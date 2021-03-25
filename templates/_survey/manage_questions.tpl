{block name="sub_style"}
<style type="text/css">
</style>
{/block}
{block name="sub_script"}
{*<script src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.sortable.js"></script>*}
<script type="text/javascript">

var question_type=new Array;
$(document).ready(function() {

    var query = window.location.href.slice(window.location.href.indexOf('questions') + 10).split('/');
    if(query.length >= 3)
        $("#save_quest").hide();
    else
        $("#save_quest").show();
    
    question_type["ctrl_text"] = '<div class="row-fluid mb selected_answer_wrpr">\n\
                                            <div class="span12 no-ml drop-zone">\n\
                                                <input type="hidden" name="q_type" value="text" />\n\
                                                <div class="row-fluid">\n\
                                                        <div style="margin:0;" class="span11"><strong>{$translate.text_box}</strong></div>\n\
                                                        <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                </div>\n\
                                                <div style="margin: 0px;" class="span2">\n\
                                                        <label for="answer_point" class="span12" style="float: left;">{$translate.point}</label>\n\
                                                        <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>\n\
                                                                <input type="text" name="answer_point" id="answer_point" value="" placeholder="{$translate.point}" class="form-control span8"/>\n\
                                                        </div>\n\
                                                </div>\n\
                                                <div class="span10">\n\
                                                        <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>\n\
                                                        <textarea id="answer_hint" name="answer_hint" placeholder="{$translate.ans_hint}" rows="1" class="form-control span12"></textarea>\n\
                                                </div>\n\
                                        </div>\n\
                                    </div>';
     question_type["ctrl_textarea"] = '<div class="row-fluid mb selected_answer_wrpr">\n\
                                            <div class="span12 no-ml drop-zone">\n\
                                                    <input type="hidden" name="q_type" value="textarea" />\n\
                                                    <div class="row-fluid">\n\
                                                            <div style="margin:0;" class="span11"><strong>{$translate.text_area}</strong></div>\n\
                                                            <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                    </div>\n\
                                                    <div style="margin: 0px;" class="span2">\n\
                                                            <label for="answer_point" class="span12" style="float: left;">{$translate.point}</label>\n\
                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>\n\
                                                                    <input type="text" name="answer_point" id="answer_point" value="" placeholder="{$translate.point}" class="form-control span8"/> \n\
                                                            </div>\n\
                                                    </div>\n\
                                                    <div class="span10">\n\
                                                            <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>\n\
                                                            <textarea id="answer_hint" name="answer_hint" placeholder="{$translate.ans_hint}" rows="1" class="form-control span12"></textarea>\n\
                                                    </div>\n\
                                            </div>\n\
                                        </div>';
     question_type["ctrl_check"] = '<div class="row-fluid mb selected_answer_wrpr">\n\
                                        <div class="span12 no-ml drop-zone">\n\
                                                <input type="hidden" name="q_type" value="check" />\n\
                                                <div class="row-fluid">\n\
                                                        <div style="margin:0;" class="span11"><strong>{$translate.check_box}</strong></div>\n\
                                                        <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                </div>\n\
                                                <div class="row-fluid" id="answer_choices">\n\
                                                        <div class="span12 no-ml mt ctrl-strip">\n\
                                                                <input type="checkbox" name="ckbox[]" value="1" class="pull-left" style="margin-right: 10px ! important;" />\n\
                                                                <input type="hidden" name="ckbox[]" value="NULL" />\n\
                                                                <div style="margin: 0px;" class="input-prepend span5"> \n\
                                                                        <span class="add-on icon-pencil"></span>\n\
                                                                        <input name="ckbox_txt[]" value="" type="text" placeholder="{$translate.answer}" class="form-control span11"/> \n\
                                                                </div>\n\
                                                                <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-add">+</button>\n\
                                                                <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove">-</button>\n\
                                                                <div style="margin: 0px;" class="input-prepend span5"> <span class="add-on icon-pencil"></span>\n\
                                                                        <input type="text" name="ckbox_point[]" value="" placeholder="{$translate.point}" class="form-control span11" /> \n\
                                                                </div>\n\
                                                        </div>\n\
                                                        <div class="span12 no-ml mt ctrl-strip">\n\
                                                                <input type="checkbox" name="ckbox[]" value="1" class="pull-left" style="margin-right: 10px ! important;" />\n\
                                                                <input type="hidden" name="ckbox[]" value="NULL" />\n\
                                                                <div style="margin: 0px;" class="input-prepend span5"> \n\
                                                                        <span class="add-on icon-pencil"></span>\n\
                                                                        <input name="ckbox_txt[]" value="" type="text" placeholder="{$translate.answer}" class="form-control span11"/> \n\
                                                                </div>\n\
                                                                <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-add">+</button>\n\
                                                                <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove">-</button>\n\
                                                                <div style="margin: 0px;" class="input-prepend span5"> <span class="add-on icon-pencil"></span>\n\
                                                                        <input type="text" name="ckbox_point[]" value="" placeholder="{$translate.point}" class="form-control span11" /> \n\
                                                                </div>\n\
                                                        </div>\n\
                                                </div>\n\
                                                <div class="row-fluid" style="margin: 5px 0px 0px ! important;">\n\
                                                        <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>\n\
                                                        <textarea id="answer_hint" name="answer_hint" placeholder="{$translate.ans_hint}" rows="1" class="form-control span12"></textarea>\n\
                                                </div>\n\
                                                <div class="row-fluid additional_functions mt no-ml">\n\
                                                        <div class="span4 no-ml">\n\
                                                                <div class="input-prepend span11" style="margin-left: 0px; float: left;">\n\
                                                                        <span class="add-on icon-pencil"></span>\n\
                                                                        <select name="ckbox_sel_disp_style" id="select" class="form-control span12">\n\
                                                                                <option value="1">{$translate.vertical}</option>\n\
                                                                                <option value="2">{$translate.horizontal}</option>\n\
                                                                        </select>\n\
                                                                </div>\n\
                                                        </div>\n\
                                                        <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  \n\
                                                        <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  \n\
                                                </div>\n\
                                        </div>\n\
                                    </div>';
     question_type["ctrl_radio"] = '<div class="row-fluid mb selected_answer_wrpr">\n\
                                            <div class="span12 no-ml drop-zone">\n\
                                                <input type="hidden" name="q_type" value="radio" />\n\
                                                <div class="row-fluid">\n\
                                                        <div style="margin:0;" class="span11"><strong>{$translate.radio_button}</strong></div>\n\
                                                        <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                </div>\n\
                                                <div class="row-fluid" id="answer_choices">\n\
                                                        <div class="span12 no-ml mt ctrl-strip">\n\
                                                                <input type="radio" name="rdbox[]" value="1" class="pull-left" style="margin-right: 10px ! important;" />\n\
                                                                <input type="hidden" name="rdbox[]" value="NULL" />\n\
                                                                <div style="margin: 0px;" class="input-prepend span5"> \n\
                                                                        <span class="add-on icon-pencil"></span>\n\
                                                                        <input name="rdbox_txt[]" value="" type="text" placeholder="{$translate.answer}" class="form-control span11"/> \n\
                                                                </div>\n\
                                                                <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-add">+</button>\n\
                                                                <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove">-</button>\n\
                                                                <div style="margin: 0px;" class="input-prepend span5"> <span class="add-on icon-pencil"></span>\n\
                                                                        <input type="text" name="rdbox_point[]" value="" placeholder="{$translate.point}" class="form-control span11" /> \n\
                                                                </div>\n\
                                                        </div>\n\
                                                        <div class="span12 no-ml mt ctrl-strip">\n\
                                                                <input type="radio" name="rdbox[]" value="1" class="pull-left" style="margin-right: 10px ! important;" />\n\
                                                                <input type="hidden" name="rdbox[]" value="NULL" />\n\
                                                                <div style="margin: 0px;" class="input-prepend span5"> \n\
                                                                        <span class="add-on icon-pencil"></span>\n\
                                                                        <input name="rdbox_txt[]" value="" type="text" placeholder="{$translate.answer}" class="form-control span11"/> \n\
                                                                </div>\n\
                                                                <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-add">+</button>\n\
                                                                <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove">-</button>\n\
                                                                <div style="margin: 0px;" class="input-prepend span5"> <span class="add-on icon-pencil"></span>\n\
                                                                        <input type="text" name="rdbox_point[]" value="" placeholder="{$translate.point}" class="form-control span11" /> \n\
                                                                </div>\n\
                                                        </div>\n\
                                                </div>\n\
                                                <div class="row-fluid" style="margin: 5px 0px 0px ! important;">\n\
                                                        <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>\n\
                                                        <textarea id="answer_hint" name="answer_hint" placeholder="{$translate.ans_hint}" rows="1" class="form-control span12"></textarea>\n\
                                                </div>\n\
                                                <div class="row-fluid additional_functions mt no-ml">\n\
                                                        <div class="span4 no-ml">\n\
                                                                <div class="input-prepend span11" style="margin-left: 0px; float: left;">\n\
                                                                        <span class="add-on icon-pencil"></span>\n\
                                                                        <select name="rdbox_sel_disp_style" id="select" class="form-control span12">\n\
                                                                                <option value="1">{$translate.vertical}</option>\n\
                                                                                <option value="2">{$translate.horizontal}</option>\n\
                                                                        </select>\n\
                                                                </div>\n\
                                                        </div>\n\
                                                        <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  \n\
                                                        <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  \n\
                                                </div>\n\
                                        </div>\n\
                                    </div>';
     question_type["ctrl_combo"] = '<div class="row-fluid mb selected_answer_wrpr">\n\
                                          <div class="span12 no-ml drop-zone">\n\
                                                <input type="hidden" name="q_type" value="combo" />\n\
                                                <div class="row-fluid">\n\
                                                        <div style="margin:0;" class="span11"><strong>{$translate.combo_box}</strong></div>\n\
                                                        <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                </div>\n\
                                                <div class="row-fluid" id="answer_choices">\n\
                                                        <div class="span12 no-ml mt ctrl-strip">\n\
                                                                <input type="radio" name="cmbbox[]" value="1" class="pull-left" style="margin-right: 10px ! important;" />\n\
                                                                <input type="hidden" name="cmbbox[]" value="NULL" />\n\
                                                                <div style="margin: 0px;" class="input-prepend span5"> \n\
                                                                        <span class="add-on icon-pencil"></span>\n\
                                                                        <input name="cmbbox_txt[]" value="" type="text" placeholder="{$translate.answer}" class="form-control span11"/> \n\
                                                                </div>\n\
                                                                <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-add">+</button>\n\
                                                                <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove">-</button>\n\
                                                                <div style="margin: 0px;" class="input-prepend span5"> <span class="add-on icon-pencil"></span>\n\
                                                                        <input type="text" name="cmbbox_point[]" value="" placeholder="{$translate.point}" class="form-control span11" /> \n\
                                                                </div>\n\
                                                        </div>\n\
                                                        <div class="span12 no-ml mt ctrl-strip">\n\
                                                                <input type="radio" name="cmbbox[]" value="1" class="pull-left" style="margin-right: 10px ! important;" />\n\
                                                                <input type="hidden" name="cmbbox[]" value="NULL" />\n\
                                                                <div style="margin: 0px;" class="input-prepend span5"> \n\
                                                                        <span class="add-on icon-pencil"></span>\n\
                                                                        <input name="cmbbox_txt[]" value="" type="text" placeholder="{$translate.answer}" class="form-control span11"/> \n\
                                                                </div>\n\
                                                                <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-add">+</button>\n\
                                                                <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove">-</button>\n\
                                                                <div style="margin: 0px;" class="input-prepend span5"> <span class="add-on icon-pencil"></span>\n\
                                                                        <input type="text" name="cmbbox_point[]" value="" placeholder="{$translate.point}" class="form-control span11" /> \n\
                                                                </div>\n\
                                                        </div>\n\
                                                </div>\n\
                                                <div class="row-fluid" style="margin: 5px 0px 0px ! important;">\n\
                                                        <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>\n\
                                                        <textarea id="answer_hint" name="answer_hint" placeholder="{$translate.ans_hint}" rows="1" class="form-control span12"></textarea>\n\
                                                </div>\n\
                                                <div class="row-fluid additional_functions mt no-ml">\n\
                                                        <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  \n\
                                                        <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  \n\
                                                </div>\n\
                                        </div>  \n\
                                    </div>';
     question_type["ctrl_star_rating"] = '<div class="row-fluid mb selected_answer_wrpr">\n\
                                                <div class="span12 no-ml drop-zone">\n\
                                                    <input type="hidden" name="q_type" value="star_rating" />\n\
                                                    <div class="row-fluid">\n\
                                                            <div style="margin:0;" class="span11"><strong>{$translate.star_rating}</strong></div>\n\
                                                            <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                    </div>\n\
                                                    <div style="margin: 0px;" class="span4">\n\
                                                            <label for="lower_value" class="span12" style="float: left;">{$translate.lower_value}</label>\n\
                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>\n\
                                                                    <input type="text" id="lower_value" name="lower_value" value="" placeholder="{$translate.lower_value}" class="form-control span10"/> \n\
                                                            </div>\n\
                                                    </div>\n\
                                                    <div class="span4">\n\
                                                            <label for="upper_value" class="span12" style="float: left;">{$translate.upper_value}</label>\n\
                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>\n\
                                                                    <input type="text" id="upper_value" name="upper_value" value="" placeholder="{$translate.upper_value}" class="form-control span10"/> \n\
                                                            </div>\n\
                                                    </div>\n\
                                                    <div class="span4">\n\
                                                            <label for="star_count" class="span12" style="float: left;">{$translate.no_of_stars}</label>\n\
                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>\n\
                                                                    <input type="text" id="star_count" name="star_count" value="" placeholder="{$translate.no_of_stars}" class="form-control span10"> \n\
                                                            </div>\n\
                                                    </div>\n\
                                                    <div style="margin: 5px 0px 0px ! important;" class="span2">\n\
                                                            <label for="answer_point" class="span12" style="float: left;">{$translate.point}</label>\n\
                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>\n\
                                                                    <input type="text" name="answer_point" id="answer_point" value="" placeholder="{$translate.point}" class="form-control span8"/> \n\
                                                            </div>\n\
                                                    </div>\n\
                                                    <div class="span10" style="margin: 5px 0px 0px;">\n\
                                                            <label style="float: left;" class="span12" for="answer_hint">{$translate.ans_hint}</label>\n\
                                                            <textarea id="answer_hint" name="answer_hint" class="form-control span12" rows="1" placeholder="{$translate.ans_hint}"></textarea>\n\
                                                    </div>\n\
                                                    <div class="row-fluid additional_functions mt no-ml">\n\
                                                            <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  \n\
                                                            <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  \n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>';
     question_type["ctrl_custom_rating"] = '<div class="row-fluid mb selected_answer_wrpr">\n\
                                                <div class="span12 no-ml drop-zone">\n\
                                                    <input type="hidden" name="q_type" value="custom_rating" />\n\
                                                    <div class="row-fluid">\n\
                                                            <div style="margin:0;" class="span11"><strong>{$translate.custom_rating}</strong></div>\n\
                                                            <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                    </div>\n\
                                                    <div style="margin: 0px;" class="span4">\n\
                                                            <label for="out_of" class="span12" style="float: left;">{$translate.out_of_rate}</label>\n\
                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>\n\
                                                                    <input type="text" id="out_of" name="out_of" value="" class="form-control span11" placeholder="{$translate.out_of_rate}"/> \n\
                                                            </div>\n\
                                                    </div>\n\
                                                    <div class="span4">\n\
                                                            <label for="answer_point" class="span12" style="float: left;">{$translate.point}</label>\n\
                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>\n\
                                                                    <input type="text" name="answer_point" id="answer_point" value="" placeholder="{$translate.point}" class="form-control span3"/> \n\
                                                            </div>\n\
                                                    </div>\n\
                                                    <div class="span12" style="margin: 5px 0px 0px;">\n\
                                                            <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>\n\
                                                            <textarea id="answer_hint" name="answer_hint" placeholder="{$translate.ans_hint}" rows="1" class="form-control span12"></textarea>\n\
                                                    </div>\n\
                                                    <div class="row-fluid additional_functions mt no-ml">\n\
                                                            <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  \n\
                                                            <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  \n\
                                                    </div>\n\
                                                </div>\n\
                                            </div>';
     question_type["ctrl_date"] = '<div class="row-fluid mb selected_answer_wrpr">\n\
                                        <div class="span12 no-ml drop-zone">\n\
                                                <input type="hidden" name="q_type" value="date" />\n\
                                                <div class="row-fluid">\n\
                                                        <div style="margin:0;" class="span11"><strong>{$translate.date_field}</strong></div>\n\
                                                        <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                </div>\n\
                                                <div style="margin: 0px;" class="row-fluid">\n\
                                                        <label for="answer_point" class="span12" style="float: left;">{$translate.point}</label>\n\
                                                        <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>\n\
                                                                <input type="text" name="answer_point" id="answer_point" value="" class="form-control span11" placeholder="{$translate.point}"/> \n\
                                                        </div>\n\
                                                </div>\n\
                                                <div class="row-fluid" style="margin: 5px 0px 0px;">\n\
                                                        <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>\n\
                                                        <textarea id="answer_hint" name="answer_hint" placeholder="{$translate.ans_hint}" rows="1" class="form-control span12"></textarea>\n\
                                                </div>\n\
                                                <div class="row-fluid additional_functions mt no-ml">\n\
                                                        <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  \n\
                                                        <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  \n\
                                                </div>\n\
                                        </div>\n\
                                    </div>';
     question_type["ctrl_file"] = '<div class="row-fluid mb selected_answer_wrpr">\n\
                                        <div class="span12 no-ml drop-zone">\n\
                                                <input type="hidden" name="q_type" value="file" />\n\
                                                <div class="row-fluid">\n\
                                                        <div style="margin:0;" class="span11"><strong>{$translate.file}</strong></div>\n\
                                                        <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                                </div>\n\
                                                <div style="margin: 0px;" class="row-fluid">\n\
                                                        <label for="answer_point" class="span12" style="float: left;">{$translate.point}</label>\n\
                                                        <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>\n\
                                                                <input type="text" name="answer_point" id="answer_point" value="" class="form-control span11" placeholder="{$translate.point}"/> \n\
                                                        </div>\n\
                                                </div>\n\
                                                <div class="row-fluid" style="margin: 5px 0px 0px;">\n\
                                                        <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>\n\
                                                        <textarea id="answer_hint" name="answer_hint" placeholder="{$translate.ans_hint}" rows="1" class="form-control span12"></textarea>\n\
                                                </div>\n\
                                                <div class="row-fluid additional_functions mt no-ml">\n\
                                                        <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  \n\
                                                        <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  \n\
                                                </div>\n\
                                        </div>\n\
                                    </div>';
     question_type["ctrl_likert"] = '<div class="row-fluid mb selected_answer_wrpr">\n\
                                        <div class="span12 no-ml drop-zone">\n\
                                            <input type="hidden" name="q_type" value="likert" />\n\
                                            <div class="row-fluid">\n\
                                                    <div style="margin:0;" class="span11"><strong>{$translate.likert_matrix}</strong></div>\n\
                                                    <div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>\n\
                                            </div>\n\
                                            <div class="row-fluid" id="likertmatrix_questions">\n\
                                                    <label class="span12" style="float: left;">{$translate.questions}</label>\n\
                                                    <div class="span12 no-ml mt ctrl-strip">\n\
                                                            <div style="margin: 0px;" class="input-prepend span5"> \n\
                                                                    <span class="add-on icon-pencil"></span>\n\
                                                                    <input name="subquestion[]" type="text" value="" placeholder="{$translate.questions}" class="form-control span11"/> \n\
                                                            </div>\n\
                                                            <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-add">+</button>\n\
                                                            <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove">-</button>\n\
                                                    </div>\n\
                                            </div>\n\
                                            <div class="row-fluid" id="likertmatrix_colum_choice">\n\
                                                    <label class="span12" style="float: left;">{$translate.column_choice}</label>\n\
                                                    <div class="span12 no-ml mt ctrl-strip">\n\
                                                                    <div style="margin: 0px;" class="input-prepend span5"> \n\
                                                                            <span class="add-on icon-pencil"></span>\n\
                                                                            <input name="subcolumn[]" type="text" value="" placeholder="{$translate.column_choice}" class="form-control span11"/> \n\
                                                                    </div>\n\
                                                                    <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-add">+</button>\n\
                                                                    <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove">-</button>\n\
                                                                    <div style="margin: 0px;" class="input-prepend span5"> <span class="add-on icon-pencil"></span>\n\
                                                                                    <input type="text" name="point[]" value="" placeholder="{$translate.point}" class="form-control span11" /> \n\
                                                                    </div>\n\
                                                    </div>\n\
                                            </div>\n\
                                            <div class="row-fluid" style="margin: 5px 0px 0px ! important;">\n\
                                                    <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>\n\
                                                    <textarea id="answer_hint" name="answer_hint" placeholder="{$translate.ans_hint}" rows="1" class="form-control span12"></textarea>\n\
                                            </div>\n\
                                            <div class="row-fluid additional_functions mt no-ml">\n\
                                                    <div class="span4 no-ml">\n\
                                                            <div class="input-prepend span11" style="margin-left: 0px; float: left;">\n\
                                                                    <span class="add-on icon-pencil"></span>\n\
                                                                    <select name="sel_disp_style" id="select" class="form-control span12">\n\
                                                                            <option value="1">{$translate.vertical}</option>\n\
                                                                            <option value="2">{$translate.horizontal}</option>\n\
                                                                    </select>\n\
                                                            </div>\n\
                                                    </div>\n\
                                                    <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  \n\
                                                    <div class="span4 action_ctrl_wrpr"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  \n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
});

$(document).ready(function() {
    
    $("#connected_parent_details .remove_selected_form").click(function(event){
        window.location.href = "{$url_path}manage/questions/{$this_question_id}/";
        event.preventDefault();
        event.stopPropagation();
        return false;
    });
    
    $("#draggable-answers .draggable-answer").draggable({ revert: "invalid", appendTo: "#tab-working-panel", helper: 'clone', start: 
            function (event, ui) { ui.helper.css({ 'width': '220px', 'opacity': '1'}); } 
    });
    
    
    {if $show_questions eq 1}
        $('#draggable-answers .draggable-answer').draggable( 'disable' );
        //$('.drop_zone_inner').css( 'display','none' );
    {/if}
    
    $(".dragdrop-box").droppable({
            accept: ".draggable-answer",
            activeClass: "active",
            hoverClass: "hover",
            drop: function(event,ui){
                switch (ui.draggable.attr("id")){
                            case "ctrl_text":
                            case "ctrl_check":
                            case "ctrl_textarea":
                            case "ctrl_radio":
                            case "ctrl_combo":
                            case "ctrl_star_rating":
                            case "ctrl_custom_rating":
                            case "ctrl_date":
                            case "ctrl_file":
                            case "ctrl_likert":
                                    $('.dragdrop-box').append(question_type[ui.draggable.attr("id")]);
                                    $('#draggable-answers .draggable-answer').draggable( 'disable' );
                                    //$('.drop_zone_inner').css( 'display','none' );
                                    break;
                            default :
                                    alert('{$translate.invalid_question_type}');
                    }
            }
    });
    
    // remove anwer type from dropable box
    $(".ctrlstrip-close").live("click",function(){
            $(this).parents('.selected_answer_wrpr').remove();
            $('#draggable-answers .draggable-answer').draggable( 'enable' );
            //$('.drop_zone_inner').css( 'display','block' );
    });
    
    //answer-choice remove
    $(".ctrlstrip-remove").live("click",function(){
            $(this).parents('.ctrl-strip').remove();
    });
    
    //answer-choice add
    $(".ctrlstrip-add").live("click",function(){
            $(this).parents('.ctrl-strip').clone().insertAfter($(this).parents('.ctrl-strip'));
    });
    
    //add a text boxes for user comments
    $(".add_textbox_btn").live("click",function(){
            $(this).parents(".additional_functions").before('<div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">\n\
                                                                                <input name="txt_comment" value="" type="text" class="form-control span11" placeholder="{$translate.user_comment_area}"/>\n\
                                                                                <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>\n\
                                                                            </div>');
            $('.add_textbox_btn').parents('.action_ctrl_wrpr').addClass('hide');
            $('.add_textarea_btn').parents('.action_ctrl_wrpr').addClass('hide');
    });
    
    //add a text aria for user comments
    $(".add_textarea_btn").live("click",function(){
            $(this).parents(".additional_functions").before('<div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">\n\
                                                                                <textarea name="txtArea_comment" value="" rows="1" class="form-control span11" placeholder="{$translate.user_comment_area}"></textarea>\n\
                                                                                <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>\n\
                                                                            </div>');
            $('.add_textbox_btn').parents('.action_ctrl_wrpr').addClass('hide');
            $('.add_textarea_btn').parents('.action_ctrl_wrpr').addClass('hide');
    });
    
    //remove user comment control
    $(".ctrlstrip-remove-comment").live("click",function(){
            $(this).parents('.comment_wrpr').remove();
            $('.add_textbox_btn').parents('.action_ctrl_wrpr').removeClass('hide');
            $('.add_textarea_btn').parents('.action_ctrl_wrpr').removeClass('hide');
    });
    
    $(".accordion_head").click(function () {
        if ($('.accordion_body').is(':visible')) {
            $(".accordion_body").slideUp(300);
            $(".plusminus").text('+');
        }
        if ($(this).next(".accordion_body").is(':visible')) {
            $(this).next(".accordion_body").slideUp(300);
            $(this).children(".plusminus").text('+');
        } else {
            $(this).next(".accordion_body").slideDown(300);
            $(this).children(".plusminus").text('-');
        }
    });
});

function saveForm(action){
        $("#action").val(action);
        $("#frm_question").submit();
}

function fetch_answers(){
    var search_val = $("#answertype_search").val();
    search_val = search_val.toLowerCase();
    if(search_val == ''){
        $('#draggable-answers .draggable-answer').each(function(){
                $(this).removeClass('hide');
        });
    }else{
        $('#draggable-answers .draggable-answer').each(function(){
            var answer_options = $(this).find('.answer_title_data').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(answer_options))
                $(this).removeClass('hide');
            else
                $(this).addClass('hide');
        });
    }
}

