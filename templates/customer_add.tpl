{block name='style'}
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
    <style>
        .underline_link { text-decoration: underline;}
    </style>
{/block}



{block name="content"}
    {if $access_flag == 1}
        <div id="dialog-confirm" title="{$translate.confirm}" style="display:none;">
            <br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_save_changes}</p>
        </div>
        <div class="clearfix" id="dialog_popup" style="display:none;"></div>
        {$message} 
        <div class="row-fluid">
            <div style="margin: 0px; overflow: hidden !important; padding: 0 !important;" class="span12 main-left" sty>
                <div  class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1>{$translate.personal_information}</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">

                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    <div class="widget option-panel-widget input-group input-group" style="margin: 0px ! important;"> 
                        {if !empty($customer_detail)}
                            <div class="widget-body" style="padding:4px;">
                                <div class="row-fluid">
                                    <div class="span4 top-customer-info"><strong>{$translate.social_security}</strong> : {$customer_detail.social_security}</div>
                                    <div class="span4 top-customer-info"><strong>{$translate.customer_code} :</strong> {$customer_detail.code}</div>
                                    {if $sort_by_name == 1}
                                        <div class="span4 top-customer-info"><strong>{$translate.name} :</strong> {$customer_detail.first_name|cat: ' '|cat: $customer_detail.last_name}</div>
                                    {elseif $sort_by_name == 2}
                                        <div class="span4 top-customer-info"><strong>{$translate.name} :</strong> {$customer_detail.last_name|cat: ' '|cat: $customer_detail.first_name}</div>     
                                    {/if}
                                </div>
                            </div>
                        {/if}
                    </div>

                    <div class="row-fluid">
                        <div class="span12">

                            <div class="tab-content-switch-con {if $customer_username eq ""}no-mt{/if}" >
                                {if $customer_username neq ''}
                                    {block name="customer_manage_tab_content"}{/block}
                                {/if}

                                <div class="widget-header widget-header-options tab-option">
                                    <div class="span4 day-slot-wrpr-header-left span3">
                                        <h1>{$translate.customer}</h1>
                                    </div>
                                    <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                        <button id = "btn_save" class="btn btn-default btn-normal pull-right ml" type="button" onclick="saveForm()" {if $customer_username != ''}disabled="disabled"{/if}><span class="icon-save"></span> {$translate.save}</button>
                                        {if $customer_username != ''}<button id = "btn_edit" class="btn btn-default btn-normal pull-right ml" type="button"><span class="icon-pencil"></span> {$translate.btn_edit_customer_personal}</button>{/if}
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="resetForm()"><span class="icon-refresh"></span> {$translate.reset}</button>
                                        <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm()"><span class="icon-arrow-left"></span> {$translate.backs}</button>
                                        {if $customer_username neq ''}
                                            <button class="btn btn-default btn-normal pull-right" type="button" onclick="print_data();"><span class="icon-print"></span> {$translate.print}</button>
                                            {if $privilege_general.add_customer}<button class="btn btn-default btn-normal pull-right" type="button" onclick="document.location.href = '{$url_path}customer/add/'"><span class="icon-plus"></span> {$translate.add_new_customer}</button>{/if}
                                        {/if}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content-con">

                                <div class="tab-content span12 no-padding" style="margin:0;">
                                    <!--///////////////////////////////////TAB1 BEGIN\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
                                    <div role="tabpanel" class="tab-pane active" id="1">
                                        <form name="form" id="form" method="post" enctype="multipart/form-data" action="{$url_path}customer/add/{if $customer_username!= ""}{$customer_username}/{/if}" class="pull-left span12">
                                            <input type="hidden" name="hdn_url" id="hdn_url" value="{$url}" />
                                            <input type="hidden" name="username" id="username_1" value="{$customer_username}" />
                                            <input type="hidden" name="tl" id="tl" value="{$team_leader}" />
                                            <input type="hidden" name="stl" id="stl" value="{$super_team_leader}" />
                                            <input type="hidden" name="tmp_allocate" id="tmp_allocate" value="{$team_members}" />
                                            <input type="hidden" name="new_team_member" id="new_team_member" value="" />
                                            <input type="hidden" name="remove_member" id="remove_member" value="" />
                                            <input type="hidden" name="to_allocate" id="to_allocate" value="" />
                                            <input type="hidden" name="change_comp" id="change_comp" value="1" />
                                            <input type="hidden" name="new" id="new" value="{if isset($new)}{$new}{/if}" />
                                            <!--OPTION PANEL BEGIN-->

                                            <div style="" class="span12 widget-body-section input-group">
                                                <div class="row-fluid">
                                                    <div class="span4">
                                                        <div style="margin: 0px;" class="widget">
                                                            <div class="widget-header span12">
                                                                <h1>{$translate.personal_information}</h1>
                                                            </div>
                                                            <!--WIDGET BODY BEGIN-->
                                                            <div class="span12 widget-body-section input-group">
                                                                <div class="row-fluid">
                                                                    <div class="span12">
                                                                        <div class="span12" style="margin: 5px 0px 0px;">
                                                                            <label style="float: left;" class="span12" for="century">{$translate.social_security}*</label>
                                                                            <div class="input-prepend span12" style="margin-left: 0px; float: left;"> <span class="add-on icon-pencil"></span>
                                                                                <select name="century" id="century"  class="form-control span2 date-list">
                                                                                    <option value="19" {if $customer_detail.century == 19} selected="selected" {/if} >19</option>
                                                                                    <option value="20" {if $customer_detail.century == 20} selected="selected" {/if} >20</option>
                                                                                </select>
                                                                                <input type="text" value="{$customer_detail.social_security}" id="social_security" name="social_security" maxlength="11" onchange="markChange()" class="form-control span7 date-list">
                                                                                <input type="hidden"  value="{if $social_security_check}1{/if}" id="social_flag" name="social_flag">
                                                                            </div>
                                                                            <div id="soc_sec" style="color: red"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="padding: 0px; margin: 0px;" class="span6 form-left">
                                                                    <div style="margin: 0px;" class="span12">
                                                                        <label style="float: left;" class="span12" for="first_name">{$translate.first_name}*</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> 
                                                                            <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="{$translate.first_name}"  type="text" value="{$customer_detail.first_name}" id="first_name" name="first_name" onchange="markChange()" > 
                                                                        </div>
                                                                    </div>
                                                                    <div style="margin: 5px 0px ! important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="last_name">{$translate.last_name}*</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> 
                                                                            <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" type="text" value="{$customer_detail.last_name}" id="last_name" name="last_name" onchange="markChange()"> </div>
                                                                    </div>
                                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">    

                                                                        <label style="width:100%; float:left;" for="gender">{$translate.gender}</label> 

                                                                        <ol class="radio-group">
                                                                            <li>  <input type="radio" name="gender" id="gender_male" {if $customer_detail.gender == 1}checked="checked"{/if} value="1" onclick="makeChange()" ><label class="label-option-and-checkbox">{$translate.male}</label></li>
                                                                            <li>  <input type="radio" name="gender" id="gender_female" {if $customer_detail.gender == 2}checked="checked"{/if} value="2" onclick="makeChange()" ><label class="label-option-and-checkbox">{$translate.female}</label></li>
                                                                        </ol>
                                                                    </div>
                                                                    <div style="margin: 0px 0px 5px ! important;" class="span12">    
                                                                        <label style="float: left;" class="span12" for="code">{$translate.customer_code}</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="{$translate.customer_code}" type="text"{if $customer_detail.code} value="{$customer_detail.code}"{else} value="{$cust_code}"{/if} id="code" name="code" onchange="markChange()"> 
                                                                        </div>
                                                                    </div>

                                                                    <div style="margin: 0px 0px 5px ! important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="adress">{$translate.address}</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="{$translate.address}" type="text" value="{$customer_detail.address}" id="adress" name="adress" onchange="markChange()"> 
                                                                        </div>
                                                                    </div>

                                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="post">{$translate.post}</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="{$translate.post}" type="text" value="{$customer_detail.post}" id="post" name="post" onchange="markChange()"> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div style="" class="span6 form-right">
                                                                    <div style="margin: 0px 0px 5px ! important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="city">{$translate.city}</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> 
                                                                            <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="{$translate.city}" type="text" value="{$customer_detail.city}" id="city" name="city" onchange="markChange()"> 
                                                                        </div>
                                                                    </div>    
                                                                    <div style="margin: 0px 0px 5px ! important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="phone">{$translate.phone}</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="{$translate.phone}" type="text" value="{$customer_detail.phone}" id="phone" name="phone" onchange="markChange()"> </div>
                                                                    </div>    

                                                                    <div style="margin: 0px;" class="span12">
                                                                        <label style="float: left;" class="span12" for="mobile">{$translate.mobile}</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="{$translate.mobile}" type="text"  value="{$customer_detail.mobile}" id="mobile" name="mobile" maxlength="17" onchange="markChange()"> </div>
                                                                        <input type="hidden" value="1" id="mobile_flag" name="mobile_flag">
                                                                    </div>


                                                                    <div style="margin: 5px 0 0 0 !important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="email">{$translate.email}</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input class="form-control span10" placeholder="{$translate.email}" type="text" value="{$customer_detail.email}" id="email" name="email" onchange="markChange()"> </div>
                                                                    </div>                          




                                                                    {if $company_id != 5}

                                                                    <div style="margin: 10px 0px 5px;" class="span12">

                                                                        <label style="margin-bottom:10px 0px 5px 0 !important; float:left; width:100%;" for="fkkn">{$translate.fk_kn}</label>
                                                                        <ol class="radio-group">
                                                                            <li><input type="radio" name="fkkn" id="fk" {if $customer_detail.fkkn == '1'}checked="checked"{else} checked="checked" {/if} value="1" onclick="makeChange()"><label class="label-option-and-checkbox">{$translate.fk}      </label>   </li>
                                                                            <li>
                                                                                <input type="radio" name="fkkn"  id="kn" {if $customer_detail.fkkn == '2'}checked="checked"{/if} value="2" onclick="makeChange()"><label class="dv_cntnt label-option-and-checkbox">{$translate.kn}</span></label>
                                                                            </li>
                                                                        </ol>
                                                                    </div> 

                                                                    {/if}        





                                                                    <div style="margin:  5px 0 0 0 !important;" class="span12">
                                                                        <label for="date">{$translate.date}</label>
                                                                        <div class="input-prepend date hasDatepicker datepicker span12 no-ml no-padding">
                                                                            <span class="add-on icon-calendar"></span>
                                                                            <input class="form-control span10" type="text" value="{$dates}" id="date" name="date" onchange="markChange()">
                                                                        </div>
                                                                    </div>   
                                                                    


                                                                    <input  type="hidden" value="" id="date_inactive" name="date_inactive" onchange="markChange()">
                                                                </div>

                                                            </div>

                                                            <div style="margin: 0px ! important;" class="widget">
                                                                <div class="widget-header span12">
                                                                    <h1>{$translate.account_information}</h1>
                                                                </div>
                                                                <!--WIDGET BODY BEGIN--><div class="span12 widget-body-section input-group">

                                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="username">{$translate.username}</label>
                                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                            <input placeholder="{$translate.username}" class="form-control span11"  type="text" value="{$customer_detail.username}" id="username" name="username" readonly="readonly"> </div>
                                                                    </div>
                                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                                        <label style="float: left;" class="span12" for="password">{$translate.password}</label>
                                                                        <div id="pass"> <input type="button" onclick="generate_password()" value="{$translate.generate_password}" id="password" name="password" class="bttn" ></div>
                                                                    </div>

                                                                    <div class="span12">
                                                                        <label  label for="status">{$translate.status}</label>

                                                                        <ol class="radio-group" >
                                                                            <li>
                                                                                <input type="radio" name="status" id="status" {if $customer_detail.status == '1'}checked="checked"{else} checked="checked" {/if} value="1" onclick="giveActivation()">
                                                                                <label class="label-option-and-checkbox">{$translate.active}   </label> 
                                                                            </li>
                                                                            <li>
                                                                                <input type="radio" name="status" id="status" {if $customer_detail.status == '0'}checked="checked" {/if} value="0" onclick="giveInactive()">
                                                                                <label class="dv_cntnt label-option-and-checkbox">{$translate.inactive}</label>
                                                                            </li>
                                                                        </ol>
                                                                    </div>





                                                                </div><!--WIDGET BODY END-->
                                                            </div>
                                                            <!--WIDGET BODY END-->

                                                            <div style="margin: 0px ! important;" class="widget">
                                                                <div class="widget-header span12">
                                                                    <h1>{$translate.administrator_behalf}</h1>
                                                                </div>
                                                                <div class="span12 widget-body-section input-group">
                                                                    <div class="row-fluid">
                                                                       <div class="span6">
                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="name">{$translate.kn_form_name}</label>
                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                    <input class="form-control span10"  type="text" name="name" id="name" value="{$customer_detail.kn_name}"  onchange="markchange()" /> 
                                                                                </div>
                                                                            </div>

                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="bbox">{$translate.kn_box}</label>
                                                                                <div style="margin: 0px;" class="input-prepend span12" > <span class="add-on icon-pencil"></span>
                                                                                    <input class="form-control span10" type="text" name="bbox" value="{$customer_detail.kn_box}" id="bbox"  onchange="markchange()" /> 
                                                                                </div>
                                                                            </div>

                                                                            <div style="margin: 0px 0px 10px;" class="span12">
                                                                                <label style="float: left;" class="span12" for="kn_postno">{$translate.kn_form_postno}</label>
                                                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                    <input class="form-control span10" type="text" name="kn_postno"  value="{$customer_detail.kn_postno}" id="kn_postno" onchange="markchange()" maxlength="5" /> 
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                            <div class="span6">
                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                    <label style="float: left;" class="span12" for="breference_no">{$translate.kn_form_reference_no}</label>
                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                        <input class="form-control span10" type="text" name="breference_no" value="{$customer_detail.kn_reference_no}" id="breference_no" onchange="markchange()" /> 
                                                                                    </div>
                                                                                </div>
                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                    <label style="float: left;" class="span12" for="address_kn">{$translate.kn_form_address}</label>
                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                        <input class="form-control span10" type="text" name="address_kn" value="{$customer_detail.kn_address}" id="address_kn"  onchange="markchange()" /> 
                                                                                    </div>
                                                                                </div>
                                                                                <div style="margin: 0px 0px 10px;" class="span12">
                                                                                    <label style="float: left;" class="span12" for="bocity">{$translate.kn_form_city}</label>
                                                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                        <input class="form-control span10" type="text" name="bocity" value="{$customer_detail.kn_city}" id="bocity" onchange="markchange()" /> 
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>



                                                    </div>

                                                    <div class="span8" style="">
                                            <div class="row-fluid">
                                                         <div class="span6">
                                                            <div style="margin: 0px ! important;" class="widget">
                                                                <div class="widget-header span12">
                                                                    <h1>{$translate.relatives}</h1>
                                                                </div>
                                                                <!--WIDGET BODY BEGIN-->
                                                                <div class="span12" style="margin:0;">
                                                                    <div id="relatives_list">
                                                                        <ul class="span12 list-group list-group-form input-group" style="float: left;">
                                                                            {foreach $customer_relatives as $relative}    
                                                                                <li class="list-group-item span12 no-ml">
                                                                                    <div class="span5"><a href="javascript:void(0);" onclick="loadRelative('{$relative.id}')">{$relative.name}</a></div>
                                                                                    <div class="span5"><a href="javascript:void(0);" onclick="loadRelative('{$relative.id}')">{$relative.relation}</a></div>
                                                                                    <div class="span1 pull-right"><button style="text-align: center;" class="btn btn-default btn-normal span12 pull-right include_edit" type="button" onclick="deleteRelative('{$relative.id}')">x</button></div>
                                                                                </li>
                                                                            {foreachelse}    
                                                                                <li class="list-group-item">
                                                                                    <div class="span5">{$translate.no_relatives}</div>
                                                                                    <div class="span5"></div>
                                                                                    <div class="span1 pull-right"></div>
                                                                                </li>
                                                                            {/foreach}
                                                                        </ul>
                                                                    </div>
                                                                    {if !empty($customer_detail)}
                                                                        <div class="span12" style="margin-left:0;">
                                                                            <div style="margin-top: 0px; border: 0px none ! important; margin-bottom: 0px ! important;" class="widget">
                                                                                <div style="border-radius: 0px ! important; margin: 0px ! important;" class="widget-header span12">
                                                                                    <div class="span3">  <h1 class="pull-left">{$translate.relatives}</h1></div>
                                                                                    <div style="padding: 5px;" class="span9 pull-right">
                                                                                        <button class="btn btn-default btn-normal pull-right ml" id="add" name="add" onclick="addRelative()" type="button"><span class="icon-plus"></span> {$translate.add_new_relative}</button>
                                                                                        <button class="btn btn-default btn-normal pull-right" id="save" name="save" onclick="saveRelative()" type="button"><span class="icon-save"></span> {$translate.save}</button>
                                                                                    </div>
                                                                                </div>
                                                                                <!--WIDGET BODY BEGIN-->
                                                                                <div class="span12 widget-body-section input-group" id="relatives_add">
                                                                                    <div class="span6 form-left">
                                                                                        <div style="margin: 5px 0px ! important;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_name">{$translate.name}</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="{$translate.name}" type="text" name="relative_name" id="relative_name" value="" onchange="markChange()" />
                                                                                                <input name="relative_id" id="relative_id" type="hidden" value="" />
                                                                                            </div>
                                                                                        </div>

                                                                                        <div style="margin: 0px ! important;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_relation">{$translate.relation}</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="{$translate.relation}" type="text" name="relative_relation" id="relative_relation" value="" onchange="markChange()"/> </div>
                                                                                        </div>

                                                                                        <div style="margin: 5px 0px 0px;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_address">{$translate.address}</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="{$translate.address}" type="text" name="relative_address" id="relative_address" value="" onchange="markChange()"/></div>
                                                                                        </div>

                                                                                        {*if $employee_action == 'EDIT'}<button id="btn_edit" class="btn btn-default btn-normal pull-right ml" type="button"><span class="icon-pencil"></span> {$translate.btn_edit_employee_personal}</button>{/if*}
                                                                                        <div style="margin: 5px 0px;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_city">{$translate.city}</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="{$translate.city}" type="text" name="relative_city" id="relative_city" value="" onchange="markChange()"/> </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="span6 form-right">

                                                                                        <div style="margin: 5px 0px ! important;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_phone">{$translate.phone}</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="{$translate.phone}" type="text" name="relative_phone" id="relative_phone" value="" onchange="markChange()"/> </div>
                                                                                        </div>


                                                                                        <div style="margin: 0px ! important;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_work_phone">{$translate.phone_work}</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="{$translate.phone_work}" type="text" name="relative_work_phone" id="relative_work_phone" value="" onchange="markChange()"/> </div>
                                                                                        </div>


                                                                                        <div style="margin: 5px 0px ! important;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_mobile">{$translate.mobile}</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="{$translate.mobile}" type="text" name="relative_mobile" id="relative_mobile" value="" onchange="markChange()"/> </div>
                                                                                        </div>


                                                                                        <div style="margin: 0px ! important;" class="span12">
                                                                                            <label style="float: left;" class="span12" for="relative_email">{$translate.email}</label>
                                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                                <input class="form-control span10" placeholder="{$translate.email}" type="email" name="relative_email" id="relative_email" value="" onchange="markChange()"/> </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="span12" style="margin:0">
                                                                                        <label class="span12" style="margin-top:0;" for="relative_other">{$translate.other}</label>
                                                                                        <textarea id="relative_other" name="relative_other" rows="2" class="form-control span12" onchange="markChange()"></textarea>
                                                                                    </div>
                                                                                </div><!--WIDGET BODY END-->
                                                                            </div>
                                                                        </div>
                                                                    {/if}                
                                                                </div><!--WIDGET BODY END-->
                                                            </div>
                                                            <div class="row-fluid"></div>
                                                        </div>

                                                        <div class="span6">



                                                            <div style="margin: 0px ! important;" class="widget">
                                                                <div class="widget-header span12">
                                                                    <h1>{$translate.additional_information}</h1>
                                                                </div>
                                                                <!--WIDGET BODY BEGIN--><div class="span12 widget-body-section input-group">

                                                                    <div class="span12">

                                                                        <label class="span12" style="margin-top:0;" for="health_care">{$translate.health_care}</label>
                                                                        <textarea rows="2" class="form-control span12" name="health_care" id="health_care" onchange="markChange()">{if isset($customer_health.health_care)}{$customer_health.health_care}{/if}</textarea>

                                                                        <label class="span12" style="margin: 10px 0px 5px ! important;" for="occupational_therapists">{$translate.occupational_therapists}</label>
                                                                        <textarea rows="2" class="form-control span12" name="occupational_therapists" id="occupational_therapists" onchange="markChange()">{if isset($customer_health.occupational_therapists)}{$customer_health.occupational_therapists}{/if}</textarea>

                                                                        <label class="span12" style="margin: 10px 0px 5px ! important;" for="physiotherapists">{$translate.physiotherapists}</label>
                                                                        <textarea rows="2" class="form-control span12" name="physiotherapists" id="physiotherapists" onchange="markChange()">{if isset($customer_health.physiotherapists)}{$customer_health.physiotherapists}{/if}</textarea>

                                                                        <label class="span12" style="margin: 10px 0px 5px ! important;" for="aiother">{$translate.other}</label>
                                                                        <textarea rows="2" class="form-control span12" name="aiother" id="aiother" onchange="markChange()">{if isset($customer_health.other)}{$customer_health.other}{/if}</textarea>

                                                                    </div>
                                                                </div><!--WIDGET BODY END-->
                                                            </div>

                                                            <div class="row-fluid">




                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span12">
                                                            <div class="span12">
                                                                <div style="margin: 11px 0px ! important;" class="widget">
                                                                    <div class="widget-header span12">
                                                                        <h1>{$translate.relax_assistant_to_customer}</h1>
                                                                    </div>


                                                                    <div class="span12 widget-body-section input-group">
                                                                        <div class="span6">
                                                                            <div class="widget-body table-1">
                                                                                <div class="table-head-min">
                                                                                    <h1 class="span4">{$translate.all_assistants}</h1>



                                                                                    <input class="form-control span7 excluded_edit" type="text" name="searchkey_text" id="searchkey_text" onkeyup="loadNotAllocatedWorkers()" value="{$translate.search_employee}" style="min-height: 15px; height: 20px;margin: 5px;" >




                                                                                    <input style="float: right;margin-right: 10px; width: 150px; margin-bottom: 0px;"  type="hidden" name="searchkey" id="searchkey"/>

                                                                                </div>
                                                                                <div class="div-height-fix" id="nwoekers_list" style="height: 253px;">

                                                                                    {foreach $to_allocate as $employee}
                                                                                        <div id="a{$employee.username}" class="span12 child-slots-profile">
                                                                                            <span class="glyphicons icon-plus pull-right remove-child-slots cursor_hand" onclick="assignEmployee('{$employee.username}');" title="{$translate.assign_employee}"></span>
                                                                                            <span class="cursor_hand underline_link" onclick="navigatePage('{$url_path}month/gdschema/employee/{$smarty.now|date_format:"%Y/%m"}/{$employee.username}/CUST_ADD/{$customer_username}/',1);">{if $sort_by_name == 1}{$employee.first_name|cat: ' '|cat: $employee.last_name}{elseif $sort_by_name == 2}{$employee.last_name|cat: ' '|cat: $employee.first_name}{/if}</span>
                                                                                            <span class="pull-right">{$employee.code}</span>
                                                                                            {if $employee.user_role == 1}
                                                                                                <span class="slots-position pull-right">{$translate.admin}</span>
                                                                                            {else if $employee.user_role == 2}
                                                                                                <span class="slots-position pull-right">{$translate.team_leader}</span>
                                                                                            {else if $employee.user_role == 5}
                                                                                                <span class="slots-position pull-right">{$translate.trainee}</span>
                                                                                            {else if $employee.user_role == 6}
                                                                                                <span class="slots-position pull-right">{$translate.economy}</span>
                                                                                            {else if $employee.user_role == 7}
                                                                                                <span class="slots-position pull-right">{$translate.super_tl}</span>
                                                                                            {else if $employee.substitute == 1}
                                                                                                <span class="slots-position pull-right">{$translate.substitute}</span>
                                                                                            {/if}

                                                                                        </div><!--CHILD SLOT END-->
                                                                                    {foreachelse}
                                                                                        <div id="no_data" class="message" >{$translate.no_data_available}</div>
                                                                                    {/foreach}



                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        {if $loggedin_user == 1}
                                                                            <div class="span6">
                                                                                <div class="widget-body table-1">
                                                                                    <div class="table-head-min"> <h1>{$translate.attached_assistants}</h1></div>
                                                                                    <div class="div-height-fix" id="tosave_workers" style="height: 253px;">
                                                                                        {foreach $customer_team as $employee}
                                                                                            <div id="{$employee.username}"  class="span12 child-slots-profile-two">
                                                                                                <span class="glyphicons icon-minus pull-right remove-child-slots cursor_hand"  title="{$translate.remove_employee}" onclick="removeEmployee('{$employee.username}');"></span>
                                                                                                <span>
                                                                                                    <span class="cursor_hand underline_link" onclick="navigatePage('{$url_path}month/gdschema/employee/{$smarty.now|date_format:"%Y/%m"}/{$employee.username}/CUST_ADD/{$customer_username}/',1);">{if $sort_by_name == 1}{$employee.name_ff}{elseif $sort_by_name == 2}{$employee.name}{/if}</span>
                                                                                                    <span class="pull-right">{$employee.code}</span>
                                                                                                </span>
                                                                                                {if $employee.user_role == 1}
                                                                                                    <span class="slots-position pull-right">{$translate.admin}</span>
                                                                                                {else if $employee.user_role == 5}
                                                                                                    <span class="slots-position pull-right">{$translate.trainee}</span>
                                                                                                {else if $employee.user_role == 6}
                                                                                                    <span class="slots-position pull-right">{$translate.economy}</span>
                                                                                                {else if $employee.user_role == 7 && $employee.stl == 1}
                                                                                                    <span class="slots-position pull-right">{$translate.super_tl}</span>
                                                                                                {else if $employee.substitute == 1}
                                                                                                    <span class="slots-position pull-right">{$translate.substitute}</span>
                                                                                                {/if}

                                                                                                {if $employee.tl == 1}<span class="slots-position pull-right">{$translate.team_leader}</span>{/if}
                                                                                                {if $employee.user_role == 2 && $employee.tl == 0}
                                                                                                    <a href="javascript:void(0);" class="maketl" onclick="makeTl('{$employee.username}');">{$translate.make_team_leader}</a>
                                                                                                {/if}
                                                                                                {if $employee.user_role == 7 && $employee.stl == 0}
                                                                                                    <a href="javascript:void(0);" class="maketl" onclick="makeSTl('{$employee.username}');">{$translate.make_super_team_leader}</a>
                                                                                                {/if}
                                                                                            </div>
                                                                                        {foreachelse}
                                                                                            <div class="span12 child-slots-profile-two"><label>Inga assistenter</label> </div>
                                                                                        {/foreach}




                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    {else}
                                                                        <div class="span6">
                                                                            <div class="widget-body table-1">
                                                                                <div class="table-head-min"> <h1>{$translate.attached_assistants}</h1></div>
                                                                                <div class="div-height-fix" id="tosave_workers" style="height: 253px;">
                                                                                    {foreach $customer_team as $employee}
                                                                                        <div id="{$employee.username}"  class="span12 child-slots-profile-two">
                                                                                            <input class="check-box" type="checkbox">
                                                                                            <span class="glyphicons icon-minus pull-right remove-child-slots" onclick="removeEmployee('{$employee.username}');" title="{$translate.remove_employee}"></span>
                                                                                            <span>{$employee.name}<span class="pull-right">{$employee.code}</span></span> 
                                                                                            {if $employee.user_role == 1}
                                                                                                <span class="slots-position pull-right">{$translate.admin}</span>
                                                                                            {else if $employee.user_role == 5}
                                                                                                <span class="slots-position pull-right">{$translate.trainee}</span>
                                                                                            {else if $employee.user_role == 6}
                                                                                                <span class="slots-position pull-right">{$translate.economy}</span>
                                                                                            {else if $employee.user_role == 7 && $employee.stl == 1}
                                                                                                <span class="slots-position pull-right">{$translate.super_tl}</span>
                                                                                            {else if $employee.substitute == 1}
                                                                                                <span class="slots-position pull-right">{$translate.substitute}</span>
                                                                                            {/if}

                                                                                            {if $employee.tl == 1}<span class="slots-position pull-right">{$translate.team_leader}</span>{/if}
                                                                                            {if $employee.user_role == 2 && $employee.tl == 0}
                                                                                                <a href="javascript:void(0);" class="maketl" onclick="makeTl('{$employee.username}');">{$translate.make_team_leader}</a>
                                                                                            {/if}
                                                                                            {if $employee.user_role == 7 && $employee.stl == 0}
                                                                                                <a href="javascript:void(0);" class="maketl" onclick="makeSTl('{$employee.username}');">{$translate.make_super_team_leader}</a>
                                                                                            {/if}

                                                                                        </div>
                                                                                    {foreachelse}
                                                                                        <div class="span12 child-slots-profile-two"><label>Inga assistenter</label> </div>
                                                                                    {/foreach}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    {/if}                
                                                                </div>

                                                            </div>
                                                        </div>

                                                        {*<div class="row-fluid hide">
                                                            <div class="span12"><div style="margin: 0px 0 15px 0 ! important;" class="widget">
                                                                    <div class="widget-header span12">
                                                                        <h1>{$translate.working_hours_calculation}</h1>
                                                                    </div>
                                                                    <div class="span12 widget-body-section input-group">
                                                                        <div class="span12 form-left">
                                                                            <div class="span4" style="margin: 0px;">
                                                                                <label style="float: left;" class="span12" for="contract_start_month">{$translate.employee_contract_start_month}</label>
                                                                                <div class="input-prepend span7" style="margin-left: 0px; float: left;"> <span class="add-on icon-pencil"></span>
                                                                                    <select class="form-control span10" id="contract_start_month" name="contract_start_month">
                                                                                        <option value="" >{$translate.select}</option>
                                                                                        <option value="01" {if  $customer_detail.employee_contract_start_month == 1} selected = "selected" {/if} >{$translate.january}</option>
                                                                                        <option value="02" {if  $customer_detail.employee_contract_start_month == 2} selected = "selected" {/if}>{$translate.february}</option>
                                                                                        <option value="03" {if  $customer_detail.employee_contract_start_month == 3} selected = "selected" {/if}>{$translate.march}</option>
                                                                                        <option value="04" {if  $customer_detail.employee_contract_start_month == 4} selected = "selected" {/if}>{$translate.april}</option>
                                                                                        <option value="05" {if  $customer_detail.employee_contract_start_month == 5} selected = "selected" {/if}>{$translate.may}</option>
                                                                                        <option value="06" {if  $customer_detail.employee_contract_start_month == 6} selected = "selected" {/if}>{$translate.june}</option>
                                                                                        <option value="07" {if  $customer_detail.employee_contract_start_month == 7} selected = "selected" {/if}>{$translate.july}</option>
                                                                                        <option value="08" {if  $customer_detail.employee_contract_start_month == 8} selected = "selected" {/if}>{$translate.august}</option>
                                                                                        <option value="09" {if  $customer_detail.employee_contract_start_month == 9} selected = "selected" {/if}>{$translate.september}</option>
                                                                                        <option value="10" {if  $customer_detail.employee_contract_start_month == 10} selected = "selected" {/if}>{$translate.october}</option>
                                                                                        <option value="11" {if  $customer_detail.employee_contract_start_month == 11} selected = "selected" {/if}>{$translate.november}</option>
                                                                                        <option value="12" {if  $customer_detail.employee_contract_start_month == 12} selected = "selected" {/if}>{$translate.december}</option>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="input-prepend span5" style="margin-left: 0px; float: left;"> <span class="add-on icon-pencil"></span>
                                                                                    <select class="form-control span10" id="contract_month_start_date" name="contract_month_start_date">
                                                                                        {for $month_date=1 to 31}
                                                                                            <option value="{$month_date}" {if  $customer_detail.employee_contract_period_date eq $month_date} selected = "selected" {/if} >{$month_date}</option>
                                                                                        {/for}
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="span4 pull-right" style="margin: 5px 0px 0px;">
                                                                                <label style="float: left;" class="span12" for="emp_contract_period_length">{$translate.employee_contract_period_length}</label>
                                                                                <div style="margin-left: 0px; float: left;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                    <select class="form-control span11" id="emp_contract_period_length" name="emp_contract_period_length">
                                                                                        <option value="" >{$translate.select}</option>
                                                                                        <option value="01" {if $customer_detail.employee_contract_period_length eq 1} selected = "selected" {/if}>1</option>
                                                                                        <option value="02" {if $customer_detail.employee_contract_period_length eq 2} selected = "selected" {/if}>2</option>
                                                                                        <option value="03" {if $customer_detail.employee_contract_period_length eq 3} selected = "selected" {/if}>3</option>
                                                                                        <option value="04" {if $customer_detail.employee_contract_period_length eq 4} selected = "selected" {/if}>4</option>
                                                                                        <option value="06" {if $customer_detail.employee_contract_period_length eq 6} selected = "selected" {/if}>6</option>
                                                                                        <option value="12" {if $customer_detail.employee_contract_period_length eq 12} selected = "selected" {/if}>12</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>*}

                                                    </div>
                                                </div>
                                            </div>




                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div style="margin: 0px ! important;" class="widget">
                                                        <div class="widget-header span12">
                                                            <h1>{$translate.the_customers_order}</h1>
                                                        </div>
                                                        <!--WIDGET BODY BEGIN--><div class="span12 widget-body-section input-group">
                                                            <div class="table-responsive div-height-fix">  
                                                                <table class="footable table table-striped table-bordered table-white table-primary">
                                                                    <thead>
                                                                        <tr>
                                                                            <th data-class="expand">{$translate.date_from}</th>
                                                                            <th data-hide="phone,tablet">{$translate.date_to}</th>
                                                                            <th data-hide="phone,tablet">{$translate.granded_hours}</th>
                                                                            <th data-hide="phone">{$translate.fk_kn}</th>
                                                                            <th>{$translate.remaining_from_grant_hours}</th>
                                                                            <th>{$translate.exercised_call_hour}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        {foreach from=$contracts item=contract}
                                                                            <tr>
                                                                                <td>{$contract.date_from}</td><td>{$contract.date_to}</td><td>{$contract.hour}</td><td>{$contract.fkkn}</td><td {if $contract.remaining_hour < 0}style="color:red;"{/if}>{$contract.remaining_hour}</td><td>{$contract.oncall}</td>
                                                                            </tr>
                                                                        {/foreach}
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div><!--WIDGET BODY END-->


                                                    </div>
                                                    <div class="row-fluid">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="row-fluid"> 
                                    <div class="span4">
                                        <div class="widget">
                                            <div class="widget-header span12">

                                                    <label class="label-option-and-checkbox ml">
                                                        <h1><input name="rb_guardian_type" value="3" onchange="markChange()" type="radio" class="ml" {if $customer_guardian.type eq 3}checked="checked"{/if}>&nbsp;{$translate.guardian3}</h1>
                                                    </label>
                                                    <label class="label-option-and-checkbox mr">
                                                        <h1><input name="rb_guardian_type" value="1" onchange="markChange()" type="radio" class="ml" {if $customer_guardian.type eq 1 or $customer_guardian.type eq ''}checked="checked"{/if}>&nbsp;{$translate.guardian}</h1>
                                                    </label>
                                                    <label class="label-option-and-checkbox mr ml">
                                                        <h1><input name="rb_guardian_type" value="2" onchange="markChange()" type="radio" class="ml" {if $customer_guardian.type eq 2}checked="checked"{/if}>&nbsp;{$translate.guardian2}</h1>
                                                    </label>
                                                    
                                            </div>
                                            <div class="span12 widget-body-section input-group">
                                                <div class="span6 form-left">
                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                        <label style="float: left;" class="span12" for="guardian_fname">{$translate.first_name}*</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input class="form-control span10" placeholder="{$translate.first_name}" type="text" name="guardian_fname" id="guardian_fname" value="{$customer_guardian.first_name}" onchange="markChange()"/> </div>
                                                    </div>
                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                        <label style="float: left;" class="span12" for="guardian_lname">{$translate.last_name}*</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input class="form-control span10" placeholder="{$translate.last_name}" type="text" name="guardian_lname" id="guardian_lname" value="{$customer_guardian.last_name}" onchange="markChange()"/> </div>
                                                    </div>
                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                        <label style="float: left;" class="span12" for="guardian_ssn">{$translate.social_security}*</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input class="form-control span10" placeholder="{$translate.social_security}" type="text" name="guardian_ssn" id="guardian_ssn" value="{$customer_guardian.ssn}" onchange="markChange()" maxlength="12"/> </div>
                                                    </div>
                                                </div>
                                                <div class="span6 form-right">

                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                        <label style="float: left;" class="span12" for="guardian_mobile">{$translate.mobile}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input class="form-control span10" placeholder="{$translate.mobile}" type="text" name="guardian_mobile" id="guardian_mobile" value="{$customer_guardian.mobile}" onchange="markChange()"/> </div>
                                                    </div>


                                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                        <label style="float: left;" class="span12" for="guardian_email">{$translate.email}</label>
                                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                            <input type="email" class="form-control span10" placeholder="{$translate.email}" name="guardian_email" id="guardian_email" value="{$customer_guardian.email}" onchange="markChange()"> 

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span12" style="margin:0">

                                                    <label class="span12" style="margin-top:0;" for="guardian_address">{$translate.address}</label>
                                                    <textarea name="guardian_address" id="guardian_address" onchange="markChange()" class="form-control span12">{$customer_guardian.address}</textarea>
                                                </div>
                                            </div>
                                            <div class="span12 no-min-height" style="margin:0;">
                                                <div class="span12 no-min-height" style="margin-left:0;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span8">
                                        <div style="border: 0px none ! important; margin-bottom: 0px ! important;" class="widget">
                                            <div style="border-radius: 0px ! important; padding:3px;" class="widget-header span12">
                                                <div class="span12"> <h1></h1> </div>
                                            </div>

                                            <div class="span12 widget-body-section input-group">
                                                <input type="hidden" name="tdocs" id="tdocs" value="{$customer_document_string}" />
                                                <input type="hidden" name="del_doc" id="del_doc" value="" />
                                                <div class="span12" style="margin:0">
                                                    <ul class="list-group list-group-form uploaded-files-box span12" style="float: left;">
                                                        {if $customer_document_string != ""}
                                                            {foreach $customer_documents as $customer_document}
                                                                <li class="list-group-item" onchange="markChange()">
                                                                    <img src="{$url_path}images/{$customer_document.icon}" width="14" height="17" />
                                                                    <a id="lic_1" href="javascript:void(0)" onclick="downloadFile('{$customer_document.file}')" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 70% ! important; display: inline-block; vertical-align: text-top;" title="{$customer_document.file}">{*$customer_document.name*}{$customer_document.file}</a>
                                                                    <a href="javascript:void(0);" style="float: right;"  onclick="docRemove('{$customer_document.file}', this)"  class="btn btn-danger btn-lg"><span class="icon-trash"> {$translate.delete_file}</span></a>
                                                                    <div class="clearfix"></div>
                                                                </li>
                                                            {foreachelse}
                                                                <li class="list-group-item">{$translate.there_are_no_files}</li>
                                                                {/foreach}
                                                            {else}
                                                            <li class="list-group-item"><span>{$translate.there_are_no_files}</span></li>
                                                                {/if}
                                                    </ul>
                                                    <span style="background: none repeat scroll 0px center transparent; margin-right: 0px ! important; margin-bottom: 0px ! important; margin-left: 0px ! important; padding: 0px; float: left; margin-top: 10px;" class="btn btn-default btn-file">
                                                        <input type="hidden" name="file_count" id="file_count" value="1" />
                                                        <div id="file_attach">
                                                            <input class="margin-none" type="file" name="file_1" id="file_1" size="12" onchange="markChange()"/>
                                                        </div>
                                                    </span>


                                                    <div style="margin-top: 3px">
                                                        <label><a id="attach_file" href="javascript:void(0);" class="btn btn-default" onclick="attachAnother()" style="margin-top:15px">{$translate.upload_new_file}</a></label>
                                                        <label><a id="remove_file" href='javascript:void(0);' class="btn btn-default" style="margin-top:15px" onclick='removeFile()' >{$translate.delete_file}</a></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--WIDGET BODY BEGIN--><!--WIDGET BODY END-->
                                        </div>
                                    </div>
                                </div>

                                {* map *}
                                <div class="row-fluid hide"> 
                                    <div class="span12">
                                        <div style="border: 0px none !important;" class="widget no-margin">
                                            <div style="border-radius: 0px !important; padding:3px;" class="widget-header span12">
                                                <div class="span12"> <h1>{$translate.map_location}</h1> </div>
                                            </div>

                                            <div class="span12 widget-body-section input-group">
                                                <div class="span12 no-min-height">
                                                    <div class="span12 form-left">
                                                        <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                            <label style="float: left;" class="span12">{$translate.location}</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-search"></span>
                                                                <input class="form-control span10" placeholder="{$translate.location}" type="text" id="map_location_name"/> </div>
                                                        </div>
                                                    </div>
                                                    <div class="span6 form-left no-ml">
                                                        <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                            <label style="float: left;" class="span12">{$translate.map_location_lat}</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-map-marker"></span>
                                                                <input class="form-control span10" placeholder="{$translate.map_location_lat}" type="text" name="location_lat" id="location_lat" value="{$customer_detail.location_lat}" onchange="markChange()"/> </div>
                                                        </div>
                                                    </div>
                                                    <div class="span6 form-left">
                                                        <div style="margin: 0px 0px 10px ! important;" class="span12">
                                                            <label style="float: left;" class="span12">{$translate.map_location_lon}</label>
                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-map-marker"></span>
                                                                <input class="form-control span10" placeholder="{$translate.map_location_lon}" type="text" name="location_lon" id="location_lon" value="{$customer_detail.location_lon}" onchange="markChange()"/> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="map-block" class="span12 no-min-height no-ml" style="height: 250px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row-fluid"></div>
                            <div class="row-fluid"></div>
                            </form>              
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
{/block}



