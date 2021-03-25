
{block name='script'}
<script type="text/javascript">
function scroller()
    {
        $('.scroll_content').jScrollPane();
        $('.scroll-pane-arrows').jScrollPane(
                {
                        showArrows: true,
                        horizontalGutter: 10
    }
        );
		
	
}
</script>
<script type="text/javascript">

$(document).ready(function(){
            
            scroller();
            $("#overlap_error").hide();
		// --- fixed alloc --- //
	
		var top = $('#assigned_slots').offset().top - parseFloat($('#assigned_slots').css('marginTop').replace(/auto/, 0));
		var parent_top = $("#options").offset().top;
		//alert(parent_top);
		$(window).scroll(function (event) {
			// what the y position of the scroll is
			var y = $(this).scrollTop();
			// whether thats moved down]
			//alert(y);
			if (( y + $("#assigned_slots").height()) < $("#options").height()){
				$("#assigned_slots").css("position","absolute");
				$("#assigned_slots").css("top", y+ 5);
                        } else {
				//$("#assigned_slots").css("position","fixed");
				//$("#assigned_slots").css("top", parent_top+ top);
				$("#assigned_slots").addClass('assigned_slots_fixed');	
				//$("#assigned_slots").css("top",top);	
                        }
		});
		
		
                
        
        /*$('.custom_time_slots,.custom_time_slots_incomplet').bind("contextmenu click",function(e){
   
   return false;

    });*/



});


        // --- edit slot --- //
		
function edit_slot(){
        $('.custom_time_slots .time a.btn_edit').click(function(){
                $(this).parent().parent().children('.cust_slot_frm').show();
                $(this).parent().hide();
        })
        $('.custom_time_slots .time a.btn_save').click(function(){
                $(this).parent().hide();
                $(this).parent().parent().children('.duration').show();
        })
}
		
edit_slot();
	
        // --- end edit slot --- //
	
	
        // --- time slot remove --- //
	
        
	
        // --- end time slot remove --- //
	
function add_timeslot(){
                
    $('.custom_time_slots_org').clone().appendTo('.scroll_content');
    scroller()
    $("#assigned_slots .custom_time_slots_org").attr("class","custom_time_slots clearfix");
               	
}
	
$(".memory_time").draggable({ revert: true });
                
$("#add_new_slot").droppable({

        hoverClass: "dropover",
        drop: function( event, ui ) {
            var fkkn = $("input[name='fkkn']:checked").val();
            
            var slot = new String(ui.draggable.html());
                
            
            var a = slot.split("value=");
            var b=a[1].split('"');
            
            var c = b[1].split("-");
           // alert(slot);
           // alert(parseFloat(a[1].replace(' ','')));
            var url = $('#url_value').val()+"&time_from="+parseFloat(c[0].replace(' ',''))+"&time_to="+parseFloat(c[1].replace(' ',''))+"&fkkn="+fkkn+"&action=drop";
            var url_slot = $('#url_value_slot').val()+"&time_from="+parseFloat(c[0].replace(' ',''))+"&time_to="+parseFloat(c[1].replace(' ',''))+"&fkkn="+fkkn+"&action=drop";
            var url_slot_remain = $('#url_value_slot_remain').val()+"&&time_from="+parseFloat(c[0].replace(' ',''))+"&time_to="+parseFloat(c[1].replace(' ',''))+"&fkkn="+fkkn+"&action=drop";
            //$('#alloc_action').load(url);

//          $("#loading_image" ).html('<img src="{$url_path}images/ajax-loader.gif" />');
            wrapLoader("#assigned_inner");
            wrapLoader("#memory_inner");
            $.ajax({
                url:"{$url_path}ajax_gdschema_alloc_slots.php",
                type:"GET",
                data:url_slot,
                success:function(data){
                    $("#assigned_inner").html(data);
                    uwrapLoader("#assigned_inner");
                    $('#memory_inner').load(url_slot_remain,function(response, status, xhr){ uwrapLoader("#memory_inner"); });

                }
            });
          /*   $('#assigned_inner').load(url_slot);
            $('#memory_inner').load(url_slot_remain);
           jQuery().ajaxStart(function(){
                alert("it begins");
            })*/



            $(this).removeClass("dropover");
           // add_timeslot();
            type_selector_init();
            edit_slot();
        }
}); 
		
