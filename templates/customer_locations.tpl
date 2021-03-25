{block name='style'}
    <link rel="stylesheet" type="text/css" href="{$url_path}css/inconvenient-timings.css" media="all" />  
    <!-- <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/> -->
    <!-- <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css"/> -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
    
    {* <link rel="stylesheet" href="http://sa3m.github.io/leaflet-control-bing-geocoder/Control.BingGeocoder.css"/> *}
    {* <link rel="stylesheet" href="{$url_path}css/Control.BingGeocoder.css"/> *}
<link  href="https://unpkg.com/leaflet-geosearch@latest/assets/css/leaflet.css" rel="stylesheet" />
{/block}

{block name="script"}
<!-- <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script> -->
<!-- <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script> -->
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
   integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>

{* <script src="http://sa3m.github.io/leaflet-control-bing-geocoder/Control.BingGeocoder.js"></script> *}
{* <script src="{$url_path}js/Control.BingGeocoder.js"></script> *}
<script src="https://unpkg.com/leaflet-geosearch@latest/dist/bundle.min.js"></script>

<!--RESPOSNIVE TABS-->
<script>
        
    if($(window).height() > 600)
        $('.tab-content-con').css({ height: $(window).height()-279});
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
</script>
<script type="text/javascript">
    
    var map_locations_stored = {$map_locations_json};
    $(document).ready(function() {
    
            
         
        var hide_show_flag = 0;
        $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
        $(window).resize(function(){
          $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
        });
            
        
        $(".cancel-new-equipment").click(function() {
            $(".main-left").css('width', '99%');
            $(".main-right").css('display', 'none');
        });
        
        $(".btn-addnew-inconvtiming").click(function() {  
            $(".main-left").css('width', '40%');
            $(".main-right").css('width', '59%');
    		 
            $(".main-right, .oncall-box").css('display', 'block');
            $('#hidden_action').val('newentry');
            $('#saved_location_index').val('-1');
            

            $("#location_title").val('');
            $("#location_lat").val('{$STATIC_MAP_LOCATION_LAT}');
            $("#location_lon").val('{$STATIC_MAP_LOCATION_LON}').trigger('input');
            $("#is_default_location").prop('checked', true);

            $('html, body').animate({
                scrollTop: $(".main-right").offset().top
            }, 3000);
        });

        $(".btn_edit").click(function() {  
            var record_index = parseInt($(this).parents('tr.this-row').data('index'));
            
            // console.log(record_index);
            // console.log(map_locations_stored);

            if(record_index >= 0){

                $(".main-left").css('width', '40%');
                $(".main-right").css('width', '59%');
                 
                $(".main-right").css('display', 'block');
                $(".oncall-box").css('display', 'block');
                $('#hidden_action').val('edit');
                $('#saved_location_index').val(record_index);

                $("#location_title").val(map_locations_stored[record_index]['title']);
                $("#location_lat").val(map_locations_stored[record_index]['lat']);
                $("#location_lon").val(map_locations_stored[record_index]['lon']).trigger('input');
                $("#is_default_location").prop('checked', map_locations_stored[record_index]['is_default']);

            }
        });
    });


    function validate(){
        
        var location_title      = $.trim($('#edit_form_section #location_title').val());
        var location_lat        = $.trim($('#edit_form_section #location_lat').val());
        var location_lon        = $.trim($('#edit_form_section #location_lon').val());
        // var is_default_location = $.trim($('#edit_form_section input:checkbox[name=is_default_location]:checked').val());
        
        if(location_title == '') $("#edit_form_section #location_title").addClass("error");
        else  $("#edit_form_section #location_title").removeClass("error");

        if(location_lat == '') $("#edit_form_section #location_lat").addClass("error");
        else  $("#edit_form_section #location_lat").removeClass("error");

        if(location_lon == '') $("#edit_form_section #location_lon").addClass("error");
        else  $("#edit_form_section #location_lon").removeClass("error");
        
        if(location_title == '' || location_lat == '' || location_lon == '')
            alert('{$translate.fill_required_fields}');
        else
            $('#timing').submit();
    }
    function warning_delete_location(index, username){
        if(confirm("{$translate.want_delete}")){
            document.location.href = "{$url_path}customer/locations/"+username+"/"+index+"/delete/";
        }
    }
    var change = 0;
    var confirm_ask = 0;
    function markChange(){
        change = 1;
        $("#new").val("1");
    }

    ///////////////////////////MENU FUNCTIONS///////////////////////////////////

    function redirectConfirm(mode){
        var redirectURL = mode.replace("%%C-UNAME%%", "{$customer_detail.username}");
        if(redirectURL != ''){
            if(change == 1){ 
                $( "#dialog-confirm" ).dialog({
                    resizable: false,
                    height:140,
                    modal: true,
                    buttons: {
                        "{$translate.yes}": function() {
                                $( this ).dialog( "close" );
                                confirm_ask = 1;
                                saveForm();
                            },
                            "{$translate.no}": function() {
                                    $( this ).dialog( "close" );
                                    document.location.href = redirectURL;
                            }
                        }
                });
            }
            else{ 
                document.location.href = redirectURL;
            }
        }
    }

    function backForm() {
        //document.location.href = '{$url_path}list/customer/{if $customer_detail.status == '0'}inact{else}act{/if}/';
        window.history.back();
    }
