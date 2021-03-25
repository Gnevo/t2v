{*this is only for testing with accordian animation*}
{block name="style"}
<link href="{$url_path}css/employee_details.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .anställd_block {
	background: #e3edf0;
	padding: 5px 0px;
	margin: 0px 7px 10px 7px;
    }
    .ar_block {
    }
    .Anställd_postions {
            float: left;
            width: 100%;
            padding-left: 11px;
    }
    .sign_personlist {
            width: 100%;
            padding-top:9px;
            float:left;
            padding:9px 11px 5px 11px;
    }
    .sign_personlist .sign_box {
            border: 1px solid #d6d6d6;
            float: left;
            padding: 2px 4px;
            position:relative;
            margin-right:12px;
            margin-bottom:5px;
    }
    .sign_personlist .sign_box a {
            background:url(../images/surveys_close.png) no-repeat;
            width:14px;
            height:14px;
            position:absolute;
            right: -11px;
            top: 3px;
    }
    .alpha_selct_dv ul li {
            list-style: none;
    }
    a.signin_delet {
            background: url(../images/signin_delete.png) no-repeat scroll 6px center #FFFFFF;
            padding-bottom:2px; 
            padding-top:2px; 
            float:left;
    }
    .sign_box a {
            cursor: pointer;
    }
    .allassistans_pdf_files {
            float:left; 
            padding-left: 10px; 
            margin-top: 10px;
    }
    .allassistans_pdf_files_label {
            float:left; 
            padding:3px 2px 0px 0px;
            width: 94px;
    }
    .employee_allassistans_div {
            height:30px; 
            width: 100%;
    }
    .employee_allassistans_label {
            float:left; 
            padding:3px 2px 0px 0px ;
            width: 94px;
    }
    .employee_allassistans_signing {
            float:left; 
            padding-top: 5px; 
            width: 100%;
    }
    .employer_role {
            float:left; 
            margin:0px 5px 0px 2px; 
            height:20px;
    }
    .Anställd_postions .signin {
            padding-bottom:2px; 
            padding-top:2px; 
            float:left; 
            margin-right: 4px;
    }
    .sign_personlist_caption {
            float: left; 
            font-weight: bold; 
            padding: 3px 3px 0px 0px;
    }
    .not_signed_emp {
            clear: both; 
            text-align: left; 
            padding:10px 12px 10px 11px;
    }
    .employer_role_label {
            float:left; 
            padding:3px 5px 0px 0px;
    }
</style>
{/block}

