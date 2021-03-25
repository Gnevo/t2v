<?php

/**
 * Author: Shamsu
 * for managing categories
 * call from manage questions
 */

require_once('class/setup.php');
require_once('class/survey.php');
require_once ('plugins/message.class.php');

$smarty = new smartySetup(array("messages.xml"), FALSE);
//$msg = new message();
$cls_survey = new survey();
if($_SESSION['user_role'] != 1){        //check privilege
    echo "<html><body><BR><B>ERROR:</B> ".$smarty->translate['permission_denied'] ."</body></html>";
    exit;
}

if(isset($_REQUEST['category']) && trim($_REQUEST['category']) != ''){
    $new_category = trim($_REQUEST['category']);
    $exist_category = $cls_survey->get_category_by_name($new_category);
    if(empty($exist_category)){
        $cls_survey->add_new_categery($new_category, 1);
    }
}

$categories = $cls_survey->get_categeries();
$smarty->assign('categories',$categories);
echo '<ul>';
if(!empty($categories)){
    foreach ($categories as $cat){
        echo '<li> <label><input name="categories[]" type="checkbox" value="'.$cat['id'].'"> '.$cat['category_name'].'</label></li>';
    }
}
echo '</ul>';
exit();
?>