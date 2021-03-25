{block name='style'}
    <style type="text/css">
        .height-fix-inner-panel { height: 75px !important;;  }
        .height-set { height: auto !important;}
        .width-set { width:auto !important; }
        .time-box { font-size: 10px; height: auto !important;line-height: 20px; }
        .btn-stop{ margin-top: 25px;  }
        .slot-info{ font-size: 12px;
                    line-height: 18px; }
        @media screen and (max-width: 767px){ 
            .height-fix-inner-panel { height: 130px !important;;  }
            .height-fix-slot { height: auto !important; float: left !important; }
            .time-box { text-align: left !important; }
            .btn-stop { margin-top: 0px !important; }
        }



        @media screen and (max-width: 500px){ .btn-stop { margin-top: 25px; } } 
        @media screen and (max-width: 1238px){ .height-fix-slot { width:100% !important; }  }

    </style>
{/block}

{block name="content"}
    <div class="row-fluid">
        <div style="height: 609px;" class="span12 main-left">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div class="widget-header span12">
                    <h1>Come and go</h1>
                </div>
            </div>


            <div class="span12 widget-body-section input-group">


                <div class="row-fluid">
                    <div class="span12">


                        {if $msg_7}            
                            <div class="widget" style="margin: 0px ! important;">
                                <!--WIDGET BODY BEGIN-->
                                <div class="span12 widget-body-section" style="">
                                    <div class="row-fluid">
                                        {$msg_7}
                                    </div>
                                </div>
                            </div>
                        {/if}

                    </div>
                        <center><button class="btn btn-danger btn-large btn-margin-set" style="text-align: center; float:none !important;" type="button" onclick="doBack()">{$translate.back_to_comengo}</button></center>    
                </div>


            </div>
        </div>
    </div>
{/block}

{block name='script'}
<script>
    function doBack(){
        document.location.href = '{$url_path}comengo/';
    }
</script>    

{/block}