{block name="style"}
{/block}
{block name="script"}
    <script type="text/javascript">
        $(document).ready(function(){
            $(window).resize(function(){
                $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
            }).resize();
        });
    </script>
{/block}
{block name="content"} 
<div class="row-fluid">
        <div class="span12 main-left">
            <div id="left_message_wraper" class="span12" style="min-height: 0px; margin-left: 0;">{$message}</div>
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1>{$translate.customer_forms}</h1>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    <div class="span12 icons-group">
                        <div class="span12 icons-group">
                            <ul>
                                {if $privileges_forms.form_1 == 1 || $privileges_forms.form_1_report == 1}
                                    <li style="min-height: 71px; padding: 0px;">
                                        <a style="margin: 10px; display: block;" href="javascript:void(0);" onclick="navigatePage('{$url_path}form_1.php',8);">
                                            <h4 class="title">{$translate.form_1}</h4>
                                            <h5 class="sub-title"><i>{$translate.form_1_desc}</i></h5>
                                        </a>
                                        <div class="corner-arrow"></div>
                                    </li>
                                {/if}
                                {if $privileges_forms.form_2 == 1 || $privileges_forms.form_2_report == 1}
                                    <li style="min-height: 71px; padding: 0px;">
                                        <a style="margin: 10px; display: block;" href="javascript:void(0);" onclick="navigatePage('{$url_path}form_2.php',8);">
                                            <h4 class="title">{$translate.form_2}</h4>
                                            <h5 class="sub-title"><i>{$translate.form_2_desc}</i></h5>
                                        </a>
                                        <div class="corner-arrow"></div>
                                    </li>
                                {/if}
                                {if $privileges_forms.form_3 == 1 || $privileges_forms.form_3_report == 1}
                                    <li style="min-height: 71px; padding: 0px;">
                                        <a style="margin: 10px; display: block;" href="javascript:void(0);" onclick="navigatePage('{$url_path}form_3.php',8);">
                                            <h4 class="title">{$translate.form_3}</h4>
                                            <h5 class="sub-title"><i>{$translate.form_3_desc}</i></h5>
                                        </a>
                                        <div class="corner-arrow"></div>
                                    </li>
                                {/if}
                                {if $privileges_forms.form_4 == 1}
                                    <li style="min-height: 71px; padding: 0px;">
                                        <a style="margin: 10px; display: block;" href="{$url_path}form_4.php">
                                            <h4 class="title">{$translate.form_4}</h4>
                                            <h5 class="sub-title"><i>{$translate.form_4_desc}</i></h5>
                                        </a>
                                        <div class="corner-arrow"></div>
                                    </li>
                                {/if}
                                {if $privileges_forms.form_5 == 1}
                                    <li style="min-height: 71px; padding: 0px;">
                                        <a style="margin: 10px; display: block;" href="{$url_path}form_5.php">
                                            <h4 class="title">{$translate.form_5}</h4>
                                            <h5 class="sub-title"><i>{$translate.form_5_desc}</i></h5>
                                        </a>
                                        <div class="corner-arrow"></div>
                                    </li>
                                {/if}
                                {if $privileges_forms.form_6 == 1}
                                    <li style="min-height: 71px; padding: 0px;">
                                        <a style="margin: 10px; display: block;" href="{$url_path}form_6.php">
                                            <h4 class="title">{$translate.form_6}</h4>
                                            <h5 class="sub-title"><i>{$translate.form_6_desc}</i></h5>
                                        </a>
                                        <div class="corner-arrow"></div>
                                    </li>
                                {/if}
				{if $privileges_forms.form_7 == 1}
                                    <li style="min-height: 71px; padding: 0px;">
                                        <a style="margin: 10px; display: block;" href="{$url_path}form_7.php">
                                            <h4 class="title">{$translate.form_7}</h4>
                                            <h5 class="sub-title"><i>{$translate.form_7_desc}</i></h5>
                                        </a>
                                        <div class="corner-arrow"></div>
                                    </li>
                                {/if}
                            </ul>               
                        </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
{/block}
