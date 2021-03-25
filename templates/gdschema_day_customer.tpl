{block name='style'}
<link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" /><!-- DateTimePicker Plugin -->
<link rel="stylesheet" href="{$url_path}css/date-picker.css" type="text/css" /><!-- DATE PICKER -->
<link rel="stylesheet" href="{$url_path}css/contextMenu.css" type="text/css" />
<!-- <link rel="stylesheet" href="{$url_path}css/print.css" type="text/css" /> -->
<link rel="stylesheet" href="{$url_path}css/scrolltabs.css" type="text/css">
<link rel="stylesheet" href="{$url_path}css/widget-timeline.css" type="text/css" />
<style type="text/css">
    #approve_leave_on_apply{
        padding: 5px;
        background: #ffeded;
        border: solid 1px #ffc8c8 !important;
        max-width: 100%;
        color: red;
        margin: 13px 0 5px 0 !important;
    }
    #approve_leave_on_apply label{
        color: #dc7c7c;
    }
    .full_hdr{ float: left;width: 100%;background: #f0f0f0;}
    .dayview_common {
        float: left;
        width: 100%;
    }

    .dayview_head {
        width: 100%;
        float: left;
    }

    .dayview_head .cal {
        background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
        background: -moz-linear-gradient(top, rgba(91, 183, 204, 1) 1%, rgba(109, 193, 214, 1) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(1%, rgba(91, 183, 204, 1)), color-stop(100%, rgba(109, 193, 214, 1)));
        background: -webkit-linear-gradient(top, rgba(91, 183, 204, 1) 1%, rgba(109, 193, 214, 1) 100%);
        background: -o-linear-gradient(top, rgba(91, 183, 204, 1) 1%, rgba(109, 193, 214, 1) 100%);
        background: -ms-linear-gradient(top, rgba(91, 183, 204, 1) 1%, rgba(109, 193, 214, 1) 100%);
        background: linear-gradient(to bottom, rgba(91, 183, 204, 1) 1%, rgba(109, 193, 214, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#5bb7cc', endColorstr='#6dc1d6', GradientType=0);
        border-color: #4B9BAE;
        text-align: center;
        width: 12.45%;
        float: left;
        font-weight: bold;
        height: 70px;
    }

    .dayview_head .cal:nth-child(2) {
        width: 87.4% !important;
    }

    .dayview_head .cal:nth-child(1) {
        border-right: #dcdeea solid 1px;
    }

    .dayview_head span {
        display: inline-block; /*none;*/
    }

    .dayview_timeline {
        width: 100%;
        float: left;
        background: #fad9b8;
    }

    .dayview_time_icon {
        float: left;
        border-right: #dcdeea solid 1px;
        width: 12.45%;
    }

    .dayview_time_icon i {
        padding: 8px;
        float: left;
    }

    .dayview_time {
        float: left;
        width: 87.4%;
    }

    .dayview_chart {
        width: 100%;
        float: left;
    }

    .dayview_employee {
        width: 12.48%;
        float: left;
    }

    .dayview_employee ul {
        float: left;
        width: 99%;
        border-right: #dcdeea solid 1px;
    }

    .dayview_employee ul li {
        float: left;
        width: 96%;
        background: #fff;
        padding: 5px 4%; /*15px 2%;*/
        height: 15px; /*10px;*/
        margin-bottom: 3px;
    }

    .dayview_employee ul li:nth-child(2n) {
        background: #eaf9fc;
    }

    .dayview_employee ul li a, .dayview_employee ul li b {
        float: left;
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size: 11px;
    }

    .dayview_timeshow {
        float: left;
        width: 87.52%;
        position: relative;
    }

    .dayview_raw {
        float: left;
        width: 100%;
        background: #fff;
        margin-bottom: 3px;
    }

    .dayview_raw .slots_all {
        float: left;
        width: 100%;
    }

    .dayview_raw .slots_all li {
        width: auto;
        float: left;
        /*background-color: #f2c40f;*/
        height: 25px;/*40px;*/
        position: relative;
    }

    .dayview_raw:nth-child(2n) {
        background: #eaf9fc;
    }

    .dayview_client {
        float: right;
        width: 14%;
        background: #fff;
        padding-top: 5px;
        height: 93vh;
        border-left: #ccc solid 1px;
        /*text-align: center;*/
        margin-right: -10px;
        padding-right: .5%;
        position: fixed;
        right: 0px;
        z-index: 999;
    }

    .dayview_client h2 {
        float: left;
        width: 94%;
        font-size: 19px;
        border-bottom: #ccc solid 1px;
        padding: 8px 3%;
    }

    .dayview_client ul.client_list_wraper {
        float: left;
        width: 100%;
        //margin-top: 12px !important;
        //margin-bottom: 12px !important;
        max-height: 85%;
        overflow: auto;
        overflow-x: hidden;
        padding-right: 16px !important;
    }

    .dayview_client ul.client_list_wraper li {
        float: left;
        width: 100%;
        margin-bottom: 0;/*12px;*/
        height: 23px;
        padding-top: 6px;
        padding-bottom: 6px;
    }

    .dayview_client ul.client_list_wraper li span {
        float: left;
        width: 64%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        text-align: left;
    }

    .dayview_client ul.client_list_wraper li i {
        float: right;
        width: 8%;
        font-size: 15px;
        color: #afafaf;
        cursor: pointer;
        margin-top: 1px;
        padding-right: 2px;
    }

    .dayview_client ul.client_list_wraper li i:before {
        width: 100%;
        cursor: pointer;
    }

    .dayview_client ul.client_list_wraper li .client_color {
        width: 10px;
        height: 10px;
        background: #f00;
        border-radius: 100%;
        float: left;
        margin-top: 5px;
        margin-right: 4px;
        margin-left: 5%;
    }

    .dayview_time_list {
        border-top: none;
        min-height: 5px !important;
        margin-top: 5px !important;
    }

    .dayview_time_list li {
        background-position: bottom;
    }

    .dayview_number {
        min-height: 5px !important;
    }

    .opasity_zero {
        /*opacity: 0;*/
    }

    .min_height {
        min-height: 5px !important;
    }
    .client_list .client_full_name{ text-transform: capitalize; }

    .dayview_fixed_clientdetails, .dayview_fixed_content {
        position: fixed;
        top: 49px;
        background: #fff;
        max-width: 330px;
        width: 80%;
        height: 100%;
        border-left: #ccc solid 1px;
        left: 100%;
        z-index: 9;
    }

    .dayview_btn {
        background: -webkit-linear-gradient(top, rgba(255, 255, 255, 1) 0, rgba(238, 238, 238, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(252, 252, 252, 1) 100%);
        background: -o-linear-gradient(top, rgba(255, 255, 255, 1) 0, rgba(238, 238, 238, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(252, 252, 252, 1) 100%);
        background: -ms-linear-gradient(top, rgba(255, 255, 255, 1) 0, rgba(238, 238, 238, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(252, 252, 252, 1) 100%);
        border: #ccc solid 1px;
    }

    .dayview_sidesection {}

    .client_side_head {
        float: left;
        width: 100%;
        border-bottom: #ccc solid 1px;
    }

    .client_side_head h2 {
        float: left;
        width: 90%;
        text-align: left;
        border: none;
        margin-bottom: 0px;
        font-size: 15px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .worklist {
        float: left;
        width: 100%;
        max-height: 350px;
        overflow: auto;
        overflow-x: hidden;
        margin-bottom: 5px !important;
    }

    .worklist li {
        float: left;
        width: auto !important;
        background-color: #F3F3F3 !important;
        border-radius: 3px;
        padding: 3px 10px;
        font-size: 12px;
        margin-right: 5px;
        border: #ccc solid 1px;
        height: auto !important;
        margin-bottom: 4px;
    }

    .dayview_sidesection .date_day {
        width: 90%;
    }

    .width_adj {
        margin: 3% !important;
        width: 94% !important;
        text-align: left !important;
        max-height: 83vh;
        overflow: auto;
        overflow-x: hidden;
    }

    .dayview_sidesection .template_label {
        min-height: 0!important;
        text-align: left;
        margin-top: -3px;
    }

    .dayview_sidesection .wid {
        width: 80% !important;
    }

    .dayview_sidesection .btn_adjs {
        text-align: center !important;
        margin-top: 7% !important;
    }

    .button_new {
        width: 94% !important;
        margin: 3%;
    }

    .myCheckbox {
        float: left;
        width: 13%;
        margin-right: 1%;
        margin-bottom: 5px;
    }

    .myCheckbox input {
        display: none;
        position: relative;
        z-index: -9999;
    }

    .myCheckbox span {
        width: 100%;
        height: 20px;
        display: block;
        background: -webkit-linear-gradient(top, rgba(255, 255, 255, 1) 0, rgba(238, 238, 238, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(252, 252, 252, 1) 100%);
        background: -o-linear-gradient(top, rgba(255, 255, 255, 1) 0, rgba(238, 238, 238, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(252, 252, 252, 1) 100%);
        background: -ms-linear-gradient(top, rgba(255, 255, 255, 1) 0, rgba(238, 238, 238, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(252, 252, 252, 1) 100%);
        border: #ccc solid 1px;
        text-align: center;
    }

    .myCheckbox input:checked + span {
        background: -webkit-linear-gradient(top, rgba(91, 183, 204, 1) 1%, rgba(109, 193, 214, 1) 100%);
        background: -o-linear-gradient(top, rgba(91, 183, 204, 1) 1%, rgba(109, 193, 214, 1) 100%);
        background: -ms-linear-gradient(top, rgba(91, 183, 204, 1) 1%, rgba(109, 193, 214, 1) 100%);
    }

    .dropdowns {
        position: relative;
        width: 100%;
        float: left;
        margin-top: 4px;
        margin-bottom: 0px !important;
    }

    .dropdowns .input-prepend {
        font-size: 13px !important;
    }

    .dropdowns dd {
        position: relative;
        float: left;
        margin-top: 10px;
        width: 100%;
    }

    .dropdowns dd,
    .dropdowns dt {
        margin-top: -26px;
    }

    .dropdowns ul {
        margin: -1px 0 0 0;
    }

    .dropdowns dd {
        position: relative;
        float: left;
        margin-top: -2px;
    }

    .dropdowns a,
    .dropdowns a:visited {
        color: #333;
        text-decoration: none;
        outline: none;
        font-size: 12px;
        font-weight: normal;
    }

    .dropdowns dt a {
        background-color: #fff;
        display: block;
        padding: 0px 20px 0px 10px;
        min-height: 20px;
        line-height: 20px;
        overflow: hidden;
        border: 0;
        color: #333;
        border: 0;
        width: 87%;
        float: left;
        margin-left: 20px;
        position: relative;
        border: #ccc solid 1px;
    }

    .dropdowns dt a p {
        position: relative;
        width: 90%;
        float: left;
        margin: 0px;
    }

    .dropdowns dt a span,
    .multiSel span {
        cursor: pointer;
        display: block;
        padding: 0px 3px 0px 1px;
        float: left;
    }

    .dropdowns dd ul {
        background-color: #fff;
        border: 0;
        color: #333;
        display: none;
        left: 10px;
        padding: 2px 15px 2px 5px;
        position: absolute;
        width: 239px;
        list-style: none;
        height: 100px;
        overflow: auto;
        font-size: 12px;
        margin-top: 0px !important;
        border: #ccc solid 1px;
        top: -1px;
        max-height: none !important;
    }

    .dropdowns span.value {
        display: none;
    }

    .dropdowns dd ul li a {
        padding: 5px;
        display: block;
    }

    .dropdowns dd ul li a:hover {
        background-color: #fff;
    }

    .mutliSelect ul li span {
        font-size: 13px !important
    }

    .mutliSelect {
        position: relative;
        float: left;
    }

    .dropdowns dt {
        float: left;
        margin-bottom: 2px;
        width: 100%;
    }

    .mutliSelect ul li {
        margin-bottom: 0px !important;
        padding-top: 0px !important;
    }

    .mutliSelect ul li input {
        margin-top: 3px !important;
    }

    .absolute_div, .absolute_div_for_newslot {
        position: absolute;
        z-index: 9999;
        width: 300px;
        top: 100%;
        left: 0px;
        display: none;
    }

    .abs_conent {
        float: left;
        width: 100%;
    }

    .abs_conent li {
        background: none !important;
        height: auto !important;
        width: 100% !important;
        margin-bottom: 10px !important;
    }

    .abs_conent .hover-popup-comment {
        overflow-y: auto;
    }

    .absolute_div .slot-hover-popup, .absolute_div_for_newslot .slot-hover-popup {
        padding: 3%;
        margin-left: 0px;
    }

    .day_view_style {
        float: left;
        width: 100% !important;
        height: 70px !important;
    }

    .day_view_style .week__view_day {
        width: 100%;
        float: left;
    }

    .day_view_style .week__view_day .week_hd {
        width: 100%;
        float: left;
        height: 20px;
        text-align: center;
        font-size: 13px;
    }

    .day_view_style .week__view_day .full_week {
        float: left;
        width: 100%;
        font-size: 11px;
        margin-bottom: 6px !important;
        margin-top: 7px !important;
    }

    .day_view_style .week__view_day .full_week li {
        float: left;
        text-align: center;
        width: 14.26%;
        border-radius: 5px;
    }

    .day_view_style .week__view_day .full_week li .dayview_dt {
        width: 100%;
        height: 16px;
    }

    .day_view_style .week__view_day .full_week li .dayview_dt_mnth {
        width: 100% !important;
        color: #048fca;
    }

    .day_view_style span {
        width: 50%;
        border-right: #ccc solid 1px !important;
        border-left: none !important;
        padding-left: 1% !important;
        padding-right: 1% !important;
        background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
        background: -moz-linear-gradient(top, rgba(91, 183, 204, 1) 1%, rgba(109, 193, 214, 1) 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(1%, rgba(91, 183, 204, 1)), color-stop(100%, rgba(109, 193, 214, 1)));
        background: -webkit-linear-gradient(top, rgba(91, 183, 204, 1) 1%, rgba(109, 193, 214, 1) 100%);
        background: -o-linear-gradient(top, rgba(91, 183, 204, 1) 1%, rgba(109, 193, 214, 1) 100%) t;
        background: -ms-linear-gradient(top, rgba(91, 183, 204, 1) 1%, rgba(109, 193, 214, 1) 100%);
        background: linear-gradient(to bottom, rgba(91, 183, 204, 1) 1%, rgba(109, 193, 214, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#5bb7cc', endColorstr='#6dc1d6', GradientType=0);
    }

    .day_view_style .scroll_tab_inner {
        width: 96%;
    }

    .scroll_tabs_theme_light div.scroll_tab_inner {
        height: 70px !important;
        left: 2% !important;
    }

    .scroll_tabs_theme_light .scroll_tab_left_button {
        height: 70px;
        width: 2% !important;
    }

    .scroll_tabs_theme_light .scroll_tab_left_button::before {
        content: "\25C0";
        line-height: 70px;
        padding-left: 2px;
    }

    .scroll_tabs_theme_light .scroll_tab_right_button {
        height: 70px;
        width: 2% !important;
    }

    .scroll_tabs_theme_light .scroll_tab_right_button::before {
        content: "\25B6";
        line-height: 70px;
        padding-left: 2px;
    }

    .simple_textare {
        width: 93%;
        resize: none;
        height: 80px;
        overflow: auto;
        overflow-x: hidden;
    }

    .viewsecton {
        float: left;
        width: 100%;
    }

    .editsection {
        float: left;
        width: 100%;
        /*display: none;*/
    }

    .edit_abs {
        display: block !important;
        float: right;
        cursor: pointer;
        margin-bottom: 5px;
        background: #484848;
    color: #fff !important;
    padding: 3px;
    border-radius: 3px;
    font-size: 12px;
    }

    .edit_abs:before {
        cursor: pointer;
    }

    .cls_abs, .cls_abs_newslot, .work_abs, .car_pool {
        display: block !important;
        float: right;
        cursor: pointer;
        margin-bottom: 5px;
        margin-right: 8px;
        background: #484848;
    color: #fff !important;
    padding: 3px;
    border-radius: 3px;
    font-size: 12px;
    }

    .cls_abs:before, .cls_abs_newslot:before, .work_abs:before, .car_pool:before {
        cursor: pointer;
    }

    .show {
        display: block !important;
    }

    .hide {
        display: none !important;
    }

    .ruler_time {
        position: absolute;
        width: 100%;
        left: 0px;
        top: 0px;
        display: flex;
        height: 99.5%;
    }

    .ruler_time li {
        border-right: 1px solid #B7B7B7;
        height: 100%;
        width: 100%;
        flex-direction: row;
    }

    .scroll_tabs_theme_light div.scroll_tab_inner span.scroll_tab_over {
        background: #eeb280 !important;
    }

    .scroll_tabs_theme_light div.scroll_tab_inner span.scroll_tab_over .colorchange {
        background: #038fcc;
        color: #fff;
    }

    .active-week .colorchange {
        background: #038fcc !important;
        color: #fff !important;
    }

    .active-week .colorchange .dayview_dt_mnth {
        color: #fff !important;
    }

    .active-week {
        background: #eeb280 !important;
    }

    .cal .dayview_btn {
        font-size: 8px;
        /*margin-top: 21%;*/
    }

    .client_menu {
        display: none;
    }
    li.li_timeline { cursor: pointer; }
    .easy-tree i{ font-size: 11px;}
    .slot-info-box-download{ font-size: 16px; margin: 0px 0px 0 2px; display: inline-block; cursor: pointer; }
    .nonVisible{ visibility: hidden; }
    .btn-sort-by{ white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 86%; }
    @keyframes animateBorderSelectedSlot {
      to {
        border: 1px dashed white !important; box-shadow: inset 0px 0px 0px 1px blue;
      }
    }
    .selected_slot{ border: 1px dashed blue !important; box-shadow: inset 0px 0px 0px 1px white; animation: 1s animateBorderSelectedSlot infinite; }
    @media (max-width: 480px) {
        .dayview_head .cal {
            width: 12.1% !important;
        }
        .day_view_style span {
            width: 94%;
        }
        .dayview_time_icon {
            width: 12.1%;
        }
        .day_view_style .week__view_day .full_week li {
            font-size: 8px;
        }
        .timeline-number li span {
            font-size: 8px;
        }
        .dayview_client {
            position: fixed;
            right: -74%;
            z-index: 9;
            width: 74%;
            padding-right: 7px;
            max-width: 230px;
        }
         .dayview_common{ width: 100% !important; }
        .main-left {
            overflow-x: visible;
        }
        .top-fixed-navigation-wrpr {
            z-index: 9;
        }
        .right_zero {
            right: 0%;
        }
        .client_menu {
            height: 49px;
            line-height: 48px;
            background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
            background: -moz-linear-gradient(top, #fff 0, #f6f6f6 47%, #ededed 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0, #fff), color-stop(47%, #f6f6f6), color-stop(100%, #ededed));
            background: -webkit-linear-gradient(top, #fff 0, #f6f6f6 47%, #ededed 100%);
            background: -o-linear-gradient(top, #fff 0, #f6f6f6 47%, #ededed 100%);
            background: -ms-linear-gradient(top, #fff 0, #f6f6f6 47%, #ededed 100%);
            background: linear-gradient(to bottom, #fff 0, #f6f6f6 47%, #ededed 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed', GradientType=0);
            display: block;
            position: fixed;
            z-index: 9999;
            top: 0px !important;
            right: 7px;
            border: #346D9D solid 1px;
        }
        .icon-bar {
            display: block;
            width: 18px;
            height: 2px;
            background-color: #f5f5f5;
            -webkit-border-radius: 1px;
            -moz-border-radius: 1px;
            border-radius: 1px;
            -webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, .25);
            -moz-box-shadow: 0 1px 0 rgba(0, 0, 0, .25);
            box-shadow: 0 1px 0 rgba(0, 0, 0, .25);
        }
        .client_menu button {
            height: 48px;
            line-height: 49px;
        }
        .width_adj {
            height: 66vh;
        }
        .cal .dayview_btn {
            font-size: 11px;
            width: 34px;
            height: 27px;
            overflow: hidden;
            /*margin-top: 51%;*/
        }
        .absolute_div, .absolute_div_for_newslot {
            position: fixed;
            z-index: 9;
            width: 90%;
            top: 18%;
            display: none;
            left: 5% !important;
        }
        .scroll_tabs_theme_light div.scroll_tab_inner {
            height: 70px !important;
            left: 4% !important;
            font-size: 12px;
        }
        .scroll_tabs_theme_light .scroll_tab_right_button {
            height: 70px;
            width: 4% !important;
            font-size: 12px;
        }
        .scroll_tabs_theme_light .scroll_tab_right_button::before {
            padding-left: 0px !important;
            font-size: 12px;
        }
        .scroll_tabs_theme_light .scroll_tab_left_button {
            width: 4% !important;
        }
        .dayview_time_list {
            display: flex !important;
            width: 99.9% !important;
        }
        .dayview_time_list li {
            width: 100% !important;
            flex-direction: row;
            border-right: 1px solid #B7B7B7;
        }
        .absolute_div .slot-hover-popup, .absolute_div_for_newslot .slot-hover-popup {
            max-height: 280px;
            overflow-y: auto;
            overflow: auto;
            overflow-x: hidden;
        }
        .absolute_div:before, .absolute_div_for_newslot:before {
            display: none;
        }
        .absolute_div:after, .absolute_div_for_newslot:after {
            display: none;
        }
    }

    @media (min-width: 481px) and (max-width: 600px) {

        .dayview_head .cal {
            width: 12.1% !important;
        }
        .day_view_style span {
            width: 99%;
        }
        .dayview_time_icon {
            width: 12.1%;
        }
        .day_view_style .week__view_day .full_week li {
            font-size: 8px;
        }
        .timeline-number li span {
            font-size: 8px;
        }
        .dayview_client {
            position: fixed;
            right: -74%;
            z-index: 9;
            width: 74%;
            padding-right: 7px;
            max-width: 230px;
            z-index: 9;
        }
        .dayview_common.adjust_width{ width: 100% !important; }
        .dayview_common{ width: 100% !important;}
        .main-left {
            overflow-x: visible;
        }
        .top-fixed-navigation-wrpr {
            z-index: 9;
        }
        .right_zero {
            right: 0%;
        }
        .client_menu {
            height: 49px;
            line-height: 48px;
            background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJod…EiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
            background: -moz-linear-gradient(top, #fff 0, #f6f6f6 47%, #ededed 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0, #fff), color-stop(47%, #f6f6f6), color-stop(100%, #ededed));
            background: -webkit-linear-gradient(top, #fff 0, #f6f6f6 47%, #ededed 100%);
            background: -o-linear-gradient(top, #fff 0, #f6f6f6 47%, #ededed 100%);
            background: -ms-linear-gradient(top, #fff 0, #f6f6f6 47%, #ededed 100%);
            background: linear-gradient(to bottom, #fff 0, #f6f6f6 47%, #ededed 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed', GradientType=0);
            display: block;
            position: fixed;
            z-index: 9999;
            top: 0px !important;
            right: 7px;
            border: #346D9D solid 1px;
        }
        .icon-bar {
            display: block;
            width: 18px;
            height: 2px;
            background-color: #f5f5f5;
            -webkit-border-radius: 1px;
            -moz-border-radius: 1px;
            border-radius: 1px;
            -webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, .25);
            -moz-box-shadow: 0 1px 0 rgba(0, 0, 0, .25);
            box-shadow: 0 1px 0 rgba(0, 0, 0, .25);
        }
        .client_menu button {
            height: 48px;
            line-height: 49px;
        }
        .width_adj {
            height: 66vh;
        }
        .cal .dayview_btn {
            font-size: 11px;
            width: 34px;
            height: 27px;
            overflow: hidden;
            /*margin-top: 39%;*/
        }
        .absolute_div, .absolute_div_for_newslot {
            position: fixed;
            z-index: 9;
            width: 400px;
            top: 25%;
            bottom: 20px;
            margin: 0 0 0 -30%;
            left: 50% !important;
        }
        .scroll_tabs_theme_light div.scroll_tab_inner {
            height: 70px !important;
            left: 3% !important;
        }
        .scroll_tabs_theme_light .scroll_tab_right_button {
            height: 70px;
            width: 3% !important;
        }
        .scroll_tabs_theme_light .scroll_tab_right_button::before {
            padding-left: 0px !important;
        }
        .scroll_tabs_theme_light .scroll_tab_left_button {
            width: 3% !important;
        }
        .dayview_time_list {
            display: flex !important;
            width: 100.3% !important;
        }
        .dayview_time_list li {
            width: 100% !important;
            flex-direction: row;
            border-right: 1px solid #B7B7B7;
        }
        .absolute_div:before, .absolute_div_for_newslot:before {
            display: none !important;
        }
        .absolute_div:after, .absolute_div_for_newslot:after {
            display: none !important;
        }
    }

    @media (min-width: 601px) and (max-width: 768px) {

        #menu.hidden-phone .dayview_common{ width:100%; }
        .dayview_head .cal {
            width: 12.1% !important;
        }
        .day_view_style span {
            width: 99%;
        }
        .dayview_time_icon {
            width: 12.1%;
        }
        .day_view_style .week__view_day .full_week li {
            font-size: 8px;
        }
        .timeline-number li span {
            font-size: 8px;
        }
        .dayview_common.adjust_width{ width: 100% !important; }
        .dayview_common{ width: 100% !important;}
        .main-left {
            overflow-x: visible;
        }
        .top-fixed-navigation-wrpr {
            z-index: 9;
        }
        .right_zero {
            right: 0%;
        }
        .width_adj {
            height: 66vh;
        }
        .cal .dayview_btn {
            font-size: 11px;
            width: 34px;
            height: 27px;
            overflow: hidden;
            /*margin-top: 51%;*/
        }
        .absolute_div, .absolute_div_for_newslot {
            position: fixed;
            z-index: 9;
            width: 400px;
            top: 22%;
            bottom: 20px;
            margin: 0 0 0 -35%;
            left: 50% !important;
        }
        .scroll_tabs_theme_light div.scroll_tab_inner {
            height: 70px !important;
            left: 3% !important;
        }
        .scroll_tabs_theme_light .scroll_tab_right_button {
            height: 70px;
            width: 3% !important;
        }
        .scroll_tabs_theme_light .scroll_tab_right_button::before {
            padding-left: 0px !important;
        }
        .scroll_tabs_theme_light .scroll_tab_left_button {
            width: 3% !important;
        }
        .dayview_time_list {
            display: flex !important;
            width: 100.3% !important;
        }
        .dayview_time_list li {
            width: 100% !important;
            flex-direction: row;
            border-right: 1px solid #B7B7B7;
        }
        .dayview_client {
            width: 23%;
            height: 98vh;
            margin-right: 0px;
        }
        .absolute_div:before, .absolute_div_for_newslot:before {
            display: none !important;
        }
        .absolute_div:after, .absolute_div_for_newslot:after {
            display: none !important;
        }
    }

    @media (min-width: 769px) and (max-width: 960px) {
        .dayview_head .cal {
            width: 12.1% !important;
        }
        .day_view_style span {
            width: 48%;
        }
        .dayview_time_icon {
            width: 12.1%;
        }
        .day_view_style .week__view_day .full_week li {
            font-size: 8px;
        }
        .timeline-number li span {
            font-size: 8px;
        }
      
        .main-left {
            overflow-x: visible;
        }
        .top-fixed-navigation-wrpr {
            z-index: 9;
        }
        .right_zero {
            right: 0%;
        }
        .width_adj {
            height: 66vh;
        }
        .scroll_tabs_theme_light div.scroll_tab_inner {
            height: 70px !important;
            left: 3% !important;
        }
        .scroll_tabs_theme_light .scroll_tab_right_button {
            height: 70px;
            width: 3% !important;
        }
        .scroll_tabs_theme_light .scroll_tab_right_button::before {
            padding-left: 0px !important;
        }
        .scroll_tabs_theme_light .scroll_tab_left_button {
            width: 3% !important;
        }
        .dayview_time_list {
            display: flex !important;
            width: 100.3% !important;
        }
        .dayview_time_list li {
            width: 100% !important;
            flex-direction: row;
            border-right: 1px solid #B7B7B7;
        }
        .dayview_client {
            width: 23%;
            height: 98vh;
            margin-right: 0px;
        }
    }

   /* .dayview_raw:nth-last-child(-n+3) ul li .absolute_div, .dayview_raw:nth-last-child(-n+3) ul li .absolute_div_for_newslot {
        bottom: 18%;
        top: auto;
    }

    .dayview_raw:nth-last-child(-n+3) ul li .absolute_div:before, .dayview_raw:nth-last-child(-n+3) ul li .absolute_div_for_newslot:before {
        display: none;
    }

    .dayview_raw:nth-last-child(-n+3) ul li .absolute_div:after, .dayview_raw:nth-last-child(-n+3) ul li .absolute_div_for_newslot:after {
        display: block;
    }
        */
    .tooltip_upper .absolute_div{ top: auto;bottom: 100%;    left: 0px !important; }
    .unmanned_row.tooltip_upper .absolute_div{ top: auto;bottom: 100%;    left: auto !important; right: 0 !important; }
    .tooltip_upper .absolute_div_for_newslot{ top: auto;bottom: 100%;    left: 0px !important; }

    .slots_all li:nth-last-child(-n+2) .absolute_div{
        left: auto;
        right: 0px;
    }

    .slots_all li:nth-last-child(-n+2) .absolute_div_for_newslot {
        left: auto;
        right: 0px;
    }


    .absolute_div:before, .absolute_div_for_newslot:before {
        display: none !important;
        content: "";
        width: 0px;
        height: 0px;
        border-left: rgba(255, 0, 0, 0) solid 7px;
        border-bottom: #c1e3d0 solid 10px;
        border-right: rgba(255, 0, 0, 0) solid 7px;
        margin-left: 5px;
        margin-top: -10px;
    }

    .absolute_div:after, .absolute_div_for_newslot:after {
        display: none !important;
        content: "";
        width: 0px;
        height: 0px;
        border-left: rgba(255, 0, 0, 0) solid 7px;
        border-top: #c1e3d0 solid 10px;
        border-right: rgba(255, 0, 0, 0) solid 7px;
        margin-right: 3px;
        margin-top: 0px;
        float: right;
        display: none;
    }

    .day_view_style .week__view_day .full_week li:hover {
        background: #038fcc !important;
        color: #fff !important;
    }

    .day_view_style .week__view_day .full_week li:hover .dayview_dt_mnth {
        color: #fff !important;
    }

    .dayview_client  ul.client_list_wraper li:hover {
        background: #333;
        color: #fff;
    }

    .color_dark {
        background: #333 !important;
        color: #fff;
    }
    /*.color_dark i {
        color: #505050 !important;
    }*/

    .header_day_view {
        float: left;
        width: 100%;
    }

    .fixed_hd {
        position: fixed;
        z-index: 9;
        width: 71%;
    }
    .slot_time_bar{
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        border: 1px solid #bbb;
        background-color: #084a5c !important;
    }
    .easy-tree li span label {
        float: left;
    }

    #car_pool_wraper_group #car_pool_ul li{
        padding: 5px 0px !important;
        font-size: 12px;
    }

    #car_pool_wraper_group #car_pool_ul li input[type="radio"]{
        margin: 0px 5px !important;
    }


    .fixed{ position: fixed;top: 51px;z-index: 999; }


    @media (min-width: 960px) and (max-width: 1170px) {
    .dayview_head .cal{ width:12.40%; }
    .dayview_time_icon{ width:12.40%; }
    }
    @media (min-width: 769px) and (max-width: 990px) {
      .dayview_client{  width: 23%;}
    .dayview_common.adjust_width{ width: 100% !important; }
    .dayview_common{ width: 100% !important;}
    html.sticky-sidebar.sidebar:not(.fixed) #menu { z-index: 0; }

</style>
{/block} 
{block name="content"}
<div class="row-fluid" id="gdmonth_wraper">
    {* main-left*}
    <div class="span12 main-left">
        <div id="div_alloc_action" class='hide'></div>
        <div id="schedule_det">
            <div class="row-fluid">
                <div class="span12">
                    <div class="dayview_common">
                        <div class="full_hdr">
                            <div class="span12 template-customize-wrpr">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title clearfix">
                                           <div class="pull-left" style="padding:5px;">{$translate.day_view} {$translate.customer}: {$customer_details.first_name|cat: ' '|cat:$customer_details.last_name}</div>
                                            <div class="pull-right no-print">
                                                <ul class="pull-right">
                                                    <li style="background: none; border: none;">
                                                        <div class="ml pull-right timeline_control no-print hide-small-devices">
                                                            <label class="checkbox" style="padding:0 !important">
                                                                <input id="all_check" class="checkbox" value="1" type="checkbox" style="margin-right: 5px !important;"/>{$translate.check_all}
                                                            </label>
                                                        </div>
                                                    </li>
                                                    {if $privileges_gd.add_slot == 1}<li onclick="create_new_slot();" id="create-slot"><span class="icon-plus"></span><a href="javascript:void(0);"><span>{$translate.add_new}</span></a></li>{/if}
                                                    <li onclick="navigatePage('{$url_path}month/gdschema/{$current_year}/{$current_month}/{$selected_customer}/',1);"><span class="icon-calendar"></span><a href="javascript:void(0);"><span>{$translate.monthly_view}</span></a></li>
                                                    <li onclick="navigatePage('{$url_path}gdschema_alloc_window.php?date={$selected_date}&customer={$selected_customer}',1);"><span class="icon-calendar"></span><a href="javascript:void(0);"><span>{$translate.day_view}</span></a></li>
                                                    <li onclick="reload_content();"><span class="icon-refresh"></span><a href="javascript:void(0);"><span>{$translate.refresh}</span></a></li>
                                                    {if $rpt_page_url neq ''}<li><span class="icon-arrow-left"></span><a href="{$rpt_page_url}"><span>{if $from_page == 'emp_work_report'}{$translate.back_report}{else if $from_page == 'EMP_ADD'}{$translate.back_employee}{else}{$translate.back_mc_leave}{/if}</span></a></li>{/if}
                                                </ul>
                                            </div>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div id="left_message_wraper" class="span12 no-ml" style="min-height: 0px; margin-left: 0;">{$message}</div>
                            <div class="header_day_view">
                                <div class="dayview_head">
                                    <div class="cal">
                                        <button class="dayview_btn monthPicker mt" data-date="{$selected_date}" data-date-format="yyyy-mm-dd"><i class="icon-calendar"></i> {$selected_date}</button>

                                        <div class="dropdown">
                                            <button class="btn btn-warning dropdown-toggle btn-sort-by" type="button" data-toggle="dropdown">{$translate.sort_by} <span class="caret"></span></button>
                                            <ul class="dropdown-menu text-left">
                                                <li><a href="javascript:void(0);" onclick="sort_by_timeline('EMP')">{if $sort_by neq 'TIME'}<i class="icon icon-check"></i> {/if}{$translate.employee}</a></li>
                                                <li><a href="javascript:void(0);" onclick="sort_by_timeline('TIME')">{if $sort_by eq 'TIME'}<i class="icon icon-check"></i> {/if}{$translate.time}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="cal" style="background-image: none;">
                                        <div id="tabs2-copy" class="scroll_tabs_theme_light day_view_style scroll_tabs_container">
                                            <div class="scroll_tab_left_button" title="{$translate.prev}" onclick="navigatePage('{$url_path}gdschema_day_customer.php?date={$alloc_prev_week_day}&year_week=&customer={$selected_customer}&action=1',1);" style="position: absolute; left: 0px; top: 0px; cursor: pointer; display: block; width: 5% ! important; text-align: center; box-sizing: border-box; border: 1px solid rgb(204, 204, 204);"></div>
                                            <div class="scroll_tab_inner clearfix" style="overflow: hidden; font-size: 0px; position: absolute; left: 5% ! important; margin: 0px; text-overflow: clip; top: 0px; white-space: nowrap; width: 90%;">
                                                <span class="week_no_spn active-week" style="-moz-user-select: none; padding: 0px ! important; display: inline-block; width: 100%;">
                                                {foreach $week_numbers as $week}
                                                     <div class="week__view_day">
                                                         <div class="week_hd" onclick="navigatePage('{$url_path}customer/gdschema/{$week.id}/{$selected_customer}/',1);">{$translate.week} {$week.id}
                                                         </div>
                                                         <ul class="full_week">
                                                            {foreach $week['week_days'] as $days} 
                                                                 <li  {if $days['date'] == $selected_date}class="colorchange"{/if} onclick="navigatePage('{$url_path}gdschema_day_customer.php?date={$days.date}&year_week={$week.id}&customer={$selected_customer}&action=1',1);" {if (($days.date|date_format:'%u') eq 7) || ($days.date|in_array:$holidays)} style="color:red !important;"{/if}>
                                                                     <div class="dayview_dt">{$translate[$days['day']]}</div>
                                                                     <div class="dayview_dt_mnth" {if (($days.date|date_format:'%u') eq 7) || ($days.date|in_array:$holidays)} style="color:red !important;"{/if}>{$days['day_num']} {$translate[$days['month']]}</div>
                                                                 </li>
                                                            {/foreach}
                                                        </ul>
                                                     </div>
                                                 {/foreach}
                                                </span>
                                            </div>
                                            <div class="scroll_tab_right_button" title="{$translate.next}" onclick="navigatePage('{$url_path}gdschema_day_customer.php?date={$alloc_next_week_day}&year_week=&customer={$selected_customer}&action=1',1);" style="position: absolute; right: 0px; top: 0px; cursor: pointer; display: block; width: 5% ! important; text-align: center; box-sizing: border-box; border: 1px solid rgb(204, 204, 204);"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="dayview_timeline">
                                    <div class="dayview_time_icon"> <i class="icon-time"></i> <div style="margin: 5px 2px ! important; white-space: pre; text-overflow: ellipsis; overflow: hidden;"> {$translate.timeline}</div></div>
                                    <div class="dayview_time">
                                        <div class="row-fluid time-count-wrpr">
                                            <div class="span12 min_height">
                                                <ul class="span12 timeline-number dayview_number">
                                                    <li data-time-from=0 class="li_timeline"><span style="float:left; margin:0;">0</span><span>1</span></li>
                                                    <li data-time-from=1 class="li_timeline"><span>2</span></li>
                                                    <li data-time-from=2 class="li_timeline"><span>3</span></li>
                                                    <li data-time-from=3 class="li_timeline"><span>4</span></li>
                                                    <li data-time-from=4 class="li_timeline"><span>5</span></li>
                                                    <li data-time-from=5 class="li_timeline"><span>6</span></li>
                                                    <li data-time-from=6 class="li_timeline"><span>7</span></li>
                                                    <li data-time-from=7 class="li_timeline"><span>8</span></li>
                                                    <li data-time-from=8 class="li_timeline"><span>9</span></li>
                                                    <li data-time-from=9 class="li_timeline"><span>10</span></li>
                                                    <li data-time-from=10 class="li_timeline"><span>11</span></li>
                                                    <li data-time-from=11 class="li_timeline"><span>12</span></li>
                                                    <li data-time-from=12 class="li_timeline"><span>13</span></li>
                                                    <li data-time-from=13 class="li_timeline"><span>14</span></li>
                                                    <li data-time-from=14 class="li_timeline"><span>15</span></li>
                                                    <li data-time-from=15 class="li_timeline"><span>16</span></li>
                                                    <li data-time-from=16 class="li_timeline"><span>17</span></li>
                                                    <li data-time-from=17 class="li_timeline"><span>18</span></li>
                                                    <li data-time-from=18 class="li_timeline"><span>19</span></li>
                                                    <li data-time-from=19 class="li_timeline"><span>20</span></li>
                                                    <li data-time-from=20 class="li_timeline"><span>21</span></li>
                                                    <li data-time-from=21 class="li_timeline"><span>22</span></li>
                                                    <li data-time-from=22 class="li_timeline"><span>23</span></li>
                                                    <li data-time-from=23 class="li_timeline"><span style="margin-right: 0px;">24</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="row-fluid time-count-wrpr">
                                            <div class="span12 min-height-15">
                                                <ul class="dayview_time_list span12 timeline ">
                                                    <li data-time-from=0 class="li_timeline" style="border-left:solid thin #ccc;"></li>
                                                    <li data-time-from=1 class="li_timeline"></li>
                                                    <li data-time-from=2 class="li_timeline"></li>
                                                    <li data-time-from=3 class="li_timeline"></li>
                                                    <li data-time-from=4 class="li_timeline"></li>
                                                    <li data-time-from=5 class="li_timeline"></li>
                                                    <li data-time-from=6 class="li_timeline"></li>
                                                    <li data-time-from=7 class="li_timeline"></li>
                                                    <li data-time-from=8 class="li_timeline"></li>
                                                    <li data-time-from=9 class="li_timeline"></li>
                                                    <li data-time-from=10 class="li_timeline"></li>
                                                    <li data-time-from=11 class="li_timeline"></li>
                                                    <li data-time-from=12 class="li_timeline"></li>
                                                    <li data-time-from=13 class="li_timeline"></li>
                                                    <li data-time-from=14 class="li_timeline"></li>
                                                    <li data-time-from=15 class="li_timeline"></li>
                                                    <li data-time-from=16 class="li_timeline"></li>
                                                    <li data-time-from=17 class="li_timeline"></li>
                                                    <li data-time-from=18 class="li_timeline"></li>
                                                    <li data-time-from=19 class="li_timeline"></li>
                                                    <li data-time-from=20 class="li_timeline"></li>
                                                    <li data-time-from=21 class="li_timeline"></li>
                                                    <li data-time-from=22 class="li_timeline"></li>
                                                    <li data-time-from=23 class="li_timeline"></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dayview_chart">
                            <div class="dayview_employee">
                                <ul>
                                    {foreach from=$employee_day_slots key=emp_key item=employee_data}
                                        <li class="emp_entry" data-emp='{$emp_key}'><a href="javascript:void(0);" {if $employee_data['show_details'] == 1}onclick="navigatePage('{$url_path}gdschema_alloc_window_employee.php?date={$selected_date}&employee={$emp_key}',1);"{/if}>{$employee_data['name']}</a></li>
                                    {/foreach}
                                    {if $unmanned_day_slots|count gt 0}
                                        {*$unmanned_day_slots|count*26.21*}
                                        {*13 => 5 + 5 paddings top and bottom + 3 bottom margin
                                          15 => text container css height  *}
                                        <li class="emp_entry" style="height: {(($unmanned_day_slots|count-1)*(13+15))+15}px;"><b>{$translate.unmanned}</b></li>
                                    {/if}
                                </ul>
                            </div>
                            <div class="dayview_timeshow">
                                <ul class="ruler_time">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                                {assign var=emp_index value=0}
                                {foreach $employee_day_slots key=emp_key item=employee_data}
                                    {assign var=emp_index value=$emp_index+1}
                                    <div class="dayview_raw {if $emp_index gt 8}tooltip_upper{/if}" data-emp='{$emp_key}'>
                                        <ul class="slots_all">
                                            {if $employee_data['slots']|count gt 0}
                                                {*foreach $employee_data['slots'] as $slot_det*}
                                                {foreach from=$employee_data['slots'] key=slot_index item=slot_det name=slot_data}
                                                    {if $slot_det['slot_difference'] != 0}
                                                        <li style="width:{$slot_det['slot_difference']*4.16}%" class="raw1 opasity_zero">
                                                            {if $privileges_gd.add_slot == 1}
                                                                <div class="absolute_div_for_newslot">
                                                                    <div class="slot-hover-popup span12 slot-theme-complete">
                                                                        <i class="icon-remove cls_abs_newslot" title="{$translate.tooltip_close}"></i>
                                                                        <div class="editsection">
                                                                            <input type="hidden" class="new_slot_details_hub" 
                                                                                        data-time-from='{if $smarty.foreach.slot_data.first}0.00{else}{$employee_data['slots'][$slot_index-1]['slot_to']}{/if}'
                                                                                        data-time-to='{$slot_det.slot_from}'
                                                                                        data-employee-id='{$slot_det.employee}'
                                                                                        data-employee-name='{$slot_det.emp_name|escape:'html'}'
                                                                                        />
                                                                            <div class="span12" style="margin-left: 0px;">
                                                                                <div class="slot-wrpr span12 time_slots_theme" id="slot-wrpr-month" style="margin-bottom:5px !important;">
                                                                                    <div class="span12" style="margin:0;">
                                                                                        <div class="input-prepend date hasDatepicker span11 datepicker" id="slot_details_date_newslot" style="padding-left: 0px;">
                                                                                            <span class="add-on icon-calendar" title="{$translate.date}"></span>
                                                                                            <input class="form-control span12" id="sdDate_newslot" value="{$selected_date}" placeholder="{$translate.date}" type="text"/>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="span12" style="margin-left: 0px;">
                                                                                        <div class="input-prepend">
                                                                                            <span class="add-on  icon-time " title="{$translate.time}"></span>
                                                                                            <input class="form-control span5 custom_slot slot_from time-input-text" id="new_slot_from" name="slot_from" value="{if $smarty.foreach.slot_data.first}0.00{else}{$employee_data['slots'][$slot_index-1]['slot_to']}{/if}" placeholder="{$translate.from}" type="text" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;">
                                                                                            <span class="add-on"> {$translate.to} </span>
                                                                                            <input class="form-control span5 custom_slot slot_to time-input-text" id="new_slot_to" name="slot_to" value="{$slot_det.slot_from}" placeholder="{$translate.to}" type="text" style="margin-left: -1px;width: 43%;">
                                                                                        </div>
                                                                                    </div>
                                                                                    <h2 class="span12 no-mb no-padding"><span class="icon-group" title="{$translate.employee}"></span> 
                                                                                        <span id="sdEmployee">{$slot_det.emp_name}</span>
                                                                                    </h2>
                                                                                    <div class="span12" style="margin-left: 0px;">
                                                                                        <div class="input-prepend span11">
                                                                                            <span class="add-on icon-user" title="{$translate.customer}"></span>
                                                                                            <select id="custom_slot_customer" name="custom_slot_customer" class="form-control custom_slot_customer span12">
                                                                                                <option value="">{$translate.select}</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="span12" style="margin-left: 0px;">
                                                                                        <div class="input-prepend span11">
                                                                                            <span class="add-on icon-star" title="{$translate.fkkn}"></span>
                                                                                            <select class="form-control span12 custom_slot_fkkn" name="custom_slot_fkkn" id="custom_slot_fkkn">
                                                                                                <option value="1" selected="selected">{$translate.fk}</option>
                                                                                                <option value="2">{$translate.kn}</option>
                                                                                                <option value="3">{$translate.tu}</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="span12" style="margin-left: 0px;">
                                                                                        <div class="input-prepend span11">
                                                                                            <span class="add-on icon-comment" title="{$translate.comment}"></span>
                                                                                            <textarea class="form-control span12" id="sdComment" rows="1" placeholder="{$translate.comment}"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <ul class="slot-icons slot-icons-day slot-icons-day-small pull-right single-slot-icon-list span12 can_change" style="width: 27px; height: 30px; overflow: hidden;">
                                                                                        <li class="slot-icon slot-icon-type-1 slot-icon-small-travel" data-value='1' title="{$translate.travel}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-0 slot-icon-small-normal active" data-value='0' title="{$translate.normal}"></li>
                                                                                        <li class="slot-icon slot-icon-type-2 slot-icon-small-break" data-value='2' title="{$translate.break}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-3 slot-icon-small-oncall" data-value='3' title="{$translate.oncall}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-4 slot-icon-small-over-time" data-value='4' title="{$translate.overtime}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-5 slot-icon-small-qualtiy-overtime" data-value='5' title="{$translate.qual_overtime}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-6 slot-icon-small-more-time" data-value='6' title="{$translate.more_time}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-14 slot-icon-small-oncall-moretime" data-value='14' title="{$translate.more_oncall}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-7 slot-icon-small-some-other-time" data-value='7' title="{$translate.some_other_time}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-8 slot-icon-small-training" data-value='8' title="{$translate.training_time}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-9 slot-icon-small-call-training" data-value='9' title="{$translate.call_training}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-10 slot-icon-small-personal-meeting" data-value='10' title="{$translate.personal_meeting}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-11 slot-icon-small-voluntary" data-value='11' title="{$translate.voluntary}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-12 slot-icon-small-complimentary" data-value='12' title="{$translate.complementary}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-13 slot-icon-small-complimentary-oncall" data-value='13' title="{$translate.complementary_oncall}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-15 slot-icon-small-standby" data-value='15' title="{$translate.oncall_standby}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-16 slot-icon-small-dismissal" data-value='16' title="{$translate.work_for_dismissal}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-17 slot-icon-small-dismissal-oncall" data-value='17' title="{$translate.work_for_dismissal_oncall}" style="display: none;"></li>
                                                                                    </ul>
                                                                                    <div class="slot-wrpr-buttons button_new">
                                                                                        <button type="button" class="btn btn-success span12 manEntryFromTimeLine" onclick="manEntryFromTimeLine(this);"><span class="icon-save"></span> {$translate.save}</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            {/if}
                                                        </li>
                                                    {/if}
                                                    {if $login_user_role neq 3 or ($login_user_role eq 3 and ($privileges_gd.not_show_employees eq 0 || ($privileges_gd.not_show_employees eq 1 and $slot_det.employee eq $login_user)))}
                                                        <li data-id="{$slot_det['id']}" data-customer="{$slot_det['customer']}" class="raw1 slot_time_bar {if $slot_det.signed eq 1}signed_slot striped{/if} {if $slot_det.status eq 2}slot-theme-leave{elseif $slot_det.status eq 4}slot-theme-candg{elseif $slot_det.status eq 0 or $slot_det.status eq 3}slot-theme-incomplete{elseif $slot_det.status eq 1 and $slot_det.created_status eq 1}slot-theme-candg-accept{elseif $slot_det.type eq 10}slot-theme-pm{else}slot-theme-complete{/if}" style=" width:{$slot_det.slot_hour*4.16}%; {if $slot_det.status neq 2 and $slot_det.status neq 4 and $slot_det.status neq 0 and $slot_det.status neq 3 and !($slot_det.status eq 1 and $slot_det.created_status eq 1) and $slot_det.type neq 10}background: none; background-color: {$slot_det['employee_color']}{/if} !important" id="slot_thread_{$slot_det['id']}">
                                                            <div class="absolute_div {if $slot_det.status eq 2}slot-theme-leave{elseif $slot_det.status eq 4}slot-theme-candg{elseif $slot_det.status eq 0 or $slot_det.status eq 3}slot-theme-incomplete{elseif $slot_det.status eq 1 and $slot_det.created_status eq 1}slot-theme-candg-accept{elseif $slot_det.type eq 10}slot-theme-pm{else}slot-theme-complete{/if}">
                                                                <div class="slot-hover-popup span12">
                                                                    {if $slot_det.show_details eq 1 and $slot_det.signed neq 1}<i class="icon-pencil edit_abs" title="{$translate.tooltip_edit_slot}"></i>{/if}
                                                                    {if $slot_det.status neq 2 and $slot_det.signed eq 0}<input type="checkbox" value="{$slot_det.id}" class="check-box m_check" title="{$translate.select_slot}">{/if}
                                                                    <i class="icon-remove cls_abs" title="{$translate.tooltip_close}"></i>
                                                                    <div class="viewsecton {if $slot_det.signed eq 1}striped{/if}">
                                                                        <input type="hidden" class="slot_details_hub" 
                                                                                    data-id='{$slot_det.id}'
                                                                                    data-type='{$slot_det.type}'
                                                                                    data-date='{$slot_det.date}'
                                                                                    data-status='{$slot_det.status}'
                                                                                    data-time-from='{$slot_det.slot_from}'
                                                                                    data-time-to='{$slot_det.slot_to}'
                                                                                    data-total_hours='{$slot_det.slot_hour}'
                                                                                    data-customer-id='{$slot_det.customer}'
                                                                                    data-customer-name='{$slot_det.cust_name|escape:'html'}'
                                                                                    data-employee-id='{$slot_det.employee}'
                                                                                    data-employee-name='{$slot_det.emp_name|escape:'html'}'
                                                                                    data-fkkn='{$slot_det.fkkn}'
                                                                                    data-signed='{$slot_det.signed}'
                                                                                    data-comment='{$slot_det.comment|escape:'html'}'
                                                                                    />
                                                                        {if $slot_det.status == 2 && $slot_det.signed == 0 && $slot_det.tl_flag ==1}
                                                                            <input type="hidden" class="slot_leave_details_hub" 
                                                                                    data-leave-id='{$slot_det.leave_data.id}'
                                                                                    data-leave-group-id='{$slot_det.leave_data.group_id}'
                                                                                    data-leave-status='{$slot_det.leave_data.status}'
                                                                                    data-leave-time-from='{$slot_det.leave_data.time_from}'
                                                                                    data-leave-time-to='{$slot_det.leave_data.time_to}'
                                                                                    data-leave-is-exist-relation='{$slot_det.leave_data.is_exist_relation}'
                                                                                    />
                                                                        {/if}
                                                                        <ul class="abs_conent">
                                                                            <li><h1>{$slot_det['slot_from']}-{$slot_det['slot_to']} ({$slot_det['slot_hour']})</h1></li>
                                                                            <li><span class="icon-group"></span> {$slot_det['cust_name']}</li>
                                                                            <li><span class="icon-user"></span> {$slot_det['emp_name']}</li>
                                                                            {if $slot_det['comment'] neq ''}<li class="hover-popup-comment"><span class="icon-comment"></span>{$slot_det['comment']}</li>{/if}
                                                                        </ul>
                                                                        <span class='pull-left'>
                                                                            <span class="slot-type pull-left">
                                                                                {if $slot_det['fkkn'] eq 1}{$translate.fk}
                                                                                {else if $slot_det['fkkn'] eq 2}{$translate.kn}
                                                                                {else if $slot_det['fkkn'] eq 3}{$translate.tu}
                                                                                {/if}
                                                                            </span>
                                                                            <span class='pull-left ml'>
                                                                                <ul class="slot-type-small-icons-group clearfix">
                                                                                    <li class="slot-icon slot-icon-type-{$slot_det['type']} {$slot_det['slot_type_class']} active" title="{$slot_det['slot_type_label']}"></li>
                                                                                </ul>
                                                                            </span>
                                                                            {if $slot_det['status'] eq 2}
                                                                                <span class="label label-important ml" style="padding: 5px;">{$slot_det.leave_data.leave_name}</span>
                                                                            {/if}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    {else}
                                                        <li style="width:{$slot_det.slot_hour*4.16}%" class="raw1 opasity_zero">
                                                            {if $privileges_gd.add_slot == 1}
                                                                <div class="absolute_div_for_newslot">
                                                                    <div class="slot-hover-popup span12 slot-theme-complete">
                                                                        <i class="icon-remove cls_abs_newslot" title="{$translate.tooltip_close}"></i>
                                                                        <div class="editsection">
                                                                            <input type="hidden" class="new_slot_details_hub" 
                                                                                        data-time-from='{$slot_det.slot_from}'
                                                                                        data-time-to='{$slot_det.slot_to}'
                                                                                        data-employee-id='{$slot_det.employee}'
                                                                                        data-employee-name='{$slot_det.emp_name|escape:'html'}'
                                                                                        />
                                                                            <div class="span12" style="margin-left: 0px;">
                                                                                <div class="slot-wrpr span12 time_slots_theme" id="slot-wrpr-month" style="margin-bottom:5px !important;">
                                                                                    <div class="span12" style="margin:0;">
                                                                                        <div class="input-prepend date hasDatepicker span11 datepicker" id="slot_details_date_newslot" style="padding-left: 0px;">
                                                                                            <span class="add-on icon-calendar" title="{$translate.date}"></span>
                                                                                            <input class="form-control span12" id="sdDate_newslot" value="{$selected_date}" placeholder="{$translate.date}" type="text"/>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="span12" style="margin-left: 0px;">
                                                                                        <div class="input-prepend">
                                                                                            <span class="add-on  icon-time " title="{$translate.time}"></span>
                                                                                            <input class="form-control span5 custom_slot slot_from time-input-text" id="new_slot_from" name="slot_from" value="{if $smarty.foreach.slot_data.first}0.00{else}{$employee_data['slots'][$slot_index-1]['slot_to']}{/if}" placeholder="{$translate.from}" type="text" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;">
                                                                                            <span class="add-on"> {$translate.to} </span>
                                                                                            <input class="form-control span5 custom_slot slot_to time-input-text" id="new_slot_to" name="slot_to" value="{$slot_det.slot_from}" placeholder="{$translate.to}" type="text" style="margin-left: -1px;width: 43%;">
                                                                                        </div>
                                                                                    </div>
                                                                                    <h2 class="span12 no-mb no-padding"><span class="icon-group" title="{$translate.employee}"></span> 
                                                                                        <span id="sdEmployee">{$slot_det.emp_name}</span>
                                                                                    </h2>
                                                                                    <div class="span12" style="margin-left: 0px;">
                                                                                        <div class="input-prepend span11">
                                                                                            <span class="add-on icon-user" title="{$translate.customer}"></span>
                                                                                            <select id="custom_slot_customer" name="custom_slot_customer" class="form-control custom_slot_customer span12">
                                                                                                <option value="">{$translate.select}</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="span12" style="margin-left: 0px;">
                                                                                        <div class="input-prepend span11">
                                                                                            <span class="add-on icon-star" title="{$translate.fkkn}"></span>
                                                                                            <select class="form-control span12 custom_slot_fkkn" name="custom_slot_fkkn" id="custom_slot_fkkn">
                                                                                                <option value="1" selected="selected">{$translate.fk}</option>
                                                                                                <option value="2">{$translate.kn}</option>
                                                                                                <option value="3">{$translate.tu}</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="span12" style="margin-left: 0px;">
                                                                                        <div class="input-prepend span11">
                                                                                            <span class="add-on icon-comment" title="{$translate.comment}"></span>
                                                                                            <textarea class="form-control span12" id="sdComment" rows="1" placeholder="{$translate.comment}"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <ul class="slot-icons slot-icons-day slot-icons-day-small pull-right single-slot-icon-list span12 can_change" style="width: 27px; height: 30px; overflow: hidden;">
                                                                                        <li class="slot-icon slot-icon-type-1 slot-icon-small-travel" data-value='1' title="{$translate.travel}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-0 slot-icon-small-normal active" data-value='0' title="{$translate.normal}"></li>
                                                                                        <li class="slot-icon slot-icon-type-2 slot-icon-small-break" data-value='2' title="{$translate.break}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-3 slot-icon-small-oncall" data-value='3' title="{$translate.oncall}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-4 slot-icon-small-over-time" data-value='4' title="{$translate.overtime}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-5 slot-icon-small-qualtiy-overtime" data-value='5' title="{$translate.qual_overtime}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-6 slot-icon-small-more-time" data-value='6' title="{$translate.more_time}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-14 slot-icon-small-oncall-moretime" data-value='14' title="{$translate.more_oncall}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-7 slot-icon-small-some-other-time" data-value='7' title="{$translate.some_other_time}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-8 slot-icon-small-training" data-value='8' title="{$translate.training_time}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-9 slot-icon-small-call-training" data-value='9' title="{$translate.call_training}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-10 slot-icon-small-personal-meeting" data-value='10' title="{$translate.personal_meeting}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-11 slot-icon-small-voluntary" data-value='11' title="{$translate.voluntary}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-12 slot-icon-small-complimentary" data-value='12' title="{$translate.complementary}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-13 slot-icon-small-complimentary-oncall" data-value='13' title="{$translate.complementary_oncall}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-15 slot-icon-small-standby" data-value='15' title="{$translate.oncall_standby}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-16 slot-icon-small-dismissal" data-value='16' title="{$translate.work_for_dismissal}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-17 slot-icon-small-dismissal-oncall" data-value='17' title="{$translate.work_for_dismissal_oncall}" style="display: none;"></li>
                                                                                    </ul>
                                                                                    <div class="slot-wrpr-buttons button_new">
                                                                                        <button type="button" class="btn btn-success span12 manEntryFromTimeLine" onclick="manEntryFromTimeLine(this);"><span class="icon-save"></span> {$translate.save}</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            {/if}
                                                        </li>
                                                    {/if}
                                                    {if $smarty.foreach.slot_data.last and $slot_det.slot_to neq '24.00' and $slot_det.slot_to neq '24'}
                                                        <li style="width:{$slot_det['day_end_unalloc_duration']*4.16}%" class="raw1 opasity_zero">
                                                            {if $privileges_gd.add_slot == 1}
                                                                <div class="absolute_div_for_newslot">
                                                                    <div class="slot-hover-popup span12 slot-theme-complete">
                                                                        <i class="icon-remove cls_abs_newslot" title="{$translate.tooltip_close}"></i>
                                                                        <div class="editsection">
                                                                            <input type="hidden" class="new_slot_details_hub" 
                                                                                        data-time-from='{$slot_det.slot_to}'
                                                                                        data-time-to='24.00'
                                                                                        data-employee-id='{$slot_det.employee}'
                                                                                        data-employee-name='{$slot_det.emp_name|escape:'html'}'
                                                                                        />
                                                                            <div class="span12" style="margin-left: 0px;">
                                                                                <div class="slot-wrpr span12 time_slots_theme" id="slot-wrpr-month" style="margin-bottom:5px !important;">
                                                                                    <div class="span12" style="margin:0;">
                                                                                        <div class="input-prepend date hasDatepicker span11 datepicker" id="slot_details_date_newslot" style="padding-left: 0px;">
                                                                                            <span class="add-on icon-calendar" title="{$translate.date}"></span>
                                                                                            <input class="form-control span12" id="sdDate_newslot" value="{$selected_date}" placeholder="{$translate.date}" type="text"/>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="span12" style="margin-left: 0px;">
                                                                                        <div class="input-prepend">
                                                                                            <span class="add-on  icon-time " title="{$translate.time}"></span>
                                                                                            <input class="form-control span5 custom_slot slot_from time-input-text" id="new_slot_from" name="slot_from" value="{$slot_det.slot_to}" placeholder="{$translate.from}" type="text" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;">
                                                                                            <span class="add-on"> {$translate.to} </span>
                                                                                            <input class="form-control span5 custom_slot slot_to time-input-text" id="new_slot_to" name="slot_to" value="24.00" placeholder="{$translate.to}" type="text" style="margin-left: -1px;width: 43%;">
                                                                                        </div>
                                                                                    </div>
                                                                                    <h2 class="span12 no-mb no-padding"><span class="icon-group" title="{$translate.employee}"></span> 
                                                                                        <span id="sdEmployee">{$slot_det.emp_name}</span>
                                                                                    </h2>
                                                                                    <div class="span12" style="margin-left: 0px;">
                                                                                        <div class="input-prepend span11">
                                                                                            <span class="add-on icon-user" title="{$translate.customer}"></span>
                                                                                            <select id="custom_slot_customer" name="custom_slot_customer" class="form-control custom_slot_customer span12">
                                                                                                <option value="">{$translate.select}</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="span12" style="margin-left: 0px;">
                                                                                        <div class="input-prepend span11">
                                                                                            <span class="add-on icon-star" title="{$translate.fkkn}"></span>
                                                                                            <select class="form-control span12 custom_slot_fkkn" name="custom_slot_fkkn" id="custom_slot_fkkn">
                                                                                                <option value="1" selected="selected">{$translate.fk}</option>
                                                                                                <option value="2">{$translate.kn}</option>
                                                                                                <option value="3">{$translate.tu}</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="span12" style="margin-left: 0px;">
                                                                                        <div class="input-prepend span11">
                                                                                            <span class="add-on icon-comment" title="{$translate.comment}"></span>
                                                                                            <textarea class="form-control span12" id="sdComment" rows="1" placeholder="{$translate.comment}"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <ul class="slot-icons slot-icons-day slot-icons-day-small pull-right single-slot-icon-list span12 can_change" style="width: 27px; height: 30px; overflow: hidden;">
                                                                                        <li class="slot-icon slot-icon-type-1 slot-icon-small-travel" data-value='1' title="{$translate.travel}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-0 slot-icon-small-normal active" data-value='0' title="{$translate.normal}"></li>
                                                                                        <li class="slot-icon slot-icon-type-2 slot-icon-small-break" data-value='2' title="{$translate.break}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-3 slot-icon-small-oncall" data-value='3' title="{$translate.oncall}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-4 slot-icon-small-over-time" data-value='4' title="{$translate.overtime}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-5 slot-icon-small-qualtiy-overtime" data-value='5' title="{$translate.qual_overtime}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-6 slot-icon-small-more-time" data-value='6' title="{$translate.more_time}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-14 slot-icon-small-oncall-moretime" data-value='14' title="{$translate.more_oncall}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-7 slot-icon-small-some-other-time" data-value='7' title="{$translate.some_other_time}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-8 slot-icon-small-training" data-value='8' title="{$translate.training_time}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-9 slot-icon-small-call-training" data-value='9' title="{$translate.call_training}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-10 slot-icon-small-personal-meeting" data-value='10' title="{$translate.personal_meeting}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-11 slot-icon-small-voluntary" data-value='11' title="{$translate.voluntary}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-12 slot-icon-small-complimentary" data-value='12' title="{$translate.complementary}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-13 slot-icon-small-complimentary-oncall" data-value='13' title="{$translate.complementary_oncall}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-15 slot-icon-small-standby" data-value='15' title="{$translate.oncall_standby}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-16 slot-icon-small-dismissal" data-value='16' title="{$translate.work_for_dismissal}" style="display: none;"></li>
                                                                                        <li class="slot-icon slot-icon-type-17 slot-icon-small-dismissal-oncall" data-value='17' title="{$translate.work_for_dismissal_oncall}" style="display: none;"></li>
                                                                                    </ul>
                                                                                    <div class="slot-wrpr-buttons button_new">
                                                                                        <button type="button" class="btn btn-success span12 manEntryFromTimeLine" onclick="manEntryFromTimeLine(this);"><span class="icon-save"></span> {$translate.save}</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            {/if}
                                                        </li>
                                                    {/if}
                                                {/foreach}
                                            {else}
                                                <li style="width:{24*4.16}%" class="raw1 opasity_zero">
                                                    {if $privileges_gd.add_slot == 1}
                                                        <div class="absolute_div_for_newslot">
                                                            <div class="slot-hover-popup span12 slot-theme-complete">
                                                                <i class="icon-remove cls_abs_newslot" title="{$translate.tooltip_close}"></i>
                                                                <div class="editsection">
                                                                    <input type="hidden" class="new_slot_details_hub" 
                                                                                data-time-from='0'
                                                                                data-time-to='24.00'
                                                                                data-employee-id='{$employee_data.username}'
                                                                                data-employee-name='{$employee_data.name|escape:'html'}'
                                                                                />
                                                                    <div class="span12" style="margin-left: 0px;">
                                                                        <div class="slot-wrpr span12 time_slots_theme" id="slot-wrpr-month" style="margin-bottom:5px !important;">
                                                                            <div class="span12" style="margin:0;">
                                                                                <div class="input-prepend date hasDatepicker span11 datepicker" id="slot_details_date_newslot" style="padding-left: 0px;">
                                                                                    <span class="add-on icon-calendar" title="{$translate.date}"></span>
                                                                                    <input class="form-control span12" id="sdDate_newslot" value="{$selected_date}" placeholder="{$translate.date}" type="text"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="span12" style="margin-left: 0px;">
                                                                                <div class="input-prepend">
                                                                                    <span class="add-on  icon-time " title="{$translate.time}"></span>
                                                                                    <input class="form-control span5 custom_slot slot_from time-input-text" id="new_slot_from" name="slot_from" value="0" placeholder="{$translate.from}" type="text" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;">
                                                                                    <span class="add-on"> {$translate.to} </span>
                                                                                    <input class="form-control span5 custom_slot slot_to time-input-text" id="new_slot_to" name="slot_to" value="24.00" placeholder="{$translate.to}" type="text" style="margin-left: -1px;width: 43%;">
                                                                                </div>
                                                                            </div>
                                                                            <h2 class="span12 no-mb no-padding"><span class="icon-group" title="{$translate.employee}"></span> 
                                                                                <span id="sdEmployee">{$employee_data.name}</span>
                                                                            </h2>
                                                                            <div class="span12" style="margin-left: 0px;">
                                                                                <div class="input-prepend span11">
                                                                                    <span class="add-on icon-user" title="{$translate.customer}"></span>
                                                                                    <select id="custom_slot_customer" name="custom_slot_customer" class="form-control custom_slot_customer span12">
                                                                                        <option value="">{$translate.select}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="span12" style="margin-left: 0px;">
                                                                                <div class="input-prepend span11">
                                                                                    <span class="add-on icon-star" title="{$translate.fkkn}"></span>
                                                                                    <select class="form-control span12 custom_slot_fkkn" name="custom_slot_fkkn" id="custom_slot_fkkn">
                                                                                        <option value="1" selected="selected">{$translate.fk}</option>
                                                                                        <option value="2">{$translate.kn}</option>
                                                                                        <option value="3">{$translate.tu}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="span12" style="margin-left: 0px;">
                                                                                <div class="input-prepend span11">
                                                                                    <span class="add-on icon-comment" title="{$translate.comment}"></span>
                                                                                    <textarea class="form-control span12" id="sdComment" rows="1" placeholder="{$translate.comment}"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <ul class="slot-icons slot-icons-day slot-icons-day-small pull-right single-slot-icon-list span12 can_change" style="width: 27px; height: 30px; overflow: hidden;">
                                                                                <li class="slot-icon slot-icon-type-1 slot-icon-small-travel" data-value='1' title="{$translate.travel}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-0 slot-icon-small-normal active" data-value='0' title="{$translate.normal}"></li>
                                                                                <li class="slot-icon slot-icon-type-2 slot-icon-small-break" data-value='2' title="{$translate.break}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-3 slot-icon-small-oncall" data-value='3' title="{$translate.oncall}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-4 slot-icon-small-over-time" data-value='4' title="{$translate.overtime}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-5 slot-icon-small-qualtiy-overtime" data-value='5' title="{$translate.qual_overtime}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-6 slot-icon-small-more-time" data-value='6' title="{$translate.more_time}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-14 slot-icon-small-oncall-moretime" data-value='14' title="{$translate.more_oncall}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-7 slot-icon-small-some-other-time" data-value='7' title="{$translate.some_other_time}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-8 slot-icon-small-training" data-value='8' title="{$translate.training_time}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-9 slot-icon-small-call-training" data-value='9' title="{$translate.call_training}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-10 slot-icon-small-personal-meeting" data-value='10' title="{$translate.personal_meeting}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-11 slot-icon-small-voluntary" data-value='11' title="{$translate.voluntary}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-12 slot-icon-small-complimentary" data-value='12' title="{$translate.complementary}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-13 slot-icon-small-complimentary-oncall" data-value='13' title="{$translate.complementary_oncall}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-15 slot-icon-small-standby" data-value='15' title="{$translate.oncall_standby}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-16 slot-icon-small-dismissal" data-value='16' title="{$translate.work_for_dismissal}" style="display: none;"></li>
                                                                                <li class="slot-icon slot-icon-type-17 slot-icon-small-dismissal-oncall" data-value='17' title="{$translate.work_for_dismissal_oncall}" style="display: none;"></li>
                                                                            </ul>
                                                                            <div class="slot-wrpr-buttons button_new">
                                                                                <button type="button" class="btn btn-success span12 manEntryFromTimeLine" onclick="manEntryFromTimeLine(this);"><span class="icon-save"></span> {$translate.save}</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    {/if}
                                                </li>
                                            {/if}
                                        </ul>
                                    </div>
                                {/foreach}


                                {*unmanned slots*}
                                {if $unmanned_day_slots|count gt 0}
                                    {foreach from=$unmanned_day_slots key=slot_index item=slot_det name=slot_data}
                                        {assign var=emp_index value=$emp_index+1}
                                        <div class="dayview_raw unmanned_row {if $emp_index gt 8}tooltip_upper{/if}" data-emp=''>
                                            <ul class="slots_all">
                                                {if $slot_det['slot_difference'] != 0}
                                                    <li style="width:{$slot_det['slot_difference']*4.16}%" class="raw1 opasity_zero">
                                                    </li>
                                                {/if}
                                                <li data-id="{$slot_det['id']}" data-customer="{$slot_det['customer']}" class="raw1 slot_time_bar {if $slot_det.signed eq 1}signed_slot striped{/if} {if $slot_det.status eq 2}slot-theme-leave{elseif $slot_det.status eq 4}slot-theme-candg{elseif $slot_det.status eq 0 or $slot_det.status eq 3}slot-theme-incomplete{elseif $slot_det.status eq 1 and $slot_det.created_status eq 1}slot-theme-candg-accept{elseif $slot_det.type eq 10}slot-theme-pm{else}slot-theme-complete{/if}" style=" width:{$slot_det.slot_hour*4.16}%; {if $slot_det.status neq 2 and $slot_det.status neq 4 and $slot_det.status neq 0 and $slot_det.status neq 3 and !($slot_det.status eq 1 and $slot_det.created_status eq 1) and $slot_det.type neq 10}background: none; background-color: {$slot_det['employee_color']}{/if}" id="slot_thread_{$slot_det['id']}">
                                                    <div class="absolute_div {if $slot_det.status eq 2}slot-theme-leave{elseif $slot_det.status eq 4}slot-theme-candg{elseif $slot_det.status eq 0 or $slot_det.status eq 3}slot-theme-incomplete{elseif $slot_det.status eq 1 and $slot_det.created_status eq 1}slot-theme-candg-accept{elseif $slot_det.type eq 10}slot-theme-pm{else}slot-theme-complete{/if}">
                                                        <div class="slot-hover-popup span12">
                                                            {if $slot_det.show_details eq 1 and $slot_det.signed neq 1}<i class="icon-pencil edit_abs" title="{$translate.tooltip_edit_slot}"></i>{/if}
                                                            {if $slot_det.status neq 2 and $slot_det.signed eq 0}<input type="checkbox" value="{$slot_det.id}" class="check-box m_check" title="{$translate.select_slot}">{/if}
                                                            <i class="icon-remove cls_abs" title="{$translate.tooltip_close}"></i>
                                                            <div class="viewsecton {if $slot_det.signed eq 1}striped{/if}">
                                                                <input type="hidden" class="slot_details_hub" 
                                                                            data-id='{$slot_det.id}'
                                                                            data-type='{$slot_det.type}'
                                                                            data-date='{$slot_det.date}'
                                                                            data-status='{$slot_det.status}'
                                                                            data-time-from='{$slot_det.slot_from}'
                                                                            data-time-to='{$slot_det.slot_to}'
                                                                            data-total_hours='{$slot_det.slot_hour}'
                                                                            data-customer-id='{$slot_det.customer}'
                                                                            data-customer-name='{$slot_det.cust_name|escape:'html'}'
                                                                            data-employee-id='{$slot_det.employee}'
                                                                            data-employee-name='{$slot_det.emp_name|escape:'html'}'
                                                                            data-fkkn='{$slot_det.fkkn}'
                                                                            data-signed='{$slot_det.signed}'
                                                                            data-comment='{$slot_det.comment|escape:'html'}'
                                                                            />
                                                                {if $slot_det.status == 2 && $slot_det.signed == 0 && $slot_det.tl_flag ==1}
                                                                    <input type="hidden" class="slot_leave_details_hub" 
                                                                            data-leave-id='{$slot_det.leave_data.id}'
                                                                            data-leave-group-id='{$slot_det.leave_data.group_id}'
                                                                            data-leave-status='{$slot_det.leave_data.status}'
                                                                            data-leave-time-from='{$slot_det.leave_data.time_from}'
                                                                            data-leave-time-to='{$slot_det.leave_data.time_to}'
                                                                            data-leave-is-exist-relation='{$slot_det.leave_data.is_exist_relation}'
                                                                            />
                                                                {/if}
                                                                <ul class="abs_conent">
                                                                    <li><h1>{$slot_det['slot_from']}-{$slot_det['slot_to']} ({$slot_det['slot_hour']})</h1></li>
                                                                    <li><span class="icon-group"></span> {$slot_det['cust_name']}</li>
                                                                    <li><span class="icon-user"></span> {*$slot_det['emp_name']*}<i>[{$translate.no_employee}]</i></li>
                                                                    {if $slot_det['comment'] neq ''}<li class="hover-popup-comment"><span class="icon-comment"></span>{$slot_det['comment']}</li>{/if}
                                                                </ul>
                                                                <span class='pull-left'>
                                                                    <span class="slot-type pull-left">
                                                                        {if $slot_det['fkkn'] eq 1}{$translate.fk}
                                                                        {else if $slot_det['fkkn'] eq 2}{$translate.kn}
                                                                        {else if $slot_det['fkkn'] eq 3}{$translate.tu}
                                                                        {/if}
                                                                    </span>
                                                                    <span class='pull-left ml'>
                                                                        <ul class="slot-type-small-icons-group clearfix">
                                                                            <li class="slot-icon slot-icon-type-{$slot_det['type']} {$slot_det['slot_type_class']} active" title="{$slot_det['slot_type_label']}"></li>
                                                                        </ul>
                                                                    </span>
                                                                    {if $slot_det['status'] eq 2}
                                                                        <span class="label label-important ml" style="padding: 5px;">{$slot_det.leave_data.leave_name}</span>
                                                                    {/if}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    {/foreach}
                                {/if}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="span4 main-right no-print hide"  style="margin-top: 8px; padding: 10px;"  id="stickyPanelParent">
            
            {*add slot*}
            {if $privileges_gd.add_slot == 1}
                <div id="slot_creation_main_wraper_group" class="clearfix">
                    {*add new slot*}
                    <div class="add-new-slots-month hide clearfix">
                        <div id="btnGroupStickyPanel" class="span12">
                            <div class="slot-wrpr-buttons span12 no-ml mb" style="margin-top:5px;">
                                <button type="button" class="btn btn-success span6" onclick="manEntry();"><span class="icon-save"></span> {$translate.save}</button>
                                <button type="button" class="btn btn-danger span6 slot-confirm-buttons" id="slot-create-cancel"><span class="icon-chevron-left"></span> {$translate.cancel}</button>
                            </div>
                        </div>
                        <div style="margin-top: 0px; margin-bottom: 5px ! important; " class="widget">
                            <div class="widget-body" style="padding:5px;">
                                <div class="row-fluid">
                                    <div class="span8 customer-name mt no-min-height" style="margin-left:5px;"> 
                                        <span style="margin-right: 5px;" class="icon-group"></span>{$customer_details.first_name|cat: ' '|cat:$customer_details.last_name}
                                    </div>
                                    <div class="pull-right"> 
                                        <button type="button" class="btn btn-default-special span12" onclick="popupAddSlotMore();"  tabindex="-1" title="{$translate.add_more_slot}"><span class="icon-plus"></span></button>
                                    </div>
                                    <div class="span12" style="margin-left: 0px;">
                                        <div class="input-prepend date hasDatepicker datepicker" id="dtPickerNewSlotDate">
                                            <span class="add-on icon-calendar"></span>
                                            <input class="form-control span12 slot_date" id="new_slot_date" placeholder="{$translate.date}" onblur="load_avail_emps_within_period_for_new_slot(this);" type="text"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span12 create-slotes-panel no-pb" style="margin-left: 0px;"></div>            

                        <br/>
                       {*copy to weeks options*}
                        <span class="span12 no-min-height no-ml" style="margin-top:5px;"><input class="pull-left" style="margin-right:10px !important;" type="checkbox" name="check_created_slot_copy_to_weeks" id="check_created_slot_copy_to_weeks" /> <label for="check_created_slot_copy_to_weeks" class="template_label">{$translate.copy_multiple}</label></span>
                        <div class="span12 form-wrpr mt no-ml hide" id="created_slot_copy_to_weeks">
                            <h1 style="margin:10px 0 10px 0 !important;">{$translate.copy_multiple}</h1>

                            <div class="span12" style="margin-left: 0px;">
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="1" checked="checked" style="margin-right: 4px !important;"> {$translate.monday_first_charecter}
                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="2" checked="checked" style="margin-right: 4px !important;"> {$translate.tuesday_first_charecter}
                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="3" checked="checked" style="margin-right: 4px !important;"> {$translate.wednesday_first_charecter}
                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="4" checked="checked" style="margin-right: 4px !important;"> {$translate.thursday_first_charecter}
                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="5" checked="checked" style="margin-right: 4px !important;"> {$translate.friday_first_charecter}
                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="6" checked="checked" style="margin-right: 4px !important;"> {$translate.saturday_first_charecter}
                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="cscm_days" class="cscm_days" value="0" checked="checked" style="margin-right: 4px !important;"> {$translate.sunday_first_charecter}
                                </label>
                            </div>
                            <div class="clearfix"></div>
                            <label for="cscm_from_wk">{$translate.copy_from}</label>
                            <div class="span12" style="margin-left: 0px;">
                                <div class="input-prepend span11">
                                    <span class="add-on icon-pencil"></span>
                                    <select class="form-control span12 cscm_frm_wk_selct" id="cscm_from_wk" onchange="getAfterDates_for_cscm()">
                                        {section name=week start=1 loop={$no_of_weeks+1} step=1}
                                            <option value="{$smarty.section.week.index}">{$smarty.section.week.index}</option>
                                        {/section}
                                    </select>
                                </div>
                            </div>
                            <div class="span12" style="margin-left: 0px;">
                                <div class="input-prepend span11">
                                    <span class="add-on icon-pencil"></span>
                                    <select class="form-control span12" name="cscm_from_option" id="cscm_from_option" onchange="getAfterDates_for_cscm()">
                                        <option value="0">{$translate.every_week}</option>
                                        <option value="1">{$translate.every_2}</option>
                                        <option value="2">{$translate.every_3}</option>
                                        <option value="3">{$translate.every_4}</option>
                                    </select>
                                </div>
                            </div>
                            <label for="cscm_to_wk"> {$translate.copy_upto}</label>
                            <div class="span12" style="margin-left: 0px;">
                                <div class="input-prepend span11">
                                    <span class="add-on icon-pencil"></span>
                                    <select name="cscm_to_wk" id="cscm_to_wk" class="form-control span12"></select>
                                </div>
                            </div>
                        </div>
                        <span class="span12 no-ml" style="margin-top:10px;"><input class="pull-left" style="margin-right:10px !important;" type="checkbox" name="saveTimeslot" id="saveTimeslot" /> <label for="saveTimeslot" class="template_label">{$translate.save_timeslot}</label></span>

                    </div>
                </div>
            {/if}
            {if $privileges_gd.change_time == 1}
                <div id="change_time_of_slots" class="span12 hide">
                    <div class="span12 panel-heading">
                        <h4 class="panel-title clearfix">{$translate.change_time}</h4>
                    </div>
                    <div class="span12 slots-full-view-body">
                        <div class="span12" style="margin:0;">
                            <div class="input-prepend">
                                <span class="add-on  icon-time " title="{$translate.time}"></span>
                                <input class="form-control span5 time-input-text" id="change_time_from" placeholder="{$translate.time_from}" type="text"   style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;"/>
                                <span class="add-on">{$translate.to}</span>
                                <input class="form-control span5 time-input-text" id="change_time_to" placeholder="{$translate.time_to}" type="text"   style="margin-left: -1px;"/>
                            </div>
                        </div>
                    </div>
                    <div class="slot-wrpr-buttons span12">
                        <button type="button" class="btn btn-success span6" id="btnChangeUserMultiple" onclick="saveChangetimes();"><span class="icon-save"></span> {$translate.save}</button>
                        <button type="button" class="btn btn-danger span6 slot-confirm-buttons">X {$translate.cancel}</button>
                    </div>
                </div>
            {/if}

            {*slot manage options*}
            <div id="slot_details_main_wraper_group" class="hide">
                <div class="slot-wrpr span12" id="slot-wrpr-slots">

                    <input class="this_slot_id" id="sdID" type="hidden" value=""/>
                    <input id="this_slot_actual_date" type="hidden" value=""/>
                    <input id="this_slot_actual_timefrom" type="hidden" value=""/>
                    <input id="this_slot_actual_timeto" type="hidden" value=""/>
                    <input id="this_slot_actual_customer" type="hidden" value=""/>
                    <input id="this_slot_actual_employee" type="hidden" value=""/>
                    <input id="this_slot_actual_employee_name" type="hidden" value=""/>
                    <input id="this_slot_actual_fkkn" type="hidden" value=""/>
                    <input id="this_slot_actual_type" type="hidden" value=""/>
                    
                    <input id="this_slot_leave_id" type="hidden" value=""/>
                    <input id="this_slot_leave_status" type="hidden" value=""/>
                    <input id="this_slot_leave_group_id" type="hidden" value=""/>
                    <input id="this_slot_leave_time_from" type="hidden" value=""/>
                    <input id="this_slot_leave_time_to" type="hidden" value=""/>
                    {*<input id="this_tl_flag" type="hidden" value=""/>*}
                    
                    <div class="span12" style="margin:0;">
                        <div class="input-prepend date hasDatepicker span11 datepicker" id="slot_details_date" style="padding-left: 0px;">
                            <span class="add-on icon-calendar" title="{$translate.date}"></span>
                            <input class="form-control span12" id="sdDate" placeholder="{$translate.date}" type="text"/>
                        </div>
                    </div>

                    <div class="span12" style="margin:0;">
                        <div class="input-prepend">
                            <span class="add-on  icon-time " title="{$translate.time}"></span>
                            <input class="form-control span5 time-input-text" id="sdTFrom" placeholder="{$translate.from}" type="text"  oninput="load_avail_emps_within_period(this); load_pm_special_employees_confirm_type();" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;"/>
                            <span class="add-on">{$translate.to}</span>
                            <input class="form-control span5 time-input-text" id="sdTTo" placeholder="{$translate.to}" type="text"  oninput="load_avail_emps_within_period(this); load_pm_special_employees_confirm_type();" style="margin-left: -1px;"/>
                        </div>
                    </div>
                    <h2 class="span12 no-mb"><span class="icon-user" title="{$translate.customer}"></span> 
                        <span id="sdCustomer">{$customer_details.first_name|cat: ' '|cat:$customer_details.last_name}</span>
                        <input class="this_slot_customer_id" id="sdCustomerID" type="hidden" value="{$selected_customer}"/>
                    </h2>
                    <div class="span12" style="margin-left: 0px;">
                        <div class="input-prepend span11">
                            <span class="add-on icon-group" title="{$translate.employee}"></span>
                            <select class="form-control span12" id="sdEmployee">
                                <option value="">{$translate.select}</option>
                            </select>
                        </div>
                    </div>
                    <div class="span12" style="margin-left: 0px;">
                        <div class="input-prepend span11">
                            <span class="add-on icon-star" title="{$translate.fkkn}"></span>
                            <select class="form-control span12"  id="sdFKKN">
                                <option value="1">{$translate.fk}</option>
                                <option value="2">{$translate.kn}</option>
                                <option value="3">{$translate.tu}</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="span12" style="margin-left: 0px;">
                        <div class="input-prepend span11">
                            <span class="add-on icon-comment" title="{$translate.comment}"></span>
                            <textarea class="form-control span12" id="sdComment" rows="1" placeholder="{$translate.comment}"></textarea>
                        </div>
                    </div>

                    <button type="button" class="btn btn-default span1 hide" id="btn_direct_lock_slot"><span class="icon-lock"></span></button>
                    

                    <ul class="slot-icons slot-icons-day slot-icons-day-small pull-right single-slot-icon-list span12 can_change" id="sdTypes" style="width: 27px; height: 30px; overflow: hidden;">
                        <li class="slot-icon slot-icon-type-1 slot-icon-small-travel active" data-value='1' title="{$translate.travel}"></li>
                        <li class="slot-icon slot-icon-type-0 slot-icon-small-normal" data-value='0' title="{$translate.normal}"></li>
                        <li class="slot-icon slot-icon-type-2 slot-icon-small-break" data-value='2' title="{$translate.break}"></li>
                        <li class="slot-icon slot-icon-type-3 slot-icon-small-oncall" data-value='3' title="{$translate.oncall}"></li>
                        <li class="slot-icon slot-icon-type-4 slot-icon-small-over-time" data-value='4' title="{$translate.overtime}"></li>
                        <li class="slot-icon slot-icon-type-5 slot-icon-small-qualtiy-overtime" data-value='5' title="{$translate.qual_overtime}"></li>
                        <li class="slot-icon slot-icon-type-6 slot-icon-small-more-time" data-value='6' title="{$translate.more_time}"></li>
                        <li class="slot-icon slot-icon-type-14 slot-icon-small-oncall-moretime" data-value='14' title="{$translate.more_oncall}"></li>
                        <li class="slot-icon slot-icon-type-7 slot-icon-small-some-other-time" data-value='7' title="{$translate.some_other_time}"></li>
                        <li class="slot-icon slot-icon-type-8 slot-icon-small-training" data-value='8' title="{$translate.training_time}"></li>
                        <li class="slot-icon slot-icon-type-9 slot-icon-small-call-training" data-value='9' title="{$translate.call_training}"></li>
                        <li class="slot-icon slot-icon-type-10 slot-icon-small-personal-meeting" data-value='10' title="{$translate.personal_meeting}"></li>
                        <li class="slot-icon slot-icon-type-11 slot-icon-small-voluntary" data-value='11' title="{$translate.voluntary}"></li>
                        <li class="slot-icon slot-icon-type-12 slot-icon-small-complimentary" data-value='12' title="{$translate.complementary}"></li>
                        <li class="slot-icon slot-icon-type-13 slot-icon-small-complimentary-oncall" data-value='13' title="{$translate.complementary_oncall}"></li>
                        <li class="slot-icon slot-icon-type-15 slot-icon-small-standby" data-value='15' title="{$translate.oncall_standby}"></li>
                        <li class="slot-icon slot-icon-type-16 slot-icon-small-dismissal" data-value='16' title="{$translate.work_for_dismissal}"></li>
                        <li class="slot-icon slot-icon-type-17 slot-icon-small-dismissal-oncall" data-value='17' title="{$translate.work_for_dismissal_oncall}"></li>
                    </ul>
                    
                    {if $privileges_gd.candg_approve eq 1}
                        <span id="candg_action_btn_group" class="hide span12 no-ml">
                            <button class="btn btn-success" type="button" onclick="acceptCandGSlot();"><i class="icon-ok-sign icon-large"></i> {$translate.accept}</button>
                            <button class="btn btn-danger" type="button" onclick="delete_single_slot();"><i class="icon-remove-sign icon-large"></i> {$translate.reject}</button>
                        </span>
                    {/if}
                    {if $privileges_gd.add_slot eq 1}
                        <span id="clone_leave_action_btn_group" class="hide">
                            <button class="btn btn-success" type="button" onclick="clone_relation_leave_slot();"><i class="icon-copy icon-large"></i> {$translate.btn_clone_relation}</button>
                        </span>
                    {/if}
                    {if $privileges_mc.leave_approval eq 1 or $privileges_mc.leave_rejection eq 1 or $privileges_mc.leave_edit eq 1}
                        <span id="leave_quick_action_btn_group" class="hide span12 no-ml">
                            {if $privileges_mc.leave_approval == 1}<button class="btn btn-success leave_accept_btn hide span12 no-ml" type="button" onclick="update_leave_status(1);" style="margin-top: 3px;"><i class="icon-ok-sign icon-large"></i> {$translate.approve}</button>{/if}
                            {if $privileges_mc.leave_rejection == 1}<button class="btn btn-inverse leave_reject_btn hide span12 no-ml" type="button" onclick="update_leave_status(2);" style="margin-top: 3px;"><i class="icon-remove-sign icon-large"></i> {$translate.reject}</button>{/if}
                            {if $privileges_mc.leave_edit == 1}
                                <button class="btn btn-inverse leave_cancel_btn hide span12 no-ml" type="button" onclick="cancel_leave_slot();" style="margin-top: 3px;"><i class="icon-remove-sign icon-large"></i> {$translate.cancel_leave}</button>
                                <button class="btn btn-info leave_edit_btn hide span12 no-ml" type="button" onclick="edit_leave_slot();" style="margin-top: 3px;"><i class="icon-edit icon-large"></i> {$translate.back_to_work}</button>
                            {/if}
                        </span>
                    {/if}
                    {if $privileges_mc.leave_edit == 1}
                        <div class="span12 no-ml mt hide" id="leave_edit_wrpr">
                            <div class="slot-wrpr span12">
                                <h4 class="right-panel-sub-heading" style="margin-top:10px;">{$translate.applied_leaves}</h4>
                                <hr>
                                <div class="span12" style="margin:0;">
                                    <div class="span12 no-ml">
                                        <label style="font-weight: bold;">{$translate.unsick_from}:</label>
                                        <input type="text" id="unsick_time_from" name="unsick_time_from" value="" class="span12" placeholder="{$translate.from_time}">
                                    </div>
                                    <button type="button" class="btn btn-info" onclick="edit_leave_slotConfirm();"><span class="icon-save"></span> {$translate.save}</button>
                                    <button type="button" class="btn btn-danger leave_edit_btn" onclick="edit_leave_slot();">{$translate.cancel}</button>
                                </div>
                            </div>
                        </div>
                    {/if}
                    
                    <div class="span12 no-ml hide" id="PM-special-empls">
                        <div class="span12 no-ml form-section-highlight">
                            <h4 style="background-color: #DEFAEB; border: 1px solid #C1E3D0;">{$translate.pm_available_employees}</h4>
                            <div class="checkboxes-wrpr mb" id="PM-special-empls-avails">
                                {*<input type="checkbox" class="PM-special-empl-check" name="PM-special-empl-check" value="shkh001">Öranström Sven<br>
                                <input type="checkbox" class="PM-special-empl-check" name="PM-special-empl-check" value="diya001">Åa Divve<br>*}
                            </div>
                            <div class="span12 no-ml hide" id="PM-special-empls-unavails-div">
                                <h4 style="background-color: #feeded;border: 1px solid #e8c6c6;">{$translate.unavailable_employees}</h4>
                                <div class="checkboxes-wrpr" id="PM-special-empls-unavails">
                                    {*Öranström Sven<br>
                                    Åa Divve<br>*}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="slot-wrpr-buttons span12  btn-group btn-group-justified" style="margin:0; margin-top:5px;" >
                        <a href="javascript:void(0);" class="btn btn-success" id="btn_slot_details_save" onclick="modify_slot_details()"><i class="icon-save"></i> {$translate.save}</a>
                        <a href="javascript:void(0);" class="btn btn-danger slot-confirm-buttons">X {$translate.cancel}</a>
                    </div>
                </div>

                {if $privileges_gd.leave eq 1 || $privileges_gd.copy_single_slot eq 1 || $privileges_gd.copy_single_slot_option eq 1 || $privileges_gd.swap eq 1 || $privileges_gd.delete_slot eq 1 || $privileges_gd.split_slot eq 1}
                    <div class="row-fluid btn-group-slots pull-left" style=" margin: 0 0 15px 0;">
                        <div class="{*slot-wrpr-buttons span12*} span12 widget-body-section input-group btn-set" id="slot_action_buttons">
                            {if $privileges_gd.leave eq 1}<button type="button" class="btn btn-info no-ml span6" id="btn_slot_franvaro" title="{$translate.leave}"><span class="icon-user"></span> {$translate.leave}</button>{/if}
                            {if $privileges_gd.copy_single_slot eq 1}<button type="button" class="btn btn-info no-ml span6" id="btn_slot_copy" title="{$translate.boka_pass_slots_copy}" onclick="copy_single_slot();"><span class="icon-copy"></span> {$translate.copy}</button>{/if}
                            {*{if $privileges_gd.swap eq 1}<button type="button" class="btn btn-info no-ml span6" id="btn_slot_swap_copy" onclick="swap_copy_single_slot();" title="{$translate.boka_pass_swap_slots_copy}"><span class=" icon-paste"></span> {$translate.swap_copy}</button>{/if}*}
                            {*{if $privileges_gd.swap eq 1}<button type="button" class="btn btn-info no-ml span6" id="btn_slot_swap" onclick="swap_past_single_slot();" title="{$translate.boka_pass_swap_slot}"><span class=" icon-paste"></span> {$translate.swap}</button>{/if}*}
                            {if $privileges_gd.delete_slot eq 1}<button type="button" class="btn btn-info no-ml span6" id="btn_slot_delete" onclick="delete_single_slot();" title="{$translate.boka_pass_slots_delete}"><span class="icon-remove"></span> {$translate.delete}</button>{/if}
                            {if $privileges_gd.split_slot eq 1}<button type="button" class="btn btn-info no-ml span6" id="btn_slot_split" title="{$translate.boka_pass_slots_split}"><span class="icon-level-up"></span> {$translate.split}</button>{/if}
                            {if $privileges_gd.copy_single_slot_option eq 1}<button type="button" class="btn btn-info no-ml span6" id="btn_slot_copy_multiple" title="{$translate.boka_pass_slots_copy_weekly}"><span class="icon-level-down"></span> {$translate.copy_multiple}</button>{/if}
                        </div>
                    </div>
                {/if}

                {*leave section starts*}
                {if $privileges_gd.leave eq 1}
                    <div class="row-fluid form-wrpr hide" id="Franvaro-box" style="margin: 0 0 15px 0;">
                    <div class="span12 ">
                        <h1 style="margin: 10px 0px !important;">{$translate.leave}</h1>
                        <input type="hidden" name="leave_type_day" id="leave_type_day" value="2" />
                        <input type="hidden" name="leave_type_val" id="leave_type_val" value="" />
                        <div class="btn-group leave-type">
                            {foreach from=$leave_types key=leave_type_key item=leave_type}
                                <a unselectable="on" href="javascript:void(0);" id="leave_type{$leave_type_key}" class="btn btn-default" name="leave_type" value="{$leave_type_key}" onclick="setLeaveType({$leave_type_key});">{$leave_type}</a>
                            {/foreach}
                        </div>
                       
                        <div id="karense_notify" class="" style="display: none;"></div>
                         {if $privileges_mc.leave_approval == 1}
                            <div class="widget mt no-mb" id="approve_leave_on_apply">
                                <label><input type="checkbox" id="leave_approve_on_apply" name="leave_approve_on_apply" checked="checked"> {$translate.approve}</label>
                            </div>
                        {/if}
                        <div class="widget widget-tabs widget-tabs-double-2 no-mb" style="margin-top: 9px;">
                            <div class="widget-head">
                                <ul>
                                    <li id="date_time_time" class="active"><a class="glyphicons clock" href="#tabLeaveTimePeriod" data-toggle="tab"  onclick="leaveTab('time');" ><i></i><span>{$translate.time}</span></a></li>
                                    <li id="date_time_date"><a class="glyphicons calendar" href="#tabLeaveDatePeriod" data-toggle="tab" onclick="leaveTab('date');"><i></i><span>{$translate.date}</span></a></li>
                                </ul>
                            </div>
                            <div class="widget-body">
                                <div class="tab-content">
                                    {*tabLeaveTimePeriod*}
                                    <div id="tabLeaveTimePeriod" class="tab-pane widget-body-regular active clearfix" style="background:#fff;">
                                        <div class="span12" style="margin:0">
                                            <div class="form-group">
                                                <label for="leave_date_day" class="no-mb">{$translate.date}:</label>
                                                <div class="input-prepend date hasDatepicker datepicker no-pt" id="dp_leave_date_day" style="padding-left: 0px;">
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span8" name="leave_date_day" id="leave_date_day" value="" placeholder="{$translate.date}" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin: 0px;" class="span12">
                                            <label for="leave_time_from" class='no-mb'>{$translate.time_range}:</label>
                                            <div class="input-prepend">
                                                <span class="add-on  icon-time "></span>
                                                <input class="form-control span5" name="leave_time_from" id="leave_time_from" value="" placeholder="{$translate.from}" type="text" />
                                                <input class="form-control span5" name="leave_time_to" id="leave_time_to"  value="" placeholder="{$translate.to}" type="text" />
                                            </div>
                                        </div>
                                        
                                        <div id="leave_time_replacement_emps" class="span12 no-ml mt">
                                            {if $login_user_role neq 3}
                                                <label style="padding: 0px;" class="checkbox">
                                                    <input name="send_sms_time" id="send_sms_time" class="checkbox" value="1" type="checkbox" style="margin-right: 4px !important;"> {$translate.send_sms}
                                                </label>
                                                
                                                <div id="time_replacer_nosms_tbl">
                                                    <div class="span12" style="margin: 0px;">
                                                        <label style="float: left;font-weight: bold;" class="span12" for="replace_employees_list_time">{$translate.replacement_employee}:</label>
                                                        <div style="margin-left: 0px; float: left;" class="input-prepend span11">
                                                            <span class="add-on icon-group"></span>
                                                            <select name="rep_employees" id="replace_employees_list_time" class="form-control span12 replace_employees_list">
                                                                <option value="">{$translate.none}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="time_replacer_sms_tbl" class="clearfix hide" style="border: 1px solid #ccc; margin-left: 0;padding: 3px;">
                                                    <div class="span12" style="margin: 5px 0px 0px;">
                                                        <label style="float: left;font-weight: bold;" class="span12" for="rep_employees_sms">{$translate.replacement_employee}:</label>
                                                        <div style="margin-left: 0px; float: left;" class="input-prepend span11">
                                                            <span class="add-on icon-group"></span>
                                                            <select name="rep_employees_sms" id="rep_employees_sms" class="form-control span11 replace_employees_list_sms" multiple="multiple">
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="span12" style="margin: 5px 0px 0px;">
                                                        <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                            <input name="chk_confirmation" class="checkbox" onclick="manageConf('time');" value="" type="checkbox" style="margin-right: 4px !important;"> {$translate.confirmatoin}
                                                        </label>
                                                        <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                            <input name="chk_rejection" class="checkbox" value="0" type="checkbox" style="margin-right: 4px !important;"> {$translate.send_rejection}
                                                        </label>
                                                        <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                            <input name="chk_sender" class="checkbox" value="0" type="checkbox" style="margin-right: 4px !important;"> {$translate.confirmation_to_sender}
                                                        </label>
                                                    </div>
                                                </div>
                                            {/if}
                                        </div>
                                        {*if $privileges_gd.no_pay_leave eq 1}
                                            <div class="span12 no_pay_sick_check_div  no-min-height mt hide">
                                                <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                    <input type="checkbox" name="time_no_pay_sick_check" id="time_no_pay_sick_check" value="1" checked="checked" class="checkbox" style="margin-right: 4px !important;" /> <span style="padding-left: 4px; color: red; font-weight: bold" class="karense_label">{$translate.karense}</span>
                                                </label>
                                            </div>
                                        {/if*}
                                    </div>
                                    
                                    {*tabLeaveDatePeriod*}
                                    <div style="background: none repeat scroll 0% 0% rgb(255, 255, 255);" id="tabLeaveDatePeriod" class="tab-pane widget-body-regular clearfix">
                                        <div class="span12" style="margin:0">
                                            <div class="form-group">
                                                <label for="leave_date_from" class="no-mb">{$translate.date}:</label>
                                                <div class="input-prepend date datepicker no-pt" id="dp_leave_date_from" style="padding-left: 0px;">
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span8 dte_fld" name="leave_date_from" id="leave_date_from" placeholder="{$translate.date}" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span12" style="margin:0">
                                            <div class="form-group">
                                                <label for="leave_date_to" class="no-mb">{$translate.to}:</label>
                                                <div class="input-prepend date datepicker no-pt" id="dp_leave_date_to" style="padding-left: 0px;">
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span8 dte_fld" name="leave_date_to" id="leave_date_to" placeholder="{$translate.date}" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                                
                                        <div id="leave_date_replacement_emps" style="margin-top: 9px;">
                                            {if $login_user_role neq 3}
                                                <label style="padding: 0px;" class="checkbox">
                                                    <input class="checkbox" name="send_sms_date" id="send_sms_date" value="1" type="checkbox" style="margin-right: 4px !important;"> {$translate.send_sms}
                                                </label>
                                                
                                                <div id="date_replacer_nosms_tbl">
                                                    <div class="span12">
                                                        <label style="float: left;" class="span12 template_label" for="replace_employees_list_date">{$translate.replacement_employee}:</label>
                                                        <div style="margin-left: 0px; float: left;" class="input-prepend span11">
                                                            <span class="add-on icon-group"></span>
                                                            <select name="rep_date_employees" id="replace_employees_list_date" class="form-control span12 replace_employees_list_date">
                                                                <option value="">{$translate.none}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="date_replacer_sms_tbl" class="clearfix hide" style="border: 1px solid #ccc; margin-left: 0;padding: 3px;">
                                                    <div class="span12" style="margin: 5px 0px 0px;">
                                                        <label style="float: left;" class="span12 template_label" for="rep_employees_sms">{$translate.replacement_employee}:</label>
                                                        <div style="margin-left: 0px; float: left;" class="input-prepend span11">
                                                            <span class="add-on icon-group"></span>
                                                            <select name="rep_employees_sms" class="form-control span11 replace_employees_list_date_sms" multiple="multiple">
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="span12" style="margin: 5px 0px 0px;">
                                                        <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                            <input name="chk_confirmation_date" class="checkbox" onclick="manageConf('date');" value="" type="checkbox" style="margin-right: 4px !important;"> {$translate.confirmatoin}
                                                        </label>
                                                        <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                            <input name="chk_rejection_date" class="checkbox" value="0" type="checkbox" style="margin-right: 4px !important;"> {$translate.send_rejection}
                                                        </label>
                                                        <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                            <input name="chk_sender_date" class="checkbox" value="0" type="checkbox" style="margin-right: 4px !important;"> {$translate.confirmation_to_sender}
                                                        </label>
                                                    </div>
                                                </div>
                                            {/if}
                                        </div>
                                        {*if $privileges_gd.no_pay_leave eq 1}
                                            <div class="span12 no_pay_sick_check_div no-min-height mt hide">
                                                <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                    <input type="checkbox" name="date_no_pay_sick_check" id="date_no_pay_sick_check" value="1" checked="checked" class="checkbox" style="margin-right: 4px !important;" /> <span style="padding-left: 4px; color: red; font-weight: bold" class="karense_label">{$translate.karense}</span>
                                                </label>
                                            </div>
                                        {/if*}
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="span12 mt">
                            <label style="float: left;" class="span12 template_label" for="leave_comments">{$translate.comments}:</label>
                            <div class="input-prepend span12" style="margin: 0px;">
                                <span class="add-on icon-comment" title="{$translate.comment}"></span>
                                <textarea class="form-control span11"  name="leave_comments" id="leave_comments" rows="1" placeholder="{$translate.comment}"></textarea>
                            </div>
                        </div>
                        <div class="span12 no-ml mt">
                            <button type="button" class="btn btn-success span6" id="btn_save_leave" onclick="saveLeave();"><i class="icon-save"></i>  {$translate.save_leave}</button>
                            <button type="button" class="btn btn-danger span6 no-ml" id="Franvaro-box-close">x {$translate.cancel}</button>
                        </div>
                    </div>
                    </div>
                {/if}

                {*slot split starts*}
                {if $privileges_gd.split_slot eq 1}
                    <div class="span12 form-wrpr hide" id="slot-dela-pass" style="margin: 0 0 15px 0;">
                        <h1 style="margin:10px 0 10px 0 !important;">{$translate.split}</h1>
                        <label>{$translate.from_time}</label>
                        <input id="split_slot_timefrom" name="split_slot_timefrom" type="text" class="span12" placeholder="{$translate.from_time}" />
                        <label>{$translate.to_time}</label>
                        <input id="split_slot_timeto" name="split_slot_timeto" type="text" class="span12" placeholder="{$translate.to_time}" />
                        <div class="span12 no-ml">
                            <button type="button" class="btn btn-success span6" onclick="splitSlot();"><span class="icon-save"></span> {$translate.save}</button>
                            <button type="button" class="btn btn-danger span6 no-ml" id="slot-dela-pass-close">x {$translate.cancel}</button>
                        </div>
                    </div>
                {/if}

                {*copy multiple starts*}
                {if $privileges_gd.copy_single_slot_option eq 1}
                    <div class="span12 form-wrpr hide" id="kopierapass-box" style="margin: 0 0 15px 0;">
                        <h1 style="margin:10px 0 10px 0 !important;">{$translate.copy_multiple}</h1>
                        <form name="frm_copy" id="frm_copy" method="post">
                            <div class="span12" style="margin-left: 0px;">
                      
                               
                               
                               <!-- <label style="padding: 0px;" class="checkbox span6 hide" id="lbl_copy_slot_with_user">
                                    <input name="withuser" id="slot_copy_multiple_withuser" class="checkbox" value="radio" type="radio" style="margin-right: 4px !important;"> {$translate.with_user}
                                </label>
                                -->
                                
                                     <ol class="radio-group checkbox no-padding pull-left" id="lbl_copy_slot_with_user">
                                    <li>
                                    <input name="withuser" id="slot_copy_multiple_withuser" class="checkbox" value="radio" type="radio" >
                                    <label class="label-option-and-checkbox">   {$translate.with_user} </label>
                                    </li>
                                    
                                    </ol>
                                
                                
                                <!--<label style="padding: 0px;" class="checkbox span6 hide" id="lbl_copy_slot_without_user">
                                    <input name="withuser" id="slot_copy_multiple_withoutuser" class="checkbox" value="radio" type="radio" style="margin-right: 4px !important;"> {$translate.without_user}
                                </label>-->
                                
                                
                                 <ol class="radio-group checkbox no-padding pull-left" id="lbl_copy_slot_without_user" >
                                    <li>
                                    <input name="withuser" id="slot_copy_multiple_withoutuser" class="checkbox" value="radio" type="radio" >
                                    <label class="label-option-and-checkbox">  {$translate.without_user} </label>
                                    </li>
                                    
                                    </ol>
                                
                                
                            </div>
                            <br>

                            <div class="span12" style="margin-left: 0px;">
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="slot_copy_multiple_days" value="1" checked="checked" style="margin-right: 4px !important;"> {$translate.monday_first_charecter}
                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="slot_copy_multiple_days" value="2" checked="checked" style="margin-right: 4px !important;"> {$translate.tuesday_first_charecter}
                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="slot_copy_multiple_days" value="3" checked="checked" style="margin-right: 4px !important;"> {$translate.wednesday_first_charecter}
                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="slot_copy_multiple_days" value="4" checked="checked" style="margin-right: 4px !important;"> {$translate.thursday_first_charecter}
                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="slot_copy_multiple_days" value="5" checked="checked" style="margin-right: 4px !important;"> {$translate.friday_first_charecter}
                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="slot_copy_multiple_days" value="6" checked="checked" style="margin-right: 4px !important;"> {$translate.saturday_first_charecter}
                                </label>
                                <label class="checkbox checkbox-inline mr no-pl">
                                    <input type="checkbox"  name="slot_copy_multiple_days" value="0" checked="checked" style="margin-right: 4px !important;"> {$translate.sunday_first_charecter}
                                </label>
                            </div>
                            <div class="clearfix"></div>
                            <label style="margin-top:10px;" for="from_wk">{$translate.copy_from}</label>
                            <div class="span12" style="margin-left: 0px;">
                                <div class="input-prepend span11">
                                    <span class="add-on icon-pencil"></span>
                                    <select class="form-control span12 frm_wk_selct" id="slot_copy_multiple_from_wk" onchange="getAfterDates_for_slotcopy_multiple()">
                                        {section name=week start=1 loop={$no_of_weeks+1} step=1}
                                            <option value="{$smarty.section.week.index}">{$smarty.section.week.index}</option>
                                        {/section}
                                    </select>
                                </div>
                            </div>
                            <div class="span12" style="margin-left: 0px;">
                                <div class="input-prepend span11">
                                    <span class="add-on icon-pencil"></span>
                                    <select class="form-control span12" name="slot_copy_multiple_from_option" id="slot_copy_multiple_from_option" onchange="getAfterDates_for_slotcopy_multiple()">
                                        <option value="0">{$translate.every_week}</option>
                                        <option value="1">{$translate.every_2}</option>
                                        <option value="2">{$translate.every_3}</option>
                                        <option value="3">{$translate.every_4}</option>
                                    </select>
                                </div>
                            </div>
                            <label style="margin-top:10px;" for="slot_copy_multiple_to_wk"> {$translate.copy_upto}</label>
                            <div class="span12" style="margin-left: 0px;">
                                <div class="input-prepend span11">
                                    <span class="add-on icon-pencil"></span>
                                    <select name="slot_copy_multiple_to_wk" id="slot_copy_multiple_to_wk" class="form-control span12"></select>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="span12 no-ml">
                            <button type="button" class="btn btn-success span6" onclick="save_copy();"><span class="icon-save"></span> {$translate.save}</button>
                            <button type="button" class="btn btn-danger span6 no-ml" id="kopierapass-box-close">x {$translate.cancel}</button>
                        </div>
                    </div>
                {/if}
            </div>
            
            {*right_click_action_options*}
            <div id="right_click_action_options" class="hide">
                {*goto employees*}
                <div id="goto-employees-options" class="span12 hide">
                    <div class="span12 panel-heading"><h4 class="panel-title clearfix">{$translate.go_to} {$translate.employee}</h4></div>
                    <div class="span12 slots-full-view-body1" style="overflow-y: auto; padding-right: 5px !important;">
                        <div id="goto-employees-list" class="row-fluid span12" style="padding-bottom: 8px !important; padding-right: 4px; margin-left: 0;">
                            {foreach $righclick_employees_for_goto AS $empl}
                                <div style="margin-left: 0px;" class="span12">
                                    <div style="margin-top: 4px;" class="span12 child-slots">
                                        <label onclick="navigatePage('{$url_path}gdschema_day_employee.php?date={$selected_date}&employee={$empl.username}&action=1',1);">
                                            <span>{if $sort_by_name == 1}{$empl.first_name} {$empl.last_name}{elseif $sort_by_name == 2}{$empl.last_name} {$empl.first_name}{/if}</span>
                                        </label>
                                    </div>
                                </div>
                            {foreachelse}
                                <div style="margin-left: 0px;" class="span12"><div class="message">{$translate.this_customer_have_no_employees}</div></div>
                            {/foreach}
                        </div>
                    </div>
                    <div class="slot-wrpr-buttons span12" style="margin:0; margin-top:15px;" >
                        <button type="button" class="btn btn-danger span12 slot-confirm-buttons">X {$translate.cancel}</button>
                    </div>
                </div>
                        
                {*goto customers*}
                <div id="goto-customers-options" class="span12 hide">
                    <div class="span12 panel-heading"><h4 class="panel-title clearfix">{$translate.go_to} {$translate.customer}</h4></div>
                    <div class="span12 slots-full-view-body1" style="overflow-y: auto; padding-right: 5px !important;">
                        <div id="goto-customers-list" class="row-fluid span12" style="padding-bottom: 8px !important; padding-right: 4px; margin-left: 0;">
                            {foreach $search_customers AS $custl}
                                <div style="margin-left: 0px;" class="span12">
                                    <div style="margin-top: 4px;" class="span12 child-slots">
                                        <label onclick="navigatePage('{$url_path}gdschema_day_customer.php?date={$selected_date}&year_week={$selected_week}&customer={$custl.username}&action=1',1);">
                                            <span>{if $sort_by_name == 1}{$custl.first_name} {$custl.last_name}{elseif $sort_by_name == 2}{$custl.last_name} {$custl.first_name}{/if}</span>
                                        </label>
                                    </div>
                                </div>
                            {foreachelse}
                                <div style="margin-left: 0px;" class="span12"><div class="message">{$translate.no_customer_available}</div></div>
                            {/foreach}
                        </div>
                    </div>
                    <div class="slot-wrpr-buttons span12" style="margin:0; margin-top:15px;" >
                        <button type="button" class="btn btn-danger span12 slot-confirm-buttons">X {$translate.cancel}</button>
                    </div>
                </div>
                
                {*change employee/customer*}
                {if $privileges_gd.add_employee eq 1 or $privileges_gd.add_customer eq 1}
                    <div id="change-employee-customer-options" class="span12 hide">
                        <div class="span12 panel-heading"><h4 class="panel-title clearfix">{$translate.change}</h4></div>
                        <div class="span12 slots-full-view-body1" style="overflow-y: auto; padding-right: 5px !important;">
                            <input type="hidden" name="slots_to_change_users" id="slots_to_change_users" value="" />
                            <input type="hidden" name="change_usertype_to_change_users" id="change_usertype_to_change_users" value="" />
                            <div id="available_users_for_change" class="row-fluid span12" style="padding-bottom: 8px !important; padding-right: 4px; margin-left: 0;"></div>
                        </div>
                        <div class="slot-wrpr-buttons span12" style="margin:0; margin-top:15px;" >
                            <button type="button" class="btn btn-success span6" id="btnChangeUserMultiple" onclick="saveChangeUserMultiple();"><span class="icon-save"></span> {$translate.save}</button>
                            <button type="button" class="btn btn-danger span6 slot-confirm-buttons">X {$translate.cancel}</button>
                        </div>
                    </div>
                {/if}
                
                {*replace employee*}
                {if $privileges_gd.add_employee eq 1}
                    <div id="replace-employee-week-basis" class="manage-form span12 hide">
                        <div class="span12">
                            <h4 style="margin-top:20px;font-weight: bold;">{$translate.replace_user}</h4>
                            <hr>
                            <div class='row-fluid'>
                                <div class="span12" style="margin-left: 1.49254%;">
                                    <span style="font-weight: bold;">{$translate.replacing_employee}:</span> <span id="spn_replacing_employee"></span>
                                </div>
                                <div class="span12">
                                    <span style="font-weight: bold;">{$translate.customer}:</span> 
                                    <input type="checkbox" class="checkbox" name="repl_infocus" value="radio" id="repl_infocus" onchange="loadEmployeesForReplacement();" checked="checked">
                                    <span id="spn_replace_customer"></span>
                                </div>
                                <input type="hidden" name="slot_customer" class='slot_customer' value="" />
                                <input type="hidden" name="slot_employee" class='slot_employee' value="" />
                            </div>
                            <div class="form-section-highlight">
                                <div class="row-fluid">
                                    <div class="form-group">
                                        <div class="input-prepend date hasDatepicker datepicker" id="replace_emp_date_from_div">
                                            <span class="add-on icon-calendar"></span>
                                            <input type="text" placeholder="{$translate.from_date}" id="replace_emp_date_from" name="replace_emp_date_from" {*onblur="loadEmployeesForReplacement();"*} class="form-control span12">
                                        </div>
                                        <div class="input-prepend date datepicker" id="replace_emp_date_to_div">
                                            <span class="add-on icon-calendar"></span>
                                            <input type="text" placeholder="{$translate.to_date}" id="replace_emp_date_to" name="replace_emp_date_to" {*onblur="loadEmployeesForReplacement();"*} class="form-control span12">
                                        </div>
                                    </div>
                                </div>

                                <h4>{$translate.replacer_employees}</h4>
                                <div id="replacement_employee_list" style="margin-top:0;" class="checkboxes-wrpr"></div>
                            </div>
                        </div>
                        <div style=" margin: 10px 0px 0px;" class="slot-wrpr-buttons span12">
                            <button type="button" class="btn btn-success span6" id="btnReplaceEmpMultiple" onclick="saveReplaceMultipleConfirm();"><span class="icon-save"></span> {$translate.replace}</button>
                            <button type="button" class="btn btn-danger span6 slot-confirm-buttons">X {$translate.close}</button>
                        </div>
                    </div>
                {/if}
                
                {*sms section*}
                {if $login_user_role eq 1}
                    <div id="sms-for-emp-allocation" class="manage-form span12 hide">
                        <div class="span12">
                            <h4 style="margin-top:20px;font-weight: bold;">{$translate.sms}</h4>
                            <hr>
                            <div class="form-section-highlight">

                                <h4>{$translate.replacement_employee}</h4>
                                <input type="hidden" name="slot_ids" class="slot_ids" value="" />
                                <select multiple="multiple" class="form-control span11 send_employees_list_sms" id="send_employees_list_sms" name="send_employees_list_sms"></select>
                                {*<div id="replacement_employee_list" style="margin-top:0;" class="checkboxes-wrpr"></div>*}

                                <div class="row-fluid">
                                    <div style="margin: 5px 0px 0px;" class="span12">
                                        <label class="checkbox confirmation_slot" style="padding: 0px;">
                                            <input type="checkbox" style="margin-right: 4px !important;" value="" onclick="manageSmsAllotmentConf()" class="checkbox" name="chk_confirmation_allotment"> {$translate.confirmatoin}
                                        </label>
                                        <label class="checkbox confirmation_slot" style="padding: 0px;">
                                            <input type="checkbox" style="margin-right: 4px !important;" value="0" class="checkbox" name="chk_rejection_allotment"> {$translate.send_rejection}
                                        </label>
                                        <label class="checkbox confirmation_slot" style="padding: 0px;">
                                            <input type="checkbox" style="margin-right: 4px !important;" value="0" class="checkbox" name="chk_sender_allotment"> {$translate.confirmation_to_sender}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style=" margin: 10px 0px 0px;" class="slot-wrpr-buttons span12">
                            <button type="button" class="btn btn-success span6" id="btnEmpAllotSMS" onclick="sendSmsForAllotment()"><span class="icon-save"></span> {$translate.send}</button>
                            <button type="button" class="btn btn-danger span6 slot-confirm-buttons">X {$translate.cancel}</button>
                        </div>
                    </div>
                {/if}
            </div>
    </div>
</div>
{/block}


{block name='script'}
<script async src="{$url_path}js/date-picker.js"></script>
<script async src="{$url_path}js/time_formats.js?v={filemtime('js/time_formats.js')}" type="text/javascript" ></script>
<script async src="{$url_path}js/bootbox.js"></script>
<script async src="{$url_path}js/jQuery.print.js"></script>
<!-- <script async src="{$url_path}js/jquery.floatThead.min.js" type="text/javascript" ></script> -->
<script async type="text/javascript" src="{$url_path}js/jquery.stickyPanel.js?v={filemtime('js/jquery.stickyPanel.js')}"></script>
<!-- <script async src="{$url_path}js/jQuery.print.js"></script> -->
<!-- <script src="{$url_path}js/jquery.scrolltabs.js"></script> -->
<script type="text/javascript">
    //didn't remove this js block from this location
    $(function(){
        $.contextMenu( 'destroy' );
    });
</script>
<script type="text/javascript">

    $(document).ready(function() {
        $(".absolute_div .edit_abs").click(function(e) {
            close_right_panel();
            show_right_panel();
            $("#slot_details_main_wraper_group").removeClass('hide');
            $("#slot-dela-pass, #Franvaro-box, #kopierapass-box").addClass('hide');

            $('html, body').animate({
                scrollTop: $(".main-right").offset().top
            }, 2000);
            
            //---------------add data-----------------------
            var slot_data       = $(this).parents('.slot-hover-popup').find('.slot_details_hub');
            var slot_id         = slot_data.attr('data-id');
            var slot_date       = slot_data.attr('data-date');
            var slot_timefrom   = $.trim(slot_data.attr('data-time-from'));
            var slot_time_to    = $.trim(slot_data.attr('data-time-to'));
            var slot_customer_id= slot_data.attr('data-customer-id');
            var slot_employee_id= slot_data.attr('data-employee-id');
            var slot_fkkn       = slot_data.attr('data-fkkn');
            var slot_type       = slot_data.attr('data-type');
            var slot_status     = slot_data.attr('data-status');
            var slot_signed     = slot_data.attr('data-signed') == 1 ? true : false;

            $('#slot_details_main_wraper_group #sdID').val(slot_data.attr('data-id'));  //id
            //$('#slot_details_main_wraper_group #sdDate').val(slot_data.attr('data-date'));  //date
            $('#slot_details_main_wraper_group #slot_details_date').datepicker('update', slot_data.attr('data-date'));  //date
            $('#slot_details_main_wraper_group #sdTFrom').val(slot_data.attr('data-time-from'));  //from-time
            $('#slot_details_main_wraper_group #sdTTo').val(slot_data.attr('data-time-to'));  //from-time
            $('#slot_details_main_wraper_group #sdEmployeeID').val(slot_data.attr('data-employee-id'));  //employee-id
            $('#slot_details_main_wraper_group #sdEmployee').html(slot_data.attr('data-employee-name'));  //employee-name
            
            $('#slot_details_main_wraper_group #sdFKKN').val(slot_data.attr('data-fkkn'));  //fkkn
            $('#slot_details_main_wraper_group #sdComment').val(slot_data.attr('data-comment'));  //comment
            
            //
            $('#slot_details_main_wraper_group #sdTypes').find(' li.slot-icon').removeClass("active").css("display", 'none');
            $('#slot_details_main_wraper_group #sdTypes').find(' li.slot-icon-type-'+slot_data.attr('data-type')).addClass("active").css("display", 'block');

            //set actual slot values to hidden fields
            $('#slot_details_main_wraper_group #this_slot_actual_date').val(slot_date);
            $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val(slot_timefrom);
            $('#slot_details_main_wraper_group #this_slot_actual_timeto').val(slot_time_to);
            $('#slot_details_main_wraper_group #this_slot_actual_customer').val(slot_customer_id);
            $('#slot_details_main_wraper_group #this_slot_actual_employee').val(slot_employee_id);
            $('#slot_details_main_wraper_group #this_slot_actual_employee_name').val(slot_data.attr('data-employee-name'));
            $('#slot_details_main_wraper_group #this_slot_actual_fkkn').val(slot_fkkn);
            $('#slot_details_main_wraper_group #this_slot_actual_type').val(slot_type);
            
            $('.karense_label').html('{$translate.karense} - '+slot_data.attr('data-employee-name'));

            //hide pm-special employee section 
            $('#slot_details_main_wraper_group #PM-special-empls').addClass('hide');

            {if $privileges_gd.add_slot eq 1}
                //clone leave relation slot
                $('#slot_details_main_wraper_group #clone_leave_action_btn_group').addClass('hide');
            {/if}

            //leave details 
            var slot_leave_data = { };
            if(slot_status == 2){
                slot_leave_data       = $(this).parents('.slot-hover-popup').find('.slot_leave_details_hub');
                
                $('#slot_details_main_wraper_group #this_slot_leave_id').val(slot_leave_data.attr('data-leave-id'));
                $('#slot_details_main_wraper_group #this_slot_leave_group_id').val(slot_leave_data.attr('data-leave-group-id'));
                $('#slot_details_main_wraper_group #this_slot_leave_time_from').val(slot_leave_data.attr('data-leave-time-to'));
                $('#slot_details_main_wraper_group #this_slot_leave_time_to').val(slot_leave_data.attr('data-leave-time-to'));
                $('#slot_details_main_wraper_group #this_slot_leave_status').val(slot_leave_data.attr('data-leave-status'));
            }
            else {
                $('#slot_details_main_wraper_group #this_slot_leave_id, #slot_details_main_wraper_group #this_slot_leave_group_id, #slot_details_main_wraper_group #this_slot_leave_time_from, #slot_details_main_wraper_group #this_slot_leave_time_to, #slot_details_main_wraper_group #this_slot_leave_status').val('');
            }

            var slot_details_obj = { 'slot_id': slot_id,
                            'slot_date': slot_date,
                            'slot_timefrom': slot_timefrom,
                            'slot_time_to': slot_time_to,
                            'slot_customer_id': slot_customer_id,
                            'slot_employee_id': slot_employee_id};
            
            {if $privileges_gd.candg_approve eq 1}
                //hide candg action buttons
                $('#slot_details_main_wraper_group #candg_action_btn_group').addClass('hide');
            {/if}
                
            $('#slot_details_main_wraper_group #leave_quick_action_btn_group, #slot_details_main_wraper_group .leave_accept_btn, #slot_details_main_wraper_group .leave_reject_btn, #slot_details_main_wraper_group .leave_cancel_btn, #slot_details_main_wraper_group .leave_edit_btn, #slot_details_main_wraper_group #leave_edit_wrpr').addClass('hide');

            //block all features as first time
            $('#slot_details_main_wraper_group #sdDate, #slot_details_main_wraper_group #sdTFrom,\n\
                #slot_details_main_wraper_group #sdTTo, #slot_details_main_wraper_group #sdEmployee,\n\
                #slot_details_main_wraper_group #sdFKKN, #slot_details_main_wraper_group #sdComment').attr('disabled', 'disabled');

            $('#slot_action_buttons, #btn_slot_details_save').addClass('hide');//#btn_direct_lock_slot
            $('#slot_details_main_wraper_group #sdTypes').addClass('disabled_types');   //to disable open event of slot types
            $('#slot_details_main_wraper_group #sdTypes').removeClass('can_change');   //to disable open event of slot types

            //check privileges to slot_action_buttons
            $('#btn_slot_franvaro, #btn_slot_copy, #btn_slot_swap_copy, #btn_slot_swap, #btn_slot_delete, #btn_slot_split, #btn_slot_copy_multiple').addClass('hide');  //hide all action button as first

            //block edit of signed/leave/candg slots
            if(slot_signed || slot_status == 2 || slot_status == 4){
                //employee section
                $('#slot_details_main_wraper_group #sdEmployee').html('<option value="">{$translate.no_employee}</option>');  //employee
                if(slot_data.attr('data-employee-id') !== '')
                    $('#slot_details_main_wraper_group #sdEmployee').append('<option value="'+slot_data.attr('data-employee-id')+'" selected="selected">'+slot_data.attr('data-employee-name')+'</option>');
                
                {if $privileges_gd.candg_approve eq 1}
                    if(slot_status == 4 && slot_employee_id != ''){
                        $('#slot_details_main_wraper_group #candg_action_btn_group').removeClass('hide');
                        $('#slot_details_main_wraper_group #sdComment').removeAttr('disabled');
                    }
                {/if}
                {if $privileges_mc.leave_approval == 1 || $privileges_mc.leave_rejection == 1 || $privileges_mc.leave_edit == 1}
                    if(slot_status == 2){
                        $('#slot_details_main_wraper_group #leave_quick_action_btn_group').removeClass('hide');
                        if(slot_leave_data.attr('data-leave-status') == '0' || slot_leave_data.attr('data-leave-status') == 0){
                            {if $privileges_mc.leave_approval == 1}$('#slot_details_main_wraper_group .leave_accept_btn').removeClass('hide');{/if}
                            {if $privileges_mc.leave_rejection == 1}$('#slot_details_main_wraper_group .leave_reject_btn').removeClass('hide');{/if}
                        }
                        else if(slot_leave_data.attr('data-leave-status') == '1' || slot_leave_data.attr('data-leave-status') == 1){
                            {if $privileges_mc.leave_edit == 1}
                                $('#slot_details_main_wraper_group .leave_cancel_btn, #slot_details_main_wraper_group .leave_edit_btn').removeClass('hide');
                                //$('#slot_details_main_wraper_group #leave_edit_wrpr').removeClass('hide');
                            {/if}
                        }
                    }
                {/if}
                if(slot_status == 2){
                    {if $privileges_gd.add_slot eq 1}
                        if(slot_leave_data.attr('data-leave-is-exist-relation') == '0')
                            $('#slot_details_main_wraper_group #clone_leave_action_btn_group').removeClass('hide');
                    {/if}
                }
            }
            else{
                wrapLoader('#slot_details_main_wraper_inner');
                $.ajax({
                    url:"{$url_path}ajax_alloc_action_month.php",
                    type:"POST",
                    dataType: 'json',
                    data: { action: 'check_slot_credentials', 'slot_id': slot_id},
                    success:function(data){
                        //console.log(data);
                        {if $privileges_gd.leave eq 1}
                            if(slot_employee_id != '' && data.tl_flag && slot_type != 12 && slot_type != 13 && slot_type != 16 && slot_type != 17)
                                $('#btn_slot_franvaro').removeClass('hide');
                        {/if}
                        
                        {if $privileges_gd.copy_single_slot eq 1}
                            if(data.tl_flag)
                                $('#btn_slot_copy').removeClass('hide');
                        {/if}
                        
                        {if $privileges_gd.delete_slot eq 1}
                            if(data.tl_flag)
                                $('#btn_slot_delete').removeClass('hide');
                        {/if}
                        
                        {if $privileges_gd.split_slot eq 1}
                            if(data.tl_flag)
                                $('#btn_slot_split').removeClass('hide');
                        {/if}
                        
                        {if $privileges_gd.copy_single_slot_option eq 1}
                            if( (slot_employee_id != '' || slot_customer_id != '') && data.tl_flag)
                                $('#btn_slot_copy_multiple').removeClass('hide');
                        {/if}
                        
                        
                        var privileges_change_time = '{$privileges_gd.change_time}';
                        if( privileges_change_time == '1' && data.tl_flag)
                            $('#slot_details_main_wraper_group #sdDate, #slot_details_main_wraper_group #sdTFrom, #slot_details_main_wraper_group #sdTTo').removeAttr('disabled');
                        
                        var privileges_fkkn     = '{$privileges_gd.fkkn}';
                        var loggedin_userrole   = '{$login_user_role}';
                        var loggedin_user       = '{$login_user}';
                        if( privileges_fkkn == '1' && ((loggedin_userrole == '3' && slot_employee_id == loggedin_user) || (loggedin_userrole != '3')))
                            $('#slot_details_main_wraper_group #sdFKKN').removeAttr('disabled');
                        
                        var privileges_add_employee     = '{$privileges_gd.add_employee}';
                        var privileges_remove_employee  = '{$privileges_gd.remove_employee}';
                        if( (privileges_add_employee == '1' || privileges_remove_employee == '1') && ((loggedin_userrole == '3' && (slot_employee_id == loggedin_user || slot_employee_id =='')) || (loggedin_userrole != '3'))){
                            $('#slot_details_main_wraper_group #sdEmployee').removeAttr('disabled');
                            load_avail_emps_for_slot(slot_details_obj, $('#slot_details_main_wraper_group #sdTFrom'));
                        } else {
                            $('#slot_details_main_wraper_group #sdEmployee').html('<option value="">{$translate.no_employee}</option>');  //employee
                            if(slot_employee_id !== '')
                                $('#slot_details_main_wraper_group #sdEmployee').append('<option value="'+slot_employee_id+'" selected="selected">'+slot_data.attr('data-employee-name')+'</option>');
                        }

                        var privileges_slot_type = '{$privileges_gd.slot_type}';
                        if( privileges_slot_type == '1' && ((loggedin_userrole == '3' && slot_employee_id == loggedin_user) || (loggedin_userrole != '3'))){
                            $('#slot_details_main_wraper_group #sdTypes').removeClass('disabled_types');
                            $('#slot_details_main_wraper_group #sdTypes').addClass('can_change');   //to disable open event of slot types
                        }
                        
                        {if $login_user_role neq 3}
                            $('#slot_details_main_wraper_group #sdComment').removeAttr('disabled');
                            $('#slot_action_buttons, #btn_slot_details_save').removeClass('hide');  // #btn_direct_lock_slot
                        {else}
                            if(slot_employee_id == loggedin_user || slot_employee_id ==''){
                                $('#slot_details_main_wraper_group #sdComment').removeAttr('disabled');
                            }
                            
                            if(slot_employee_id == loggedin_user ||
                                (privileges_change_time == '1' && data.tl_flag) ||
                                (privileges_add_employee == '1' || privileges_remove_employee == '1') ||
                                privileges_slot_type == '1'){
                                    $('#slot_action_buttons, #btn_slot_details_save').removeClass('hide');
                            }
                            
                        {/if}
                    }
                }).always(function(data) { 
                    uwrapLoader('#slot_details_main_wraper_inner');
                    $('#slot_details_main_wraper_group #sdTFrom').focus();
                });
            }
            
            //by default leave type day set as 2 (leave as timeperiod)
            //$('#leave_type_day').val(2);
            $('#Franvaro-box #leave_type_val').val('');
            //$('.no_pay_sick_check_div').addClass('hide');

            //--------------------------------------------------------
            $(this).parents('.absolute_div').hide();
            e.stopPropagation();
        });


        /*MAIN-RIGHT COLLPASE*/
        $(".slot-confirm-buttons").click(function() {
            close_right_panel();
        });


        $(".slots_all li.slot_time_bar, .slots_all li.opasity_zero").click(function(e) {
            $('.slots_all li').not(this).find('.absolute_div, .absolute_div_for_newslot').hide();
            if(!$(this).hasClass('opasity_zero')){
                $(this).children(".absolute_div").show();
            }
        });

        $(".cls_abs").click(function(e) {
            $(this).parents('.absolute_div').hide();
            //$(".slots_all li .absolute_div").hide();
            e.stopPropagation();
        });

        $(".slots_all li.slot_time_bar:not(.opasity_zero)").dblclick(function(e) {
            $(this).find('.absolute_div .edit_abs').trigger('click');
            e.stopPropagation();
        });

        {if $privileges_gd.add_slot == 1}
            //, .slots_all li .absolute_div_for_newslot li.slot-icon
            $('.slots_all li .absolute_div_for_newslot .form-control').dblclick(function(e) {
                e.stopPropagation();
            });
            $(".slots_all li.opasity_zero").dblclick(function(e) {
                $('.slots_all li').find('.absolute_div, .absolute_div_for_newslot').hide();

                if(!$(this).hasClass('slot_time_bar')){
                    $(this).children(".absolute_div_for_newslot").show();
                }
                var this_obj = $(this);

                var slot_data       = this_obj.find('.editsection').find('input.new_slot_details_hub');
                var slot_employee_id= slot_data.attr('data-employee-id');
                var selected_date   = this_obj.find('#sdDate_newslot').val();

                //load team customers of this employee
                load_not_signed_customers_of_employee(this_obj, selected_date);

                clear_text_selection();
                this_obj.find(".slot_from").focus().select();
            });
        {/if}

        $(".cls_abs_newslot").click(function(e) {
            $(this).parents('.absolute_div_for_newslot').hide();
            e.stopPropagation();
        });

        $('.slots_all .absolute_div input.check-box.m_check').change(function(){
                if($(this).is(':checked')){
                    $(this).parents('.raw1.slot_time_bar').addClass('selected_slot');
                }else{
                    $(this).parents('.raw1.slot_time_bar').removeClass('selected_slot');
                }
        });

        $('#check_created_slot_copy_to_weeks').click(function(){
                $('#created_slot_copy_to_weeks')[$(this).is(':checked') ? 'removeClass' : 'addClass']('hide');
                if($(this).is(':checked')){
                    var new_slot_date = $.trim($('.add-new-slots-month #new_slot_date').val());
                    if(new_slot_date != ''){
                        reset_cscm_params(new_slot_date);
                    }
                }
        });
        
        $(document).off('click', ".slot-icons-day.can_change .slot-icon").on('click', ".slot-icons-day.can_change .slot-icon", function() {
            $(".slot-icons-day").css('width', 'auto');
            $(".slot-icons-day").css('height', 'auto');
            $(".slot-icons-day").css('overflow', 'block');
            $(this).parents('.single-slot-icon-list').find(' li.slot-icon').css("display", 'block');
        });
        $(document).off('dblclick', ".slot-icons-day .slot-icon").on('dblclick', ".slot-icons-day .slot-icon", function() {
            $(".slot-icons-day").css('width', '27px');
            $(".slot-icons-day").css('height', '30px');
            $(".slot-icons-day").css('overflow', 'hidden');
            $(this).parents('.single-slot-icon-list').find(' li.slot-icon:not(.active)').css("display", 'none');
            // e.stopPropagation();
        });
        $(document).off('click', ".single-slot-icon-list li.slot-icon").on('click', ".single-slot-icon-list li.slot-icon", function() {
            $(this).parents('.single-slot-icon-list').find(' li.slot-icon').removeClass("active");
            $(this).addClass("active");
        });

        //dtpicker for new slot from customer slot creation panel
        $('.add-new-slots-month #dtPickerNewSlotDate').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '{$lang}'})
        .on('changeDate', function(ev){
            $('.add-new-slots-month .slot_from:first').focus();
            if(typeof ev.date != 'undefined' && ev.date != ''){
                reset_cscm_params($.datepicker.formatDate('yy-mm-dd', ev.date));
            }
        });
        
        $(document).off('keypress', ".add-new-slots-month #new_slot_date, .add-new-slots-month .slot_from, .add-new-slots-month .slot_to")
                .on('keypress', ".add-new-slots-month #new_slot_date, .add-new-slots-month .slot_from, .add-new-slots-month .slot_to", function(e) {
            if(e.which == 13) {
                manEntry();
            }
        });

        $('#slot_details_main_wraper_group #sdDate, #slot_details_main_wraper_group #sdTFrom, #slot_details_main_wraper_group #sdTTo, \n\
            #slot_details_main_wraper_group #sdEmployee').keypress(function(e) { //, #slot_details_main_wraper_group #sdComment
                if(e.which == 13) {
                    if(!$('#slot_details_main_wraper_group .slot-wrpr-buttons #btn_slot_details_save').hasClass('hide'))
                        modify_slot_details();
                }
        });

        /*Franvaro*/
        $("#btn_slot_franvaro").click(function() {
            $("#kopierapass-box, #slot-dela-pass").addClass('hide');
            $('#karense_notify').html('');
            $('#Franvaro-box').find('.btn-group.leave-type').find('.btn').removeClass('active');
            //load leave replacement employees
            if($("#Franvaro-box").hasClass('hide')){
                //var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                var slot_timefrom   = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                var slot_timeto     = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();

                $('#Franvaro-box #leave_date_from, #Franvaro-box #leave_date_to, #Franvaro-box #leave_date_day').datepicker('update', slot_date);
                $('#Franvaro-box #dp_leave_date_from, #Franvaro-box #dp_leave_date_to, #Franvaro-box #dp_leave_date_day').datepicker('update', slot_date);

                $("#Franvaro-box #leave_time_from").val(slot_timefrom);
                $("#Franvaro-box #leave_time_to").val(slot_timeto);
                {if $login_user_role neq 3}
                    load_replacement_employees('get_for_2_modes');
                {/if}
            }
            $("#Franvaro-box").toggleClass('hide');
            if(!$("#Franvaro-box").hasClass('hide')){
                $('#slot_details_main_wraper_group').animate({
                    scrollTop: $('#slot-wrpr-slots').height()+$('.btn-group-slots').height()+40
                });
            }
        });

        $("#Franvaro-box-close").click(function() {
            $("#Franvaro-box").addClass('hide');
        });

        /*kopiera pass*/
        $("#btn_slot_copy_multiple").click(function() {
            $("#Franvaro-box, #slot-dela-pass").addClass('hide');
            
            //load slot from week- to week as default
            if($("#kopierapass-box").hasClass('hide')){
                var slot_date   = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                var cur_week    = date('W',  strtotime(slot_date));
                $("#kopierapass-box #slot_copy_multiple_from_wk").val(parseInt(cur_week));
                getAfterDates_for_slotcopy_multiple();
                
                var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();
                var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                
                if(slot_employee != ''){
                    $('#kopierapass-box #lbl_copy_slot_with_user').removeClass('hide');
                    $('#kopierapass-box #slot_copy_multiple_withuser').attr('checked', 'checked');
                }else
                    $('#kopierapass-box #lbl_copy_slot_with_user').addClass('hide');
                
                if(slot_customer != ''){
                    $('#kopierapass-box #lbl_copy_slot_without_user').removeClass('hide');
                    if(slot_employee == ''){
                        $('#kopierapass-box #slot_copy_multiple_withoutuser').attr('checked', 'checked');
                    }
                }else
                    $('#kopierapass-box #lbl_copy_slot_without_user').addClass('hide');
            }
            $("#kopierapass-box").toggleClass('hide');
            if(!$("#kopierapass-box").hasClass('hide')){
                $('#slot_details_main_wraper_group').animate({
                    scrollTop: $('#slot-wrpr-slots').height()+$('.btn-group-slots').height()+40
                });
            }
        });

        $("#kopierapass-box-close").click(function() {
            $("#kopierapass-box").addClass('hide');
        });

        $("#btn_slot_split").click(function() {
            $("#Franvaro-box, #kopierapass-box").addClass('hide');
            
            //load slot timefrom - timeto as default
            if($("#slot-dela-pass").hasClass('hide')){
                var slot_timefrom   = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                var slot_timeto     = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();
                
                $("#slot-dela-pass #split_slot_timefrom").val(slot_timefrom);
                $("#slot-dela-pass #split_slot_timeto").val(slot_timeto);
            }
            
            $("#slot-dela-pass").toggleClass('hide');
            if(!$("#slot-dela-pass").hasClass('hide')){
                $('#slot_details_main_wraper_group').animate({
                    scrollTop: $('#slot-wrpr-slots').height()+$('.btn-group-slots').height()+40
                });
            }
        });
            
        $("#slot-dela-pass-close").click(function() {
            $("#slot-dela-pass").addClass('hide');
        });

        $('#Franvaro-box #leave_date_from, #Franvaro-box #leave_date_to, #Franvaro-box #leave_date_day').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '{$lang}'})
        .on('changeDate', function(ev){
            load_replacement_employees();
        });

        $('.slots_all li.opasity_zero .editsection #slot_details_date_newslot').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '{$lang}'})
        .on('changeDate', function(ev){
            //load team customers of this employee
            var this_obj = $(this).parents('li.opasity_zero');
            var selected_date = '';

            if(typeof ev.date != 'undefined' && ev.date != ''){
                selected_date = $.datepicker.formatDate('yy-mm-dd', ev.date);
            }

            load_not_signed_customers_of_employee(this_obj, selected_date);
        });

    });

    function sort_employee_slots(from_time){
        navigatePage('{$url_path}gdschema_day_customer.php?date={$selected_date}&year_week={$selected_week}&customer={$selected_customer}&action=1&filter_time_from='+$.trim(from_time),1);
    }

    function sort_by_timeline(arg){
        if(arg =='CUST' || arg =='EMP' || arg =='TIME'){
            navigatePage('{$url_path}gdschema_day_customer.php?date={$selected_date}&year_week={$selected_week}&customer={$selected_customer}&action=1&sort_by='+arg, 1);
        }
    }

    function reload_content(data_values){
        /*var passing_data_object = { };
        if(typeof data_values !== 'undefined')
            passing_data_object = data_values;

        var scoll_position_calendar = $('.fixed-scrolling-tbl').scrollTop();
        var _fn_callbak = function() {
            $('.fixed-scrolling-tbl').animate({
                scrollTop: scoll_position_calendar
            });
        }*/

        navigatePage('{$url_path}gdschema_day_customer.php?date={$selected_date}&year_week={$selected_week}&customer={$selected_customer}&action=1{if $filter_time_from neq ''}&filter_time_from={$filter_time_from}{/if}{if $sort_by neq ''}&sort_by={$sort_by}{/if}',1);
    }

    function clear_text_selection(){
        if (window.getSelection) {
          if (window.getSelection().empty) {  // Chrome
            window.getSelection().empty();
          } else if (window.getSelection().removeAllRanges) {  // Firefox
            window.getSelection().removeAllRanges();
          }
        } else if (document.selection) {  // IE?
          document.selection.empty();
        }
        return;
    }

    function load_avail_emps_within_period_for_new_slot(this_obj){

        /*console.log(this_obj);
        console.log( $(this_obj).parents('.time_slots_theme').find('.custom_slot_employee'));
        return false;*/
        $(this_obj).parents('.time_slots_theme').find('.custom_slot_employee').html('<option value="">{$translate.select}</option>');
        if($.trim($('.add-new-slots-month .slot_date').val()) != '' && $.trim($(this_obj).parents('.time_slots_theme').find('.slot_from').val()) != '' && $.trim($(this_obj).parents('.time_slots_theme').find('.slot_to').val()) != ''){
            var slot_date = $.trim($('.add-new-slots-month .slot_date').val());
            var slot_from = time_to_sixty($.trim($(this_obj).parents('.time_slots_theme').find('.slot_from').val()));
            var slot_to = time_to_sixty($.trim($(this_obj).parents('.time_slots_theme').find('.slot_to').val()));
            if(slot_to == 0) slot_to = 24;
            var cur_time_slot_theme = $(this_obj).parents('.time_slots_theme');

            //get all other slot details
            var main_obj = { 'selected_date': slot_date,
                            'selected_customer': '{$selected_customer}',
                            'action': 'multiple_add',
                            'current_slot': { 'time_from': slot_from, 'time_to': slot_to },
                            'other_time_slots': [ ] }; 
            $( '.add-new-slots-month .create-slotes-panel .time_slots_theme' ).each(function( index ) {

                var tmp_slot_from = time_to_sixty($(this).find('.slot_from').val());
                var tmp_slot_to = time_to_sixty($(this).find('.slot_to').val());
                if(tmp_slot_to == 0) tmp_slot_to = 24;

                if(tmp_slot_from !== false && tmp_slot_to !== false && !cur_time_slot_theme.is(this)){
                    var tmp_slot_employee = $(this).find('.custom_slot_employee').val();
                    var temp_obj = { 'time_from': tmp_slot_from, 'time_to': tmp_slot_to, 'employee': tmp_slot_employee };
                    main_obj['other_time_slots'].push(temp_obj);
                }
            });
            //console.log(main_obj);

            //wrapLoader('.time_slots_theme');
            //wrapLoader($(this_obj).parents('.time_slots_theme'));
            $.ajax({
                url:"{$url_path}ajax_get_avail_employees_for_a_period.php",
                type:"POST",
                dataType: 'json',
                data: main_obj,
                success:function(data){
                    $(this_obj).parents('.time_slots_theme').find('.custom_slot_employee').html('<option value="">{$translate.select}</option>');
                    $.each(data, function(i, value) {
                        $(this_obj).parents('.time_slots_theme').find('.custom_slot_employee').append($('<option>').text(value.ordered_name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                    });

                },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            }).always(function(data) { 
                //uwrapLoader($(this_obj).parents('.time_slots_theme'));

                //keep tab order
                var this_obj_id = $(this_obj).attr('id');
                if(this_obj_id == 'new_slot_date') $(this_obj).parents('.time_slots_theme').find('.slot_from').focus();
                /*else if(this_obj_id == 'new_slot_from') $(this_obj).focus();
                else if(this_obj_id == 'new_slot_to') $(this_obj).focus();*/
            });
        }
    }

    function load_not_signed_customers_of_employee(root_obj, selected_date){

        var slot_data       = root_obj.find('.editsection').find('input.new_slot_details_hub');
        var slot_employee_id= slot_data.attr('data-employee-id');

        var temp_previous_selected_cust = root_obj.find('.editsection').find('#custom_slot_customer').val();

        //load team customers of this employee
        root_obj.find(".editsection").find('#custom_slot_customer').html('<option value="">{$translate.select}</option>');
        $.ajax({
            url:"{$url_path}ajax_alloc_action_month.php",
            type:"POST",
            dataType: "json",
            data:{ 'employee'  : slot_employee_id, 'action' : 'get_team_not_signed_customers', 'date': selected_date },
            success:function(data){
                        root_obj.find(".editsection").find('#custom_slot_customer').html('<option value="">{$translate.select}</option>');
                        var default_page_customer_exists = false;
                        var previous_selected_customer_exists = false;
                        if(data && data.customers){
                            root_obj.find(".editsection").find('#custom_slot_customer').html('<option value="">{$translate.select}</option>');
                            $.each(data.customers, function(i, value) {
                                if(value.username == '{$selected_customer}') default_page_customer_exists = true;
                                if(temp_previous_selected_cust != '' && value.username == temp_previous_selected_cust) previous_selected_employee_exists = true;
                                root_obj.find(".editsection").find('#custom_slot_customer').append(
                                    $('<option>')
                                        .text(value.last_name+' '+value.first_name)
                                        .attr('value', value.username));
                            });

                            if(temp_previous_selected_cust == '' && default_page_customer_exists){
                                root_obj.find(".editsection").find('#custom_slot_customer').val('{$selected_customer}');
                            }
                            else if(temp_previous_selected_cust != '' && previous_selected_customer_exists){
                                root_obj.find(".editsection").find('#custom_slot_customer').val(temp_previous_selected_cust);
                            }
                        }
                    },
            error: function (xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
        }).always(function(data) {
        });
    }
            

    {if $privileges_gd.add_slot == 1}

        function manEntry(){
            var proceed_flag = true;

            var slot_date = $.trim($('.add-new-slots-month .slot_date').val());
            var have_slots = false;

            $( '.add-new-slots-month .create-slotes-panel .time_slots_theme' ).each(function( index ) {
                have_slots = true;
                if($.trim($(this).find('.slot_from').val()) == '' || $.trim($(this).find('.slot_to').val()) == ''){
                    proceed_flag = false;
                }
            });
            
            var weekly_past = $('.add-new-slots-month input:checkbox#check_created_slot_copy_to_weeks:checked').val();
            var weekly_past_value = (weekly_past ? true : false);
            
            var from_week = to_week = from_option = week_days = '';
            if(weekly_past_value){
                from_week = $('.add-new-slots-month #cscm_from_wk').val();
                to_week = $('.add-new-slots-month #cscm_to_wk').val();
                from_option = $('.add-new-slots-month #cscm_from_option').val();
                
                week_days = $('.add-new-slots-month input:checkbox:checked.cscm_days').map(function () {
                        return this.value;
                    }).get().join('-');
            }

            if(slot_date == ''){
                bootbox.alert('{$translate.invalid_date}', function(result){ });
                $('.add-new-slots-month .slot_date').focus();
            }
            else if(!proceed_flag){
                bootbox.alert('{$translate.incomplete_slot_times}', function(result){ });
            }
            else if(!have_slots){
                bootbox.alert('{$translate.please_add_slots}', function(result){ });
            }
            else if (weekly_past_value == true && week_days == '') {
                alert('{$translate.select_days}');
            }
            else {
                var main_obj = { 'selected_date': slot_date,
                                'action': 'multiple_add',
                                'time_slots': [ ] }; 

                var collid_emp_obj = [ ];
                $( '.add-new-slots-month .create-slotes-panel .time_slots_theme' ).each(function( index ) {

                    var tmp_slot_from = time_to_sixty($(this).find('.slot_from').val());
                    var tmp_slot_to = time_to_sixty($(this).find('.slot_to').val());
                    if(tmp_slot_to == 0) tmp_slot_to = 24;

                    if(tmp_slot_from !== false)  $(this).find('.slot_from').val(tmp_slot_from);
                    if(tmp_slot_to !== false)    $(this).find('.slot_to').val(tmp_slot_to);

                    var tmp_slot_employee = $(this).find('.custom_slot_employee').val();

                    if(tmp_slot_from !== false && tmp_slot_to !== false){
                        tmp_slot_from = parseFloat(tmp_slot_from);
                        tmp_slot_to = parseFloat(tmp_slot_to);
                        var temp_obj = { 'time_from': tmp_slot_from, 'time_to': tmp_slot_to, 'customer': '{$selected_customer}'};
                        main_obj['time_slots'].push(temp_obj);
                        collid_emp_obj.push({ 
                                'time_from': tmp_slot_from, 
                                'time_to': tmp_slot_to, 
                                'employee': tmp_slot_employee
                            });
                    }
                });

                var flag_employee_slots_collided = false;
                //check employee slot collided or not
                var count_slots = collid_emp_obj.length;
                for(var i = 1 ; i < count_slots ; i++){

                    if (collid_emp_obj[i]['employee'] == '') continue;
                    for(var j = 0 ; j < i ; j++){

                        if (collid_emp_obj[j]['employee'] == '') continue;
                        if (collid_emp_obj[j]['employee'] != collid_emp_obj[i]['employee']) continue;

                        if((collid_emp_obj[j]['time_from'] >= collid_emp_obj[i]['time_from'] && collid_emp_obj[j]['time_from'] <  collid_emp_obj[i]['time_to']) ||
                            (collid_emp_obj[j]['time_to'] > collid_emp_obj[i]['time_from'] && collid_emp_obj[j]['time_to'] <= collid_emp_obj[i]['time_to']) ||
                            (collid_emp_obj[j]['time_from'] < collid_emp_obj[i]['time_from'] && collid_emp_obj[j]['time_to'] > collid_emp_obj[i]['time_to'])){
                                flag_employee_slots_collided = true;
                                break;
                        }
                    }
                    if(flag_employee_slots_collided) break;
                }

                if(flag_employee_slots_collided){
                    bootbox.alert('{$translate.employee_slots_collided_within_entered_slots}', function(result){ });
                } else {
                    if(weekly_past_value){
                        main_obj['from_week']   = from_week;
                        main_obj['to_week']     = to_week;
                        main_obj['from_option'] = from_option;
                        main_obj['days']        = week_days;
                    }
                    
                    wrapLoader('#slot_creation_main_wraper_group');
                    $.ajax({
                        url: "{$url_path}ajax_check_inconv_time_with_slot_time.php",
                        type: "POST",
                        dataType: 'json',
                        data: main_obj,
                        success:function(data){
                            //console.log(data);
                            if(data.transaction)
                                manEntry_proceed(data);
                            else if(data.transaction == false && data.error_reason != '')
                                alert(data.error_reason);
                            else
                                bootbox.alert('{$translate.enter_date_and_time}', function(result){ });
                        },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                    }).always(function(data) { 
                            uwrapLoader('#slot_creation_main_wraper_group');
                    });
                }
            }
        }
        
        function manEntry_proceed(data_obj){
    
            var slot_date = $.trim($('.add-new-slots-month .slot_date').val());

            var saveTimeslot = $('.add-new-slots-month input:checkbox[name=saveTimeslot]:checked').val();
            var saveTimeslot_value = 0;
            if (saveTimeslot) saveTimeslot_value = 1;

            var weekly_past = $('.add-new-slots-month input:checkbox#check_created_slot_copy_to_weeks:checked').val();
            var weekly_past_value = (weekly_past ? true : false);
            
            var from_week = to_week = from_option = '';
            if(weekly_past_value){
                from_week = $('.add-new-slots-month #cscm_from_wk').val();
                to_week = $('.add-new-slots-month #cscm_to_wk').val();
                from_option = $('.add-new-slots-month #cscm_from_option').val();
                
                var week_days = $('.add-new-slots-month input:checkbox:checked.cscm_days').map(function () {
                        return this.value;
                    }).get().join('-');
            }

            //get all other slot details
            var main_obj = { 'selected_date': slot_date,
                            'selected_customer': '{$selected_customer}',
                            'action': 'man_slot_entry',
                            'sub_action': 'multiple_add',
                            'req_from': 'gd_timeline_customer',
                            'gd_page_date': '{$selected_date}',
                            'customer': '{$selected_customer}',
                            'emp_alloc': '{$login_user}',
                            'saveTimeslot': saveTimeslot_value,
                            'stop_if_any_error': true,
                            'time_slots': [ ] };

            var url_atl = 'date='+slot_date+'&employee=&customer={$selected_customer}&emp_alloc={$login_user}&action=man_slot_entry&sub_action=multiple_add&type_check=18';
            if(weekly_past_value){
                url_atl += '&from_week=' + from_week + '&from_option=' + from_option + '&to_week=' + to_week + '&days=' + week_days;
                
                main_obj['from_week']   = from_week;
                main_obj['to_week']     = to_week;
                main_obj['from_option'] = from_option;
                main_obj['days']        = week_days;
            }

            var need_atl_checking = false;

            var normal_slot_types = ['0', '1', '2', '4', '5', '6', '7', '8', '10', '11', '12', '15', '16'];
            var oncall_slot_types = ['3', '9', '13', '14', '17'];

            var have_normal_slots = false;
            var have_oncall_slots = false;

            url_atl__ = { 'time_slots': [ ] };  
            var url_atl_slot_count = 0;
            var slot_enters_next_day = false;
            $( '.add-new-slots-month .create-slotes-panel .time_slots_theme' ).each(function( index ) {

                var tmp_slot_from = time_to_sixty($(this).find('.slot_from').val());
                var tmp_slot_to = time_to_sixty($(this).find('.slot_to').val());
                if(tmp_slot_to == 0) tmp_slot_to = 24;

                if(tmp_slot_from !== false && tmp_slot_to !== false){
                    tmp_slot_from = parseFloat(tmp_slot_from);
                    tmp_slot_to = parseFloat(tmp_slot_to);
                    if(tmp_slot_from >= tmp_slot_to) slot_enters_next_day = true;
                        
                    var tmp_slot_employee = $(this).find('.custom_slot_employee').val();
                    var tmp_comment = $.trim($(this).find('.comment_textarea').val());
                    var tmp_fkkn = $(this).find('.custom_slot_fkkn').val();
                    var tmp_slot_type = $(this).find('ul.single-slot-icon-list').find('li.active').attr('data-value');

                    if(tmp_slot_employee != '') need_atl_checking = true;
                    if($.inArray( tmp_slot_type, normal_slot_types ) > -1) //check if normal slot type
                        have_normal_slots = true;
                    if($.inArray( tmp_slot_type, oncall_slot_types ) > -1) //check if oncall slot type
                        have_oncall_slots = true;

                    var temp_obj = { 
                            'time_from': tmp_slot_from, 
                            'time_to': tmp_slot_to, 
                            'employee': tmp_slot_employee,
                            'comment': tmp_comment,
                            'fkkn': tmp_fkkn,
                            'type': tmp_slot_type
                        };
                    main_obj['time_slots'].push(temp_obj);
                    url_atl__['time_slots'].push({ 
                            'time_from': tmp_slot_from, 
                            'time_to': tmp_slot_to, 
                            'employee': tmp_slot_employee,
                            'type': tmp_slot_type
                        });
                }
            });
            url_atl += '&' + serialize_json_as_url(url_atl__['time_slots'], 'time_slots');
            //main_obj.push( { 'convert_to_oncall': 'yes'});
            //----------------------------------------------------------------

            var base_url = '{$url_path}ajax_alloc_action.php?';
            
            if(!weekly_past_value) main_obj['reload'] = 'stop';

            if(have_oncall_slots && (data_obj.time_flag == 0 || data_obj.time_flag_next == 0))
                alert('{$translate.time_outside_oncall}');

            else if(have_normal_slots && (data_obj.time_flag == 1 && data_obj.time_flag_next == 1)){
                bootbox.dialog( '{$translate.do_you_want_to_change_as_oncall_slot}', [{
                        "label" : "{$translate.no}",
                        "class" : "btn-danger",
                        "callback": function() {
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                if(weekly_past_value)
                                                    navigatePageWithMaintainScrollPosition(this_url,1, main_obj);
                                                else{
                                                    var _fn_callbak = function() {
                                                        reload_content();
                                                    }
                                                    excecute_request(this_url, main_obj, _fn_callbak);
                                                }
                                            }, base_url);
                            }else{
                                if(weekly_past_value)
                                    navigatePageWithMaintainScrollPosition(base_url,1, main_obj);
                                else{
                                    var _fn_callbak = function() {
                                        reload_content();
                                    }
                                    excecute_request(base_url, main_obj, _fn_callbak);
                                }
                            }
                        }
                    }, {
                        "label" : "{$translate.yes}",
                        "class" : "btn-success",
                        "callback": function() {
                            main_obj['convert_to_oncall'] ='yes';
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                if(weekly_past_value)
                                                    navigatePageWithMaintainScrollPosition(this_url,1, main_obj);
                                                else{
                                                    var _fn_callbak = function() {
                                                        reload_content();
                                                    }
                                                    excecute_request(this_url, main_obj, _fn_callbak);
                                                }
                                            }, base_url);
                            }else{
                                if(weekly_past_value)
                                    navigatePageWithMaintainScrollPosition(base_url,1, main_obj);
                                else{
                                    var _fn_callbak = function() {
                                        reload_content();
                                    }
                                    excecute_request(base_url, main_obj, _fn_callbak);
                                }
                            }
                        }
                }]);
            }
            else if(have_normal_slots && (data_obj.slot_split_time_flag == 1 || data_obj.slot_split_time_flag_next == 1)){
                bootbox.dialog( '{$translate.do_seperate_oncall_hours}', [{
                        "label" : "{$translate.no}",
                        "class" : "btn-danger",
                        "callback": function() {
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                    if(weekly_past_value)
                                                        navigatePageWithMaintainScrollPosition(this_url,1, main_obj);
                                                    else{
                                                        var _fn_callbak = function() {
                                                            reload_content();
                                                        }
                                                        excecute_request(this_url, main_obj, _fn_callbak);
                                                    }
                                            }, base_url);
                            }else{
                                if(weekly_past_value)
                                    navigatePageWithMaintainScrollPosition(base_url,1, main_obj);
                                else{
                                    var _fn_callbak = function() {
                                        reload_content();
                                    }
                                    excecute_request(base_url, main_obj, _fn_callbak);
                                }
                            }
                        }
                    }, {
                        "label" : "{$translate.yes}",
                        "class" : "btn-success",
                        "callback": function() {
                            main_obj['split_slots'] = 'yes';
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                if(weekly_past_value)
                                                    navigatePageWithMaintainScrollPosition(this_url,1, main_obj);
                                                else{
                                                    var _fn_callbak = function() {
                                                        reload_content();
                                                    }
                                                    excecute_request(this_url, main_obj, _fn_callbak);
                                                }
                                            }, base_url);
                            }else {
                                if(weekly_past_value)
                                    navigatePageWithMaintainScrollPosition(base_url,1, main_obj);
                                else{
                                    var _fn_callbak = function() {
                                        reload_content();
                                    }
                                    excecute_request(base_url, main_obj, _fn_callbak);
                                }
                            }
                        }
                }]);
            }
            else {
                if(need_atl_checking){
                    check_atl_warning(url_atl, function(this_url){ 
                                                if(weekly_past_value)
                                                    navigatePageWithMaintainScrollPosition(this_url,1, main_obj);
                                                else{
                                                    var _fn_callbak = function() {
                                                        reload_content();
                                                    }
                                                    excecute_request(this_url, main_obj, _fn_callbak);
                                                }
                                    }, base_url);
                } else {
                    if(weekly_past_value)
                                    navigatePageWithMaintainScrollPosition(base_url,1, main_obj);
                    else{
                        var _fn_callbak = function() {
                            reload_content();
                        }
                        excecute_request(base_url, main_obj, _fn_callbak);
                    }
                }
            }
        }
        
        function manEntryFromTimeLine(this_obj){
            var proceed_flag = true;

            var $saveFormParent = $(this_obj).parents('.slot-hover-popup');

            var slot_date = $.trim($saveFormParent.find('#sdDate_newslot').val());
            var selected_customer = $.trim($saveFormParent.find('#custom_slot_customer').val());
            var time_from = $.trim($saveFormParent.find('.slot_from').val());
            var time_to = $.trim($saveFormParent.find('.slot_to').val());
            var fkkn = $.trim($saveFormParent.find('.custom_slot_fkkn').val());

            if(slot_date == ''){
                bootbox.alert('{$translate.invalid_date}', function(result){ });
                $saveFormParent.find('#sdDate_newslot').focus();
            }
            else if(time_from == '' || time_to == ''){
                bootbox.alert('{$translate.incomplete_slot_times}', function(result){ });
            }
            else {
                var main_obj = { 'selected_date': slot_date,
                                'action': 'multiple_add',
                                'time_slots': [ ] }; 

                var tmp_slot_from = time_to_sixty(time_from);
                var tmp_slot_to = time_to_sixty(time_to);
                if(tmp_slot_to == 0) tmp_slot_to = 24;

                if(tmp_slot_from !== false)  $saveFormParent.find('.slot_from').val(tmp_slot_from);
                if(tmp_slot_to !== false)    $saveFormParent.find('.slot_to').val(tmp_slot_to);

                if(tmp_slot_from !== false && tmp_slot_to !== false){
                    tmp_slot_from = parseFloat(tmp_slot_from);
                    tmp_slot_to = parseFloat(tmp_slot_to);
                    var temp_obj = { 'time_from': tmp_slot_from, 'time_to': tmp_slot_to, 'customer': selected_customer};
                    main_obj['time_slots'].push(temp_obj);
                }

                wrapLoader('.opasity_zero .editsection');
                $.ajax({
                    url: "{$url_path}ajax_check_inconv_time_with_slot_time.php",
                    type: "POST",
                    dataType: 'json',
                    data: main_obj,
                    success:function(data){
                        //console.log(data);
                        if(data.transaction)
                            manEntryFromTimeLine_proceed(data, this_obj);
                        else if(data.transaction == false && data.error_reason != '')
                            alert(data.error_reason);
                        else
                            bootbox.alert('{$translate.enter_date_and_time}', function(result){ });
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                }).always(function(data) { 
                        uwrapLoader('.opasity_zero .editsection');
                });
            }
        }

        function manEntryFromTimeLine_proceed(data_obj, this_obj){

            var $saveFormParent = $(this_obj).parents('.slot-hover-popup');

            var slot_date = $.trim($saveFormParent.find('#sdDate_newslot').val());
            var selected_customer = $.trim($saveFormParent.find('#custom_slot_customer').val());
            var time_from = $.trim($saveFormParent.find('.slot_from').val());
            var time_to = $.trim($saveFormParent.find('.slot_to').val());
            var fkkn = $.trim($saveFormParent.find('.custom_slot_fkkn').val());

            //get all other slot details
            var main_obj = { 'selected_date': slot_date,
                            'selected_customer': selected_customer,
                            'action': 'man_slot_entry',
                            'sub_action': 'multiple_add',
                            'req_from': 'gd_timeline_customer',
                            'gd_page_date': slot_date,
                            'customer': selected_customer,
                            'emp_alloc': '{$login_user}',
                            'saveTimeslot': 0,
                            'stop_if_any_error': true,
                            'reload': 'stop',
                            'time_slots': [ ] };

            var url_atl = 'date='+slot_date+'&employee=&customer='+selected_customer+'&emp_alloc={$login_user}&action=man_slot_entry&sub_action=multiple_add&type_check=18';

            var need_atl_checking = false;

            var normal_slot_types = ['0', '1', '2', '4', '5', '6', '7', '8', '10', '11', '12', '15', '16'];
            var oncall_slot_types = ['3', '9', '13', '14', '17'];

            var have_normal_slots = false;
            var have_oncall_slots = false;

            url_atl__ = { 'time_slots': [ ] };  
            var url_atl_slot_count = 0;
            var slot_enters_next_day = false;


            var tmp_slot_from = time_to_sixty(time_from);
            var tmp_slot_to = time_to_sixty(time_to);
            if(tmp_slot_to == 0) tmp_slot_to = 24;

            if(tmp_slot_from !== false && tmp_slot_to !== false){
                tmp_slot_from = parseFloat(tmp_slot_from);
                tmp_slot_to = parseFloat(tmp_slot_to);
                if(tmp_slot_from >= tmp_slot_to) slot_enters_next_day = true;

                //var tmp_slot_employee = $(this).find('.custom_slot_employee').val();
                var tmp_slot_employee = $.trim($saveFormParent.find('input.new_slot_details_hub').attr('data-employee-id'));
                var tmp_comment = $.trim($saveFormParent.find('#sdComment').val());
                var tmp_fkkn = $.trim($saveFormParent.find('.custom_slot_fkkn').val());
                var tmp_slot_type = $saveFormParent.find('ul.single-slot-icon-list').find('li.active').attr('data-value');

                if(tmp_slot_employee != '') need_atl_checking = true;
                if($.inArray( tmp_slot_type, normal_slot_types ) > -1) //check if normal slot type
                    have_normal_slots = true;
                if($.inArray( tmp_slot_type, oncall_slot_types ) > -1) //check if oncall slot type
                    have_oncall_slots = true;

                var temp_obj = { 
                        'time_from': tmp_slot_from, 
                        'time_to': tmp_slot_to, 
                        'employee': tmp_slot_employee,
                        'comment': tmp_comment,
                        'fkkn': tmp_fkkn,
                        'type': tmp_slot_type
                    };
                main_obj['time_slots'].push(temp_obj);
                url_atl__['time_slots'].push({ 
                        'time_from': tmp_slot_from, 
                        'time_to': tmp_slot_to, 
                        'employee': tmp_slot_employee,
                        'type': tmp_slot_type
                    });
            }
            url_atl += '&' + serialize_json_as_url(url_atl__['time_slots'], 'time_slots');
            //main_obj.push( { 'convert_to_oncall': 'yes'});
            //----------------------------------------------------------------

            var base_url = '{$url_path}ajax_alloc_action.php?';

            if(have_oncall_slots && (data_obj.time_flag == 0 || data_obj.time_flag_next == 0))
                alert('{$translate.time_outside_oncall}');

            else if(have_normal_slots && (data_obj.time_flag == 1 && data_obj.time_flag_next == 1)){
                bootbox.dialog( '{$translate.do_you_want_to_change_as_oncall_slot}', [{
                        "label" : "{$translate.no}",
                        "class" : "btn-danger",
                        "callback": function() {
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                var _fn_callbak = function() {
                                                    reload_content();
                                                };
                                                excecute_request(this_url, main_obj, _fn_callbak);
                                            }, base_url);
                            }else{
                                var _fn_callbak = function() {
                                                    reload_content();
                                                };
                                                excecute_request(base_url, main_obj, _fn_callbak);
                            }
                        }
                    }, {
                        "label" : "{$translate.yes}",
                        "class" : "btn-success",
                        "callback": function() {
                            main_obj['convert_to_oncall'] ='yes';
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                var _fn_callbak = function() {
                                                    reload_content();
                                                };
                                                excecute_request(this_url, main_obj, _fn_callbak);
                                            }, base_url);
                            }else{
                                var _fn_callbak = function() {
                                                    reload_content();
                                                };
                                                excecute_request(base_url, main_obj, _fn_callbak);
                            }
                        }
                }]);
            }
            else if(have_normal_slots && (data_obj.slot_split_time_flag == 1 || data_obj.slot_split_time_flag_next == 1)){
                bootbox.dialog( '{$translate.do_seperate_oncall_hours}', [{
                        "label" : "{$translate.no}",
                        "class" : "btn-danger",
                        "callback": function() {
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                    var _fn_callbak = function() {
                                                    reload_content();
                                                };
                                                excecute_request(this_url, main_obj, _fn_callbak);
                                            }, base_url);
                            }else{
                                var _fn_callbak = function() {
                                                    reload_content();
                                                };
                                                excecute_request(base_url, main_obj, _fn_callbak);
                            }
                        }
                    }, {
                        "label" : "{$translate.yes}",
                        "class" : "btn-success",
                        "callback": function() {
                            main_obj['split_slots'] = 'yes';
                            if(need_atl_checking){
                                check_atl_warning(url_atl, function(this_url){ 
                                                var _fn_callbak = function() {
                                                    reload_content();
                                                };
                                                excecute_request(this_url, main_obj, _fn_callbak);
                                            }, base_url);
                            }else {
                                var _fn_callbak = function() {
                                                    reload_content();
                                                };
                                                excecute_request(base_url, main_obj, _fn_callbak);
                            }
                        }
                }]);
            }
            else {
                if(need_atl_checking){
                    check_atl_warning(url_atl, function(this_url){ 
                                                var _fn_callbak = function() {
                                                    reload_content();
                                                };
                                                excecute_request(this_url, main_obj, _fn_callbak);
                                    }, base_url);
                } else {
                    var _fn_callbak = function() {
                                                    reload_content();
                                                };
                                                excecute_request(base_url, main_obj, _fn_callbak);
                }
            }
        }
    {/if}

    function serialize_json_as_url(data, array_name){

        var url = '';
        if(typeof array_name !== "undefined"){      //create as array
            url += Object.keys(data).map(function(k) {
                if(typeof data[k] == 'object'){
                    return serialize_json_as_url(data[k], array_name+'['+k+']');
                } 
                else
                    return encodeURIComponent(array_name+'['+k+']') + '=' + encodeURIComponent(data[k]);
            }).join('&');
        } else {
                url += Object.keys(data).map(function(k) {

                    if(typeof data[k] == 'object'){
                        return serialize_json_as_url(data[k], array_name+'['+k+']');
                    } else {
                        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);

                    }
                }).join('&');
        }
        return url;
    }
            
    function check_atl_warning(check_url_data, _fn_success_call_back, _call_back_data, animation_element){

            {if $company_contract_checking_flag eq 1 or $company_atl_checking_flag eq 1}    {*company checking flags*}
                if(typeof animation_element !== "undefined")
                    wrapLoader(animation_element);
                else 
                    wrapLoader("#external_wrapper");

                $.ajax({
                    url: "{$url_path}ajax_check_atl_and_contract.php",
                    type: "POST",
                    data: check_url_data,
                    dataType: "json",
                    success:function(data){
                        {if $company_atl_checking_flag eq 1}
                            if(data.atl == 'success'){
                                {if $company_contract_checking_flag eq 0}  /*not checking contract*/
                                    _fn_success_call_back(_call_back_data);
                                {else}  /*checking contract*/
                                    if(data.contract == 'success'){
                                        _fn_success_call_back(_call_back_data);
                                    }else{
                                        {if $privileges_gd['contract_override'] eq 1}
                                            bootbox.dialog( data.contract_params.error_msg, [{
                                                    "label" : "{$translate.no}",
                                                    "class" : "btn-danger"
                                                }, {
                                                    "label" : "{$translate.yes}",
                                                    "class" : "btn-success",
                                                    "callback": function() {
                                                        _fn_success_call_back(_call_back_data);
                                                    }
                                            }]);
                                        {else}
                                            bootbox.alert(data.contract_params.error_msg, function(result){ });
                                        {/if}
                                    }
                                {/if}
                            }
                            else{
                                _call_back_data += '&' + serialize_json_as_url(data.atl_params, 'atl_param');
                                {if $privileges_gd.atl_override eq 1}
                                    bootbox.dialog( data.atl + ".<br/><br/>{$translate.do_you_want_to_continue}", [{
                                            "label" : "{$translate.no}",
                                            "class" : "btn-danger"
                                        }, {
                                            "label" : "{$translate.yes}",
                                            "class" : "btn-success",
                                            "callback": function() {
                                                {if $company_contract_checking_flag eq 0}  /*not checking contract*/
                                                    _fn_success_call_back(_call_back_data);
                                                {else}
                                                    if(data.contract == 'success'){
                                                         _fn_success_call_back(_call_back_data);
                                                    }else{
                                                        {if $privileges_gd['contract_override'] eq 1}
                                                            bootbox.dialog( data.contract_params.error_msg, [{
                                                                    "label" : "{$translate.no}",
                                                                    "class" : "btn-danger"
                                                                }, {
                                                                    "label" : "{$translate.yes}",
                                                                    "class" : "btn-success",
                                                                    "callback": function() {
                                                                        _fn_success_call_back(_call_back_data);
                                                                    }
                                                            }]);
                                                        {else}
                                                            bootbox.alert(data.contract_params.error_msg, function(result){ });
                                                        {/if}
                                                    }
                                                {/if}
                                            }
                                    }]);
                                {else} 
                                    bootbox.alert(data.atl, function(result){ });
                                {/if}
                            }
                        {else if $company_contract_checking_flag eq 1}
                            if(data.contract == 'success'){
                                _fn_success_call_back(_call_back_data);
                            }else{
                                {if $privileges_gd['contract_override'] eq 1}
                                    bootbox.dialog( data.contract_params.error_msg, [{
                                            "label" : "{$translate.no}",
                                            "class" : "btn-danger"
                                        }, {
                                            "label" : "{$translate.yes}",
                                            "class" : "btn-success",
                                            "callback": function() {
                                                _fn_success_call_back(_call_back_data);
                                            }
                                    }]);
                                {else}
                                    bootbox.alert(data.contract_params.error_msg, function(result){ });
                                {/if}
                            }
                        {/if}
                     },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                 })
                 .always(function(data) {
                    if(typeof animation_element !== "undefined")
                        uwrapLoader(animation_element);
                    else 
                        uwrapLoader("#external_wrapper");
                });
            {else}
                _fn_success_call_back(_call_back_data);
            {/if}
    }
             
    {*        created slot copy multiple*}
    function reset_cscm_params(selected_date){
        if(selected_date != ''){
            var total_weeks_in_a_year = total_weeks_in_date_year(selected_date);

            $('.add-new-slots-month #created_slot_copy_to_weeks #cscm_from_wk').find('option[value="53"]').remove();
            if(total_weeks_in_a_year == 53){
                $('<option value="53">53</option>').appendTo(".add-new-slots-month #created_slot_copy_to_weeks #cscm_from_wk");
            }

            var selected_date_week = $.datepicker.iso8601Week(new Date(selected_date));
            $(".add-new-slots-month #created_slot_copy_to_weeks #cscm_from_wk").val(selected_date_week);
            getAfterDates_for_cscm();
        }
    }
            
    function getAfterDates_for_cscm(){
        //var max_week_number = 52;
        var year_week   = $('.add-new-slots-month #new_slot_date').val();
        var max_week_number = total_weeks_in_date_year(year_week);
        var cur_slot_year_of_week = date('o',strtotime(year_week));
        var year = parseInt(cur_slot_year_of_week, 10);
        var to_week = parseInt($(".add-new-slots-month #created_slot_copy_to_weeks #cscm_from_wk").val()) + (parseInt($(".add-new-slots-month #created_slot_copy_to_weeks #cscm_from_option").val()));
        if (to_week > max_week_number) {
            to_week = to_week - max_week_number;
            year = year + 1;
        }
        $('.add-new-slots-month #created_slot_copy_to_weeks #cscm_to_wk').find('option').remove();
        for (var i = 0; i < 40; i++) {
            if (to_week > max_week_number) {
                to_week = 1;
                year = year + 1;
            }
            $('<option value="' + year + '-' + to_week + '">' + year + ':' + to_week + '</option>').appendTo(".add-new-slots-month #created_slot_copy_to_weeks #cscm_to_wk");
            to_week = to_week + 1;
        }
    }

    function modify_slot_details(){
        var slot_date       = $('#slot_details_main_wraper_group #sdDate').val();
        var slot_timefrom   = $('#slot_details_main_wraper_group #sdTFrom').val();
        var slot_time_to    = $('#slot_details_main_wraper_group #sdTTo').val();
        var slot_employee_id= $('#slot_details_main_wraper_group #sdEmployee').val();
        var old_employee_id   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();

        var proceed_flag = true;
        if(slot_date == ''){
            bootbox.alert('{$translate.invalid_date}', function(result){  });
            proceed_flag = false;
            return false;
        }else if(slot_timefrom == '' || slot_time_to == ''){
            bootbox.alert('{$translate.incomplete_slot_times}', function(result){  });
            proceed_flag = false;
            return false;
        } 
        // else if(old_employee_id != '' && slot_employee_id == ''){
        //     bootbox.dialog( '{$translate.do_you_want_to_reset_previous_employee}', [{
        //                                                     "label" : "{$translate.no}",
        //                                                     "class" : "btn-danger"
        //                                                 }, {
        //                                                     "label" : "{$translate.yes}",
        //                                                     "class" : "btn-success",
        //                                                     "callback": function() {
        //                                                         modify_slot_details_confirm();
        //                                                     }
        //                                             }]);
        // } 
        else {
            modify_slot_details_confirm();
        }
    }
    
    function modify_slot_details_confirm(){
        var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
        var slot_date       = $('#slot_details_main_wraper_group #sdDate').val();
        var slot_timefrom   = $('#slot_details_main_wraper_group #sdTFrom').val();
        var slot_time_to    = $('#slot_details_main_wraper_group #sdTTo').val();
        var slot_customer_id= $('#slot_details_main_wraper_group #sdCustomerID').val();
        var slot_employee_id= $('#slot_details_main_wraper_group #sdEmployee').val();
        var slot_fkkn       = $('#slot_details_main_wraper_group #sdFKKN').val();
        var slot_comment    = $('#slot_details_main_wraper_group #sdComment').val();
        var slot_type       = $('#slot_details_main_wraper_group #sdTypes').find('li.active').attr('data-value');
        
        var old_employee_id = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
        var old_time_from   = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
        var old_time_to     = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();
        
        slot_timefrom = time_to_sixty(slot_timefrom);
        slot_time_to = time_to_sixty(slot_time_to);
        if(slot_time_to == 0) slot_time_to = 24;
        
        var slot_details_obj = { 'slot_id': slot_id,
                            'slot_date': slot_date,
                            'slot_timefrom': slot_timefrom,
                            'slot_time_to': slot_time_to,
                            'slot_customer': slot_customer_id,
                            'slot_employee': slot_employee_id,
                            'slot_type': slot_type,
                            'slot_fkkn': slot_fkkn,
                            'slot_comment': slot_comment,
                            'action': 'modify_slot'
                };
                
        if(slot_type == 10){
            var permeeting_emps = $('#slot_details_main_wraper_group #PM-special-empls #PM-special-empls-avails input:checkbox:checked[name=PM-special-empl-check]').map(function () {
                    return this.value;
            }).get().join('||');
            slot_details_obj['personal_meeting_emps']= permeeting_emps;
        }
        
        if(slot_employee_id != '' && (slot_employee_id != old_employee_id || slot_timefrom != old_time_from || slot_time_to != old_time_to || (typeof permeeting_emps != "undefined" && permeeting_emps != ''))){
            var url_atl = slot_details_params =  serialize_json_as_url(slot_details_obj);
            var base_url = '{$url_path}ajax_alloc_action_month.php?';
            check_atl_warning(url_atl, function(this_url){ 
                                                //navigatePage(this_url,1, main_obj);
                                                wrapLoader('#slot_details_main_wraper_group');
                                                $.ajax({
                                                    url:this_url,
                                                    type:"POST",
                                                    data:slot_details_obj,
                                                    success:function(data){
                                                        reload_content();
                                                    }
                                                }).always(function(data) { 
                                                    uwrapLoader('#slot_details_main_wraper_group');
                                                });
                            }, base_url);
        }
        else{
            wrapLoader('#slot_details_main_wraper_group');
            $.ajax({
                url:"{$url_path}ajax_alloc_action_month.php",
                type:"POST",
                data:slot_details_obj,
                success:function(data){
                    reload_content();
                }
            }).always(function(data) { 
                uwrapLoader('#slot_details_main_wraper_group');
            });
        }
    }

    {if $privileges_gd.candg_approve eq 1}
        function acceptCandGSlot(){
            bootbox.dialog( '{$translate.confirm_approval_candg}', [{
                    "label" : "{$translate.no}",
                    "class" : "btn-danger"
                }, {
                    "label" : "{$translate.yes}",
                    "class" : "btn-success",
                    "callback": function() {
                        var slot_id = $('#slot_details_main_wraper_group #sdID').val();
                        var textarea_value = $("#slot_details_main_wraper_group #sdComment").val();
                         $.ajax({ 
                            async:true,
                            cache: true,
                            url:"{$url_path}ajax_alloc_action_slot.php",
                            data: 'id='+slot_id+'&action=slot_approve_candg_new&comment_text='+textarea_value,
                            type:"POST",
                            success:function(data){
                                if(data == 'sucess'){
                                    close_right_panel();
                                    reload_content();
                                }
                            }
                        });
                    }
            }]);
         }
    {/if}

    {if $privileges_gd.add_slot eq 1}
            function clone_relation_leave_slot(){
                bootbox.dialog( '{$translate.confirm_clone_leave_relation}', [{
                        "label" : "{$translate.no}",
                        "class" : "btn-danger"
                    }, {
                        "label" : "{$translate.yes}",
                        "class" : "btn-success",
                        "callback": function() {
                            var slot_id = $('#slot_details_main_wraper_group #sdID').val();
                            var selected_employee = $('#slot_details_main_wraper_group #sdEmployeeID').val();
                            var url = '{$url_path}ajax_alloc_action.php?employee='+selected_employee+'&date={$selected_date}&year_week={$selected_week}&req_from=common_day_view&slotid='+slot_id+'&action=clone_leaveslot';
                            navigatePage(url, 1);
                        }
                }]);
             }
    {/if}
