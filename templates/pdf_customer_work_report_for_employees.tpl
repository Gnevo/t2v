{block name="style"}
<link href="{$url_path}css/employee_details.css" rel="stylesheet" type="text/css" />
{/block}

{block name="script"}
<script type="text/javascript">
    
$(document).ready(function(){

    //$("#radio").buttonset();
    $(".list").click(function() {

        var c_ref= $(this);
        $(".listed_details").slideUp("slow"); 
        $(this).parent().children(".listed_details").slideToggle("slow"); 
        $(this).parent().children(".listed_details").children("#emp_form").children(".employee_allassistans").remove();
        var emp_id = $(this).parent().children(".listed_details").children("#emp_form").children("#emp_id").val();
//        alert(emp_id);
            $.ajax({
                                    async:false,
                                    url:"{$url_path}ajax_get_employees_for_employee.php",
                                    data:"eid="+emp_id,
                                    type:"POST",
                                    success:function(data){
                                            //$("#holi_table").html(data);
//                                            alert('hi');
                                            c_ref.parent().children(".listed_details").children("#emp_form").append(data);
                                    }
                                    
                                    });
        });
        


});
            
            
       
function data_existance_check(cur_button)
{
    var error= $(cur_button).parent().parent().parent().children("#error_div");
    error.html('');
    var eID= $(cur_button).parent().parent().children("#emp_id").val();
    var year= $(cur_button).parent().parent().children(".listed_year_month_dv").children(".year_month").children(".year").children("#cmb_year").val();
    var month= $(cur_button).parent().parent().children(".listed_year_month_dv").children(".year_month").children(".month").children("#cmb_month").val();
    var type= $(cur_button).parent().parent().children(".listed_year_month_dv").children("#radio").children("#radio3").val();
    var cust= $(cur_button).parent().parent().children(".employee_allassistans").children("#cmb_customer").val();
    var tx=0;
    if($(cur_button).parent().parent().children(".employee_allassistans").children("#cmb_customer").attr('disabled') =="disabled")
        {
            error.html('{$translate.this_employee_have_no_customers}');
            return false;
        }
    else if(year=="")
        {
                //alert("select year");
                error.html('{$translate.select_year}');
                return false;
        }
    else if(month=="")
        {
            //alert("select month");
            error.html('{$translate.select_month}');
            return false;
        }
    else
        {
            $.ajax({
            async:false,
            url:"{$url_path}ajax_check_exist_employee_work_data_for_employees.php",
            data:"month="+month+"&year="+year+"&EID="+eID+"&type="+type+"&cust="+cust,
            type:"POST",
            success:function(data){
//                    alert(data);
                    tx=data;
                    /*if(data == 1)
                        {
                        //return true;
                        tx=data
                        }
                    else
                        {
                        error.html('{*$translate.no_data_available*}');
                        return false;
                        }*/
                    
                   
                    }
            });
            if(tx == 1)
                {
                return true;
                }
            else
                {
                error.html('{$translate.no_data_available}');
                return false;
                }
        }
    //return true;
    //return false;
}

function select_employee(name){
   window.location.href = '{$url_path}list/employee/'+name+'/';
}


</script>
{/block}



{block name="content"}
<div class="employee_details">
    <div class="tbl_hd"><span class="titles_tab">{$translate.customer_employee_monthly_work_report}</span>
        <a href="{$url_path}forms.php" class="back"><span class="btn_name">{$translate.backs}</span></a></div>
    <div class="employee_print_details">

        <div class="alpha_selct_dv">
            {assign var='alphabets' value=','|explode:$translate.alphabets}
            <ul>
                {foreach from=$alphabets item=row}
                    <li><a href="javascript:void(0)">{$row}</a></li>
                {/foreach}
            </ul>
        </div>

        <div class="employee_details_inner">
            <div class="list_contnts">
                {foreach from=$employee_details item=list}
                    <div id="employee_block" name="employee_block">                         <!--collaps this fold-->
                        <div class="list"><div class="listed_employee">
                                <span class="employee_id">{$list.social_security}</span></div>
                            <span class="employee_name">{$list.fullname}</span>
                            <div class="listed_employee_addrs">{$list.city}</div>
                        </div>

                        <div class="listed_details" style="display:none;">
                            <form name="emp_form" id="emp_form" method="post" target="_blank">
                                <input type="hidden" id="emp_id" name="emp_id" value="{$list.username}" />
                                <div class="listed_year_month_dv">
                                    <div class="year_month">
                                        <div class="year">
                                            {$translate.year}
                                            <select name=cmb_year id=cmb_year class="required">
                                                <option value="" >{$translate.select_year}</option>
                                                {html_options values=$year_option_values selected=$report_year output=$year_option_values}
                                            </select>
                                        </div>

                                        <div class="month">
                                            {$translate.month}
                                            <select name=cmb_month id=cmb_month>
                                                <option value="" >{$translate.select_month}</option>
                                                {html_options values=$month_option_values selected=$report_month output=$month_option_output}
                                            </select>
                                        </div>
                                    </div>

                                    <div id="radio" class="fk_kn">
                                        <input type="radio" id="radio3" name="type" value="1" checked="checked" /><label for="radio1">{$translate.fk}</label>
                                        <input type="radio" id="radio3" name="type" value="2" /><label for="radio3">{$translate.kn}</label>
                                        <span id="err_msg" style="color:#FF0000; padding-left: 4px; width: 20px"></span>
                                    </div>  
                                </div>

                                <div class="employee_allassistans">
                                    {$translate.customer}
                                    <select name=cmb_customer id=cmb_customer class="list_detail_assistance"> 
                                        <option value="">{$translate.all_customers}</option>
                                        <!--option value="">Assistenter</option-->
                                    </select>
                                </div>

                                <div class="employee_print_btn">
                                    <input name="button1" id="button1" type="submit" value="Skirv ut" class="skirrut" onclick="return data_existance_check(this)"/>

                                </div>
                            </form>
                            <div id="error_div" name="error_div" style="clear: both; text-align: right; padding-right:12px; margin-top: -18px; color:#BB5613 "></div>
                        </div>
                    </div>
                {/foreach}



            </div>
        </div> 
    </div>
</div> 
{/block}
