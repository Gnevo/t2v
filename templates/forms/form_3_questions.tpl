{block name='style'}
{*<link rel="stylesheet" type="text/css" href="{$url_path}css/em_con.css" />*}
<link href="{$url_path}css/forms_report.css" rel="stylesheet" type="text/css" />
{/block}

{block name='script'}
<script type="text/javascript">
    $(document).ready(function(){
        if($(window).height() > 400){
            $('#samsida_hold').css({ height: $(window).height()-109}); 
            $('#form_data').css({ height: $(window).height()-50});
        } else {
            $('#samsida_hold').css({ height: $(window).height()});
            $('#form_data').css({ height: $(window).height()});  
        }

        $(window).resize(function(){
           if($(window).height() > 400){
                $('#samsida_hold').css({ height: $(window).height()-109}); 
                $('#form_data').css({ height: $(window).height()-50});
           } else {
                $('#samsida_hold').css({ height: $(window).height()});
                $('#form_data').css({ height: $(window).height()});  
           }
        });  

        $('.btn_remove_tbl_row').live('click', function (event) {
            $(this).parent().parent().remove();
            reorder();
        });
    });
    
    function saveForm(){
        $('#action').val('save');
        $("#forms").submit();
    }

    function deleteQuestion(id) {
        if(confirm('{$translate.want_delete}')) {
            $('#action').val('delete');
            $('#action_id').val(id);
            $("#forms").submit();
        }
    }

    function goToQuesions() {
        navigatePage('{$url_path}form_3_questions.php', 8);
    }

    function addQuestion() {
        $('#tbl_questions tr:last').after('<tr><td></td><td><input type="text" name="orders[]" value="" style="width: 90%;" /></td><td><input type="text" name="questions[]" value="" style="width: 95%;" /></td><td><button type="button" class="btn btn_remove_tbl_row"><i class="icon-trash"></i></button></td></tr>');
        reorder();
    }

    function reorder() {
        var i = 0;
        $('#tbl_questions tr').each(function () {
            $(this).find("td:first").text(i);
            $(this).find("td:nth-child(2)").html('<input type="text" name="orders[]" value="' + i + '" style="width: 90%;" />');
            i++;
        });
    }
</script>

{/block}

{block name="content"}
    <div class="row-fluid">
        <div class="span12 main-left" id="form_data" style="overflow:hidden; height: 623px;">
            <div id="left_message_wraper" class="span12 no-min-height">{$message}</div>
            <form name="forms" id="forms" method="post" action="{$url_path}form_3_questions.php">
                <input type="hidden" name="action" id="action" value="" />
                <input type="hidden" name="action_id" id="action_id" value="" />
                <div class="panel panel-default span12 no-ml" style="margin: 5px 0px 0px ! important;">
                    <div class="panel-heading" style="">
                        <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                            {$translate.form_3}
                            <ul class="pull-right">
                                <li><i class="icon-arrow-left"></i><a href="javascript:void(0);" onclick="navigatePage('{$url_path}form_3.php',8);"><span class="special_spn">{$translate.backs}</span></a></li>
                                <li><i class="icon-refresh"></i><a href="javascript:void(0);" onclick="navigatePage('{$url_path}form_3_questions.php',8);"><span class="special_spn">{$translate.reset}</span></a></li>
                                <li><i class="icon-save"></i><a href="javascript:void(0);" onclick="saveForm()"><span class="special_spn">{$translate.save}</span></a></li>
                            </ul>
                        </h4>
                    </div>
                </div>
                <div id="forms_container" class="span12 no-ml">
                    <div id="samsida_hold" style="overflow:auto;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" id="tbl">
                            <tr align="left">
                                <th>
                                    <span style="margin-top: 5px;" class="manage-form span12 no-ml no-min-height"><h4 style="font-weight: bold;">{$translate.form_3}</h4></span>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border" id="tbl_questions">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="10%">{$translate.order}</th>
                                            <th>{$translate.question}</th>
                                            <th width="5%">{$translate.actions}</th>
                                        </tr>
                                        {assign var="i" value=1}
                                        {foreach $form_questions as $question_id=>$question}
                                            <tr>
                                                <td>{$i}</td>
                                                <td><input type="text" name="orders[]" value="{$question['qorder']}" style="width: 90%;" /></td>
                                                <td><input type="text" name="questions[]" value="{$question['question']}" style="width: 95%;" /></td>
                                                <td><button type="button" class="btn" onclick="deleteQuestion({$question_id})"><i class="icon-trash"></i></button><input type="hidden" name="question_ids[]" value="{$question_id}" /></td>
                                            </tr>
                                            {assign var="i" value=$i+1}
                                        {/foreach}
                                    </table>
                                    <table width="100%" border="0" cellpadding="0" cellspacing="1" class="tbl_border">
                                        <tr>
                                            <td><button class="btn btn-primary mr" onclick="addQuestion();" type="button"><i class="icon-plus"></i> {$translate.add}</button></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="margin-top: 25px" class="span12 no-ml mb">
                                        <button class="btn btn-primary mr" onclick="saveForm();" type="button"><i class="icon-save"></i> {$translate.save}</button>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
{/block}