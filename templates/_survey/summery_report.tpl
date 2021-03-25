{block name="style"}
<link type="text/css" rel="stylesheet"  href="{$url_path}css/serva.css"/>
<link type="text/css" rel="stylesheet" media="all" href="{$url_path}css/jquery.jscrollpane.css" />
<link type="text/css" rel="stylesheet" media="all" href="{$url_path}css/jquery.jscrollpane.lozenge.css" />
<style type="text/css">
        .scroll-pane,
        .scroll-pane-arrows
        {
			width: 100%;
			height: 250px;
			overflow: auto;
        }
        .horizontal-only
        {
			height: auto;
			max-height: 250px;
        }
</style>
{/block}
{block name="script"}
<script type="text/javascript" src="{$url_path}js/jquery.jscrollpane.min.js"></script>
<script type="text/javascript">
    function getReport(){
        var user = $("#user").val();
        var survey_id = $("#survey_id").val();
        document.location.href = "{$url_path}S_summery_report_final.php?user="+user+"&survey_id="+survey_id;
    }
</script>
{/block}
{block name="content"}
<div id="wrapper">
    <div class="Surveys_block clearfix" style="padding: 0px;">
        <div class="typeof_reporthd clearfix">
            <div class="report_name">Summery Report</div>
            <div class="reportdetails_agerange">
                <div class="reportdetails_agerangecnt">Employee :</div>
                <div class="result_fromdate">
                    <select name="user" id="user">
                        {foreach $survey_users AS $users}
                            <option value="{$users.users}">{$users.name} </option>
                        {foreachelse}
                             <option value="">no users </option>
                        {/foreach}
                    </select>
                    <input type="hidden" value="{$survey_id}" name="survey_id" id="survey_id" />
                </div>
               
            </div>
                    
            <div class="creat_reportbtn"><a href="javascript:void(0)" onclick="getReport()">Creat Report</a></div>
        </div>
    </div>
</div>
{/block}