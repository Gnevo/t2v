{block name="content"}
<ul class="list-group list-group-form uploaded-files-box span12" style="float: left;">
    {foreach $customer_documents as $customer_document}
        <li class="list-group-item">
            <img src="{$url_path}images/{$customer_document.icon}" width="14" height="17" />
            <a id="lic_1" href="javascript:void(0);" onclick="downloadFile('{$customer_document.file}')">{$customer_document.name}</a>
            <a href="javascript:void(0);" style="float: right;" onclick="docRemove('{$customer_document.file}')" class="btn btn-danger"><span class="icon-trash"> {$translate.delete_file}</span></a>
            <div class="clearfix"></div>
        </li>
    {foreachelse}
        <li class="list-group-item"><span>{$translate.there_are_no_files}</span></li>
    {/foreach}
</ul>
{/block}