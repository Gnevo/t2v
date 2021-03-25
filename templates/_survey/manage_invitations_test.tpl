{block name="style"}
<link type="text/css" rel="stylesheet"  href="{$url_path}css/serva.css"/>
<link type="text/css" rel="stylesheet" media="all" href="{$url_path}css/jquery.jscrollpane.css" />
<link type="text/css" rel="stylesheet" media="all" href="{$url_path}css/jquery.jscrollpane.lozenge.css" />
<style type="text/css">
    .scroll-pane,  .scroll-pane-arrows {
            width: 100%;
            height: 200px;
            overflow: auto;
    }
    .horizontal-only {
            height: auto;
            max-height: 200px;
    }
    .answer-hold-attrib {
            width: 95%; 
            height: 325px;
    }
    .invite_body {
            max-height: 550px;
            min-height: 550px;
    }
</style>
{/block}

{block name="script"}
<script type="text/javascript">

$(document).ready(function() {
    $('.manage_forms, #tools_rack_group, #tools_rack_user, #tools_rack_survey, #tools_rack_customer, .answer_hold, .Surveys_drop_zoneinner').jScrollPane();
    $('.scroll-pane-arrows').jScrollPane({
            showArrows: false,
            horizontalGutter: 10
    });

    $(".search_icon").click(function(){
            $(this).parent().parent().find(".searchclose_section").show();
            $(this).parent().parent().find('.search_click').hide();
            $(this).parent().parent().find("input").focus();
     });

    $(".search_close").click(function(){
            $(this).parent().parent().find(".search_click").show();
            $(this).parent().parent().find('.searchclose_section').hide();
            if($(this).parent().find("input").attr('id') == 'invite_search'){
                $("#invite_search").val('');
                fetch_invite();
            }else if($(this).parent().find("input").attr('id') == 'group_search'){
                $("#group_search").val('');
                fetch_group();
            }else if($(this).parent().find("input").attr('id') == 'user_search'){
                $("#user_search").val('');
                fetch_user();
            }else if($(this).parent().find("input").attr('id') == 'customer_search'){
                $("#customer_search").val('');
                fetch_customer();
            }else if($(this).parent().find("input").attr('id') == 'survey_search'){
                $("#survey_search").val('');
                fetch_surveys();
            }
     });
     
    // survay form functions
    $(".group_block, .user_block, .tool_srvy, .customer_block").draggable({ revert: true, appendTo: ".tabname_content", helper: 'clone' });
    $(".drop_zone").droppable({
            accept: ".formlist_block",
            activeClass: "active",
            hoverClass: "hover",
            drop: function(event,ui){
                    if (ui.draggable.hasClass("tool_srvy")){
                        alert('{$translate.please_drop_on_surveys_sections}');
                    }else if (ui.draggable.hasClass("group_block")){
                        var group = ui.draggable.find("a").html();
                        var group_id = ui.draggable.find("input").val();
                        ui.draggable.css('display', 'none');
                        ui.draggable.find("span").attr('data-disabled', 'TRUE');
                        $(this).children(".drop_zone_inner").before("<div class='ctrloption clearfix'>\n\
                                                                        <div class='ctrlstrip-close'></div>\n\
                                                                        <div class='group_leader'>Group</div>\n\
                                                                        <div class='ctrl-option-inner group_class'>\n\
                                                                            <div class='ctrl-strip clearfix'>"+ group +"</div>\n\
                                                                            <input type='hidden' name='group_ids[]' value='"+group_id+"' />\n\
                                                                        </div>\n\
                                                                        <div class='questian_toolboxsettings clearfix'></div>\n\
                                                                    </div>");
                        reinitScroll('#tools_rack_group');
                    }else if (ui.draggable.hasClass("user_block")){
                        var user = ui.draggable.find("a").html();
                        var user_id = ui.draggable.find("input").val();
                        ui.draggable.css('display', 'none');
                        ui.draggable.find("span").attr('data-disabled', 'TRUE');
                        $(this).children(".drop_zone_inner").before("<div class='ctrloption clearfix'>\n\
                                                                        <div class='ctrlstrip-close'></div>\n\
                                                                        <div class='group_leader'>User</div>\n\
                                                                        <div class='ctrl-option-inner user_class'>\n\
                                                                            <div class='ctrl-strip clearfix'>"+ user +"</div>\n\
                                                                            <input type='hidden' name='user_ids[]' value='"+user_id+"' />\n\
                                                                        </div>\n\
                                                                        <div class='questian_toolboxsettings clearfix'></div>\n\
                                                                    </div>");
                        reinitScroll('#tools_rack_user');
                    }else if (ui.draggable.hasClass("customer_block")){
                        var customer = ui.draggable.find("a").html();
                        var customer_id = ui.draggable.find("input").val();
                        ui.draggable.css('display', 'none');
                        ui.draggable.find("span").attr('data-disabled', 'TRUE');
                        $(this).children(".drop_zone_inner").before("<div class='ctrloption clearfix'>\n\
                                                                        <div class='ctrlstrip-close'></div>\n\
                                                                        <div class='group_leader'>Customer</div>\n\
                                                                        <div class='ctrl-option-inner customer_class'>\n\
                                                                            <div class='ctrl-strip clearfix'>"+ customer +"</div>\n\
                                                                            <input type='hidden' name='customer_ids[]' value='"+customer_id+"' />\n\
                                                                        </div>\n\
                                                                        <div class='questian_toolboxsettings clearfix'></div>\n\
                                                                    </div>");
                        reinitScroll('#tools_rack_customer');
                    }
                    reinitScroll('.answer_hold');
            }
    });

    $(".Surveys_drop_zone").droppable({
        //accept: ".tool_srvy",
        accept: ".formlist_block",
        activeClass: "active",
        hoverClass: "hover",
        drop: function(event, ui) {
            if (ui.draggable.hasClass("group_block") || ui.draggable.hasClass("user_block") || ui.draggable.hasClass("customer_block")){
                alert('{$translate.drop_on_users_sections}');
            } else if (ui.draggable.hasClass("tool_srvy")) {
                var survey_name = ui.draggable.find("a").html();
                var survey_id = ui.draggable.find("input").val();
                $(this).children(".Surveys_drop_zoneinner").find('.jspPane').append("<a>" + survey_name + "<input type='hidden' name='suvery_ids[]' value='"+survey_id+"' /><span></span></a>");
                ui.draggable.css('display', 'none');
                ui.draggable.find("span").attr('data-disabled', 'TRUE');
                reinitScroll('.Surveys_drop_zoneinner');
            }
        }
    });

    // remove Survey
    $(".Surveys_drop_zoneinner a span").live("click", function() {
            var survey_id = $(this).parent().children('input').val();
            $(this).parent().remove();
            $('.survey_blocks').find('[name="survey_'+survey_id+'"]').parent().css('display','block');
            $('.survey_blocks').find('[name="survey_'+survey_id+'"]').parent().find("span").attr('data-disabled', 'FALSE');
            reinitScroll('.Surveys_drop_zoneinner');
    });

    // remove ctrl_option 
    $(".ctrlstrip-close").live("click",function(){
            var this_id = $(this).parent().find('.ctrl-option-inner').find('input').val();
            $(this).parent().remove();
            if ($(this).parent().find('.ctrl-option-inner').hasClass("group_class")){
                $('.group_blocks').find('[name="group_'+this_id+'"]').parent().css('display','block');
                $('.group_blocks').find('[name="group_'+this_id+'"]').parent().find("span").attr('data-disabled', 'FALSE');
                reinitScroll('#tools_rack_group');
            }else if ($(this).parent().find('.ctrl-option-inner').hasClass("user_class")){
                $('.user_blocks').find('[name="user_'+this_id+'"]').parent().css('display','block');
                $('.user_blocks').find('[name="user_'+this_id+'"]').parent().find("span").attr('data-disabled', 'FALSE');
                reinitScroll('#tools_rack_user');
            }else if ($(this).parent().find('.ctrl-option-inner').hasClass("customer_class")){
                $('.customer_blocks').find('[name="customer_'+this_id+'"]').parent().css('display','block');
                $('.customer_blocks').find('[name="customer_'+this_id+'"]').parent().find("span").attr('data-disabled', 'FALSE');
                reinitScroll('#tools_rack_customer');
            }
            reinitScroll('.answer_hold');
    });

    splitTab("tabname");
});