{block name='script'}


<script src="{$url_path}js/date-picker.js"></script>
<script src="{$url_path}js/bootbox.js" type="text/javascript"></script>
<script src="{$url_path}js/jquery.maskedinput.js" type="text/javascript" ></script>
{* <script src='https://maps.google.com/maps/api/js?sensor=false&libraries=places' type="text/javascript"></script> *}
{* <script src="{$url_path}js/locationpicker.jquery.js"></script> *}

<script type="text/javascript">

 /*var elementPosition = $('.tab-option').offset();
    $('.tab-content-con').scroll(function () {
        if ($('.tab-content-con').scrollTop() > elementPosition.top) {
            $('.tab-option').addClass('fix-tab-option');
           
        } else {
             $('.tab-option').removeClass('fix-tab-option');
        }
 });*/
 
 
var change = 0;
var confirm_ask = 0;
var edit_mod = 0;
$(document).ready(function() {
    /*$('#map-block').locationpicker({
        location: {
            latitude: '{$customer_detail.location_lat}',
            longitude: '{$customer_detail.location_lon}'
        },
        radius: 100,
        zoom: 15,
        inputBinding: {
            latitudeInput: $('#location_lat'),
            longitudeInput: $('#location_lon'),
            // radiusInput: $('#us2-radius'),
            locationNameInput: $('#map_location_name')
        },
        enableAutocomplete: true,
        autocompleteOptions: {
            types: ['(cities)'],
            // componentRestrictions: { country: 'fr'}
        }
    });*/

    if($(window).height() > 600) {
        {if empty($customer_detail)}
            $('.tab-content-con').css({ height: $(window).height()-168});  
        {else}
            $('.tab-content-con').css({ height: $(window).height()-253});
        {/if}
    }
    else
        $('.tab-content-con').css({ height: $(window).height()});
        
    $("#remove_file").hide();
    $("#searchkey_text").click(function(){
        if($("#searchkey_text").val() == "{$translate.search_employee}"){
            $("#searchkey_text").val('');
        }
    });
    $("#searchkey_text").blur(function(){
        if($("#searchkey_text").val() == ""){
            $("#searchkey_text").val('{$translate.search_employee}');
        }
    });
    // Added by viteb solution 

    $(function() {
		$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function()  {
			var url = $('#hdn_url').val();
			var customer = $('#username_1').val();
			//alert(url+customer);
			
			var ids = new Array();
			//var hrefs = new Array();
			$('#sortable li').each(function(){
				ids.push($(this).attr('id'));
				//hrefs.push($(this).find('a').attr('href'));
			});			
			$('#tmp_allocate').val(ids);
		}	
		});
    });
	
    
    $(".side_links li a,.logout").click(function(event){
        event.preventDefault();
        var href_val = $(this).attr('href');
        
        var new_var = $("#new").val();
        if(change == 1){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            confirm_ask = 1;
                            saveForm();
                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                document.location.href = href_val;
                        }
                    }
            });
        }
        else{
            document.location.href = href_val;
        }
    
    });     
    //set century asper SSN
    $( "#social_security" ).keyup(function() {
        var tmp_val = $(this).val();
        tmp_val = tmp_val.replace(/-/g, "");
        tmp_val = tmp_val.replace(/ /g, "");
        if(tmp_val.length >= 2){
            var temp_first_2_digit = parseInt(tmp_val.substring(0, 2));
            if(temp_first_2_digit >= 0 && temp_first_2_digit <= parseInt({$year_in_2_digit})){
                $('#century').val(20);
            } else {
                $('#century').val(19);
            }
        }
    });
    //validate social security number
    $('#social_security').blur(function() {
           var security = $('#social_security').val();
           security = security.replace("-","");
           $.post("{$url_path}ajax_check_social_security/", { social_security : security },
                                                   function(data){
                                                       $('#soc_sec').html(data);
                                                       if(data!= ""){
                                                           $("#social_security").addClass("error");
                                                           $('#social_security').focus();
                                                           $('#social_flag').val('');  
                                                       }else{
                                                           $('#social_flag').val('1');
                                                           $("#social_security").removeClass("error");
                                                           var last_digit = security.substring(8,9);
                                                           if(last_digit % 2 == 0){
                                                                   $('#gender_male').prop('checked',false);
                                                                   $('#gender_female').prop('checked', true);
                                                           } else {
                                                                   $('#gender_male').prop('checked', true);
                                                                   $('#gender_female').prop('checked', false);
                                                           }
                                                       }
                                                   });
});
   
    $("#first_name").blur(function() {
        if ($("#first_name").val() == ""){
                 $("#first_name").addClass("error");
           }
           else{
                 $("#first_name").removeClass("error");
           }
    });
    $("#last_name").blur(function() {
        if($("#last_name").val()==""){
                 $("#last_name").addClass("error");
           }
           else{
                 $("#last_name").removeClass("error");
           }
    });


    $("#post").blur(function() {
        if($("#post").val()==""){
                 $("#post").addClass("error");
           }
           else{
                 $("#post").removeClass("error");
           }
    });

    $("#date").blur(function() {
        if($("#date").val()==""){
                 $("#date").addClass("error");
           }
           else{
                 $("#date").removeClass("error");
           }
    });
    $("#email").blur(function() {
        $('#email').removeClass('error');
        // if($("#email").val()== "" && $('input:radio[name=send_mail]:checked').val() == 1){
        //          $("#email").addClass("error");
        //    }
        //    else{
        //          $("#email").removeClass("error");
        //    }
           
    });

        
    /*$( "#date" ).datepicker({
        showOn: "button",
        buttonImage: "{$url_path}images/date_pic.gif",
        buttonImageOnly: true
    });*/
    

    //generating username w.r.t lastname blur
    if($('#username').val() ==""){
        $('#last_name').blur(function() {
            if($('#last_name').val() != "" && $('#first_name').val() != ""){
                var name_first =  $('#first_name').val();
                var name_last =  $('#last_name').val();
                name_first = name_first.replace(/\Ä/g, "A");
                name_first = name_first.replace(/\Å/g, "A");
                name_first = name_first.replace(/\É/g, "E");
                name_first = name_first.replace(/\Ö/g, "O");
                name_first = name_first.replace(/\ä/g, "a");
                name_first = name_first.replace(/\å/g, "a");
                name_first = name_first.replace(/\é/g, "e");
                name_first = name_first.replace(/\ö/g, "o");
                name_last = name_last.replace(/\Ä/g, "A");
                name_last = name_last.replace(/\Å/g, "A");
                name_last = name_last.replace(/\É/g, "E");
                name_last = name_last.replace(/\Ö/g, "O");
                name_last = name_last.replace(/\ä/g, "a");
                name_last = name_last.replace(/\å/g, "a");
                name_last = name_last.replace(/\é/g, "e");
                name_last = name_last.replace(/\ö/g, "o");
                $.post("{$url_path}ajax_generate_username/", { first_name : name_first , last_name : name_last },
                                        function(data){
                                            $('#username').val(data);
                                            //if(parseInt(data.substring(4,7)) > 1)
                                            var security = $('#social_security').val();
                                            security = security.replace("-","");
                                            $('#dialog_hidden').load("{$url_path}ajax_global_check.php?ssno=" + security);
                                        });
            }
        });
    }
			
        //generating username w.r.t firstname blur
    if($('#username').val() =="") {
        $('#first_name').blur(function() {
        if($('#last_name').val() != "" && $('#first_name').val() != ""){
            var name_first =  $('#first_name').val();
               var name_last =  $('#last_name').val();
               name_first = name_first.replace(/\Ä/g, "A")
               name_first = name_first.replace(/\Å/g, "A")
               name_first = name_first.replace(/\É/g, "E")
               name_first = name_first.replace(/\Ö/g, "O")
               name_first = name_first.replace(/\ä/g, "a")
               name_first = name_first.replace(/\å/g, "a")
               name_first = name_first.replace(/\é/g, "e")
               name_first = name_first.replace(/\ö/g, "o")
               name_last = name_last.replace(/\Ä/g, "A")
               name_last = name_last.replace(/\Å/g, "A")
               name_last = name_last.replace(/\É/g, "E")
               name_last = name_last.replace(/\Ö/g, "O")
               name_last = name_last.replace(/\ä/g, "a")
               name_last = name_last.replace(/\å/g, "a")
               name_last = name_last.replace(/\é/g, "e")
               name_last = name_last.replace(/\ö/g, "o")
            $.post("{$url_path}ajax_generate_username/", { first_name : name_first , last_name : name_last },
        function(data){
        $('#username').val(data);	
    });
    }
    });
    }

        
        
       $('#mobile').blur(function() {
            var mobiles = $('#mobile').val();
         if($('#mobile').val() != "" ||  $('#mobile').val() != "+46"){
            mobiles = removeCharas(mobiles);
            mobiles =trimMobileNumber(mobiles);
            if(isNaN(mobiles)){
                $("#mobile").addClass("error");
                error = error + 1;
            }else{
                $("#mobile").removeClass("error");
            }
        }
       
    //$('#mobs').hide();
   
    });
 
});


