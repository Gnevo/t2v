{block name='style'}
<link rel="stylesheet" type="text/css" href="{$url_path}css/jquery.jscrollpane.css" media="all" />
<link rel="stylesheet" type="text/css" href="{$url_path}css/jquery.jscrollpane.lozenge.css" media="all" />
<link rel="stylesheet" type="text/css" href="{$url_path}css/contextMenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="{$url_path}css/contract_tooltip_info.css" media="all" />
<style type="text/css">
    .scroll-pane, .scroll-pane-arrows {
        width: 100%;
        height: 200px;
        overflow: auto;
    }
    .horizontal-only {
        height: auto;
        max-height: 200px;
    }
    .minimize_hd {
        background: url("{$url_path}images/kunderhd_bg.jpg") repeat-x scroll 0 0 rgba(0, 0, 0, 0);
        border: 1px solid #7BB9C7;
        height: 34px;
        padding: 0 0 0 10px;
    }
    .ui-widget-overlay{
       background:none; 
    }
    .fixed-dialog{ position: fixed; top: 50px; left: 50px; }
</style>
{/block}
{block name='script'}
<script type="text/javascript">
    //didn't remove this js block from this location
    $(function(){
        $.contextMenu( 'destroy' );
    });
</script>
{if $privileges_gd.process == 1}
    <script type="text/javascript" src="{$url_path}js/jquery.shortcuts.js"></script>
    <script type="text/javascript" src="{$url_path}js/jquery.shortcuts.min.js"></script>
{/if}
<script type="text/javascript" src="{$url_path}js/jquery.contextmenu.js"></script>
<script type="text/javascript">
    