</script>

{*      leave scripts*}
<script>
    {if $privileges_mc.leave_approval == 1 || $privileges_mc.leave_rejection == 1}
        function update_leave_status(flag){
            //flag == 1 -> accept, flag == 2 -> reject
            var delete_flag;
            if (flag == 1){
                bootbox.dialog('{$translate.do_u_want_approve_leave}', [
                {
                    "label" : "{$translate.no}",
                    "class" : "btn-danger",
                    
                },
                 {
                    "label" : "{$translate.yes}",
                    "class" : "btn-success",
                    "callback": function() {
                        update_leave_status_proceed(flag);
                    }
                 }
                 
            ]); 
            }
            else if (flag == 2){
                bootbox.dialog('{$translate.do_u_want_reset_substitute_slots}', [
                {
                    "label" : "{$translate.cancel}",
                    "class" : "btn-primary",
                },
                {
                    "label" : "{$translate.no}",
                    "class" : "btn-danger",
                    "callback": function() {
                        delete_flag = 0;
                        update_leave_status_proceed(flag,delete_flag);
                    }
                    
                 },
                 {
                    "label" : "{$translate.yes}",
                    "class" : "btn-success",
                    "callback": function() {
                        delete_flag = 1;
                        update_leave_status_proceed(flag,delete_flag);
                    }
                 }
                 
                ]);
            }
                
        }
        function update_leave_status_proceed(flag,delete_flag = undefined){
            var slot_leave_status   = $('#slot_details_main_wraper_group #this_slot_leave_status').val();
            if(slot_leave_status != '0') //check already treated leave
                return false;

            var slot_leave_id         = $('#slot_details_main_wraper_group #this_slot_leave_id').val();
            var process_details_obj = { 'id': slot_leave_id,
                                        'status': flag};

            var process_flag = (flag == 1 || flag == 2 ? true : false);

            if(flag == 2){ //reject operation

                var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                var slot_leave_time_from    = $('#slot_details_main_wraper_group #this_slot_leave_time_from').val();
                var slot_leave_time_to      = $('#slot_details_main_wraper_group #this_slot_leave_time_to').val();

                process_details_obj.employee= slot_employee;
                process_details_obj.date    = slot_date;
                process_details_obj.t_from  = slot_leave_time_from;
                process_details_obj.t_to    = slot_leave_time_to;

                process_details_obj.vikarie_delete    = delete_flag;
            }
            if(process_flag){
                wrapLoader("#main_content #external_wrapper");
                $.ajax({
                    async:false,
                    url:"{$url_path}ajax_gdschema_alloc_update_leave_status.php",
                    data:process_details_obj,
                    type:"POST",
                    success:function(data){
                                reload_content();
                            }
                }).always(function(data) { 
                    uwrapLoader("#main_content #external_wrapper");
                });
            }
        }
    {/if}
    {if $privileges_mc.leave_edit == 1}
        function cancel_leave_slot(this_obj){
            //return false;
            //{ "action": "leave_slot_remove", "leave_id": "'+value.id+'", "gid": "'+value.gid+'", "slot_id": "'+day_slot.id+'", "employee": "'+day_slot.employee+'", "date": "'+value.leave_date+'", "tfrom": "'+day_slot.time_from+'", "tto": "'+day_slot.time_to+'"}
            var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
            var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
            var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
            var slot_time_from  = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
            var slot_time_to    = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();
            
            var splitted_slot_start_time = slot_time_from.split('.');

            var today_date_time = strtotime('{$today_date} 00:00:00'+ ' -90 days');
            var slot_start_date_time = strtotime(slot_date+" "+splitted_slot_start_time[0]+":"+splitted_slot_start_time[1]+":00");
            var minute_diff = Math.round((today_date_time - slot_start_date_time) / 60);
            var is_past_slot = minute_diff > 0 ? true : false;

            if(is_past_slot){
                bootbox.alert('{$translate.date_is_passed_cant_cancel_leave}', function(result){  });
            }
            else{
                bootbox.dialog( '{$translate.confirm_cancel_leave}', [{
                        "label" : "{$translate.no}",
                        "class" : "btn-danger"
                    }, {
                        "label" : "{$translate.yes}",
                        "class" : "btn-success",
                        "callback": function() {
                            var slot_leave_id           = $('#slot_details_main_wraper_group #this_slot_leave_id').val();
                            var slot_leave_group_id     = $('#slot_details_main_wraper_group #this_slot_leave_group_id').val();
                            var slot_leave_time_from    = $('#slot_details_main_wraper_group #this_slot_leave_time_from').val();
                            var slot_leave_time_to      = $('#slot_details_main_wraper_group #this_slot_leave_time_to').val();
                            var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                            var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                            var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                            var slot_time_from  = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                            var slot_time_to    = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();

                            var process_details_obj = { 'action': 'leave_slot_remove',
                                                    'leave_id': slot_leave_id,
                                                    'gid': slot_leave_group_id,
                                                    'slot_id': slot_id,
                                                    'employee': slot_employee,
                                                    'date': slot_date,
                                                    'tfrom': slot_time_from,
                                                    'tto': slot_time_to };

                            bootbox.dialog( '{$translate.do_you_want_to_reset_substitute_slots} <br/><br/>{$translate.note_shortcode} {$translate.date_passed_substitute_slots_cant_remove|replace:"'":"\'"}<br/>{$translate.date_passed_substitute_slots_cant_remove_2|replace:"'":"\'"}<br/>{$translate.date_passed_substitute_slots_cant_remove_3|replace:"'":"\'"}', [{
                                "label" : "{$translate.cancel}",
                                "class" : "btn-primary"
                            }, {
                                "label" : "{$translate.btn_leave_substitute_reset_no}",
                                "class" : "btn-danger",
                                "callback": function() {
                                    process_details_obj.vikarie_delete = '0';
                                    cancel_leave_slot_confirm(process_details_obj)
                                }
                            }, {
                                "label" : "{$translate.btn_leave_substitute_reset_yes}",
                                "class" : "btn-success",
                                "callback": function() {
                                    process_details_obj.vikarie_delete = '1';
                                    cancel_leave_slot_confirm(process_details_obj)
                                }
                            }]);
                        }
                    }]);
            }
        }
        
        function cancel_leave_slot_confirm(process_details_obj){
            wrapLoader("#main_content #external_wrapper");
            $.ajax({
                async:false,
                url:"{$url_path}mc_leave_popup.php",
                data:process_details_obj,
                dataType: 'json',
                type:"POST",
                success:function(data_process){
                            if(data_process.process_result){    //excute if successfully done transactions
                                reload_content();
                            } else if(typeof data_process.message !== "undefined" && data_process.message != '' && data_process.message != null) {
                                $('#left_message_wraper').html(data_process.message).removeClass('hide');
                                $('.main-left').animate({
                                    scrollTop: 0
                                });
                            } else {
                                reload_content();
                            }
                        }
            }).always(function(data) { 
                uwrapLoader("#main_content #external_wrapper");
            });
        }
        
        function edit_leave_slot(){
            $("#slot_details_main_wraper_group #leave_edit_wrpr").toggleClass('hide');
            var slot_leave_time_to      = $('#slot_details_main_wraper_group #this_slot_leave_time_to').val();
            $("#slot_details_main_wraper_group #unsick_time_from").val(slot_leave_time_to);
        }
        
        function edit_leave_slotConfirm(){
            var toval = parseFloat($('#leave_edit_wrpr #unsick_time_from').val());
            if(toval == 0 || toval == 24 ){
                alert('Enter Time except 0 & 24');
            }else if($('#leave_edit_wrpr #unsick_time_from').val() != ''){
                bootbox.dialog( '{$translate.confirm_back_to_work}', [{
                        "label" : "{$translate.no}",
                        "class" : "btn-danger"
                    }, {
                        "label" : "{$translate.yes}",
                        "class" : "btn-success",
                        "callback": function() {
                            var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                            var leave_id        = $('#slot_details_main_wraper_group #this_slot_leave_id').val();
                            var leave_employee  = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                            var leave_date      = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                            var leave_time_from = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                            var leave_time_to   = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();

                            var process_details_obj = { 'slotid': slot_id,
                                            'id': leave_id,
                                            'employee': leave_employee,
                                            'date': leave_date,
                                            't_from': leave_time_from,
                                            't_to': leave_time_to,
                                            'status': '-1',
                                            'edited_from': $('#leave_edit_wrpr #unsick_time_from').val()};
                            //console.log(process_details_obj);
                            wrapLoader("#main_content #external_wrapper");
                            $.ajax({
                                url:"{$url_path}ajax_gdschema_alloc_update_leave_status.php",
                                type:"POST",
                                //dataType: "json",
                                data:process_details_obj,
                                success:function(data){
                                        reload_content();
                                },
                                error: function (xhr, ajaxOptions, thrownError){
                                    alert(thrownError);
                                }
                            }).always(function(data) {
                                uwrapLoader("#main_content #external_wrapper");
                            });
                        }
                }]);
            }else{
                alert('{$translate.please_enter_time}');
                $('#leave_edit_wrpr #unsick_time_from').focus();
            }
        }
    {/if}
    
    function setLeaveType(val) {
        $('#leave_type_val').val(val);
        check_is_karense_day();
        /*if(val == 1)
            $('.no_pay_sick_check_div').removeClass('hide');
        else
            $('.no_pay_sick_check_div').addClass('hide');*/
    }
    
    function check_is_karense_day(){
        var leave_type          = $('#Franvaro-box #leave_type_val').val();
        var no_pay_check_value  = 0;
        if(leave_type == 1){
            var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
            var employee        = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
            var leave_type_day  = $('#Franvaro-box #leave_type_day').val();
            var leave_date      = '';
            var url_data_obj = { 'slot_id': slot_id, 'employee': employee, 'leave_day' : leave_type_day };

            {*leave on between date*}
            if (leave_type_day == '1') {
                leave_date = $('#leave_date_from').val();

                url_data_obj['date'] = leave_date;
                url_data_obj['leave_taken_beween'] = 'dates';

                var no_pay_check = $('#Franvaro-box input:checkbox[name=date_no_pay_sick_check]:checked').val();
                if(no_pay_check) no_pay_check_value = 1;

            }
            else if (leave_type_day == '2') { {*leave on time*}
                leave_date          = $('#Franvaro-box #leave_date_day').val();
                var leave_time_from = $('#Franvaro-box #leave_time_from').val();
                var leave_time_to   = $('#Franvaro-box #leave_time_to').val();

                url_data_obj['date'] = leave_date;
                url_data_obj['leave_taken_beween'] = 'time';
                url_data_obj['leave_time_from'] = leave_time_from;
                url_data_obj['leave_time_to'] = leave_time_to;

                var no_pay_check = $('#Franvaro-box input:checkbox[name=time_no_pay_sick_check]:checked').val();
                if(no_pay_check) no_pay_check_value = 1;
            }
            url_data_obj['slot_type'] = $("#sdTypes li").filter('.active').attr('data-value');
            url_data_obj['time_from'] = $("#sdTFrom").val();
            $.ajax({
                url: "{$url_path}ajax_check_karense_exist.php",
                type: "POST",
                dataType: 'json',
                data: $.param(url_data_obj),
                success:function(data){
                   //console.log(data);
                    $('#karense_notify').html('');
                    if(data.transaction == true){
                        /*if(data.karense == true){
                            if(no_pay_check_value == 1){
                                $('#karense_notify').hide().html('<div class="message">{$translate.karense_included}</div>').fadeIn('slow');
                            }
                            else{
                                $('#karense_notify').hide().html('<div class="message">{$translate.karense_not_included}</div>').fadeIn('slow');
                            }
                            $('.no_pay_sick_check_div').show();
                        } else{
                            $('#karense_notify').hide().html('<div class="message">{$translate.karense_not_possible}'+data.karense_date+'</div>').fadeIn('slow');
                            $('.no_pay_sick_check_div').hide();
                            
                        }*/
                        if(typeof data.karense != "undefined" && data.karense !== false && typeof data.karense.karens != "undefined" && data.karense.karens > 0){
                            $('#karense_notify').hide().html('<div class="message">{$translate.total_karense_deduction}: '+data.karense.deduction+' {$translate.hour_short}<br/>{$translate.deduction_sick_day}: '+data.karense.karens+' {$translate.hour_short}('+data.karense.remaining+' {$translate.hour_short})</div>').fadeIn('slow');
                        }
                        else{
                            $('#karense_notify').hide().html('<div class="message">{$translate.no_karense_deduction}</div>').fadeIn('slow');
                        }
                    } else{
                        $('#karense_notify').html('');
                    }
                },
                error: function (xhr, ajaxOptions, thrownError){
                    //alert(thrownError);
                }
            });
        } else
            $('#karense_notify').html('');

    }
    
    function leaveTab(tab){
            if (tab == 'time') {
                $('#leave_type_day').val(2);
                check_is_karense_day();
            } else {
                $('#leave_type_day').val(1);
                check_is_karense_day();
            }
    }
    
    function manageConf(type){
        if(type == 'time'){
            if($('#Franvaro-box input:checkbox[name=chk_confirmation]:checked').prop('checked')){
                $('#Franvaro-box input:checkbox[name=chk_rejection]').attr('disabled', 'disabled');
                $('#Franvaro-box input:checkbox[name=chk_rejection]').prop('checked', false);
                $('#Franvaro-box input:checkbox[name=chk_sender]').prop('checked', true);
            }else
                $('#Franvaro-box input:checkbox[name=chk_rejection]').attr('disabled', false);
        }
        else if(type == 'date'){
            if($('#Franvaro-box input:checkbox[name=chk_confirmation_date]:checked').prop('checked')){
                $('#Franvaro-box input:checkbox[name=chk_rejection_date]').attr('disabled', 'disabled');
                $('#Franvaro-box input:checkbox[name=chk_rejection_date]').prop('checked', false);
                $('#Franvaro-box input:checkbox[name=chk_sender_date]').prop('checked', true);
            }else
                $('#Franvaro-box input:checkbox[name=chk_rejection_date]').attr('disabled', false);
        }
    }
    
    function NewDate(str){
        str=str.split('-');
        var date=new Date();
        date.setUTCFullYear(str[0], str[1]-1, str[2]);
        date.setUTCHours(0, 0, 0, 0);
        return date;
    }
    
    {if $login_user_role neq 3}
        function load_replacement_employees(action){
            var leave_type_day  = $.trim($('#leave_type_day').val());
            var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
            
            if(typeof action !== "undefined" && action == 'get_for_2_modes'){
                wrapLoader("#leave_date_replacement_emps");
                $.ajax({
                    url:"{$url_path}ajax_available_users_for_leave_replacement.php",
                    type:"POST",
                    dataType: "json",
                    data:'id='+slot_id+'&leave_format=&action=get_avail_emps_for_2_methods',
                    success:function(data){
                                    
                                //set for date period users
                                $('#replace_employees_list_date').html('<option value="">{$translate.none}</option>');
                                $('.replace_employees_list_date_sms').html('');
                                $.each(data.date_users, function(i, value) {
                                    $('#replace_employees_list_date').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                    $('.replace_employees_list_date_sms').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                });
                                
                                //set for timeperiod users
                                $('#replace_employees_list_time').html('<option value="">{$translate.none}</option>');
                                $('.replace_employees_list_sms').html('');
                                $.each(data.time_users, function(i, value) {
                                    $('#replace_employees_list_time').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                    $('.replace_employees_list_sms').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                });
                            },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                }).always(function(data) {
                    uwrapLoader("#leave_date_replacement_emps");
                });
            }
            else if(leave_type_day == 2){
                var leave_date_day  = $.trim($('#leave_date_day').val());
                var leave_time_from = time_to_sixty($.trim($('#leave_time_from').val()));
                var leave_time_to   = time_to_sixty($.trim($('#leave_time_to').val()));
                if(leave_time_to == 0) leave_time_to = 24;
                if(slot_id != '' && leave_time_from != '' && leave_time_to != '' && leave_date_day != ''){
                    wrapLoader("#leave_time_replacement_emps");
                    $.ajax({
                        url:"{$url_path}ajax_available_users_for_leave_replacement.php",
                        type:"POST",
                        dataType: "json",
                        data:'date='+leave_date_day+'&time_from='+leave_time_from+'&time_to='+leave_time_to+'&id='+slot_id+'&leave_format='+leave_type_day,
                        success:function(data){
                                    $('#replace_employees_list_time').html('<option value="">{$translate.none}</option>');
                                    $('.replace_employees_list_sms').html('');
                                    $.each(data, function(i, value) {
                                        //rep_list_options += '<option value="'+value.username+'">'+value.name+'</option>';
                                        $('#replace_employees_list_time').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                        $('.replace_employees_list_sms').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                    });
                                },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                    }).always(function(data) {
                        uwrapLoader("#leave_time_replacement_emps");
                    });
                }
            } 
            else if(leave_type_day == 1){
                var leave_date_from = $.trim($('#leave_date_from').val());
                var leave_date_to   = $.trim($('#leave_date_to').val());
                var date1 = NewDate(leave_date_from)
                var date2 = NewDate(leave_date_to);
                if (date1 > date2) 
                    alert('{$translate.check_the_from_and_to_date}');
                else if(slot_id != '' && leave_date_from != '' && leave_date_to != ''){
                    wrapLoader("#leave_date_replacement_emps");
                    $.ajax({
                        url:"{$url_path}ajax_available_users_for_leave_replacement.php",
                        type:"POST",
                        dataType: "json",
                        data:'date_from='+leave_date_from+'&date_to='+leave_date_to+'&id='+slot_id+'&leave_format='+leave_type_day,
                        success:function(data){
                                    $('#replace_employees_list_date').html('<option value="">{$translate.none}</option>');
                                    $('.replace_employees_list_date_sms').html('');
                                    $.each(data, function(i, value) {
                                        $('#replace_employees_list_date').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                        $('.replace_employees_list_date_sms').append($('<option>').text(value.name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')).attr('value', value.username));
                                    });
                                },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(thrownError);
                        }
                    }).always(function(data) {
                        uwrapLoader("#leave_date_replacement_emps");
                    });
                }
            }
        }
    {/if}
    
    {if $privileges_gd.leave eq 1}
        function saveLeave(){
            var slot_id                = $('#slot_details_main_wraper_group #sdID').val();
            var slot_type              = $('#slot_details_main_wraper_group #this_slot_actual_type').val();
            var employee               = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
            var leave_approve_on_apply = $('#leave_approve_on_apply').is(":checked") === true ? 1 : 0 ; 
            
            if(slot_type != 12 && slot_type != 13 && slot_type != 16 && slot_type != 17){
                var leave_type = $('#leave_type_val').val();
                if (leave_type != '') {
                    var leave_date_from = $('#Franvaro-box #leave_date_from').val();
                    var leave_date_to   = $('#Franvaro-box #leave_date_to').val();
                    var leave_type_day  = $('#Franvaro-box #leave_type_day').val();
                    var leave_comments  = $('#Franvaro-box #leave_comments').val();
                    var no_pay_check_value = 0;
                    var sms_emps = [ ];
                    var need_sms = false;

                    var opt_sms_conformation = 0;
                    var opt_sms_sender = 0;
                    var opt_sms_rejection = 0;

                    {*leave on between date*}
                    if (leave_type_day == '1') {
                        {if $login_user_role neq 3}
                            var rep_emp = $('#Franvaro-box .replace_employees_list_date[name=rep_date_employees]').val();
                            if(typeof rep_emp == 'undefined') rep_emp = '';

                            need_sms = $('#Franvaro-box #send_sms_date').prop('checked');
                            if(need_sms){
                                sms_emps = $('#Franvaro-box .replace_employees_list_date_sms').val();

                                if($('#Franvaro-box input:checkbox[name=chk_confirmation_date]:checked').prop('checked')){
                                    opt_sms_conformation = 1;
                                    if($('#Franvaro-box input:checkbox[name=chk_sender_date]:checked').prop('checked'))
                                        opt_sms_sender = 1;
                                }    
                                else {
                                    if($('#Franvaro-box input:checkbox[name=chk_sender_date]:checked').prop('checked'))
                                        opt_sms_sender = 1;
                                    if($('#Franvaro-box input:checkbox[name=chk_rejection_date]:checked').prop('checked'))
                                        opt_sms_rejection = 1;    
                                }
                            }
                        {else}
                            var rep_emp = '';
                        {/if}

                        if (leave_date_from != '' && leave_date_to != '') {
                            var date1 = NewDate(leave_date_from);
                            var date2 = NewDate(leave_date_to);
                            if (date1 <= date2) {

                                {if $privileges_gd.no_pay_leave eq 1}
                                    var no_pay_check = $('#Franvaro-box input:checkbox[name=date_no_pay_sick_check]:checked').val();
                                    if(no_pay_check) no_pay_check_value = 1;
                                {else}
                                    no_pay_check_value = 1;
                                {/if}

                                var url_data_obj = { 'slot_id': slot_id, 'employee': employee, 'date_from': leave_date_from, 'date_to': leave_date_to, 'leave_type': leave_type, 'leave_day' : leave_type_day, 'leave_replacer' : rep_emp, 'comments' : leave_comments, 'no_pay_check': no_pay_check_value, 
                                        'need_replacer_sms': need_sms, 'sms_replacer_emps': sms_emps, 'opt_sms_conformation': opt_sms_conformation, 'opt_sms_sender': opt_sms_sender, 'opt_sms_rejection': opt_sms_rejection,'leave_approve_on_apply' : leave_approve_on_apply };
                            
                                wrapLoader('#slot_details_main_wraper_inner');
                                $.ajax({
                                    url: '{$url_path}save_leave.php',
                                    type:"POST",
                                    data: $.param(url_data_obj),
                                    success:function(data){
                                        //console.log(data);
                                        close_right_panel();
                                        reload_content();
                                    }
                                }).always(function(data) { 
                                    uwrapLoader('#slot_details_main_wraper_inner');
                                });
                            } else
                                alert('{$translate.check_the_from_and_to_date}');
                        }else
                            alert('{$translate.check_the_from_and_to_date}');
                    } else if (leave_type_day == '2') { {*leave on time*}
                        var leave_date_day  = $('#Franvaro-box #leave_date_day').val();
                        var leave_time_from = $('#Franvaro-box #leave_time_from').val();
                        var leave_time_to   = $('#Franvaro-box #leave_time_to').val();

                        {if $privileges_gd.no_pay_leave eq 1}
                            var no_pay_check = $('#Franvaro-box input:checkbox[name=time_no_pay_sick_check]:checked').val();
                            if(no_pay_check) no_pay_check_value = 1;
                        {else}
                            no_pay_check_value = 1;
                        {/if}

                        {if $login_user_role neq 3}
                            var rep_emp = $('#Franvaro-box .replace_employees_list[name=rep_employees]').val();
                            if(typeof rep_emp == 'undefined') rep_emp = '';

                            need_sms = $('#Franvaro-box #send_sms_time').prop('checked');
                            if(need_sms){
                                sms_emps = $('#Franvaro-box .replace_employees_list_sms').val();

                                if($('#Franvaro-box input:checkbox[name=chk_confirmation]:checked').prop('checked')){
                                    opt_sms_conformation = 1;
                                    if($('#Franvaro-box input:checkbox[name=chk_sender]:checked').prop('checked'))
                                        opt_sms_sender = 1;
                                }    
                                else {
                                    if($('#Franvaro-box input:checkbox[name=chk_sender]:checked').prop('checked'))
                                        opt_sms_sender = 1;
                                    if($('#Franvaro-box input:checkbox[name=chk_rejection]:checked').prop('checked'))
                                        opt_sms_rejection = 1;    
                                }
                            }
                        {else}
                            var rep_emp = '';
                        {/if}
                        var rep_emp = $('#Franvaro-box .replace_employees_list[name=rep_employees]').val();
                        if(typeof rep_emp == 'undefined') rep_emp = '';
                        if (leave_date_day != '') {
                            var url_data_obj = { 'slot_id': slot_id, 'employee': employee, 'leave_date': leave_date_day, 'leave_range_from': leave_time_from, 'leave_range_to': leave_time_to, 'leave_type' : leave_type, 'leave_day' : leave_type_day, 'leave_replacer' : rep_emp, 'comments' : leave_comments, 'no_pay_check': no_pay_check_value, 
                                    'need_replacer_sms': need_sms, 'sms_replacer_emps': sms_emps, 'opt_sms_conformation': opt_sms_conformation, 'opt_sms_sender': opt_sms_sender, 'opt_sms_rejection': opt_sms_rejection,'leave_approve_on_apply' : leave_approve_on_apply };
                                    
                            wrapLoader('#slot_details_main_wraper_inner');
                            $.ajax({
                                url: '{$url_path}save_leave.php',
                                type:"POST",
                                data: $.param(url_data_obj),
                                success:function(data){
                                    //console.log(data);
                                    close_right_panel();
                                    reload_content();
                                }
                            }).always(function(data) { 
                                uwrapLoader('#slot_details_main_wraper_inner');
                            });
                        } else
                            alert('{$translate.please_select_one_date}');
                    }
                } else
                    alert('{$translate.please_select_a_leave_type}');
            }
        }
    {/if}

    $(document).ready(function() {
        {if $login_user_role neq 3}
            $('#Franvaro-box #leave_date_from, #Franvaro-box #leave_date_to, #Franvaro-box #leave_date_day').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '{$lang}'})
            .on('changeDate', function(ev){
              load_replacement_employees();
            });

            $( "#Franvaro-box #leave_time_from, #Franvaro-box #leave_time_to" ).keyup(function(){
                load_replacement_employees();
            });
        {/if}
        
        {*if $privileges_gd.no_pay_leave eq 1}
            $('#time_no_pay_sick_check, #date_no_pay_sick_check').click(function(){
                if($(this).is(':checked')){
                    var kerense_employee = $('#slot_details_main_wraper_group #this_slot_actual_employee_name').val();
                    $(this).parents('.no_pay_sick_check_div').find('span').html('{$translate.karense} - '+kerense_employee).css('color', 'red');
                }else{
                    $(this).parents('.no_pay_sick_check_div').find('span').html('{$translate.no_karense}').css('color', '');
                }
            });
        {/if*}
    
        $('#send_sms_time').click(function(){
                if($(this).is(':checked')){
                    $('#time_replacer_sms_tbl').removeClass('hide');
                    $('#time_replacer_nosms_tbl').addClass('hide');
                }else{
                    $('#time_replacer_sms_tbl').addClass('hide');
                    $('#time_replacer_nosms_tbl').removeClass('hide');
                }
        });
        $('#send_sms_date').click(function(){
                if($(this).is(':checked')){
                    $('#date_replacer_sms_tbl').removeClass('hide');
                    $('#date_replacer_nosms_tbl').addClass('hide');
                }else{
                    $('#date_replacer_sms_tbl').addClass('hide');
                    $('#date_replacer_nosms_tbl').removeClass('hide');
                }
        });

        /*$('#leave_date_day, #leave_date_from, #leave_date_to').change(function(){
            check_is_karense_day();
        });*/
        $('#leave_date_day, #leave_date_from, #leave_date_to').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '{$lang}'})
        .on('changeDate', function(ev){
          check_is_karense_day();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '{$lang}'
        });

        var stickyPanelOptions = {
            topPadding: 3,
            afterDetachCSSClass: "stickyPanelDetached",
            savePanelSpace: true,
            parentSelector: '#stickyPanelParent'
        };
        
        $("#btnGroupStickyPanel").stickyPanel(stickyPanelOptions);


        //HEIGHT FIT
        $('.main-left, .main-right').css({ height: $(window).innerHeight()-50 });
        $(window).resize(function(){
          $('.margin-left, .main-right').css({ height: $(window).innerHeight()-50 });
        }).resize();

        //datepicker_btstrap
        $(".monthPicker").datepicker({
            format: "yyyy-mm-dd",
            changeMonth: true,
            changeYear: true,
            // viewMode: "months", //1
            // minViewMode: "months",
            autoclose: true,
            language: '{$lang}',
            onClose: function (dateText, inst) { }
        }).on('changeDate', function(ev){
            //console.log(ev);
            //if(ev.viewMode == 'months'){
                // var month = $.datepicker.formatDate('mm', ev.date);
                var this_date = $.datepicker.formatDate('yy-mm-dd', ev.date);
                var year = $.datepicker.formatDate('yy', ev.date);
                var week_no = $.datepicker.iso8601Week(ev.date);
                //console.log(ev);
                var year_week = year+'|'+ (week_no < 10 ? '0' : '')+week_no;
                //console.log(year_week);
                $(".monthPicker").datepicker('hide');
                navigatePage('{$url_path}gdschema_day_customer.php?date='+this_date+'&year_week='+year_week+'&customer={$selected_customer}&action=1',1);
            //}
        });
    });

    {if $privileges_gd.add_slot == 1}
        function create_new_slot(){
            close_right_panel();
            show_right_panel();
            $("#slot_creation_main_wraper_group").removeClass('hide');
            $(".add-new-slots-month .create-slotes-panel").html(get_slot_add_theme());
            $(".add-new-slots-month").removeClass('hide');
            
            var stickyPanelOptions = {
                topPadding: 3,
                afterDetachCSSClass: "stickyPanelDetached",
                savePanelSpace: true,
                parentSelector: '#stickyPanelParent'
            };

            $("#btnGroupStickyPanel").stickyPanel('unstick');
            $("#btnGroupStickyPanel").stickyPanel(stickyPanelOptions);

            $('html, body').animate({
                scrollTop: $(".main-right").offset().top
            }, 2000);
            
            var date = $('.add-new-slots-month #new_slot_date').val();
            date = (typeof date != 'undefined' ? date : '');
            if(date != '')
                $('.add-new-slots-month #new_slot_from').focus();
            else{
                $('.add-new-slots-month #dtPickerNewSlotDate').datepicker('update', '{$selected_date}');
                // $('.add-new-slots-month .slot_date').focus();
                $('.add-new-slots-month #new_slot_from').focus();
            }
        }
    {/if}