function validate_email(email){ // function to validate email
    {literal}
    var email_regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
     return email_regex.test(email);

    {/literal}
}

// generating password
function generate_password(){
    $("#pass").html('<input type="text"  id="password" name="password" value ="{$pass}" />');
    //$('#send_mail_yes:radio').prop("checked", true).attr('checked', 'checked');
}

function loadNotAllocatedWorkers() {
    if($('#searchkey_text').val() == "{$translate.search_employee}" || $('#searchkey_text').val() == ""){
        $('#searchkey').val('');
    }else{
        $('#searchkey').val($('#searchkey_text').val());
    }
    var employee_list = '';         
    var customer = $('#username').val();
    var key = $('#searchkey').val();
    var tmp_allocate = $('#tmp_allocate').val();
    if(tmp_allocate != ''){
        employee_list = tmp_allocate;
    }
    $('#nwoekers_list').html('<img src="{$url_path}images/ajax-loader.gif" />');
    $.ajax({
        url:"{$url_path}ajax_employee_list.php",
        type:"POST",
        data:encodeURI("listtype=toadd&customer=" + customer  + "&searchkey=" + key + "&employees=" + employee_list),
        success:function(data){
            $("#nwoekers_list").html(data);
            scroller();
        }
    });
}

function assignEmployee(username) {
    markChange(); 
    var tmp_allocate = $('#tmp_allocate').val();
    var new_members = $('#new_team_member').val();
    var remove_members = $('#remove_member').val();
    var tmp_allocate_array = remove_members.split(",");
    var tl = $('#tl').val();
    var stl = $('#stl').val();
    var rem_mem_allocate = '';
    var new_user_list = '';
    var j = 0;
    for(var i=0; i < tmp_allocate_array.length; i++) {
        if(tmp_allocate_array[i] != username) {
            if(j > 0){
                rem_mem_allocate += ",";
            }
            rem_mem_allocate += tmp_allocate_array[i];
            j++;
        }
    }
    if(new_members != ''){
        new_members = new_members + ',' + username
    }else{
        new_members = username;
    }
    if(tmp_allocate != '') {
        new_user_list = tmp_allocate + ',' + username;
    } else {
        new_user_list = username;
    }
    $('#remove_member').val(rem_mem_allocate);
    $('#new_team_member').val(new_members);
    $('#tmp_allocate').val(new_user_list);
    $('#naddwoekers_list').html('<img src="{$url_path}images/ajax-loader.gif" />');
    $.ajax({
        url:"{$url_path}ajax_employee_list.php",
        type:"POST",
        data:"listtype=allocated&employees=" + new_user_list + "&tl="+tl+"&stl="+stl+"&customer={$customer_username}",
        success:function(data){
            $("#tosave_workers").html(data);
            loadNotAllocatedWorkers();
            scroller();
        }
    });
}

