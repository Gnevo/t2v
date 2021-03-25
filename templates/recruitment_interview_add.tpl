{block name="style"}
<link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" />
{*<link href="{$url_path}css/jquery.jscrollpane.css" rel="stylesheet" media="screen">*}
<style>
    .search_section, .search_ssn, .search_criteria {
    	float: left;
    }
    .search_section{
    	padding:8px 0 0 13px;
    }
    .search_criteria {
    	margin-left:10px;
    	
    }
    .search_options {
    	margin:0px 6px 1px 6px;
    	background-color:#e1ecf0;
    	padding:15px 14px;
    }
    #search_meddcentr table:first-child td:first-child {
    	width:15px;
    }
    .interview_submit {
    	background-color:#a0dae6;
    	margin:0px 6px 5px 6px;
    	padding:10px 0px;
    }
    #search_meddcentr table.table_list {
    	margin-bottom:0px;	
    }
    .interview_dates a, .med_searchsubmit a {
    	background-color:#dddddd;
    	padding:4px 6px;
    	display:block;
    	float:left;
    	border:solid 1px #cccccc;	
    }
    .interview_dates p {
    	float:left;
    	margin-right:10px;
    	margin-left:9px;
    	padding:4px 0px;
    }
    .search_filed {
    	margin:0px 14px;
    }
    .med_searchsubmit {
    	margin-top:6px;
    }
    .error{
        background: #f8dbdb;
        border-color: #e77776;
    }

    .search_column {
    	border-right:solid 1px #9fd9e5;
    	float:left;
    	padding:0px 10px;
    }
    .search_column:last-child {
    	border-right:none;
    	margin-right:0px;
    }
    .search_column:first-child {
    	padding-left:0px;
    }

    .summery_popup { 
        margin: 7px 3px; 
        border:solid 1px #daf2f7; 
        width: 99%; 
        text-align: center;
    }
    .summery_popup td {
        border-right: solid 1px #ffffff;
        font-size: 12px;
        background-color: #daf2f7;
        padding: 5px 4px;
        margin-bottom: 3px;
        text-align: center;
    }
    .summery_popup th {
        border-right: solid 1px #ffffff;
        font-size: 12px;
        font-weight: bold;
        background-color: #daf2f7;
        padding: 5px;
        border-bottom: solid 1px #fff;
        text-align: center;
    } 

    .ui-widget-overlay{
           background:none; 
        }
    .fixed-dialog{ position: fixed; top: 50px; left: 50px; }
