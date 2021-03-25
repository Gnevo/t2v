
{block name="style"}
<link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
<style>
    .incon2 td { color: #ff6f54 !important;}
</style>
{/block}
{block name='script'}
<script type="text/javascript">

$(document).ready(function(){
    
});


 </script>
{/block}

{block name="content"}

<div class="row-fluid">
    <div class="span12 main-left">
        {if $privilege}
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1 class='pull-left'>Find User</h1>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget" style="margin: 0px ! important;">
                            <div class="span12 widget-body-section input-group">
                                <div class="widget-body no-padding mb">
                                    <div class="row-fluid">
                                        <div class="span12 widget-body-section input-group">
                                            <form id="form_list" name="form_list" method="post">
                                                <div class="pull-left" style="margin: 0px ! important; padding: 0px;">
                                                    <label class="span12" style="float: left;" for="search_name">Name *</label>
                                                    <div style="margin: 0px; float:left;" class="input-prepend span10"> <span class="add-on icon icon-search"></span>
                                                        <input name="search_name" id="search_name" value="{$search_name}" type="text" class="form-control span12" placeholder="Find Name"/> 
                                                    </div>
                                                </div>
                                                <div class="pull-right" style="padding-top: 15px;">
                                                    <button type="submit" name="submit" class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft"><span class="icon-search"></span> Go</button>
                                                </div>
                                            </form></div>
                                    </div>
                                </div>

                                <div class="row-fluid">
                                    <div class="row-fluid">
                                        <div id="table_val" class="table-responsive">
                                            <table class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda">
                                                <thead>
                                                    <tr>
                                                        <th>{$translate.name}</th>
                                                        <th>{$translate.company}</th>
                                                        <th>{$translate.username}</th>
                                                        <th>{$translate.role}</th>
                                                        <th>{$translate.social_security}</th>
                                                        <th>{$translate.code}</th>
                                                        <th>{$translate.city}</th>
                                                        <th>{$translate.phone}</th>
                                                        <th>{$translate.mobile}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {foreach from=$companies item=company}
                                                        {foreach [$company.customers, $company.employees] as $company_users}
                                                            {foreach from=$company_users item=user}
                                                                <tr class="gradeX {if $user.status == 0} incon2 {/if}">
                                                                    <td>{$user.first_name} {$user.last_name}</td>
                                                                    <td>{$company.name}</td>
                                                                    <td>{$user.username}</td>
                                                                    <td>{if $user.role eq 1}Admin
                                                                        {elseif $user.role eq 2}TL
                                                                        {elseif $user.role eq 3}Employee
                                                                        {elseif $user.role eq 4}Customer
                                                                        {elseif $user.role eq 5}Trainee
                                                                        {elseif $user.role eq 6}Economy
                                                                        {elseif $user.role eq 7}SuperTL{/if}</td>
                                                                    <td>{$user.social_security}</td>
                                                                    <td>{$user.code}</td>
                                                                    <td>{$user.city}</td>
                                                                    <td>{$user.phone}</td>
                                                                    <td>{$user.mobile}</td>
                                                                </tr>
                                                            {/foreach}
                                                        {/foreach}
                                                    {foreachelse}
                                                        <tr><td colspan="9">
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
        {else}
            <div class="fail">{$translate.permission_denied}</div>    
        {/if}
    </div>
</div>
{/block}

