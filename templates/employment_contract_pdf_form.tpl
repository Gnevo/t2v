{block name='style'}
{* <link rel="stylesheet" type="text/css" href="{$url_path}css/em_con.css" />*}
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
{/block}

{block name='script'}
<script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript">
    $(document).ready(function (){
         
        if($(window).height() > 600)
            $('.tab-content-con').css({ height: $(window).height()-271});
        else
            $('.tab-content-con').css({ height: $(window).height()});
         
         
        $(".side_links li a").click(function(event){
            event.preventDefault();
            var href_val = $(this).attr('href');
            
            var new_var = $("#new").val();
            if(new_var == "1"){
                $( "#dialog-confirm" ).dialog({
                    resizable: false,
                    height:140,
                    modal: true,
                    buttons: {
                        "{$translate.yes}": function() {
                                $( this ).dialog( "close" );
                                saveForm();
                            },
                            "{$translate.no}": function() {
                                    $( this ).dialog( "close" );
                                    document.location.href = href_val;
                            }
                        }
                });
            }
            else{
                document.location.href = href_val;
            }
         });
         $(".datepicker").datepicker({
                autoclose: true,
                weekStart: 1,
                calendarWeeks: true, 
                language: '{$lang}'
        });
        
        $('#chkArbetstidHeltid').click(function() { 
            var checked = $(this).attr('checked', true);
            if(checked){ 
                $('#txtArbetstidDeltidTim').val('');
                $('#txtArbetstidDeltidMin').val('');
                $("#txtArbetstidDeltidTim").removeClass("error");
                $("#txtArbetstidDeltidMin").removeClass("error");
            }
        });
        $('#chkArbetstidDeltid').click(function() { 
            var checked = $(this).attr('checked', true);
            if(checked){ 
                $('#normal_week_hr').val('');
                $('#oncall_hr').val('');
                $("#normal_week_hr").removeClass("error");
                $("#oncall_hr").removeClass("error");
            }
        });

        {if $date_from neq '' and $contracts.employmentType eq 2}
            $('input[type=radio][name=work_type]').uncheckableRadio();
        {/if}

        $(document).off('keyup', "#txtArbetstidLonPerManad, #txtArbetstidLonPerTimme")
            .on('keyup', "#txtArbetstidLonPerManad, #txtArbetstidLonPerTimme", function(e) {
                    // get keycode of current keypress event
                    var code = (e.keyCode || e.which);
                    //console.log(code);
                    

                    // do nothing if it's an arrow key  || (code >=65 && code <= 90)
                    if(code == 37 || code == 38 || code == 39 || code == 40) {
                        return;
                    }
                    var this_val = $(this).val();
                    var new_val = this_val.replace(/[^0-9.,]+/g,'').replace(/,/g,".");
                    $(this).val(new_val);
                    /*$(this).val($(this).val().replace(/[^0-9.,]+/g,''));
                    $(this).val($(this).val().replace(/,/g,"."));*/
        });
            
        // if({$count_of_dates} == 0){
        //         window.location.href = "{$url_path}employment/contract/pdf/{$employee_username}/new/"
        // }

    });

    // window.onload = function() {
    //     // similar behavior as clicking on a link
    //     window.location.href = "http://stackoverflow.com";
    // }
		
    $(function() {
		var availableTags1 = [
                        {foreach from=$customers item=customer}
                            {if $sort_by_name == 1}
                                "{$customer.first_name} {$customer.last_name}",    
                            {elseif $sort_by_name == 2}
                                "{$customer.last_name} {$customer.first_name}",    
                            {/if}
                               
                        {/foreach}
		];
               
                
		$( "#txtnamn" ).autocomplete({
                            source: availableTags1,
                            open: function(event, ui) { 
                                            $("#hiden_val").val(1);        
                                    },
                            close: function(event, ui) { 
                                            $("#hiden_val").val(0);
                                    },
                            focus:function(event, ui ){
                                            $("#txtnamn").val(ui.item.item);
                                    }
		});
    });
           
    function removeSign(id){
        $('#action').val('unsign');
        $('#forms').submit();
    }

    function saveForm(){
        var error = 0;
        var j =0 ;
        //var social_flag = $("#social_flag").val();
        var social = $("#txtpersonalnummer").val();
        $('#action').val('save');
        $('#forms').attr('target','_self');
       /* if(social == ""){
            $("#txtpersonalnummer").addClass("error");
            error = 1;
        }*/
        var value1 = $("input:radio[name=assistanceChecked]:checked").val();
        var value = $("input:radio[name=assistance]:checked").val();

        var customer_value = $("input:radio[name=customer_group]:checked").val();

        if (typeof customer_value == 'undefined' || customer_value == ''){
             error = 1;
             alert('{$translate.select_a_customer}');
             
        }
       
        /*if(value1 == 1){
            var from_month = $("#txtAnstFormVisstidFrom").val();
            {*var to_month = $("#txtAnstFormVisstidTom").val();*}
            if(from_month == ""){
                $("#txtAnstFormVisstidFrom").addClass("error");
                $("#txtAnstFormProvanstallningFrom").removeClass("error");
                $("#txtOverenskommelseBefDatum").removeClass("error");
                error = 1;
            }
            {*if(to_month == ""){
                $("#txtAnstFormVisstidTom").addClass("error");
                $("#txtAnstFormProvanstallningTom").removeClass("error");
                $("#to_date").removeClass("error");
                error = 1;
            }*}
        }*/
        /*if(value == 2){
            var from_month = $("#txtAnstFormProvanstallningFrom").val();
            {*var to_month = $("#txtAnstFormProvanstallningTom").val();*}
            if(from_month == ""){
                $("#txtAnstFormVisstidFrom").removeClass("error");
                $("#txtAnstFormProvanstallningFrom").addClass("error");
                $("#txtOverenskommelseBefDatum").removeClass("error");
                error = 1;
            }
            {*if(to_month == ""){
                $("#txtAnstFormVisstidTom").removeClass("error");
                $("#txtAnstFormProvanstallningTom").addClass("error");
                $("#to_date").removeClass("error");
                error = 1;
            }*}
        }
        else{
            var from_month = $("#txtOverenskommelseBefDatum").val();
            {*var to_month = $("#to_date").val();*}
            if(from_month == ""){
                $("#txtAnstFormVisstidFrom").removeClass("error");
                $("#txtAnstFormProvanstallningFrom").removeClass("error");
                $("#txtOverenskommelseBefDatum").addClass("error");
                error = 1;
            }
            {*if(to_month == ""){
                $("#txtAnstFormVisstidTom").removeClass("error");
                $("#txtAnstFormProvanstallningTom").removeClass("error");
                $("#to_date").addClass("error");
                error = 1;
            }*}
        }*/
        if ($('#social_flag').val() == '1'){
             j=1;
             error = 1;
        }
        var val = $('input:radio[name=work_type]:checked').val();
        if(val == 1){
            /*if($("#normal_week_hr").val() == ''){
                $("#normal_week_hr").addClass("error");
                error = 1;
            }else{
                $("#normal_week_hr").removeClass("error");
                // error = 0;
            }*/
            /*if($("#oncall_hr").val() == '' || $("#oncall_hr").val() =='0.00'){
                $("#oncall_hr").addClass("error");
                error = 1;
            }else{
                $("#oncall_hr").removeClass("error");
                error = 0;
            }*/
        }
         /*if(val == 2){
            if($("#txtArbetstidDeltidTim").val() == ''){
                $("#txtArbetstidDeltidTim").addClass("error");
                error = 1;
            } else {
             $("#txtArbetstidDeltidTim").removeClass("error");
                error = 0;
            }
            if($("#txtArbetstidDeltidMin").val() == ''){
                $("#txtArbetstidDeltidMin").addClass("error");
                error = 1;
            } else {
             $("#txtArbetstidDeltidMin").removeClass("error");
                error = 0;
            }
        }*/


        if(error == 0 && (val == '' || typeof val === 'undefined') && value != 2){
            error = 1;
            alert('{$translate.select_working_hours}');
        }
        
        
        //social_flag = $("#social_flag").val();
        if(error == 0){
           $('#forms').submit();
        }
    }
    function printForm(){
        $('#action').val('print');
        $('#forms').attr('target','_blank');
        $('#forms').submit();
    }

    function newContract(){
        document.location.href = "{$url_path}employment/contract/pdf/{$employee_username}/new/";
    }

    function load_documentation(){               
        document.location.href = "{$url_path}employment/contract/pdf/{$employee_username}/"+$('#date').val()+"/";
    }


    function redirectConfirm(mode){
        var change = $("#new").val();
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
                $( "#dialog-confirm" ).dialog({
                    resizable: false,
                    height:140,
                    modal: true,
                    buttons: {
                        "{$translate.yes}": function() {
                                $( this ).dialog( "close" );
                                saveForm();
                            },
                            "{$translate.no}": function() {
                                    $( this ).dialog( "close" );
                                    document.location.href = "{$url_path}employee/add/{if isset($employee_username)}{$employee_username}/{/if}";
                            }
                        }
                });
            }
            else{
                document.location.href = "{$url_path}employee/add/{if isset($employee_username)}{$employee_username}/{/if}";
            }
    }

    function loadContract(){
        var change = $("#new").val();
        if(change == "1"){
                $( "#dialog-confirm" ).dialog({
                    resizable: false,
                    height:140,
                    modal: true,
                    buttons: {
                        "{$translate.yes}": function() {
                                $( this ).dialog( "close" );
                                saveForm();
                            },
                            "{$translate.no}": function() {
                                    $( this ).dialog( "close" );
                                    document.location.href = "{$url_path}employment/contract/pdf/{if isset($employee_username)}{$employee_username}/{/if}";
                            }
                        }
                });
            }
            else{
                document.location.href = "{$url_path}employment/contract/pdf/{if isset($employee_username)}{$employee_username}/{/if}";
            }
    }

    function loadNotification(){
        var change = $("#new").val();
        if(change == "1"){
                $( "#dialog-confirm" ).dialog({
                    resizable: false,
                    height:140,
                    modal: true,
                    buttons: {
                        "{$translate.yes}": function() {
                                $( this ).dialog( "close" );
                                saveForm();
                            },
                            "{$translate.no}": function() {
                                    $( this ).dialog( "close" );
                                    document.location.href = "{$url_path}employee/notification/{if isset($employee_username)}{$employee_username}/{/if}";
                            }
                        }
                });
            }
            else{
                document.location.href = "{$url_path}employee/notification/{if isset($employee_username)}{$employee_username}/{/if}";
            }
    }

    function loadPrivilege(){
        var change = $("#new").val();
        if(change == "1"){
                $( "#dialog-confirm" ).dialog({
                    resizable: false,
                    height:140,
                    modal: true,
                    buttons: {
                        "{$translate.yes}": function() {
                                $( this ).dialog( "close" );
                                saveForm();
                            },
                            "{$translate.no}": function() {
                                    $( this ).dialog( "close" );
                                    document.location.href = "{$url_path}employee/privileges/{if isset($employee_username)}{$employee_username}/{/if}";
                            }
                        }
                });
            }
            else{
                document.location.href = "{$url_path}employee/privileges/{if isset($employee_username)}{$employee_username}/{/if}";
            }
    }

    function loadPrifferedTime(){
        var change = $("#new").val();
        if(change == "1"){
                $( "#dialog-confirm" ).dialog({
                    resizable: false,
                    height:140,
                    modal: true,
                    buttons: {
                        "{$translate.yes}": function() {
                                $( this ).dialog( "close" );
                                saveForm();
                            },
                            "{$translate.no}": function() {
                                    $( this ).dialog( "close" );
                                    document.location.href = "{$url_path}emptime/preference/{if isset($employee_username)}{$employee_username}/{/if}";
                            }
                        }
                });
            }
            else{
                document.location.href = "{$url_path}emptime/preference/{if isset($employee_username)}{$employee_username}/{/if}";
            }
    }

    function loadSalary(){
        var change = $("#new").val();
        if(change == "1"){
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
                                    document.location.href = "{$url_path}employee/list/salary/{if isset($employee_username)}{$employee_username}/{/if}";
                            }
                        }
                });
            }
            else{
                document.location.href = "{$url_path}employee/list/salary/{if isset($employee_username)}{$employee_username}/{/if}";
            }
    }
    function loadSkills(){
        var change = $("#new").val();
        if(change == "1"){
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
                                    document.location.href = "{$url_path}employee/skills/{if isset($employee_username)}{$employee_username}/{/if}";
                            }
                        }
                });
            }
            else{
                document.location.href = "{$url_path}employee/skills/{if isset($employee_username)}{$employee_username}/{/if}";
            }
    }
    function loadDocumentation(){
        var change = $("#new").val();
        if(change == "1"){
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
                                    document.location.href = "{$url_path}employee/documentations/{if isset($employee_username)}{$employee_username}/{/if}";
                            }
                        }
                });
            }
            else{
                document.location.href = "{$url_path}employee/documentations/{if isset($employee_username)}{$employee_username}/{/if}";
            }
    }*/

    function makeChange(){
        $("#new").val('1');
    }
    function backForm(){
        //document.location.href = "{$url_path}list/employee/{if $employee_detail[0].status == '0'}inact{else}act{/if}/";
        //document.referrer;
        //history.go(-1)
        window.history.back();
    } 
    (function( $ ){

        $.fn.uncheckableRadio = function() {

            return this.each(function() {
                $(this).mousedown(function() {
                    $(this).data('wasChecked', this.checked);
                });

                $(this).click(function() {
                    if ($(this).data('wasChecked'))
                        this.checked = false;
                });
            });

        };

        $('input[type=radio][name=assistance]').uncheckableRadio();

        $('input[type=radio][name=assistance]').click(function(){

            $( "input[type=radio][name=work_type]").unbind( "click" ).unbind( "mousedown" );
            if($(this).val() == 2 && $(this).data('wasChecked') == false){
                $('input[type=radio][name=work_type]').uncheckableRadio();
            }
        });

    })( jQuery );