</script>
<script>
    function addMapPicker() {
        var mapCenter = [{$STATIC_MAP_LOCATION_LAT}, {$STATIC_MAP_LOCATION_LON}];
        var map = L.map('map-block', { center : mapCenter, zoom : 6 });
        // L.tileLayer('https://{ s}.tiles.mapbox.com/v3/{ id}/{ z}/{ x}/{ y}.png', {
        L.tileLayer('https://{ s}.tile.openstreetmap.org/{ z}/{ x}/{ y}.png', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
            id: 'examples.map-i875mjb7',
            noWrap : true
        }).addTo(map);
        
        var marker = L.marker(mapCenter).addTo(map);
        // var bingGeocoder = new L.Control.BingGeocoder('AsaKzgbo2GW8wrcv0mLCyVvEx2Q8V1N54Gpmizw-fzHIKOAjAMMy4TdNfKdS71vs', { text: '{$translate.locate}'});
        // map.addControl(bingGeocoder);

        var GeoSearchControl = window.GeoSearch.GeoSearchControl;
        var OpenStreetMapProvider = window.GeoSearch.OpenStreetMapProvider;
        // remaining is the same as in the docs, accept for the var instead of const declarations
        var provider = new OpenStreetMapProvider();
        var searchControl = new GeoSearchControl({
            provider: provider,
            style: 'bar',
            showMarker: false,
            retainZoomLevel: false,
            animateZoom: true,
            autoClose: true,
        }).addTo(map);
        // map.addControl(searchControl);

        // searchControl.getContainer().onclick = e => { console.log('hello'); e.stopPropagation(); };

        $('.leaflet-control-geosearch form').click(function(e){
            e.stopPropagation();
        });
        var updateMarker = function(lat, lng) {
            marker
                .setLatLng([lat, lng])
                .bindPopup("{$translate.your_location} :  " + marker.getLatLng().toString())
                .openPopup();
            map.invalidateSize();   //<-- Made by Shamsu
            return false;
        };
        map.on('click', function(e) {
            $('#location_lat').val(e.latlng.lat);
            $('#location_lon').val(e.latlng.lng);
            updateMarker(e.latlng.lat, e.latlng.lng);
        });

        map.on('geosearch/showlocation', function(e) {
            $('#location_lat').val(e.location.y);
            $('#location_lon').val(e.location.x);
            updateMarker(e.location.y, e.location.x);
        });
            
        var updateMarkerByInputs = function() {
            return updateMarker( $('#location_lat').val() , $('#location_lon').val());
        }
        $('#location_lat').on('input', updateMarkerByInputs);
        $('#location_lon').on('input', updateMarkerByInputs);
    }
        
    $(document).ready(function() {
        addMapPicker();
    });
</script>