function splitTab(tabname){
        // initialization
        $("."+tabname+"_menu li").eq(0).addClass("selected")
        $("."+tabname+"_content div").each(function(divId){
                $("."+tabname+"_content div.tab_content").eq(1+divId).hide();
        })

        $("."+tabname+"_menu li").click(function(){
                $("."+tabname+"_content div.tab_content").each(function(divId){
                        $("."+tabname+"_content div.tab_content").eq(divId).hide();
                });
                $("."+tabname+"_menu li").each(function(liId){
                        $("."+tabname+"_menu li").eq(liId).removeClass("selected");
                });
                $("."+tabname+"_content div.tab_content").eq($(this).index()).show();
                $(this).addClass("selected");
                switch ($(this).index()){
                        case 0:
                                reinitScroll('#tools_rack_group');
                                break;
                        case 1:
                                reinitScroll('#tools_rack_user');
                                break;
                        case 2:
                                reinitScroll('#tools_rack_customer');
                                break;
                        case 3:
                                reinitScroll('#tools_rack_survey');
                                break;
                }
        });
}

function reinitScroll(scroll_element){
    var settings = {
                showArrows: false
    };
    var pane = $(scroll_element);
    pane.jScrollPane(settings);
    var api = pane.data('jsp');
    api.reinitialise();
}

