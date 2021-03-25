var express = require('express')
, app = express()
, fs = require('fs');
var options = {
  key: fs.readFileSync('../../chatt_cert/Certifikat_2018-2020.pem'),
  cert: fs.readFileSync('../../chatt_cert/Certifikat_2018-2020.crt'),
  ca: fs.readFileSync('../../chatt_cert/Certifikat_2018-2020-ca.crt')
};
/*var options = {
  key: fs.readFileSync('../../chatt_cert/Lets_Encrypt_key.pem'),
  cert: fs.readFileSync('../../chatt_cert/Lets_Encrypt.crt')
};
var options = {
  key: fs.readFileSync('../../chatt_cert/key.pem'),
  cert: fs.readFileSync('../../chatt_cert/chatt.crt')
};*/
var server = require('https').createServer(options, app)
, io = require("socket.io").listen(server)
, mongoose = require("mongoose")
, async = require("async")
, npid = require("npid")
, uuid = require('node-uuid')
, People = require('./people.js')
, Chat = require('./chat.js')
, Model = require('./models/chats.js')
, _ = require('underscore')._;

//mongoose.Promise = global.Promise;
mongoose.connect("mongodb://localhost/cirrus");
var db = mongoose.connection;
var UserList = mongoose.model('User');
//var TeamList = mongoose.model('Team');
var ChatList = mongoose.model('Chat');
var MessageList = mongoose.model('Message');

app.configure(function() {
	app.set('port', process.env.OPENSHIFT_NODEJS_PORT || 3010);
  	app.set('ipaddr', process.env.OPENSHIFT_NODEJS_IP || "time2view.se");
	app.use(express.urlencoded());
	app.use(express.json());
	app.use(express.methodOverride());
	app.use(express.static(__dirname + '/public'));
	app.use('/components', express.static(__dirname + '/components'));
	app.use('/js', express.static(__dirname + '/js'));
	app.use('/icons', express.static(__dirname + '/icons'));
	app.set('views', __dirname + '/views');
	app.engine('html', require('ejs').renderFile);
	try {
	    npid.create('advanced-chat.pid', true);
	} catch (err) {
	    console.log(err);
	}
});

app.get('/', function(req, res) {
  res.render('index.html');
});

server.listen(app.get('port'), app.get('ipaddr'), function() {
	console.log('Express server listening on  IP: ' + app.get('ipaddr') + ' and port ' + app.get('port'));
});

io.set("log level", 1);
var people = {};
var chats = {};
var sockets = [];

function purge(s, action) {
	var person = s.mine;
	if (action === "disconnect") {
		var onlineList = [];
		async.waterfall([
	        function(callback) {
	        	if(people[person.user].sockets.length < 2) {
					UserList.findOneAndUpdate(
						{ user: person.user },
						{ "$set": { status: 0 } },
						{ upsert: false, new: true },
						function(err, doc) {
							callback(null);
						}
					);
	        	}
	        	else {
					callback(null);
	        	}
	        },
	        function(callback) {
	        	UserList.find()
				.where('user').in(person.user)
				.where('company').in(person.company)
				.populate({ 
					path: 'list',
					model: 'User'
				})
				.exec(function (err, result) {
					for(var i = 0;i < result.length;i++) {
						for(var j = 0;j < result[i].list.length;j++) {
							//checked twice is socket attribute exists or not - otherwise raised & crashed the code
							if (result[i].list[j].status === 1 && 
								typeof people[result[i].list[j].user] !== 'undefined' && people[result[i].list[j].user] &&
								typeof people[result[i].list[j].user].sockets !== 'undefined' && people[result[i].list[j].user].sockets) {
								onlineList[result[i].list[j].user] = people[result[i].list[j].user].sockets;
							}
						}
					}
					callback(null);
				});
	        },
	        function(callback) {
				var index = people[person.user].sockets.indexOf(s.id);
				if (index > -1) {
				    people[person.user].sockets.splice(index, 1);
				}
				if(people[person.user].sockets.length == 0) {
	        		for(var i = 0; i < Object.keys(onlineList).length; i++) {
						for (var j = 0; j < onlineList[Object.keys(onlineList)[i]].length; j++) {
							io.sockets.socket(onlineList[Object.keys(onlineList)[i]][j]).emit("disconnect", person.user);
							io.sockets.socket(onlineList[Object.keys(onlineList)[i]][j]).emit("updatePeople", person.user, 0);
						}
					}
					delete people[person.user];
				}
				/*else {
					for (var i = 0; i < people[person.user].sockets.length; i++) {
						io.sockets.socket(people[person.user].sockets[i]).emit("updatePerson", people[person.user]);
					}
				}*/
				//console.log("disconnected: ", s.id);
				var o = _.findWhere(sockets, {'id': s.id});
				sockets = _.without(sockets, o);
	        }],
		    function (err) {
		    }
		);
	}
}

