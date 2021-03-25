{block name='script'}
<script type="text/javascript" src="{$url_path}js/jquery.ui.core.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="{$url_path}js/jquery.ui.widget.js"></script>
{literal}
    <script type="text/javascript">
              $(function() {
                    $( "#date_from" ).datepicker({
                        showOn: "button",
                        buttonImage: "{/literal}{$url_path}{literal}images/date_pic.gif",
                        buttonImageOnly: true
                    });
                        });
                       $(function() {
                    $( "#date_to" ).datepicker({
                        showOn: "button",
                        buttonImage: "{/literal}{$url_path}{literal}images/date_pic.gif",
                        buttonImageOnly: true
                    });
                });


     
    function check_dates()
    {
            var check_date = "";
            var date_from = $("#date_from").val();
            var date_to = $("#date_to").val();
            var user = $("#user").val();
            var hrs = $("#hours").val();
            var user_id = $("#user_id").val();
            if(hrs != "" & date_from != "" & date_to != "")
            {
                            $.ajax({
                                            async:false,
                                            url:"{/literal}{$url_path}{literal}ajax_cust_contract_check_date.php",
                                            data:"user="+user+"&date_from="+date_from+"&date_to="+date_to+"&hrs="+hrs+"&user_id="+user_id,
                                            type:"POST",
                                            success:function(data){//alert(data);
                                                    check_date = data;
                                                    if(data != "")
                                                        {
                                                    $("#err_msg").html(data);
                                                     $("#err_msg").addClass("message");
                                                         }

                                                    else
                                                        {
                                                            $("#err_msg").html("");
                                                                 $("#err_msg").removeClass("message");
                                        }                        
                                            }
                            });
                            //alert(check_date);
                            if(check_date != "")
                            return false
                            else return true;
            }
    }
        $(document).ready(function (){
   // function show_hours()
    //{
            var hrs = $("#hours").val();
            var date_from = $("#date_from").val();
            var date_to = $("#date_to").val();
    //	check_dates();
            if(hrs != "" & date_from != "" & date_to != "" & check_dates())
            {
                    $.ajax({
                            url:"{/literal}{$url_path}{literal}ajax_contract_hours.php",
                            data:"hours="+hrs+"&date_from="+date_from+"&date_to="+date_to,
                            type:"POST",
                            success:function(data){
                                    $("#contract_total_hours").html(data);
                            }
                            });
            }
    //}
        });
      function show_hours()
    {
            var hrs = $("#hours").val();
            var date_from = $("#date_from").val();
            var date_to = $("#date_to").val();
    //	check_dates();
            if(hrs != "" & date_from != "" & date_to != "" & check_dates())
            {
                    $.ajax({
                            url:"{/literal}{$url_path}{literal}ajax_contract_hours.php",
                            data:"hours="+hrs+"&date_from="+date_from+"&date_to="+date_to,
                            type:"POST",
                            success:function(data){
                                    $("#contract_total_hours").html(data);
                            }
                            });
            }
    }
    function validate()
    {
            var hrs = $("#hours").val();
            var date_from = $("#date_from").val();
            var date_to = $("#date_to").val();
            //var hour_error = $("#hours_error").val();
            //var 
            $("#err_msg").html("");
            if(hrs == "")
            {
                          $("#err_msg").html("{/literal}{$translate.please_enter_hours}{literal}");
                           $("#err_msg").addClass('error');           
                    return false;
            }
            if(date_from == "")
            {
                    $("#err_msg").html($("#date_from_error").val());
                        $("#err_msg").addClass('error');    
                    return false;
            }
            if(date_to == "")
            {
                    $("#err_msg").html($("#date_to_error").val());
                        $("#err_msg").addClass('error');    
                    return false;
            }
            if(date_from > date_to)
            {
                    $("#err_msg").html("'Date to' should be greater than '");
                        $("#err_msg").addClass('error');
                    return false;
            }
            return check_dates();
    }
        function saveForm(){
         
            $('#form').submit();
        }
    function resetForm()
        {
            /*$('#reset').val('reset')
              $('#form').submit()
                  x = document.getElementById("user_id").value;
                      alert(x);;*/
                if(document.getElementById("user_id").value == "")
                  {
                      document.getElementById("hours").value = "";
                      document.getElementById("date_from").value = "";
                      document.getElementById("date_to").value = ""; 
                      window.location.reload()
                   }
                       else
                    {
                        document.getElementById('reset').value = 'reset';
                        document.forms["form"].submit();
                        }
        }
	
    </script>
{/literal}
{/block}

