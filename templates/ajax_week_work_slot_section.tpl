<script type="text/javascript">
$('a.popup').click(function() {
            
            var url = this.href;
            $('html').animate({
              scrollTop:0
                }, 10, function(){
            
            var dialog_box = $("#timetable_assign" );
            dialog_box.html('<div class="popup_first_loading" style="height: 500px;"></div>');
            // load remote content
            dialog_box.load(url);
            // open the dialog
            dialog_box.dialog({
                
                title: '{$translate.slots_allocation}',
                position: 'top',
                modal: true,
                minWidth: 705,
                minHeight: 500,
                resizable: false,
                closeOnEscape: false,
                dialogClass: 'no-close',
                buttons: {
                    '{$translate.cancel}': function() {
                        $(this).dialog("close");
                    },
                    '{$translate.save}': function() {
                        $(this).dialog("close");
                    }
                },
                close: function(event, ui) {
                        
                        $(this).dialog('destroy').remove();
                        reload_popup_themes();
//                      location.href='{$url_path}week/gdschema/{$year_week}/{$page_start}/{$week_position}/{$page_key}/';
                        if($('#chk_status').val() == 1){
                            reload_content();
                            $('#chk_status').val('0');
                        }        
//                        $('.ui-dialog[aria-labelledby="ui-dialog-title-timetable_assign"]').remove();
//                        $('#timetable_assign').remove();
                }
        });
       });
        //prevent the browser to follow the link
       return false;
    });
    
    
</script>
<table cellspacing="0" cellpadding="0" id="Open_Text_General" class="FixedTables" style="width: 2080px;">
    <tbody>
        {foreach $week_datas as $week_data}
            <tr>
                {foreach $week_data as $employee_data}
                    <td width="110px" valign="top" style="height: 96px;">
                        <ul class="td_data">
                            {if !empty($employee_data.week)}
                                {foreach $employee_data.week as $week_data}
                                    <li {if $week_data.leave}class="for_lv_day"{/if}>
                                        {if $privileges.{$employee_data.customer.username}.link && $privileges.{$employee_data.employee.username}.link && $week_data.signed == 0}
                                            <!--<a class="popup" href="{$url_path}gdschema_alloc.php?date={$week_data.date}&customer={$employee_data.customer.username}&employee={$employee_data.employee.username}">{$translate.{$week_data.day}} <span>({$week_data.time}hrs)</span></a>-->
                                            <a href="javascript:void()" onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$week_data.date}&customer={$employee_data.customer.username}&employee={$employee_data.employee.username}',1)">{$translate.{$week_data.day}} <span>({$week_data.time}hrs)</span></a>
                                        {else}
                                            {$translate.{$week_data.day}} <span>({$week_data.time}hrs)</span>
                                        {/if}
                                    </li>
                                {/foreach}
                            {/if}
                        </ul>
                    </td>
                {/foreach}
            </tr>
        {/foreach}
    </tbody>
</table>