function fetch_questions(){
    var search_val = $("#questions_search").val();
    search_val = search_val.toLowerCase();
    if(search_val == ''){
        $('#questions_list_wrpr .single_question_block').each(function(){
                $(this).removeClass('hide');
        });
    }else{
        $('#questions_list_wrpr .single_question_block').each(function(){
            var this_question = $(this).find('.question_title_data').html().toLowerCase();
            var regExp = new RegExp(search_val, 'i');
            if(regExp.test(this_question))
                $(this).removeClass('hide');
            else
                $(this).addClass('hide');
        });
    }
}

function addCategory(){
    var newCategory = $("#categery_text").val();
    if(newCategory == ""){
        alert("{$translate.enter_category_name}");
        $("#categery_text").focus();
    }else{
        wrapLoader("#category_manage_wrpr");
        $.ajax({
            url:"{$url_path}S_ajax_category_add.php",
            type:"POST",
            data:encodeURI("category=" + newCategory),
            success:function(data){
                $("#categories_box").html(data);
                $("#categery_text").val('');
                uwrapLoader("#category_manage_wrpr");
            }
        });
    }
}
</script>
{/block}

{block name="survey_manage_inner_content"}
    <div class="tab-pane active">
        <div class="row-fluid">
            <div class="span12 widget-body-section input-group" id="tab-working-panel">
{*                questions create/edit section*}
                {if $display_page neq 'list'}
                    {if $selected_form neq NULL}
                        <div class="span12 filter-bar input-group" id="connected_parent_details">
                            <form>
                                {if $selected_survey neq NULL}
                                    <div class="" style="">
                                        <label>{$translate.survey}:</label>
                                        <div class="badge badge-success badge-survey cursor_hand" onClick="javascript:location='{$url_path}manage/surveys/{$selected_survey}/';">{$selected_survey_title}</div>
                                    </div>
                                {/if}
                                <div style="" class="">
                                    <label>{$translate.form}:</label>
                                    <div class="badge badge-important badge-survey cursor_hand" onClick="javascript:location='{$url_path}manage/forms/{$selected_form}/{if $selected_survey neq NULL}{$selected_survey|cat:'/'}{/if}';">{$selected_form_title}<span class="icon-remove cursor_hand remove_selected_form"></span></div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    {/if}
                    <div class="span12 no-ml">
                        <div class="span3 input-group">
                            <div class="row-fluid">
                                <div class="widget-header span12">
                                    <div class="day-slot-wrpr-header-left pull-left">
                                        <h1>{$translate.ans_types}</h1>
                                    </div>
                                </div>
                                <div class="span12 padding-set" id="forms_section">
                                    <div class="span12 no-ml">
                                        <label style="float: left;" class="span12" for="answertype_search">{$translate.search_question_type}</label>
                                        <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                            <input class="form-control span10" placeholder="{$translate.search_question_type}" id="answertype_search" type="text"  oninput="fetch_answers()"  onemptied="fetch_answers()" /> 
                                        </div>
                                        <div id="draggable-answers" class="row quest-blocks-wrpr span12" tabindex="0">
                                            <div class="span12 answer-tool draggable-answer" id="ctrl_text"  title="Plain Text">
                                                <div class="span12 answer-tool-right">
                                                    <div class="quastion-input-types survey-quation-input-types-textbox"></div>
                                                    <label class="answer_title_data"> {$translate.text_box}</label>
                                                </div>
                                            </div>
                                            <div class="span12 answer-tool draggable-answer" id="ctrl_radio" title="Radio Button">
                                                <div class="span12 answer-tool-right">
                                                    <div class="quastion-input-types survey-quation-input-types-radio"></div>
                                                    <label class="answer_title_data"> {$translate.radio_button}</label>
                                                </div>
                                            </div>
                                            <div class="span12 answer-tool draggable-answer" id="ctrl_check" title="Check Box">
                                                <div class="span12 answer-tool-right">
                                                    <div class="quastion-input-types survey-quation-input-types-check"></div>
                                                    <label class="answer_title_data"> {$translate.check_box}</label>
                                                </div>
                                            </div>
                                            <div class="span12 answer-tool draggable-answer" id="ctrl_combo" title="ComboBox">
                                                <div class="span12 answer-tool-right">
                                                    <div class="quastion-input-types survey-quation-input-types-combo"></div>
                                                    <label class="answer_title_data"> {$translate.combo_box}</label>
                                                </div>
                                            </div>
                                            <div class="span12 answer-tool draggable-answer" id="ctrl_textarea" title="Textarea">
                                                <div class="span12 answer-tool-right">
                                                    <div class="quastion-input-types survey-quation-input-types-textarea"></div>
                                                    <label class="answer_title_data"> {$translate.text_area}</label>
                                                </div>
                                            </div>
                                            <div class="span12 answer-tool draggable-answer" id="ctrl_star_rating" title="Star Rating">
                                                <div class="span12 answer-tool-right">
                                                    <div class="quastion-input-types survey-quation-input-types-starrating"></div>
                                                    <label class="answer_title_data"> {$translate.star_rating}</label>
                                                </div>
                                            </div>
                                            <div class="span12 answer-tool draggable-answer" id="ctrl_custom_rating" title="Custom Rating">
                                                <div class="span12 answer-tool-right">
                                                    <div class="quastion-input-types survey-quation-input-types-customrating"></div>
                                                    <label class="answer_title_data"> {$translate.custom_rating}</label>
                                                </div>
                                            </div>
                                            <div class="span12 answer-tool draggable-answer" id="ctrl_date" title="Date">
                                                <div class="span12 answer-tool-right">
                                                    <div class="quastion-input-types survey-quation-input-types-date"></div>
                                                    <label class="answer_title_data"> {$translate.date}</label>
                                                </div>
                                            </div>
                                            <div class="span12 answer-tool draggable-answer" id="ctrl_file" title="File Upload">
                                                <div class="span12 answer-tool-right">
                                                    <div class="quastion-input-types survey-quation-input-types-fileupload"></div>
                                                    <label class="answer_title_data"> {$translate.file_upload}</label>
                                                </div>
                                            </div>
                                            <div class="span12 answer-tool draggable-answer" id="ctrl_likert" title="Likert Matrix">
                                                <div class="span12 answer-tool-right">
                                                    <div class="quastion-input-types survey-quation-input-types-likertmatrix"></div>
                                                    <label class="answer_title_data"> {$translate.likert_matrix}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {if $selected_form neq NULL}
                                <div class="row-fluid">
                                    <div class="accordion_container"> 
                                        <div class="accordion_head">{$translate.questions}<span class="plusminus">+</span></div> 
                                        <div style="display: none;" class="accordion_body"> 
                                            <div class="row-fluid">
                                                <label style="float: left;" class="span12" for="questions_search">{$translate.search_questions}</label>
                                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                                    <input type="text" class="form-control span11" placeholder="{$translate.search_questions}" id="questions_search" name="questions_search" oninput="fetch_questions()"  onemptied="fetch_questions()" /> 
                                                </div>
                                            </div>
                                            <div class="row-fluid mt">
                                                <div class="span12" id="questions_list_wrpr">
                                                    {foreach $questions as $question}
                                                        <div class="row-fluid single_question_block" id="question_block_{$question.id}">
                                                            <div class="span12 quest-block {if $show_questions eq 1 and $this_question_id eq $question.id}active{/if}" onClick="javascript:location='{$url_path}manage/questions/{$question.id}/{if $selected_form neq NULL}{$selected_form|cat:'/'}{if $selected_survey neq NULL}{$selected_survey|cat:'/'}{/if}{/if}';">
                                                                <div class="row-fluid">
                                                                    <div class="span2 quest-block-left"><div class="quastion-input-types survey-quation-input-types-quastionmark"></div></div>
                                                                    <div class="span8 quest-block-center"><p class="question_title_data">{$question.question}</p></div>
                                                                    <div class="span2 pull-right">
                                                                        {if $question.answer_type eq 1}<div class="quastion-input-types survey-quation-input-types-radio pull-left" style="float: right;"></div>
                                                                        {elseif $question.answer_type eq 2}<div class="quastion-input-types survey-quation-input-types-check pull-left" style="float: right;"></div>
                                                                        {elseif $question.answer_type eq 3}<div class="quastion-input-types survey-quation-input-types-combo pull-left" style="float: right;"></div>
                                                                        {elseif $question.answer_type eq 4}<div class="quastion-input-types survey-quation-input-types-textbox pull-left" style="float: right;"></div>
                                                                        {elseif $question.answer_type eq 5}<div class="quastion-input-types survey-quation-input-types-textarea pull-left" style="float: right;"></div>
                                                                        {elseif $question.answer_type eq 6}<div class="quastion-input-types survey-quation-input-types-starrating pull-left" style="float: right;"></div>
                                                                        {elseif $question.answer_type eq 7}<div class="quastion-input-types survey-quation-input-types-customrating pull-left" style="float: right;"></div>
                                                                        {elseif $question.answer_type eq 8}<div class="quastion-input-types survey-quation-input-types-date pull-left" style="float: right;"></div>
                                                                        {elseif $question.answer_type eq 9}<div class="quastion-input-types survey-quation-input-types-fileupload pull-left" style="float: right;"></div>
                                                                        {elseif $question.answer_type eq 10}<div class="quastion-input-types survey-quation-input-types-likertmatrix pull-left" style="float: right;"></div>{/if}
                                                                        {if $question.status eq 0}<div class="quastion-input-types survey-quation-input-types-lock pull-right"></div>{/if}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {/foreach}
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            {/if}
                        </div>
                        <div class="span9">
                            <div class="row-fluid">
                                <div style="margin: 0px ! important;" class="widget-header span12">
                                    <div class="span12" style="padding: 5px;">
                                        <button class="btn btn-default btn-normal pull-right ml" onClick="javascript:location='{$url_path}manage/questions/NULL/{if $selected_form neq NULL}{$selected_form|cat:'/'}{if $selected_survey neq NULL}{$selected_survey|cat:'/'}{/if}{/if}';"  type="button"><i class='icon-plus'></i> {$translate.new_question}</button>
                                        {if $this_question[0].status != 0 || !isset($this_question[0].status)}
                                            <button class="btn btn-default btn-normal pull-right" id="save_quest" onClick="saveForm(1)" type="button"><i class='icon-save'></i> {$translate.save}</button>
                                            <button class="btn btn-default btn-normal pull-right" onClick="saveForm(0)" type="button"><i class='icon-save'></i> {$translate.save_finalaise}</button>
                                            {if $show_questions eq 1}<button class="btn btn-default btn-normal pull-right" onClick="saveForm(2)" type="button"><i class='icon-trash'></i> {$translate.delete}</button>{/if}
                                        {/if}
                                    </div>
                                </div>     
                            </div>     
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="widget" style="margin-top:0;">
                                        <form method="POST" name="frm_question" id="frm_question">
                                            <input id="action" name="action" type="hidden" value="" />
                                            {if $show_questions eq 1}<input name="this_qid" type="hidden" value="{$this_question_id}" />{/if}
                                            <div class="span12 padding-set">
                                                <div style="" class="row-fluid">
                                                    <label style="float: left;" class="span12" for="txt_question">{$translate.add_question_here}</label>
                                                    <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-edit"></span>
                                                        <input class="form-control span10" id="txt_question" name="txt_question" placeholder="{$translate.add_question_here}" type="text" value="{$this_question[0].question}" {if $this_question[0].status == 0 && $this_question[0].question != ''}readonly="readonly"{/if}/> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span12 padding-set">
                                                <div class="span12 center no-min-height">{$translate.drag_drop_answer_type}</div>
                                                <div class="span12 dragdrop-box no-ml" style="max-height:300px; height: auto !important; overflow-y: auto;">
                                                    {if $show_questions eq 1}
                                                        <div class="row-fluid mb selected_answer_wrpr">
                                                            {if $this_question[0].answer_type eq 4}{*Plain Text*}
                                                                    <div class="span12 no-ml drop-zone">
                                                                        <input type='hidden' name='q_type' value='text' />
                                                                        <div class="row-fluid">
                                                                            <div style="margin:0;" class="span11"><strong>{$translate.text_box}</strong></div>
                                                                            {if $this_question[0].status != 0}<div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>{/if}
                                                                        </div>
                                                                        <div style="margin: 0px;" class="span2">
                                                                            <label for="answer_point" class="span12" style="float: left;">{$translate.point}</label>
                                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>
                                                                                <input type="text" name='answer_point' id='answer_point' value='{$this_question_answers[0].point}' placeholder="{$translate.point}" {if $this_question[0].status == 0}readonly="readonly"{/if} class="form-control span8"/> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="span10">
                                                                            <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>
                                                                            <textarea id='answer_hint' name='answer_hint' placeholder="{$translate.ans_hint}" {if $this_question[0].status == 0}readonly="readonly"{/if} rows="1" class="form-control span12">{$this_question[0].answer_hint}</textarea>
                                                                        </div>
                                                                    </div>
                                                            {elseif $this_question[0].answer_type eq 5}{*Text Area*}
                                                                    <div class="span12 no-ml drop-zone">
                                                                        <input type='hidden' name='q_type' value='textarea' />
                                                                        <div class="row-fluid">
                                                                            <div style="margin:0;" class="span11"><strong>{$translate.text_area}</strong></div>
                                                                            {if $this_question[0].status != 0}<div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>{/if}
                                                                        </div>
                                                                        <div style="margin: 0px;" class="span2">
                                                                            <label for="answer_point" class="span12" style="float: left;">{$translate.point}</label>
                                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>
                                                                                <input type="text" name='answer_point' id='answer_point' value='{$this_question_answers[0].point}' placeholder="{$translate.point}" {if $this_question[0].status == 0}readonly="readonly"{/if} class="form-control span8"/> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="span10">
                                                                            <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>
                                                                            <textarea id='answer_hint' name='answer_hint' placeholder="{$translate.ans_hint}" {if $this_question[0].status == 0}readonly="readonly"{/if} rows="1" class="form-control span12">{$this_question[0].answer_hint}</textarea>
                                                                        </div>
                                                                    </div>
                                                            {elseif $this_question[0].answer_type eq 2}{*check box*}
                                                                    <div class="span12 no-ml drop-zone">
                                                                        <input type='hidden' name='q_type' value='check' />
                                                                        <div class="row-fluid">
                                                                            <div style="margin:0;" class="span11"><strong>{$translate.check_box}</strong></div>
                                                                            {if $this_question[0].status != 0}<div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>{/if}
                                                                        </div>
                                                                        <div class="row-fluid" id="answer_choices">
                                                                            {foreach $this_question_answers as $answer}
                                                                                <div class="span12 no-ml mt ctrl-strip">
                                                                                    <input type="checkbox" name='ckbox[]' value='1' class="pull-left" {if $answer.default_flag eq 1}checked{/if} style="margin-right: 10px ! important;" />
                                                                                    <input type='hidden' name='ckbox[]' value='NULL' />
                                                                                    <div style="margin: 0px;" class="input-prepend span5"> 
                                                                                        <span class="add-on icon-pencil"></span>
                                                                                        <input name='ckbox_txt[]' value='{$answer.answer_text}' type="text" placeholder="{$translate.answer}" class="form-control span11" {if $this_question[0].status == 0}readonly="readonly"{/if}/> 
                                                                                    </div>
                                                                                    {if $this_question[0].status != 0}
                                                                                        <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-add">+</button>
                                                                                        <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove">-</button>
                                                                                    {/if}

                                                                                    <div style="margin: 0px;" class="input-prepend span5"> <span class="add-on icon-pencil"></span>
                                                                                        <input type="text" name='ckbox_point[]' value='{$answer.point}' placeholder="{$translate.point}" class="form-control span11" {if $this_question[0].status == 0}readonly="readonly"{/if} /> 
                                                                                    </div>
                                                                                </div>
                                                                            {/foreach}
                                                                        </div>
                                                                        <div class="row-fluid" style="margin: 5px 0px 0px ! important;">
                                                                            <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>
                                                                            <textarea id='answer_hint' name='answer_hint' placeholder="{$translate.ans_hint}" rows="1" class="form-control span12" {if $this_question[0].status == 0}readonly="readonly"{/if}>{$this_question[0].answer_hint}</textarea>
                                                                        </div>
                                                                        {if $this_question[0].comment_flag eq 1}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <input name='txt_comment' value='' type="text" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}/>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {elseif $this_question[0].comment_flag eq 2}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <textarea name='txtArea_comment' value='' rows="1" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}></textarea>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {/if}
                                                                        {if $this_question[0].status != 0}
                                                                            <div class="row-fluid additional_functions mt no-ml">
                                                                                <div class="span4 no-ml">
                                                                                    <div class="input-prepend span11" style="margin-left: 0px; float: left;">
                                                                                        <span class="add-on icon-pencil"></span>
                                                                                        <select name='ckbox_sel_disp_style' id='select' class="form-control span12">
                                                                                            <option value='1' {if $this_question[0].display_style eq 1}selected{/if}>{$translate.vertical}</option>
                                                                                            <option value='2' {if $this_question[0].display_style eq 2}selected{/if}>{$translate.horizontal}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  
                                                                            </div>
                                                                        {/if}
                                                                    </div>
                                                            {elseif $this_question[0].answer_type eq 1}{*radio box*}
                                                                    <div class="span12 no-ml drop-zone">
                                                                        <input type='hidden' name='q_type' value='radio' />
                                                                        <div class="row-fluid">
                                                                            <div style="margin:0;" class="span11"><strong>{$translate.radio_button}</strong></div>
                                                                            {if $this_question[0].status != 0}<div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>{/if}
                                                                        </div>
                                                                        <div class="row-fluid" id="answer_choices">
                                                                            {foreach $this_question_answers as $answer}
                                                                                <div class="span12 no-ml mt ctrl-strip">
                                                                                    <input type="radio" name='rdbox[]' value='1' class="pull-left" {if $answer.default_flag eq 1}checked{/if} style="margin-right: 10px ! important;" />
                                                                                    <input type='hidden' name='rdbox[]' value='NULL' />
                                                                                    <div style="margin: 0px;" class="input-prepend span5"> 
                                                                                        <span class="add-on icon-pencil"></span>
                                                                                        <input name='rdbox_txt[]' value='{$answer.answer_text}' type="text" placeholder="{$translate.answer}" class="form-control span11" {if $this_question[0].status == 0}readonly="readonly"{/if}/> 
                                                                                    </div>
                                                                                    {if $this_question[0].status != 0}
                                                                                        <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-add">+</button>
                                                                                        <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove">-</button>
                                                                                    {/if}

                                                                                    <div style="margin: 0px;" class="input-prepend span5"> <span class="add-on icon-pencil"></span>
                                                                                        <input type="text" name='rdbox_point[]' value='{$answer.point}' placeholder="{$translate.point}" class="form-control span11" {if $this_question[0].status == 0}readonly="readonly"{/if} /> 
                                                                                    </div>
                                                                                </div>
                                                                            {/foreach}
                                                                        </div>
                                                                        <div class="row-fluid" style="margin: 5px 0px 0px ! important;">
                                                                            <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>
                                                                            <textarea id='answer_hint' name='answer_hint' placeholder="{$translate.ans_hint}" rows="1" class="form-control span12" {if $this_question[0].status == 0}readonly="readonly"{/if}>{$this_question[0].answer_hint}</textarea>
                                                                        </div>
                                                                        {if $this_question[0].comment_flag eq 1}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <input name='txt_comment' value='' type="text" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}/>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {elseif $this_question[0].comment_flag eq 2}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <textarea name='txtArea_comment' value='' rows="1" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}></textarea>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {/if}
                                                                        {if $this_question[0].status != 0}
                                                                            <div class="row-fluid additional_functions mt no-ml">
                                                                                <div class="span4 no-ml">
                                                                                    <div class="input-prepend span11" style="margin-left: 0px; float: left;">
                                                                                        <span class="add-on icon-pencil"></span>
                                                                                        <select name='rdbox_sel_disp_style' id='select' class="form-control span12">
                                                                                            <option value='1' {if $this_question[0].display_style eq 1}selected{/if}>{$translate.vertical}</option>
                                                                                            <option value='2' {if $this_question[0].display_style eq 2}selected{/if}>{$translate.horizontal}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  
                                                                            </div>
                                                                        {/if}
                                                                    </div>
                                                            {elseif $this_question[0].answer_type eq 3}{*combo box*}
                                                                    <div class="span12 no-ml drop-zone">
                                                                        <input type='hidden' name='q_type' value='combo' />
                                                                        <div class="row-fluid">
                                                                            <div style="margin:0;" class="span11"><strong>{$translate.combo_box}</strong></div>
                                                                            {if $this_question[0].status != 0}<div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>{/if}
                                                                        </div>
                                                                        <div class="row-fluid" id="answer_choices">
                                                                            {foreach $this_question_answers as $answer}
                                                                                <div class="span12 no-ml mt ctrl-strip">
                                                                                    <input type="radio" name='cmbbox[]' value='1' class="pull-left" {if $answer.default_flag eq 1}checked{/if} style="margin-right: 10px ! important;" />
                                                                                    <input type='hidden' name='cmbbox[]' value='NULL' />
                                                                                    <div style="margin: 0px;" class="input-prepend span5"> 
                                                                                        <span class="add-on icon-pencil"></span>
                                                                                        <input name='cmbbox_txt[]' value='{$answer.answer_text}' type="text" placeholder="{$translate.answer}" class="form-control span11" {if $this_question[0].status == 0}readonly="readonly"{/if}/> 
                                                                                    </div>
                                                                                    {if $this_question[0].status != 0}
                                                                                        <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-add">+</button>
                                                                                        <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove">-</button>
                                                                                    {/if}

                                                                                    <div style="margin: 0px;" class="input-prepend span5"> <span class="add-on icon-pencil"></span>
                                                                                        <input type="text" name='cmbbox_point[]' value='{$answer.point}' placeholder="{$translate.point}" class="form-control span11" {if $this_question[0].status == 0}readonly="readonly"{/if} /> 
                                                                                    </div>
                                                                                </div>
                                                                            {/foreach}
                                                                        </div>
                                                                        <div class="row-fluid" style="margin: 5px 0px 0px ! important;">
                                                                            <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>
                                                                            <textarea id='answer_hint' name='answer_hint' placeholder="{$translate.ans_hint}" rows="1" class="form-control span12" {if $this_question[0].status == 0}readonly="readonly"{/if}>{$this_question[0].answer_hint}</textarea>
                                                                        </div>
                                                                        {if $this_question[0].comment_flag eq 1}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <input name='txt_comment' value='' type="text" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}/>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {elseif $this_question[0].comment_flag eq 2}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <textarea name='txtArea_comment' value='' rows="1" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}></textarea>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {/if}
                                                                        {if $this_question[0].status != 0}
                                                                            <div class="row-fluid additional_functions mt no-ml">
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  
                                                                            </div>
                                                                        {/if}
                                                                    </div>
                                                            {elseif $this_question[0].answer_type eq 6}{*star rating*}
                                                                    <div class="span12 no-ml drop-zone">
                                                                        <input type='hidden' name='q_type' value='star_rating' />
                                                                        <div class="row-fluid">
                                                                            <div style="margin:0;" class="span11"><strong>{$translate.star_rating}</strong></div>
                                                                            {if $this_question[0].status != 0}<div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>{/if}
                                                                        </div>
                                                                        <div style="margin: 0px;" class="span4">
                                                                            <label for="lower_value" class="span12" style="float: left;">{$translate.lower_value}</label>
                                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>
                                                                                <input type="text" id='lower_value' name='lower_value' value="{$lower_val}" placeholder="{$translate.lower_value}" {if $this_question[0].status == 0}readonly="readonly"{/if} class="form-control span10"/> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="span4">
                                                                            <label for="upper_value" class="span12" style="float: left;">{$translate.upper_value}</label>
                                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>
                                                                                <input type='text' id='upper_value' name='upper_value' value="{$upper_val}" {if $this_question[0].status == 0}readonly="readonly"{/if} placeholder="{$translate.upper_value}" class="form-control span10"/> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="span4">
                                                                            <label for="star_count" class="span12" style="float: left;">{$translate.no_of_stars}</label>
                                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>
                                                                                <input type='text' id='star_count' name='star_count' value="{$star_count}" {if $this_question[0].status == 0}readonly="readonly"{/if} placeholder="{$translate.no_of_stars}" class="form-control span10"> 
                                                                            </div>
                                                                        </div>
                                                                        <div style="margin: 5px 0px 0px ! important;" class="span2">
                                                                            <label for="answer_point" class="span12" style="float: left;">{$translate.point}</label>
                                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>
                                                                                <input type='text' name='answer_point' id='answer_point' value='{$this_question_answers[0].point}' {if $this_question[0].status == 0}readonly="readonly"{/if} placeholder="{$translate.point}" class="form-control span8"/> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="span10" style="margin: 5px 0px 0px;">
                                                                            <label style="float: left;" class="span12" for="answer_hint">{$translate.ans_hint}</label>
                                                                            <textarea id='answer_hint' name='answer_hint' class="form-control span12" rows="1" placeholder="{$translate.ans_hint}" {if $this_question[0].status == 0}readonly="readonly"{/if}>{$this_question[0].answer_hint}</textarea>
                                                                        </div>
                                                                        {if $this_question[0].comment_flag eq 1}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <input name='txt_comment' value='' type="text" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}/>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {elseif $this_question[0].comment_flag eq 2}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <textarea name='txtArea_comment' value='' rows="1" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}></textarea>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {/if}
                                                                        {if $this_question[0].status != 0}
                                                                            <div class="row-fluid additional_functions mt no-ml">
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  
                                                                            </div>
                                                                        {/if}
                                                                    </div>
                                                            {elseif $this_question[0].answer_type eq 7}{*custom rating*}
                                                                    <div class="span12 no-ml drop-zone">
                                                                        <input type='hidden' name='q_type' value='custom_rating' />
                                                                        <div class="row-fluid">
                                                                            <div style="margin:0;" class="span11"><strong>{$translate.custom_rating}</strong></div>
                                                                            {if $this_question[0].status != 0}<div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>{/if}
                                                                        </div>
                                                                        <div style="margin: 0px;" class="span4">
                                                                            <label for="out_of" class="span12" style="float: left;">{$translate.out_of_rate}</label>
                                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>
                                                                                <input type='text' id='out_of' name='out_of' value="{$this_question_answers[0].answer_text}" {if $this_question[0].status == 0}readonly="readonly"{/if} class="form-control span11" placeholder="{$translate.out_of_rate}"/> 
                                                                            </div>
                                                                        </div>
                                                                        <div  class="span4">
                                                                            <label for="answer_point" class="span12" style="float: left;">{$translate.point}</label>
                                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>
                                                                                <input type='text' name='answer_point' id='answer_point' value='{$this_question_answers[0].point}' {if $this_question[0].status == 0}readonly="readonly"{/if} placeholder="{$translate.point}" class="form-control span3"/> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="span12" style="margin: 5px 0px 0px;">
                                                                            <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>
                                                                            <textarea id='answer_hint' name='answer_hint' {if $this_question[0].status == 0}readonly="readonly"{/if} placeholder="{$translate.ans_hint}" rows="1" class="form-control span12">{$this_question[0].answer_hint}</textarea>
                                                                        </div>
                                                                        {if $this_question[0].comment_flag eq 1}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <input name='txt_comment' value='' type="text" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}/>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {elseif $this_question[0].comment_flag eq 2}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <textarea name='txtArea_comment' value='' rows="1" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}></textarea>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {/if}
                                                                        {if $this_question[0].status != 0}
                                                                            <div class="row-fluid additional_functions mt no-ml">
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  
                                                                            </div>
                                                                        {/if}
                                                                    </div>
                                                            {elseif $this_question[0].answer_type eq 8}{*date*}
                                                                    <div class="span12 no-ml drop-zone">
                                                                        <input type='hidden' name='q_type' value='date' />
                                                                        <div class="row-fluid">
                                                                            <div style="margin:0;" class="span11"><strong>{$translate.date_field}</strong></div>
                                                                            {if $this_question[0].status != 0}<div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>{/if}
                                                                        </div>
                                                                        <div style="margin: 0px;" class="row-fluid">
                                                                            <label for="answer_point" class="span12" style="float: left;">{$translate.point}</label>
                                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>
                                                                                <input type='text' name='answer_point' id='answer_point' value='{$this_question_answers[0].point}' {if $this_question[0].status == 0}readonly="readonly"{/if} class="form-control span11" placeholder="{$translate.point}"/> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="row-fluid" style="margin: 5px 0px 0px;">
                                                                            <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>
                                                                            <textarea id='answer_hint' name='answer_hint' {if $this_question[0].status == 0}readonly="readonly"{/if} placeholder="{$translate.ans_hint}" rows="1" class="form-control span12">{$this_question[0].answer_hint}</textarea>
                                                                        </div>
                                                                        {if $this_question[0].comment_flag eq 1}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <input name='txt_comment' value='' type="text" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}/>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {elseif $this_question[0].comment_flag eq 2}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <textarea name='txtArea_comment' value='' rows="1" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}></textarea>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {/if}
                                                                        {if $this_question[0].status != 0}
                                                                            <div class="row-fluid additional_functions mt no-ml">
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  
                                                                            </div>
                                                                        {/if}
                                                                    </div>
                                                            {elseif $this_question[0].answer_type eq 9}{*file*}
                                                                    <div class="span12 no-ml drop-zone">
                                                                        <input type='hidden' name='q_type' value='file' />
                                                                        <div class="row-fluid">
                                                                            <div style="margin:0;" class="span11"><strong>{$translate.file}</strong></div>
                                                                            {if $this_question[0].status != 0}<div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>{/if}
                                                                        </div>
                                                                        <div style="margin: 0px;" class="row-fluid">
                                                                            <label for="answer_point" class="span12" style="float: left;">{$translate.point}</label>
                                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon-pencil"></span>
                                                                                <input type='text' name='answer_point' id='answer_point' value='{$this_question_answers[0].point}' {if $this_question[0].status == 0}readonly="readonly"{/if} class="form-control span11" placeholder="{$translate.point}"/> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="row-fluid" style="margin: 5px 0px 0px;">
                                                                            <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>
                                                                            <textarea id='answer_hint' name='answer_hint' {if $this_question[0].status == 0}readonly="readonly"{/if} placeholder="{$translate.ans_hint}" rows="1" class="form-control span12">{$this_question[0].answer_hint}</textarea>
                                                                        </div>
                                                                        {if $this_question[0].comment_flag eq 1}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <input name='txt_comment' value='' type="text" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}/>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {elseif $this_question[0].comment_flag eq 2}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <textarea name='txtArea_comment' value='' rows="1" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}></textarea>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {/if}
                                                                        {if $this_question[0].status != 0}
                                                                            <div class="row-fluid additional_functions mt no-ml">
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  
                                                                            </div>
                                                                        {/if}
                                                                    </div>
                                                            {elseif $this_question[0].answer_type eq 10}{*likert*}
                                                                    <div class="span12 no-ml drop-zone">
                                                                        <input type='hidden' name='q_type' value='likert' />
                                                                        <div class="row-fluid">
                                                                            <div style="margin:0;" class="span11"><strong>{$translate.likert_matrix}</strong></div>
                                                                            {if $this_question[0].status != 0}<div class="span1 pull-right"><button aria-hidden="true" data-dismiss="modal" class="close ctrlstrip-close" type="button">×</button></div>{/if}
                                                                        </div>
                                                                        <div class="row-fluid" id="likertmatrix_questions">
                                                                            <label class="span12" style="float: left;">{$translate.questions}</label>
                                                                            {foreach $sub_questions as $sub_question}
                                                                                <div class="span12 no-ml mt ctrl-strip">
                                                                                    <div style="margin: 0px;" class="input-prepend span5"> 
                                                                                        <span class="add-on icon-pencil"></span>
                                                                                        <input name='subquestion[]' type='text' value='{$sub_question.question}' {if $this_question[0].status == 0}readonly="readonly"{/if} placeholder="{$translate.questions}" class="form-control span11"/> 
                                                                                    </div>
                                                                                    {if $this_question[0].status != 0}
                                                                                        <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-add">+</button>
                                                                                        <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove">-</button>
                                                                                    {/if}
                                                                                </div>
                                                                            {/foreach}
                                                                        </div>
                                                                        <div class="row-fluid" id="likertmatrix_colum_choice">
                                                                            <label class="span12" style="float: left;">{$translate.column_choice}</label>
                                                                            {foreach $this_question_answers as $answer}
                                                                                <div class="span12 no-ml mt ctrl-strip">
                                                                                    <div style="margin: 0px;" class="input-prepend span5"> 
                                                                                        <span class="add-on icon-pencil"></span>
                                                                                        <input name='subcolumn[]' type='text' value='{$answer.answer_text}' {if $this_question[0].status == 0}readonly="readonly"{/if} placeholder="{$translate.column_choice}" class="form-control span11"/> 
                                                                                    </div>
                                                                                    {if $this_question[0].status != 0}
                                                                                        <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-add">+</button>
                                                                                        <button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove">-</button>
                                                                                    {/if}

                                                                                    <div style="margin: 0px;" class="input-prepend span5"> <span class="add-on icon-pencil"></span>
                                                                                            <input type='text' name='point[]' value='{$answer.point}' placeholder="{$translate.point}" class="form-control span11" {if $this_question[0].status == 0}readonly="readonly"{/if} /> 
                                                                                    </div>
                                                                                </div>
                                                                            {/foreach}
                                                                        </div>

                                                                        <div class="row-fluid" style="margin: 5px 0px 0px ! important;">
                                                                            <label for="answer_hint" class="span12" style="float: left;">{$translate.ans_hint}</label>
                                                                            <textarea id='answer_hint' name='answer_hint' {if $this_question[0].status == 0}readonly="readonly"{/if} placeholder="{$translate.ans_hint}" rows="1" class="form-control span12">{$this_question[0].answer_hint}</textarea>
                                                                        </div>
                                                                        {if $this_question[0].comment_flag eq 1}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <input name='txt_comment' value='' type="text" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}/>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {elseif $this_question[0].comment_flag eq 2}
                                                                            <div class="row-fluid comment_wrpr" style="margin: 5px 0px 0px ! important;">
                                                                                <textarea name='txtArea_comment' value='' rows="1" class="form-control span11" placeholder="{$translate.user_comment_area}" {if $this_question[0].status == 0}readonly="readonly"{/if}></textarea>
                                                                                {if $this_question[0].status != 0}<button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set plus-minus-btn ctrlstrip-remove-comment">-</button>{/if}
                                                                            </div>
                                                                        {/if}
                                                                        {if $this_question[0].status != 0}
                                                                            <div class="row-fluid additional_functions mt no-ml">
                                                                                <div class="span4 no-ml">
                                                                                    <div class="input-prepend span11" style="margin-left: 0px; float: left;">
                                                                                        <span class="add-on icon-pencil"></span>
                                                                                        <select name='sel_disp_style' id='select' class="form-control span12">
                                                                                            <option value='1' {if $this_question[0].display_style eq 1}selected{/if}>{$translate.vertical}</option>
                                                                                            <option value='2' {if $this_question[0].display_style eq 2}selected{/if}>{$translate.horizontal}</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textbox_btn">{$translate.add_textbox_for_comment}</button></div>  
                                                                                <div class="span4 action_ctrl_wrpr{if $this_question[0].comment_flag eq 1 or $this_question[0].comment_flag eq 2} hide{/if}"><button type="button" style="margin: 0px ! important;" class="btn btn-default btn-margin-set span12 add_textarea_btn">{$translate.add_textarea_for_comment}</button></div>  
                                                                            </div>
                                                                        {/if}
                                                                    </div>
                                                            {/if}
                                                        </div>
                                                    {/if}
                                            </div>
                                                        
