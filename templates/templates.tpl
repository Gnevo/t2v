{block name='script'}
<script language="javascript">
            $(document).ready(function () { 
                
                $( "#fromdate" ).datepicker({
                    showOn: "button",
                    dateFormat: "yy-mm-dd",
                    buttonImage: "{$url_path}images/date_pic.gif",
                    buttonImageOnly: true
                });
                $( "#todate" ).datepicker({
                    showOn: "button",
                    dateFormat: "yy-mm-dd",
                    buttonImage: "{$url_path}images/date_pic.gif",
                    buttonImageOnly: true
                });
  
               
            });
            
function attachAnother() {

    var file_count = parseInt($('#file_count').val()) + 1;
    $('#file_count').val(file_count);
    $('#file_attach').append("<div class='file_attach_row" + file_count +"'><input type='file' name='file_" + file_count +"' id='file_" + file_count +"' size='12' /></div>");
}
function removeFile(id){
    var id = $('#file_count').val();
    var file_count = parseInt(id) - 1;
    $('#file_count').val(file_count);
    $('div').remove('.file_attach_row' + id);
}
function calculate(username) {
    var hours = $('#bidrag').val();
    var date_from = $("#fromdate").val();
    var to_date = $("#todate").val();
    
        $("#houres").load("{$url_path}ajax_customer_contract_hours.php?hours=" + hours + "&sdate=" + $("#fromdate").val() + "&edate=" + $("#todate").val() + "&customer=" + username + "&fkkn={$fkkn}");
    
}
function checkDates()
{
    var check_date = "";
    var date_from = $("#fromdate").val();
    var to_date = $("#todate").val();
    var user = $("#username").val();
    var hours = $('#bidrag').val();
    //var user_id = $("#user_id").val();
    if(hrs != "" & date_from != "" & date_to != "")
    {
        $.ajax({
            async:false,
            url:"{$url_path}ajax_cust_contract_check_date.php",
            data:"date_from="+date_from+"&date_to="+to_date+"&hrs="+hours+"&user="+user,
            type:"POST",
            success:function(data){
                check_date = data;
                if(data != "")
                {
                    $("#err_msg").html(data);
                    $("#err_msg").addClass("message");
                }
                else
                {
                    $("#err_msg").html("");
                    $("#err_msg").removeClass("message");
                }                        
            }
        });
                //alert(check_date);
        if(check_date != "")
            return false
        else return true;
    }
}


function saveForm() {
    var error = 0;
   
    
    $('#action').val('save');
    if($("#bidrag").val() == ""){
       
        $("#bidrag").addClass("error"); 
        error = 1;
        
    }
    if($("#fromdate").val() == ""){
        $("#fromdate").addClass("error");
        error = 1;
    }
    if($("#todate").val() == ""){
       $("#todate").addClass("error");
       error = 1;
    }

    if($("#bidrag").val() != "" && $("#fromdate").val() != "" && $("#ftodate").val() != "") {    
        $('#form').submit();
    }
}
function selectDate() {
   $('#action').val('dates');
   $('#form').submit();
}

function print_data(username,fkkn)
{
    var date=document.getElementById('date').value;
    var obj=document.getElementById('form');
    obj.action="{$url_path}pdf_customer_insurance.php?username="+username+"&fkkn="+fkkn+"&date="+date;
    obj.submit();
 }

function docRemove(docs) {         
    var old_docs = $('#tdocs').val();
    var del_file = $('#delfile').val();
    
    var doc_array = old_docs.split(",");
    for(var i=0; i < doc_array.length; i++) {
        if(doc_array[i] == docs) {
            doc_array.splice(i, 1);
            break;
        }
    }
    var new_array = doc_array.toString();
    $('#tdocs').val(new_array);
    
    $('#file_list').html('<img src="{$url_path}images/ajax-loader.gif" />');
    //alert('{$url_path}ajax_customer_attatchments_insurence.php?docs='+ new_array);
    $("#file_list").load('{$url_path}ajax_customer_attatchments_insurence.php?docs='+ new_array);
}
            
            function addLog(val,old) {

                if(val.value != old)
                {
                    var tmp = document.getElementById("log_field").value.split(val.name);
                    if(tmp[1] == "" || tmp[1] == undefined)
                    {
                        document.getElementById("log_old").value = document.getElementById("log_old").value + old + ";";
                        document.getElementById("log_field").value = document.getElementById("log_field").value + val.name + ";";
    }
                }
            }
function resetForm() {
    $('#action').val('');
    $('#form').submit();
}
function addNew() {

    document.location.href = "{$url_path}customer/insurance/{$fkkn}/{$customer_detail.username}/new/";
}

