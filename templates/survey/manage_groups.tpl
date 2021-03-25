{block name="sub_style"}
    <style type="text/css">
    </style>
{/block}

{block name="sub_script"}
<script type="text/javascript">

$(document).ready(function() {
    
    $("#draggable-users .draggable-user").draggable({ revert: "invalid", appendTo: "#tab-working-panel", helper: 'clone', start: 
            function (event, ui) { ui.helper.css({ 'width': '220px', 'opacity': '1'}); } 
    });
    
    $(".dragdrop-box").droppable({
            accept: ".draggable-user",
            activeClass: "active",
            hoverClass: "hover",
            drop: function(event,ui){
                    var user = ui.draggable.find(".user_title_data").html();
                    var user_id = ui.draggable.find("input.check_user_id").val();
                    ui.draggable.addClass('hide');
                    ui.draggable.find("input.check_user_id").attr('data-disabled', 'TRUE');
                    $('.dragdrop-box').append('<div class="span12 no-ml selected_user_wrpr mb drop-zone">\n\
                                                                <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                                <div style="margin:0;" class="span11">\n\
                                                                    <p class="span8 no-mb">'+ user +'</p>\n\
                                                                    <h1 class="span3 pull-right center"><label>{$translate.group_leader}<input id="rd_gl_'+user_id+'" type="radio" value="'+user_id+'" name="rd_groupleader" class="radio_style" style="margin: 0px 5px ! important;"></label></h1>\n\
                                                                    <input type="hidden" name="user_ids[]" value="'+user_id+'" class="selected_user_id" />\n\
                                                                </div>\n\
                                                            </div>');
            }
    });
    
    // remove ctrl_option 
    $(".ctrlstrip-close").live("click",function(){
            var user = $(this).parents('.selected_user_wrpr').find('input.selected_user_id').val();
            $(this).parents('.selected_user_wrpr').remove();
            $('[name="user_'+user+'"]').parents('.draggable-user').removeClass('hide');
            $('[name="user_'+user+'"]').parents('.draggable-user').find("input.check_user_id").attr('data-disabled', 'FALSE');
    });
});
	
function saveForm(action){
        
        $("#action").val(action);
        if(action == 1){
            var error = 0;
            if($("#grp_name").val() == ''){
                alert("{$translate.group_name_should_not_be_empty}");
                error = 1;
            }else{
                if ($(".dragdrop-box").children().hasClass('selected_user_wrpr')) {
                //do something
                    error = 0;
                }else{
                    alert("{$translate.select_atleast_one_user}");
                    error = 1;
                }
            }
            if(error == 0)
                $("#frm_question").submit();
        }else if(action == 2){
            $("#frm_question").submit();
        }
}

function addToForm(){
    var user_id = '';
    var user = '';
    $('#draggable-users input.check_user_id:checked').each(function() {
        user_id = $(this).val();
        user = $(this).parents('.draggable-user').find('.user_title_data').html();
        $(this).removeAttr('checked');
        $(this).attr('data-disabled', 'TRUE');
        $('.dragdrop-box').append('<div class="span12 no-ml selected_user_wrpr mb drop-zone">\n\
                                                                <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                                <div style="margin:0;" class="span11">\n\
                                                                    <p class="span8 no-mb">'+ user +'</p>\n\
                                                                    <h1 class="span3 pull-right center"><label>{$translate.group_leader}<input id="rd_gl_'+user_id+'" type="radio" value="'+user_id+'" name="rd_groupleader" class="radio_style" style="margin: 0px 5px ! important;"></label></h1>\n\
                                                                    <input type="hidden" name="user_ids[]" value="'+user_id+'" class="selected_user_id" />\n\
                                                                </div>\n\
                                                            </div>');
        $(this).parents('.draggable-user').addClass('hide');
    });
}

