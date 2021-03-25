<?php
ini_set( "display_errors", 0);
require_once('class/setup.php');
require_once('class/customer.php');

/*0-Root, 
1-Admin, 
2-TL, 
3-Employee, 
4-Customer,
5-Trainee, 
6-Econamy, 
7-SuperTL*/
$user = new user();
$login_user = $_SESSION['user_id'];
$privileges = $user->get_privileges($login_user, 5);
$login_user_role = $user->user_role($login_user);
//if($login_user_role == 0 || $login_user_role == 1 || $login_user_role == 2 || $login_user_role == 6 || $login_user_role == 7 )


if($privileges['customer_granded_vs_used'] == 1)
{
	$errormessage = 0;
}
else
{
	$errormessage = 1;
}
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml", "forms.xml", "reports.xml"));
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$smarty->assign('errormessage',$errormessage);
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));

$customer = new customer();

$customers = $customer->customer_list();

$smarty->assign('customers',$customers);

$smarty->assign('showform','0');


if(!empty($_POST['dropdown_check']))
{
	$_POST['from_date'] = '';
	$_POST['to_date'] = '';
	
	
	$fkdate = $_POST['fkdate'];
	$kndate = $_POST['kndate'];
	$tudate = $_POST['tudate'];
	
	$smarty->assign('fkdate',$fkdate);
	$smarty->assign('kndate',$kndate);
	$smarty->assign('tudate',$tudate);
        //----------------------------------
        if(!empty($_POST['fkdate'])){
            $contract_detail = $customer->contract_customer_edit_get($fkdate);
            $date_from = $contract_detail[0]['date_from'];
            $date_to =  $contract_detail[0]['date_to'];
            $smarty->assign('hide',1);
        }if(!empty($_POST['kndate'])){
            $contract_detail = $customer->contract_customer_edit_get($kndate);
            $date_from = $contract_detail[0]['date_from'];
            $date_to =  $contract_detail[0]['date_to'];
            $smarty->assign('hide1',1);
        }if(!empty($_POST['tudate'])){
            $contract_detail = $customer->contract_customer_edit_get($tudate);
            $date_from = $contract_detail[0]['date_from'];
            $date_to =  $contract_detail[0]['date_to'];
            $smarty->assign('hide2',1);
        }
        $data = $customer->get_filter_date_report($_POST['customer'],$date_from,$date_to,'10');
                $detail_contract = $customer->timetable_value_filter_date_report($_POST['customer'],$date_from,$date_to);
               // echo "<pre>". print_r($detail_contract, 1)."</pre>";
                $employees_array = array();
                $details = array();
                for($i= 0;$i< count($detail_contract);$i++){
                    if(in_array($detail_contract[$i]['employee'],$employees_array)){
                        for($j=0;$j<count($employees_array);$j++){
                            if($employees_array[$j] == $detail_contract[$i]['employee']){
                                if($detail_contract[$i]['fkkn'] == 1){
                                    $sum = $customer->time_sum($customer->time_difference($detail_contract[$i]['time_to'], $detail_contract[$i]['time_from']),$details[$j]['time_sum_fk']);
                                    $details[$j]['time_sum_fk'] = $sum;
                                }elseif($detail_contract[$i]['fkkn'] == 2){
                                    $sum = $customer->time_sum($customer->time_difference($detail_contract[$i]['time_to'], $detail_contract[$i]['time_from']),$details[$j]['time_sum_kn']);
                                    $details[$j]['time_sum_kn'] = $sum;
                                }elseif($detail_contract[$i]['fkkn'] == 3){
                                    $sum = $customer->time_sum($customer->time_difference($detail_contract[$i]['time_to'], $detail_contract[$i]['time_from']),$details[$j]['time_sum_tu']);
                                    $details[$j]['time_sum_tu'] = $sum;
                                }
                            }
                        }
                    }else{
                        $employees_array[] = $detail_contract[$i]['employee'];
                        if($detail_contract[$i]['fkkn'] == 1){
                            $sum = $customer->time_difference($detail_contract[$i]['time_to'], $detail_contract[$i]['time_from']);
                            $detail_contract[$i]['time_sum_fk'] = $sum;
                            $details[] = $detail_contract[$i];
                        }elseif($detail_contract[$i]['fkkn'] == 2){
                            $sum = $customer->time_difference($detail_contract[$i]['time_to'], $detail_contract[$i]['time_from']);
                            $detail_contract[$i]['time_sum_kn'] = $sum;
                            $details[] = $detail_contract[$i];
                        }elseif($detail_contract[$i]['fkkn'] == 3){
                            $sum = $customer->time_difference($detail_contract[$i]['time_to'], $detail_contract[$i]['time_from']);
                            $detail_contract[$i]['time_sum_tu'] = $sum;
                            $details[] = $detail_contract[$i];
                        }
                        
                    }
                }
                for($i=0;$i<count($details);$i++){
                    $details[$i]['total'] = $customer->time_sum_three($details[$i]['time_sum_kn'], $details[$i]['time_sum_fk'], $details[$i]['time_sum_tu']);
                }
                $smarty->assign('details',$details);
                //-------------------------------------------------
	
//	$data = $customer->get_filter_date_report_dropdown($_POST['customer'],$fkdate,$kndate,'10');
	
	if(empty($_POST['fkdate']) && empty($_POST['kndate']) && empty($_POST['tudate']))
	{
		$data['hide_kn'] = '1';
		$data['hide_fk'] = '1';
		$data['hide_tu'] = '1';
	}
        

	$smarty->assign('data',$data);
	
	$fksum = $_POST['beloppfk']*$data['fk_diff'];
	$smarty->assign('fksum',$fksum);
	
	$knsum = $_POST['beloppkn']*$data['kn_diff'];
	$smarty->assign('knsum',$knsum);
	
	$tusum = $_POST['belopptu']*$data['tu_diff'];
	$smarty->assign('tusum',$tusum);
		
	$smarty->assign('showform','1');
}

