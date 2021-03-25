var final_transcript = '';
var recognizing = false;
var last10messages = []; //to be populated later


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
// var socket = io.connect("192.168.0.234:3010");
// var socket = io.connect(chat_service_url, {secure: true});

if(typeof io !== 'undefined'){

	// if(window.localStorage.getItem('CSID-Cirrus') != '')
	// 	var socket = window.localStorage.getItem('CSID-Cirrus');
	// else
		var socket = io.connect(chat_service_url);
		// console.log(socket);

	function timeoutFunction() {
		socket.emit("typing", chatId, false);
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

		$(document).on('click', ".chat-pop .single_chat", function() {
			$(".chat-pop #msg_"+$(this).data("id")).focus();
			socket.emit("sendChat", new Date().getTime(), $(this).data("id"), $(this).data("sender"), $(this).data("receiver"), $(".chat-pop #msg_"+$(this).data("id")).val());
			$(".chat-pop #msg_"+$(this).data("id")).val("");
		});

		$(document).on('keypress', ".chat-pop .single_msg", function(e) {
			chatId = $(this).data("id");
			if (e.which === 13) {
				socket.emit("sendChat", new Date().getTime(), $(this).data("id"), $(this).data("sender"), $(this).data("receiver"), $(".chat-pop #msg_"+$(this).data("id")).val());
				$(".chat-pop #msg_"+$(this).data("id")).val("");
			}
			else {
				if (typing === false && $(".chat-pop .single_msg").is(":focus")) {
					socket.emit("typing", $(this).data("id"), true);
					typing = true;
				} else {
					clearTimeout(timeout);
					timeout = setTimeout(timeoutFunction, 5000);
				}
			}
		});

		$(".chat-pop form").submit(function(event) {
			event.preventDefault();
		});

		$("#chat_list_main_wraper_group #people").on('click', '.whisper', function() {
			socket.emit("createChat", $(this).data('value'), 0, { id:"", msg:"", msTime:"" });
		});

		/*socket.on("updatePerson", function(data) {
			mine = data;
			// console.log(socket.socket.sessionid);
			// console.log('before', window.localStorage.getItem('CSID-Cirrus'));
			// window.localStorage.setItem('CSID-Cirrus', socket.socket.sessionid);
			// window.localStorage.setItem('CSID-Cirrus', socket);
			// console.log('after', window.localStorage.getItem('CSID-Cirrus'));
		});*/

		socket.on("updateTeam", function(onlineList) {
			// console.log(onlineList);
			$.each(onlineList, function(a, user) {
				$('#chat_list_main_wraper_group #people .chat_'+user).addClass("whisper");
				$('#chat_list_main_wraper_group #people .user_'+user).removeClass("hide");
				$('#chat_list_main_wraper_group #people .icon_'+user).removeClass("icon-comments-alt").addClass("icon-comments");

				$('#chat_list_main_wraper_group #people .user_'+user).map(function() {
					$('#chat_list_main_wraper_group #people .user_'+$(this).data("team")).removeClass("hide");
					$('#chat_list_main_wraper_group #people .user_'+$(this).data("team")).data("members", parseInt($('#chat_list_main_wraper_group #people .user_'+$(this).data("team")).data("members")) + 1);
				});

				$('#chat_list_main_wraper_group #people .user_'+$('#chat_list_main_wraper_group #people .user_'+user).data("team")).removeClass("hide");
			});
		});

		socket.on("updatePeople", function(user, status) {
			if(status == 0) {
				$('#chat_list_main_wraper_group #people .chat_'+user).removeClass("whisper");
				$('#chat_list_main_wraper_group #people .icon_'+user).removeClass("icon-comments").addClass("icon-comments-alt");
				if($('#chat_list_main_wraper_group #people .user_'+user).data("members") <= 1 || $('#chat_list_main_wraper_group #people .user_'+user).data("members") === undefined) {
					$('#chat_list_main_wraper_group #people .user_'+user).addClass("hide");
				}
				$('#chat_list_main_wraper_group #people .user_'+user).map(function() {
					$('#chat_list_main_wraper_group #people .user_'+$(this).data("team")).data("members", parseInt($('#chat_list_main_wraper_group #people .user_'+$(this).data("team")).data("members")) - 1);
					if($('#chat_list_main_wraper_group #people .user_'+$(this).data("team")).data("members") <= 0) {
						$('#chat_list_main_wraper_group #people .user_'+$(this).data("team")).addClass("hide");
					}
				});
			}
			else {
				$('#chat_list_main_wraper_group #people .chat_'+user).addClass("whisper");
				$('#chat_list_main_wraper_group #people .icon_'+user).removeClass("icon-comments-alt").addClass("icon-comments");
				$('#chat_list_main_wraper_group #people .user_'+user).removeClass("hide");
				$('#chat_list_main_wraper_group #people .user_'+user).map(function() {
					$('#chat_list_main_wraper_group #people .user_'+$(this).data("team")).removeClass("hide");
					$('#chat_list_main_wraper_group #people .user_'+$(this).data("team")).data("members", parseInt($('#chat_list_main_wraper_group #people .user_'+$(this).data("team")).data("members")) + 1);
				});
			}
		});

		socket.on("isTyping", function(data) {
			// console.log(data);
			if (data.isTyping) {
				if(user !== data.username) {
					// $("#typing_"+data.id).html("<span class='text-muted'><small><i class='fa fa-keyboard-o'></i> " + data.name + " is typing.</small></span>");
					$(".chat-pop #typing_"+data.id).html('<span class="text-muted"><small><i class="icon icon-keyboard"></i> '+ data.name +' is typing.</small></span>');
					timeout = setTimeout(timeoutFunction, 10000);	//10 seconds
					// timeout = setTimeout(timeoutFunction, 120000);
				}
			} else {
				$(".chat-pop #typing_"+data.id).html("");
			}
		});

		socket.on("sendChat", function(data) {
			// $("#msgs_"+id).append("<li><strong><span class='text-muted'>" + timeFormat(msTime) + person + "</span></strong> : " + msg + "</li>");
			// console.log(msTime, id, sender, receiver, sender_user, person, msg);

			create_chat_entry(data.id, data.chat_id, data.senderUser, data.person, data.msTime, data.msg, true);
		});

		socket.on("createChat", function(name, mode, chat) {
			socket.emit("createChat", name, mode, chat);
		});

		socket.on("chatList", function(data, chats) {
			if(data.user != user){
				if(!$(".chat-pop#conversation_"+data.chat.id).length) {
					
					var html = '<div class="chat-pop" id="conversation_'+data.chat.id+'">\n\
		                <div class="box box-primary direct-chat direct-chat-primary">\n\
		                    <div id="title_'+data.chat.id+'" class="box-header with-border">\n\
		                        <h3 class="box-title" title="'+data.name+'">'+data.name+'</h3>\n\
		                        <div class="box-tools pull-right">\n\
		                            <button class="btn btn-box-tool" data-widget="collapse"><i class="icon icon-minus"></i></button>\n\
		                            <button class="btn btn-box-tool" data-widget="remove"><i class="icon icon-remove"></i></button>\n\
		                        </div>\n\
		                    </div>\n\
		                    <div class="box-body">\n\
		                        <div class="direct-chat-messages">\n\
		                        	<div id="msgs_'+data.chat.id+'" class="conversation_contents">\n\
									</div>\n\
		                        	<div class="no-min-height">\n\
			                            <div class="typing_indicator no-min-height">\n\
										   <div id="typing_'+data.chat.id+'" class="no-min-height pull-left"></div>\n\
										</div>\n\
									</div>\n\
		                        </div>\n\
		                    </div>\n\
		                    <div class="box-footer">\n\
		                        <!--form method="post" class="no-margin"-->\n\
		                            <div class="input-group">\n\
		                                <input type="text" name="msg_'+data.chat.id+'" id="msg_'+data.chat.id+'" data-id="'+data.chat.id+'" data-sender="'+data.chat.sender.user+'" data-receiver="'+data.chat.receiver.user+'" placeholder="Type Message ..." class="form-control single_msg">\n\
		                                <span class="input-group-btn">\n\
		                                    <button type="button" name="send_'+data.chat.id+'" id="send_'+data.chat.id+'" data-id="'+data.chat.id+'" data-sender="'+data.chat.sender.user+'" data-receiver="'+data.chat.receiver.user+'" class="btn btn-primary btn-flat single_chat">Send</button>\n\
		                                </span>\n\
		                            </div>\n\
		                        <!--/form-->\n\
		                    </div>\n\
		                </div>\n\
		            </div>';
		            $('#chats').append(html);

		            //load chat history
		            var previous_chat_length = chats.length;
		            if(previous_chat_length > 0) {
						$.each(chats, function(a, chat) {
							create_chat_entry(chat._id, chat.chat_id, chat.user, chat.person, chat.date, chat.message, (previous_chat_length == a+1 ? true : false));
						});
					}

		            $(".chat-pop#conversation_"+data.chat.id).find('.box input#msg_'+data.chat.id).focus();
				} else {
					if($(".chat-pop#conversation_"+data.chat.id).find('.box').hasClass('collapsed-box')){
						$(".chat-pop#conversation_"+data.chat.id).find('.box [data-widget="collapse"]').trigger('click');
					}
					$(".chat-pop#conversation_"+data.chat.id).find('.box input#msg_'+data.chat.id).focus();
				}
			}
		});

		socket.on("reconnect", function(id){
			// console.log('reconnect', id);
			$(".chat-pop i.icon_"+id).removeClass('icon-comments-alt').addClass("icon-comments");
			$("#people i.icon_"+id).removeClass('icon-comments-alt').addClass("icon-comments");
			// console.log($("#people i.icon_"+id));
		});

		socket.on("disconnect", function(id){
			// console.log('disconnect', id);
			$(".chat-pop i.icon_"+id).removeClass('icon-comments').addClass("icon-comments-alt");
			$("#people i.icon_"+id).removeClass('icon-comments').addClass("icon-comments-alt");
		});

		loadChatList();
		
		$(document).on("click", '.chat-display [data-widget="collapse"]', function(e) {
			// console.log('collapse click');
		    e.preventDefault();
		    var a = $(this),
		      	c = a.parents(".box").first(),
	          	d = c.find("> .box-body, > .box-footer, > form  >.box-body, > form > .box-footer");
	        c.hasClass("collapsed-box") ? 
	        	(a.children(":first").removeClass('icon-plus').addClass('icon-minus'),
		        d.slideDown(500, function() {
		            c.removeClass("collapsed-box");
		            c.parents(".chat-pop").removeClass("collapsed");
		        })) : 

		        (a.children(":first").removeClass('icon-minus').addClass('icon-plus'),
	            c.parents(".chat-pop").addClass("collapsed"),
		        d.slideUp(500, function() {
		            c.addClass("collapsed-box");
		        }))
		}),
		$(document).on("click", '.chat-display [data-widget="remove"]', function(e) {
			// console.log('remove click');
		    e.preventDefault();
		    var a = $(this),
		    	b = a.parents(".box").first();
	    	// if(b.hasClass("collapsed-box"))
	    		b.parents(".chat-pop").addClass("collapsed");
	    		b.parents(".chat-pop").remove();
	        b.slideUp(500);

	        // socket.emit("disconnect");
		}),
		$(document).on("keyup", '.peoples_list #chat-people-search', function(e) {
			// console.log('remove click');
		    e.preventDefault();
		    var search_val = $(this).val();
            search_val = search_val.toLowerCase();
            if (search_val == '') {
                $('.peoples_list ul#people li:not(.admin-header)').each(function() {
                    $(this).removeClass('hide_chat_people_entry');
                });
            } else {
                $('.peoples_list ul#people li:not(.admin-header)').each(function() {
                    var obj_ref = $(this);
                    var row_name = obj_ref.find('a').html().toLowerCase();
                    var regExp = new RegExp(search_val, 'i');
                    if (regExp.test(row_name)){
                        $(this).removeClass('hide_chat_people_entry');

                        if(!obj_ref.hasClass('list-group-item-header')){
                        	$('.peoples_list ul#people .user_'+obj_ref.data('team')).removeClass('hide_chat_people_entry');
                        }
                    }else
                        $(this).addClass('hide_chat_people_entry');
                });
            }
		})
	});


	function loadChatList() {
			//var user = 'shkt001';
			//var name = 'shaju';
			var device = "desktop";
			var admins = [];
			var teams = [];
	        
	        //console.log(JSON.stringify(chatList));
			if (navigator.userAgent.match(/Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i)) {
			  device = "mobile";
			}
			if (user === "" || user.length < 2) {
				$(".chat-pop #errors").empty();
				$(".chat-pop #errors").append("Please enter a name");
				$(".chat-pop #errors").show();
			} else {
				// console.log(chatList[0]);
				// console.log(user, name, device);
				// console.log(chatListPeoples[0]);
				socket.emit("joinserver", user_current_company, user, name, device, chatListPeoples[0]);
			}

			var teams = (typeof chatListPeoples[0] != 'undefined' && typeof chatListPeoples[0].teams != 'undefined') ? chatListPeoples[0].teams : [];
			var admins = (typeof chatListPeoples[0] != 'undefined' && typeof chatListPeoples[0].admins != 'undefined') ? chatListPeoples[0].admins : [];
			// console.log('hi');
			// console.log(chatListPeoples[0]);
			// console.log(JSON.stringify(admins));
			if (admins.length === 0 && teams.length === 0) {
				$("#chat_list_main_wraper_group #people").append("<li class=\"list-group-item\">There are no members in your team.</li>");
			} else {
				$.each(teams, function(a, team) {
					var status = " icon icon-comments-alt";
					$('#chat_list_main_wraper_group  #people').append("<li class=\" icon-toggle-down list-group-item active list-group-item-header user_"+ team.user +" hide\" data-members=\"0\"><i class=\"icon_" + team.user + status + "\"></i><a href=\"javascript:void(0)\" data-value='" + team.user + "' class=\"chat_" + team.user + " btn btn-xs\" style=\"color:#ffffff;\" >"+team.name+"<span class='icon  pull-right icon-change' onclick = collaspse_employee('"+team.user+"',event,this)></span></a></li>");
					$.each(team.members, function(a, member) {
						if(member.user != user){
							status = " icon icon-comments-alt";
							$('#chat_list_main_wraper_group #people').append("<li class=\"list-group-item user_"+ member.user +" in collapse hide\" data-team=\""+ team.user +"\"><i class=\"icon_" + member.user + status + "\"></i><a href=\"javascript:void(0)\" data-value='" + member.user + "' class=\"chat_" + member.user + " btn btn-xs\">" + member.name + "</a></li>");
						}
					});
				});
				$('#chat_list_main_wraper_group #people').append("<li class=\" icon-toggle-down list-group-item active list-group-item-header admin-header user_admin hide\" data-members=\"0\"><i class=\"icon-user icon\"></i><a href=\"javascript:void(0)\" class='btn btn-xs'  style=\"color:#ffffff;margin-left:3px;\">Admins<span class='icon  pull-right icon-change' onclick = collaspse_employee('admin',event,this)></span></a></li>");
				$.each(admins, function(a, admin) {
					if(admin.user != user){
						status = " icon icon-comments-alt";
						$('#chat_list_main_wraper_group #people').append("<li class=\"list-group-item user_"+ admin.user +" in collapse hide\" data-team=\"admin\"><i class=\"icon_" + admin.user + status + "\"></i><a href=\"javascript:void(0)\" data-value='" + admin.user + "' class=\"chat_" + admin.user + " btn btn-xs\">" + admin.name + "</a></li>");
					}
				});
			}
	}

	function create_chat_entry(id, chatId, senderUser, SenderName, msTime, msg, scroll_to_bottom = false){
		if(!$(".chat-pop #crd_"+id).length) {
			$(".chat-pop #msgs_"+chatId).append('<div id="crd_'+ id +'" class="direct-chat-msg clearfix '+(senderUser == user ? 'right' : '')+'">\n\
	                                <div class="direct-chat-info clearfix">\n\
	                                    <span class="direct-chat-name '+(senderUser == user ? 'pull-right' : 'pull-left')+'">'+ SenderName +'</span>\n\
	                                    <span class="direct-chat-timestamp '+(senderUser == user ? 'pull-left' : 'pull-right')+'">'+ timeFormat(msTime) +'</span>\n\
	                                </div>\n\
	                                <div class="direct-chat-text"> '+ msg +' </div>\n\
	                            </div>');

			if(scroll_to_bottom){
				var conv_container = $(".chat-pop #msgs_"+chatId).parents('.direct-chat-messages');
				var conv_scroll_height = conv_container.find("#msgs_"+chatId).height();
				// console.log(conv_container.find("#msgs_"+chatId).height());
				conv_container.animate({
					scrollTop: conv_scroll_height
				});
			}
		}
	}

	function collaspse_employee(customer_id, e, obj_ref){
		// obj_ref.closest("li").toggleClass("icon-toggle-up icon-toggle-down");
		// console.log(obj_ref.closest("li"),obj_ref);
		$(obj_ref.closest("li")).toggleClass("icon-toggle-down icon-toggle-up");
		e.stopPropagation();
		if(customer_id == 'admin'){
			$( "li" ).each(function( index ) {
				if($(this).data('team') == 'admin'){
					$(this).collapse('toggle');
				}
				// if(!$(this).hasClass('hide') == true){
				// 	// $(this).collapse('toggle');
				// }
				// console.log( index + ": " + $( this ).text() );
				// console.log(!$(this).hasClass('hide').val());
				// console.log($(this).is(":not(.hide)").val());
				// console.log($("this:not('.hide')").data('team'));

			});
		}
		else{
			$( "li" ).each(function( index ) {
				if($(this).data('team') == customer_id){
					$(this).collapse('toggle');
				}
			});
		}
		
	}
}