</script>
{/block}

{block name="content"}
<div class="clearfix" id="dialog_popup" style="display:none;"></div>
{$message}
<div id="err_msg" ></div>
<div id="kunder_info_strip"  class="clearfix">
    <div class="info_name"><b>{$translate.social_security} : </b>{$customer_detail.social_security}</div>
    <div class="info_name"><b>{$translate.code} : </b>{$customer_detail.code}</div>
    <div class="info_name_last"><b>{$translate.name} : </b>{$customer_detail.first_name|cat: ' '|cat: $customer_detail.last_name}</div>
</div>

<div id="menu">
    <ul>
        <li><a href="{$url_path}customer/add/{$customer_detail.username}/">{$translate.register}</a></li>
        <li {if $fkkn == 'fk'}class="active"{/if}><a href="{$url_path}customer/insurance/fk/{$customer_detail.username}/">{$translate.insurance}</a></li>
        <li {if $fkkn == 'kn'}class="active"{/if}><a href="{$url_path}customer/insurance/kn/{$customer_detail.username}/">{$translate.municipality}</a></li>    
        <li><a href="{$url_path}customer/implan/{$customer_detail.username}/">{$translate.implementation_plan}</a></li>  
        <li><a href="{$url_path}customer/deswork/{$customer_detail.username}/">{$translate.description_of_work}</a></li>
        <li><a href="{$url_path}customer/documentation/{$customer_detail.username}/">{$translate.documentation}</a></li>
        <li><a href="javascript:void(0)">{$translate.quality}</a></li>
        <li><a href="{$url_path}customer/equipment/{$customer_detail.username}/">{$translate.equipment}</a></li>
    </ul>
