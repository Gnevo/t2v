{if $samsida_pdf_files|count gt 0 and $user_role eq 1}
    <div class="allassistans_pdf_files">
        <label class="allassistans_pdf_files_label">{$translate.fkkn_forms}</label>
        <select name=cmb_pdf_files class="list_detail_assistance cmb_pdf_files">
            <option value="">{$translate.select}</option>
            {foreach from=$samsida_pdf_files item=pdf_file}
                <option value="{$pdf_file.file_name}">{$pdf_file.generated_date}</option>
            {/foreach}
        </select>
    </div>
{/if}

<div class="employee_allassistans_div employee_allassistans span12 no-ml">
    <div style="float:left;">
         <input type="hidden" value='{$singing_employers}' id="all_employers">
        <label class="employee_allassistans_label">{$translate.fkkn_employee}</label>
        <select name="cmb_employee" id="cmb_employee" class="list_detail_assistance" {if $flg eq "false"}disabled="disabled"{/if}> 
            <option value="">{$translate.all_assistents}</option>

            {foreach from=$employees item=entries}
                <option value="{$entries.empID}" data-employer-sign="{$entries.employer_sign}" data-sutl-sign="{$entries.sutl_sign}" >{if $sort_by_name == 1}{$entries.empName_ff}{elseif $sort_by_name == 2}{$entries.empName}{/if}</option>
            {/foreach}
        </select>
    </div>
</div>
        
{if $user_role eq 1 or ($general_privileges.employer_signing eq 1 and $superAccess eq true)}
    <div class="employee_allassistans_signing span12 no-ml mb no-min-height">
        {if $flg eq "true"}
            <div class="Anställd_postions clearfix">
                {if $signing_mode eq "remove"}
                    <a href="javascript:void(0)" class="signin_delet" id="login" name="login">{$translate.delete_all_employer_signings}</a>
                {else if $signing_mode eq "both"}
                    <label class="employer_role_label">{$translate.fkkn_employer_role}</label>
                    <input type="text" name="employer_role" class="employer_role" value="{$default_employer_role}"/>
                    <a href="javascript:void(0)" class="signin" data_mtd="normal" >{$translate.signin}</a> 
                    <a style="margin-left: 8px; float: left; height: 22px;" data_mtd="bank_id" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in"></a>
                    <a href="javascript:void(0)" class="signin_delet" id="login" name="login">{$translate.delete_all_employer_signings}</a>
                {else if $signing_mode eq "signing"}
                    <label class="employer_role_label">{$translate.fkkn_employer_role}</label>
                    <input type="text" name="employer_role" class="employer_role" value="{$default_employer_role}"/>
                    <a href="javascript:void(0)" class="signin" data_mtd="normal">{$translate.signin}</a> 
                    <a style="margin-left: 8px; float: left; height: 22px;" data_mtd="bank_id" name="loginBankId" id="loginBankId" class="signin signing_button btn-sign-in"></a>
                {/if}
            </div>
        {/if}
    </div>

{/if}

{if $flg eq "true"} 
    <div class="sign_personlist span12 no-ml no-min-height">
        {if $employee_signing_data|count gt 0} <div class="sign_personlist_caption">{$translate.employer_signed_employees}&nbsp;</div>{/if}
        {foreach from=$employee_signing_data  item=entries}
            <div class="sign_box {if $entries.employer_sign neq ''}bankID{/if}">
                {if $entries.employer_sign neq ''}<img src="{$url_path}images/bank-id-logo.jpg" style="height: 13px;">&nbsp;&nbsp;{/if}
                {if $sort_by_name == 1}{$entries.employee_name}{elseif $sort_by_name == 2}{$entries.employee_name_lf}{/if}{* {if $entries.employee_sign eq ''}<span style="font-weight: bolder; color: red"> X</span>{/if} *}
                {if $user_role eq 1 or ($general_privileges.employer_signing eq 1 and $superAccess eq true)}<a data-attrib-emp="{$entries.employee}" data_employer = "{$entries.employer}" data_sutl = "{$signin_sutl[$entries.employee]}"></a>{/if}
            </div>
        {/foreach}
    </div>
{/if}

<div class="not_signed_emp span12 no-ml no-min-height" name="not_signed_emp" id="not_signed_emp">
    {if $not_sign_emp|count > 0}
        <b>{$translate.not_signed_report}</b>&nbsp;
        {foreach from=$not_sign_emp item=entries}
            <span class="label label-default">{$entries.emp}</span>
        {/foreach}
    {/if}
