{block name='style'}
<style type="text/css">
    .new{
        display:none;
    }
    .remove_padding{
        padding-left: 0px;
    }
    .incnvnt_dtl_dvs_right{
        padding-top: 2px;
    }
    ul#menu_down, ul#menu_down ul.sub-menu {
        padding:0;
        margin: 0;
    }
    ul#menu_down li, ul#menu_down ul.sub-menu li {
        list-style-type: none;
        display: inline-block;
        background:none;
        border:none;
        border-radius:0px;
        padding:0px;
        margin:0px;
    }
    /*Link Appearance*/
    ul#menu_down li a, ul#menu_down li ul.sub-menu li a {
        text-decoration: none;
        color: #fff;
        background: #8fc6d3;
        padding: 7px 4px;
        display:inline-block;
    }
    /*Make the parent of sub-menu relative*/
    ul#menu_down li {
        position: relative;
    }
    /*sub menu*/
    ul#menu_down li ul.sub-menu {
        display:none;
        position: absolute;
        top: 30px;
        left: 0;
        width: 100px;
    }
    ul#menu_down li:hover ul.sub-menu {
        display:block;
    }
</style>
{/block}
{block name="script"}
<script type="text/javascript" src="{$url_path}js/jquery.ui.datepicker.js"></script>
<script type="text/javascript">
    var change_var = 0;
$(document).ready(function() {
    $( "#date_from,#effect_date, #date_to" ).datepicker({
        showOn: "button",
        dateFormat: "yy-mm-dd",
        buttonImage: "{$url_path}images/date_pic.gif",
        buttonImageOnly: true
    });
    $( "#intype" ).buttonset();
    $( "#ltype" ).buttonset();

    //DAYS
    $( "#format" ).buttonset();
    //////////////////////////// Validation  ////////////////////////////////////////////////////
    /*$("#timing").validate({
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
        });*/
    {*if $flag eq 1}toggme('new');{/if*}

});

function submit_form(){

    var action = '{$action}';
    if(action == 'edit'){

    var count_check = parseInt('{$change_check_count}');
        var time_from = $("#time_from").val();
        var time_to = $("#time_to").val();
        var time_from_old = '{$timing.time_from}';
        var time_to_old = '{$timing.time_to}';
        var date_from = new Date($("#date_from").val());
        var date_from_old = new Date('{$timing.effect_from}');
        {if $timing.effect_to != ""}
            
            var date_to = new Date($("#date_to").val());
            var date_to_old = new Date('{$timing.effect_to}');
            if(count_check != 0){
                if((parseFloat(time_from) > parseFloat(time_from_old)) || (parseFloat(time_to) < parseFloat(time_to_old))|| (date_from > date_from_old) || (date_to < date_to_old)){
                    var r=confirm("{$translate.it_affect_previous_added_timetable}");
                    if (r==true)
                      {

                           $("#timing").submit();
                      }
                }
            }else{
                $("#timing").submit();
            }
        {else}
            
            if(count_check != 0){

                if((parseFloat(time_from) > parseFloat(time_from_old)) || (parseFloat(time_to) < parseFloat(time_to_old))|| (date_from > date_from_old) && count_check != 0){
                var r=confirm("{$translate.it_affect_previous_added_timetable}");

                    if (r==true)
                      {
                           $("#timing").submit();
                      }
                }
                else{
                     $("#timing").submit();
                }
            }else{
                $("#timing").submit();
            }
        {/if}

    }else{
        $("#timing").submit();
    }
}

function reset_form(){
        document.getElementById("timing").reset();
}

function toggme(cl){
        var other = '';
        $("."+cl).show();
        if(cl == "new")
            other = "old";
        else
            other = "new";
        $("."+other).hide();
}



function check_from_date(){
        {*var date_from = $("#date_from").val();
        var name = $("#name").val();

        if(name != "" && date_from != "" && $("#name").is(":visible") != false){
                var v;
                $.ajax({
                        async:false,
                        url:"{$url_path}ajax_incon_timing_from_date_check.php",
                        data:"name="+name+"&date_from="+date_from,
                        type:"POST",
                        success:function(data){
                                $("#err_msg").html(data);
                                if(data != "")
                                    v = false;
                                else
                                    v = true;	
                        }
                });
                return v;
        }*}
        return true;
}

