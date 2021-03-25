<script>
   function saveForm(){
     if($("#comment").val() == ''){
        alert("{$translate.enter_the_comment}");
     }else{
        $("#form_comment").submit();
     }
   }
</script>

<div id="coment_section" style="margin: 10px 5px 10px 13px;">
    <form name="form_comment" id="form_comment" action="{$url_path}ajax_recruitment_comment.php" method="post">
        <input type="hidden" name="apps_id" id="apps_id" value="{$app_id}"/>
        <input type="hidden" name="action_popup" id="action_popup" value="{$action}"/>
        <input type="hidden" name="status_popup" id="status_popup" value="{$app_status}"/>
        <input type="hidden" name="id_comment_popup" id="id_comment_popup" value="{$comment_id}"/>
        <input type="hidden" name="show_all" id="show_all" value="{$show_all}"/>
        <textarea name="comment" id="comment" cols="10" rows="10">{$comment_detail.comment}</textarea>
        <input  type="button" id="comment_submit" name="comment_submit" value="{$translate.save}" style="margin-top: 10px; margin-left: 10px;" onclick="saveForm()"/>
    </form>
</div>