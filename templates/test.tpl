{block name="script"}
<script type="text/javascript">
function sign_remove()
{
    
    var month = $("#sel_month").val();
    var year = $("#sel_year").val();
    var employee = $("#sel_employee").val();
    if(month != "" && year != "" && employee != ""){
        $("#emp_login").html("");
        //alert('halooo');
        $.ajax({
                async:false,
                url:"{$url_path}ajax_employee_signing_remove.php",
                data:"month="+month+"&year="+year+"&emp="+employee,
                type:"POST",
                success:function(data){
                        $("#emp_login").html(data);
                }
//ajax_employee_signing_remove
            });
    }
    
}

function sign_remove_single(type, section)
{
    
    var month = $("#sel_month").val();
    var year = $("#sel_year").val();
    var employee = $("#sel_employee").val();
    if(month != "" && year != "" && employee != ""){
        $.ajax({
                async:false,
                url:"{$url_path}ajax_employee_signing_remove.php",
                data:"month="+month+"&year="+year+"&emp="+employee+"&type="+type,
                type:"POST",
                success:function(data){
                        $("#"+section).html(data);
                }
//ajax_employee_signing_remove
            });
    }
    
}
function check()
{
    //alert("hi");             
    var uname = $("#username").val();
    var pword = $("#password").val();
    var month = $("#sel_month").val();
    var year = $("#sel_year").val();
    var employee = $("#sel_employee").val();
    
    if(uname == "" || pword == "")
    {
    $("#signing_message").html("{$translate.username_or_password_missing}");
    $("#signing_message").addClass("signing_error");
    $("#signing_message").removeClass("signing_success");
    }
    else if(employee == "")
    {
    $("#signing_message").html("{$translate.select_one_employee}");
    $("#signing_message").addClass("signing_error");
    $("#signing_message").removeClass("signing_success");
    }
    else if(month != "" && year != "" && employee != ""){
        $("#signing_message").html("");
        $.ajax({
                async:false,
                url:"{$url_path}ajax_employee_signing.php",
                data:"UN="+uname+"&PW="+pword+"&month="+month+"&year="+year+"&emp="+employee,
                type:"POST",
                success:function(data){
                        $("#emp_login").html(data);
                }

        });
    }

}

function printForm(){
    if($("#sel_month").val() != "" && $("#sel_year").val() != "" && $("#sel_employee").val() != ""){
        var f = $("#form_report");
        f.attr('target', '_BLANK');
        $('#action').val('print');
        f.submit();
    }
//    $('#action').val('print');
//    $('#forms').submit();
//    if($("#cmb_employee").val() != "" && $("#lstTidStart").val() != "" && $("#lstTidSlut").val() != ""){
//        var f = $("#forms");
//        f.attr('target', '_BLANK');
//        $('#action').val('print');
//        f.submit();
//    }
}

</script>
{/block}
{block name="content"}
{if $flag_emp_access == 1}
<div class="tbl_hd"><span class="titles_tab">{$translate.employee_monthly_report}</span>
    <a onclick="printForm()" href="javascript:void(0)" class="print"><span class="btn_name">{$translate.print}</span></a>
    <a href="{$back_url}" class="back"><span class="btn_name">{$translate.backs}</span></a>
</div>
    
