{block name='style'}
<link media="all" href="{$url_path}css/jquery.dataTables.min.css" type="text/css" rel="stylesheet">
<link media="all" href="{$url_path}css/fixedColumns.dataTables.min.css" type="text/css" rel="stylesheet">
<link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        margin: 0 auto;
        border-bottom: thin solid #DDD;
        padding-bottom: 20px;
        float: left;
        width: 100%;
    }
    #s2id_autogen2{
        padding: 1px 12px;
    }

    
</style>
{/block}
{block name="script"}

<script type="text/javascript" src="{$url_path}js/bootbox.js"></script>
<script src="{$url_path}js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script>
    $(document).ready(function () {
        var dt_table = $('#header-fixed').DataTable( {
            scrollY:        $(window).height()-260,
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            fixedColumns:   true,
            "aaSorting": [],
            "order": [],
            //bFilter: false, 
            bInfo: false,
            //"bProcessing": true,
            //bJQueryUI: true,
            "oLanguage": {
                "sSearch": "{$translate.search_filter} "
            },
            "initComplete": function(settings, json) {
                $('#loading').hide();
            }
        } );

        if($(window).height() > 600)
            $('#tble_list').css({ height: $(window).height()-134}); 
        else
            $('#tble_list').css({ height: $(window).height()});    

        $(window).resize(function(){
            if($(window).height() > 600)
                $('#tble_list').css({ height: $(window).height()-134}); 
            else
                $('#tble_list').css({ height: $(window).height()});  
        });  
        
    });

    function goBack() {
        var url = '{$url_path}reports/';
        window.location.href = url;
    }
</script>
{/block}

{block name="content"}

<div class="row-fluid">
<div style="margin: 0px;" class="span12 main-left">
    {$message}
    <center>  
        <span style=" position:absolute; left: 500px; top: 214px;z-index: 100;" id="loading">
            <img src="{$url_path}images/sgo-loading.gif"  />
        </span>
    </center>
    <div style="margin: 15px 0px 0px;" class="widget-header span12">
      <div class="span4 day-slot-wrpr-header-left">
         <h1 style="margin: 5px ! important;">{$translate.document_sign_report}</h1>
      </div>
      <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 5px;">
        <button class="btn btn-default btn-normal pull-right btn-cancel-category" type="button" style="margin-left: 2px;" onclick="goBack()">{$translate.back}</button>
      </div>
    </div>
    <div class="span12 widget-body-section input-group">
        <div class="option_strip clearfix" style="padding-bottom: 10px;">
            <form id="search_form" name="search_form" action="" method="post">
                <div class="workreportform_left"  style="float:inherit;">
                    <span style="padding-left: 0px">
                        {$translate.year} 
                        <select name='year' id='year'>
                            {html_options values=$year_option_values selected=$list_year output=$year_option_values}
                        </select>
                    </span> 
                    <span style="padding-left: 15px">
                        {$translate.month}
                        <select name='month' id='month'>
                            <option value="" >{$translate.select_month}</option>
                            {html_options values=$month_option_values selected=intval($list_month) output=$month_option_output_full}
                        </select>
                    </span>  
                    <span style="padding-left: 15px">
                        <input type="checkbox" value="1" {if $flag_signed}checked="checked"{/if} name="signed" id="signed" style="margin-right: 3px;"/>  
                        <span style="padding-left: 5px; padding-top: 5px;">{$translate.signed}</span>
                    </span> 
                    <span style="padding-left: 15px"></span> 
                    <span style="margin: 0 3px 0 2px;">
                        <input type="submit" value="{$translate.get}" name="btn_get" />
                    </span> 
                </div>
            </form>
        </div>
        <div class="row-fluid" id="tble_list">
            <table id="header-fixed" style="margin: 0px;" class="table table-striped order-column table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>{$translate.name}</th>
                        <th>{$translate.document}</th>
                        <th>{$translate.upload_date}</th>
                        <th>{$translate.signed}</th>
                        <th>{$translate.sign_date}</th>
                    </tr>
                </thead>    
                <tbody >
                    {foreach from=$signed_documents item=sign_documents key=username}
                        {foreach from=$sign_documents item=document key=document_id}
                            <tr>
                                <td>{$document.name}</td>
                                <td>{$document.document}</td>
                                <td>{$document.document_upload_date}</td>
                                <td>{if $document.sign}<img src="{$url_path}images/banck_id_signing.jpg" style="height: 18px;">{/if}</td>
                                <td>{$document.sign_date}</td>
                            </tr>
                        {/foreach}
                    {/foreach}
                </tbody>
            </table>     
        </div>
    </div>
</div>
</div>
{/block}