{block name='style'}
    <link href="{$url_path}css/color-wheel.css" rel="stylesheet" />
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->

    <style type="text/css">
        .underline_link { text-decoration: underline;}
        .btn-help{
                    margin: 5px;
                    cursor: pointer;}
        /*{block name="style_check_list"} {/block}*/
    </style>
{/block}

{block name='script'}
<script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="{$url_path}js/bootbox.js"></script>
<script src="{$url_path}js/nice-scroll.js"></script>  
<script src="{$url_path}js/color-wheel.js"></script>
 <!-- {block name="script_check_list"} {/block} -->
<script type="text/javascript">
     $( ".inner" ).draggable();

        window.onload = function() {
            if('{$employee_username}' == '')
                showHelp();
        };
    $( function() {
        // window.open('{$url_path}ajax_employee_checklist.php',' ','width=1000,height=600,top=50,left=200');
            $( ".main-list" ).sortable();
            $( ".main-list" ).disableSelection();
          } );
    var after_sort_id     = [];
        $( ".main-list" ).sortable({
            // change: function(e, ui) {
            //     before_sort_order = [];
            //     $("#checklist_list li").not('.additem-list').each(function( index ) {

            //       if($(this).data('sortable') != undefined){
            //          before_sort_order.push($(this).data('sortable'));
            //       }
            //     });
            // },
            update: function( event, ui ) {
                after_sort_id     = [];
                 $("#checklist_list li").not('.additem-list').each(function( index ) {
                  after_sort_id.push($(this).data('id'));
                });
                // console.log(before_sort_order,after_sort_id); 
                dataObj = {
                    // before_sort_order : before_sort_order,
                    after_sort_id     : after_sort_id,
                    action            : 'changing_sort_order'
                }
                $.ajax({
                    method  : 'post',
                    url     : '{$url_path}ajax_employee_checklist.php',
                    data    : dataObj,
                    success : function(data){
                        data = JSON.parse(data);
                        // console.log(data);
                        // for (var key in data) {
                        //     $('#cheklist_'+key).attr('data-sortable',data[key]);
                        // }

                    }
                });
            // console.log(ui.item.index());
            // var oldIndex = ui.item.sortable.index;
            // var newIndex = ui.item.index();
            // console.log(oldIndex,newIndex);
          }
        });
    $("#color_code").spectrum({
       color: "{$color_code}",
       showInput: true,
        className: "full-spectrum",
        showInitial: true,
        showPalette: true,
        showSelectionPalette: true,
        maxPaletteSize: 10,
        preferredFormat: "hex",
        localStorageKey: "spectrum.demo",
        cancelText: "{$translate.cancel_colorbox}",
        chooseText: "{$translate.choose}",
        move: function (color) {

        },
        show: function () {

        },
        beforeShow: function () {

        },
        hide: function () {

        },
        change: function () {

        },
        palette: [
            ["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)",
                "rgb(204, 204, 204)", "rgb(217, 217, 217)", "rgb(255, 255, 255)"],
            ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
                "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"],
            ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)",
                "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)",
                "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)",
                "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)",
                "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)",
                "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
                "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
                "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
                "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)",
                "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]
        ]
    });

    $('.btn-toggle').click(function() {
            $(this).find('.btn').toggleClass('active');
            if ($(this).find('.btn-primary').size() > 0) {
                $(this).find('.btn').toggleClass('btn-primary');

                if ($(this).find('.btn-primary').val() == "ON") {
                    
                    if ($(this).attr("purpose") == "substitute") {
                        $('#substitute_fn').val(1);
                    }
                    else if ($(this).attr("purpose") == "inconvenient_on") {
                        $('#chk_inconvenient_on').val(1);
                    }
                    else if ($(this).attr("purpose") == "sem_leave_days") {
                        $('#sem_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "vab_leave_days") {
                        $('#vab_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "fp_leave_days") {
                        $('#fp_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "nopay_leave_days") {
                        $('#nopay_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "other_leave_days") {
                        $('#other_leave_days').val(1);
                    }
                    else if ($(this).attr("purpose") == "candg_follow") {
                        $('#candg_follow').val(1);
                    }
                }
                else if ($(this).find('.btn-primary').val() == "OFF") {
                    if ($(this).attr("purpose") == "substitute") {
                        $('#substitute_fn').val(0);
                    }
                    else if ($(this).attr("purpose") == "inconvenient_on") {
                        $('#chk_inconvenient_on').val(0);
                    }
                    else if ($(this).attr("purpose") == "sem_leave_days") {
                        $('#sem_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "vab_leave_days") {
                        $('#vab_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "fp_leave_days") {
                        $('#fp_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "nopay_leave_days") {
                        $('#nopay_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "other_leave_days") {
                        $('#other_leave_days').val(0);
                    }
                    else if ($(this).attr("purpose") == "candg_follow") {
                        $('#candg_follow').val(0);
                    }
                }
            }
            if ($(this).find('.btn-danger').size() > 0) {
                $(this).find('.btn').toggleClass('btn-danger');
            }
            if ($(this).find('.btn-success').size() > 0) {
                $(this).find('.btn').toggleClass('btn-success');
            }
            if ($(this).find('.btn-info').size() > 0) {
                $(this).find('.btn').toggleClass('btn-info');
            }
            $(this).find('.btn').toggleClass('btn-default');

        });

    /*function assignCustomer(username) {
        $.ajax({
            url:"{$url_path}ajax_customer_list.php",
            type:"GET",
            data:"listtype=allocate&customers="+username+"&username={$users_in}",
            success:function(data){
                $("#list_kunder").html(data);
            }
        });
    }
         
    function removeCustomer(username) {
      
        $.ajax({
            url:"{$url_path}ajax_customer_list.php",
            type:"GET",
            data:"listtype=del&customers="+username+"&username={$users_in}",
            success:function(data){
                $("#list_kunder").html(data);
            }
        });
        
    }
    */

    function showHelp(e){
        console.log('{$employee_username}');
        
            window.open('{$url_path}employee/checklist/',' ','width=800,height=600,top=50,left=200');
        // $('.help').removeClass('hide');
    }

    function assignCustomer(username, this_obj) {

        var main_reference = $(this_obj).parents('.nwoekers_list_entry');
        
        var cust_uname = main_reference.attr('data-username');
        var cust_name = main_reference.find('.emp_name').html();
        var cust_role_old = $.trim(main_reference.find('.emp_role').attr('data-old-role-val'));
        var cust_code = main_reference.find('.emp_code').html();
        
        if($('#tosave_workers').find('.no_emp_msg').length > 0){
            $('#tosave_workers').find('.no_emp_msg').remove();
        }
        var role_label = '';
        switch(cust_role_old){
            case '2' : role_label = '{$translate.tl}'; break;
            case '7' : role_label = '{$translate.super_tl}'; break;
            default : role_label = '{$translate.employee}'; 
        }
        $('#tosave_workers').append('<div id="'+cust_uname+'"  class="span12 child-slots-profile-two attached_emp_entry" data-username="'+cust_uname+'">\n\
                            <a href="javascript:void(0);" onclick="removeCustomer(\''+cust_uname+'\', this);" style="float: right;" title="{$translate.remove_customer}"><span class="glyphicons icon-minus pull-right remove-child-slots cursor_hand"></span></a>\n\
                            <span>\n\
                                <span class="cursor_hand underline_link emp_name_exact" onclick="navigatePage(\'{$url_path}month/gdschema/{$smarty.now|date_format:"%Y/%m"}/'+cust_uname+'/{$employee_username}/EMP_ADD/\',1);">'+cust_name+'</span>\n\
                                <span class="pull-right emp_code">'+cust_code+'</span>\n\
                            </span>\n\
                            <span class="slots-position pull-right emp_role_name">\n\
                                <span class="tl">'+role_label+'</span>\n\
                            </span> \n\
                            <input type="hidden" name="team_cust_uname[]" value="'+cust_uname+'" />\n\
                            <input type="hidden" name="team_cust_role[]" class="emp_role_val" value="'+cust_role_old+'" />\n\
                        </div>');
        main_reference.remove();
        if($('#nwoekers_list').find('.nwoekers_list_entry').length == 0){
            $('#nwoekers_list').html('<div id="no_data" class="span12 message no_emp_msg" >{$translate.no_data_available}</div>');
        }
    }


    function removeCustomer(username, this_obj) {
        var main_reference = $(this_obj).parents('.attached_emp_entry');
        
        var cust_uname = main_reference.attr('data-username');
        var cust_name = main_reference.find('.emp_name_exact').html();
        var cust_role_val = $.trim(main_reference.find('.emp_role_val').val());
        var cust_code = main_reference.find('.emp_code').html();
        
        if($('#nwoekers_list').find('.no_emp_msg').length > 0){
            $('#nwoekers_list').find('.no_emp_msg').remove();
        }
        $('#nwoekers_list').append('<div id="a'+cust_uname+'" class="span12 nwoekers_list_entry child-slots-profile" data-username="'+cust_uname+'">\n\
                            <a href="javascript:void(0);" onclick="assignCustomer(\''+cust_uname+'\', this);" title="{$translate.assign_customer}"><i class="glyphicons icon-plus pull-right remove-child-slots cursor_hand"></i></a>\n\
                            <span>\n\
                                <span class="cursor_hand underline_link emp_name" onclick="navigatePage(\'{$url_path}month/gdschema/{$smarty.now|date_format:"%Y/%m"}/'+cust_uname+'/{$employee_username}/EMP_ADD/\',1);">'+cust_name+'</span>\n\
                                <span class="pull-right emp_code">'+cust_code+'</span>\n\
                                <span class="emp_role" data-old-role-val="'+cust_role_val+'"></span>\n\
                            </span>\n\
                        </div>');
                
        main_reference.remove();
        if($('#tosave_workers').find('.attached_emp_entry').length == 0){
            $('#tosave_workers').html('<div id="no_data" class="span12 message no_emp_msg" >{$translate.no_data_available}</div>');
        }
    }

    function loadNotAllocatedCustomers() { 
        var key = $('#searchkey').val();
        $.ajax({
            url:"{$url_path}ajax_customer_list.php",
            type:"GET",
            data:"listtype=toadd&searchkey="+key+"&username={$users_in}",
            success:function(data){
                $("#list_kunder").html(data);
            }
        });
        //$("#list_kunder").load("{$url_path}ajax_customer_list.php?listtype=toadd&searchkey="+key+"&username={$users_in}");
    }

    //save form
    function saveForm(){
        
        var error = 0;
        var errors = 0;
        var email_check = $('#email').val();
        var proceed;
        if(email_check == ''){
            proceed = true;
        }
        else{
            if(!validate_email(email_check)){
                $('#email').addClass('error');
                proceed = false;
            }
            else{
                $('#email').removeClass('error');
                proceed = true;
            }
        }
        if(proceed == true){
            if($("#phone").val() == "0")
                $("#phone").val('');
            if($('#mobile').val() == "+46")
                $("#mobile").val('');
            var social = $('#social_security').val();
            social = social.replace("-", "");
            $.ajax({
                url:"{$url_path}ajax_check_social_security.php",
                type:"POST",
                data:"social_security="+social,
                success: function(data){
                    $('#soc_sec').html(data);
                    if(data == "{$translate.this_social_security_number_is_wrong}"){
                        $("#social_security").addClass("error");
                        $('#social_security').focus();
                        $('#social_flag').val(''); 
                    }else{
                        $('#social_flag').val('1'); 
                        $("#social_security").removeClass("error");
                    }
                    if($('#social_flag').val() == ""){
                        $("#social_security").addClass("error");
                        errors =  1;
                    }
                    if($('#social_security').val() == ""){
                        $("#social_security").addClass("error");
                        error =  1;
                    }
                    var error_pass = 0;
                    var error_deact = 0;
                    var error_new = 0;
                    var dates_inactive = $("#date_inactive").val();
                    var dates = $("#date").val();
                    if(dates_inactive != "" | dates_inactive != null){
                        if (dates == dates_inactive){
                            error_deact = 1;
                        }
                    }
                    var pass = $("#password").val();
                    if(pass.length < 8){
                        $("#password").addClass("error");
                        error_pass = 1;
                    }
                
                    var mobiles = $('#mobile').val();
                    mobiles = removeCharas(mobiles);
                    mobiles = trimMobileNumber(mobiles);
                    if(isNaN(mobiles)){
                        $("#mobile").addClass("error");
                        error = error + 1;
                    }else{
                        $.post("{$url_path}ajax_mobile_check.php/", { mobile : mobiles, ids : $('#username').val() , method : 1 }, function(data){
                            $('#mobs').html(data);
                            if(data!= ""){
                                $("#mobile").addClass("error");
                                //$('#mobile').focus();
                                $('#mobile_flag').val('');
                                error_new = 1;
                            }else{
                                $('#mobile_flag').val('1'); 
                                $("#mobile").removeClass("error");
                                if ($("#first_name").val() == ""){
                                    $("#first_name").addClass("error");
                                    error = error + 1;
                                }
                                else{
                                    $("#first_name").removeClass("error");
                                }
                                if($("#last_name").val()==""){
                                    $("#last_name").addClass("error");
                                    error = error + 1;
                                }
                                else{
                                    $("#last_name").removeClass("error");
                                }

                                if($("#role").val()==""){
                                    $("#role").addClass("error");
                                    error = error + 1;
                                }
                                else{
                                    $("#role").removeClass("error");
                                }
                                if($("#date").val()==""){
                                    $("#date").addClass("error");
                                    error = error + 1;
                                }
                                else{
                                    $("#date").removeClass("error");
                                }
                                // var mail_send = $('input:radio[name=send_mail]:checked').val();
                                // if(mail_send == 1){
                                //     if($("#email").val()== ""){
                                //         $("#email").addClass("error");
                                //         error = error + 1;
                                //     }
                                //     else{
                                //         $("#email").removeClass("error");
                                //     }
                                // }else{
                                //     $("#email").removeClass("error");
                                // }

                                if(error == 0 && error_pass == 0 && error_deact == 0 && errors == 0 && error_new == 0){
                                            
                                    if(confirm_ask == 0){
                                        //set message warning if employee will deactivate
                                        var diactivation_warning = '';
                                        var radio_val = $('input:radio[name=status]:checked').val();
                                        if(radio_val == 0){
                                            diactivation_warning = '<br/> {$translate.caution}: {$translate.slots_after_inactivation_date_will_be_delete}';
                                        }
                                        bootbox.dialog('{$translate.want_save_changes} '+diactivation_warning, [{
                                                "label" : "{$translate.no}",
                                                "class" : "btn-danger",
                                                "callback": function() {
                                                    bootbox.hideAll();
                                                }
                                            }, {
                                                "label" : "{$translate.yes}",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                        bootbox.hideAll();
                                                        $("#form").submit();
                                                }
                                        }]);
                                    }else{
                                        var radio_val = $('input:radio[name=status]:checked').val();
                                        if(radio_val == 0){
                                            bootbox.dialog('{$translate.caution}: {$translate.slots_after_inactivation_date_will_be_delete}', [{
                                                    "label" : "{$translate.no}",
                                                    "class" : "btn-danger",
                                                    "callback": function() {
                                                        bootbox.hideAll();
                                                    }
                                                }, {
                                                    "label" : "{$translate.yes}",
                                                    "class" : "btn-success",
                                                    "callback": function() {
                                                            bootbox.hideAll();
                                                            $("#form").submit();
                                                    }
                                            }]); 
                                        } else
                                            $("#form").submit();

                                    }
                                }
                                else{
                                    if(error != 0){
                                        $("#error_error").addClass('message');
                                        $("#error_error").html("{$translate.required_missing}");
                                    }
                                    if(error_pass != 0){
                                        $("#error_pass").addClass('message');
                                        $("#error_pass").html("{$translate.password_minimum}");
                                    }
                                    if(error_deact != 0){
                                        var radio_val = $('input:radio[name=status]:checked').val();
                                        if(radio_val == 0){
                                            $("#error_pass").addClass('message');
                                            $("#error_pass").html("{$translate.deactive_date_less}");
                                        }else{
                                            $("#error_pass").addClass('message');
                                            $("#error_pass").html("{$translate.active_date_less}");
                                        }
                                    }
                                }
                            }

                        });
        //$("#mobile").removeClass("error");
                    }
                }
            });
        }
    }	



    //reset form
    function resetForm(){
        $('#form').get(0).reset();
        $('.btn-group').button('reset');
        {if $access_flag == 1 && $employee_action == 'EDIT'}
            edit_mod = 0;
            $("#password, .btn-group button:not(.excluded_edit button), #form option:not(:selected)").attr('disabled', true);
            $("#form input:not(.excluded_edit input), #form textarea").prop('readonly', true);
            $(':radio,:checkbox').click(function(){
                return false;
            });
            $('.icon-plus, .icon-minus').hide();
            $(".sp-container").hide();
        {/if}
    } 

    //print form
    function printForm(){
        //window.print();
        //$('#formPrint').attr('target','_blank');
        $('#formPrint').submit();
    } 	
    
    //back form
    function backForm(){
        //document.location.href = "{$url_path}list/employee/{if $employee_detail[0].status == '0'}inact{else}act{/if}/";
        //document.referrer;
        //history.go(-1)
        window.history.back();
    } 	
        
    function addNewForm(){
    var url = "{$url_path}employee/add/";
        document.location.href = url;
        } 
    var confirm_ask = 0;
    var edit_mod    = 1;	
    var change      = 0;
    $(document).ready(function() {

        
        {if $access_flag == 1 && $employee_action == 'EDIT'}
            edit_mod = 0;
            //$("#password, .btn-group button:not(.excluded_edit button), #form select,  #form input:not(.excluded_edit input), #form textarea").prop('disabled', true);
            $("#password, .btn-group button:not(.excluded_edit button), #form option:not(:selected)").attr('disabled', true);
            $("#form input:not(.excluded_edit input), #form textarea").prop('readonly', true);
            $(':radio,:checkbox').click(function(){
                return false;
            });
            $('.icon-plus, .icon-minus').hide();
            $(".sp-container").hide();
            //$(".sp-container").remove();
            
            

            $("#btn_edit").click(function() {
                
                bootbox.dialog('{$translate.edit_employee_personal_data_mail_go}', [
                    {
                    "label" : "{$translate.no}",
                    "class" : "btn-danger",
                    "callback": function() {
                            bootbox.hideAll();
                            document.location.href = "{$url_path}employee/add/{if isset($employee_username)}{$employee_username}/{/if}";
                        }
                    }, 
                    {
                    "label" : "{$translate.yes}",
                    "class" : "btn-success",
                    "callback": function() {
                            edit_mod = 1;
                            
                            // $('#form input:not(#username)').attr('readonly', false);
                            // $('#form option:not(:selected)').attr('disabled', false);
                            // $("#btn_save, #password").prop('disabled', false);
                            $("#password, .btn-group button:not(.excluded_edit button), #form option:not(:selected)").attr('disabled', false);
                            $("#form input:not(.excluded_edit input, #username), #form textarea").prop('readonly', false);
                            $(':radio,:checkbox').unbind('click');
                            $('.icon-plus, .icon-minus').show();
                            $(".sp-container").show();

                            $(".datepicker").datepicker({
                                autoclose: true,
                                weekStart: 1,
                                calendarWeeks: true, 
                                language: '{$lang}'
                            });

                            $.mask.definitions['~']='[1-9]';
                            $("#mobile").mask("+46?99 999 99 99", { placeholder:" " });
                            $("#phone").mask("0?~9-99999999999", { placeholder:" " });

                            $("#btn_save").removeAttr('disabled');
                            
                        }
                    }
                ]);    
                     
            });
        {else}
            $.mask.definitions['~']='[1-9]';
            $("#mobile").mask("+46?99 999 99 99", { placeholder:" " });
            $("#phone").mask("0?~9-99999999999", { placeholder:" " });

            $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '{$lang}'
            });
        {/if}
        if($(window).height() > 600) {
            {if empty($employee_detail)}
                $('.tab-content-con').css({ height: $(window).height()-180});  
            {else}
                $('.tab-content-con').css({ height: $(window).height()-271});
            {/if}
        }
        else
            $('.tab-content-con').css({ height: $(window).height()});

        
        /*$(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '{$lang}'
        });
        $(".datepicker").datepicker('disable');*/
        /*$( "#date, #date_inactive, #sem_leave_todate" ).datepicker({
                showOn: "button",
                dateFormat: "yy-mm-dd",
                buttonImage: "{$url_path}images/date_pic.gif",
                buttonImageOnly: true
        });*/
        
        var tab = '{$tab}';
        if(tab == '03'){
            documentationLoad();
        }
        else if(tab == '02'){
            skillLoad();
        }
        $("#role_val").val("{$employee_role}");
     $(".side_links li a").click(function(event){
            event.preventDefault();
            var path = $(this).attr('href');
            
            var new_var = $("#new").val();
            if(new_var == "1"){
                
                bootbox.dialog('{$translate.want_save_changes}', [{
                    "label" : "{$translate.no}",
                    "class" : "btn-danger",
                    "callback": function() {
                            bootbox.hideAll();
                            document.location.href = path;
                        }
                    }, {
                    "label" : "{$translate.yes}",
                    "class" : "btn-success",
                    "callback": function() {
                            bootbox.hideAll();
                            confirm_ask = 1;
                            saveForm();
                        }
                    
                }]);
            }
            else{
                document.location.href = path;
            }
         });

    $("#first_name").blur(function() {
        if ($("#first_name").val() == ""){
                 $("#first_name").addClass("error");
           }
           else{
                 $("#first_name").removeClass("error");
           }
    });
    $("#last_name").blur(function() {
        if($("#last_name").val()==""){
                 $("#last_name").addClass("error");
           }
           else{
                 $("#last_name").removeClass("error");
           }
    });

    $("#role").blur(function() {
        if($("#role").val()==""){
                 $("#role").addClass("error");
           }
           else{
                 $("#role").removeClass("error");
           }
    });
    $("#date").blur(function() {
        if($("#date").val()==""){
                 $("#date").addClass("error");
           }
           else{
                 $("#date").removeClass("error");
           }
    });
    $("#email").blur(function() {
        $('#email').removeClass('error');
        // if($("#email").val()== "" && $('input:radio[name=send_mail]:checked').val() == 1){
        //          $("#email").addClass("error");
        //    }
        //    else{
        //          $("#email").removeClass("error");
        //    }
    });

    $("#max_hours").blur(function() {
        if($("#max_hours").val()=="" || $("#max_hours").val() > 15){
                 $("#max_hours").addClass("error");
           }
           else{
                 $("#max_hours").removeClass("error");
           }
    });


    //generating username w.r.t lastname blur
    if($('#username').val() =="") {
        
        $('#last_name').blur(function() {
                if($('#last_name').val() != "" && $('#first_name').val() != ""){
                   var name_first =  $('#first_name').val();
                   var name_last =  $('#last_name').val();
                   var social_sec = $('#social_security').val();
                   social_sec = social_sec.replace("-","");
                   name_first = name_first.replace(/\Ä/g, "A")
                   name_first = name_first.replace(/\Å/g, "A")
                   name_first = name_first.replace(/\É/g, "E")
                   name_first = name_first.replace(/\Ö/g, "O")
                   name_first = name_first.replace(/\ä/g, "a")
                   name_first = name_first.replace(/\å/g, "a")
                   name_first = name_first.replace(/\é/g, "e")
                   name_first = name_first.replace(/\ö/g, "o")
                   name_last = name_last.replace(/\Ä/g, "A")
                   name_last = name_last.replace(/\Å/g, "A")
                   name_last = name_last.replace(/\É/g, "E")
                   name_last = name_last.replace(/\Ö/g, "O")
                   name_last = name_last.replace(/\ä/g, "a")
                   name_last = name_last.replace(/\å/g, "a")
                   name_last = name_last.replace(/\é/g, "e")
                   name_last = name_last.replace(/\ö/g, "o")
                   $.post("{$url_path}ajax_generate_username/", { first_name : name_first , last_name : name_last },
                        function(data){
                                 $('#username').val(data);
                                 //if(parseInt(data.substring(4,7)) > 1)
                                    $('#dialog_hidden').load("{$url_path}ajax_global_check.php?ssno=" + social_sec);
        });
        }
        });
        }
    		
    			
     //generating username w.r.t firstname blur
     if($('#username').val() =="") {
             $('#first_name').blur(function() {
                 if($('#last_name').val() != "" && $('#first_name').val() != ""){
                 var name_first =  $('#first_name').val();
                   var name_last =  $('#last_name').val();
                   name_first = name_first.replace(/\Ä/g, "A")
                   name_first = name_first.replace(/\Å/g, "A")
                   name_first = name_first.replace(/\É/g, "E")
                   name_first = name_first.replace(/\Ö/g, "O")
                   name_first = name_first.replace(/\ä/g, "a")
                   name_first = name_first.replace(/\å/g, "a")
                   name_first = name_first.replace(/\é/g, "e")
                   name_first = name_first.replace(/\ö/g, "o")
                   name_last = name_last.replace(/\Ä/g, "A")
                   name_last = name_last.replace(/\Å/g, "A")
                   name_last = name_last.replace(/\É/g, "E")
                   name_last = name_last.replace(/\Ö/g, "O")
                   name_last = name_last.replace(/\ä/g, "a")
                   name_last = name_last.replace(/\å/g, "a")
                   name_last = name_last.replace(/\é/g, "e")
                   name_last = name_last.replace(/\ö/g, "o")
                      $.post("{$url_path}ajax_generate_username/", { first_name : $('#first_name').val() , last_name : $('#last_name').val() },
                          function(data){
                                $('#username').val(data);	
        });
        }
        });
        }
    		
    //set century asper SSN	
    $( "#social_security" ).keyup(function() {
        var tmp_val = $(this).val();
        tmp_val = tmp_val.replace(/-/g, "");
        tmp_val = tmp_val.replace(/ /g, "");
        if(tmp_val.length >= 2){
            var temp_first_2_digit = parseInt(tmp_val.substring(0, 2));
            if(temp_first_2_digit >= 0 && temp_first_2_digit <= parseInt({$year_in_2_digit})){
                $('#century').val(20);
            } else {
                $('#century').val(19);
            }
        }
    });
    //validate social security number
    $('#social_security').blur(function() {
        var social_sec = $('#social_security').val();
        social_sec = social_sec.replace("-","");
        $.ajax({
        url:"{$url_path}ajax_check_social_security.php",
        type:"POST",
        data:"social_security="+social_sec,
        success:
            function(data){
                $('#soc_sec').html(data);
                            if(data!= ""){
                              $("#social_security").addClass("error");
                              $('#social_security').focus();
                              $('#social_flag').val('');  
                            }else{
                              $('#social_flag').val('1'); 
                              $("#social_security").removeClass("error");
                              var last_digit = social_sec.substring(8,9);
                              if(last_digit % 2 == 0){
                                $('#gender_male').prop('checked',false);
                                $('#gender_female').prop('checked',true);
                              }else{
                                $('#gender_male').prop('checked',true);
                                $('#gender_female').prop('checked',false);
                              }
                            }
         }
                        
        });
        });	
            
    $('#mobile').blur(function() {
        if($('#mobile').val() == "+46"){
            $("#mobile").val('');
        }
        var mobiles = $('#mobile').val();
            //var mobiles = $('#mobile').val();
            mobiles = removeCharas(mobiles);
            mobiles = trimMobileNumber(mobiles);
            if(isNaN(mobiles)){
                $("#mobile").addClass("error");
            }else{
                $("#mobile").removeClass("error");
            }

            $.post("{$url_path}ajax_mobile_check/", { mobile : mobiles, ids : $('#username').val() , method : 1 },
                function(data){
                    $('#mobs').html(data);
                                if(data!= ""){
                                  $("#mobile").addClass("error");
                                  //$('#mobile').focus();
                                  $('#mobile_flag').val('');
                                }else{
                                  $('#mobile_flag').val('1');  
                                }

            });
        
    });

    $('#phone').blur(function() {
        if($('#phone').val() == "0"){
            $("#phone").val('');
        }
    });
         
        		
    				
    });


    function makeSTl(emp, cust, this_obj) {
        /*$("#cust_username_team").val(cust);
        $("#emp_username_team").val(emp);
        $("#action_change").val("1");
        $("#form").submit();*/
        if(edit_mod == 1){
            $(this_obj).parents('.attached_emp_entry').find('input.emp_role_val').val('7');
            $(this_obj).parents('.attached_emp_entry').find('.emp_role_name').html('{$translate.super_tl}');
        }
    }

    function makeTl(emp, cust, this_obj) {
        /*$("#cust_username_team").val(cust);
        $("#emp_username_team").val(emp);
        $("#action_change").val("2");
        $("#form").submit();*/
        if(edit_mod == 1){
            $(this_obj).parents('.attached_emp_entry').find('input.emp_role_val').val('2');
            $(this_obj).parents('.attached_emp_entry').find('.emp_role_name').html('{$translate.tl}');
        }
    }

    function giveDeactivation(){
        makeChange();
        var inactive_date = $("#date_inactive").val();
        if(inactive_date == "" || inactive_date == null){
            $("#date_inactive").val("{$today}");
        }else{
            var date = new Date($("#date").val());
            var date_in = new Date($("#date_inactive").val());
            if(date > date_in){
                $("#date_inactive").val("{$today}");
            }
        }
    }

    function giveActivation(){  
        makeChange();
        var inactive_date = $("#date_inactive").val();
        
        if(inactive_date != "" || inactive_date != null){
            var date = new Date($("#date").val());
            var date_in = new Date($("#date_inactive").val());
            if(date_in < date){
                $("#date_inactive").val('');
            }
        }
    }

    function makeChange(){
        change = 1;
        $("#new").val('1');   
    }

    function redirectConfirm(mode){
        var redirectURL = mode.replace("%%C-UNAME%%", "{$employee_username}");
        if(redirectURL != ''){
            if(change == 1){
                $( "#dialog-confirm" ).dialog({
                    resizable: false,
                    height:140,
                    modal: true,
                    buttons: {
                        "{$translate.yes}": function() {
                                $( this ).dialog( "close" );
                                confirm_ask = 1;
                                saveForm();
                            },
                            "{$translate.no}": function() {
                                    $( this ).dialog( "close" );
                                    document.location.href = redirectURL;
                            }
                        }
                });
            }
            else{
                document.location.href = redirectURL;
            }
        }
    }

    /*function loadAddEmployee(){
        var change = $("#new").val();
        if(change == "1"){
                
                bootbox.dialog('{$translate.want_save_changes}', [{
                    "label" : "{$translate.no}",
                    "class" : "btn-danger",
                    "callback": function() {
                            bootbox.hideAll();
                            document.location.href = "{$url_path}employee/add/{if isset($employee_username)}{$employee_username}/{/if}";
                        }
                    }, {
                    "label" : "{$translate.yes}",
                    "class" : "btn-success",
                    "callback": function() {
                            bootbox.hideAll();
                            confirm_ask = 1;
                            saveForm();
                        }
                }]);
                
            }
            else{
                document.location.href = "{$url_path}employee/add/{if isset($employee_username)}{$employee_username}/{/if}";
            }
    }

    function loadContract(){
        var change = $("#new").val();
        if(change == "1"){
                
                bootbox.dialog('{$translate.want_save_changes}', [{
                    "label" : "{$translate.no}",
                    "class" : "btn-danger",
                    "callback": function() {
                            bootbox.hideAll();
                            document.location.href = "{$url_path}employment/contract/pdf/{if isset($employee_username)}{$employee_username}/{/if}";
                        }
                    }, {
                    "label" : "{$translate.yes}",
                    "class" : "btn-success",
                    "callback": function() {
                            bootbox.hideAll();
                            confirm_ask = 1;
                            saveForm();
                        }
                }]);
                
            }
            else{
                document.location.href = "{$url_path}employment/contract/pdf/{if isset($employee_username)}{$employee_username}/{/if}";
            }
    }

    function loadNotification(){
        var change = $("#new").val();
        if(change == "1"){
            
            bootbox.dialog('{$translate.want_save_changes}', [{
                "label" : "{$translate.no}",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        document.location.href = "{$url_path}employee/notification/{if isset($employee_username)}{$employee_username}/{/if}";
                    }
                }, {
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                        bootbox.hideAll();
                        confirm_ask = 1;
                        saveForm();
                    }
            }]);
                
                
            }
            else{
                document.location.href = "{$url_path}employee/notification/{if isset($employee_username)}{$employee_username}/{/if}";
            }
    }

    function loadPrivilege(){
        var change = $("#new").val();
        if(change == "1"){
            bootbox.dialog('{$translate.want_save_changes}', [{
                "label" : "{$translate.no}",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        document.location.href = "{$url_path}employee/privileges/{if isset($employee_username)}{$employee_username}/{/if}";
                    }
                }, {
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                        bootbox.hideAll();
                        confirm_ask = 1;
                        saveForm();
                    }
            }]);
                
            }
            else{
                document.location.href = "{$url_path}employee/privileges/{if isset($employee_username)}{$employee_username}/{/if}";
            }
    }
    function loadPrifferedTime(){
        var change = $("#new").val();
        if(change == "1"){
            
            bootbox.dialog('{$translate.want_save_changes}', [{
                "label" : "{$translate.no}",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        document.location.href = "{$url_path}emptime/preference/{if isset($employee_username)}{$employee_username}/{/if}";
                    }
                }, {
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                        bootbox.hideAll();
                        confirm_ask = 1;
                        saveForm();
                    }
            }]);
            }
            else{
                document.location.href = "{$url_path}emptime/preference/{if isset($employee_username)}{$employee_username}/{/if}";
            }
    }

    function loadSalary(){
        var change = $("#new").val();
        if(change == "1"){
            
            bootbox.dialog('{$translate.want_save_changes}', [{
                "label" : "{$translate.no}",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        document.location.href = "{$url_path}employee/list/salary/{if isset($employee_username)}{$employee_username}/{/if}";
                    }
                }, {
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                        bootbox.hideAll();
                        confirm_ask = 1;
                        saveForm();
                    }
            }]);
        }
        else{
            document.location.href = "{$url_path}employee/list/salary/{if isset($employee_username)}{$employee_username}/{/if}";
        }
    }

    function loadAdministration(){
        var change = $("#new").val();
        if(change == "1"){
            
            bootbox.dialog('{$translate.want_save_changes}', [{
                "label" : "{$translate.no}",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        document.location.href = "{$url_path}employee/list/salary/{if isset($employee_username)}{$employee_username}/{/if}";
                    }
                }, {
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                        bootbox.hideAll();
                        confirm_ask = 1;
                        saveForm();
                    }
            }]);
            }
        else{
            document.location.href = "{$url_path}employee/list/salary/{if isset($employee_username)}{$employee_username}/{/if}";
        }
    }

    function loadSkills(){
        var change = $("#new").val();
        if(change == "1"){
            
            bootbox.dialog('{$translate.want_save_changes}', [{
                "label" : "{$translate.no}",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        document.location.href = "{$url_path}employee/skills/{if isset($employee_username)}{$employee_username}/{/if}";
                    }
                }, {
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                        bootbox.hideAll();
                        confirm_ask = 1;
                        saveForm();
                    }
            }]);
            
        }
        else{
            document.location.href = "{$url_path}employee/skills/{if isset($employee_username)}{$employee_username}/{/if}";
        }

    }

    function loadDocumentation(){
        var change = $("#new").val();
        if(change == "1"){
            
            bootbox.dialog('{$translate.want_save_changes}', [{
                "label" : "{$translate.no}",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        document.location.href = "{$url_path}employee/documentations/{if isset($employee_username)}{$employee_username}/{/if}";
                    }
                }, {
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                        bootbox.hideAll();
                        confirm_ask = 1;
                        saveForm();
                    }
            }]);
        }
        else{
            document.location.href = "{$url_path}employee/documentations/{if isset($employee_username)}{$employee_username}/{/if}";
        }

    }*/

    function arvodeLoad(){
            $("#kunder_link").parent().removeClass("active");
            $("#utbildning_link").parent().removeClass("active"); 
            $("#dokumentation_link").parent().removeClass("active"); 
            $("#arvode_link").parent().removeClass("active"); 
            $("#arvode_link").parent().addClass("active");
            $("#skill_div").hide();
            $("#Kunder").load("{$url_path}ajax_contract_sign.php");
    }

    {*function signContract(id){
       
       bootbox.dialog('{$translate.want_save_changes}', [{
                label: "{$translate.yes}",
                class: "btn-success",
                callback: function() {
                        bootbox.hideAll();
                        var password = $("#pass1").val();
                        var hash = CryptoJS.MD5("{$hash}"+password);
                        if (hash == "{$passwrd}")
                        {
                            document.location.href = "{$url_path}employee/administration/4/"+id+"/{$employee_detail[0].username}/sign/";
                        } 
                        else if(password != null)
                        {
                            bootbox.dialog( '{$translate.confirm}', [{
                                "label" : "{$translate.ok}",
                                "class" : "btn-primary",
                                "callback": function() {
                                    bootbox.hideAll();
                                }
                                }]);
                        }
                    }
                }, {
                label: "{$translate.no}",
                class: "btn-danger",
                callback: function() {
                        bootbox.hideAll();
                        
                    }
            }]);
    }*}
    function contractDownload(id){
        $('#action').val('print');
        //document.location.href = "{$url_path}employee/administration/4/"+id+"/{$employee_detail[0].username}/print/";
        window.open("{$url_path}employee/administration/4/"+id+"/{$employee_detail[0].username}/print/");
    }
    function delAttachment(id){
        
        bootbox.dialog( '{$translate.confirm}', [{
            label: "{$translate.no}",
            class: "btn-danger",
            callback: function() {
                bootbox.hideAll();
            }
        }, {
            label: "{$translate.yes}",
            class: "btn-success",
            callback: function() {
                bootbox.hideAll();
                document.location.href = "{$url_path}employee/add/{$employee_username}/del1/"+id+"/";
                documentationLoad();
            }
        }]);

    }
    function delSkill(id){

        bootbox.dialog( '{$translate.confirm}', [{
            label: "{$translate.no}",
            class: "btn-danger",
            callback: function() {
                bootbox.hideAll();
            }
        }, {
            label: "{$translate.yes}",
            class: "btn-success",
            callback: function() {
                bootbox.hideAll();
                document.location.href = "{$url_path}employee/add/{$employee_username}/del2/"+id+"/";
                            skillLoad();
            }
        }]);
        
    }    
    function employeeLoad(){
        $("#kunder_link").parent().removeClass("active");
        $("#utbildning_link").parent().removeClass("active"); 
        $("#dokumentation_link").parent().removeClass("active"); 
        $("#arvode_link").parent().removeClass("active"); 
        $("#kunder_link").parent().addClass("active");
        $("#skill_div").hide();
        $("#Kunder").load("{$url_path}ajax_employee_role.php");
    }
    function skillLoad(){

       $("#kunder_link").parent().removeClass("active");
            $("#utbildning_link").parent().removeClass("active"); 
            $("#dokumentation_link").parent().removeClass("active"); 
            $("#arvode_link").parent().removeClass("active"); 
            $("#utbildning_link").parent().addClass("active");
            $("#skill_div").show();
        $("#Kunder").load("{$url_path}ajax_employee_skill.php");    
    }
    function PreferedTime(){
    	$("#PreferedTime").load("{$url_path}ajax_employee_skill.php");
    }
    function documentationLoad(){
    $("#kunder_link").parent().removeClass("active");
            $("#utbildning_link").parent().removeClass("active"); 
            $("#dokumentation_link").parent().removeClass("active"); 
            $("#arvode_link").parent().removeClass("active"); 
            $("#dokumentation_link").parent().addClass("active");
            $("#skill_div").hide();
        $("#Kunder").load("{$url_path}ajax_employee_attachment.php?move=1");
    }

    function checkSecurity(){
            var security = $("#social_security").val();
            security = security.replace("-","");
                    $.ajax({
                            url:"{$url_path}ajax_check_social_security.php",
                            data:"social_security="+security,
                            type:"POST",
                            success:function(data){
                                   $('#soc_sec').html(data);
                                        if(data!= ""){
                                        $("#social_security").addClass("error");
                                        $('#social_security').focus();
                                        $('#social_flag').val('');  
                                    }else{
                                        $('#social_flag').val('1');  
                            }
                            }
                            });
            
    }
    function popup_skill(url) {
             
            var dialog_box_new = $("#dialog_popup");
                dialog_box_new.load(url);
                // open the dialog
                dialog_box_new.dialog({

            title: '{$translate.add_skill}',
            position: 'top',
            modal: true,
            minWidth: 420,
            resizable: false
            
        });
           skillLoad(); 
           return false;
        }
    function generate_password(){
        $("#pass").html('<span class="add-on icon-pencil"></span><input type="text" id="password" class="form-control span11" name="password" value ="{$pass}" >');
        //$('#send_mail_yes:radio').prop("checked", true).attr('checked', 'checked');
    }
    function trimNumber(s) {
        while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
        return s;
    }
    function trimMobileNumber(s) {
        while (s.substr(0,3) == '+46' && s.length>1) { s = s.substr(3,9999); }
        return s;
    }
    function removeCharas(s) {
        var i=0;
        var temp_mobile = '';
        while(i<s.length){
            if(s.substr(i,1) == " " || s.substr(i,1) == "." || s.substr(i,1) == "," || s.substr(i,1) == "-" || s.substr(i,1) == "_"){
                i++;
            }else{
                temp_mobile = temp_mobile+s.substr(i,1);
                i++;
            }
        }
        return temp_mobile;
    }

    function validate_email(email){ // function to validate email
        {literal}
        var email_regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
         return email_regex.test(email);

        {/literal}
    }
</script>

{/block}

{block name="content"}
<!-- {block name="employee_check_list"} {/block} -->
{if $access_flag == 1}
<div id="dialog-confirm" title="{$translate.confirm}" style="display:none; padding-top: 20px;padding-left: 13px;">
    <p><span class="error_msg_icon" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_save_changes}</p>
</div>
<div id="dialog-confirm_delete" title="{$translate.confirm}" style="display:none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_delete}</p>
</div>
<div class="clearfix" id="dialog_popup" style="display:none;"></div>
<div class="clearfix" id="dialog_hidden" style="display:none;"></div>
<div class="row-fluid">
    <div class="span12 main-left">
        <div style="margin: 15px 0px 0px ! important;" class="widget">
            <div class="widget-header span12">
                <div class="span6">
                    <h1>{$translate.employee_profile}</h1>
                </div>
                
                <div class="span6">
                    <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft btn-help" onclick="showHelp(this);">{$translate.employee_checklist}</a>
                </div>
                
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
            {if $employee_username != ""}
            <div class="widget option-panel-widget" style="margin: 0 !important;">
                <div class="widget-body">
                    <div class="row-fluid">
                        <div class="span4 top-customer-info"><strong>{$translate.social_security} : </strong>{if $employee_action eq 'EDIT'}{$employee_detail[0].social_security}{/if}</div>
                        <div class="span4 top-customer-info"><strong>{$translate.code} : </strong>{if $employee_action eq 'EDIT'}{$employee_detail[0].code}{/if}</div>
                        {if $sort_by_name == 2}
                        <div class="span4 top-customer-info"><strong>{$translate.name} : </strong>{if $employee_action eq 'EDIT'}{$employee_detail[0].last_name|cat: ' '|cat: $employee_detail[0].first_name}{/if}</div>
                        {elseif $sort_by_name == 1}
                        <div class="span4 top-customer-info"><strong>{$translate.name} : </strong>{if $employee_action eq 'EDIT'}{$employee_detail[0].first_name|cat: ' '|cat: $employee_detail[0].last_name}{/if}</div>
                        {/if}
                    </div>
                </div>
            </div>
            {/if}
            <div class="row-fluid">
                <div class="span12">
                    <div class="tab-content-switch-con {if $employee_username eq ""}no-mt{/if}" >
                        <div class="span12">
                            {if $employee_username neq ''}
                                {block name="employee_manage_tab_content"}{/block}
                            {/if}
                            <div class="widget-header widget-header-options tab-option">
                                <div class="span4 day-slot-wrpr-header-left span3">
                                    <h1>{$translate.employee_profile}</h1>
                                </div>
                                <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                    <button id = "btn_save" class="btn btn-default btn-normal pull-right ml" type="button" onclick="saveForm()" {if $employee_action == 'EDIT'}disabled="disabled"{/if}><span class="icon-save"></span> {$translate.save}</button>
                                    {if $employee_action == 'EDIT'}<button id = "btn_edit" class="btn btn-default btn-normal pull-right ml" type="button"><span class="icon-pencil"></span> {$translate.btn_edit_employee_personal}</button>{/if}
                                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="resetForm()"><span class="icon-refresh"></span> {$translate.reset}</button>
                                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm()"><span class="icon-arrow-left"></span> {$translate.backs}</button>
                                    {if $employee_username != ""}
                                    <button class="btn btn-default btn-normal pull-right" type="button" onclick="printForm()"><span class="icon-print"></span> {$translate.print}</button>
                                    {if $privilege_general.add_employee}<button class="btn btn-default btn-normal pull-right" type="button" onclick="addNewForm()"><span class="icon-plus"></span> {$translate.add_new_employee}</button>{/if}
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content-con">
                        <div class="tab-content span12 no-padding" style="margin:0;">
                            <div role="tabpanel" class="tab-pane active" id="tab-1">
                                {if $employee_username != ""}
                                <form id="formPrint" name="formPrint" method="post" target="blank">
                                    <input type="hidden" name="action" id="action" value="print" />
                                    <input type="hidden" name="print_user" id="print_user" value="{if $employee_action eq 'EDIT'}{$employee_detail[0].username}{/if}" />
                                </form>
                                {/if}
                                <form id="form" name="form" method="post" action="" style="float: left;">
                                    {*                                            <input type="hidden" name="work" id="work"  {if $employee_detail[0].works} value="{$employee_detail[0].works}" {else} value=""{/if}/>*}
                                    <input type="hidden" name="rand_pass" id="rand_pass"  value="{$pass}" />
                                    <input type="hidden" name="team" id="team"  value="{if isset($current_team[0]) and isset($current_team[0].id)}{$current_team[0].id}{/if}" />
                                    <input type="hidden" name="cur_team" id="cur_team" value="{if isset($current_team[0]) and isset($current_team[0].id)}{$current_team[0].id}{/if}" />
                                    <input type="hidden" name="user_id" id="user_id" value="{if $employee_action eq 'EDIT'}{$employee_detail[0].username}{/if}" />
                                    <input type="hidden" name="cur_role" id="cur_role" value="{$employee_role}" />
                                    <input type="hidden" name="global_check" id="global_check" value="0" />
                                    <input type="hidden" name="not_assign" id="not_assign" value="{$not_assign}" />
                                    <input type="hidden" name="assign" id="assign" value="{$assign}" />
                                    <input type="hidden" name="assign_emp" id="assign_emp" value="{$assign_emp}" />
                                    <input type="hidden" name="add_cust" id="add_cust" value="" />
                                    <input type="hidden" name="remove_cust" id="remove_cust" value="" />
                                    <input type="hidden" name="cust_username_team" id="cust_username_team" value="" />
                                    <input type="hidden" name="emp_username_team" id="emp_username_team" value="" />
                                    <input type="hidden" name="action_change" id="action_change" value="" />
                                    <input type="hidden" name="new" id="new" value="" />
                                    <input type="hidden" name="change_comp" id="change_comp" value="1" />
                                    <input type="hidden" name="role_val" id="role_val" value="" />
                                    <input type="hidden" name="role_change" id="role_change" value="" />
                                    <div class="tab-content span12 no-padding" style="margin:0;">
                                        <!--////////////////////////////////////////TAB 1 BEGIN///////////////////////////////////////////////-->
                                        <div style="" class="span12 widget-body-section input-group">
                                            <div class="row-fluid">
                                                {$message}
                                                <div id="error_error" style="color: white;"></div>
                                                <div id="error_pass" style="color: white;"></div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="row-fluid">
                                                    <div class="span6">
                                                        <!--PERSONAL INFORMATION BEGIN-->
                                                        <div class="span12">
                                                            <div class="widget" style="margin-top:0;">
                                                                <div class="widget-header span12">
                                                                    <h1>{$translate.personal_information}</h1>
                                                                </div>
                                                                <!--WIDGET BODY BEGIN-->
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="span6 form-left">
                                                                        <label style="float: left;" class="span12" for="social_security">{$translate.social_security}*</label>
                                                                        <div style="margin-left: 0px; float: left;">
                                                                            <div class="input-prepend span12 date-list">
                                                                                <span class="add-on icon-pencil"></span>
                                                                                <select class="form-control span3" name="century" id="century">
                                                                                    <option value="19" {if $employee_action eq 'EDIT' and $employee_detail[0].century == 19} selected="selected" {/if} >19</option>
                                                                                    <option value="20" {if $employee_action eq 'EDIT' and $employee_detail[0].century == 20} selected="selected" {/if} >20</option>
                                                                                </select>
                                                                                <input value="{if $employee_action eq 'EDIT'}{$employee_detail[0].social_security}{/if}" class="form-control span8" name="social_security" id="social_security" type="text" maxlength="11" onchange="makeChange()" style="margin-left: 2px;" required="true" />
                                                                                <input type="hidden" value="{if $social_security_check}1{/if}" id="social_flag" name="social_flag">
                                                                            </div>
                                                                            <div id="soc_sec" style="color: red"></div>
                                                                        </div>
                                                                        <div style="margin: 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="first_name">{$translate.first_name}*</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12">
                                                                                <span class="add-on icon-pencil"></span>
                                                                                <input value="{if $employee_action eq 'EDIT'}{$employee_detail[0].first_name}{/if}" class="form-control span11" name="first_name" id="first_name" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="last_name">{$translate.last_name}*</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12">
                                                                                <span class="add-on icon-pencil"></span>
                                                                                <input value="{if $employee_action eq 'EDIT'}{$employee_detail[0].last_name}{/if}" class="form-control span11" name="last_name" id="last_name" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="gender">{$translate.gender}</label>
                                                                            <ol class="radio-group">
                                                                                <li> <input  type="radio" name="gender" id="gender_male" {if $employee_action eq 'EDIT' and $employee_detail[0].gender == 1}checked="checked"{/if} value="1" onclick="makeChange()" />
                                                                                <label class="label-option-and-checkbox">{$translate.male}</label> </li>
                                                                                <li>  <input type="radio" name="gender" id="gender_female" {if $employee_action eq 'EDIT' and $employee_detail[0].gender == 2}checked="checked"{/if} value="2" onclick="makeChange()" />
                                                                                <label class="label-option-and-checkbox">{$translate.female}</label> </li>
                                                                            </ol>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="code">{$translate.code}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input {if $employee_action eq 'EDIT'} value="{$employee_detail[0].code}"{else} value="{$emp_code}"{/if} class="form-control span11" name="code" id="code" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="address">{$translate.address}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="{if $employee_action eq 'EDIT'}{$employee_detail[0].address}{/if}" class="form-control span11" name="address" id="address" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 32px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="care_of">{$translate.care_off}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="{if $employee_action eq 'EDIT'}{$employee_detail[0].care_of}{/if}" class="form-control span11" id="care_of" name="care_of" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <div class="span6 form-right">
                                                                        <div class="span12">
                                                                            <label style="float: left;" class="span12" for="post">{$translate.post}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="{if $employee_action eq 'EDIT'}{$employee_detail[0].post}{/if}" class="form-control span11" id="post" name="post" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="city">{$translate.city}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="{if $employee_action eq 'EDIT'}{$employee_detail[0].city}{/if}" class="form-control span11" id="city" name="city" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="phone">{$translate.phone}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="{if $employee_action eq 'EDIT'}{$employee_detail[0].phone}{/if}" class="form-control span11" id="phone" name="phone" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 0px 0;" class="span12">
                                                                            <label style="float: left;" class="span12" for="mobile">{$translate.mobile}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="{if $employee_action eq 'EDIT'}{$employee_detail[0].mobile}{/if}" class="form-control span11" id="mobile" name="mobile" maxlength="17" type="text" onchange="makeChange()" />
                                                                                <input type="hidden" value="1" id="mobile_flag" name="mobile_flag">
                                                                            </div>
                                                                            <div id="mobs" style="color: red"></div>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="email">{$translate.email}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="{if $employee_action eq 'EDIT'}{$employee_detail[0].email}{/if}" class="form-control span11" id="email" name="email" type="email" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 3px 0px 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="date">{$translate.date}</label>
                                                                            <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12 no-padding"> <span class="add-on icon-calendar"></span>
                                                                                <input value="{if $employee_action eq 'EDIT'}{$employee_detail[0].date}{else}{$today}{/if}" class="form-control span11" id="date" name="date" type="text" onchange="makeChange()" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin:15px 0 0 0;" class="span12">
                                                                            <label style="float: left;" class="span12" for="date_inactive">{$translate.date_inactive}</label>
                                                                            <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12 no-padding"> <span class="add-on icon-calendar"></span>
                                                                                <input value="{if $employee_action eq 'EDIT'}{$employee_detail[0].date_inactive}{/if}" class="form-control span11" id="date_inactive" name="date_inactive" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--PERSONAL INFORMATION END-->
                                                        
                                                        <div class="span12" style="margin:-11px 0 0 0;">
                                                            <div class="clearfix list_kunder list_customer" id="list_kunder" >
                                                                <div class="widget" style="margin-top:0;">
                                                                    <div class="widget-header span12">
                                                                        <div class="span6">
                                                                            <h1>{$translate.relax_customer_to_assistant}</h1>
                                                                        </div>
                                                                        <div class="span6" style="padding-top: 10px;">
                                                                            <span style="float:right; padding-right: 4px;"><input type="checkbox" name="office_personal" id="office_personal" value="1" {if $employee_action eq 'EDIT' and $employee_detail[0].office_personal == 1}checked="checked"{/if}></span>
                                                                            <span style="float:right; padding-right: 4px;">{$translate.office_personal}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span12 widget-body-section input-group" >
                                                                        {if $user_roles_login == 1 || $user_roles_login == 6}
                                                                        <div class="span6" style="margin-top:-10px">
                                                                            <div class="widget-body table-1">
                                                                                <div class="table-head-min">
                                                                                    <h1>{$translate.all_customers}</h1>
                                                                                </div>
                                                                                <div class="div-height-fix" style="height: 270px;">
                                                                                    <div id="nwoekers_list">
                                                                                        {foreach $to_assign as $employee}
                                                                                        <div id="a{$employee.username}" class="span12 nwoekers_list_entry child-slots-profile" data-username="{$employee.username}">
                                                                                            {if $user_roles_login == 1 || $user_roles_login == 6}
                                                                                            <a href="javascript:void(0);" class="assign_link" onclick="assignCustomer('{$employee.username}', this);" title="{$translate.assign_customer}"><i class="glyphicons icon-plus pull-right remove-child-slots cursor_hand"></i></a>
                                                                                            {/if}
                                                                                            <span>
                                                                                                <span class="cursor_hand underline_link emp_name assign_link" onclick="navigatePage('{$url_path}month/gdschema/{$smarty.now|date_format:"%Y/%m"}/{$employee.username}/{$employee_username}/EMP_ADD/',1);">{if $sort_by_name == 1}{$employee.first_name|cat: ' '|cat: $employee.last_name}{elseif $sort_by_name == 2}{$employee.last_name|cat: ' '|cat: $employee.first_name}{/if}</span>
                                                                                                <span class="pull-right emp_code">{$employee.code}</span>
                                                                                                <span class="emp_role" data-old-role-val="3"></span>
                                                                                            </span>
                                                                                        </div>
                                                                                        {foreachelse}
                                                                                        <div id="no_data" class="span12 message no_emp_msg" >{$translate.no_data_available}</div>
                                                                                        {/foreach}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        {/if}
                                                                        <div class="span6" style="margin-top:-10px">
                                                                            <div class="widget-body table-1">
                                                                                <div class="table-head-min">
                                                                                    <h1>{$translate.attached_customers}</h1>
                                                                                </div>
                                                                                <div class="div-height-fix" style="height: 270px;">
                                                                                    <div id="tosave_workers">
                                                                                        {assign i 0}
                                                                                        {foreach $assigned as $customer}
                                                                                        {if $i == 0 && $customer.username == ""}
                                                                                        <div id="no_data" class="span12 message no_emp_msg">{$translate.no_data_available}</div>
                                                                                        {break}
                                                                                        {/if}
                                                                                        <div id="a{$customer.username}" class="span12 child-slots-profile-two attached_emp_entry" data-username="{$customer.username}">
                                                                                            {if $user_roles_login == 1 || $user_roles_login == 6}
                                                                                            <a href="javascript:void(0);" class="assign_link" onclick="removeCustomer('{$customer.username}', this);" style="float: right;" title="{$translate.remove_customer}"><span class="glyphicons icon-minus pull-right remove-child-slots cursor_hand"></span></a>
                                                                                            {/if}
                                                                                            <span>
                                                                                                <span class="cursor_hand underline_link emp_name_exact" onclick="navigatePage('{$url_path}month/gdschema/{$smarty.now|date_format:"%Y/%m"}/{$customer.username}/{$employee_username}/EMP_ADD/',1);">{if $sort_by_name == 1}{$customer.first_name} {$customer.last_name}{elseif $sort_by_name == 2}{$customer.last_name} {$customer.first_name}{/if}</span>
                                                                                                <span class="pull-right emp_code">{$customer.code}</span>
                                                                                            </span>
                                                                                            <span class="slots-position pull-right emp_role_name">
                                                                                                {if $customer.role == 3}
                                                                                                {if $user_roles == 2}
                                                                                                {if $user_roles_login == 1 || $user_roles_login == 6}
                                                                                                <a href="javascript:void(0);" class="maket2 assign_link" onclick="makeTl('{$employee_detail[0].username}','{$customer.username}', this);">{$translate.make_team_leader}</a>{/if}
                                                                                                {else if $user_roles == 7}
                                                                                                {if $user_roles_login == 1 || $user_roles_login == 6}
                                                                                                <a href="javascript:void(0);" class="maket2 assign_link" onclick="makeSTl('{$employee_detail[0].username}','{$customer.username}', this);">{$translate.make_super_team_leader}</a>{/if}
                                                                                                {else}
                                                                                                <span class="tl">{$translate.employee}</span>
                                                                                                {/if}
                                                                                                {else if $customer.role == 7}<span class="tl">{$translate.super_tl}</span>
                                                                                                {else if $customer.role == 2}<span class="tl">{$translate.tl}</span>
                                                                                                {/if}
                                                                                            </span>
                                                                                            <input type="hidden" name="team_cust_uname[]" value="{$customer.username}" />
                                                                                            <input type="hidden" name="team_cust_role[]" class="emp_role_val" value="{$customer.role}" />
                                                                                        </div>
                                                                                        {foreachelse}
                                                                                        <div id="no_data" class="span12 message no_emp_msg" >{$translate.no_data_available}</div>
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
                                                    <div class="span6">
                                                        <div class="widget" style="margin-top:0; margin-bottom: 12px !important;">
                                                            <div class="widget-header span12">
                                                                <h1>{$translate.color_code}</h1>
                                                            </div>
                                                            <!--WIDGET BODY BEGIN-->
                                                            <div class="span12 widget-body-section input-group">
                                                                <input id="color_code" name="color_code" value="{$color_code}" class="sp-replacer sp-light full-spectrum" type="hidden" />
                                                            </div>
                                                        </div>
                                                        <div class="span12" style="margin:2px 0 0 0;">
                                                            <div class="span6">
                                                                <div class="span12 widget-header">
                                                                    <h1>{$translate.account_information}</h1>
                                                                </div>
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="span12 form-left">
                                                                        <div style="margin: 0 0 10px 0 !important;" class="span12">
                                                                            <label style="float: left;" class="span12" for="username">{$translate.username}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="{$employee_detail[0].username}" class="form-control span11" id="username" name="username" readonly="readonly" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 0px 0px 10px 0 !important;" class="span12">
                                                                            <label style="float: left;" class="span12" for="password">{$translate.password}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12">
                                                                                <div id="pass"><button type="button" onclick="generate_password()" id="password" name="password" class="btn btn-default btn-normal" onchange="makeChange()" value="{$translate.generate_password}">{$translate.generate_password}</button></div>
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: -4px 0 0 0" class="span12">
                                                                            <label style="float: left;" class="span12" for="status">{$translate.status}</label>
                                                                            <ol class="radio-group">
                                                                                <li>
                                                                                    <input  type="radio"  name="status" id="status" {if $employee_detail[0].status == '1'}checked="checked"{else} checked="checked" {/if} value="1" onclick="giveActivation()" />
                                                                                    <label class="label-option-and-checkbox">{$translate.active}</label>
                                                                                </li>
                                                                                <li>  
                                                                                    <input  type="radio" name="status"  id="status"  {if $employee_detail[0].status == '0'}checked="checked" {/if} value="0" onclick="giveDeactivation()" />
                                                                                    <label class="label-option-and-checkbox">{$translate.inactive}</label>
                                                                                </li>
                                                                            </ol>
                                                                        </div>
                                                                        {* <div style="margin: 10px 0px 0px;" class="span12">
                                                                        <label style="float: left;" class="span12" for="send_mail">{$translate.send_mail}</label>
                                                                        <ol class="radio-group">
                                                                            <li>
                                                                                <input  type="radio" name="send_mail" id="send_mail_yes"  value="1" onclick="makeChange()" />
                                                                                <label class="label-option-and-checkbox">{$translate.yes}</label></li>
                                                                                <li><input  type="radio" name="send_mail"  id="send_mail_no" checked="checked" value="0" onclick="makeChange()" />
                                                                                <label class="label-option-and-checkbox">{$translate.no}</label> </li>
                                                                            </ol>
                                                                        </div>    *}
                                                                        <div style="margin:14px 0 0 0 !important" class="span12">
                                                                            <label style="float: left;" class="span12" for="role">{$translate.role}</label>
                                                                            <div style="margin: 0px; float: left;" class="input-prepend span12">
                                                                                <span class="add-on icon-pencil"></span>
                                                                                {if $user_roles_login == 1}
                                                                                <select class="form-control span11" name="role" id="role" onchange="makeChange()">
                                                                                    <option value="">{$translate.select_role}</option>
                                                                                    <option value="1" {if $employee_role == '1'} selected="selected" {/if}>{$translate.admin}</option>
                                                                                    <option value="2" {if $employee_role == '2'} selected="selected" {/if}>{$translate.tl}</option>
                                                                                    <option value="3" {if $employee_role == '3'} selected="selected" {/if}>{$translate.employee}</option>
                                                                                    <option value="6" {if $employee_role == '6'} selected="selected" {/if}>{$translate.economy}</option>
                                                                                    <option value="7" {if $employee_role == '7'} selected="selected" {/if}>{$translate.super_tl}</option>
                                                                                </select>
                                                                                {else if $user_roles_login == 2}
                                                                                <select {if $selected_employee_role eq 1 or $selected_employee_role eq 7} disabled {/if} class="form-control span11" name="role" id="role" onchange="makeChange()">
                                                                                    <option value="">{$translate.select_role}</option>
                                                                                    {if $selected_employee_role eq 1}<option value="1" {if $employee_role == '1'} selected="selected" {/if}>{$translate.admin}</option>{/if}
                                                                                    {if $selected_employee_role eq 7}<option value="7" {if $employee_role == '7'} selected="selected" {/if}>{$translate.super_tl}</option>{/if}
                                                                                    <option value="2" {if $employee_role == '2'} selected="selected" {/if}>{$translate.tl}</option>
                                                                                    <option value="3" {if $employee_role == '3'} selected="selected" {/if}>{$translate.employee}</option>
                                                                                    <option value="6" {if $employee_role == '6'} selected="selected" {/if}>{$translate.economy}</option>
                                                                                </select>
                                                                                {else if $user_roles_login == 3}
                                                                                <select  {if $selected_employee_role eq 1 or $selected_employee_role eq 7 or $selected_employee_role eq 2} disabled {/if} class="form-control span11" name="role" id="role" onchange="makeChange()">
                                                                                    <option value="">{$translate.select_role}</option>
                                                                                    {if $selected_employee_role eq 1}<option value="1" {if $employee_role == '1'} selected="selected" {/if}>{$translate.admin}</option>{/if}
                                                                                    {if $selected_employee_role eq 7}<option value="7" {if $employee_role == '7'} selected="selected" {/if}>{$translate.super_tl}</option>{/if}
                                                                                    {if $selected_employee_role eq 2}<option value="2" {if $employee_role == '2'} selected="selected" {/if}>{$translate.tl}</option>{/if}
                                                                                    <option value="3" {if $employee_role == '3'} selected="selected" {/if}>{$translate.employee}</option>
                                                                                </select>
                                                                                {else if $user_roles_login == 6}
                                                                                <select class="form-control span11" name="role" id="role" onchange="makeChange()">
                                                                                    <option value="2" {if $employee_role == '2'} selected="selected" {/if}>{$translate.tl}</option>
                                                                                    <option value="3" {if $employee_role == '3'} selected="selected" {/if}>{$translate.employee}</option>
                                                                                    <option value="6" {if $employee_role == '6'} selected="selected" {/if}>{$translate.economy}</option>
                                                                                    <option value="7" {if $employee_role == '7'} selected="selected" {/if}>{$translate.super_tl}</option>
                                                                                </select>
                                                                                {else if $user_roles_login == 7}
                                                                                    <select {if $selected_employee_role eq 1} disabled {/if} class="form-control span11" name="role" id="role" onchange="makeChange()">
                                                                                        <option value="">{$translate.select_role}</option>
                                                                                        {if $selected_employee_role eq 1}<option value="1" {if $employee_role == '1'} selected="selected" {/if}>{$translate.admin}</option>{/if}
                                                                                        <option value="2" {if $employee_role == '2'} selected="selected" {/if}>{$translate.tl}</option>
                                                                                        <option value="3" {if $employee_role == '3'} selected="selected" {/if}>{$translate.employee}</option>
                                                                                        <option value="6" {if $employee_role == '6'} selected="selected" {/if}>{$translate.economy}</option>
                                                                                        <option value="7" {if $employee_role == '7'} selected="selected" {/if}>{$translate.super_tl}</option>
                                                                                    </select>
                                                                                {else}
                                                                                <select class="form-control span11" name="role" id="role" onchange="makeChange()" onclick="alert('Cannot Change ');" disabled="TRUE">
                                                                                    <option value="">{$translate.select_role}</option>
                                                                                    <option value="1" {if $employee_role == '1'} selected="selected" {/if}>{$translate.admin}</option>
                                                                                    <option value="2" {if $employee_role == '2'} selected="selected" {/if}>{$translate.tl}</option>
                                                                                    <option value="3" {if $employee_role == '3'} selected="selected" {/if}>{$translate.employee}</option>
                                                                                    <option value="6" {if $employee_role == '6'} selected="selected" {/if}>{$translate.economy}</option>
                                                                                    <option value="7" {if $employee_role == '7'} selected="selected" {/if}>{$translate.super_tl}</option>
                                                                                </select>
                                                                                {/if}
                                                                            </div>
                                                                            <div id="role_error" style="color: red"></div>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 39px 0px !important;" class="span6">
                                                                            <label style="float: left;" class="span12">{$translate.substitute}</label>
                                                                            <div class="btn-group btn-toggle" style="float: left;" purpose="substitute">
                                                                                <button type="button" class="btn {if $employee_detail[0].substitute ne 1}active btn-primary{else} btn-default{/if}" value="OFF">{$translate.off}</button>
                                                                                <button type="button" class="btn {if $employee_detail[0].substitute eq 1}active btn-primary{else} btn-default{/if}" value="ON">{$translate.on}</button>
                                                                                <input type="hidden" value="{$employee_detail[0].substitute}" id="substitute_fn" name="substitute">
                                                                            </div>
                                                                        </div>
                                                                        {if $company_detail.inconvenient_on eq 1}
                                                                            <div style="margin: 10px 0px 29px 0px !important;" class="span6">
                                                                                <label style="float: left;" class="span12">{$translate.use_inconvenient}</label>
                                                                                <div class="btn-group btn-toggle" style="float: left;" purpose="inconvenient_on">
                                                                                    <button type="button" class="btn {if $employee_detail[0].inconvenient_on == 0 && $employee_detail[0].inconvenient_on != ''}active btn-primary{else} btn-default{/if}" value="OFF">{$translate.off}</button>
                                                                                    <button type="button" class="btn {if $employee_detail[0].inconvenient_on == 1 || $employee_detail[0].inconvenient_on == ''}active btn-primary{else} btn-default{/if}" value="ON">{$translate.on}</button>
                                                                                    <input type="hidden" value="{if $employee_detail[0].inconvenient_on == ''}1{else}{$employee_detail[0].inconvenient_on}{/if}" id="chk_inconvenient_on" name="chk_inconvenient_on"/>
                                                                                </div>
                                                                            </div>
                                                                        {/if}
                                                                         <div  class="span6" style="float: none;">
                                                                            <label style="float: left;" class="span12">{$translate.candg_follow}</label>
                                                                            <div class="btn-group btn-toggle" style="float: left;" purpose="candg_follow">
                                                                                <button type="button" class="btn {if $employee_detail[0].candg_follow ne 1}active btn-primary{else} btn-default{/if}" value="OFF">{$translate.off}</button>
                                                                                <button type="button" class="btn {if $employee_detail[0].candg_follow eq 1}active btn-primary{else} btn-default{/if}" value="ON">{$translate.on}</button>
                                                                                <input type="hidden" value="{$employee_detail[0].candg_follow}" id="candg_follow" name="candg_follow">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="span6">
                                                                <div class="span12 widget-header">
                                                                    <h1>{$translate.other_employee_information}</h1>
                                                                </div>
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="span12 form-left">
                                                                        <div class="" style="margin: 0px;">
                                                                            <label style="float: left; " class="span12" for="max_hours">{$translate.employee_max_hours}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="{if $employee_detail[0].max_hours gt 0}{$employee_detail[0].max_hours}{/if}" maxlength="5" class="form-control span11" name="max_hours" id="max_hours"  type="text" />
                                                                            </div>
                                                                        </div>
                                                                        <span style="float: left; margin: -10px 0 0 0;" class="input-tips">({$translate.max_15_hours})</span>
                                                                        <div style="margin: 10px 0px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="remaining_sem_leave">{$translate.remaining_sem_leave}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input value="{$employee_detail[0].remaining_sem_leave}" maxlength="17" class="form-control span11"  id="remaining_sem_leave" name="remaining_sem_leave" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 0px 0px 10px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="sem_leave_todate">{$translate.sem_leave_todate}</label>
                                                                            <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12 no-padding"> <span class="add-on icon-calendar"></span>
                                                                                <input {if $employee_detail[0].sem_leave_todate != '0000-00-00'}value="{$employee_detail[0].sem_leave_todate}"{else}value=""{/if} class="form-control span11" id="sem_leave_todate" name="sem_leave_todate" type="text" />
                                                                            </div>
                                                                        </div>
                                                                        {* {if $company_detail.inconvenient_on eq 0}*}
                                                                        <div style="margin: 0px 0px 10px;" class="span12">
                                                                            <label style="float: left;margin-right: 7px;" for="leave_in_advance">{$translate.leave_in_advance}</label>
                                                                            <input type="checkbox" value="1" id="leave_in_advance" name="leave_in_advance" {if $employee_detail[0].leave_in_advance == 1}checked="checked"{/if} style="width: auto;" title="{$translate.tooltip_leave_in_advance_employee}" />
                                                                        </div>
                                                                        {* {/if}*}
                                                                        <div style="margin: 0px 0px 10px;" class="span12">
                                                                            <label style="float: left;" class="span12" for="txt_ice">{$translate.ice}</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12">
                                                                                <textarea class="form-control span12" id="txt_ice" name="txt_ice">{$employee_detail[0].ice}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="span12" style="margin:12px 0 0 0;">
                                                            <div style="margin: 0px 0 15px 0 ! important;" class="widget">
                                                                <div class="widget-header span12">
                                                                    <h1>{$translate.working_hours_calculation}</h1>
                                                                </div>
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="span12 form-left">
                                                                        <div class="span6 widget-body-section input-group" >
                                                                            <div class="span12">
                                                                            <label style="float: left;" class="span12" for="contract_start_month">{$translate.employee_contract_start_month}</label>
                                                                            <div class="input-prepend span7" style="margin-left: 0px; float: left;"> <span class="add-on icon-pencil"></span>
                                                                                <select class="form-control span10" id="contract_start_month" name="contract_start_month">
                                                                                    <option value="" >{$translate.select}</option>
                                                                                    <option value="01" {if  $employee_detail[0].employee_contract_start_month == 1} selected = "selected" {/if} >{$translate.january}</option>
                                                                                    <option value="02" {if  $employee_detail[0].employee_contract_start_month == 2} selected = "selected" {/if}>{$translate.february}</option>
                                                                                    <option value="03" {if  $employee_detail[0].employee_contract_start_month == 3} selected = "selected" {/if}>{$translate.march}</option>
                                                                                    <option value="04" {if  $employee_detail[0].employee_contract_start_month == 4} selected = "selected" {/if}>{$translate.april}</option>
                                                                                    <option value="05" {if  $employee_detail[0].employee_contract_start_month == 5} selected = "selected" {/if}>{$translate.may}</option>
                                                                                    <option value="06" {if  $employee_detail[0].employee_contract_start_month == 6} selected = "selected" {/if}>{$translate.june}</option>
                                                                                    <option value="07" {if  $employee_detail[0].employee_contract_start_month == 7} selected = "selected" {/if}>{$translate.july}</option>
                                                                                    <option value="08" {if  $employee_detail[0].employee_contract_start_month == 8} selected = "selected" {/if}>{$translate.august}</option>
                                                                                    <option value="09" {if  $employee_detail[0].employee_contract_start_month == 9} selected = "selected" {/if}>{$translate.september}</option>
                                                                                    <option value="10" {if  $employee_detail[0].employee_contract_start_month == 10} selected = "selected" {/if}>{$translate.october}</option>
                                                                                    <option value="11" {if  $employee_detail[0].employee_contract_start_month == 11} selected = "selected" {/if}>{$translate.november}</option>
                                                                                    <option value="12" {if  $employee_detail[0].employee_contract_start_month == 12} selected = "selected" {/if}>{$translate.december}</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="input-prepend span5" style="margin-left: 0px; float: left;"> <span class="add-on icon-pencil"></span>
                                                                                <select class="form-control span10" id="contract_month_start_date" name="contract_month_start_date">
                                                                                    {for $month_date=1 to 31}
                                                                                        <option value="{$month_date}" {if  $employee_detail[0].employee_contract_period_date eq $month_date} selected = "selected" {/if} >{$month_date}</option>
                                                                                    {/for}
                                                                                </select>
                                                                            </div>
                                                                            </div>
                                                                            <div class="span12" style="margin:10px 0 0 0;"> 
                                                                                <label style="float: left;" class="span12" for="emp_contract_period_length">{$translate.employee_contract_period_length}</label>
                                                                            <div style="margin-left: 0px; float: left;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <select class="form-control span11" id="emp_contract_period_length" name="emp_contract_period_length">
                                                                                    <option value="" >{$translate.select}</option>
                                                                                    <option value="01" {if $employee_detail[0].employee_contract_period_length eq 1} selected = "selected" {/if}>1</option>
                                                                                    <option value="02" {if $employee_detail[0].employee_contract_period_length eq 2} selected = "selected" {/if}>2</option>
                                                                                    <option value="03" {if $employee_detail[0].employee_contract_period_length eq 3} selected = "selected" {/if}>3</option>
                                                                                    <option value="04" {if $employee_detail[0].employee_contract_period_length eq 4} selected = "selected" {/if}>4</option>
                                                                                    <option value="04" {if $employee_detail[0].employee_contract_period_length eq 5} selected = "selected" {/if}>5</option>
                                                                                    <option value="06" {if $employee_detail[0].employee_contract_period_length eq 6} selected = "selected" {/if}>6</option>
                                                                                    <option value="06" {if $employee_detail[0].employee_contract_period_length eq 7} selected = "selected" {/if}>7</option>
                                                                                    <option value="06" {if $employee_detail[0].employee_contract_period_length eq 8} selected = "selected" {/if}>8</option>
                                                                                    <option value="06" {if $employee_detail[0].employee_contract_period_length eq 9} selected = "selected" {/if}>9</option>
                                                                                    <option value="06" {if $employee_detail[0].employee_contract_period_length eq 10} selected = "selected" {/if}>10</option>
                                                                                    <option value="06" {if $employee_detail[0].employee_contract_period_length eq 11} selected = "selected" {/if}>11</option>
                                                                                    <option value="12" {if $employee_detail[0].employee_contract_period_length eq 12} selected = "selected" {/if}>12</option>
                                                                                </select>
                                                                            </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="span6 pull-right widget-body-section input-group">
                                                                            <div class="span12">
                                                                                <label style="float: left;" class="span12" for="start_day">{$translate.start_day}</label>
                                                                                <div style="margin-left: 0px; float: left;" class="input-prepend span11">
                                                                                    <span class="add-on icon-pencil"></span>
                                                                                    <select class="form-control span12" onchange="makeChange()" name="start_day" id="start_day">
                                                                                        <option value="1" {if $vals[0] == 1}selected="selected"{/if}>{$translate.monday}</option>
                                                                                        <option value="2" {if $vals[0] == 2}selected="selected"{/if}>{$translate.tuesday}</option>
                                                                                        <option value="3" {if $vals[0] == 3}selected="selected"{/if}>{$translate.wednesday}</option>
                                                                                        <option value="4" {if $vals[0] == 4}selected="selected"{/if}>{$translate.thursday}</option>
                                                                                        <option value="5" {if $vals[0] == 5}selected="selected"{/if}>{$translate.friday}</option>
                                                                                        <option value="6" {if $vals[0] == 6}selected="selected"{/if}>{$translate.saturday}</option>
                                                                                        <option value="7" {if $vals[0] == 7}selected="selected"{/if}>{$translate.sunday}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div style="margin:  10px 0 0 0;" class="span12">
                                                                                <label style="float: left;" class="span12" for="start_time">{$translate.start_time}</label>
                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-time"></span>
                                                                                    <input value="{$vals[1]}" class="form-control span11" id="start_time" name="start_time" type="text" onchange="makeChange()" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div><!--WIDGET BODY END-->
                                                            </div>
                                                        </div>
                                                        <div class="span12" style="margin:0;">
                                                            <div class="span6">
                                                                <div class="span12 widget-header" style="margin-left: 0px;">
                                                                    <h1>{$translate.export_information}</h1>
                                                                </div>
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="span12 form-left">
                                                                        <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                                                            <label style="float: left;" class="span12">{$translate.SEM_in_days}</label>
                                                                            <div class="btn-group btn-toggle" style="float: left;" purpose="sem_leave_days">
                                                                                <button type="button" class="btn {if $employee_detail[0].sem_leave_days ne 1}active btn-primary{else} btn-default{/if}" value="OFF">{$translate.off}</button>
                                                                                <button type="button" class="btn {if $employee_detail[0].sem_leave_days eq 1}active btn-primary{else} btn-default{/if}" value="ON">{$translate.on}</button>
                                                                                <input type="hidden" value="{$employee_detail[0].sem_leave_days}" id="sem_leave_days" name="sem_leave_days">
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                                                            <label style="float: left;" class="span12">{$translate.VAB_in_days}</label>
                                                                            <div class="btn-group btn-toggle" style="float: left;" purpose="vab_leave_days">
                                                                                <button type="button" class="btn {if $employee_detail[0].vab_leave_days ne 1}active btn-primary{else} btn-default{/if}" value="OFF">{$translate.off}</button>
                                                                                <button type="button" class="btn {if $employee_detail[0].vab_leave_days eq 1}active btn-primary{else} btn-default{/if}" value="ON">{$translate.on}</button>
                                                                                <input type="hidden" value="{$employee_detail[0].vab_leave_days}" id="vab_leave_days" name="vab_leave_days">
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                                                            <label style="float: left;" class="span12">{$translate.FP_in_days}</label>
                                                                            <div class="btn-group btn-toggle" style="float: left;" purpose="fp_leave_days">
                                                                                <button type="button" class="btn {if $employee_detail[0].fp_leave_days ne 1}active btn-primary{else} btn-default{/if}" value="OFF">{$translate.off}</button>
                                                                                <button type="button" class="btn {if $employee_detail[0].fp_leave_days eq 1}active btn-primary{else} btn-default{/if}" value="ON">{$translate.on}</button>
                                                                                <input type="hidden" value="{$employee_detail[0].fp_leave_days}" id="fp_leave_days" name="fp_leave_days">
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 15px 0px 10px 0px !important;" class="span6">
                                                                            <label style="float: left;" class="span12">{$translate.NOPAY_in_days}</label>
                                                                            <div class="btn-group btn-toggle" style="float: left;" purpose="nopay_leave_days">
                                                                                <button type="button" class="btn {if $employee_detail[0].nopay_leave_days ne 1}active btn-primary{else} btn-default{/if}" value="OFF">{$translate.off}</button>
                                                                                <button type="button" class="btn {if $employee_detail[0].nopay_leave_days eq 1}active btn-primary{else} btn-default{/if}" value="ON">{$translate.on}</button>
                                                                                <input type="hidden" value="{$employee_detail[0].nopay_leave_days}" id="nopay_leave_days" name="nopay_leave_days">
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 15px 0px 8px 0px !important;" class="span6">
                                                                            <label style="float: left;" class="span12">{$translate.OTHER_in_days}</label>
                                                                            <div class="btn-group btn-toggle" style="float: left;" purpose="other_leave_days">
                                                                                <button type="button" class="btn {if $employee_detail[0].other_leave_days ne 1}active btn-primary{else} btn-default{/if}" value="OFF">{$translate.off}</button>
                                                                                <button type="button" class="btn {if $employee_detail[0].other_leave_days eq 1}active btn-primary{else} btn-default{/if}" value="ON">{$translate.on}</button>
                                                                                <input type="hidden" value="{$employee_detail[0].other_leave_days}" id="other_leave_days" name="other_leave_days">
                                                                            </div>
                                                                        </div>

                                                                         

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="span6">
                                                                <div class="span12 widget-header">
                                                                    <h1>{$translate.employee_salary_type}</h1>
                                                                </div>
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="span12 form-left">
                                                                        <ol class="radio-group">
                                                                            <li style="margin-right: 0px; float: none;"><input  type="radio" name="salary_type"  value="1" checked="checked" onclick="makeChange()" />
                                                                                <label class="label-option-and-checkbox">{$translate.employee_salary_hour_saving_holiday}</label></li>
                                                                                <br>
                                                                            <li style="margin-top: 10px;margin-right: 0px; float: none;"><input  type="radio" name="salary_type" {if $employee_detail[0].salary_type == 2 || ($employee_username == '' && $employee_detail[0].salary_type == '' && $company_id == 8)}checked="checked"{/if} value="2" />
                                                                                <label class="label-option-and-checkbox">{$translate.employee_salary_hour_paid_vacation}</label> </li>
                                                                                <br>
                                                                            <li style="margin-top: 10px;margin-right: 0px;float: none;"><input  type="radio" name="salary_type" {if $employee_detail[0].salary_type == 3}checked="checked"{/if} value="3"  />
                                                                                <label class="label-option-and-checkbox">{$translate.employee_salary_monthly}</label> </li>
                                                                                <br>
                                                                            <li style="margin-top: 10px;margin-right: 0px;float: none;"><input  type="radio" name="salary_type" {if $employee_detail[0].salary_type == 4}checked="checked"{/if} value="4" />
                                                                                <label class="label-option-and-checkbox">{$translate.employee_salary_monthly_office}</label> </li>
                                                                                <br>
                                                                            <li style="margin-top: 10px;margin-right: 0px;float: none;"><input  type="radio" name="salary_type" {if $employee_detail[0].salary_type == 5}checked="checked"{/if} value="5" />
                                                                                <label class="label-option-and-checkbox">{$translate.employee_salary_hour_office}</label> </li>
                                                                                <br>
                                                                            <li style="margin-top: 10px;margin-right: 0px;float: none;"><input  type="radio" name="salary_type" {if $employee_detail[0].salary_type == 6}checked="checked"{/if} value="6" />
                                                                                <label class="label-option-and-checkbox">{$translate.employee_salary_type_6}</label> </li>
                                                                        </ol>
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
                        {else}
                            <div class="message fail">{$translate.permission_denied}</div>
                        {/if}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{/block}