function type_selector_init(){
	
        $(".type_selector ul").mouseenter(function(){
				
            $(this).children().css("display","block");
                    $(this).animate({
                            width: "270px"
                    },200);
        });

        $(".type_selector ul").mouseleave(function(){

                lenth = $(this).children().length;
                for(i=0;i < lenth;i++){
                        if($(this).children().eq(i).attr("class") == "selected"){
                                $(this).children().eq(i).css("display","block");

                        }else{
                                $(this).children().eq(i).css("display","none");
                        }
                }

                $(this).animate({
                        width: "30px"
                },200);
        });
			
                                
}

type_selector_init();


function loadContent(url){
    wrapLoader("#timetable_assign");
    $('#timetable_assign').load(url,function(response, status, xhr){ uwrapLoader("#timetable_assign"); });
//    $.ajax({
//        async:false,
//        url: url,
//        success:function(data){
//                $("#timetable_assign").html(data);
//                }
//    });
    }

function skillRemove(url){
    //alert(url);
    wrapLoader("#alloc_action");
    $('#alloc_action').load(url,function(response, status, xhr){ uwrapLoader("#alloc_action"); });
}
function custRemove(url){
    if(confirm('{$translate.confirm_delete}')){
        wrapLoader("#alloc_action");
        $('#alloc_action').load(url,function(response, status, xhr){ uwrapLoader("#alloc_action"); });
    }    
}
function empRemove(url){
    if(confirm('{$translate.confirm_delete}')){
        wrapLoader("#alloc_action");
        $('#alloc_action').load(url,function(response, status, xhr){ uwrapLoader("#alloc_action"); });
    }
}
function slotRemove(url){
    //alert(url);
    if(confirm('{$translate.confirm_delete}')){
        wrapLoader("#alloc_action");
        $('#alloc_action').load(url,function(response, status, xhr){ uwrapLoader("#alloc_action"); });
    }
}

function loadAjax(url){
    wrapLoader("#alloc_action");
    $('#alloc_action').load(url,function(response, status, xhr){ uwrapLoader("#alloc_action"); });
}
function loadType(url){
    if($('#from').val()!='' && $('#to').val()!=''){
         url = url + '&time_from='+$('#from').val()+'&time_to='+$('#to').val();
         wrapLoader("#alloc_action");
        $('#alloc_action').load(url,function(response, status, xhr){ uwrapLoader("#alloc_action"); });
        $('#allocate_cusempwork').dialog('close');
    }
    else{
        alert('Please Enter Time');
    }
}
function loadAdd(url){
    //alert(url);
    wrapLoader("#alloc_action");
    $('#alloc_action').load(url,function(response, status, xhr){ uwrapLoader("#alloc_action"); });
    $('#allocate_cusempwork').dialog('close');

    }
function processEntry(){
$('#add_new_slot').hide();
$('#slot_entry').show();
    }
function processDrag(){
    $('#slot_entry').hide();
    $('#add_new_slot').show();
    
    }
function manEntry(url){

if($('#slot_from').val()!='' && $('#slot_to').val()!=''){
    url = url + '&time_from='+$('#slot_from').val()+'&time_to='+$('#slot_to').val();
    wrapLoader("#alloc_action");
    $('#alloc_action').load(url,function(response, status, xhr){ uwrapLoader("#alloc_action"); });
    }else{
alert('Please Enter Time');

    }
    }
function messagePrivilege(){
    alert('{$translate.permission_denied}');
} 