{block name="script"}
<script type="text/javascript">
$(document).ready(function(){
        
    function getNewEmployees(thisparent){
            var cust_id = thisparent.find("#cust_id").val();
            var year= thisparent.find("#cmb_year").val();
            var month= thisparent.find("#cmb_month").val();
            var nk= thisparent.find("#radio").find("input:checked").val();
            wrapLoader(thisparent);
            $.ajax({
                        async:true,
                        url:"{$url_path}ajax_get_employees_for_customer.php",
                        data:"cid="+cust_id+"&month="+month+"&year="+year+"&nk="+nk,
                        type:"POST",
                        success:function(data){
                                thisparent.find(".tidsredov_block .anställd_block").html(data);
                                thisparent.find("#error_div").html('');
                                uwrapLoader(thisparent);
                        }
            });
    }
    
    $(".listed_details #cmb_employee").die('change');
    $(".listed_details #cmb_employee").live('change', function() {
            var thisparent = $(this).parents('.listed_details');
            var cID= thisparent.find("#cust_id").val();
            var year= thisparent.find("#cmb_year").val();
            var month= thisparent.find("#cmb_month").val();
            var emp= thisparent.find("#cmb_employee").val();
            var type= thisparent.find("#radio").find("input:checked").val();
            wrapLoader(thisparent);
            $.ajax({
                        async:true,
                        url:"{$url_path}ajax_employer_signing.php",
                        data:"cid="+cID+"&month="+month+"&year="+year+"&fkkn="+type+"&emp="+emp+"&action=check",
                        type:"POST",
                        success:function(data){
                                var data = data.split("||||");
                                thisparent.find(".employee_allassistans_signing").html(data[0]);
                                thisparent.find(".sign_personlist").html(data[1]);
                                uwrapLoader(thisparent);
                        }
            });
    });
    
    $(".allassistans_pdf_files .cmb_pdf_files").die('change');
    $(".allassistans_pdf_files .cmb_pdf_files").live('change', function() {
            var file_name = $(this).val().trim();
            if(file_name != ''){
                window.open("{$url_path}pdf_viewer.php?name="+file_name+'&type=1');
            }
    });
    
    $(".listed_details #emp_form .listed_year_month_dv .year").delegate("#cmb_year", "change", function() {
            var thisparent = $(this).parents(".listed_details");
            getNewEmployees(thisparent);
    });

    $(".listed_details #emp_form .listed_year_month_dv .month").delegate("#cmb_month", "change", function() {
            var thisparent = $(this).parents(".listed_details");
            getNewEmployees(thisparent);
    });

    $(".listed_details #emp_form .listed_year_month_dv #radio").delegate("#radio1, #radio3", "change", function() {
            var thisparent = $(this).parents(".listed_details");
            getNewEmployees(thisparent);
    });

    /*$(".list").click(function() {
            var thisparent = $(this).parent().children(".listed_details");
            $(".listed_details").slideUp("slow");
            if (thisparent.css("display") == 'none'){
                thisparent.slideToggle("slow");
                thisparent.find("#error_div").html('');
                thisparent.find(".bargaining").first().attr('checked', 'checked');
{*                thisparent.find(".agreement_type").first().attr('checked', 'checked');*}
                setTimeout(function(){ getNewEmployees(thisparent); },300);
            }
    });*/
    
    $( "#employee_block" ).accordion({
        collapsible: true,
        icons: null,
        heightStyle: "content",
        animate: "bounceslide"
    });
    $( "#employee_block" ).on( "accordionactivate", function( event, ui ) { alert('ccc'); } );
    
    $(".txtbargaining").click(function() {
            $(this).parents('.bargaining_group').find(".otherbargaining").attr('checked', 'checked');
    });

    $(".otherbargaining").click(function() {
            $(this).parents('.bargaining_group').find(".txtbargaining").focus();
    });

    $(".bargaining").click(function() {
            $(this).parents('.bargaining_group').find(".txtbargaining").val('');
    });

    $(".signin").die('click');
    $(".signin").live('click', function() {
            var thisparent = $(this).parents('.listed_details');
            var cID= thisparent.find("#cust_id").val();
            var year= thisparent.find("#cmb_year").val();
            var month= thisparent.find("#cmb_month").val();
            var emp= thisparent.find("#cmb_employee").val();
            var employer_role = thisparent.find(".employer_role").val();
            var type= thisparent.find("#radio").find("input:checked").val();
{*            alert(cID+'-'+year+'-'+month+'-'+emp);*}
            employer_role = employer_role.trim();
            if (employer_role == ''){
                alert('Please enter Employer Position');
                thisparent.find(".employer_role").focus();
            }else{
                wrapLoader(thisparent);
                $.ajax({
                            async:true,
                            url:"{$url_path}ajax_employer_signing.php",
                            data:"cid="+cID+"&month="+month+"&year="+year+"&fkkn="+type+"&emp="+emp+"&employer_role="+employer_role+"&action=signing",
                            type:"POST",
                            success:function(data){
                                    var data = data.split("||||");
                                    thisparent.find(".employee_allassistans_signing").html(data[0]);
                                    thisparent.find(".sign_personlist").html(data[1]);
                                    uwrapLoader(thisparent);
                            }
                });
            }
    });
    
    $(".employee_allassistans_signing .signin_delet").die('click');
    $(".employee_allassistans_signing .signin_delet").live('click', function() {
            var thisparent = $(this).parents('.listed_details');
            var cID= thisparent.find("#cust_id").val();
            var year= thisparent.find("#cmb_year").val();
            var month= thisparent.find("#cmb_month").val();
            var emp= thisparent.find("#cmb_employee").val();
            var type= thisparent.find("#radio").find("input:checked").val();
            wrapLoader(thisparent);
            $.ajax({
                        async:true,
                        url:"{$url_path}ajax_employer_signing.php",
                        data:"cid="+cID+"&month="+month+"&year="+year+"&fkkn="+type+"&emp="+emp+"&action=remove",
                        type:"POST",
                        success:function(data){
                                var data = data.split("||||");
                                thisparent.find(".employee_allassistans_signing").html(data[0]);
                                thisparent.find(".sign_personlist").html(data[1]);
                                uwrapLoader(thisparent);
                        }
            });
    });
    
    $(".sign_personlist .sign_box a").die('click');
    $(".sign_personlist .sign_box a").live('click', function() {
            var sel_emp = $(this).attr('data-attrib-emp');
            var thisparent = $(this).parents('.listed_details');
            var cID= thisparent.find("#cust_id").val();
            var year= thisparent.find("#cmb_year").val();
            var month= thisparent.find("#cmb_month").val();
            var type= thisparent.find("#radio").find("input:checked").val();
            if(sel_emp != ''){
                wrapLoader(thisparent);
                $.ajax({
                            async:true,
                            url:"{$url_path}ajax_employer_signing.php",
                            data:"cid="+cID+"&month="+month+"&year="+year+"&fkkn="+type+"&emp="+sel_emp+"&action=remove&remove_type=direct_box",
                            type:"POST",
                            success:function(data){
                                    var data = data.split("||||");
                                    thisparent.find(".employee_allassistans_signing").html(data[0]);
                                    thisparent.find(".sign_personlist").html(data[1]);
                                    uwrapLoader(thisparent);
                            }
                });
            }
    });
    
    $('.agreement_type_special').change(function(){
        var company_name = '';
        var org_no = '';
        var this_company_field = $(this).parents('.agreements_group').find('.agreement_type2_company');
        var this_org_field = $(this).parents('.agreements_group').find('.agreement_type2_orgno');
        if($(this).is(':checked')){
            company_name = this_company_field.attr('data-company');
            org_no = this_org_field.attr('data-org-no');
        }else{
            company_name = '';
            org_no = '';
            var reseted_company = this_company_field.val();
            var reseted_orgno = this_org_field.val();
            this_company_field.attr('data-company', reseted_company);
            this_org_field.attr('data-org-no', reseted_orgno);
        }
        this_company_field.val(company_name);
        this_org_field.val(org_no);
    });
});