if(!empty($_POST['customer']))
{
        if($_POST['customer'] != 'All'){
            $customer_detail = $customer->customer_detail($_POST['customer']);
            $smarty->assign('customer_detail',$customer_detail);
            //print_r($customer_detail); exit;

            $social_security = substr_replace($customer_detail['social_security'], "-", 6, 0);
            $smarty->assign('social_security',$social_security);

            $fkperiod = $customer->get_date_period($_POST['customer'], 1);
            $smarty->assign('fkperiods', $fkperiod);

            $knperiod = $customer->get_date_period($_POST['customer'], 2);
            $smarty->assign('knperiods', $knperiod);
            
            $tuperiod = $customer->get_date_period($_POST['customer'], 3);
            $smarty->assign('tuperiods', $tuperiod);
	}
	if(!empty($_POST['beloppfk'])) // preserving beloppfk
	{
		$smarty->assign('beloppfk',$_POST['beloppfk']);
	}else{
		$smarty->assign('beloppfk','0');
	}
	
	if(!empty($_POST['beloppkn'])) // preserving beloppkn
	{
		$smarty->assign('beloppkn',$_POST['beloppkn']);
	}else{
		$smarty->assign('beloppkn','0');
	}
	
	if(!empty($_POST['belopptu'])) // preserving beloppkn
	{
		$smarty->assign('belopptu',$_POST['belopptu']);
	}else{
		$smarty->assign('belopptu','0');
	}
}


// Preserve value
if(!empty($_POST['customer']))
{
	$smarty->assign('cust',$_POST['customer']);
}
if(!empty($_POST['from_date']))
{
	$smarty->assign('fdate',$_POST['from_date']);
}
if(!empty($_POST['to_date']))
{
	$smarty->assign('tdate',$_POST['to_date']);
}