$(function(){       
        $('#slot_list_week, .company_names, .unassigned_names').jScrollPane();
        $('.scroll-pane-arrows').jScrollPane({
                showArrows: true,
                horizontalGutter: 10
        });
        
        $('.minimize_plus').click(function(){
            $('.worker_wrapper').slideToggle(800);
            $('.minimize_plus').hide();
            $('.minimize_minus').show();
            $('#slot_list_week, .company_names, .unassigned_names').jScrollPane();
            $.ajax({
                url: "{$url_path}ajax_set_minimize_session.php",
                type: "GET",
                data: "max_min=max",
                success:function(data){
                
                }
           });
        });
        $('.minimize_minus').click(function(){
            $('.worker_wrapper').slideToggle(800);
            $('.minimize_plus').show();
            $('.minimize_minus').hide();
            $.ajax({
                url: "{$url_path}ajax_set_minimize_session.php",
                type: "GET",
                data: "max_min=min",
                success:function(data){
                
                }
           });
        });
        /**************************************************
         * Context-Menu with Sub-Menu
         **************************************************/
        $.contextMenu({
            selector: '.time_slot_btn, .time_slot_incomplete,.customer_week,.week_class', 
            autoHide: true,
            build: function($trigger, e) {
                var rightClickClass = $(this).attr('class');
                var included_candg_slots = false;
                var included_none_candg_slots = false;
                        //window.console && console.log(m) || alert(m);
                var ids = '';
                var pass_add = 0;
                var values = $('input:checkbox:checked.chk_slots').map(function () {
                    if($(this).parent().parent().parent().hasClass("time_slot_btn")){
                        pass_add = 1;
                    }
                    return this.value;
                }).get();
                if(values.length != 0)
                    ids = values.join('-');
                var slot_type_change = '';
                $( 'input:checkbox:checked.chk_slots' ).each(function( index ) {
                    if($(this).parents().hasClass('time_slot_candg'))
                        included_candg_slots = true;

                    else
                        included_none_candg_slots = true;
                });
                var option = {
                    callback: function(key, options) {
                        
                        switch(key){
                            case "delete_slot": 
                                if(ids != ''){
                                    var urls = '{$url_path}ajax_right_click_actions.php?ids='+ids+'&action=multiple_slots_remove&week_num={$year_week}&employee={$employee}';
                                    deleteActions(urls,3);  
                                } else
                                    alert("{$translate.select_atleast_one_slot}");
                                break;

                            case 'delete_customer':
                               if(ids != ''){
                                    var urls = '{$url_path}ajax_right_click_actions.php?ids='+ids+'&action=delete_customers&week_num={$year_week}&employee={$employee}';
                                    deleteActions(urls,2);
                               } else
                                    alert("{$translate.select_atleast_one_slot}");
                               break;

                            case 'delete_employee':
                               if(ids != ''){
                                    var urls = '{$url_path}ajax_right_click_actions.php?ids='+ids+'&action=delete_employees&week_num={$year_week}&employee={$employee}';
                                    deleteActions(urls,1);
                               } else
                                    alert("{$translate.select_atleast_one_slot}");
                               break;
                            case 'change_fk':
                               if(ids != ''){
                                    var urls = '{$url_path}ajax_right_click_actions.php?ids='+ids+'&action=change_fk&week_num={$year_week}&employee={$employee}';
                                    changeActions(urls);
                               } else
                                    alert("{$translate.select_atleast_one_slot}");
                               break;
                            case 'change_kn':
                               if(ids != ''){
                                    var urls = '{$url_path}ajax_right_click_actions.php?ids='+ids+'&action=change_kn&week_num={$year_week}&employee={$employee}';
                                    changeActions(urls);
                               } else
                                    alert("{$translate.select_atleast_one_slot}");
                               break;
                               
                            case 'change_tu':
                               if(ids != ''){
                                    var urls = '{$url_path}ajax_right_click_actions.php?ids='+ids+'&action=change_tu&week_num={$year_week}&employee={$employee}';
                                    changeActions(urls);
                               } else
                                    alert("{$translate.select_atleast_one_slot}");
                               break;

                            case "change_employee":
                               if(ids != ''){
                                    var url = "{$url_path}ajax_right_click_customers_employees_change.php?employee={$employee}&week_num={$year_week}&method=1&ids="+ids;
                                    changeEmployeeCustomer(url,1);
                               } else
                                    alert("{$translate.select_atleast_one_slot}");
                               break;
                            case "change_customer":
                               if(ids != ''){
                                    var url = "{$url_path}ajax_right_click_customers_employees_change.php?employee={$employee}&week_num={$year_week}&method=2&ids="+ids;
                                    changeEmployeeCustomer(url,2);
                               } else
                                    alert("{$translate.select_atleast_one_slot}");
                               break;
                            case "change_type":
                               if(ids != ''){
                                    var url = "{$url_path}ajax_right_click_customers_employees_change.php?employee={$employee}&week_num={$year_week}&method=3&ids="+ids;
                                    changeEmployeeCustomer(url,3);
                               } else
                                    alert("{$translate.select_atleast_one_slot}");
                               break;
                            case "copy": 
                               if(ids != ''){
                                    copySlot(); 
                               } else
                                    alert("{$translate.select_atleast_one_slot}");
                               break;
                            case "paste" :
                                if(rightClickClass == 'week_class'){
                                    pasteSlot('','',$(this).children('.hidden_input').val());
                                }else if(rightClickClass == 'time_slot_incomplete context-menu-active' || rightClickClass == 'time_slot_btn  context-menu-active'){
                                    var dates = $(this).parent().find('.customer_week_days').attr('data-date');
                                    pasteSlot('TRUE',dates,'');
                                }else if(rightClickClass == 'customer_week'){
                                    var dates = $(this).find('.customer_week_days').attr('data-date');
                                    pasteSlot('TRUE',dates,'');
                                }else{
                                    alert("{$translate.cannot_paste}");
                                }
                                break;
                            case "go_to_employee" :
                                var url = "{$url_path}ajax_right_click_customers_employees.php?employee={$employee}&week_num={$year_week}&action=goto_employee";
                                goToEmployeeCustomerPopup(url,1);
                                break;
                            case "go_to_customer" :
                                var url = "{$url_path}ajax_right_click_customers_employees.php?employee={$employee}&week_num={$year_week}&action=goto_customer";
                                goToEmployeeCustomerPopup(url,2);
                                break;
                            case "go_to_week" :
                                var url = "{$url_path}ajax_right_click_customers_employees.php?employee={$employee}&week_num={$year_week}&action=goto_week";
                                goToEmployeeCustomerPopup(url,3);
                                break;

                           case "change_type_normal" :
                           case "change_type_travel" :
                           case "change_type_break" :
                           case "change_type_oncall" :
                           case "change_type_overtime" :
                           case "change_type_qual_overtime" :
                           case "change_type_more_time" :
                           case "change_type_some_other_time" :
                           case "change_type_training_time" :
                           case "change_type_call_training" :
                           case "change_type_personal_meeting" :
                           case "change_type_more_oncall" :
                           case "change_type_voluntary" :
                           case "change_type_complementary" :
                           case "change_type_complementary_oncall" :
                           case "change_type_oncall_standby" :   
                               switch(key){
                                   case "change_type_normal" : slot_type_change = 0; break;
                                   case "change_type_travel" : slot_type_change = 1; break;
                                   case "change_type_break" : slot_type_change = 2; break;
                                   case "change_type_oncall" : slot_type_change = 3; break;
                                   case "change_type_overtime" : slot_type_change = 4; break;
                                   case "change_type_qual_overtime" : slot_type_change = 5; break;
                                   case "change_type_more_time" : slot_type_change = 6; break;
                                   case "change_type_some_other_time" : slot_type_change = 7; break;
                                   case "change_type_training_time" : slot_type_change = 8; break;
                                   case "change_type_call_training" : slot_type_change = 9; break;
                                   case "change_type_personal_meeting" : slot_type_change = 10; break;
                                   case "change_type_voluntary" : slot_type_change = 11; break;
                                   case "change_type_complementary" : slot_type_change = 12; break;
                                   case "change_type_complementary_oncall" : slot_type_change = 13; break;
                                   case "change_type_more_oncall" : slot_type_change = 14; break;
                                   case "change_type_oncall_standby" : slot_type_change = 15; break;    
                               }
                               if(ids != ''){
                                    if(confirm('{$translate.confirm_changes}')){
                                        if(slot_type_change == 14 || slot_type_change == 3 || slot_type_change == 9 || slot_type_change == 13){
                                         $.ajax({
                                            url: "{$url_path}ajax_check_oncall_inconve_range.php",
                                            type: "GET",
                                            data: 'ids='+ids,
                                            success:function(data){
                                                if(data == 'success'){
                                                    var url = '{$url_path}ajax_right_click_actions.php?week_num={$year_week}&employee={$employee}&ids='+ids+'&action=change_type&slot_type='+slot_type_change;
                                                    navigatePage(url,1);
                                                }else{
                                                    alert('{$translate.time_outside_oncall}');
                                                }
                                            }
                                          });
                                        }else{
                                            var url = '{$url_path}ajax_right_click_actions.php?week_num={$year_week}&employee={$employee}&ids='+ids+'&action=change_type&slot_type='+slot_type_change;
                                            navigatePage(url,1);
                                        }
                                    }
                               } else
                                    alert("{$translate.select_atleast_one_slot}");
                               break;
                        }
                    },
                    items: {
                        {if $privileges_gd.process == 1}
                            "copy": { "name": "{$translate.copy}", disabled: (included_candg_slots ? true : false)},
                            "sep1": "---------",
                            "paste": { "name": "{$translate.paste}", disabled: (included_candg_slots ? true : false)},
                            "sep2": "---------",
                        {/if}
                        "go_to": { 
                                    "name": "{$translate.go_to}",
                                    "items":{
                                        "go_to_employee":{ "name":"{$translate.employee}" },
                                        "go_to_customer":{ "name":"{$translate.customer}" },
                                        "go_to_week":{ "name":"{$translate.week}"}
                                        }
                                  },
                        "sep3": "---------",
                        {if $privileges_gd.add_employee eq 1 or $privileges_gd.add_customer eq 1 or $privileges_gd.fkkn eq 1 or $privileges_gd.slot_type eq 1}
                            "change": {   
                                    "name": "{$translate.change_action}" , disabled: (included_candg_slots ? true : false), 
                                    "items": {
                                        {if $privileges_gd.add_employee eq 1}
                                            "change_employee":{ "name":"{$translate.employee}" },
                                        {/if}
                                        {if $privileges_gd.add_customer eq 1}
                                            "change_customer": { "name": "{$translate.customer}" },
                                        {/if}
                                        {if $privileges_gd.fkkn eq 1}
                                            "change_fk": { "name": "FK" },
                                            "change_kn": { "name": "KN" },
                                            "change_tu": { "name": "TU" },
                                        {/if}
                                        {if $privileges_gd.slot_type eq 1}
                                            "change_type": { 
                                                "name": "{$translate.slot_type}",
                                                "items" : {
                                                    'change_type_normal':{ "name" : "{$translate.normal}"}, 
                                                    'change_type_travel':{ "name" : "{$translate.travel}"},
                                                    'change_type_oncall':{ "name" : "{$translate.oncall}"},
                                                    'change_type_overtime':{ "name" : "{$translate.overtime}"},
                                                    'change_type_break':{ "name" : "{$translate.break}"},
                                                    'change_type_qual_overtime':{ "name" : "{$translate.qual_overtime}"},
                                                    'change_type_more_time':{ "name" : "{$translate.more_time}"},
                                                    'change_type_some_other_time':{ "name" : "{$translate.some_other_time}" },
                                                    'change_type_training_time':{ "name" : "{$translate.training_time}"},
                                                    'change_type_call_training':{ "name" : "{$translate.call_training}" },
                                                    'change_type_personal_meeting':{ "name" : "{$translate.personal_meeting}"},
                                                    'change_type_voluntary':{ "name" : "{$translate.voluntary}"},
                                                    'change_type_complementary':{ "name" : "{$translate.complementary}"},
                                                    'change_type_complementary_oncall':{ "name" : "{$translate.complementary_oncall}"},
                                                    'change_type_more_oncall':{ "name" : "{$translate.more_oncall}"},
                                                    'change_type_oncall_standby':{ "name" : "{$translate.oncall_standby}"}
                                                    //'change_type_break':{ "name" : "{$translate.break}"}
                                                } 
                                            }
                                        {/if}
                                    }
                            },
                        {/if}
                        {if $privileges_gd.delete_slot eq 1 or $privileges_gd.remove_employee eq 1 or $privileges_gd.remove_customer eq 1}
                            "delete": {
                                    "name": "{$translate.delete_action}",
                                    "items": {
                                        {if $privileges_gd.delete_slot eq 1} "delete_slot": { "name": "{$translate.slot}" },{/if}
                                        {if $privileges_gd.remove_employee eq 1} "delete_employee": { "name": "{$translate.employee}", disabled: (included_candg_slots ? true : false) },{/if}
                                        {if $privileges_gd.remove_customer eq 1} "delete_customer": { "name": "{$translate.customer}", disabled: (included_candg_slots ? true : false) }{/if}
                                    }

                            }
                        {/if}
                    }
                }
                if(included_candg_slots && !included_none_candg_slots){
                    option.items.candg_approve = { 
                            "name":"{$translate.approve}", 
                            accesskey: "{$translate.approve}",
                            callback: function(key, opt){ 
                                    var urls = '{$url_path}ajax_right_click_actions.php?ids='+ids+'&action=slot_approve_candg&week_num={$year_week}&employee={$employee}';
                                    if(confirm('{$translate.confirm_approval_candg}'))
                                        navigatePage(urls, 1);
                                    else
                                        alert("{$translate.select_atleast_one_slot}");
                            }
                    };

                    option.items.candg_reject = { 
                            "name":"{$translate.reject}", 
                            accesskey: "{$translate.reject}",
                            callback: function(key, opt){ 
                                    var urls = '{$url_path}ajax_right_click_actions.php?ids='+ids+'&action=multiple_slots_remove&week_num={$year_week}&employee={$employee}';
                                    deleteActions(urls,3);
                            }
                    };
                }

                return option;
            }
        });
});

