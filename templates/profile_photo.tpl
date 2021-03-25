{block name='style'}
    <link rel="stylesheet" type="text/css" href="{$url_path}css/profile-settings.css" />
    <style type="text/css" media="screen">
        input[type=file] {
            font-size: 15px;
            vertical-align: middle;
            padding: 7px;
            height: auto;
            line-height: initial;
        }
        .upload_form_cont{ margin: 60px 0; }
        .active-border { border: thin solid #E3E3E3; }
        .upload_form_cont #image{ border-bottom-right-radius: 0;border-top-right-radius: 0; }
        .upload_form_cont .btn{ margin: 0px;margin-top: -1px;margin-left: -7px;padding: 10px; }
        @media screen and (max-width: 767px){
            .upload_form_cont #image { float: left; width: 68% !important;}
            .upload_form_cont .btn{ float: left; }
            form#photo{ padding: 0px 20px; }
        }
    </style>
{/block}

{block name='script'} 
<script type="text/javascript" src="{$url_path}js/jquery.imgareaselect.min.js"></script>
{if $uploaded}
<script type="text/javascript">
    function preview(img, selection) { 
        var scaleX = {$thumb_width}; 
        var scaleY = {$thumb_height}; 

        $('#thumbnail + div > img').css({ 
                width: Math.round(scaleX * {$current_large_image_width}) + 'px', 
                height: Math.round(scaleY * {$current_large_image_height}) + 'px',
                marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
                marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
        });
        $('#x1').val(selection.x1);
        $('#y1').val(selection.y1);
        $('#x2').val(selection.x2);
        $('#y2').val(selection.y2);
        $('#w').val(selection.width);
        $('#h').val(selection.height);
    } 

    $(document).ready(function () { 
    	$('#save_thumb').click(function() {
    		var x1 = $('#x1').val();
    		var y1 = $('#y1').val();
    		var x2 = $('#x2').val();
    		var y2 = $('#y2').val();
    		var w = $('#w').val();
    		var h = $('#h').val();
    		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
    			alert("You must make a selection first");
    			return false;
    		}else{
    			return true;
    		}
    	});
    }); 

    $(window).load(function () { 
        $('#thumbnail').imgAreaSelect({ aspectRatio: '1:{$thumb_height/$thumb_width}', handles: 'True', parent: '#parent', onSelectChange: preview }); 
    });

</script>
{/if}
{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <div class="span2">
                        <h1>{$translate.profiles}</h1>
                    </div>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                {$message}
                <div class="row-fluid">
                    <div class="{if $uploaded}span6{else}span4{/if} center innerL innerTB active-border clearfix">
                        {if $uploaded}
                            <div class="span12"><div class="alert alert-warning" role="alert">{$translate.select_area_to_crop_image}</div></div>
                            <div align="center">
                                <div id="parent" style="position:relative;">
                                    <span id="thumbnail" style="display: inline-block;">
                                        <img id="image" style="width:80%;" src="{$url_path}{$large_image}?v={filemtime($large_image)}" />
                                    </span>
                                </div>
                                <form id="img_prof" name="img_prof" method="post">
                                    <input type="hidden" name="filename" value="{$large_image_name}" id="filename" />
                                    <input type="hidden" name="x1" value="" id="x1" />
                                    <input type="hidden" name="y1" value="" id="y1" />
                                    <input type="hidden" name="x2" value="" id="x2" />
                                    <input type="hidden" name="y2" value="" id="y2" />
                                    <input type="hidden" name="w" value="" id="w" />
                                    <input type="hidden" name="h" value="" id="h" />
                                    {* <input type="submit" name="upload_thumbnail" value="{$translate.save}" id="save_thumb" /> *}
                                    <button class="btn btn-success btn-normal btn-manage " name="upload_thumbnail" value="{$translate.save}" id="save_thumb" style="margin: 8px;" type="submit">{$translate.save}</button>
                                </form>
                            </div>
                        {else}
                            {if $thumb_photo_exists}
                                <div class="span12">
                                    <img src="{$url_path}{$thumbnail_image}?v={filemtime($thumbnail_image)}" id="thumbnail" alt="{$user_id}" />
                                </div>
                                <div class="span12">
                                    {* <a href="{$url_path}profile_photo.php?act=delete&user={$user_id}" class="btn" style="float: left;">{$translate.delete}</a> *}
                                    <button class="btn btn-danger btn-normal btn-manage " style="margin: 8px;" type="button" onclick="location.href='{$url_path}profile_photo.php?act=delete&user={$user_id}';">{$translate.delete}</button>
                                </div>
                            {else}
                                <div class="span12">
                                    <img src="{$url_path}images/dashboard-avatar.png" alt="{$user_id}" id="thumbnail" />
                                </div>
                            {/if}
                        {/if}
                    </div>
                    <div class="{if $uploaded}span6{else}span8{/if} center active-border">
                        <form id="photo" name="photo" method="post" enctype="multipart/form-data">
                            <div class="upload_form_cont">
                                <div>
                                    <div><label class="center" style="float: none;" for="image_file">{$translate.upload_newfile}</label></div>
                                    <div>
                                        <input name="image" id="image" type="file" required="true" />
                                        <button class="btn btn-success btn-normal btn-manage " name="upload" value="{$translate.upload_new_file}" type="submit">{$translate.upload_new_file}</button>
                                    </div>
                                </div>
                                {* <div> *}
                                    {* <input type="submit" name="upload" value="{$translate.upload_new_file}" class="upload-photo" /> *}
                                    {* <button class="btn btn-success btn-normal btn-manage " name="upload" value="{$translate.upload_new_file}" style="margin: 8px;" type="submit">{$translate.upload_new_file}</button> *}
                                {* </div> *}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}