io.sockets.on("connection", function (socket) {
	socket.on("joinserver", function(company, user, name, device, list) {
		var cnt = 0;
		var ids = [];
		var onlineList = [];
		if(people[user]) {
			for(cnt = 0;cnt < people[user].sockets.length;cnt++) {
				ids[cnt] = people[user].sockets[cnt];
			}
		}
		ids[cnt] = socket.id;
		people[user] = new People(ids, company, user, name, device);
		socket.mine = people[user];
		/*for (var i = 0; i < people[user].sockets.length; i++) {
			io.sockets.socket(people[user].sockets[i]).emit("updatePerson", people[user]);
		}*/
		var peopleKeys = Object.keys(people);
		var chatKeys = Object.keys(chats);
		//console.log('connected: %s (%s)', socket.id, user);
		async.waterfall([
	        function(callback) {
	        	UserList.findOneAndUpdate(
					{ company: company, user: user },
					{ "$set": { company: company, user: people[user].user, name: people[user].name, status: 1 } },
					{ upsert: true, new: true },
					function(err,doc){
						callback(null);
					}
				);
	        },
	        function(callback) {
	            if (list.admins.length != 0) {
	            	for (var i = 0; i < list.admins.length; i++) {
						var count = 0;
						for (var j = 0; j < peopleKeys.length; j++) {
							if (list.admins[i].user === peopleKeys[j]) {
								onlineList[peopleKeys[j]] = people[peopleKeys[j]].sockets;
								list.admins[i].status = 1;
								break;
							} 
						}
						UserList.findOneAndUpdate(
							{ company: company, user: list.admins[i].user },
							{ "$set": { company: company, user: list.admins[i].user, name: list.admins[i].name, status: list.admins[i].status } },
							{ upsert: true, new: true },
							function(err,doc){
								UserList.findOneAndUpdate(
									{ company: company, user: user },
									{ $addToSet: { list: doc._id }},
									{ upsert: false, new: true },
									function(err, doc) {
										count++;
										if(count === i) {
											callback(null);
										}
									}
								);
							}
						);
					}
				}
	        },
	        function(callback) {
	        	if (list.teams.length != 0) {
					for (var i = 0; i < list.teams.length; i++) {
						var count = 0;
						for (var k = 0; k < peopleKeys.length; k++) {
							if (list.teams[i].user === peopleKeys[k]) {
								onlineList[peopleKeys[k]] = people[peopleKeys[k]].sockets;
								list.teams[i].status = 1;
								break;
							} 
						}
						UserList.findOneAndUpdate(
							{ company: company, user: list.teams[i].user },
							{ "$set": { company: company, user: list.teams[i].user, name: list.teams[i].name, status: list.teams[i].status } },
							{ upsert: true, new: true },
							function(err, member){
								UserList.findOneAndUpdate(
									{ company: company, user: user },
									{ $addToSet: { list: member._id }},
									{ upsert: false, new: true },
									function(err, doc) {
										count++;
										if(count === i) {
											callback(null, list.teams);
										}
									}
								);
							}
						);
					}
				}
	        },
	        function(teams, callback) {
	        	var i = 0;
				var setTeam = function(team, callback) {
				    for (var j = 0; j < team.members.length; j++) {
	        			for (var k = 0; k < peopleKeys.length; k++) {
							if (team.members[j].user === peopleKeys[k]) {
								onlineList[peopleKeys[k]] = people[peopleKeys[k]].sockets;
								list.teams[i].members[j].status = 1;
								break;
							}
						}
						updateTeam(company, user, team.user, team.members[j], function(err) {
						});
	        		}
	        		i++;
				    return callback();
				}
				async.forEach(teams, setTeam, function(error) {
				    if (error) {   
				        callback(error)
				    } else {
				        callback(null);
				    }
				});
	        },
	        function(callback) {
	        	for (var i = 0; i < chatKeys.length; i++) {
					if(chats[chatKeys[i]].sender.user === user || chats[chatKeys[i]].receiver.user === user) {
						if(chats[chatKeys[i]].sender.user === user) {
							chats[chatKeys[i]].sender = people[user];
							for (var j = 0; j < chats[chatKeys[i]].receiver.sockets.length; j++) {
								io.sockets.socket(chats[chatKeys[i]].receiver.sockets[j]).emit("reconnect", user);
							}
						}
						else if(chats[chatKeys[i]].receiver.user === user) {
							chats[chatKeys[i]].receiver = people[user];
							for (var j = 0; j < chats[chatKeys[i]].sender.sockets.length; j++) {
								io.sockets.socket(chats[chatKeys[i]].sender.sockets[j]).emit("reconnect", user);
							}
						}
					}
				}
				socket.emit("updateTeam", Object.keys(onlineList));
				for(var i = 0; i < Object.keys(onlineList).length; i++) {
					for (var j = 0; j < onlineList[Object.keys(onlineList)[i]].length; j++) {
						io.sockets.socket(onlineList[Object.keys(onlineList)[i]][j]).emit("updatePeople", user, 1);
					}
				}
	        }],
		    function (err) {
		    }
		);
		sockets.push(socket);
	});

	var updateTeam = function(company, user, team, member, callback) {
		UserList.findOneAndUpdate(
			{ company: company, user: member.user },
			{ "$set": { company: company, user: member.user, name: member.name, status: member.status } },
			{ upsert: true, new: true },
			function(err, team_member) {
				if (err) {
					callback(err);
				}
				UserList.findOneAndUpdate(
					{ company: company, user: user },
					{ $addToSet: { list: team_member._id }},
					{ upsert: false, new: true },
					function(err, doc) {
						callback(null);
					}
				);
			}
		);
	}

	socket.on("getOnlinePeople", function(fn) {
		fn({people: people});
	});

	socket.on("typing", function(/*person, */id, status) {
		/*if (typeof people[person.user] !== "undefined") {
			io.sockets.in(socket.room).emit("isTyping", {isTyping: status, id: id, name: person.name, username: person.user});
		}*/
		if (typeof socket.mine !== "undefined" && typeof socket.mine.user !== "undefined" && typeof people[socket.mine.user] !== "undefined") {
			io.sockets.in(socket.room).emit("isTyping", {isTyping: status, id: id, name: socket.mine.name, username: socket.mine.user});
		}
	});

	socket.on("disconnect", function() {
		if(socket.mine) {
			purge(socket, "disconnect");
		}
	});

	socket.on("createChat", function(receiverUser, mode, chatData) {
		var own = false;
		var person = socket.mine;
		var sender = person;
		var receiver = undefined;
		var keys = Object.keys(people);
		if (keys.length != 0) {
			for (var i = 0; i<keys.length; i++) {
				if (keys[i] === receiverUser) {
					receiver = people[keys[i]];
					if (mode == 0 && sender === people[keys[i]].id) {
						own = true;
						break;
					}
				} 
			}
		}
		if(mode == 1) {
			sender = chatData.sender;
		}
		if(!own) {
			var chatKey = undefined;
			ChatList.find()
			.populate({ 
                path: 'messages',
                model: 'Message',
                options : { limit : 20, sort: { '_id': 1 } }
            })
			.where('company').in(socket.mine.company)
		    .where('chat_id').in(sender.user + "_" + receiver.user)
		    .exec(function (err, result) {
		        if(result.length == 0) {
		        	ChatList.find()
					.populate({ 
		                path: 'messages',
		                model: 'Message',
                		options : { limit : 20, sort: { '_id': 1 } }
		            })
				    .where('company').in(socket.mine.company)
				    .where('chat_id').in(receiver.user + "_" + sender.user)
				    .exec(function (err, result) {
				        if(result.length == 0) {
				        	var ChatObject = new ChatList();
							ChatObject.company = socket.mine.company;
							ChatObject.chat_id = sender.user + "_" + receiver.user;
							ChatObject.sender = sender.name;
							ChatObject.receiver = receiver.name;
							ChatObject.save(function (err, sObj) {
								if (err) { 
									return;
								}
				        		chatKey = sObj._id;
						        var chat = new Chat(chatKey, sender, receiver);
								chats[chatKey] = chat;
								if(mode == 0) {
									for (var i = 0; i < person.sockets.length; i++) {
										io.sockets.socket(person.sockets[i]).emit("chatList", { chat: chats[chatKey], user: receiver.user, name: receiver.name }, {});
									}
								}
								else {
									for(var i = 0;i < receiver.sockets.length;i++) {
										io.sockets.socket(receiver.sockets[i]).emit("chatList", { chat: chats[chatData.chat_id], user: chatData.user, name: chatData.name }, {});
										io.sockets.socket(receiver.sockets[i]).emit("sendChat", { id:chatData.id, chat_id:chatData.chat_id, msTime:chatData.msTime, user:chatData.user, person:chatData.name, msg:chatData.msg, senderUser:chatData.user });
									}
								}
							});
				        }
				        else {
				        	chatKey = result[0]._id;
					        var chat = new Chat(chatKey, sender, receiver);
							chats[chatKey] = chat;
							if(mode == 0) {
								for (var i = 0; i < person.sockets.length; i++) {
									io.sockets.socket(person.sockets[i]).emit("chatList", { chat: chats[chatKey], user: receiver.user, name: receiver.name }, result[0].messages);
								}
							}
							else {
								for(var i = 0;i < receiver.sockets.length;i++) {
									io.sockets.socket(receiver.sockets[i]).emit("chatList", { chat: chats[chatData.chat_id], user: chatData.user, name: chatData.name }, result[0].messages);
									io.sockets.socket(receiver.sockets[i]).emit("sendChat", { id:chatData.id, chat_id:chatData.chat_id, msTime:chatData.msTime, user:chatData.user, person:chatData.name, msg:chatData.msg, senderUser:chatData.user });
								}
							}
				        }
				    });
		        }
		        else {
		        	chatKey = result[0]._id;
		        	var chat = new Chat(chatKey, sender, receiver);
					chats[chatKey] = chat;
					if(mode == 0) {
						for (var i = 0; i < person.sockets.length; i++) {
							io.sockets.socket(person.sockets[i]).emit("chatList", { chat: chats[chatKey], user: receiver.user, name: receiver.name }, result[0].messages);
						}
					}
					else {
						for(var i = 0;i < receiver.sockets.length;i++) {
							io.sockets.socket(receiver.sockets[i]).emit("chatList", { chat: chats[chatData.chat_id], user: chatData.user, name: chatData.name }, result[0].messages);
							io.sockets.socket(receiver.sockets[i]).emit("sendChat", { id:chatData.id, chat_id:chatData.chat_id, msTime:chatData.msTime, user:chatData.user, person:chatData.name, msg:chatData.msg, senderUser:chatData.user });
						}
					}
		        }
		    });
		}
	});

	socket.on("sendChat", function(msTime, id, sender, receiver, msg) {
		var person = socket.mine
		var sender_flag = false;
		var sender = people[sender];
		var receiver = people[receiver];
		var MessageObject = new MessageList();
		if(sender) {
			for (var i = 0; i < sender.sockets.length; i++) {
				if(socket.id === sender.sockets[i]) {
					sender_flag = true;
					break;
				}
			}
		}
		if(sender_flag) {
			MessageObject.chat_id = id;
			MessageObject.user = sender.user;
			MessageObject.person = sender.name;
			MessageObject.message = msg;
			MessageObject.status = 1;
			MessageObject.save(function (err, sObj) {
				if (err) { 
					return;
				}
				ChatList.findOneAndUpdate(
	                { company: person.company, _id: MessageObject.chat_id },
	                { $push: { messages: sObj }},
	                { upsert: false },
	                function(err,doc){
	                    if (err) {
	                        return;
	                    }
	                }
	            );
	            if(receiver) {
					for (var i = 0; i < person.sockets.length; i++) {
						io.sockets.socket(person.sockets[i]).emit("sendChat", { id:MessageObject._id, chat_id:MessageObject.chat_id, msTime:MessageObject.date, user:receiver.user, person:sender.name, msg:MessageObject.message, senderUser:sender.user });
					}
					io.sockets.socket(receiver.sockets[0]).emit("createChat", receiver.user, 1, { id:MessageObject._id, chat_id:MessageObject.chat_id, sender:sender, user:sender.user, name:sender.name, msg:msg, msTime:msTime });
	            }
	            else {
	            	for (var i = 0; i < person.sockets.length; i++) {
						io.sockets.socket(person.sockets[i]).emit("sendChat", { id:MessageObject._id, chat_id:MessageObject.chat_id, msTime:MessageObject.date, user:null, person:sender.name, msg:MessageObject.message, senderUser:sender.user });
					}
	            }
			});
		}
		else{
			MessageObject.chat_id = id;
			MessageObject.user = receiver.user;
			MessageObject.person = receiver.name;
			MessageObject.message = msg;
			MessageObject.status = 1;
			MessageObject.save(function (err, sObj) {
				if (err) { 
					return;
				}
				ChatList.findOneAndUpdate(
	                { company: person.company, _id: MessageObject.chat_id },
	                { $push: { messages: sObj }},
	                { upsert: false },
	                function(err,doc){
	                    if (err) {
	                        return;
	                    }
	                }
	            );
	            if(receiver) {
		            for (var i = 0; i < person.sockets.length; i++) {
						io.sockets.socket(person.sockets[i]).emit("sendChat", { id:MessageObject._id, chat_id:MessageObject.chat_id, msTime:MessageObject.date, user:receiver.user, person:receiver.name, msg:MessageObject.message, senderUser:receiver.user });
					}
					if(sender) {
						io.sockets.socket(receiver.sockets[0]).emit("createChat", sender.user, 1, { id:MessageObject._id, chat_id:MessageObject.chat_id, sender:receiver, user:receiver.user, name:receiver.name, msg:msg, msTime:msTime });
					}
	            }
	            else {
		            for (var i = 0; i < person.sockets.length; i++) {
						io.sockets.socket(person.sockets[i]).emit("sendChat", { id:MessageObject._id, chat_id:MessageObject.chat_id, msTime:MessageObject.date, user:null, person:receiver.name, msg:MessageObject.message, senderUser:receiver.user });
					}
				}
			});
		}
	});
});