/* Right Click Function Start */
function deleteActions(url,method){
   var confirm_message = '';
    if(method == 1){
        confirm_message = '{$translate.confirm_delete}';
    }else if(method == 2){
        confirm_message = '{$translate.confirm_delete_customer}';
    }else{
        confirm_message = '{$translate.confirm_delete_slot}';
    }
    if(confirm(confirm_message)){
        navigatePage(url, 1);
    }
}

function changeActions(url){
    if(confirm('{$translate.confirm_changes}')){
        navigatePage(url, 1);
    }
}

function changeEmployeeCustomer(url,method){
        var dialog_box = $("#right_click_change_type" );
        dialog_box.html('<div class="popup_first_loading" style="height: 100px;"></div>').load(url);
        if(method == 1){
            dialog_box.dialog({
                title: '{$translate.change_employee}',
                position: 'top,left',
                modal: true,
                minWidth: 230,
                width: 230,
                minHeight: 100,
                closeOnEscape: true,
                close: function(event, ui) {
                        $(this).dialog('destroy').remove();
                        reload_popup_themes();
                }
            });
        }else if(method == 2){
            dialog_box.dialog({
                title: '{$translate.change_customer}',
                position: 'top,left',
                modal: true,
                minWidth: 230,
                width: 230,
                minHeight: 100,
                closeOnEscape: true,
                close: function(event, ui) {
                        $(this).dialog('destroy').remove();
                        reload_popup_themes();
                }
            });
        }else if(method == 3){
            dialog_box.dialog({
                title: '{$translate.change_slot_type}',
                position: 'top,left',
                modal: true,
                minWidth: 150,
                maxHeight: 600,
                closeOnEscape: true,
                close: function(event, ui) {
                        $(this).dialog('destroy').remove();
                        reload_popup_themes();
                }
            });
        }
}

function goToEmployeeCustomerPopup(url,method){
        var dialog_box = $("#right_click_change_type" );
        dialog_box.html('<div class="popup_first_loading" style="height: 100px;"></div>').load(url);
        if(method == 1){
            dialog_box.dialog({
                title: '{$translate.go_to_employee}',
                position: 'top,left',
                modal: true,
                minWidth: 230,
                width: 230,
                minHeight: 100,
                closeOnEscape: true,
                close: function(event, ui) {
                        $(this).dialog('destroy').remove();
                        reload_popup_themes();
                }
            });
        }else if(method == 2){
            dialog_box.dialog({
                title: '{$translate.go_to_customer}',
                position: 'top,left',
                modal: true,
                minWidth: 230,
                width: 230,
                minHeight: 100,
                closeOnEscape: true,
                close: function(event, ui) {
                        $(this).dialog('destroy').remove();
                        reload_popup_themes();
                }
            });
        }
        else{
            dialog_box.dialog({
                title: '{$translate.go_to_week}',
                position: 'top,left',
                modal: true,
                resizable: true,
                Width: 100,
                minHeight: 80,
                closeOnEscape: true,
                close: function(event, ui) {
                        $(this).dialog('destroy').remove();
                        reload_popup_themes();
                }
            });
        }
        
        
}

{if $privileges_gd.process == 1}
    function copySlot(){
        var ids = '';

        var values = $('input:checkbox:checked.chk_slots').map(function () {
                        return this.value;
        }).get();    
        for(var i=0; i < values.length; i++){   
            ids += values[i]+'-';
        }

        if(ids != ''){
            var url = '{$url_path}ajax_slot_process.php?date={$year_week}&employee={$employee}&emp_alloc={$emp_alloc}&action=copy_select&slots='+ids;
            wrapLoader("#slot_list_week");
            $('#alloc_action').load(url,function(response, status, xhr){ uwrapLoader("#slot_list_week"); });
        }else{

            alert('{$translate.select_one_slot}');
        }
    }
    function pasteSlot(action_type,date,week_year){
        action_type = action_type || 'FALSE';
        date = date || '';
        week_year = week_year || '';
        if(date == ''){
            if(week_year != ''){
                var url = '{$url_path}ajax_slot_process.php?date='+week_year+'&employee={$employee}&emp_alloc={$emp_alloc}&action=paste_select';
                var url_data = 'date='+week_year+'&employee={$employee}&emp_alloc={$emp_alloc}&action=paste_select&type_check=8'
            }else{
                var url = '{$url_path}ajax_slot_process.php?date={$year_week}&employee={$employee}&emp_alloc={$emp_alloc}&action=paste_select';
                var url_data = 'date={$year_week}&employee={$employee}&emp_alloc={$emp_alloc}&action=paste_select&type_check=8'
            }
        }
        else{
            var url = '{$url_path}ajax_slot_process.php?date='+date+'&employee={$employee}&emp_alloc={$emp_alloc}&action=paste_select&to_single_day='+action_type; 
            var url_data = 'date='+date+'&employee={$employee}&emp_alloc={$emp_alloc}&action=paste_select&type_check=8&to_single_day='+action_type; 
        }
        
        var atl_req_data = 'date={$year_week}&employee={$employee}&emp_alloc={$emp_alloc}&action=paste_select&type_check=8';
        check_atl_warning(atl_req_data, function(this_url){ 
                            $('#alloc_action').load(this_url,function(response, status, xhr){ reload_content() });
                        }, url, "#slot_list_week");
    }

    $.Shortcuts.stop();
    $.Shortcuts.remove({
        mask: 'Ctrl+C'
    });

    $.Shortcuts.remove({
        mask: 'Ctrl+V'
    });

    $.Shortcuts.add({
        type: 'down',
        mask: 'Ctrl+C',
        handler: copySlot
    });
    $.Shortcuts.add({
        type: 'down',
        mask: 'Ctrl+V',
        handler: pasteSlot
    });
    $.Shortcuts.start(); 
{/if}