function fetch_groups(){
    var search_val = $("#group_search").val();
    search_val = search_val.toLowerCase();
    if(search_val == ''){
        $('#groups_list_wrpr .single_group_block').each(function(){
                $(this).removeClass('hide');
        });
    }else{
        $('#groups_list_wrpr .single_group_block').each(function(){
            var this_group = $(this).find('.group_title_data').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(this_group))
                $(this).removeClass('hide');
            else
                $(this).addClass('hide');
        });
    }
}

function fetch_user(){
    var search_val = $("#user_search").val();
    search_val = search_val.toLowerCase();
    if(search_val == ''){
        $('#draggable-users .draggable-user').each(function(){
            if($(this).find("input.check_user_id").attr('data-disabled') == 'FALSE')
                $(this).removeClass('hide');
        });
    }else{
        $('#draggable-users .draggable-user').each(function(){
            var this_group = $(this).find('.user_title_data').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(this_group) && $(this).find("input.check_user_id").attr('data-disabled') == 'FALSE')
                $(this).removeClass('hide');
            else
                $(this).addClass('hide');
        });
    }
}
</script>
{/block}
{block name="survey_manage_inner_content"}
<div class="tab-pane active">
        <div class="row-fluid">
            <div class="span12 widget-body-section input-group" id="tab-working-panel">
{*                group create/edit section*}
                {if $display_page neq 'list'}
                    <div class="span12 no-ml">
                        <div class="span3 input-group">
                            <div class="row-fluid">
                                <div class="widget-header span12">
                                    <div class="day-slot-wrpr-header-left pull-left">
                                        <h1>{$translate.employees}</h1>
                                    </div>
                                    <div class="pull-right" style="padding: 5px;">
                                        <button class="btn btn-info pull-right" onClick="addToForm();" type="button"><i class="icon-plus"></i> {$translate.add_to_list}</button>
                                    </div>
                                </div>
                                <div class="span12 padding-set" id="employees_section">
                                    <div class="span12 no-ml">
                                        <label style="float: left;" class="span12" for="user_search">{$translate.search_employees}</label>
                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                            <input class="form-control span10" placeholder="{$translate.search_employees}" id="user_search" type="text"  oninput="fetch_user()"  onemptied="fetch_user()" /> 
                                        </div>
                                        <div tabindex="0" id="draggable-users" class="row quest-blocks-wrpr span12" style="overflow-y: auto;max-height: 400px;">
                                            {foreach $users as $user}
                                                <div class="row-fluid draggable-user {if $show_group eq 1 and in_array($user.username, $filter_members_ids)}hide{/if}">
                                                    <div class="span12 quest-block">
                                                        <div class="row-fluid">
                                                            <div class="span2 quest-block-left"><div class="survey-quation-input-types-user"></div></div>
                                                            <div class="span8 quest-block-center"><p  class="user_title_data" style="margin: 5px 0px ! important;">{$user.last_name} {$user.first_name}</p></div>
                                                            <div class="span2">
                                                                {* data-disabled attribute for span is used to check already been used this employee *}
                                                                <input name="user_{$user.username}" type="checkbox" value="{$user.username}" class="check-box check_user_id" style="margin: 0px 5px 0px 10px ! important;" data-disabled='{if $show_group eq 1 and in_array($user.username, $filter_members_ids)}TRUE{else}FALSE{/if}'/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            {/foreach}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span9">
                            <div class="row-fluid">
                                <div style="margin: 0px ! important;" class="widget-header span12">
                                    <div class="span12" style="padding: 5px;">
                                        <button class="btn btn-default btn-normal pull-right ml" onClick="javascript:location='{$url_path}manage/groups/';"  type="button"><i class='icon-plus'></i> {$translate.new}</button>
                                        <button class="btn btn-default btn-normal pull-right" onClick="saveForm(1)" type="button"><i class='icon-save'></i> {$translate.save}</button>
                                        {if $show_group eq 1}<button class="btn btn-default btn-normal pull-right" onClick="saveForm(2)" type="button"><i class='icon-trash'></i> {$translate.delete}</button>{/if}
                                    </div>
                                </div>     
                            </div>     
                            <div class="row-fluid">
                                <div class="span12">

                                    <div class="widget" style="margin-top:0;">
                                        <form method="POST" name="frm_question" id="frm_question">
                                            <input id="action" name="action" type="hidden" value="" />
                                            {if $show_group eq 1}<input name="this_gid" type="hidden" value="{$this_group_id}" />{/if}
                                            <div class="span12 padding-set">
                                                <div style="" class="row-fluid">
                                                    <label style="float: left;" class="span12" for="grp_name">{$translate.group_name}</label>
                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-edit"></span>
                                                        <input class="form-control span10" placeholder="{$translate.group_name}" id="grp_name" name="txt_group_title" type="text" value="{$this_group_details.group_name}" /> 
                                                    </div>
                                                </div>

                                                <div class="row-fluid" style="margin: 5px 0px 0px;">
                                                    <label style="float: left;" class="span12" for="group_description">{$translate.description}</label>
                                                    <textarea id="group_description" name="group_description" style="margin: 0px;" class="form-control span12" rows="1" placeholder="{$translate.description}">{$this_group_details.group_description}</textarea>
                                                </div>
                                            </div>
                                            <div class="span12 padding-set">
                                                <div class="span12 center no-min-height">{$translate.drag_drop_users}</div>
                                                <div class="span12 dragdrop-box no-ml" style="max-height:300px; height: auto !important; text-align: center;overflow-y: auto;">
                                                    {if $show_group eq 1}
                                                        {foreach $this_group_members as $group_member}
                                                            <div class="span12 no-ml selected_user_wrpr mb drop-zone">
                                                                <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>
                                                                <div style="margin:0;" class="span11">
                                                                    <p class="span8 no-mb">{$group_member.last_name} {$group_member.first_name}</p>
                                                                    <h1 class="span3 pull-right center"><label>{$translate.group_leader}<input id='rd_gl_{$group_member.username}' type="radio" value="{$group_member.username}" name="rd_groupleader" {if $this_group_details.group_leader neq '' and $this_group_details.group_leader eq $group_member.username}checked="checked"{/if} class="radio_style" style="margin: 0px 5px ! important;"></label></h1>
                                                                    <input type='hidden' name='user_ids[]' value='{$group_member.username}' class="selected_user_id" />
                                                                </div>
                                                            </div>
                                                        {/foreach}
                                                    {/if}
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {else}
                                            
