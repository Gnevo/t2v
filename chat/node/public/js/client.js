/* HTML5 magic
- GeoLocation
- WebSpeech
*/

//WebSpeech API
var final_transcript = '';
var recognizing = false;
var last10messages = []; //to be populated later

if (!('webkitSpeechRecognition' in window)) {
	console.log("webkitSpeechRecognition is not available");
} else {
	var recognition = new webkitSpeechRecognition();
	recognition.continuous = true;
	recognition.interimResults = true;

	recognition.onstart = function() {
		recognizing = true;
	};

	recognition.onresult = function(event) {
		var interim_transcript = '';
		for (var i = event.resultIndex; i < event.results.length; ++i) {
			if (event.results[i].isFinal) {
				final_transcript += event.results[i][0].transcript;
				$('#msg').addClass("final");
				$('#msg').removeClass("interim");
			} else {
				interim_transcript += event.results[i][0].transcript;
				$("#msg").val(interim_transcript);
				$('#msg').addClass("interim");
				$('#msg').removeClass("final");
			}
		}
		$("#msg").val(final_transcript);
	};
}

function startButton(event) {
	if (recognizing) {
		recognition.stop();
		recognizing = false;
		$("#start_button").prop("value", "Record");
		return;
	}
	final_transcript = '';
	recognition.lang = "en-GB"
	recognition.start();
	$("#start_button").prop("value", "Recording ... Click to stop.");
	$("#msg").val();
}
//end of WebSpeech

/*
Functions
*/
function toggleNameForm() {
   $("#login-screen").toggle();
}

function toggleChatWindow() {
  $("#main-chat-screen").toggle();
}

// Pad n to specified size by prepending a zeros
function zeroPad(num, size) {
  var s = num + "";
  while (s.length < size)
	s = "0" + s;
  return s;
}

var mine = '';
var typing = false;
var chatId = undefined;
var timeout = undefined;
var socket = io.connect("time2view.se:3010", {secure:true});
//var socket = io.connect('https://www.time2view.se/chat', {resource: 'chat/socket.io'});

function timeoutFunction() {
	socket.emit("typing", mine, chatId, false);
	chatId = undefined;
	typing = false;
}

// Format the time specified in ms from 1970 into local HH:MM:SS
function timeFormat(msTime) {
	var d = new Date(msTime);
	return zeroPad(d.getHours(), 2) + ":" +
		zeroPad(d.getMinutes(), 2) + ":" +
		zeroPad(d.getSeconds(), 2) + " ";
}