</script>

<script type="text/javascript">

function check_atl_warning(check_url_data, _fn_success_call_back, _call_back_data, animation_element){
        
        {if $company_contract_checking_flag eq 1 or $company_atl_checking_flag eq 1}    {*company checking flags*}
            if(typeof animation_element !== "undefined")
                wrapLoader(animation_element);
            else 
                wrapLoader("#assigned_inner");
            
            $.ajax({
                url: "{$url_path}ajax_check_atl_and_contract.php",
                type: "GET",
                data: check_url_data,
                dataType: "json",
                success:function(data){
    {*                console.log(data);*}
                    {if $company_atl_checking_flag eq 1}
                        if(data.atl == 'success'){
                            {if $company_contract_checking_flag eq 0}  /*not checking contract*/
                                _fn_success_call_back(_call_back_data);
                            {else}  /*checking contract*/
                                if(data.contract == 'success'){
                                    _fn_success_call_back(_call_back_data);
                                }else{
                                    {if $privilages_main['contract_override'] eq 1}
                                        $("#dialog-confirm-contract p").html("<span class='error_msg_icon'></span>" + data.contract_params.error_msg);
                                        $( "#dialog-confirm-contract" ).dialog({
                                                resizable: false,
                                                width: 350,
                                                modal: true,
                                                buttons: {
                                                    "{$translate.yes}": function() {
                                                            $( this ).dialog( "close" );
                                                            _fn_success_call_back(_call_back_data);
                                                    },
                                                    "{$translate.no}": function() {
                                                        $( this ).dialog( "close" );
                                                    }
                                                }
                                        });
                                    {else}
                                        $("#overlap_error").remove();
                                        $("#timetable_assign").prepend('<div id="overlap_error" class="message">' + data.contract_params.error_msg + '</div>');
                                    {/if}
                                }
                            {/if}
                        }
                        else{
                            _call_back_data += '&' + serialize_json_as_url(data.atl_params, 'atl_param');
                            {if $privilages_main.atl_override eq 1}
                                $("#dialog-confirm p").html("<span class='error_msg_icon'></span>" + data.atl + ".<br/><br/>{$translate.do_you_want_to_continue}");
                                $( "#dialog-confirm" ).dialog({
                                    resizable: false,
                                    width: 350,
                                    modal: true,
                                    buttons: {
                                        "{$translate.yes}": function() {
                                                $( this ).dialog( "close" );
                                                {if $company_contract_checking_flag eq 0}  /*not checking contract*/
                                                    _fn_success_call_back(_call_back_data);
                                                {else}
                                                    if(data.contract == 'success'){
                                                         _fn_success_call_back(_call_back_data);
                                                    }else{
                                                        {if $privilages_main['contract_override'] eq 1}
                                                                $("#dialog-confirm-contract p").html("<span class='error_msg_icon'></span>" + data.contract_params.error_msg);
                                                                $( "#dialog-confirm-contract" ).dialog({
                                                                    resizable: false,
                                                                    width: 350,
                                                                    modal: true,
                                                                    buttons: {
                                                                        "{$translate.yes}": function() {
                                                                                $( this ).dialog( "close" );
                                                                                _fn_success_call_back(_call_back_data);
                                                                        },
                                                                        "{$translate.no}": function() {
                                                                            $( this ).dialog( "close" );
                                                                        }
                                                                    }
                                                                });
                                                        {else}
                                                                $("#overlap_error").remove();
                                                                $("#timetable_assign").prepend('<div id="overlap_error" class="message">' + data.contract_params.error_msg + '</div>');
                                                        {/if}
                                                    }
                                                {/if}
                                            },
                                        "{$translate.no}": function() {
                                            $( this ).dialog( "close" );
                                        }
                                    }
                                }); 
                            {else} 
                                 alert(data.atl);
                            {/if}
                        }
                    {else if $company_contract_checking_flag eq 1}
                        if(data.contract == 'success'){
                            _fn_success_call_back(_call_back_data);
                        }else{
                            {if $privilages_main['contract_override'] eq 1}
                                $("#dialog-confirm-contract p").html("<span class='error_msg_icon'></span>" + data.contract_params.error_msg);
                                $( "#dialog-confirm-contract" ).dialog({
                                        resizable: false,
                                        width: 350,
                                        modal: true,
                                        buttons: {
                                            "{$translate.yes}": function() {
                                                    $( this ).dialog( "close" );
                                                    _fn_success_call_back(_call_back_data);
                                            },
                                            "{$translate.no}": function() {
                                                $( this ).dialog( "close" );
                                            }
                                        }
                                });
                            {else}
                                $("#overlap_error").remove();
                                $("#timetable_assign").prepend('<div id="overlap_error" class="message">' + data.contract_params.error_msg + '</div>');
                            {/if}
                        }
                    {/if}
                 },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
             })
             .always(function(data) {
                if(typeof animation_element !== "undefined")
                    uwrapLoader(animation_element);
                else 
                    uwrapLoader("#assigned_inner");
            });
        {else}
            _fn_success_call_back(_call_back_data);
        {/if}
}

