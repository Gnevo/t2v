{block name="style"}
    <link href="{$url_path}css/cirrus.css" rel="stylesheet" type="text/css" /> 
{/block} 
{block name="script"}
    <script src="{$url_path}js/rempdata.js" type="text/javascript"></script>
{/block} 

{block name="content"}
<div class="row-fluid">
    <div class="span12 main-left">
        <div class="tbl_hd"><span class="titles_tab">{$translate.employee_monthly_report}</span>
            <a href="{$url_path}reports/" class="back">{$translate.backs}</a>
        </div>
        <div id="tble_list">
            {if $errormessage eq 1}
                <div style="color:red;" align="center">{$translate.no_access_error_message} </div>
            {else}
            <table class="table_list">
                <div class="option_strip">
                    <form method="post" action="">
                        <input type="hidden" name="url" id="url" value="{$url_path}" />
                        <input type="hidden" name="hdn_alpha" id="hdn_alpha" value="" />
                        <input type="hidden" name="hdn_order" id="hdn_order" value="ascname" />
                        {$translate.show_employees}&nbsp;&nbsp;
                        <input type="checkbox" name="check1" id="check1" value="1" style="padding-top:3px;" />&nbsp;&nbsp;{$translate.active}&nbsp;&nbsp;
                        <input type="checkbox" name="check2" id="check2" value="0" />&nbsp;&nbsp;{$translate.inactive}&nbsp;&nbsp;&nbsp;
                        <input type="button" name="submit" value="{$translate.show}" onclick="adddata();" />
                    </form>
                    <span style=" float:right;">
                        <a href="javascript:void(0);" onclick="csvdownload();" title="CSV" class="mr" ><img src="{$url_path}images/csv-download.png" height="30" width="30" /></a>
                        <a href="javascript:void(0);" onclick="exceldownload();" title="Excel" class="mr" ><img src="{$url_path}images/excel-download.png" height="30" width="30" /></a>
                        <a href="javascript:void(0);" onclick="pdfdownload();" title="PDF" ><img src="{$url_path}images/pdf-download.gif" height="30" width="30" /></a>
                    </span>
                    <center>
                        <span style="display:none; position:absolute; left:750px;" id="loading">
                            <img src="{$url_path}images/sgo-loading.gif" /> 
                        </span>
                    </center>
                </div>
                <div id="showdata">
                    <div class="row-fluid">
                        <div class="pagention span12">
                            <div class="alphbts span8">
                                <ul>
                                    <li>
                                        <a onclick="select_employee('A')" href="javascript:void(0)">A</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('B')" href="javascript:void(0)">B</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('C')" href="javascript:void(0)">C</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('D')" href="javascript:void(0)">D</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('E')" href="javascript:void(0)">E</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('F')" href="javascript:void(0)">F</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('G')" href="javascript:void(0)">G</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('H')" href="javascript:void(0)">H</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('I')" href="javascript:void(0)">I</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('J')" href="javascript:void(0)">J</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('K')" href="javascript:void(0)">K</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('L')" href="javascript:void(0)">L</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('M')" href="javascript:void(0)">M</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('N')" href="javascript:void(0)">N</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('O')" href="javascript:void(0)">O</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('P')" href="javascript:void(0)">P</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('Q')" href="javascript:void(0)">Q</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('R')" href="javascript:void(0)">R</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('S')" href="javascript:void(0)">S</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('T')" href="javascript:void(0)">T</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('U')" href="javascript:void(0)">U</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('V')" href="javascript:void(0)">V</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('W')" href="javascript:void(0)">W</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('X')" href="javascript:void(0)">X</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('Y')" href="javascript:void(0)">Y</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('Z')" href="javascript:void(0)">Z</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('Å')" id="Å" href="javascript:void(0)">Å</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('Ä')" id="Ä" href="javascript:void(0)">Ä</a>
                                    </li>
                                    <li>
                                        <a onclick="select_employee('Ö')" id="Ö" href="javascript:void(0)">Ö</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="pagention_dv span4">
                                <div class="pagination" style="margin:0px;float:right;">
                                    <ul id="pagination">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </table>
            {/if}
        </div>
    </div>
</div>
{/block}
