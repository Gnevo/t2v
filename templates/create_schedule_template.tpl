{block name="script"}
    <script src="{$url_path}js/jquery.ui.datepicker.js" type="text/javascript" ></script>
    <script src="{$url_path}js/copy_template.js" type="text/javascript" ></script>
    <script>
        $(document).ready(function() {
            $("#frmdate").datepicker({ldelim}
                showOn: "button",
                buttonImage: "{$url_path}images/date_pic.gif",
                buttonImageOnly: true
        {rdelim});

            $("#todate").datepicker({ldelim}
                showOn: "button",
                buttonImage: "{$url_path}images/date_pic.gif",
                buttonImageOnly: true
        {rdelim});

            $(function() {
                var availableTags = [
        {foreach from=$customerlist item=customer}
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
                                    })
                                            .data("autocomplete")._renderItem = function(ul, item) {
                                        return $("<li>")
                                                .data("item.autocomplete", item)
                                                .append("<a>" + item.label + "</a>")
                                                .appendTo(ul);
                                    };
                                    //        $( "#txt_customer" ).autocomplete({
                                    //            source: availableTags
                                    //        });
                                });
                            });

                            function popup(url)

         {

                 var dialog_box_new = $("#issue_popup");

                 // var value = $("#name_"+id).val();

                 // load remote content

                 dialog_box_new.load(url);

                 // open the dialog

                 dialog_box_new.dialog({
                     title: '{$translate.copy_to_another_customer}',
                     position: 'center',
                     modal: true,
                     resizable: false,
                     minWidth: 350,
                     minHeight: 50

                 });

                 return false;
             }

             function popup_template(url)

         {

                 var dialog_box_new = $("#template_popup");

                 // var value = $("#name_"+id).val();

                 // load remote content

                 dialog_box_new.load(url);

                 // open the dialog

                 dialog_box_new.dialog({
                     title: '{$translate.save_template}',
                     position: 'center',
                     modal: true,
                     resizable: false,
                     minWidth: 400

                 });

                 return false;
             }


             function adddata()
    {
            var emptxt = document.getElementById("emp").value;
            if (emptxt == '') {
                document.getElementById("emp_error").style.display = "block";
                return false;
            } else {
                document.getElementById("emp_error").style.display = "none";
            }
            var emp = document.getElementById("employee-id").value;
            //var emptxt = document.getElementById("emp").value;	
            var frmdate = document.getElementById("frmdate").value;
            var todate = document.getElementById("todate").value;

            var host = document.getElementById("url").value;
            if (frmdate == '')
            {
                        document.getElementById("fromdateerrormsg").style.display = 'block';
                        return false;
                    }
                    else
            {
                        document.getElementById("fromdateerrormsg").style.display = 'none';
                    }

                    if (todate == '')
            {
                        document.getElementById("todateerrormsg").style.display = 'block';
                        return false;
                    }
                    else
            {
                        document.getElementById("todateerrormsg").style.display = 'none';
                    }

                    document.getElementById("loading").style.display = 'block';

                    var url = host + "get/schedule/templates/";

                    if (emp != '')
            {
                        emp = emp.replace(' ', '_');

                        url += emp + "/";
                    }
                    else
            {
                        url += "-/";
                    }
                    if (frmdate != '')
            {
                        url += frmdate + "/";
                    }
                    else
            {
                        url += "0000-00-00/";
                    }
                    if (todate != '')
            {
                        url += todate + "/";
                    }
                    else
            {
                        url += "0000-00-00/";
                    }


                    var xmlhttp;
                    if (window.XMLHttpRequest)
            {
                        xmlhttp = new XMLHttpRequest();
                    }
                    else
            {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange = function()
            {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                                    jQuery("#showdata").html('');
                                    jQuery("#showdata").html(xmlhttp.responseText);
                                    jQuery("#loading").hide();
                                }
                            }

                            xmlhttp.open("GET", url, true);
                            xmlhttp.send();
                            return false;

                        }


                        function Reloadadddata()
    {
            var emp = document.getElementById("employee-id").value;
            var frmdate = document.getElementById("frmdate").value;
            var todate = document.getElementById("todate").value;

            var host = document.getElementById("url").value;


            document.getElementById("loading").style.display = 'block';

            var url = host + "get/schedule/templates/";

            if (emp != '')
            {
                        emp = emp.replace(' ', '_');

                        url += emp + "/";
                    }
                    else
            {
                        url += "-/";
                    }
                    if (frmdate != '')
            {
                        url += frmdate + "/";
                    }
                    else
            {
                        url += "0000-00-00/";
                    }
                    if (todate != '')
            {
                        url += todate + "/";
                    }
                    else
            {
                        url += "0000-00-00/";
                    }


                    var xmlhttp;
                    if (window.XMLHttpRequest)
            {
                        xmlhttp = new XMLHttpRequest();
                    }
                    else
            {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange = function()
            {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                                    jQuery("#showdata").html('');
                                    jQuery("#showdata").html(xmlhttp.responseText);
                                    jQuery("#loading").hide();
                                }
                            }
                            xmlhttp.open("GET", url, true);
                            xmlhttp.send();
                            return false;
                        }

                        function reset_form() {
                            location.reload();
                        }
                        var emp = document.getElementById("employee-id").value;
                        if (emp != '') {
                            Reloadadddata();

                            jQuery(document).ready(function() {
                                setTimeout("jQuery('.success').hide(2000);", 10000);
                            });
                        }
    </script>
{/block}
{block name="content"}

    <div class="clearfix" style="width:400px;" id="issue_popup" style="display:none;"></div>
    <div class="clearfix" style="width:400px;" id="template_popup" style="display:none;"></div>