function removeEmployee(username) {
    markChange();  
    var tmp_allocate = $('#tmp_allocate').val();
    var new_members = $('#new_team_member').val();
    var remove_members = $('#remove_member').val();
    var tl = $('#tl').val();
    var stl = $('#stl').val();
    var tmp_allocate_array = tmp_allocate.split(",");
    var tmp_new_member_array = new_members.split(",");
    var new_tmp_allocate = "";
    var new_mem_allocate = "";
    if(remove_members == ""){
        remove_members = username;
    }else{
        remove_members = remove_members+","+username;
    }
    var j = 0;
    for(var i=0; i < tmp_new_member_array.length; i++) {
        if(tmp_new_member_array[i] != username) {
            if(j > 0){
                new_mem_allocate += ",";
            }
            new_mem_allocate += tmp_new_member_array[i];
            j++;
        }
    }
    j=0;
    for(var i=0; i < tmp_allocate_array.length; i++) {
        if(tmp_allocate_array[i] != username) {
            if(j > 0){
                new_tmp_allocate += ",";
            }
            new_tmp_allocate += tmp_allocate_array[i];
            j++;
        }
    }
    $('#remove_member').val(remove_members);
    $('#tmp_allocate').val(new_tmp_allocate);
    $('#new_team_member').val(new_mem_allocate );
    $('#tosave_workers').html('<img src="{$url_path}images/ajax-loader.gif" />');
    $.ajax({
        url:"{$url_path}ajax_employee_list.php",
        type:"POST",
        data:"listtype=allocated&employees=" + new_tmp_allocate + "&tl="+tl+"&stl="+stl,
        success:function(data){
            $("#tosave_workers").html(data);
            loadNotAllocatedWorkers();
            scroller();
        }
    });
}

