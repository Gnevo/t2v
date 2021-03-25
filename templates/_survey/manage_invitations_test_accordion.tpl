{block name="sub_style"}
    <style type="text/css">
        .accordion-toggle { border-radius: 5px !important; background: none repeat scroll 0 0 #78bccc !important;} 
        .accordion-inner { padding: 5px 8px !important;}
        .draggable-group .quest-block, .draggable-employee .quest-block, .draggable-customer .quest-block, .draggable-survey .quest-block { padding: 4px !important; margin: 2px 0 !important; }
    </style>
{/block}

{block name="sub_script"}
<script type="text/javascript">
{*$.noConflict();*}
$(document).ready(function() {
    /*$(".accordion-heading").click(function () {
        if ($('.accordion_body').is(':visible')) {
            //$(".accordion_body").slideUp(300);
            $(".plusminus").html('+');
        }
        if ($(this).next(".accordion_body").is(':visible')) {
            //$(this).next(".accordion_body").slideUp(300);
            $(this).find(".plusminus").html('+');
        } else {
            //$(this).next(".accordion_body").slideDown(300);
            $(this).find(".plusminus").html('-');
        }
    });*/
    
    /*$(".acordion_height").click(function(){
            
           // $(this).delay(5000, function(){ });
            switch ($('#accordion').accordion('option', 'active')){
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
     });*/
     
    $("#draggable-groups .draggable-group, #draggable-employees .draggable-employee, #draggable-customers .draggable-customer, #draggable-surveys .draggable-survey").draggable({ revert: "invalid", appendTo: "#tab-working-panel", helper: 'clone', start: 
            function (event, ui) { ui.helper.css({ 'width': '220px', 'opacity': '1'}); } 
    });
    
    $(".dragdrop-box-recipients").droppable({
            accept: ".draggable-group, .draggable-employee, .draggable-customer, .draggable-survey",
            activeClass: "active",
            hoverClass: "hover",
            drop: function(event,ui){
                    if (ui.draggable.hasClass("draggable-survey")){
                        alert('{$translate.please_drop_on_surveys_sections}');
                    }else if (ui.draggable.hasClass("draggable-group")){
                        var group = ui.draggable.find(".group_title_data").html();
                        var group_id = ui.draggable.find("input.check_group_id").val();
                        ui.draggable.addClass('hide');
                        ui.draggable.find("input.check_group_id").attr('data-disabled', 'TRUE');
                        $(".dragdrop-box-recipients").append('<div class="span12 no-ml selected_group_wrpr mb drop-zone">\n\
                                                                <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                                <div style="margin:0;" class="span11">\n\
                                                                    <p class="span8 no-mb">'+ group +'</p>\n\
                                                                    <h1 class="span3 pull-right center"><label>{$translate.group}</label></h1>\n\
                                                                    <input type="hidden" name="group_ids[]" value="'+group_id+'" class="selected_group_id" />\n\
                                                                </div>\n\
                                                            </div>');
                    }else if (ui.draggable.hasClass("draggable-employee")){
                        var user = ui.draggable.find(".employee_title_data").html();
                        var user_id = ui.draggable.find("input.check_employee_id").val();
                        ui.draggable.addClass('hide');
                        ui.draggable.find("input.check_employee_id").attr('data-disabled', 'TRUE');
                        $(".dragdrop-box-recipients").append('<div class="span12 no-ml selected_user_wrpr mb drop-zone">\n\
                                                                <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                                <div style="margin:0;" class="span11">\n\
                                                                    <p class="span8 no-mb">'+ user +'</p>\n\
                                                                    <h1 class="span3 pull-right center"><label>{$translate.user}</label></h1>\n\
                                                                    <input type="hidden" name="user_ids[]" value="'+user_id+'" class="selected_user_id" />\n\
                                                                </div>\n\
                                                            </div>');
                    }else if (ui.draggable.hasClass("draggable-customer")){
                        var customer = ui.draggable.find(".customer_title_data").html();
                        var customer_id = ui.draggable.find("input.check_customer_id").val();
                        ui.draggable.addClass('hide');
                        ui.draggable.find("input.check_customer_id").attr('data-disabled', 'TRUE');
                        $(".dragdrop-box-recipients").append('<div class="span12 no-ml selected_customer_wrpr mb drop-zone">\n\
                                                                <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                                <div style="margin:0;" class="span11">\n\
                                                                    <p class="span8 no-mb">'+ customer +'</p>\n\
                                                                    <h1 class="span3 pull-right center"><label>{$translate.customer}</label></h1>\n\
                                                                    <input type="hidden" name="customer_ids[]" value="'+customer_id+'" class="selected_customer_id" />\n\
                                                                </div>\n\
                                                            </div>');
                    }
            }
    });

    $(".dragdrop-box-survey").droppable({
        //accept: ".tool_srvy",
        accept: ".draggable-group, .draggable-employee, .draggable-customer, .draggable-survey",
        activeClass: "active",
        hoverClass: "hover",
        drop: function(event, ui) {
            if (ui.draggable.hasClass("draggable-group") || ui.draggable.hasClass("draggable-employee") || ui.draggable.hasClass("draggable-customer")){
                alert('{$translate.drop_on_users_sections}');
            } else if (ui.draggable.hasClass("draggable-survey")) {
                var survey_name = ui.draggable.find(".survey_title_data").html();
                var survey_id = ui.draggable.find("input.check_survey_id").val();
                ui.draggable.addClass('hide');
                ui.draggable.find("input.check_survey_id").attr('data-disabled', 'TRUE');
                $(".dragdrop-box-survey .survey-customer-list").append('<li class="selected_survey_wrpr">'+ survey_name + '\n\
                                                                <input type="hidden" name="suvery_ids[]" value="'+survey_id+'" class="selected_survey_id" />\n\
                                                                <div class="ml pull-right"><button aria-hidden="true" data-dismiss="modal" class="close survey-close" type="button">×</button></div></li>');
            }
        }
    });

    // remove Survey
    $(".dragdrop-box-survey .survey-close").live("click", function() {
            var survey_id = $(this).parents('.selected_survey_wrpr').children('input.selected_survey_id').val();
            $(this).parents('.selected_survey_wrpr').remove();
            $('#draggable-surveys').find('[name="survey_'+survey_id+'"]').parents('.draggable-survey').removeClass('hide');
            $('#draggable-surveys').find('[name="survey_'+survey_id+'"]').parents('.draggable-survey').find("input.check_survey_id").attr('data-disabled', 'FALSE');
    });

    // remove employee/customer/groups from dropzone
    $(".ctrlstrip-close").live("click",function(){
            if ($(this).parents('.drop-zone').hasClass("selected_group_wrpr")){
                var this_id = $(this).parents('.drop-zone').find('input.selected_group_id').val();
                $('#draggable-groups').find('[name="group_'+this_id+'"]').parents('.draggable-group').removeClass('hide');
                $('#draggable-groups').find('[name="group_'+this_id+'"]').attr('data-disabled', 'FALSE');
            }else if ($(this).parents('.drop-zone').hasClass("selected_user_wrpr")){
                var this_id = $(this).parents('.drop-zone').find('input.selected_user_id').val();
                $('#draggable-employees').find('[name="user_'+this_id+'"]').parents('.draggable-employee').removeClass('hide');
                $('#draggable-employees').find('[name="user_'+this_id+'"]').attr('data-disabled', 'FALSE');
            }else if ($(this).parents('.drop-zone').hasClass("selected_customer_wrpr")){
                var this_id = $(this).parents('.drop-zone').find('input.selected_customer_id').val();
                $('#draggable-customers').find('[name="customer_'+this_id+'"]').parents('.draggable-customer').removeClass('hide');
                $('#draggable-customers').find('[name="customer_'+this_id+'"]').attr('data-disabled', 'FALSE');
            }
            $(this).parents('.drop-zone').remove();
    });
});
  
function saveForm(action){
        $("#action").val(action);
        if(action == 1){
            var error = 0;
            var present_a = 0;
            if($("#inv_name").val() == ""){
                error = 1;
                alert("{$translate.invitation_subject_should_not_be_empty}");
            }else{
                if ($('.dragdrop-box-recipients').children().hasClass('drop-zone')) {
                    $('.dragdrop-box-survey').find('li.selected_survey_wrpr').each(function() {
                        present_a++;
                    });
                    if(present_a == 0){
                        alert("{$translate.select_atleast_one_survey}");
                         error = 1;
                    }
                }else{
                    alert("{$translate.select_atleast_one_user_or_group}");
                    error = 1;
                }
            }
            if(error == 0){
               $("#frm_question").submit();
            }
        }else if(action == 2){
            $("#frm_question").submit();
        }
}

function addToForm(){
    var opened_collapse_id = $('#accordion .accordion-body.in:first').attr('id');
    var control_id = '';
    var control_caption = '';
    var count = 0;
{*    switch ($('.tabname_menu li.selected').index()){*}
    switch (opened_collapse_id){
            case 'collapse-group':
                    $('#draggable-groups input.check_group_id:checked').each(function() {
                                control_id = $(this).val();
                                control_caption = $(this).parents('.draggable-group').find('.group_title_data').html();
                                $(this).removeAttr('checked');
                                $(this).attr('data-disabled', 'TRUE');
                                $(".dragdrop-box-recipients").append('<div class="span12 no-ml selected_group_wrpr mb drop-zone">\n\
                                                                        <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                                        <div style="margin:0;" class="span11">\n\
                                                                            <p class="span8 no-mb">'+ control_caption +'</p>\n\
                                                                            <h1 class="span3 pull-right center"><label>{$translate.group}</label></h1>\n\
                                                                            <input type="hidden" name="group_ids[]" value="'+control_id+'" class="selected_group_id" />\n\
                                                                        </div>\n\
                                                                    </div>');
                                $(this).parents('.draggable-group').addClass('hide');
                                count++;
                    });
                    if(count == 0)
                        alert('{$translate.select_atleast_one_group}');
                    break;
            case 'collapse-employee':
                    $('#draggable-employees input.check_employee_id:checked').each(function() {
                                control_id = $(this).val();
                                control_caption = $(this).parents('.draggable-employee').find('.employee_title_data').html();
                                $(this).removeAttr('checked');
                                $(this).attr('data-disabled', 'TRUE');
                                $(".dragdrop-box-recipients").append('<div class="span12 no-ml selected_user_wrpr mb drop-zone">\n\
                                                                <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                                <div style="margin:0;" class="span11">\n\
                                                                    <p class="span8 no-mb">'+ control_caption +'</p>\n\
                                                                    <h1 class="span3 pull-right center"><label>{$translate.user}</label></h1>\n\
                                                                    <input type="hidden" name="user_ids[]" value="'+control_id+'" class="selected_user_id" />\n\
                                                                </div>\n\
                                                            </div>');
                                $(this).parents('.draggable-employee').addClass('hide');
                                count++;
                    });
                    if(count == 0)
                        alert('{$translate.select_atleast_one_user}');
                    break;
            case 'collapse-customer':
                    $('#draggable-customers input.check_customer_id:checked').each(function() {
                                control_id = $(this).val();
                                control_caption = $(this).parents('.draggable-customer').find('.customer_title_data').html();
                                $(this).removeAttr('checked');
                                $(this).attr('data-disabled', 'TRUE');
                                $(".dragdrop-box-recipients").append('<div class="span12 no-ml selected_customer_wrpr mb drop-zone">\n\
                                                                <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                                <div style="margin:0;" class="span11">\n\
                                                                    <p class="span8 no-mb">'+ control_caption +'</p>\n\
                                                                    <h1 class="span3 pull-right center"><label>{$translate.customer}</label></h1>\n\
                                                                    <input type="hidden" name="customer_ids[]" value="'+control_id+'" class="selected_customer_id" />\n\
                                                                </div>\n\
                                                            </div>');
                                $(this).parents('.draggable-customer').addClass('hide');
                                count++;
                    });
                    if(count == 0)
                        alert('{$translate.select_atleast_one_customer}');
                    break;
            case 'collapse-surveys':
                    $('#draggable-surveys input.check_survey_id:checked').each(function() {
                                control_id = $(this).val();
                                control_caption = $(this).parents('.draggable-survey').find('.survey_title_data').html();
                                $(this).removeAttr('checked');
                                $(this).attr('data-disabled', 'TRUE');
                                $(".dragdrop-box-survey .survey-customer-list").append('<li class="selected_survey_wrpr">'+ control_caption + '\n\
                                                                <input type="hidden" name="suvery_ids[]" value="'+control_id+'" class="selected_survey_id" />\n\
                                                                <div class="ml pull-right"><button aria-hidden="true" data-dismiss="modal" class="close survey-close" type="button">×</button></div></li>');
                                $(this).parents('.draggable-survey').addClass('hide');
                                count++;
                    });
                    if(count == 0)
                        alert('{$translate.select_atleast_one_survey}');
                    break;
    }
}

function fetch_invite(){
    var search_val = $("#invite_search").val();
    search_val = search_val.toLowerCase();
    if(search_val == ''){
        $('#invitation_list_wrpr .single_invitation_block').each(function(){
                $(this).removeClass('hide');
        });
    }else{
        $('#invitation_list_wrpr .single_invitation_block').each(function(){
            var this_group = $(this).find('.invitation_title_data').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(this_group))
                $(this).removeClass('hide');
            else
                $(this).addClass('hide');
        });
    }
}

function fetch_group(){
    var search_val = $("#group_search").val();
    search_val = search_val.toLowerCase();
    if(search_val == ''){
        $('#draggable-groups .draggable-group').each(function(){
            if($(this).find("input.check_group_id").attr('data-disabled') == 'FALSE')
                $(this).removeClass('hide');
        });
    }else{
        $('#draggable-groups .draggable-group').each(function(){
            var this_group = $(this).find('.group_title_data').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(this_group) && $(this).find("input.check_group_id").attr('data-disabled') == 'FALSE')
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
        $('#draggable-employees .draggable-employee').each(function(){
            if($(this).find("input.check_employee_id").attr('data-disabled') == 'FALSE')
                $(this).removeClass('hide');
        });
    }else{
        $('#draggable-employees .draggable-employee').each(function(){
            var this_group = $(this).find('.employee_title_data').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(this_group) && $(this).find("input.check_employee_id").attr('data-disabled') == 'FALSE')
                $(this).removeClass('hide');
            else
                $(this).addClass('hide');
        });
    }
}

function fetch_customer(){
    var search_val = $("#customer_search").val();
    search_val = search_val.toLowerCase();
    if(search_val == ''){
        $('#draggable-customers .draggable-customer ').each(function(){
            if($(this).find("input.check_customer_id").attr('data-disabled') == 'FALSE')
                $(this).removeClass('hide');
        });
    }else{
        $('#draggable-customers .draggable-customer ').each(function(){
            var this_group = $(this).find('.customer_title_data').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(this_group) && $(this).find("input.check_customer_id").attr('data-disabled') == 'FALSE')
                $(this).removeClass('hide');
            else
                $(this).addClass('hide');
        });
    }
}

