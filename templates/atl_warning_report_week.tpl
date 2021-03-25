{block name="style"}
<link type="text/css" rel="stylesheet" href="../css/employee_details.css">
{/block}
{block name='script'}
<script type="text/javascript">
$(document).ready(function(){
{assign j 0}
    {foreach $warning_reports AS $warning}
        {if isset($warning.data[0]['date']) && ($warning.data[0]['date'] != "" || $warning.data[0]['date'] != NULL)}
        {if $warning.count != 0}
            $("#first_{$j}").append('<th rowspan="{$warning.count}" style="text-align: center">{$warning.sum}</th>');
         {/if}
             {assign j $j+1}
        {/if}
    {/foreach}
});

function submitForm(){
    $("#forms").submit();
}
</script>
{/block}
{block name="content"}
<div id="wrapper">
    <div class="employee_details">
        <div class="tbl_hd"> <span class="titles_tab">{$translate.atl_warning}</span> <a class="back" href="javascript:void(0);" onclick="submitForm();"><span class="btn_name">{$translate.backs}</span></a> 
       <!-- <div class="tbl_hd"> <span class="titles_tab">{$translate.atl_warning}</span> <a class="back" href="{$url_path}atl/warning/"><span class="btn_name">{$translate.backs}</span></a> 
            <a class="back" onclick="navigatePage('http://192.168.0.234/works/app/t2v/cirrus/forms/');" href="javascript:void(0);" >Tillbaka</a>--> 
        </div>
        <div id="tble_list">
            <div class="employee_print_details">

                <div class="employee_details_inner" style="border:none;">


                    <!--finish here-->

                    <form name="forms" id="forms" method="post" action="{$url_path}atl/warning/">
                        <input type="hidden" name="month"  id="month" value="{$month}" />
                        <input type="hidden" name="year" id="year" value="{$year}" />
                        <input type="hidden" name="get_report" id="get_report" value="1" />
                    </form>


                    <div name="employee_block" id="employee_block">

                        <div class="employe_searchdetail clearfix">
                            <div class="employ_box">
                                <div class="employ">{$translate.employee}  :</div>
                                <div class="employ_name">{$employee.last_name} {$employee.first_name}</div>
                            </div>
                            <div class="employ_box">
                                <div class="employ_month">{$translate.monthly}  :</div>
                                <div class="employ_monthlyhrs">{$monthly} hrs</div>
                            </div>
                            <div class="employ_box">
                                <div class="employ_week">{$translate.weekly}  :</div>
                                <div class="employ_weeklyhrs">{$weekly} hrs</div>
                            </div>
                        </div>

                        <div class="serch_weekdetails">
                            {assign i 0}
                            {foreach $warning_reports AS $warning}
                                {if isset($warning.data[0]['date']) && ($warning.data[0]['date'] != "" || $warning.data[0]['date'] != NULL)}
                            <div class="week_num">Vecka {$warning.week}</div>
                            <table class="table_list tbl_padding_fix">
                                <tbody><tr>
                                        <th width="105">{$translate.date}</th>
                                        <th width="105">{$translate.day}</th>
                                        <th width="105">{$translate.from}</th>
                                        <th width="105">{$translate.to}</th>
                                        <th width="105">{$translate.extra}</th>
                                        <th width="105">{$translate.total}</th></tr>
                                    {assign k 0}
                                    {foreach $warning.data AS $data}
                                    <tr {if $k == 0}class="odd first" id="first_{$i}"{else}class="odd"{/if}>  
                                        
                                        <td style="text-align: center">{$data.date}</td>
                                        <td style="text-align: center">{$data.day}</td>
                                        <td style="text-align: center">{$data.time_from}</td>
                                        <td style="text-align: center">{$data.time_to}</td>
                                        <td style="text-align: center">{$data.extra_hours}</td>
                                            {assign k $k+1}
                                    </tr>
                                    {foreachelse}
                                        <tr class="odd">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th>00</th>
                                    </tr>
                                    {/foreach}
                                
                                    {assign i $i+1}
                                </tbody>
                            </table>
                                {/if}
                            {/foreach}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{/block}