function makeTl(user) {

    if(edit_mod == 1){
        var tls = $('#tl').val();
        if(tls == ""){
            tls = user;
            $('#tl').val(user);
        }else{
           tls = tls+","+user;
           $('#tl').val(tls);
        }

        var stl_user = $('#stl').val();
        var temp_tls = $('#tl').val();
        var tmp_allocate = $('#tmp_allocate').val();
        $('#tosave_workers').html('<img src="{$url_path}images/ajax-loader.gif" />');
        console.log(111);
        $.ajax({
            url:"{$url_path}ajax_employee_list.php",
            type:"POST",
            data:"listtype=allocated&employees=" + tmp_allocate + "&tl="+temp_tls+"&stl="+stl_user,
            success:function(data){
                $("#tosave_workers").html(data);
                scroller();
            }
        });
    }
}

function makeSTl(user) {
    if(edit_mod == 1){
        var stls = $('#stl').val();
        if(stls == ""){
            stls = user;
            $('#stl').val(user);
        }else{
           stls = stls+","+user;
           $('#stl').val(stls);
        }

        //$('#stl').val(user);
        var tl_user = $('#tl').val();
        var tmp_allocate = $('#tmp_allocate').val();
        $('#tosave_workers').html('<img src="{$url_path}images/ajax-loader.gif" />');
        $.ajax({
            url:"{$url_path}ajax_employee_list.php",
            type:"POST",
            data:"listtype=allocated&employees=" + tmp_allocate + "&stl="+stls+"&tl="+tl_user,
            success:function(data){
                $("#tosave_workers").html(data);
                scroller();
            }
        });
    }
}

