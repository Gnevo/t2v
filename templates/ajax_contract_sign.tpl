{block name='script'}
<script type="text/javascript">
    function load_salary(){
        var date_inconv = $("#inconv_select").val();
        var date_normal = $("#normal_select").val();
        $("#kunder_link").parent().removeClass("active");
        $("#utbildning_link").parent().removeClass("active"); 
        $("#dokumentation_link").parent().removeClass("active"); 
        $("#arvode_link").parent().removeClass("active"); 
        $("#arvode_link").parent().addClass("active");
        $("#skill_div").hide();
        $("#Kunder").load("{$url_path}ajax_contract_sign.php?normal_select="+date_normal+"&inconv_select="+date_inconv);
    }
</script>
{/block}
{block name="content"}
<div class="lon_anst">
<div style="float: left;margin-right: 3px; padding-left:7px;"><span>{$translate.contract_sign}</span>
        
    </div> </div>
<div class="content_inner">
    <table width="550" border="0" cellspacing="0" cellpadding="0" class="em_table_details">
        {foreach from=$contracts item=contract}
            <tr class="{cycle values="em_table_inner,em_table_inner_white"}"><td class="border"><a id="contract_{$contract.id}" href="javascript:void(0);" onclick="contractDownload('{$contract.id}')" >{$contract.customer_name} {$contract.alloc_date}</a></td> {if $contract.sign_date == NULL || $contract.alloc_date == ""}<td><input type="button" name="sign_{$contract.id}" id="sign_{$contract.id}" onclick="signContract('{$contract.id}')" value="{$translate.sign}" /></td>{else}<td>{$translate.signed}</td>{/if}</tr>
        {foreachelse}
            <div class="message">{$translate.no_data_available}</div>
        {/foreach}
        
   
    </table>
    <form>
        <input type="hidden" name="contract_ids" id="contract_ids" value="{$contract.id}" />
    </form>
</div>

<div class="lon_anst">
    
    <div style="float: left;margin-right: 3px; padding-left:7px;"><span>{$translate.normal_effect_from}</span>
        <select onchange="load_salary()" name="normal_select" id="normal_select">
            <option value="0">{$translate.select}</option>
            {foreach $employee_normal_dates AS $dates}
                <option {if $dates.id == $normal_last_id}selected="selected"{/if} value="{$dates.id}">{$dates.effect_from}</option> 
            {/foreach}
        </select>
    </div> 
    <div style="float:right;margin-right: 10px;"><span style="font-weight:bold;">{if $normal_salaries.effect_to == '0000-00-00'}{else} - {$normal_salaries.effect_to}{/if}</div> 
    <div style="float:right; margin-right:8px;"><span style="font-weight:bold;">{$normal_salaries.effect_from}</span></div></div>
    
    <div class="content_inner">
    <table width="550" cellspacing="0" cellpadding="0" border="0" class="em_table_details">
        {if $employee_normal_dates}
    <tbody>
        <tr class="em_table_inner">
            <td width="475" class="border">{$translate.normal}</td>
            <td width="87" class="border">{$normal_salaries.normal}</td>
        </tr>
        <tr class="em_table_inner_white">
            <td class="border">{$translate.travel}</td>
            <td class="border">{$normal_salaries.travel}</td>
        </tr>
        <tr class="em_table_inner">
            <td width="475" class="border">{$translate.break}</td>
            <td width="87" class="border">{$normal_salaries.break}</td>
        </tr>
        <tr class="em_table_inner_white">
            <td class="border">{$translate.oncall}</td>
            <td class="border">{$normal_salaries.oncall}</td>
        </tr>
        <tr class="em_table_inner">
            <td width="475" class="border">{$translate.overtime}</td>
            <td width="87" class="border">{$normal_salaries.overtime}</td>
        </tr>
        <tr class="em_table_inner_white">
            <td class="border">{$translate.qual_overtime}</td>
            <td class="border">{$normal_salaries.quality_overtime}</td>
        </tr>
        <tr class="em_table_inner">
            <td width="475" class="border">{$translate.more_time}</td>
            <td width="87" class="border">{$normal_salaries.more_time}</td>
        </tr>
        <tr class="em_table_inner_white">
            <td class="border">{$translate.some_other_time}</td>
            <td class="border">{$normal_salaries.some_other_time}</td>
        </tr>
        <tr class="em_table_inner">
            <td width="475" class="border">{$translate.training_time}</td>
            <td width="87" class="border">{$normal_salaries.training_time}</td>
        </tr>
        <tr class="em_table_inner_white">
            <td class="border">{$translate.call_training}</td>
            <td class="border">{$normal_salaries.call_training}</td>
        </tr>
        <tr class="em_table_inner">
            <td width="475" class="border">{$translate.personal_meeting}</td>
            <td width="87" class="border">{$normal_salaries.personal_meeting}</td>
        </tr>
        <tr class="em_table_inner_white">
            <td class="border">{$translate.holiday_big}</td>
            <td class="border">{$normal_salaries.holiday_big}</td>
        </tr>
        <tr class="em_table_inner">
            <td width="475" class="border">{$translate.holiday_red}</td>
            <td width="87" class="border">{$normal_salaries.holiday_red}</td>
        </tr>
  </tbody>
</table>
{else}
   <div class="message">{$translate.no_data_available}</div> 
{/if}
</div>
<div class="lon_anst"><div style="float: left;margin-right: 3px; padding-left:7px;"><span>{$translate.inconv_effect_from}</span>
        <select onchange="load_salary()" name="inconv_select" id="inconv_select">
            <option value="0">{$translate.select}</option>
            {foreach $employee_inconvenient_dates AS $inconv_dates}
                              <option {if $inconv_last_id ==  $inconv_dates.id}selected="selected"{/if} value="{$inconv_dates.id}">{$inconv_dates.effect_from}</option>
             {/foreach}         
          </select></div> <div style="float:right;margin-right: 10px;"> <span style="font-weight:bold;">{if $effects.effect_to == '0000-00-00'}{else} - {$effects.effect_to}{/if}</div> 
          <div style="float:right; margin-right:8px;"><span style="font-weight:bold;">{$effects.effect_from}</span></div> </div>
         <div class="content_inner">
          <table width="550" cellspacing="0" cellpadding="0" border="0" class="em_table_details" style="border:1px solid #E0E0E0; ">
           {if $employee_inconvenient_dates}
              <tbody>
            {foreach $inconveninet_salaries AS $salaries}
                <tr class="{cycle values="em_table_inner,em_table_inner_white"}">
                    <td class="border">{$salaries.name}</td>
                    <td>{$salaries.amount}</td>
                  </tr>
            {/foreach}
                
    
  </tbody>
  {else}
     <div class="message">{$translate.no_data_available}</div> 
  {/if}
</table>
 </div     
{/block}