{*                                            categories*}
                                                <div id="category_manage_wrpr" class="span12 input-group mt no-ml" style="padding: 10px 0px 0px;">
                                                    <div class="span12" id="categories_box" style="overflow-y: auto; max-height: 100px;">
                                                        {foreach $categories as $category}
                                                            <label class="checkbox-inline"><input name="categories[]" type="checkbox" value="{$category.id}" {if $show_questions eq 1 and in_array($category.id, $question_categories)} checked="checked" {/if} class="check-box catagory_entry" style="margin: 0px 5px 0px 10px ! important;"> {$category.category_name}</label>
                                                        {/foreach}
                                                    </div>
                                                    <div class="span12 padding-set">
                                                        <div style="" class="span8">
                                                            <label for="categery_text" class="span12" style="float: left;">{$translate.add_new_categary}</label>
                                                            <div class="input-prepend span12" style="margin: 0px;"> <span class="add-on icon icon-plus"></span>
                                                                <input type="text" name="categery_text" id="categery_text" placeholder="{$translate.add_new_categary}" class="form-control span11"> 
                                                            </div>
                                                        </div>
                                                        <div class="span4">
                                                            <button type="button" onclick="addCategory();" style="margin: 25px 0px 0px ! important;" class="btn btn-default span12 btn-margin-set"><i class="icon-plus"></i> {$translate.add}</button>
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
                {else}
                                            
