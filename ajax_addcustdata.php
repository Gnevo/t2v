<?php
require_once('class/setup.php');
//require_once('class/equipment.php');
require_once('class/customer.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"), FALSE);
//$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
$customer = new customer();
$employee = new employee();
$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$order = $pram[$totparam-1];
$status = $pram[$totparam-2];
$name = $pram[$totparam-3];
/*$order = 'ascnum';
$order = 'descnum';
$order = 'ascssn';
$order = 'descssn';
$order = 'ascname';
$order = 'descname';*/
//$name = str_replace('_',' ',$pram[$totparam-3]);
/*
if($name == '-')
{
	echo "in 1";
}
if($status == '-')
{
	echo "in 2";
}
exit;
*/

$customers_array = $customer->customer_activeinactive_data($name,$status,$order);
foreach ($customers_array as $customer_data) {
	$customer_username = $customer_data['username'];
	$formatted_mobile = '';
    if($customer_data['mobile'] != ''){
        $length_mobile_display = (strlen($customer_data['mobile'])-5)/2;
        $temp_mobile = '';
        $pos = 5;
        for($m=0;$m<$length_mobile_display;$m++){
            $temp_mobile = $temp_mobile." ".substr($customer_data['mobile'], $pos,2);
            $pos = $pos +2;
        }
        $formatted_mobile = "+46".substr($customer_data['mobile'], 0,3) . " " . substr($customer_data['mobile'], 3,2)." ".$temp_mobile;
    }
    $customers[$customer_username]['username'] =  $customer_username;
	$customers[$customer_username]['code'] =  $customer_data['code'];
	if($_SESSION['company_sort_by'] == 1)
		$customers[$customer_username]['name'] =  $customer_data['first_name'] . ' ' . $customer_data['last_name'];
	else {
		$customers[$customer_username]['name'] =  $customer_data['last_name'] . ' ' . $customer_data['first_name'];
	}
	$customers[$customer_username]['social_security'] =  $customer_data['century'] . substr($customer_data['social_security'], 0, 6) . "-" . substr($customer_data['social_security'], 6);
	$customers[$customer_username]['city'] =  $customer_data['city'];
	$customers[$customer_username]['phone'] =  $customer_data['phone'];
	$customers[$customer_username]['mobile'] =  $formatted_mobile;
	$customers[$customer_username]['status'] =  $customer_data['status'];
	$customers[$customer_username]['email'] =  $customer_data['email'];
	$customers[$customer_username]['address'] =  $customer_data['address'];
	$customers[$customer_username]['post'] =  $customer_data['post'];
	$customers[$customer_username]['employees'][$customer_data['employee_username']] = $customer_data['employee_name'];
	$relatives = $customer->customer_getrelatives($customer_username);
	$gardians = $customer->customer_getgardins($customer_username);		
	$relcnt = count($relatives);
	$relarray = '';
	if(count($relatives)){
		for($e=0;$e<count($relatives);$e++){
			if($relatives[$e]['mobile'] != '')
				$mynumber = $relatives[$e]['mobile'];
			elseif($relatives[$e]['phone'] != '')
				$mynumber = $relatives[$e]['phone'];
			else
				$mynumber = '';	
			if($e == 0)
				$relarray .= $relatives[$e]["name"].' ('.$relatives[$e]["relation"].')'.' '.$mynumber.' '.$relatives[$e]['email'];
			else
				$relarray .= '<hr style="color:#ccc;">'.$relatives[$e]["name"].' ('.$relatives[$e]["relation"].')'.' '.$mynumber.' '.$relatives[$e]['email'];
		}
	} else {
		$relarray = '--';
	}
	$customers[$customer_username]['relatives'] = $relarray;
	
	if(count($gardians)>0) {
		$guardianstr = $gardians[0]['first_name'].'  '.$gardians[0]['last_name'].'  '.$gardians[0]['mobile'].' '.$gardians[0]['email'];
	} else {
		$guardianstr = 	'--';
	}
	$customers[$customer_username]['gardians'] = $guardianstr;
}
$customers = fix_keys($customers, true);
//echo '<pre>' . print_r($customers, 1) . '</pre>';exit();
$page = 10;
$tot = count($customers);
$div = ceil($tot/$page);

if($tot > 0){
	$falg = 0;
	$username = '';
	
	for($i=0;$i<$div;$i++){
		if($i == 0)
			$show = 'style="display:block;"';
		else
			$show = 'style="display:none;"';
		echo '
		<div id="showmain'.$i.'" '.$show.' >
		<input type="hidden" name="pages" id="pages" value="'.$div.'"/>
                <div class="row-fluid">    
		<div class="pagention span12" >
                <div class="alphbts span8">
                    <ul>
                        <li>
                        	<a onclick="select_employee(this.id);" id="A" style="cursor:pointer;" >A</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="B" style="cursor:pointer;" >B</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="C" style="cursor:pointer;" >C</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="D" style="cursor:pointer;" >D</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="E" style="cursor:pointer;" >E</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="F"  style="cursor:pointer;">F</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="G"  style="cursor:pointer;">G</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="H" style="cursor:pointer;" >H</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="I" style="cursor:pointer;" >I</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="J" style="cursor:pointer;" >J</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="K" style="cursor:pointer;" >K</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="L" style="cursor:pointer;" >L</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="M" style="cursor:pointer;" >M</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="N" style="cursor:pointer;" >N</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="O"  style="cursor:pointer;">O</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="P" style="cursor:pointer;" >P</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Q"  style="cursor:pointer;" >Q</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="R" style="cursor:pointer;" >R</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="S" style="cursor:pointer;" >S</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="T" style="cursor:pointer;" >T</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="U"  style="cursor:pointer;">U</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="V"  style="cursor:pointer;">V</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="W" style="cursor:pointer;" >W</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="X"  style="cursor:pointer;">X</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Y" style="cursor:pointer;" >Y</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Z" style="cursor:pointer;" >Z</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Å" name="Å" style="cursor:pointer;" >Å</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Ä" name="Ä" style="cursor:pointer;" >Ä</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Ö" name="Ö" style="cursor:pointer;" >Ö</a>
                        </li>
                    </ul>
                </div>';
				
				$start = $i;
                                $end = $start+3 > $div ? $div: $start+3;
				echo '<div class="pagention_dv span4">
						<div class="pagination" style="margin:0px;float:right;">
							<ul id="pagination">';						
							if($div > 0){
                                if($i > 0){
                                    echo  '<li>
                                              <a class="nxt" href="javascript:void(0);" onclick="showgrid(0)">
                                                      <img src="'.$smarty->url.'images/first.png" style="margin-bottom:3px;">
                                              </a>
                                          </li>
                                          <li>
                                              <a href="javascript:void(0);" onclick="showgrid('.($i-1).')">
                                                      <img src="'.$smarty->url.'images/prev.png" style="margin-bottom:3px;">
                                              </a>
                                          </li>';
                                 }
								for($k=$start;$k<$end;$k++){
									if($k == $i){
										echo '<li><a class="selected">'.($k+1).'</a></li>';
									}
									else{
										echo '<li>
											<a href="javascript:void(0);" onclick="showgrid('.$k.')">'.($k+1).'</a>
										</li>';	
									}
								}
							}
                            if($div > $i)                                                        
                            echo '<li>
                            	<a class="nxt" href="javascript:void(0);" onclick="showgrid('.($i+1).')">
                            		<img src="'.$smarty->url.'images/nxt.png" style="margin-bottom:3px;">
                            	</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="showgrid('.($div-1).')">
                                	<img src="'.$smarty->url.'images/last.png" style="margin-bottom:3px;">
                                </a>
                            </li>';
                        echo '</ul>
                    </div>
                </div>
            </div>
            </div>';
			
		if($tot == ($falg+1))
		{
			$last = $tot;	
		}
		else if($tot == 1)
		{
			$last = 1;	
		}
		else
		{
			$last = $falg+10 ;
		}
		
		if($div == ($i+1))
		{
			$last = $tot;
		}
		echo '<span style="margin:4px 0 3px 10px; float:left;">'.($falg+1).' '.$smarty->localise->contents['to'].' '.$last.' '.$smarty->localise->contents['outof'].' '.$tot.' '.$smarty->localise->contents['customer'].'</span>';	
			//(Englishword - swedis word) (Employee - anställd) (customer - kund) 

			$show1 = $show2 = $show3 = $show4 = $show5 = $show6 = $show7 = $show8 = 'display:none;';
			$numorder = $ssnorder = $nameorder = $cnameorder = '';
				
			if($order == 'ascnum'){				
				$numorder = "'descnum'";
				$show1 = 'display:block;';
			}
			if($order == 'descnum'){
				$numorder = "'ascnum'";
				$show2 = 'display:block;';
			}
			
			if($order == 'ascssn'){
				$ssnorder = "'descssn'";
				$show3 = 'display:block;';
			}
			if($order == 'descssn'){
				$ssnorder = "'ascssn'";
				$show4 = 'display:block;';
			}
			
			
			if($order == 'ascname'){
				$nameorder = "'descname'";
				$show5 = 'display:block;';
			}
			if($order == 'descname'){
				$nameorder = "'ascname'";
				$show6 = 'display:block;';
			}

			if($order == 'asccustname'){
				$cnameorder = "'desccustname'";
				$show7 = 'display:block;';
			}
			if($order == 'desccustname'){
				$cnameorder = "'asccustname'";
				$show8 = 'display:block;';
			}
			
			if(empty($numorder))
				$numorder = "'ascnum'";
			if(empty($ssnorder))
				$ssnorder = "'ascssn'";
			if(empty($nameorder))
				$nameorder = "'ascname'";
			if(empty($cnameorder))
				$cnameorder = "'asccustname'";
						
			echo '<div class="row-fluid"><div class="span12" style="overflow:-moz-scrollbars-horizontal; overflow-x:scroll; overflow-y:hidden;">
			<table class="table_list" style="width:100%; overflow:-moz-scrollbars-horizontal; overflow-x:scroll; overflow-y:hidden;">			
			<tr style="height:45px;vertical-align:top;" >
				<th style="word-wrap: break-word;" valign="top"	>
					<span style="float:left;position: relative;" >
					<span style="cursor:pointer;text-decoration:underline;" onclick="changeorder('.$numorder.');" >'.$smarty->localise->contents['customer_no'].'</span>
					<span style="float:right; vertical-align:bottom;">
					<i class="icon icon-arrow-up" style="'.$show1.'" />				
					<i class="icon icon-arrow-down" style="'.$show2.'"  />
					<span>
					</span>
				</th>
				<th style="word-wrap: break-word; " valign="top"> 
					<span style="float:left;position: relative;" >
					<span style="cursor:pointer;text-decoration:underline;" onclick="changeorder('.$ssnorder.');" >'.$smarty->localise->contents['SSN'].'</span>
					<span style="float:right; vertical-align:bottom;">
					<i class="icon icon-arrow-up" style="'.$show3.'"  />
					<i class="icon icon-arrow-down" style="'.$show4.'" />
					</span>
					</span>
				</th>
				<th style="word-wrap: break-word;" valign="top">
					<span style="float:left;position: relative;" >
					<span style="cursor:pointer;text-decoration:underline;" onclick="changeorder('.$nameorder.');" >'.$smarty->localise->contents['name'].'</span>
					<span style="float:right; vertical-align:bottom;">
					<i class="icon icon-arrow-up" style="'.$show5.'"  />				
					<i class="icon icon-arrow-down" style="'.$show6.'" />
					</span>
					</span>
				</th>	
				<th style="word-wrap: break-word;" >'.$smarty->localise->contents['address'].'</th>
				<th style="word-wrap: break-word; " >'.$smarty->localise->contents['zipcode'].'</th>
				<th style="word-wrap: break-word;" >'.$smarty->localise->contents['city'].'</th>
				<th style="word-wrap: break-word;  width:70px;" valign="top">
					<span style="float:left;position: relative;width: 110px;" >
					<span style="cursor:pointer;text-decoration:underline;" onclick="changeorder('.$cnameorder.');" >'.$smarty->localise->contents['employee'].'</span>
					<span style="float:right; vertical-align:bottom;">
					<i class="icon icon-arrow-up" style="'.$show7.'"  />
					<i class="icon icon-arrow-down" style="'.$show8.'" />
					</span>
					</span>
				</th>
				<th style="word-wrap: break-word; " >'.$smarty->localise->contents['mobile'].'</th>
				<th style="word-wrap: break-word; ">'.$smarty->localise->contents['email'].'</th>		
				<th style="word-wrap: break-word; ">'.$smarty->localise->contents['relatives'].'</th>								              
				<th style="word-wrap: break-word; ">'.$smarty->localise->contents['guardian'].'</th>								              
			</tr>';		
		
		for($j=0;$j<10;$j++){
			$username = $customers[$falg]['username'];
			$fullname = $customers[$falg]['name'];
			$ssn = $customers[$falg]['social_security'];
			$city = $customers[$falg]['city'];
			$phone = $customers[$falg]['phone'];
			$employees = $customers[$falg]['employees'];
            $mobile = $formatted_mobile;
			$status = $customers[$falg]['status'];
			$email = $customers[$falg]['email'];
			$address = $customers[$falg]['address'];
			$code = $customers[$falg]['code'];
			$posts = $customers[$falg]['post'];
			$relatives = $customers[$falg]['relatives'];
			$gardians = $customers[$falg]['gardians'];
			if($tot >= $falg+1){
				$style = '';
				$style1 = '';
				
				if($status == 0){
					$style = 'style="color:red;word-wrap: break-word; height:40px; "';
					$style1 = 'style="word-wrap: break-word; color:red;"';
				}
				else{
					$style = 'style=" word-wrap: break-word;height:40px;"';
					$style1 = 'style=" word-wrap: break-word;"';
				}
				
				if($j%2 == 0){
					echo'<tr class="odd" >
                    <td  '.$style.' valign="middle">'.$code.'</td>
                    <td  '.$style.' valign="middle">'.$ssn.'</td>
                    <td  '.$style.' valign="middle">'.$fullname.'</td>
                    <td  '.$style.' valign="middle">'.$address.'</td>
                    <td  '.$style.' valign="middle">'.$posts.'</td>
                    <td  '.$style.' valign="middle">'.$city.'</td>
                    <td  '.$style.' valign="middle">';
                    foreach ($employees as $employee_name) {
                    	echo $employee_name;
                    	echo '<hr style="color:#ccc;margin:0;">';
                    }
                    echo '</td>
                    <td  '.$style.' valign="middle">'.$mobile.'</td>	
                    <td  '.$style1.' valign="middle">'.$email.'</td>
					<td   '.$style1.' valign="middle">'.$relatives.'</td>
					<td  '.$style1.' valign="middle">'.$gardians.'</td>
                </tr>';	
				} else {
					echo'<tr class="even" >
                    <td  '.$style.' valign="middle">'.$code.'</td>
                    <td  '.$style.' valign="middle">'.$ssn.'</td>
                    <td  '.$style.' valign="middle">'.$fullname.'</td>
                    <td  '.$style.' valign="middle">'.$address.'</td>
                    <td  '.$style.' valign="middle">'.$posts.'</td>
                    <td  '.$style.' valign="middle">'.$city.'</td>
                    <td  '.$style.' valign="middle">';
                    foreach ($employees as $employee_name) {
                    	echo $employee_name;
                    	echo '<hr style="color:#ccc;margin:0;">';
                    }
                    echo '</td>
                    <td  '.$style.' valign="middle">'.$mobile.'</td>	
                    <td  '.$style1.' valign="middle">'.$email.'</td>
					<td  '.$style1.' valign="middle">'.$relatives.'</td>
					<td  '.$style1.' valign="middle">'.$gardians.'</td>
                </tr>';	
				}
						
			}
			$falg++;
		}
			echo '<tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
                </tr>	
            </table></div></div></div>';
			
			$Grandtotworkinghrs = 0;
		
	}
}
else{
	echo '
		<div id="showmain" >
		<input type="hidden" name="pages" id="pages" value="0"/>
		<div class="pagention" >
                <div class="alphbts">
                    <ul>
                        <li>
                        	<a onclick="select_employee(this.id);" id="A" style="cursor:pointer;" >A</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="B" style="cursor:pointer;" >B</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="C" style="cursor:pointer;" >C</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="D" style="cursor:pointer;" >D</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="E" style="cursor:pointer;" >E</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="F"  style="cursor:pointer;">F</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="G"  style="cursor:pointer;">G</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="H" style="cursor:pointer;" >H</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="I" style="cursor:pointer;" >I</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="J" style="cursor:pointer;" >J</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="K" style="cursor:pointer;" >K</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="L" style="cursor:pointer;" >L</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="M" style="cursor:pointer;" >M</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="N" style="cursor:pointer;" >N</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="O"  style="cursor:pointer;">O</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="P" style="cursor:pointer;" >P</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Q"  style="cursor:pointer;" >Q</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="R" style="cursor:pointer;" >R</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="S" style="cursor:pointer;" >S</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="T" style="cursor:pointer;" >T</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="U"  style="cursor:pointer;">U</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="V"  style="cursor:pointer;">V</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="W" style="cursor:pointer;" >W</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="X"  style="cursor:pointer;">X</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Y" style="cursor:pointer;" >Y</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Z" style="cursor:pointer;" >Z</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Å" style="cursor:pointer;" >Å</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Ä" style="cursor:pointer;" >Ä</a>
                        </li>
                        <li>
                        	<a onclick="select_employee(this.id);" id="Ö" style="cursor:pointer;" >Ö</a>
                        </li>
                    </ul>
                </div>';
				
				echo '<div class="pagention_dv">
						<div class="pagination">
							<ul id="pagination">	
                        </ul>
                    </div>
                </div>
            </div>';
			echo '<table class="table_list tbl_padding_fix">
                <tr>
					<th>'.$smarty->localise->contents["employeenumber"].'</th>
					<th>'.$smarty->localise->contents["SSN"].'</th>
					<th>'.$smarty->localise->contents["name"].'</th>
					<th>'.$smarty->localise->contents["address"].'</th>
					<th>'.$smarty->localise->contents["zipcode"].'</th>
					<th>'.$smarty->localise->contents["city"].'</th>
					<th>'.$smarty->localise->contents["employee"].'</th>
					<th>'.$smarty->localise->contents["mobile"].'</th>
					<th>'.$smarty->localise->contents["email"].'</th>
					<th>'.$smarty->localise->contents["relatives"].'</th>
					<th>'.$smarty->localise->contents["guardian"].'</th>					
                </tr>
				<tr>
					<td colspan="12" align="center"  class="usertdname" height="30px;" >&nbsp;<strong>'.$smarty->localise->contents["no_record_found"].'</strong></td>
				</tr>
				</table>';				
		
}

//print_r($employees);	
exit;

$employees = $employee->getemployee($name);

if(count($employees) > 0) {
	echo '<ul style="position:absolute; padding:3px; width:130px; margin-left:47px; list-style:none; background:#fff;">';
	for($i=0;$i<count($employees);$i++)		
	{		
		echo '<li style=" border:1px solid #000; padding:2px; background:#fff; cursor:pointer;" onclick="fillemp(this.id);" id="'.$employees[$i]["first_name"] .' '.$employees[$i]["last_name"].'" >'.$employees[$i]["first_name"] .' '.$employees[$i]["last_name"].'</li>';
	}
	echo '</ul>';
}
else {
	echo '<ul style="position:absolute; padding:3px; width:130px; margin-left:47px; list-style:none; background:#fff;">';
	echo '<li style=" border:1px solid #000; padding:2px; background:#fff;">Not Found</li>';
	echo '</ul>';
}
exit;

function fix_keys($array, $numberCheck = false) {
    foreach ($array as $k => $val) {
        if (is_array($val)) $array[$k] = fix_keys($val, flase); //recurse
        if (is_numeric($k)) $numberCheck = true;
    }
    if ($numberCheck === true) {
        return array_values($array);
    } else {
        return $array;
    }
}
?>