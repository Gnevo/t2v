{block name='script'}

{/block}

{block name="content"}
{if $privilege}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1 class='pull-left'>{$translate.company}</h1>
                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                        <button onclick="javascript:location='{$url_path}company/add/';" class="btn btn-default btn-normal pull-right" type="button">{$translate.create_new}</button>
                    </div>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="span12">
                            <div class="widget" style="margin: 0px ! important;">
                                <div style="" class="span12 widget-body-section input-group">
                                    <div class="row-fluid">
                                        <div class="row-fluid">
                                            <div id="table_val" class="table-responsive">
                                                <table class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda">
                                                    <thead>
                                                        <tr>
                                                            <th>{$translate.logo}</th>
                                                            <th>{$translate.name}</th>
                                                            <th>{$translate.database}</th>
                                                            <th>{$translate.language}</th>
                                                            <th>{$translate.address}</th>
                                                            <th>{$translate.phone}</th>
                                                            <th class="table-col-center small-col"></th>
                                                            <th class="table-col-center small-col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {foreach from=$companies item=company}
                                                            <tr class="gradeX">
                                                                <td><img style='height: 60px;' src="{$url_path}company_logo/{if $company.logo}{$company.logo}{else}defalt.png{/if}" alt="{$company.name}"/></td>
                                                                <td>{$company.name}</td>
                                                                <td>{$company.db_name}</td>
                                                                <td>{$company.language}</td>
                                                                <td>{$company.address|cat: '<br/>'|cat: $company.city}</td>
                                                                <td>{$company.phone|cat: '<br/>'|cat: $company.mobile}</td>
                                                                <td class="table-col-center small-col"><a href="{$url_path}dashboard/{$company.id}/" class="btn btn-default" title="{$translate.deactivate}"><i class="icon-off"></i></a></td>
                                                                <td class="table-col-center small-col"><a href="{$url_path}company/add/{$company.id}/" class="btn btn-default" title="{$translate.edit}"><i class="icon-wrench"></i></a></td>
                                                            </tr>
                                                        {foreachelse}
                                                            <tr><td colspan="8">
                                                                    <div class="message">{$translate.no_data_available}</div>
                                                                </td>
                                                            </tr>
                                                        {/foreach}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{else}
    <div class="row-fluid" id="main_container">
        <div class="span12 main-left">
            <div class="fail">{$translate.permission_denied}</div> 
        </div>   
    </div>   
{/if}
{/block}