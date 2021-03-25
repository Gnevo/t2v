{if $type == 'add'}
<div class="span6 form-left">
    <div style="margin: 10px 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_name">{$translate.name}</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.name}" type="text" name="relative_name" id="relative_name" value="" onchange="markChange()" />
            <input name="relative_id" id="relative_id" type="hidden"/>
        </div>
    </div>

    <div style="margin: 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_relation">{$translate.relation}</label>
        <div style="margin: 0px;" class="input-prepend span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.relation}" type="text" name="relative_relation" id="relative_relation" value="" onchange="markChange()"/> </div>
    </div>

    <div style="margin: 10px 0px 0px;" class="span12">
        <label style="float: left;" class="span12" for="relative_address">{$translate.address}</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.address}" type="text" name="relative_address" id="relative_address" value="" onchange="markChange()"/></div>
    </div>

    <div style="margin: 10px 0px;" class="span12">
        <label style="float: left;" class="span12" for="relative_city">{$translate.city}</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.city}" type="text" name="relative_city" id="relative_city" value="" onchange="markChange()"/> </div>
    </div>

</div>
<div class="span6 form-right">

    <div style="margin: 10px 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_phone">{$translate.phone}</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.phone}" type="text" name="relative_phone" id="relative_phone" value="" onchange="markChange()"/> </div>
    </div>


    <div style="margin: 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_work_phone">{$translate.phone_work}</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.phone_work}" type="text" name="relative_work_phone" id="relative_work_phone" value="" onchange="markChange()"/> </div>
    </div>


    <div style="margin: 10px 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_mobile">{$translate.mobile}</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.mobile}" type="text" name="relative_mobile" id="relative_mobile" value="" onchange="markChange()"/> </div>
    </div>


    <div style="margin: 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_email">{$translate.email}</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.email}" type="email" name="relative_email" id="relative_email" value="" onchange="markChange()"/> </div>
    </div>

</div>
<div class="span12" style="margin:0">
    <label class="span12" style="margin-top:0;" for="relative_other">{$translate.other}</label>
    <textarea id="relative_other" name="relative_other" rows="2" class="form-control span12" onchange="markChange()">{$relative_details.other}</textarea>
</div>            
{else if $type == 'load'}
    <div class="span6 form-left">
    <div style="margin: 10px 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_name">{$translate.name}</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.name}" type="text" name="relative_name" id="relative_name" value="{$relative_details.name}" onchange="markChange()" />
	    <input name="relative_id" id="relative_id" type="hidden" value="{$relative_details.id}" />		
	</div>
    </div>

    <div style="margin: 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_relation">{$translate.relation}</label>
        <div style="margin: 0px;" class="input-prepend span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.relation}" type="text" name="relative_relation" id="relative_relation" value="{$relative_details.relation}" onchange="markChange()"/> </div>
    </div>

    <div style="margin: 10px 0px 0px;" class="span12">
        <label style="float: left;" class="span12" for="relative_address">{$translate.address}</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.address}" type="text" name="relative_address" id="relative_address" value="{$relative_details.address}" onchange="markChange()"/></div>
    </div>

    <div style="margin: 10px 0px;" class="span12">
        <label style="float: left;" class="span12" for="relative_city">{$translate.city}</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.city}" type="text" name="relative_city" id="relative_city" value="{$relative_details.city}" onchange="markChange()"/> </div>
    </div>

</div>
<div class="span6 form-right">

    <div style="margin: 10px 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_phone">{$translate.phone}</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.phone}" type="text" name="relative_phone" id="relative_phone" value="{$relative_details.phone}" onchange="markChange()"/> </div>
    </div>


    <div style="margin: 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_work_phone">{$translate.phone_work}</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.phone_work}" type="text" name="relative_work_phone" id="relative_work_phone" value="{$relative_details.work_phone}" onchange="markChange()"/> </div>
    </div>


    <div style="margin: 10px 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_mobile">{$translate.mobile}</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.mobile}" type="text" name="relative_mobile" id="relative_mobile" value="{$relative_details.mobile}" onchange="markChange()"/> </div>
    </div>


    <div style="margin: 0px ! important;" class="span12">
        <label style="float: left;" class="span12" for="relative_email">{$translate.email}</label>
        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
            <input class="form-control span10" placeholder="{$translate.email}" type="email" name="relative_email" id="relative_email" value="{$relative_details.email}" onchange="markChange()"/> </div>
    </div>

</div>
<div class="span12" style="margin:0">
    <label class="span12" style="margin-top:0;" for="relative_other">{$translate.other}</label>
    <textarea id="relative_other" name="relative_other" rows="2" class="form-control span12" onchange="markChange()">{$relative_details.other}</textarea>
</div>
{else if $type == 'list'}
    <ul class="span12 list-group list-group-form input-group" style="float: left;">
        {foreach $customer_relatives as $relative}    
            <li class="list-group-item span12 no-ml">
                <div class="span5"><a href="javascript:void(0);" onclick="loadRelative('{$relative.id}')">{$relative.name}</a></div>
                <div class="span5"><a href="javascript:void(0);" onclick="loadRelative('{$relative.id}')">{$relative.relation}</a></div>
                <div class="span1 pull-right"><button style="text-align: center;" class="btn btn-default btn-normal span12 pull-right" type="button" onclick="deleteRelative('{$relative.id}')">x</button></div>
            </li>
        {foreachelse}    
            <li class="list-group-item">
                <div class="span5">{$translate.no_relatives}</div>
                <div class="span5"></div>
                <div class="span1 pull-right"></div>
            </li>
        {/foreach}
    </ul>
{/if}
