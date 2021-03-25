{block name="content"}

<div class="content_inner">
 <!-- <table width="562" border="0" cellspacing="0" cellpadding="0" class="em_table_details">
        {foreach from=$skills item=skil}
        <tr class="em_table_inner">
            <td class="border"><table width="562" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="525">{$skil.skill}</td>
                        <td width="37"><span style="color:#333; text-decoration:none; font-size:12px;"><a style="margin-right: 45px;" href="javascript:void(0)" onclick="delSkill('{$skil.id}')">X</a></span></td>
                    </tr>
                </table></td>
        </tr>
        {foreach from=$skil.description item=descr}
        <tr class="em_table_inner_white">
            <td class="border">{$descr.desc}</td>
        </tr>
        {/foreach}
        {/foreach}
        </table>
    
        <input name="add_skill" type="button" class="bttn" value="{$translate.add_skill}" style="margin:15px 0 0 7px;" onclick="popup_skill('{$url_path}employee_skill_add_popup.php')">
        <span style="margin:0 7px 0 0px; float:right;"><a href="{$url_path}pdf_employee_information.php?id={$emp}" target="_blank"><img src="{$url_path}images/1337429071_pdf.png"></a></span>
      --> 
       {foreach from=$skills item=skil}
           <div class="tab_row_heading">{$skil.skill} <a style="float: right;margin-right: 40px"id="skill_del" class="settings" href="javascript:void(0);" onclick="delSkill('{$skil.id}')"><img width="20" height="20" border="0" title="{$translate.delete}" alt="" src="{$url_path}images/cirrus_icon_reject.png"></a></div>
      
      {foreach from=$skil.description item=descr}
            <div class="tab_row_subtext">{$descr.desc}</div>
       {/foreach}
       {foreachelse}
           <div class="message">{$translate.no_data_available}</div>
        {/foreach}
        
</div>
        <!--<input name="add_skill" type="button" class="bttn" value="{$translate.add_skill}" style="margin:15px 0 0 7px;" onclick="popup_skill('{$url_path}employee_skill_add_popup.php')">
        <span style="margin:0 7px 0 0px; float:right;"><a href="{$url_path}pdf_employee_information.php?id={$emp}" target="_blank"><img src="{$url_path}images/1337429071_pdf.png"></a></span>
 -->
        {/block}