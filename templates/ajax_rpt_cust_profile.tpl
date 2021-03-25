{block name="style"}
    <style type="text/css">
        .label-data { width:40%;}
        .data-wrpr .child-slots-profile-two { width:100% !important; } 
        .data{ width:60%;} 
        .data-wrpr{ 
            margin-bottom: 1px;
            float: left;
            width: 90%;
            padding: 5px;
            margin: 0 10px;
            font-size: 12px;}
        .box-wrpr{
            float: left;
            width: 45%;
            text-align: left;
            position: relative;
            height: 295px;
            margin: 0px 0px 20px 28px;
            border: thin solid #B9B9B9;
            /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffffff+0,f6f6f6+47,ededed+100;White+3D+%231 */
            background: #ffffff; /* Old browsers */
            background: -moz-linear-gradient(top, #ffffff 0%, #f6f6f6 47%, #ededed 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(47%,#f6f6f6), color-stop(100%,#ededed)); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(top, #ffffff 0%,#f6f6f6 47%,#ededed 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(top, #ffffff 0%,#f6f6f6 47%,#ededed 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(top, #ffffff 0%,#f6f6f6 47%,#ededed 100%); /* IE10+ */
            background: linear-gradient(to bottom, #ffffff 0%,#f6f6f6 47%,#ededed 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=0 ); /* IE6-9 */
            overflow: auto;
            overflow-x: hidden;}

        .data-wrpr:nth-of-type(2n+1) {
            background-color: rgba(230, 230, 230, 1);
        }
        .box-wrpr h4{  color: #FFF;
                       background: #78BCCC none repeat scroll 0% 0%;
                       padding: 6px;
                       font-size: 14px;}
        @media screen and (max-width:809px) {
            .box-wrpr{ width:90%;}
        }
        @media screen and (max-width:767px) {
            .box-wrpr { margin: 10px 0 !important; width:97% !important;}
        }
    </style>
{/block}
{block name="script"}
    <script src="{$url_path}js/jquery-1.10.1.min.js"></script>
{/block}
{block name="content"}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">
            {if $sort_by_name == 1}{$customer_detail.first_name} {$customer_detail.last_name}
            {elseif $sort_by_name == 2}{$customer_detail.last_name} {$customer_detail.first_name}
            {/if}
        </h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="box-wrpr">
                <h4>{$translate.personal_information}</h4>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.social_security}</div>  
                    <div class="pull-right data"><strong>{$customer_detail.social_security}</strong></div>
                </div>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.first_name}</div>  
                    <div class="pull-right data"><strong>{$customer_detail.first_name}</strong></div>
                </div>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.last_name}</div>  
                    <div class="pull-right data"><strong>{$customer_detail.last_name}</strong></div>
                </div>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.gender}</div>  
                    <div class="pull-right data"><strong>{if $customer_detail.gender == 1}{$translate.male}{else}{$translate.female}{/if}</strong></div>
                </div>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.customer_code}</div>  
                    <div class="pull-right data"><strong>{$customer_detail.code}</strong></div>
                </div>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.address}</div>  
                    <div class="pull-right data"><strong>{$customer_detail.address}</strong></div>
                </div>

                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.post}</div>  
                    <div class="pull-right data"><strong>{$customer_detail.post}</strong></div>
                </div>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.city}</div>  
                    <div class="pull-right data"><strong>{$customer_detail.city} </strong></div>
                </div>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$customer_detail.phone}</div>  
                    <div class="pull-right data"><strong>{$customer_detail.phone}</strong></div>
                </div>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.mobile}</div>  
                    <div class="pull-right data"><strong>{$customer_detail.mobile}</strong></div>
                </div>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.email}</div>  
                    <div class="pull-right data"><strong>{$customer_detail.email}</strong></div>
                </div>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.fk_kn}</div>  
                    <div class="pull-right data"><strong>{if $customer_detail.fkkn == '1'}{$translate.fk}{else}{$translate.kn}{/if}</strong></div>
                </div>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.date}</div>  
                    <div class="pull-right data"><strong>{$customer_detail.date}</strong></div>
                </div>
            </div>

            <div class="box-wrpr">
                <h4>{$translate.relatives}</h4>
                <div style="margin: 0px 10px;" class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        {foreach $customer_relatives as $relative}     
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 style="background: rgb(191, 233, 255) none repeat scroll 0% 0%; border: thin solid rgb(157, 200, 221); padding: 4px;" class="panel-title">
                                    <a style="color:#333;" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        {$relative.relation}
                                    </a>
                                </h4>
                            </div>
                            <div style="height: 0px;" id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div style="padding: 10px 0px;" class="panel-body">
                                    <div class="data-wrpr">
                                        <div class="label-data pull-left">{$translate.name}</div>  
                                        <div class="pull-right data"><strong>{$relative.name}</strong></div>
                                    </div>
                                    <div class="data-wrpr">
                                        <div class="label-data pull-left">Phone</div>  
                                        <div class="pull-right data"><strong>{$relative.phone}</strong></div>
                                    </div>
                                    <div class="data-wrpr">
                                        <div class="label-data pull-left">{$translate.relation}</div>  
                                        <div class="pull-right data"><strong>{$relative.relation}</strong></div>
                                    </div>

                                    <div class="data-wrpr">
                                        <div class="label-data pull-left">Address</div>  
                                        <div class="pull-right data"><strong>{$relative.address}</strong></div>
                                    </div>

                                    <div class="data-wrpr">
                                        <div class="label-data pull-left">City</div>  
                                        <div class="pull-right data"><strong>{$relative.city}</strong></div>
                                    </div>
                                    <div class="data-wrpr">
                                        <div class="label-data pull-left">Phone work</div>  
                                        <div class="pull-right data"><strong>{$relative.work_phone}</strong></div>
                                    </div>
                                    <div class="data-wrpr">
                                        <div class="label-data pull-left">Mobile</div>  
                                        <div class="pull-right data"><strong>{$relative.mobile}</strong></div>
                                    </div>
                                    <div class="data-wrpr">
                                        <div class="label-data pull-left">Email</div>  
                                        <div class="pull-right data"><strong>{$relative.email}</strong></div>
                                    </div>
                                    <div class="data-wrpr">
                                        <div class="label-data pull-left">other_customer_relation</div>  
                                        <div class="pull-right data"><strong>{$relative.other}</strong></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        {foreachelse}      
                            
                                {$translate.no_relatives}
                           
                        {/foreach}        
                    </div>
                </div>
            </div>

            <div class="box-wrpr">
                <h4>{$translate.additional_information}</h4>
                {if !empty($customer_health)}
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.health_care}</div>  
                    <div class="pull-right data"><strong>{$customer_health.health_care}</strong></div>
                </div>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.occupational_therapists}</div>  
                    <div class="pull-right data"><strong>{$customer_health.occupational_therapists}</strong></div>
                </div>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.physiotherapists}</div>  
                    <div class="pull-right data"><strong>{$customer_health.physiotherapists}</strong></div>
                </div>
                <div class="data-wrpr">
                    <div class="label-data pull-left">{$translate.other}</div>  
                    <div class="pull-right data"><strong>{$customer_health.other}</strong></div>
                </div>
                {else}
                    {$translate.no_additional_information}
                {/if}    
            </div>
            <div class="box-wrpr">
                <h4>{$translate.attached_assistants}</h4>
                <div class="data-wrpr" style="background: none;">
                    {foreach $customer_team as $employee}
                        <div id="adgi001" class="child-slots-profile-two" >
                            <span class="glyphicons icon-minus pull-right remove-child-slots" title="Koppla bort assistent från kund"></span>
                            <span>
                            {if $sort_by_name == 1}{$employee.name_ff}
                            {elseif $sort_by_name == 2}{$employee.name}
                            {/if}
                            <span class="pull-right">{$employee.code}</span>
                        </span>
                    </div>
                {foreachelse}
                    {$translate.no_employees_attached}
                {/foreach}
            </div>

        </div>
        {*<div class="box-wrpr">
        <h4>The customer's order</h4>
        <div class="data-wrpr">
        <div class="label-data pull-left">From Date</div>  
        <div class="pull-right data"><strong>M</strong></div>
        </div>
        <div class="data-wrpr">
        <div class="label-data pull-left">To Date</div>  
        <div class="pull-right data"><strong>M</strong></div>
        </div>
        <div class="data-wrpr">
        <div class="label-data pull-left">Granted Hours</div>  
        <div class="pull-right data"><strong>M</strong></div>
        </div>
        <div class="data-wrpr">
        <div class="label-data pull-left">FK/KN</div>  
        <div class="pull-right data"><strong>M</strong></div>
        </div>
        <div class="data-wrpr">
        <div class="label-data pull-left">Remaining from grant. h</div>  
        <div class="pull-right data"><strong>M</strong></div>
        </div>
        <div class="data-wrpr">
        <div class="label-data pull-left">Exercised call hour</div>  
        <div class="pull-right data"><strong>M</strong></div>
        </div>
        </div>*}
        <div class="box-wrpr">
            <h4>{$translate.guardian}</h4>
            {if $customer_guardian.first_name}
            <div class="data-wrpr">
                <div class="label-data pull-left">{$translate.first_name}</div>  
                <div class="pull-right data"><strong>{$customer_guardian.first_name}</strong></div>
            </div>
            <div class="data-wrpr">
                <div class="label-data pull-left">{$translate.last_name}</div>  
                <div class="pull-right data"><strong>{$customer_guardian.last_name}</strong></div>
            </div>
            <div class="data-wrpr">
                <div class="label-data pull-left">{$translate.mobile}</div>  
                <div class="pull-right data"><strong>{$customer_guardian.mobile}</strong></div>
            </div>
            <div class="data-wrpr">
                <div class="label-data pull-left">{$translate.email}</div>  
                <div class="pull-right data"><strong>{$customer_guardian.email}</strong></div>
            </div>
            <div class="data-wrpr">
                <div class="label-data pull-left">{$translate.address}</div>  
                <div class="pull-right data"><strong>{$customer_guardian.address}</strong></div>
            </div>
            {else}
                {$translate.no_guardian_information}
            {/if}
            
        </div>
        <div class="box-wrpr">
            <h4>{$translate.guardian2}</h4>
            {if $customer_guardian.first_name2}
            <div class="data-wrpr">
                <div class="label-data pull-left">{$translate.first_name}</div>  
                <div class="pull-right data"><strong>{$customer_guardian.first_name2}</strong></div>
            </div>
            <div class="data-wrpr">
                <div class="label-data pull-left">{$translate.last_name}</div>  
                <div class="pull-right data"><strong>{$customer_guardian.last_name2}</strong></div>
            </div>
            <div class="data-wrpr">
                <div class="label-data pull-left">{$translate.mobile}</div>  
                <div class="pull-right data"><strong>{$customer_guardian.mobile2}</strong></div>
            </div>
            <div class="data-wrpr">
                <div class="label-data pull-left">{$translate.email}</div>  
                <div class="pull-right data"><strong>{$customer_guardian.email2}</strong></div>
            </div>
            <div class="data-wrpr">
                <div class="label-data pull-left">{$translate.address}</div>  
                <div class="pull-right data"><strong>{$customer_guardian.address2}</strong></div>
            </div>
            {else}
                {$translate.no_guardian_information}
            {/if}
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{$translate.close}</button>
    </div>
</div>
{/block}