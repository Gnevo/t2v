<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once('class/employee.php');
//require_once('class/equipment.php');
$smarty = new smartySetup(array("user.xml","month.xml","messages.xml","button.xml","forms.xml","reports.xml"), FALSE);
$customer = new customer();
$employee = new employee();
//$equipment = new equipment();
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));

$uri = substr($_SERVER['REQUEST_URI'],0,-1);
$pram = explode('/',$uri);
$totparam = count($pram);
$name = $pram[$totparam-2];
$year = $pram[$totparam-1];
$employees = $employee->employee_emptocust_data($year,$name);

$page = 10;
$tot = count($employees);
$div = ceil($tot/$page);

if($tot > 0)
{
	$falg = 0;
	$chkusername = '';
	$mycnt = 0;
	for($i=0;$i<$div;$i++)	
	{

		if($i == 0)
		{
			$show = 'style="display:block;"';
		}
		else
		{
			$show = 'style="display:none;"';	
			//$show = 'style="display:block;"';
		}
		echo '
		<div id="showmain'.$i.'" '.$show.' >
		<input type="hidden" name="pages" id="pages" value="'.$div.'"/>
                <div class="row-fluid">    
		<div class="pagention span12" >
                <div class="alphbts span8" >
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
							if($div > 0)
							{
                                                            if($i > 0){
                                                          echo  '<li>
                                                                    <a class="nxt" href="javascript:void(0);" onclick="showgrid('.($i).')">
                                                                            <img src="'.$smarty->url.'images/first.png" style="margin-bottom:3px;">
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" onclick="showgrid('.($i-1).')">
                                                                            <img src="'.$smarty->url.'images/prev.png" style="margin-bottom:3px;">
                                                                    </a>
                                                                </li>';
                                                            }
								for($k=$start;$k<$end;$k++)
								{
									if($k == $i)
									{
										echo '<li><a class="selected">'.($k+1).'</a></li>';
									}
									else
									{
										echo '<li>
											<a href="javascript:void(0);" onclick="showgrid('.$k.')">'.($k+1).'</a>
										</li>';	
									}
								}
							}
                            if($div > ($i+1))                                                      
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
            </div></div>';
			
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
		echo '<span style="margin:4px 0 3px 10px; float:left;">'.($falg+1).' '.$smarty->localise->contents['to'].' '.$last.' '.$smarty->localise->contents['outof'].'  '.$tot.' '.$smarty->localise->contents['customer'].'</span>';	
			//(Englishword - swedis word) (Employee - anställd) (customer - kund) 
					
			/*echo $numorder;
			echo "<br>";
			echo $ssnorder;
			echo "<br>";
			echo $nameorder;
			echo "<br>";
			exit;*/				
			echo '<div class="row-fluid"><div class="span12" style="overflow:-moz-scrollbars-horizontal; overflow-x:scroll; overflow-y:hidden;float:left; margin-left:5px;"><table class="table_list tbl_padding_fix" style="width:100%">
			<tr style="height:45px;vertical-align:top;" >
				<th style="word-wrap: break-word; width:70px;" valign="top"	>					
					'.$smarty->localise->contents['number'].'				
				</th>
				<th style="word-wrap: break-word; width:70px;" valign="top"	>					
					'.$smarty->localise->contents['customer'].'				
				</th>

				<th style="word-wrap: break-word; width:70px;" valign="top"> 					
					'.$smarty->localise->contents['username'].'
				</th>
				<th style="word-wrap: break-word;  width:70px;" valign="top">					
					'.$smarty->localise->contents['employeename'].'					
				</th>	
				<th style="word-wrap: break-word; width:70px;" >'.$smarty->localise->contents['employeephonenumber'].'</th>
								              
			</tr>';	
				
		$number = '';
		for($j=0;$j<10;$j++)	
		{
			//print_r($employees[$falg]);
			//exit;	
			
					
			$empfname	= urldecode($employees[$falg]['empfname']);
			$emplname	= urldecode($employees[$falg]['emplname']);
			$custfname	= urldecode($employees[$falg]['custfname']);
			$custlname	= urldecode($employees[$falg]['custlname']);
			
			$empfname	= iconv('Windows-1252', 'UTF-8', $empfname);
			$emplname	= iconv('Windows-1252', 'UTF-8', $emplname);
			$custfname	= iconv('Windows-1252', 'UTF-8', $custfname);
			$custlname	= iconv('Windows-1252', 'UTF-8', $custlname);
			
			
			$username	= $employees[$falg]['username'];
			$phone		= $employees[$falg]['phone'];
			$custid		= $employees[$falg]['custid'];
			$custssn	= $employees[$falg]['custssn'];
			
			
			$customer_to_emp_count = $customer->count_cust_employee($year,$custid);
	
			if($chkusername == $employees[$falg]['custfname'] && $j != 0)
			{
				$custfullname = '';
				$number = $mycnt+1;	
				$custssnno = '';			
			}
			else if($chkusername == $employees[$falg]['custfname'] && $j == 0)
			{
				$number = ($mycnt+1).'('.$customer_to_emp_count.')';
                                if($_SESSION['company_sort_by'] == 1)
                                    $custfullname = $custfname.', '.$custlname;
                                elseif($_SESSION['company_sort_by'] == 2)
                                    $custfullname = $custlname.', '.$custfname;		
				$custssnno = $custssn;	
			}
			else
			{
				$mycnt = 0;
				$chkusername = $employees[$falg]['custfname'];
				if($_SESSION['company_sort_by'] == 1)
                                    $custfullname = $custfname.', '.$custlname;
                                elseif($_SESSION['company_sort_by'] == 2)
                                    $custfullname = $custlname.', '.$custfname;	
				
				$number = ($mycnt+1).'('.$customer_to_emp_count.')';
				$custssnno = $custssn;					
			}
			
			//SELECT * FROM timetable WHERE customer = 'cybr001' AND `status` = 1 AND YEAR(`date`) = 2012 AND employee != '' GROUP BY employee,customer
					
			if($tot >= $falg+1)
					{
						$style = 'style="padding-top:3px; padding-bottom:3px;"';
                                                
                                                $formatted_mobile = '';
                                                if($employees[$falg]['mobile'] != ''){
                                                    $length_mobile_display = (strlen($employees[$falg]['mobile'])-5)/2;
                                                    $temp_mobile = '';
                                                    $pos = 5;
                                                    for($j=0;$j<$length_mobile_display;$j++){
                                                        $temp_mobile = $temp_mobile." ".substr($employees[$falg]['mobile'], $pos,2);
                                                        $pos = $pos +2;
                                                    }
                                                    $formatted_mobile = "+46".substr($employees[$falg]['mobile'], 0,3) . " " . substr($employees[$falg]['mobile'], 3,2)." ".$temp_mobile;
                                                }
                                                $tmp_mobile = $formatted_mobile;
						
												
						if($j%2 == 0)
						{
							
							echo'<tr class="odd" >
								<td width="50" '.$style.' >&nbsp;&nbsp;'.$number.'</td>
								<td width="320" '.$style.'><a style="text-decoration:underline; margin-left:5px;" href="'.$smarty->url.'ajax_rpt_cust_profile.php?customer='.$custid.'" class="modal-toggle" data-toggle="modal" data-target="#myModal">'.iconv("UTF-8", "windows-1252",$custssnno).'<br><span style="margin-left:5px;">'.iconv("UTF-8", "windows-1252",$custfullname).'</span></a></td>	
								<td width="50" '.$style.' >&nbsp;'.$username.'</td>';
                                                                if($_SESSION['company_sort_by'] == 1)
                                                                    echo '<td width="300" '.$style.'>&nbsp;'.iconv("UTF-8", "windows-1252",$empfname.', '.$emplname).'</td>';
								elseif($_SESSION['company_sort_by'] == 2)
                                                                    echo '<td width="300" '.$style.'>&nbsp;'.iconv("UTF-8", "windows-1252",$emplname.', '.$empfname).'</td>';
								echo '<td width="100" '.$style.'>&nbsp;'.$phone.'<br>&nbsp;'.$tmp_mobile.'</td>
							</tr>';	
						}
						else
						{
							echo'<tr class="even" >
								<td width="50" '.$style.' >&nbsp;&nbsp;'.$number.'</td>
								<td width="320" '.$style.'><a style="text-decoration:underline;margin-left:5px;" href="'.$smarty->url.'ajax_rpt_cust_profile.php?customer='.$custid.'" class="modal-toggle" data-toggle="modal" data-target="#myModal">'.iconv("UTF-8", "windows-1252",$custssnno).'<br><span style="margin-left:5px;">'.iconv("UTF-8", "windows-1252",$custfullname).'</span></a></td>	
								<td width="50" '.$style.'>&nbsp;'.$username.'</td>';
                                                                if($_SESSION['company_sort_by'] == 1)
                                                                    echo '<td width="300" '.$style.'>&nbsp;'.iconv("UTF-8", "windows-1252",$empfname.', '.$emplname).'</td>';
								elseif($_SESSION['company_sort_by'] == 2)
                                                                    echo '<td width="300" '.$style.'>&nbsp;'.iconv("UTF-8", "windows-1252",$emplname.', '.$empfname).'</td>';
								echo '<td width="100" '.$style.'>&nbsp;'.$phone.'<br>&nbsp;'.$tmp_mobile.'</td>
							</tr>';
						}	
					}
			
			if($i == ($tot-1))
			{
				echo $endflag;	
			}	
			$mycnt++;
			$falg++;
		}
		
			echo '<tr>
                    <th width="50">&nbsp;</th>
                    <th width="320">&nbsp;</th>
                    <th width="50">&nbsp;</th>
                    <th width="300">&nbsp;</th>
                    <th width="100">&nbsp;</th>                   
                </tr>	
            </table></div></div></div>';
			
			$Grandtotworkinghrs = 0;
		
	}
}
else
{
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
						<div class="pagination" style="margin:0px;float:right;">
							<ul id="pagination">	
                        </ul>
                    </div>
                </div>
            </div>';
			echo '<div class="row-fluid"><div class="span12"><table class="table_list tbl_padding_fix" style="width:100%">
                <tr>
					<th>'.$smarty->localise->contents["number"].'</th>
					<th>'.$smarty->localise->contents["customer"].'</th>
					<th>'.$smarty->localise->contents["username"].'</th>
					<th>'.$smarty->localise->contents["employeename"].'</th>
					<th>'.$smarty->localise->contents["employeephonenumber"].'</th>					
                </tr>
				<tr>
					<td colspan="12" align="center"  class="usertdname" height="30px;" >&nbsp;<strong>'.$smarty->localise->contents["no_record_found"].'</strong></td>
				</tr>
				</table></div></div>';	
}