function validate(){
            var err = 1;
            for(var i=1;i<=7;i++){
                    if($("#check"+i).is(":checked") != false)
                        err = 0;
            }
            if(err){
                    $("#check_err").html("{$translate.select_one_day}");
                    return false;
            }
            else
                    $("#check_err").html("");

            if(!check_from_date())
                return false;

            return true;
    }
    
    function loadRegister(){
    var new_var = $("#new").val();
    if(change_var == "1"){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        $( this ).dialog( "close" );
                        saveForm();
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            document.location.href = "{$url_path}customer/add/{$customer_detail.username}/";
                    }
                }
        });
    }
    else{
        document.location.href = "{$url_path}customer/add/{$customer_detail.username}/";
    }
    
}
function loadInsurancefk(){
    var new_var = $("#new").val();
    if(change_var == "1"){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        $( this ).dialog( "close" );
                        saveForm();
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            document.location.href = "{$url_path}customer/insurance/fk/{$customer_detail.username}/";
                    }
                }
        });
    }
    else{
        document.location.href = "{$url_path}customer/insurance/fk/{$customer_detail.username}/";
    }
    
}
function loadInsurancekn(){
    var new_var = $("#new").val();
    if(change_var == "1"){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        $( this ).dialog( "close" );
                        saveForm();
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            document.location.href = "{$url_path}customer/insurance/kn/{$customer_detail.username}/";
                    }
                }
        });
    }
    else{
        document.location.href = "{$url_path}customer/insurance/kn/{$customer_detail.username}/";
    }
    
}
function loadImplan(){
    var new_var = $("#new").val();
    if(change_var == "1"){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        $( this ).dialog( "close" );
                        saveForm();
                       
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            document.location.href = "{$url_path}customer/implan/{$customer_detail.username}/";
                    }
                }
        });
    }
    else{
        document.location.href = "{$url_path}customer/implan/{$customer_detail.username}/";
    }
    
    
}

function loadWork(){
    var new_var = $("#new").val();
    if(change_var == "1"){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        $( this ).dialog( "close" );
                        saveForm();
                        
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            document.location.href = "{$url_path}customer/deswork/{$customer_detail.username}/";
                    }
                }
        });
    }
    else{
        document.location.href = "{$url_path}customer/deswork/{$customer_detail.username}/";
    }
    
}

function loadDocument(){
    var new_var = $("#new").val();
    if(change_var == "1"){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        $( this ).dialog( "close" );
                        saveForm();
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            document.location.href = "{$url_path}customer/documentation/{$customer_detail.username}/";
                    }
                }
        });
    }
    else{
        document.location.href = "{$url_path}customer/documentation/{$customer_detail.username}/";
    }
    
}

function loadEqipment(){
    var new_var = $("#new").val();
    if(change_var == "1"){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        $( this ).dialog( "close" );
                        saveForm();
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            document.location.href = "{$url_path}customer/equipment/{$customer_detail.username}/";
                    }
                }
        });
    }
    else{
        document.location.href = "{$url_path}customer/equipment/{$customer_detail.username}/";
    }
}

function loadPrivilege(){
    var new_var = $("#new").val();
    if(change_var == "1"){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        $( this ).dialog( "close" );
                        saveForm();
                        
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            document.location.href = "{$url_path}customer/privilege/{$customer_detail.username}/";
                    }
                }
        });
    }
    else{
        document.location.href = "{$url_path}customer/privilege/{$customer_detail.username}/";
    }
}

function loadInsurancete(){
    if(change_var == 1){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        $( this ).dialog( "close" );
                        saveForm();
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            document.location.href = "{$url_path}customer/insurance/te/{$customer_detail.username}/";
                    }
                }
        });
    }
    else{
        document.location.href = "{$url_path}customer/insurance/te/{$customer_detail.username}/";
    }
    
}

function loadInconveninetTime(){
    if(change_var == 1){
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "{$translate.yes}": function() {
                        $( this ).dialog( "close" );
                        saveForm();
                    },
                    "{$translate.no}": function() {
                            $( this ).dialog( "close" );
                            document.location.href = "{$url_path}customer/inconvenient/timings/list/{$customer_detail.username}/";
                    }
                }
        });
    }
    else{
        document.location.href = "{$url_path}customer/inconvenient/timings/list/{$customer_detail.username}/";
    }
    
}

