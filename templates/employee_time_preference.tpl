{block name='style'}
<link rel="stylesheet" href="{$url_path}css/jquery-ui-new.css" />
<link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
<link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" />
<link rel="stylesheet" type="text/css" href="{$url_path}css/inconvenient-timings.css" media="all" />  

{/block}

{block name="script"}
{*<script src="{$url_path}js/jquery.ui.datepicker.js" type="text/javascript" ></script>*}
{* <script src="{$url_path}js/date-picker.js"></script> *}
<script src="{$url_path}js/jquery-ui.js"></script>
<script src="{$url_path}js/date-picker.js"></script>
<script src="{$url_path}js/bootbox.js"></script>

<script>

    
    

   $(document).ready(function() {   
    

    

    // var hide_show_flag = 0;
    // $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    // $(window).resize(function(){
    //   $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
    // });
    
    var a = $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '{$lang}',

    });

    $(".form_dates").datepicker('setDate', new Date());   
    var days = 1;
    var datePicker = $('.form_dates').datepicker().on('changeDate', function(ev) {
        var splt_date1 = (String($('#from_date').val())).split("-");
        var splt_date2 = (String($('#to_date').val())).split("-");
        var date1 = new Date(splt_date1[0], splt_date1[1]-1, splt_date1[2]);
        var date2 = new Date(splt_date2[0], splt_date2[1]-1, splt_date2[2]);
        var diffc = date1.getTime() - date2.getTime();
        days = Math.round(Math.abs(diffc/(1000*60*60*24)));
        if(days > 7){
            $('#days_div').show();
        }
        else{
            $('#days_div').hide();
        }
    });

    
    $(".cancel-new-equipment").click(function() {
         $(".main-left").css('width', '99%');
        $(".main-right").css('display', 'none');
    });

    $(".btn-addnew-inconvtiming").click(function() {  
        $(".main-left").css('width', '66%');
        $(".main-right").css('width', '33%');
         
        $(".main-right, .oncall-box").css('display', 'block');
        $('#hidden_action').val('newentry');
        
        
    
        $( "#format" ).buttonset();
                        
        $('html, body').animate({
            scrollTop: $(".main-right").offset().top
        }, 3000);
    });
    
    // var stickyPanelOptions = {
    //     topPadding: 3,
    //     afterDetachCSSClass: "stickyPanelDetached",
    //     savePanelSpace: true,
    //     parentSelector: '#stickyPanelParent'
    // };
    
    // $("#btnGroupStickyPanel").stickyPanel(stickyPanelOptions);
    
    $('#submit1').on('click', function(e){
        //e.preventDefault();
        error = 0;
        if($('#frmdate').val()){
            var splt_date1 = (String($('#frmdate').val())).split("-");
            date1 = new Date(splt_date1[0], splt_date1[1]-1, splt_date1[2]);
        }else{
            bootbox.alert('{$translate.fill_date_fields}', function(result){  });
            error = 1;
        }
        if($('#todate').val()){
            var splt_date2 = (String($('#todate').val())).split("-");
            date2 = new Date(splt_date2[0], splt_date2[1]-1, splt_date2[2]);
        }else{
            bootbox.alert('{$translate.fill_date_fields}', function(result){  });
            error = 1;
        }

        if(date1 > date2){
            bootbox.alert('{$translate.to_date_greater_than_from_date}', function(result){  });
            error = 1;
        }
        if (error == 0) {
            $('#hidden_action').val('list');
            $('#time_preference_form').submit();
            return true;
        }else{
            e.preventDefault();
        }
    });
});

function validate(){
        var date1 = '';
        var date2 = '';
        error = 0;
        if($('#from_date').val()){
            var splt_date1 = (String($('#from_date').val())).split("-");
            date1 = new Date(splt_date1[0], splt_date1[1]-1, splt_date1[2]);
        }else{
            bootbox.alert('{$translate.fill_date_fields}', function(result){  });
            error = 1;
        }
        if($('#to_date').val()){
            var splt_date2 = (String($('#to_date').val())).split("-");
            date2 = new Date(splt_date2[0], splt_date2[1]-1, splt_date2[2]);
        }else{
            bootbox.alert('{$translate.fill_date_fields}', function(result){  });
            error = 1;
        }

        if(date1 > date2){
            bootbox.alert('{$translate.to_date_greater_than_from_date}', function(result){  });
            error = 1;
        }
        
        var inc_days_selected = false;
        if($('#days_div').is(":visible")){
        //alert($('#days_div').html());               
            for(var i=1;i<=7;i++){
                if($("#check"+i).is(":checked") != false)
                    inc_days_selected = true;
            }
            if(!inc_days_selected){
                bootbox.alert('{$translate.select_one_day}', function(result){  });
                error = 1;
            }
        }else{
            $('#days_div .check').prop('checked', false);
        }
    
    if(error == 0){
        $('#hidden_action').val('newentry');
        $('#time_preference_form').submit();
    }
        
}

