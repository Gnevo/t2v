{block name="style"}
    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
    <style type="text/css" media="screen">
      #tbl-summary td {
          padding: 2px 14px;
      }
    </style>
{/block}
{block name="script"}
<script src="{$url_path}js/jquery.ui.datepicker.js" type="text/javascript" ></script>
<script src="{$url_path}js/jquery.event.drag-2.0.min.js"></script>
<script>
    $(document).ready(function() {
		$(".titles_tab").hide();
/*
$("#fdate").blur(function() {
    if($("#fdate").val()==""){
             $("#fdate").addClass("error");
       }
       else{
             $("#fdate").removeClass("error");
       }
});
*/

    $("#fdate").datepicker({ldelim}
    showOn: "button",
    buttonImage: "{$url_path}images/date_pic.gif",
    buttonImageOnly: true
    {rdelim});
	
	$("#tdate").datepicker({ldelim}
    showOn: "button",
    buttonImage: "{$url_path}images/date_pic.gif",
    buttonImageOnly: true
    {rdelim});
    

});
</script>
{/block}
{block name="content"}
    <div class="row-fluid">
    <div class="span12 main-left">
        
        <div class="tbl_hd"><span class="titles_tab">{$translate.customer_monthly_report}</span>
    <a href="{$url_path}reports/" class="back">{$translate.backs}</a>
    </div>
    
   
     {if ($errormessage == 1)}
    <div style="color:red;" align="center"	>{$translate.no_access_error_message} </div>
    {else}  
    <div id="tble_list">
        <div class="row-fluid">
            <div class="option_strip span12" style="padding-bottom: 10px;">
       
    
        
    <form method="post" action="" >
        <div class="row-fluid">
        <div class="span12" style="margin-bottom: 10px;">
        <div class="span4">
            {$translate.customer} <select name="customer" onchange="submit();" style="width:180px;">
        <option>{$translate.select}</option>
        <option value="All" {if $cust == 'All'} selected="selected" {/if}>{$translate.all}</option>
        {foreach from=$customers item=customer}
            <option value="{$customer.username}" {if $cust == $customer.username} selected="selected" {/if}>{if $sort_by_name == 2}{$customer.last_name} {$customer.first_name}{elseif $sort_by_name == 1}{$customer.first_name} {$customer.last_name}{/if}</option>
        {/foreach}
    </select>
	</div>
	{if (!empty($customer_detail) ) || $cust == 'All'}
        <div class="span4">    
	{$translate.social_security}:
	{$customer_detail.century}{$social_security}
	</div>
        <div class="span4">
	{$translate.fk}<input type="text" id="beloppfk" name="beloppfk" value="{$beloppfk}"  size="5" style="width:75px; margin-top: 5px;"/>
	{$translate.kn}<input type="text" id="beloppkn" name="beloppkn" value="{$beloppkn}" size="5" style="width:75px; margin-top: 5px;"/>
	{$translate.tu}<input type="text" id="belopptu" name="belopptu" value="{$belopptu}" size="5" style="width:75px; margin-top: 5px;"/>
        </div>
        </div></div>
	<div class="row-fluid">
        <div class="span12" style="margin-bottom: 10px;">
        <div class="span4">    
            {$translate.date_from}*
            <input class="date_pick_input" type="text" value="{$fdate}" id="fdate" name="from_date" style="margin-top:5px;">
        </div>
        <div class="span4">
            {$translate.date_to}*
            <input class="date_pick_input" type="text" value="{$tdate}" id="tdate" name="to_date" style="margin-top:5px;">
        </div>
        <div class="span2">
            <input type="submit" value=" {$translate.show} " name="check" style="margin-top:5px;" />
        </div>    
    </div></div>
        {if $cust != 'All'}
	<div class="row-fluid">
            <div class="span12">
        <div class="span3">    
	{$translate.select_period} ({$translate.fk})
            <select id="fkdate" name="fkdate">
                <option value="">{$translate.select}</option>
                {foreach from=$fkperiods item=period}
                    <option value="{$period.id}" {if $fkdate == $period.id} selected="selected" {/if}>{$period.date_from} - {$period.date_to}		                    </option>
                {/foreach}
			 </select>
        </div>
                         <div class="span3">                 
	{$translate.select_period} ({$translate.kn})
            <select id="kndate" name="kndate">
                <option value="">{$translate.select}</option>
                {foreach from=$knperiods item=period}
                    <option value="{$period.id}" {if $kndate == $period.id} selected="selected" {/if}>{$period.date_from} - {$period.date_to}		                    </option>
                {/foreach}
			 </select>
                         </div>
                         <div class="span3">                 
	{$translate.select_period} ({$translate.tu})
            <select id="tudate" name="tudate">
                <option value="">{$translate.select}</option>
                {foreach from=$tuperiods item=period}
                    <option value="{$period.id}" {if $tudate == $period.id} selected="selected" {/if}>{$period.date_from} - {$period.date_to}		                    </option>
                {/foreach}
			 </select>
                         </div>
                         <div class="span2" style="margin-top:20px;">         
		<input type="submit" value=" {$translate.show} " name="dropdown_check" />
                </div>
	
        </div></div>
        {/if}        
        {/if}
	
