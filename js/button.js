var ActionValue = "";
//var ActionPath = "https://www.time2view.se/cirrus-demo/recruitment_application.php";
var ActionPath = "http://192.168.0.234/works/app/t2v/cirrus/recruitment_application.php";
$(function() {
	$("div").each(function() {
		if($(this).hasClass("cirrus-button")) {
			ActionValue = $(this).attr("id-val");
			Caption = $(this).attr("caption");
			$(this).append('<form name="cirrus_form" action="'+ActionPath+'" method="post" target="_blank"><input name="company_id" type="hidden" value="'+ActionValue+'"/><a href="javascript:void(0)" class="cirrus-navigator" style="color: #fff;text-decoration: none;">'+Caption+'</a></form>');
		}
	});
	$(".cirrus-navigator").click(function(){window.cirrus_form.submit();});
});
