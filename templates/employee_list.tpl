{block name='style'}
<style type="text/css">

    .ui-autocomplete{
        z-index: 35 !important;
    }
    .btn-help{
                    margin: 5px;
                    cursor: pointer;}
    /*{block name="style_check_list"} {/block}*/
</style>
{/block}

{block name='script'}
    <script src="{$url_path}js/jquery.floatThead.min.js" type="text/javascript" ></script>
    <script type="text/javascript" src="{$url_path}js/bootbox.js"></script>
    <!-- {block name="script_check_list"} {/block} -->
    <script type="text/javascript">
        //     $( ".inner" ).draggable();
            
        // $( function() {
        //     $( ".main-list" ).sortable();
        //     $( ".main-list" ).disableSelection();
        //   } );
        // var after_sort_id     = [];
        // $( ".main-list" ).sortable({
        //     // change: function(e, ui) {
        //     //     before_sort_order = [];
        //     //     $("#checklist_list li").not('.additem-list').each(function( index ) {

        //     //       if($(this).data('sortable') != undefined){
        //     //          before_sort_order.push($(this).data('sortable'));
        //     //       }
        //     //     });
        //     // },
        //     update: function( event, ui ) {
        //         after_sort_id     = [];
        //          $("#checklist_list li").not('.additem-list').each(function( index ) {
        //           after_sort_id.push($(this).data('id'));
        //         });
        //         // console.log(before_sort_order,after_sort_id); 
        //         dataObj = {
        //             // before_sort_order : before_sort_order,
        //             after_sort_id     : after_sort_id,
        //             action            : 'changing_sort_order'
        //         }
        //         $.ajax({
        //             method  : 'post',
        //             url     : '{$url_path}ajax_employee_checklist.php',
        //             data    : dataObj,
        //             success : function(data){
        //                 data = JSON.parse(data);
        //                 // console.log(data);
        //                 // for (var key in data) {
        //                 //     $('#cheklist_'+key).attr('data-sortable',data[key]);
        //                 // }

        //             }
        //         });
        //     // console.log(ui.item.index());
        //     // var oldIndex = ui.item.sortable.index;
        //     // var newIndex = ui.item.index();
        //     // console.log(oldIndex,newIndex);
        //   }
        // });
        function showHelp(e){
            window.open('{$url_path}employee/checklist/',' ','width=800,height=600,top=50,left=200');
            // $('.help').removeClass('hide');
        }

        function select_employee(action, name, page) {
            $("#search_alph").val(name);
            var view = $("#search_emp").val();
            var sort_by = $("#sort_by").val();
            if (view == '{$translate.search_employee}' || view == "") { 
                $("#temp_search_emp").val('');
            }
            var search = $("#temp_search_emp").val();
            $("#temp_search_emp").val(name);

            $("#search_emp").val('');
            var cust = $("#cust").val();

            var action = $("#action").val();
            if (search != "" || cust != "") {

                var url1 = encodeURI("{$url_path}ajax_employee_list_page.php?page=" + page + "&search=" + name + "&cust=" + cust + "&action=" + action);
                var url2 = encodeURI("{$url_path}ajax_employee_listing.php?page=" + page + "&search=" + name + "&cust=" + cust + "&action=" + action + "&sort_by=" + sort_by);
                $("#pagination").load(url1);
                $("#table_val").load(url2);

            } else {
                window.location.href = '{$url_path}list/employee/' + action + '/' + name + '/';
            }
        }


        $(document).ready(function () {
        
            var $table_scroll = $('#header-fixed');
            $table_scroll.floatThead({
                     scrollContainer: function($table_scroll){
                            return $table_scroll.closest('.fixed-scrolling-tbl');

                    }
            });
        
        if($(window).height() > 600)
            $('#table_val').css({ height: $(window).height()-238});
        else
            $('#table_val').css({ height: $(window).height()});
        
            $("#search_emp").click(function () {
                var fix = $("#search_emp").val();
                if (fix == "{$translate.search_employee}") {
                    $("#search_emp").val('');
                }

            });
            $("#search_emp").blur(function () {
                var fix = $("#search_emp").val();
                if (fix == "") {
                    $("#search_emp").val('{$translate.search_employee}');
                    $("#search_alph").val('');
                    paginateDisplay('1');
                }
            });
            $("#search_cust").click(function () {
                var fix = $("#search_cust").val();
                if (fix == "{$translate.search_customer}") {
                    $("#search_cust").val('');
                }

            });
            $("#search_cust").blur(function () {
                var fix = $("#search_cust").val();
                if (fix == "") {
                    $("#search_cust").val('{$translate.search_customer}');
                    $("#search_alph").val('');
                    paginateDisplay('1');
                }
            });
            $("#search_emp").autocomplete({
                        
                source: {$json_employees},
                select: function (event, ui) {
                    this.value = ui.item.value;
                   
                    $("#temp_search_emp").val(this.value);
                    paginateDisplay('1');
                }
            });
            $("#search_cust").autocomplete({
                source: {$json_customers},
                select: function (event, ui) {
                    this.value = ui.item.value;
                    $("#cust").val(this.value);
                    paginateDisplay('1');
                }


            });
            $("input:radio[name=active]").click(function () {
                var value = $(this).val();
                window.location.href = '{$url_path}list/employee/' + value + '/';
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
                        /*var temp_format_mobile = value.mobile;
                        temp_format_mobile = temp_format_mobile.replace(/#|\+| |-|_/g, "");
                        temp_format_mobile = temp_format_mobile.replace(/^0/, '');*/
                        return (matcher.test( value.label ) || matcher.test(value.uname) || matcher.test(value.code) || matcher.test(value.ssn) || matcher.test(value.mobile) || matcherMobile.test(value.mobile) || matcher.test(value.email));
                    });
                }
            });
            
        });

        function paginateDisplay(page) {
            
            var view = $("#search_emp").val();
            var view1 = $("#search_cust").val();
            if (view == '{$translate.search_employee}' || view == "") {
                $("#temp_search_emp").val('');
            }
            if (view1 == '{$translate.search_customer}' || view1 == "") {
                $("#cust").val('');
            }
            var search = $("#temp_search_emp").val();
            if (search == "") {
                search = $("#search_alph").val();
            }
            var cust = $("#cust").val();
            var action = $("#action").val();
            var sort_by = $("#sort_by").val();
            if (search.lenght == 1) {
                select_employee(action, search, page);
            } else {
                //if(search != "" || cust != ""){
                var urls = encodeURI("{$url_path}ajax_employee_list_page.php?page=" + page + "&search=" + search + "&cust=" + cust + "&action=" + action + "&sort_by=" + sort_by);
                $("#pagination").load(urls);
                
                loadEmployee(page);
                
                /* }else{
                 window.location.href = '{$url_path}list/employee/'+action+'/S';
                 }*/
            }

        }

        function loadEmployee(page) {
            var view = $("#search_emp").val();
            if (view == '{$translate.search_employee}' || view == "") {
                $("#temp_search_emp").val('');
            }
            var search = $("#temp_search_emp").val();
            if (search == "") {
                search = $("#search_alph").val();
            }

            var cust = $("#cust").val();
            var action = $("#action").val();
            var sort_by = $("#sort_by").val();
            var sort_direction = $.trim($('#sort_order_direction').val());
            
            var urls = encodeURI("{$url_path}ajax_employee_listing.php?page=" + page + "&search=" + search + "&cust=" + cust + "&action=" + action + "&sort_by=" + sort_by + "&sort_direction=" + sort_direction );
            /*$("#header-fixed").remove();
            $("#table_val").empty();*/
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
            //$("#table_val").load(urls);
            
        }

        function sortBy(sort_val) {
            $("#sort_by").val(sort_val);
            var sort_direction = $.trim($('#sort_order_direction').val());
            if(sort_direction == '' || sort_direction == 'desc' )
                $('#sort_order_direction').val('asc');
            else
                $('#sort_order_direction').val('desc');
            paginateDisplay('1');
        }

        



    </script>
{/block}