function showTemp(){
    //alert($('#tmp_allocate').val());
}
//save form
function saveForm(){
    var error_pass = 0;                                   
    var error = 0;
    var errors = 0;
    var email_check = $('#email').val();
    var proceed;
    if(email_check == ''){
        proceed = true;
    }
    else{
        if(!validate_email(email_check)){
            $('#email').addClass('error');
            proceed = false;
        }
        else{
            $('#email').removeClass('error');
            proceed = true;
        }
    }
    if(proceed == true){
        if($("#phone").val() == "0"){
            $("#phone").val('');
        }
        if($("#mobile").val() == "+46"){
            $("#mobile").val('');
        }
        if($("#relative_phone").val() == "0"){
            $("#relative_phone").val('');
        }
        if($("#relative_work_phone").val() == "0"){
            $("#relative_work_phone").val('');
        }
        if($("#relative_mobile").val() == "+46"){
            $("#relative_mobile").val('');
        }
        if($("#guardian_mobile").val() == "+46"){
            $("#guardian_mobile").val('');
        }
        if($("#guardian_mobile2").val() == "+46"){
            $("#guardian_mobile2").val('');
        }
        var security = $('#social_security').val();
        security = security.replace("-","");
         $.ajax({
         url:"{$url_path}ajax_check_social_security/",  
        type:"POST",
        data:"social_security="+security,
        success:function(data){
                //$('#soc_sec').html(data);
                if(data == "{$translate.this_social_security_number_is_wrong}"){
                    $("#social_security").addClass("error");
                    $('#social_security').focus();
                    $('#social_flag').val(''); 
                } else {
                    $('#social_flag').val('1');
                    $("#social_security").removeClass("error");
                }
                if($('#social_flag').val() == ""){
                         $("#social_security").addClass("error");
                         errors =  1;
                }
        
                var pass = $("#password").val();
                if(pass.length < 8){
                    $("#password").addClass("error");
                    error_pass = 1;
                }      
                
                if($('#mobile').val() != ""){
                        var mobiles = $('#mobile').val();
                        mobiles = removeCharas(mobiles);
                        mobiles = trimMobileNumber(mobiles);
                        if(isNaN(mobiles)){
                            $("#mobile").addClass("error");
                            error = error + 1;
                        }else{
                            $("#mobile").removeClass("error");
                        }
                }
        
        
                //$("#mobile").removeClass("error");

                if ($("#first_name").val() == ""){

                        $("#first_name").addClass("error");
                        error = error + 1;
                }
                else{
                        $("#first_name").removeClass("error");
                }
                if($("#last_name").val()==""){
                        $("#last_name").addClass("error");
                        error = error + 1;
                }
                else{
                        $("#last_name").removeClass("error");
                }

                if($("#date").val()==""){
                        $("#date").addClass("error");
                        error = error + 1;
                }
                else{
                        $("#date").removeClass("error");
                }
                // mail_send = $('input:radio[name=send_mail]:checked').val();
                // if(mail_send == 1){
                //         if($("#email").val()== ""){
                //             $("#email").addClass("error");
                //             error = error + 1;
                //     }
                //     else{
                //             $("#email").removeClass("error");
                //     }
                // }else{
                //             $("#email").removeClass("error");
                // }
                if(error == 0 && error_pass == 0 && errors == 0){
                    if(confirm_ask == 0){
                        //set message warning if employee will deactivate
                        var diactivation_warning = '';
                        var radio_val = $('input:radio[name=status]:checked').val();
                        if(radio_val == 0){
                            diactivation_warning = '<br/> {$translate.caution}: {$translate.slots_after_inactivation_date_will_be_delete}';
                        }

                        bootbox.dialog('{$translate.want_save_changes} '+diactivation_warning, [{
                                        "label" : "{$translate.no}",
                                        "class" : "btn-danger",
                                        "callback": function() {
                                            bootbox.hideAll();
                                        }
                                    }, {
                                        "label" : "{$translate.yes}",
                                        "class" : "btn-success",
                                        "callback": function() {
                                                bootbox.hideAll();
                                                $("#form").submit();
                                        }
                                }]);
                          }else{
                            var radio_val = $('input:radio[name=status]:checked').val();
                                if(radio_val == 0){
                                    bootbox.dialog('{$translate.caution}: {$translate.slots_after_inactivation_date_will_be_delete}', [{
                                            "label" : "{$translate.no}",
                                            "class" : "btn-danger",
                                            "callback": function() {
                                                bootbox.hideAll();
                                            }
                                        }, {
                                            "label" : "{$translate.yes}",
                                            "class" : "btn-success",
                                            "callback": function() {
                                                    bootbox.hideAll();
                                                    $("#form").submit();
                                            }
                                    }]); 
                                } else
                                    $("#form").submit();
                          }
                    }
                    else{
                        if(error != 0){
                            $("#error_error").html("{$translate.required_missing}");
                        }
                        if(error_pass != 0){
                            $("#error_pass").html("{$translate.password_minimum}");
                        }
                    }
            }
                    
        });
        
	}		
       
}