function makeChange(){
    change_var = 1;
}
</script>
{/block}
{block name="content"}
{$message}
{if !empty($customer_detail)}
    <div id="kunder_info_strip"  class="clearfix">
        <div class="info_name"><b>{$translate.social_security} : </b>{$customer_detail.social_security}</div>
        <div class="info_name"><b>{$translate.customer_code} : </b>{$customer_detail.code}</div>
        {if $sort_by_name == 1}
                <div class="info_name_last"><b>{$translate.name} : </b>{$customer_detail.first_name|cat: ' '|cat: $customer_detail.last_name}</div>
            {elseif $sort_by_name == 2}
                <div class="info_name_last"><b>{$translate.name} : </b>{$customer_detail.last_name|cat: ' '|cat: $customer_detail.first_name}</div>
    {/if}
    </div>
{/if}
<div id="menu" style="font-size: 11px">
    <div>
        <ul id="menu_down">
            <li><a href="javascript:void(0)" onclick="loadRegister()" style="background-color:#8fc6d3;padding: 7px 3px;margin-right: 3px"><</a>
                <ul class="sub-menu">
                    <li><a href="javascript:void(0)" onclick="loadRegister()">{$translate.register}</a></li>
                </ul>
            </li>   
        </ul>
    </div>
    <ul>
      <!--  <li class="active"><a href="{$url_path}customer/add/{$customer_detail.username}/">{$translate.register}</a></li>
        <li><a href="{$url_path}customer/insurance/fk/{$customer_detail.username}/">{$translate.insurance}</a></li>
        <li><a href="{$url_path}customer/insurance/kn/{$customer_detail.username}/">{$translate.municipality}</a></li>
        <li><a href="{$url_path}customer/implan/{$customer_detail.username}/">{$translate.implementation_plan}</a></li>  
        <li><a href="{$url_path}customer/deswork/{$customer_detail.username}/">{$translate.description_of_work}</a></li>
        <li><a href="{$url_path}customer/documentation/{$customer_detail.username}/">{$translate.documentation}</a></li>
        <!-- <li><a href="javascript:void(0)">{$translate.quality}</a></li>
        <li><a href="{$url_path}customer/equipment/{$customer_detail.username}/">{$translate.equipment}</a></li>-->
<!--        <li><a href="javascript:void(0)" onclick="loadRegister()">{$translate.register}</a></li>-->
        <li><a href="javascript:void(0)" onclick="loadInsurancefk()">{$translate.insurance}</a></li>
        <li><a href="javascript:void(0)" onclick="loadInsurancekn()">{$translate.municipality}</a></li>    
        <li><a href="javascript:void(0)" onclick="loadInsurancete()">{$translate.insurance_te}</a></li> 
        <li><a href="javascript:void(0)" onclick="loadImplan()">{$translate.implementation_plan}</a></li>  
        <li><a href="javascript:void(0)" onclick="loadWork()">{$translate.description_of_work}</a></li>
        <li><a href="javascript:void(0)" onclick="loadDocument()">{$translate.documentation}</a></li>
       <!-- <li><a href="javascript:void(0)">{$translate.quality}</a></li> -->
        <li><a href="javascript:void(0)" onclick="loadEqipment()">{$translate.equipment}</a></li>
        <li><a href="javascript:void(0)" onclick="loadPrivilege()">{$translate.privilege}</a></li>
<!--        <li><a href="{$url_path}customer/appoiments/{$customer_detail.username}/">{$translate.appoiments}</a></li>-->
        <li><a href="{$url_path}customer/appoiments/{$customer_detail.username}/">{$translate.appoiments}</a></li>
        <li class="active"><a href="javascript:void(0)" onclick="loadInconveninetTime()">{$translate.customer_oncall_settings}</a></li>
    </ul>
<!--    <div>
        <ul id="menu_down">
            <li><a href="#">></a>
                <ul class="sub-menu">
                    <li><a href="javascript:void(0)" onclick="loadInconveninetTime()">{$translate.inconvenient_timing}</a></li>
                </ul>
            </li>   
        </ul>
    </div>-->
