{block name='script'}
<script>
$(document).ready(function() {
    $(".remove").click(function(e){
        e.stopPropagation();
    });
    
    $('.even').click(function() {
    //$(this).parent().find("#sub_slots").toggle('slow', function() {
//    alert($(this).parent().next('tbody').html());
    $(this).parent().next('tbody').toggle('slow');
//$(this).parent().next('tbody').slideToggle("slow");
    });
});

function loadAjax(url){
    $('#alloc_action').load(url);
}

function already_signed(){
    alert("Report Already signed.");
}

function loadAjaxSlotConfirm(url){

    if(confirm('{$translate.confirm_delete}')){
        var delete_flag;
        if(confirm('{$translate.do_you_want_to_reset_substitute_slots}'))
            delete_flag = 1;
        else
            delete_flag = 0;
        url = url+"&vikarie_delete="+delete_flag;
        
        var dialog_box = $("#leave_display_popup" );
        dialog_box.load(url);   // open the dialog
        dialog_box.dialog({
            title: '{$translate.applied_leaves}',
            position: 'top',
            modal: true,
            resizable: false,
            minWidth: 545,
            closeOnEscape: true,
            dialogClass: 'no-close',
            buttons: {
                '{$translate.save}': function() {
                    $(this).dialog("close");
                }
            },
            close: function(event, ui) {
                $(this).dialog('destroy').remove();
                $('.ui-dialog[aria-labelledby="ui-dialog-title-leave_display_popup"]').remove();
                $('#leave_display_popup').remove();
                $('#pop_up_themes').html('<div id="leave_display_popup" style="display:none;"></div>');
                //var month = $("#cmb_month").val();
                //var year = $("#cmb_year").val();
                //navigatePage('{$url_path}message/center/leave/'+year+'/'+month+'/',5);
                //window.location.href = '{$url_path}message/center/leave/'+year+'/'+month+'/NULL/';
                reload();
            }
        });
    }
}

</script>
{/block}

{block name='content'}
{$message}
<div class="slot_alocation_main" style="width: 495px;" >
    <div class="alocation_details">
        <div class="option_head clearfix">
            <span style="float:left;">
                {$employee_name}
            </span>
        </div>


        <div class="single_allocation">
            <div class="detail_inner_pending" style="width: 97%;height: auto;">
                <div class="detail_inner_left" style="width: 100%;">
                    <table class="table_list" id="table_list" name="table_list" style="width: 97%;">
                        <tr>
                            <th>{$translate.date}</th>
                            <th>{$translate.leave_type}</th>
                            <th>{$translate.time_from}</th>
                            <th>{$translate.time_to}</th>
                            <th></th>

                        </tr>
                            {foreach from=$leave_details item=entry}
                                <tr class="even" id="status_{$entry.gID}">
                                    <td style="cursor: pointer;">{$entry.leave_date}</td>
                                    <td style="cursor: pointer;">{if in_array($entry.type, [1,2,3,4,5,6,7,8]}{$leave_type[$entry.type]}{/if} </td>
                                    <td style="cursor: pointer;">{$entry.time_from}</td>
                                    <td style="cursor: pointer;">{$entry.time_to}</td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="loadAjaxSlotConfirm('{$url_path}mc_leave_popup.php?action=leave_remove&id={$entry.id}&gid={$entry.gid}&user={$entry.emp_id}&date={$entry.leave_date}&tfrom={$entry.time_from}&tto={$entry.time_to}')" class="remove" title="{$translate.cancel_leave}"></a>
                                    </td>
                                </tr>
                                <tbody id="sub_grouping" style="display: none;">
                                    {foreach from=$entry.day_slots item=slots}
                                        <tr class="odd" id="sub_slots">
                                            <td colspan="4" style="padding-left: 125px;">{$slots.time_from} - {$slots.time_to}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="remove" title="{$translate.cancel_leave}" onclick="{if $slots.signed eq 1}already_signed();{else}loadAjaxSlotConfirm('{$url_path}mc_leave_popup.php?action=leave_slot_remove&leave_id={$entry.id}&gid={$entry.gid}&slot_id={$slots.id}&employee={$slots.employee}&date={$entry.leave_date}&tfrom={$slots.time_from}&tto={$slots.time_to}');{/if}"></a>
                                            </td>
                                        </tr>
                                    {foreachelse}
                                        <tr class="odd" id="sub_slots">
                                            <td colspan="5" style="padding-left: 125px; color: red;">{$translate.no_time_slot_exists}</td>
                                        </tr>
                                    {/foreach}
                                </tbody>
                            {/foreach}
                    </table>
                    
                    
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
</div>
{/block}