{block name="content"}

    <!-- {block name="employee_check_list"} {/block} -->
    <div class="row-fluid">
        <div class="span12 main-left" style="overflow-y: hidden;">

            <div style="margin: 15px 0px 0px ! important;" class="widget">
            	<div class="widget-header span12">
                    <div class="span6">
                        <h1>{$translate.employee} ( {$emp_count} {if $action == "inact"}{$translate.inactive}{else}{$translate.active}{/if} )</h1>
                    </div>
                    <div class="span6">
                        <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft btn-help" onclick="showHelp(this);">{$translate.employee_checklist}</a>
                    </div>
                </div>
            </div>
            
            <!--OPTION PANEL BEGIN-->
            <div class="span12 widget-body-section input-group">
                <div class="widget-body" style="padding:5px;">
                    <div class="row-fluid">
                        <div class="span12 widget-body-section input-group" style="position: relative;">
                            <form id="form_list" name="form_list" method="post" action="{$url_path}list/employee/{$action}/">
                                <input type="hidden" name="temp_search_emp" id="temp_search_emp" />
                                <input type="hidden" name="action" id="action" value="{$action}" />
                                <input type="hidden" name="cust" id="cust" value="" />
                                <input type="hidden" name="sort_by" id="sort_by" value="{$sort_by}" />
                                <input type="hidden" name="search_alph" id="search_alph" value="{$search_alph}" />
                                <div class="pull-left" style="margin: 0px ! important; padding: 0px;">
                                    <label class="span12" style="float: left;" for="search_emp">{$translate.search_employee}</label>
                                    <div style="margin: 0px; float:left;" class="input-prepend span10"> <span class="add-on icon icon-search"></span>
                                        <input class="form-control span12" placeholder="{$translate.search_employee}" name="search_emp" id="search_emp" type="text" /> 
                                    </div>

                                </div>
                                <div class="pull-left">
                                    <label class="span12" style="float: left;" for="search_cust">{$translate.search_customer}</label>
                                    <div style="margin: 0px; float:left;" class="input-prepend span10"> <span class="add-on icon icon-search"></span>
                                        <input class="form-control span12" placeholder="{$translate.search_customer}" name="search_cust" id="search_cust" type="text"> 
                                    </div>
                                </div>
                                <div class="pull-left" style="padding-top: 20px;">
                                    <ol class="radio-group">
                                        <li>
                                            <input name="active" value="act" id="active" {if $action == "act"}checked=checked {/if} title="{$translate.active_employees}"  type="radio">
                                            <label class="label-option-and-checkbox">{$translate.active}  </label>
                                        </li>
                                        <li>  <input name="active" value="inact" id="ssn" {if $action == "inact"}checked=checked {/if} title="{$translate.inactive_employees}"  type="radio"><label class="label-option-and-checkbox">{$translate.inactive}</label>
                                        </li>
                                    </ol>
                                </div>



                                <div class="pull-right" style="padding-top: 15px;">
                                    <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft" style="text-align: center;" href="{$url_path}list/employee/{$action}/"><span class="icon-arrow-left"></span> {$translate.backs}</a>
                                    {if $privileges_general.add_employee}
                                        <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft" style="text-align: center;" href="{$url_path}employee/add/" class="add"><span class="icon-plus"></span> {$translate.add_new_employee}</a>
                                    {/if}
                                </div>
                        
                        </form>
                        </div>
                    </div>
                </div>
                                <div class="clearfix"></div>
                                <div class="row-fluid" style="position: relative;">
                    
                                <!--WIDGET BODY BEGIN-->
                                <div class="widget-body span12 no-ml">
                                    
                                    <div class="row-fluid">
                                        <div class="pull-left">
                                            <div class="pagination pagination-mini margin-none">
                                                <ul class="alphbts">
                                                    {assign var='alphabets' value=','|explode:$translate.alphabets}
                                                    {foreach from=$alphabets item=row}
                                                        <li><a href="javascript:void(0)" onclick="select_employee('{$action}', '{$row}', '1')">{$row}</a></li>
                                                        {/foreach}
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="pull-right">
                                            <div class="pagination pagination-mini pagination-right pagin margin-none">
                                                {if $count>1}
                                                    <ul id="pagination">
                                                        <li><a  class="active" href="javascript:void(0)" onclick="paginateDisplay('{$page}')">{$page}</a></li>
                                                        <li><a href="javascript:void(0)" onclick="paginateDisplay('{$page+1}')">{$page+1}</a></li>
                                                        <li><a class="nxt" href="javascript:void(0)" onclick="paginateDisplay('{$page+1}')">&gt;</a></li>
                                                        <li><a href="javascript:void(0)" onclick="paginateDisplay('{$count}')">&gt;&gt;</a></li>
                                                    </ul>
                                                {/if}
                                            </div>
                                        </div>
                                        </div>
                                            <input type="hidden" id="sort_order_direction" value="" />
                                        <div class="row-fluid">
                                            
                                            <div id="table_val" class="table-responsive fixed-scrolling-tbl">
                                                <table class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda recruitment-table"  id="header-fixed">
                                                    <thead>
                                                        <tr>
                                                            <th><a href="javascript:void(0);" onclick="sortBy('n')" style="text-decoration: underline" title="{$translate.sort_by_name}">{$translate.name}</a></th>
                                                            <th><a href="javascript:void(0);" onclick="sortBy('ec')" style="text-decoration: underline" title="{$translate.sort_by_code}">{$translate.code}</a></th>
                                                            <th>{$translate.social_security}</th>
                                                            <th>{$translate.signature}</th>
                                                            <th>
                                                            {if $action == 'act'}
                                                            <a href="javascript:void(0);" onclick="sortBy('lg')" style="text-decoration: underline" title="{$translate.sort_by_login}">{$translate.loggedin} ({$count_log})</a>
                                                            {else if $action == 'inact'}
                                                                {$translate.inactive_date}
                                                            {/if}
                                                            </th>
                                                            <th><a href="javascript:void(0);" onclick="sortBy('r')" style="text-decoration: underline" title="{$translate.sort_by_role}">{$translate.role}</a></th>
                                                            <th><a href="javascript:void(0);" onclick="sortBy('el')" style="text-decoration: underline" title="{$translate.sort_by_error_login}">{$translate.error_login}</a></th>
                                                            <th>{$translate.mobile}</th>
                                                            <th class="table-col-center small-col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
{*                                                        {$i=0}*}
                                                        {foreach from=$employee_list item=employee}
{*                                                            {$i = $i+1}*}
                                                            <tr class="gradeX" onclick="document.location = '{$url_path}employee/add/{$employee.username}/';" style="cursor: pointer;">
                                                                {if $sort_by_name == 1}
                                                                    <td class="large-col">{$employee.first_name} {$employee.last_name}</td> 
                                                                {elseif $sort_by_name == 2}
                                                                    <td class="large-col">{$employee.last_name} {$employee.first_name}</td>
                                                                {/if}
                                                                <td>{$employee.code}</td>
                                                                <td>{$employee.social_security}</td>
                                                                <td>{$employee.username}</td>
                                                                <td>
                                                                    {if $action == 'act'}
                                                                    {if $employee.login == 1}{$translate.yes}{/if}
                                                                    {else if $action == 'inact'}
                                                                    {$employee.date_inactive}
                                                                    {/if}
                                                                </td>
                                                                <td>{if $employee.role == 1}{$translate.admin}{elseif $employee.role == 2}{$translate.tl}{elseif $employee.role == 3}{$translate.employee}{elseif $employee.role == 5}{$translate.trainee}{elseif $employee.role == 6}{$translate.economy}{elseif $employee.role == 7}{$translate.super_tl}{/if}</td>
                                                                <td>{$employee.error_login}</td>
                                                                <td>{$employee.mobile}</td>
                                                                <td class="table-col-center small-col"><a href="{$url_path}employee/add/{$employee.username}/" class="btn btn-default"><i class="icon-wrench"></i></a></td>
                                                            </tr>
                                                            {*{if $i==8}
                                                            {break}
                                                            {/if}*}
                                                        {foreachelse}
                                                            <tr><td colspan="8">
                                                                    <div class="message">{$translate.no_data_available}</div>
                                                                </td>
                                                            </tr>
                                                        {/foreach}
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    
                               
                           
                        </div>
                    
            </div>
            </div>
                                                    
        </div>
    </div>
{/block}


