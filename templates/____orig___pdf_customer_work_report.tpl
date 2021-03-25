{block name="style"}
<link href="{$url_path}css/forms_report.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .signing_button{ cursor: pointer; }    
    .sign_personlist .sign_box.bankID{ color: #510080 !important;}
    .box-form span, .box-form .fixed-font { font-size: 13px;}
</style>
{/block}

{block name="script"}
<script src="{$url_path}js/bootbox.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    
    $(window).resize(function(){
        if($(window).height() > 300){
            //$('.main-left').css({ height: $(window).height()-56}); 
            $('.list_contnts').css({ height: $(window).height()-152}); 
        }
        else{
            $('.list_contnts').css({ height: $(window).height()});    
        }
    }).resize();
        
    function getNewEmployees(thisparent){
            var cust_id = thisparent.find("#cust_id").val();
            var year    = thisparent.find("#cmb_year").val();
            var month   = thisparent.find("#cmb_month").val();
            var nk      = thisparent.find("#radio").find("input:checked").val();
            wrapLoader(thisparent);
            $.ajax({
                        async:true,
                        url:"{$url_path}ajax_get_employees_for_customer.php",
                        data:"cid="+cust_id+"&month="+month+"&year="+year+"&nk="+nk,
                        type:"POST",
                        success:function(data){
                                var data = data.split("||||");
                                // thisparent.find(".tidsredov_block .anställd_block").html(data);
                                thisparent.find(".tidsredov_block .anställd_block").html(data[0]);
                                thisparent.find("#error_div").html('');
                                thisparent.find('.signin_delet').attr('data_value','all');

                                if(data[1])
                                    thisparent.find(".fk_form_defaults_block").html(data[1]);

                                uwrapLoader(thisparent);
                        }
            });
    }
    
    $(".listed_details #emp_form .listed_year_month_dv .year").delegate("#cmb_year", "change", function() {
            var thisparent = $(this).parents(".listed_details");
            getNewEmployees(thisparent);
    });

    $(".listed_details #emp_form .listed_year_month_dv .month").delegate("#cmb_month", "change", function() {
            var thisparent = $(this).parents(".listed_details");
            getNewEmployees(thisparent);
    });

    $(".listed_details #emp_form .listed_year_month_dv #radio").delegate("#radio1, #radio3, #radio4", "change", function() {
            var thisparent = $(this).parents(".listed_details");
            getNewEmployees(thisparent);
            var selected_fkkn_val = $(this).val();
            if(selected_fkkn_val == 2 || selected_fkkn_val == 3)
                $(this).parents('.listed_details').find(".fk_copy_print").removeClass('hide');
            else
                $(this).parents('.listed_details').find(".fk_copy_print").addClass('hide');
    });

    $(".list").click(function() {
            var thisparent = $(this).parent().children(".listed_details");
            $(".listed_details").slideUp("slow");
            if (thisparent.css("display") == 'none'){
                thisparent.slideToggle("slow");
                thisparent.find("#error_div").html('');
{*                thisparent.find(".bargaining").first().attr('checked', 'checked');*}
{*                thisparent.find(".agreement_type").first().attr('checked', 'checked');*}
                setTimeout(function(){ getNewEmployees(thisparent); },300);
            }
    });
    
    {if $user_role eq 1 or $general_privileges.employer_signing eq 1}
        $(".listed_details #cmb_employee").die('change');
        $(".listed_details #cmb_employee").live('change', function() {
                var thisparent = $(this).parents('.listed_details');
                var cID     = thisparent.find("#cust_id").val();
                var year    = thisparent.find("#cmb_year").val();
                var month   = thisparent.find("#cmb_month").val();
                var emp     = thisparent.find("#cmb_employee").val();
                var type    = thisparent.find("#radio").find("input:checked").val();
                wrapLoader(thisparent);
                $.ajax({
                            async:true,
                            url:"{$url_path}ajax_employer_signing.php",
                            data:"cid="+cID+"&month="+month+"&year="+year+"&fkkn="+type+"&emp="+emp+"&action=check",
                            type:"POST",
                            success:function(data){
                                    var data = data.split("||||");
                                    thisparent.find(".employee_allassistans_signing").html(data[0]);
                                    thisparent.find(".sign_personlist").html(data[1]);
                                    if(thisparent.find(".not_signed_emp").length)
                                        thisparent.find(".not_signed_emp").remove();
                                    if(thisparent.find(".signed_emp").length)
                                            thisparent.find(".signed_emp").remove();
                                    //thisparent.find(".sign_personlist").insertAfter(data[2]);
                                    $(data[3]).insertAfter(thisparent.find(".sign_personlist"));
                                    $(data[2]).insertAfter(thisparent.find(".sign_personlist"));

                                    if(data[5])
                                        thisparent.find(".fk_form_defaults_block").html(data[5]);
                                    uwrapLoader(thisparent);
                            }
                });
        });

        $(".allassistans_pdf_files .cmb_pdf_files").die('change');
        $(".allassistans_pdf_files .cmb_pdf_files").live('change', function() {
                var file_name = $(this).val().trim();
                if(file_name != ''){
                    window.open("{$url_path}pdf_viewer.php?name="+file_name+'&type=1');
                }
        });
    

        $(".txtbargaining").die('change');
        $(".txtbargaining").live('click', function() {
        //$(".txtbargaining").click(function() {
                $(this).parents('.bargaining_group').find(".otherbargaining").attr('checked', 'checked');
        });

        $(".otherbargaining").die('change');
        $(".otherbargaining").live('click', function() {
        //$(".otherbargaining").click(function() {
                $(this).parents('.bargaining_group').find(".txtbargaining").focus();
        });

        $(".bargaining").die('change');
        $(".bargaining").live('click', function() {
        //$(".bargaining").click(function() {
                $(this).parents('.bargaining_group').find(".txtbargaining").val('');
        });

        $(".signin").die('click');
        $(".signin").live('click', function(e) {
            e.preventDefault();
            var thisparent  = $(this).parents('.listed_details');
            var cID         = thisparent.find("#cust_id").val();
            var year        = thisparent.find("#cmb_year").val();
            var month       = thisparent.find("#cmb_month").val();
            var emp         = thisparent.find("#cmb_employee").val();
            var employer_role = thisparent.find(".employer_role").val();
            var type        = thisparent.find("#radio").find("input:checked").val();
            if (employer_role == ''){
                alert('{$translate.enter_employer_position}');
                thisparent.find(".employer_role").focus();
            }else{
                if($(this).attr("data_mtd") == 'bank_id'){
                    popup = window.open("{$url_path}ajax_employee_signing.php?month="+month+"&year="+year+"&emp="+emp+"&fkkn="+type+"&customer="+cID+"&from_page=employer", 'importwindow', 'width=500, height=500, top=100, left=200, toolbar=1');
                    //popup = window.open("http://www.google.com", 'importwindow', 'width=500, height=200, top=100, left=200, toolbar=1').focus();

                    $(popup.document).ready(function() {

                        $(popup).on('beforeunload', function() {

                            wrapLoader(thisparent);
                            $.ajax({
                                        async:true,
                                        url:"{$url_path}ajax_employer_signing.php",
                                        data:"cid="+cID+"&month="+month+"&year="+year+"&fkkn="+type+"&emp="+emp+"&employer_role="+employer_role+"&action=signing&method=bank_id",
                                        type:"POST",
                                        success:function(data){
                                                var data = data.split("||||");
                                                thisparent.find(".employee_allassistans_signing").html(data[0]);
                                                thisparent.find(".sign_personlist").html(data[1]);
                                                if(thisparent.find(".not_signed_emp").length)
                                                    thisparent.find(".not_signed_emp").remove();
                                                if(thisparent.find(".signed_emp").length)
                                                    thisparent.find(".signed_emp").remove();
                                                //thisparent.find(".sign_personlist").insertAfter(data[2]);
                                                $(data[3]).insertAfter(thisparent.find(".sign_personlist"));
                                                $(data[2]).insertAfter(thisparent.find(".sign_personlist"));

                                                if(data[4]){   
                                                    thisparent.find('#cmb_employee').empty();
                                                    thisparent.find('#cmb_employee').append(data[4]);
                                                }
                                                if(data[5])
                                                    thisparent.find(".fk_form_defaults_block").html(data[5]);

                                                uwrapLoader(thisparent);
                                        }
                            });

                        } );
                    });
                }else{
                    wrapLoader(thisparent);
                    $.ajax({
                                async:true,
                                url:"{$url_path}ajax_employer_signing.php",
                                data:"cid="+cID+"&month="+month+"&year="+year+"&fkkn="+type+"&emp="+emp+"&employer_role="+employer_role+"&action=signing&method=normal",
                                type:"POST",
                                success:function(data){

                                        var data = data.split("||||");
                                        thisparent.find(".employee_allassistans_signing").html(data[0]);
                                        thisparent.find(".sign_personlist").html(data[1]);
                                        if(thisparent.find(".not_signed_emp").length)
                                            thisparent.find(".not_signed_emp").remove();
                                        if(thisparent.find(".signed_emp").length)
                                            thisparent.find(".signed_emp").remove();
                                        //thisparent.find(".sign_personlist").insertAfter(data[2]);
                                        $(data[3]).insertAfter(thisparent.find(".sign_personlist"));
                                        $(data[2]).insertAfter(thisparent.find(".sign_personlist"));

                                        if(data[4]){   
                                            thisparent.find('#cmb_employee').empty();
                                            thisparent.find('#cmb_employee').append(data[4]);
                                        }

                                        if(data[5])
                                            thisparent.find(".fk_form_defaults_block").html(data[5]);
                                        uwrapLoader(thisparent);
                                }
                    });
                }
            }
        });

        $(".employee_allassistans_signing .signin_delet").die('click');
        $(".employee_allassistans_signing .signin_delet").live('click', function() {

            var all_employer = new Array();
            var all_sutl     = new Array();
            var translate    = '';
            var thisparent   = $(this).parents('.listed_details');
            var all_employer_flag = false;
            var all_sutl_flag   = false;


            if($(this).attr('data_value') == 'all'){
                $(thisparent.find("#cmb_employee option")).each(function(index){
                    $(this).attr('data-employer-sign') == undefined || $(this).attr('data-employer-sign') == "" ? '': all_employer.push($(this).attr('data-employer-sign'));
                    $(this).attr('data-sutl-sign') == undefined || $(this).attr('data-sutl-sign') == "" ? '':all_sutl.push($(this).attr('data-sutl-sign'));
                });

                for(var i = 0; i < all_employer.length; i++) {
                    if ('{$login_user}' != all_employer[i] ){
                        var all_employer_flag = true;
                        break;
                    } 
                }

                 for(var i = 0; i < all_sutl.length; i++) {
                    if ('{$login_user}' != all_sutl[i] ){
                        var all_sutl_flag = true;
                        break;
                    } 
                }
                
                if (all_employer_flag == true && all_sutl_flag == true ){
                    translate = '{$translate.sign_changes_on_atleastone_report_and_employer_do_want_to_proceed}';
                }
                else if (all_employer_flag == true && all_sutl_flag == false){
                    translate = '{$translate.sign_changes_on_atleastone_employer_do_want_to_proceed}';
                }
                else if (all_employer_flag == false && all_sutl_flag == true){
                    translate = '{$translate.sign_changes_on_atleastone_report_do_want_to_proceed}';
                }
                else if (all_employer_flag == false && all_sutl_flag == false){
                    translate = '{$translate.do_u_want_delete_atleastone_report}';
                }
            }
            else{
                var sign_employer = $('option:selected', thisparent.find("#cmb_employee")).attr('data-employer-sign');
                var sign_sutl     = $('option:selected', thisparent.find("#cmb_employee")).attr('data-sutl-sign');
                
                if ('{$login_user}' != sign_employer && '{$login_user}' != sign_sutl){
                    translate = '{$translate.sign_changes_on_report_and_employer_do_want_to_proceed}';
                }
                else if ('{$login_user}' != sign_employer && '{$login_user}' == sign_sutl){
                    translate = '{$translate.sign_changes_on_employer_do_want_to_proceed}';
                }
                else if ('{$login_user}' == sign_employer && '{$login_user}' != sign_sutl){
                    translate = '{$translate.sign_changes_on_report_do_want_to_proceed}';
                }
                else if ('{$login_user}' == sign_employer && '{$login_user}' == sign_sutl){
                    translate = '{$translate.do_u_want_delete_report}';
                }
            }

            var this_var = this;
                 bootbox.dialog(translate, [
                        {
                            "label" : "{$translate.no}",
                            "class" : "btn-danger",
                        },
                         {
                            "label" : "{$translate.yes}",
                            "class" : "btn-success",
                            "callback": function() {
                                sign_remove_update(this_var);
                            }
                         }
                  ]);
        });

        function sign_remove_update(this_var){
                
                var thisparent    = $(this_var).parents('.listed_details');
                var cID           = thisparent.find("#cust_id").val();
                var year          = thisparent.find("#cmb_year").val();
                var month         = thisparent.find("#cmb_month").val();
                var emp           = thisparent.find("#cmb_employee").val();
                var type          = thisparent.find("#radio").find("input:checked").val();
                var sign_employer = $('option:selected', thisparent.find("#cmb_employee")).attr('data-employer-sign');
                var sign_sutl     = $('option:selected', thisparent.find("#cmb_employee")).attr('data-sutl-sign');
                
                wrapLoader(thisparent);
                $.ajax({
                            async:true,
                            url:"{$url_path}ajax_employer_signing.php",
                            data:"cid="+cID+"&month="+month+"&year="+year+"&sign_employer="+sign_employer+"&sign_sutl="+sign_sutl+"&fkkn="+type+"&emp="+emp+"&action=remove",
                            type:"POST",
                            success:function(data){
                                    var data = data.split("||||");
                                    thisparent.find(".employee_allassistans_signing").html(data[0]);
                                    thisparent.find(".sign_personlist").html(data[1]);
                                    if(thisparent.find(".not_signed_emp").length)
                                        thisparent.find(".not_signed_emp").remove();
                                    if(thisparent.find(".signed_emp").length)
                                            thisparent.find(".signed_emp").remove();
                                    //thisparent.find(".sign_personlist").insertAfter(data[2]);
                                    $(data[3]).insertAfter(thisparent.find(".sign_personlist"));
                                    $(data[2]).insertAfter(thisparent.find(".sign_personlist"));

                                    if(data[5])
                                        thisparent.find(".fk_form_defaults_block").html(data[5]);

                                    uwrapLoader(thisparent);
                            }
                });
        }

        $(".sign_personlist .sign_box a").die('click');
        $(".sign_personlist .sign_box a").live('click', function() {
                var sign_employer = $(this).attr('data_employer');
                var sign_sutl     = $(this).attr('data_sutl');
                var translate     = '';
                // console.log(sign_employer);
                // console.log(sign_sutl);

                if ('{$login_user}' != sign_employer && '{$login_user}' != sign_sutl){
                    translate = '{$translate.sign_changes_on_report_and_employer_do_want_to_proceed}';
                }
                else if ('{$login_user}' != sign_employer && '{$login_user}' == sign_sutl){
                    translate = '{$translate.sign_changes_on_employer_do_want_to_proceed}';
                }
                else if ('{$login_user}' == sign_employer && '{$login_user}' != sign_sutl){
                    translate = '{$translate.sign_changes_on_report_do_want_to_proceed}';
                }
                else if ('{$login_user}' == sign_employer && '{$login_user}' == sign_sutl){
                    translate = '{$translate.do_u_want_delete_report}';
                }
                var this_var = this;
                     bootbox.dialog(translate, [
                            {
                                "label" : "{$translate.no}",
                                "class" : "btn-danger",
                            },
                             {
                                "label" : "{$translate.yes}",
                                "class" : "btn-success",
                                "callback": function() {
                                    sign_remove_individual(this_var);
                                }
                             }
                      ]);
        });


        function sign_remove_individual(this_var){
            var sel_emp       = $(this_var).attr('data-attrib-emp');
            var sign_employer = $(this_var).attr('data_employer');
            var sign_sutl     = $(this_var).attr('data_sutl');
            var thisparent    = $(this_var).parents('.listed_details');
            var cID           = thisparent.find("#cust_id").val();
            var year          = thisparent.find("#cmb_year").val();
            var month         = thisparent.find("#cmb_month").val();
            var type          = thisparent.find("#radio").find("input:checked").val();

            

            if(sel_emp != ''){
                wrapLoader(thisparent);
                $.ajax({
                            async:true,
                            url:"{$url_path}ajax_employer_signing.php",
                            data:"cid="+cID+"&month="+month+"&year="+year+"&sign_employer="+sign_employer+"&sign_sutl="+sign_sutl+"&fkkn="+type+"&emp="+sel_emp+"&action=remove&remove_type=direct_box",
                            type:"POST",
                            success:function(data){
                                    var data = data.split("||||");
                                    thisparent.find(".employee_allassistans_signing").html(data[0]);
                                    thisparent.find(".sign_personlist").html(data[1]);
                                    if(thisparent.find(".not_signed_emp").length)
                                        thisparent.find(".not_signed_emp").remove();
                                    //thisparent.find(".sign_personlist").insertAfter(data[2]);
                                    if(thisparent.find(".signed_emp").length)
                                        thisparent.find(".signed_emp").remove();
                                    $(data[3]).insertAfter(thisparent.find(".sign_personlist"));
                                    $(data[2]).insertAfter(thisparent.find(".sign_personlist"));
                                    
                                    if(data[5])
                                        thisparent.find(".fk_form_defaults_block").html(data[5]);

                                    uwrapLoader(thisparent);
                            }
                });
            }
        }

        $(".agreement_type_special[name='agreement_type']").die('change');
        $(".agreement_type_special[name='agreement_type']").live('change', function() {
        //$(".agreement_type_special[name='agreement_type']").change(function(){

            var company_name        = '';
            var org_no              = '';
            var this_company_field  = $(this).parents('.agreements_group').find('.agreement_type2_company');
            var this_org_field      = $(this).parents('.agreements_group').find('.agreement_type2_orgno');
            if($(this).val() == 2 && $(this).is(':checked')){
                company_name = this_company_field.attr('data-company');
                org_no = this_org_field.attr('data-org-no');
            }
            /*else{
                company_name        = '';
                org_no              = '';
                var reseted_company = this_company_field.val();
                var reseted_orgno   = this_org_field.val();
                this_company_field.attr('data-company', reseted_company);
                this_org_field.attr('data-org-no', reseted_orgno);
            }*/
            this_company_field.val(company_name);
            this_org_field.val(org_no);
        });
        
        $("input:radio[name='provider_of_pa']").die('change');
        $("input:radio[name='provider_of_pa']").live('change', function() {
        //$("input:radio[name='provider_of_pa']").change(function(){
            if($(this).val() == 2 && $(this).is(':checked')){
                $(this).parents('.agreements_group').find('.agreement_type_special, .agreement_type2_company, .agreement_type2_orgno, #company_cp_name, #company_cp_phone').prop("disabled", false);
            }
            else{
                $(this).parents('.agreements_group').find('.agreement_type_special, .agreement_type2_company, .agreement_type2_orgno, #company_cp_name, #company_cp_phone').prop("disabled", true);
            }
        });
    
    {/if}
});

