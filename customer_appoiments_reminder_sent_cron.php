<?php
require_once('configs/config.inc.php');
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/sms.php');
require_once('class/company.php');
require_once ('class/equipment.php');
require_once('class/employee.php');
$smarty_mail    = new smartySetup(array("mail.xml", "messages.xml"),FALSE);
$company_obj    = new company();
$obj_eq         = new equipment();
$obj_employee   = new employee();

global $preference, $company;
//http://192.168.0.234/works/app/t2v/cirrus-r/customer_appoiments_reminder_sent_cron.php

//date_default_timezone_set('CET');
$start_time = new DateTime;
$start_time->setTimezone(new DateTimeZone('Europe/Stockholm'));
$cur_dtime = $start_time->format('Y-m-d G:i');
//echo "<pre>".print_r($preference, 1)."</pre>";
//$cur_dtime = date('Y-m-d H:i:s');
$cur_time = strtotime($cur_dtime);

$translate = $smarty_mail->localise->contents;
$companies = $company_obj->company_list();
//echo "<pre>".print_r($companies, 1)."</pre>";
$filename = "/var/www/vhosts/u4886173-01.vps.fsdata.se/time2view.se/cirrus/check.txt";
$handle = fopen($filename, 'a');
    fwrite($handle, "I am here"."\n");
    fclose($handle);
