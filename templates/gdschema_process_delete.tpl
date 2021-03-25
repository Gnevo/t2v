{block name='script'}
<script type="text/javascript">
    $(document).ready(function() {
        getAfterDates();     
    });

    function getAfterDates(){
        max_week_number = 52;
        var year_week = '{$cur_date}';
        var year = parseInt({$cur_year_of_week}, 10);
        var to_week = parseInt($("#from_wk").val()) + (parseInt($("#from_option").val()));
        if (to_week > max_week_number) {
            to_week = to_week - max_week_number;
            year = year + 1;
        }
        $('#to_wk').find('option').remove();
        for (i = 0; i < 40; i++) {
            if (to_week > max_week_number) {
                to_week = 1;
                year = year + 1;
            }
            $('<option value="' + year + '-' + to_week + '">' + year + ':' + to_week + '</option>').appendTo("#to_wk");
            to_week = to_week + 1;
        }
    }
    
    function save_schema_delete(){
        var days = "";
        for (var i = 0; i < document.frm_delete.days.length; i++) {
            if (document.frm_delete.days[i].checked)
                days += document.frm_delete.days[i].value + '-';
        }
        if (days == '') {
            alert('select days');
        } else {
            $('#chk_status').val('1');
            wrapLoader("#delete_multiple_save");
            $('#delete_multiple_save').load('{$url_path}ajax_process_schema_delete.php?customer={$customer}&employee={$employee}&date={$cur_date}&from_week=' + $('#from_wk').val() + '&from_option=' + $('#from_option').val() + '&to_week=' + $('#to_wk').val() + '&id={$slot_details.id}&sel_slots={$sel_slots}&days=' + days + '&action=copy_multiple&user={$in_user}', function(response, status, xhr) {
                uwrapLoader("#delete_multiple_save");
            });
        }

    }   

    function op_close(){
        if($('#schema_delete_process_status').val() ==  1)
            reload_content();
        $("#timetable_process_copy").dialog('destroy').remove();
        reload_popup_themes_copy();
    }

</script>
{/block}

{block name='content'}
<div id="status_msg">{$message}</div>
<div id="delete_multiple_save"></div>
<input type="hidden" id="schema_delete_process_status" value="0" />
<div id="slot_manage_copy_multiple">
    <fieldset style="width: 504px;"><legend>{$translate.delete_multiple}</legend>
        <form name="frm_delete" id="frm_delete" method="post">
            <div class="title_strip">
                {$translate.delete_options}
                <div style="float:right;padding-top: 1px;">V{$cur_week}:&nbsp;{$cur_date}</div>
            </div>
            <div id="radio">
                <label><input type="checkbox"  name="days" value="1" checked="checked"/>M</label>
                <label><input type="checkbox"  name="days" value="2" checked="checked"/>T</label>
                <label><input type="checkbox"  name="days" value="3" checked="checked"/>W</label>
                <label><input type="checkbox"  name="days" value="4" checked="checked"/>T</label>
                <label><input type="checkbox"  name="days" value="5" checked="checked"/>F</label>
                <label><input type="checkbox"  name="days" value="6" checked="checked"/>S</label>
                <label><input type="checkbox"  name="days" value="0" checked="checked"/>S</label>
            </div>

            <div class="from_to_week">
                <div>
                    {$translate.from_week}
                    <select class="frm_wk_selct" id="from_wk" onchange="getAfterDates()">
                        {section name=week start={$cur_week} loop={$no_of_weeks+1} step=1}
                            <option value="{$smarty.section.week.index}" {if $smarty.section.week.index == $cur_week} selected="selected"{/if}>{$smarty.section.week.index}</option>
                        {/section}
                    </select>
                    <select name="from_option" id="from_option" onchange="getAfterDates()">
                        <option value="0">{$translate.every_week}</option>
                        <option value="1">{$translate.every_2}</option>
                        <option value="2">{$translate.every_3}</option>
                        <option value="3">{$translate.every_4}</option>
                    </select>
                    {$translate.copy_to}
                    <select name="to_wk" id="to_wk"></select>
                </div>
            </div>
            <div style="clear:both; text-align:center; margin-top: 10px; float: right;">
                <a style="margin-right: 10px;width: 63px;padding: 3px 0px 0px 0px;height: 20px" href="javascript:void(0);" onclick="save_schema_delete()" class="alocation_lvbtn">{$translate.delete}</a>
                <a style="width: 63px;padding: 3px 0px 0px 0px;height: 20px"href="javascript:void(0);" onclick="op_close()" class="alocation_lvbtn">{$translate.close}</a>
            </div>
        </form>
    </fieldset></div>
{/block}