{if $user_role != 4}
function select_customer(name){
    navigatePage("{$url_path}pdf/report/work/customer/"+name+"/",8)
}
{/if}

function data_existance_check(cur_button){ 
    var error= $(cur_button).parents('.listed_details').find("#error_div");
    error.html('');
    var cID= $(cur_button).parents('.listed_details').find("#cust_id").val();
    var year= $(cur_button).parents('.listed_details').find("#cmb_year").val();
    var month= $(cur_button).parents('.listed_details').find("#cmb_month").val();
    var type= $(cur_button).parents('.listed_details').find("#radio").find("input:checked").val();
    var emp= $(cur_button).parents('.listed_details').find("#cmb_employee").val();
    
    var bargaining= $(cur_button).parents('.listed_details').find('.bargaining_group').find("input:checked.bargaining").val();
    var bargaining_text = $(cur_button).parents('.listed_details').find('.bargaining_group').find(".txtbargaining").val();
    var agreement_special = $(cur_button).parents('.listed_details').find('.agreements_group').find("input:checked.agreement_type_special").val();
    
    var agreement_type2_company = $(cur_button).parents('.listed_details').find('.agreements_group').find(".agreement_type2_company").val();
    var agreement_type2_orgno = $(cur_button).parents('.listed_details').find('.agreements_group').find(".agreement_type2_orgno").val();
    
    var tx=0;

    if($(cur_button).parents('.listed_details').find("#cmb_employee").attr('disabled') == "disabled"){
            error.html('{$translate.this_customer_have_no_employees}');
            return false;
    }else if(year == ""){
            error.html('{$translate.select_year}');
            return false;
    }else if(month == ""){
            error.html('{$translate.select_month}');
            return false;
    }else if(bargaining == '' || typeof bargaining == 'undefined'){
            error.html('{$translate.select_bargaining_type}');
            return false;
    }else if(bargaining == 6 && bargaining_text.trim() == ''){
            error.html('{$translate.enter_other_bargaining}');
            $(cur_button).parents('.listed_details').find('.bargaining_group').find(".txtbargaining").val('');
            $(cur_button).parents('.listed_details').find('.bargaining_group').find(".txtbargaining").focus();
            return false;
    }else if(agreement_special == 1 && typeof agreement_special != 'undefined' && agreement_type2_company.trim() == ''){
            error.html('{$translate.enter_employer_name}');
            $(cur_button).parents('.listed_details').find('.agreements_group').find(".agreement_type2_company").focus();
            return false;
    }else if(agreement_special == 1 && typeof agreement_special != 'undefined' && agreement_type2_orgno.trim() == ''){
            error.html('{$translate.enter_employer_organization_number}');
            $(cur_button).parents('.listed_details').find('.agreements_group').find(".agreement_type2_orgno").focus();
            return false;
    }else{
        {*alert("month="+month+"&year="+year+"&CID="+cID+"&type="+type+"&emp="+emp+"&bargaining="+bargaining+"&agreement="+agreement);*}
        $.ajax({
            async:false,
            url:"{$url_path}ajax_check_exist_employee_work_data.php",
            data:"month="+month+"&year="+year+"&CID="+cID+"&type="+type+"&emp="+emp,
            type:"POST",
            success:function(data){
                    tx=data;
                },
            error:function(jqXHR, textStatus, errorThrown ){
                    {*alert(jqXHR.status); alert(textStatus); alert(errorThrown);*}
                }
        });
        if(tx == 1){
            return true;
        }else{
            error.html('{$translate.no_data_available}');
            return false;
        }
    }
}

