<script>
    $(document).ready(function (){
            $('#scrolling').jScrollPane();
    });
</script>
{if $action eq 'goto_employee'}
    <div class="cstmr_wk_main">
            <div class="select_skill_scroller" style="max-height: 380px;">
                <div class="select_skill_title">{$translate.select_employee}</div>
                <div id="scrolling_area"> 
                    <div id="scrolling" style="max-height: 270px;">
                        <ul>
                            {foreach $righclick_employees AS $empl}
                                <li id="a" onclick="$('#right_click_change_type').dialog('close'); navigatePage('{$url_path}/employee/gdschema/{$week_year}/{$empl.username}/',1)">{if $sort_by_name == 1}{$empl.first_name} {$empl.last_name}{elseif $sort_by_name == 2}{$empl.last_name} {$empl.first_name}{/if}</li>
                            {foreachelse}
                                <div class="message">{$translate.no_data_available}</div>
                            {/foreach}
                        </ul>
                    </div>
                </div>
            </div> 
            <div style="clear:both;"></div>
    </div>
    <div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
        <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#right_click_change_type').dialog('close');" href="javascript:void(0)">{$translate.cancel}</a>
    </div>
{else if $action eq 'goto_customer'}
    <div class="cstmr_wk_main">
            <div class="select_skill_scroller" style="max-height: 380px;">
                <div class="select_skill_title">{$translate.select_customer}</div>
                <div id="scrolling_area"> 
                    <div id="scrolling" style="max-height: 270px;">
                        <ul>
                            {foreach $righclick_customers AS $cust}
                                <li id="a" onclick="$('#right_click_change_type').dialog('close'); navigatePage('{$url_path}/customer/gdschema/{$week_year}/{$cust.username}/',1)">{if $sort_by_name == 1}{$cust.first_name} {$cust.last_name}{elseif $sort_by_name == 2}{$cust.last_name} {$cust.first_name}{/if}</li>
                            {foreachelse}
                                <div class="message">{$translate.no_data_available}</div>
                            {/foreach}
                        </ul>
                    </div>
                </div>
            </div> 
            <div style="clear:both;"></div>
    </div>
    <div class="clearfix" id="cancel_button_div" style="border-top:1px solid #DDDDDD;margin-top:5px;height:38px;">
        <a class="alocation_btn" style="float:right; display:block; margin:8px 15px 0px 0px;" onclick="$('#right_click_change_type').dialog('close');" href="javascript:void(0)">{$translate.cancel}</a>
    </div>
{else if $action eq 'goto_week'}
    <script>
        function goWeek(){
            var week = $("#week_select").val();
            var year = $("#cmb_year").val();
            $('#right_click_change_type').dialog('close');
            if (week == '{$end_week + 1}'){
                week = '01';
                year = parseInt(year)+1;
                navigatePage('{$url_path}/customer/gdschema/'+year+'|'+week+'/{$page_user}/',1)
            }else{
                navigatePage('{$url_path}/customer/gdschema/'+year+'|'+week+'/{$page_user}/',1)
            }
        }
    </script>
    <div style="margin:22px 0 0 22px">
        {$translate.week} 
        <select id="week_select" style="width:50px;">
            {for $foo=$start to $end_week}
                <option value="{$foo}" {if $report_week == $foo}selected="selected"{/if}>{$foo}</option>
            {/for}
            {if $less_1 == 1}<option value="{$end_week + 1}">{$end_week + 1}</option>{/if}
        </select>
        {$translate.year} 
        <select id="cmb_year" name="year">
            {html_options values=$year_option_values selected=$report_year output=$year_option_values}
        </select>
        {if $report_year == ""} {$report_year = $smarty.now|date_format:"%Y"} {/if}
        <input type="button" name="go_week" id="go_week" onclick="goWeek()" style="width:50px; margin-left: 10px" value="{$translate.go}"/>
    </div>
{/if}