</div>

<div class="signed_emp span12 no-ml no-min-height" name="signed_emp" id="signed_emp">
    {if $signed_emps|count > 0}
        <b>{$translate.signed_report}</b>&nbsp;
        {foreach from=$signed_emps item=entries}
            <span class="label label-default">{if $entries.employee_sign neq ''}<img src="{$url_path}images/bank-id-logo.jpg" style="height: 13px;">&nbsp;&nbsp;{/if}{$entries.emp}</span>
        {/foreach}
    {/if}
</div>


||||

{* This for fk form defaults *}
{if $user_role eq 1 or ($general_privileges.employer_signing eq 1 and $superAccess eq true)}
    <div style="padding-bottom:10px; margin-top:4px;"  class="bargaining_group">
        <div style="padding:7px 6px 7px 8px; font-size:13px; font-weight:bold; margin-bottom:5px; color:#666666;">3. Omfattas assistenten av kollektivavtal?</div>
        <div style="border:solid 1px #b8b7b7; margin:0px 7px; padding-bottom:10px;">
            <table style="margin:0px 7px; font-family:Arial, Helvetica, sans-serif; font-size:12px;" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr><td height="30">Omfattas assistenten av kollektivavtal?</td></tr>
                <tr>
                    <td width="11%" height="30">
                        <span style="margin-right:10px;" class='pull-left'>
                            <label>
                                <input type="radio" {if (!empty($form_defaults) and $form_defaults.bargaining_new eq 1) or empty($form_defaults)}checked="checked"{/if} value="1" name="bargaining" class="bargaining" style="margin-right:2px;">&nbsp;Ja
                            </label>
                        </span>
                        <span style="margin-right:10px;" class='pull-left'>
                            <label>
                                <input type="radio" {if !empty($form_defaults) and $form_defaults.bargaining_new eq 2}checked="checked"{/if} value="2" name="bargaining" class="bargaining" style="margin-right:2px;">&nbsp;Nej
                            </label>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="agreements_group clearfix" style="background-color:#f6f9f9; margin:6px 0;">
        <div style="padding:7px 6px 7px 8px; font-size:13px; font-weight:bold; margin-bottom:5px; color:#666666;">{*7. Uppgifter om anordnaren*}5. Anordnaren av personlig assistans </div>
        <div style="border: 1px solid rgb(184, 183, 183); margin: 0px 7px;">
            <div class="box-form" style="margin: 9px 7px;">
                <div class="row-fluid">
                    <div class="span12">
                        <label style="margin-left: 5px;" class="pull-left no-ml">
                            <input type="radio" class="provider_of_pa radio pull-left" name="provider_of_pa" value="1" {if (!empty($form_defaults) and $form_defaults.provider_of_pa_flag eq 1)}checked="checked"{/if}/>&nbsp;
                            Jag har själv anställt assistenten (Fyll inte i något mer under den här punkten)
                        </label>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span4">
                        <label style="margin-left: 5px;" class="pull-left no-ml">
                            <input type="radio" class="provider_of_pa radio pull-left" name="provider_of_pa" value="2" {if (!empty($form_defaults) and $form_defaults.provider_of_pa_flag eq 2) or empty($form_defaults)}checked="checked"{/if}/>&nbsp;
                            Personen anlitar en assistans-anordnare
                        </label>
                    </div>
                    <div class="span8">{* span12 *}
                        <div class="row-fluid">
                            <div class="span8">
                                <div style="" class="span12">
                                    <label style="float: left;" class="span12 no-min-height">Namn på anordnaren</label>
                                    <div class="span12 fixed-font" style="margin: 0px;"><strong>{$company_data.name}</strong></div>
                                </div>
                            </div>
                            <div class="span4">
                                <div style="" class="span12">
                                    <label style="float: left;" class="span12 no-min-height">Organisationsnummer</label>
                                    <div style="margin: 0px;" class="span12 fixed-font"><strong>{$company_data.org_no}</strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span8">
                                <div style="margin: 0px 0px 10px;" class="span12">
                                    <label style="float: left;" class="span12 no-min-height" for="company_cp_name">Kontaktperson</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input type="text" class="form-control span10" name="company_cp_name" id="company_cp_name" value="{if !empty($form_defaults) and $form_defaults.provider_of_pa_flag eq 2 and $form_defaults.company_cp_name neq ''}{$form_defaults.company_cp_name}{else}{$company_data.cp_name}{/if}" {if !empty($form_defaults) and $form_defaults.provider_of_pa_flag eq 1}disabled="disabled"{/if}> </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div style="margin: 0px 0px 10px;" class="span12">
                                    <label style="float: left;" class="span12 no-min-height" for="company_cp_phone">Telefon, även riktnummer</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input type="text" class="form-control span10" name="company_cp_phone" id="company_cp_phone" value="{if !empty($form_defaults) and $form_defaults.provider_of_pa_flag eq 2 and $form_defaults.company_cp_phone neq ''}{$form_defaults.company_cp_phone}{else}{$company_data.contact_number}{/if}" {if !empty($form_defaults) and $form_defaults.provider_of_pa_flag eq 1}disabled="disabled"{/if}> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label style="float: left;" class="span12 no-min-height">Är anordnaren arbetsgivare för assistenten?</label>
                                <label style="margin-left: 5px;" class="no-ml"><input type="radio" class="radio pull-left agreement_type agreement_type_special" name="agreement_type" value="1" {if (!empty($form_defaults) and $form_defaults.agreement_types_new eq 1) or empty($form_defaults)}checked="checked"{/if} {if !empty($form_defaults) and $form_defaults.provider_of_pa_flag eq 1}disabled="disabled"{/if}>&nbsp;Ja </label>
                            </div>
                        </div>
                        <div style="margin: 12px 0px;" class="row-fluid">
                            <div class="span4">
                                <label class="no-ml" style="margin-left: 5px;">
                                    <input type="radio" class="radio pull-left agreement_type agreement_type_special" name="agreement_type" value="2" {if !empty($form_defaults) and $form_defaults.agreement_types_new eq 2}checked="checked"{/if} {if !empty($form_defaults) and $form_defaults.provider_of_pa_flag eq 1}disabled="disabled"{/if}>&nbsp;
                                    Nej, anordnaren är
                                        uppdragsgivare åt
                                        assistenten som har
                                        en annan arbetsgivare</label>
                            </div>
                            <div class="span4">
                                <div style="" class="span12">
                                    <label style="float: left;" class="span12 no-min-height" for="name_of_another_employer">Namn på arbetsgivaren</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input type="text" value="{if !empty($form_defaults) and $form_defaults.agreement_types_new eq 2 and $form_defaults.agreement_type2_company neq ''}{$form_defaults.agreement_type2_company}{/if}" name="agreement_type2_company" data-company="{if !empty($form_defaults) and $form_defaults.agreement_types_new eq 2 and $form_defaults.agreement_type2_company neq ''}{$form_defaults.agreement_type2_company}{else}{$company_data.name}{/if}" class="form-control span10 agreement_type2_company" {if !empty($form_defaults) and $form_defaults.provider_of_pa_flag eq 1}disabled="disabled"{/if}/></div>
                                </div>
                            </div>
                            <div class="span4">
                                <div style="" class="span12">
                                    <label style="float: left;" class="span12 no-min-height" for="another_employer_org_no">Organisationsnummer</label>
                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                        <input type="text" value="{if !empty($form_defaults) and $form_defaults.agreement_types_new eq 2 and $form_defaults.agreement_type2_orgNo neq ''}{$form_defaults.agreement_type2_orgNo}{/if}" name="agreement_type2_orgno" data-org-no="{if !empty($form_defaults) and $form_defaults.agreement_types_new eq 2 and $form_defaults.agreement_type2_company neq ''}{$form_defaults.agreement_type2_orgNo}{else}{$company_data.org_no}{/if}" class="form-control span10 agreement_type2_orgno" {if !empty($form_defaults) and $form_defaults.provider_of_pa_flag eq 1}disabled="disabled"{/if}/></div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="no-ml" style="margin-left: 5px;">
                                    <input type="radio" class="radio pull-left agreement_type agreement_type_special" name="agreement_type" value="3" {if !empty($form_defaults) and $form_defaults.agreement_types_new eq 3}checked="checked"{/if} {if !empty($form_defaults) and $form_defaults.provider_of_pa_flag eq 1}disabled="disabled"{/if}>&nbsp;
                                    Nej, anordnaren är uppdragsgivare åt assistenten som är egenföretagare.</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/if}