{if $user_role != 4}
function select_customer(name){
    navigatePage("{$url_path}pdf/report/work/customer/"+name+"/",8)
}
{/if}

function data_existance_check(cur_button, isRealFk){ 
    isRealFk    = typeof isRealFk !== 'undefined' ? isRealFk : true;
    var error   = $(cur_button).parents('.listed_details').find("#error_div");
    error.html('');
    var cID     = $(cur_button).parents('.listed_details').find("#cust_id").val();
    var year    = $(cur_button).parents('.listed_details').find("#cmb_year").val();
    var month   = $(cur_button).parents('.listed_details').find("#cmb_month").val();
    var type    = $(cur_button).parents('.listed_details').find("#radio").find("input:checked").val();
    var emp     = $(cur_button).parents('.listed_details').find("#cmb_employee").val();
     
    var tx      = 0;
    var pflag   = 1;

    if($(cur_button).parents('.listed_details').find("#cmb_employee").attr('disabled') == "disabled"){
            error.html('{$translate.this_customer_have_no_employees}');
            pflag = 0;
            return false;
    }else if(year == ""){
            error.html('{$translate.select_year}');
            pflag = 0;
            return false;
    }else if(month == ""){
            error.html('{$translate.select_month}');
            pflag = 0;
            return false;
    }
    {if $user_role eq 1}
        var bargaining= $(cur_button).parents('.listed_details').find('.bargaining_group').find("input:checked.bargaining").val();
        var provider_of_pa = $(cur_button).parents('.listed_details').find('.agreements_group').find("input:checked.provider_of_pa").val();
        provider_of_pa = typeof provider_of_pa !== 'undefined' ? provider_of_pa : '';

        var agreement_type = '', company_cp_name = '', company_cp_phone = '', agreement_type2_company = '', agreement_type2_orgno = null;
        if(provider_of_pa == 2){
            company_cp_name = ($(cur_button).parents('.listed_details').find('.agreements_group').find("#company_cp_name").val());
            company_cp_phone = ($(cur_button).parents('.listed_details').find('.agreements_group').find("#company_cp_phone").val());

            agreement_type = $(cur_button).parents('.listed_details').find('.agreements_group').find("input[name=agreement_type]:checked").val();
            agreement_type = typeof agreement_type !== 'undefined' ? agreement_type : '';

            agreement_type2_company = (agreement_type == 2) ? ($(cur_button).parents('.listed_details').find('.agreements_group').find(".agreement_type2_company").val()) : null;
            agreement_type2_orgno = (agreement_type == 2) ? ($(cur_button).parents('.listed_details').find('.agreements_group').find(".agreement_type2_orgno").val()) : null;

        }
        
        if(bargaining == '' || typeof bargaining == 'undefined'){
                error.html('{$translate.select_bargaining_type}');
                pflag = 0;
                return false;
        }else if(agreement_type == 2 && agreement_type2_company.trim() == ''){
                error.html('{$translate.enter_employer_name}');
                $(cur_button).parents('.listed_details').find('.agreements_group').find(".agreement_type2_company").focus();
                pflag = 0;
                return false;
        }else if(agreement_type == 2 && agreement_type2_orgno.trim() == ''){
                error.html('{$translate.enter_employer_organization_number}');
                $(cur_button).parents('.listed_details').find('.agreements_group').find(".agreement_type2_orgno").focus();
                pflag = 0;
                return false;
        }
    {/if}
    if(pflag == 1){
        $.ajax({
            async:false,
            url:"{$url_path}ajax_check_exist_employee_work_data.php",
            data:"month="+month+"&year="+year+"&CID="+cID+"&type="+type+"&emp="+emp,
            type:"POST",
            success:function(data){
                    tx=data;
                },
            error:function(jqXHR, textStatus, errorThrown ){
                    {*alert(jqXHR.status); alert(textStatus); alert(errorThrown);*}
                }
        });
        if(tx == 1){
            var sel_action = (isRealFk ? 'ACTUAL-FK' : 'FK-COPY');
            $(cur_button).parents('.listed_details').find("input.action").val(sel_action);
            return true;
        }else{
            error.html('{$translate.no_data_available}');
            return false;
        }
    }
}

