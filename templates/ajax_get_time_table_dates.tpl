<script type="text/javascript">
function show_certificate(){
    var c_name = $("#cmb_certificate").val();
    if(c_name != "")
        {
            //window.open("{$url_path}{$company}/created_pdf_files/"+c_name);
            window.open("{$url_path}pdf_viewer.php?name="+c_name);
            //alert("{$url_path}{$company}/created_pdf_files/"+c_name);
        }
}
</script>
<div class="span12 no-ml">
    <span class="span2">Arbetad tid avser:</span>
    <select name="lstTidStart" id="lstTidStart" style="border:#e4e4e4 solid 1px; min-width: 125px; margin-right: 15px;"  onchange="generate_section_3()">
        <option value="">{$translate.select}</option>
        {foreach from=$dates item=entries}
            <option value="{$entries.val}">{$entries.disp}</option>
        {/foreach}
    </select>
    till
    <select name="lstTidSlut" id="lstTidSlut" style="border:#e4e4e4 solid 1px; min-width: 125px; margin-left: 15px;" onchange="generate_section_3()">
        <option value="">{$translate.select}</option>
        {foreach from=$dates item=entries}
            <option value="{$entries.val}">{$entries.disp}</option>
        {/foreach}
    </select>
</div>
{if $certificate}
    <div class="span12 no-ml">
        <span class="span2">Tidigare arbetsgivarintyg:</span>
        <select name='cmb_certificate' id="cmb_certificate" onchange="show_certificate()">
            <option value=""  selected >{$translate.select}</option>
            {foreach from=$certificate item=entries}
            <option value={$entries.file}>{$entries.date}</option>
            {/foreach}
        </select>
    </div>
{/if}