</script>

{*    single slot actions*}
<script>
    function makeInterestIn(){
        var ids_temp = $('#monthlyviewtbl .monthlyslotview.slot:not(:hidden) input:checkbox:checked.m_check').map(function () {
            return this.value;
        }).get();
        var ids = ids_temp.join('-');
        $('#slot_details_main_wraper_group #sdID').val(ids);
        var slot_id     = $('#slot_details_main_wraper_group #sdID').val();
        var process_details_obj = { 
            'id': slot_id,
            'action'    : 'interestedin'
        };
        wrapLoader('#slot_details_main_wraper_group');
        $.ajax({
            url:"{$url_path}ajax_alloc_action_slot.php",
            type:"POST",
            data:process_details_obj,
            success:function(data){
                //console.log(data);
                reload_content();
            }
        }).always(function(data) { 
            uwrapLoader('#slot_details_main_wraper_group');
        });
    }
    {if $privileges_gd.split_slot eq 1}
        function splitSlot(){
            var new_tfrom   = $("#slot-dela-pass #split_slot_timefrom").val();
            var new_tto     = $("#slot-dela-pass #split_slot_timeto").val();
            if(new_tfrom != '' && new_tto != ''){
            
                var slot_id     = $('#slot_details_main_wraper_group #sdID').val();
                var slot_from   = $('#slot_details_main_wraper_group #this_slot_actual_timefrom').val();
                var slot_to     = $('#slot_details_main_wraper_group #this_slot_actual_timeto').val();
                
                if(slot_id.includes('-')) {
                    var process_details_obj = { 'id': slot_id,
                        'slot_from' : slot_from,
                        'slot_to'   : slot_to,
                        'time_from' : new_tfrom,
                        'time_to'   : new_tto,
                        'action'    : 'splitmultiple'
                    };
                } else {
                    var process_details_obj = { 'id': slot_id,
                        'slot_from' : slot_from,
                        'slot_to'   : slot_to,
                        'time_from' : new_tfrom,
                        'time_to'   : new_tto,
                        'action'    : 'split'
                    };
                }
                
                wrapLoader('#slot_details_main_wraper_inner');
                $.ajax({
                    url:"{$url_path}ajax_alloc_action_slot.php",
                    type:"POST",
                    data:process_details_obj,
                    success:function(data){
                        //console.log(data);
                        close_right_panel();
                        reload_content();
                    }
                }).always(function(data) { 
                    uwrapLoader('#slot_details_main_wraper_inner');
                });
            }else
                alert('{$translate.please_enter_time}');
        }
    {/if}
    
    function getAfterDates_for_slotcopy_multiple(){
        var max_week_number = 52;
        var year_week   = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
        var cur_slot_year_of_week = date('o',strtotime(year_week));
        var year = parseInt(cur_slot_year_of_week, 10);
        var to_week = parseInt($("#kopierapass-box #slot_copy_multiple_from_wk").val()) + (parseInt($("#kopierapass-box #slot_copy_multiple_from_option").val()));
        if (to_week > max_week_number) {
            to_week = to_week - max_week_number;
            year = year + 1;
        }
        $('#kopierapass-box #slot_copy_multiple_to_wk').find('option').remove();
        for (var i = 0; i < 40; i++) {
            if (to_week > max_week_number) {
                to_week = 1;
                year = year + 1;
            }
            $('<option value="' + year + '-' + to_week + '">' + year + ':' + to_week + '</option>').appendTo("#kopierapass-box #slot_copy_multiple_to_wk");
            to_week = to_week + 1;
        }
    }
    
    {if $privileges_gd.copy_single_slot_option eq 1}
        function save_copy(){
            var days = "";
            var with_user = 1;
            for(var i=0; i < document.frm_copy.slot_copy_multiple_days.length; i++){
            if(document.frm_copy.slot_copy_multiple_days[i].checked)
                days += document.frm_copy.slot_copy_multiple_days[i].value+'-';
            }
            if(days == '')
                alert('{$translate.select_days}');
            else{
                if($('#kopierapass-box #slot_copy_multiple_withoutuser').attr("checked") == "checked")
                    with_user = 0;
                
                var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();
                var slot_employee   = $('#slot_details_main_wraper_group #this_slot_actual_employee').val();
                
                var from_week   = $("#kopierapass-box #slot_copy_multiple_from_wk").val();
                var from_option = $("#kopierapass-box #slot_copy_multiple_from_option").val();
                var to_week     = $("#kopierapass-box #slot_copy_multiple_to_wk").val();
                
                var additional_urldata = 'customer='+slot_customer+'&employee='+slot_employee+'&date='+slot_date+
                        '&from_week='+from_week+'&from_option='+from_option+'&to_week='+to_week+'&id='+slot_id+
                        '&days='+days+'&with_user='+with_user+'&action=copy_multiple&user={$login_user}';
                //console.log(additional_urldata);
                
                if(with_user == 1){
                    var atl_req_data = additional_urldata + '&to_single_slot=TRUE&type_check=11';
                    var process_url = '{$url_path}ajax_alloc_action_slot.php?' + additional_urldata;
                    check_atl_warning(atl_req_data, function(this_url){
                                        wrapLoader('#slot_details_main_wraper_inner');
                                        $('#div_alloc_action').load(this_url, function(response, status, xhr){ uwrapLoader('#slot_details_main_wraper_group'); reload_content(); });
                                    }, process_url, '#slot_details_main_wraper_group');
                }else{
                    wrapLoader('#slot_details_main_wraper_inner');
                    $.ajax({
                        url:"{$url_path}ajax_alloc_action_slot.php",
                        type:"POST",
                        data:additional_urldata,
                        success:function(data){
                            //console.log(data);
                            close_right_panel();
                            reload_content();
                        }
                    }).always(function(data) { 
                        uwrapLoader('#slot_details_main_wraper_inner');
                    });
                }
            }
        }
    {/if}

    {if $privileges_gd.copy_single_slot eq 1}
        function copy_single_slot(){
            
            var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
            var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
            var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();

            var slot_details_obj = { 'id': slot_id,
                            'date': slot_date,
                            'customer': slot_customer,
                            'action': 'copy'
                };

            wrapLoader('#slot_details_main_wraper_inner');
            $.ajax({
                url:"{$url_path}ajax_alloc_action_slot.php",
                type:"POST",
                data:slot_details_obj,
                success:function(data){
                    //console.log(data);
                    close_right_panel();
                }
            }).always(function(data) { 
                uwrapLoader('#slot_details_main_wraper_inner');
            });
        }
    {/if}
    {if $privileges_gd.swap eq 1}
        function swap_copy_single_slot(){
            
            var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
            var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
            var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();

            var slot_details_obj = { 'id': slot_id,
                            'date': slot_date,
                            'customer': slot_customer,
                            'action': 'swap'
                };

            wrapLoader('#slot_details_main_wraper_inner');
            $.ajax({
                url:"{$url_path}ajax_alloc_action_slot.php",
                type:"POST",
                data:slot_details_obj,
                success:function(data){
                    //console.log(data);
                    close_right_panel();
                }
            }).always(function(data) { 
                uwrapLoader('#slot_details_main_wraper_inner');
            });
        }
    {/if}
    
    {if $privileges_gd.delete_slot eq 1 or $privileges_gd.candg_approve eq 1}
        function delete_single_slot(){
            bootbox.dialog( '{$translate.confirm_delete_slot}', [{
                    "label" : "{$translate.no}",
                    "class" : "btn-danger"
                }, {
                    "label" : "{$translate.yes}",
                    "class" : "btn-success",
                    "callback": function() {
                        var slot_id         = $('#slot_details_main_wraper_group #sdID').val();
                        var slot_date       = $('#slot_details_main_wraper_group #this_slot_actual_date').val();
                        var slot_customer   = $('#slot_details_main_wraper_group #this_slot_actual_customer').val();

                        var slot_details_obj = { 'id': slot_id,
                                        'date': slot_date,
                                        'customer': slot_customer,
                                        'action': 'slot_remove'
                            };

                        wrapLoader('#slot_details_main_wraper_inner');
                        $.ajax({
                            url:"{$url_path}ajax_alloc_action_slot.php",
                            type:"POST",
                            data:slot_details_obj,
                            success:function(data){
                                //console.log(data);
                                close_right_panel();
                                reload_content();
                            }
                        }).always(function(data) { 
                            uwrapLoader('#slot_details_main_wraper_inner');
                        });
                    }
            }]);
        }
    {/if}
