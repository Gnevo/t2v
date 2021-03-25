{block name='script'}
<script type="text/javascript">
 
    function downloadFile(filename){
        document.location.href = "{$url_path}download.php?{$download_folder}/"+filename;
    }
</script>
{/block}
{block name="content"}
<div class="content_inner">
    <table width="562" border="0" cellspacing="0" cellpadding="0" class="em_table_details">
        <tr class="em_table_inner">
            <td class="border"><strong><a href="#">{$translate.contracts_of_employment}</a></strong></td>
        </tr>
        <tr>
            <td><table width="562" border="0" cellspacing="0" cellpadding="0" class="em_table_details">
                    <tr class="em_table_inner_white">
                        <td width="281" class="border"><strong>{$translate.document}</strong></td>
                        <td width="281" class="border"><strong>{$translate.dates}</strong></td>
                    </tr>
                </table></td>
        </tr>
        {foreach from=$documents item=document}
        <tr class="em_table_inner">
            <td><table width="562" border="0" cellspacing="0" cellpadding="0" class="em_table_details">
                  
                   
                    <tr class="em_table_inner">
                        <td width="281" class="border"><a href="javascript:void(0)" onclick="downloadFile('{$document.documents}')">{$document.documents}</a></td>
                        <td width="244" class="border">{$document.date}</td>
                        <td width="37" class="border"><a style="float: right;margin-right: 45px;"id="docum_del" class="settings" href="javascript:void(0);" onclick="delAttachment('{$document.id}')"><img width="20" height="20" border="0" title="{$translate.delete}" alt="" src="{$url_path}images/cirrus_icon_reject.png"></a></td>
                    </tr>
                </table></td>
        </tr>
        {foreachelse}
          <tr><td>  <div class="message">{$translate.no_data_available}</div></td></tr>
        {/foreach}
        
    </table>
    <form method="post" name="doc_form" {if $move == 1}action="{$url_path}employee/add/{$employee}/"{else}action="{$url_path}employee/administration/"{/if} enctype="multipart/form-data">
        <label class="formarea">{$translate.upload_document}</label><label class="formarea"><input name="file" type="file" /></label>
        
        <label class="formarea"><input name="save_doc" type="submit" value="{$translate.save}" /></label>
    </form>
</div>
        
{/block}