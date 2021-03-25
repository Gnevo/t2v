{block name='style'}
<style type="text/css">
    .new{
        display:none;
    }
</style>
{/block}
{block name="script"}

{literal}
    <script type="text/javascript">
    $(document).ready(function() {
           
            /////////////////////////////////////////////////////

            $("#name").val("{/literal}{$timing.name}{literal}");
            $("#effect_from_day").val("{/literal}{$day}{literal}");
            $("#effect_from_month").val("{/literal}{$month}{literal}");
	
            //////////////////////////// Validation  ////////////////////////////////////////////////////
	
            $("#timing").validate({
		
                    rules: {
                            name: {
                                    required: true
                            },
                            
                            year_from: {
                                    required: true
                            }
                    }
		
		
                    });
                        
                        
            $("#effect_from_day,#effect_from_month,#name").change(function(){               //used for table showed in bottom

                    var sel_id = $("#name").val();
                    var day = $("#effect_from_day").val();  
                    var month = $("#effect_from_month").val();
                    if(sel_id != "" && day != "" && month != "")
                    {
                            $.ajax({
                                    async:false,
                                    url:"{/literal}{$url_path}{literal}ajax_holi_incon_timing_ByID.php",
                                    data:"id="+sel_id+"&day_from="+day+"&month_from="+month,
                                    type:"POST",
                                    success:function(data){
                                            $("#holi_table").html(data);
                                    }
                                    });
                    }
                    else
                        $("#holi_table").html('');
		
                    });
                        
                        
            $("#effect_from_day,#effect_from_month,#name").change(function(){               //used for updating time to field

                    var sel_id = $("#name").val();
                    var day = $("#effect_from_day").val();  
                    var month = $("#effect_from_month").val();
                    if(sel_id != "" && day != "" && month != "")
                    {
                            $.ajax({
                                    async:false,
                                    url:"{/literal}{$url_path}{literal}ajax_holi_incon_timing_timeto.php",
                                    data:"id="+sel_id+"&day_from="+day+"&month_from="+month,
                                    type:"POST",
                                    success:function(data){
                                            $("#dateTodiv").html(data);
                                    }
                                    });
                    }
                    else
                        $("#dateTodiv").html('');

                    });


    });//JQurey endz

	
            function submit_form()
            {
                    $("#timing").submit();
            }
                
            function reset_form()
            {
                    //$("#timing").reset();
                    //document.getElementById("timing").reset();
                    var c=document.getElementById("dateTodiv").innerHTML;  
                    //var new_text = replace_in_javascript("&nbsp;", " ", c);
                    c =c.replace(/&nbsp;/g, "");
                    //c =c.replace("&nbsp;", "");
                    alert(c);
            }

	/*function show(id)
            {
                alert(id);
            }*/
           
            function validate()
            {
                    
                    var d_err = 0;
                    var d = $("#effect_from_day").val();
                    var m = $("#effect_from_month").val();


                    if(parseInt(d)>28 && parseInt(m) == 2)
                    {
                            d_err = 1;
                    }
                    if(parseInt(d) == 31 && ( parseInt(m) == 4 || parseInt(m) == 6 || parseInt(m) == 9 || parseInt(m) == 11))
                    {
                                    d_err = 1;
                    }
                    if(d_err == 1)
                    {
                            $("#err_msg").html("{/literal}{$translate.enter_correct_date}{literal}");	
                            return false
                    }
                    else
                            $("#err_msg").html("");	

                    return true;
            }
	
                    </script>
                {/literal}
                {/block}
                {block name="content"}

                <form name="timing" id="timing" method="post" onsubmit="return validate()">
                    <div class="tbl_hd"><span class="titles_tab">{$translate.inconv_timing}</span>
                        <a class="reset" href="javascript:void(0);" onclick="reset_form()"></a>
                        <a class="save" href="javascript:void(0);" onclick="submit_form()"></a>
                    </div>


                    <div class="add_contract_main">
                        <div class="incnvnt_dv">
                            <div class="incnvnt_dv_ttle">{$translate.inconv_timing_holi}</div>
                            <div class="incnvnt_dv_dtl">
                                <div class="incnvnt_dtl_dvs">
                                    <div class="incnvnt_dtl_dvs_left"> <!-- name field  ---->
                                        <div class="incnvnt_lft_nme">{$translate.holiday}</div>
                                        <div class="incnvnt_lft_nme_fld" >
                                            <select name="name" id="name" class="old" >
                                                <option value="">{$translate.select_holiday}</option>
                                                {foreach $timing_names as $nam}
                                                    {html_options  values=$nam.id output=$nam.name}
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                            
                                <div class="incnvnt_dtl_dvs"> <!-- year from field  ---->
                                    <div class="incnvnt_dtl_dvs_right">
                                        <div class="incnvnt_lft_nme">{$translate.year_effect_from}</div>
                                        <div class="incnvnt_lft_nme_fld" >
                                            <select name="year_from" id="year_from" class="old">
                                                <option value="">{$translate.select_year}</option>
                                                {html_options  values=$Year_option_values output=$Year_option_values}
                                            </select>
                                        </div>
                                    </div>
                                    <div id="err_msg" style="color:#FF0000;  float:left;"></div>
                                </div> 
                                        
                                <div class="incnvnt_dtl_dvs"> <!-- date from field  ---->
                                    <div class="incnvnt_dtl_dvs_right">
                                        <div class="incnvnt_lft_nme">{$translate.date_effect_from}</div>
                                        <div class="incnvnt_lft_nme_fld" >
                                            <select name="effect_from_day" id="effect_from_day" class="old" style="width:85px">
                                                    <option value="">{$translate.select_day}</option>
                                                    {html_options  values=$day_option_values output=$day_option_values}
                                            </select>
                                            <select name="effect_from_month" id="effect_from_month" style="width:105px">
                                                    <option value="">{$translate.select_month}</option>
                                                    {html_options  values=$month_option_values output=$month_option_output}
                                            </select>
                                        </div>
                                    </div>
                                    <div id="err_msg" style="color:#FF0000;  float:left;"></div>
                                </div>    

                                <div class="incnvnt_dtl_dvs"> <!-- date to field  ---->
                                    <div class="incnvnt_dtl_dvs_right">
                                        <div class="incnvnt_lft_nme">{$translate.date_to}</div>
                                        <div class="time_flds_fld">
                                           <!-- update this portion      date to part  -->
                                           <div id="dateTodiv" style="padding-top: 3px; font-weight: bold">
                                               <!-- output from ajax (ajax_holi_incon_timing_timeto.php) -->
                                           </div>
                                        </div>
                                    </div>
                                    <div id="err_msg" style="color:#FF0000;  float:left;"></div>
                                </div>
                                        

                                <!-- give table-->

                                <div  id="holi_table" style="padding-top: 5px">
                                    <!-- output from ajax (ajax_holi_incon_timing_ByID.php) -->
                                </div>
                               
                            </div>  
                        </div>

                    </div>

                </form>   
                {/block}
