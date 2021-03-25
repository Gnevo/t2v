{block name='script'}
<script>
$(document).ready(function() {
    
});


</script>
{/block}

{block name='content'}
{$message}
<div class="slot_alocation_main" style="width: 495px;" >
    <div class="alocation_details">
        <div class="option_head clearfix">
            <span style="float:left;">
                {$bm_details.name}
            </span>
        </div>


        <div class="single_allocation">
            <div class="detail_inner_pending" style="width: 97%;height: auto;">
                <div class="detail_inner_left" style="width: 100%;">
                    <form id="bm_form" name="bm_form" method="post">
                        <table id="table_list" name="table_list">
                            <tr>
                                <td style="float: left;margin-right: 25px;">{$translate.time_from}</td>
                                <td><input type="text" id="tfrom" name="tfrom" value="{$bm_details.start_time}">
                                    <input type="hidden" id="action" name="action" value="bm_edit">
                                    <input type="hidden" id="bm_id" name="bm_id" value="{$bm_details.id}">
                                </td>
                            </tr>
                            <tr>
                                <td style="float: left;margin-right: 25px;">{$translate.time_to}</td>
                                <td><input type="text" id="tto" name="tto" value="{$bm_details.end_time}"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
</div>
{/block}