function backForm() {
{*    document.location.href = '{if $privileges_general.add_employee == 1 || $privileges_general.edit_employee == 1}{$url_path}employee/add/{$employees_username}/{else}{$url_path}employee/administration/{$employees_username}/{/if}';*}
    //document.location.href = '{if $privileges_general.add_employee == 1 || $privileges_general.edit_employee == 1}{$url_path}list/employee/{if $employee_detail[0].status == '0'}inact{else}act{/if}/{else}{$url_path}employee/administration/{$employees_username}/{/if}';
    window.history.back();
}
</script>
<script type="text/javascript">

function delLeave(id){

    bootbox.dialog( '{$translate.do_you_want_to_delete_the_leave}', [{
            "label" : "{$translate.no}",
            "class" : "btn-primary"
        }, {
            "label" : "{$translate.yes}",
            "class" : "btn-primary",
            "callback": function() {
                $('#hidden_action').val('del_id');
                $('#hidden_action_val').val(id);
                $('#time_preference_form').submit();
            }
    }]);
    

}

function delGrpLeave(id){
     bootbox.dialog( '{$translate.do_you_want_to_delete_the_leave_grp}', [{
            "label" : "{$translate.no}",
            "class" : "btn-primary"
        }, {
            "label" : "{$translate.yes}",
            "class" : "btn-primary",
            "callback": function() {
                $('#hidden_action').val('del_grp_id');
                $('#hidden_action_val').val(id);
                $('#time_preference_form').submit();
            }
    }]);

}

function pdfdownload(){ 
    var emp = document.getElementById("hdn_employee").value;    
    var host = document.getElementById("url").value;    
    var url = host+"emptimepreference/pdfdwonload/emp/";
    url += emp+'/';
    
    myWindow=window.open(url,'Employee Preference Time Data PDF','width=200,height=100');
    myWindow.focus();
    return false;   
}

{if $employee_username != ""}


    function redirectConfirm(mode){
        var redirectURL = mode.replace("%%C-UNAME%%", "{$employee_username}");
        if(redirectURL != ''){
            document.location.href = redirectURL;
        }
    }
    
    /*function loadAddEmployee(){
        document.location.href = "{$url_path}employee/add/{if isset($employee_username)}{$employee_username}/{/if}";
    }
    
    function loadContract(){
        document.location.href = "{$url_path}employment/contract/pdf/{if isset($employee_username)}{$employee_username}/{/if}";
    }

    function loadNotification(){
        document.location.href = "{$url_path}employee/notification/{if isset($employee_username)}{$employee_username}/{/if}";
    }

    function loadPrivilege(){
        document.location.href = "{$url_path}employee/privileges/{if isset($employee_username)}{$employee_username}/{/if}";
    }

    function loadPrifferedTime(){
        document.location.href = "{$url_path}emptime/preference/{if isset($employee_username)}{$employee_username}/{/if}";
    }


    function loadSalary(){
        document.location.href = "{$url_path}employee/list/salary/{if isset($employee_username)}{$employee_username}/{/if}";
    }

    function loadDocumentation(){
        document.location.href = "{$url_path}employee/documentations/{if isset($employee_username)}{$employee_username}/{/if}";
    }

    function loadSkills(){
        document.location.href = "{$url_path}employee/skills/{if isset($employee_username)}{$employee_username}/{/if}";
    }

    function loadWorkSettings(){
        document.location.href = "{$url_path}employee/work/settings/{if isset($employee_username)}{$employee_username}/{/if}";
    }*/

