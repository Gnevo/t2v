{block name='style'}
<link media="all" href="{$url_path}css/jquery.dataTables.min.css" type="text/css" rel="stylesheet">
<link media="all" href="{$url_path}css/fixedColumns.dataTables.min.css" type="text/css" rel="stylesheet">

<style type="text/css">
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        margin: 0 auto;
        border-bottom: thin solid #DDD;
        padding-bottom: 20px;
        float: left;
        width: 100%;
    }
    .DTFC_LeftHeadWrapper{
        width: 350px !important;
    }
    .DTFC_RightBodyLiner{
        overflow-y: hidden !important;
    }
    .DTFC_LeftBodyLiner{
        overflow: hidden !important;
        width: 350px !important;
    }
    #s2id_autogen2{
        padding: 1px 12px;
    }

    
</style>
{/block}
{block name="script"}

<script type="text/javascript" src="{$url_path}js/bootbox.js"></script>
<script src="{$url_path}js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script src="{$url_path}js/dataTables.fixedColumns.min.js" type="text/javascript" ></script>

<script>
    $(document).ready(function () {
        //$('html, body').css('overflow', 'auto');
        //   $("#menu").hide();

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
        if('{$fkkn_split}' == 0){
            dt_table.columns( '.fkkn_class' ).visible( false );
            dt_table.columns.adjust().draw();
        }

        $('.DTFC_ScrollWrapper').css({ height: $(window).height()-258}); 
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
    </script>
<script type="text/javascript">
//     $(document).ready(function () {
//     $('.m').click(function (row) {
//         //alert('Click!');

//         $('#tble_list').jScrollPane();
//         $('.scroll-pane-arrows').jScrollPane({
//             showArrows: true,
//             horizontalGutter: 10
//         });
//     });
// });
                
function linkBack(){
    document.location.href = "{$url_path}export_lon/";
}
                
function submitForm(){
    var check_flag = 1
    $(".extern_code").each(function() {
        if ($(this).val() == '') {
            check_flag = 0;
            return false;
        }
    });
    if(check_flag == 1){

        $('#loading').show();
        $("#export_form").submit();
    }
    else{
        bootbox.dialog("{$translate.unfilled_salary_codes}", [{
                "label" : "{$translate.no}",
                "class" : "btn-danger",
                "callback": function() {
                    bootbox.hideAll();
                }
            }, {
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                    bootbox.hideAll();

                    $("#export_form").submit();
                }
        }]);
         
    }
}
function linkFromTemplate(){
    $('#frm_load_template').submit();
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
         <h1 style="margin: 5px ! important;">{$translate.configuration}</h1>
      </div>
      {if $fkkn_split}
          <div class="span2 day-slot-wrpr-header-left">
             <h1 style="margin: 11px ! important; background-color:#9da0a5;display:block; text-align: center; padding: 4px;">{$translate.fkkn_split}</h1>
          </div>
      {/if}
      <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 5px;">
         <button style="" class="btn btn-default btn-normal pull-right" type="button" onclick="submitForm()">{$translate.save}</button>
         <button class="btn btn-default btn-normal pull-right no-ml" type="button" onclick="linkBack()">{$translate.back}</button>
         <button class="btn btn-default btn-normal pull-right" type="button" onclick="linkFromTemplate()">{$translate.load_from_template}</button>

      </div>
    </div>
    <div class="span12 widget-body-section input-group">
        
        <div class="row-fluid" id="tble_list">
            <form method="post" action="{$url_path}export_lon-config/" class="export_lon-config clearfix" id="export_form">
            
                
                <table id="header-fixed" style="margin: 0px;" class="table table-striped order-column table-bordered" cellspacing="0" width="100%">
                    <thead>
                    
                        <tr>
                            <th >{$translate.internal}</th>
                            <th colspan = "4" >{$translate.external_vacation_saving}</th>
                            <th colspan = "4" >{$translate.external_vacation_paid}</th>
                            <th colspan = "4" >{$translate.external_monthly}</th>
                            <th colspan = "4" >{$translate.external_monthly_office}</th>
                            <th colspan = "4" >{$translate.external_monthly_office_hour}</th>
                            <th colspan = "4" >{$translate.external_no_name}</th>
                        </tr>
                        <tr>
                            <th data-orderable="false"></th>

                            <th data-orderable="false">{$translate.no_split_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.fk_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.kn_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.tu_head}</th>

                            <th data-orderable="false">{$translate.no_split_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.fk_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.kn_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.tu_head}</th>

                            <th data-orderable="false">{$translate.no_split_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.fk_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.kn_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.tu_head}</th>

                            <th data-orderable="false">{$translate.no_split_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.fk_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.kn_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.tu_head}</th>

                            <th data-orderable="false">{$translate.no_split_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.fk_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.kn_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.tu_head}</th>

                            <th data-orderable="false">{$translate.no_split_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.fk_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.kn_head}</th>
                            <th data-orderable="false" class="fkkn_class" {if $fkkn_split == 0}{/if}>{$translate.tu_head}</th>
                        </tr>
                    </thead>    
                    <tbody >
                        {$rows}
                    </tbody>

                </table>
                
            
            </form>  
            <form method="post" action="{$url_path}export_lon-config/" class="hide" id="frm_load_template">
                <input type="hidden" name="action" value="LOAD_FROM_TEMPLATE">
            </form>      
        </div>
    </div>
</div>
</div>
{/block}