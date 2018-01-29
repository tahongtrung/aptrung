/*
 * Screets Chat
 * Application scripts
 *
 * Copyright (c) 2013 Screets
 */

(function(a){a(document).ready(function(){a.sc_chat.init();a(window).unload(function(){sc_chat.is_admin&&a.ajax({type:"POST",url:sc_chat.ajaxurl+"?mode=logout",data:"action=sc_chat_ajax_callback",async:!1})})});a.sc_chat={data:{first_time:!0,last_log_ID:0,no_activity:0,logged_in:!1,sender:"",win_is_active:0,sc_chat_box_visible:!1,error:!1},init:function(){var c=!1;window.onfocus=function(){a.sc_chat.data.win_is_active=1};window.onblur=function(){a.sc_chat.data.win_is_active=0};!0==sc_chat.is_admin&&
(a.sc_POST("login","action=sc_chat_ajax_callback&f_chat_user_name="+sc_chat.username+"&f_chat_user_email="+sc_chat.email+"&f_chat_is_admin=true",function(b){c=!1;b.error?a.sc_chat.display_error(b.error):a.sc_chat.login(b.name,b.gravatar,!0)}),a(document).on("click",".sc-chat-users .user",function(){var b=a(this).attr("data-receiver-id"),c=a(this).attr("data-visitor-id");a.sc_chat.open_new_tab(b,c,!0);return!1}),a("ul.sc-chat-tabs").each(function(){var b,c=a(this).find("li");c.addClass("active");c.not(b).each(function(){a(a(this).attr("href")).hide()});
a(document).on("click",".sc-chat-popup-content",function(){a("ul.sc-chat-tabs li.active").removeClass("new-msg")});a(this).on("click","li a",function(e){a("ul.sc-chat-tabs li").removeClass("active new-msg");a(".sc-chat-popup-content").removeClass("active");b=a(this).parent();c=a(a(this).attr("href"));b.addClass("active");c.addClass("active");a(".sc-cnv-wrap").scrollTop(1E4);c.find(".f-chat-line").focus();e.preventDefault()});a(this).on("click","li .close",function(b){var c=a(this).prev().attr("data-receiver-id");
a("ul.sc-chat-tabs li").removeClass("active new-msg");a(".sc-chat-popup-content").removeClass("active");a(".console-tab").addClass("active");a("#Console").addClass("active");a("#Tab_"+c).remove();a("#Receiver_"+c).remove();b.preventDefault()})}),a(".sc-chat-login-btn").click(function(){var b=a(this);a.sc_chat.data.current_status=a(this).attr("data-status");"online"==a.sc_chat.data.current_status?a.sc_POST("offline","action=sc_chat_ajax_callback",function(c){a('.user[data-user-type="1"]').fadeOut(1E3);
a.sc_chat.get_online_users();b.attr("data-status","offline").html('<i class="sc-icon-offline"></i> '+sc_chat.tr_offline);a.sc_chat.data.current_status="offline";a("#Chat_console").removeClass("sc-online").addClass("sc-offline");a.sc_chat.play_sound("offline")}):"offline"==a.sc_chat.data.current_status&&a.sc_POST("online","action=sc_chat_ajax_callback",function(){a.sc_chat.get_online_users();a('.user[data-user-type="ME"]').show();b.attr("data-status","online").html('<i class="sc-icon-online"></i> '+
sc_chat.tr_online);a.sc_chat.data.current_status="online";a("#Chat_console").removeClass("sc-offline").addClass("sc-online");a.sc_chat.play_sound("online")})}),a(document).on("click",".sc-chat-refresh",function(){receiver_ID=a(this).parent().parent().parent().parent().attr("data-receiver-id");visitor_ID=a("#User_"+receiver_ID).attr("data-visitor-id");a.sc_chat.get_user_info(visitor_ID,receiver_ID)}));sc_chat.is_admin||(a("#SC_send_form_btn").click(function(){a("#SC_contact_form").submit()}),a("#SC_contact_form").submit(function(){a(".sc-chat-notification").fadeIn(100).removeClass("error success").html(sc_chat.tr_sending+
"...");a.sc_POST("send_contact_from",a(this).serialize(),function(b){b.error?a(".sc-chat-notification").addClass("error").html(b.error):(a(".sc-chat-notification").addClass("success").html(b.message).delay(1500).fadeOut(500),a(".sc-chat-header-title").html(b.message).delay(4E3).queue(function(b){a(this).html(sc_chat.tr_offline_header);b()}),a('#SC_contact_form input[type="text"], #SC_contact_form textarea').val(""),setTimeout(a.sc_chat.hide_chatbox,2700))});return!1}),a("#SC_start_chat_btn").click(function(){a("#SC_login_form").submit()}),
a("#SC_login_form input").keydown(function(b){13==b.keyCode&&a("#SC_login_form").submit()}),a("#SC_login_form").submit(function(){if(c)return!1;a(".sc-chat-notification").removeClass("error success").fadeIn(500).html(sc_chat.tr_wait+"...");c=!0;a.sc_POST("login",a(this).serialize(),function(b){c=!1;b.error?a.sc_chat.display_error(b.error):a.sc_chat.login(b.name,b.gravatar,!0)});return!1}),1==sc_chat.use_css_anim?setTimeout(a.sc_chat.animate_chatbox,500*sc_chat.delay):setTimeout(a.sc_chat.animate_chatbox,
1E3*sc_chat.delay));a("body").on("keydown",".f-chat-line",function(b){13!=b.keyCode||b.shiftKey||(b.preventDefault(),a(this).parent().submit(),a(this).val(""),a(this).trigger("autosize.resize"))});a(document).on("submit","#Reply_form",function(){var b=a(this).find(".f-receiver-id").val(),d=a.trim(a(this).find(".f-chat-line").val()),e=a(this).serialize(),h=a(".f-chat-line");if(0==d.length||c)return!1;c=!0;var g="t"+Math.round(1E6*Math.random()),f={ID:g,author:a.sc_chat.data.name,gravatar:a.sc_chat.data.gravatar,
receiver_ID:b,chat_line:d.replace(/</g,"&lt;").replace(/>/g,"&gt;")};h.addClass("sc-chat-sending");a.sc_chat.add_chat_line(a.extend({},f));a.sc_POST("send_chat_msg",e,function(b){c=!1;a(".f-chat-line").val("").removeClass("sc-chat-sending");a("div.chat-"+g).remove();b.error?(a.sc_chat.display_error(b.error),a("#Reply_form .f-chat-line").attr("disabled","disabled").addClass("sc-chat-error")):(f.ID=b.insert_ID,a.sc_chat.add_chat_line(a.extend({},f)))});return!1});a(document).on("click",".sc-chat-btn-logout",
function(){a.sc_chat.data.logged_in=!1;a.sc_POST("logout","action=sc_chat_ajax_callback",function(b){!0==sc_chat.is_admin?window.location.href="./":a("#Conversation").fadeOut(300,function(){a(".sc-chat-wrapper").fadeIn(300,function(){setTimeout(function(){a.sc_chat.hide_chatbox()},1E3)})})});return!1});a.sc_POST("is_user_logged_in","action=sc_chat_ajax_callback",function(b){var c=!0;sc_chat.is_admin||!0!=sc_chat.is_op||(c=!1);b.logged&&c&&a.sc_chat.login(b.user.name,b.user.email,!1)});(function d(){a.sc_chat.get_online_users(d)})();
(function e(){a.sc_chat.get_chat_lines(e)})()},login:function(c,b,d){a.sc_chat.data.name=c;a.sc_chat.data.gravatar=b;a.sc_chat.data.logged_in=!0;!0==sc_chat.is_admin?(a(".sc-chat-login-btn").attr("data-status","online").html('<i class="sc-icon-online"></i> '+sc_chat.tr_online),a("#Chat_console").addClass("sc-online")):(a.sc_chat.open_chatbox(),!0==d?a(".sc-chat-wrapper").fadeOut(function(){a(".sc-chat-notification").html("").hide();a("#Conversation").fadeIn();a(".f-chat-line").focus().autosize();
a(".sc-cnv-wrap").scrollTop(1E4)}):(a(".sc-chat-wrapper").hide(),"on"==a.cookie("sc_chat_chatbox_status")&&(delay=1==sc_chat.use_css_anim?500*sc_chat.delay:1E3*sc_chat.delay,setTimeout(function(){a("#Conversation").show();a(".f-chat-line").autosize();a(".sc-cnv-wrap").scrollTop(1E4)},delay),a.sc_chat.data.sc_chat_box_visible=!0)));a.sc_chat.data.first_time=!1},render:function(a,b){var d=[];switch(a){case "login_top_bar":d=['<span><img src="',b.gravatar,'" width="23" height="23" />','<span class="name">',
b.name,'</span><a href="" class="logoutButton rounded">',b.tr_logout,"</a></span>"];break;case "chat_line":d=['<div class="sc-msg-wrap chat chat-',b.ID,'" data-user-id="',b.author,'"><div class="sc-chat-time">',b.time,'</div><div class="sc-usr-avatar"><img src="',b.gravatar,'" width="38" height="38" onload="this.style.visibility=\'visible\'" />','</div><div class="sc-msg"><div class="sc-usr-name">',b.author,':</div><div class="sc-chat-line">',b.chat_line,'</div></div><div class="clearfix"></div></div>'];
break;case "user":d=['<a id="User_',b.name,'" href="#Receiver_',b.ID,'" class="user" data-receiver-id="',b.name,'" data-visitor-id="',1==b.type?b.ID:b.visitor_ID,'" data-user-type="',b.type,'"><img class="avatar" src="',b.gravatar,'" onload="this.style.visibility=\'visible\'" /> <div class="username"> <strong>',b.name,"</strong> (",b.email,")<small>",b.tagline,"</small></div></a>"];break;case "new_tab_title":d=['<li class="',b.custom_class,'" id="Tab_',b.ID,'"><a href="#Receiver_',b.ID,'" data-receiver-id="',
b.ID,'">',b.ID,'</a> <button type="button" class="close">&times;</button></li>'];break;case "new_tab_content":d=['<div id="Receiver_',b.ID,'" data-receiver-id="',b.ID,'" class="',b.custom_class,' sc-chat-popup-content"><div class="sc-chat-inner"><div id="SC_cnv_wrap" class="sc-cnv-wrap"><div class="sc-chat-user-agent">',b.user_info?b.user_info:'<a href="javascript:void(0)" class="sc-chat-refresh">Refresh</a>','</div></div><div class="sc-chat-tip"></div></div><form id="Reply_form" method="post" action="" class="sc-chat-reply"><input type="hidden" name="action" value="sc_chat_ajax_callback" /><input type="hidden" name="receiver_ID" class="f-receiver-id" value="',
b.ID,'" /><input type="hidden" name="visitor_ID" class="f-visitor-id" value="',b.visitor_ID,'" /><textarea name="chat_line" class="f-chat-line" maxlength="700" placeholder="',sc_chat.tr_write_a_reply,'"></textarea></form></div>']}return d.join("")},open_new_tab:function(c,b,d){user_type=a('.sc-chat-users a[data-visitor-id="'+b+'"]').attr("data-user-type");var e=[];e.ID=c;e.visitor_ID=b;e.custom_class="";e.user_info="1"!=user_type&&b?sc_chat.tr_loading+"...":"";if(0==a(".sc-chat-tabs li#Tab_"+c).length){if(1==
a(".sc-chat-tabs .console-tab.active").length||d)a(".sc-chat-tabs li").removeClass("active"),a(".sc-chat-popup-content").removeClass("active"),e.custom_class="active ";a(".sc-chat-tabs").append(a.sc_chat.render("new_tab_title",e));a(".sc-chat-popup-contents").append(a.sc_chat.render("new_tab_content",e));a("#Receiver_"+c+" .f-chat-line").focus()}a.sc_chat.get_user_info(b,c);return!1},get_user_info:function(c,b){a.sc_chat.data.receiver_ID=b;a.sc_POST("user_info","action=sc_chat_ajax_callback&ID="+
c,function(b){"null"!=b.device_name&&(a.sc_chat.data.user_info=b.device_name+" "+b.device_version+" - "+b.platform+", "+b.ip_address+' &nbsp; <a href="admin.php?page=sc_chat_m_chat_logs&action=edit&visitor_ID='+c+'" target="_blank">'+sc_chat.tr_chat_logs+"</a>",a.sc_chat.update_user_info())})},update_user_info:function(){a("#Receiver_"+a.sc_chat.data.receiver_ID+" .sc-chat-user-agent").html(a.sc_chat.data.user_info)},add_chat_line:function(c){if(!0==sc_chat.is_admin){c.author==sc_chat.username&&c.receiver_ID==
sc_chat.username?a.sc_chat.data.sender=sc_chat.username:c.receiver_ID==sc_chat.username?a.sc_chat.data.sender=c.author:c.author==sc_chat.username?a.sc_chat.data.sender=c.receiver_ID:"__OP__"==c.receiver_ID&&(a.sc_chat.data.sender=c.author);if(a.sc_chat.data.sender){var b=a("#User_"+a.sc_chat.data.sender).attr("data-visitor-id");a.sc_chat.open_new_tab(a.sc_chat.data.sender,b);a.sc_chat.update_user_info()}a("#Tab_"+c.author+":not(.active)").addClass("new-msg")}b=new Date;c.time&&b.setUTCHours(c.time.hours,
c.time.minutes);c.time=(10>b.getHours()?"0":"")+b.getHours()+":"+(10>b.getMinutes()?"0":"")+b.getMinutes();b=a.sc_chat.render("chat_line",c);exists=a(".sc-cnv-wrap .chat-"+c.ID);exists.length&&exists.remove();a.sc_chat.data.last_log_ID||a(".sc-cnv-wrap .sc-lead").remove();var d=!0==sc_chat.is_admin?a("#Receiver_"+a.sc_chat.data.sender+" .sc-cnv-wrap"):a(".sc-cnv-wrap");if("t"!=c.ID.toString().charAt(0)){var e=d.find(".chat-"+(+c.ID-1));e.length?e.after(b):d.append(b)}else d.append(b);a(".sc-cnv-wrap").scrollTop(1E5);
a.sc_chat.data.last_user=c.author},get_chat_lines:function(c){a.sc_chat.data.logged_in||!1!=sc_chat.is_admin?a.sc_POST("get_chat_lines",{last_log_ID:a.sc_chat.data.last_log_ID,action:"sc_chat_ajax_callback",sender:a.sc_chat.data.sender},function(b){for(var d=0;d<b.chats.length;d++)a.sc_chat.add_chat_line(b.chats[d]);b.chats.length?(a.sc_chat.data.no_activity=0,a.sc_chat.data.last_log_ID=b.chats[d-1].ID,!0==a.sc_chat.data.first_time||0!=a.sc_chat.data.win_is_active&&!0!=sc_chat.is_admin||(!0==sc_chat.is_admin?
a.sc_chat.play_sound("new_message"):"on"==a.cookie("sc_chat_chatbox_status")&&a.sc_chat.play_sound("new_message"))):a.sc_chat.data.no_activity++;b=1E3;3<a.sc_chat.data.no_activity&&(b=2E3);10<a.sc_chat.data.no_activity&&(b=5E3);20<a.sc_chat.data.no_activity&&(b=15E3);setTimeout(c,b)}):setTimeout(c,1E3)},get_online_users:function(c){a.sc_chat.data.logged_in||!1!=sc_chat.is_admin?a.sc_GET("get_online_users",{action:"sc_chat_ajax_callback"},function(b){if(!0==sc_chat.is_admin){for(var d=[],e=0;e<b.users.length;e++)b.users[e]&&
d.push(a.sc_chat.render("user",b.users[e]));e="";e=1>b.total?sc_chat.tr_no_one_online:1==b.total?sc_chat.tr_1_person_online:sc_chat.tr_x_people_online.replace("%s",b.total);d.push('<p class="count">'+e+"</p>");a("#People_list .sc-chat-users").html(d.join(""))}setTimeout(c,15E3)}):setTimeout(c,3E3)},animate_chatbox:function(){var c=a("#sc_chat_box"),b=a("#sc_chat_box .sc-chat-header"),d=c.innerHeight(),e=b.innerHeight();c.css("bottom","-"+d+"px");c.css("visibility","visible");1==sc_chat.use_css_anim?
(c.css("bottom","-"+(d-e)+"px").addClass("sc-chat-animated sc-chat-bounce-in-up"),b.click(function(){a.removeCookie("sc_chat_chatbox_status");d=c.innerHeight();e=b.innerHeight();!1==a.sc_chat.data.sc_chat_box_visible?(d=c.innerHeight(),e=b.innerHeight(),c.css("bottom",0).addClass("sc-chat-css-anim"),setTimeout(function(){480<window.innerWidth&&(a("#f_chat_user_name").length?a("#f_chat_user_name, .f-chat-line").focus():a("#f_chat_user_email, .f-chat-line").focus())},500),!0==a.sc_chat.data.logged_in&&
(a("#Conversation").show(),setTimeout(function(){a(".f-chat-line").focus().autosize()},500)),a.cookie("sc_chat_chatbox_status","on",{expires:1}),a.sc_chat.data.sc_chat_box_visible=!0):(c.css("bottom","-"+(d-e)+"px"),a.cookie("sc_chat_chatbox_status","off",{expires:1}),a.sc_chat.data.sc_chat_box_visible=!1)})):(c.stop().animate({bottom:"+="+e},{duration:900,easing:"easeOutBack"}),b.click(function(){a("#Conversation").show();a.removeCookie("sc_chat_chatbox_status");d=c.innerHeight();e=b.innerHeight();
!1==a.sc_chat.data.sc_chat_box_visible?(c.stop().animate({bottom:0},{duration:200,easing:"easeOutExpo",complete:function(){480<window.innerWidth&&(a("#f_chat_user_name").length?a("#f_chat_user_name, .f-chat-line").focus():a("#f_chat_user_email, .f-chat-line").focus())}}),a.cookie("sc_chat_chatbox_status","on",{expires:1}),a.sc_chat.data.sc_chat_box_visible=!0):(a.cookie("sc_chat_chatbox_status","off",{expires:1}),c.stop().animate({bottom:"-"+(d-e)},{duration:190,easing:"easeOutExpo"}),a.cookie("sc_chat_chatbox_status",
"off",{expires:1}),a.sc_chat.data.sc_chat_box_visible=!1)}))},open_chatbox:function(){var c=a("#sc_chat_box");a("#Reply_form .f-chat-line").removeAttr("disabled").removeClass("sc-chat-error");1==sc_chat.use_css_anim?c.css("bottom",0):(c.stop().animate({bottom:0},{duration:200,easing:"easeOutExpo"}),a("#f_chat_user_name, .f-chat-line").focus())},hide_chatbox:function(){var c=a("#sc_chat_box"),b=a("#sc_chat_box .sc-chat-header");sc_chat_box_h=c.innerHeight();sc_chat_header_h=b.innerHeight();1==sc_chat.use_css_anim?
c.css("bottom","-"+(sc_chat_box_h-sc_chat_header_h)+"px"):c.stop().animate({bottom:"-"+(sc_chat_box_h-sc_chat_header_h)},{duration:190,easing:"easeOutExpo"});a.sc_chat.data.sc_chat_box_visible=!1},add_source:function(c,b){a("<source>").attr("src",b).appendTo(c)},play_sound:function(c){if("none"!=sc_chat.sound_package){var b=a("<audio />",{autoPlay:"autoplay"});a.sc_chat.add_source(b,sc_chat.plugin_url+"/assets/sounds/"+c+".mp3");a.sc_chat.add_source(b,sc_chat.plugin_url+"/assets/sounds/"+c+".ogg");
a.sc_chat.add_source(b,sc_chat.plugin_url+"/assets/sounds/"+c+".wav");b.appendTo("body")}},display_error:function(c){var b=!0==sc_chat.is_admin?"error":"";a(".sc-chat-notification").show().html("").delay(500).html('<div class="'+b+'">'+c+"</div>")},hide_error:function(){a(".sc-chat-notification").hide()}};a.sc_POST=function(c,b,d){a.post(sc_chat.ajaxurl+"?mode="+c,b,d,"json").fail(function(b){a.sc_chat.data.error=!0;console.log(b);a.sc_chat.display_error(sc_chat.tr_wait+"...");return!1}).done(function(){!0==
a.sc_chat.data.error&&a.sc_chat.hide_error();a.sc_chat.data.error=!1})};a.sc_GET=function(c,b,d){a.get(sc_chat.ajaxurl+"?mode="+c,b,d,"json").fail(function(b){a.sc_chat.data.error=!0;console.log(b);a.sc_chat.display_error(sc_chat.tr_wait+"...");return!1}).done(function(){!0==a.sc_chat.data.error&&a.sc_chat.hide_error();a.sc_chat.data.error=!1})}})(window.jQuery||window.Zepto);