{block name="content"}
<ul>
    {foreach $customer_documents as $customer_document}
        <li class="files">
            <img src="{$url_path}images/{$customer_document.icon}" width="14" height="17" />
            <a id="lic_1" target="_blank" href="{$url_path}download.php?{$download_folder}/{$customer_document.file}">{$customer_document.name}</a>
            <a href="javascript:void(0);"  onclick="docRemove('{$customer_document.file}')">{$translate.delete_file}</a>
        </li>
    {foreachelse}
        <li class="files"><span>{$translate.there_are_no_files}</span></li>
    {/foreach}
</ul>
{/block}