<?php
require_once('class/setup.php');
require_once('class/recruitment.php');
$smarty = new smartySetup(array("recruitment.xml","recruitment_button.xml"), FALSE);
$obj_recruitment = new recruitment();
$applicant_id = $_REQUEST['app_id'];
$applicant_status = $_REQUEST['status'];
$action = $_REQUEST['action'];
$show_all = $_REQUEST['show_all'];
$comment_id = $_REQUEST['comment_id'];
if($action == 3){
   $obj_recruitment->delete_comment_recruitment($comment_id);
   echo "deleted";
//   if($show_all == '1' || $show_all == 1)
//       header("location:".$smarty->url."view/recruitment/applicant/".$applicant_id."-1/");
//   else
//       header("location:".$smarty->url."view/recruitment/applicant/".$applicant_id."/");
}elseif($action == 2){
    $comment_detail = $obj_recruitment->get_comment_recruitment_detail($comment_id); 
    $smarty->assign('comment_detail',$comment_detail);
}
$smarty->assign('app_id',$applicant_id);
$smarty->assign('app_status',$applicant_status);
$smarty->assign('action',$action);
$smarty->assign('comment_id',$comment_id);
$smarty->assign('show_all',$show_all);
if(isset($_POST['comment'])){
    $obj_recruitment->application_id = $_POST['apps_id'];
    $obj_recruitment->status = $_POST['status_popup'];
    $obj_recruitment->comment = $_POST['comment'];
    $obj_recruitment->date = date("Y-m-d");
    $comment_id = $_POST['id_comment_popup'];
    if($_POST['action_popup'] == 1){
        $obj_recruitment->add_comment_recruitment();
        if($_POST['show_all'] == 1 || $_POST['show_all'] == '1')
            header("location:".$smarty->url."view/recruitment/applicant/".$_POST['apps_id']."-1/");
        else
            header("location:".$smarty->url."view/recruitment/applicant/".$_POST['apps_id']."/");
    }elseif($_POST['action_popup'] == 2){
        $obj_recruitment->edit_comment_recruitment($comment_id);
        if($_POST['show_all'] == 1 || $_POST['show_all'] == '1')
            header("location:".$smarty->url."view/recruitment/applicant/".$_POST['apps_id']."-1/");
        else
            header("location:".$smarty->url."view/recruitment/applicant/".$_POST['apps_id']."/");
    }
}
if($action != 3)
$smarty->display('ajax_recruitment_comment.tpl');
?>