<?php
require_once('class/setup.php');
require_once('class/db.php');
require_once('class/company.php');
require_once('class/dona.php');
require_once('class/customer.php');
//require_once('class/employee.php');
require_once('class/mail.php');
require_once('plugins/message.class.php');
$smarty = new smartySetup(array('company.xml',"user.xml", "messages.xml", "button.xml","month.xml"));
$company = new company();
$customer = new customer();
//$employee = new employee();
$dona = new dona();
$messages = new message();
global $preference, $company;
//setting the menu

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));
if((isset($_POST['database']) && $_POST['database'] != "1") || (isset($_POST['setup']) && $_POST['setup'] == "1")){
    
    $company->name = $_POST['company_name'];
    $company->db_name = $_POST['database'];
    $company->org_no =  str_replace("-","",$_POST['org_no']);;
    $company->address = $_POST['adress'];
    $company->box = trim($_POST['company_box']);
    $company->city = $_POST['comp_city'];
    $company->email = $_POST['email'];
    $company->phone = $_POST['phone'];
    $company->comp_city = $_POST['comp_city'];
    $company->zipcode = $_POST['zipcode'];
    $company->mobile = $_POST['mobile'];
    $company->website = $_POST['website'];
    $company->bill_status = $_POST['bill_status'];
    $company->username1=$_POST['username1'];
    $company->username2=$_POST['username2'];
    $company->contact_person1 = $_POST['first_name1']." ".$_POST['last_name1'];
    $company->contact_person2 = $_POST['first_name2']." ".$_POST['last_name2'];
    $company->contact_person1_email = $_POST['email1'];
    $company->contact_person2_email = $_POST['email2'];
    $company->upload_dir = $_POST['dir'];
    $company->land_code = $_POST['land_code'];
    $company->price = $_POST['price'];
    $company->price_per_sms = $_POST['price_per_sms'];
    $company->price_per_sign = $_POST['price_per_sign'];
    $company->logo = "";
    $company->salary_system= $_POST['salary_system'];
    $company->contract_from = $_POST['contract_from'];
    $company->contract_to = $_POST['contract_to'];
    
    $start_time = $_POST['start_time']; 
    if($_POST['start_time'] == null || $_POST['start_time'] == ""){
        $start_time = 0.00;
    }
    $company->company_start_day= $_POST['start_day'].$dona->time_to_sixty($start_time);
//    echo $company->company_start_day;
    //$company->db_name = $_POST['database'];
    if(isset($_POST['setup']) && $_POST['setup'] == "1"){
        $company->contact_person1 = $_POST['first_name1'];
        $company->contact_person2 = $_POST['first_name2'];
        $company->logo = $_POST['logo'];
        $company->company_update($_SERVER['QUERY_STRING']);
        $smarty->assign('company', $data = $company->get_company_detail($_SERVER['QUERY_STRING']));
        $smarty->assign('setup','1');
        if(isset($_POST['username1']) && $_POST['username1'] != ""){
            $company->username = $_POST['username1'];
            $company->role = "1";
            $company->first_name = $_POST['first_name1'];
            $company->last_name = $_POST['last_name1'];
            $company->address = $_POST['address1'];
            $company->city = $_POST['city1'];
            $company->post = $_POST['post1'];
            $company->phone = $_POST['phone1'];
            $company->mobile = $_POST['mobile1'];
            $company->email = $_POST['email1'];
            $company->social_security = $_POST['social_security1'];
            $company->company_id =$_SERVER['QUERY_STRING'];
            if($_POST['password'] == $smarty->translate[generate_password]){
                $company->password = '';
            }else{
                $company->password = $_POST['password'];
            }
            $company->login_edit();
            $company->employee_edit_newdb($_POST['datab']);
            $compony_detail = $customer->get_company_detail($_SERVER['QUERY_STRING']);
            $company_home = $compony_detail['website'];
            //$cirrus_link = $company['website'];
            $logo = $compony_detail['logo'];
            $company_name = $compony_detail['name'];
            $contact_person = $compony_detail['contact_person1'];
            $subject = $smarty->translate[employee_add];
            $msg = $smarty->translate[name].' : '.trim($company->first_name).' '.trim($company->last_name).'<br>'.$smarty->translate[address].' : '.$company->address.'<br>'.$smarty->translate[email].' : '.$company->email.'<br>'.$smarty->translate[phone].' : '.$company->phone. '<br>'.$smarty->translate[mobile].' : ' . $company->mobile.'<br>'.$smarty->translate[username].' : '.$company->username;
            if($company->password != ""){
                $msg .= '<br>'.$smarty->translate[password].' : '.$company->password;
            }
            $msg .= '<br>'.$smarty->translate[link_to_company_home_page].' : '.$company_home.'<br>'.$smarty->translate[link_to_cirrus].' : '.$cirrus_link;
            $mailer = new SimpleMail($subject,$msg);
            $mailer->addSender("cirrus-noreplay@time2view.se");
            $mailer->addRecipient($company->email,trim($company->first_name).' '.trim($company->last_name));
            $mailer->send();

        }
        if(isset($_POST['username2']) && $_POST['username2'] != ""){
            $company->username = $_POST['username2'];
            $company->role = "1";
            $company->first_name = $_POST['first_name2'];
            $company->last_name = $_POST['last_name2'];
            $company->address = $_POST['address2'];
            $company->city = $_POST['city2'];
            $company->post = $_POST['post2'];
            $company->phone = $_POST['phone2'];
            $company->mobile = $_POST['mobile2'];
            $company->email = $_POST['email2'];
            $company->social_security = $_POST['social_security2'];
            $company->company_id =$_SERVER['QUERY_STRING'];
            if($_POST['password2'] == $smarty->translate[generate_password]){
                $company->password = '';
            }else{
                $company->password = $_POST['password2'];
            }
            $compony_detail = $customer->get_company_detail($_SERVER['QUERY_STRING']);
            if($compony_detail['username2'] == '' || $compony_detail['username2'] == NULL ){
                $company->login_add(TRUE);
                $company->employee_add_newdb($_POST['datab']);
            }else{
                $company->login_edit();
                $company->employee_edit_newdb($_POST['datab']);
            }
            
            $company_home = $compony_detail['website'];
            //$cirrus_link = $company['website'];
            $logo = $compony_detail['logo'];
            $company_name = $compony_detail['name'];
            $contact_person = $compony_detail['contact_person1'];
            $subject = $smarty->translate[employee_add];
            $msg = $smarty->translate[name].' : '.trim($company->first_name).' '.trim($company->last_name).'<br>'.$smarty->translate[address].' : '.$company->address.'<br>'.$smarty->translate[email].' : '.$company->email.'<br>'.$smarty->translate[phone].' : '.$company->phone. '<br>'.$smarty->translate[mobile].' : ' . $company->mobile.'<br>'.$smarty->translate[username].' : '.$company->username;
            if($company->password != ""){
                $msg .= '<br>'.$smarty->translate[password].' : '.$company->password;
            }
            $msg .= '<br>'.$smarty->translate[link_to_company_home_page].' : '.$company_home.'<br>'.$smarty->translate[link_to_cirrus].' : '.$cirrus_link;
            $mailer = new SimpleMail($subject,$msg);
            $mailer->addSender("cirrus-noreplay@time2view.se");
            $mailer->addRecipient($company->email,trim($company->first_name).' '.trim($company->last_name));
            $mailer->send();
        }
        
//        echo $data['strart_day'];
        $val[0] = substr($data['strart_day'],0,1);
        $val[1] = substr($data['strart_day'],1,5);
        $smarty->assign('vals',$val);
        $message = 'company_editting_success';
        $type = "success";
        $messages->set_message($type, $message);
    }
    
    else{
        $directory = str_replace(" ", "_", $_POST['company_name']);
        $company->upload_dir = $directory;
        $thisdir = getcwd();
        $upload_path = $thisdir."/company_logo/";
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            
            $file_name = $_FILES['file']['name'];
            $size = filesize($_FILES['file']['tmp_name']);
            $str = str_replace(" ", "_", $file_name );
          
                $extension = $customer->get_file_extension($str);
                if ($extension == "jpg" || $extension == "png" ) {

                    //$upload_path = "document_decision/";
                    $file_path = $upload_path . $str;

                    if(file_exists($file_path)){


                            $num = 1;
                            $x = 0;
                            $str1 = explode('.',$str);
                            $str = $str1[0]."_".$num.".".$str1[1];
                            $file_path = $upload_path . $str;
                            while($x == 0){
                                if(file_exists($file_path)){                                            
                                    $num++;
                                    $str1 = explode('.',$str);
                                    $str1[0] = substr($str1[0],0,-2);
                                    $str = $str1[0]."_".$num.".".$str1[1];
                                    $file_path = $upload_path . $str;
                                }
                                else{
                                    $x++;
                                }
                            }
                            $company->logo = $str;
                            move_uploaded_file($_FILES['file']['tmp_name'], $file_path);

                    }


                    else{
                        $company->logo = $str;
                    move_uploaded_file($_FILES['file']['tmp_name'], $file_path);

                    }

                } else {

                    $message = 'file_selected_supported_extension';
                    $type = "fail";  
                    $messages->set_message($type, $message);
                    $error = "1";
                }

        }
        $x = $company->company_add();
        if($x){
            $comp_id = $x;
            $filename = $preference['url']."/sql/t2v_cirrus.sql";
            $company->generate_database_tables($filename, $_POST['database']);
            $company->company_id = $x;
            $company->create_new_directory_company($directory);
            if(isset($_POST['username1']) && $_POST['username1'] != ""){
                $company->username = $_POST['username1'];
                $company->role = "1";
                $company->first_name = $_POST['first_name1'];
                $company->last_name = $_POST['last_name1'];
                $company->address = $_POST['address1'];
                $company->city = $_POST['city1'];
                $company->post = $_POST['post1'];
                $company->phone = $_POST['phone1'];
                $company->mobile = $_POST['mobile1'];
                $company->email = $_POST['email1'];
                $company->social_security = $_POST['social_security1'];
                $company->company_id =$comp_id;
                if($_POST['password'] == $smarty->translate[generate_password]){
                    $company->password = '';
                }else{
                    $company->password = $_POST['password'];
                }
                $company->login_add(TRUE);
                $company->employee_add_newdb($_POST['database']);
                $compony_detail = $customer->get_company_detail($comp_id);
                $company_home = $compony_detail['website'];
                //$cirrus_link = $company['website'];
                $logo = $compony_detail['logo'];
                $company_name = $compony_detail['name'];
                $contact_person = $compony_detail['contact_person1'];
                $subject = $smarty->translate[employee_add];
                $msg = $smarty->translate[name].' : '.trim($company->first_name).' '.trim($company->last_name).'<br>'.$smarty->translate[address].' : '.$company->address.'<br>'.$smarty->translate[email].' : '.$company->email.'<br>'.$smarty->translate[phone].' : '.$company->phone. '<br>'.$smarty->translate[mobile].' : ' . $company->mobile.'<br>'.$smarty->translate[username].' : '.$company->username;
                if($company->password != ""){
                    $msg .= '<br>'.$smarty->translate[password].' : '.$company->password;
                }
                $msg .= '<br>'.$smarty->translate[link_to_company_home_page].' : '.$company_home.'<br>'.$smarty->translate[link_to_cirrus].' : '.$cirrus_link;
                $mailer = new SimpleMail($subject,$msg);
                $mailer->addSender("cirrus-noreplay@time2view.se");
                $mailer->addRecipient($company->email,trim($company->first_name).' '.trim($company->last_name));
                $mailer->send();

            }
            if(isset($_POST['username2']) && $_POST['username2'] != ""){
                $company->username = $_POST['username2'];
                $company->role = "1";
                $company->first_name = $_POST['first_name2'];
                $company->last_name = $_POST['last_name2'];
                $company->address = $_POST['address2'];
                $company->city = $_POST['city2'];
                $company->post = $_POST['post2'];
                $company->phone = $_POST['phone2'];
                $company->mobile = $_POST['mobile2'];
                $company->email = $_POST['email2'];
                $company->social_security = $_POST['social_security2'];
                $company->company_id =$comp_id;
                if($_POST['password2'] == $smarty->translate[generate_password]){
                    $company->password = '';
                }else{
                    $company->password = $_POST['password2'];
                }
                $company->login_add(TRUE);
                $company->employee_add_newdb($_POST['database']);
                $compony_detail = $customer->get_company_detail($comp_id);
                $company_home = $compony_detail['website'];
                //$cirrus_link = $company['website'];
                $logo = $compony_detail['logo'];
                $company_name = $compony_detail['name'];
                $contact_person = $compony_detail['contact_person1'];
                $subject = $smarty->translate[employee_add];
                $msg = $smarty->translate[name].' : '.trim($company->first_name).' '.trim($company->last_name).'<br>'.$smarty->translate[address].' : '.$company->address.'<br>'.$smarty->translate[email].' : '.$company->email.'<br>'.$smarty->translate[phone].' : '.$company->phone. '<br>'.$smarty->translate[mobile].' : ' . $company->mobile.'<br>'.$smarty->translate[username].' : '.$company->username;
                if($company->password != ""){
                    $msg .= '<br>'.$smarty->translate[password].' : '.$company->password;
                }
                $msg .= '<br>'.$smarty->translate[link_to_company_home_page].' : '.$company_home.'<br>'.$smarty->translate[link_to_cirrus].' : '.$cirrus_link;
                $mailer = new SimpleMail($subject,$msg);
                $mailer->addSender("cirrus-noreplay@time2view.se");
                $mailer->addRecipient($company->email,trim($company->first_name).' '.trim($company->last_name));
                $mailer->send();
                
            }
            $message = 'company_adding_success';
            $type = "success";
            $messages->set_message($type, $message);
            header("location:".$smarty->url."company/add/".$comp_id."/");
            exit();
            
        }
    }
    
    
   // header("location:".$smarty->url."dashboard/");
}