</div>
<div id="main_tab">
    <div id="tab_content">
      
        <form name="timing" id="timing" method="post" onsubmit="return validate()">
            <div class="tbl_hd"><span class="titles_tab">{$translate.inconv_timing}</span>
                <a class="save" href="javascript:void(0);" onclick="submit_form()"><span class="btn_name">{$translate.save}</span></a>
                <a class="reset" href="javascript:void(0);" onclick="reset_form()"><span class="btn_name">{$translate.reset}</span></a>
                <a class="back" href="{$url_path}customer/inconvenient/timings/list/{$customer_username}/" ><span class="btn_name">{$translate.backs}</span></a>
            </div>
            <div class="add_contract_main">
                <div class="incnvnt_dv">
                    <div class="incnvnt_dv_ttle">{$translate.inconv_timing_norm}</div>
                    <input type="hidden" name="type_sal" id="type_sal" value="{$timing.type}" />
                    <div class="incnvnt_dv_dtl">
                        <div class="incnvnt_dtl_dvs">
                            <div class="incnvnt_dtl_dvs_left"> {*name field*}
                                <div class="incnvnt_lft_nme">{$translate.name}</div>
                                <div class="incnvnt_lft_nme_fld" >
                                    <select name="name" id="name" class="old" {if $action eq 'clone'}disabled="disabled"{/if} onchange="markChange()">
                                        <option value="">{$translate.select}</option>
                                        {foreach $timing_names as $nam}
                                            {html_options  values=$nam.name output=$nam.name selected=$timing.name}
                                        {/foreach}
                                    </select>
                                    {if $action neq 'clone'}<input name="new_name" id="new_name" type="text" class="time_fld_dt_pick new" value="{if $action eq 'new'}{$timing.name}{/if}"/>{/if}
                                </div>
                                {*if $action neq 'clone'}
                                <div class="add_img">
                                    <a href="javascript:void(0)" onclick="toggme('new')"  class="old"><img src="{$url_path}images/addd.png" width="15" /></a>
                                    <a href="javascript:void(0)" onclick="toggme('old')" class="new"><img src="{$url_path}images/cls_btn.png" width="15" /></a>
                                </div>
                                {/if*}
                            </div>
                        </div>
                        <div class="incnvnt_dtl_dvs"> {*date from field*}
                            <div class="incnvnt_dtl_dvs_right">
                                <div class="incnvnt_lft_nme">{$translate.date_effect_from}</div>
                                <div class="time_flds_fld"><input name="date_from" id="date_from" type="text" class="time_fld_dt_pick" readonly="readonly" onchange="check_from_date()" onblur="check_from_date()" value="{$timing.effect_from}"/>
                                </div>
                            </div>
                            <div id="err_msg" style="color:#FF0000;  float:left;"></div>
                        </div>
                        {if $timing.effect_to neq ''}
                        <div class="incnvnt_dtl_dvs"> {*date to field*}
                            <div class="incnvnt_dtl_dvs_right">
                                <div class="incnvnt_lft_nme">{$translate.date_effect_to}</div>
                                <div class="time_flds_fld"><input name="date_to" id="date_to" type="text" class="time_fld_dt_pick" readonly="readonly" onchange="check_from_date()" onblur="check_from_date()" value="{$timing.effect_to}"/>
                                </div>
                            </div>
                        </div>
                        {/if}
                        <div class="incnvnt_dtl_dvs_days">
                            <div class="incnvnt_lft_nme_2">{$translate.type}</div>
                            <div class="time_flds_fld">
                                <div id="ltype" class="remove_padding">
                                    <input type="radio" id="ltype1" name="ltype" {if $timing.nature neq 1}checked="checked"{/if} value="0" onchange="markChange()"/><label for="ltype1">{$translate.discrete}</label>
                                    <input type="radio" id="ltype2" name="ltype" {if $timing.nature eq 1}checked="checked"{/if} value="1" onchange="markChange()" /><label for="ltype2">{$translate.continus}</label>
                                </div>
                            </div>
                        </div>
                        <div class="incnvnt_dtl_dvs">
                            <div class="incnvnt_lft_nme_2">{$translate.time_range}</div>
                            <span>{$translate.from}</span><input type="text" name="time_from" id="time_from" style="width: 100px;" value="{$timing.time_from}" onchange="markChange()"/>
                            <span>{$translate.to}</span><input type="text" name="time_to" id="time_to" style="width: 100px;" value="{$timing.time_to}" onchange="markChange()"/>
                        </div>
                        <div class="incnvnt_dtl_dvs_days">
                            <div class="incnvnt_lft_nme_2">{$translate.days}</div>
                            <div id="form_allday">
                                <div id="format" class="remove_padding">
                                    <input type="checkbox" id="check1" class="check" name="mon" value="1" {if $days.mon eq 1}checked="checked"{/if} onchange="markChange()"/><label for="check1">{$translate.mon}</label>
                                    <input type="checkbox" id="check2" class="check" name="tue" value="2" {if $days.tue eq 1}checked="checked"{/if} onchange="markChange()"/><label for="check2">{$translate.tue}</label>
                                    <input type="checkbox" id="check3" class="check" name="wed" value="3" {if $days.wed eq 1}checked="checked"{/if} onchange="markChange()"/><label for="check3">{$translate.wed}</label>
                                    <input type="checkbox" id="check4" class="check" name="thu" value="4" {if $days.thu eq 1}checked="checked"{/if} onchange="markChange()"/><label for="check4">{$translate.thu}</label>
                                    <input type="checkbox" id="check5" class="check" name="fri" value="5"  {if $days.fri eq 1}checked="checked"{/if} onchange="markChange()"/><label for="check5">{$translate.fri}</label>
                                    <input type="checkbox" id="check6" class="check" name="sat" value="6"  {if $days.sat eq 1}checked="checked"{/if} onchange="markChange()"/><label for="check6">{$translate.sat}</label>
                                    <input type="checkbox" id="check7" class="check" name="sun" value="7"  {if $days.sun eq 1}checked="checked"{/if} onchange="markChange()"/><label for="check7">{$translate.sun}</label>
                                    &nbsp;&nbsp;&nbsp;<span id="check_err"></span>
                                </div>
                            </div>
                        </div>
                          
                        <div class="incnvnt_dtl_dvs"> {*salary field*}
                            <div class="incnvnt_dtl_dvs_right">
                                <div class="incnvnt_lft_nme">{$translate.oncall_salary}</div>
                                <div class="time_flds_fld">
                                    <input name="salary" id="salary" type="text" class="time_fld_dt_pick" value="{$timing.amount}" onchange="markChange()"/>
                                </div>
                            </div>
                        </div>
                        <div class="incnvnt_dtl_dvs"> {*salary field call training*}
                            <div class="incnvnt_dtl_dvs_right">
                                <div class="incnvnt_lft_nme">{$translate.call_training_salary}</div>
                                <div class="time_flds_fld">
                                    <input name="salary_call_training" id="salary_call_training" type="text" class="time_fld_dt_pick" value="{$timing.sal_call_training}" />
                                </div>
                            </div>
                        </div>
                        <div class="incnvnt_dtl_dvs"> {*salary field complimentary oncall*}
                            <div class="incnvnt_dtl_dvs_right">
                                <div class="incnvnt_lft_nme">{$translate.complimentary_oncall_salary}</div>
                                <div class="time_flds_fld">
                                    <input name="salary_complimentary_oncall" id="salary_complimentary_oncall" type="text" class="time_fld_dt_pick" value="{$timing.sal_complementary_oncall}" />
                                </div>
                            </div>
                        </div>
                        <div class="incnvnt_dtl_dvs"> {*salary field more oncall*}
                            <div class="incnvnt_dtl_dvs_right">
                                <div class="incnvnt_lft_nme">{$translate.more_oncall_salary}</div>
                                <div class="time_flds_fld">
                                    <input name="salary_more_oncall" id="salary_more_oncall" type="text" class="time_fld_dt_pick" value="{$timing.sal_more_oncall}" />
                                </div>
                            </div>
                        </div> 
                    </div>  
                </div>
            </div>
        </form> 
    </div>
</div>
{/block}