foreach($companies as $single_company){
    $customer = new customer();
    $customer->select_db($single_company['db_name']);
    $from = $single_company['name']."@time2view.se";
    $appoiments_arr = $customer->get_appoiments_reminder();
    //echo "<pre>".print_r($appoiments_arr, 1)."</pre>";
    if(!empty($appoiments_arr)){
        foreach($appoiments_arr as $appoiments){
            $reminder_before_date   = $appoiments["reminder_before_date"];
            $reminder_time          = $appoiments["reminder_time"];
            $totalSecondLeft        = $appoiments["totalSecondLeft"];
            $email_alert            = $appoiments["email_alert"];
            $sms_alert              = $appoiments["sms_alert"];
            $appoiment_date         = $appoiments["appoiment_date"];
            $last_alert_time        = $appoiments["last_alert_time"];
            $last_alert_sent_before = $appoiments["last_alert_sent_before"];
            $repeat_until_due_date  = $appoiments["repeat_until_due_date"];
            $id                     = $appoiments["id"];

            $email_sent = 0;
            
            if($last_alert_time == '0000-00-00 00:00:00' || $last_alert_time == '' || ($last_alert_time != '' && date('Y-m-d H:i', strtotime($last_alert_time)) != date('Y-m-d H:i', strtotime($cur_dtime)))){ // checks this cron hit already sent mail b4
                if($reminder_time == 'hours'){
                    $handle = fopen($filename, 'a');
    fwrite($handle, "I am here1"."\n");
    fclose($handle);
                    //echo "id---".$id."<br>";
    //                $app_dtime = $appoiment_date;
                    $app_time = strtotime($appoiment_date);
                    //$time_diff = $obj_eq->time_difference(date('H.i', $cur_time), date('H.i', $app_time));  //check hours difference
                    //echo "time difference----".date('Y-m-d H:i:s',$cur_time)."-----".date('Y-m-d H:i:s', $app_time)."----->";
                    $handle = fopen($filename, 'a');
                    fwrite($handle, "time difference----".date('Y-m-d H:i:s',$cur_time)."-----".date('Y-m-d H:i:s', $app_time)."----->"."\n");
                    fclose($handle);
                    $diff = abs($cur_time- $app_time);  //check hours difference
                    $hours = floor($diff / (60 * 60));
                    $mins = floor(($diff - ($hours * 60 * 60)) / (60));
        
                    $time_diff = $hours . "." . str_pad($mins, 2, '0', STR_PAD_LEFT);
                    //echo "<br>";
                    $date_b4 = $reminder_before_date;
                    if($date_b4 != 0 && $date_b4 != '' && $time_diff > 0){
                        $handle = fopen($filename, 'a');
    fwrite($handle, "I am here2"."\n");
    fclose($handle);
                        $final = $time_diff/$date_b4;
                        $handle = fopen($filename, 'a');
    fwrite($handle, $final."\n");
    fclose($handle);
                        //echo "-------<br>";
                        if($repeat_until_due_date == 1){
                            $email_sent = (intval($final) == $final ? 1 : 0);
                            $handle = fopen($filename, 'a');
    fwrite($handle, $from.$email_sent."\n");
    fclose($handle);
                        }
                        else
                            $email_sent = (intval($final) == $final && $final == 1 ? 1 : 0);
                    }
                    //echo "------------------------------------------------------------------------------------<br>";

                }else{ 
    //                $app_dtime = $appoiment_date;
                    $app_time = strtotime($appoiment_date);

                    $date_diff = $obj_employee->date_difference(date('Y-m-d', $cur_time), date('Y-m-d', $app_time));
                    $date_diff = $date_diff / (24 * 60 * 60);  // check day difference -> must be greater than zero

                    $date_b4 = $reminder_before_date;
                    if($date_b4 != 0 && $date_b4 != '' && $date_diff > 0){
                        $final = $date_diff/$date_b4;
                        if(intval($final) == $final && ($repeat_until_due_date == 1 || ($repeat_until_due_date != 1 && $final == 1))){ //check day matched
                            $email_sent = (date('H.i', $app_time) == date('H.i', $cur_time) ? 1 : 0); //check time matched
                        }
                    }
                }
            }

            if($email_sent ==1){
//                echo $id;
                // send email 
                if($email_alert == 1){

                    //$from       = $company['email']; //$preference['admin_email'];
                    $to         = $appoiments["cust_email"];
                    $subject    = $translate['appoiment_reminder'];
                    $customer_name       = $appoiments['last_name'].' '.$appoiments['first_name'];
                    $name = '';
                    if($_SESSION['company_sort_by'] == 1)
                        $customer_name       = $appoiments['first_name'].' '.$appoiments['last_name'];	
                    $date_array = explode(" ", date('F jS Y, l')); 		
                    $New_date   = date('F j Y, l');
                    $New_date   = str_replace($date_array[0],$translate['label_'.strtolower($date_array[0])], $New_date);
                    $New_date   = str_replace(end($date_array),$translate['label_'.strtolower(end($date_array))], $New_date);
                    
                    $New_date_app   = date('F j Y, l', strtotime($appoiment_date));
                    $New_date_app   = str_replace($date_array[0],$translate['label_'.strtolower($date_array[0])], $New_date_app);
                    $New_date_app   = str_replace(end($date_array),$translate['label_'.strtolower(end($date_array))], $New_date_app);
                    
                    $subject   .= $New_date_app;

                    $content = "<table width='650' border='0' cellspacing='0' cellpadding='0' style=' background-color:#fff; margin:0 auto; margin-top:3%;'>
                      <tr>
                            <td>
                                    <table width='650'  height='102'border='0' cellspacing='0' cellpadding='0'>
                                      <tr>
                                            <td width='45' valign='top' style='background:url(" . $preference['url'] . "mail/header_bg_left.jpg) no-repeat;'><img src='" . $preference['url'] . "mail/header_bg_left.jpg' /></td>
                                                    <td width='208' valign='top' style='background-image:url(" . $preference['url'] . "mail/logo_newsletter_cirrus.jpg);'><img src='" . $preference['url'] . "mail/logo_newsletter_cirrus.jpg' /></td>
                                            <td width='397' valign='top' style='background:url(" . $preference['url'] . "mail/header_bg_top.jpg) no-repeat;'><img src='" . $preference['url'] . "mail/header_bg_top.jpg' /></td> 
                                      </tr>
                              </table>
                            </td>
                      </tr>
                      <tr>
                            <td width='650' height='267' valign='top'>
                            <table width='650' border='0' cellspacing='0' cellpadding='0'>
                              <tr>
                                    <td width='52'>&nbsp;</td>
                                    <td width='538'><table width='538' border='0' cellspacing='0' cellpadding='0'>
                                      <tr>
                                            <td width='329'>&nbsp;</td>
                                            <td width='209' style='font:normal 12px/19px Tahoma, Geneva, sans-serif; text-align:left; color:#a8a8a8;'>".$New_date ."</td>
                                      </tr>
                                    </table></td>
                                    <td width='60'>&nbsp;</td>
                              </tr>
                              <tr>
                                    <td width='52'>&nbsp;</td>
                                    <td width='538'>&nbsp;</td>
                                    <td width='60'>&nbsp;</td>
                              </tr>
                              <tr>
                                    <td width='52'>&nbsp;</td>
                                    <td width='538'>&nbsp;</td>
                                    <td width='60'>&nbsp;</td>
                              </tr>
                              <tr>
                                    <td width='52'>&nbsp;</td>
                                    <td width='538'>&nbsp;</td>
                                    <td width='60'>&nbsp;</td>
                              </tr>
                              <tr>
                                    <td width='52'>&nbsp;</td>
                                    <td width='538'><table width='538' border='0' cellspacing='0' cellpadding='0'>
                                      <tr>
                                            
                                            <td colspan='2' style='font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>
                                                    <p><b>".$translate['appoiment_reminder']." </b></p>
                                            </td>
                                      </tr>
                                      <tr>
                                            <td width='150'>".$translate['label_customer_for_appointment_email']."</td>
                                            <td style='font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>
                                                    ".$customer_name."
                                            </td>
                                      </tr>
                                      <tr>
                                            <td width='150'>".$translate['appoiment_date']."</td>
                                            <td style='font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>
                                                    ".$appoiment_date."
                                            </td>
                                      </tr>
                                      <tr>
                                            <td width='150'>".$translate['appoiment_address']."</td>
                                            <td style='font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>
                                                    ".$appoiments['appoiment_address']."
                                            </td>
                                      </tr>
                                      <tr>
                                            <td width='150'>".$translate['phone_number']."</td>
                                            <td style='font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>
                                                    ".$appoiments['phone_number']."
                                            </td>
                                      </tr>
                                      <tr>
                                            <td width='150'>".$translate['appoiment_reason']."</td>
                                            <td style='font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>
                                                    ".$appoiments['reason']."
                                            </td>
                                      </tr>
                                       <tr>
                                            <td width='150'>".$translate['appoiment_remarks']."</td>
                                            <td style='font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>
                                                    ".$appoiments['remarks']."
                                            </td>
                                      </tr> 
                                            <tr>
                                            <td width='150'>".$translate['contact_person_name']."</td>
                                            <td style='font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>
                                                    ".$appoiments['contact_person_name']."
                                            </td>
                                      </tr>
                                      <tr>
                                            <td width='150'>".$translate['phone_number_cp']."</td>
                                            <td style='font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>
                                                    ".$appoiments['phone_number_cp']."
                                            </td>
                                      </tr>
                                      <tr>
                                            <td width='150'>".$translate['email_cp']."</td>
                                            <td style='font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>
                                                    ".$appoiments['email_cp']."
                                            </td>
                                      </tr>
                                       
                                       <tr>
                                            <td width='150'>&nbsp;</td>
                                            <td style='font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>
                                                    <p>&nbsp;</p>
                                            </td>
                                      </tr>
                                      <tr>
                                            <td width='150'>&nbsp;</td>
                                            <td style='font:normal 12px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>
                                                    <p>".$translate['label_thanks'].",</p>
                                            </td>
                                      </tr>
                                    </table>
                                    </td>
                                    <td width='60'>&nbsp;</td>
                              </tr>
                              <tr>
                                    <td width='52' height='50'>&nbsp;</td>
                                    <td width='538' height='50'>&nbsp;</td>
                                    <td width='60' height='50'>&nbsp;</td>
                              </tr>
                            </table>
                            </td>
                      </tr>
                    </table>
                    </td>
                      </tr>
                      <tr>
                            <td width='650' height='91' valign='top'><table width='650' border='0' cellspacing='0' cellpadding='0'>
                      <tr>
                            <td width='451' height='25'>&nbsp;</td>
                            <td width='139' height='25' style='font:normal 15px/24px Tahoma, Geneva, sans-serif; text-align:left; color:#81817e;'>".$translate['power_by']."</td>
                            <td width='34' height='25'>&nbsp;</td>
                      </tr>
                      <tr>
                            <td width='451' height='48'>&nbsp;</td>
                            <td width='139' valign='top'><img src='" . $preference['url'] . "mail/t2v_logo_newsletter.jpg' /></td>

                            <td width='34'>&nbsp;</td>
                      </tr>
                    </table>
                    </td>
                      </tr>
                    </table>";

                    //    ini_set("sendmail_from", 'Noreply<'.$from.'>');
                    $headers = "MIME-Version: 1.0"  . PHP_EOL;
                    $headers .= "Content-type:text/html;charset=UTF-8"  . PHP_EOL;
                    $headers .= 'From: "Noreply" <' .$from.'>' . PHP_EOL;

                    $send_mail = mail($to, $subject, $content, $headers, '-f'.$from);

                }

                // send sms	
                if ($sms_alert == 1) {
                    $mobile = $appoiments["cust_number"];
                    $sms_message = $translate['appointment_alert']."%0A"; //Appointment Alert
                    $sms_message .= $customer_name."%0A";
                    $sms_message .= $translate['label_with'] . " " . $appoiments['contact_person_name']."%0A";
                    $sms_message .= $translate['label_on'] . " " . substr($appoiment_date, 0, -3)."%0A";
                    $sms_message .= $translate['please_login_cirrus_more_info'];
                    $flag = 1;
                    $obj_sms = new sms($sms_message);
                    $obj_sms->addRecipient($mobile);
                    if ($flag == 1) {
                        if (!$obj_sms->send())
                            $flag = 0;
                    }
                }

                $customer->last_alert_update($id, $cur_dtime);
                
                echo $from."Appoiment ($id) sent<br/>";
            }
        }
    }
}
echo 'Cron executed';
exit();
?>