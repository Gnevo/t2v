{block name='style'}
<link rel="stylesheet" href="{$url_path}js/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css" />
<!-- DateTimePicker Plugin -->
<link rel="stylesheet" href="{$url_path}css/scrolltabs.css">
<link href="{$url_path}css/widget-timeline.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{$url_path}css/date-picker.css" />
<!-- DATE PICKER -->
<link rel="stylesheet" href="{$url_path}css/contextMenu.css" type="text/css" />
<link rel="stylesheet" href="{$url_path}css/print.css" type="text/css" />
<style type="text/css">
    .dayview_common {
        float: left;
        width: 85%;
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
        width: 12.48%;
        float: left;
        font-weight: bold;
        height: 90px;
    }

    .dayview_head .cal:nth-child(2) {
        width: 87.4% !important;
    }

    .dayview_head .cal:nth-child(1) {
        border-right: #dcdeea solid 1px;
    }

    .dayview_head span {
        display: none;
    }

    .dayview_timeline {
        width: 100%;
        float: left;
        background: #fad9b8;
    }

    .dayview_time_icon {
        float: left;
        border-right: #dcdeea solid 1px;
        width: 12.48%;
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
        padding: 15px 2%;
        height: 10px;
        margin-bottom: 3px;
    }

    .dayview_employee ul li:nth-child(2n) {
        background: #eaf9fc;
    }

    .dayview_employee ul li a {
        float: left;
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
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
        background-color: #f2c40f;
        height: 40px;
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
        text-align: center;
        margin-right: -10px;
        padding-right: .5%;
        position: fixed;
        right: 0px;
    }

    .dayview_client h2 {
        float: left;
        width: 94%;
        font-size: 19px;
        border-bottom: #ccc solid 1px;
        padding: 8px 3%;
    }

    .dayview_client ul {
        float: left;
        width: 100%;
        //margin-top: 12px !important;
        //margin-bottom: 12px !important;
        max-height: 85%;
        overflow: auto;
        overflow-x: hidden;
    }

    .dayview_client ul li {
        float: left;
        width: 100%;
        margin-bottom: 12px;
        height: 23px;
        padding-top: 8px;
    }

    .dayview_client ul li span {
        float: left;
        width: 65%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        text-align: left;
    }

    .dayview_client ul li i {
        float: right;
        width: 10%;
        font-size: 21px;
        color: #afafaf;
        cursor: pointer;
        margin-top: -2px;
    }

    .dayview_client ul li i:before {
        width: 100%;
        cursor: pointer;
    }

    .dayview_client ul li .client_color {
        width: 10px;
        height: 10px;
        background: #f00;
        border-radius: 100%;
        float: left;
        margin-top: 4px;
        margin-right: 10px;
        margin-left: 6%;
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
        opacity: 0;
    }

    .min_height {
        min-height: 5px !important;
    }

    .dayview_fixed_clientdetails {
        position: fixed;
        top: 49px;
        background: #fff;
        max-width: 330px;
        width: 80%;
        height: 100%;
        border-left: #ccc solid 1px;
        left: 100%;
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
    }

    .dayview_sidesection .date_day {
        width: 90%;
    }

    .width_adj {
        margin: 3% !important;
        width: 94% !important;
        text-align: left !important;
        height: 83vh;
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

    .absolute_div {
        position: absolute;
        z-index: 9;
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

    .absolute_div .slot-hover-popup {
        padding: 3%;
        margin-left: 0px;
    }

    .day_view_style {
        float: left;
        width: 100% !important;
        height: 90px !important;
    }

    .day_view_style .week__view_day {
        width: 100%;
        float: left;
    }

    .day_view_style .week__view_day .week_hd {
        width: 100%;
        float: left;
        height: 32px;
        text-align: center;
        font-size: 13px;
    }

    .day_view_style .week__view_day .full_week {
        float: left;
        width: 100%;
        font-size: 11px;
        margin-bottom: 13px !important;
        margin-top: 5px !important;
    }

    .day_view_style .week__view_day .full_week li {
        float: left;
        text-align: center;
        width: 14.26%;
        border-radius: 5px;
    }

    .day_view_style .week__view_day .full_week li .dayview_dt {
        width: 100%;
        height: 20px;
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
        height: 90px !important;
        left: 2% !important;
    }

    .scroll_tabs_theme_light .scroll_tab_left_button {
        height: 90px;
        width: 2% !important;
    }

    .scroll_tabs_theme_light .scroll_tab_left_button::before {
        content: "\25C0";
        line-height: 90px;
        padding-left: 2px;
    }

    .scroll_tabs_theme_light .scroll_tab_right_button {
        height: 90px;
        width: 2% !important;
    }

    .scroll_tabs_theme_light .scroll_tab_right_button::before {
        content: "\25B6";
        line-height: 90px;
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
        display: none;
    }

    .edit_abs {
        display: block !important;
        float: right;
        cursor: pointer;
        margin-bottom: 5px;
    }

    .edit_abs:before {
        cursor: pointer;
    }

    .cls_abs {
        display: block !important;
        float: right;
        cursor: pointer;
        margin-bottom: 5px;
        margin-right: 8px;
    }

    .cls_abs:before {
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
        margin-top: 32%;
    }

    .client_menu {
        display: none;
    }

    @media only screen and (max-device-width: 480px) {
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
        .dayview_common {
            width: 98% !important
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
            margin-top: 73%;
        }
        .absolute_div {
            position: fixed;
            z-index: 9;
            width: 90%;
            top: 18%;
            display: none;
            left: 5% !important;
        }
        .scroll_tabs_theme_light div.scroll_tab_inner {
            height: 90px !important;
            left: 4% !important;
            font-size: 12px;
        }
        .scroll_tabs_theme_light .scroll_tab_right_button {
            height: 90px;
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
        .absolute_div .slot-hover-popup {
            max-height: 280px;
            overflow-y: auto;
            overflow: auto;
            overflow-x: hidden;
        }
        .absolute_div:before {
            display: none;
        }
        .absolute_div:after {
            display: none;
        }
    }

    @media only screen and (min-device-width: 481px) and (max-device-width: 600px) {
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
        }
        .dayview_common {
            width: 98% !important
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
            margin-top: 73%;
        }
        .absolute_div {
            position: fixed;
            z-index: 9;
            width: 400px;
            top: 25%;
            bottom: 20px;
            margin: 0 0 0 -30%;
            left: 50% !important;
        }
        .scroll_tabs_theme_light div.scroll_tab_inner {
            height: 90px !important;
            left: 3% !important;
        }
        .scroll_tabs_theme_light .scroll_tab_right_button {
            height: 90px;
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
        .absolute_div:before {
            display: none !important;
        }
        .absolute_div:after {
            display: none !important;
        }
    }

    @media only screen and (min-device-width: 601px) and (max-device-width: 768px) {
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
        .dayview_common {
            width: 76% !important
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
        .cal .dayview_btn {
            font-size: 11px;
            width: 34px;
            height: 27px;
            overflow: hidden;
            margin-top: 73%;
        }
        .absolute_div {
            position: fixed;
            z-index: 9;
            width: 400px;
            top: 22%;
            bottom: 20px;
            margin: 0 0 0 -35%;
            left: 50% !important;
        }
        .scroll_tabs_theme_light div.scroll_tab_inner {
            height: 90px !important;
            left: 3% !important;
        }
        .scroll_tabs_theme_light .scroll_tab_right_button {
            height: 90px;
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
        .absolute_div:before {
            display: none !important;
        }
        .absolute_div:after {
            display: none !important;
        }
    }

    @media only screen and (min-device-width: 769px) and (max-device-width: 960px) {
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
        .dayview_common {
            width: 76% !important
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
            height: 90px !important;
            left: 3% !important;
        }
        .scroll_tabs_theme_light .scroll_tab_right_button {
            height: 90px;
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

    .dayview_raw:nth-last-child(-n+3) ul li .absolute_div {
        bottom: 18%;
        top: auto;
    }

    .dayview_raw:nth-last-child(-n+3) ul li .absolute_div:before {
        display: none;
    }

    .dayview_raw:nth-last-child(-n+3) ul li .absolute_div:after {
        display: block;
    }

    .slots_all li:nth-last-child(-n+2) .absolute_div {
        left: auto;
        right: 0px;
    }

    .absolute_div:before {
        display: block;
        content: "";
        width: 0px;
        height: 0px;
        border-left: rgba(255, 0, 0, 0) solid 7px;
        border-bottom: #c1e3d0 solid 10px;
        border-right: rgba(255, 0, 0, 0) solid 7px;
        margin-left: 5px;
        margin-top: -10px;
    }

    .absolute_div:after {
        display: block;
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
    .color_dark i {
        color: #505050 !important;
    }

    .header_day_view {
        float: left;
        width: 100%;
    }

    .fixed_hd {
        position: fixed;
        z-index: 9;
        width: 71%;
    }
</style>
{/block} {block name='script'}
<script async src="{$url_path}js/date-picker.js"></script>
<script async src="{$url_path}js/time_formats.js?v={filemtime('js/time_formats.js')}" type="text/javascript" ></script>
<script async src="{$url_path}js/bootbox.js"></script>
<script async src="{$url_path}js/jQuery.print.js"></script>
<script src="{$url_path}js/jquery.scrolltabs.js"></script>
<script type="text/javascript">
alert('hi');
    $(".absolute_div .edit_abs").click(function() {
        $(this).parents('.slot-hover-popup').find(".editsection").show();
        $(this).parents('.slot-hover-popup').find(".viewsecton").hide();
    });

    $(".slots_all li").click(function(e) {
        $(this).children(".absolute_div").show();
        $('.slots_all li').not(this).find('.absolute_div').hide();
    });

    $(".slots_all #slot-create-cancel").click(function() {
        $(this).parents('.slot-hover-popup').find(".editsection").hide();
        $(this).parents('.slot-hover-popup').find(".viewsecton").show();
    });


    $(".cls_abs").click(function(e) {
        $(this).parents('.absolute_div').hide();
        //$(".slots_all li .absolute_div").hide();
        e.stopPropagation();
    });

    $(".client_menu").click(function() {
        $(".dayview_client").toggleClass("right_zero");
    });



    $(".client_list").mouseover(function() {
        var customer_id = $(this).attr('data-customer');
        $(".slot_time_bar").each(function(){        
            if($(this).attr('data-customer') == customer_id){
                $(this).addClass("color_dark");
            }
        });
        $("this").addClass("color_dark");
    });
    $(".client_list").mouseout(function() {
        var customer_id = $(this).attr('data-customer');
        $(".slot_time_bar").each(function(){        
            if($(this).attr('data-customer') == customer_id){
                $(this).removeClass("color_dark");
            }
        });
        $(this).removeClass("color_dark");     
    });
    $(".slot_time_bar").mouseover(function() {
        //alert("hi");
        var customer_id = $(this).attr('data-customer');
        $(".client_list").each(function(){        
            if($(this).attr('data-customer') == customer_id){
                $(this).addClass("color_dark");
            }
        });
        $(this).addClass("color_dark");
    });
    $(".slot_time_bar").mouseout(function() {
        var customer_id = $(this).attr('data-customer');
        $(".client_list").each(function(){        
            if($(this).attr('data-customer') == customer_id){
                $(this).removeClass("color_dark");
            }
        });
        $(this).removeClass("color_dark");    
    });

    $(".dropdowns dt a").on('click', function() {
        $(".dropdowns dd ul").slideToggle('fast');
    });
    $(".dropdowns dd ul li a").on('click', function() {
        $(".dropdowns dd ul").hide();
    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function(e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("dropdowns")) $(".dropdowns dd ul").hide();
    });

    $(".slot_add_by_cust #slot-create-cancel").click(function() {
        $("#right_panels").css({
            "right": "auto",
            "left": "100%"
        }, 'slow');
    })
    $(".dayview_client ul li.client_list").click(function() {
        var client_full_name = $(this).find('.client_full_name').html();
        var client_uname = $(this).attr('data-customer');
        $("#right_panels").css({
            "right": "0px",
            "left": "auto"
        }, 'slow');
        $('.slot_add_by_cust #add_slot_custname').html(client_full_name);
        $('.slot_add_by_cust .slot_customer').val(client_uname);
    });

    $(document).ready(function() {
        $('#tabs2').scrollTabs({
            scroll_distance: 500,
            //scroll_duration: 1000
        });
        $('.scroll_tab_inner').animate({ scrollLeft: '650px'}, 0);
        
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
        });
        $(document).off('click', ".single-slot-icon-list li.slot-icon").on('click', ".single-slot-icon-list li.slot-icon", function() {
            $(this).parents('.single-slot-icon-list').find(' li.slot-icon').removeClass("active");
            $(this).addClass("active");
        });
        
        $(document).off('click', ".mutliSelect input[type='checkbox']").on('click', ".mutliSelect input[type='checkbox']", function() {

            var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
                data_name = $(this).attr('data-name'),
                title = data_name + ",",
                value = $(this).val();

            if ($(this).is(':checked')) {
                var html = '<span class="multiselect_emps" data-name="' + data_name + '" data-value="' + value + '">' + title + '</span>';
                $('.multiSel').append(html);
                $(".hida").hide();
            } else {
                $('.multiSel span[data-value="' + value + '"]').remove();
                var ret = $(".hida");
                $('.dropdowns dt a').append(ret);

            }
        });

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
    });

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

        //navigatePage('{$url_path}month/gdschema/{$selected_year}/{$selected_month}/{$selected_customer}/{if $rpt_page_url neq ''}{$selected_employee}/{$from_page}/{/if}',1, passing_data_object, true, _fn_callbak);
        navigatePage('{$url_path}gdschema_day.php?date={$selected_date}&year_week={$selected_week}&action=1',1);
    }

    function load_avail_emps_within_period_for_new_slot(this_obj){

                /*console.log(this_obj);
                console.log( $(this_obj).parents('.time_slots_theme').find('.custom_slot_employee'));
                return false;*/
                $(this_obj).parents('.time_slots_theme').find('.custom_slot_employee').html('<ul></ul>');
                $(this_obj).parents('.time_slots_theme').find('.multiSel span.multiselect_emps').remove();
                var selected_customer = $('.slot_add_by_cust .slot_customer').val();
                if($.trim($('.add-new-slots-month .slot_date').val()) != '' && $.trim($(this_obj).parents('.time_slots_theme').find('.slot_from').val()) != '' && $.trim($(this_obj).parents('.time_slots_theme').find('.slot_to').val()) != '' && selected_customer != ''){
                    var slot_date = $.trim($('.add-new-slots-month .slot_date').val());
                    var slot_from = time_to_sixty($.trim($(this_obj).parents('.time_slots_theme').find('.slot_from').val()));
                    var slot_to = time_to_sixty($.trim($(this_obj).parents('.time_slots_theme').find('.slot_to').val()));
                    if(slot_to == 0) slot_to = 24;

                    //get all other slot details
                    var main_obj = { 'selected_date': slot_date,
                                    'selected_customer': selected_customer,
                                    'action': 'multiple_add',
                                    'current_slot': { 'time_from': slot_from, 'time_to': slot_to },
                                    'other_time_slots': [ ] };
                    //console.log(main_obj);

                    //wrapLoader('.time_slots_theme');
                    //wrapLoader($(this_obj).parents('.time_slots_theme'));
                    $.ajax({
                        url:"{$url_path}ajax_get_avail_employees_for_a_period.php",
                        type:"POST",
                        dataType: 'json',
                        data: main_obj,
                        success:function(data){
                            $(this_obj).parents('.time_slots_theme').find('.custom_slot_employee').html('<ul></ul>');
                            $(this_obj).parents('.time_slots_theme').find('.multiSel span.multiselect_emps').remove();
                            $.each(data, function(i, value) {
                                $(this_obj).parents('.time_slots_theme').find('.custom_slot_employee ul').append($('<li><input type="checkbox" value="'+value.username+'" data-name="'+value.ordered_name+'" /> '+value.ordered_name+(value.substitute == 1 ? ' ({$translate.substitute})' : '')+'</li>'));
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
            
    function manEntry(){
        var proceed_flag = true;

        var slot_date = $.trim($('.add-new-slots-month .slot_date').val());
        var selected_customer = $('.slot_add_by_cust .slot_customer').val();
        var have_slots = false;

        $( '.add-new-slots-month .time_slots_theme' ).each(function( index ) {
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

            $( '.add-new-slots-month .time_slots_theme' ).each(function( index ) {

                var tmp_slot_from = time_to_sixty($(this).find('.slot_from').val());
                var tmp_slot_to = time_to_sixty($(this).find('.slot_to').val());
                if(tmp_slot_to == 0) tmp_slot_to = 24;

                if(tmp_slot_from !== false)  $(this).find('.slot_from').val(tmp_slot_from);
                if(tmp_slot_to !== false)    $(this).find('.slot_to').val(tmp_slot_to);

                if(tmp_slot_from !== false && tmp_slot_to !== false){
                    tmp_slot_from = parseFloat(tmp_slot_from);
                    tmp_slot_to = parseFloat(tmp_slot_to);
                    var temp_obj = { 'time_from': tmp_slot_from, 'time_to': tmp_slot_to, 'customer': selected_customer};
                    main_obj['time_slots'].push(temp_obj);
                }
            });

            var flag_employee_slots_collided = false;

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
        var selected_customer = $('.slot_add_by_cust .slot_customer').val();

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
                        'selected_customer': selected_customer,
                        'action': 'man_slot_entry',
                        'sub_action': 'multiple_add',
                        'req_from': 'gd_alloc_window',
                        'gd_page_date': slot_date,
                        'customer': selected_customer,
                        'emp_alloc': '{$login_user}',
                        'saveTimeslot': saveTimeslot_value,
                        'stop_if_any_error': true,
                        'time_slots': [ ] };

        var url_atl = 'date='+slot_date+'&employee=&customer='+selected_customer+'&emp_alloc={$login_user}&action=man_slot_entry&sub_action=multiple_add&type_check=18';
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
        $( '.add-new-slots-month .time_slots_theme' ).each(function( index ) {

            var tmp_slot_from = time_to_sixty($(this).find('.slot_from').val());
            var tmp_slot_to = time_to_sixty($(this).find('.slot_to').val());
            if(tmp_slot_to == 0) tmp_slot_to = 24;

            if(tmp_slot_from !== false && tmp_slot_to !== false){
                tmp_slot_from = parseFloat(tmp_slot_from);
                tmp_slot_to = parseFloat(tmp_slot_to);
                if(tmp_slot_from >= tmp_slot_to) slot_enters_next_day = true;

                //var tmp_slot_employee = $(this).find('.custom_slot_employee').val();
                var tmp_slot_employee = $(this).find('.custom_slot_employees_selected span.multiselect_emps').map(function () {
                        return $(this).attr('data-value');
                    }).get();
                var tmp_slot_employee_string = tmp_slot_employee.join('-');
                var tmp_comment = $.trim($(this).find('.comment_textarea').val());
                var tmp_slot_type = $(this).find('ul.single-slot-icon-list').find('li.active').attr('data-value');

                if(tmp_slot_employee_string != '') need_atl_checking = true;
                if($.inArray( tmp_slot_type, normal_slot_types ) > -1) //check if normal slot type
                    have_normal_slots = true;
                if($.inArray( tmp_slot_type, oncall_slot_types ) > -1) //check if oncall slot type
                    have_oncall_slots = true;

                var temp_obj = { 
                        'time_from': tmp_slot_from, 
                        'time_to': tmp_slot_to, 
                        'employee': tmp_slot_employee,
                        'comment': tmp_comment,
                        'fkkn': 1,
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
        {*console.log(main_obj);*}
        {*return false;*}

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
</script>
{/block} 
{block name="content"}
<div class="row-fluid{if $show_right_panel} show_main_right{/if}" id="gdmonth_wraper">
    {* main-left*}
    <div class="span12 main-left">
        <div id="div_alloc_action" class='hide'></div>
        <div id="left_message_wraper" class="span12" style="min-height: 0px; margin-left: 0;">{$message}</div>
        <div id="schedule_det">
            {if $privileges_general.create_template eq 1 or $privileges_general.use_template eq 1}
            <div class="row-fluid panel-collapse collapse no-print" id="manage-template" style="height: 0px; background:none; ">
                <div class="span12" style="margin-bottom:20px;">
                    <div class="panel-body span12">
                        {if $privileges_general.create_template eq 1}
                        <div style="" class="widget-header span12">
                            <div class="span12">
                                <h1 class="heading-form">{$translate.create_template} :</h1>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12" style="margin: 5px 0px 0px;">
                                <div class="span6 form-left">
                                    <div class="span12" style="margin: 5px 0px 0px;">
                                        <label style="float: left;" class="span12 template_label" for="cmb_save_template_name">{$translate.select_template}</label>
                                        <div style="margin-left: 0px; float: left;" class="input-prepend span11"> <span class="add-on icon-pencil"></span>
                                            <select class="form-control span12" id="cmb_save_template_name" name="cmb_save_template_name">
                                                <option value="">{$translate.new_template}</option>
                                                {foreach $customer_schedules as $schedule}
                                                    <option value="{$schedule.tid}" data-from="{$schedule.from_date}" data-to="{$schedule.to_date}">{$schedule.temp_name|stripslashes}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                    <div style="margin: 0px ! important;" class="span12 spanTemplateSaveNewName">
                                        <label style="float: left;" class="span12 template_label" for="templateSaveNewName">{$translate.template_name}</label>
                                        <div style="margin: 0px; float: left;" class="input-prepend span12">
                                            <span class="add-on icon-pencil"></span>
                                            <input class="form-control span11" name="templateSaveNewName" id="templateSaveNewName" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="span6 form-right">
                                    <div style="margin: 5px 0px ! important;" class="span12">
                                        <label style="float: left;" class="span12 template_label" for="templateSaveFrmDate">{$translate.from}</label>
                                        <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker" id="dpTemplateSaveFrmDate">
                                            <span class="add-on icon-calendar"></span>
                                            <input class="form-control span11" id="templateSaveFrmDate" value="" name="templateSaveFrmDate" type="text" />
                                        </div>
                                    </div>
                                    <div style="margin: 0px ! important;" class="span12">
                                        <label style="float: left;" class="span12 template_label" for="templateSaveToDate">{$translate.to}</label>
                                        <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker" id="dpTemplateSaveToDate">
                                            <span class="add-on icon-calendar"></span>
                                            <input class="form-control span11" id="templateSaveToDate" name="templateSaveToDate" type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group span12" style="margin-left: 0px">
                                    <button type="button" class="btn btn-success" style="margin:10px 0 0 0 !important " onclick="saveSchedule();"> {$translate.save_template}</button>
                                </div>
                            </div>
                        </div>
                        {/if} 
                        {if $privileges_general.use_template eq 1}
                        <div class="row-fluid" style="margin-top:15px">
                            <div class="widget-header span12">
                                <div class="span12">
                                    <h1>{$translate.preview_template} :</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6 form-left">
                                <div class="span12" style="margin: 5px 0px 0px;">
                                    <label style="float: left;" class="span12 template_label" for="cmb_template_name">{$translate.select_template}</label>
                                    <div style="margin-left: 0px; float: left;padding: 0px;" class="input-prepend span11">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control span12" id="cmb_template_name" name="cmb_template_name">
                                            <option value="">{$translate.select_template}</option>
                                            {foreach $customer_schedules as $schedule}
                                            <option value="{$schedule.tid}">{$schedule.temp_name|stripslashes}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                </div>
                                <div style="margin: 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12 template_label" for="templatePrvStartDate">{$translate.copy_start_date}</label>
                                    <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend date hasDatepicker span12 datepicker" id="dpTemplatePrvStartDate">
                                        <span class="add-on icon-calendar"></span>
                                        <input class="form-control span11" id="templatePrvStartDate" name="templatePrvStartDate" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="span6 form-right">
                                <div style="margin: 5px 0px ! important;" class="span12">
                                    <label style="float: left;" class="span12 template_label" for="cmb_no_of_times">{$translate.no_of_times}</label>
                                    <div style="margin: 0px; float: left;padding: 0px;" class="input-prepend span11">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control span12" id="cmb_no_of_times" name="cmb_no_of_times">
                                            {for $mIndex=1 to 5}
                                            <option value="{$mIndex}">{$mIndex}</option>
                                            {/for}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group span12" style="margin-left: 0px;">
                                <button type="button" class="btn btn-success" style="margin:10px 0 0 0 !important " onclick="applySchedule()"> {$translate.preview}</button>
                            </div>
                        </div>
                        {/if}
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            {/if} 
            {if $contract_exist_flag} {*login role = employee not enter to this block*}
            <div class="row-fluid no-print">
                <div class="span12 count-popup" style="display: none; z-index: 10;">
                    {if isset($customer_hours.actual_hours.fk) and isset($customer_hours.actual_hours.kn) and ($customer_hours.actual_hours.fk.normal neq '0' or $customer_hours.actual_hours.fk.oncall neq '0' or $customer_hours.actual_hours.kn.normal neq '0' or $customer_hours.actual_hours.kn.oncall neq '0')}
                    <div class="table-responsive">
                        <table class="footable table table-striped table-bordered table-white table-primary" style="margin-bottom: 1px;">
                            <thead>
                                <tr>
                                    <th data-class="expand" class="table-col-center" style=" background:#fff; color:#7C7C7C;">{$translate.contract_monthly_hours}</th>
                                    {if $customer_hours.actual_hours.fk.normal neq '0' or $customer_hours.actual_hours.fk.oncall neq '0'}
                                    <th data-hide="phone,tablet" class="table-col-center" style=" background:#fff; color:#7C7C7C;">{$translate.fk} {$customer_hours.actual_hours.fk.normal}h {if $customer_hours.actual_hours.fk.oncall neq 0}({$customer_hours.actual_hours.fk.oncall}J){/if}</th>
                                    {/if} {if $customer_hours.actual_hours.kn.normal neq '0' or $customer_hours.actual_hours.kn.oncall neq '0'}
                                    <th data-hide="phone,tablet" class="table-col-center" style=" background:#fff; color:#7C7C7C;">{$translate.kn} {$customer_hours.actual_hours.kn.normal}h {if $customer_hours.actual_hours.kn.oncall neq 0}({$customer_hours.actual_hours.kn.oncall}J){/if}</th>
                                    {/if}
                                </tr>
                            </thead>
                        </table>
                    </div>
                    {/if} {if $customer_contract_period_hours.fk|count gt 0 or $customer_contract_period_hours.kn|count gt 0}
                    <div class="table-responsive">
                        <table class="footable table table-striped table-bordered table-white table-primary" style="margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <th data-class="expand" class="table-col-center" style=" background:#fff; color:#7C7C7C;">{$translate.contract_type}</th>
                                    <th data-hide="phone,tablet" class="table-col-center" style=" background:#fff; color:#7C7C7C;">{$translate.contract_period}</th>
                                    <th data-hide="phone,tablet" class="table-col-center" style=" background:#fff; color:#7C7C7C;">{$translate.contract_period_hours}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $customer_contract_period_hours.fk as $period}
                                <tr>
                                    <td class="table-col-center">{$translate.fk}</td>
                                    <td class="table-col-center">{$period.period_from} {$translate.to_time} {$period.period_to}</td>
                                    <td class="table-col-center">{$period.work_hours}h ({$period.contract_hours}h) {if $period.contract_hours - $period.work_hours > 0}(<span style="color: green;">{number_format($period.contract_hours - $period.work_hours, 2)}h</span>) {else if $period.contract_hours - $period.work_hours
                                        < 0}(<span style="color: red;">{number_format($period.contract_hours - $period.work_hours, 2)}h</span>) {/if}
                                    </td>
                                </tr>
                                {/foreach} {foreach $customer_contract_period_hours.kn as $period}
                                <tr>
                                    <td class="table-col-center">{$translate.kn}</td>
                                    <td class="table-col-center">{$period.period_from} {$translate.to_time} {$period.period_to}</td>
                                    <td class="table-col-center">{$period.work_hours}h ({$period.contract_hours}h) {if $period.contract_hours - $period.work_hours > 0}(<span style="color: green;">{number_format($period.contract_hours - $period.work_hours,2)}h</span>) {else if $period.contract_hours - $period.work_hours
                                        < 0}(<span style="color: red;">{number_format($period.contract_hours - $period.work_hours, 2)}h</span>) {/if}
                                    </td>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                    {/if}
                </div>
            </div>
            {/if}
            <div class="row-fluid table-info hide table-info-mobile no-print" id="customer-summery-popup" style="margin-bottom:15px;">
                <div class="panel-body collapse-panel span12">
                    <div class="row-fluid">
                        <h4 class="pull-left" style="font-size:14px !important; ">{$translate.employees_work_summery}</h4>
                        <div class="span1 pull-right">
                            <button id="close-customer-summery-popup" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="table-responsive">
                            <table class="footable table table-striped table-bordered table-white table-primary" style="margin-bottom: 0px;">
                                <thead>
                                    <tr>
                                        <th data-class="expand">{$translate.employee}</th>
                                        <th data-hide="phone,tablet">{$translate.normal}</th>
                                        <th data-hide="phone,tablet">{$translate.oncall}</th>
                                        <th data-hide="phone">{$translate.normal_work_percent}</th>
                                        <th>{$translate.oncall_work_percent}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {foreach $employee_work_summery_array as $summery}
                                    <tr>
                                        <td>{$summery.employee_name}</td>
                                        <td>{$summery.normal}</td>
                                        <td>{$summery.oncall}</td>
                                        <td>{$summery.normal_percentage}%</td>
                                        <td>{$summery.oncall_percentage}%</td>
                                    </tr>
                                    {foreachelse}
                                    <tr>
                                        <td colspan='5' style='text-align:center;'>{$translate.no_data}</td>
                                    </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="row-fluid">
                <div class="span12">
                    <div class="dayview_common">
                        <div class="span12 template-customize-wrpr" style="margin-bottom:10px;">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title clearfix">
                               <div class="pull-left" style="padding:5px;">{$translate.monthly_view}</div>
                                <div class="pull-right no-print">
                                    <ul class="pull-right">
                                        <li onclick="reload_content();"><span class="icon-refresh"></span><a href="javascript:void(0);"><span>{$translate.refresh}</span></a></li>
                                        {if $privileges_general.create_template eq 1 or $privileges_general.use_template eq 1}
                                            <li class="{*clear-margin *}collapsed cursor_hand" id="li_tmplt_btn" data-toggle="collapse" data-parent="#accordion" href="#manage-template" aria-expanded="false" aria-controls="collapseTwo"><span id="spn_tmplt_btn" class="icon-plus cursor_hand"></span><a href="javascript:void(0);"><span>{$translate.manage_template}</span></a></li>
                                        {/if}
                                        {if $rpt_page_url neq ''}<li><span class="icon-arrow-left"></span><a href="{$rpt_page_url}"><span>{if $from_page == 'emp_work_report'}{$translate.back_report}{else if $from_page == 'EMP_ADD'}{$translate.back_employee}{else}{$translate.back_mc_leave}{/if}</span></a></li>{/if}
                                    </ul>
                                </div>
                            </h4>
                                </div>
                            </div>
                        </div>
                        <div class="header_day_view">
                            <div class="dayview_head">
                                <div class="cal">
                                    <button class="dayview_btn"><i class="icon-calendar"></i> {$selected_date}</button>
                                </div>
                                <div class="cal">
                                    <div id="tabs2" class="scroll_tabs_theme_light day_view_style">
                                        {foreach $week_numbers as $week}
                                            <span class="week_no_spn {if $week['id'] == $selected_week}active-week{/if}">
                                             <div class="week__view_day">
                                                 <div class="week_hd" onclick="navigatePage('{$url_path}gdschema_week_consolidated.php?date={$selected_date}&year_week={$week.id}&action=1',1);">{$translate.week} {$week.id}</div>
                                                 <ul class="full_week">
                                                    {foreach $week['week_days'] as $days} 
                                                     <li  {if $days['date'] == $selected_date}class="colorchange"{/if} onclick="navigatePage('{$url_path}gdschema_day.php?date={$days.date}&year_week={$week.id}&action=1',1);">
                                                         <div class="dayview_dt">{$translate[$days['day']]}</div>
                                                         <div class="dayview_dt_mnth">{$days['day_num']} {$translate[$days['month']]}</div>

                                                     </li>
                                                     {/foreach}
                                                     
                                                 </ul>
                                             </div>
                                            </span>
                                        {/foreach}
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="dayview_timeline">
                                <div class="dayview_time_icon"> <i class="icon-time"></i> </div>
                                <div class="dayview_time">
                                    <div class="row-fluid time-count-wrpr">
                                        <div class="span12 min_height">
                                            <ul class="span12 timeline-number dayview_number">
                                                <li><span style="float:left; margin:0;">0</span><span>1</span></li>
                                                <li><span>2</span></li>
                                                <li><span>3</span></li>
                                                <li><span>4</span></li>
                                                <li><span>5</span></li>
                                                <li><span>6</span></li>
                                                <li><span>7</span></li>
                                                <li><span>8</span></li>
                                                <li><span>9</span></li>
                                                <li><span>10</span></li>
                                                <li><span>11</span></li>
                                                <li><span>12</span></li>
                                                <li><span>13</span></li>
                                                <li><span>14</span></li>
                                                <li><span>15</span></li>
                                                <li><span>16</span></li>
                                                <li><span>17</span></li>
                                                <li><span>18</span></li>
                                                <li><span>19</span></li>
                                                <li><span>20</span></li>
                                                <li><span>21</span></li>
                                                <li><span>22</span></li>
                                                <li><span>23</span></li>
                                                <li><span style="margin-right: 0px;">24</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row-fluid time-count-wrpr">
                                        <div class="span12 min-height-15">
                                            <ul class="dayview_time_list span12 timeline ">
                                                <li style="border-left:solid thin #ccc;"></li>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dayview_chart">
                            <div class="dayview_employee">
                                <ul>
                                    {foreach $employee_day_slots as $employee_data}
                                    <li><a href="javascript:void(0);">{$employee_data['name']}</a></li>
                                    {/foreach}
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
                                {foreach $employee_day_slots as $employee_data}
                                    <div class="dayview_raw">
                                        <ul class="slots_all">
                                            {foreach $employee_data['slots'] as $slot_det}
                                                {if $slot_det['slot_difference'] != 0}
                                                    <li style="width:{$slot_det['slot_difference']*4.16}%" class="raw1 opasity_zero"></li>
                                                {/if}
                                                <li data-id="{$slot_det['id']}" data-customer="{$slot_det['customer']}" class="raw1 slot_time_bar" style=" width:{$slot_det.slot_hour*4.16}%; background-color: {$slot_det['customer_color']}">
                                                    <div class="absolute_div">
                                                        <div class="slot-hover-popup span12 slot-theme-complete">
                                                            <i class="icon-pencil edit_abs"></i> 
                                                            <i class="icon-remove cls_abs"></i>
                                                            <div class="viewsecton">
                                                                <ul class="abs_conent">
                                                                    <li><h1>{$slot_det['slot_from']}-{$slot_det['slot_to']} ({$slot_det['slot_hour']})</h1></li>
                                                                    <li><span class="icon-group"></span> {$slot_det['cust_name']}</li>
                                                                    <li><span class="icon-user"></span> {$slot_det['emp_name']}</li>
                                                                    {if $slot_det['comment'] neq ''}<li class="hover-popup-comment"><span class="icon-comment"></span>{$slot_det['comment']}</li>{/if}
                                                                </ul>
                                                                <ul class="slot-icons slot-icons-day slot-icons-day-small pull-right single-slot-icon-list span12 can_change" style="width: 27px; height: 30px; overflow: hidden;">
                                                                    <li class="slot-icon slot-icon-type-{$slot_det['type']} {$slot_det['slot_type_class']} active" data-value="0" title="{$slot_det['slot_type_label']}"></li>
                                                                </ul>
                                                                <ul class="worklist">
                                                                {foreach $customer_works[$slot_det['customer']] as $main_works}
                                                                    {foreach $main_works as $works}                                                      
                                                                        <li>{$works}</li>
                                                                    {/foreach}
                                                                {/foreach}
                                                                </ul>
                                                            </div>
                                                            <div class="editsection">
                                                                <div class="span12" style="margin-left: 0px;">
                                                                    <div class="slot-wrpr span12 time_slots_theme" id="slot-wrpr-month" style="margin-bottom:5px !important;">
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
                                                                                    data-signed='{$slot_det.signed_in}'
                                                                                    data-comment='{$slot_det.comment|escape:'html'}'
                                                                                    />
                                                                        {if $slot_det.status == 2 && $slot_det.signed_in == 0 && $slot_det.tl_flag ==1}
                                                                            <input type="hidden" class="slot_leave_details_hub" 
                                                                                    data-leave-id='{$slot_det.leave_data.id}'
                                                                                    data-leave-group-id='{$slot_det.leave_data.group_id}'
                                                                                    data-leave-status='{$slot_det.leave_data.group_id}'
                                                                                    data-leave-time-from='{$slot_det.leave_data.time_from}'
                                                                                    data-leave-time-to='{$slot_det.leave_data.time_to}'
                                                                                    data-leave-is-exist-relation='{$slot_det.leave_data.is_exist_relation}'
                                                                                    />
                                                                        {/if}
                                                                        <div class="span12" style="margin:0;">
                                                                            <div class="input-prepend date hasDatepicker span11 datepicker" id="slot_details_date" style="padding-left: 0px;">
                                                                                <span class="add-on icon-calendar" title="{$translate.date}"></span>
                                                                                <input class="form-control span12" id="sdDate" value="{$slot_det.date}" placeholder="{$translate.date}" type="text"/>
                                                                            </div>
                                                                        </div>
                                                                        <div class="span12" style="margin-left: 0px;">
                                                                            <div class="input-prepend">
                                                                                <span class="add-on  icon-time " title="{$translate.time}"></span>
                                                                                <input class="form-control span5 custom_slot slot_from time-input-text" id="new_slot_from" name="slot_from" value="{$slot_det.slot_from}" oninput="load_avail_emps_within_period_for_new_slot(this);" placeholder="{$translate.from}" type="text" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;">
                                                                                <span class="add-on"> {$translate.to} </span>
                                                                                <input class="form-control span5 custom_slot slot_to time-input-text" id="new_slot_to" name="slot_to" value="{$slot_det.slot_to}" oninput="load_avail_emps_within_period_for_new_slot(this);" placeholder="{$translate.to}" type="text" style="margin-left: -1px;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="span12" style="margin-left: 0px;">
                                                                            <div class="input-prepend span11">
                                                                                <span class="add-on icon-group" title="{$translate.employee}"></span>
                                                                                <select id="custom_slot_employee" name="custom_slot_employee" class="form-control custom_slot_employee span12">
                                                                                    <option value="">Välj</option>
                                                                                    <option value="">Välj 1</option>
                                                                                    <option value="">Välj 2</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="span12" style="margin-left: 0px;">
                                                                            <div class="input-prepend span11">
                                                                                <span class="add-on icon-comment" title="{$translate.comment}"></span>
                                                                                <textarea class="form-control span12" id="sdComment" rows="1" placeholder="{$translate.comment}">{$slot_det.comment}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <ul class="slot-icons slot-icons-day slot-icons-day-small pull-right single-slot-icon-list span12 can_change" style="width: 27px; height: 30px; overflow: hidden;">
                                                                            <li class="slot-icon slot-icon-type-1 slot-icon-small-travel {if $slot_det.type eq 1}active{/if}" data-value='1' title="{$translate.travel}" {if $slot_det.type neq 1}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-0 slot-icon-small-normal {if $slot_det.type eq 0}active{/if}" data-value='0' title="{$translate.normal}" {if $slot_det.type neq 0}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-2 slot-icon-small-break {if $slot_det.type eq 2}active{/if}" data-value='2' title="{$translate.break}" {if $slot_det.type neq 2}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-3 slot-icon-small-oncall {if $slot_det.type eq 3}active{/if}" data-value='3' title="{$translate.oncall}" {if $slot_det.type neq 3}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-4 slot-icon-small-over-time {if $slot_det.type eq 4}active{/if}" data-value='4' title="{$translate.overtime}" {if $slot_det.type neq 4}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-5 slot-icon-small-qualtiy-overtime {if $slot_det.type eq 5}active{/if}" data-value='5' title="{$translate.qual_overtime}" {if $slot_det.type neq 5}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-6 slot-icon-small-more-time {if $slot_det.type eq 6}active{/if}" data-value='6' title="{$translate.more_time}" {if $slot_det.type neq 6}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-14 slot-icon-small-oncall-moretime {if $slot_det.type eq 14}active{/if}" data-value='14' title="{$translate.more_oncall}" {if $slot_det.type neq 14}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-7 slot-icon-small-some-other-time {if $slot_det.type eq 7}active{/if}" data-value='7' title="{$translate.some_other_time}" {if $slot_det.type neq 7}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-8 slot-icon-small-training {if $slot_det.type eq 8}active{/if}" data-value='8' title="{$translate.training_time}" {if $slot_det.type neq 8}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-9 slot-icon-small-call-training {if $slot_det.type eq 9}active{/if}" data-value='9' title="{$translate.call_training}" {if $slot_det.type neq 9}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-10 slot-icon-small-personal-meeting {if $slot_det.type eq 10}active{/if}" data-value='10' title="{$translate.personal_meeting}" {if $slot_det.type neq 10}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-11 slot-icon-small-voluntary {if $slot_det.type eq 11}active{/if}" data-value='11' title="{$translate.voluntary}" {if $slot_det.type neq 11}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-12 slot-icon-small-complimentary {if $slot_det.type eq 12}active{/if}" data-value='12' title="{$translate.complementary}" {if $slot_det.type neq 12}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-13 slot-icon-small-complimentary-oncall {if $slot_det.type eq 13}active{/if}" data-value='13' title="{$translate.complementary_oncall}" {if $slot_det.type neq 13}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-15 slot-icon-small-standby {if $slot_det.type eq 15}active{/if}" data-value='15' title="{$translate.oncall_standby}" {if $slot_det.type neq 15}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-16 slot-icon-small-dismissal {if $slot_det.type eq 16}active{/if}" data-value='16' title="{$translate.work_for_dismissal}" {if $slot_det.type neq 16}style="display: none;"{/if}></li>
                                                                            <li class="slot-icon slot-icon-type-17 slot-icon-small-dismissal-oncall {if $slot_det.type eq 17}active{/if}" data-value='17' title="{$translate.work_for_dismissal_oncall}" {if $slot_det.type neq 17}style="display: none;"{/if}></li>
                                                                        </ul>
                                                                        <div class="slot-wrpr-buttons button_new">
                                                                            <button type="button" class="btn btn-success span6" onclick="manEntryCopy();"><span class="icon-save"></span> {$translate.save}</button>
                                                                            <button type="button" class="btn btn-danger span6 slot-confirm-buttons" id="slot-create-cancel"><span class="icon-chevron-left"></span> {$translate.cancel}</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            {/foreach}
                                            
                                        </ul>
                                    </div>
                                {/foreach}
                                
                            </div>
                        </div>
                    </div>
                    <div class="dayview_client">
                        <div class="client_menu">
                            <button type="button" class="btn btn-navbar left-collapse-menu">
                                <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                            </button>
                        </div>
                        <h2>Our Clients</h2>
                        <ul class="client_list_wraper">
                            {foreach $customers as $customer}
                                <li class="client_list"  data-customer="{$customer['username']}" style="cursor: pointer;">
                                    <div class="client_color client_block" style="background-color: {$customer['color']}"></div> 
                                    <span class="client_full_name">{if $sort_by_name == 1}{$customer['first_name']} {$customer['last_name']}{else}{$customer['last_name']} {$customer['first_name']}{/if}</span> 
                                    <i class="icon-angle-right"></i> 
                                </li>                                
                            {/foreach}
                                
                        </ul>
                       
                        <div id="right_panels_wraper">
                            {* slot add by cust*}
                            <div class="dayview_fixed_clientdetails slot_add_by_cust" id="right_panels">
                                <div id="btnGroupStickyPanel" class="span12" style="">
                                    <div class="client_side_head"><h2 id="add_slot_custname">Client name</h2></div>
                                </div>
                                <div class="slot-wrpr-buttons button_new">
                                    <button type="button" class="btn btn-success span6" onclick="manEntry();"><span class="icon-save"></span> {$translate.save}</button>
                                    <button type="button" class="btn btn-danger span6 slot-confirm-buttons" id="slot-create-cancel"><span class="icon-chevron-left"></span> {$translate.cancel}</button>
                                </div>
                                <div class="width_adj">
                                    <div class="add-new-slots-month clearfix dayview_sidesection ">
                                        <div style="margin-top: 0px; margin-bottom: 5px ! important; " class="row-fluid">
                                            <div class="widget-body" style="padding:5px;">
                                                <div class="span12" style="margin-left: 0px;">
                                                    <ul class="worklist">
                                                        <li>Work 1</li>
                                                        <li>Work 2</li>
                                                        <li>Work 3</li>
                                                        <li>Work 4</li>
                                                        <li>Work 5</li>
                                                        <li>Work 6</li>
                                                        <li>Work 7</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span12" style="margin-left: 0px;">
                                            <div class="slot-wrpr span12 time_slots_theme" id="slot-wrpr-month" style="margin-bottom:5px !important;">
                                                {*<div class="close_btn_wrpr pull-right">
                                                    <button aria-hidden="true" data-dismiss="modal" class="close close-slot-create-theme" title="remove slot" type="button" onclick="close_slot_template(this);" tabindex="-1">×</button>
                                                </div>*}
                                                <input class="slot_customer" id="slot_customer" type="hidden" value="" />
                                                <div class="span12" style="margin-left: 0px;">
                                                    <div class="input-prepend date hasDatepicker datepicker date_day no-padding" id="dtPickerNewSlotDate">
                                                        <span class="add-on icon-calendar"></span>
                                                        <input class="form-control span12 slot_date" id="new_slot_date" value="{$selected_date}" placeholder="{$translate.date}" onblur="load_avail_emps_within_period_for_new_slot(this);" type="text">
                                                    </div>
                                                </div>
                                                <div class="span12" style="margin-left: 0px;">
                                                    <div class="input-prepend">
                                                        <span class="add-on  icon-time " title="{$translate.time}"></span>
                                                        <input class="form-control span5 custom_slot slot_from time-input-text" id="new_slot_from" name="slot_from" value="" oninput="load_avail_emps_within_period_for_new_slot(this);" placeholder="Från" type="text" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;">
                                                        <span class="add-on"> {$translate.to} </span>
                                                        <input class="form-control span5 custom_slot slot_to time-input-text" id="new_slot_to" name="slot_to" value="" oninput="load_avail_emps_within_period_for_new_slot(this);" placeholder=" till " type="text" style="margin-left: -1px;">
                                                    </div>
                                                </div>
                                                <div class="span12" style="margin-left: 0px;">
                                                    <div class="input-prepend span11">
                                                        <span class="add-on icon-group"></span>
                                                        <dl class="dropdowns">
                                                            <dt>
                                                                <a href="javascript:void(0);">
                                                                    <span class="hida">{$translate.select_employee}</span>
                                                                    <p class="multiSel custom_slot_employees_selected"></p>
                                                                </a>
                                                            </dt>
                                                            <dd>
                                                                <div class="mutliSelect custom_slot_employee">
                                                                    <ul>
    {*                                                                    <li><input type="checkbox" value="A" data-name="Apple" /> Apple</li>*}
                                                                    </ul>
                                                                </div>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="span12" style="margin-left: 0px;">
                                                    <div class="input-prepend span11">
                                                        <span class="add-on icon-comment" title="{$translate.comment}"></span>
                                                        <textarea id="comment_textarea"  class="comment_textarea form-control span12" rows="1" placeholder="{$translate.comment}"></textarea>
                                                    </div>
                                                </div>
                                                <ul class="slot-icons slot-icons-day slot-icons-day-small pull-right single-slot-icon-list span12 can_change" style="width: 27px; height: 30px; overflow: hidden; margin-bottom: 0px ! important; margin-top: 0px ! important;">
                                                    <li class="slot-icon slot-icon-type-1 slot-icon-small-travel" data-value="1" title="{$translate.travel}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-0 slot-icon-small-normal active" data-value="0" title="{$translate.normal}"></li>
                                                    <li class="slot-icon slot-icon-type-2 slot-icon-small-break" data-value="2" title="{$translate.break}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-3 slot-icon-small-oncall" data-value="3" title="{$translate.oncall}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-4 slot-icon-small-over-time" data-value="4" title="{$translate.overtime}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-5 slot-icon-small-qualtiy-overtime" data-value="5" title="{$translate.qual_overtime}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-6 slot-icon-small-more-time" data-value="6" title="{$translate.more_time}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-14 slot-icon-small-oncall-moretime" data-value="14" title="{$translate.more_oncall}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-7 slot-icon-small-some-other-time" data-value="7" title="{$translate.some_other_time}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-8 slot-icon-small-training" data-value="8" title="{$translate.training_time}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-9 slot-icon-small-call-training" data-value="9" title="{$translate.call_training}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-10 slot-icon-small-personal-meeting" data-value="10" title="{$translate.personal_meeting}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-11 slot-icon-small-voluntary" data-value="11" title="{$translate.voluntary}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-12 slot-icon-small-complimentary" data-value="12" title="{$translate.complementary}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-13 slot-icon-small-complimentary-oncall" data-value="13" title="{$translate.complementary_oncall}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-15 slot-icon-small-standby" data-value="15" title="{$translate.oncall_standby}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-16 slot-icon-small-dismissal" data-value="16" title="{$translate.work_for_dismissal}" style="display: none;"></li>
                                                    <li class="slot-icon slot-icon-type-17 slot-icon-small-dismissal-oncall" data-value="17" title="{$translate.work_for_dismissal_oncall}" style="display: none;"></li>
                                                </ul>
                                            </div>
                                        </div>
                                        {*<div class="span12" style="margin-left: 0px;">
                                            <button class="dayview_btn" style="float: right;"><i class="icon-plus"></i>Add Task</button>
                                        </div>*}
                                        <br>
                                        <span class="span12 no-min-height  no-ml" style="margin-top:5px;"><input class="pull-left" style="margin-right:10px !important;" type="checkbox" name="check_created_slot_copy_to_weeks" id="check_created_slot_copy_to_weeks"> <label for="check_created_slot_copy_to_weeks" class="template_label">{$translate.copy_multiple}</label></span>
                                        <div class="span12  mt no-ml  slot-wrpr hide" id="created_slot_copy_to_weeks">
                                            <h1 style="margin:10px 0 10px 0 !important;">{$translate.copy_multiple}</h1>
                                            <div class="span12" style="margin-left: 0px;">
                                                <label class="myCheckbox">
                                                    <input type="checkbox" name="cscm_days" class="cscm_days" value="1" checked="checked" />
                                                    <span> {$translate.monday_first_charecter} </span>
                                                </label>
                                                <label class="myCheckbox">
                                                    <input type="checkbox" name="cscm_days" class="cscm_days" value="2" checked="checked" />
                                                    <span> {$translate.tuesday_first_charecter} </span>
                                                </label>
                                                <label class="myCheckbox">
                                                    <input type="checkbox" name="cscm_days" class="cscm_days" value="3" checked="checked" />
                                                    <span> {$translate.wednesday_first_charecter} </span>
                                                </label>
                                                <label class="myCheckbox">
                                                    <input type="checkbox" name="cscm_days" class="cscm_days" value="4" checked="checked" />
                                                    <span> {$translate.thursday_first_charecter} </span>
                                                </label>
                                                <label class="myCheckbox">
                                                    <input type="checkbox" name="cscm_days" class="cscm_days" value="5" checked="checked" />
                                                    <span> {$translate.friday_first_charecter} </span>
                                                </label>
                                                <label class="myCheckbox">
                                                    <input type="checkbox" name="cscm_days" class="cscm_days" value="6" checked="checked" />
                                                    <span> {$translate.saturday_first_charecter} </span>
                                                </label>
                                                <label class="myCheckbox">
                                                    <input type="checkbox" name="cscm_days" class="cscm_days" value="0" checked="checked" />
                                                    <span> {$translate.sunday_first_charecter} </span>
                                                </label>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <label for="cscm_from_wk">{$translate.copy_from}</label>
                                                </div>
                                                <div class="span4">
                                                    <label for="cscm_from_option">{$translate.interval}</label>
                                                </div>
                                                <div class="span4">
                                                    <label for="cscm_to_wk">{$translate.copy_upto}</label>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span4">
                                                    <div class="input-prepend span11">
                                                        <span class="add-on icon-calendar"></span>
                                                        <select  id="cscm_from_wk" onchange="getAfterDates_for_cscm()" class="form-control wid cscm_frm_wk_selct">
                                                            {section name=week start=1 loop={$no_of_weeks+1} step=1}
                                                                <option value="{$smarty.section.week.index}">{$smarty.section.week.index}</option>
                                                            {/section}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="span4">
                                                    <div class="input-prepend span11">
                                                        <span class="add-on icon-clock"></span>
                                                        <select name="cscm_from_option" id="cscm_from_option" onchange="getAfterDates_for_cscm()" class="form-control wid">
                                                            <option value="0">{$translate.every_week}</option>
                                                            <option value="1">{$translate.every_2}</option>
                                                            <option value="2">{$translate.every_3}</option>
                                                            <option value="3">{$translate.every_4}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="span4">
                                                    <div class="input-prepend span11">
                                                        <span class="add-on icon-calendar"></span>
                                                        <select name="cscm_to_wk" id="cscm_to_wk" class="form-control span12 wid"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="span12 no-ml">
                                            <span class="span12 no-ml" style="margin-top:10px;"><input class="pull-left" style="margin-right:10px !important;" type="checkbox" name="saveTimeslot" id="saveTimeslot"> <label for="saveTimeslot" class="template_label">{$translate.save_timeslot}</label></span>
                                        </div>
                                        {*<div class="span12 btn_adjs">
                                            <button class="dayview_btn"><i class="icon-trash"></i>Delete Client</button>
                                        </div>*}
                                    </div>
                                </div>
                            </div>
                                    
                            {* slot manage options*}
            <div id="slot_details_main_wraper_group" class="hide">
                <div class="slot-wrpr span12" id="slot-wrpr-slots">
                    <input class="this_slot_id" id="sdID" type="hidden" value="" />
                    <input id="this_slot_actual_date" type="hidden" value="" />
                    <input id="this_slot_actual_timefrom" type="hidden" value="" />
                    <input id="this_slot_actual_timeto" type="hidden" value="" />
                    <input id="this_slot_actual_customer" type="hidden" value="" />
                    <input id="this_slot_actual_employee" type="hidden" value="" />
                    <input id="this_slot_actual_employee_name" type="hidden" value="" />
                    <input id="this_slot_actual_fkkn" type="hidden" value="" />
                    <input id="this_slot_actual_type" type="hidden" value="" />
                    <input id="this_slot_leave_id" type="hidden" value="" />
                    <input id="this_slot_leave_status" type="hidden" value="" />
                    <input id="this_slot_leave_group_id" type="hidden" value="" />
                    <input id="this_slot_leave_time_from" type="hidden" value="" />
                    <input id="this_slot_leave_time_to" type="hidden" value="" /> {*
                    <input id="this_tl_flag" type="hidden" value="" />*}
                    <div class="span12" style="margin:0;">
                        <div class="input-prepend date hasDatepicker span11 datepicker" id="slot_details_date" style="padding-left: 0px;">
                            <span class="add-on icon-calendar" title="{$translate.date}"></span>
                            <input class="form-control span12" id="sdDate" placeholder="{$translate.date}" type="text" />
                        </div>
                    </div>
                    <div class="span12" style="margin:0;">
                        <div class="input-prepend">
                            <span class="add-on  icon-time " title="{$translate.time}"></span>
                            <input class="form-control span5 time-input-text" id="sdTFrom" placeholder="{$translate.from}" type="text" oninput="load_avail_emps_within_period(this); load_pm_special_employees_confirm_type();" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; margin-right: -1px;" />
                            <span class="add-on">{$translate.to}</span>
                            <input class="form-control span5 time-input-text" id="sdTTo" placeholder="{$translate.to}" type="text" oninput="load_avail_emps_within_period(this); load_pm_special_employees_confirm_type();" style="margin-left: -1px;" />
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
                            <select class="form-control span12" id="sdFKKN">
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
                            </span> {/if} {if $privileges_gd.add_slot eq 1}
                    <span id="clone_leave_action_btn_group" class="hide">
                                <button class="btn btn-success" type="button" onclick="clone_relation_leave_slot();"><i class="icon-copy icon-large"></i> {$translate.btn_clone_relation}</button>
                            </span> {/if} {if $privileges_mc.leave_approval eq 1 or $privileges_mc.leave_rejection eq 1 or $privileges_mc.leave_edit eq 1}
                    <span id="leave_quick_action_btn_group" class="hide span12 no-ml">
                                {if $privileges_mc.leave_approval == 1}<button class="btn btn-success leave_accept_btn hide" type="button" onclick="update_leave_status(1);"><i class="icon-ok-sign icon-large"></i> {$translate.approve}</button>{/if}
                                {if $privileges_mc.leave_rejection == 1}<button class="btn btn-danger leave_reject_btn hide" type="button" onclick="update_leave_status(2);"><i class="icon-remove-sign icon-large"></i> {$translate.reject}</button>{/if}
                                {if $privileges_mc.leave_edit == 1}
                                    <button class="btn btn-danger leave_cancel_btn hide span5 no-ml" type="button" onclick="cancel_leave_slot();"><i class="icon-remove-sign icon-large"></i> {$translate.cancel_leave}</button>
                                    <button class="btn btn-info leave_edit_btn hide span5" type="button" onclick="edit_leave_slot();"><i class="icon-edit icon-large"></i> {$translate.back_to_work}</button>
                                {/if}
                            </span> {/if} {if $privileges_mc.leave_edit == 1}
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
                                {*
                                <input type="checkbox" class="PM-special-empl-check" name="PM-special-empl-check" value="shkh001">Öranström Sven
                                <br>
                                <input type="checkbox" class="PM-special-empl-check" name="PM-special-empl-check" value="diya001">Åa Divve
                                <br>*}
                            </div>
                            <div class="span12 no-ml hide" id="PM-special-empls-unavails-div">
                                <h4 style="background-color: #feeded;border: 1px solid #e8c6c6;">{$translate.unavailable_employees}</h4>
                                <div class="checkboxes-wrpr" id="PM-special-empls-unavails">
                                    {*Öranström Sven
                                    <br> Åa Divve
                                    <br>*}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slot-wrpr-buttons span12  btn-group btn-group-justified" style="margin:0; margin-top:5px;">
                        <a href="javascript:void(0);" class="btn btn-success" id="btn_slot_details_save" onclick="modify_slot_details()"><i class="icon-save"></i> {$translate.save}</a>
                        <a href="javascript:void(0);" class="btn btn-danger slot-confirm-buttons">X {$translate.cancel}</a>
                    </div>
                </div>
                {if $privileges_gd.leave eq 1 || $privileges_gd.copy_single_slot eq 1 || $privileges_gd.copy_single_slot_option eq 1 || $privileges_gd.swap eq 1 || $privileges_gd.delete_slot eq 1 || $privileges_gd.split_slot eq 1}
                <div class="row-fluid btn-group-slots pull-left" style=" margin: 0 0 15px 0;">
                    <div class="{*slot-wrpr-buttons span12*} span12 widget-body-section input-group btn-set" id="slot_action_buttons">
                        {if $privileges_gd.leave eq 1}
                        <button type="button" class="btn btn-info no-ml span6" id="btn_slot_franvaro" title="{$translate.leave}"><span class="icon-user"></span> {$translate.leave}</button>{/if} {if $privileges_gd.copy_single_slot eq 1}
                        <button type="button" class="btn btn-info no-ml span6" id="btn_slot_copy" title="{$translate.boka_pass_slots_copy}" onclick="copy_single_slot();"><span class="icon-copy"></span> {$translate.copy}</button>{/if} {* {if $privileges_gd.swap eq 1}
                        <button type="button" class="btn btn-info no-ml span6" id="btn_slot_swap_copy" onclick="swap_copy_single_slot();" title="{$translate.boka_pass_swap_slots_copy}"><span class=" icon-paste"></span> {$translate.swap_copy}</button>{/if}*} {* {if $privileges_gd.swap eq 1}
                        <button type="button" class="btn btn-info no-ml span6" id="btn_slot_swap" onclick="swap_past_single_slot();" title="{$translate.boka_pass_swap_slot}"><span class=" icon-paste"></span> {$translate.swap}</button>{/if}*} {if $privileges_gd.delete_slot eq 1}
                        <button type="button" class="btn btn-info no-ml span6" id="btn_slot_delete" onclick="delete_single_slot();" title="{$translate.boka_pass_slots_delete}"><span class="icon-remove"></span> {$translate.delete}</button>{/if} {if $privileges_gd.split_slot eq 1}
                        <button type="button" class="btn btn-info no-ml span6" id="btn_slot_split" title="{$translate.boka_pass_slots_split}"><span class="icon-level-up"></span> {$translate.split}</button>{/if} {if $privileges_gd.copy_single_slot_option eq 1}
                        <button type="button" class="btn btn-info no-ml span6" id="btn_slot_copy_multiple" title="{$translate.boka_pass_slots_copy_weekly}"><span class="icon-level-down"></span> {$translate.copy_multiple}</button>{/if}
                    </div>
                </div>
                {/if} {* leave section starts*} {if $privileges_gd.leave eq 1}
                <div class="row-fluid form-wrpr hide" id="Franvaro-box" style="margin: 0 0 15px 0;">
                    <div class="span12 ">
                        <h1 style="margin: 10px 0px !important;">{$translate.leave}</h1>
                        <input type="hidden" name="leave_type_day" id="leave_type_day" value="2" />
                        <input type="hidden" name="leave_type_val" id="leave_type_val" value="" />
                        <div class="btn-group leave-type">
                            {foreach from=$leave_types key=leave_type_key item=leave_type}
                            <a unselectable="on" href="javascript:void(0);" id="leave_type{$leave_type_key}" class="btn btn-default" name="leave_type" value="{$leave_type_key}" onclick="setLeaveType({$leave_type_key});">{$leave_type}</a> {/foreach}
                        </div>
                        <div id="karense_notify" class="" style="display: none;"></div>
                        <div class="widget widget-tabs widget-tabs-double-2 no-mb" style="margin-top: 9px;">
                            <div class="widget-head">
                                <ul>
                                    <li id="date_time_time" class="active"><a class="glyphicons clock" href="#tabLeaveTimePeriod" data-toggle="tab" onclick="leaveTab('time');"><i></i><span>{$translate.time}</span></a></li>
                                    <li id="date_time_date"><a class="glyphicons calendar" href="#tabLeaveDatePeriod" data-toggle="tab" onclick="leaveTab('date');"><i></i><span>{$translate.date}</span></a></li>
                                </ul>
                            </div>
                            <div class="widget-body">
                                <div class="tab-content">
                                    {* tabLeaveTimePeriod*}
                                    <div id="tabLeaveTimePeriod" class="tab-pane widget-body-regular active clearfix" style="background:#fff;">
                                        <div class="span12" style="margin:0">
                                            <div class="form-group">
                                                <label for="leave_date_day" class="no-mb">{$translate.date}:</label>
                                                <div class="input-prepend date hasDatepicker datepicker no-pt" id="dp_leave_date_day" style="padding-left: 0px;">
                                                    <span class="add-on icon-calendar"></span>
                                                    <input class="form-control span6" name="leave_date_day" id="leave_date_day" value="" placeholder="{$translate.date}" type="text" />
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin: 0px;" class="span12">
                                            <label for="leave_time_from" class='no-mb'>{$translate.time_range}:</label>
                                            <div class="input-prepend">
                                                <span class="add-on  icon-time "></span>
                                                <input class="form-control span5" name="leave_time_from" id="leave_time_from" value="" placeholder="{$translate.from}" type="text" />
                                                <input class="form-control span5" name="leave_time_to" id="leave_time_to" value="" placeholder="{$translate.to}" type="text" />
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
                                        {if $privileges_gd.no_pay_leave eq 1}
                                        <div class="span12 no_pay_sick_check_div  no-min-height mt hide">
                                            <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                <input type="checkbox" name="time_no_pay_sick_check" id="time_no_pay_sick_check" value="1" checked="checked" class="checkbox" style="margin-right: 4px !important;" /> <span style="padding-left: 4px; color: red; font-weight: bold" class="karense_label">{$translate.karense}</span>
                                            </label>
                                        </div>
                                        {/if}
                                    </div>
                                    {* tabLeaveDatePeriod*}
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
                                        {if $privileges_gd.no_pay_leave eq 1}
                                        <div class="span12 no_pay_sick_check_div no-min-height mt hide">
                                            <label style="padding: 0px;" class="checkbox confirmation_slot">
                                                <input type="checkbox" name="date_no_pay_sick_check" id="date_no_pay_sick_check" value="1" checked="checked" class="checkbox" style="margin-right: 4px !important;" /> <span style="padding-left: 4px; color: red; font-weight: bold" class="karense_label">{$translate.karense}</span>
                                            </label>
                                        </div>
                                        {/if}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span12 mt">
                            <label style="float: left;" class="span12 template_label" for="leave_comments">{$translate.comments}:</label>
                            <div class="input-prepend span12" style="margin: 0px;">
                                <span class="add-on icon-comment" title="{$translate.comment}"></span>
                                <textarea class="form-control span11" name="leave_comments" id="leave_comments" rows="1" placeholder="{$translate.comment}"></textarea>
                            </div>
                        </div>
                        <div class="span12 no-ml mt">
                            <button type="button" class="btn btn-success span6" id="btn_save_leave" onclick="saveLeave();"><i class="icon-save"></i> {$translate.save_leave}</button>
                            <button type="button" class="btn btn-danger span6 no-ml" id="Franvaro-box-close">x {$translate.cancel}</button>
                        </div>
                    </div>
                </div>
                {/if} {* slot split starts*} {if $privileges_gd.split_slot eq 1}
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
                {/if} {* copy multiple starts*} {if $privileges_gd.copy_single_slot_option eq 1}
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
                                    <input name="withuser" id="slot_copy_multiple_withuser" class="checkbox" value="radio" type="radio">
                                    <label class="label-option-and-checkbox"> {$translate.with_user} </label>
                                </li>
                            </ol>
                            <!--<label style="padding: 0px;" class="checkbox span6 hide" id="lbl_copy_slot_without_user">
                                        <input name="withuser" id="slot_copy_multiple_withoutuser" class="checkbox" value="radio" type="radio" style="margin-right: 4px !important;"> {$translate.without_user}
                                    </label>-->
                            <ol class="radio-group checkbox no-padding pull-left" id="lbl_copy_slot_without_user">
                                <li>
                                    <input name="withuser" id="slot_copy_multiple_withoutuser" class="checkbox" value="radio" type="radio">
                                    <label class="label-option-and-checkbox"> {$translate.without_user} </label>
                                </li>
                            </ol>
                        </div>
                        <br>
                        <div class="span12" style="margin-left: 0px;">
                            <label class="checkbox checkbox-inline mr no-pl">
                                <input type="checkbox" name="slot_copy_multiple_days" value="1" checked="checked" style="margin-right: 4px !important;"> {$translate.monday_first_charecter}
                            </label>
                            <label class="checkbox checkbox-inline mr no-pl">
                                <input type="checkbox" name="slot_copy_multiple_days" value="2" checked="checked" style="margin-right: 4px !important;"> {$translate.tuesday_first_charecter}
                            </label>
                            <label class="checkbox checkbox-inline mr no-pl">
                                <input type="checkbox" name="slot_copy_multiple_days" value="3" checked="checked" style="margin-right: 4px !important;"> {$translate.wednesday_first_charecter}
                            </label>
                            <label class="checkbox checkbox-inline mr no-pl">
                                <input type="checkbox" name="slot_copy_multiple_days" value="4" checked="checked" style="margin-right: 4px !important;"> {$translate.thursday_first_charecter}
                            </label>
                            <label class="checkbox checkbox-inline mr no-pl">
                                <input type="checkbox" name="slot_copy_multiple_days" value="5" checked="checked" style="margin-right: 4px !important;"> {$translate.friday_first_charecter}
                            </label>
                            <label class="checkbox checkbox-inline mr no-pl">
                                <input type="checkbox" name="slot_copy_multiple_days" value="6" checked="checked" style="margin-right: 4px !important;"> {$translate.saturday_first_charecter}
                            </label>
                            <label class="checkbox checkbox-inline mr no-pl">
                                <input type="checkbox" name="slot_copy_multiple_days" value="0" checked="checked" style="margin-right: 4px !important;"> {$translate.sunday_first_charecter}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {* main-right*}
    <div class="span4 main-right{if !$show_right_panel} hide{/if}" style="margin-top: 8px; padding: 10px;" id="stickyPanelParent">
        {* add slot/memory slot*} {if $privileges_gd.add_slot == 1}
        <div id="slot_creation_main_wraper_group" class="clearfix {if !($show_right_panel and $right_panel eq 'memory_slots')} hide{/if}">
            {* memory slots*}
            <div id="memory-slots">
                <div class="row-fluid">
                    <div class="span12 no-ml">
                        <button type="button" class="btn btn-default-special span12 btn-large" id="create-slot"><span class="icon-level-down"></span> {$translate.click_to_add_new_time_slot}</button>
                    </div>
                </div>
                <div style="margin-top: 5px ! important;margin-bottom: 5px ! important;" class="span12 slots-full-view-body">
                    <div class="row-fluid">
                        <div class="span12">
                            <div style="margin: 0px;" class="input-prepend date hasDatepicker span11 datepicker" id="dp_memslot_throw_date">
                                <span class="add-on icon-calendar"></span>
                                <input class="form-control span12" id="memslot_throw_date" placeholder="{$translate.date}" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid span12 no-ml" id="available_memory_slots">
                        <ol class="memory-slots-list-wrpr">
                            {foreach $memory_slots as $mem_slot}
                            <li class="memory_time">
                                <div class="child-slots" style="padding:2px !important;" {*draggable="true" ondragstart="drag(event)" *}>
                                    <input type="checkbox" name="mem_slot_{$mem_slot.id}" id="mem_slot_{$mem_slot.id}" value="{$mem_slot.time_from|cat:'-'|cat:$mem_slot.time_to|cat:'-'|cat:$mem_slot.type}" class="check-box this_mslot" data-id="{$mem_slot.id}" data-timefrom='{$mem_slot.time_from}' data-timeto='{$mem_slot.time_to}' data-type='{$mem_slot.type}' />
                                    <span style="font-size:8px;">{$mem_slot.time_from|cat:'-'|cat:$mem_slot.time_to} {if $mem_slot.type eq '3'}J{/if}</span>
                                    <span class="glyphicons icon-remove pull-right remove-memory-slot cursor_hand" style="padding-left: 0; font-size: 7px;"></span>
                                </div>
                            </li>
                            {/foreach}
                        </ol>
                    </div>
                </div>
                <div class="row-fluid no-ml">
                    <div class="span12 no-ml">
                        <button type="button" class="btn btn-default-special span12 mb" onclick="multipleMemorySlotAdd();"><span class="icon-plus"></span> {$translate.add_multiple_timeslots}</button>
                        <button type="button" class="btn btn-danger span12 slot-confirm-buttons no-ml"><span class="icon-chevron-left"></span> {$translate.cancel}</button>
                    </div>
                </div>
            </div>
        </div>
        {/if} 
        
        {* right_click_action_options*}
        <div id="right_click_action_options" class="hide">
            {* goto employees*}
            <div id="goto-employees-options" class="span12 hide">
                <div class="span12 panel-heading">
                    <h4 class="panel-title clearfix">{$translate.go_to} {$translate.employee}</h4></div>
                <div class="span12 slots-full-view-body" style="overflow-y: auto; padding-right: 5px !important;">
                    <div id="goto-employees-list" class="row-fluid span12" style="padding-bottom: 8px !important; padding-right: 4px; margin-left: 0;">
                        {foreach $righclick_employees_for_goto AS $empl}
                        <div style="margin-left: 0px;" class="span12">
                            <div style="margin-top: 4px;" class="span12 child-slots">
                                <label onclick="navigatePage('{$url_path}month/gdschema/employee/{$selected_year}/{$selected_month}/{$empl.username}/',1);">
                                    <span>{if $sort_by_name == 1}{$empl.first_name} {$empl.last_name}{elseif $sort_by_name == 2}{$empl.last_name} {$empl.first_name}{/if}</span>
                                </label>
                            </div>
                        </div>
                        {foreachelse}
                        <div style="margin-left: 0px;" class="span12">
                            <div class="message">{$translate.this_customer_have_no_employees}</div>
                        </div>
                        {/foreach}
                    </div>
                </div>
                <div class="slot-wrpr-buttons span12" style="margin:0; margin-top:15px;">
                    <button type="button" class="btn btn-danger span12 slot-confirm-buttons">X {$translate.cancel}</button>
                </div>
            </div>
            {* goto customers*}
            <div id="goto-customers-options" class="span12 hide">
                <div class="span12 panel-heading">
                    <h4 class="panel-title clearfix">{$translate.go_to} {$translate.customer}</h4></div>
                <div class="span12 slots-full-view-body" style="overflow-y: auto; padding-right: 5px !important;">
                    <div id="goto-customers-list" class="row-fluid span12" style="padding-bottom: 8px !important; padding-right: 4px; margin-left: 0;">
                        {foreach $search_customers AS $custl}
                        <div style="margin-left: 0px;" class="span12">
                            <div style="margin-top: 4px;" class="span12 child-slots">
                                <label onclick="navigatePage('{$url_path}month/gdschema/{$selected_year}/{$selected_month}/{$custl.username}/',1);">
                                    <span>{if $sort_by_name == 1}{$custl.first_name} {$custl.last_name}{elseif $sort_by_name == 2}{$custl.last_name} {$custl.first_name}{/if}</span>
                                </label>
                            </div>
                        </div>
                        {foreachelse}
                        <div style="margin-left: 0px;" class="span12">
                            <div class="message">{$translate.no_customer_available}</div>
                        </div>
                        {/foreach}
                    </div>
                </div>
                <div class="slot-wrpr-buttons span12" style="margin:0; margin-top:15px;">
                    <button type="button" class="btn btn-danger span12 slot-confirm-buttons">X {$translate.cancel}</button>
                </div>
            </div>
            {* change employee/customer*} {if $privileges_gd.add_employee eq 1 or $privileges_gd.add_customer eq 1}
            <div id="change-employee-customer-options" class="span12 hide">
                <div class="span12 panel-heading">
                    <h4 class="panel-title clearfix">{$translate.change}</h4></div>
                <div class="span12 slots-full-view-body" style="overflow-y: auto; padding-right: 5px !important;">
                    <input type="hidden" name="slots_to_change_users" id="slots_to_change_users" value="" />
                    <input type="hidden" name="change_usertype_to_change_users" id="change_usertype_to_change_users" value="" />
                    <div id="available_users_for_change" class="row-fluid span12" style="padding-bottom: 8px !important; padding-right: 4px; margin-left: 0;"></div>
                </div>
                <div class="slot-wrpr-buttons span12" style="margin:0; margin-top:15px;">
                    <button type="button" class="btn btn-success span6" id="btnChangeUserMultiple" onclick="saveChangeUserMultiple();"><span class="icon-save"></span> {$translate.save}</button>
                    <button type="button" class="btn btn-danger span6 slot-confirm-buttons">X {$translate.cancel}</button>
                </div>
            </div>
            {/if} {* replace employee*} {if $privileges_gd.add_employee eq 1}
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
                                    <input type="text" placeholder="{$translate.from_date}" id="replace_emp_date_from" name="replace_emp_date_from" {*onblur="loadEmployeesForReplacement();" *} class="form-control span12">
                                </div>
                                <div class="input-prepend date datepicker" id="replace_emp_date_to_div">
                                    <span class="add-on icon-calendar"></span>
                                    <input type="text" placeholder="{$translate.to_date}" id="replace_emp_date_to" name="replace_emp_date_to" {*onblur="loadEmployeesForReplacement();" *} class="form-control span12">
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
            {/if} {* sms section*} {if $login_user_role eq 1}
            <div id="sms-for-emp-allocation" class="manage-form span12 hide">
                <div class="span12">
                    <h4 style="margin-top:20px;font-weight: bold;">{$translate.sms}</h4>
                    <hr>
                    <div class="form-section-highlight">
                        <h4>{$translate.replacement_employee}</h4>
                        <input type="hidden" name="slot_ids" class="slot_ids" value="" />
                        <select multiple="multiple" class="form-control span11 send_employees_list_sms" id="send_employees_list_sms" name="send_employees_list_sms"></select>
                        {*
                        <div id="replacement_employee_list" style="margin-top:0;" class="checkboxes-wrpr"></div>*}
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
