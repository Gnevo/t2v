{block name="employee_manage_tab_content"}
    <div style="display: none;" class="scroller scroller-left"><span class="icon-chevron-left"></span></div>
    <div style="display: block;" class="scroller scroller-right"><span class="icon-chevron-right"></span></div>
    <div class="wrapper no-margin">
        <ul class="nav nav-tabs list" role="tablist" id="myTab" style="left: 0px;">
            {if $user_roles_login neq 3 and $user_roles_login neq 4}<li role="presentation" {if $menu.tabmenu == 'employee_add'}class="active"{/if}><a href="javascript:void(0)" onclick="redirectConfirm('{$url_path}employee/add/%%C-UNAME%%/')" aria-controls="1" role="tab" data-toggle="tab">{$translate.employee_profile}</a></li>{/if}
            {if $privilege_general.employee_settings_contract eq 1}<li {if $menu.tabmenu == 'employee_contract_pdf'}class="active"{/if} role="presentation"><a aria-controls="2" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('{$url_path}employment/contract/pdf/%%C-UNAME%%/')">{$translate.employee_contract}</a></li>{/if}
            {if $privilege_general.employee_settings_salary eq 1}<li {if $menu.tabmenu == 'employee_list_salary'}class="active"{/if} role="presentation"><a aria-controls="3e" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('{$url_path}employee/list/salary/%%C-UNAME%%/')">{$translate.salary}</a></li>{/if}
            {if $privilege_general.employee_settings_notification eq 1}<li {if $menu.tabmenu == 'employee_notification'}class="active"{/if} role="presentation"><a aria-controls="4" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('{$url_path}employee/notification/%%C-UNAME%%/')">{$translate.employee_notification}</a></li>{/if}
            {if $privilege_general.employee_settings_privileges eq 1 and $employee_role != 1}<li {if $menu.tabmenu == 'employee_privileges'}class="active"{/if} role="presentation"><a aria-controls="5" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('{$url_path}employee/privileges/%%C-UNAME%%/')">{$translate.employee_previlege}</a></li>{/if}
            {if $privilege_general.employee_settings_cv eq 1}<li {if $menu.tabmenu == 'employee_skills'}class="active"{/if} role="presentation"><a aria-controls="6" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('{$url_path}employee/skills/%%C-UNAME%%/')">{$translate.skills}</a></li>{/if}
            {if $privilege_general.employee_settings_documentation eq 1}<li {if $menu.tabmenu == 'employee_documentations'}class="active"{/if} role="presentation"><a aria-controls="7" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('{$url_path}employee/documentations/%%C-UNAME%%/')">{$translate.documentation}</a></li>{/if}
            {*if $privilege_general.employee_settings_preference eq 1}<li {if $menu.tabmenu == 'employee_preference'}class="active"{/if} role="presentation"><a aria-controls="8" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('{$url_path}emptime/preference/%%C-UNAME%%/')">{$translate.employee_preferredtime}</a></li>{/if*}
            {if $privilege_general.employee_settings_preference eq 1}<li {if $menu.tabmenu == 'employee_non_prefered_timing'}class="active"{/if} role="presentation"><a aria-controls="8" role="tab" data-toggle="tab" href="javascript:void(0)" onclick="redirectConfirm('{$url_path}employee/non-prefered/timing/%%C-UNAME%%/1/')">{$translate.employee_non_preferred_time}</a></li>{/if}
        </ul>
    </div>
{/block}