</style>
{/block}
{block name="script"}
{*<script type="text/javascript" src="{$url_path}js/jquery.min.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.validate.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery-ui.min.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.ui.button.min.js"></script>
<script type="text/javascript" src="{$url_path}js/mousehold.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="{$url_path}js/aplweb.scrollbars.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.event.drag-2.0.min.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery-ui.min.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.ui.position.min.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.ui.dialog.min.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.ui.mouse.min.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.ui.draggable.min.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.ui.droppable.min.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.contextmenu.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="{$url_path}js/clock.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.mousewheel_1.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.jscrollpane.min.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.switchButton.js"></script>*}
<script src="{$url_path}js/plugins/forms/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
    $(".search_options").keypress(function(e) {
            if(e.which == 13) {
                var search_enter = $('input:radio[name=selection_search]:checked').val();
                if(search_enter == 1 || search_enter == 2){
                    submit_form('1');
                }else{
                    submit_form('3');
                }
            }
        }); 

    $(document).ready(function(){
        var myVar = '';
        
       //  $( "#date" ).datepicker({
       //     showOn: "button",
       //     buttonImage: "{$url_path}images/date_pic.gif",
       //     buttonImageOnly: true,
       //     dateFormat :"yy-mm-dd"
       // });

        $('#date').datetimepicker({
            format: "yyyy-mm-dd hh:ii:ss",
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '{$lang}'
        });
       
        $("#type_recruitment").change(function (){
            $("#action").val('4');
            $("#form2").submit(); 
        });
  


    });
    
        function viewSearch(type){
            if(type == 1){
                $("#criteria_search").hide();
                $("#ssn_search").show();
            }else if(type == 2){
                $("#ssn_search").hide();
                $("#criteria_search").show();
                
            }
        
        }
     
     function submit_form(type_action){
            var error = 0;
            if(type_action ==2 || type_action ==5 || type_action ==6){
                var recut_emp="";
                $('.check_pernumber:checked').each(function() {
                    if(recut_emp == ''){
                        recut_emp=$(this).attr("value");
                    }else{
                        recut_emp=recut_emp+','+($(this).attr("value"));
                    }
                });
                if(recut_emp == ''){
                    alert("{$translate.select_applicants}");
                    error = 1;
                }
                else if($("#date").val() == '' && type_action == 2){
                    alert("{$translate.select_interview_date}");
                    error = 1;
                }
                $("#selected_per_num").val(recut_emp);
            }else if(type_action == 1){
                var search = $('input:radio[name=selection_search]:checked').val();
                if($("#serach_key").val() == "" && search == 1){
                   alert("{$translate.enter_ssn}"); 
                   error = 1;
                }
                if($("#serach_key").val() == "" && search == 2){
                   alert("{$translate.enter_name}"); 
                   error = 1;
                }
            }
                $("#action").val(type_action);
                if(error == 0)
                    $("#form2").submit(); 
        }   
        
        
        
        function loadSortedCandidates(type_recruitment){
            $("#search_meddcentr").load('{$url_path}ajax_recruitment_sorted_list.php?status_type='+type_recruitment);
        
        }
        
        function rescheduleInterview(){
            if ($('#re_date').css('display') == 'none') {
                $('#re_date').show();
            }else{
                if($("#date").val() == ""){
                    $('#re_date').hide();
                }else{
                    submit_form('6')
                }
            }
        }
        
        
        
        function popupPreviousSchedule(app_id){
            var dialog_box_new = $("#previous_slot");
            dialog_box_new.html('<div class="popup_first_loading" style="height: 100px;"></div>').load('{$url_path}ajax_recruitment_previous_schedules.php?app_id='+app_id);
            dialog_box_new.dialog({
                title: '{$translate.previous_schedules}',
                position: 'top,left',
                modal: true,
                //width: 'auto',
                //maxHeight: 150,
                //height: 150,
                width: 516,
                minWidth: 300,
                minHeight: 100,
                closeOnEscape: true,
                sticky: true,
                dialogClass: 'fixed-dialog',
                resizable: false,
                //dialogClass: 'no-close',
                //show: { effect: "blind", duration: 800 },
                close: function(event, ui) {
                        $(this).dialog('destroy').remove();
                        $("#external_wrapper #pop_up_themes").append('<div id="previous_slot" style="display:none;"></div>');
                },
                hide: 'slide',
                show: { effect: 'slide', duration: 500 }
//                
         });
        }
       {*function search_check(type_action)
       {
    if(type_action ==1){
        var search_key=('#tags').val();
         if(search_key == '{$applicant.personal_number}'){
      $("#temp_search_cust").val('');  
   }
     var search = $("#temp_search_cust").val();
     $("#temp_search_cust").val(name);
    var action = $("#action").val();
    if(search != ""){
    }*}
       
    </script>
{/block}
    {block name="content"}
    <div class="row-fluid">
    <div class="span12 main-left">
    <div class="tbl_hd">
        <span class="titles_tab">{$translate.recruitment}<span style="padding-left: 10px;"></span></span>  
        <a class="add" href="{$url_path}add/recruitment/applicant/"><span class="btn_name">{$translate.add_new_applicant}</span></a>
        <a class="back" href="{$url_path}administration/"><span class="btn_name">{$translate.back}</span></a>
    </div>
    <div id="pop_up_themes">
        <div id="previous_slot" style="display:none;"></div>
    </div>
    {$message}
    <div id="tble_list">
        <form method="post" enctype="multipart/form-data" name="form2" id="form2" action="{$url_path}recruitment/interview/add/">
            <div class="row-fluid">
            <div class="pagention span12">
                <select name="type_recruitment" id="type_recruitment" style="margin-left: 8px; margin-top: 3px;height: 23px;">
                    <option value="5" {if $type_recruitment == '5'}selected="selected"{/if} >{$translate.all_candicates}</option>
                    <option value="0" {if $type_recruitment == '0'}selected="selected"{/if} >{$translate.applied_candicates}</option>
                    <option value="1" {if $type_recruitment == '1'}selected="selected"{/if}>{$translate.interview_called}</option>
                    <!--<option value="2" {if $type_recruitment == '2'}selected="selected"{/if}>{$translate.interview_attended}</option>
                    <option value="3" {if $type_recruitment == '3'}selected="selected"{/if}>{$translate.shortlisted_candidates}</option>
                    <option value="4" {if $type_recruitment == '4'}selected="selected"{/if}>{$translate.offer_letter_send}</option>
                    <!--                <option value="5">Select</option>-->
                </select>
                <div class="search_section">
                    <div class="search_ssn"><input name="selection_search" type="radio" value="1"id="ssn"{if $search_type == "1"}checked="checked"{/if} onclick="viewSearch('1')" style="margin-right: 5px;"/>{$translate.search_by_ssn}</div>

                    <div class="search_criteria"><input name="selection_search" type="radio" value="0"id="criteria"  {if $search_type == "0"}checked="checked"{/if} onclick="viewSearch('2')" style="margin-right: 5px;"/>{$translate.search_by_criteria}</div>
                    <div class="search_criteria"><input name="selection_search" type="radio" value="2"id="search_name"  {if $search_type == "2"}checked="checked"{/if}onclick="viewSearch('1')"  style="margin-right: 5px;"/>{$translate.search_by_name}</div>

                </div>
            </div>
            </div>        
            <div class="row-fluid">
            <div class="search_options span12">
                <input type ="hidden" name="action" id="action" value="">
                <input type ="hidden" name="selected_per_num" id="selected_per_num" value="">
                <div class="search_filed" id="ssn_search" {if $search_type == '0'}style="display: none"{/if}>
                    <div class="search_column">
                        <input name="serach_key" type="text"  id="serach_key"    style="width:115px; height:18px;" value="{$ssn_num}">
                        <input type="hidden" name="temp_search_cust" id="temp_search_cust" />


                    </div>
                    <div class="search_column">
                        <input name="Submit" type="button" id="Submit" value="{$translate.search}" class="submit_btn" onclick="submit_form('1');" >


                    </div>
                    <!--                <div class="med_searchfiled"><input name="serach_key" type="text"  id="serach_key"    style="width:240px; height:25px;">
                                        <input type="hidden" name="temp_search_cust" id="temp_search_cust" />
                                    </div>
                                    <div class="med_searchsubmit">
                                        <input name="Submit" type="button" id="Submit" value="{$translate.search}" class="submit_btn" onclick="submit_form('1');" >

                                    </div>-->
                </div>
                <div class="search_filed" id="criteria_search" {if $search_type == '1' || $search_type == '2'}style="display: none"{/if}>
                    <div class="search_column">
                        <select id="gender" name="gender">
                            <option value="" >{$translate.gender}</option>
                            <option value="1" {if $value_filter_gender == "1"}selected="selected"{/if}>{$translate.male}</option>
                            <option value="0" {if $value_filter_gender == "0"}selected="selected"{/if}>{$translate.female}</option>
                        </select>


                    </div>
                    <div class="search_column">

                        <div style="display: block;" id="filter_age" class="filtering" >
                            <input type="text" placeholder="{$translate.age_from}..." value="{$value_filter_age_from}" id="age_from" name="age_from" style="width:90px; height:20px;"> 
                            <input type="text" placeholder="{$translate.age_to}..." value="{$value_filter_age_to}" id="age_to" name="age_to" style="width:90px; height:20px;"> 
                        </div>
                    </div>
                    <div class="search_column"><div style="display: block;" id="filter_qual" class="filtering">
                            <select name="qual" id="qual" style="width:120px;">
                                <option value="">{$translate.qualification}</option>
                                {foreach $qualifications AS $qualification}
                                    <option value="{$qualification.qualification}" {if $value_filter_qual == $qualification.qualification}selected="selected"{/if}>{$qualification.qualification}</option> 
                                {/foreach}
                            </select>
                        </div></div>
                    <div class="search_column"><div style="display: block;" id="filter_lang" class="filtering">
                            <select name="lang" id="lang" style="width:120px;">
                                <option value="">{$translate.language}</option>
                                {foreach $languages_applicant AS $lng}
                                    <option value="{$lng.language_known}" {if $value_filter_lang == $lng.language_known}selected="selected"{/if}>{$lng.language_known}</option> 
                                {/foreach}
                            </select>
                        </div></div>
                    <div class="search_column"><div style="display: block;" id="filter_city" class="filtering">
                            <select name="city" id="city" style="width:120px;">
                                <option value="">{$translate.city}</option>
                                {foreach $cities AS $city}
                                    <option value="{$city.city}" {if $value_filter_city == $city.city}selected="selected"{/if}>{$city.city}</option> 
                                {/foreach}
                            </select>
                        </div></div>
                    <div class="search_column"> <div class="med_searchsubmit" style="margin-top: 2px;">
                            <input name="Submit" type="button" id="Submit" value="{$translate.search}" class="submit_btn" onclick="submit_form('3');" >

                        </div></div>

                </div>
            </div>
            </div>
            <div class="row-fluid">                            
            <div id="search_meddcentr">
                <table class="table_list" style="text-align:left; font-size:12px; width: 100%">
                    <tbody>
                        <tr style="text-align: center">
                            {if $type_recruitment != '5'}<th>&nbsp;</th>{/if}
                            <th>{$translate.social_security_number}</th>
                            <th>{$translate.name}</th>
                            <th style="width: 100px;">{$translate.mobile_phone}</th>
                            <th>{$translate.gender}</th>
                            <th>{$translate.city}</th>
                            {if $type_recruitment != '0'}
                                <th>{$translate.date_of_interview}</th>
                            {/if}
                            <th>{$translate.created_date}</th>
                            {if $type_recruitment == '5'}
                                <th style="width: 30px;"><a href="javascript:void(0);" onclick="loadSortedCandidates('0')" style="text-decoration: underline;" title="{$translate.applied}">{$translate.applied_short}</a></th>
                                <th style="width: 30px;"><a href="javascript:void(0);" onclick="loadSortedCandidates('1')" style="text-decoration: underline;" title="{$translate.interview_called}">{$translate.interview_called_short}</a></th>
                                 <!-- <th><a href="javascript:void(0);" onclick="loadSortedCandidates('2')" style="text-decoration: underline" title="{$translate.interview_attended}">{$translate.interview_attended_short}</a></th>
                              <th><a href="javascript:void(0);" onclick="loadSortedCandidates('3')" style="text-decoration: underline" title="{$translate.shortlisted}">{$translate.shortlisted_short}</a></th>
                                <th><a href="javascript:void(0);" onclick="loadSortedCandidates('4')" style="text-decoration: underline" title="{$translate.offer_letter_send}">{$translate.offer_letter_send_short}</a></th>-->
                            {/if}
                            {*if $type_recruitment == '1'}
                            <th></th>
                            {/if*}
                        </tr>
                        {foreach $applicants AS $applicant}

                            <tr class="{cycle values="even,odd"}" >
                                {if $type_recruitment != '5'} <td><input type="checkbox" name="check_pernumber" class="check_pernumber"  value="{$applicant.id}" > </td>{/if}
                                <td>{$applicant.personal_number}</td>
                                <td><a {if $type_recruitment != '5'}href="{$url_path}view/recruitment/applicant/{$applicant.id}/"{else}href="{$url_path}view/recruitment/applicant/{$applicant.id}-1/"{/if} style="border-bottom: 1px dashed #999;">{$applicant.last_name} {$applicant.first_name}</a></td> 
                                <td>{if $applicant.mobile != ''}{$applicant.mobile}{else}{$applicant.telephone}{/if}</td>
                                <td>{if $applicant.gender == 1}{$translate.male}{elseif $applicant.gender == 0}{$translate.female}{/if}</td>
                                <td >{$applicant.city}</td>
                                {if $type_recruitment != '0'} <td >{$applicant.date_of_interview}</td>{/if}
                                <td >{if $applicant.created_date neq ''}{$applicant.created_date|date_format:'Y-m-d'}{/if}</td>
                                {if $type_recruitment == '5'}
                                    {if $applicant.status == ""}<td style="text-align: center"><img src="{$url_path}images/recruitment_tick.png" /></td><td></td>{/if}
                                    {if $applicant.status == 1}<td></td><td style="text-align: center"><img src="{$url_path}images/recruitment_tick.png" /></td>{/if}
                                    {*if $applicant.status == 2}<td></td><td></td><td style="text-align: center"><img src="{$url_path}images/recruitment_tick.png" /></td><td></td><td></td>{/if}
                                    {if $applicant.status == 3}<td></td><td></td><td></td><td style="text-align: center"><img src="{$url_path}images/recruitment_tick.png" /></td><td></td>{/if}
                                    {if $applicant.status == 4}<td></td><td></td><td></td><td></td><td style="text-align: center"><img src="{$url_path}images/recruitment_tick.png" /></td>{/if*}
                                    {if $applicant.status == 5}<td colspan="2" style="text-align: center;color: #CA226B">{$translate.selected_employee}</td>{/if}
                                {/if}
                                {*if $type_recruitment == '1'}
                                    <td><input type="button" name="previous_schedule" id="previous_schedule" value="{$translate.previous_schedules}" onclick="popupPreviousSchedule('{$applicant.id}');" /></td>
                                {/if*}
                            </tr>   
                        {foreachelse}
                            <td {if $type_recruitment == '0'}colspan="7"{elseif $type_recruitment == 5}colspan="9"{else}colspan="8"{/if}><div class="message">{$translate.no_data_available}</div></td>
                        {/foreach}

                    </tbody>
                </table>
            </div>
            </div>
<div class="row-fluid">
<div class="interview_submit span12">
    {if $type_recruitment == '0'}
        <div class="interview_dates">
            <p>{$translate.date_of_interview} </p>
            <div style="float:left; margin-right:3px; margin-top:3px;">
                <input class="date_pick_input" type="text" value="" id="date" name="Date_of_Interview">
            </div> 
            <div style="float:left;">
                <input name="save" type="button" id="save_recut" value="{$translate.give_interview_date}" class="submit_btn" onclick="submit_form('2');" style="margin-top:3px;margin-left:3px;padding: 2px;">
            </div>
        </div>
    {elseif $type_recruitment != '0' && $type_recruitment != '5'}
        <div style="float:left;">
            <!--<input style="padding: 2px 4px;margin-left: 20px" name="save" type="button" id="save_recut"{if $type_recruitment == '1'}value="{$translate.mark_attended}"{/if}{if $type_recruitment == '2'}value="{$translate.mark_shortlisted}"{/if}{if $type_recruitment == '3'}value="{$translate.mark_offer_letter_send}"{/if}{if $type_recruitment == '4'}value="{$translate.mark_employee}"{/if} class="submit_btn" onclick="submit_form('5');"> -->
            <input style="padding: 2px 4px;margin-left: 20px" name="save" type="button" id="save_recut"{if $type_recruitment == '1'}value="{$translate.mark_employee}"{/if} class="submit_btn" onclick="submit_form('5');">
        </div>
        {if $type_recruitment == 1}
            <div style="float: left;margin-left: 18px;display: none;" id="re_date">
                <input class="date_pick_input" type="text" value="" id="date" name="Date_of_Interview">
            </div>
            <div style="float: left">
                <input style="padding: 2px 4px;margin-left: 20px" name="save_new_date" type="button" id="save_new_date" value="{$translate.reschedule_date}" onclick="rescheduleInterview()"/>
            </div>
        {/if}
        
    {/if}
</div>
</div>
</form>
</div>
    </div></div>
{/block}