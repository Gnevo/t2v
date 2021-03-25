<script>
    $(document).ready(function (){
        {if $large_sides == "" || $large_sides == null}
            {if $large_common == '1'}
                var height_centre = (parseInt('{$large_centre}')*54)+50;
                $('.threeday_today').height(height_centre);
                $('.threeday_yesterday').height(height_centre - 25);
                $('.threeday_tomorrow').height(height_centre - 25);
             {else}
                 var height_centre = $('.threeday_today').height();
                $('.threeday_yesterday').height(height_centre - 25);
                $('.threeday_tomorrow').height(height_centre - 25);
            {/if}
        {else}
            var height_sides = (parseInt('{$large_sides}')*54)+70;
            $('.threeday_today').height(height_sides + 25);
            $('.threeday_yesterday').height(height_sides);
            $('.threeday_tomorrow').height(height_sides);
        {/if}
    });
</script>
<div class="threedaytitle_strip clearfix ">
    <div class="threeday_yesterday clearfix">
        <div class="yesterday_strip">{$yesterday}</div>
        <div class="yesterday_box">
            {foreach $slots_before as $yest}
            <a class="{if $yest.status == 2}time_slot_leave{elseif $yest.status == 0 || $yest.status == 3}time_slot_incomplete{else}time_slot_btn{/if}">
                <div class="clearfix time_singlesloat">
                    <div class="single_sloat_detail">
                        <span class="customer_week_time">{$yest.slot}</span>

                    </div>
                    <div class="customer_name">{if $yest.cust_name != " "}{$yest.cust_name}{else}{/if}</div>
                </div>
                <div class="threecolum_customername" >
                    <div class="block_left_color">
                        <span class="fkkn_type">
                            {if $yest.fkkn == 1}
                                <img src="{$url_path}images/icon_fk.gif"/>
                            {else if $yest.fkkn == 2}
                                <img src="{$url_path}images/icon_kn.gif"/>
                            {/if}
                        </span>

                    </div>

                    {if $yest.type == 0}
                        <span class="work"></span>
                    {else if $yest.type == 1}
                        <span class="travel"></span>
                    {else if $yest.type == 2}
                        <span class="lunch"></span>
                    {else if $yest.type == 3}
                        <span class="oncall"></span>
                    {else if $yest.type == 4}
                        <span class="overtime"></span>    
                    {else if $yest.type == 5}
                        <span class="qualityovertime"></span>
                    {else if $yest.type == 6}
                        <span class="moreovertime"></span>
                    {else if $yest.type == 7}
                        <span class="someothertime"></span>
                    {else if $yest.type == 8}
                        <span class="trainingtime"></span>
                    {else if $yest.type == 9}
                        <span class="calltraining"></span>
                    {else if $yest.type == 10}
                        <span class="personalmeeting"></span>
                    {/if} 

                </div>
            </a>
            {/foreach}
           
        </div>
    </div>
    <div class="threeday_today">
        <div class="today_strip">{$today}</div>
        {foreach $slots_present as $present}
        <a class="{if $present.status == 2}time_slot_leave{elseif $present.status == 0 || $present.status == 3}time_slot_incomplete{else}time_slot_btn{/if}">
            <!--<a href="javascript:void(0);" onclick="loadPopupSlot('http://192.168.0.234/works/app/t2v/cirrus/gdschema_slot_manage.php?date=2013-08-15&slot=5879')" class="time_slot_incomplete ">-->
            <div class="clearfix time_singlesloat">
                <div class="single_sloat_detail">
                    <span class="customer_week_time">{$present.slot}</span>

                </div>
                <div class="customer_name">{if $present.cust_name != " "}{$present.cust_name}{else}{/if}</div>
            </div>
            <div class="threecolum_customername" >
                <div class="block_left_color">
                    <span class="fkkn_type">
                        {if $present.fkkn == 1}
                                <img src="{$url_path}images/icon_fk.gif"/>
                            {else if $present.fkkn == 2}
                                <img src="{$url_path}images/icon_kn.gif"/>
                            {/if}
                    </span>

                </div>
                    {if $present.type == 0}
                        <span class="work"></span>
                    {else if $present.type == 1}
                        <span class="travel"></span>
                    {else if $present.type == 2}
                        <span class="lunch"></span>
                    {else if $present.type == 3}
                        <span class="oncall"></span>
                    {else if $present.type == 4}
                        <span class="overtime"></span>    
                    {else if $present.type == 5}
                        <span class="qualityovertime"></span>
                    {else if $present.type == 6}
                        <span class="moreovertime"></span>
                    {else if $present.type == 7}
                        <span class="someothertime"></span>
                    {else if $present.type == 8}
                        <span class="trainingtime"></span>
                    {else if $present.type == 9}
                        <span class="calltraining"></span>
                    {else if $present.type == 10}
                        <span class="personalmeeting"></span>
                    {/if}

            </div>
        </a>
            {/foreach}
    </div>
    <div class="threeday_tomorrow">
        <div class="yesterday_strip">{$tomorrow}</div>
        <div class="yesterday_box">
            {foreach $slots_after as $tomo}
            <a class="{if $tomo.status == 2}time_slot_leave{elseif $tomo.status == 0 || $tomo.status == 3}time_slot_incomplete{else}time_slot_btn{/if}">
               
                <div class="clearfix time_singlesloat">
                    <div class="single_sloat_detail">
                        <span class="customer_week_time">{$tomo.slot}</span>

                    </div>
                    <div class="customer_name">{if $tomo.cust_name != " "}{$tomo.cust_name}{else}{/if}</div>
                </div>
                <div class="threecolum_customername" >
                    <div class="block_left_color">
                        <span class="fkkn_type">
                            {if $tomo.fkkn == 1}
                                <img src="{$url_path}images/icon_fk.gif"/>
                            {else if $tomo.fkkn == 2}
                                <img src="{$url_path}images/icon_kn.gif"/>
                            {/if}
                        </span>

                    </div>

                    {if $tomo.type == 0}
                        <span class="work"></span>
                    {else if $tomo.type == 1}
                        <span class="travel"></span>
                    {else if $tomo.type == 2}
                        <span class="lunch"></span>
                    {else if $tomo.type == 3}
                        <span class="oncall"></span>
                    {else if $tomo.type == 4}
                        <span class="overtime"></span>    
                    {else if $tomo.type == 5}
                        <span class="qualityovertime"></span>
                    {else if $tomo.type == 6}
                        <span class="moreovertime"></span>
                    {else if $tomo.type == 7}
                        <span class="someothertime"></span>
                    {else if $tomo.type == 8}
                        <span class="trainingtime"></span>
                    {else if $tomo.type == 9}
                        <span class="calltraining"></span>
                    {else if $tomo.type == 10}
                        <span class="personalmeeting"></span>
                    {/if}

                </div>
            </a>
            {/foreach}
        </div>
    </div>
</div>