function sam_sida(s){
    var error1  = $(s).parents('.listed_details').children("#error_div");
    var error   = $(s).parents('.listed_details').find("#error_div");
    var cID     = $(s).parents('.listed_details').find("#cust_id").val();
    var year    = $(s).parents('.listed_details').find("#cmb_year").val();
    var month   = $(s).parents('.listed_details').find("#cmb_month").val();
    var type    = $(s).parents('.listed_details').find("#radio").find("input:checked.fkkn").val();
    var emp     = $(s).parents('.listed_details').find("#cmb_employee").val();
    
    error1.html('');
    error.html('');
    if($(s).parents('.listed_details').find("#cmb_employee").attr('disabled') == "disabled"){
            error.html('{$translate.this_customer_have_no_employees}');
            return false;
    }else if(year == ""){
        error1.html('{$translate.select_year}');
       return false;
    }else if(month == ""){
        error1.html('select year{$translate.select_month}');
       return false;
    }else{
        {if $user_role eq 1}
            var bargaining = $(s).parents('.listed_details').find('.bargaining_group').find("input:checked.bargaining").val();
            bargaining = typeof bargaining !== 'undefined' ? bargaining : '';
            
            var provider_of_pa = $(s).parents('.listed_details').find('.agreements_group').find("input:checked.provider_of_pa").val();
            provider_of_pa = typeof provider_of_pa !== 'undefined' ? provider_of_pa : '';
            // var provider_of_pa = 2;
            
            var agreement_type = '', company_cp_name = '', company_cp_phone = '', agreement_type2_company = '', agreement_type2_orgno = null;
            if(provider_of_pa == 2){
                company_cp_name = ($(s).parents('.listed_details').find('.agreements_group').find("#company_cp_name").val());
                company_cp_phone = ($(s).parents('.listed_details').find('.agreements_group').find("#company_cp_phone").val());
                
                agreement_type = $(s).parents('.listed_details').find('.agreements_group').find("input[name=agreement_type]:checked").val();
                agreement_type = typeof agreement_type !== 'undefined' ? agreement_type : 1;
                
                agreement_type2_company = (agreement_type == 2) ? ($(s).parents('.listed_details').find('.agreements_group').find(".agreement_type2_company").val()) : null;
                agreement_type2_orgno = (agreement_type == 2) ? ($(s).parents('.listed_details').find('.agreements_group').find(".agreement_type2_orgno").val()) : null;

            }
            
            
            var _this_emp = typeof emp != 'undefined' && emp != '' ? emp : null;
            
            var obj_data = { 'bargaining' : bargaining,
                'provider_of_pa'    : provider_of_pa,
                'company_cp_name'   : company_cp_name,
                'company_cp_phone'  : company_cp_phone,
                'agreement_type'    : agreement_type,
                'agreement_type2_company'   : agreement_type2_company,
                'agreement_type2_orgno'     : agreement_type2_orgno, 
                'customer'  : cID,
                'employee'  : _this_emp,
                'action'    : 'save_params'
            };
            $.ajax({
                        async   : true,
                        url     : "{$url_path}pdf/report/work/customer/summary/",
                        data    : obj_data,
                        type    : "POST",
                        success:function(data){ }
            });
        {/if}
        window.open('{$url_path}pdf/report/work/customer/summary/'+month+'/'+year+'/'+cID+'/'+type+'/'+emp+'/');
    }
}

