<?php
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml","messages.xml","button.xml","month.xml","reports.xml"));
require_once('class/customer.php');
require_once('configs/config.inc.php');
//require_once('plugins/customize_pdf.class.php');
//$pdf = new PDF();


//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 6));

$customer = new customer();

$test = explode('&', $_SERVER['QUERY_STRING']);
if($test[0]=='print')
{
    $emplist=$customer->customer_report($test[1], $test[3], $test[2]);
    $report_header=$smarty->translate['customer_monthly_report'];
    $report_sub_header=$smarty->translate['customer'];
    $total_cap=$smarty->translate['total'];
    $c_heading_list=array($smarty->translate['date'],$smarty->translate['work'],$smarty->translate['employee'],$smarty->translate['normal'],$smarty->translate['travel'],$smarty->translate['break'],$smarty->translate['total_hour']);
    $customer->Customer_pdf_report($emplist,$test[4],$test[5],$test[3],$report_header,$report_sub_header,$c_heading_list,$total_cap);
}
else
{
    $customer_combo=$customer->distinct_customers();
    $smarty->assign('C_combo', $customer_combo);

    $years_combo=$customer->distinct_years();
    $smarty->assign("year_option_values", $years_combo);

    //print_r($month);
    /*  $month taken from server.config.inc.php     */
    /*$smarty->assign("month_option_values", array(1,2,3,4,5,6,7,8,9,10,11,12));
    $smarty->assign("month_option_output", array($translate.january,$translate.february,$translate.march,$translate.april,$translate.may,
            $translate.june,$translate.july,$translate.august,$translate.september,$translate.october,$translate.november,$translate.december));
    */
    global $month;
    $month_num=array();
    $month_name=array();

    foreach ($month as $m_id)
    {
        $month_num[]=$m_id['id'];
        $month_name[]=$smarty->translate[$m_id['month']];
    }

    $smarty->assign("month_option_values", $month_num);
    $smarty->assign("month_option_output", $month_name);


    $cust=(isset($_POST["cmb_customer"])?$_POST["cmb_customer"]:"");
    $yr=(isset($_POST["cmb_year"])?$_POST["cmb_year"]:"");
    $month1=(isset($_POST["cmb_month"])? $_POST["cmb_month"] : "");

    $smarty->assign('customer_name', $cust);
    $smarty->assign('report_month', $month1);
    $smarty->assign('report_year', $yr);

    $emplist=$customer->customer_report($cust, $yr, $month1);
    $smarty->assign('customer_report_entries', $emplist);
    $smarty->display('extends:layouts/dashboard.tpl|customer_monthly_report.tpl');
}
?>