{*                questions listing section*}
                    <div class="span12 no-ml mt">
                        <div class="widget-header span12">
                            <div class="day-slot-wrpr-header-left pull-left">
                                <h1>{$translate.questions}</h1>
                            </div>
                            <div style="padding: 5px;">
                                <button class="btn btn-default btn-normal pull-right ml" onClick="javascript:location='{$url_path}manage/questions/NULL/{if $selected_form neq NULL}{$selected_form|cat:'/'}{if $selected_survey neq NULL}{$selected_survey|cat:'/'}{/if}{/if}';"  type="button"><i class='icon-plus'></i> {$translate.new_question}</button>
                            </div>
                        </div>
                        <div class="span12 widget-body-section input-group">
                            <div class="span12">
                                <label style="float: left;" class="span12" for="questions_search">{$translate.search_questions}</label>
                                <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon icon-search"></span>
                                    <input type="text" class="form-control span11" placeholder="{$translate.search_questions}" id="questions_search" name="questions_search" oninput="fetch_questions()"  onemptied="fetch_questions()" /> 
                                </div>
                                <div tabindex="0" style="overflow-y: auto; max-height: 300px;" class="row no-ml span12" id="questions_list_wrpr">
                                    {foreach $questions as $question}
                                        <div class="row-fluid single_question_block" id="question_block_{$question.id}">
                                            <div class="span12 quest-block" onClick="javascript:location='{$url_path}manage/questions/{$question.id}/';">
                                                <div class="row-fluid">
                                                    <div class="quest-block-left"><div class="quastion-input-types survey-quation-input-types-quastionmark"></div></div>
                                                    <div class="span10 quest-block-center"><p class="question_title_data">{$question.question}</p></div>
                                                    <div class="span1 pull-right">
                                                        {if $question.answer_type eq 1}<div class="quastion-input-types survey-quation-input-types-radio pull-left" style="float: right;"></div>
                                                        {elseif $question.answer_type eq 2}<div class="quastion-input-types survey-quation-input-types-check pull-left" style="float: right;"></div>
                                                        {elseif $question.answer_type eq 3}<div class="quastion-input-types survey-quation-input-types-combo pull-left" style="float: right;"></div>
                                                        {elseif $question.answer_type eq 4}<div class="quastion-input-types survey-quation-input-types-textbox pull-left" style="float: right;"></div>
                                                        {elseif $question.answer_type eq 5}<div class="quastion-input-types survey-quation-input-types-textarea pull-left" style="float: right;"></div>
                                                        {elseif $question.answer_type eq 6}<div class="quastion-input-types survey-quation-input-types-starrating pull-left" style="float: right;"></div>
                                                        {elseif $question.answer_type eq 7}<div class="quastion-input-types survey-quation-input-types-customrating pull-left" style="float: right;"></div>
                                                        {elseif $question.answer_type eq 8}<div class="quastion-input-types survey-quation-input-types-date pull-left" style="float: right;"></div>
                                                        {elseif $question.answer_type eq 9}<div class="quastion-input-types survey-quation-input-types-fileupload pull-left" style="float: right;"></div>
                                                        {elseif $question.answer_type eq 10}<div class="quastion-input-types survey-quation-input-types-likertmatrix pull-left" style="float: right;"></div>{/if}
                                                        {if $question.status eq 0}<div class="quastion-input-types survey-quation-input-types-lock pull-right"></div>{/if}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {/foreach}
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}
            </div>
        </div>
    </div>
{/block}