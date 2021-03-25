 <table class="table_list" style="text-align:left; font-size:12px; width: 100%;">
                <tbody>
                    <tr>
                         
                        <th>{$translate.social_security_number}</th>
                        <th>{$translate.name}</th>
                        <th style="width: 100px;">{$translate.mobile_phone}</th>
                        <th>{$translate.gender}</th>
                        <th>{$translate.city}</th>
                        
                        <th>{$translate.date_of_interview}</th>
                        <th>{$translate.created_date}</th>
                    
                    
                        <th style="width: 30px;"><a href="javascript:void(0);" onclick="loadSortedCandidates('0')" style="text-decoration: underline" title="{$translate.applied}">{$translate.applied_short}</a></th>
                        <th style="width: 30px;"><a href="javascript:void(0);" onclick="loadSortedCandidates('1')" style="text-decoration: underline" title="{$translate.interview_called}">{$translate.interview_called_short}</a></th>
                            
                          
                    </tr>
                    {foreach $applicants AS $applicant}

                        <tr class="{cycle values="even,odd"}" >

                           

                            
                            <td>{$applicant.personal_number}</td>
                            <td><a href="{$url_path}view/recruitment/applicant/{$applicant.id}/" style="border-bottom: 1px dashed #999;">{$applicant.last_name} {$applicant.first_name}</a></td>
                            <td>{if $applicant.mobile != ''}{$applicant.mobile}{else}{$applicant.telephone}{/if}</td>
                            <td>{if $applicant.gender == 1}{$translate.male}{elseif $applicant.gender == 0}{$translate.female}{/if}</td>
                            <td >{$applicant.city}</td>
                            <td >{$applicant.date_of_interview}</td>
                            <td >{if $applicant.created_date neq ''}{$applicant.created_date|date_format:'Y-m-d'}{/if}</td>
                           
                                {if $applicant.status == ""}<td style="text-align: center"><img src="{$url_path}images/recruitment_tick.png" /></td><td></td>{/if}
                                {if $applicant.status == 1}<td></td><td style="text-align: center"><img src="{$url_path}images/recruitment_tick.png" /></td>{/if}
                                {if $applicant.status == 2}<td></td><td></td><td style="text-align: center"><img src="{$url_path}images/recruitment_tick.png" /></td><td></td><td></td>{/if}
                                {*if $applicant.status == 3}<td></td><td></td><td></td><td style="text-align: center"><img src="{$url_path}images/recruitment_tick.png" /></td><td></td>{/if}
                                {if $applicant.status == 4}<td></td><td></td><td></td><td></td><td style="text-align: center"><img src="{$url_path}images/recruitment_tick.png" /></td>{/if*}
                                {if $applicant.status == 5}<td colspan="2" style="text-align: center;color: #CA226B">{$translate.selected_employee}</td>{/if}
                           
                        </tr>
                    {foreachelse}
                    <td colspan="12"><div class="message">{$translate.no_data_available}</div></td>
                {/foreach}

                </tbody>
            </table>