function saveForm(action){
        $("#action").val(action);
        $("#frm_question").submit();
}

function addToForm(){
    var control_id = '';
    var control_caption = '';
    var count = 0;
    switch ($('.tabname_menu li.selected').index()){
            case 0:
                    $('#tools_rack_group input:checked').each(function() {
                                control_id = $(this).val();
                                control_caption = $(this).parent().find('a').html();
                                $(this).removeAttr('checked');
                                $(this).parent().find("span").attr('data-disabled', 'TRUE');
                                $('.drop_zone').children(".drop_zone_inner").before("<div class='ctrloption clearfix'>\n\
                                                                                        <div class='ctrlstrip-close'></div>\n\
                                                                                        <div class='group_leader'>Group</div>\n\
                                                                                        <div class='ctrl-option-inner group_class'>\n\
                                                                                            <div class='ctrl-strip clearfix'>"+ control_caption +"</div>\n\
                                                                                            <input type='hidden' name='group_ids[]' value='"+control_id+"' />\n\
                                                                                        </div>\n\
                                                                                        <div class='questian_toolboxsettings clearfix'></div>\n\
                                                                                    </div>");
                                $(this).parent().css('display', 'none');
                                count++;
                    });
                    reinitScroll('.answer_hold');
                    reinitScroll('#tools_rack_group');
                    if(count == 0)
                        alert('{$translate.select_atleast_one_group}');
                    break;
            case 1:
                    $('#tools_rack_user input:checked').each(function() {
                                control_id = $(this).val();
                                control_caption = $(this).parent().find('a').html();
                                $(this).removeAttr('checked');
                                $(this).parent().find("span").attr('data-disabled', 'TRUE');
                                $('.drop_zone').children(".drop_zone_inner").before("<div class='ctrloption clearfix'>\n\
                                                                                        <div class='ctrlstrip-close'></div>\n\
                                                                                        <div class='group_leader'>User</div>\n\
                                                                                        <div class='ctrl-option-inner user_class'>\n\
                                                                                            <div class='ctrl-strip clearfix'>"+ control_caption +"</div>\n\
                                                                                            <input type='hidden' name='user_ids[]' value='"+control_id+"' />\n\
                                                                                        </div>\n\
                                                                                        <div class='questian_toolboxsettings clearfix'></div>\n\
                                                                                    </div>");
                                $(this).parent().css('display', 'none');
                                count++;
                    });
                    reinitScroll('.answer_hold');
                    reinitScroll('#tools_rack_user');
                    if(count == 0)
                        alert('{$translate.select_atleast_one_user}');
                    break;
            case 2:
                    $('#tools_rack_customer input:checked').each(function() {
                                control_id = $(this).val();
                                control_caption = $(this).parent().find('a').html();
                                $(this).removeAttr('checked');
                                $(this).parent().find("span").attr('data-disabled', 'TRUE');
                                $('.drop_zone').children(".drop_zone_inner").before("<div class='ctrloption clearfix'>\n\
                                                                                        <div class='ctrlstrip-close'></div>\n\
                                                                                        <div class='group_leader'>Customer</div>\n\
                                                                                        <div class='ctrl-option-inner customer_class'>\n\
                                                                                            <div class='ctrl-strip clearfix'>"+ control_caption +"</div>\n\
                                                                                            <input type='hidden' name='customer_ids[]' value='"+control_id+"' />\n\
                                                                                        </div>\n\
                                                                                        <div class='questian_toolboxsettings clearfix'></div>\n\
                                                                                    </div>");
                                $(this).parent().css('display', 'none');
                                count++;
                    });
                    reinitScroll('.answer_hold');
                    reinitScroll('#tools_rack_customer');
                    if(count == 0)
                        alert('{$translate.select_atleast_one_customer}');
                    break;
            case 3:
                    $('#tools_rack_survey input:checked').each(function() {
                                control_id = $(this).val();
                                control_caption = $(this).parent().find('a').html();
                                $(this).removeAttr('checked');
                                $(this).parent().find("span").attr('data-disabled', 'TRUE');
                                $(".Surveys_drop_zoneinner").find('.jspPane').append("<a>" + control_caption + "<input type='hidden' name='suvery_ids[]' value='"+control_id+"' /><span></span></a>");
                                $(this).parent().css('display', 'none');
                                count++;
                    });
                    reinitScroll('.Surveys_drop_zoneinner');
                    reinitScroll('#tools_rack_survey');
                    if(count == 0)
                        alert('{$translate.select_atleast_one_survey}');
                    break;
    }
}