//print_r($employees);	
exit;

$employees = $employee->getemployee($name);

if(count($employees) > 0)
{
	echo '<ul style="position:absolute; padding:3px; width:130px; margin-left:47px; list-style:none; background:#fff;">';
	for($i=0;$i<count($employees);$i++)		
	{		
		echo '<li style=" border:1px solid #000; padding:2px; background:#fff; cursor:pointer;" onclick="fillemp(this.id);" id="'.$employees[$i]["first_name"] .' '.$employees[$i]["last_name"].'" >'.$employees[$i]["first_name"] .' '.$employees[$i]["last_name"].'</li>';
	}
	echo '</ul>';
}
else
{
	echo '<ul style="position:absolute; padding:3px; width:130px; margin-left:47px; list-style:none; background:#fff;">';
	echo '<li style=" border:1px solid #000; padding:2px; background:#fff;">Not Found</li>';
	echo '</ul>';
}
exit;

/*$smarty->assign('employees',$employees);
$years_work = $employee->distinct_years();
$smarty->assign("year_option_values", $years_work);
$smarty->assign('years',$years_work);
if(isset($_POST['add'])){
    $emp = $_POST['employee'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $month = intval($month);
    $smarty->assign('month',$month);
    $smarty->assign('report_year',$year);
    $smarty->assign('emp',$emp);
    $timetable = $equipment->employee_timetable_month($emp,$month,$year);
    //print_r($timetable);
    $sums = $equipment->employee_week_time_sum($timetable);
    $smarty->assign('reports',$timetable);
    $smarty->assign('sums',$sums);
}
$smarty->display('extends:layouts/dashboard.tpl|employee_leave_report.tpl');*/
?>