 
{block name="script"}
    <script src="{$url_path}js/jquery.ui.datepicker.js" type="text/javascript" ></script>
    <script src="{$url_path}js/rperofemployement.js" type="text/javascript" ></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $("#frmdate, #todate").datepicker({
                    showOn: "button",
                    buttonImage: "{$url_path}images/date_pic.gif",
                    buttonImageOnly: true
            });
            var availableTags = [
                {foreach from=$employeeslist item=employee}
                    {if $sort_by_name == 1}
                            {
                                value: "{$employee.username}",
                                label: "{$employee.first_name} {$employee.last_name}"
                            },
                    {elseif $sort_by_name == 2}
                            {
                                value: "{$employee.username}",
                                label: "{$employee.last_name} {$employee.first_name}"
                            },
                    {/if}
                {/foreach}
            ];
            $("#emp").autocomplete({
                    minLength: 0,
                    source: availableTags,
                    focus: function(event, ui) {
                        $("#emp").val(ui.item.label);
                        return false;
                    },
                    select: function(event, ui) {
                        $("#emp").val(ui.item.label);
                        $("#employee-id").val(ui.item.value);
                        return false;
                    }
            }).data("autocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                    .data("item.autocomplete", item)
                    .append("<a>" + item.label + "</a>")
                    .appendTo(ul);
            };
            var availableCustomers = [
                {foreach from=$search_customers item=customer}  
                        {if $sort_by_name == 1}
                            {
                            value: "{$customer.username}",
                            label: "{$customer.first_name} {$customer.last_name}"
                            },
                        {elseif $sort_by_name == 2}
                            {
                            value: "{$customer.username}",
                            label: "{$customer.last_name} {$customer.first_name}"
                            },
                        {/if}
                {/foreach}
            ];
            $( "#txt_customer" ).autocomplete({
                minLength: 0,
                source: availableCustomers,
                focus: function( event, ui ) {
                    $( "#txt_customer" ).val( ui.item.label );
                    return false;
                },
                select: function( event, ui ) {
                    $( "#txt_customer" ).val( ui.item.label );
                    $( "#customer-id" ).val( ui.item.value );
                    return false;
                }
            })
            .data( "autocomplete" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                    .data( "item.autocomplete", item )
                    .append( "<a>" + item.label + "</a>" )
                    .appendTo( ul );
            };
        
            $('#search_type_div').delegate('.search_type', 'change', function () {
                    var search_type_rd = $("#search_type_div input[type='radio'][name='search_type']:checked");
                    if (search_type_rd.length > 0)
                        search_type = search_type_rd.val();

                    if(search_type == 1){   {*customer*}
                        $('.search_type_customer_div').css('display', 'block');
                        $('.search_type_employee_div').css('display', 'none');
                        $('#txt_customer').focus();
                    }else if(search_type == 2){ {*employee*}
                        $('.search_type_employee_div').css('display', 'block');
                        $('.search_type_customer_div').css('display', 'none');
                        $('#emp').focus();
                    }
            });
        });
    </script>
{/block}
{block name="style"}
    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
    <style>
        .ui-autocomplete {
            max-height: 200px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
        }
        * html .ui-autocomplete {
            height: 200px;
        }
        #frmdate, #todate { width: 90px; }
        .search_types { margin-top: 12px; }
        /*.search_selected { margin-top: 5px; }*/
        .customer_block, .employ_block, .selected_textfiled, .unsigned_rb_div { float: left; margin-right: 8px; }
        .padd_column { padding-left: 8px !important; }
        .txt_align_center { text-align: center; }
        #search_type_div { float: left; }
        .sort_by_field { text-decoration: underline; cursor: pointer; }
    </style>
{/block}
{block name="content"}
    <div class="row-fluid">
    <div class="span12 main-left">
    <div class="tbl_hd"><span class="titles_tab">{$translate.percentage_of_employment_report}</span>
        <a href="{$url_path}reports/" class="back">{$translate.backs}</a>
    </div>

    <div id="tble_list">
        <table class="table_list">
            <div class="option_strip">
                <div style="color:red; display:none;" align="center" id="errormsg" >{$translate.todate_greaterthan_fromdate_error}</div>
                <form id="frm_percentage" name="frm_percentage" method="post" style="margin-top: 5px;">
                    {*{$translate.employee} <input type="text" name="emp" id="emp" maxlength="150"  autocomplete="off" aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" />
                    <input id="employee-id" value="" type="hidden">*}
                    <input type="hidden" name="url" id="url" value="{$url_path}" />
                    <input type="hidden" id="hdn_alpha" name="hdn_alpha" value="" />
                    <span id="suggest"></span>
                    
                    <div class="search_selected"  id="search_type_div" style="margin-right: 5px;">
                        <div class="clearfix" style="padding-top: 3px; float: left;">
                            <div class="customer_block">
                                <label>
                                    <p style="float: left;margin-right: 3px;"><input type="radio" id="search_type_customer" name="search_type" class="search_type" value="1" /></p>
                                    <p style="float: left; margin: 4px 0 10px">{$translate.customer}</p>
                                </label>
                            </div>
                            <div class="selected_textfiled search_type_customer_div" style="display: none;">
                                <input type="text" id="txt_customer" name="txt_customer" value="" placeholder="{$translate.select_customer}"/>
                                <input type="hidden" id="customer-id" value=""/>
                            </div>
                            
                            <div class="employ_block">
                                <label>
                                    <p style="float: left;margin-right: 3px;"><input type="radio" checked="checked" id="search_type_employee" name="search_type" class="search_type" value="2" /></p>
                                    <p style="float: left;margin: 4px 0 10px">{$translate.employee}</p>
                                </label>
                            </div>
                            <div  class="selected_textfiled search_type_employee_div">
                                <input type="text" id="emp" name="emp" value="" placeholder="{$translate.select_employee}"/>
                                <input type="hidden" id="employee-id" value=""/>
                            </div>
                        </div>
                    </div>
                        
                    {$translate.from_date} : <input type="text" name="frmdate" id="frmdate" maxlength="11" style="margin-top:5px;"/>
                    {$translate.to_date} : <input type="text" name="todate" id="todate" maxlength="11" style="margin-top:5px;"/>

                    <input type="button" name="submit" value="{$translate.show}" onclick="adddata();" />  

                    <span style=" float:right;">
                        <a href="javascript:void(0);" onclick="pdfdownload();" ><img src="{$url_path}images/pdf-download.gif" height="30" width="30" /></a>
                    </span>

                    <center>  
                        <span style="display:none; position:absolute; left: 700px; top: 214px;" id="loading">
                            <img src="{$url_path}images/sgo-loading.gif"  />
                        </span>
                    </center>
                </form>  
            </div>

            <div id="showdata" >
                <div class="row-fluid">
                <div class="pagention span12">
                    <div class="alphbts span8">
                        <ul>
                            <li><a onclick="select_employee('A')" href="javascript:void(0)">A</a></li>
                            <li><a onclick="select_employee('B')" href="javascript:void(0)">B</a></li>
                            <li><a onclick="select_employee('C')" href="javascript:void(0)">C</a></li>
                            <li><a onclick="select_employee('D')" href="javascript:void(0)">D</a></li>
                            <li><a onclick="select_employee('E')" href="javascript:void(0)">E</a></li>
                            <li><a onclick="select_employee('F')" href="javascript:void(0)">F</a></li>
                            <li><a onclick="select_employee('G')" href="javascript:void(0)">G</a></li>
                            <li><a onclick="select_employee('H')" href="javascript:void(0)">H</a></li>
                            <li><a onclick="select_employee('I')" href="javascript:void(0)">I</a></li>
                            <li><a onclick="select_employee('J')" href="javascript:void(0)">J</a></li>
                            <li><a onclick="select_employee('K')" href="javascript:void(0)">K</a></li>
                            <li><a onclick="select_employee('L')" href="javascript:void(0)">L</a></li>
                            <li><a onclick="select_employee('M')" href="javascript:void(0)">M</a></li>
                            <li><a onclick="select_employee('N')" href="javascript:void(0)">N</a></li>
                            <li><a onclick="select_employee('O')" href="javascript:void(0)">O</a></li>
                            <li><a onclick="select_employee('P')" href="javascript:void(0)">P</a></li>
                            <li><a onclick="select_employee('Q')" href="javascript:void(0)">Q</a></li>
                            <li><a onclick="select_employee('R')" href="javascript:void(0)">R</a></li>
                            <li><a onclick="select_employee('S')" href="javascript:void(0)">S</a></li>
                            <li><a onclick="select_employee('T')" href="javascript:void(0)">T</a></li>
                            <li><a onclick="select_employee('U')" href="javascript:void(0)">U</a></li>
                            <li><a onclick="select_employee('V')" href="javascript:void(0)">V</a></li>
                            <li><a onclick="select_employee('W')" href="javascript:void(0)">W</a></li>
                            <li><a onclick="select_employee('X')" href="javascript:void(0)">X</a></li>
                            <li><a onclick="select_employee('Y')" href="javascript:void(0)">Y</a></li>
                            <li><a onclick="select_employee('Z')" href="javascript:void(0)">Z</a></li>
                            <li><a onclick="select_employee('Å')" id="Å" href="javascript:void(0)">Å</a></li>
                            <li><a onclick="select_employee('Ä')" id="Ä" href="javascript:void(0)">Ä</a></li>
                            <li><a onclick="select_employee('Ö')" id="Ö" href="javascript:void(0)">Ö</a></li>
                        </ul>
                    </div>

                    <div class="pagention_dv span4">
                        <div class="pagination" style="margin:0px;float:right;">
                            <ul id="pagination"></ul>
                        </div>
                    </div>
                </div>
                </div>
            </div>

        </table>
    </div>
    </div>
</div>                            
{/block}