function fetch_invite(){
    var search_val = $("#invite_search").val();
    search_val = search_val.toLowerCase();
    if(search_val == ''){
        $('.manage_forms .manageform_block').each(function(){
                $(this).css('display', 'block');
        });
    }else{
        $('.manage_forms .manageform_block').each(function(){
            var this_group = $(this).find('a').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(this_group))
                $(this).css('display', 'block');
            else
                $(this).css('display', 'none');
        });
    }
    reinitScroll('.manage_forms');
}

function fetch_group(){
    var search_val = $("#group_search").val();
    search_val = search_val.toLowerCase();
    if(search_val == ''){
        $('#tools_rack_group .formlist_block').each(function(){
            if($(this).find("span").attr('data-disabled') == 'FALSE')
                $(this).css('display', 'block');
        });
    }else{
        $('#tools_rack_group .formlist_block').each(function(){
            var this_group = $(this).find('a').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(this_group) && $(this).find("span").attr('data-disabled') == 'FALSE')
                $(this).css('display', 'block');
            else
                $(this).css('display', 'none');
        });
    }
    reinitScroll('#tools_rack_group');
}

function fetch_user(){
    var search_val = $("#user_search").val();
    search_val = search_val.toLowerCase();
    if(search_val == ''){
        $('#tools_rack_user .formlist_block').each(function(){
            if($(this).find("span").attr('data-disabled') == 'FALSE')
                $(this).css('display', 'block');
        });
    }else{
        $('#tools_rack_user .formlist_block').each(function(){
            var this_group = $(this).find('a').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(this_group) && $(this).find("span").attr('data-disabled') == 'FALSE')
                $(this).css('display', 'block');
            else
                $(this).css('display', 'none');
        });
    }
    reinitScroll('#tools_rack_user');
}

function fetch_customer(){
    var search_val = $("#customer_search").val();
    search_val = search_val.toLowerCase();
    if(search_val == ''){
        $('#tools_rack_customer .formlist_block').each(function(){
            if($(this).find("span").attr('data-disabled') == 'FALSE')
                $(this).css('display', 'block');
        });
    }else{
        $('#tools_rack_customer .formlist_block').each(function(){
            var this_group = $(this).find('a').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(this_group) && $(this).find("span").attr('data-disabled') == 'FALSE')
                $(this).css('display', 'block');
            else
                $(this).css('display', 'none');
        });
    }
    reinitScroll('#tools_rack_customer');
}

