<?php
require_once('class/setup.php');
//require_once('class/equipment.php');
//require_once('class/customer.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"), FALSE);
//$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));
//$customer = new customer();
$employee = new employee();
$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
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
$employees_array = $employee->employee_activeinactive_data($name,$status,$order);
foreach ($employees_array as $employee_data) {
	$employee_username = $employee_data['username'];
	$formatted_mobile = '';
    if($employee_data['mobile'] != ''){
        $length_mobile_display = (strlen($employee_data['mobile'])-5)/2;
        $temp_mobile = '';
        $pos = 5;
        for($m=0;$m<$length_mobile_display;$m++){
            $temp_mobile = $temp_mobile." ".substr($employee_data['mobile'], $pos,2);
            $pos = $pos +2;
        }
        $formatted_mobile = "+46".substr($employee_data['mobile'], 0,3) . " " . substr($employee_data['mobile'], 3,2)." ".$temp_mobile;
    }
    $employees[$employee_username]['username'] =  $employee_username;
	$employees[$employee_username]['code'] =  $employee_data['code'];
	if($_SESSION['company_sort_by'] == 1)
		$employees[$employee_username]['name'] =  $employee_data['first_name'] . ' ' . $employee_data['last_name'];
	else {
		$employees[$employee_username]['name'] =  $employee_data['last_name'] . ' ' . $employee_data['first_name'];
	}
	$employees[$employee_username]['social_security'] =  $employee_data['century'] . substr($employee_data['social_security'], 0, 6) . "-" . substr($employee_data['social_security'], 6);
	$employees[$employee_username]['city'] =  $employee_data['city'];
	$employees[$employee_username]['phone'] =  $employee_data['phone'];
	$employees[$employee_username]['mobile'] =  $formatted_mobile;
	$employees[$employee_username]['status'] =  $employee_data['status'];
	$employees[$employee_username]['email'] =  $employee_data['email'];
	$employees[$employee_username]['address'] =  $employee_data['address'];
	$employees[$employee_username]['post'] =  $employee_data['post'];
	$customer_name = $employees[$falg]['customer_name'];
	if($employee_data['customer_name']) {
		$employees[$employee_username]['customers'][] = $employee_data['customer_name'];
	}

}
$employees = fix_keys($employees, true);
//echo '<pre>'.print_r($employees, 1).'</pre>'; exit();
$page = 10;
$tot = count($employees);
$div = ceil($tot/$page);