{*                groups listing section*}
                    <div class="span12 no-ml mt">
                        <div class="widget-header span12">
                            <div class="day-slot-wrpr-header-left pull-left">
                                <h1>{$translate.groups}</h1>
                            </div>
                            <div style="padding: 5px;">
                                <button class="btn btn-default btn-normal pull-right ml" onClick="javascript:location='{$url_path}manage/groups/';"  type="button"><i class='icon-plus'></i> {$translate.new}</button>
                            </div>
                        </div>
                        <div class="span12 widget-body-section input-group">
                            <div class="span12">
                                <label style="float: left;" class="span12" for="group_search">{$translate.search_groups}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                    <input type="text" class="form-control span11" placeholder="{$translate.search_groups}" id="group_search" name="group_search" oninput="fetch_groups()"  onemptied="fetch_groups()" /> 
                                </div>
                                <div tabindex="0" style="overflow-y: auto; max-height: 300px;" class="row no-ml span12" id="groups_list_wrpr">
                                    {foreach $groups as $group}
                                        <div class="row-fluid single_group_block" id="group_block_{$form.id}">
                                            <div class="span12 quest-block {if $show_group eq 1 and $this_group_id eq $group.id}active{/if}" onClick="javascript:location='{$url_path}manage/groups/{$group.id}/';">
                                                <div class="row-fluid">
                                                    <div class="quest-block-left"><div class="survey-quation-input-types-group pull-left"></div></div>
                                                    <div class="span10 quest-block-center">
                                                        <p class="group_title_data">{$group.group_name}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {/foreach}
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}
            </div>
        </div>
    </div>
{/block}