</script>
{/block}

{block name="content"}
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
                        <h1>{$translate.employee_profile}</h1>
                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    {if $employee_username != ""}
                        <div class="widget option-panel-widget" style="margin: 0 !important;">
                            <div class="widget-body" >
                                <div class="row-fluid">
                                    <div class="span4 top-customer-info"><strong>{$translate.social_security} : </strong>{$employee_detail[0].social_security}</div>
                                    <div class="span4 top-customer-info"><strong>{$translate.code} : </strong>{$employee_detail[0].code}</div>
                                    {if $sort_by_name == 2}
                                        <div class="span4 top-customer-info"><strong>{$translate.name} : </strong>{$employee_detail[0].last_name|cat: ' '|cat: $employee_detail[0].first_name}</div>
                                    {elseif $sort_by_name == 1}
                                        <div class="span4 top-customer-info"><strong>{$translate.name} : </strong>{$employee_detail[0].first_name|cat: ' '|cat: $employee_detail[0].last_name}</div>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    {/if}
                    
                     <div class="row-fluid">
                <div class="span12">
                    <div class="tab-content-switch-con" >
                        {if $employee_username != ""} 
                            <div class="span12">
                                {block name="employee_manage_tab_content"}{/block}
                                <div class="widget-header widget-header-options tab-option">
                                    <div class="span4 day-slot-wrpr-header-left span3">
                                        <h1>{$translate.employee_contract}</h1>
                                    </div>
                                       <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                           <button class="btn btn-default btn-normal pull-right ml" type="button" onclick="saveForm()"><span class="icon-save"></span> {$translate.save}</button>
                                           <button class="btn btn-default btn-normal pull-right" type="button" onclick="resetForm()"><span class="icon-refresh"></span> {$translate.reset}</button>
                                           <button class="btn btn-default btn-normal pull-right" type="button" onclick='backForm()'><span class="icon-arrow-left"></span> {$translate.backs}</button>
                                           <button class="btn btn-default btn-normal pull-right" type="button" onclick="printForm()"><span class="icon-print"></span> {$translate.print}</button>
                                           <button class="btn btn-default btn-normal pull-right" type="button" onclick="newContract()"><span class="icon-plus"></span> {$translate.add_new}</button>
                                       </div>
                                </div>
                            </div>
                        </div>
                        {/if}
                        
                           <div class="tab-content-con boxscroll">
                                
                               <div class="tab-content span12" style="margin:0;">
                                   <div role="tabpanel" class="tab-pane active" id="tab-2">
                                       <form name="forms" id="forms" method="post" action="{$url_path}employment/contract/pdf/{$employee_username}/{if $date_from neq ''}{$date_from}/{/if}" style="float:left; width:100%;">
                                           <input type="hidden" name="action" id="action" value="" />
                                           <input type="hidden" name="user_id" id="user_id" value="{$employee_username}" />
                                           <input type="hidden" name="hiden_val" id="hiden_val" value="" />
                                           <input type="hidden" name="social_flag" id="social_flag" value="" />
                                           <input type="hidden" name="new" id="new" value="" />
                                           <input type="hidden" name="change_comp" id="change_comp" value="1" />
                                           <div class="tab-content span12" style="margin:0; padding: 0;">

                                               <div style="" class="span12 widget-body-section input-group">
                                                    <div class="row-fluid no-min-height">
                                                        {$message}
                                                    </div>
                                                   <div class="row-fluid">
                                                       <div style="padding: 0px;" class="span12 widget-body-section">
                                                           <div class="span6 form-left">
                                                               <label style="float: left;" class="span12" for="date">{$translate.employee_contract}</label>
                                                               <div style="margin-left: 0px; float: left;">
                                                                   <div class="input-prepend span10">
                                                                       <span class="add-on icon-pencil"></span>
                                                                       <select class="form-control span12" name="date" id="date" onchange="load_documentation()">
                                                                           <option value="">{$translate.select}</option>
                                                                           {foreach from=$dates item=date}
                                                                               <option value="{$date.id}" {if $date.id == $date_from} selected="selected" {/if}>{$date.date_from} {if $sort_by_name == 1}{$date.customer_first_name} {$date.customer_last_name}{else}{$date.customer_last_name} {$date.customer_first_name}{/if}</option>
                                                                           {/foreach}
                                                                       </select>
                                                                       {if $contracts.sign_date != "" || $contracts.sign_date != null}
                                                                           <button class="btn btn-default btn-normal" type="button" name="remove_sign" id="remove_sign" value="{$translate.remove_sign}" style="float: right;margin-right: 40px;margin-top: 10px;" onclick="removeSign('{$contracts.id}')">{$translate.remove_sign}</button>
                                                                       {/if}
                                                                   </div>
                                                               </div>
                                                               <div class="widget" style="margin-top:0;">
                                                                   <div class="widget-header span12">
                                                                       <h1>&Ouml;verenskommelse har tr&auml;ffats om:</h1>
                                                                   </div>
                                                                   <!--WIDGET BODY BEGIN-->
                                                                   <div class="span12 widget-body-section input-group">
                                                                        <div class="span12">
                                                                            <ol class="radio-group span12 no-ml" style="float:left; width: 100%;">
                                                                               <li class="span12 no-ml"><input name="have_been_agreed" value="1" {if $contracts.have_been_agreed neq 2}checked="checked"{/if} onclick="makeChange()" type="radio"><label class="label-option-and-checkbox">ny anställning</label></li>
                                                                               <li class="span12 no-ml"><input name="have_been_agreed" value="2" {if $contracts.have_been_agreed eq 2}checked="checked"{/if} onclick="makeChange()" type="radio"><label class="label-option-and-checkbox">ändrade anställningsvillkor</label></li>
                                                                           </ol>
                                                                        </div>
                                                                        <div class="span12 no-ml">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label style="float: left;" class="span12" for="txtOverenskommelseBefDatum">&Auml;ndrade anst&auml;llningsvillkor fr o m</label>
                                                                               <div style="margin: 0px; float:left;" class="input-prepend date hasDatepicker datepicker span6"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control span8" name="txtOverenskommelseBefDatum" id="txtOverenskommelseBefDatum" type="text" size="12" value="{$contracts.date_from}" onchange="makeChange()" autocomplete="off" /> 
                                                                               </div>
                                                                               <div style="margin: 0px; float:left;" class="input-prepend date hasDatepicker datepicker span6"> <span class="add-on icon-calendar"></span>
                                                                                   <input placeholder="{$translate.to_date}" class="form-control span8" name="to_date" id="to_date" type="text" size="12" value="{$contracts.date_to}" onchange="makeChange()"  autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <!--WIDGET BODY END-->
                                                               </div>
                                                               <div class="widget" style="margin-top:0;">
                                                                   <div class="widget-header span12">
                                                                       <h1>B. Arbetsuppgifter/arbetsplats</h1>
                                                                   </div>
                                                                   <!--WIDGET BODY BEGIN-->
                                                                   <div style="margin: 10px 0px 10px 14px;" class="span12">
                                                                       <label style="float: left;" class="span12" for="exampleInputEmail1"><strong>Personlig assistent f&ouml;r brukaren d&auml;r brukare befinner sig</strong> </label>
                                                                   </div>
                                                                   <div class="span12 widget-body-section input-group" style="padding: 5px 15px ! important;">
                                                                       <table class="table table-bordered" style="width: 100%; margin:10px 0 10px 0">
                                                                           <thead>
                                                                               <tr>
                                                                                    <th style="width: 10%;">&nbsp;</th>
                                                                                    <th style="width: 55%;">Namn</th>
                                                                                    <th style="width: 35%;">Personnummer</th>
                                                                               </tr>
                                                                           </thead>
                                                                           <tbody>
                                                                               {foreach $assigned_customers AS $assigned}
                                                                                   <tr>
                                                                                        <td><input type="radio" name="customer_group" value="{$assigned.username}" {if $contracts.customer_name eq $assigned.username}checked="checked"{/if} onchange="makeChange()"/></td>
                                                                                        <td>
                                                                                           {if $sort_by_name == 1}{$assigned.first_name} {$assigned.last_name}
                                                                                           {elseif $sort_by_name == 2}{$assigned.last_name} {$assigned.first_name}{/if}
                                                                                        </td>
                                                                                        <td>{$assigned.century}{substr_replace($assigned.social_security,'-',6,0)}</td>
                                                                                   </tr>
                                                                               {/foreach}
                                                                           </tbody>
                                                                       </table>
                                                                       <ol class="radio-group">
                                                                               <li>
                                                                                   <input name="other_customer" value="1" {if $contracts.other_customer == '1'} checked="checked"{/if} onchange="makeChange()"  type="checkbox" style="margin: 3px 5px 0px 0px !important;" class="pull-left" />
                                                                                   <label class="label-option-and-checkbox label-phone"> {$translate.other_customer}</label>
                                                                               </li>
                                                                           </ol>
                                                                       <input type="hidden" name="txtnamn" id="txtnamn" style="width:320px" value="{$cust_name}" onblur="checkSocialSecuroty()" onchange="makeChange()"/>
                                                                   </div>
                                                                   <!--WIDGET BODY END-->
                                                               </div>
                                                               <div class="widget" style="margin-top: 0px; margin-bottom: 0px ! important;">
                                                                   <div class="widget-header span12">
                                                                       <h1>C. Anst&auml;llningsform, upps&auml;gningstider och kollektivavtal</h1>
                                                                   </div>
                                                                   <!--WIDGET BODY BEGIN-->
                                                                   <div style="margin: 10px 0px 10px 15px;" class="span12">
                                                                       <label style="float: left;" class="span12" for="exampleInputEmail1"><strong>Tidsbegr&auml;nsad anst&auml;llning</strong> </label>
                                                                   </div>
                                                                   <div style="padding: 5px 0px 15px 15px ! important;" class="span12 widget-body-section input-group">
                                                                       <div style="margin: 0px 0px 10px;" class="span12">

                                                                           <ol class="radio-group">
                                                                               <li>
                                                                                   <input name="assistanceChecked" id="chkAnstFormVisstid" value="1" {if $contracts.assistanceChecked == '1'} checked="checked"{/if} onchange="makeChange()"  type="checkbox" style="margin: 3px 5px 0px 0px !important;" class="pull-left" />
                                                                                   <label class="label-option-and-checkbox label-phone"> F&ouml;r viss tid s&aring; l&auml;nge assistens-uppdraget varar</label>
                                                                               </li>
                                                                           </ol>


                                                                       </div>
                                                                       <div style="margin: 0px;" class="span6">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label style="float: left;" class="span12" for="exampleInputEmail1">from</label>
                                                                               <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control span8" name="txtAnstFormVisstidFrom" type="text" id="txtAnstFormVisstidFrom" size="12" value="{$contracts.tmp_long_assistance_from}" onchange="makeChange()"  autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                       <div class="span6">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label style="float: left;" class="span12" for="exampleInputEmail1">eventuellt längst t o m</label>
                                                                               <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control span8" name="txtAnstFormVisstidTom" type="text" id="txtAnstFormVisstidTom" size="12" value="{$contracts.tmp_long_assistance_to}" onchange="makeChange()" autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <div style="padding: 15px 0px 15px 15px ! important;" class="span12 widget-body-section input-group">
                                                                       <div class="span3">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label class="checkbox checkbox-inline" style="margin: 0px; padding: 0px;">
                                                                                   <input style="margin: 3px 5px 0px 0px ! important;" name="chkAnstFormVikarieFor" type="checkbox" id="chkAnstFormVikarieFor" value="1" {if $contracts.tmp_assistance_for != ''}checked="checked"{/if} onchange="makeChange()" /> Vikarie för:
                                                                               </label>
                                                                           </div>
                                                                       </div>
                                                                       <div class="span9">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                   <input class="form-control span11" name="txtAnstFormVikarieNamn" type="text" id="txtAnstFormVikarieNamn" value="{$contracts.tmp_assistance_for}" onchange="makeChange()" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <div class="span12 widget-body-section input-group">
                                                                       <div class="span12"> under dennes frånvaro </div>
                                                                       <div style="margin: 0px;" class="span6">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label style="float: left;" class="span12" for="txtAnstFormVikarieFranvaroFrom">from</label>
                                                                               <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control span8" name="txtAnstFormVikarieFranvaroFrom" type="text" id="txtAnstFormVikarieFranvaroFrom" size="12" value="{if $contracts.absence_from != '0000-00-00'}{$contracts.absence_from}{/if}" onchange="makeChange()"  autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                       <div class="span6">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label style="float: left;" class="span12" for="txtAnstFormVikarieFranvaroTom">längst t o m</label>
                                                                               <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control span8" name="txtAnstFormVikarieFranvaroTom" type="text" id="txtAnstFormVikarieFranvaroTom" size="12" value="{if $contracts.absence_to != '0000-00-00'}{$contracts.absence_to}{/if}"  onchange="makeChange()"  autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <div style="padding-top: 10px;" class="span12 widget-body-section input-group">
                                                                       <div style="" class="span12">

                                                                           <ol class="radio-group span12 no-ml">
                                                                               <li style="margin-bottom: 5px;" class="span12 no-ml">
                                                                                   <input type="radio" name="assistance" value="2" {if  $contracts.employmentType == "2"} checked="checked" {/if} onclick="makeChange()"  />
                                                                                   <label class="label-option-and-checkbox"> För särskilt avtalade tillfällen sk. Timanställning </label>(se bilaga)
                                                                               </li>
                                                                               <li style="margin-bottom: 6px;" class="span12 no-ml">
                                                                                   <input type="radio" name="assistance" value="1" {if  $contracts.employmentType == "1"} checked="checked" {/if} onclick="makeChange()"  />
                                                                                   <label class="label-option-and-checkbox"> Provanställning </label>
                                                                               </li>
                                                                           </ol>


                                                                       </div>
                                                                       <!-- <div class="row-fluid">Provanställning</div> -->
                                                                       <div style="margin: 0px;" class="span6">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label style="float: left;" class="span12" for="exampleInputEmail1">from</label>
                                                                               <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control span8" name="txtAnstFormProvanstallningFrom" type="text" id="txtAnstFormProvanstallningFrom" size="12" value="{$contracts.probationary_from}" onchange="makeChange()"  autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                       <div class="span6">
                                                                           <div style="margin: 0px;" class="span12">
                                                                               <label style="float: left;" class="span12" for="exampleInputEmail1">t o m</label>
                                                                               <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control span8" name="txtAnstFormProvanstallningTom" type="text" id="txtAnstFormProvanstallningTom" size="12" value="{$contracts.probationary_to}" onchange="makeChange()"  autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <div style="" class="span12 widget-body-section input-group">
                                                                       <div class="span12">Endast i samband med Tillsvidareanställning</div>
                                                                       <label class="checkbox checkbox-inline" style="padding-left:0 !important;">
                                                                           <input style="margin: 3px 5px 0px 0px ! important;" name="chkAnstFormTillsvidareanstallning" type="checkbox" id="chkAnstFormTillsvidareanstallning" value="1" {if $contracts.open_ended_appointment != '' && $contracts.open_ended_appointment != '0'} checked="checked" {/if} onclick="makeChange()" /> Tillsvidareanställning Tillträdesdag </label>
                                                                       <div class="row-fluid">
                                                                           <div style="margin: 10px 0 0 0;" class="span12">
                                                                               <div style="margin: 0px;" class="input-prepend span6"> <span class="add-on icon-calendar"></span>
                                                                                   <input class="form-control date hasDatepicker datepicker span8" name="txtAnstFormTillsvidareanstallningTilltradesdag" type="text" id="txtAnstFormTillsvidareanstallningTilltradesdag" size="10" value="{$contracts.prevailing_collective}" onchange="makeChange()"  autocomplete="off" /> 
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                       <div style="padding: 10px 0px 0px;" class="span12 widget-body-section">
                                                                           <div class="span12">
                                                                               <div style="margin: 0px;" class="span12">
                                                                                   <label style="float: left;" class="span12" for="txtAnstFormTillsvidareanstallningTilltradesdag">Uppsägningstid: enligt vid var tid gällande kollektivavtal</label>
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <!--WIDGET BODY END-->
                                                               </div>
                                                           </div>
                                                           <div class="span6 form-right">
                                                               <div class="widget" style="margin-top:0;">
                                                                   <div class="widget-header span12">
                                                                       <h1>D. Arbetstid, lön (se gällande kollektivavtal)</h1>
                                                                   </div>
                                                                   <!--WIDGET BODY BEGIN-->
                                                                   <div style="padding: 10px !important;" class="span12 widget-body-section input-group">
                                                                       <div style="" class="span12">
                                                                           <div class="span12" style="margin:0 0 5px 0;">

                                                                               <ol class="para-inputs-list">

                                                                                   <li>         
                                                                                       <ol class="radio-group" style="float:left;">
                                                                                           <li>
                                                                                               <input name="work_type" type="radio" id="chkArbetstidHeltid" value="1" {if $contracts.fulltime eq 1 or $date_from eq ''} checked="checked" {/if} onclick="makeChange()"  /><label class="label-option-and-checkbox">Heltid</label>
                                                                                           </li>
                                                                                       </ol>
                                                                                       <!-- <div  class="input-prepend pull-left"> 
                                                                                           <input class="form-control span12" name="normal_week_hr" type="text" id="normal_week_hr" size="4" {if $contracts.fulltime neq 2} value="{if $contracts.hour > 0}{$contracts.hour}{/if}"{else}value="{if $contracts.normal_week_hr > 0}{$contracts.normal_week_hr}{/if}"{/if} onchange="makeChange()" /> 
                                                                                       </div> -->
                                                                                       <label class="radio pull-left" style="margin:0px 5px;">40 tim i genomsnitt per vecka &nbsp;&nbsp;&nbsp;&nbsp;</label>

                                                                                       <!-- <div  class="input-prepend pull-left"> 
                                                                                           <input class="form-control span12" name="oncall_hr" type="text" id="oncall_hr" size="4" {if $contracts.fulltime neq 2}value="{if $contracts.monthly_oncall_hour > 0}{$contracts.monthly_oncall_hour}{/if}"{else}value="{if $contracts.oncall_week_hr > 0}{$contracts.oncall_week_hr}{/if}"{/if} onchange="makeChange()" /> 
                                                                                       </div>
                                                                                       <label class="radio" style="margin:0px 0 10px 0;"> &nbsp;tim jour per månad</label></li> -->
                                                                               </ol>
                                                                           </div>
                                                                       </div>

                                                                       <div class="span12" style="margin:0 0 5px 0">
                                                                           {assign var=part value="."|explode:$contracts.part_time}


                                                                           <ol class="para-inputs-list">
                                                                               <li>  
                                                                                   <ol class="radio-group" style="width: 100%;">
                                                                                       <li>
                                                                                           <input name="work_type" type="radio" id="chkArbetstidDeltid" value="2" {if $contracts.fulltime == 2}checked="checked"{/if} onclick="makeChange()"  /><label class="label-option-and-checkbox">Deltid</label>
                                                                                       </li>
                                                                                   </ol><br/>
                                                                                   <div class="input-prepend pull-left">
                                                                                       <input class="form-control span12" name="txtArbetstidDeltidTim" type="text" id="txtArbetstidDeltidTim" size="4" maxlength="2" value="{if $part[0] > 0}{$part[0]}{/if}" onchange="makeChange()" /> 
                                                                                   </div>
                                                                                   <label class="radio pull-left"  style="margin:0">&nbsp;tim&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                                   <div class="input-prepend pull-left"> 
                                                                                       <input class="form-control span12" name="txtArbetstidDeltidMin" type="text" id="txtArbetstidDeltidMin" size="4" maxlength="2" value="{if $part[1] > 0}{$part[1]}{/if}" onchange="makeChange()" /> 
                                                                                   </div>
                                                                                   <label class="radio pull-left" style="margin:0;">&nbsp;min &nbsp;&nbsp;i genomsnitt per vecka&nbsp;</label> 
                                                                               </li>
                                                                           </ol>                                   
                                                                       </div>


                                                                       <div style="margin: 0px; margin-top: 20px;" class="input-prepend span12"> 
                                                                           <label style="float: left; margin: 0px 10px 0 0;" for="txtArbetstidLonPerManad">Lön vid anställningstillfället</label>
                                                                       </div>
                                                                       <div style="margin: 0px;" class="input-prepend span12">
                                                                           <input style="float: left;" class="form-control span3" name="txtArbetstidLonPerManad" type="text" id="txtArbetstidLonPerManad" size="15" value="{if $contracts.salary_month > 0}{$contracts.salary_month}{/if}" onchange="makeChange()" />
                                                                           <label style="float: left;" for="txtArbetstidLonPerTimme">&nbsp;&nbsp;kronor per månad</label>
                                                                       </div>
                                                                       <div style="margin: 0px;" class="input-prepend span12">                                                                   
                                                                           <input style="float: left;" class="form-control span3" name="txtArbetstidLonPerTimme" type="text" id="txtArbetstidLonPerTimme" size="15" value="{if $contracts.salary_hour > 0}{$contracts.salary_hour}{/if}" onchange="makeChange()" />
                                                                           <label style="float: left;" for="txtArbetstidLonPerTimme">&nbsp;&nbsp;kronor per timme</label>
                                                                       </div>


                                                                       <div style="margin:0 0 5px 0" class="span12">
                                                                           <div style="margin: 0px;" class="input-prepend span4">
                                                                               <input style="float: left; margin-top: 4px !important;" name="chkArbetstidLonInklSemLon" type="checkbox" id="chkArbetstidLonInklSemLon" value="1" {if $contracts.incl_salary != '' && $contracts.incl_salary != '0'} checked="checked" {/if} />
                                                                               <label class="checkbox checkbox-inline" style="padding-left:5px !important;">inkl. sem.lön&nbsp;&nbsp;&nbsp;</label>
                                                                           </div>
                                                                           <div style="margin: 0px;" class="input-prepend span8"> 
                                                                               <input style="float: left; margin-top: 4px !important;" name="chkArbetstidLonExklSemLon" type="checkbox" id="chkArbetstidLonExklSemLon" value="1" {if $contracts.excl_salary != '' && $contracts.excl_salary != '0'} checked="checked" {/if} onclick="makeChange()" />
                                                                               <label class="checkbox checkbox-inline" style="padding-left:5px !important;">exkl. sem.lön</label>
                                                                           </div>


                                                                           <div class="row-fluid">
                                                                               <div class="span12" style="margin:10px 0 0 0;">
                                                                                   <div class="input-prepend pull-left" style="margin-top: 4px;"> 
                                                                                       <input style="width: auto;" name="chkArbetstidLonUtbetalasManadsvis" type="checkbox" id="chkArbetstidLonUtbetalasManadsvis" value="1"  {if $contracts.incl_wages != '' && $contracts.incl_wages != '0'} checked="checked" {/if} onclick="makeChange()" />
                                                                                   </div>
                                                                                   <label style="float: left; margin: 0px;">&nbsp;Lönen utbetalas månadsvis</label>
                                                                               </div>
                                                                               <div style="margin: 0px;" class="input-prepend span12"> 
                                                                                   <label style="float: left; ">Lönen inkluderar &nbsp;</label>
                                                                                   <input class="form-control span2" style="float: left;" name="txtArbetstidLonInkluderarLonerevision" type="text" id="txtArbetstidLonInkluderarLonerevision" size="4" value="{if $contracts.act_salary > 0}{(int)$contracts.act_salary}{/if}" onchange="makeChange()" />
                                                                                   <label style="float: left; margin: 0px 5px 0 5px;"> &nbsp;års lönerevision</label>
                                                                               </div>
                                                                               <div style="margin: 0px;" class="input-prepend span12"> 
                                                                                   <label style="float: left;" for="txtBankkonto">Bank/Kontonr &nbsp;</label>
                                                                                   <input style="float: left;" class="form-control span8" name="txtBankkonto" type="text" id="txtBankkonto" size="60" value="{$contracts.bank_account}" onchange="makeChange()" /> 
                                                                               </div>





                                                                           </div>
                                                                       </div>

                                                                   </div>
                                                                   <!--WIDGET BODY END-->
                                                               </div>
                                                               <div class="widget" style="margin-top:0;">
                                                                   <div class="widget-header span12">
                                                                       <h1>E. Semesterrätt</h1>
                                                                   </div>
                                                                   <!--WIDGET BODY BEGIN-->
                                                                   <div style="padding: 10px !important;" class="span12 widget-body-section input-group">
                                                                       <div style="margin: 0px 0px 10px;" class="span12">
                                                                           <div style="margin: 0px;" class="input-prepend span12" > 
                                                                               <label class="radio">Semester utges enligt lag och kollektivavtal med

                                                                                   <input class="form-control span2" name="txtSemesterSemesterdagar" type="text" id="txtSemesterSemesterdagar" size="4" value="{$contracts.leave_per_year}" onchange="makeChange()" />
                                                                                   semesterdagar<br /> per år vid fullt intjänade
                                                                               </label>
                                                                           </div>
                                                                           <div  class="span12" style="margin:0 !important;">

                                                                               <ol class="radio-group" style="margin:10px 0 0 0 !important">
                                                                                   <li>

                                                                                       <input  name="chkSemesterLonIngarTimlon" type="checkbox" id="chkSemesterLonIngarTimlon" value="1" {if $contracts.incl_holiday_pay != ''}checked="checked"{/if} onchange="makeChange()" /><label class="label-option-and-checkbox">Semesterlön ingår i överenskommen timlön&nbsp;</label></li>

                                                                                   <li>
                                                                                       <input  name="chkSemesterLonIngarEjTimlon" type="checkbox" id="chkSemesterLonIngarEjTimlon" value="1" {if $contracts.excl_holiday_pay != '' && $contracts.excl_holiday_pay != '0'}checked="checked"{/if} onchange="makeChange()" />
                                                                                       <label class="label-option-and-checkbox">  Semesterlön ingår ej i överenskommen timlön&nbsp;</label>

                                                                                   </li>
                                                                               </ol>  



                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                                   <!--WIDGET BODY END-->
                                                               </div>
                                                               <div class="widget" style="margin-top:0;">
                                                                   <div class="widget-header span12">
                                                                       <h1>F. Övertid, restid, ob, jour, beredskap</h1>
                                                                   </div>
                                                                   <!--WIDGET BODY BEGIN-->
                                                                   <div style="padding: 10px !important;" class="span12 widget-body-section input-group">
                                                                       <div style="margin: 0px 0px 10px;" class="span12">
                                                                           <label class="radio">
                                                                               <label class="span12" style="float: left;" for="exampleInputEmail1">I lönen ingår kompensation för </label>
                                                                               <label class="checkbox checkbox-inline" style="padding-left: 0px ! important; margin-top: 10px;">
                                                                                   <input style="margin: 3px 5px 0px 0px ! important;" name="chkOvrigtOvertid" type="checkbox" id="chkOvrigtOvertid" value="1" {if is_array($opt) && in_array("1",$opt)}checked="checked"{/if} onclick="makeChange()" />övertid&nbsp;&nbsp;&nbsp;</label>
                                                                               <label class="checkbox checkbox-inline" style="padding-left: 0px ! important; margin-top: 10px;">
                                                                                   <input style="margin: 3px 5px 0px 0px ! important;" name="chkOvrigtRestid" type="checkbox" id="chkOvrigtRestid" value="1" {if is_array($opt) && in_array("2",$opt)}checked="checked"{/if} onclick="makeChange()" />restid&nbsp;&nbsp;&nbsp;</label>
                                                                               <label class="checkbox checkbox-inline" style="padding-left: 0px ! important; margin-top: 10px;">
                                                                                   <input style="margin: 3px 5px 0px 0px ! important;" name="chkOvrigtBeredskap" type="checkbox" id="chkOvrigtBeredskap" value="1" {if is_array($opt) && in_array("3",$opt)}checked="checked"{/if} onclick="makeChange()" />beredskap&nbsp;&nbsp;&nbsp;</label>
                                                                               <label class="checkbox checkbox-inline" style="padding-left: 0px ! important; margin-top: 10px;">
                                                                                   <input style="margin: 3px 5px 0px 0px ! important;" name="chkOvrigtOb" type="checkbox" id="chkOvrigtOb" value="1" {if is_array($opt) && in_array("4",$opt)}checked="checked"{/if} onclick="makeChange()" />ob&nbsp;&nbsp;&nbsp;</label>
                                                                               <label class="checkbox checkbox-inline" style="padding-left: 0px ! important; margin-top: 10px;">
                                                                                   <input style="margin: 3px 5px 0px 0px ! important;" name="chkOvrigtJour" type="checkbox" id="chkOvrigtJour" value="1" {if is_array($opt) && in_array("5",$opt)}checked="checked"{/if} onclick="makeChange()" />jour</label>
                                                                           </label>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                               <div class="widget" style="margin-top:0;">
                                                                   <div class="widget-header span12">
                                                                       <h1>G. S&auml;rskilda villkor, noteringar</h1>
                                                                   </div>
                                                                   <!--WIDGET BODY BEGIN-->
                                                                   <div style="padding: 10px !important;" class="span12 widget-body-section input-group">
                                                                       <div style="margin: 0px 0px 10px;" class="span12">
                                                                           <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                               <input class="form-control span8" name="txtNotering1" type="text" id="txtNotering1" style="width:90%"  value="{$contracts.special_condition}" onchange="makeChange()" /> 
                                                                           </div>
                                                                       </div>
                                                                       <div style="margin: 0" class="span12">
                                                                           <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                               <input class="form-control span8" name="txtNotering2" type="text" id="txtNotering2" style="width:90%" value="{$contracts.notes}" onchange="makeChange()" /> 
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
                               </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {else}
        <div class="message fail">{$translate.permission_denied}</div>      
    {/if}
{/block}