function multipleSlotAdd(){
    var count = $("#multiple_slots_count").val();
//    alert(count);
    if(count > 0){
        $("#multiple_slots_count").val('0');
        var multiple_time = $("#multiple_slots").val();
        $("#multiple_slots").val('');
        var fkkn = $("input[name='fkkn']:checked").val();  
        var url = $('#url_value').val()+"&multiple="+multiple_time+"&fkkn="+fkkn+"&action=drop";
        var url_slot = $('#url_value_slot').val()+"&multiple="+multiple_time+"&fkkn="+fkkn+"&action=drop";
        var url_slot_remain = $('#url_value_slot_remain').val()+"&multiple="+multiple_time+"&fkkn="+fkkn+"&action=drop";
        $.ajax({
            url:"{$url_path}ajax_gdschema_slots_overlap_check.php",
            type:"GET",
            data:url_slot,
            success:function(data){
                $("#overlap_check").val($.trim(data));
                if($.trim(data) != "0"){
                    $("#overlap_error").addClass("message");
                    $("#overlap_error").show();
                    $("#overlap_error").html("{$translate.overlapped} "+$.trim(data));
                }else{
                    $("#overlap_error").hide();
                    $("#multiple_slots_count").val("0");
                                                                 //$("#loading_image" ).html('<img src="{$url_path}images/ajax-loader.gif" />');
                    wrapLoader("#assigned_inner");
                    wrapLoader("#memory_inner");
                    $.ajax({
                        url:"{$url_path}ajax_gdschema_alloc_slots.php",
                        type:"GET",
                        data:url_slot,
                        success:function(data){
                            $("#assigned_inner").html(data);
                            uwrapLoader("#assigned_inner");
                            $('#memory_inner').load(url_slot_remain,function(response, status, xhr){ uwrapLoader("#memory_inner"); });

                        }
                    });
                };
            }
        });
        
    }else{
        alert("{$translate.no_elements_selected}");
    }
}
function multipleSlotTempAdd(slot_id){
    
    var count = parseInt($("#multiple_slots_count").val());
    if($("#slot_"+slot_id).attr("checked")){
    
        count = count+1;
       /* var a = $("#slot_"+slot_id).parent().html().split("-");
        var b = a[0].split(">");
        a[1] = parseFloat(a[1].replace(' ',''))
        var time_slot = b[2]+"-"+a[1];*/
        var time_slot = $("#slot_"+slot_id).val();
        if($("#multiple_slots").val() == ""){
            $("#multiple_slots").val(time_slot);
        }else{
            var old_time_slot = $("#multiple_slots").val();
            old_time_slot = old_time_slot+","+time_slot;
            $("#multiple_slots").val(old_time_slot);
        }
        $("#multiple_slots_count").val(count);

    }else{
        count = count-1;
       /* var a = $("#slot_"+slot_id).parent().html().split("-");
        var b = a[0].split(">");
        a[1] = parseFloat(a[1].replace(' ',''))
        var time_slot = b[2]+"-"+a[1];*/
        var time_slot = $("#slot_"+slot_id).val();
        var old_slots = $("#multiple_slots").val();
        var old_slots_temp = old_slots.split(",");
        var time_slot_temp = "";
        if(old_slots_temp.length == 1){
            $("#multiple_slots").val("");
        }else{
            for(var i=0;i<old_slots_temp.length;i++){
                if(old_slots_temp[i] != time_slot){
                   if(time_slot_temp == ""){
                        time_slot_temp = old_slots_temp[i];
                   }else{
                        time_slot_temp = time_slot_temp+","+old_slots_temp[i];
                   }
                } 
            }
            $("#multiple_slots").val(time_slot_temp)
        }
        $("#multiple_slots_count").val(count);
    }

}
</script>

{/block}