{if $login_user_role eq 1 OR $login_user_role eq 2 OR $login_user_role eq 3 OR $login_user_role eq 7}
    {if $sign_status eq "false" and ($rpt_content_normal or $rpt_content_oncall or $rpt_content_leave or $rpt_content_over or $rpt_content_quality or $rpt_content_more or $rpt_content_some or $rpt_content_training or $rpt_content_personal or $rpt_content_calltraining or $rpt_content_leave_over or $rpt_content_leave_quality or $rpt_content_leave_more or $rpt_content_leave_some or $rpt_content_leave_training or $rpt_content_leave_personal or $rpt_content_leave_oncall or $rpt_content_leave_calltraining)}
        <div id="emp_login" name="emp_login" class="emp_login" style="overflow: hidden;">
            <div class="signed_list" id="signed_list">
                <span id="span_emp_sign"  style="line-height: 25px;">
                    {if $signing_details.signin_employee neq ''}
                        {$translate.signed_by} {$signing_details.signin_employee_name} {$translate.on} {$signing_details.signin_date}
                        {*if $login_user_role eq 1 or $is_suTL}
                            <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove_single(1,'span_emp_sign')" title="{$translate.delete}"></a>
                        {/if*}
                    {else}
                        {$translate.unsigned}
                    {/if}({$translate.employee})
                </span><br/>
                <span id="span_TL_sign"  style="line-height: 25px;">
                    {if $signing_details.signin_tl neq ''}
                        {$translate.signed_by} {$signing_details.signin_tl_name} {$translate.on} {$signing_details.signin_tl_date}
                        {*if $login_user_role eq 1 or $is_suTL}
                            <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove_single(2,'span_TL_sign')" title="{$translate.delete}"></a>
                        {/if*}
                    {else}
                        {$translate.unsigned}
                    {/if}(TL)    
                </span><br/>
                <span id="span_suTL_sign"  style="line-height: 25px;">
                    {if $signing_details.signin_sutl neq ''}
                        {$translate.signed_by} {$signing_details.signin_sutl_name} {$translate.on} {$signing_details.signin_sutl_date}
                        {*if $login_user_role eq 1 or $is_suTL}
                            <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove_single(3,'span_suTL_sign')" title="{$translate.delete}"></a>
                        {/if*}
                    {else}
                        {$translate.unsigned}
                    {/if}(SuperTL)
                </span>
            </div>
            {if $report_year < $now_year || ($report_month <= $now_month && $report_year == $now_year)}    
            <span id="signing" class="signing">
                <span id="signing_message" name="signing_message" class="signing_error"></span>
                <span class="signing_form">
                    <label for="username">{$translate.username}</label>
                    <input name="username" id="username" type="text" />

                    <label for="password">{$translate.password}</label>
                    <input name="password" id="password" type="password" />
                </span>

                <a name="login" id="login" class="signin" href="javascript:void(0)" onclick="check()">{$translate.signin}</a>
            </span>
            {/if}
        </div>
    {else if $sign_status eq "true" and ($rpt_content_normal or $rpt_content_oncall or $rpt_content_leave or $rpt_content_over or $rpt_content_quality or $rpt_content_more or $rpt_content_some or $rpt_content_training or $rpt_content_personal or $rpt_content_calltraining or $rpt_content_leave_over or $rpt_content_leave_quality or $rpt_content_leave_more or $rpt_content_leave_some or $rpt_content_leave_training or $rpt_content_leave_personal or $rpt_content_leave_oncall or $rpt_content_leave_calltraining)}
        <div id="emp_login" name="emp_login" class="emp_login" style="overflow: hidden;">
            <div class="signed_list" id="signed_list">
                <span id="span_emp_sign"  style="line-height: 25px;">
                    {if $signing_details.signin_employee neq ''}
                        {$translate.signed_by} {$signing_details.signin_employee_name} {$translate.on} {$signing_details.signin_date}
                        {*if $login_user_role eq 1 or $is_suTL}
                            <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove_single(1,'span_emp_sign')" title="{$translate.delete}"></a>
                        {/if*}
                    {else}
                        {$translate.unsigned}
                    {/if}({$translate.employee})
                </span><br/>
                <span id="span_TL_sign"  style="line-height: 25px;">
                    {if $signing_details.signin_tl neq ''}
                        {$translate.signed_by} {$signing_details.signin_tl_name} {$translate.on} {$signing_details.signin_tl_date}
                        {*if $login_user_role eq 1 or $is_suTL}
                            <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove_single(2,'span_TL_sign')" title="{$translate.delete}"></a>
                        {/if*}
                    {else}
                        {$translate.unsigned}
                    {/if}(TL)    
                </span><br/>
                <span id="span_suTL_sign"  style="line-height: 25px;">
                    {if $signing_details.signin_sutl neq ''}
                        {$translate.signed_by} {$signing_details.signin_sutl_name} {$translate.on} {$signing_details.signin_sutl_date}
                        {*if $login_user_role eq 1 or $is_suTL}
                            <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove_single(3,'span_suTL_sign')" title="{$translate.delete}"></a>
                        {/if*}
                    {else}
                        {$translate.unsigned}
                    {/if}(SuperTL)
                </span>
            </div>
            <span id="signing" class="signing">
                <span id="signing_message" name="signing_message" class="signing_success">
                    {$translate.this_employee_already_signin}
                </span>
                {if $login_user_role eq 1}
                    <a name="login" id="login" class="delete" href="javascript:void(0)" onclick="sign_remove()" title="{$translate.delete}"></a>
                {/if}
            </span>
        </div>
    {/if}
{/if}
<div id="tble_list"> 

    <div class="pagention">

        {if $report_month == ""}  
            {$report_month = ($smarty.now|date_format:"%m")+0}
        {/if}
        {if $report_year == ""}  
            {$report_year = $smarty.now|date_format:"%Y"}
        {/if}
        <div class="alphbts" style="width: 98.5%; margin-top: 5px;">
            
            <form id="form_report" method="post">
                {$translate.month}: {$month_name}
                &nbsp;&nbsp;&nbsp;&nbsp;
                Period: {$report_year}-{$rpt_month}-01 -- {$report_year}-{$rpt_month}-{$cur_month_last_date}
                &nbsp;&nbsp;&nbsp;&nbsp;
            
                {*$translate.month}:{$report_month*}
                <input type="hidden" id="sel_month" name="sel_month" value="{$report_month}">
                
                {*$translate.year}:{$report_year*}
                <input type="hidden" id="sel_year" name="sel_year" value="{$report_year}">
                
                <span style="float: right;">
                    {$translate.employee}: {$employee_name}
                    <input type="hidden" id="sel_employee" name="sel_employee" value="{$employee_id}">
                </span>
                <input type="hidden" name="action" id="action" value="" />
            </form>
        </div>

    </div>
    <div id="content_table" name="content_table" style="width:871px; overflow: scroll; min-height: 400px; margin-left:6px">
        {if $rpt_content_normal || $rpt_content_oncall || $rpt_content_leave || $rpt_content_over || $rpt_content_quality || $rpt_content_more || $rpt_content_some || $rpt_content_training || $rpt_content_personal || $rpt_content_calltraining || $rpt_content_leave_over || $rpt_content_leave_quality || $rpt_content_leave_more || $rpt_content_leave_some || $rpt_content_leave_training || $rpt_content_leave_personal || $rpt_content_leave_oncall || $rpt_content_leave_calltraining}
            <table class="table_list" width="1500px" id="cont_table">
                <tr align="center">
                    <th width="50px">{$translate.date}</th>

                    {foreach from=$sub_keys_normal item=entries1}  
                        <th width="50px">{$entries1}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_over item=entries1}  
                        <th width="50px">{if $entries1 == "overtime"}{$translate.overtime}{else}{$entries1}<br>{$translate.overtime}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_quality item=entries1}  
                        <th width="50px">{if $entries1 == "qual_overtime"}{$translate.qual_overtime}{else}{$entries1}<br>{$translate.qual_overtime}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_more item=entries1}  
                        <th width="50px">{if $entries1 == "more_time"}{$translate.more_time}{else}{$entries1}<br>{$translate.more_time}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_some item=entries1}  
                        <th width="50px">{if $entries1 == "some_other_time"}{$translate.some_other_time}{else}{$entries1}<br>{$translate.some_other_time}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_training item=entries1}  
                        <th width="50px">{if $entries1 == "training"}{$translate.training_time}{else}{$entries1}<br>{$translate.training_time}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_personal item=entries1}  
                        <th width="50px">{if $entries1 == "personal_meeting"}{$translate.personal_meeting}{else}{$entries1}<br>{$translate.personal_meeting}{/if}</th>
                    {/foreach}
                    
                                        
                    {if $sub_keys_normal || $sub_keys_over || $sub_keys_quality || $sub_keys_more || $sub_keys_some || $sub_keys_training || $sub_keys_personal}
                        <th width="50px" style="background:#F5BE87">{$translate.work_sum_ord}</th>
                    {/if}
                    
                    {foreach from=$sub_keys_oncall item=entries1}  
                        <th width="50px">{if $entries1 == 'jour'}Jour{elseif stripos(' '|cat:$entries1,'jour')}{$entries1}{else}Jour<br>{$entries1}{/if}</th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_calltraining item=entries1}  
                        <th width="50px">{if $entries1 == 'call_training'}{$translate.call_training}{else}{$entries1}<br>{$translate.call_training}{/if}</th>
                    {/foreach}
                    
                    {if $sub_keys_oncall || $sub_keys_calltraining}
                        <th width="50px" style="background:#F5BE87">{$translate.work_sum_jour}</th>
                    {/if}
                    {if $sub_keys_normal || $sub_keys_over || $sub_keys_quality || $sub_keys_more || $sub_keys_some || $sub_keys_training || $sub_keys_personal || $sub_keys_oncall || $sub_keys_calltraining}
                        <th width="50px" >{$translate.work_sum}</th>
                    {/if}
                    {foreach from=$sub_keys_leave_normal_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            {if $entries1 == 1}<th width="50px" style="background:#F9DDDD">Sjuk
                            {else if $entries1 == 2}<th width="50px" style="background:#F9DDDD">Sem
                            {else if $entries1 == 3}<th width="50px" style="background:#F9DDDD">VAB
                            {else if $entries1 == 4}<th width="50px" style="background:#F9DDDD">FP
                            {else if $entries1 == 5}<th width="50px" style="background:#F9DDDD">möte
                            {else if $entries1 == 6}<th width="50px" style="background:#F9DDDD">Utbild
                            {else if $entries1 == 7}<th width="50px" style="background:#F9DDDD">Övrigt
                            {else if $entries1 == 8}<th width="50px" style="background:#F9DDDD">Byte
                            {else}

                            {/if}       
                            {$entries2}
                        {/foreach}
                        </th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_over_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            {if $entries1 == 1}<th width="50px" style="background:#F9DDDD">Sjuk
                            {else if $entries1 == 2}<th width="50px" style="background:#F9DDDD">Sem
                            {else if $entries1 == 3}<th width="50px" style="background:#F9DDDD">VAB
                            {else if $entries1 == 4}<th width="50px" style="background:#F9DDDD">FP
                            {else if $entries1 == 5}<th width="50px" style="background:#F9DDDD">möte
                            {else if $entries1 == 6}<th width="50px" style="background:#F9DDDD">Utbild
                            {else if $entries1 == 7}<th width="50px" style="background:#F9DDDD">Övrigt
                            {else if $entries1 == 8}<th width="50px" style="background:#F9DDDD">Byte
                            {else}

                            {/if}       
                            <br>
                            {if stripos(' '|cat:$entries2,'overtime')}{$translate.$entries2}{else}{$entries2}<br>{$translate.overtime}{/if}
                        {/foreach}
                        </th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_quality_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            {if $entries1 == 1}<th width="50px" style="background:#F9DDDD">Sjuk
                            {else if $entries1 == 2}<th width="50px" style="background:#F9DDDD">Sem
                            {else if $entries1 == 3}<th width="50px" style="background:#F9DDDD">VAB
                            {else if $entries1 == 4}<th width="50px" style="background:#F9DDDD">FP
                            {else if $entries1 == 5}<th width="50px" style="background:#F9DDDD">möte
                            {else if $entries1 == 6}<th width="50px" style="background:#F9DDDD">Utbild
                            {else if $entries1 == 7}<th width="50px" style="background:#F9DDDD">Övrigt
                            {else if $entries1 == 8}<th width="50px" style="background:#F9DDDD">Byte
                            {else}

                            {/if}       
                            <br>
                            {if stripos(' '|cat:$entries2,'qual_overtime')}{$translate.$entries2}{else}{$entries2}<br>{$translate.qual_overtime}{/if}
                        {/foreach}
                        </th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_more_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            {if $entries1 == 1}<th width="50px" style="background:#F9DDDD">Sjuk
                            {else if $entries1 == 2}<th width="50px" style="background:#F9DDDD">Sem
                            {else if $entries1 == 3}<th width="50px" style="background:#F9DDDD">VAB
                            {else if $entries1 == 4}<th width="50px" style="background:#F9DDDD">FP
                            {else if $entries1 == 5}<th width="50px" style="background:#F9DDDD">möte
                            {else if $entries1 == 6}<th width="50px" style="background:#F9DDDD">Utbild
                            {else if $entries1 == 7}<th width="50px" style="background:#F9DDDD">Övrigt
                            {else if $entries1 == 8}<th width="50px" style="background:#F9DDDD">Byte
                            {else}

                            {/if}       
                            <br>
                            {if stripos(' '|cat:$entries2,'more_time')}{$translate.$entries2}{else}{$entries2}<br>{$translate.more_time}{/if}
                        {/foreach}
                        </th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_some_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            {if $entries1 == 1}<th width="50px" style="background:#F9DDDD">Sjuk
                            {else if $entries1 == 2}<th width="50px" style="background:#F9DDDD">Sem
                            {else if $entries1 == 3}<th width="50px" style="background:#F9DDDD">VAB
                            {else if $entries1 == 4}<th width="50px" style="background:#F9DDDD">FP
                            {else if $entries1 == 5}<th width="50px" style="background:#F9DDDD">möte
                            {else if $entries1 == 6}<th width="50px" style="background:#F9DDDD">Utbild
                            {else if $entries1 == 7}<th width="50px" style="background:#F9DDDD">Övrigt
                            {else if $entries1 == 8}<th width="50px" style="background:#F9DDDD">Byte
                            {else}

                            {/if}       
                            <br>
                            {if stripos(' '|cat:$entries2,'some_other_time')}{$translate.$entries2}{else}{$entries2}<br>{$translate.some_other_time}{/if}
                        {/foreach}
                        </th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_training_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            {if $entries1 == 1}<th width="50px" style="background:#F9DDDD">Sjuk
                            {else if $entries1 == 2}<th width="50px" style="background:#F9DDDD">Sem
                            {else if $entries1 == 3}<th width="50px" style="background:#F9DDDD">VAB
                            {else if $entries1 == 4}<th width="50px" style="background:#F9DDDD">FP
                            {else if $entries1 == 5}<th width="50px" style="background:#F9DDDD">möte
                            {else if $entries1 == 6}<th width="50px" style="background:#F9DDDD">Utbild
                            {else if $entries1 == 7}<th width="50px" style="background:#F9DDDD">Övrigt
                            {else if $entries1 == 8}<th width="50px" style="background:#F9DDDD">Byte
                            {else}

                            {/if}
                            <br>
                            {if stripos(' '|cat:$entries2,'training')}{$translate.$entries2}{else}{$entries2}<br>{$translate.training}{/if}
                        {/foreach}
                        </th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_personal_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            {if $entries1 == 1}<th width="50px" style="background:#F9DDDD">Sjuk
                            {else if $entries1 == 2}<th width="50px" style="background:#F9DDDD">Sem
                            {else if $entries1 == 3}<th width="50px" style="background:#F9DDDD">VAB
                            {else if $entries1 == 4}<th width="50px" style="background:#F9DDDD">FP
                            {else if $entries1 == 5}<th width="50px" style="background:#F9DDDD">möte
                            {else if $entries1 == 6}<th width="50px" style="background:#F9DDDD">Utbild
                            {else if $entries1 == 7}<th width="50px" style="background:#F9DDDD">Övrigt
                            {else if $entries1 == 8}<th width="50px" style="background:#F9DDDD">Byte
                            {else}

                            {/if}       
                            <br>
                            {if stripos(' '|cat:$entries2,'personal_meeting')}{$translate.$entries2}{else}{$entries2}<br>{$translate.personal_meeting}{/if}
                        {/foreach}
                        </th>
                    {/foreach}
                    
                    {if !empty($sub_keys_leave_normal_head) || !empty($sub_keys_leave_over_head) || !empty($sub_keys_leave_quality_head) || !empty($sub_keys_leave_more_head) || !empty($sub_keys_leave_some_head) || !empty($sub_keys_leave_training_head) || !empty($sub_keys_leave_personal_head)}<th width="50px" style="background:#F5BE87">{$translate.leave_sum_ord}</th>{/if}
                    
                    {foreach from=$sub_keys_leave_oncall_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            {if $entries1 == 1}<th width="50px" style="background:#F9DDDD">Sjuk
                            {else if $entries1 == 2}<th width="50px" style="background:#F9DDDD">Sem
                            {else if $entries1 == 3}<th width="50px" style="background:#F9DDDD">VAB
                            {else if $entries1 == 4}<th width="50px" style="background:#F9DDDD">FP
                            {else if $entries1 == 5}<th width="50px" style="background:#F9DDDD">möte
                            {else if $entries1 == 6}<th width="50px" style="background:#F9DDDD">Utbild
                            {else if $entries1 == 7}<th width="50px" style="background:#F9DDDD">Övrigt
                            {else if $entries1 == 8}<th width="50px" style="background:#F9DDDD">Byte
                            {else}

                            {/if}       
                            {$entries2}
                        {/foreach}
                        </th>
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_calltraining_head item=entries3}
                        
                        {foreach from=$entries3 key=entries1 item=entries2}
                            {if $entries1 == 1}<th width="50px" style="background:#F9DDDD">Sjuk
                            {else if $entries1 == 2}<th width="50px" style="background:#F9DDDD">Sem
                            {else if $entries1 == 3}<th width="50px" style="background:#F9DDDD">VAB
                            {else if $entries1 == 4}<th width="50px" style="background:#F9DDDD">FP
                            {else if $entries1 == 5}<th width="50px" style="background:#F9DDDD">möte
                            {else if $entries1 == 6}<th width="50px" style="background:#F9DDDD">Utbild
                            {else if $entries1 == 7}<th width="50px" style="background:#F9DDDD">Övrigt
                            {else if $entries1 == 8}<th width="50px" style="background:#F9DDDD">Byte
                            {else}

                            {/if}       
                            {if stripos(' '|cat:$entries2,'call_training')}{$translate.$entries2}{else}{$entries2}<br>{$translate.call_training}{/if}
                        {/foreach}
                        </th>
                    {/foreach}
                    
                    {if !empty($sub_keys_leave_oncall_head) || !empty($sub_keys_leave_calltraining_head)}<th width="50px" style="background:#F5BE87">{$translate.leave_sum_oncall}</th>{/if}
                    {if !empty($sub_keys_leave_normal_head) || !empty($sub_keys_leave_over_head) || !empty($sub_keys_leave_quality_head) || !empty($sub_keys_leave_more_head) || !empty($sub_keys_leave_some_head) || !empty($sub_keys_leave_training_head) || !empty($sub_keys_leave_personal_head) || !empty($sub_keys_leave_oncall_head) || !empty($sub_keys_leave_calltraining_head)}<th width="50px" style="background:#F9DDDD">{$translate.leave_sum}</th>{/if}
                
            </tr>

            {assign var=i value=0}
            {assign var=sum_sum_hour value=0}
            {assign var=sum_sum_hour_ord value=0}
            {assign var=sum_sum_hour_jour value=0}
            {assign var=sum_sum_hour_leave value=0}
            {assign var=sum_sum_hour_leave_oncall value=0}
            {foreach $days_in_month as $day_in_month}
                <tr align="center">

                    {assign var=sum_hour value=0}
                    {assign var=sum_hour_ord value=0}
                    {assign var=sum_hour_jour value=0}
                    {assign var=sum_hour_leave value=0}
                    {assign var=sum_hour_leave_oncall value=0}
                    {assign var=j value=0}
                    {assign var=tot value=array() scope="global"}
                    <td width="50px" style="padding:5px 2px;">{substr($day_in_month,5)} {substr($translate.{$day_in_month|date_format:"%a"|lower},0,3)}{*utf8_encode(substr($translate.{$day_in_month|date_format:"%a"|lower},1,1))|lower*}</td>

                    {foreach from=$sub_keys_normal item=entries1}
                        {if $rpt_content_normal.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_normal.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_normal.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_normal.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_over item=entries1}
                        {if $rpt_content_over.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_over.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_over.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_over.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_quality item=entries1}
                        {if $rpt_content_quality.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_quality.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_quality.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_quality.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_more item=entries1}
                        {if $rpt_content_more.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_more.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_more.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_more.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_some item=entries1}
                        {if $rpt_content_some.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_some.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_some.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_some.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_training item=entries1}
                        {if $rpt_content_training.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_training.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_training.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_training.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_personal item=entries1}
                        {if $rpt_content_personal.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_personal.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_personal.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_ord" value=$sum_hour_ord + $rpt_content_personal.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {if $sub_keys_normal || $sub_keys_over || $sub_keys_quality || $sub_keys_more || $sub_keys_some || $sub_keys_training || $sub_keys_personal}
                         <td style="background:#F5BE87">{if $sum_hour_ord}{round($sum_hour_ord,2)}{else}&nbsp;{/if}</td>
                        {assign var="sum_sum_hour_ord" value= ($sum_sum_hour_ord + $sum_hour_ord)}
                    {/if}
                    
                    {foreach from=$sub_keys_oncall item=entries1}  
                        {if $rpt_content_oncall.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_oncall.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_oncall.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_jour" value=$sum_hour_jour + $rpt_content_oncall.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {foreach from=$sub_keys_calltraining item=entries1}  
                        {if $rpt_content_calltraining.{$day_in_month}.{$entries1}}
                            <td>{round($rpt_content_calltraining.{$day_in_month}.{$entries1},2)}</td>
                            {assign var="sum_hour" value=$sum_hour + $rpt_content_calltraining.{$day_in_month}.{$entries1}}
                            {assign var="sum_hour_jour" value=$sum_hour_jour + $rpt_content_calltraining.{$day_in_month}.{$entries1}}
                        {else}
                            <td>&nbsp;</td>
                        {/if}
                    {/foreach}
                    
                    {if $sub_keys_oncall || $sub_keys_calltraining}
                         <td style="background:#F5BE87">{if $sum_hour_jour}{round($sum_hour_jour,2)}{else}&nbsp;{/if}</td>
                        {assign var="sum_sum_hour_jour" value= ($sum_sum_hour_jour + $sum_hour_jour)}
                    {/if}
                    {if $sub_keys_normal || $sub_keys_over || $sub_keys_quality || $sub_keys_more || $sub_keys_some || $sub_keys_training || $sub_keys_personal || $sub_keys_oncall || $sub_keys_calltraining}
                    <td>{if $sum_hour}{round($sum_hour,2)}{else}&nbsp;{/if}</td>
                    {assign var="sum_sum_hour" value= ($sum_sum_hour + $sum_hour)}
                    {/if}
                    {foreach from=$sub_keys_leave_normal_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_over_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_over.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_over.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_over.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}

                    {foreach from=$sub_keys_leave_quality_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_quality.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_quality.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_quality.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_more_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_more.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_more.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_more.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_some_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_some.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_some.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_some.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_training_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_training.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_training.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_training.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_personal_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_personal.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_personal.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave" value=$sum_hour_leave + $rpt_content_leave_personal.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    {if $sub_keys_leave_normal_head || $sub_keys_leave_over_head || $sub_keys_leave_quality_head || $sub_keys_leave_more_head || $sub_keys_leave_some_head || $sub_keys_leave_training_head || $sub_keys_leave_personal_head}
                        <td style="background:#F5BE87">{if $sum_hour_leave}{round($sum_hour_leave,2)}{else}&nbsp;{/if}</td>
                    {/if}
                    
                    {assign var="sum_sum_hour_leave" value= ($sum_sum_hour_leave + $sum_hour_leave)}
                    
                    {foreach from=$sub_keys_leave_oncall_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_oncall.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_oncall.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave_oncall" value=$sum_hour_leave_oncall + $rpt_content_leave_oncall.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    {foreach from=$sub_keys_leave_calltraining_head item=entries3}
                        {foreach from=$entries3 key=entries2 item=entries1}
                             {if $rpt_content_leave_calltraining.$day_in_month.$entries2.$entries1}
                                <td style="background:#F9DDDD">{round($rpt_content_leave_calltraining.$day_in_month.$entries2.$entries1,2)}</td>
                                {assign var="sum_hour_leave_oncall" value=$sum_hour_leave_oncall + $rpt_content_leave_calltraining.$day_in_month.$entries2.$entries1}
                            {else}
                                <td style="background:#F9DDDD">&nbsp;</td>
                            {/if}
                        {/foreach}
                    {/foreach}
                    
                    
                    {if $sub_keys_leave_oncall_head || $sub_keys_leave_calltraining_head}
                        <td style="background:#F5BE87">{if $sum_hour_leave_oncall}{round($sum_hour_leave_oncall,2)}{else}&nbsp;{/if}</td>
                    {/if}
                    {if $sub_keys_leave_normal_head || $sub_keys_leave_over_head || $sub_keys_leave_quality_head || $sub_keys_leave_more_head || $sub_keys_leave_some_head || $sub_keys_leave_training_head || $sub_keys_leave_personal_head || $sub_keys_leave_oncall_head || $sub_keys_leave_calltraining_head}
                        <td style="background:#F9DDDD">{if $sum_hour_leave || $sum_hour_leave_oncall}{round($sum_hour_leave + $sum_hour_leave_oncall,2)}{else}&nbsp;{/if}</td>
                    {/if}
                    {assign var="sum_sum_hour_leave_oncall" value= ($sum_sum_hour_leave_oncall + $sum_hour_leave_oncall)}
                    
                </tr>
            {/foreach}
            <tr align="center">
                <td>{$translate.sum}</td>
                {foreach from=$sum_normal item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                {foreach from=$sum_over item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                {foreach from=$sum_quality item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                {foreach from=$sum_more item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                {foreach from=$sum_some item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                
                {foreach from=$sum_training item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                
                {foreach from=$sum_personal item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                
                {if $sub_keys_normal || $sub_keys_over || $sub_keys_quality || $sub_keys_more || $sub_keys_some || $sub_keys_training || $sub_keys_personal}
                     <td style="background:#F5BE87">{round($sum_sum_hour_ord,2)}</td>
                {/if}
                
                {foreach from=$sum_oncall item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                
                {foreach from=$sum_calltraining item=entries1}
                    <td>{round($entries1,2)}</td>
                {/foreach}
                
                {if $sub_keys_oncall || $sub_keys_calltraining}
                     <td style="background:#F5BE87">{round($sum_sum_hour_jour,2)}</td>
                {/if}
                
                {if $sub_keys_normal || $sub_keys_over || $sub_keys_quality || $sub_keys_more || $sub_keys_some || $sub_keys_training || $sub_keys_personal || $sub_keys_oncall || $sub_keys_calltraining}
                <td>{round($sum_sum_hour,2)}</td>
                {/if}
                
                {foreach from=$sum_leave_normal_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach}
                {foreach from=$sum_leave_over_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach}
                {foreach from=$sum_leave_quality_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach}
                {foreach from=$sum_leave_more_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach}
                {foreach from=$sum_leave_some_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach}
                {foreach from=$sum_leave_training_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach}
                {foreach from=$sum_leave_personal_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach}
                {if $sum_leave_normal_inconv || $sum_leave_over_inconv || $sum_leave_quality_inconv || $sum_leave_more_inconv || $sum_leave_some_inconv || $sum_leave_training_inconv || $sum_leave_personal_inconv}
                    <td style="background:#F5BE87">{round($sum_sum_hour_leave,2)}</td>
                {/if}
                {foreach from=$sum_leave_oncall_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach}
                {foreach from=$sum_leave_calltraining_inconv item=entries2}
                    {foreach from=$entries2 item=entries1}
                        <td style="background:#F9DDDD">{round($entries1,2)}</td>
                    {/foreach}
                {/foreach}
                {if $sum_leave_oncall_inconv || $sum_leave_calltraining_inconv}
                    <td style="background:#F5BE87">{round($sum_sum_hour_leave_oncall,2)}</td>
                {/if}
                {if $sum_leave_normal_inconv || $sum_leave_over_inconv || $sum_leave_quality_inconv || $sum_leave_more_inconv || $sum_leave_some_inconv || $sum_leave_training_inconv || $sum_leave_personal_inconv || $sum_leave_oncall_inconv || $sum_leave_calltraining_inconv}
                    <td style="background:#F9DDDD">{round($sum_sum_hour_leave + $sum_sum_hour_leave_oncall,2)}</td>
                {/if}
            </tr>    

        </table>
    {else}
        <div class="fail">{$translate.leave_not_approved}</div>   
    {/if}
</div>
</div>
{else}
<div class="fail">{$translate.permission_denied}</div>    
{/if}  
{/block}