$(document).ready(function(){
    
    $(".chk_slots").click(function(e){
        e.stopPropagation();
    });
    
    $('#all_check').click(function () {
        $('#slot_list_week').find(':checkbox').attr('checked', this.checked);
    });
    var employees_search = [
        {foreach from=$employee_search item=employees_search}
            {
                    value: "{$employees_search.username}",
                    label: "{$employees_search.last_name} {$employees_search.first_name}({$employees_search.code})"
            },
        {/foreach}
    ];
    $( "#employee_search" ).autocomplete({
        source: employees_search,
        select: function( event, ui ) {
             this.value = ui.item.value;
             navigatePage('{$url_path}employee/gdschema/{$year_week}/'+this.value+'/',1);
            // $("#employee_search").val(this.value);
             
    }
    });
    var customers_search = [
        {foreach from=$customer_search item=customer_searchs}
             {
                    value: "{$customer_searchs.username}",
                    label: "{$customer_searchs.last_name} {$customer_searchs.first_name}({$customer_searchs.code})"
            },       
        {/foreach}
    ];
    $( "#customer_search" ).autocomplete({
        source: customers_search,
        select: function( event, ui ) {
             this.value = ui.item.value;
             navigatePage('{$url_path}customer/gdschema/{$year_week}/'+this.value+'/',1);
             
    }
    });
    
     $( "#employee_search" ).click(function(){
        var search_val = $( "#employee_search" ).val();
        if(search_val == '{$translate.search_employee}'){
            $( "#employee_search" ).val('');
        }
     });
     
      $( "#customer_search" ).click(function(){
        var search_val = $( "#customer_search" ).val();
        if(search_val == '{$translate.search_customer}'){
            $( "#customer_search" ).val('');
        }
     });
      $( "#employee_search" ).blur(function(){
        var search_val = $( "#employee_search" ).val();
        if(search_val == ''){
            $( "#employee_search" ).val('{$translate.search_employee}');
        }
     });
     
      $( "#customer_search" ).blur(function(){
        var search_val = $( "#customer_search" ).val();
        if(search_val == ''){
            $( "#customer_search" ).val('{$translate.search_customer}');
        }
     });
});

function serialize_json_as_url(data, array_name){
    
    var url = '';
    if(typeof array_name !== "undefined"){      //create as array
        url = Object.keys(data).map(function(k) {
                return encodeURIComponent(array_name+'['+k+']') + '=' + encodeURIComponent(data[k]);
        }).join('&');
    } else {
        url = Object.keys(data).map(function(k) {
                return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
        }).join('&');
    }
    return url;
}
    
function reload_content(){
    wrapLoader("#slot_list_week");
    wrapLoader(".worker_wrapper");
    $.ajax({
        async:true,
        cache: true,
        url:"{$url_path}ajax_work_slot_work_week_section.php",
        data:"year_week={$year_week}&employee={$employee}",
        type:"POST",
        success:function(data){
                $("#slot_list_week").html(data);
                uwrapLoader("#slot_list_week");
                $('#slot_list_week').jScrollPane();
                }
    });
    
    $.ajax({    //total work hours
        async:true,
        url:"{$url_path}ajax_gdschema_cust_emp_tot_work_hours.php",
        data:"year_week={$year_week}&employee={$employee}",
        type:"POST",
        success:function(data){
                $("#calculated_total_work_hours").html(data);
                }
    });
    $.ajax({
        async:true,
        cache: true,
        url:"{$url_path}ajax_worker_wrapper_section.php",
        data:"year_week={$year_week}&employee={$employee}",
        type:"POST",
        success:function(data){
                $(".worker_wrapper").html(data);
                uwrapLoader(".worker_wrapper");
                $('.company_names, .unassigned_names').jScrollPane();
                }
    });
}

function loadPopup(url,base) {
     $('html').animate({ scrollTop:0 }, 10, function(){
                var dialog_box = $("#timetable_assign");
                dialog_box.html('<div class="popup_first_loading" style="height: 500px;"></div>').load(url);
                dialog_box.dialog({
                    title: '{$translate.slots_allocation}',
                    position: 'top,left',
                    modal: true,
                    resizable: false,
                    minWidth: 1050,
                    minHeight: 650,
                    closeOnEscape: false,
                    sticky:true,
                    dialogClass: 'fixed-dialog',

                    close: function(event, ui) {
                        $(this).dialog('destroy').remove();
                        reload_popup_themes();
                        if($('#chk_status').val() == 1){
                            if(base == 1){
            //                    location.href='{$url_path}employee/gdschema/{$year_week}/{$employee}/';
                                reload_content();
                                $('#chk_status').val('0');
                            }

                        }
                    }


                });
    });
}
function loadPopupSlot(url) {
    var dialog_box = $("#timetable_slot_assign" );
    dialog_box.html('<div class="popup_first_loading" style="height: 100px;"></div>').load(url);
    // open the dialog
    dialog_box.dialog({
        title: '{$translate.slots_management}',
        position: 'top,left',
        modal: true,
        resizable: false,
        minWidth: 515,
        closeOnEscape: false,
        sticky:true,
        dialogClass: 'fixed-dialog',
        close: function(event, ui) {
            $(this).dialog('destroy').remove();
            reload_popup_themes();
            if($('#chk_status').val() == 1){
                reload_content();
//              location.href='{$url_path}employee/gdschema/{$year_week}/{$employee}/';
                $('#chk_status').val('0');
            }
        }
    });
}

function loadPopupProcess(url) {
    var dialog_box_process = $("#timetable_process" );
    dialog_box_process.html('<div class="popup_first_loading" style="height: 100px;"></div>').load(url);
    // open the dialog
    dialog_box_process.dialog({
        title: '{$translate.slots_process}',
        position: 'top',
        modal: true,
        resizable: false,
        minWidth: 145,
        width: 161,
        closeOnEscape: false,
        sticky:true,
        dialogClass: 'fixed-dialog',
        close: function(event, ui) {
            $(this).dialog('destroy').remove();
            reload_popup_themes();
            if($('#chk_status').val() == 1){
                reload_content();
//                $('.ui-dialog[aria-labelledby="ui-dialog-title-timetable_process"]').remove();
//                $('#timetable_process').remove();
//              location.href='{$url_path}employee/gdschema/{$year_week}/{$employee}/';
                $('#chk_status').val('0');
            }
            
        }
    });
}

function loadPopupProcessMain(url) {
    var dialog_box_process = $("#timetable_process_main" );
    dialog_box_process.html('<div class="popup_first_loading" style="height: 100px;"></div>').load(url);
    // open the dialog
    dialog_box_process.dialog({
        title: '{$translate.slots_process}',
        position: 'top,left',
        modal: true,
        resizable: false,
        minWidth: 630,
        close: function(event, ui) {
            $(this).dialog('destroy').remove();
            $('.ui-dialog[aria-labelledby="ui-dialog-title-timetable_process_main"]').remove();
            $('#timetable_process_main').remove();
//            $("#main_content .worker_wrapper").append('<div id="timetable_process_main" style="display:none;"></div>');
            reload_popup_themes();
            if($('#chk_status').val() == 1){
                reload_content();
//            location.href='{$url_path}employee/gdschema/{$year_week}/{$employee}/';
                $('#chk_status').val('0');
            }
        }
    });
}

function loadPopupProcessCopy(url) {
    var dialog_box_copy = $("#timetable_process_copy");
    dialog_box_copy.html('<div class="popup_first_loading" style="height: 100px;"></div>').load(url);
    dialog_box_copy.dialog({
        title: '{$translate.slots_process}',
        position: 'top,left',
        modal: true,
        resizable: false,
        minWidth: 515,
        closeOnEscape: false,
        sticky:true,
        dialogClass: 'fixed-dialog',
        close: function(event, ui) {
            $(this).dialog('destroy').remove();
            reload_popup_themes();
        }
        
    });
}