function fetch_surveys(){
    var search_val = $("#survey_search").val();
    search_val = search_val.toLowerCase();
    if(search_val == ''){
        $('#draggable-surveys .draggable-survey').each(function(){
            if($(this).find("input.check_survey_id").attr('data-disabled') == 'FALSE')
                $(this).removeClass('hide');
        });
    }else{
        $('#draggable-surveys .draggable-survey').each(function(){
            var this_group = $(this).find('.survey_title_data').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(this_group) && $(this).find("input.check_survey_id").attr('data-disabled') == 'FALSE')
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
{*                invitation create/edit section*}
                {if $display_page neq 'list'}
                    <div class="span12 no-ml">
                        <div class="span3 input-group">
                            <div class="row-fluid">
                                <div class="widget-header span12">
                                    <div class="pull-right" style="padding: 5px;">
                                        <button class="btn btn-info pull-right" onClick="addToForm();" type="button"><i class="icon-plus"></i> {$translate.add_to_invitation}</button>
                                    </div>
                                </div>
                                <div class="span12 no-ml" style="">
                                    <div class="row quest-blocks-wrpr span12" style="overflow: hidden;" tabindex="0">
                                        <div style="" class="span12">
                                            <div id="accordion" class="accordion">
                                                {*Groups Section*}
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">
                                                        <a href="#collapse-group" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">{$translate.groups}</a>
                                                    </div>
                                                    <div style="height: 0px;" class="accordion-body collapse" id="collapse-group">
                                                        <div class="accordion-inner clearfix">
                                                            <label style="float: left;" class="span12" for="group_search">{$translate.search}</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                                                <input class="form-control span10" placeholder="{$translate.search}" id="group_search" type="text"  oninput="fetch_group()"  onemptied="fetch_group()" /> 
                                                            </div>
                                                            <div tabindex="0" id="draggable-groups" class="row quest-blocks-wrpr span12" style="overflow-y: auto;max-height: 400px;margin-top: 0px !important; ">
                                                                {foreach $groups as $group}
                                                                    <div class="row-fluid draggable-group {if $show_invitation eq 1 and in_array($group.id, $filter_group_ids)}hide{/if}">
                                                                        <div class="span12 quest-block">
                                                                            <div class="row-fluid">
                                                                                <div class="span2 quest-block-left"><div class="survey-quation-input-types-group"></div></div>
                                                                                <div class="span8 quest-block-center"><p  class="group_title_data no-mb pt">{$group.group_name}</p></div>
                                                                                <div class="span2">
                                                                                    {* data-disabled attribute for span is used to check already been used this group *}
                                                                                    <input name="group_{$group.id}" type="checkbox" value="{$group.id}" class="check-box check_group_id" style="margin: 0px 5px 0px 10px ! important;" data-disabled='{if $show_invitation eq 1 and in_array($group.id, $filter_group_ids)}TRUE{else}FALSE{/if}'/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                {/foreach}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                {*Employees Section*}
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">
                                                        <a href="#collapse-employee" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">{$translate.employees}</a>
                                                    </div>
                                                    <div style="height: 0px;" class="accordion-body collapse" id="collapse-employee">
                                                        <div class="accordion-inner">
                                                            <label style="float: left;" class="span12" for="user_search">{$translate.search}</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                                                <input class="form-control span10" placeholder="{$translate.search}" id="user_search" type="text"  oninput="fetch_user()"  onemptied="fetch_user()" /> 
                                                            </div>
                                                            <div tabindex="0" id="draggable-employees" class="row quest-blocks-wrpr span12" style="overflow-y: auto;max-height: 400px;margin-top: 0px !important; ">
                                                                {foreach $users as $user}
                                                                    <div class="row-fluid draggable-employee {if $show_invitation eq 1 and in_array($user.username, $filter_members_ids)}hide{/if}">
                                                                        <div class="span12 quest-block">
                                                                            <div class="row-fluid">
                                                                                <div class="span2 quest-block-left"><div class="survey-quation-input-types-user"></div></div>
                                                                                <div class="span8 quest-block-center"><p  class="employee_title_data no-mb pt">{$user.last_name} {$user.first_name}</p></div>
                                                                                <div class="span2">
                                                                                    {* data-disabled attribute for span is used to check already been used this employee *}
                                                                                    <input name="user_{$user.username}" type="checkbox" value="{$user.username}" class="check-box check_employee_id" style="margin: 0px 5px 0px 10px ! important;" data-disabled='{if $show_invitation eq 1 and in_array($user.username, $filter_members_ids)}TRUE{else}FALSE{/if}'/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                {/foreach}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                {*Customers Section*}
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">
                                                        <a href="#collapse-customer" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">{$translate.customer}</a>
                                                    </div>
                                                    <div style="height: 0px;" class="accordion-body collapse" id="collapse-customer">
                                                        <div class="accordion-inner">
                                                            <label style="float: left;" class="span12" for="customer_search">{$translate.search}</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                                                <input class="form-control span10" placeholder="{$translate.search}" id="customer_search" type="text"  oninput="fetch_customer()"  onemptied="fetch_customer()" /> 
                                                            </div>
                                                            <div tabindex="0" id="draggable-customers" class="row quest-blocks-wrpr span12" style="overflow-y: auto;max-height: 400px;margin-top: 0px !important; ">
                                                                {foreach $customers_list as $customer}
                                                                    <div class="row-fluid draggable-customer {if $show_invitation eq 1 and in_array($customer.username, $filter_customer_ids)}hide{/if}">
                                                                        <div class="span12 quest-block">
                                                                            <div class="row-fluid">
                                                                                <div class="span2 quest-block-left"><div class="survey-quation-input-types-user"></div></div>
                                                                                <div class="span8 quest-block-center"><p  class="customer_title_data no-mb pt">{$customer.last_name} {$customer.first_name}</p></div>
                                                                                <div class="span2">
                                                                                    {* data-disabled attribute for span is used to check already been used this customer *}
                                                                                    <input name="customer_{$customer.username}" type="checkbox" value="{$customer.username}" class="check-box check_customer_id" style="margin: 0px 5px 0px 10px ! important;" data-disabled='{if $show_invitation eq 1 and in_array($customer.username, $filter_customer_ids)}TRUE{else}FALSE{/if}'/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                {/foreach}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {*Surveys Section*}
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">
                                                        <a href="#collapse-surveys" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">{$translate.surveys}</a>
                                                    </div>
                                                    <div style="height: 0px;" class="accordion-body collapse" id="collapse-surveys">
                                                        <div class="accordion-inner">
                                                            <label style="float: left;" class="span12" for="survey_search">{$translate.search}</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                                                <input class="form-control span10" placeholder="{$translate.search}" id="survey_search" type="text"  oninput="fetch_surveys()"  onemptied="fetch_surveys()" /> 
                                                            </div>
                                                            <div tabindex="0" id="draggable-surveys" class="row quest-blocks-wrpr span12" style="overflow-y: auto;max-height: 400px;margin-top: 0px !important; ">
                                                                {foreach $surveys as $survey}
                                                                    <div class="row-fluid draggable-survey {if $show_invitation eq 1 and in_array($survey.id, $filter_survey_ids)}hide{/if}">
                                                                        <div class="span12 quest-block">
                                                                            <div class="row-fluid">
                                                                                <div class="span2 quest-block-left"><div class="survey-quation-input-types-manageform"></div></div>
                                                                                <div class="span8 quest-block-center"><p  class="survey_title_data no-mb pt">{$survey.survey_title}</p></div>
                                                                                <div class="span2">
                                                                                    {* data-disabled attribute for span is used to check already been used this customer *}
                                                                                    <input name="survey_{$survey.id}" type="checkbox" value="{$survey.id}" class="check-box check_survey_id" style="margin: 0px 5px 0px 10px ! important;" data-disabled='{if $show_invitation eq 1 and in_array($survey.id, $filter_survey_ids)}TRUE{else}FALSE{/if}'/>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span9">
                            <div class="row-fluid">
                                <div style="margin: 0px ! important;" class="widget-header span12">
                                    <div class="span12" style="padding: 5px;">
                                        <button class="btn btn-default btn-normal pull-right ml" onClick="javascript:location='{$url_path}manage/invitations/';"  type="button"><i class='icon-plus'></i> {$translate.new_invitation}</button>
                                        <button class="btn btn-default btn-normal pull-right" onClick="saveForm(1)" type="button"><i class='icon-save'></i> {$translate.save}</button>
                                        {if $show_invitation eq 1}<button class="btn btn-default btn-normal pull-right" onClick="saveForm(2)" type="button"><i class='icon-trash'></i> {$translate.delete}</button>{/if}
                                    </div>
                                </div>     
                            </div>     
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="widget" style="margin-top:0;">
                                        <form method="POST" name="frm_question" id="frm_question">
                                            <input id="action" name="action" type="hidden" value="" />
                                            {if $show_invitation eq 1}<input name="this_Iid" type="hidden" value="{$this_invitation_id}" />{/if}
                                            <div class="span12 padding-set">
                                                <div style="" class="row-fluid">
                                                    <label style="float: left;" class="span12" for="inv_name">{$translate.subject}</label>
                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-edit"></span>
                                                        <input class="form-control span10" placeholder="{$translate.subject}" id="inv_name" name="txtSubject" type="text" value="{$this_ivite_details.invite_subject}" /> 
                                                    </div>
                                                </div>

                                                <div class="row-fluid" style="margin: 5px 0px 0px;">
                                                    <label style="float: left;" class="span12" for="txtMessage">{$translate.invitation_message}</label>
                                                    <textarea id="txtMessage" name="txtMessage" style="margin: 0px;" class="form-control span12" rows="1" placeholder="{$translate.invitation_message}">{$this_ivite_details.invite_message}</textarea>
                                                </div>
                                            </div>
{*                                            survey droppable section*}
                                            <div class="span12 padding-set">
                                                <div class="span12 center no-min-height">{$translate.drag_drop_survey}</div>
                                                <div class="span12 dragdrop-box dragdrop-box-survey no-ml" style="max-height:300px; height: auto !important; text-align: center;overflow-y: auto;">
                                                    <ul class="survey-customer-list">
                                                        {foreach $this_invitation_surveys as $survey}
                                                            <li class="selected_survey_wrpr">{$survey.survey_title}
                                                                <input type='hidden' name='suvery_ids[]' value='{$survey.id}' class="selected_survey_id" />
                                                                <div class="ml pull-right"><button aria-hidden="true" data-dismiss="modal" class="close survey-close" type="button">×</button></div></li>
                                                        {/foreach}
                                                    </ul>
                                                </div>
                                            </div>
                                            
{*                                            receipients droppable section*}
                                            <div class="span12 padding-set">
                                                <div class="span12 center no-min-height">{$translate.drag_drop_employee_n_customer}</div>
                                                <div class="span12 dragdrop-box dragdrop-box-recipients no-ml" style="max-height:300px; height: auto !important; text-align: center;overflow-y: auto;">
                                                    {if $show_invitation eq 1}
                                                        {foreach $this_invitation_groups as $group}
                                                            <div class="span12 no-ml selected_group_wrpr mb drop-zone">
                                                                <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>
                                                                <div style="margin:0;" class="span11">
                                                                    <p class="span8 no-mb">{$group.group_name}</p>
                                                                    <h1 class="span3 pull-right center"><label>{$translate.group}</label></h1>
                                                                    <input type='hidden' name='group_ids[]' value='{$group.id}' class="selected_group_id" />
                                                                </div>
                                                            </div>
                                                        {/foreach}
                                                        {foreach $this_invitation_individuals as $individual}
                                                            <div class="span12 no-ml selected_user_wrpr mb drop-zone">
                                                                <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>
                                                                <div style="margin:0;" class="span11">
                                                                    <p class="span8 no-mb">{$individual.last_name} {$individual.first_name}</p>
                                                                    <h1 class="span3 pull-right center"><label>{$translate.user}</label></h1>
                                                                    <input type='hidden' name='user_ids[]' value='{$individual.username}' class="selected_user_id" />
                                                                </div>
                                                            </div>
                                                        {/foreach}
                                                        {foreach $this_invitation_customers as $customer}
                                                            <div class="span12 no-ml selected_customer_wrpr mb drop-zone">
                                                                <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>
                                                                <div style="margin:0;" class="span11">
                                                                    <p class="span8 no-mb">{$customer.last_name} {$customer.first_name}</p>
                                                                    <h1 class="span3 pull-right center"><label>{$translate.customer}</label></h1>
                                                                    <input type='hidden' name='customer_ids[]' value='{$customer.username}' class="selected_customer_id" />
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
                                            
{*                invitations listing section*}
                    <div class="span12 no-ml mt">
                        <div class="widget-header span12">
                            <div class="day-slot-wrpr-header-left pull-left">
                                <h1>{$translate.invitation}</h1>
                            </div>
                            <div style="padding: 5px;">
                                <button class="btn btn-default btn-normal pull-right ml" onClick="javascript:location='{$url_path}manage/invitations/';"  type="button"><i class='icon-plus'></i> {$translate.new_invitation}</button>
                            </div>
                        </div>
                        <div class="span12 widget-body-section input-group">
                            <div class="span12">
                                <label style="float: left;" class="span12" for="invite_search">{$translate.search_invitation}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                    <input type="text" class="form-control span11" placeholder="{$translate.search_invitation}" id="invite_search" name="invite_search" oninput="fetch_invite()"  onemptied="fetch_invite()" /> 
                                </div>
                                <div tabindex="0" style="overflow-y: auto; max-height: 300px;" class="row no-ml span12" id="invitation_list_wrpr">
                                    {foreach $invitations as $invitation}
                                        <div class="row-fluid single_invitation_block" id="invitation_block_{$invitation.id}">
                                            <div class="span12 quest-block {if $show_invitation eq 1 and $this_invitation_id eq $invitation.id}active{/if}" onClick="javascript:location='{$url_path}manage/invitations/{$invitation.id}/';">
                                                <div class="row-fluid">
                                                    <div class="quest-block-left"><div class="survey-quation-input-types-invitation pull-left"></div></div>
                                                    <div class="span10 quest-block-center">
                                                        <p class="invitation_title_data">{$invitation.invite_subject}</p>
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