</div>
<div id="main_tab">
    <div id="tab_content">
        <form name="form" id="form" method="post" enctype="multipart/form-data" action="{$url_path}customer/insurance/{$fkkn}/{$customer_detail.username}/">
            <input type="hidden" name="username" id="username" value="{$customer_username}" />
            <input type="hidden" name="tdocs" id="tdocs" value="{$documents_string}" />
            <input type="hidden" name="delfile" id="delfile" value="" />
            <input type="hidden" name="file_count" id="file_count" value="1"/>
            
            <div class="tbl_hd"><span class="titles_tab">{$translate.customer}</span>
                <div class="titlebar_links">
                    <a href="javascript:void(0)" class="save"onclick="saveForm()"><span class="btn_name">{$translate.save}</span></a>
                    <a href="javascript:void(0)" class="reset"onclick="resetForm()"><span class="btn_name">{$translate.reset}</span></a>
                    <a href="javascript:void(0)" onclick="print_data('{$customer_username}','{$fkkn}')" class="print"></span><span class="btn_name">{$translate.print}</span></a>
                    <a href="{$url_path}list/customer/"class="back"></span><span class="btn_name">{$translate.backs}</span></a>
                </div>
                {if $fkkn == 'kn'}
                    <div class="titlebar_chekbox">
                        <input type="checkbox" name="iss" id="iss" value="1" {if $contract_details[0].iss == 1} checked="checked" {/if}/>
                        <label for="iss">LSS</label>
                        <input type="checkbox" name="sol" id="sol" value="1" {if $contract_details[0].sol == 1} checked="checked" {/if} />
                        <label for="sol">SOL</label>
                    </div>
                {/if}
            </div>
            <div id="forms_container" class="clearfix">
                <div class="document_strip clearfix">
                    <div class="sub_hd">{$translate.edit_existing_data}
                        <div class="right">
                            <input name="add" type="button" class="add" id="add" value="{$translate.add_new}" onclick="addNew()" />
                        </div>
                    </div>
                    <br />
                    <strong>{$translate.select_period} </strong>
                    <select id="date" name="date" onchange="selectDate()">
                        <option value="">{$translate.select}</option>
                        {foreach from=$periods item=period}
                            <option value="{$period.id}" {if $contract_id == $period.id} selected="selected" {/if}>{$period.date_from} - {$period.date_to}</option>
                        {/foreach}
                    </select>
                    <input type="hidden" name="action" id="action" value=""/>
                </div>
                <div>
                    <div id="decision">
                        <div class="sub_hd double"><span class="titles">{$translate.administrator_decision}</span></div>
                        <div class="sub_hd double"><span class="titles">{$translate.decision_authorization_agreement}</span></div>
                        <div class="decision_row">
                            <div class="td_raw">
                                <label for="dofname*">{$translate.first_name}*</label>
                                <input type="text" name="dofname" id="dofname" value="{$contract_details[0].first}" onblur="addLog(this,'{$contract_details[0].first}')"/>
                            </div>
                            <div class="td_raw">
                                <label for="dolname*">{$translate.last_name}*</label>
                                <input type="text" name="dolname" id="dolname" value="{$contract_details[0].last}" onblur="addLog(this,'{$contract_details[0].last}')"/>
                            </div>
                            <div class="td_raw">
                                <label for="dophone">{$translate.mobile}</label>
                                <input type="text" name="dophone" id="dophone" value="{$contract_details[0].mob}" onblur="addLog(this,'{$contract_details[0].mob}')"/>
                            </div>
                            <div class="td_raw">
                                <label for="doemail">{$translate.email}</label>
                                <input type="text" name="doemail" id="doemail" value="{$contract_details[0].mail}" onblur="addLog(this,'{$contract_details[0].mail}')"/>
                            </div>
                            <div class="td_raw">
                                <label for="docity">{$translate.location}</label>
                                <input type="text" name="docity" id="docity" value="{$contract_details[0].cities}" onblur="addLog(this,'{$contract_details[0].cities}')"/>
                            </div>
                            <div class="td_raw">
                                <label for="bidrag">{$translate.granded_hours}*</label>
                                <input type="text" name="bidrag" id="bidrag" value="{$contract_details[0].hour}" onfocus="calculate('{$customer_details[0].username}')" onchange="calculate('{$customer_details[0].username}')" onkeyup="calculate('{$customer_detail.username}')" onblur="addLog(this,'{$contract_details[0].hour}')"/>
                                <span id="bidragInfo"></span>
                            </div>
                            <div class="td_raw">
                                <label for="fromdate"><strong>{$translate.date_from}*</strong></label>
                                <input name="fromdate" type="text" class="date_pick_input" id="fromdate" value="{$contract_details[0].date_from}" onfocus="calculate('{$customer_detail.username}')" onchange="calculate('{$customer_detail.username}')" onkeyup="calculate('{$customer_detail.username}')" onblur="addLog(this,'{$contract_details[0].date_from}')">
                                <span id="fromdateInfo"></span>
                            </div>
                            <div class="td_raw">
                                <label for="todate">{$translate.date_to}*</label>
                                <input name="todate" type="text" class="date_pick_input" id="todate" value="{$contract_details[0].date_to}" onfocus="calculate('{$customer_detail.username}')" onchange="calculate('{$customer_detail.username}')" onkeyup="calculate('{$customer_detail.username}')" onblur="addLog(this,'{$contract_details[0].date_to}')">
                                <span id="todateInfo"></span>
                            </div>
                        </div>
                            <div id="file_list" class="file_lists">
                            <ul>
                                {foreach from=$documents item=document}
                                    <li class="files">
                                        <img src="{$url_path}images/{$document.icon}" width="14" height="17" />
                                        <a id="lic_1" target="_blank" href="{$url_path}download.php?{$download_folder}/{$document.file}">{$document.name}</a>
                                        <a href="javascript:void(0);"  onclick="docRemove('{$document.file}')">{$translate.delete_file}</a>
                                    </li>
                                {foreachelse}
                                    <li class="files"><span>{$translate.there_are_no_files}</span></li>
                                {/foreach}
                            </ul>
                        </div>
                                    <div class="trusteeship_file_attach">
                                        <input type="hidden" name="log_field" id="log_field" value=""/>
                                        <input type="hidden" name="log_old" id="log_old" value=""/>
                                        

                                        <div id="file_attach" class="file_attach_row">
                                            <input type="file" name="file_1" id="file_1" size="12"/>
                                        </div>
                                        <div class="file_attach_row">
                                            <label><a href='javascript:void(0);' onclick='removeFile()'>{$translate.delete}</a></label>
                                        </div>
                                        <div class="file_attach_row">
                                            <label><a href="javascript:void(0);" onclick="attachAnother()">{$translate.upload_new_file}</a></label>
                                        </div>
                                    </div>
                                </div>
                                <div id="billing_off">
                                    <div class="sub_hd"><span class="titles">{$translate.administrator_behalf}</span></div>
                                    <div class="td_raw">
                                        <label for="bofname">{$translate.first_name}</label>
                                        <input type="text" name="bofname" id="bofname" value="{$contract_details[0].first_name}" onblur="addLog(this,'{$contract_details[0].first_name}')"/>
                                    </div>
                                    <div class="td_raw">
                                        <label for="bolname">{$translate.last_name}</label>
                                        <input type="text" name="bolname" id="bolname" value="{$contract_details[0].last_name}" onblur="addLog(this,'{$contract_details[0].last_name}')"/>
                                    </div>
                                    <div class="td_raw">
                                        <label for="bophone">{$translate.mobile}</label>
                                        <input type="text" name="bophone" id="bophone" value="{$contract_details[0].mobile}" onblur="addLog(this,'{$contract_details[0].mobile}')"/>
                                    </div>
                                    <div class="td_raw">
                                        <label for="boemail">{$translate.email}</label>
                                        <input type="text" name="boemail" id="boemail" value="{$contract_details[0].email}" onblur="addLog(this,'{$contract_details[0].email}')"/>
                                    </div>
                                    <div class="td_raw">
                                        <label for="bocity">{$translate.location}</label>
                                        <input type="text" name="bocity" id="bocity" value="{$contract_details[0].city}" onblur="addLog(this,'{$contract_details[0].city}')"/>
                                    </div>
                                    <div class="cheking">
                                        <div class="sub_hd"><strong>{$translate.night}</strong></div>
                                        <div class="colm">
                                            <div class="officers_check">
                                                <input type="checkbox" name="oncall" id="oncall" value="1" {if $contract_details[0].oncall == "1"} checked="checked" {/if} onclick="addLog(this,'{$contract_details[0].oncall}')"/>
                                                <label for="oncall">{$translate.emergency}</label>
                                            </div>
                                            <div class="officers_check">
                                                <input type="checkbox" name="awake" id="awake" value="1" {if $contract_details[0].awake == "1"} checked="checked" {/if} onclick="addLog(this,'{$contract_details[0].awake}')"/>
                                                <label for="awake">{$translate.alert}</label>
                                            </div>
                                        </div>
                                        <div class="colm">
                                            <div class="officers_check">
                                                <input type="checkbox" name="oncall2" id="oncall2" value="1" {if $contract_details[0].oncall2 == "1"} checked="checked" {/if} onclick="addLog(this,'{$contract_details[0].oncall2}')"/>
                                                <label for="oncall2">{$translate.preparedness}</label>
                                            </div>
                                            <div class="officers_check">
                                                <input type="checkbox" name="something" id="something" value="1" {if $contract_details[0].something == "1"} checked="checked" {/if} onclick="addLog(this,'{$contract_details[0].something}')"/>
                                                <label for="something">{$translate.other}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="houres" class="clearfix">
                                    <div class="hourse_per">
                                        <div class="per_month">{$translate.monthly}</div>
                                        <div class="time">{$monthly_hrs}</div>
                                    </div>
                                    <div class="hourse_per">
                                        <div class="per_month">{$translate.weekly}</div>
                                        <div class="time">{$weekly_hrs}</div>
                                    </div>
                                    <div class="hourse_per">
                                        <div class="per_month">{$translate.granded_hours}</div>
                                        <div class="time">{$hrs}</div>
                                    </div>
                                    <div class="hourse_per">
                                        <div class="per_month">{$translate.remaining_hours}</div>
                                        <div class="time">{$remaining_hrs}</div>
                                    </div>
                                   <!--  <div class="hourse_per">
                                        <div class="per_month">{$translate.exercised_call_hour}</div>
                                        <div class="time">{$oncall}</div>
                                    </div>
                                   <div class="time_period_block">
                                        <h1>{$translate.monthly}</h1>
                                        <h2>{$monthly_hrs}</h2>
                                    </div>
                                    <div class="time_period_block">
                                        <h1>{$translate.weekly}</h1>
                                        <h2>{$weekly_hrs}</h2>
                                    </div>
                                    <div class="time_period_block">
                                        <h1>{$translate.granded_hours}</h1>
                                        <h2>{$hrs}</h2>
                                    </div>
                                    <div class="time_period_block">
                                        <h1>{$translate.remaining_hours}</h1>
                                        <h2>{$remaining_hrs}</h2>
                                    </div>
                                    <div class="time_period_block">
                                        <h1>{$translate.exercised_call_hour}</h1>
                                        <h2>{$oncall}</h2>
                                    </div>-->

                                </div>
                                <div id="comments_on" class="clearfix">
                                    <div class="comments_on_hours">
                                        <label for="ovrig">{$translate.comment_decision_hour}</label>
                                        <textarea name="comhours" cols="32" id="comhours" onblur="addLog(this,'{$contract_details[0].comments_time}')">{$contract_details[0].comments_time}</textarea>
                                    </div>
                                    <div class="comments_on_hours">
                                        <label for="ovrig">{$translate.comment_decision_management_others}</label>
                                        <textarea name="comdecision" cols="32" id="comdecision" onblur="addLog(this,'{$contract_details[0].comments_other}')">{$contract_details[0].comments_other}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {/block}