function popup(url) {
    
    var dialog_box_new = $("#allocate_cusempwork" );
    dialog_box_new.html('<div class="popup_first_loading" style="height: 100px;"></div>').load(url);
    // open the dialog
    dialog_box_new.dialog({

        title: '{$translate.slots_allocation}',
        position: 'top,left',
        modal: true,
        minWidth: 460,
        closeOnEscape: false,
        sticky:true,
        dialogClass: 'fixed-dialog',
        buttons: {
            '{$translate.cancel}': function() {
                $(this).dialog("close");
            }
        },
        close: function(event, ui) {
            $(this).dialog('destroy').remove();
            reload_popup_themes();
        }
    });
    
    //prevent the browser to follow the link
    return false;
}
var glob = '';  //for closing popup inner from outside
function popup_inner(url) {
            
    var dialog_box_new = $("#allocate_cusempwork" );
    glob = dialog_box_new;
    dialog_box_new.html('<div class="popup_first_loading" style="height: 100px;"></div>').load(url);
    // open the dialog
    dialog_box_new.dialog({

        title: '{$translate.slots_allocation}',
        position: 'top,left',
        modal: true,
        minWidth: 230,
        width: 230,
        minHeight: 100,
        closeOnEscape: false,
        sticky:true,
        dialogClass: 'fixed-dialog',
        close: function(event, ui) {
            $(this).dialog('destroy').remove();
            $(".worker_wrapper #pop_up_themes").append('<div id="alloc_action" style="display:none;"></div>');
            $(".worker_wrapper #pop_up_themes").append('<div id="allocate_cusempwork" style="display: none;"></div>');
        }
    });

    //prevent the browser to follow the link
    return false;
}
    

function reload_popup_themes(){
    $(".worker_wrapper #pop_up_themes").html('')
            .append('<div id="timetable_slot_assign" style="display:none;"></div>')
            .append('<div id="timetable_process" style="display:none;"></div>')
            .append('<div id="timetable_process_main" style="display:none;"></div>')
            .append('<div id="timetable_process_copy" style="display:none;"></div>')
            .append('<div id="timetable_assign" style="display:none;"></div>')
            .append('<div id="alloc_action" style="display:none;"></div>')
            .append('<div id="allocate_cusempwork" style="display: none;"></div>')
            .append('<div id="right_click_change_type" style="display: none;"></div>');
}
    
function closePopup(url){
    $("#timetable_slot_assign").dialog("close");
//    reload_content();
//    location.href='{$url_path}employee/gdschema/{$year_week}/{$employee}/';
    }

function messagePrivilege(){
    alert('{$translate.permission_denied}');
}
</script>
<script type="text/javascript">
{*contract tooltip display			*}
$(document).ready(function(){
        timer = null;
        show = function(){
            if(timer){
                scheduleCancel();
            }
            $('#theNotif').fadeIn('fast');
        }
        scheduleCancel = function (){
            clearTimeout(timer);
            timer = null;
        }
        scheduleHide = function (){
            if(timer){
                scheduleCancel();
            }

            timer = setTimeout(function(){
                hide();
            }, 500);
        }
        hide = function (){
            $('#theNotif').fadeOut('fast');
            timer = null;
        }
        hideInstant = function (){
            $('#theNotif').css('display', 'none');
            timer = null;
        }

        $("#notifikasi").mouseenter(function() {
            show();
        });
        $("#notifikasi").mouseleave(function() {
            scheduleHide();
        });
        $("#theNotif").mouseenter(function() {
            scheduleCancel();
        });
});
</script>
{/block}