{if $msg_updated neq ''}{if $msg_updated == 1}<div class="success" >{$translate.template_save_success}</div>{else}{$message}{/if}{/if}
<div class="tbl_hd"><span class="titles_tab">{$translate.create_schedule_template}</span>
    <a href="{$url_path}administration/" class="back">{$translate.backs}</a>
</div>

<div id="tble_list">

    <table class="table_list">


        <div class="option_strip">
            <div style="color:red; display:none;" align="left" id="emp_error" >{$translate.enter_customer_name_error}</div>
            <div style="color:red; display:none;" align="center" id="todateerrormsg" >{$translate.todate_error}</div>
            <div style="color:red; display:none;" align="center" id="fromdateerrormsg" >{$translate.fromdate_error}</div>
            <form method="post" action="" name="frmautoschedule" >
                {$translate.customer_name}<span style="color:red;" >&nbsp;*</span> <input type="text" name="emp" id="emp" maxlength="150"  autocomplete="off" aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" value="{$name}" class="ui-autocomplete-input" />
                <input type="hidden" name="hdn_emp_id" id="hdn_emp_id" value="{$hdn_emp_id}" value="" />
                <input id="employee-id" value="{$username}" type="hidden">
                <input type="hidden" name="url" id="url" value="{$url_path}" />
                <input type="hidden" id="hdn_alpha" name="hdn_alpha" value="" />


                <span id="suggest">
                </span>

                &nbsp;{$translate.from_date} <span style="color:red;" >&nbsp;*</span> <input type="text" name="frmdate" value="{$sdate}" id="frmdate" maxlength="11" />
                &nbsp;{$translate.to_date} <span style="color:red;" >&nbsp;*</span> <input type="text" name="todate" value="{$edate}" id="todate" maxlength="11" />
                <input type="button" name="submit" value="{$translate.get_schedule}" onclick="adddata();" />  

                <input type="button" name="reset" value="{$translate.label_reset}" onclick="reset_form();" />  

            </form>  

            <center>  
                <span style="display:none; position:absolute; left: 700px; top: 214px;z-index:1111;" id="loading">
                    <img src="{$url_path}images/sgo-loading.gif"  />


                </span>

            </center>

        </div>

        <div id="showdata" ></div>

</div>
<script>
    {if $msg_updated neq ''}
                        Reloadadddata();
    {/if}
                        jQuery(document).ready(function() {
                            //hide a div after 3 seconds
                            setTimeout("jQuery('.success').hide(2000);", 10000);
                        });
</script> 

</table>
{/block}