{/if}
</script>
{/block}
{block name="content"}
    

    <div class="row-fluid">
    <form method="post" id="time_preference_form" name="time_preference_form">
        <div class="span12 main-left boxscroll">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1>{$translate.employee_profile}</h1>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                {if $employee_username != ""}
                    <div class="widget option-panel-widget" style="margin: 0px 0px 15px ! important;">
                        <div class="widget-body" style="padding:4px;">
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
                    {if $employee_username != ""} 
                        <div class="span12">
                            {block name="employee_manage_tab_content"}{/block}
                        </div>
                    {/if}  

                    <div role="tabpanel" class="tab-pane active" id="tab-8">
                        <div class="span12">
                            <div class="widget" style="margin: 10px 0px ! important;">
                                <!--WIDGET BODY BEGIN-->
                                <div class="widget-header span12">
                                    <div class="span4 day-slot-wrpr-header-left span6">
                                        <h1>{$translate.employee_time_preference}</h1>
                                    </div>
                                    <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 5px;">
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm()"><span class="icon-arrow-left"></span> {$translate.backs}</button>
                                        <button class="btn btn-default btn-normal pull-right btn-addnew-inconvtiming" type="button"><span class="icon-plus" ></span> {$translate.add_new}</button>
                                    </div>
                                </div>
                                
                                    <input type="hidden" name="url" id="url" value="{$url_path}" />    
                                    <div style="" class="span12 widget-body-section input-group">
                                        <div class="row-fluid">
                                            {$message}
                                        </div>
                                        <div class="row-fluid">
                                            <div style="color:red; display:none;" align="center" id="errormsg" >{$translate.todate_greaterthan_fromdate_error}</div>
                                            {if $errorMessage != ''}<div style="color:red; " align="center" id="posterrormsg" >{$errorMessage}</div>{/if}
                                            {if $deleteMessage != ''} {$deleteMessage} {/if}
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span3">
                                                <div style="margin: 0px;" class="span12">
                                                    <label style="float: left;" class="span12" for="exampleInputEmail1">Från datum :</label>
                                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                        <input class="form-control span9" type="text" name="frmdate" id="frmdate" maxlength="11" value="{$frmdate}" /> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span3">
                                                <div style="margin: 0px;" class="span12">
                                                    <label style="float: left;" class="span12" for="exampleInputEmail1">Till Datum :</label>
                                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker datepicker span12"> <span class="add-on icon-calendar"></span>
                                                        <input class="form-control span9" type="text" name="todate" id="todate" maxlength="11" value="{$todate}" /> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span1" style="padding-top: 20px;"> 
                                                <input class="btn btn-default" type="button" value="{$translate.show}" id="submit1" name="submit1" />
                                                <input type="hidden" id="hdn_employee" name="hdn_employee" value="{$employees_username}" />
                                                <input type="hidden" id="hdn_tot_employee" name="hdn_tot_employee" value="{$emp_count}" />
                                            </div>
                                            <div class="span5" style="padding-top: 20px;">
                                                <div class="pull-right">
                                                    <a href="javascript:void(0);" onclick="pdfdownload();" class="btn btn-default" ><i class="icon-file-text"></i></a>
                                                    <a href="javascript:void(0);" id="email" class="btn btn-default" ><i class="icon-envelope"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        {if !empty($special_leaves)}
                                        <div>
                                            <table class="table table-bordered table-primary table-striped table-vertical-center" style="width: 50%; margin-top: 10px;">
                                                <thead>
                                                    <tr>
                                                        <th>{$translate.date}</th>
                                                        <th>{$translate.delete}</th>
                                                        <th>{$translate.comment}</th>
                                                        <th>{$translate.group_delete}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {foreach $special_leaves as $special_leave}
                                                        {$grp_status = true}
                                                        {foreach $special_leave as $leave_entry}
                                                            <tr>
                                                                <td>{$leave_entry.date}</td>
                                                                <td align="center"><a href="javascript:void(0);" onclick="delLeave('{$leave_entry.id}')"><i class="icon-trash" style="font-size: 16px"; title="{$translate.delete}"></i></a></td>
                                                                {if $grp_status}
                                                                    <td align="center" rowspan="{count($special_leave)}" style="width: 40%">{$leave_entry.comment}</td>
                                                                    <td align="center" rowspan="{count($special_leave)}"><a href="javascript:void(0);" onclick="delGrpLeave('{$leave_entry.group_id}')"><i class="icon-remove" style="font-size: 30px; color:red; -webkit-text-stroke:2px white;"; title="{$translate.delete_grp}"></i></a></td>
                                                                {/if}
                                                            </tr>
                                                            {$grp_status = false}
                                                        {/foreach}
                                                    {/foreach}
                                                </tbody>
                                            </table>
                                        </div>
                                        {/if}
                                    </div>
                        
                            </div>

                                 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: block;  margin-top: 5px;margin-left: 5px;" class="span4 main-right" id="stickyPanelParent">
            {* <form name="timing" id="timing" method="post"> *}
                <div class="span12 oncall-box" style="margin-left: 0px; display: block;">
                    <div style="margin: 0px ! important;" class="widget">
                        <div class="widget-header span12">
                            <h1>{$translate.employee_work_excempted_days}</h1>
                            <input type="hidden" name="action" id="hidden_action" value="" />
                            <input type="hidden" name="action_val" id="hidden_action_val" value="" />
                        </div>    
                        <div class="span12 widget-body-section input-group">

                            <div class="row-fluid mb" id="btnGroupStickyPanel">
                                <div class="span12" style="margin: 0px ! important;"> 
                                    <button class="btn btn-success span6" style="text-align: center;" type="button" onclick="validate();"><span class="icon-save"></span> {$translate.save}</button>
                                    <button class="btn btn-danger span6 cancel-new-equipment no-ml" style="text-align: center;" type="button"><span class="icon-chevron-left"></span> {$translate.cancel}</button>
                                </div>
                            </div>
                            <div class="row-fluid" id="edit_form_section">
                                <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                    

                                    <div style="margin: 0px ! important;" class="span12 no-ml date_to">
                                        <label style="float: left;" class="span12" for="date_to">{$translate.from_date}</label>
                                        <div class="input-prepend  hasDatepicker date datepicker no-pr no-mr span11" style="margin: 0px;">
                                            <div class="input-prepend hasDatepicker date datepicker no-pr no-mr span11" style="padding: 0px;">
                                                <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span11 form_dates"  name="from_date" id="from_date" value="" type="text" readonly="readonly"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="margin: 0px ! important;" class="span12 no-ml date_to">
                                        <label style="float: left;" class="span12" for="date_to">{$translate.to_date}</label>
                                        <div class="input-prepend  hasDatepicker date datepicker no-pr no-mr span11" style="margin: 0px;">
                                            <div class="input-prepend hasDatepicker date datepicker no-pr no-mr span11" style="padding: 0px;">
                                                <span class="add-on icon-calendar"></span>
                                                    <input class="form-control form_dates span11"  name="to_date" id="to_date" value="" type="text" readonly="readonly"/>
                                            </div>
                                        </div>
                                    </div>
                                    

                                                   
                                        

                                    <div style="margin: 0px; display: none;" class="span12" id="days_div">
                                        <label style="float: left;" class="span12">{$translate.days}</label>
                                        <div id="format">
                                            <input type="checkbox" id="check1" class="check checkBoxClass" name="mon" value="1" checked="checked" /><label for="check1">{$translate.mon}</label>
                                            <input type="checkbox" id="check2" class="check checkBoxClass" name="tue" value="2" checked="checked" /><label for="check2">{$translate.tue}</label>
                                            <input type="checkbox" id="check3" class="check checkBoxClass" name="wed" value="3" checked="checked" /><label for="check3">{$translate.wed}</label>
                                            <input type="checkbox" id="check4" class="check checkBoxClass" name="thu" value="4" checked="checked" /><label for="check4">{$translate.thu}</label>
                                            <input type="checkbox" id="check5" class="check checkBoxClass" name="fri" value="5" checked="checked" /><label for="check5">{$translate.fri}</label>
                                            <input type="checkbox" id="check6" class="check checkBoxClass" name="sat" value="6" checked="checked" /><label for="check6">{$translate.sat}</label>
                                            <input type="checkbox" id="check7" class="check checkBoxClass" name="sun" value="7" checked="checked" /><label for="check7">{$translate.sun}</label>
                                        </div>
                                    </div>

                                    <div style="margin: 0px ! important;" class="span12 no-ml date_to">
                                        <label style="float: left;" class="span12" for="leave_comment">{$translate.leave_comment}</label>
                                        <div class="input-prepend  no-pr no-mr span11" style="margin: 0px;">
                                            <div class="input-prepend no-pr no-mr span11" style="padding: 0px;">
                                                    <textarea class="form-control span12"  name="leave_comment" id="leave_comment" value=""></textarea> 
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            {* </form>   *}
        </div>
    </form>    
    </div>
{/block}