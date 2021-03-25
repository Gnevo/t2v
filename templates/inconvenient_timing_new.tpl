{block name='style'}
<style type="text/css">
    .new{
        display:none;
    }
</style>
{/block}
{block name="script"}
<script type="text/javascript" src="{$url_path}js/jquery.ui.datepicker.js"></script>

{literal}
    <script type="text/javascript">
    $(document).ready(function() {
            //datepicker
            $( "#date_from,#effect_date" ).datepicker({
           showOn: "button",
           dateFormat: "yy-mm-dd",
           buttonImage: "{/literal}{$url_path}{literal}images/date_pic.gif",
           buttonImageOnly: true
       });
   
    {/literal}
    {if $timing.time_from neq ''}
        {literal}
            var v1 = {/literal}{$timing.time_from}{literal}
            var v2 = {/literal}{$timing.time_to}
            {else}
                {literal}
            var v1 = 00;
            var v2 = 450
                {/literal}
                {/if}
                    {literal}
	
	
            //slider
            $("#slider-range").slider({
            min: 0000,
            max: 2400,
            step: 25,
            range: true,
            values: [ v1, v2 ],
            slide: function( event, ui ) {
            $("#range").val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
            }
            });

            //checkbox
            $( "#check" ).button();
            $( "#format" ).buttonset();
            $( "#radio" ).buttonset();
	
            //$("#range").val( $("#slider-range" ).slider( "values", 0 ) +" - " + $( "#slider-range" ).slider( "values", 1 ) );
            $("#range").val( v1 +" - " + v2 );
            /////////////////////////////////////////////////////
            $("#name").val("{/literal}{$timing.name}{literal}");
            $("#date_from").val("{/literal}{$timing.effect_from}{literal}");
            //$("#range").val("{/literal}{$timing.time_from}-{$timing.time_to}{literal}");
	
            //////////////////////////// Validation  ////////////////////////////////////////////////////
	
            $("#timing").validate({
		
                    rules: {
                            name: {
                                    required: function(element){
                                            return ($("#new_name").css("display") == "none") ? true : false
                                    }
                            },
                            new_name: {
                                    required: function(element){
                                            return ($("#name").css("display") == "none") ? true : false
                                    }
                            },
                            date_from: {
                                    required: true
                            },
                            range: {
                                    required: true
                            }
                    }
		
		
                    });

    });

	
            function submit_form()
            {
                    $("#timing").submit();
            }
                
            function reset_form()
            {
                    //$("#timing").reset();
                    document.getElementById("timing").reset();
            }
            function toggme(cl) 
            {
                    var other = '';
                    $("."+cl).show();
                    if(cl == "new")
                    other = "old";
                    else
                    other = "new";
                    $("."+other).hide();
            }
	
            function check_from_date()
            {
                    var date_from = $("#date_from").val();
                    var name = $("#name").val();
                        
                    if(name != "" && date_from != "" && $("#name").is(":visible") != false)
                    {
                            var v;
                            $.ajax({
                                    async:false,
                                    url:"{/literal}{$url_path}{literal}ajax_incon_timing_from_date_check.php",
                                    data:"name="+name+"&date_from="+date_from,
                                    type:"POST",
                                    success:function(data){
                                            //alert(data)
                                            $("#err_msg").html(data);
                                            if(data != "")
                                            v = false;
                                            else
                                            v = true;	
                                    }
                                    });
                                    return v;
                    }
                    return true;
            }
            function validate()
            {
                var err = 1;
                    
                for(var i=1;i<=7;i++)
                    {//alert($("#check"+i).is(":checked"));
                        if($("#check"+i).is(":checked") != false)
                            err = 0;
                            //if($(".check:checked").length == 0)
                    }
                if(err)
                {
                        $("#check_err").html("{/literal}{$translate.select_one_day}{literal}");
                        return false;
                }
                else
                        $("#check_err").html("");

                /*if($("#range").val == '')
                {
                        $("#check_err").html("{/literal}{$translate.select_one_day}{literal}");
                        return false;
                }
                else
                        $("#check_err").html("");*/
                            
                if(!check_from_date())
                    return false;

                return true;
            }
                
	
                    </script>
                {/literal}
                {/block}
                {block name="content"}

                <form name="timing" id="timing" method="post" onsubmit="return validate()">
                    <div class="tbl_hd"><span class="titles_tab">{$translate.inconv_timing}</span>
                        <a class="reset" href="javascript:void(0);" onclick="reset_form()"><span class="btn_name">{$translate.reset}</span></a>
                        <a class="save" href="javascript:void(0);" onclick="submit_form()"><span class="btn_name">{$translate.save}</span></a>
                        <a class="back" href="{$url_path}inconvenient/timings/list/" ><span class="btn_name">{$translate.backs}</span></a>
                    </div>


                    <div class="add_contract_main">
                        <div class="incnvnt_dv">
                            <div class="incnvnt_dv_ttle">{$translate.inconv_timing_norm}</div>
                            <div class="incnvnt_dv_dtl">
                                <div class="incnvnt_dtl_dvs">
                                    <div class="incnvnt_dtl_dvs_left"> <!-- name field  ---->
                                        <div class="incnvnt_lft_nme">{$translate.name}</div>
                                        <div class="incnvnt_lft_nme_fld" >
                                            <select name="name" id="name" class="old">
                                                <option value="">Select</option>
                                                {foreach $timing_names as $nam}
                                                    {html_options  values=$nam output=$nam}
                                                {/foreach}
                                            </select>
                                            <input name="new_name" id="new_name" type="text" class="time_fld_dt_pick new"/>
                                        </div>

                                        <div class="add_img">
                                            <a href="javascript:void(0)" onclick="toggme('new')"  class="old"><img src="{$url_path}images/addd.png" width="15"  /></a>
                                            <a href="javascript:void(0)" onclick="toggme('old')" class="new"><img src="{$url_path}images/cls_btn.png" width="15"  /></a>
                                        </div>
                                        {if $flag eq 1} <script type="text/javascript" language="JavaScript"> toggme('new') </script> {/if}
                                    </div>
                                </div>
                                <div class="incnvnt_dtl_dvs"> <!-- date from field  ---->
                                    <div class="incnvnt_dtl_dvs_right">
                                        <div class="incnvnt_lft_nme">{$translate.date_effect_from}</div>
                                        <div class="time_flds_fld"><input name="date_from" id="date_from" type="text" class="time_fld_dt_pick" readonly="readonly" onchange="check_from_date()" onblur="check_from_date()" />
                                        </div>
                                    </div>
                                    <div id="err_msg" style="color:#FF0000;  float:left;"></div>
                                </div>    
                                <div class="incnvnt_dtl_dvs">
                                    <p>
                                    <div class="incnvnt_lft_nme">{$translate.time_range}:</div>
                                    <input type="text" id="range" name="range" readonly="readonly" style="border:1px solid #dcdcdc; color:#f6931f; font-weight:bold; height:18px;  width:84px; line-height:18px;  margin-right:30px; padding-left:3px;" />
                                    </p>
                                    <div id="slider-range" style="width: 352px; position:relative; top:-15px; right:128px;"></div>
                                </div> 

                                <div class="incnvnt_dtl_dvs_days">
                                    
                                        <div class="incnvnt_lft_nme_2">{$translate.days}:</div>
                                        <div id="form_allday">
                                            <div id="format">
                                                <input type="checkbox" id="check1" class="check" name="mon" value="1" {if $days.mon eq 1}checked="checked"{/if} /><label for="check1">{$translate.mon}</label>
                                                <input type="checkbox" id="check2" class="check" name="tue" value="2" {if $days.tue eq 1}checked="checked"{/if} /><label for="check2">{$translate.tue}</label>
                                                <input type="checkbox" id="check3" class="check" name="wed" value="3" {if $days.wed eq 1}checked="checked"{/if} /><label for="check3">{$translate.wed}</label>
                                                <input type="checkbox" id="check4" class="check" name="thu" value="4" {if $days.thu eq 1}checked="checked"{/if} /><label for="check4">{$translate.thu}</label>
                                                <input type="checkbox" id="check5" class="check" name="fri" value="5"  {if $days.fri eq 1}checked="checked"{/if} /><label for="check5">{$translate.fri}</label>
                                                <input type="checkbox" id="check6" class="check" name="sat" value="6"  {if $days.sat eq 1}checked="checked"{/if} /><label for="check6">{$translate.sat}</label>
                                                <input type="checkbox" id="check7" class="check" name="sun" value="7"  {if $days.sun eq 1}checked="checked"{/if} /><label for="check7">{$translate.sun}</label>
                                                &nbsp;&nbsp;&nbsp;<span id="check_err"></span>
                                            </div>
                                        </div>
  
                                </div>
                            </div>  
                        </div>

                    </div>

                </form>   
                {/block}