</script>
{/block}

{block name="content"}
<div id="siteloader"></div>
<div class="row-fluid">
    <div class="span12 main-left" style="overflow:hidden; min-height: 300px;">
        <div class="panel panel-default" style="margin: 5px 0px 0px ! important;">
            <div class="panel-heading" style="">
                <h4 class="panel-title no-mb clearfix" style="border-radius: 0px;">
                    {$translate.customer_employee_monthly_work_report}
                    <ul class="pull-right">
{*                        <li onclick="navigatePage('{$url_path}pdf/report/work/customer/',8);"><span class="icon-refresh"></span><a href="javascript:void(0);"><span>{$translate.refresh}</span></a></li>*}
                        <li><i class="icon-arrow-left"></i><a href="{$url_path}forms/"><span>{$translate.backs}</span></a></li>
                    </ul>
                </h4>
            </div>
        </div>
        <div class="employee_details">
            <div class="employee_print_details">
                {if $user_role != 4}
                    <div class="alpha_selct_dv clearfix">
                        {assign var='alphabets' value=','|explode:$translate.alphabets}
                        <ul>
                            {foreach from=$alphabets item=row}
                                <li><a href="javascript:void(0)" onclick="select_customer('{$row}')">{$row}</a></li>
                            {/foreach}
                        </ul>
                    </div>
                {/if}
                <div class="employee_details_inner clearfix">
                    <div class="list_contnts clearfix" style="overflow:auto;">
                        {foreach from=$customer_details item=list}
                        <div id="employee_block" name="employee_block" style="border:solid 1px #8fc6d3;" class="clearfix"><!--collaps this fold-->
                            <div class="entity_list list clearfix">
                                <div class="listed_employee span3 pull-left "><span class="employee_id">{$list.social_security}</span></div>
                                <span class="employee_name span6">{if $sort_by_name == 1}{$list.first_name} {$list.last_name}{elseif $sort_by_name == 2}{$list.last_name} {$list.first_name}{/if}</span>
                                <div class="listed_employee_addrs span3 pull-right">{$list.city}</div>
                            </div>
                            <div  class="listed_details" style="display:none;height:auto;">
                                <form name="emp_form" id="emp_form" method="post" target="_blank" action="{$url_path}pdf/report/work/customer/">
                                    <input type="hidden" id="cust_id" name="cust_id" value="{$list.username}" />
                                    <div class="tidsredov_block clearfix">
                                        <div class="ar_block clearfix span12">
                                            <div class="span12 no-ml" id="error_div" name="error_div" style="clear: both; text-align: center; padding-right: 12px; color: rgb(187, 86, 19); min-height: 0px;"></div>
                                            <div class="listed_year_month_dv span8 pull-left no-ml" style="min-height: 0px;">
                                                <div class="pull-left year_month span12">
                                                    <div class="year pull-left"> <span class="pull-left">{$translate.year}</span>
                                                        <select style="margin-left:5px;width: auto;" name="cmb_year" id="cmb_year" class="required pull-left">
                                                            <option value="" >{$translate.select_year}</option>
                                                            {html_options values=$year_option_values selected=$report_year output=$year_option_values}
                                                        </select>
                                                    </div>
                                                    <div class="month pull-left"> <span class="pull-left">{$translate.month}</span>
                                                        <select style="margin-left:5px;width: auto;" name="cmb_month" id="cmb_month" class="pull-left">
                                                            <option value="" >{$translate.select_month}</option>
                                                            {html_options values=$month_option_values selected=$report_month output=$month_option_output}
                                                        </select>
                                                    </div>
                                                    <div class="pull-left span6" id="radio" style="">
                                                        <label style="margin-right:5px;"><input type="radio" style="margin-right:4px !important;" {if $list.fkkn == 1}checked="checked"{/if} value="1" name="type" id="radio1" class="fkkn">{$translate.fk}</label>
                                                        <label style="margin-right:5px;"><input type="radio" style="margin-right:4px !important;" {if $list.fkkn == 2}checked="checked"{/if} value="2" name="type" id="radio3" class="fkkn">{$translate.kn}</label>
                                                        <label><input type="radio" style="margin-right:4px !important;" {if $list.fkkn == 3}checked="checked"{/if} value="3" name="type" id="radio4" class="fkkn">{$translate.tu}</label>
                                                        <span id="err_msg" style="color:#FF0000; padding-left: 4px; width: 20px"></span> 
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="employee_print_btn span4 pull-right" style="min-height: 0px;">
                                                <input type="hidden" name="action" class="action" value="" />
                                                <input type="submit" name="button1" id="button1" value="{$translate.print}" class="btn btn-primary pull-right ml " onclick="return data_existance_check(this, true)">
                                                <input type="submit" name="button3" id="button3" value="{$translate.btn_fk_copy_print}" class="btn btn-primary pull-right fk_copy_print {if $list.fkkn == 1}hide{/if}" onclick="return data_existance_check(this, false)">
                                                <input type="button" name="button2" id="button2" value="{$translate.fkkn_summery_label}" class="btn btn-primary pull-right " onclick="return sam_sida(this)">
                                            </div>
                                        </div>
                                        <div class="anställd_block span12 no-ml">
                                            <div class="employee_allassistans_div employee_allassistans span12 no-ml">
                                                <div style="float:left;">
                                                    <label class="employee_allassistans_label">{$translate.fkkn_employee}</label>
                                                    <select disabled="disabled" class="list_detail_assistance" id="cmb_employee" name="cmb_employee"> 
                                                        <option value="">{$translate.all_assistents}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            {if $user_role eq 1 or ($general_privileges.employer_signing eq 1 and $list.superAccess eq true)}
                                                <div class="employee_allassistans_signing span12 no-ml mb no-min-height"></div>
                                                <div id="not_signed_emp" name="not_signed_emp" class="not_signed_emp span12 no-ml no-min-height"></div>
                                            {/if}
                                        </div>
                                    </div>
                                    {if $user_role eq 1 or ($general_privileges.employer_signing eq 1 and $list.superAccess eq true)}
                                        <div class="fk_form_defaults_block">
                                            <div style="padding-bottom:10px; margin-top:4px;"  class="bargaining_group">
                                                <div style="padding:7px 6px 7px 8px; font-size:13px; font-weight:bold; margin-bottom:5px; color:#666666;">3. Omfattas assistenten av kollektivavtal?</div>
                                                <div style="border:solid 1px #b8b7b7; margin:0px 7px; padding-bottom:10px;">
                                                    <table style="margin:0px 7px; font-family:Arial, Helvetica, sans-serif; font-size:12px;" width="100%" border="0" cellpadding="0" cellspacing="0">
                                                        <tr><td height="30">Omfattas assistenten av kollektivavtal?</td></tr>
                                                        <tr>
                                                            <td width="11%" height="30">
                                                                <span style="margin-right:10px;" class='pull-left'>
                                                                    <label>
                                                                        <input type="radio" {if (!empty($list.defaults) and $list.defaults.bargaining_new eq 1) or empty($list.defaults)}checked="checked"{/if} value="1" name="bargaining" class="bargaining" style="margin-right:2px;">&nbsp;Ja
                                                                    </label>
                                                                </span>
                                                                <span style="margin-right:10px;" class='pull-left'>
                                                                    <label>
                                                                        <input type="radio" {if !empty($list.defaults) and $list.defaults.bargaining_new eq 2}checked="checked"{/if} value="2" name="bargaining" class="bargaining" style="margin-right:2px;">&nbsp;Nej
                                                                    </label>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="agreements_group clearfix" style="background-color:#f6f9f9; margin:6px 0;">
                                                <div style="padding:7px 6px 7px 8px; font-size:13px; font-weight:bold; margin-bottom:5px; color:#666666;">{*7. Uppgifter om anordnaren*}5. Anordnaren av personlig assistans </div>
                                                <div style="border: 1px solid rgb(184, 183, 183); margin: 0px 7px;">
                                                    <div class="box-form" style="margin: 9px 7px;">
                                                        <div class="row-fluid">
                                                            <div class="span12">
                                                                <label style="margin-left: 5px;" class="pull-left no-ml">
                                                                    <input type="radio" class="provider_of_pa radio pull-left" name="provider_of_pa" value="1" {if (!empty($list.defaults) and $list.defaults.provider_of_pa_flag eq 1)}checked="checked"{/if}/>&nbsp;
                                                                    Jag har själv anställt assistenten (Fyll inte i något mer under den här punkten)
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div class="span4">
                                                                <label style="margin-left: 5px;" class="pull-left no-ml">
                                                                    <input type="radio" class="provider_of_pa radio pull-left" name="provider_of_pa" value="2" {if (!empty($list.defaults) and $list.defaults.provider_of_pa_flag eq 2) or empty($list.defaults)}checked="checked"{/if}/>&nbsp;
                                                                    Personen anlitar en assistans-anordnare
                                                                </label>
                                                            </div>
                                                            <div class="span8">{* span12 *}
                                                                <div class="row-fluid">
                                                                    <div class="span8">
                                                                        <div style="" class="span12">
                                                                            <label style="float: left;" class="span12 no-min-height">Namn på anordnaren</label>
                                                                            <div class="span12 fixed-font" style="margin: 0px;"><strong>{$company_data.name}</strong></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span4">
                                                                        <div style="" class="span12">
                                                                            <label style="float: left;" class="span12 no-min-height">Organisationsnummer</label>
                                                                            <div style="margin: 0px;" class="span12 fixed-font"><strong>{$company_data.org_no}</strong></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row-fluid">
                                                                    <div class="span8">
                                                                        <div style="margin: 0px 0px 10px;" class="span12">
                                                                            <label style="float: left;" class="span12 no-min-height" for="company_cp_name">Kontaktperson</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input type="text" class="form-control span10" name="company_cp_name" id="company_cp_name" value="{if !empty($list.defaults) and $list.defaults.provider_of_pa_flag eq 2 and $list.defaults.company_cp_name neq ''}{$list.defaults.company_cp_name}{else}{$company_data.cp_name}{/if}" {if !empty($list.defaults) and $list.defaults.provider_of_pa_flag eq 1}disabled="disabled"{/if}> </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span4">
                                                                        <div style="margin: 0px 0px 10px;" class="span12">
                                                                            <label style="float: left;" class="span12 no-min-height" for="company_cp_phone">Telefon, även riktnummer</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input type="text" class="form-control span10" name="company_cp_phone" id="company_cp_phone" value="{if !empty($list.defaults) and $list.defaults.provider_of_pa_flag eq 2 and $list.defaults.company_cp_phone neq ''}{$list.defaults.company_cp_phone}{else}{$company_data.contact_number}{/if}" {if !empty($list.defaults) and $list.defaults.provider_of_pa_flag eq 1}disabled="disabled"{/if}> </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row-fluid">
                                                                    <div class="span12">
                                                                        <label style="float: left;" class="span12 no-min-height">Är anordnaren arbetsgivare för assistenten?</label>
                                                                        <label style="margin-left: 5px;" class="no-ml"><input type="radio" class="radio pull-left agreement_type agreement_type_special" name="agreement_type" value="1" {if (!empty($list.defaults) and $list.defaults.agreement_types_new eq 1) or empty($list.defaults)}checked="checked"{/if} {if !empty($list.defaults) and $list.defaults.provider_of_pa_flag eq 1}disabled="disabled"{/if}>&nbsp;Ja </label>
                                                                    </div>
                                                                </div>
                                                                <div style="margin: 12px 0px;" class="row-fluid">
                                                                    <div class="span4">
                                                                        <label class="no-ml" style="margin-left: 5px;">
                                                                            <input type="radio" class="radio pull-left agreement_type agreement_type_special" name="agreement_type" value="2" {if !empty($list.defaults) and $list.defaults.agreement_types_new eq 2}checked="checked"{/if} {if !empty($list.defaults) and $list.defaults.provider_of_pa_flag eq 1}disabled="disabled"{/if}>&nbsp;
                                                                            Nej, anordnaren är
                                                                                uppdragsgivare åt
                                                                                assistenten som har
                                                                                en annan arbetsgivare</label>
                                                                    </div>
                                                                    <div class="span4">
                                                                        <div style="" class="span12">
                                                                            <label style="float: left;" class="span12 no-min-height" for="name_of_another_employer">Namn på arbetsgivaren</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input type="text" value="{if !empty($list.defaults) and $list.defaults.agreement_types_new eq 2 and $list.defaults.agreement_type2_company neq ''}{$list.defaults.agreement_type2_company}{/if}" name="agreement_type2_company" data-company="{if !empty($list.defaults) and $list.defaults.agreement_types_new eq 2 and $list.defaults.agreement_type2_company neq ''}{$list.defaults.agreement_type2_company}{else}{$company_data.name}{/if}" class="form-control span10 agreement_type2_company" {if !empty($list.defaults) and $list.defaults.provider_of_pa_flag eq 1}disabled="disabled"{/if}/></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="span4">
                                                                        <div style="" class="span12">
                                                                            <label style="float: left;" class="span12 no-min-height" for="another_employer_org_no">Organisationsnummer</label>
                                                                            <div style="margin: 0px;" class="input-prepend span12"> <span class="add-on icon-pencil"></span>
                                                                                <input type="text" value="{if !empty($list.defaults) and $list.defaults.agreement_types_new eq 2 and $list.defaults.agreement_type2_orgNo neq ''}{$list.defaults.agreement_type2_orgNo}{/if}" name="agreement_type2_orgno" data-org-no="{if !empty($list.defaults) and $list.defaults.agreement_types_new eq 2 and $list.defaults.agreement_type2_company neq ''}{$list.defaults.agreement_type2_orgNo}{else}{$company_data.org_no}{/if}" class="form-control span10 agreement_type2_orgno" {if !empty($list.defaults) and $list.defaults.provider_of_pa_flag eq 1}disabled="disabled"{/if}/></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row-fluid">
                                                                    <div class="span12">
                                                                        <label class="no-ml" style="margin-left: 5px;">
                                                                            <input type="radio" class="radio pull-left agreement_type agreement_type_special" name="agreement_type" value="3" {if !empty($list.defaults) and $list.defaults.agreement_types_new eq 3}checked="checked"{/if} {if !empty($list.defaults) and $list.defaults.provider_of_pa_flag eq 1}disabled="disabled"{/if}>&nbsp;
                                                                            Nej, anordnaren är uppdragsgivare åt assistenten som är egenföretagare.</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    {/if}
                                </form>
                            </div>
                        </div>
                        {/foreach}
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
{/block}