{block name='style'}
{*    <link rel="stylesheet" type="text/css" media="all" href="{$url_path}css/calendar.css" title="win2k-cold"/>*}
{/block}

{block name='script'}
    <script>
        function navigateCalender(path) {
            $('#calendar-container').load(path);
        }
    </script>
{/block}

{block name="content"}
    <table class="table table-bordered table-white table-responsive table-primary table-Anställda slot-calender">
        <thead>
            <tr>
                <th style="width: 40px;" onclick="navigateCalender('{$url_path}ajax/calender/{$year - 1}/{$month}/{$day}/{if $is_employee_starup_page}1/{/if}')"><span class="btn btn-block btn-default span12"><i class="icon-double-angle-left"></i></span></th>
                <th onclick="navigateCalender('{$url_path}ajax/calender/{$prv_year}/{$prv_month}/{$day}/{if $is_employee_starup_page}1/{/if}')"><span class="btn btn-block btn-default span12"><i class="icon-angle-left"></i></span></th>
                <th colspan="4" class="table-col-center center" onclick="navigateCalender('{$url_path}ajax/calender/{$cur_year}/{$cur_month}/{$cur_day}/{if $is_employee_starup_page}1/{/if}')">{$translate.{$month_label}}, {$year}</th>
                <th onclick="navigateCalender('{$url_path}ajax/calender/{$next_year}/{$next_month}/{$day}/{if $is_employee_starup_page}1/{/if}')"><span class="btn btn-block btn-default span12"><i class="icon-angle-right"></i></span></th>
                <th onclick="navigateCalender('{$url_path}ajax/calender/{$year + 1}/{$month}/{$day}/{if $is_employee_starup_page}1/{/if}')"><span class="btn btn-block btn-default span12"><i class="icon-double-angle-right"></i></span></th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th style="width: 40px;" class="table-col-center">V</th>
                    {foreach $weeks as $week_day}
                    <th class="table-col-center">{$translate.{$week_day.label}}</th>
                    {/foreach}

            </tr>
        </thead>
        <tbody>
            {foreach $month_weeks as $month_week}
                <tr>
                    <td onclick ="navigateCalender('{$url_path}ajax/calender/{$month_week.week.year}/{$month_week.week.month}/{$day}/{if $is_employee_starup_page}1/{/if}');" class="table-col-center weeks-small-calender" style="width:40px;">{$month_week.week.week}</td>
                    {foreach $month_week.days as $week_day}
                        <td onclick="navigatePage('{$url_path}all{if $is_employee_starup_page}/employee{/if}/gdschema/{$week_day.year}|{$week_day.week}/{$week_day.date}/', 1);"class="table-col-center {if $week_day.type == 'old'}coming-days{else if $week_day.type == 'current'}today-small-calender{else if $week_day.type == 'holiday'}off-days{else if $week_day.type == 'redday'}off-days{else if ($week_day.date|date_format:'%u') eq 7}off-days{/if}">{$week_day.day}</td>
                    {/foreach}
                </tr>
            {/foreach}
        </tbody>
        <thead>
            <tr>
                <th colspan="8">
        <ul>
            {foreach $months as $month}
                <li onclick="monthReloadCalendar('{$year}', '{$month.id}', '{$day}');">{$translate.{$month.label}}</li>
            {/foreach}
        </ul></th>
</tr>
</thead>
</table>
{/block}