</form>
  </div>
        
  </div>
  
  {if $showform == '1'}
      <div class="row-fluid">
       
  <div class="span12" style="margin:10px;">
  
  {if $data['hide_fk']!='1'}
      {if $hide == 1}
        
  <div style="float:left" class="span4">
  	<table style="margin:10px; text-align:right;" id="tbl-summary" >
    	<tr>
        	<td style="width:200px; background:#DAF2F7;"><b>{$translate.granded_hours}</b></td>
            <td style="width:90px;">{$data['fk_granted']}</td>
        </tr>
        <tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.used_hours}</b></td> 
            <td style="width:90px;"><font color="{$data['fk_color']}">{$data['fk_used']}</font></td>
        </tr>
        <tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.diff}</b></td>
            <td style="width:90px;"><font color="{$data['fk_color']}">{$data['fk_diff']}</font></td>
        </tr>
		 <tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.diff_in_per}</b></td>
            <td style="width:90px;"><font color="{$data['fk_color']}">{$data['fk_diff_per']}</font></td>
        </tr>
		<tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.belopp_fk}</b></td>
            <td style="width:90px;">{$beloppfk}</td>
        </tr>
		<tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.sum}</b></td>
            <td style="width:90px;"><font color="{$data['fk_color']}">{$fksum}</font></td>
        </tr>
        <tr>
          <td style="width:90px; background:#DAF2F7;"><b>{$translate.used_hours_including_unmanned}</b></td> 
            <td style="width:90px;"><font color="{$data['fk_color']}">{$data['fk_used_including_unmanned']}</font></td>
        </tr>
        <tr>
          <td style="width:90px; background:#DAF2F7;"><b>{$translate.unmanned_hours}</b></td> 
            <td style="width:90px;"><font color="{$data['fk_color']}">{$data['fk_unmanned_hours']}</font></td>
        </tr>
    </table>
  </div>
  {/if}
  {/if}
  {if $data['hide_kn']!='1'}
      {if $hide1 == 1}
          <div style="float:left" class="span4">
  	<table style="margin:10px; text-align:right;" id="tbl-summary">
    	<tr>
        	<td style="width:200px; background:#DAF2F7;"><b>{$translate.granded_hours}</b></td>
            <td style="width:90px;">{$data['kn_granted']}</td>
        </tr>
        <tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.used_hours}</b></td>
            <td style="width:90px;"><font color="{$data['kn_color']}">{$data['kn_used']}</font></td>
        </tr>
        <tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.diff}</b></td>
            <td style="width:90px;"><font color="{$data['kn_color']}">{$data['kn_diff']}</font></td>
        </tr>
		<tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.diff_in_per}</b></td>
            <td style="width:90px;"><font color="{$data['kn_color']}">{$data['kn_diff_per']}</font></td>
        </tr>
		<tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.belopp_kn}</b></td>
            <td style="width:90px;">{$beloppkn}</td>
        </tr>
		<tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.sum}</b></td>
            <td style="width:90px;"><font color="{$data['fk_color']}">{$knsum}</font></td>
        </tr>
        <tr>
          <td style="width:90px; background:#DAF2F7;"><b>{$translate.used_hours_including_unmanned}</b></td> 
            <td style="width:90px;"><font color="{$data['fk_color']}">{$data['kn_used_including_unmanned']}</font></td>
        </tr>
        <tr>
          <td style="width:90px; background:#DAF2F7;"><b>{$translate.unmanned_hours}</b></td> 
            <td style="width:90px;"><font color="{$data['fk_color']}">{$data['kn_unmanned_hours']}</font></td>
        </tr>
    </table>
  </div>
  {/if}
  {/if}
  
  {if $data['hide_tu']!='1'}
      {if $hide2 == 1}
          <div style="float:right" class="span4">
  	<table style="margin:10px; text-align:right;" id="tbl-summary">
    	<tr>
        	<td style="width:200px; background:#DAF2F7;"><b>{$translate.granded_hours}</b></td>
            <td style="width:90px;">{$data['tu_granted']}</td>
        </tr>
        <tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.used_hours}</b></td>
            <td style="width:90px;"><font color="{$data['kn_color']}">{$data['tu_used']}</font></td>
        </tr>
        <tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.diff}</b></td>
            <td style="width:90px;"><font color="{$data['kn_color']}">{$data['tu_diff']}</font></td>
        </tr>
		<tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.diff_in_per}</b></td>
            <td style="width:90px;"><font color="{$data['kn_color']}">{$data['tu_diff_per']}</font></td>
        </tr>
		<tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.belopp_tu}</b></td>
            <td style="width:90px;">{$belopptu}</td>
        </tr>
		<tr>
        	<td style="width:90px; background:#DAF2F7;"><b>{$translate.sum}</b></td>
            <td style="width:90px;"><font color="{$data['fk_color']}">{$tusum}</font></td>
        </tr>
        <tr>
          <td style="width:90px; background:#DAF2F7;"><b>{$translate.used_hours_including_unmanned}</b></td> 
            <td style="width:90px;"><font color="{$data['fk_color']}">{$data['tu_used_including_unmanned']}</font></td>
        </tr>
        <tr>
          <td style="width:90px; background:#DAF2F7;"><b>{$translate.unmanned_hours}</b></td> 
            <td style="width:90px;"><font color="{$data['fk_color']}">{$data['tu_unmanned_hours']}</font></td>
        </tr>
    </table>
  </div>
  {/if}
  {/if}
  
  </div>
  </div>
  {/if}
  
  {if $cust != '' && $cust != 'All'}
      <div class="row-fluid">
      <div class="span12">
          <table class="table_list" style="width:100%">
        <tr>
            <th>{$translate.name}</th>
          {if $hide == 1}  <th>{$translate.fk}</th> {/if}
          {if $hide1 == 1}  <th>{$translate.kn}</th> {/if}
          {if $hide2 == 1}  <th>{$translate.tu}</th> {/if}
           {if $hide1 == 1 && $hide == 1 && $hide2 == 1} <th>{$translate.total}</th>{/if}
        </tr>
        {foreach from=$details item=detail}
            <tr class="{cycle values="even,odd"}">
                {if $sort_by_name == 1}
                    <td>{$detail.first_name} {$detail.last_name}</td>
                {elseif $sort_by_name == 2}
                    <td>{$detail.last_name} {$detail.first_name}</td>
                {/if}
                
               {if $hide == 1} <td style="text-align: center">{if isset($detail.time_sum_fk)}{$detail.time_sum_fk}{else}0.00{/if}</td> {/if}
               {if $hide1 == 1} <td style="text-align: center">{if isset($detail.time_sum_kn)}{$detail.time_sum_kn}{else}0.00{/if}</td> {/if}
               {if $hide2 == 1} <td style="text-align: center">{if isset($detail.time_sum_tu)}{$detail.time_sum_tu}{else}0.00{/if}</td> {/if}
                {if $hide1 == 1 && $hide == 1 && $hide2 == 1} <td style="text-align: center">{$detail.total}</td> {/if}
                
                    
            </tr>
       {foreachelse}
           <tr><td colspan="8">
                   <div class="message">{$translate.no_data_available}</div>
           </td></tr>
       {/foreach}
    </table></div></div>
  {/if}    
  </div>
   {/if} 
  </div></div>
{/block}