//reset form
function resetForm(){

document.location.href='{$url_path}customer/add/{$customer_username}/';
} 

//print form
function printForm(){

}

function attachAnother() {
 markChange()               
var file_count = parseInt($('#file_count').val()) + 1;
if(file_count > 1){
    $("#remove_file").show();
}
$('#file_count').val(file_count);
$('#file_attach').append("<div class='file_attach_row" + file_count +"'><input type='file' name='file_" + file_count +"' id='file_" + file_count +"' size='12' /></div>");
}

function removeFile(id){
markChange()
var id = $('#file_count').val();
var file_count = parseInt(id) - 1;
if(file_count == 1){
    $("#remove_file").hide();
}
$('#file_count').val(file_count);
$('div').remove('.file_attach_row' + id);
}
function docRemove(doc, this_obj) {
markChange()
 var old_del = $("#del_doc").val();               
var old_docs = $('#tdocs').val();
var doc_array = old_docs.split(",");
for(var i=0; i < doc_array.length; i++) {
if(doc_array[i] == doc) {
doc_array.splice(i, 1);
if(old_del == ""){
    $("#del_doc").val(doc);
}else{
$("#del_doc").val(old_del+","+doc);
}
break;
}
}
var new_array = doc_array.toString();
$('#tdocs').val(new_array);
    //$('#file_list').html('<img src="{$url_path}images/ajax-loader.gif" />');
    //$("#file_list").load("{$url_path}ajax_customer_attachments.php?type=customer_attachment&docs=" + new_array);

    $(this_obj).parents('li.list-group-item').remove();
}