function sam_sida(s){
    var error1= $(s).parents('.listed_details').children("#error_div");
    error1.html('');
    var cID= $(s).parents('.listed_details').find("#cust_id").val();
    var year= $(s).parents('.listed_details').find("#cmb_year").val();
    var month= $(s).parents('.listed_details').find("#cmb_month").val();
    var type= $(s).parents('.listed_details').find("#radio").find("input:checked.fkkn").val();
    var emp= $(s).parents('.listed_details').find("#cmb_employee").val();
    
    if(year == ""){
        error1.html('{$translate.select_year}');
       return false;
    }else if(month == ""){
        error1.html('select year{$translate.select_month}');
       return false;
    }else{
        window.open('{$url_path}pdf/report/work/customer/summary/'+month+'/'+year+'/'+cID+'/'+type+'/'+emp+'/');
    }
}

</script>
{/block}

{block name="content"}
<div class="employee_details">
    <div class="tbl_hd">
        <span class="titles_tab">{$translate.customer_employee_monthly_work_report}</span>
        <a href="{$url_path}forms/" class="back"><span class="btn_name">{$translate.backs}</span></a>
    </div>
    <div class="employee_print_details">
        {if $user_role != 4}
            <div class="alpha_selct_dv">
                {assign var='alphabets' value=','|explode:$translate.alphabets}
                <ul>
                    {foreach from=$alphabets item=row}
                        <li><a href="javascript:void(0)" onclick="select_customer('{$row}')">{$row}</a></li>
                    {/foreach}
                </ul>
            </div>
        {/if}
        <div class="employee_details_inner">
            <div class="list_contnts">
                <div id="employee_block" name="employee_block"><!--collaps this fold-->
                {foreach from=$customer_details item=list}
                    <div class="list">
                        <div class="listed_employee"><span class="employee_id">{$list.social_security}</span></div>
                        <span class="employee_name">{$list.last_name} {$list.first_name}</span>
                        <div class="listed_employee_addrs">{$list.city}</div>
                    </div>
                    <div  class="listed_details___">
                        <form name="emp_form" id="emp_form" method="post" target="_blank" action="{$url_path}pdf/report/work/customer/">
                            <input type="hidden" id="cust_id" name="cust_id" value="{$list.username}" />
                            <div class="tidsredov_block">
                                <div class="ar_block clearfix">
                                    <div id="error_div" name="error_div" style="clear: both; text-align: center; padding-right:12px; color:#BB5613; "></div>
                                    <div style="width:458px;height:30px;" class="listed_year_month_dv">
                                        <div class="year_month">
                                            <div style="width:95px;" class="year"> {$translate.year}
                                                <select class="required" id="cmb_year" name="cmb_year" style="margin-left:5px;">
                                                    <option value="" >{$translate.select_year}</option>
                                                    {html_options values=$year_option_values selected=$report_year output=$year_option_values}
                                                </select>
                                                <span class="employee_print_btn" style="width:155px;height:30px;"> </span>
                                            </div>
                                            <div style="width:146px;" class="month"> {$translate.month}
                                                <select id="cmb_month" name="cmb_month"  style="margin-left:5px;">
                                                    <option value="" >{$translate.select_month}</option>
                                                    {html_options values=$month_option_values selected=$report_month output=$month_option_output}

                                                </select>
                                            </div>
                                        </div>
                                        <div style="float:left;margin-top: -20px;height:30px;margin-left: 5px;" id="radio">
                                            <label style="margin-right:5px;"><input type="radio" class="fkkn" id="radio1" name="type" value="1" checked="checked" style="margin-right:3px;" />{$translate.fk}</label>
                                            <label><input type="radio" class="fkkn" id="radio3" name="type" value="2" style="margin-right:3px;" />{$translate.kn}</label>
                                            <span style="color:#FF0000; padding-left: 4px; width: 20px" id="err_msg"></span> 
                                        </div>
                                    </div>
                                    <div style="width:155px;height:30px;" class="employee_print_btn">
                                        <input type="submit" onClick="return data_existance_check(this)" class="skirrut" value="{$translate.print}" id="button1" name="button1"/>
                                        <input type="button" onClick="return sam_sida(this)" class="skirrut" value="{$translate.fkkn_summery_label}" id="button2" name="button2"/>
                                    </div>
                                </div>
                                <div class="anställd_block clearfix">
                                    <div class="employee_allassistans_div employee_allassistans">
                                        <div style="float:left;">
                                            <label class="employee_allassistans_label">{$translate.fkkn_employee}</label>
                                            <select name=cmb_employee id=cmb_employee class="list_detail_assistance" style="width:186px;">
                                                <option value="">{$translate.all_assistents}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="employee_allassistans_signing"></div>
                                    <div class="not_signed_emp" name="not_signed_emp" id="not_signed_emp"></div>
                                </div>
                            </div>
                            <div style="padding-bottom:10px; margin-top:4px;"  class="bargaining_group">
                                <div style="padding:7px 6px 7px 8px; font-size:13px; font-weight:bold; margin-bottom:5px; color:#666666;">5. Uppgifter om kollektivavtal</div>
                                <div style="border:solid 1px #b8b7b7; margin:0px 7px; padding-bottom:10px;">
                                    <table style="margin:0px 7px; font-family:Arial, Helvetica, sans-serif; font-size:12px;" width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr><td height="30" colspan="5">Assistenten omfattas av följande kollektivavtal (markera med kryss)</td></tr>
                                        <tr>
                                            <td width="11%" height="30"><span style="margin-right:10px;">
                                                    <label>
                                                        <input type="radio" checked="checked" value="1" name="bargaining" class="bargaining" style="margin-right:2px;">KFO
                                                    </label></span></td>
                                            <td width="13%" height="30"><span style="margin-right:10px;">
                                                    <label>
                                                        <input type="radio" value="2" name="bargaining" class="bargaining" style="margin-right:2px;">KFS
                                                    </label></span></td>
                                            <td width="17%" height="30"><span style="margin-right:10px;">
                                                    <label>
                                                        <input type="radio" value="3" name="bargaining" class="bargaining" style="margin-right:2px;">HÖK/AB (SKL)
                                                    </label></span></td>
                                            <td width="22%" height="30"><span style="margin-right:10px;">
                                                    <label>
                                                        <input type="radio" value="4" name="bargaining" class="bargaining" style="margin-right:2px;">PAN (SKL)
                                                    </label></span></td>
                                            <td width="37%" height="30"><span style="margin-right:10px;">
                                                    <label>
                                                        <input type="radio" value="5" name="bargaining" class="bargaining" style="margin-right:2px;">Vårdföretagarna, bransch G
                                                    </label></span></td>
                                        </tr>
                                        <tr>
                                            <td height="30"><span style="margin-right:10px;">
                                                    <label>
                                                        <input type="radio" value="6" name="bargaining" class="bargaining otherbargaining" style="margin-right:2px;">Annat:
                                                    </label></span></td>
                                            <td height="30" colspan="3"><input name="txtbargaining" class="txtbargaining" style="width:398px;" type="text" /></td>
                                            <td height="30">
                                                <span style="margin-right:10px;"><label>
                                                    <input type="radio" value="7" name="bargaining" class="bargaining" style="margin-right:2px;">
                                                    Assistenten omfattas inte av något kollektivavtal</label>
                                                </span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div style="background-color:#f6f9f9; margin:6px 0;" class="agreements_group clearfix">
                                <div style="padding:7px 6px 7px 8px; font-size:13px; font-weight:bold; margin-bottom:5px; color:#666666;">6. Uppgifter om den anordnare som har avtal med personen som får personlig assistans</div>
                                <div style="border:solid 1px #b8b7b7; margin:0px 7px; padding-bottom:10px;">
                                    <table style="margin:0px 7px; font-family:Arial, Helvetica, sans-serif; font-size:12px;" width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td height="30" colspan="3">
                                                <span style="margin-right:10px;"><label>
                                                        <input type="checkbox" value="1" name="agreement_type_1" class="agreement_type" style="margin-right:2px;" />
                                                        Vi är arbetsgivare för assistenten och har avtal med personen som får personlig assistans
                                                </label></span></td>
                                        </tr>
                                        <tr>
                                            <td height="30">
                                                <span><label style="float: left; width: 455px; margin-right: 30px;">
                                                    <input type="checkbox" value="1" name="agreement_type_2" class="agreement_type_special" style="margin-right:4px; float: left" />
                                                    <span style="margin-right:5px; float: left;">Vi är uppdragsgivare åt assistenten som är anställd av en annan arbetsgivare</span>
                                                </label></span></td>
                                            <td height="30">
                                                <div style="margin-right:10px;">
                                                    <span style="margin-right:5px;">Arbetsgivarens namn</span>
                                                    <input type="text" value="" name="agreement_type2_company" data-company="{$company_data.name}" class="agreement_type2_company" style="margin-right:2px;width: 129px;" />
                                                </div></td>
                                            <td height="30">
                                                <div style="margin-right:10px;">
                                                    <span style="margin-right:5px;">Organisationsnummer</span>
                                                    <input type="text" value="" name="agreement_type2_orgno" data-org-no="{$company_data.org_no}" class="agreement_type2_orgno" style="margin-right:2px;width: 129px;" />
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td height="30" colspan="3">
                                                <span style="margin-right:10px;"><label>
                                                    <input type="checkbox" value="1" name="agreement_type_3" class="agreement_type" style="margin-right:2px;" />
                                                    Vi har tillstånd från Socialstyrelsen eller Inspektionen för vård och omsorg (gäller inte kommunen)
                                                </label></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                {/foreach}
                    </div>
            </div>
        </div> 
    </div>
</div> 
{/block}