{block name="content"}
{if $flag_emp_access eq 1}
    <div id="dialog-confirm" title="{$translate.confirm}" style="display:none; padding-top: 20px;padding-left: 13px; height: auto !important;"><p><span class="error_msg_icon"></span></p></div>
    <div id="dialog-confirm-contract" title="{$translate.confirm}" style="display:none; padding-top: 20px;padding-left: 13px; height: auto !important;"><p><span class="error_msg_icon"></span></p></div>
    <input type="hidden" value="0" id="chk_status">
    <div class="minimize_hd">
        <div style="float:right;">
            <div class="minimize_plus"  {if $max_min == 'max'} style="display: none;"{/if}><img src="{$url_path}images/minimize_plus.png" width="25" height="33"></div>
            <div class="minimize_minus" {if $max_min == 'min'} style="display: none;"{/if}><img src="{$url_path}images/minimize_minus.png" width="25" height="33"></div>
        </div>
    </div>
    <div class="worker_wrapper clearfix" {if $max_min == 'min'}style="display: none;"{/if}>
        <div id="pop_up_themes">
            <div id="timetable_slot_assign" style="display:none;"></div>
            <div id="timetable_process" style="display:none;"></div>
            <div id="timetable_process_main" style="display:none;"></div>
            <div id="timetable_process_copy" style="display:none;"></div>
            <div id="timetable_assign" style="display:none;"></div>
            <div id="alloc_action" style="display:none;"></div>
            <div id="allocate_cusempwork" style="display: none;"></div>
            <div id="right_click_change_type" style="display: none; max-height: 300px;"></div>
        </div>
        {$message}
        <div class="unassigned_customers">
            <div class="search_hd"><div class="unassign_hd">{$translate.companies_to_be_assigned} </div></div>
            <div class="company_names clearfix">
                <table class="pending" cellspacing="0" cellpadding="0">
                    {foreach $customers_to_allocate as $customer_to_allocate}
                        <tr>
                            <td width="340"><a onclick="navigatePage('{$url_path}customer/gdschema/{$customer_to_allocate.first_date}/{$customer_to_allocate.customer_id}/',1);" href="javascript:void(0);" title="{$customer_to_allocate.code}">{if $sort_by_name == 1}{$customer_to_allocate.customer_name_ff}{elseif $sort_by_name == 2}{$customer_to_allocate.customer_name}{/if}</a></td>
                            <td width="200" style="text-align: right; padding-right: 20px;"><a onclick="navigatePage('{$url_path}customer/gdschema/{$customer_to_allocate.first_date}/{$customer_to_allocate.customer_id}/',1);" href="javascript:void(0);">{$customer_to_allocate.total_hours}h</a></td>
                        </tr>
                    {/foreach}
                </table>
            </div>
        </div>
        <div class="unassigned_workers">
            <div class="search_hd"><div class="unassign_hd">{$translate.workers_to_be_assigned} </div></div>
            <div class="unassigned_names">
                <table class="pending" cellspacing="0" cellpadding="0">
                    {foreach $employees_to_allocate as $employee_to_allocate}
                        <tr>
                            <td width="162"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$employee_to_allocate.username}/',1);" href="javascript:void(0);" title="{$employee_to_allocate.code}">{$employee_to_allocate.name}</a></td>
                            <td width="140"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$employee_to_allocate.username}/',1);" href="javascript:void(0);">{$employee_to_allocate.allocated}h {if $employee_to_allocate.monthly_hour} / {$employee_to_allocate.monthly_hour}h{/if}</a></td>
                            <!--<td width="140"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$employee_to_allocate.username}/',1);" href="javascript:void(0);">{$employee_to_allocate.allocated}h {if $employee_to_allocate.allocate}({$employee_to_allocate.allocate}h){/if}</a></td>-->
                        </tr>
                    {/foreach}
                </table>
            </div>
        </div>
        <div class="company_req">
            <div class="search_hd"><div class="comp_hd">{$translate.workers_on_leave} </div><div class="requ_dat_hd">{$translate.date}</div></div>
            <div class="company_names clearfix">
                <table class="pending" cellspacing="0" cellpadding="0">
                    {foreach $leave_employees as $leave_employee}
                        <tr>
                            <td width="162"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$leave_employee.employee}/',1);" href="javascript:void(0);" title="{$leave_employee.code}">{$leave_employee.name} - {$leave_employee.type}</a></td>
                            <td width="127"><a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$leave_employee.employee}/',1);" href="javascript:void(0);">{$leave_employee.date}</a></td>
                        </tr>
                    {/foreach}
                </table>
            </div>
        </div>

    </div>
    <form name="frm_week_slot">
        <div id="wrapper">
            <span class="color_code" style="background-color: {$employee_data.color}; border: 1px solid #A1E5F4; float: left; margin-top: 0px;height: 35px;"></span>
            <div class="block_head">
                    <span class="titles_tab" id="notifikasi" style="width: 349px;">
                        <div class="sprite_submenu_icons" style="background-position: 0 0;margin-top: -2px;"></div>
                        <div id="theNotif" style="display:none;">
                            <div class="contract_arrow"><img src="{$url_path}images/contract_arrow.png" width="23" height="7"  alt=""/></div>
                            <div class="date_monthcontract">
                                <ul>
                                    <li><b>{$translate.weekly_normal_hour} </b><br/>{$work_hours.weekly_nomal}h ({$contract_hours.weekly_nomal}h)</li>
                                    <li><b>{$translate.weekly_oncall_hour}(J) </b><br/>{$work_hours.weekly_oncall}h ({$contract_hours.weekly_oncall}h)</li>
                                    {if isset($work_hours.monthly_nomal) and isset($work_hours.monthly_oncall)}
                                        <li><b>{$translate.monthly_normal_hour} </b><br/>{$work_hours.monthly_nomal}h ({$contract_hours.monthly_nomal}h)</li>
                                        <li><b>{$translate.monthly_oncall_hour}(J) </b><br/>{$work_hours.monthly_oncall}h ({$contract_hours.monthly_oncall}h)</li>
                                    {/if}
                                </ul>
                            </div>
                            {if $work_hours.periods|count gt 0}
                                {foreach $work_hours.periods as $period}
                                    <div class="contact_period">
                                        <ul>
                                            <li><b>{$translate.contract_period}</b><br/>{$period.period_from} {$translate.to_time} {$period.period_to}</li>
                                            <li><b>{$translate.contract_period_total_normal_hour} </b><br/>{$period.work_nomal}h ({$period.contract_nomal}h)</li>
                                            <li><b>{$translate.contract_period_total_oncall_hour}(J) </b><br/>{$period.work_oncall}h ({$period.contract_oncall}h)</li>
                                        </ul>
                                    </div>
                                {/foreach}
                            {/if}
                        </div>
                        {$translate.employee}:{if $sort_by_name == 1}{$employee_data.first_name|cat:' '|cat:$employee_data.last_name|cat:' ('|cat:$translate.employee_no|cat:$employee_data.code|cat:')'}{elseif $sort_by_name == 2} {$employee_data.last_name|cat:' '|cat:$employee_data.first_name|cat:' ('|cat:$translate.employee_no|cat:$employee_data.code|cat:')'}{/if}
                    </span>
                    <div style="float: right">
                        <!-- Niyaz commented -->
                        {if $privileges_gd.process == 1}<!--<span class="process_check"><span class = "chk_slot_ctrl"><input type="checkbox" name="all_check" id="all_check"><label for="all_check">{$translate.check_all}</label><br /></span>-->{/if}
                        {if $process_previlege}<a href="javascript:void(0);" onclick="loadPopupProcessMain('{$url_path}gdschema_process_main.php?cur_week={$year_week}&type=copy&user={$employee_data.username}')" title="{$translate.show_actions}" class="process">{$translate.big_process}</a>{/if}</span>
                    </div>
                    <div style="float: right;margin-right:5px;margin-top: 8px "> 
                       {if $emp_role neq '3'} <input  style="width:150px;" type="text" name="employee_search" id="employee_search" value="{$translate.search_employee}">{/if}
                        {if $emp_role neq '4'}<input  style="width:150px;" type="text" name="customer_search" id="customer_search" value="{$translate.search_customer}">{/if}
                    </div>
            </div>
            <div id="tble_list" class="scroll_fix">
                <div class="table_workers">
                    <div class="{*tableDiv*} scroll_fix" id="tableDiv_General">
                        <div class="week_strip clearfix">
                            <div class="arrow_left">
                                <a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$employee}/{$week_position + 1}/',1);" href="javascript:void(0);" title="{$translate.increase_week_position}"></a>
                            </div>
                            <ul class="weeks">
                                {foreach $week_numbers as $week_number}
                                    {assign var=exp_week_year value="|"|explode:$week_number.id}
                                    {if $week_number.selected}
                                        <li class="active week_class"><a onclick="navigatePage('{if $user_role == 3 || $user_role == 4}{$url_path}gdschema/{else}{$url_path}week/gdschema/{$week_number.id}/1/8/{/if}',1);" href="javascript:void(0);" title="{$translate.enter_the_week_slots} {$exp_week_year[1]}">{$week_number.value}</a></li>
                                    {else}
                                        <li class="week_class"><a onclick="navigatePage('{$url_path}employee/gdschema/{$week_number.id}/{$employee}/8/',1);" href="javascript:void(0);" title="{$translate.go_to_slot_page_week} {$exp_week_year[1]}">{$week_number.value}</a><input type="hidden" class="hidden_input" name="hidden_input[]" value="{$week_number.id}" /></li>
                                    {/if}

                                {/foreach}
                            </ul>
                            <div class="arrow_right">
                                <a onclick="navigatePage('{$url_path}employee/gdschema/{$year_week}/{$employee}/{$week_position - 1}/',1);" href="javascript:void(0);" title="{$translate.reduce_week_position}"></a>
                            </div>
                        </div>
                        <div class="fixedArea clearfix">
                            <div id="slot_list_week" class="cstmr_wk_main">
                                    {foreach $employee_week as $employee_day}
                                    <div class="customer_week">
                                            <a href="javascript:void(0);" {if ($employee_day.privileges_gd == 1)}onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$employee_day.date}&employee={$employee_data.username}',1)" title="{$translate.enter_into_day_slots}" {else} style="cursor: default;" onclick="messagePrivilege()"{/if} class="customer_week_days" data-date="{$employee_day.date}">{$translate.{$employee_day.day.day}}<br/>{$employee_day.date}</a>
                                            {foreach $employee_day.slots as $day_slot}
                                                <a href="javascript:void(0);" {if $day_slot.tl_flag == 1 && $day_slot.status != 2 &&  $day_slot.signed == 0 && ($privileges.{$day_slot.customer}.link == 1 || {$day_slot.customer} == '')&& $privileges.{$day_slot.employee}.link == 1 && ($day_slot.privileges_gd.leave == 1 || $day_slot.privileges_gd.delete_slot == 1 || $day_slot.privileges_gd.split_slot == 1 || $day_slot.privileges_gd.add_customer == 1 || $day_slot.privileges_gd.add_employee == 1 || $day_slot.privileges_gd.fkkn == 1 || $day_slot.privileges_gd.slot_type == 1 || $day_slot.privileges_gd.remove_customer == 1 || $day_slot.privileges_gd.remove_employee == 1 || $day_slot.privileges_gd.swap == 1 || $day_slot.privileges_gd.copy_single_slot == 1 || $day_slot.privileges_gd.copy_single_slot_option == 1)} title="{$translate.slot_view}" onclick="loadPopupSlot('{$url_path}gdschema_slot_manage.php?date={$employee_day.date}&slot={$day_slot.id}&coming=employee')" {if $day_slot.type == 10 &&  $day_slot.status == 1}style="background: url('{$url_path}images/bag.jpg') repeat-x scroll 0 0 #ded7f3"{/if}{else}style="cursor: default; {if $day_slot.type == 10 &&  $day_slot.status == 1} background: url('{$url_path}images/bag.jpg') repeat-x scroll 0 0 #ded7f3{/if}" onclick="messagePrivilege()"{/if} 
                                                   class="{if $day_slot.status == 2}time_slot_leave{elseif $day_slot.status == 0}time_slot_incomplete{elseif $day_slot.status eq 1 and $day_slot.created_status eq 1}time_slot_candg_accept{elseif $day_slot.status == 4}time_slot_candg{else}time_slot_btn{/if}">
                                                   <div class="block_left_color">
                                                        <span class="fkkn_type">
                                                            {if $day_slot.fkkn eq 1}<img src="{$url_path}images/icon_fk.gif"/>
                                                            {else if $day_slot.fkkn eq 2}<img src="{$url_path}images/icon_kn.gif"/>
                                                            {else if $day_slot.fkkn eq 3}<img src="{$url_path}images/tu.gif"/>{/if}
                                                        </span>
                                                        <span class="color_code" style="background-color: {$day_slot.emp_color};">{if $day_slot.signed != 0}<img src="{$url_path}images/cross_line.png"/>{/if}</span>
                                                    </div>
                                                    <div class="single_sloat_detail">
                                                        <span class="customer_week_time">{$day_slot.slot}({$day_slot.slot_hour})</span>
                                                        {if $day_slot.type eq 0}<span class="work"></span>
                                                        {else if $day_slot.type eq 1}<span class="travel"></span>
                                                        {else if $day_slot.type eq 2}<span class="lunch"></span>
                                                        {else if $day_slot.type eq 3}<span class="oncall"></span>
                                                        {else if $day_slot.type eq 4}<span class="overtime"></span>    
                                                        {else if $day_slot.type eq 5}<span class="qualityovertime"></span>
                                                        {else if $day_slot.type eq 6}<span class="moreovertime"></span>
                                                        {else if $day_slot.type eq 7}<span class="someothertime"></span>
                                                        {else if $day_slot.type eq 8}<span class="trainingtime"></span>
                                                        {else if $day_slot.type eq 9}<span class="calltraining"></span>
                                                        {else if $day_slot.type eq 10}<span class="personalmeeting"></span>
                                                        {else if $day_slot.type eq 11}<span class="voluntary"></span>
                                                        {else if $day_slot.type eq 12}<span class="complementary"></span>
                                                        {else if $day_slot.type eq 13}<span class="complementary_oncall"></span>
                                                        {else if $day_slot.type eq 14}<span class="more_oncall"></span>
                                                        {else if $day_slot.type eq 15}<span class="oncall_standby"></span>{/if}
                                                        <span class="customer_used_item" {if $day_slot.status eq 2}style="margin-bottom: 4px;"{/if}>
                                                          <span>{$day_slot.cust_name|truncate:10:'...'}</span>
                                                        </span>
                                                            <!-- Niyaz commented -->
{*                                                        {if $day_slot.status != 2}*}
                                                        {if $day_slot.status neq 2 and ($day_slot.privileges_gd.process eq 1 or $day_slot.privileges_gd.add_employee eq 1 or $day_slot.privileges_gd.add_customer eq 1 or $day_slot.privileges_gd.fkkn eq 1 or $day_slot.privileges_gd.slot_type eq 1 or $day_slot.privileges_gd.delete_slot eq 1 or $day_slot.privileges_gd.remove_employee eq 1 or $day_slot.privileges_gd.remove_customer eq 1)}
                                                            <span class="chk_slot_hold clearfix" style="bottom: 2px;width: 92px;margin-top:2px;">
                                                                {if htmlspecialchars($day_slot.comment) != '' || htmlspecialchars($day_slot.comment) != null} <img src="{$url_path}images/icon_comment.png" title="{htmlspecialchars($day_slot.comment)}" style="cursor: default;">{/if}
                                                                <input type="checkbox" name="chk_wk_slots" class="chk_slots" value="{$day_slot.id}" style="float: right">
                                                            </span>
                                                        {/if}
                                                        {if $day_slot.status == 2}
                                                            <div id="leave_slot_description" class="leave_sick" style="margin:0 0 0 0;padding: 0 1px; ">{$day_slot.leave_data.leave_name}</div>
                                                        {/if}
                                                    </div>
                                                   <!--{if $employee_day.signed != 0} <div class="notworking_time_slot"></div>{/if}-->
                                                </a>
                                            {/foreach}
                                            {if ($privileges_gd.copy_day_slot == 1 || $privileges_gd.delete_day_slot == 1 || $privileges_gd.copy_day_slot_option == 1 || $privileges_gd.add_slot == 1)}    
                                                <a href="javascript:void(0);" onclick="loadPopupProcess('{$url_path}gdschema_slot_process.php?date={$employee_day.date}&employee={$employee_data.username}')" class="time_slot_btn_add" title="{$translate.show_actions}">{$translate.process}</a>
                                            {else}
                                                <a href="javascript:void(0);" onclick="messagePrivilege()" class="time_slot_btn_add">{$translate.process}</a>
                                            {/if}
                                    </div>
                                {/foreach}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
{else}
    <div class="fail">{$translate.permission_denied}</div>    
{/if}                      
{/block}