function listAllRelatives(){
    
    var username = $('#username').val();
    $('#relatives_list').html('<img src="{$url_path}images/ajax-loader.gif" />');
    $.ajax({
        url:"{$url_path}ajax_customer_relative.php",
        type:"POST",
        data:"action=list&customer="+username,
        success:function(data){
            $("#relatives_list").html(data);
            if($("#relatives_list table tr").length > 12)
            $("#relatives_list").css("overflow-y","scroll");
            $('#relatives_add').html('<img src="{$url_path}images/ajax-loader.gif" />');
            $("#relatives_add").load("{$url_path}ajax_customer_relative.php?action=add");
        }
    });
}
			
function deleteRelative(id) {
      
    if(confirm("{$translate.are_you_sure}")) {

        var username = $('#username').val();
        $.ajax({
            url:"{$url_path}ajax_customer_relative.php",
            type:"POST",
            data:"action=delete&id="+id+"&customer="+username,
            success:function(data){
                listAllRelatives()
            }
        });
    }
}

function loadRelative(id){
       
    var username = $('#username').val();
    $.ajax({
        url:"{$url_path}ajax_customer_relative.php",
        type:"POST",
        data:"action=load&id="+id+"&customer="+username,
        success:function(data){
            $("#relatives_add").html(data);
        }
    });
}
function addRelative(){
    var username = $('#username').val();
    $.ajax({
        url:"{$url_path}ajax_customer_relative.php",
        type:"POST",
        data:"action=add&customer="+username,
        success:function(data){
            $("#relatives_add").html(data);
        }
    });
}

function saveRelative(){

    var username = $('#username').val();
    var relative_id = $("#relative_id").val();
    var relative_name = $("#relative_name").val();
    var relative_address = $("#relative_address").val();
    var relative_city = $("#relative_city").val();
    var relative_relation = $("#relative_relation").val();
    var relative_phone = $("#relative_phone").val();
    var relative_work_phone = $("#relative_work_phone").val();
    var relative_mobile = $("#relative_mobile").val();
    var relative_email = $("#relative_email").val();
    var relative_other = $("#relative_other").val();

    var data_set = {
        'action' : 'save',
        'customer' : username,
        'name' : relative_name,
        'address' : relative_address,
        'city' : relative_city,
        'relation' : relative_relation,
        'phone' : relative_phone,
        'work_phone' : relative_work_phone,
        'mobile' : relative_mobile,
        'email' : relative_email,
        'other' : relative_other,
        'id' : relative_id
    };

    $.ajax({
        url:"{$url_path}ajax_customer_relative.php",
        type:"POST",
        data: data_set,
        success:function(data){
            listAllRelatives();
        }
    });

}

function markChange(){
    change = 1;
    $("#new").val("1");
}

function redirectConfirm(mode){
    var redirectURL = mode.replace("%%C-UNAME%%", "{$customer_detail.username}");
    if(redirectURL != ''){
        if(change == 1){
            $( "#dialog-confirm" ).dialog({
                resizable: false,
                height:140,
                modal: true,
                buttons: {
                    "{$translate.yes}": function() {
                            $( this ).dialog( "close" );
                            confirm_ask = 1;
                            saveForm();
                        },
                        "{$translate.no}": function() {
                                $( this ).dialog( "close" );
                                document.location.href = redirectURL;
                        }
                    }
            });
        }
        else{
            document.location.href = redirectURL;
        }
    }
}


function giveInactive(){
    var inact = $("#date_inactive").val();
    if(inact == "" || inact == null){
        $("#date_inactive").val("{$today}");
    }
    markChange();

}   

function giveActivation(){
    var inact = $("#date_inactive").val();
    if(inact != "" || inact != null){
        $("#date_inactive").val("");
    }
    
    markChange();

} 
function downloadFile(filename){
    document.location.href = "{$url_path}download.php?{$download_folder}/"+filename;
}

function trimNumber(s) {
        while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
        return s;
    }
function trimMobileNumber(s) {
    while (s.substr(0,3) == '+46' && s.length>1) { s = s.substr(3,9999); }
    return s;
}

function removeCharas(s) {
    var i=0;
    var temp_mobile = '';
    while(i<s.length){
        if(s.substr(i,1) == " " || s.substr(i,1) == "." || s.substr(i,1) == "," || s.substr(i,1) == "-" || s.substr(i,1) == "_"){
            i++;
        }else{
            temp_mobile = temp_mobile+s.substr(i,1);
            i++;
        }
    }
    return temp_mobile;
}

function scroller(){
    {*$('.workers, .assigned_workers_names, .trusteeship_file_lists, #scroller').jScrollPane();
    $('.scroll-pane-arrows').jScrollPane(
            {
                    showArrows: true,
                    horizontalGutter: 10
            }
    );*}return true;
}
</script>
<script>
$(document).ready(function(){

    {if $access_flag == 1 && $customer_username != ''}
        edit_mod = 0;
        //$("#password, .btn-group button:not(.excluded_edit button), #form select,  #form input:not(.excluded_edit input), #form textarea").prop('disabled', true);
        $("#password, #save, #add, .include_edit, .btn-group button:not(.excluded_edit button), #form select:not(.excluded_edit) option:not(:selected)").attr('disabled', true);
        $("#form input:not(.excluded_edit), #form textarea:not(.excluded_edit)").prop('readonly', true);
        $(':radio:not(.excluded_edit),:checkbox:not(.excluded_edit)').click(function(){
            return false;
        });
        $('.icon-plus, .icon-minus').hide();
        
        //$(':radio,:checkbox').unbind('click');

        $("#btn_edit").click(function() {
            
            bootbox.dialog('{$translate.edit_customer_personal_data_mail_go}', [
                {
                "label" : "{$translate.no}",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        //document.location.href = "{$url_path}customer/add/{if isset($customer_username)}{$customer_username}/{/if}";
                    }
                }, 
                {
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                        edit_mod = 1;
                        
                        $("#password, #save, #add, .include_edit, .btn-group button:not(.excluded_edit button), #form select:not(.excluded_edit) option:not(:selected)").attr('disabled', false);
                        $("#form input:not(.excluded_edit, #username), #form textarea:not(.excluded_edit)").prop('readonly', false);
                        $(':radio:not(.excluded_edit),:checkbox:not(.excluded_edit)').unbind('click');
                        $('.icon-plus, .icon-minus').show();


                        $(".datepicker").datepicker({
                            autoclose: true,
                            weekStart: 1,
                            calendarWeeks: true, 
                            language: '{$lang}'
                        });

                        $.mask.definitions['~']='[1-9]';
                        $("#mobile, #guardian_mobile, #guardian_mobile2, #relative_mobile").mask("+46?99 999 99 99", { placeholder:" "});
                        $("#phone, #relative_phone, #relative_work_phone").mask("0?~9-99999999999", { placeholder:" "});
                        
                        $("#btn_save").removeAttr('disabled');
                    }
                }
            ]);      
        });
    {else}

    $.mask.definitions['~']='[1-9]';
    $("#mobile, #guardian_mobile, #guardian_mobile2, #relative_mobile").mask("+46?99 999 99 99", { placeholder:" "});
    $("#phone, #relative_phone, #relative_work_phone").mask("0?~9-99999999999", { placeholder:" "});

        $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '{$lang}'
        });
    {/if}



    var hidWidth;
    var scrollBarWidths = 40;

    var widthOfList = function(){
      var itemsWidth = 0;
      $('.list li').each(function(){
        var itemWidth = $(this).outerWidth();
        itemsWidth+=itemWidth;
      });
      return itemsWidth;
    };

    var widthOfHidden = function(){
      return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
    };

    var getLeftPosi = function(){
      return $('.list').length > 0 ? $('.list').position().left : 0;
    };
    var reAdjust = function(){
      if (($('.wrapper').outerWidth()) < widthOfList()) {
        $('.scroller-right').show();
      }
      else {
        $('.scroller-right').hide();
      }

      if (getLeftPosi()<0) {
        $('.scroller-left').show();
      }
      else {
        $('.item').animate({ left:"-="+getLeftPosi()+"px" },'slow');
            $('.scroller-left').hide();
      }
    }


    reAdjust();

    $(window).on('resize',function(e){  
        reAdjust();
    });

    $('.scroller-right').click(function() {

      $('.scroller-left').fadeIn('slow');
      $('.scroller-right').fadeOut('slow');

      $('.list').animate({ left:"+="+widthOfHidden()+"px" },'slow',function(){

      });
    });

    $('.scroller-left').click(function() {

            $('.scroller-right').fadeIn('slow');
            $('.scroller-left').fadeOut('slow');

            $('.list').animate({ left:"-="+getLeftPosi()+"px" },'slow',function(){

            });
    });    

});
function backForm() {
    //document.location.href = '{$url_path}list/customer/{if $customer_detail.status == '0'}inact{else}act{/if}/';
    window.history.back();
}

function print_data(){
    if (!Date.now) {
        Date.now = function() { return new Date().getTime(); }
    }
    
    window.open('{$url_path}pdf_customer_information.php?username={$customer_detail.username}&_'+Date.now());
}
</script>
{/block}