if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != ""){
    $smarty->assign('company', $data = $company->get_company_detail($_SERVER['QUERY_STRING']));
    $smarty->assign('setup','1');
    $smarty->assign('employee_detail1',$a = $company->employee_detail_main($data['username1'],$data['db_name']));
//    echo "<pre>". print_r($a, 1)."</pre>";
    if($data['username2'] != NULL || $data['username2'] != ''){
        $smarty->assign('employee_detail2',$company->employee_detail_main($data['username2'],$data['db_name']));
    }
    $val[0] = substr($data['start_day'],0,1);
    $val[1] = substr($data['start_day'],1,5);
    $smarty->assign('vals',$val);
    $company_contracts = $company->get_company_contract_detail($_SERVER['QUERY_STRING']);
    $smarty->assign('company_contracts',$company_contracts);
} 
else {
    $smarty->assign('databases', $company->get_empty_database());
}
//Setting layout and page
$cstr = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM12345678901234567890_#?%&*-+";
$pass = "";
for ($i = 0; $i < 9; $i++) {
    $rnd = mt_rand(0, 73);
    $pass .= $cstr[$rnd];
}
$smarty->assign('pass1', $pass);
$pass = "";
for ($i = 0; $i < 9; $i++) {
    $rnd = mt_rand(0, 73);
    $pass .= $cstr[$rnd];
}
$smarty->assign('pass2', $pass);
$smarty->assign('message', $messages->show_message());
//$smarty->assign('message', $messages->show_message());
$smarty->display('extends:layouts/root_dashboard.tpl|company_add.tpl');
?>