if($tot > 0){
	$falg = 0;
	$username = '';
	
	for($i=0;$i<$div;$i++){
		if($i == 0) {
			$show = 'style="display:block;"';
		}
		else {
			$show = 'style="display:none;"';	
		}
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
									if($div > 0) {
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
										for($k=$start;$k<$end;$k++) {
											if($k == $i) {
												echo '<li><a class="selected">'.($k+1).'</a></li>';
											}
											else {
												echo '<li>
													<a href="javascript:void(0);" onclick="showgrid('.$k.')">'.($k+1).'</a>
												</li>';	
											}
										}
									}
		                            if($div > ($i+1)) {
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
		                            }
		                        echo '</ul>
		                    </div>
	                	</div>
	            </div>
	        </div>';
			
		if($tot == ($falg+1)) $last = $tot;	
		else if($tot == 1) $last = 1;	
		else $last = $falg+10 ;
		
		if($div == $i+1)
			$last = $tot;
		echo '<span style="margin:4px 0 3px 10px; float:left;">'.($falg+1).' '.$smarty->localise->contents['to'].' '.$last.' '.$smarty->localise->contents['outof'].'  '.$tot.' '.$smarty->localise->contents['employee'].'</span>';

			$show1 = $show2 = $show3 = $show4 = $show5 = $show6 = $show7 = $show8 = 'display:none;';
			$numorder = $ssnorder = $nameorder = $cnameorder = '';
				
			if($order == 'ascnum') {				
				$numorder = "'descnum'";
				$show1 = 'display:block;';
			}
			if($order == 'descnum') {
				$numorder = "'ascnum'";
				$show2 = 'display:block;';
			}
			
			
			if($order == 'ascssn') {
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
								
			echo '<div class="row-fluid">
			<div class="span12" style="overflow:-moz-scrollbars-horizontal; overflow-x:scroll; overflow-y:hidden;float:left;">
			<table class="table_list tbl_padding_fix" style="width:100%;">
			<tr style="height:45px;vertical-align:top;" >
				<th style="word-wrap: break-word; width:70px;" valign="top"	>
					<span style="float:left;position: relative;width: 110px;" >
					<span style="cursor:pointer;text-decoration:underline;" onclick="changeorder('.$numorder.');" >'.$smarty->localise->contents['employeenumber'].'</span>
					<span style="float:right; vertical-align:bottom;">
					<i class="icon icon-arrow-up" style="'.$show1.'" />				
					<i class="icon icon-arrow-down" style="'.$show2.'"  />
					<span>
					</span>
				</th>
				<th style="word-wrap: break-word; width:70px;" valign="top"> 
					<span style="float:left;position: relative;width: 110px;" >
					<span style="cursor:pointer;text-decoration:underline;" onclick="changeorder('.$ssnorder.');" >'.$smarty->localise->contents['SSN'].'</span>
					<span style="float:right; vertical-align:bottom;">
					<i class="icon icon-arrow-up" style="'.$show3.'"  />
					<i class="icon icon-arrow-down" style="'.$show4.'" />
					</span>
					</span>
				</th>
				<th style="word-wrap: break-word;  width:70px;" valign="top">
					<span style="float:left;position: relative;width: 110px;" >
					<span style="cursor:pointer;text-decoration:underline;" onclick="changeorder('.$nameorder.');" >'.$smarty->localise->contents['name'].'</span>
					<span style="float:right; vertical-align:bottom;">
					<i class="icon icon-arrow-up" style="'.$show5.'"  />				
					<i class="icon icon-arrow-down" style="'.$show6.'" />
					</span>
					</span>
				</th>	
				<th style="word-wrap: break-word; width:70px;" >'.$smarty->localise->contents['address'].'</th>
				<th style="word-wrap: break-word; width:70px;" >'.$smarty->localise->contents['zipcode'].'</th>
				<th style="word-wrap: break-word; width:70px;" >'.$smarty->localise->contents['city'].'</th>
				<th style="word-wrap: break-word;  width:70px;" valign="top">
					<span style="float:left;position: relative;width: 110px;" >
					<span style="cursor:pointer;text-decoration:underline;" onclick="changeorder('.$cnameorder.');" >'.$smarty->localise->contents['customer'].'</span>
					<span style="float:right; vertical-align:bottom;">
					<i class="icon icon-arrow-up" style="'.$show7.'"  />
					<i class="icon icon-arrow-down" style="'.$show8.'" />
					</span>
					</span>
				</th>
				<th style="word-wrap: break-word; width:70px;" >'.$smarty->localise->contents['mobile'].'</th>
				<th style="word-wrap: break-word; width:131px;">'.$smarty->localise->contents['email'].'</th>					              
			</tr>';		
		
		for($j=0 ; $j<10 ; $j++){
			$username = $employees[$falg]['username'];
			$fullname = $employees[$falg]['name'];
			$ssn = $employees[$falg]['social_security'];
			$city = $employees[$falg]['city'];
			$phone = $employees[$falg]['phone'];
			$customers = $employees[$falg]['customers'];
			$mobile = $employees[$falg]['mobile'];
			$status = $employees[$falg]['status'];
			$email = $employees[$falg]['email'];
			$address = $employees[$falg]['address'];
			$code = $employees[$falg]['code'];
			$posts = $employees[$falg]['post'];
		
			if($tot >= $falg+1) {
				$style = '';
				$style1 = '';
				
				if($status == 0) {
					$style = 'style="color:red;word-wrap: break-word; width:90px;  height:40px; "';
					$style1 = 'style="word-wrap: break-word; color:red;"';
				}
				else {
					$style = 'style=" word-wrap: break-word; width:90px; height:40px;"';
					$style1 = 'style=" word-wrap: break-word;"';
				}
				
				if($j%2 == 0)
                    echo'<tr class="odd" >';
                else
                    echo'<tr class="even" >';
                    
                echo'<td  '.$style.' valign="middle">&nbsp;'.$code.'</td>
                    <td  '.$style.' valign="middle">&nbsp;'.$ssn.'</td>
                    <td  '.$style.' valign="middle">&nbsp;'.$fullname.'</td>
                    <td  '.$style.' valign="middle">&nbsp;'.$address.'</td>
                    <td  '.$style.' valign="middle">&nbsp;'.$posts.'</td>
                    <td  '.$style.' valign="middle">&nbsp;'.$city.'</td>
                    <td  '.$style.' valign="middle">';
                    foreach ($customers as $customer_name) {
                    	echo $customer_name;
                    	echo '<hr style="color:#ccc;margin:0;">';
                    }
                    echo '</td>
                    <td  '.$style.' valign="middle">&nbsp;'.$mobile.'</td>	
                    <td  '.$style1.' valign="middle">&nbsp;'.$email.'</td>
                </tr>';
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
            </tr>	
        </table></div></div></div>';
		
		
	}
}
else {
	echo '
		<div id="showmain" >
		<input type="hidden" name="pages" id="pages" value="0"/>
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
				
				echo '<div class="pagention_dv span4">
						<div class="pagination">
							<ul id="pagination">	
                        </ul>
                    </div>
                </div>
            </div></div>';
			echo '<div class="row-fluid"><div class="span12"><table class="table_list tbl_padding_fix">
                <tr>
					<th>'.$smarty->localise->contents["employeenumber"].'</th>
					<th>'.$smarty->localise->contents["SSN"].'</th>
					<th>'.$smarty->localise->contents["name"].'</th>
					<th>'.$smarty->localise->contents["address"].'</th>
					<th>'.$smarty->localise->contents["zipcode"].'</th>
					<th>'.$smarty->localise->contents["city"].'</th>
					<th>'.$smarty->localise->contents["customer"].'</th>
					<th>'.$smarty->localise->contents["mobile"].'</th>
					<th>'.$smarty->localise->contents["email"].'</th>
                </tr>
				<tr>
					<td colspan="12" align="center"  class="usertdname" height="30px;" >&nbsp;<strong>'.$smarty->localise->contents["no_record_found"].'</strong></td>
				</tr>
				</table></div></div>';				
		
}

//print_r($employees);	
exit;

$employees = $employee->getemployee($name);

if(count($employees) > 0){
	echo '<ul style="position:absolute; padding:3px; width:130px; margin-left:47px; list-style:none; background:#fff;">';
	for($i=0;$i<count($employees);$i++)		
	{		
		echo '<li style=" border:1px solid #000; padding:2px; background:#fff; cursor:pointer;" onclick="fillemp(this.id);" id="'.$employees[$i]["first_name"] .' '.$employees[$i]["last_name"].'" >'.$employees[$i]["first_name"] .' '.$employees[$i]["last_name"].'</li>';
	}
	echo '</ul>';
}
else{
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