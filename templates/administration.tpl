{block name='style'}
    
{/block}

{block name='script'}
    <script type="text/javascript">
        function loadExport(){
            $('#loading').show();
            document.location.href = "{$url_path}export_lon/";
        };
        function loadFkExport(){
            $('#loading').show();
            document.location.href = "{$url_path}emp/to/cust/fkkn/send/";
        };
    </script>
{/block}

{block name="content"}
    <div class="row-fluid">
        <center>  
            <span style="display: none; position:absolute; left: 500px; top: 214px;z-index: 100;" id="loading">
                <img src="{$url_path}images/sgo-loading.gif"  />
            </span>
        </center>
        <div class="span12 main-left slot-form mCustomScrollbar" data-mcs-theme="dark">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1>{$translate.administration}</h1>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12 icons-group">

                        <div class="span12 icons-group">

                            <ul>        
                                {if $previlages.administration == 1}
                                    <li><a href="javascript:void(0);" onclick="loadExport()"><div class="administration-icon-export"></div><label>{$translate.export}</label></a></li>
                                    <li><a href="{$url_path}lon/export_unsigned/"><div class="administration-icon-export"></div><label>{$translate.export_unsigned}</label></a></li>
                                    <li><a href="{$url_path}privilege/employee/"><div class="administration-icon-privilege"></div><label>{$translate.privilege}</label></a></li>
                                    <li><a href="javascript:void(0);" onclick="navigatePage('{$url_path}billing/')"><div class="administration-icon-billing"></div><label>{$translate.billing}<br></label></a></li>
                                    {*<li><a href="{$url_path}autoscheduler/"><div class="administration-icon-auto-schedule"></div><label>{$translate.auto_scheduling}<br></label><a></li>*}
                                    <li><a href="{$url_path}globalsettings/"><div class="administration-icon-global-settings"></div><label>{$translate.global_setting}<br></label></a></li>     
                                    <li><a href="{$url_path}company/edit/"><div class="administration-icon-company-settngs"></div><label>{$translate.company_setting}<br></label></a></li>
                                    <li><a href="{$url_path}surveys/"><div class="administration-icon-surveys"></div><label>{$translate.surveys}<br></label></a></li>
                                    

                                    {*{if ($emp_role eq 1 or $emp_role eq 6) and $company_id != 11}{/if}*}
                                {/if}
                                {if $previlages.recruitment == 1}
                                    <li><a href="{$url_path}recruitment/interview/add/"><div class="administration-icon-recruitment"></div><label>{$translate.recruitment}<br></label></a></li>
                                {/if}
                                {if $previlages.administration_fk_export == 1 and $company_id != 11}  <li><a href="javascript:void(0);" onclick="loadFkExport()"><div class="administration-icon-export"></div><label>{$translate.emp_to_cust_fkkn_export}</label></a></li>{/if}                              
                                {if $user_id == 'dodo001' || $user_id == 'gine001' || $user_id == 'thne001'}
                                    <li><a href="{$url_path}export_lon_new.php"><div class="administration-icon-export"></div><label>Export New</label></a></li>
                                {/if}
                                {*{if $previlages.create_template == 1}
                                    <li><a href="{$url_path}create/schedule/templates/"><div class="administration-icon-create-schedule-template"></div><label>{$translate.create_schedule_template}<br></label></a></li>
                                {/if}*}
                                {*{if $previlages.use_template == 1}        
                                    <li><a href="{$url_path}use/schedule/templates/"><div class="administration-icon-use-template-schedule"></div><label>{$translate.use_template_schedule}<br></label></a></li>
                                {/if}*}
                                {if $user_id == 'dodo001'}
                                    <li><a href="{$url_path}report/employee/signing/action/admin/"><div class="administration-icon-export"></div><label>Action On Sign</label></a></li>
                                {/if}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
{/block}

{block name='script'}
   
{/block}