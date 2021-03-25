{block name="content"}

    <div class="tbl_hd"><span class="titles_tab">{$translate.appoiment_detail}&nbsp;&nbsp;<b>({$customer->getCustomerName($appoiments_arr[0].customer)})<b/></span>
        <a class="back" href="{$url_path}{if $user_role neq 4}customer/appoiments/{$appoiments_arr[0].customer}/{else}appointments/{$appoiments_arr[0].customer}/{/if}" >{$translate.backs}</a></div>
        
    <div id="tble_list">
   <div class="inconvenient_table">
        <table class="table_list" id="tbl1">
        <tbody>
           <tr class="even" >
            <td width="40%">{$translate.appoiment_date}</td><td>{$appoiments_arr[0].appoiment_date}</td>
            </tr>
           
            <tr class="odd">
           		 <td>{$translate.appoiment_address}</td><td>{$appoiments_arr[0].appoiment_address}</td>
           	</tr>
            <tr class="even">	 
                 <td>{$translate.phone_number}</td>
                <td>{$appoiments_arr[0].phone_number}</td>
            </tr>
            <tr class="odd">
            	<td>{$translate.appoiment_reason}</td><td>{$appoiments_arr[0].reason}</td>
            </tr>
             <tr class="even">
            	<td>{$translate.appoiment_remarks}</td><td>{$appoiments_arr[0].remarks}</td>
            </tr>
             <tr class="odd">
           		 <td>{$translate.contact_person_name}</td><td>{$appoiments_arr[0].contact_person_name}</td>
           	</tr>
            <tr class="even">	 
                 <td>{$translate.phone_number_cp}</td>
                <td>{$appoiments_arr[0].phone_number_cp}</td>
            </tr>
            <tr class="odd">
            	<td>{$translate.email_cp}</td><td>{$appoiments_arr[0].email_cp}</td>
            </tr>
            <tr class="even">
            	<td>{$translate.remind_me_approintment_over_email}</td><td>
                {if $appoiments_arr[0].email_alert eq 1}{$translate.label_yes}{else}{$translate.label_no}{/if}</td>
            </tr>
            {if $appoiments_arr[0].email_alert eq 1}
            <tr class="odd">
            	<td>{$translate.email}</td><td>
                {$appoiments_arr[0].cust_email}</td>
            </tr>
            {/if}
             <tr class="even">
            	<td>{$translate.remind_me_about_this_approintment_over_sms}</td><td>
                {if $appoiments_arr[0].sms_alert eq 1}{$translate.label_yes}{else}{$translate.label_no}{/if}</td>
            </tr>
            {if $appoiments_arr[0].sms_alert eq 1}
            <tr class="odd">
            	<td>{$translate.phone_number} ({$translate.number_where_alert_should_sent})</td><td>
                {$appoiments_arr[0].cust_number}</td>
            </tr>
            {/if}
            {if $appoiments_arr[0].email_alert eq 1 || $appoiments_arr[0].sms_alert eq 1}
            <tr class="even">
            	<td>{$translate.reminder_before}</td><td>{$appoiments_arr[0].reminder_before_date} {$appoiments_arr[0].reminder_time}</td>
            </tr>
            {/if}
             
           </tbody></table>
    </div>
    <div style="clear:both">
    </div>
 </div>   
{/block}