function fetch_surveys(){
    var search_val = $("#survey_search").val();
    search_val = search_val.toLowerCase();
    if(search_val == ''){
        $('#tools_rack_survey .tool_srvy').each(function(){
            if($(this).find("span").attr('data-disabled') == 'FALSE')
                $(this).css('display', 'block');
        });
    }else{
        $('#tools_rack_survey .tool_srvy').each(function(){
            var this_group = $(this).find('a').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(this_group) && $(this).find("span").attr('data-disabled') == 'FALSE')
                $(this).css('display', 'block');
            else
                $(this).css('display', 'none');
        });
    }
    reinitScroll('#tools_rack_survey');
}
</script>
{/block}
{block name="content"}
    <div id="menu">
        <ul>
            <li><a href="{$url_path}manage/questions/">{$translate.manage_questions}</a></li>
        <li><a href="{$url_path}manage/forms/">{$translate.manage_forms}</a></li>
        <li><a href="javascript:void(0)">{$translate.manage_surveys}</a></li>
        <li><a href="{$url_path}manage/groups/">{$translate.manage_groups}</a></li>
        <li class="active"><a href="{$url_path}manage/invitations/">{$translate.invitation}</a></li>
        </ul>
        <div style="float:right; margin: 2px 3px 0px 0px;"><a class="back" href="{$url_path}surveys/">{$translate.backs}</a></div>
    </div>
    <div id="main_tab" class="clearfix">
        <div id="tab_menu">
            {$message}
            <div class="managequestions_row">
                <div class="invite_body questions">
                    <div class="menubar_title clearfix">
                        <div class="search_click">
                            <div class="menu_title"> {$translate.invitation} </div>
                            <a class="search_icon"> <span class="icon"></span> </a> 
                        </div>
                        <div class="searchclose_section">
                            <input class="serchbox" type="text" id="invite_search" onemptied="fetch_invite()" oninput="fetch_invite()" data-key-placeholder="placeholder_search" placeholder="{$translate.search}..." />
                            <a class="search_close"> <span class="icon"></span> </a> 
                        </div>
                    </div>
                    <div class="manage_forms">
                        {foreach $invitations as $invitation}
                            <div class="manageform_block clearfix {if $show_invitation eq 1 and $this_invitation_id eq $invitation.id}active{/if}">
                                <span><img src="{$url_path}images/invitation.png" width="17" height="13"></span>
                                <a href="{$url_path}manage/invitations/{$invitation.id}/">{$invitation.invite_subject}</a>
                            </div>
                        {foreachelse}
                            {$translate.no_available_invitations}
                        {/foreach}
                    </div>
                </div>
            </div>
            <form method="POST" name="frm_question" id="frm_question">
                <div class="managequestions_row">
                    <div class="invite_body creatquestion_box">
                        <div class="answermenubar_title"></div>
                        <div class="scrol"> 
                            <div class="question_hold">
                                <input name="txtSubject" type="text" class="quest_textbox" style="margin-bottom:4px;" data-key-placeholder="placeholder_question" placeholder="Subject :"  value="{$this_ivite_details.invite_subject}" />
                                <textarea name="txtMessage" type="text" class="quest_textbox" style="height:40px;margin-bottom: 2px;" data-key-placeholder="placeholder_question" placeholder="Invitation Message :">{$this_ivite_details.invite_message}</textarea>
                                <input id="action" name="action" type="hidden" value="" />
                                {if $show_invitation eq 1}<input name="this_Iid" type="hidden" value="{$this_invitation_id}" />{/if}
                            </div>
                            <div class="Surveys_drop_zone">
                                <div class="Surveys_drop_zoneinner clearfix">
                                    <div>Drag & Drop Surveys</div>
                                    {foreach $this_invitation_surveys as $survey}
                                        <a>{$survey.survey_title}<input type='hidden' name='suvery_ids[]' value='{$survey.id}' /><span></span></a>
                                    {/foreach}
                                </div>
                            </div>
                            <div class="answer_hold answer-hold-attrib" style="height: 275px">
                                <div class="drop_zone">
                                    {if $show_invitation eq 1}
                                            {foreach $this_invitation_groups as $group}
                                                <div class='ctrloption clearfix'>
                                                    <div class='ctrlstrip-close'></div>
                                                    <div class='group_leader'>Group</div>
                                                    <div class='ctrl-option-inner group_class'>
                                                        <div class='ctrl-strip clearfix'>{$group.group_name}</div>
                                                        <input type='hidden' name='group_ids[]' value='{$group.id}' />
                                                    </div>
                                                    <div class='questian_toolboxsettings clearfix'></div>
                                                </div>
                                            {/foreach}
                                            {foreach $this_invitation_individuals as $individual}
                                                <div class='ctrloption clearfix'>
                                                    <div class='ctrlstrip-close'></div>
                                                    <div class='group_leader'>User</div>
                                                    <div class='ctrl-option-inner user_class'>
                                                        <div class='ctrl-strip clearfix'>{$individual.last_name} {$individual.first_name}</div>
                                                        <input type='hidden' name='user_ids[]' value='{$individual.username}' />
                                                    </div>
                                                    <div class='questian_toolboxsettings clearfix'></div>
                                                </div>
                                            {/foreach}
                                            {foreach $this_invitation_customers as $customer}
                                                <div class='ctrloption clearfix'>
                                                    <div class='ctrlstrip-close'></div>
                                                    <div class='group_leader'>Customer</div>
                                                    <div class='ctrl-option-inner customer_class'>
                                                        <div class='ctrl-strip clearfix'>{$customer.last_name} {$customer.first_name}</div>
                                                        <input type='hidden' name='customer_ids[]' value='{$customer.username}' />
                                                    </div>
                                                    <div class='questian_toolboxsettings clearfix'></div>
                                                </div>
                                            {/foreach}
                                    {/if}
                                    <div class="drop_zone_inner">Drag & Drop Groups, Employees and Customers</div>
                                </div>
                            </div>
                        </div>
                        <div class="settings_box clearfix">
                            <a class="save" href="javascript:void(0)" onClick="saveForm(1)"><span class="btn_name">Save</span></a>
                            {if $show_invitation eq 1}<a class="delet" href="javascript:void(0)" onClick="saveForm(2)"><span class="btn_name">Delete</span></a>{/if}
                            <a class="add new" href="{$url_path}manage/invitations/"><span class="btn_name">New</span></a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="invite_body managequestions_row">
                <div class="tab_menu clearfix">
                    <div class="tabname_menu">
                        <ul>
                            <li>Groups</li>
                            <li>Individuals</li>
                            <li>Customers</li>
                            <li>Surveys</li>
                        </ul>
                    </div>
                    <div class="tabname_content">
                        {*Groups Section*}
                        <div class="tab_content">
                            <div class="menubar_title clearfix">
                                <div class="search_click">
                                    <div class="menu_title">Groups</div>
                                    <a class="search_icon"><span class="icon"></span></a>
                                </div>
                                <div class="searchclose_section">
                                    <input class="serchboxrgt" id="group_search" onemptied="fetch_group()" oninput="fetch_group()" type="text" data-key-placeholder="placeholder_search" placeholder="Group Search...">
                                    <a class="search_close"><span class="icon"></span></a>
                                </div>
                            </div>
                            <div id="tools_rack_group" class="group_blocks">
                                {foreach $groups as $group}
                                    <div class="formlist_block group_block clearfix" {if $show_invitation eq 1 and in_array($group.id, $filter_group_ids)}style="display: none;"{/if}>
                                        <input name="group_{$group.id}" type="checkbox" value="{$group.id}">
                                        <span data-disabled='{if $show_invitation eq 1 and in_array($group.id, $filter_group_ids)}TRUE{else}FALSE{/if}' ><img src="{$url_path}images/group_manageicon.png" width="17" height="13"></span>
                                        {* data-disabled attribute for span is used to check already been used this employee *}
                                        <a href="javascript:void(0);">{$group.group_name}</a></label>
                                    </div>
                                {/foreach}
                            </div>
                        </div>
                        {*Employees Section*}
                        <div class="tab_content">
                            <div class="menubar_title clearfix">
                                <div class="search_click">
                                    <div class="menu_title">Individuals</div>
                                    <a class="search_icon"><span class="icon"></span></a>
                                </div>
                                <div class="searchclose_section">
                                    <input class="serchboxrgt" id="user_search" onemptied="fetch_user()" oninput="fetch_user()" type="text" data-key-placeholder="placeholder_search" placeholder="Individuals Search...">
                                    <a class="search_close"><span class="icon"></span></a>
                                </div>
                            </div>
                            <div id="tools_rack_user" class="user_blocks">
                                {foreach $users as $user}
                                    <div class="formlist_block user_block clearfix" {if $show_invitation eq 1 and in_array($user.username, $filter_members_ids)}style="display: none;"{/if}>
                                        <input name="user_{$user.username}" type="checkbox" value="{$user.username}">
                                        <span data-disabled='{if $show_invitation eq 1 and in_array($user.username, $filter_members_ids)}TRUE{else}FALSE{/if}' ><img src="{$url_path}images/induvidual_managegroup.png" width="17" height="17"></span>
                                        {* data-disabled attribute for span is used to check already been used this employee *}
                                        <a href="javascript:void(0);">{$user.last_name} {$user.first_name}</a>
                                    </div>
                                {/foreach}
                            </div>
                        </div>
                        {*Customers Section*}
                        <div class="tab_content">
                            <div class="menubar_title clearfix">
                                <div class="search_click">
                                    <div class="menu_title">Customers</div>
                                    <a class="search_icon"><span class="icon"></span></a>
                                </div>
                                <div class="searchclose_section">
                                    <input class="serchboxrgt" id="customer_search" onemptied="fetch_customer()" oninput="fetch_customer()" type="text" data-key-placeholder="placeholder_search" placeholder="Customers Search...">
                                    <a class="search_close"><span class="icon"></span></a>
                                </div>
                            </div>
                            <div id="tools_rack_customer" class="customer_blocks">
                                {foreach $customers_list as $customer}
                                    <div class="formlist_block customer_block clearfix" {if $show_invitation eq 1 and in_array($customer.username, $filter_customer_ids)}style="display: none;"{/if}>
                                        <input name="customer_{$customer.username}" type="checkbox" value="{$customer.username}">
                                        <span data-disabled='{if $show_invitation eq 1 and in_array($customer.username, $filter_customer_ids)}TRUE{else}FALSE{/if}' ><img src="{$url_path}images/induvidual_managegroup.png" width="17" height="17"></span>
                                        {* data-disabled attribute for span is used to check already been used this employee *}
                                        <a href="javascript:void(0);">{$customer.last_name} {$customer.first_name}</a>
                                    </div>
                                {/foreach}
                            </div>
                        </div>
                        {*Surveys Section*}
                        <div class="tab_content">
                            <div class="menubar_title clearfix">
                                <div class="search_click">
                                    <div class="menu_title">Surveys</div>
                                    <a class="search_icon"><span class="icon"></span></a>
                                </div>

                                <div class="searchclose_section">
                                    <input class="serchboxrgt" id="survey_search" onemptied="fetch_surveys()" oninput="fetch_surveys()" type="text" data-key-placeholder="placeholder_search" placeholder="Survey Search...">
                                    <a class="search_close"><span class="icon"></span></a>
                                </div>
                            </div>
                            <div id="tools_rack_survey" class="survey_blocks">
                                {foreach $surveys as $survey}
                                    <div class="formlist_block tool_srvy clearfix" {if $show_invitation eq 1 and in_array($survey.id, $filter_survey_ids)}style="display: none;"{/if}>
                                        <input name="survey_{$survey.id}" type="checkbox" value="{$survey.id}">
                                        <span data-disabled='{if $show_invitation eq 1 and in_array($survey.id, $filter_survey_ids)}TRUE{else}FALSE{/if}' ><img src="{$url_path}images/manageform_icon.jpg" width="17" height="17"></span>
                                        {* data-disabled attribute for span is used to check already been used this employee *}
                                        <a href="javascript:void(0);">{$survey.survey_title}</a>
                                    </div>
                                {/foreach}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagesettings clearfix">
                    <a class="addto_form" href="javascript:void(0)" onClick="addToForm()"><span class="btn_name">Add to Form</span></a>
                </div>
            </div>
        </div>
    </div>
{/block}