// Fetch data by from and to date
if( (!empty($_POST['customer']) || $_POST['customer'] == 'All') && !empty($_POST['from_date']) &&  !empty($_POST['to_date']) && !empty($_POST['check']) ){
	
	if($_POST['from_date'] <= $_POST['to_date'])
	{ 
		$data = $customer->get_filter_date_report($_POST['customer'],$_POST['from_date'],$_POST['to_date'],'10');

        if($_POST['customer'] != 'All'){
            $detail_contract = $customer->timetable_value_filter_date_report($_POST['customer'],$_POST['from_date'],$_POST['to_date']);
            //echo "<pre>". print_r($detail_contract, 1)."</pre>";exit();
            $employees_array = array();
            $details = array();
            for($i= 0;$i< count($detail_contract);$i++){
                if(in_array($detail_contract[$i]['employee'],$employees_array)){
                    for($j=0;$j<count($employees_array);$j++){
                        if($employees_array[$j] == $detail_contract[$i]['employee']){
                            if($detail_contract[$i]['fkkn'] == 1){
                                $sum = $customer->time_sum($customer->time_difference($detail_contract[$i]['time_to'], $detail_contract[$i]['time_from']),$details[$j]['time_sum_fk']);
                                $details[$j]['time_sum_fk'] = $sum;
                            }elseif($detail_contract[$i]['fkkn'] == 2){
                                $sum = $customer->time_sum($customer->time_difference($detail_contract[$i]['time_to'], $detail_contract[$i]['time_from']),$details[$j]['time_sum_kn']);
                                $details[$j]['time_sum_kn'] = $sum;
                            }elseif($detail_contract[$i]['fkkn'] == 3){
                                $sum = $customer->time_sum($customer->time_difference($detail_contract[$i]['time_to'], $detail_contract[$i]['time_from']),$details[$j]['time_sum_te']);
                                $details[$j]['time_sum_tu'] = $sum;
                            }
                        }
                    }
                }else{
                    $employees_array[] = $detail_contract[$i]['employee'];
                    if($detail_contract[$i]['fkkn'] == 1){
                        $sum = $customer->time_difference($detail_contract[$i]['time_to'], $detail_contract[$i]['time_from']);
                        $detail_contract[$i]['time_sum_fk'] = $sum;
                        $details[] = $detail_contract[$i];
                    }elseif($detail_contract[$i]['fkkn'] == 2){
                        $sum = $customer->time_difference($detail_contract[$i]['time_to'], $detail_contract[$i]['time_from']);
                        $detail_contract[$i]['time_sum_kn'] = $sum;
                        $details[] = $detail_contract[$i];
                    }elseif($detail_contract[$i]['fkkn'] == 3){
                        $sum = $customer->time_difference($detail_contract[$i]['time_to'], $detail_contract[$i]['time_from']);
                        $detail_contract[$i]['time_sum_tu'] = $sum;
                        $details[] = $detail_contract[$i];
                    }
                    
                }
            }
            for($i=0;$i<count($details);$i++){
                $details[$i]['total'] = $customer->time_sum_three($details[$i]['time_sum_kn'], $details[$i]['time_sum_fk'], $details[$i]['time_sum_tu']);
            }
            $smarty->assign('details',$details);
        }
        
        //echo "<pre>"; print_r($details);exit();   

		$smarty->assign('showform','1');
		
		$smarty->assign('data',$data);
                
		$fksum = ($_POST['beloppfk']*$data['fk_diff']);
		$smarty->assign('fksum',$fksum);
		
		$knsum = $_POST['beloppkn']*$data['kn_diff'];
		$smarty->assign('knsum',$knsum);
		
		$tusum = $_POST['belopptu']*$data['tu_diff'];
		$smarty->assign('tusum',$tusum);
		
        $smarty->assign('hide',1);
        $smarty->assign('hide1',1);
        $smarty->assign('hide2',1);
	}
}

$smarty->display('extends:layouts/dashboard.tpl|customer_filter_date_report.tpl');
?>