</script>

{*    right click functions*}
<script>
    $(document).ready(function() {
        /**************************************************
         * Context-Menu with Sub-Menu
         **************************************************/


        $.contextMenu({
            selector: '.dayview_timeshow, .dayview_employee', 
            build: function($trigger, e) {
                //console.log($trigger);
                //console.log(e);

                var included_candg_slots = false;
                var included_none_candg_slots = false;
                var included_incomplete_slots = false;
                var included_non_incomplete_slots = false;
                var included_selected_slots = false;
                var included_notonly_incomplete_slots = true;
                $( '.slots_all .absolute_div input:checkbox:checked.m_check.check-box' ).each(function( index ) {
                    if($(this).parents('li.slot_time_bar').find('.absolute_div').hasClass('slot-theme-candg'))
                        included_candg_slots = true;
                    else
                        included_none_candg_slots = true;
                });
                $( '.slots_all .absolute_div input:checkbox:checked.m_check.check-box' ).each(function( index ) {
                    if($(this).parents('li.slot_time_bar').find('.absolute_div').hasClass('slot-theme-incomplete'))
                        included_incomplete_slots = true;
                    else
                        included_non_incomplete_slots = true;
                });
                //console.log('included_candg_slots: '+included_candg_slots);
                //console.log('included_not_candg_slots: '+included_none_candg_slots);

                if(included_candg_slots && included_none_candg_slots){
                    //$trigger.contextMenu(false);
                    return false;
                }

                if(included_incomplete_slots || included_non_incomplete_slots){
                    included_selected_slots = true;
                }

                if(included_incomplete_slots && !included_non_incomplete_slots){
                    included_notonly_incomplete_slots = false;
                }

                var ids_temp = $('.slots_all .absolute_div input:checkbox:checked.m_check.check-box').map(function () {
                    return this.value;
                }).get();

                var ids = ids_temp.join('-');

                // this callback is executed every time the menu is to be shown
                // its results are destroyed every time the menu is hidden
                // e is the original contextmenu event, containing e.pageX and e.pageY (amongst other data)
                var options = {
                    callback: function(key, options) {
                        //window.console && console.log(m) || alert(m);
                        var slot_type_change = '';
                        var slot_fkkn_change = '';
                        switch(key){
                            case "go_to_employee":
                                var temp_empl_id = '';
                                if(ids_temp.length == 1){
                                    var slot_details_hub = $('#slot_thread_'+ids_temp[0]).find('.slot_details_hub');
                                    if(slot_details_hub.length == 1){
                                        temp_empl_id = slot_details_hub.attr('data-employee-id');
                                        if(temp_empl_id != ''){
                                            navigatePage('{$url_path}gdschema_day_employee.php?date={$selected_date}&employee='+temp_empl_id+'&action=1',1);
                                        }
                                    }
                                }
                                if(temp_empl_id == ''){
                                    close_right_panel();
                                    show_right_panel();
                                    $("#right_click_action_options, #goto-employees-options").removeClass('hide');
                                }
                               break;
                            case "go_to_customer":
                                close_right_panel();
                                show_right_panel();
                                $("#right_click_action_options, #goto-customers-options").removeClass('hide');
                               break;
                            case "delete_slot":
                               if(ids != ''){
                                    var urls = '{$url_path}ajax_right_click_actions.php';
                                    var url_post_data = { 'ids': ids, 'action' : 'multiple_slots_remove', 'page_date': '{$selected_date}', 'customer': '{$selected_customer}', 'request_from': 'gd_timeline_customer' };
                                    bootbox.dialog( '{$translate.confirm_delete_slot}', [{
                                            "label" : "{$translate.no}",
                                            "class" : "btn-danger"
                                        }, {
                                            "label" : "{$translate.yes}",
                                            "class" : "btn-success",
                                            "callback": function() {
                                                navigatePage(urls, 1, url_post_data);
                                            }
                                    }]);
                               } else
                                   bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                               break;
                            case 'delete_customer':
                               if(ids != ''){
                                   var urls = '{$url_path}ajax_right_click_actions.php';
                                   var url_post_data = { 'ids': ids, 'action': 'delete_customers', 'page_date': '{$selected_date}', 'customer': '{$selected_customer}', 'request_from': 'gd_timeline_customer' };
                                   bootbox.dialog( '{$translate.confirm_delete_customer}', [{
                                            "label" : "{$translate.no}",
                                            "class" : "btn-danger"
                                        }, {
                                            "label" : "{$translate.yes}",
                                            "class" : "btn-success",
                                            "callback": function() {
                                                navigatePage(urls, 1, url_post_data);
                                            }
                                    }]);
                               } else
                                   bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                               break;
                            case 'delete_employee':
                               if(ids != ''){
                                   var urls = '{$url_path}ajax_right_click_actions.php';
                                   var url_post_data = { 'ids': ids, 'action': 'delete_employees', 'page_date': '{$selected_date}', 'customer': '{$selected_customer}', 'request_from': 'gd_timeline_customer' };
                                   bootbox.dialog( '{$translate.confirm_delete}', [{
                                            "label" : "{$translate.no}",
                                            "class" : "btn-danger"
                                        }, {
                                            "label" : "{$translate.yes}",
                                            "class" : "btn-success",
                                            "callback": function() {
                                                navigatePage(urls, 1, url_post_data);
                                            }
                                    }]);
                               } else
                                   bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                               break;
                           case 'change_fk':
                           case 'change_kn':
                           case 'change_tu':
                               switch(key){
                                   case "change_fk" : slot_fkkn_change = 'change_fk'; break;
                                   case "change_kn" : slot_fkkn_change = 'change_kn'; break;
                                   case "change_tu" : slot_fkkn_change = 'change_tu'; break;
                               }

                               if(ids != ''){
                                   var urls = '{$url_path}ajax_right_click_actions.php';
                                   var url_post_data = { 'ids': ids, 'action': slot_fkkn_change, 'page_date': '{$selected_date}', 'customer': '{$selected_customer}', 'request_from': 'gd_timeline_customer' };
                                   bootbox.dialog( '{$translate.confirm_changes}', [{
                                            "label" : "{$translate.no}",
                                            "class" : "btn-danger"
                                        }, {
                                            "label" : "{$translate.yes}",
                                            "class" : "btn-success",
                                            "callback": function() {
                                                navigatePage(urls, 1, url_post_data);
                                            }
                                    }]);
                               } else
                                   bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                               break;
                           case "change_employee":
                               if(ids != ''){
                                   var process_details_obj = { 'page_date': '{$selected_date}',
                                    'pCustomer': '{$selected_customer}',
                                    'ids': ids,
                                    'action': 'avail_employees_for_multiple_slot_change',
                                    'method': '1'};
                                   changeEmployeeCustomer(process_details_obj,1);
                               } else
                                   bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                               break;
                           case "change_customer":
                               if(ids != ''){
                                   var process_details_obj = { 'page_date': '{$selected_date}',
                                    'pCustomer': '{$selected_customer}',
                                    'ids': ids,
                                    'action': 'avail_customers_for_multiple_slot_change',
                                    'method': '2'};
                                   changeEmployeeCustomer(process_details_obj,2);
                               } else
                                   bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                               break;

                            case "change_time":
                               if(ids != ''){
                                changeEmployeeTime();
                               } else
                                   bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                               break;

                           case "copy": 
                               if(ids != '')
                                   copyMonthlySlot();
                               else
                                   bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                               break;
                           case "paste" :
                                var dates = '{$selected_date}';
                                pasteSlot('TRUE',dates,'');
                                break;   
                           case "add_slot" :
                                create_new_slot();
                                break;
                           case "split_slot" :
                                split_slot_event();
                               break;
                           case "mark_interest_in" :
                                bootbox.dialog( '{$translate.confirm_changes}', [{
                                        "label" : "{$translate.no}",
                                        "class" : "btn-danger"
                                    }, {
                                        "label" : "{$translate.yes}",
                                        "class" : "btn-success",
                                        "callback": function() {

                                            makeInterestIn();
                                        }
                                }]);
                               break;
                           case "change_type_normal" :
                           case "change_type_travel" :
                           case "change_type_oncall" :
                           case "change_type_break" :
                           case "change_type_overtime" :
                           case "change_type_qual_overtime" :
                           case "change_type_more_time" :
                           case "change_type_some_other_time" :
                           case "change_type_training_time" :
                           case "change_type_call_training" :
                           case "change_type_personal_meeting" :
                           case "change_type_more_oncall" :
                           case "change_type_voluntary" :
                           case "change_type_complementary" :
                           case "change_type_complementary_oncall" :
                           case "change_type_oncall_standby":     
                               switch(key){
                                   case "change_type_normal" : slot_type_change = 0; break;
                                   case "change_type_travel" : slot_type_change = 1; break;
                                   case "change_type_break" : slot_type_change = 2; break;
                                   case "change_type_oncall" : slot_type_change = 3; break;
                                   case "change_type_overtime" : slot_type_change = 4; break;
                                   case "change_type_qual_overtime" : slot_type_change = 5; break;
                                   case "change_type_more_time" : slot_type_change = 6; break;
                                   case "change_type_some_other_time" : slot_type_change = 7; break;
                                   case "change_type_training_time" : slot_type_change = 8; break;
                                   case "change_type_call_training" : slot_type_change = 9; break;
                                   case "change_type_personal_meeting" : slot_type_change = 10; break;
                                   case "change_type_voluntary" : slot_type_change = 11; break;
                                   case "change_type_complementary" : slot_type_change = 12; break;
                                   case "change_type_complementary_oncall" : slot_type_change = 13; break;
                                   case "change_type_more_oncall" : slot_type_change = 14; break;
                                   case "change_type_oncall_standby" : slot_type_change = 15; break;    
                               }
                               if(ids != ''){
                                    bootbox.dialog( '{$translate.confirm_changes}', [{
                                        "label" : "{$translate.no}",
                                        "class" : "btn-danger"
                                    },{
                                        "label" : "{$translate.yes}",
                                        "class" : "btn-success",
                                        "callback": function() {
                                        var mixed_normal_oncall_types = false;
                                        //special check for complementary and complementary-oncall
                                        if(slot_type_change == 12 || slot_type_change == 13){
                                            var normal_slot_types = ['0', '1', '2', '4', '5', '6', '7', '8', '10', '11', '12', '15', '16'];
                                            var oncall_slot_types = ['3', '9', '13', '14', '17'];
                                            var have_normal_slots = false, have_oncall_slots = false;
                                            var tmp_this_slot_type = '';
                                            $( '.slots_all .absolute_div input:checkbox:checked.m_check.check-box' ).each(function( index ) {
                                                tmp_this_slot_type = $(this).parents('.slot-hover-popup').find('input.slot_details_hub').attr('data-type');
                                                if($.inArray( tmp_this_slot_type, normal_slot_types ) > -1) //check if normal slot type
                                                    have_normal_slots = true;
                                                else if($.inArray( tmp_this_slot_type, oncall_slot_types ) > -1) //check if oncall slot type
                                                    have_oncall_slots = true;
                                            });
                                            mixed_normal_oncall_types = (have_normal_slots == true && have_oncall_slots == true ? true : false);
                                        }
                                        if((slot_type_change == 12 || slot_type_change == 13) && mixed_normal_oncall_types == true){
                                            var prompt_msg = null;
                                            if(slot_type_change == 12) //complementary
                                                prompt_msg = '{$translate.do_you_want_to_change_oncall_to_comp_oncall}';
                                            else if(slot_type_change == 13) //complementary-oncall
                                                prompt_msg = '{$translate.do_you_want_to_change_normal_to_complementary}';
                                            
                                                bootbox.dialog( prompt_msg, [{
                                                        "label" : "{$translate.cancel}",
                                                        "class" : "btn-primary"
                                                    },{
                                                        "label" : "{$translate.no}",
                                                        "class" : "btn-danger",
                                                        "callback": function() {
                                                            if(slot_type_change == 13){
                                                                $.ajax({
                                                                    url: "{$url_path}ajax_check_oncall_inconve_range.php",
                                                                    type: "POST",
                                                                    data: 'ids='+ids,
                                                                    success:function(data){
                                                                        if(data == 'success'){
                                                                            var url = '{$url_path}ajax_right_click_actions.php';
                                                                            var url_post_data = { 'page_date': '{$selected_date}', 'customer': '{$selected_customer}', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_timeline_customer' };
                                                                            navigatePage(url,1, url_post_data); 
                                                                        }else
                                                                            bootbox.alert('{$translate.time_outside_oncall}', function(result){ });
                                                                    }
                                                                  });
                                                           }else{
                                                                var url = '{$url_path}ajax_right_click_actions.php';
                                                                var url_post_data = { 'page_date': '{$selected_date}', 'customer': '{$selected_customer}', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_timeline_customer' };
                                                                navigatePage(url,1, url_post_data); 
                                                           }
                                                        }
                                                    },{
                                                        "label" : "{$translate.yes}",
                                                        "class" : "btn-success",
                                                        "callback": function() {
                                                            var url = '{$url_path}ajax_right_click_actions.php';
                                                            var url_post_data = { 'page_date': '{$selected_date}', 'customer': '{$selected_customer}', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_timeline_customer', 'normal_oncall_auto_change': true };
                                                            navigatePage(url,1, url_post_data); 
                                                        }
                                                }]);
                                        }
                                        else if(slot_type_change == 14 || slot_type_change == 3 || slot_type_change == 9 || slot_type_change == 13 || slot_type_change == 17){
                                            $.ajax({
                                                url: "{$url_path}ajax_check_oncall_inconve_range.php",
                                                type: "POST",
                                                data: 'ids='+ids,
                                                success:function(data){
                                                    if(data == 'success'){
                                                        var url = '{$url_path}ajax_right_click_actions.php';
                                                        var url_post_data = { 'page_date': '{$selected_date}', 'customer': '{$selected_customer}', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_timeline_customer' };
                                                        navigatePage(url,1, url_post_data); 
                                                    }else
                                                        bootbox.alert('{$translate.time_outside_oncall}', function(result){ });
                                                }
                                            });
                                        }
                                        else{
                                            var url = '{$url_path}ajax_right_click_actions.php';
                                            var url_post_data = { 'page_date': '{$selected_date}', 'customer': '{$selected_customer}', 'ids': ids, 'action': 'change_type', 'slot_type': slot_type_change, 'request_from': 'gd_timeline_customer' };
                                            navigatePage(url,1, url_post_data); 
                                        }
                                   }
                                   }]);
                               } else
                                    bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                               break;
                        }
                    },
                    items: {
                        {if $privileges_gd.process eq 1}
                            "copy": { "name": "{$translate.copy}", accesskey: "{$translate.copy}", disabled: ((included_candg_slots || !included_selected_slots) ? true : false)},
                            "paste": { "name": "{$translate.paste}", accesskey: "{$translate.paste}", disabled: ((included_candg_slots || !included_selected_slots) ? true : false)},
                        {/if}
                        {if $privileges_gd.process eq 1} "sep11": "---------", {/if}
                        "goto": {   
                                    "name": "{$translate.go_to}", 
                                    accesskey: "{$translate.go_to}", 
                                    "items": {
                                        "go_to_employee":{ "name":"{$translate.employee}", accesskey: "{$translate.employee}" },
                                        "go_to_customer":{ "name":"{$translate.customer}", accesskey: "{$translate.customer}" }
                                    }
                            },
                        {if $privileges_gd.add_employee eq 1 or $privileges_gd.add_customer eq 1 or $privileges_gd.fkkn eq 1 or $privileges_gd.slot_type eq 1}
                            {if $privileges_gd.process eq 1} "sep121": "---------", {/if}
                            "change": {
                                    "name": "{$translate.change_action}", 
                                    disabled: ((included_candg_slots || !included_selected_slots) ? true : false),
                                    accesskey: "{$translate.change_action}", 
                                    "items": {
                                        {if $privileges_gd.add_employee eq 1}
                                            "change_employee":{ "name":"{$translate.employee}", accesskey: "{$translate.employee}", disabled: (included_candg_slots ? true : false) },
                                        {/if}
                                        {if $privileges_gd.add_customer eq 1}
                                            "change_customer": { "name": "{$translate.customer}", accesskey: "{$translate.customer}", disabled: (included_candg_slots ? true : false) },
                                        {/if}
                                        {if $privileges_gd.fkkn eq 1}
                                            "change_contract": { 
                                                "name": "{$translate.right_click_menu_contract}",
                                                disabled: (included_candg_slots ? true : false),
                                                accesskey: "{$translate.right_click_menu_contract}", 
                                                "items" : {
                                                    "change_fk": { "name": "FK", accesskey: "FK", disabled: (included_candg_slots ? true : false) },
                                                    "change_kn": { "name": "KN", accesskey: "KN", disabled: (included_candg_slots ? true : false) },
                                                    "change_tu": { "name": "TU", accesskey: "TU", disabled: (included_candg_slots ? true : false) },
                                                }
                                            },
                                        {/if}
                                        {if $privileges_gd.slot_type eq 1}
                                            "change_type": { 
                                                "name": "{$translate.slot_type}",
                                                disabled: (included_candg_slots ? true : false),
                                                accesskey: "{$translate.slot_type}", 
                                                "items" : {
                                                'change_type_oncall_standby':{ "name" : "{$translate.oncall_standby}"},

                                                        'change_type_training_time':{ "name" : "{$translate.training_time}"},
                                                        'change_type_call_training':{ "name" : "{$translate.call_training}" },
                                                        'change_type_complementary':{ "name" : "{$translate.complementary}"},
                                                        'change_type_complementary_oncall':{ "name" : "{$translate.complementary_oncall}"},
                                                        'change_type_qual_overtime':{ "name" : "{$translate.qual_overtime}"},
                                                        'change_type_normal':{ "name" : "{$translate.normal}"},
                                                        'change_type_personal_meeting':{ "name" : "{$translate.personal_meeting}"},
                                                         'change_type_break':{ "name" : "{$translate.break}"},
                                                         'change_type_travel':{ "name" : "{$translate.travel}"},
                                                        'change_type_more_time':{ "name" : "{$translate.more_time}"},
                                                        'change_type_more_oncall':{ "name" : "{$translate.more_oncall}"},
                                                        'change_type_some_other_time':{ "name" : "{$translate.some_other_time}" },
                                                        'change_type_voluntary':{ "name" : "{$translate.voluntary}"},
                                                        'change_type_oncall':{ "name" : "{$translate.oncall}"},
                                                        'change_type_overtime':{ "name" : "{$translate.overtime}"}
                                                } 
                                            },
                                        {/if}
                                        {if $privileges_gd.change_time eq 1 }
                                                "change_time":{ "name":"{$translate.change_time}", accesskey: "{$translate.change_time}", disabled: ((included_candg_slots || !included_selected_slots) ? true : false) },
                                        {/if}
                                    }
                            },
                        {/if}
                        {if $privileges_gd.delete_slot eq 1 or $privileges_gd.remove_employee eq 1 or $privileges_gd.remove_customer eq 1}
                            "delete": {
                                    "name": "{$translate.delete_action}",
                                    accesskey: "{$translate.delete_action}", 
                                    "items": {
                                        {if $privileges_gd.delete_slot eq 1} "delete_slot": { "name": "{$translate.slot}", accesskey: "{$translate.slot}" },{/if}
                                        {if $privileges_gd.remove_employee eq 1} "delete_employee": { "name": "{$translate.employee}", accesskey: "{$translate.employee}", disabled: ((included_candg_slots || !included_selected_slots) ? true : false) },{/if}
                                        {if $privileges_gd.remove_customer eq 1} "delete_customer": { "name": "{$translate.customer}", accesskey: "{$translate.customer}", disabled: ((included_candg_slots || !included_selected_slots) ? true : false) }{/if}
                                    }

                            },
                        {/if}
                        {if $privileges_gd.split_slot eq 1}
                            "sep12": "---------",
                            "split_slot": { "name": "{$translate.split_slot}", accesskey: "{$translate.split_slot}", disabled: ((included_candg_slots || !included_selected_slots) ? true : false)},
                        {/if}
                        {if $privileges_gd.split_slot eq 1}
                            "sep12": "---------",
                            "mark_interest_in": { "name": "{$translate.mark_interest_in}", accesskey: "{$translate.mark_interest_in}", disabled: (included_notonly_incomplete_slots ? true : false)},
                        {/if}
                        {if $privileges_gd.add_slot eq 1}
                            "sep12": "---------",
                            "add_slot": { "name": "{$translate.add_new_slot}", accesskey: "{$translate.add_new_slot}"},
                        {/if}
                    }
                }

                if(included_candg_slots && !included_none_candg_slots){
                    {if $privileges_gd.candg_approve eq 1}
                        options.items.candg_approve = { 
                                "name":"{$translate.approve}", 
                                accesskey: "{$translate.approve}",
                                callback: function(key, opt){ 
                                        var urls = '{$url_path}ajax_right_click_actions.php';
                                        var url_post_data = { 'ids': ids, 'action': 'slot_approve_candg', 'page_date': '{$selected_date}', 'customer': '{$selected_customer}', 'request_from': 'gd_timeline_customer' };
                                        
                                        var processed_emp_names = [ ];
                                        $.each(ids_temp, function( index, value ) {
                                            var temp_sel_data_obj   = $('.slots_all #slot_thread_'+value).find('.slot_details_hub');
                                            processed_emp_names.push(temp_sel_data_obj.attr('data-employee-name'));

                                        });
                                        processed_emp_names = arrayUnique(processed_emp_names);

                                        bootbox.dialog( '{$translate.confirm_approval_candg} <br/><br/>{$translate.employee}: '+processed_emp_names.join(', '), [{
                                                "label" : "{$translate.no}",
                                                "class" : "btn-danger"
                                            },{
                                                "label" : "{$translate.yes_to_all}",
                                                "class" : "btn-primary",
                                                "callback": function() {
                                                    var other_ids = [ ];
                                                    var processed_emps = [ ];
                                                        
                                                    $.each(ids_temp, function( index, value ) {
                                                        var temp_sel_data_obj   = $('.slots_all #slot_thread_'+value).find('.slot_details_hub');
                                                        var temp_sel_data_emp   = temp_sel_data_obj.attr('data-employee-id');
                                                        var temp_sel_data_cust  = temp_sel_data_obj.attr('data-customer-id');
                                                        
                                                        if($.inArray( temp_sel_data_emp, processed_emps ) == -1){

                                                            if(temp_sel_data_emp != '' && temp_sel_data_cust != ''){
                                                                $( '.slots_all .absolute_div.slot-theme-candg input.slot_details_hub' ).each(function( index ) {
                                                                    if($(this).attr('data-employee-id') == temp_sel_data_emp && $(this).attr('data-customer-id') == temp_sel_data_cust && $(this).attr('data-id') != value){
                                                                        other_ids.push($(this).attr('data-id'));
                                                                    }
                                                                });

                                                                processed_emps.push(temp_sel_data_emp);
                                                            }
                                                        }
                                                            
                                                    });
                                                    
                                                    var final_ids = ids_temp.concat(other_ids);
                                                    url_post_data['ids'] = final_ids.join('-');
                                                    navigatePage(urls, 1, url_post_data);
                                                }
                                            },{
                                                "label" : "{$translate.yes}",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                    navigatePage(urls, 1, url_post_data);
                                                }
                                        }]);
                                }
                        };

                        options.items.candg_reject = { 
                                "name":"{$translate.reject}", 
                                accesskey: "{$translate.reject}",
                                callback: function(key, opt){ 
                                        var urls = '{$url_path}ajax_right_click_actions.php';
                                        var url_post_data = { 'ids': ids, 'action': 'multiple_slots_remove', 'page_date': '{$selected_date}', 'customer' : '{$selected_customer}', 'request_from': 'gd_timeline_customer' };
                                        bootbox.dialog( '{$translate.confirm_delete_slot}', [{
                                                "label" : "{$translate.no}",
                                                "class" : "btn-danger",
                                                "callback": function() {
                                                    bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
                                                }
                                            }, {
                                                "label" : "{$translate.yes}",
                                                "class" : "btn-success",
                                                "callback": function() {
                                                    navigatePage(urls, 1, url_post_data);
                                                }
                                        }]);
                                }
                        };
                    {/if}
                }
                
                {if $privileges_gd.add_employee eq 1}
                    if(ids_temp.length == 1 && !included_candg_slots){
                        options.items.pmain_replace = { 
                                    "name":"{$translate.replace}", 
                                    accesskey: "{$translate.replace}",
                                    callback: function(key, opt){ 
                                            loadPopupReplaceProcessMain(ids);
                                    }
                        };
                    }
                {/if}
        
                {if $login_user_role eq 1}
                    if(included_incomplete_slots && !included_non_incomplete_slots){
                         options.items.sms = { 
                                 "name":"{$translate.sms}", 
                                 accesskey: "{$translate.sms}",
                                 callback: function(key, opt){ 
                                            loadSMSProcessMain(ids);
                                 }
                         };
                     }
                 {/if}
         
                {if $privileges_gd.swap eq 1}
                    //swap 2 slots at a single action
                    if(ids_temp.length == 2 && included_non_incomplete_slots && !included_incomplete_slots && !included_candg_slots){
                         options.items.swap_switch = { 
                                 "name":"{$translate.swap}", 
                                 accesskey: "{$translate.swap}",
                                 callback: function(key, opt){ 
                                            process_swap_switch_2_slots(ids);
                                 }
                         };
                    }
                    
                    //slot copy for swap
                    if(ids_temp.length == 1 && included_non_incomplete_slots && !included_incomplete_slots && !included_candg_slots){
                         options.items.swap_copy = { 
                                 "name":"{$translate.swap_copy}", 
                                 accesskey: "{$translate.swap_copy}",
                                 callback: function(key, opt){ 
                                            process_swap_copy_first_slot(ids);
                                 }
                         };
                    }
                    
                    //slot swap past from copied slot
                    if(ids_temp.length == 1 && '{$swap_copied_slot}' != '' && ids_temp != '{$swap_copied_slot}' && included_non_incomplete_slots && !included_incomplete_slots && !included_candg_slots){
                         options.items.swap_past = { 
                                 "name":"{$translate.swap}", 
                                 accesskey: "{$translate.swap}",
                                 callback: function(key, opt){ 
                                            process_swap_past_with_second_slot(ids);
                                 }
                         };
                     }
                {/if}

                if(ids_temp.length >= 1){
                    // "sep122": "---------",
                    options.items.sep122 = "---------";
                }

                if(ids_temp.length == 1){
                    options.items.find_similar = { 
                                "name":"{$translate.find_similar}", 
                                accesskey: "{$translate.find_similar}",
                                callback: function(key, opt){ 
                                    var selected_id = ids;
                                    var slot_obj = $('.slots_all .slot_time_bar input:checkbox.m_check[value='+ids+']').parents('.slot_time_bar').find('input.slot_details_hub');
                                    var from_time = slot_obj.attr('data-time-from');
                                    var to_time = slot_obj.attr('data-time-to');

                                    $( '.slots_all .slot_time_bar input.slot_details_hub' ).each(function( index ) {
                                        if($(this).attr('data-time-from') == from_time && $(this).attr('data-time-to') == to_time && $(this).attr('data-id') != selected_id){
                                            $(this).parents('.slot_time_bar').find('input:checkbox.m_check').attr('checked', true).trigger('change');
                                        }
                                    });
                                }
                    };
                }

                if(ids_temp.length >= 1){
                    options.items.unmark_all = { 
                                "name":"{$translate.uncheck_all}", 
                                accesskey: "{$translate.uncheck_all}",
                                callback: function(key, opt){ 
                                    $('.slots_all .absolute_div').find('.m_check:checkbox').attr('checked', false).trigger('change');
                                    $('.timeline_control #all_check').attr('checked', false);
                                }
                    };
                }

                return options;
            }
        });

        {if $privileges_gd.add_employee eq 1}
            $('#replace-employee-week-basis #replace_emp_date_from_div, #replace-employee-week-basis #replace_emp_date_to_div').datepicker({ autoclose: true, weekStart: 1, calendarWeeks: true, language: '{$lang}'})
            .on('changeDate', function(ev){
              //console.log(ev.date.valueOf());
              loadEmployeesForReplacement();
            });
        {/if}
    });

    {if $privileges_gd.change_time eq 1}
            function changeEmployeeTime(){
                close_right_panel();
                show_right_panel();
                $('#change_time_of_slots,#slot_creation_main_wraper_group').removeClass('hide');
            } 

            function saveChangetimes(){
                var time_from =  $('#change_time_from').val();
                var time_to   =  $('#change_time_to').val();
                if(time_from > time_to){
                    bootbox.alert('{$translate.fromtime_should_be_lessthan_totime}', function(result){  });
                    return false;
                }
                 var ids_temp = $('.slots_all .absolute_div input:checkbox:checked.m_check.check-box').map(function () {
                    return this.value;
                }).get();

                var data_obj = {
                    'time_from' : time_from, 
                    'time_to' : time_to,
                    'ids': ids_temp.join(','),
                    'action':'change_slot_time',
                }
                $.ajax({
                    url:"{$url_path}ajax_alloc_action_month.php",
                    type:"POST",
                    dataType: 'json',
                    data:data_obj,
                    success:function(data){
                        console.log(data);
                        if(data.result_flag == false){
                            $('#left_message_wraper').html(data.error_message);
                        }
                        else{
                            reload_content();
                        }
                    }
                });

            }           
        {/if}
    
    {if $privileges_gd.add_employee eq 1 or $privileges_gd.add_customer eq 1}
        function changeEmployeeCustomer(process_details_obj, method){
            close_right_panel();
            show_right_panel();
            $("#right_click_action_options, #change-employee-customer-options").removeClass('hide');

            var popup_title = '';
            if(method == 1){
                popup_title = '{$translate.change_employee}';
                $('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val('employee');
            }else if(method == 2){
                popup_title = '{$translate.change_customer}';
                $('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val('customer');
            }else 
                $('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val('');

            $('#right_click_action_options #change-employee-customer-options .panel-title').html(popup_title);
            $('#right_click_action_options #change-employee-customer-options #available_users_for_change').html('');
            $('#right_click_action_options #change-employee-customer-options #slots_to_change_users').val(process_details_obj.ids);

            wrapLoader('#right_click_action_options');
            $.ajax({
                url:"{$url_path}ajax_alloc_action_month.php",
                type:"POST",
                dataType: 'json',
                data:process_details_obj,
                success:function(data_process){
                    //console.log(data_process);
                    var avail_users = [];
                    if(method == 1)
                        avail_users = data_process.avail_employees;
                    else if(method == 2)
                        avail_users = data_process.avail_customers;

                    //console.log(avail_users.length);
                    if(avail_users.length > 0){
                        $.each(avail_users, function(i, value) {
                            $('#right_click_action_options #change-employee-customer-options #available_users_for_change').append('<div class="span12 available_user" style="margin-left: 0px;">\n\
                                            <div class="span12 child-slots" style="margin-top: 4px;">\n\
                                                <label>\n\
                                                    <input type="radio" name="rd_change_user" value="'+value.username+'" class="check-box this_avail_user" />\n\
                                                    <span>'+value.ordered_name+'</span>'+(method == 1 && value.substitute == 1 ? '<span class="pull-right label label-info">{$translate.substitute}</span>' : '')+'\n\
                                                </label>\n\
                                            </div>\n\
                                        </div>');
                        });
                        $('#change-employee-customer-options #btnChangeUserMultiple').removeClass('hide');
                    } else if(typeof data_process.message !== 'undefined'){
                        $('#right_click_action_options #change-employee-customer-options #available_users_for_change').html('<div class="message">'+data_process.message+'</div>');
                        $('#change-employee-customer-options #btnChangeUserMultiple').addClass('hide');
                    }
                },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            })
            .always(function(data) {
                uwrapLoader('#right_click_action_options');
            });
        }

        function saveChangeUserMultiple(){

            var selected_user = $('#change-employee-customer-options #available_users_for_change input:radio:checked.this_avail_user').val(); 
            var selected_slots = $.trim($('#right_click_action_options #change-employee-customer-options #slots_to_change_users').val());
            var change_usertype = $.trim($('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val());

            //console.log(selected_user);

            if(typeof selected_user === 'undefined' || selected_user == '')
                bootbox.alert('{$translate.no_user_selected}', function(result){ });
            else if(selected_slots == '')
                bootbox.alert('{$translate.no_slot_selected}', function(result){ });
            else if(change_usertype == 'employee'){
                wrapLoader('#right_click_action_options');
                $.ajax({
                    url:    "{$url_path}ajax_customers_employees_change.php",
                    type:   "POST",
                    data:   "employee_username="+selected_user+"&ids="+selected_slots+"&action=check_overlap",
                    success:function(data){
                            if(data == 'sucess'){
                                saveChangeUserMultipleConfirm();
                            }else
                                bootbox.alert("{$translate.overlapped} " + data, function(result){ });
                    }
                }).always(function(data) { 
                    uwrapLoader('#right_click_action_options');
                });
            }else if(change_usertype == 'customer')
                saveChangeUserMultipleConfirm();
        }

        function saveChangeUserMultipleConfirm(){
            var selected_user = $('#change-employee-customer-options #available_users_for_change input:radio:checked.this_avail_user').val(); 
            var selected_slots = $.trim($('#right_click_action_options #change-employee-customer-options #slots_to_change_users').val());
            var change_usertype = $.trim($('#right_click_action_options #change-employee-customer-options #change_usertype_to_change_users').val());

            var url = "customer={$customer.userid}&page_date={$cur_date}&method=1&request_from=gd_timeline_customer&ids="+selected_slots;
            if(change_usertype == 'employee') url += "&employee_username="+selected_user;
            else if(change_usertype == 'customer') url += "&customer_select="+selected_user;

            var atl_req_data = url+'&type_check=17&right_click=1';
            var process_url = '{$url_path}ajax_alter_slot_employee_customer.php?'+url;
            check_atl_warning(atl_req_data, function(this_url){
                            close_right_panel();
                            navigatePage(this_url, 1);
                        }, process_url, '#right_click_action_options');
        }
    {/if}

    function copyMonthlySlot(){
        var ids = '';
        var values = $('.slots_all .absolute_div input:checkbox:checked.m_check.check-box').map(function () {
                return this.value;
        }).get();    
        for(var i=0; i < values.length; i++)
            ids += values[i]+'-';

        if(ids != ''){
            var url_data = 'page_date={$selected_date}&customer={$selected_customer}&action=copy_select&slots='+ids;
            // var url_data = 'sel_year={$selected_year}&sel_month={$selected_month}&customer={$selected_customer}&action=copy_select&slots='+ids;
            wrapLoader("#main_content #external_wrapper");
            $.ajax({
                    url: "{$url_path}ajax_slot_process.php",
                    type: "POST",
                    data: url_data,
                    dataType: "json",
                    success:function(data){
                        uwrapLoader("#main_content #external_wrapper");
                    }
            });
        }else
            bootbox.alert('{$translate.select_atleast_one_slot}', function(result){ });
    }

    function pasteSlot(action_type, date, week_year){
        action_type = action_type || 'FALSE';
        date = date || '';
        week_year = week_year || '';
        if(date == ''){
            if(week_year != ''){
                var url = '{$url_path}ajax_slot_process.php?date='+week_year+'&customer={$selected_customer}&emp_alloc={$login_user}&action=paste_select';
                var url_data = 'date='+week_year+'&customer={$selected_customer}&emp_alloc={$login_user}&action=paste_select&type_check=8'
                var atl_req_data = 'date='+week_year+'&customer={$selected_customer}&emp_alloc={$login_user}&action=paste_select&type_check=8';
            }else{
                var year_month = '{$selected_year|cat:'|'|cat:$selected_month}';
                var url = '{$url_path}ajax_slot_process.php?date='+year_month+'&customer={$selected_customer}&emp_alloc={$login_user}&action=paste_select&sub_action=past_in_month'; 
                var url_data = 'date='+year_month+'&customer={$selected_customer}&emp_alloc={$login_user}&action=paste_select&type_check=8&sub_action=past_in_month';
                var atl_req_data = 'date='+year_month+'&customer={$selected_customer}&emp_alloc={$login_user}&action=paste_select&type_check=8&sub_action=past_in_month';
            }
        }
        else{
            var url = '{$url_path}ajax_slot_process.php?date='+date+'&customer={$selected_customer}&emp_alloc={$login_user}&action=paste_select&to_single_day='+action_type; 
            var url_data = 'date='+date+'&customer={$selected_customer}&emp_alloc={$login_user}&action=paste_select&type_check=8&to_single_day='+action_type;
            var atl_req_data = 'date='+date+'&customer={$selected_customer}&emp_alloc={$login_user}&action=paste_select&type_check=8&to_single_day='+action_type;
        }
        check_atl_warning(atl_req_data, function(this_url){ 
                            wrapLoader("#external_wrapper");
                            $('#div_alloc_action').load(this_url,function(response, status, xhr){ 
                                uwrapLoader("#external_wrapper"); 
                                reload_content(); });
                        }, url, "#external_wrapper");
    }
        
    {if $privileges_gd.add_employee eq 1}
        function loadPopupReplaceProcessMain(ids) {
            //loadPopupReplaceProcessMain('{$url_path}gdschema_process_main_4_month.php?year={$selected_year}&month={$selected_month}&customer={$customer.userid}&slot_id='+ids);


            var slot_obj = $('.slots_all .absolute_div input:checkbox:checked.m_check[value='+ids+']').parents('.slot-hover-popup');
            var slot_customer_id = slot_obj.find('input.slot_details_hub').attr('data-customer-id');
            var slot_customer_name = slot_obj.find('input.slot_details_hub').attr('data-customer-name');
            var slot_employee_id = slot_obj.find('input.slot_details_hub').attr('data-employee-id');
            var slot_employee_name = slot_obj.find('input.slot_details_hub').attr('data-employee-name');
            var slot_date = slot_obj.find('input.slot_details_hub').attr('data-date');

            //console.log(slot_obj);

            if(slot_employee_id == '')
                bootbox.alert('{$translate.select_a_non_empty_employee_slot}', function(result){ });
            else{
                close_right_panel();
                $("#right_click_action_options, #replace-employee-week-basis").removeClass('hide');

                $('#replace-employee-week-basis #spn_replacing_employee').html(slot_employee_name);
                $('#replace-employee-week-basis #spn_replace_customer').html(slot_customer_name);
                $('#replace-employee-week-basis #replace_emp_date_from_div').datepicker('update', slot_date);
                $('#replace-employee-week-basis .slot_customer').val(slot_customer_id);
                $('#replace-employee-week-basis .slot_employee').val(slot_employee_id);
                $('#replace-employee-week-basis #replacement_employee_list').html('');
            }
        }

        function loadEmployeesForReplacement() {
            var dfrom = $('#replace-employee-week-basis #replace_emp_date_from').val();
            var dto = $('#replace-employee-week-basis #replace_emp_date_to').val();
            var slot_customer = $('#replace-employee-week-basis .slot_customer').val();
            var slot_employee = $('#replace-employee-week-basis .slot_employee').val();

            var customer_checked = $('#replace-employee-week-basis input:checkbox[name=repl_infocus]:checked').val();
            var is_customer_checked = 0;
            if (customer_checked) is_customer_checked = 1;

            $('#replace-employee-week-basis #replacement_employee_list').html('');
            if(dfrom != '' && dto != ''){

                //&is_customer_checked='+is_customer_checked+'&type=rep_emp_load'
                var process_details_obj = { 'start_date': dfrom,
                                        'end_date': dto,
                                        'selected_emp': slot_employee,
                                        'sel_customer': slot_customer,
                                        'is_customer_checked': is_customer_checked,
                                        'action': 'rep_emp_load'};

                wrapLoader("#replace-employee-week-basis");
                $.ajax({
                    url:"{$url_path}ajax_alloc_action_month.php",
                    type:"POST",
                    dataType: 'json',
                    data:process_details_obj,
                    success:function(data_process){
                        //console.log(data_process);
                        if(data_process.avail_employees.length > 0){
                            $.each(data_process.avail_employees, function(i, value) {
                                //$employee['username'].'">'.$employee['name']
                                $('#replace-employee-week-basis #replacement_employee_list').append('<input type="radio" value="'+value.username+'" name="week_rep_emp_radio" class="week_rep_emp_radio">'+value.ordered_name+'<br>');
                            });
                            $('#replace-employee-week-basis #btnReplaceEmpMultiple').removeClass('hide');
                        } else if(typeof data_process.message !== 'undefined'){
                            $('#replace-employee-week-basis #replacement_employee_list').html('<div class="message">'+data_process.message+'</div>');
                            $('#replace-employee-week-basis #btnReplaceEmpMultiple').addClass('hide');
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                })
                .always(function(data) {
                    uwrapLoader("#replace-employee-week-basis");
                });

            }
        }

        function saveReplaceMultipleConfirm(){

            var dfrom   = $.trim($('#replace-employee-week-basis #replace_emp_date_from').val());
            var dto     = $.trim($('#replace-employee-week-basis #replace_emp_date_to').val());

            var emp_rep = "";
            var emp_rep_values = $('#replace-employee-week-basis input:radio:checked.week_rep_emp_radio').map(function() {
                return this.value;
            }).get();
            if (emp_rep_values.length) emp_rep = emp_rep_values[0];

            if(dfrom == '' || dto == '')
                bootbox.alert('{$translate.please_select_one_date}', function(result){ });
            else if (emp_rep == '') 
                bootbox.alert('{$translate.select_replace_employee}', function(result){ });
            else{
                var in_focus = 0;
                if ($('#replace-employee-week-basis #repl_infocus').attr("checked") == "checked")
                    in_focus = 1;

                var slot_customer = $('#replace-employee-week-basis .slot_customer').val();
                var slot_employee = $('#replace-employee-week-basis .slot_employee').val();

                var process_details_obj = { 'from_date': dfrom,
                                        'to_date': dto,
                                        'employee': slot_employee,
                                        'employee_rep': emp_rep,
                                        'user': slot_customer,
                                        'focus': in_focus,
                                        'request_from': 'gd_timeline_customer',
                                        'type': 'replace'};

                wrapLoader("#replace-employee-week-basis");
                $.ajax({
                    url:"{$url_path}ajax_process_main.php",
                    type:"POST",
                    dataType: 'json',
                    data:process_details_obj,
                    success:function(data_process){
                        //console.log(data_process);
                        if(data_process.result){
                            close_right_panel();
                            reload_content();
                        } else if(typeof data_process.message !== 'undefined'){
                            $('#left_message_wraper').html(data_process.message);
                            $('.main-left').animate({
                                scrollTop: $('#left_message_wraper').offset().top
                            });
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                })
                .always(function(data) {
                    uwrapLoader("#replace-employee-week-basis");
                });
            }
        }
    {/if}
        
    {if $login_user_role eq 1}
        function loadSMSProcessMain(ids){
            close_right_panel();
            show_right_panel();
            $("#right_click_action_options, #sms-for-emp-allocation").removeClass('hide');

            var splitted_ids = ids.split('-');
            var ids_comma_seperated = splitted_ids.join(',');

            $('#sms-for-emp-allocation .slot_ids').val(ids_comma_seperated);
            $('#sms-for-emp-allocation #send_employees_list_sms').html('');

            var process_details_obj = { 'ids': ids,
                                        'action': 'avail_emps_for_sms_allotment'};

            wrapLoader("#sms-for-emp-allocation");
            $.ajax({
                url:"{$url_path}ajax_alloc_action_month.php",
                type:"POST",
                dataType: "json",
                data:process_details_obj,
                success:function(data){
                            //console.log(data)
                            $.each(data.avail_employees, function(i, value) {
                                $('#sms-for-emp-allocation #send_employees_list_sms').append($('<option>').text(value.ordered_name).attr('value', value.username));
                            });

                            if(data.avail_employees.length > 0)
                                $('#sms-for-emp-allocation #btnEmpAllotSMS').removeClass('hide');
                            else
                                $('#sms-for-emp-allocation #btnEmpAllotSMS').addClass('hide');
                        },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            }).always(function(data) {
                uwrapLoader("#sms-for-emp-allocation");
            });
        }

        function sendSmsForAllotment(){
            var slot_id = $("#sms-for-emp-allocation .slot_ids").val();
            var opt_sms_conformation = 0;
            var opt_sms_sender = 0;
            var opt_sms_rejection = 0;
            {if $login_user_role neq 3}
                var rep_emp = $('#sms-for-emp-allocation .send_employees_list_sms[name=send_employees_list_sms]').val();
                if(typeof rep_emp == 'undefined') rep_emp = '';
                sms_emps = $('#sms-for-emp-allocation .send_employees_list_sms').val();

                if($('#sms-for-emp-allocation input:checkbox[name=chk_confirmation_allotment]:checked').prop('checked')){
                    opt_sms_conformation = 1;
                    if($('#sms-for-emp-allocation input:checkbox[name=chk_sender_allotment]:checked').prop('checked'))
                        opt_sms_sender = 1;
                }    
                else {
                    if($('#sms-for-emp-allocation input:checkbox[name=chk_sender_allotment]:checked').prop('checked'))
                        opt_sms_sender = 1;
                    if($('#sms-for-emp-allocation input:checkbox[name=chk_rejection_allotment]:checked').prop('checked'))
                        opt_sms_rejection = 1;    
                }
            {else}
                var rep_emp = '';
            {/if}

            var url_data_obj = { 'slots': slot_id, 'sms_send_employees' : rep_emp,
                     'opt_sms_conformation': opt_sms_conformation, 'opt_sms_sender': opt_sms_sender, 'opt_sms_rejection': opt_sms_rejection, 'request_from': 'gd_timeline_customer' };

            //console.log(url_data_obj);

            wrapLoader("#sms-for-emp-allocation");
            $.ajax({
                url:  '{$url_path}employee_sms_alert_send.php',
                type:"POST",
                dataType: 'json',
                data:$.param(url_data_obj),
                success:function(data_process){
                    //console.log(data_process);
                    close_right_panel();
                    if(typeof data_process.message !== 'undefined'){
                        $('#left_message_wraper').html(data_process.message);
                        $('.main-left').animate({
                            scrollTop: $('#left_message_wraper').offset().top
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            })
            .always(function(data) {
                uwrapLoader("#sms-for-emp-allocation");
            });
        }

        function manageSmsAllotmentConf(){
            if($('#sms-for-emp-allocation input:checkbox[name=chk_confirmation_allotment]:checked').prop('checked')){
                $('#sms-for-emp-allocation input:checkbox[name=chk_rejection_allotment]').attr('disabled', 'disabled');
                $('#sms-for-emp-allocation input:checkbox[name=chk_rejection_allotment]').prop('checked', false);
                $('#sms-for-emp-allocation input:checkbox[name=chk_sender_allotment]').prop('checked', true);
            }else
                $('#sms-for-emp-allocation input:checkbox[name=chk_rejection_allotment]').attr('disabled', false);
        }
    {/if}
    
    {if $privileges_gd.swap eq 1}
        function process_swap_switch_2_slots(ids){
            if(ids != ''){
                var process_details_obj = { 'ids': ids,
                                        'action': 'swap_switch_2_slots'};

                wrapLoader("#main_content #external_wrapper");
                $.ajax({
                    url:"{$url_path}ajax_alloc_action_month.php",
                    type:"POST",
                    dataType: 'json',
                    data:process_details_obj,
                    success:function(data_process){
                        if(data_process.result !== 'undefined' && data_process.result){
                            reload_content();
                        }
                        else if(data_process.message !== undefined && data_process.message != ''){
                            $('#left_message_wraper').html(data_process.message);
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError){
                        alert(thrownError);
                    }
                })
                .always(function(data) {
                    uwrapLoader("#main_content #external_wrapper");
                });
            }
        }
        
        function process_swap_copy_first_slot(ids){
            if(ids != ''){
                var slot_details_obj = { 'id': ids,
                                'action': 'swap'
                    };

                wrapLoader("#main_content #external_wrapper");
                $.ajax({
                    url:"{$url_path}ajax_alloc_action_slot.php",
                    type:"POST",
                    data:slot_details_obj,
                    success:function(data){
                        reload_content();
                    }
                }).always(function(data) { 
                    uwrapLoader("#main_content #external_wrapper");
                });
            }
        }
        
        function process_swap_past_with_second_slot(ids){
            if(ids != ''){
                var slot_data = $('.slots_all #slot_thread_'+ids).find('.slot_details_hub');
                var slot_id         = ids;
                var slot_date       = slot_data.attr('data-date');
                var slot_customer   = slot_data.attr('data-customer-id');
                var slot_employee   = slot_data.attr('data-employee-id');

                var atl_req_data = 'date='+slot_date+'&employee='+slot_employee+'&customer='+slot_customer+
                            '&id='+slot_id+'&action=swap&swap=1&type_check=15';

                var slot_details_obj = 'id='+slot_id+'&date='+slot_date+'&customer='+slot_customer+'&action=swap&swap=1';
                var process_url = '{$url_path}ajax_alloc_action_slot.php?' + slot_details_obj;

                check_atl_warning(atl_req_data, function(this_url){
                                    wrapLoader('#main_content #external_wrapper');
                                    $('#div_alloc_action').load(this_url,function(response, status, xhr){ uwrapLoader('#main_content #external_wrapper'); reload_content(); });
                                }, process_url, '#main_content #external_wrapper');
            }
        }
    {/if}
</script>

<script type="text/javascript">

    $(document).ready(function(){

        $(".main-left").scroll(function(){
              if ($(this).scrollTop() > 0) {
                  $('.full_hdr').addClass('fixed');
                  $('.dayview_chart').css('margin-top','175px');

              } else {
                  $('.full_hdr').removeClass('fixed');
                  $('.dayview_chart').css('margin-top','0px');
              }
        });

        $(".dayview_common").addClass("adjust_width");

        $('.full_hdr').width($('.dayview_common').width());
        $(".absolute_div_for_newslot").draggable( { obstacle: ".absolute_div_for_newslot", preventCollision: true } );

        $('ul.timeline-number li.li_timeline, ul.dayview_time_list li.li_timeline').click(function(){

            var $sort_time = $(this).data('time-from');
            if($.trim($sort_time) != ''){
                sort_employee_slots($sort_time);
            }
        });

        $('.timeline_control #all_check').click(function () {
            $('.slots_all .absolute_div').find('.m_check:checkbox').attr('checked', this.checked).trigger('change');
            //$('.slots_all .absolute_div').find('.m_check:checkbox:not(:checked)').trigger('click');
        });
    });

    $(window).resize(function(){
        $(".full_hdr").width($(".dayview_common").width());
    });

    function split_slot_event() {
            close_right_panel();
            show_right_panel();
            $("#slot_details_main_wraper_group").removeClass('hide');
            $("#slot-wrpr-slots, #slot_action_buttons, #Franvaro-box, #kopierapass-box").addClass('hide');
            $("#slot-dela-pass-close").click(function(){ close_right_panel(); });
            var ids_temp = $('#monthlyviewtbl .monthlyslotview.slot:not(:hidden) input:checkbox:checked.m_check').map(function () {
                return this.value;
            }).get();
            var ids = ids_temp.join('-');
            var included_slots = false;
            var slot_timefrom = null;
            var slot_timeto = null;
            $('#monthlyviewtbl .monthlyslotview.slot:not(:hidden) input:checkbox:checked.m_check' ).each(function( index ) {
                included_slots = true;
                var slot_data = $(this).parents('.slot').find('.slot_details_hub');
                slot_timefrom = $.trim(slot_data.attr('data-time-from'));
                slot_timeto = $.trim(slot_data.attr('data-time-to'));
            });
            $("#split_slot_timefrom").val(slot_timefrom);
            $("#split_slot_timeto").val(slot_timeto);
            $("#this_slot_actual_timefrom").val(slot_timefrom);
            $("#this_slot_actual_timeto").val(slot_timeto);
            //load slot timefrom - timeto as default
            if($("#slot-dela-pass").hasClass('hide')){
                $("#split_slot_timefrom").val(slot_timefrom);
                $("#split_slot_timeto").val(slot_timeto);
            }
            $('#slot_details_main_wraper_group #sdID').val(ids);
            //alert(slot_timefrom);
            $("#slot-dela-pass").toggleClass('hide');
            if(!$("#slot-dela-pass").hasClass('hide')){
                $('.main-right').animate({
                    scrollTop: $('#slot-wrpr-slots').height()+$('.btn-group-slots').height()+40
                });
            }

        }
    
    function show_right_panel(){
            $('#gdmonth_wraper').addClass('show_main_right');
            $('.main-right').removeClass('hide');
            //$(window).resize();

            $(".full_hdr").width($(".dayview_common").width());
        }
        
    function close_right_panel(){
        $('#gdmonth_wraper').removeClass('show_main_right');
        $(".main-right").addClass('hide');

        $(".full_hdr").width($(".dayview_common").width());
        
        $("#slot_creation_main_wraper_group").addClass('hide');
        $("#slot_details_main_wraper_group").addClass('hide');
        $("#right_click_action_options").addClass('hide');
        $(".add-new-slots-month").addClass('hide');
        $("#slot-dela-pass, #Franvaro-box, #kopierapass-box").addClass('hide');
        $("#change-employee-customer-options, #replace-employee-week-basis, #sms-for-emp-allocation, #goto-employees-options, #goto-customers-options,#change_time_of_slots").addClass('hide');
        
    }

    function popupAddSlotMore(){
        $('.add-new-slots-month .create-slotes-panel').prepend(get_slot_add_theme());
        $('.add-new-slots-month .create-slotes-panel .slot_from:first').focus();
    }
    
    function get_slot_add_theme(){
        var slot_theme = '<div class="slot-wrpr span12 time_slots_theme" id="slot-wrpr-month" style="margin-bottom:5px !important;">\n\
                            <div class="close_btn_wrpr pull-right"><button aria-hidden="true" data-dismiss="modal" class="close close-slot-create-theme" title="{$translate.remove_slot}" type="button" onclick="close_slot_template(this);"  tabindex="-1">×</button></div>\n\
                            <div class="span12" style="margin-left: 0px;">\n\
                                <div class="input-prepend">\n\
                                    <span class="add-on  icon-time " title="{$translate.time}"></span>\n\
                                    <input class="form-control span5 custom_slot slot_from time-input-text" id="new_slot_from" name="slot_from" value="" oninput="load_avail_emps_within_period_for_new_slot(this);" placeholder="{$translate.from}" type="text"  style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;"/>\n\
                                    <span class="add-on">{$translate.to}</span>\n\
                                    <input class="form-control span5 custom_slot slot_to time-input-text" id="new_slot_to" name="slot_to" value="" oninput="load_avail_emps_within_period_for_new_slot(this);" placeholder="{$translate.to}" type="text"  style="margin-left: -1px;"/>\n\
                                </div>\n\
                            </div>\n\
                            <div class="span12" style="margin-left: 0px;">\n\
                                <div class="input-prepend span11">\n\
                                    <span class="add-on icon-group" title="{$translate.employee}"></span>\n\
                                    <select id="custom_slot_employee" name="custom_slot_employee" class="form-control custom_slot_employee span12">\n\
                                        <option value="">{$translate.select}</option>\n\
                                    </select>\n\
                                </div>\n\
                            </div> ' ;
                            slot_theme += '<div class="span12" style="margin-left: 0px;">\n\
                                <div class="input-prepend span11">\n\
                                    <span class="add-on icon-star"></span>\n\
                                    <select class="form-control custom_slot_fkkn span12" name="custom_slot_fkkn">\n\
                                        <option {if $customer_details.fkkn eq 1}selected="selected"{/if} value="1">{$translate.fk}</option>\n\
                                        <option {if $customer_details.fkkn neq 1}selected="selected"{/if} value="2">{$translate.kn}</option>\n\
                                        <option value="3">{$translate.tu}</option>\n\
                                    </select>\n\
                                </div>\n\
                            </div> ';
                            slot_theme += '<div class="span12" style="margin-left: 0px;">\n\
                                <div class="input-prepend span11">\n\
                                    <span class="add-on icon-comment" title="{$translate.comment}"></span>\n\
                                    <textarea id="comment_textarea"  class="comment_textarea form-control span12" rows="1" placeholder="{$translate.comment}"></textarea>\n\
                                </div>\n\
                            </div>\n\
                            <ul class="slot-icons slot-icons-day slot-icons-day-small pull-right single-slot-icon-list span12 can_change" style="width: 27px; height: 30px; overflow: hidden;">\n\
                                <li class="slot-icon slot-icon-type-1 slot-icon-small-travel" data-value=1 title="{$translate.travel}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-0 slot-icon-small-normal active" data-value=0 title="{$translate.normal}"></li>\n\
                                <li class="slot-icon slot-icon-type-2 slot-icon-small-break" data-value=2 title="{$translate.break}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-3 slot-icon-small-oncall" data-value=3 title="{$translate.oncall}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-4 slot-icon-small-over-time" data-value=4 title="{$translate.overtime}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-5 slot-icon-small-qualtiy-overtime" data-value=5 title="{$translate.qual_overtime}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-6 slot-icon-small-more-time" data-value=6 title="{$translate.more_time}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-14 slot-icon-small-oncall-moretime" data-value=14 title="{$translate.more_oncall}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-7 slot-icon-small-some-other-time" data-value=7 title="{$translate.some_other_time}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-8 slot-icon-small-training" data-value=8 title="{$translate.training_time}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-9 slot-icon-small-call-training" data-value=9 title="{$translate.call_training}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-10 slot-icon-small-personal-meeting" data-value=10 title="{$translate.personal_meeting}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-11 slot-icon-small-voluntary" data-value=11 title="{$translate.voluntary}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-12 slot-icon-small-complimentary" data-value=12 title="{$translate.complementary}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-13 slot-icon-small-complimentary-oncall" data-value=13 title="{$translate.complementary_oncall}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-15 slot-icon-small-standby" data-value=15 title="{$translate.oncall_standby}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-16 slot-icon-small-dismissal" data-value=16 title="{$translate.work_for_dismissal}" style="display: none;"></li>\n\
                                <li class="slot-icon slot-icon-type-17 slot-icon-small-dismissal-oncall" data-value=17 title="{$translate.work_for_dismissal_oncall}" style="display: none;"></li>\n\
                            </ul>\n\
                        </div>';
            return slot_theme;
    }
</script>
{/block} 