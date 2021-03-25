
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

function get_login(un, pw){
    {if $selected_company neq ''}
        $.ajax({
            async:false,
{*            url:"{$url_path}auth.php",*}
            url:"{$url_path}secondary_login.php",
            data:"username="+un+"&password="+pw+"&user_company={$selected_company}&rtacc=TRUE",
            type:"POST",
            success:function(data){
                    location.href = '{$url_path}all/gdschema/l/1/';
            }
        });
    {/if}
}

function login_error(){
    alert("Can't login due to some technical issue, pls try after some times..");
}

 </script>
{/block}

{block name="content"}

<div class="row-fluid">
    <div class="span12 main-left">
        {if $privilege}
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1 class='pull-left'>Users</h1>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="span12">
                            <div class="widget" style="margin: 0px ! important;">
                                <div class="span12 widget-body-section input-group">
                                    <div class="widget-body no-padding mb">
                                        <div class="row-fluid">
                                            <div class="span12 widget-body-section input-group">
                                                <form id="form_list" name="form_list" method="post">
                                                    <div class="pull-left" style="margin: 0px ! important; padding: 0px;">
                                                        <label class="span12" style="float: left;" for="companies">Company</label>
                                                        <div style="margin: 0px; float:left;" class="input-prepend span10"> <span class="add-on icon icon-search"></span>
                                                            <select name="companies" id="companies" class="form-control span12">
                                                                <option value="">Select Company</option>
                                                                {foreach from=$companies item=company}
                                                                    <option value="{$company.id}" {if $company.id eq $selected_company}selected="true"{/if}>{$company.name}</option>
                                                                {/foreach}
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="pull-left">
                                                        <label class="span12" style="float: left;" for="u_type">User Type</label>
                                                        <div style="margin: 0px; float:left;" class="input-prepend span10"> <span class="add-on icon icon-search"></span>
                                                            <select name="u_type" id="u_type" class="form-control span12">
                                                                <option value="">Select type</option>
                                                                <option value="1" {if $selected_user_type eq 1}selected="true"{/if}>Admin</option>
                                                                <option value="6" {if $selected_user_type eq 6}selected="true"{/if}>Economy</option>
                                                                <option value="3" {if $selected_user_type eq 3}selected="true"{/if}>Employee</option>
                                                                <option value="4" {if $selected_user_type eq 4}selected="true"{/if}>Customer</option>
                                                                <option value="2" {if $selected_user_type eq 2}selected="true"{/if}>TL</option>
                                                                <option value="7" {if $selected_user_type eq 7}selected="true"{/if}>Super TL</option>
                                                            </select>
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
                                                            <th>{$translate.username}</th>
                                                            <th>{$translate.name}</th>
                                                            <th>{$translate.social_security}</th>
                                                            <th>{$translate.code}</th>
                                                            <th>{$translate.city}</th>
                                                            <th>{$translate.phone}</th>
                                                            <th>{$translate.mobile}</th>
                                                            <th class="table-col-center small-col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {foreach from=$users item=user}
                                                            <tr class="gradeX {if $user.status == 0} incon2 {/if}">
                                                                <td>{$user.username}</td>
                                                                <td>{$user.last_name} {$user.first_name}</td>
                                                                <td>{$user.social_security}</td>
                                                                <td>{$user.code}</td>
                                                                <td>{$user.city}</td>
                                                                <td>{$user.phone}</td>
                                                                <td>{$user.mobile}</td>
                                                                <td class="table-col-center small-col"><a href="javascript:void(0);" onclick="{if $user.password neq ""}get_login('{$user.username}', '{$user.password}');{else}login_error();{/if}" class="settings"><i class="icon-unlock cursor_hand" title="Login"></i></a></td>
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
        {else}
            <div class="fail">{$translate.permission_denied}</div>    
        {/if}
    </div>
</div>
{/block}

