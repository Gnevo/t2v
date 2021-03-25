{block name="content"}
    {foreach $customer_documents as $customer_document}
        <li class="list-group-item">
            <a id="lic_1"  href="javascript:void(0)" onclick="downloadFile('{$customer_document.file}')">{$customer_document.name}</a>
            <a href="javascript:void(0);"  onclick="docRemove('{$customer_document.file}')" title="{$translate.delete_file}"><i class="icon-trash"></i></a>
        </li>
    {foreachelse}
        <li class="files"><span>{$translate.there_are_no_files}</span></li>
    {/foreach}
{/block}