$(document).ready(function() {
	$(document).on('click', ".single_chat", function() {
		$("#msg_"+$(this).data("id")).focus();
		socket.emit("sendChat", mine, new Date().getTime(), $(this).data("id"), $(this).data("sender"), $(this).data("receiver"), $("#msg_"+$(this).data("id")).val());
		$("#msg_"+$(this).data("id")).val("");
	});

	$(document).on('keypress', ".single_msg", function(e) {
		chatId = $(this).data("id");
		if (e.which === 13) {
			socket.emit("sendChat", mine, new Date().getTime(), $(this).data("id"), $(this).data("sender"), $(this).data("receiver"), $("#msg_"+$(this).data("id")).val());
			$("#msg_"+$(this).data("id")).val("");
		}
		else {
			if (typing === false && $(".single_msg").is(":focus")) {
				socket.emit("typing", mine, $(this).data("id"), true);
				typing = true;
			} else {
				clearTimeout(timeout);
				timeout = setTimeout(timeoutFunction, 2000);
			}
		}
	});

	$("form").submit(function(event) {
		event.preventDefault();
	});

	$("#conversation").bind("DOMSubtreeModified",function() {
		$("#conversation").animate({
			scrollTop: $("#conversation")[0].scrollHeight
		});
	});

	$("#main-chat-screen").hide();
	$("#errors").hide();
	$("#name").focus();
	$("#join").attr('disabled', 'disabled'); 
  
	if ($("#name").val() === "") {
		$("#join").attr('disabled', 'disabled');
	}

	//enter screen
	$("#nameForm").submit(function() {
		var user = $("#user").val();
		var name = $("#name").val();
		var device = "desktop";
		var chatList = [];
		var admins = [];
		var teams = [];
		data = {}
        data["admins"] = [];
        data["teams"] = [];
        admin = {}
        admin["status"] = 0;
        admin["user"] = "dodo001";
        admin["name"] = "Donadoni";
		admins.push(admin);
		admin = {}
        admin["status"] = 0;
        admin["user"] = "anke001";
        admin["name"] = "Anne Kate";
		admins.push(admin);
		data["admins"] = admins;
		team = {}
        team["status"] = 0;
        team["user"] = "cifo001";
        team["name"] = "Cibin Force";
        team["members"] = [];
        member = {}
        member["status"] = 0;
        member["user"] = "shkt001";
        member["name"] = "Shaju";
		team["members"].push(member);
        member = {}
        member["status"] = 0;
        member["user"] = "vive001";
        member["name"] = "Vineeth";
		team["members"].push(member);
        member = {}
        member["status"] = 0;
        member["user"] = "niva001";
        member["name"] = "Nithin";
		team["members"].push(member);
		teams.push(team);
		team = {}
        team["status"] = 0;
        team["user"] = "gine001";
        team["name"] = "Gilad Nevo";
        team["members"] = [];
        member = {}
        member["status"] = 0;
        member["user"] = "shkt001";
        member["name"] = "Shaju";
		team["members"].push(member);
        member = {}
        member["status"] = 0;
        member["user"] = "diks001";
        member["name"] = "Divya";
		team["members"].push(member);
        member = {}
        member["status"] = 0;
        member["user"] = "ummu001";
        member["name"] = "Umer Mukthar";
		team["members"].push(member);
		teams.push(team);
		data["teams"] = teams;
        chatList.push(data);
		if (navigator.userAgent.match(/Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i)) {
		  device = "mobile";
		}
		if (user === "" || user.length < 2) {
			$("#errors").empty();
			$("#errors").append("Please enter a name");
			$("#errors").show();
		} else {
			socket.emit("joinserver", user, name, device, chatList[0]);
			toggleNameForm();
			toggleChatWindow();
		}
	});

	$("#name").keypress(function(e){
		var user = $("#user").val();
		var name = $("#name").val();
		if(user.length < 2) {
			$("#join").attr('disabled', 'disabled'); 
		} else {
		  $("#errors").empty();
		  $("#errors").hide();
		  $("#join").removeAttr('disabled');
		}
	});

	$("#people").on('click', '.whisper', function() {
		socket.emit("createChat", mine, $(this).data('value'), 0, { id:"", msg:"", msTime:"" });
	});

	socket.on("update-person", function(data) {
		mine = data;
	});

	socket.on("setTeam", function(chatList) {
		console.log(chatList);
		var teams = chatList.teams;
		var admins = chatList.admins;
		if (teams.length === 0) {
			$("#people").append("<li class=\"list-group-item\">There are no members in your team.</li>");
		} else {
			$.each(teams, function(a, team) {
				var whisper = " ";
				var status = " fa fa-comment-o";
				if(team.status == 1) {
					whisper = " whisper ";
					status = " fa fa-comment";
				}
				$('#people').append("<li class=\"list-group-item active\"><i class=\"icon_" + team.user + status + "\"></i><a href=\"javascript:void(0)\" data-value='" + team.user + "' class=\"chat_" + team.user + whisper + "btn btn-xs\" style=\"color:#ffffff;\">"+team.name+"</a></li>");
				$.each(team.members, function(a, member) {
					whisper = " ";
					status = " fa fa-comment-o";
					if(member.status == 1) {
						whisper = " whisper ";
						status = " fa fa-comment";
					}
					$('#people').append("<li class=\"list-group-item\"><i class=\"icon_" + member.user + status + "\"></i><a href=\"javascript:void(0)\" data-value='" + member.user + "' class=\"chat_" + member.user + whisper + "btn btn-xs\">" + member.name + "</a></li>");
				});
			});
			$('#people').append("<li class=\"list-group-item active\">Admins</li>");
			$.each(admins, function(a, admin) {
				whisper = " ";
				status = " fa fa-comment-o";
				if(admin.status == 1) {
					whisper = " whisper ";
					status = " fa fa-comment";
				}
				$('#people').append("<li class=\"list-group-item\"><i class=\"icon_" + admin.user + status + "\"></i><a href=\"javascript:void(0)\" data-value='" + admin.user + "' class=\"chat_" + admin.user + whisper + "btn btn-xs\">" + admin.name + "</a></li>");
			});
		}
	});

	socket.on("update-people", function(chatList) {
		var teams = chatList.teams;
		var admins = chatList.admins;
		$.each(teams, function(a, team) {
			if(team.status == 1) {
				$('.chat_'+team.user).addClass("whisper");
				$('.icon_'+team.user).removeClass("fa fa-comment-o").addClass("fa fa-comment");
			}
			else {
				$('.chat_'+team.user).removeClass("whisper");
				$('.icon_'+team.user).removeClass("fa fa-comment").addClass("fa fa-comment-o");
			}
			$.each(team.members, function(a, member) {
				if(member.status == 1) {
					$('.chat_'+member.user).addClass("whisper");
					$('.icon_'+member.user).removeClass("fa fa-comment-o").addClass("fa fa-comment");
				}
				else {
					$('.chat_'+member.user).removeClass("whisper");
					$('.icon_'+member.user).removeClass("fa fa-comment").addClass("fa fa-comment-o");
				}
			});
		});
		$.each(admins, function(a, admin) {
			if(admin.status == 1) {
				$('.chat_'+admin.user).addClass("whisper");
				$('.icon_'+admin.user).removeClass("fa fa-comment-o").addClass("fa fa-comment");
			}
			else {
				$('.chat_'+admin.user).removeClass("whisper");
				$('.icon_'+admin.user).removeClass("fa fa-comment").addClass("fa fa-comment-o");
			}
		});
	});

	socket.on("isTyping", function(data) {
		if (data.isTyping) {
			if($("#name").val() !== data.name) {
				$("#typing_"+data.id).html("<span class='text-muted'><small><i class='fa fa-keyboard-o'></i> " + data.name + " is typing.</small></span>");
				timeout = setTimeout(timeoutFunction, 2000);
			}
		} else {
			$("#typing_"+data.id).html("");
		}
	});

	socket.on("sendChat", function(data) {
		if(!$("#"+data.id).length) {
			$("#msgs_"+data.chat_id).append("<li id='" + data.id + "'><strong><span class='text-muted'>" + timeFormat(data.msTime) + data.person + "</span></strong> : " + data.msg + "</li>");
		}
	});

	socket.on("createChat", function(name, mode, chat) {
		socket.emit("createChat", mine, name, mode, chat);
	});

	socket.on("chatList", function(data, chats) {
		if(!$("#"+data.chat.id).length) {
			var html = "<div id=conversation_"+data.chat.id+">";
			html += "<div id='close_"+data.chat.id+"' style=\"text-align:right;\"><a href=\"javascript:void(0)\">Close</a></div>";
			html += "<div id='typing_"+data.chat.id+"'></div>";
			html += "<ul id='msgs_"+data.chat.id+"' class='list-unstyled'></ul>";
			html += "</div>";
			html += "<div class=\"input-group\">";
			html += "<input type='text' name='msg_"+data.chat.id+"' id='msg_"+data.chat.id+"' data-id='"+data.chat.id+"' data-sender='"+data.chat.sender.user+"' data-receiver='"+data.chat.receiver.user+"' class='form-control input-lg single_msg' placeholder='Your message'>";
			html += "<span class=\"input-group-btn\"><button type='button' name='send_"+data.chat.id+"' id='send_"+data.chat.id+"' data-id='"+data.chat.id+"' data-sender='"+data.chat.sender.user+"' data-receiver='"+data.chat.receiver.user+"' class='btn btn-success btn-lg single_chat'>Send</button></span>";
			html += "</div>";
			$("#chats").append("<li id=title_"+data.chat.id+" class=\"list-group-item active\"><i id=status_"+data.user+" class=\"fa fa-user-circle-o\" style=\"color:#00ff00;\"></i> "+data.name+"</li>");
			$('#chats').append("<li id="+data.chat.id+" class=\"list-group-item\">" + html + "</li>");
			if(chats.length > 0) {
				$.each(chats, function(a, chat) {
					$("#msgs_"+chat.chat_id).append("<li id='"+chat._id+"'><strong><span class='text-muted'>" + timeFormat(chat.date) + chat.person + "</span></strong> : " + chat.message + "</li>");
				});
			}
		}
	});

	socket.on("reconnect", function(id){
		$("#status_"+id).css("color", "#00ff00");
	});

	socket.on("disconnect", function(id){
		$("#status_"+id).css("color", "#eeeeee");
	});
});