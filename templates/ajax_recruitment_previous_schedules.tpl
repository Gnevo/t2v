<table class="summery_popup" style="text-align:left; font-size:12px;">
                <tbody>
                    <tr>
                        <th></th>
                        <th>{$translate.old_schedules}</th>
                        <th>{$translate.change_made_on}</th>
                        
                    </tr>
                    {assign i 1}
                    {foreach $schedules AS $schedule}

                        <tr class="{cycle values="even,odd"}" >

                            <td>{$i}</td>
                            <td>{$schedule.old_interview_date}</td>
                            <td>{$schedule.date_made_change}</td>
                            {assign i $i+1}
                        </tr>   
                    {foreachelse}
                    <td colspan="3"><div class="message">{$translate.no_data_available}</div></td>
                {/foreach}

                </tbody>
            </table>