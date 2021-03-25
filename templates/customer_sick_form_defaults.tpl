{block name='style'}
<style type="text/css">
    .box-form { border: solid thin #000; padding: 20px; }
    .box-form-wrpr {  margin-bottom: 20px; }
    .signing_form_label{ width:92px; float:left; display:block; padding-left:8px; }
    .signing_form_text{ float:left; width: 122px; }
</style>
{/block}
{block name='script'}
<script type="text/javascript">
var change = 0; 
$(document).ready(function(){
    if($(window).height() > 600)
        $('.tab-content-con').css({ height: $(window).height()-254});
    else
        $('.tab-content-con').css({ height: $(window).height()});
    
    var hidWidth;
    var scrollBarWidths = 40;

    
    var widthOfList = function(){
      var itemsWidth = 0;
      $('.list li').each(function(){
        var itemWidth = $(this).outerWidth();
        itemsWidth+=itemWidth;
      });
      return itemsWidth;
    };

    var widthOfHidden = function(){
      return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
    };

    var getLeftPosi = function(){
      return $('.list').position().left;
    };
    var reAdjust = function(){
      if (($('.wrapper').outerWidth()) < widthOfList()) {
        $('.scroller-right').show();
      }
      else {
        $('.scroller-right').hide();
      }

      if (getLeftPosi()<0) {
        $('.scroller-left').show();
      }
      else {
        $('.item').animate({ left:"-="+getLeftPosi()+"px" },'slow');
            $('.scroller-left').hide();
      }
    }


    reAdjust();

    $(window).on('resize',function(e){  
            reAdjust();
    });

    $('.scroller-right').click(function() {

      $('.scroller-left').fadeIn('slow');
      $('.scroller-right').fadeOut('slow');

      $('.list').animate({ left:"+="+widthOfHidden()+"px" },'slow',function(){

      });
    });

    $('.scroller-left').click(function() {

            $('.scroller-right').fadeIn('slow');
            $('.scroller-left').fadeOut('slow');

            $('.list').animate({ left:"-="+getLeftPosi()+"px" },'slow',function(){

            });
    });   
    

});

function load_data(){
    var selected_emp = $('#cmb_employee').val();
    $('#selected_employee').val(selected_emp);
    $('#formLoad').submit();
}

function backForm() {
            //document.location.href = '{$url_path}list/customer/{if $customer_detail.status == '0'}inact{else}act{/if}/';
            window.history.back();
        }
   
function saveForm(){
    var uname = $("#signing_uname").val();
    var pword = $("#signing_password").val();
    if(uname == "" || pword == ""){
        alert("{$translate.username_or_password_missing}");
        $("#signing_password").focus();
    } else
        $('#frmSave').submit();
}

function markchange(){
    change = 1;
}

function redirectConfirm(mode){
    var redirectURL = mode.replace("%%C-UNAME%%", "{$customer_detail.username}");
    if(redirectURL != ''){
        document.location.href = redirectURL;
    }
}

</script>
{/block}

{block name="content"}
    {if $access_flag == 1}
        <div id="dialog-confirm" title="{$translate.confirm}" style="display:none;">
            <br><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_save_changes}</p>
        </div>
        <div class="clearfix" id="dialog_popup" style="display:none;"></div>
        {$message} 
        <div class="row-fluid">
            <div style="" class="span12 main-left boxscroll">
                <div style="margin: 0px;" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1>{$translate.customer}</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">

                    </div>
                </div>
                <div class="span12 widget-body-section input-group">
                    <div class="widget option-panel-widget input-group input-group" style="margin: 0px ! important;"> 
                        {if !empty($customer_detail)}
                            <div class="widget-body" style="padding:4px;">
                                <div class="row-fluid">
                                    <div class="span4 top-customer-info"><strong>{$translate.social_security}</strong> : {$customer_detail.social_security}</div>
                                    <div class="span4 top-customer-info"><strong>{$translate.customer_code} :</strong> {$customer_detail.code}</div>
                                    {if $sort_by_name == 1}
                                        <div class="span4 top-customer-info"><strong>{$translate.name} :</strong> {$customer_detail.first_name|cat: ' '|cat: $customer_detail.last_name}</div>
                                    {elseif $sort_by_name == 2}
                                        <div class="span4 top-customer-info"><strong>{$translate.name} :</strong> {$customer_detail.last_name|cat: ' '|cat: $customer_detail.first_name}</div>     
                                    {/if}
                                </div>
                            </div>
                        {/if}
                    </div>
                   <div class="row-fluid">
                        <div class="span12">
                            <div class="tab-content-switch-con" >
                            {block name="customer_manage_tab_content"}{/block}
                            <div class="widget-header widget-header-options tab-option">
                                    <div class="span4 day-slot-wrpr-header-left span3">
                                        <h1>{$translate.customer} - {$translate.sick_form_defaults}</h1>
                                    </div>
                                        <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                            <button class="btn btn-default btn-normal pull-right ml" type="button" onclick="saveForm();"><span class="icon-save"></span> {$translate.save}</button>
                                            <button class="btn btn-default btn-normal pull-right" type="button" onclick="backForm();"><span class="icon-arrow-left"></span> {$translate.backs}</button>
                                        </div>
                                </div>
                            </div>
                            <div class="tab-content-con boxscroll">
                            <div class="tab-content span12" style="margin:0;">
                                <div role="tabpanel" class="tab-pane active" id="tab-8">
                                    <form style ="float: left; width:100%;" id="frmSave" name="frmSave" method="post" class="no-mb">
                                        <input type="hidden" name="selected_action" value="SAVE"/>
                                        <div style="margin-left: 0px;" class="span12">
                                            <div class="span12">
                                                <div class="widget no-mb" style="margin-top:0;">
                                                    <!--WIDGET BODY BEGIN-->
                                                    <div class="span12 widget-body-section input-group">
                                                        <div class="row-fluid">
                                                            <div class="span12">
                                                                <div class="widget no-mb" style="margin-top:0;">
                                                                    <div class="span12 widget-body-section input-group mb">
                                                                        <div class="box-form-wrpr">
                                                                            <h4><strong>Övriga fält</strong></h4>
                                                                            <div class="row-fluid">
                                                                                <div class="span12">
                                                                                    <table border="0" cellspacing="0" cellpadding="1" class="span12 no-ml table-responsive">
                                                                                        <tr>
                                                                                            <td width="25%" bgcolor="#FFFFFF">Uppdrag</td>
                                                                                            <td width="75%" bgcolor="#FFFFFF"><input name="txtUppdrag" type="text" id="txtUppdrag" value="{$sick_form_defaults.uppdrag}" size="30" /></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td width="25%" bgcolor="#FFFFFF">Fullmakt</td>
                                                                                            <td width="75%" bgcolor="#FFFFFF">
                                                                                                <label><input name="chkFullmaktBifogas" type="checkbox" id="chkFullmaktBifogas" value="1" {if $sick_form_defaults.fullmakt_values.fullmakt1 eq 1}checked="checked"{/if}> Bifogas </label>
                                                                                                <label class='mt mb'><input name="chkFullmaktTidigareInsant" type="checkbox" id="chkFullmaktTidigareInsant" value="1" {if $sick_form_defaults.fullmakt_values.fullmakt2 eq 1}checked="checked"{/if}> Tidigare ins&auml;nt</label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2" bgcolor="#FFFFFF">
                                                                                                <label><input name="chkBifogas1" type="checkbox" id="chkBifogas1" value="1" {if $sick_form_defaults.checkbox_values.chkBifogas1 eq 1}checked="checked"{/if}/>
                                                                                                Sjukfr&aring;nvaroanm&auml;lan eller annan uppgift som styrker ordinarie assistents sjukfr&aring;nvaro.</label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2" bgcolor="#FFFFFF">
                                                                                                <label><input name="chkBifogas2" type="checkbox" id="chkBifogas2" value="1" {if $sick_form_defaults.checkbox_values.chkBifogas2 eq 1}checked="checked"{/if}/>
                                                                                                Kopia p&aring; l&ouml;neutbetalning eller annan uppgift som styrker att kostnaderna &auml;r utbetalda&ndash; ordinarie personlig assistent och vikarie</label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2" bgcolor="#FFFFFF">
                                                                                                <label><input name="chkBifogas3" type="checkbox" id="chkBifogas3" value="1" {if $sick_form_defaults.checkbox_values.chkBifogas3 eq 1}checked="checked"{/if}/>
                                                                                                Tidrapport till f&ouml;rs&auml;kringskassan - ordinarie personlig asstistens och vikarie</label>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2" bgcolor="#FFFFFF">
                                                                                                <label><input name="chkBifogas4" type="checkbox" id="chkBifogas4" value="1" {if $sick_form_defaults.checkbox_values.chkBifogas4 eq 1}checked="checked"{/if}/>
                                                                                                Komplett ifyllt sammanst&auml;llning som visas att faktiskt merkostnad finns. (Styrkande av merkostnadens storlek, sid 2.)</label>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {else}
      <div class="fail">{$translate.permission_denied}</div>
    {/if}
{/block}