<script type="text/javascript" src="{$url_path}js/jquery.stickyPanel.js"></script>
<script>
	$(document).ready(function() {
            var stickyPanelOptions = {
                topPadding: 3,
                afterDetachCSSClass: "stickyPanelDetached",
                savePanelSpace: true,
                parentSelector: '#stickyPanelParent'
            };
            
            $("#btnGroupStickyPanel").stickyPanel(stickyPanelOptions);
        });
</script>
{/block}

{block name="content"}
<div class="row-fluid">
    <div class="span12 main-left">
        <div id="left_message_wraper" class="span12 no-min-height no-ml">{$message}</div>
        <div style="margin: 15px 0px 0px;" class="widget-header span12">
            <div class="day-slot-wrpr-header-left pull-left">
                <h1 style="margin: 5px ! important;">{$translate.customer}</h1>
            </div>
        </div>
        <div class="span12 widget-body-section input-group">
            <div class="widget option-panel-widget input-group input-group" style="margin: 0px ! important;">
                {if !empty($customer_detail)}
                    <div class="widget-body" style="padding:4px;">
                        <div class="row-fluid">
                            <div class="span4 top-customer-info"><strong>{$translate.social_security} : </strong>{$customer_detail.social_security}</div>
                            <div class="span4 top-customer-info"><strong>{$translate.customer_code} : </strong>{$customer_detail.code}</div>
                            <div class="span4 top-customer-info"><strong>{$translate.name} : </strong> {if $sort_by_name == 1}{$customer_detail.first_name|cat: ' '|cat: $customer_detail.last_name}{elseif $sort_by_name == 2}{$customer_detail.last_name|cat: ' '|cat: $customer_detail.first_name}{/if}</div>
                        </div>
                    </div>
                {/if}
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="tab-content-switch-con">
                        {block name="customer_manage_tab_content"}{/block}
                        <div class="widget-header widget-header-options tab-option">
                            <div class="span4 day-slot-wrpr-header-left span3">
                                <h1 style="">{$translate.map_location}</h1>
                            </div>
                            <div class="pull-right day-slot-wrpr-header-left span9" style="padding: 5px;">
                                <button class="btn btn-default btn-normal pull-right ml" onclick="backForm()" type="button"><span class="icon-arrow-left"></span> {$translate.back}</button>
                                <button class="btn btn-default btn-normal pull-right btn-addnew-inconvtiming" type="button"><span class="icon-plus" ></span> {$translate.add_new}</button>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="tab-content-con boxscroll">
                        <div class="tab-content span12" style="margin:0;">
                            <div role="tabpanel" class="tab-pane active" id="11">
                                <div style="margin: 20px 0px 0px;" class="widget">
                                    <div class="span12 widget-body-section input-group">
                                        <div class="table-responsive">
                                            <table id="inconv_table" class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" style="margin: 0px; top: 0px;">
                                                <thead>
                                                    <tr>
                                                        <th class="table-col-center" style="width:20px">#</th>
                                                        <th style="width: 100px;">{utf8_encode($translate.location_name)}</th>
                                                        <th>{$translate.map_location_lat}</th>
                                                        <th>{$translate.map_location_lon}</th>
                                                        <th style="width:124px;">{$translate.is_default}</th>
                                                        <th style="width:124px;">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                {assign i 0}
                                                {foreach from=$map_locations item=list}
                                                    {assign i $i+1}
                                                    <tbody>
                                                        <tr class="gradeX this-row" data-index="{$i-1}">
                                                            <td style="width: 20px;" class="center">{$i}</td>
                                                            <td class="text-left">{$list.title}</td>
                                                            <td class="text-left">{$list.lat}</td>
                                                            <td class="text-left">{$list.lon}</td>
                                                            <td class="text-left">{if $list.is_default}{$translate.yes}{else}{$translate.no}{/if}</td>
                                                            <td class="center" style="width: 130px;">
                                                                <button type="button" class="btn btn-default btn_edit" title="{$translate.edit}"><span class="icon-wrench"></span></button>
                                                                <button type="button" class="btn btn-default btn_delete" title="{$translate.delete}" onclick="warning_delete_location({$i-1},'{$customer_detail.username}');"><span class="icon-trash"></span></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                {foreachelse}
                                                    <tbody>
                                                        <tr class="gradeX">
                                                            <td class="text-center" colspan="6">
                                                                <div class="alert alert-info no-ml no-mr">
                                                                    <strong><i class="icon-info-sign icon-large"></i> {$translate.message_caption_information}</strong>:  {$translate.no_location_found}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                {/foreach}
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
    <div style="display: block;  margin-top: 5px;margin-left: 5px;" class="span4 main-right" id="stickyPanelParent">
        <form name="timing" id="timing" method="post">
            <div class="span12 oncall-box" style="margin-left: 0px; display: block;">
                <div style="margin: 0px ! important;" class="widget">
                    <div class="widget-header span12">
                        <h1>{$translate.map_location}</h1>
                        <input type="hidden" name="action" id="hidden_action" value="" />
                        <input type="hidden" name="saved_location_index" id="saved_location_index" value="-1" />
                    </div>
                    <div class="span12 widget-body-section input-group">
                        <div class="row-fluid mb" id="btnGroupStickyPanel">
                            <div class="span12" style="margin: 0px ! important;">
                                <button class="btn btn-success span6" style="text-align: center;" type="button" onclick="validate();"><span class="icon-save"></span> {$translate.save}</button>
                                <button class="btn btn-danger span6 cancel-new-equipment no-ml" style="text-align: center;" type="button"><span class="icon-chevron-left"></span> {$translate.cancel}</button>
                            </div>
                        </div>
                        <div class="row-fluid" id="edit_form_section">
                            <div class="span12 form-left" style="padding: 0px; margin: 0px;">
                                <div style="margin: 6px 0px 0px ! important;" class="span8">
                                    <label style="float: left;" class="span12" for="location_title">{$translate.name}</label>
                                    <div style="margin: 0px;" class="input-prepend  span12">
                                        <span class="add-on icon-pencil"></span>
                                        <input name="location_title" id="location_title" type="text" class="form-control span11" value="{$timing.sal_call_training}" />
                                    </div>
                                </div>
                                <div style="margin: 25px 0px 0px ! important;" class="span4">
                                    <div class="pull-right">
                                        <input type="checkbox" id="is_default_location" class="check mr" name="is_default_location" value="1" style="float: left;margin: 4px 5px 0 0 !important;" />
                                        <label for="is_default_location">{$translate.is_default}</label>
                                    </div>
                                </div>
                                <div style="margin: 10px 0px 0px ! important;" class="span12 hide">
                                    <label style="float: left;" class="span12" for="location_search">{$translate.location}</label>
                                    <div style="margin: 0px;" class="input-prepend span12">
                                        <span class="add-on icon-search"></span>
                                        <input id="location_search" type="text"  class="form-control span11" />
                                    </div>
                                </div>
                                <div style="margin: 6px 0px 0px ! important;" class="span6">
                                    <label style="float: left;" class="span12" for="location_lat">{$translate.map_location_lat}</label>
                                    <div style="margin: 0px;" class="input-prepend span12" >
                                        <span class="add-on icon-map-marker"></span>
                                        <input name="location_lat" class="form-control span11" id="location_lat" type="text" value="{$timing.sal_complementary_oncall}" />
                                    </div>
                                </div>
                                <div style="margin: 6px 0px 0px ! important;" class="span6">
                                    <label style="float: left;" class="span12" for="location_lon">{$translate.map_location_lon}</label>
                                    <div style="margin: 0px;" class="input-prepend span12">
                                        <span class="add-on icon-map-marker"></span>
                                        <input name="location_lon" id="location_lon" type="text"  class="form-control span11" value="{$timing.sal_more_oncall}" />
                                    </div>
                                </div>
                                <div id="map-block" class="span12 no-min-height no-ml" style="height: 370px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                </div>
                <div class="row-fluid">
                    <div class="span12"></div>
                </div>
            </div>
        </form>
    </div>
</div>
{/block}