
{block name="style"}
<link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
<style>
    .incon2 td { color: #ff6f54 !important;}
</style>
{/block}
{block name='script'}
<script type="text/javascript">

    $(document).ready(function(){
        $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
        $(window).resize(function(){
          $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
        });

        $('.btn-addnew').click(function(){
            close_right_panel();
            $('#main_container').addClass('show_main_right');
            $(".main-right, .main-right .addnew-box").removeClass('hide');
            
            $('html, body').animate({
                scrollTop: $(".main-right").offset().top
            }, 3000);

            $('.addnew-box .loadedCD').addClass('hide');
            $('.addnew-box .cdinput input').val('');
        });

        $(".btn-cancel-right").click(function() {
            close_right_panel();
        });
    });

    function close_right_panel(){
        $('#main_container').removeClass('show_main_right');
        $(".main-right, .main-right .addnew-box").addClass('hide');
        $('.main-right #right_message_wraper').html('');
    }

    function loadCompany(){
        var __company = $('.addnew-box #fake_user_company').val();

        if(__company != ''){
            $.ajax({
                url:"{$url_path}fake_users_list_for_root.php",
                type:"POST",
                dataType: 'json',
                data: { 'action': 'GET_CUSTOMERS', 'company': __company},
                success:function(data){
                    $('.addnew-box #fake_user_customer').html('<option value="">Select Source Customer</option>');
                    var __temp_options = '';
                    $.each(data, function( index, value ) {
                        __temp_options += '<option value="'+value.username+'" \
                            data-code="'+value.code+'" \
                            data-fname="'+value.first_name+'" \
                            data-lname="'+value.last_name+'" \
                            data-gender="'+value.gender+'" \
                            data-century="'+value.century+'" \
                            data-ssn="'+value.social_security+'" \
                            data-address="'+value.address+'" \
                            data-post="'+value.post+'" \
                            data-city="'+value.city+'" \
                            data-phone="'+value.phone+'" \
                            data-mobile="'+value.mobile+'" \
                            data-email="'+value.email+'" >'+value.last_name+' '+value.first_name+' ('+value.username+')</option>';
                    });
                    $('.addnew-box #fake_user_customer').append(__temp_options);
                    $('.addnew-box .loadedCD').addClass('hide');
                }
            });
        }
        else {
            $('.addnew-box #fake_user_customer').html('<option value="">Select Source Customer</option>');
            $('.addnew-box .loadedCD').addClass('hide');
        }
    }

    function loadCust(){
        var __company = $('.addnew-box #fake_user_company').val();
        var __customer = $('.addnew-box #fake_user_customer').val();

        if(__company != '' && __customer != ''){
            $('.addnew-box .cdinput input').val('');
            $('.addnew-box .loadedCD').removeClass('hide');
            var selectedCustOption = $('.addnew-box #fake_user_customer option:selected');

            console.log(selectedCustOption.attr('data-code'));
            $('.addnew-box #fake_username').val(__customer);
            $('.addnew-box #fake_code').val(selectedCustOption.data('code'));
            $('.addnew-box #fake_fname').val(selectedCustOption.data('fname'));
            $('.addnew-box #fake_lname').val(selectedCustOption.data('lname'));
            $('.addnew-box #fake_century').val(selectedCustOption.data('century'));
            $('.addnew-box #fake_ssn').val(selectedCustOption.data('ssn'));
            $('.addnew-box #fake_address').val(selectedCustOption.data('address'));
            $('.addnew-box #fake_city').val(selectedCustOption.data('city'));
            $('.addnew-box #fake_post').val(selectedCustOption.data('post'));
            $('.addnew-box #fake_phone').val(selectedCustOption.data('phone'));
            $('.addnew-box #fake_mobile').val(selectedCustOption.data('mobile'));
            $('.addnew-box #fake_email').val(selectedCustOption.data('email'));
        }
        else {
            $('.addnew-box .cdinput input').val('');
            $('.addnew-box .loadedCD').addClass('hide');
        }
    }

    function save_fake(){
        var __company = $('.addnew-box #fake_user_company').val();
        var __customer = $('.addnew-box #fake_user_customer').val();

        if(__company != '' && __customer != ''){
            $.ajax({
                url:"{$url_path}fake_users_list_for_root.php",
                type:"POST",
                dataType: 'json',
                data: { 'action': 'GENERATE_FAKE', 'company': __company, 'customer': __customer},
                success:function(data){

                    if(data.result == true){
                        $('.addnew-box #fake_user_customer').val('')
                        $('.addnew-box .cdinput input').val('');
                        $('.addnew-box .loadedCD').addClass('hide');
                        alert('Newly Created Username - '+ data.newUser);
                    }
                    else{
                        alert('Some errors spoted, try again.')
                    }
                }
            });
        }
        else{
            alert('Select a company and customer');
        }
    }
 </script>
{/block}

{block name="content"}

{if $privilege}
    <div class="row-fluid" id="main_container">
        <div class="span12 main-left">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1>Fake Users</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                        <button class="btn btn-default btn-normal ml pull-right btn-addnew" type="button" title="Add New"><i class="icon-plus"></i> Add New</button>
                    </div>
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
                                                            </tr>
                                                        {foreachelse}
                                                            <tr><td colspan="7">
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

        {*    main right*}
        <div class="span4 main-right hide" style="margin-top: 8px; padding: 10px;">
            <div id="right_message_wraper" class="span12 no-min-height"></div>
            
            {* new fake user*}
            <div class="span12 addnew-box hide no-ml">
                <div style="margin: 0px ! important;" class="widget">
                    <div style="" class="widget-header span12">
                        <div class="span4 day-slot-wrpr-header-left span6">
                            <h1 style="">Create New</h1>
                        </div>
                        <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                            <button class="btn btn-default btn-normal pull-right btn-save-user" type="button" onclick="save_fake()"><i class='icon-save'></i> Create</button>
                            <button class="btn btn-default btn-normal pull-right  btn-cancel-right no-ml" type="button"><i class='icon-power-off'></i> {$translate.close}</button>
                        </div>
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="row-fluid">
                            <form method="post" name="user_form" id="user_form" >
                                <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                    <div class="span12" style="margin: 0px;">
                                        <label class="span12" style="float: left;" for="fake_user_company">Company:</label>
                                        <div style="float: left; margin: 0px;" class="input-prepend span11">
                                            <span class="add-on icon-pencil"></span>
                                            <select name="fake_user_company" id="fake_user_company" class="form-control span12" onchange="loadCompany();">
                                                <option value="">Select Company</option>
                                                {foreach from=$companies item=company}
                                                    <option value="{$company.id}">{$company.name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="span12" style="margin: 10px 0px ! important;">
                                        <label class="span12" style="float: left;" for="fake_user_customer">Source Customer:</label>
                                        <div style="float: left; margin: 0px;" class="input-prepend span11">
                                            <span class="add-on icon-pencil"></span>
                                            <select name="fake_user_customer" id="fake_user_customer" class="form-control span12" onchange="loadCust();">
                                                <option value="">Select Source Customer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr />
                                    <br/>
                                    <div class="span12 no-ml loadedCD">
                                        <div style="margin: 10px 0px ! important;" class="span12 cdinput">
                                            <label style="float: left;" class="span12" for="fake_username">Username:</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="fake_username" id="fake_username" class="form-control span11" type="text" disabled />
                                            </div>
                                        </div>
                                        <div style="margin: 10px 0px ! important;" class="span12 cdinput">
                                            <label style="float: left;" class="span12" for="fake_fname">First Name:</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="fake_fname" id="fake_fname" class="form-control span11" type="text" disabled />
                                            </div>
                                        </div>
                                        <div style="margin: 10px 0px ! important;" class="span12 cdinput">
                                            <label style="float: left;" class="span12" for="fake_lname">Last Name:</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="fake_lname" id="fake_lname" class="form-control span11" type="text" disabled />
                                            </div>
                                        </div>
                                        <div style="margin: 10px 0px ! important;" class="span12 cdinput">
                                            <label style="float: left;" class="span12" for="fake_code">Code:</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="fake_code" id="fake_code" class="form-control span11" type="text" disabled />
                                            </div>
                                        </div>
                                        <div style="margin: 10px 0px ! important;" class="span12 cdinput">
                                            <label style="float: left;" class="span12" for="fake_century">Century:</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="fake_century" id="fake_century" class="form-control span11" type="text" disabled />
                                            </div>
                                        </div>
                                        <div style="margin: 10px 0px ! important;" class="span12 cdinput">
                                            <label style="float: left;" class="span12" for="fake_ssn">SSN:</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="fake_ssn" id="fake_ssn" class="form-control span11" type="text" disabled />
                                            </div>
                                        </div>
                                        <div style="margin: 10px 0px ! important;" class="span12 cdinput">
                                            <label style="float: left;" class="span12" for="fake_address">Address:</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="fake_address" id="fake_address" class="form-control span11" type="text" disabled />
                                            </div>
                                        </div>
                                        <div style="margin: 10px 0px ! important;" class="span12 cdinput">
                                            <label style="float: left;" class="span12" for="fake_city">City:</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="fake_city" id="fake_city" class="form-control span11" type="text" disabled />
                                            </div>
                                        </div>
                                        <div style="margin: 10px 0px ! important;" class="span12 cdinput">
                                            <label style="float: left;" class="span12" for="fake_post">Post:</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="fake_post" id="fake_post" class="form-control span11" type="text" disabled />
                                            </div>
                                        </div>
                                        <div style="margin: 10px 0px ! important;" class="span12 cdinput">
                                            <label style="float: left;" class="span12" for="fake_phone">Phone:</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="fake_phone" id="fake_phone" class="form-control span11" type="text" disabled />
                                            </div>
                                        </div>
                                        <div style="margin: 10px 0px ! important;" class="span12 cdinput">
                                            <label style="float: left;" class="span12" for="fake_mobile">Mobile:</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="fake_mobile" id="fake_mobile" class="form-control span11" type="text" disabled />
                                            </div>
                                        </div>
                                        <div style="margin: 10px 0px ! important;" class="span12 cdinput">
                                            <label style="float: left;" class="span12" for="fake_email">Email:</label>
                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                <input name="fake_email" id="fake_email" class="form-control span11" type="text" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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