{block name='style'}
<link href="{$url_path}css/jquery.ui.custom.css" rel="stylesheet" type="text/css" />
<link href="{$url_path}css/jquery.ui.base.css" rel="stylesheet" type="text/css" />
{/block}

{block name="content"}
{$message}

<div class="tbl_hd"><span class="titles_tab">{$translate.add_contr} - {$user_display_name}</span>
    <a onclick="saveForm()" href="javascript:void(0)"><img width="77" height="25" src="{$url_path}images/btn_save.gif"></a>
    <a onclick="resetForm()" href="javascript:void(0)"><img width="77" height="25" src="{$url_path}images/btn_reset.gif"></a>
</div>

<div class="add_contract_main">
    <div id="err_msg" ></div>
    <div class="contract_left_area">
        <div class="contract_details_title">{$translate.contr_detail}</div>
        <div class="contract_details_forms" onkeyup="show_hours()">
            <form id="form" name="form" method="post" action="{$url_path}contract/customer/add/{$string}/{if $data.hour != ""}{$data.id}/{/if}" onsubmit="return validate();">
                <input name="action" id="action" type="hidden" value="{if $data.hour != ""}edit{else}add{/if}" />
                <input type="hidden" name="reset" id="reset" value="" />
                <div class="time_flds">
                    <div class="time_flds_name">{$translate.hours}</div>
                    <div class="time_flds_fld">
                        <input class="time_fld_cls" id="hours" name="hours" type="text" onchange="show_hours()" value="{if $data.hour != ""}{$data.hour}{/if}" />
                        <input id="user" name="user" type="hidden" value="{$username}" />
                        <input id="user_id" name="user_id" type="hidden" value="{$user_id}" />
                        <input id="hours_error" name="hours_error" type="hidden" value="{$translate.please_enter_hours}" />
                    </div>
                </div>
                <div class="time_flds">
                    <div class="time_flds_name">{$translate.date_from}</div>
                    <div class="time_flds_fld">
                        <input class="cntrct_dtls_dtpic"  id="date_from" name="date_from" type="text" onchange="show_hours()" value="{if $data.date_from != ""}{$data.date_from}{/if}" />
                        <input id="date_from_error" name="date_from_error" type="hidden" value="{$translate.please_enter_date_from}" />
                        
                    </div>
                </div>
                <div class="time_flds">
                    <div class="time_flds_name">{$translate.date_to}</div>
                    <div class="time_flds_fld">
                        <input class="cntrct_dtls_dtpic"  id="date_to" name="date_to" type="text" onchange="show_hours()" value="{if $data.date_to != ""}{$data.date_to}{/if}" />
                        <input id="date_from_error" name="date_from_error" type="hidden" value="{$translate.please_enter_date_to}" />
                       
                    </div>
                </div>
            </form>
    </div>
</div>
<div class="contract_right_area">
    <div class="contract_total_time">{$translate.Total_time_calculation_for_contract}</div>
    <div class="contract_total_hours" id="contract_total_hours">
           <div class="time_period_block">
               <h1>{$translate.monthly}</h1>
               <h2>{$translate.zero}</h2>
           </div>
           <div class="time_period_block">
               <h1>{$translate.weekly}</h1>
               <h2>{$translate.zero}</h2>
           </div>
           <div class="time_period_block">
               <h1>{$translate.daily}</h1>
               <h2>{$translate.zero}</h2>
           </div>
           <div class="time_period_block">
               <h1>{$translate.tot_hrs}</h1>
               <h2>{$translate.zero}</h2>
           </div>
    </div>
</div>
<div style="clear:both"></div>
</div>
{/block}
