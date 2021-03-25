{foreach from=$customer_data item=data}
                    <div class="comments_history clearfix">
                        <label for="ovrig">{$translate.back_history}</label>
                        <textarea name="history" id="history" cols="32" >{$data.history}</textarea>
                        <input name="person_num" id="person_num" type="hidden" value="" />
                        <input name="id" id="id" type="hidden" value="" />
                    </div>
                    <div class="comments_history clearfix">
                        <label for="ovrig">{$translate.diagnosis}</label>
                        <textarea name="diagnosis" id="diagnosis"  cols="32" >{$data.diagnosis}</textarea>
                    </div>
                    <div class="comments_history clearfix">
                        <label for="ovrig">{$translate.mission}</label>
                        <textarea name="mission" id="mission"  cols="32" >{$data.mission}</textarea>
                    </div>
                    <div class="comments_history clearfix">
                        <label for="ovrig">{$translate.cust_mail}</label>
                        <textarea name="mail" id="mail"  cols="32" >{$data.email}</textarea>
                    </div>
                    <div class="comments_history clearfix">
                        <label for="ovrig">{$translate.intervention_detail}</label>
                        <textarea name="intervention_detail"  cols="32" id="ovrig">{$data.intervention}</textarea>
                    </div>
                    <div class="comments_boxe">
                        <div class="working">
                            <div class="work_detail">
                                <label for="arbete">{$translate.work}</label>
                                <select name="work" id="work" >
                                    <option value="">{$translate.select}</option>
                                    <option value="School">School</option>
                                    <option value="Hospital">Hospital</option>
                                    <option value="Bank">Bank</option>
                                </select>
                            </div>
                            <div class="work_detail">
                                <label for="telefon">{$translate.telephone}</label>
                                <input type="text" name="telephone" id="telephone"  value="{$data.phone}" />
                            </div>
                        </div>
                        <div class="comment">
                            <div class="commenter">
                                <label for="kammentar">{$translate.comment}</label>
                                <textarea name="comment_work" id="comment_work"  cols="45" rows="5">{$data.work_comment}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="comments_boxe">
                        <div class="working">
                            <div class="work_detail"><label>{$translate.travel}</label></div>
                                <div class="work_detail_check">
                                    <input type="checkbox" name="fardtjanst" class="clear_chek" value="fardtjanst"  id="fardtjanst" />
                                    <label for="fardtjanst">{$translate.trans_serv}</label></div>
                                <div class="work_detail_check"></label>
                                    <input type="checkbox" name="egenbil" value="egenbil" class="clear_chek" id="egenbil"  />
                                    <label for="Egen Bil">{$translate.own_car}</label>
                                </div>
                                <div class="work_detail_check">
                                    <input type="checkbox" name="annat" id="annat" class="clear_chek" value="annat"  />
                                    <label for="annat">{$translate.other}</label>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="commenter">
                                    <label for="kammentar">{$translate.comment}</label>
                                    <textarea name="comment_travel" id="comment_travel"  cols="45" rows="5">{$data.travel_comment}</textarea>
                                </div>
                            </div>
                    </div>
    {/foreach}
  