{block name='content'}
{$message}
{assign var = 'url_val' value='' scope='global'}
{assign var = 'url_val_popup' value='' scope='global'}
{assign var = 'url_val_slot' value='' scope='global'}
{if $employee.name != '' && $customer.name !=''}
    {$url_val = $url_path|cat:'ajax_alloc_action.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_slot = 'date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_value_slot_remain = $url_path|cat:'ajax_gdschema_alloc_remainig_slots.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_popup.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_reload = $url_path|cat:'gdschema_alloc.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_self = $url_path|cat:'gdschema_alloc.php?employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{elseif $employee.name != '' && $customer.name ==''}
    {$url_val = $url_path|cat:'ajax_alloc_action.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_slot = 'date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_value_slot_remain = $url_path|cat:'ajax_gdschema_alloc_remainig_slots.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_popup.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_reload = $url_path|cat:'gdschema_alloc.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_self = $url_path|cat:'gdschema_alloc.php?&employee='|cat:$employee.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{elseif $employee.name == '' && $customer.name !=''}
    {$url_val = $url_path|cat:'ajax_alloc_action.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_slot = 'date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_value_slot_remain = $url_path|cat:'ajax_gdschema_alloc_remainig_slots.php?date='|cat:$cur_date|cat:'&employee='|cat:$employee.userid|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_popup = $url_path|cat:'gdschema_alloc_popup.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_reload = $url_path|cat:'gdschema_alloc.php?date='|cat:$cur_date|cat:'&customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
    {$url_val_self = $url_path|cat:'gdschema_alloc.php?customer='|cat:$customer.userid|cat:'&emp_alloc='|cat:$emp_alloc}
{/if}

{if $flag_sign == 0}
<div class="custom_time_slots_org">
    <div class="left_col">
        
        <div class="time"> <span class="duration">0900 - 1400 <a href="#" class="btn_edit"></a></span>
            <form id="slot_drop" name="slot_drop" method="post" action="" class="cust_slot_frm clearfix">
                <input type="text" name="time_cust2" id="time_cust2"  class="custom_slot" />
                <input type="hidden" name="url_value" id="url_value"  value="{$url_val}" />
                <input type="hidden" name="multiple_slots" id="multiple_slots" />
                <input type="hidden" name="overlap_check" id="overlap_check" value="0" />
                <input type="hidden" name="multiple_slots_count" id="multiple_slots_count" value="0"/>
                <input type="hidden" name="url_value_slot" id="url_value_slot"  value="{$url_val_slot}" />
                <input type="hidden" name="url_value_slot_remain" id="url_value_slot_remain"  value="{$url_value_slot_remain}" />
                <a href="#" class="btn_save"></a>
            </form>
            <span class="custom_slot"></span></div>
        <div class="skill clearfix"> <span class="skill_name">{$translate.vacum_cleaner}<a href="#" class="remove"></a></span> <span class="add_skill"><a href="javascript:void(0);" onclick="popup_inner('{$url_path}gdschema_alloc.php?date={$week_data.date}&customer={$employee_data.customer.username}')" class="btn_add_skill">Add Skill</a></span> </div>
        <div class="company clearfix"> <span class="company_name">{$translate.company_name}<a href="#" class="remove"></a></span> <span class="add_company"><a href="#" class="btn_add_company">Add Company</a></span> </div>
        <div class="worker clearfix"> <span class="worker_name">{$translate.worker_name}<a href="#" class="remove"></a></span> <span class="add_worker"><a href="#" class="btn_add_worker"></a></span></div>
    </div>
    <div class="time_option"><a href="#" class="close"></a>
        <div class="type_selector clearfix">
            <ul class="clearfix">
                <li><a href="#" class="travel"></a></li>
                <li class="selected"><a href="#" class="work"></a></li>
                <li><a href="#" class="lunch"></a></li>
            </ul>
        </div>

    </div>
</div>

<div class="clearfix" id="day_selector">
    <div class="clearfix" id="week">
        <div id="week_number">V{$cur_week}</div>
        <ul class="clearfix">
            {foreach $alloc_week_days as $week_day}
                <li>
                    <a {if $week_day.active}class="selected"{/if} href="javascript:void(0);" {if $week_day.flag == 1}onclick="loadContent('{$url_val_self}&date={$week_day.date}')"{/if}>
                        {$translate.{$week_day.label}}
                    </a>
                </li>
            {/foreach}
        </ul>
    </div>
</div>
<div id="overlap_error"></div>
<div id="worker_company_name">{if $employee.name}<a href="javascript:void(0);" onclick="loadContent('{$url_path}gdschema_alloc.php?date={$cur_date}&employee={$employee.userid}')" id="worker_name">{$employee.name} {$employee.week_worked_hour}({$employee.contract_week_hour})<span style="float:right">{$cur_date}</span></a>{/if}{if $customer.name}<a href="javascript:void(0);" onclick="loadContent('{$url_path}gdschema_alloc.php?date={$cur_date}&customer={$customer.userid}')" id="company_name">{$customer.name} - FK: {$customer.week_worked_hour_fk}({$customer.contract_week_hour_fk}) KN: {$customer.week_worked_hour_kn}({$customer.contract_week_hour_kn}){if $employee.name == ''}<span style="float:right;">{$cur_date}</span>{/if}</a>{/if}</div>

<div class="clearfix" id="options">
    <div id="assigned_slots">
        <div class="option_head">{$translate.assigned_slots} </div>
        <div id="assigned_inner">
            <div class="scroll_content" >

                {foreach $slot_details as $slot_det}
                    <div id="d{$slot_det.id}" class="{if $slot_det.status == 1}custom_time_slots clearfix{else if $slot_det.status == 2}custom_time_slots_leave clearfix{else}custom_time_slots_incomplete clearfix{/if}" >
                        <div class="left_col">
                            <div class="time">
                                <span class="duration">{$slot_det.slot} ({$slot_det.slot_hour})</span>
                                <span class="duration_btn">
                                    {if $slot_det.status != 2 && $slot_det.signed_in == 0}    
                                    {if $slot_det.status == 3}<a href="javascript:void(0);" {if $emp_role == 1 || $emp_role == 6}onclick="loadAjax('{$url_val}&id={$slot_det.id}&type=2&action=direct')"{/if}><div class="sprite_alloc_popup_icons" style="background-position: 0 -363px; width: 15px; height: 15px;"></div></a>
                                    {else}
                                        {if $emp_role == 1 || $emp_role == 6}<a href="javascript:void(0);" onclick="loadAjax('{$url_val}&id={$slot_det.id}&type=3&action=direct')"><div class="sprite_alloc_popup_icons" style="background-position: 0 -343px; width: 15px; height: 15px;"></div></a>{/if}
                                        {/if}
                                    {/if}
                            </span>
                            {if $slot_det.customer}
                                <div class="fkkn_btn" style="float:right; padding-right:20px; width:40px;">
                                    {if $slot_det.status != 2 && $slot_det.signed_in == 0}   
                                        {if $slot_det.fkkn == 1}<a href="javascript:void(0);" {if $privileges_gd.fkkn == 1}onclick="loadAjax('{$url_val}&id={$slot_det.id}&type=2&action=fkkn')"{/if}><div class="sprite_alloc_popup_icons" style="background-position: 0 -217px; width: 51px; height: 16px;"></div></a>
                                        {elseif $slot_det.fkkn == 2}<a href="javascript:void(0);" {if $privileges_gd.fkkn == 1}onclick="loadAjax('{$url_val}&id={$slot_det.id}&type=1&action=fkkn')"{/if}><div class="sprite_alloc_popup_icons" style="background-position: 0 -282px; width: 51px; height: 16px;"></div></a>
                                            {/if}
                                        {/if}
                                </div><!-- End demo -->
                            {/if}

                            </span>

                            <span class="custom_slot"></span></div>
                            {if $slot_det.type == 0}    

                        {/if}
                        <div class="company clearfix">
                            {if $slot_det.customer != ''}<span class="company_name">{$slot_det.cust_name}{if $privileges_gd.remove_customer == 1 && $slot_det.signed_in == 0}<a href="javascript:void(0);" onclick="custRemove('{$url_val|cat:'&id='|cat:$slot_det.id|cat:'&action=cust_remove'}')" class="remove"></a>{/if}</span>
                        {else}<span class="add_company"><a href="javascript:void(0);" class="btn_add_company" {if $privileges_gd.add_customer == 1}onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&action=add_cust')"{else}onclick="messagePrivilege()"{/if}>{$translate.add_company}</a></span>{/if}

                    </div>
                    <div class="worker clearfix">
                        {if $slot_det.employee != ''}<span class="worker_name">{$slot_det.emp_name}{if  $privileges_gd.remove_employee == 1 && $slot_det.signed_in == 0}<a href="javascript:void(0);" onclick="empRemove('{$url_val|cat:'&id='|cat:$slot_det.id|cat:'&action=emp_remove'}')" class="remove"></a>{/if}</span>
                    {else}<span class="add_worker"><a href="javascript:void(0);" class="btn_add_worker" {if $privileges_gd.add_employee == 1}onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&action=add_emp')"{else}onclick="messagePrivilege()"{/if}>{$translate.add_worker}</a></span>{/if}
                </div>
            </div>
            <div class="time_option">{if $privileges_gd.delete_slot == 1 && $slot_det.signed_in == 0}<a href="javascript:void(0);" class="close" onclick="slotRemove('{$url_val}&id={$slot_det.id}&action=slot_remove')"></a>{/if}
                {if ($privileges_gd.leave == 1 || $privileges_gd.copy_single_slot == 1 || $privileges_gd.copy_single_slot_option == 1 || $privileges_gd.swap == 1 || $privileges_gd.delete_slot == 1 || $privileges_gd.split_slot == 1 || $privileges_gd.add_customer == 1 || $privileges_gd.add_employee == 1 || $privileges_gd.fkkn == 1 || $privileges_gd.slot_type == 1) && $slot_det.signed_in == 0}
                        <a href="javascript:void(0);" onclick="loadPopupSlot('{$url_path}gdschema_slot_manage.php?date={$slot_det.date}&slot={$slot_det.id}', '{$url_val_reload}')" class="settings"></a>
                    {else}
                        <a href="javascript:void(0);" onclick="messagePrivilege()" class="settings"></a>
                {/if}    
                {if $slot_det.status != 2 && $privileges_gd.slot_type == 1 && $slot_det.signed_in == 0}              
                    <div class="type_selector clearfix">
                        <ul class="clearfix">

                            <li {if $slot_det.type == 1}class="selected"{/if} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=1&action=type')"><a title="{$translate.travel}" href="javascript:void(0);"  class="travel"></a></li>
                            <li {if $slot_det.type == 0}class="selected"{/if} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=0&action=type')"><a title="{$translate.normal}" href="javascript:void(0);"  class="work"></a></li>
                            <li {if $slot_det.type == 2}class="selected"{/if} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=2&action=type')"><a title="{$translate.break}" href="javascript:void(0);"  class="lunch"></a></li>
                            <li {if $slot_det.type == 3}class="selected"{/if} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=3&action=type')"><a title="{$translate.oncall}" href="javascript:void(0);"  class="oncall"></a></li>
                            <li {if $slot_det.type == 4}class="selected"{/if} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=4&action=type')"><a title="{$translate.overtime}" href="javascript:void(0);"  class="overtime"></a></li>
                            <li {if $slot_det.type == 5}class="selected"{/if} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=5&action=type')"><a title="{$translate.qual_overtime}" href="javascript:void(0);"  class="qual_overtime"></a></li>
                            <li {if $slot_det.type == 6}class="selected"{/if} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=6&action=type')"><a title="{$translate.more_time}" href="javascript:void(0);"  class="more_time"></a></li>
                            <li {if $slot_det.type == 7}class="selected"{/if} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=7&action=type')"><a title="{$translate.some_other_time}" href="javascript:void(0);"  class="some_other_time"></a></li>
                            <li {if $slot_det.type == 8}class="selected"{/if} onclick="popup_inner('{$url_val_popup}&id={$slot_det.id}&type=8&action=type')"><a title="{$translate.training_time}" href="javascript:void(0);"  class="training_time"></a></li>
                        </ul>
                    </div>
                    
                {/if}   
            </div>
        </div>
    {/foreach}
</div>
<div id="loading_image"></div>
</div>
{if $privileges_gd.add_slot == 1}
    <div id="add_new_slot"><a href="javascript:void(0);" onclick="processEntry()">{$translate.click_to_add_new_time_slot}</a></div>
{/if}    
<div id="slot_entry" style="display: none;">
    <form id="frm_slot_entry" name="frm_slot_entry" method="post" action="" class="cust_slot_frm clearfix" >
        <table>
            <tr>
                <td>From</td><td colspan="3"><input type="text" name="slot_from" id="slot_from"  class="custom_slot" style="width: 100px;" /></td>
            </tr>
            <tr>
                <td>To</td><td><input type="text" name="slot_to" id="slot_to"  class="custom_slot" style="width: 100px;" /></td>
                <td><input type="button" name="btn_slot_entry" id="btn_slot_entry" value="{$translate.save}" onclick="manEntry('{$url_val}&type=0&action=man_slot_entry')"></td>
                <td><input type="button" name="btn_slot_entry_back" id="btn_slot_entry_back" value="{$translate.back}" onclick="processDrag()"></td>
            </tr>
        </table>
    </form>
</div>    
</div>
{if $privileges_gd.add_slot == 1}
    
<div id="memory_slots">
    <div class="option_head" style="height:20px;">{$translate.memory_slots} <a href="javascript:void(0);" class="btn_add_worker" style="float: right;" onclick="multipleSlotAdd()">{$translate.add_selected}</a></div>
    <div id="memory_inner" class="clearfix">
        
        <div class="scroll_memory_inner">
            {foreach $memory_slots3 as $available_slots}
                <div class="memory_time clearfix"><div style="float: left;padding-top: 2px;"><input type="checkbox" name="slot_{$available_slots.id}" id="slot_{$available_slots.id}"  onclick="multipleSlotTempAdd('{$available_slots.id}')" value="{$available_slots.time_from|cat:'-'|cat:$available_slots.time_to}"/><span>{$available_slots.time_from|cat:'-'|cat:$available_slots.time_to}</span></div>
                  <a href="javascript:void(0);" onclick="loadAjax ('{$url_val}&id={$available_slots.id}&action=memory_slot_remove');" style="float: right;"><div class="sprite_alloc_popup_icons" style="background-position: 0 -144px; width: 18px; height: 19px;"></div></a>
                </div>
            {/foreach}
        </div>
        <div class="scroll_memory_inner">
            {foreach $memory_slots2 as $available_slots}
                <div class="memory_time clearfix"><div style="float: left;padding-top: 2px;"><input type="checkbox" name="slot_{$available_slots.id}" id="slot_{$available_slots.id}"  onclick="multipleSlotTempAdd('{$available_slots.id}')" value="{$available_slots.time_from|cat:'-'|cat:$available_slots.time_to}"/><span>{$available_slots.time_from|cat:'-'|cat:$available_slots.time_to}<span></div>
                    <a href="javascript:void(0);" onclick="loadAjax ('{$url_val}&id={$available_slots.id}&action=memory_slot_remove');" style="float: right;"><div class="sprite_alloc_popup_icons" style="background-position: 0 -144px; width: 18px; height: 19px;"></div></a>
                </div>
            {/foreach}
        </div>
        <div class="scroll_memory_inner">
            {foreach $memory_slots1 as $available_slots}
                <div class="memory_time clearfix"><div style="float: left;padding-top: 2px;"><input type="checkbox" name="slot_{$available_slots.id}" id="slot_{$available_slots.id}"  onclick="multipleSlotTempAdd('{$available_slots.id}')" value="{$available_slots.time_from|cat:'-'|cat:$available_slots.time_to}"/><span>{$available_slots.time_from|cat:'-'|cat:$available_slots.time_to}<span></div>
                    <a href="javascript:void(0);" onclick="loadAjax ('{$url_val}&id={$available_slots.id}&action=memory_slot_remove');" style="float: right;"><div class="sprite_alloc_popup_icons" style="background-position: 0 -144px; width: 18px; height: 19px;"></div></a>
                </div>
            {/foreach}
        </div>
    </div>
</div>
{/if}
</div>
{else}
    <div class="message">{$translate.employee_signed_in}</div>
{/if}    
   <!-- <div class="message">{$translate.no_common_works}</div> -->
{/block}
