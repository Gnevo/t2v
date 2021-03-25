{block name='style'}
<style type="text/css">
    .ui-autocomplete{
        z-index: 35 !important;
    }
</style>
    <style>
        .active-pagination{
        background: none repeat scroll 0% 0% #90DDEC;
        color: #FFF;
        font-weight: 600;}
    </style>
{/block}
{block name="script"}
<script src="{$url_path}js/jquery.floatThead.min.js" type="text/javascript" ></script>
<script type="text/javascript">
function select_customer(action,name,page){
var view = $("#search_cust").val();
   if(view == '{$translate.search_customer}' || view == ""){
      $("#temp_search_cust").val('');  
   }
     var search = $("#temp_search_cust").val();
     $("#temp_search_cust").val(name);
   
    $("#search_cust").val('');
   var emp = $("#emp").val();
   
   {*var sort_by = '{$sort_by}';*}
    
    var action = $("#action").val();
    if(search != "" || emp != ""){
            var url1 = encodeURI("{$url_path}ajax_customer_list_page.php?page="+page+"&search="+name+"&emp="+emp+"&action="+action);
            var url2 = encodeURI("{$url_path}ajax_customer_listing.php?page="+page+"&search="+name+"&emp="+emp+"&action="+action);
            $(".pagination").load(url1);
            $("#table_val").load(url2);
        
    }else{
        //document.location.href = '{$url_path}list/customer/'+action+'/'+name+'/'+(sort_by != '' ? sort_by+'/' : '');
        document.location.href = '{$url_path}list/customer/'+action+'/'+name+'/';
    }
}
    
    $(document).ready(function(){
    
    var $table_scroll = $('#header-fixed');
        $table_scroll.floatThead({
                 scrollContainer: function($table_scroll){
                        return $table_scroll.closest('.fixed-scrolling-tbl');
                        
                }
        });
        
    if($(window).height() > 600){
        //alert($(window).height()-148);
        $('#table_val').css({ height: $(window).height()-238}); }
    else
        $('#table_val').css({ height: $(window).height()});
        
    $("#search_cust").click(function(){
        var fix = $("#search_cust").val();
        if(fix == "{$translate.search_customer}"){
           $("#search_cust").val('');
        }
        
    });
   $("#search_cust").blur(function(){
       
        var fix = $("#search_cust").val();
        if(fix == ""){
           $("#search_cust").val('{$translate.search_customer}');
           paginateDisplay('1');
        }
    });
    $("#search_emp").click(function(){
        var fix = $("#search_emp").val();
        if(fix == "{$translate.search_employee}"){
           $("#search_emp").val('');
           
        }
        
    });
   $("#search_emp").blur(function(){
        var fix = $("#search_emp").val();
        if(fix == ""){
           $("#search_emp").val('{$translate.search_employee}');
           paginateDisplay('1');
        }
    });
    
    $( "#search_cust" ).autocomplete({
        source: {$json_customers},
        select: function( event, ui ) {
             this.value = ui.item.value;
             $("#temp_search_cust").val(this.value);
             paginateDisplay('1');
        }
    });
    $( "#search_emp" ).autocomplete({
        source: {$json_employees},
        select: function( event, ui ) {
             this.value = ui.item.value;
             $("#emp").val(this.value);
             paginateDisplay('1');
        }
    });
    $("input:radio[name=active]").click(function() { 
        var value = $(this).val();
        window.location.href = '{$url_path}list/customer/'+value+'/';
    });
    
    $.extend( $.ui.autocomplete, {
        escapeRegex: function( value ) {
            return value.replace(/[-[\]{ldelim}{rdelim}()*+?.,\\^$|#\s]/g, "\\$&");
        },
        escapeRegexForMobile: function( value ) {
            return value.replace(/\#|\+|\ |\-|\_/g, "").replace(/^0/, '');
        },
        filter: function(array, term) {
            var matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
            var matcherMobile = new RegExp( $.ui.autocomplete.escapeRegexForMobile(term), "i" );
            return $.grep( array, function(value) {
                return (matcher.test( value.label ) || matcher.test(value.uname) || matcher.test(value.code) || matcher.test(value.ssn) || matcher.test(value.mobile) || matcherMobile.test(value.mobile) || matcher.test(value.email));
            });
        }
    });
    
});

function paginateDisplay(page){
    var view =$("#search_cust").val();
    var view1 =$("#search_emp").val();

    if(view == '{$translate.search_customer}'  || view == ""){
      $("#temp_search_cust").val('');  
   }
   if(view1 == '{$translate.search_employee}'  || view1 == ""){
      $("#emp").val('');  
   }
   
   var sort_by = '{$sort_by}';
   
   var search = $("#temp_search_cust").val();
   var emp = $("#emp").val();
   var action = $("#action").val();
   if(search.lenght == 1){
        select_employee(action,search,page);
   }else{
        //if(search != "" || emp != ""){
             var urls = encodeURI("{$url_path}ajax_customer_list_page.php?page="+page+"&search="+search+"&emp="+emp+"&action="+action+ "&sort_by=" + sort_by);
             $(".pagination").load(urls);
             loadEmployee(page);
       /*  }else{
             window.location.href = '{$url_path}list/customer/'+action+'/';
         }*/
    }   
   
}

function loadEmployee(page){
    var view =$("#search_cust").val();
    if(view == '{$translate.search_customer}' || view == ""){
      $("#temp_search_cust").val('');  
   }
    var search = $("#temp_search_cust").val();
    var emp = $("#emp").val();
    var action = $("#action").val();
    
    var sort_direction = $.trim($('#sort_order_direction').val());
    if(sort_direction == '' || sort_direction == 'desc' ){
        $('#sort_order_direction').val('asc');
        sort_direction = 'asc';
    }else{
        $('#sort_order_direction').val('desc');
        sort_direction = 'desc';
    }
    
    var urls = encodeURI("{$url_path}ajax_customer_listing.php?page="+page+"&search="+search+"&emp="+emp+"&action="+action+ "&sort_direction=" + sort_direction);
    //$("#table_val").load(urls);
    $.ajax({
        url: urls,
        success: function(data) {
             $(".floatThead-floatContainer").remove();
            $("#table_val").html(data);
            var $table_scroll = $('#table_val table');

            $table_scroll.floatThead({
                     scrollContainer: function($table_scroll){
                            return $table_scroll.closest('.fixed-scrolling-tbl');

                    }
            });
        }
    });
}

function sortBy(sort_by) {
    var view = $("#search_cust").val();
    if(view == '{$translate.search_customer}' || view == ""){
       $("#temp_search_cust").val('');  
    }
   
    var name = '{$page_letter}';
    var search = $("#temp_search_cust").val();
    $("#temp_search_cust").val(name);
   
    $("#search_cust").val('');
    var emp = $("#emp").val();
    
    var sort_direction = $.trim($('#sort_order_direction').val());
    if(sort_direction == '' || sort_direction == 'desc' ){
        $('#sort_order_direction').val('asc');
        sort_direction = 'asc';
    }else{
        $('#sort_order_direction').val('desc');
        sort_direction = 'desc';
    }
    
    var action = $("#action").val();
    if(search != "" || emp != ""){
            var url1 = encodeURI("{$url_path}ajax_customer_list_page.php?page=1&search="+name+"&emp="+emp+"&action="+action+ "&sort_by=" + sort_by);
            var url2 = encodeURI("{$url_path}ajax_customer_listing.php?page=1&search="+name+"&emp="+emp+"&action="+action+ "&sort_by=" + sort_by+ "&sort_direction=" + sort_direction);
            $(".pagination").load(url1);
            $("#table_val").load(url2);
        
    }else{
        document.location.href = '{$url_path}list/customer/'+action+'/'+name+'/'+sort_by+'/'+sort_direction+'/';
    }
}

function add_new_btn(){
    document.location.href = '{$url_path}customer/add/';
}
function back_btn(){ 
    document.location.href = '{$url_path}list/customer/{$action}/';
}
function edit_btn(custname){
    document.location.href = '{$url_path}customer/add/'+custname+'/';
}

</script>
{/block}
{block name="content"}


    <div class="row-fluid">
        <div class="span12 main-left" style="overflow-y: hidden">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1>{$translate.customers}({$customer_count} &nbsp;{if $action == "inact"}{$translate.inactive}{else}{$translate.active}{/if})</h1>
                </div>
            </div>


            <!--OPTION PANEL BEGIN--><div class="span12 widget-body-section input-group">
                <div class="widget-body" style="padding:5px;">


                    <div class="row-fluid">
                        <div class="span12 widget-body-section input-group" style="position: relative">
                            <form id="form_list" name="form_list" method="post" action="{$url_path}list/employee/{$action}/">
                                <div class="pull-left" style="margin: 0px ! important; padding: 0px;">

                                    <label class="span12" style="float: left;" for="search_emp">{$translate.search_customer}</label>
                                    <div style="margin: 0px; float:left;" class="input-prepend span10"> <span class="add-on icon icon-search"></span>
                                        <input  class="form-control span12 text-box" type="text" name="search_cust" id="search_cust" value="{$translate.search_customer}">
                                    </div>



                                    <input type="hidden" name="temp_search_cust" id="temp_search_cust" />
                                    <input type="hidden" name="action" id="action" value="{$action}" />
                                    <input type="hidden" name="emp" id="emp" value="" />
                                    <label for="inactive"></label>
                                </div>

                                <div class="pull-left">
                                    <label class="span12" style="float: left;" for="search_emp">{$translate.search_employee}</label>
                                    <div style="margin: 0px; float:left;" class="input-prepend span10"> <span class="add-on icon icon-search"></span>
                                        <input  class="form-control span12 text-box" type="text" name="search_emp" id="search_emp" value="{$translate.search_employee}">
                                    </div>
                                </div>

                                <div class="pull-left" style="padding-top: 20px;">
                                    <ol class="radio-group">
                                        <li><input type="radio" name="active" id="active" value="act" {if $action eq "act"}checked=checked {/if} class="radio"/>
                                            <label class="radio label-option-and-checkbox">{$translate.active} </label></li>

                                        <li>  
                                            <input type="radio" name="active" id="inactive" value="inact" {if $action eq "inact"}checked=checked {/if} class="radio"/>
                                            <label class="radio label-option-and-checkbox">{$translate.inactive}</label></li>
                                    </ol>
                                </div> 
                                <div class="pull-right" style="padding-top: 15px;">
                                    {if $privileges_general.add_customer}
                                        <button type="button" class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft"  onclick="add_new_btn()"><span class="icon-plus"></span> {$translate.add_new}</button>
                                    {/if}

                                    <button type="button" class="btn btn-default btn-margin-set btn-option-panel pull-right" onclick="back_btn()"><span class="icon-arrow-left"></span> {$translate.backs}</button>
                                </div>

                        </div>
                        </form>

                    </div>
                </div><!--OPTION PANEL END-->

                <div class="clearfix"></div>

                <!--TABLE BEGIN-->
                <div class="row-fluid" style="margin-top:10px; position: relative">
                    <input type="hidden" id="sort_order_direction" value="{$sort_direction}" />
                    <div class="widget-body span12 no-ml">
                        <div class="row-fluid">
                            <div class="pull-left">
                                <div class="pagination pagination-mini margin-none">
                                    <ul>
                                        {assign var='alphabets' value=','|explode:$translate.alphabets}    
                                        {foreach from=$alphabets item=row}    
                                            <li {if $page_letter==$row}class="active"{/if}><a href="javascript:void(0)" onclick="select_customer('{$action}','{$row}','1')">{$row}</a></li>
                                            {/foreach}
                                    </ul>
                                </div>
                            </div>

                            <div class="pull-right">
                                <div class="pagination pagination-mini pagination-right pagin margin-none">
                                    <div class="pagination" style=" margin: 0px;"><ul>{$pagination}</ul></div>
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="row-fluid">
                        <div class="table-responsive fixed-scrolling-tbl" id="table_val">
                            <table class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" id="header-fixed">
                                <thead>
                                    <tr>
                                        <th>{$translate.name}</th>
                                        <th><a href="javascript:void(0);" onclick="sortBy('CC');" style="text-decoration: underline" title="{$translate.sort_by_code}">{$translate.code}</a></th>
                                        <th>{$translate.social_security}</th>
                                        <th>{$translate.username}</th>
                                        <th>{$translate.mobile}</th>
                                        <th>{$translate.city}</th>
                                        {if $action == 'inact'}
                                            <th>{$translate.inactive_date}</th>
                                        {/if}
                                        <th class="table-col-center small-col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {foreach from=$customer_list item=customer}
                                        <tr class="gradeX" onclick="edit_btn('{$customer.username}')" style="cursor: pointer;">
                                            <td class="large-col">
                                                {*if $customer.ch == 1 && !empty($customer.company)}
                                                    {$customer.company.name}
                                                {else*}
                                                    {if $sort_by_name == 1}
                                                        {$customer.first_name} {$customer.last_name}
                                                    {elseif $sort_by_name == 2}
                                                        {$customer.last_name} {$customer.first_name}
                                                    {/if}
                                                {*/if*}</td>
                                            <td>{$customer.code}</td>
                                            <td>{$customer.social_security}</td>
                                            <td>{$customer.username}</td>
                                            <td>{if $customer.mobile == ""}----{else}{$customer.mobile}{/if} </td>
                                            <td>{$customer.city}</td>
                                            {if $action == 'inact'}
                                            <td>{$customer.date_inactive}</td>
                                            {/if}
                                            <td class="table-col-center small-col"><button type="button" onclick="edit_btn('{$customer.username}')" class="btn btn-default" title="{$translate.edit}"><span class="icon-wrench"></span></button></td>
                                        </tr>
                                    {foreachelse}
                                        <tr><td colspan="7">
                                                <div class="message">{$translate.no_data_available}</div>
                                            </td></tr>
                                        {/foreach}

                                    <!-- // Table row END -->
                                </tbody>
                                <!-- // Table body END -->
                            </table>
                        </div>
                        </div>
                        <!-- // Table END -->
                    </div>
                </div><!--TABLE END-->



            </div>
        </div>





    </div>
{/block}
