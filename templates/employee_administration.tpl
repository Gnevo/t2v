{block name='style'}
    <link rel="stylesheet" type="text/css" href="{$url_path}css/employee-profile.css" />
    <link rel="stylesheet" href="{$url_path}css/date-picker.css" /><!-- DATE PICKER -->
    <style type="text/css">
        .downFile{ text-overflow: ellipsis; overflow: hidden; white-space: nowrap; display: block; }
        .terms_section { font-size: 12px; padding: 4px 2px 0px 0px; }
        .btn-precise{
            padding : 5px !important;
            margin  : 5px !important;
        }
        table tbody tr td > .day-report{ height: auto !important;}
        #day_wrapper .toggler-class:before{ content: "\f077"; }
        #day_wrapper .collapsed .toggler-class:before { content: "\f078"; }
        #email_option{ margin: 0 0 10px; border: thin solid #ccc}
        #email_option dt{ background: #ddd; padding: 5px;}
    </style>

{/block}

{block name='script'} 
<script src="{$url_path}js/date-picker.js"></script>
<script type="text/javascript" src="{$url_path}js/md5.js"></script>
<script src="{$url_path}js/jquery.maskedinput.js" type="text/javascript" ></script>
<script src="{$url_path}js/jquery.validate.js" type="text/javascript" ></script>
<script type="text/javascript" src="{$url_path}js/bootbox.js"></script>
<script async src="{$url_path}js/time_formats.js?v={filemtime('js/time_formats.js')}" type="text/javascript" ></script>
<script type="text/javascript">
function resetForm(){
    $('#form').get(0).reset();
    $('.btn-group').button('reset');
} 
$(document).ready( function (){
    $("#password, .btn-group button:not(.excluded_edit button)").attr('disabled', true);
    $("#form .exception input:not(.non_editable), #form textarea:not(.non_editable)").prop('readonly', true);
    var edit_mod = 0;   
    $(':radio,:checkbox').not('.non_editable').click(function(){
        return false;
    });
    $('.icon-plus, .icon-minus').hide();

    $("#btn_edit").click(function() {
        if(edit_mod == 1){
            edit_mod = 0;
            resetForm();
            $(this).html('<span class="icon-pencil"></span> ' + '{$translate.btn_edit_employee_personal}');
            $("#password, .btn-group button:not(.excluded_edit button)").attr('disabled', true);
            $("#form .exception input:not(.non_editable input), #form textarea:not(.non_editable)").prop('readonly', true);
            //$('#form .exception input[type="checkbox"][readonly]').off('.readonly').removeAttr("readonly").css("opacity", "1");
            $(':radio,:checkbox').click(function(){
                return false;
            });
            $('.icon-plus, .icon-minus').hide();
            
        }else{
            bootbox.dialog('{$translate.edit_employee_personal_data_mail_go}', [
                {
                "label" : "{$translate.no}",
                "class" : "btn-danger",
                "callback": function() {
                        bootbox.hideAll();
                        //document.location.href = "{$url_path}employee/add/{if isset($employee_username)}{$employee_username}/{/if}";
                    }
                }, 
                {
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                        edit_mod = 1;
                        $('#btn_edit').html('<span class="icon-pencil"></span> ' + '{$translate.btn_cancell_edit_employee_personal}');
                        // $('#form input:not(#username)').attr('readonly', false);
                        // $('#form option:not(:selected)').attr('disabled', false);
                        // $("#btn_save, #password").prop('disabled', false);
                        $("#password, .btn-group button:not(.excluded_edit button)").attr('disabled', false);
                        $("#form .exception input:not(.non_editable), #form textarea:not(.non_editable)").prop('readonly', false);
                        $(':radio,:checkbox').unbind('click');
                        $('.icon-plus, .icon-minus').show();
                    }
                }
            ]);    
        }
    });
    
    $("#frmdate, #todate").datepicker({
        dateFormat: 'yy-mm-dd',
        showOn: "button",
        buttonImage: "{$url_path}images/date_pic.gif",
        buttonImageOnly: true
    });
        
    {if $tab == 02}
    
        skillLoad();
   {/if}
    {if $tab == 03}
     
        documentationLoad()
   {/if}
    {if $tab == 04}
        arvodeLoad();
        {/if}
    $.mask.definitions['~']='[1-9]';
    $("#mobile").mask("0?~9-999 99 99 99", { placeholder:" " });
    $("#phone").mask("0?~9-99999999999", { placeholder:" " }); 
    $('#pass1').keypress(function (event){
    
    if(event.which == '13'){
    event.preventDefault();
        var password = $("#pass1").val();
        var id = $("#contract_ids").val();
                              $( "#dialog-confirm_pass" ).dialog( "close" );
                             var hash = CryptoJS.MD5("{$hash}"+password);
                             
                            if (hash == "{$passwrd}")
                            {
                                document.location.href = "{$url_path}employee/administration/4/"+id+"/{$employee_detail[0].username}/sign/";
                            } 
                            else if(password != null)
                            {
                                //alert("{$translate.sorry_wrong_password}");
                                $( "#dialog" ).dialog({
                                closeOnEscape: true,
                                maxHeight: 150,
                                maxWidth: 150,
                                 buttons: { "{$translate.ok}": function() { $(this).dialog("close"); } } 
                            });
                            }
    }
});
     
   $('#mobile').blur(function() {
   var mobiles = $('#mobile').val();
            
            mobiles = removeCharas(mobiles);
            mobiles = trimNumber(mobiles);
            if(isNaN(mobiles)){
                $("#mobile").addClass("error");
                error = error + 1;
            }else{
                $("#mobile").removeClass("error");
                $.post("{$url_path}ajax_mobile_check/", { mobile : mobiles, ids : $('#user_id').val() , method : 1 },
                function(data){
                    $('#mobs').html(data);
                    if(data!= ""){
                      $("#mobile").addClass("error");
                      //$('#mobile').focus();
                      $('#mobile_flag').val('');  
                    }else{
                      $('#mobile_flag').val('1');  
                    }

                });
            }
        
       
        
    });
    
});

function saveForm(){
    var error = 0;
    var error_mob = 0;
    var pass = $("#password").val();
    if(pass.length < 8){
        $("#password").addClass("error");
        error = 1;
    }
    var mobiles = $('#mobile').val(); 
    //alert(mobiles);
        mobiles = removeCharas(mobiles);
        mobiles = trimNumber(mobiles);
        
        if(isNaN(mobiles)){
            $("#mobile").addClass("error");
            error_mob = error_mob + 1;
        }else{
            $("#mobile").removeClass("error");
        }
        $.post("{$url_path}ajax_mobile_check/", { mobile : mobiles, ids : $('#user_id').val() , method : 1 },
        function(data){
            $('#mobs').html(data);
            if(data!= ""){
              $("#mobile").addClass("error");
               error_mob = error_mob + 1;
              $('#mobile_flag').val('');  
            }else{
              $('#mobile_flag').val('1'); 
              if(error == 0 && error_mob == 0){ 

                    $( "#dialog-confirm" ).dialog({
                            resizable: false,
                            height:140,
                            modal: true,
                            buttons: {
                                    "{$translate.yes}": function() {

                                            $( this ).dialog( "close" );
                                            $("#form").submit();
                                            },
                                                    "{$translate.no}": function() {
                                                            $( this ).dialog( "close" );
                                                    }
                                            }
                                    });
                     }else{
                        if(error != 0){
                            $("#error_pass").html("{$translate.password_minimum}");
                        }
                     }
            }

        });
    }
   

function arvodeLoad(){
        $("#kunder_link").parent().removeClass("active");
        $("#utbildning_link").parent().removeClass("active"); 
        $("#dokumentation_link").parent().removeClass("active"); 
        $("#arvode_link").parent().removeClass("active"); 
        $("#arvode_link").parent().addClass("active");
        $("#skill_div").hide();
        $("#Kunder").load("{$url_path}ajax_contract_sign.php");
}
function signContract(id){
   /* var name = prompt("{$translate.please_enter_your_password}");
    var hash = CryptoJS.MD5("{$hash}"+name);
    if (hash == "{$passwrd}")
    {
        document.location.href = "{$url_path}employee/administration/4/"+id+"/{$employee_detail[0].username}/sign/";
    } 
    else if(name != null)
    {
        alert("{$translate.sorry_wrong_password}");
    }
    //document.location.href = "{$url_path}employee/administration/4/"+id+"/{$employee_detail[0].username}/sign/"; 
    //$( "#dialog:ui-dialog" ).dialog( "destroy" );*/
   
    $( "#dialog-confirm_pass" ).dialog({
        resizable: false,
        height:140,
        modal: true,
        buttons: {
                "{$translate.ok}": function() {
                            $( this ).dialog( "close" );
                             var password = $("#pass1").val();
                             var hash = CryptoJS.MD5("{$hash}"+password);
                            if (hash == "{$passwrd}")
                            {
                                document.location.href = "{$url_path}employee/administration/4/"+id+"/{$employee_detail[0].username}/sign/";
                            } 
                            else if(password != null)
                            {
                                //alert("{$translate.sorry_wrong_password}");
                                $( "#dialog" ).dialog({
                                closeOnEscape: true,
                                maxHeight: 150,
                                maxWidth: 150,
                                buttons: { "{$translate.ok}": function() { $(this).dialog("close"); } } 
                            });
                            }
                        },
                        "{$translate.cancel}": function() {
                                $( this ).dialog( "close" );
                        }
                    }
		});
}
function contractDownload(id){
    $('#action').val('print');
    //document.location.href = "{$url_path}employee/administration/4/"+id+"/{$employee_detail[0].username}/print/";
    window.open("{$url_path}employee/administration/4/"+id+"/{$employee_detail[0].username}/print/");
}

function delAttachment(id){
$( "#dialog-confirm_delete" ).dialog({
        resizable: false,
        height:140,
        modal: true,
        buttons: {
                "{$translate.yes}": function() {

                        $( this ).dialog( "close" );
                        document.location.href = "{$url_path}employee/administration/1/"+id+"/";
                        documentationLoad();
                        },
				"{$translate.no}": function() {
					$( this ).dialog( "close" );
				}
			}
		});
    
    
}

function delSkill(id){
$( "#dialog-confirm_delete" ).dialog({
        resizable: false,
        height:140,
        modal: true,
        buttons: {
                "{$translate.yes}": function() {

                        $( this ).dialog( "close" );
                        document.location.href = "{$url_path}employee/administration/2/"+id+"/";
                        skillLoad();
                        },
				"{$translate.no}": function() {
					$( this ).dialog( "close" );
				}
			}
		});
    
}
             
function employeeLoad(){
       $("#kunder_link").parent().removeClass("active");
        $("#utbildning_link").parent().removeClass("active"); 
        $("#dokumentation_link").parent().removeClass("active"); 
        $("#arvode_link").parent().removeClass("active"); 
        $("#kunder_link").parent().addClass("active");
        $("#skill_div").hide();
   $("#Kunder").load("{$url_path}ajax_employee_role.php");
    
}

function skillLoad(){

   $("#kunder_link").parent().removeClass("active");
        $("#utbildning_link").parent().removeClass("active"); 
        $("#dokumentation_link").parent().removeClass("active"); 
        $("#arvode_link").parent().removeClass("active"); 
        $("#utbildning_link").parent().addClass("active");
        $("#skill_div").show();
    $("#Kunder").load("{$url_path}ajax_employee_skill.php");    
}
function printSkill() {
    window.open('{$url_path}pdf_employee_information.php?id={$employee_detail[0].username}');
}
function PreferedTime(){
	$("#PreferedTime").load("{$url_path}ajax_employee_skill.php");
}

function documentationLoad(){
$("#kunder_link").parent().removeClass("active");
        $("#utbildning_link").parent().removeClass("active"); 
        $("#dokumentation_link").parent().removeClass("active"); 
        $("#arvode_link").parent().removeClass("active"); 
        $("#dokumentation_link").parent().addClass("active");
        $("#skill_div").hide();
    $("#Kunder").load("{$url_path}ajax_employee_attachment.php");
}

function checkSecurity()
{
        var security = $("#social_security").val();
                $.ajax({
                        url:"{$url_path}ajax_check_social_security.php",
                        data:"social_security="+security,
                        type:"POST",
                        success:function(data){
                               $('#soc_sec').html(data);
                                    if(data!= ""){
                                    $("#social_security").addClass("error");
                                    $('#social_security').focus();
                                    $('#social_flag').val('');  
                                }else{
                                    $('#social_flag').val('1');  
                        }
                        }
                        });
        
}
function popup_skill(url)
     {
         var dialog_box_new = $("#dialog_popup");
            dialog_box_new.load(url);
            // open the dialog
            dialog_box_new.dialog({

        title: '{$translate.add_skill}',
        position: 'top',
        modal: true,
        minWidth: 420,
        resizable: false
        
    });
       skillLoad(); 
       return false;
    }
    
    function generate_password(){
      $("#pass").html('<span class="add-on icon-pencil"></span><input type="text" id="password" class="form-control span10" name="password" value ="{$pass}" >');
    }
    
    
   function trimNumber(s) {
        while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
        return s;
    }
    function removeCharas(s) {
        var i=0;
        var temp_mobile = '';
        while(i<s.length){
            if(s.substr(i,1) == " " || s.substr(i,1) == "." || s.substr(i,1) == "," || s.substr(i,1) == "-" || s.substr(i,1) == "_"){
                i++;
            }else{
                temp_mobile = temp_mobile+s.substr(i,1);
                i++;
            }
        }
        return temp_mobile;
    }
</script>
<script type="text/javascript">
	function validaddform() {
            
		var globalerror = 0;
		var correctstr = '';
		var myform = document.getElementById('week_form');
		
		for(var from_counter = 0 ; from_counter < 7 ; from_counter++)
		{
			correctstr = '';
			error = 0;
			var myvalue = $.trim(myform.elements["txtday"+from_counter].value);
                        myform.elements["txtday"+from_counter].value = myvalue;
			var chunks = myvalue.split(","); 
			var ArrayLen = chunks.length;
                        if($.trim(myvalue) != ''){
                            for(var array_counter = 0 ; array_counter < ArrayLen ; array_counter++)
                                {						
                                    var chunk0 = chunks[array_counter];	
                                    var chunks0 = chunk0.split("-");

                                    var string_first = chunks0[0];
                                    var string_second = chunks0[1];

                                    if(chunks0.length == 2)
                                    {
                                            var mycnk0 = string_first.replace(/\s+$/, "");
                                            var mycnk1 = string_second.replace(/\s+$/, "");			

                                            if(mycnk0.indexOf(' ') > -1 || mycnk1.indexOf(' ') > -1)
                                            {
                                                    //alert('Spce not allowed');
                                                    error = 1;
                                            }

                                            mycnk0 = mycnk0.replace(/\s/g, '');
                                            mycnk1 = mycnk1.replace(/\s/g, '');

                                            if(mycnk0 < 0 || mycnk0 > 2400 || mycnk0%5 != 0)
                                                    error = 1;
                                            if(mycnk1 < 0 || mycnk1 > 2400 || mycnk1%5 != 0)
                                                    error = 1;

                                            if(mycnk0.length == 1)
                                                    var num0 = '000'+mycnk0;
                                            else if(mycnk0.length == 2)
                                                    var num0 = '00'+mycnk0;
                                            else if(mycnk0.length == 3)
                                                    var num0 = '0'+mycnk0;
                                            else if(mycnk0.length == 4)
                                                    var num0 = mycnk0;
                                            else
                                                    error = 1;

                                            if(mycnk1.length == 1)
                                                    var num1 = '000'+mycnk1;
                                            else if(mycnk1.length == 2)
                                                    var num1 = '00'+mycnk1;
                                            else if(mycnk1.length == 3)
                                                    var num1 = '0'+mycnk1;
                                            else if(mycnk1.length == 4)
                                                    var num1 = mycnk1;
                                            else
                                                    error = 1;
                                            correctstr += num0+'-'+num1+',';

                                    }
                                    else
                                    {					
                                            error = 1;
                                    }	
                            }	
                        }
			
			if(error == 1)
			{
				globalerror = 1;
				myform.elements["txtday"+from_counter].style.border = '1px solid red';
				myform.elements["error"+from_counter].style.display = 'block';
				
			}	
			else
			{
				myform.elements["txtday"+from_counter].style.border = '1px solid #ccc';
				myform.elements["error"+from_counter].style.display = 'none';
			}
			//alert(correctstr);
			//return false;
		}
		if(globalerror == 1)
		{	
		return false;
		}			
	
		myform.submit();
		
	}
	
	function checkthis(formobj,slotid)	
	{		
		var globalerror = 0;
		var correctstr = '';
		var myform = document.getElementById('editform'+formobj);
		for(var from_counter = 0 ; from_counter < 7 ; from_counter++)
		{
			correctstr = '';
			error = 0;
                        var myvalue = $.trim(myform.elements["txtday"+from_counter].value);
                        myform.elements["txtday"+from_counter].value = myvalue;
                        
			var chunks = myvalue.split(","); 
			var ArrayLen = chunks.length;				
			
                        if($.trim(myvalue) != ''){
                            for(var array_counter = 0 ; array_counter < ArrayLen ; array_counter++)
                            {					
                                    var chunk0 = chunks[array_counter];					
                                    var chunks0 = chunk0.split("-");

                                    var string_first = chunks0[0];
                                    var string_second = chunks0[1];

                                    if(chunks0.length == 2)
                                    {
                                            var mycnk0 = string_first.replace(/\s+$/, "");
                                            var mycnk1 = string_second.replace(/\s+$/, "");			

                                            if(mycnk0.indexOf(' ') > -1 || mycnk1.indexOf(' ') > -1)
                                            {
                                                    //alert('Spce not allowed');
                                                    error = 1;
                                            }

                                            mycnk0 = mycnk0.replace(/\s/g, '');
                                            mycnk1 = mycnk1.replace(/\s/g, '');

                                            if(mycnk0 < 0 || mycnk0 > 2400 || mycnk0%5 != 0)
                                            {
                                                    error = 1;
                                            }
                                            if(mycnk1 < 0 || mycnk1 > 2400 || mycnk1%5 != 0)
                                            {
                                                    error = 1;
                                            }

                                            if(mycnk0.length == 1)					
                                            {
                                                    var num0 = '000'+mycnk0;
                                            }
                                            else if(mycnk0.length == 2)

                                            {
                                                    var num0 = '00'+mycnk0;
                                            }
                                            else if(mycnk0.length == 3)
                                            {
                                                    var num0 = '0'+mycnk0;
                                            }
                                            else if(mycnk0.length == 4)
                                            {
                                                    var num0 = mycnk0;
                                            }
                                            else
                                            {
                                                    error = 1;
                                            }

                                            if(mycnk1.length == 1)
                                            {
                                                    var num1 = '000'+mycnk1;
                                            }
                                            else if(mycnk1.length == 2)
                                            {
                                                    var num1 = '00'+mycnk1;
                                            }
                                            else if(mycnk1.length == 3)
                                            {
                                                    var num1 = '0'+mycnk1;
                                            }
                                            else if(mycnk1.length == 4)
                                            {
                                                    var num1 = mycnk1;
                                            }
                                            else
                                            {
                                                    error = 1;
                                            }		
                                            correctstr += num0+'-'+num1+',';

                                    }
                                    else
                                    {					
                                            error = 1;
                                    }	
                            }	
			}
			if(error == 1)
			{
				globalerror = 1;
				myform.elements["txtday"+from_counter].style.border = '1px solid red';
				myform.elements["error"+from_counter].style.display = 'block';
				
			}	
			else
			{
				myform.elements["txtday"+from_counter].style.border = '1px solid #ccc';
				myform.elements["error"+from_counter].style.display = 'none';
			}
			//alert(correctstr);
			//return false;
		}
		
		if(globalerror == 1)
		{	
			return false;
		}	
		
		myform.elements["hdn_slot"].value = slotid; 
		if(myform.elements["editfrmdate"+formobj].value > myform.elements["edittodate"+formobj].value)
		{ 
			document.getElementById('errormsg').style.display = 'block';
		 	return false; 
		} 
		else 
		{ 
			document.getElementById('errormsg').style.display = 'none';
		}  
	
		myform.submit();		
	}
	
	function delrec(formid,timeid)
	{
		document.getElementById('hdn_delete').value = timeid;	
		document.forms['myform'].submit();
		return false;
	}
	
	

	//var phoneNumberPattern = /(\d{4})?[-]?(\d{4})?[,].*/;  
	//$res = phoneNumberPattern.test(elementValue);  
	

   $(document).ready(function() {	
	
	$(".btn-addskill").click(function() {
            $('#add_new_skill').toggle();

            // $('.addnew-skill').addClass('addnew-skill-visible');
            // $('.addnew-skill').removeClass('addnew-skill');
            // $('.upload-document-visible').addClass('upload-document');
            // $('.upload-document-visible').removeClass('upload-document-visible');
            // $('.sigin-box-visible').addClass('sigin-box');
            // $('.sigin-box-visible').removeClass('sigin-box-visible');
            // $(".main-left").css('width', '66%');
            // $(".main-right").css('width', '32%');
            // $(".main-right").css('display', 'block');
            // $('.edit_skill_right').hide();
        });
                     
        $(".btn-upload-document").click(function() {
            $('#document_upload').toggle();
            // $('.upload-document').addClass('upload-document-visible');
            // $('.upload-document').removeClass('upload-document');
            // $('.addnew-skill-visible').addClass('addnew-skill');
            // $('.addnew-skill-visible').removeClass('addnew-skill-visible');
            // $('.sigin-box-visible').addClass('sigin-box');
            // $('.sigin-box-visible').removeClass('sigin-box-visible');
        });
        
        $(".btn-cancel-upload").click(function() {
            // $('.upload-document-visible').removeClass('upload-document-visible');
            // $('.upload-document-visible').addClass('upload-document');
            $('#document_upload').hide();
            // $('.addnew-skill-visible').addClass('addnew-skill');
            // $('.addnew-skill-visible').removeClass('addnew-skill-visible');
            $('.edit_skill_right').show();
            // $(".main-left").css('width', '99%');
            // $(".main-right").css('display', 'none');
        });
                     
        $(".btn-cancel-addskill, .btn-addnew-skill").click(function() {
            $('#add_new_skill').hide();
            // $('.addnew-skill-visible').removeClass('addnew-skill-visible');
            // $('.addnew-skill-visible').addClass('addnew-skill');
            $('#edit_skill_right').show();
            // $(".main-left").css('width', '99%');
            // $(".main-right").css('display', 'none');
        });
       
       
        
	$('#email').click(function() {		
	
	$('#emailaddress').val('');
		$('#emailpopup').slideDown('slow');
	});
	
	$('#send').click(function() {		
		$('#emailpopup').slideUp('slow');
	});
	
	$('#closeemail').click(function() {		
		$('#emailpopup').slideUp('slow');
	});
	
	
		
	$('#emailform').submit(function() {
		
		var email 		= $('#emailaddress').val();
		var hdn_url		= $("#url").val();
		var employee	= $("#hdn_employee").val();
		var  url = hdn_url+'emptimepreference/sendemail/';
		var error = 0;
		
		if(email == '')
		{
			error = 1;				
		}
			
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		if(!pattern.test(email))
		{         
			error = 1;
		}
		
		if(error == 1)
		{
			$("#errormsg").html('');
			$("#errormsg").html('Invalid Email Address');
			$("#errormsg").show();
			return false;
		}
		
	
		$.ajax({
		type: "POST",
		url: url,
		data: { email: email, employee:employee }
		}).done(function( html ) {
		//alert( "Data Saved: " + html );
		$("#errormsg").html('');
		$("#errormsg").html(html);
		$("#errormsg").show();
		});
	
		return false;
	});
		
	
	$('#submit').click(function() {
			$('#posterrormsg').html(' ');
			var fromdate	= $("#frmdate").val();
			var todate		= $("#todate").val();
			var employee		= $("#hdn_employee").val();
			
			var hdn_url		= $("#url").val();
			//$.post("test.php", { name: "John", time: "2pm" } );
			var  url = hdn_url+'ajax_employee_time_preference_new.php';
			var error = 0;
			
			if(fromdate == '')
			{
				$("#frmdate").css('border-color','red');
				error = 1;
			}
			else
			{
				$("#frmdate").css('border-color','1px solid #D9D9D9');	
			}
			if(todate == '')
			{
				$("#todate").css('border-color','red');			
				error = 1;
			}
			else
			{
				$("#todate").css('border-color','1px solid #D9D9D9');	
			}
			
			if(todate < fromdate)
			{				
				$("#errormsg").show();
				error = 1;			
			}
			else
			{
				$("#errormsg").hide();
			}		
		
			if(error == 1)
			{
				return false;	
			}
				
			$.ajax({
			type: "POST",
			url: url,
			data: { fromdate: fromdate, todate: todate, employee: employee }
			}).done(function( html ) {
			//alert( "Data Saved: " + msg );
			$("#datashow").html('');
			$("#datashow").html(html);
	
			});
			return false;

	});
	
	
	var tot_employee = $("#hdn_tot_employee").val();
	for(var employee_counter = 0 ; employee_counter < tot_employee ; employee_counter++)
	{
		$("#editfrmdate"+employee_counter).datepicker({ldelim}
		showOn: "button",
		buttonImage: "{$url_path}images/date_pic.gif",
		buttonImageOnly: true
		{rdelim});
		
		$("#edittodate"+employee_counter).datepicker({ldelim}
		showOn: "button",
		buttonImage: "{$url_path}images/date_pic.gif",
		buttonImageOnly: true
		{rdelim});
	}
	
});
function formBack() {
    document.location.href = '{if $privileges_general.add_employee == 1 || $privileges_general.edit_employee == 1}{$url_path}employee/add/{$employees_username}/{else}{$url_path}employee/administration/{$employees_username}/{/if}';
}
</script>
<script type="text/javascript">
function pdfdownload(){	
	var emp = document.getElementById("hdn_employee").value;	
	var host = document.getElementById("url").value;	
	var url = host+"emptimepreference/pdfdwonload/emp/";
	url += emp+'/';
	
	myWindow=window.open(url,'Employee Preference Time Data PDF','width=200,height=100');
	myWindow.focus();
	return false;	
}
</script>
<script type="text/javascript">
    function downloadFile(filename){
        document.location.href = "{$url_path}download.php?{$download_folder}/"+filename;
    }
    function download_skill(file){
        document.location.href = "{$url_path}download.php?{$download_folder}/"+file;
    }

    function toggle_edit(id){
       
        if($('#edit_skill_form'+id).length == 0){
            $('#edit_skill_main'+id).after(edit_form(id));
        }
        else{
            $('#edit_skill_form'+id).remove();
        }        
        $('.attachment1,.attachment2,.attachment3').empty();
        // $('.upload-document-visible').addClass('upload-document');
        // $('.upload-document-visible').removeClass('upload-document-visible');
        // $('.addnew-skill-visible').addClass('addnew-skill');
        // $('.addnew-skill-visible').removeClass('addnew-skill-visible');
        // $(".main-left").css('width', '66%');
        // $(".main-right").css('width', '32%');
        // $(".main-right").css('display', 'block');
        $('.edit_skill_right').show();
        var title = $('#skill_title'+id).text().trim();
        var description = $('#skill_description'+id).text().trim();
        $('#skills_edit').val(title);
        $('#skills_edit').append('<input type=hidden name=skill_h_id value='+id+'>');
        $('#description_edit').val(description);
        if($('#attachment1'+id).text().trim() != ''){
            $('.attachment1').append('<label class=edit_label>'+$('#attachment1'+id).text().trim()+'</label><a href=javascript:void(0) class="btn btn-danger edit_delete" onclick="delete_skill_doc(\'attachment1\')"><i class=icon-trash></i></a>');
        }
        else{
            $(".attachment1").append('<input type=file name=file[]> style=line-height:0;');
        } 
        if($('#attachment2'+id).text().trim() != ''){
            $('.attachment2').append('<label class=edit_label>  '+$('#attachment2'+id).text().trim()+'</label><a href=javascript:void(0) class="btn btn-danger edit_delete" onclick=delete_skill_doc(\'attachment2\')><i class=icon-trash></i></a>');
        }
        else{
            $(".attachment2").append('<input type=file name=file[]>  style=line-height:0;');

        }
        if($('#attachment3'+id).text().trim() != ''){
            $('.attachment3').append('<label class=edit_label>'+$('#attachment3'+id).text().trim()+'</label><a href=javascript:void(0) class="btn btn-danger edit_delete" onclick=delete_skill_doc(\'attachment3\')><i class=icon-trash></i></a>');
        }
        else{
            $(".attachment3").append('<input type=file name=file[]>  style=line-height:0;');
        }  
    }

    function delete_skill_doc(db_column){
        $('.'+db_column).empty();
        var html = '<input type=file  name=file[] style=line-height:20px; ><input type=hidden name=db_column[] value='+db_column+'>';
        $('.'+db_column).append(html);
    }
    function edit_form(id){
         var html = '<div class="row-fluid" id=edit_skill_form'+id+' style="margin-bottom:10px;">\n\
                 <div class="span12 edit_skill_right" style="margin-left: 0px; display: none;">\n\
                    <div style="margin: 0px ! important;" class="widget">\n\
                        <form method="post" name="doc_form" action="" enctype="multipart/form-data">\n\
                             <div style="" class="widget-header span12">\n\
                                <div class="span5 day-slot-wrpr-header-left span6">\n\
                                    <h1 style="">{$translate.upload_document}</h1>\n\
                                </div>\n\
                                <div class="pull-right day-slot-wrpr-header-left span7" style="padding: 5px;">\n\
                                    <button class="btn btn-default btn-normal pull-right" name="save_edit_doc" type="submit" value="{$translate.save}" ><span class="icon-save"></span> {$translate.save}</button>\n\
                                    <button class="btn btn-default btn-normal  pull-right " type="button" onclick=edit_form_back('+id+')><span class="icon-arrow-left"></span> {$translate.cancel}</button>\n\
                                </div>\n\
                                <div class="span12 widget-body-section input-group email-list-box">\n\
                                    <div class="row-fluid">\n\
                                        <div style="margin: 0px ! important;" class="span12">\n\
                                            <label style="float: left;" class="span12" for="skills">{$translate.skill}</label>\n\
                                            <div style="margin: 0px 0 10px 0" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>\n\
                                                <input class="form-control span10 non_editable" type="text" name="skills" id="skills_edit"/></div></div></div>'; 
        var html1 =         '<div class="row-fluid"><div style="margin: 0px" class="span12">\n\
                                            <label style="float: left;" class="span12" for="description">{$translate.description}</label>\n\
                                            <textarea class="form-control span12 non_editable" name="description" id="description_edit"></textarea>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="row-fluid">\n\
                                        <div style="margin: 0px" class="span12">\n\
                                            <label style="float: left;" class="span12">{$translate.upload_document}</label>\n\
                                            <div class="attachment1" style="margin-top: 25px;"></div>\n\
                                            <div class="attachment2" style="padding-top: 10px;"></div>\n\
                                            <div class="attachment3" style="padding-top: 10px;"></div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                         </form>\n\
                    </div>\n\
                </div>\n\
            </div>';
        var html2 = html+html1;
            return html2;
    }
    function edit_form_back(id){
        $('#edit_skill_form'+id).hide();
    }

    // non prefered functions start

    $('.btn-add-new').click(function(){
        $('#new_non_prefered_time').show();
        $('.day-show .panel-title:not(.collapsed)').trigger('click');
        $('#save_btn,#close_btn').show();
        // $('.day-show').removeClass('hide');
        // $('.empty-all,#from_date,#to_date').val('');
        // $('.remove-intervals').trigger('click');

    });

    $('.btn-cancel-right').click(function(){
        $('#copy_to_week').prop('checked', false);
        $('#new_non_prefered_time,#save_btn,#close_btn').hide();
        $('.empty-all,#from_date,#to_date').val('');
        $('.remove-intervals').trigger('click');
        $('#group_id').val('');
        $('#copy_to_week_times').hide();

        // $('.collapse').collapse();
        // $('.collapse').collapse({
        //     toggle: false
        // })
        // $('.collapse').collapse('hide');
    });

    $('.add-new-intervals').click(function(){
        var day  = $(this).closest('.panel-body').data('day');
        var html = '<div class="span12 row-fluid no-ml interval-div">\n\
                        <div class="span1"><span class="icon-minus remove-intervals"></span></div>\n\
                        <div class="span2">{$translate.emp_non_prefr_time_from}</div>\n\
                        <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>\n\
                        <div class="span2">{$translate.emp_non_prefr_time_to}</div>\n\
                        <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>\n\
                    <div>';
        $(this).closest('.panel-body').append(html);
    });

    $(document).on("click",".remove-intervals",function() {
        $(this).closest('.row-fluid').remove();
    });

    $(function(){
        $(".datepicker").datepicker({
            autoclose: true,
            weekStart: 1,
            calendarWeeks: true, 
            language: '{$lang}'
        }).on('changeDate', function(ev){
            var fromDate = $('#from_date').val();
            var toDate   = $('#to_date').val();
            var daysForshow = [7,1,2,3,4,5,6]; // 7 -sunday ... 6-saturday
            
            if(fromDate != '' && toDate == ''){
                var dayObj = new Date(fromDate);
                var day = daysForshow[dayObj.getDay()];
                // $('.day-show').hide();
                $('.day-show').addClass('hide');
                // $('#day_show'+day).show();
                $('#day_show'+day).removeClass('hide');
            }
            else{
                // $('.day-show').hide();
                $('.day-show').addClass('hide');
                var startDate = new Date(fromDate); //YYYY-MM-DD
                var endDate   = new Date(toDate);
                var dates     = getDateArray(startDate, endDate);
                if(dates.length >= 7){
                    // $('.day-show').show();
                    $('.day-show').removeClass('hide');
                }
                else{
                    dates.forEach(function(value, key){
                        // $('#day_show'+daysForshow[value]).show();
                        $('#day_show'+daysForshow[value]).removeClass('hide');
                    });
                }
            }
            /*if(typeof ev.date != 'undefined' && ev.date != ''){
                console.log($.datepicker.formatDate('yy-mm-dd', ev.date));
            }*/
        });
    });

    function getDateArray(start, end) {
        var days = new Array();
        var dt  = new Date(start);
        while (dt <= end) {
            days.push(new Date(dt).getDay());
            dt.setDate(dt.getDate() + 1);
        }
        return days;
    }

    function handleTimeInterval(){
        var interval           = [];
        var dayInterval        = {}; 
        var dayIntervalVisible = {};
        var isOverlape         = 0 ;
        var fromDate           = $('#from_date').val();
        var toDate             = $('#to_date').val(); 
        if(fromDate == ''){
            bootbox.alert('{$translate.from_date_is_mandatory}', function(result){ });
        }
        else{
            toDate != '' ? toDate : toDate = fromDate ;
            $('#new_non_prefered_time .day-show:not(.hide) .interval-div').each(function( index ) {
                var timeFrom = time_to_sixty($(this).find('.time-from').val());
                var timeTo   = time_to_sixty($(this).find('.time-to').val());
                var day      = $(this).closest('.panel-body').data('day'); // 1 = monday ... 7 = sunday 
                if(timeFrom !== false && timeTo !== false){
                    timeFrom = parseFloat(timeFrom);
                    timeTo   = parseFloat(timeTo);
                    if(timeFrom < timeTo){
                        if(typeof dayInterval[day] == "undefined")
                            dayInterval[day] = [];
                        dayInterval[day].push({ 'timeFrom':timeFrom, 'timeTo' : timeTo});
                    }
                }
            });
            // console.log(dayInterval);
            
            if(Object.keys(dayInterval).length > 0){
            
                for (var key in dayInterval) { 
                    dayInterval[key].sort(function(a, b){ // sorting each day increasing order of timeFrom.
                        return a.timeFrom-b.timeFrom;
                    });
                    for (var i = 1; i < dayInterval[key].length; i++) { // checking for overlapping time periods.
                        if(dayInterval[key][i].timeFrom < dayInterval[key][i-1].timeTo){
                            isOverlape = 1;
                            break;
                        }
                    }
                    if(isOverlape == 1)
                        break;
                }
                if(isOverlape == 1){
                    bootbox.alert('{$translate.time_intervals_are_overlapping}', function(result){ });
                }
                else{
                    var data;
                    var preference_mode = $("input[name='pref_selection']:checked"). val();
                    if($('#group_id').val() != ''){ // edit
                        data = { 'group_id':$('#group_id').val(),'dayInterval':dayInterval ,'username':'{$user_id}' ,'fromDate':fromDate, 'toDate':toDate,'action':'edit_time_interval', 'preference_mode' : preference_mode}
                    }
                    else{
                        data = { 'dayInterval':dayInterval ,'username':'{$user_id}' ,'fromDate':fromDate, 'toDate':toDate,'action':'save_time_interval', 'preference_mode' : preference_mode}
                    }
                    $.ajax({
                        url:"{$url_path}employee_administration.php",
                        type:'POST',
                        datetype:'json',
                        data:data,
                        success:function(data){
                            data = JSON.parse(data);
                            // console.log(data);
                            // return false;
                            if(data.result_flag == false){
                                $('#error_message').html(data.error_message);
                            }
                            else{
                                location.href = '{$url_path}employee/administration/';
                            }
                        }
                    });
                }
            }
            else{
                bootbox.alert('{$translate.no_time_interval_is_selected}', function(result){ });
            }
        }
    }

    function handleSingleDelete(id){
        bootbox.dialog('{$translate.do_u_want_delete}', [
        {
            "label" : "{$translate.no}",
            "class" : "btn-danger",
        },
         {                          
            "label" : "{$translate.yes}",
            "class" : "btn-success",
            "callback": function() {
              if(id){
                var preference_mode = $("input[name='pref_selection']:checked"). val();
                $.ajax({
                url:"{$url_path}employee_administration.php",
                type:'POST',
                datetype:'json',
                data:{ 'id':id , 'action':'delete_single_time_interval', 'preference_mode': preference_mode},
                success:function(data){
                    // console.log(data);
                    // console.log(JSON.parse(data));
                    data = JSON.parse(data);
                    if(data.result_flag == true){
                        location.href = '{$url_path}employee/administration/';
                    }
                    else{
                        $('#main_message').html(data.error_message);
                    }
                }
            });
              }
            }
         }
      ]);
    }

    function delete_non_prefered_time(group_id){
        bootbox.dialog('{$translate.do_u_want_delete}', [
        {
            "label" : "{$translate.no}",
            "class" : "btn-danger",
        },
         {                          
            "label" : "{$translate.yes}",
            "class" : "btn-success",
            "callback": function() {
                if(group_id){
                    var preference_mode = $("input[name='pref_selection']:checked"). val();
                    $.ajax({
                        url:"{$url_path}employee_administration.php",
                        type:'POST',
                        datetype:'json',
                        data:{ 'group_id':group_id , 'action':'delete_time_interval', 'preference_mode': preference_mode},
                        success:function(data){
                            // console.log(data);
                            // console.log(JSON.parse(data));
                            data = JSON.parse(data);
                            if(data.result_flag == true){
                                location.href = '{$url_path}employee/administration/';
                            }
                            else{
                                $('#main_message').html(data.error_message);
                            }
                        }
                    });
                }
               }
            }
        ]);
    }

    function edit_non_prefered_time(dateRange,groupId){
        // $('.day-show .panel-title:not(.collapsed)').trigger('click');
        // $('.panel-title.collapsed').siblings('.in.collapse').prev('.panel-title.collapsed').trigger('click');
        
        // $('.collapse').collapse('hide');
        var prevDay = '';
        $('.panel-body').find('.no-ml.interval-div').remove();
        $('.btn-add-new').trigger('click');
        // $('.day-show .panel-title:not(.collapsed)').trigger('click');
        // $('.day-show').show();
        $('.day-show').removeClass('hide');
        $('#group_id').val(groupId);
        $('#from_date').val(dateRange[0].date_from);
        $('#to_date').val(dateRange[0].date_to);
        setTimeout(function(){
            dateRange.forEach(function(value ,key){
                 // console.log($('#day'+value.day).collapse('show'));
                 
                $('.day-show#day_show'+value.day+' .panel-title').trigger('click');
                if(prevDay != value.day){
                    $('#day'+value.day).find('.time-from').val(value.time_from);
                    $('#day'+value.day).find('.time-to').val(value.time_to);
                }
                else{
                    var html = append_new_interval(value.time_from,value.time_to);
                    $('#day'+value.day).find('.panel-body').append(html);
                    
                }
                prevDay = value.day;
            });
        }, 1000);
    }

    function append_new_interval(timeForm, timeTo){
        var html = '<div class="span12 row-fluid no-ml interval-div">\n\
                        <div class="span1"><span class="icon-minus remove-intervals"></span></div>\n\
                        <div class="span2">{$translate.emp_non_prefr_time_from}</div>\n\
                        <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" value = '+timeForm+' ></div>\n\
                        <div class="span2">{$translate.emp_non_prefr_time_to}</div>\n\
                        <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" value = '+timeTo+' ></div>\n\
                    <div>';
        return html;
    }

    $('#copy_to_week').click(function(){
        if ($(this).is (':checked')){
            $('#copy_to_week_times').show();
        }
        else{
            $('#copy_to_week_times').hide();
        }
        
    });

    $('#set_copy_time').click(function(){

            var proceed = true;
            var dayArray = [];
            // console.log(dayArray);
            var from_time_week = $('#from_date_week').val();
            var to_time_week   = $('#to_date_week').val();
            if(from_time_week != '' && to_time_week != ''){
                
                // $('.day-show').find('.panel-title').trigger('click');
                // $('.day-show .single-day:not(.in)').prev('.panel-title').trigger('click');
                $('.day-show .panel-title:not(.collapsed)').trigger('click');
                var interval    = [];
                var dayInterval = {}; 
                $('.day-show').each(function( index ) {
                    if ($(this).css('display') == 'block'){
                         dayArray.push($(this).find('.panel-body').data('day'));
                    }
                });
                $('#new_non_prefered_time .interval-div').each(function( index ) {
                    var timeFrom = time_to_sixty($(this).find('.time-from').val());
                    var timeTo   = time_to_sixty($(this).find('.time-to').val());
                    var day      = $(this).closest('.panel-body').data('day'); // 1 = monday ... 7 = sunday 
                    // var dayArray = dayArray.push(day);
                    if(timeFrom != false && timeTo != false){
                        timeFrom = parseFloat(timeFrom);
                        timeTo   = parseFloat(timeTo);
                        if(timeFrom < timeTo){
                            if(typeof dayInterval[day] == "undefined")
                                dayInterval[day] = [];
                            dayInterval[day].push({ 'timeFrom':timeFrom, 'timeTo' : timeTo});
                        }
                    }
                });
                // console.log(dayInterval);
                if(Object.keys(dayInterval).length == 0){
                    // $('.day-show .panel-title:not(.collapsed)').trigger('click');
                     setTimeout(function(){
                        dayArray.forEach(function(value,key){
                            $('#day'+value).find('.time-from').val(from_time_week);
                            $('#day'+value).find('.time-to').val(to_time_week);
                            $('.day-show#day_show'+value+' .panel-title').trigger('click');
                        });
                    }, 1000);  
                        // $('.interval-div').find('.time-from').val(from_time_week);
                        // $('.interval-div').find('.time-to').val(to_time_week);
                }
                else{

                    setTimeout(function(){
                        dayArray.forEach(function(value,key){
                            proceed = true;
                            if(typeof dayInterval[value] !== 'undefined'){
                                // $('.day-show .panel-title:not(.collapsed)').trigger('click');
                                dayInterval[value].forEach(function(value, key){
                                    if(value.timeFrom == from_time_week  && value.timeTo == to_time_week){
                                        proceed = false;
                                        return false;
                                    }
                                });
                            }
                            if(proceed){
                                if(dayInterval.hasOwnProperty(value)){
                                    var html = append_new_interval(from_time_week,to_time_week);
                                    $('#day'+value).find('.panel-body').append(html);
                                    $('.day-show#day_show'+value+' .panel-title').trigger('click');
                                }
                                else{
                                    $('#day'+value).find('.interval-div').find('.time-from').val(from_time_week);
                                    $('#day'+value).find('.interval-div').find('.time-to').val(to_time_week);
                                    $('.day-show#day_show'+value+' .panel-title').trigger('click');
                                }
                            }
                        });
                    }, 1000);
                }
                // $('.collapse').collapse('show');
            }
        // }
    });

    $(document).off('keyup', ".time-from, .time-to")
        .on('keyup', ".time-from,.time-to", function(e) {
                // get keycode of current keypress event
                var code = (e.keyCode || e.which);
                //console.log(code);
                // do nothing if it's an arrow key  || (code >=65 && code <= 90)
                if(code == 37 || code == 38 || code == 39 || code == 40) {
                    return;
                }
                var this_val = $(this).val();
                var new_val = this_val.replace(/[^0-9.,]+/g,'').replace(/,/g,".");
                $(this).val(new_val);
                /*$(this).val($(this).val().replace(/[^0-9.,]+/g,''));
                $(this).val($(this).val().replace(/,/g,"."));*/
    });


</script>
{/block}


{block name="content"}
    <div id="dialog-confirm" title="{$translate.confirm}" style="display:none;">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_save_changes}</p>
    </div>
    <div id="dialog-confirm_delete" title="{$translate.confirm}" style="display:none;">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$translate.want_delete}</p>
    </div>
    <div id="dialog-confirm_pass" title="{$translate.please_enter_your_password}" style="display:none;">
        <p style="margin-left: 10px"><br> <form style="margin-left: 10px"><input type="password" name="pass1" id="pass1" value=""></input></form></p>
</div>
<div id="dialog" title="" style="display:none;">
    <p style="margin-left: 40px; margin-top: 40px; font-size: 22px; color: red;">{$translate.sorry_wrong_password}</p>
</div>
<div id="dialog_popup" style="display:none;"></div>
<div class="clearfix" id="dialog_hidden" style="display:none;"></div>
<div class="row-fluid">
    <form id="form" name="form" method="post" action="{$url_path}employee/administration/">
        <input type="hidden" name="tab" id="tab"  value="{$tab}" />
        <input type="hidden" name="work" id="work"  {if $employee_detail[0].works} value="{$employee_detail[0].works}" {else} value=""{/if}/>
        <input type="hidden" name="rand_pass" id="rand_pass"  value="{$pass}" />
        <input type="hidden" name="team" id="team"  value="{$current_team[0].id}" />
        <input type="hidden" name="cur_team" id="cur_team" value="{$current_team[0].id}" />
        <input type="hidden" name="user_id" id="user_id" value="{$employee_detail[0].username}" />
        <input type="hidden" name="cur_role" id="cur_role" value="{$employee_role}" />
        <input type="hidden" name="global_check" id="global_check" value="0" />
        <div style="width: 99%; margin-left: 0px;" class="span12 main-left">
            <div style="margin: 15px 0px 0px ! important;" class="widget">
                <div style="" class="widget-header span12">
                    <div class="span4 day-slot-wrpr-header-left span6">
                        <h1>{$translate.employee}</h1>
                    </div>
                    <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                        <button style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button" onclick="saveForm()"><span class="icon-save"></span> {$translate.save}</button>
                        <button id = "btn_edit" class="btn btn-default btn-normal pull-right ml" type="button" onclick="resetForm()><span class="icon-pencil"></span> {$translate.btn_edit_employee_personal}</button>
                        <button style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button" onclick="resetForm()"><span class="icon-refresh"></span> {$translate.reset}</button>
                    </div>
                </div>
            </div>
            <div class="span12 widget-body-section input-group">
                <div class="row-fluid">
                    {$message}
                    <div id="error_pass" style="color: red"></div>
                </div>
                <div class="row-fluid">
                    <div class="span4" style="">
                        <div style="margin: 0px;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.personal_information}</h1>
                            </div>
                            <!--WIDGET BODY BEGIN-->
                            <div class="span12 widget-body-section input-group exception">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="span12" style="margin: 5px 0px 0px;">
                                            <label style="float: left;" class="span12" for="social_security">{$translate.social_security}*</label>
                                            <div style="margin-left: 0px; float: left;">
                                                <div class="input-prepend span12 hasDatepicker">
                                                    <span class="add-on icon-pencil"></span>
                                                    <select class="form-control span3 non_editable" name="century" id="century" readonly="readonly">
                                                        <option value="19" {if $employee_detail[0].century == 19} selected="selected" {/if} >19</option>
                                                        <option value="20" {if $employee_detail[0].century == 20} selected="selected" {/if} >20</option>
                                                    </select>
                                                    <input value="{$employee_detail[0].social_security}" class="form-control span7 non_editable" name="social_security" id="social_security" type="text" maxlength="11" onchange="makeChange()" style="margin-left: 2px;" readonly="readonly" /> 
                                                    <input type="hidden" value="{if $social_security_check}1{/if}" id="social_flag" name="social_flag">
                                                </div>
                                                <div id="soc_sec" style="color: red"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="padding: 0px; margin: 0px;" class="span6 form-left">
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="first_name">{$translate.first_name}*</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> 
                                            <span class="add-on icon-pencil"></span>
                                            <input value="{$employee_detail[0].first_name}" class="form-control span10 non_editable" name="first_name" id="first_name" type="text" onchange="makeChange()" readonly="readonly" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="code">{$translate.code}</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                            <input {if $employee_detail[0].code} value="{$employee_detail[0].code}"{else} value="{$emp_code}"{/if} class="form-control span10 non_editable" name="code" id="code" type="text" onchange="makeChange()" readonly="readonly" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="post">{$translate.post}</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                            <input value="{$employee_detail[0].post}" class="form-control span10" id="post" name="post" type="text" onchange="makeChange()" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="phone">{$translate.phone}</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                            <input value="{$employee_detail[0].phone}" class="form-control span10" id="phone" name="phone" type="text" onchange="makeChange()" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="email">{$translate.email}</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                            <input value="{$employee_detail[0].email}" class="form-control span10" id="email" name="email" type="email" onchange="makeChange()" /> 
                                        </div>
                                    </div>
                                </div>
                                <div style="" class="span6 form-right">
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="last_name">{$translate.last_name}*</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> 
                                            <span class="add-on icon-pencil"></span>
                                            <input value="{$employee_detail[0].last_name}" class="form-control span10 non_editable" name="last_name" id="last_name" type="text" onchange="makeChange()" readonly="readonly" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="address">{$translate.address}</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                            <input value="{$employee_detail[0].address}" class="form-control span10" name="adress" id="adress" type="text" onchange="makeChange()" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="city">{$translate.city}</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                            <input value="{$employee_detail[0].city}" class="form-control span10" id="city" name="city" type="text" onchange="makeChange()" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="mobile">{$translate.mobile}</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                            <input value="{$employee_detail[0].mobile}" class="form-control span10" id="mobile" name="mobile" maxlength="17" type="text" onchange="makeChange()" /> 
                                            <input type="hidden" value="1" id="mobile_flag" name="mobile_flag">
                                        </div>
                                        <div id="mobs" style="color: red"></div>
                                    </div>
                                    <div style="margin: 0px;" class="span12">
                                        <label style="float: left;" class="span12" for="date">{$translate.date_of_joining}</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
                                            <input value="{if $employee_detail}{$employee_detail[0].date}{else}{$today}{/if}" class="form-control span10 non_editable" id="date" name="date" type="text" onchange="makeChange()" readonly="readonly" /> 
                                        </div>
                                    </div>
                                </div>
                                <div class="span12 no-ml">
                                    <label style="float: left;" class="span12" for="txt_ice">{$translate.ice}</label>
                                    <div style="margin: 0px;" class="input-prepend span12">
                                        <textarea class="form-control span12" id="txt_ice" name="txt_ice">{$employee_detail[0].ice}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div style="margin: 0px ! important;" class="widget exception">
                                <div class="widget-header span12">
                                    <h1>{$translate.account_information}</h1>
                                </div>
                                <!--WIDGET BODY BEGIN-->
                                <div class="span12 widget-body-section input-group">
                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                        <label style="float: left;" class="span12" for="username">{$translate.username}</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" > <span class="add-on icon-pencil"></span>
                                            <input class="form-control span10 non_editable" type="text" value="{$employee_detail[0].username}" id="username" name="username" readonly="readonly" /> 
                                        </div>
                                    </div>
                                    <div style="margin: 0px 0px 10px ! important;" class="span12">
                                        <label style="float: left;" class="span12" for="password">{$translate.password}</label>
                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker">
                                            <div id="pass"><button type="button" onclick="generate_password()" id="password" name="password" class="btn btn-default btn-normal" onchange="makeChange()" value="{$translate.generate_password}">{$translate.generate_password}</button></div>
                                            <input type="hidden" id="action" value="" name="action"/>
                                        </div>
                                    </div>
                                </div>
                                <!--WIDGET BODY END-->
                            </div>
                            <!--WIDGET BODY END-->
                        </div>
                        <div class="row-fluid">
                        </div>
                    </div>
                    <div class="span4" style="">
                        <div class="row-fluid">
                            <div class="span12">
                                <div style="margin: 0px 0px 15px ! important;" class="widget">
                                    <div style="" class="widget-header span12">
                                        <div class="span4 day-slot-wrpr-header-left span6">
                                            <h1>{$translate.documentation}</h1>
                                        </div>
                                        <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                            <button class="btn btn-default btn-normal pull-right btn-upload-document" style="margin: 0px 5px;" type="button"><span class="icon-upload"></span> {$translate.upload_document}</button>
                                        </div>
                                    </div>
                                    <!--WIDGET BODY BEGIN-->
                                    <div class="span12 widget-body-section input-group widget-body-profile-documentaion-height-fix">
                                        <div class="row-fluid" id="document_upload" style="display: none;">
                                            <div class="span12 upload-document-visible" style="margin-left: 0px;">
                                                <div style="margin: 0px ! important;" class="widget">
                                                    <form method="post" action="" name="form"></form>
                                                    <form method="post" name="doc_form" action="" enctype="multipart/form-data">
                                                        <div style="" class="widget-header span12">
                                                            <div class="span5 day-slot-wrpr-header-left span6">
                                                                <h1 style="">{$translate.upload_document}</h1>
                                                            </div>
                                                            <div class="pull-right day-slot-wrpr-header-left span7" style="padding: 5px;">
                                                                <button class="btn btn-default btn-normal pull-right btn-upload-file" name="save_doc" type="submit" value="{$translate.save}"><span class="icon-save"></span> {$translate.save}</button>
                                                                <button class="btn btn-default btn-normal  pull-right btn-cancel-upload btn-margin-rgt" type="button"><span class="icon-arrow-left"></span> {$translate.cancel}</button>
                                                            </div>
                                                        </div>
                                                        <div class="span12 widget-body-section input-group email-list-box">
                                                            <div class="row-fluid">
                                                                <div class="span12" style="margin:0">
                                                                    <div style="background: none repeat scroll 0px center transparent; margin: 0px ! important; padding: 0px;" class="btn btn-default btn-file">
                                                                        <span style="margin-right: 8px;" class="fileupload-new">Select file</span>
                                                                        <input class="margin-none span9 chrome_pad" type="file" name="file" style="line-height: 0;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                          </div>
                                        </div>
                                        <!-- Document upload end -->




                                        {foreach from=$documents item=document}
                                        {if $document.status == 1}
                                            <div class="row-fluid">
                                                <div class="span12 profile-documentaion-list">
                                                    <div class="row-fluid">
                                                        <div class="span12 profile-documentation-list-header">
                                                         {if $document.alloc_emp == {$user_id} } 
                                                          <a href="javascript:void(0);" class="btn btn-default btn-normal pull-right" onclick="delAttachment('{$document.id}')"><i class="icon-remove"></i></a>
                                                          {/if}
                                                        </div>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <div class="span6 profile-documentation-list-left">
                                                            <ul>
                                                                <li><strong>{$translate.document}</strong></li>
                                                                <li><a href="javascript:void(0)" class="downFile" onclick="downloadFile('{$document.documents}')" title="{$document.documents}">{$document.documents}</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="span6 profile-documentation-list-right">
                                                            <ul>
                                                                <li><strong>{$translate.dates}</strong></li>
                                                                <li>{$document.date}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {/if}
                                        {foreachelse}
                                            <div class="row-fluid">
                                                <div class="span12 profile-documentaion-list">
                                                    <div class="row-fluid">
                                                        
                                                            <div class="alert alert-primary">
				<strong><i class="icon-question-sign"></i></strong>{$translate.no_data_available}
			</div>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        {/foreach}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <div style="margin: 0px 0px 15px ! important;" class="widget">
                                    <div class="widget-header span12">
                                        <h1>{$translate.customer}</h1>
                                    </div>
                                    <!--WIDGET BODY BEGIN-->
                                    <div class="span12 widget-body-section input-group widget-body-profile-customer-height-fix">
                                       
                                       
                                       
                                       
                                       
                                     
                                                             
                                       
                                       
                                     
                              
{foreach from=$customers item=customer}
<div class="span12 child-slots-profile-two">
<span>{$customer.name}</span>
<span class="slots-position pull-right">
    {if $customer.role == 3}{$translate.employee}
    {else if $customer.role == 7}{$translate.super_tl}
    {else if $customer.role == 2}{$translate.tl}
    {else if $customer.role == 1 || $customer.role == 6}{$translate.admin}
    {/if}

</span>
</div>
{/foreach}

                                               
                                    
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="span4" style="">
                        <div class="row-fluid">
                            <div class="span12">
                                <div style="margin: 0px 0px 15px ! important;" class="widget">
                                    <div style="" class="widget-header span12">
                                        <div class="span4 day-slot-wrpr-header-left">
                                            <h1>{$translate.education}</h1>
                                        </div>
                                        <div class="pull-right day-slot-wrpr-header-left span8" style="padding: 5px;">
                                            <button style="margin: 0px 5px;" class="btn btn-default btn-normal pull-right btn-addnew-notes" type="button" onclick="printSkill()"><i class="icon-print"></i></button>
                                            <button class="btn btn-default btn-normal pull-right btn-addskill" style="margin: 0px 5px;" type="button"><span class="icon-plus"></span> {$translate.add_skill}</button>
                                        </div>
                                    </div>
                                    <!--WIDGET BODY BEGIN-->
                                    <div class="span12 widget-body-section input-group widget-body-profile-documentaion-height-fix">
                                       
                                      <div class="row-fluid" id="add_new_skill" style="display: none;margin-bottom: 10px;">
                                        <div class="span12 " style="margin-left: 0px;">
                                            <form name="form" id="form" method="post" action="" enctype="multipart/form-data">
                                                <div style="margin: 0px ! important;" class="widget">
                                                    <div style="" class="widget-header span12">
                                                        <div class="span5 day-slot-wrpr-header-left span6">
                                                            <h1 style="">{$translate.skill}</h1>
                                                        </div>
                                                        <div class="pull-right day-slot-wrpr-header-left span7" style="padding: 5px;">
                                                            <button class="btn btn-default btn-normal pull-right btn-addnew-skill" name="add_skills" type="submit" value="{$translate.save}"><span class="icon-save"></span> {$translate.save}</button>
                                                            <button class="btn btn-default btn-normal pull-right btn-cancel-addskill  btn-margin-rgt" type="button"><span class="icon-arrow-left"></span> {$translate.cancel}</button>
                                                        </div>
                                                    </div>
                                                    <!--WIDGET BODY BEGIN-->
                                                    <div class="span12 widget-body-section input-group email-list-box">
                                                        <div class="row-fluid">
                                                            <div style="margin: 0px ! important;" class="span12">
                                                                <label style="float: left;" class="span12" for="skills">{$translate.skill}</label>
                                                                <div style="margin: 0px 0 10px 0" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                                                    <input class="form-control span10 non_editable" type="text" name="skills" id="skills" /> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div style="margin: 0px ! important;" class="span12">
                                                                <label style="float: left;" class="span12" for="description">{$translate.description}</label>
                                                                <textarea class="form-control span12 non_editable" name="description" id="description"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row-fluid">
                                                            <div style="margin: 0px ! important;" class="span12">
                                                                <label style="float: left;margin-bottom: 5px;" class="span12">{$translate.upload_document}</label>
                                                                <div id="attachment1"><input type="file" name="file[]" id="file1"  style="line-height:0;"> </div>
                                                                <div id="attachment2"><input type="file" name="file[]" id="file2" style="line-height:0;"></div>
                                                                <div id="attachment3"><input type="file" name="file[]" id="file3" style="line-height:0;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--WIDGET BODY END-->
                                                </div>
                                            </form>
                                        </div>
                                     </div>


                                        {foreach from=$skills item=skil}
                                            <dl class="profile-education-list" id="edit_skill_main{$skil.id}">
                                                <dt>

                                                 {if $skil.alloc_emp == {$user_id}}  <a href="javascript:void(0);"  title="Edit" id="skill_title{$skil.id}"   onclick="toggle_edit('{$skil.id}')" style="text-decoration: underline;"> {/if} {$skil.skill}</a>
                                          
                                                {if $skil.alloc_emp == {$user_id}}
                                                    <a href="javascript:void(0);" onclick="delSkill('{$skil.id}')"  class="btn btn-default btn-normal pull-right"><i class="icon-remove"></i></a>
                                                {/if}
                                                </dt>
                                                {foreach from=$skil.description item=descr}
                                                    <dd id="skill_description{$skil.id}">{$descr.desc}</dd>
                                                {/foreach}
                                                {if $skil.attachment1 != '' || $skil.attachment2 != '' || $skil.attachment3 != ''}
                                                    <dd style="text-indent: 0px;margin-left: 10px;">
                                                    {if $skil.attachment1 != ''}
                                                        <label title="{$skil.attachment1}" class="text_overflow" id="attachment1{$skil.id}" onclick="download_skill('{$skil.attachment1}')" >
                                                                <i class="icon icon-download"></i>{$skil.attachment1}
                                                        </label>
                                                        </br>
                                                    {/if}
                                                    {if $skil.attachment2 != ''}
                                                        <label title="{$skil.attachment2}" class="text_overflow" id="attachment2{$skil.id}" onclick="download_skill('{$skil.attachment2}')">
                                                                <i class="icon icon-download"></i>{$skil.attachment2}
                                                        </label>
                                                        </br>
                                                    {/if}
                                                    {if $skil.attachment3 != ''}
                                                        <label title="{$skil.attachment3}" class="text_overflow" id="attachment3{$skil.id}" onclick="download_skill('{$skil.attachment2}')">
                                                                <i class="icon icon-download"></i>{$skil.attachment3}
                                                        </label>    
                                                        </br>
                                                    {/if}
                                                    </dd>
                                                {/if}
                                            </dl>
                                            
                                         

                                        {foreachelse}
                                        <div class="alert alert-primary">
				<strong><i class="icon-question-sign"></i></strong>{$translate.no_data_available}
			</div>
                                          {/foreach}
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="span12">
                                <div class="widget" style="margin: 0px 0px 15px ! important;">
                                    <div class="widget-header span12">
                                        <h1>{$translate.email_option}</h1>
                                    </div>
                                    <div class="span12 widget-body-section input-group widget-body-profile-customer-height-fix">
                                         <dl id="email_option">
                                            <dt>{$translate.email_option}</dt>
                                            <dd style="text-indent: 0px;margin-left: 10px;">
                                                <div class="form-check">
                                                    <div class="row-fluid">
                                                        <label>
                                                        <input type="checkbox" value="25"   name="email_option[]" id="email_check_emp_profile" {if 25|in_array:$selected_email_options} checked="checked" {/if} >
                                                            {$translate.employee_profile}
                                                        </label>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <label>
                                                        <input type="checkbox" value="27" name="email_option[]" id="email_check_emp_preferred_time"  {if 27|in_array:$selected_email_options} checked="checked" {/if} >
                                                            {$translate.employee_non_preferred_time}
                                                            
                                                        </label>
                                                    </div>
                                                </div>
                                            </dd>
                                        </dl>
                                </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span6" style="">
                        <div style="margin: 0px;" class="widget">
                            <div class="widget-header span12">
                                <h1>{$translate.emp_administration_contract_head}</h1>
                            </div>
                            <!--WIDGET BODY BEGIN-->
                            <div class="span12 widget-body-section input-group widget-body-arvode-height-fix">
                                <dl class="profile-education-list">
                                    <dt>{$translate.contract_sign}</dt>
                                    {foreach from=$contracts item=contract}
                                        <dd>
                                            {$translate.Signed_documents}<a id="contract_{$contract.id}" href="javascript:void(0);" onclick="contractDownload('{$contract.id}')" title="{$translate.click_to_show}" style="text-decoration: underline;text-shadow: 1px 0 0 #1a0dab;">{$contract.customer_name} {$contract.alloc_date}</a>
                                            {if $contract.sign_date == NULL || $contract.alloc_date == ""}
                                                <input class="btn btn-default pull-right btn-danger btn-sign icon icon-thumbs-up-al" type="button" name="sign_{$contract.id}" id="sign_{$contract.id}" onclick="signContract('{$contract.id}')" value="{$translate.sign}" />
                                            {else}
                                                <span style="margin-right: 5px;" class="label label-success pull-right"><span class="icon-thumbs-up-alt"></span> {$translate.signed}</span>
                                            {/if}

                                            {if $contract.sign_date == NULL || $contract.alloc_date == ""}<div class="terms_section"><i>{$translate.signing_button_agree_company_rules_and_terms}</i></div>{/if}
                                        </dd>
                                    {foreachelse}
                                        <dd>
                                            <div class="alert alert-primary">
                                				<strong><i class="icon-question-sign"></i></strong> {$translate.no_data_available}
                                			</div>
                                       </dd>
                                    {/foreach}
                                    <form>
                                        <input type="hidden" name="contract_ids" id="contract_ids" value="{$contract.id}" />
                                    </form>
                                </dl>
                                <dl class="profile-education-list">
                                    <dt>
                                    {$translate.normal_effect_from}
                                    <div class="input-prepend span4 pull-right" style="" id="datepicker">
                                        <span class="add-on icon-pencil"></span>
                                        <select class="form-control span10" onchange="load_salary()" name="normal_select" id="normal_select">
                                            <option value="0">{$translate.select}</option>
                                            {foreach $employee_normal_dates AS $dates}
                                                <option {if $dates.id == $normal_last_id}selected="selected"{/if} value="{$dates.id}">{$dates.effect_from}</option> 
                                            {/foreach}
                                        </select>
                                    </div>
                                    </dt>
                                    <dt>
                                    <div class="input-prepend span4 pull-right" style="" id="datepicker">
                                    {if $normal_salaries.effect_to == '0000-00-00'}{else} - {$normal_salaries.effect_to}{/if}<br/>
                                    {$normal_salaries.effect_from}
                                </div>
                                </dt>
                                {if $employee_normal_dates}
                                    <dd>{$translate.normal} - {$normal_salaries.normal}</dd>
                                    <dd>{$translate.travel} - {$normal_salaries.travel}</dd>
                                    <dd>{$translate.week_end_travel} - {$normal_salaries.week_end_travel}</dd>
                                    <dd>{$translate.break} - {$normal_salaries.break}</dd>
                                    <dd>{$translate.overtime} - {$normal_salaries.overtime}</dd>
                                    <dd>{$translate.qual_overtime} - {$normal_salaries.quality_overtime}</dd>
                                    <dd>{$translate.more_time} - {$normal_salaries.more_time}</dd>
                                    <dd>{$translate.some_other_time} - {$normal_salaries.some_other_time}</dd>
                                    <dd>{$translate.training_time} - {$normal_salaries.training_time}</dd>
                                    <dd>{$translate.call_training} - {$normal_salaries.call_training}</dd>
                                    <dd>{$translate.personal_meeting} - {$normal_salaries.personal_meeting}</dd>
                                    <dd>{$translate.voluntary} - {$normal_salaries.voluntary}</dd>
                                    <dd>{$translate.complementary} - {$normal_salaries.complementary}</dd>
                                    <dd>{$translate.complementary_oncall} - {$normal_salaries.complementary_oncall}</dd>
                                    <dd>{$translate.more_oncall} - {$normal_salaries.more_oncall}</dd>
                                    <dd>{$translate.standby} - {$normal_salaries.standby}</dd>
                                    <dd>{$translate.work_for_dismissal} - {$normal_salaries.w_dismissal}</dd>
                                    <dd>{$translate.work_for_dismissal_oncall} - {$normal_salaries.w_dismissal_oncall}</dd>
                                    
                                    <dd>{$translate.holiday_big} - {$normal_salaries.holiday_big}</dd>
                                    <dd>{$translate.holiday_big|cat:' '|cat:$translate.oncall} - {$normal_salaries.holiday_big_oncall}</dd>
                                    <dd>{$translate.holiday} - {$normal_salaries.holiday_red}</dd>
                                    <dd>{$translate.holiday|cat:' '|cat:$translate.oncall} - {$normal_salaries.holiday_red_oncall}</dd>
                                {else}
                                    <dd>
                                    
                                     <div class="alert alert-primary">
				<strong><i class="icon-question-sign"></i></strong> {$translate.no_data_available}
			</div> </dd>
                                {/if}
                            </dl>
                            <div class="clearfix"></div>
                            <dl class="profile-education-list">
                                <dt>{$translate.inconv_effect_from}
                                <div class="input-prepend span4 pull-right" style="" id="datepicker">
                                    <span class="add-on icon-pencil"></span>
                                    <select class="form-control span10" onchange="load_salary()" name="inconv_select" id="inconv_select">
                                        <option value="0">{$translate.select}</option>
                                        {foreach $employee_inconvenient_dates AS $inconv_dates}
                                            <option {if $inconv_last_id ==  $inconv_dates.id}selected="selected"{/if} value="{$inconv_dates.id}">{$inconv_dates.effect_from}</option>
                                        {/foreach}         
                                    </select>
                                </div>
                                </dt>
                                <dt>
                                <div class="input-prepend span4 pull-right" style="" id="datepicker">
                                {if $effects.effect_to == '0000-00-00'}{else} - {$effects.effect_to}{/if}<br/>
                                {$effects.effect_from}
                            </div>
                            </dt>
                            {if $employee_inconvenient_dates}
                                {foreach $inconveninet_salaries AS $salaries}
                                    <dd>
                                        {$salaries.name}
                                        <span class="pull-right">{$salaries.amount}</span>
                                    </dd>
                                {/foreach}
                            {else}
                                <dd>
                                <div class="alert alert-primary">
				<strong><i class="icon-question-sign"></i></strong>{$translate.no_data_available}
			</div>
                                </dd>
                                {/if}
                        </dl>
                    </div>
                    <!--WIDGET BODY END-->
                </div>
                <div class="row-fluid">
                </div>
            </div>
            <div class="span6" gdhgdfghfd>

                <div style="margin: 0px;" class="widget">
                    <div class="widget-header span12">
                        <div class="span6">
                                <h1>{$translate.employee_non_preferred_time}</h1>
                        </div>
                        <div class="span6">

                            <button type="button" class="btn btn-default btn-precise btn-add-new pull-right mr">
                                <span class="icon-plus"></span>{$translate.emp_non_prefr_time_addnew}
                            </button>
                            <button id="save_btn" class="btn btn-default btn-normal btn-precise pull-right mr"   type="button" onclick="handleTimeInterval()" style="display: none;"><i class=' icon-save'></i>{$translate.emp_non_prefr_save}</button>
                            <button id="close_btn" class="btn btn-default btn-normal btn-precise pull-right mr  btn-cancel-right" type="button" style="display: none;"><i class='icon-power-off'></i>{$translate.emp_non_prefr_close}</button>
                        </div>
                    </div>
                    <form method="post">
                    <div class="widget-header span12" style="margin-top: 3px !important; margin-left: 0px !important; padding-top: 5px;">
                        
                        <span style="padding-left: 4px; margin-top: 3px !important; float: left;"><input class="non_editable" type="radio" name="pref_selection" value="1" {if $preference_mode == 1}checked = "checked"{/if} onclick="this.form.submit()"></span>
                        <span style="padding-left: 4px; float: left;{if $preference_mode == 1}font-weight: bold;{/if}">{$translate.preferred_time}</span>
                        <span style="margin-top: 3px !important; float: left; margin-left:10px;"><input class="non_editable" type="radio" name="pref_selection" value="0" {if $preference_mode == 0}checked = "checked"{/if} onclick="this.form.submit()"></span>
                        <span style="padding-left: 4px; float: left;{if $preference_mode == 0}font-weight: bold;{/if}">{$translate.non_preferred_time}</span>
                        
                    </div>
                    </form>
                    <!--WIDGET BODY BEGIN-->
                    <div class="span12 widget-body-section input-group widget-body-arvode-height-fix">
                        <div class="span12 " id="new_non_prefered_time" style="display: none;">
                            <div class="widget">
                                <div class="widget-header span12">
                                    <div class="day-slot-wrpr-header-left pull-left">
                                        <h1 style="">{$translate.employee_non_preferred_time}</h1>
                                    </div>
                                    <div class="pull-right day-slot-wrpr-header-left" style="padding: 5px;">
                                        
                                    </div>
                                    <div class="span12 widget-body-section input-group">
                                        <div class="span6">
                                            <div class="row-fluid" id="error_message">
                                            </div>
                                            <div class="row-fluid span12">
                                                <div class="span12">
                                                        <label>{$translate.emp_non_prefr_time_from_date}</label>
                                                </div>
                                                <div class="span12 no-ml">
                                                    <input type="text" class="datepicker span12"  id="from_date" autocomplete="off" />
                                                </div>
                                            </div>
                                            <div class="row-fluid sapn12">
                                                <div class="span12">
                                                    <label>{$translate.emp_non_prefr_time_to_date}</label>
                                                </div>
                                                <div class="span12 no-ml">
                                                    <input type="text" class="datepicker span12" id="to_date" autocomplete="off" />
                                                </div>
                                            </div>

                                            <div class="row-fluid sapn12">
                                                <div class="span12">
                                                    <input type="checkbox" id="copy_to_week">
                                                    {$translate.non_prefered_copy_to_week}
                                                </div>
                                                <div class="span12 no-ml" id="copy_to_week_times" style="display: none;">
                                                    <div class="span12 row-fluid">
                                                        <div class="span2">{$translate.emp_non_prefr_time_from}</div>
                                                        <div class="span2"><input type="text" id="from_date_week"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                        <div class="span2">{$translate.emp_non_prefr_time_to}</div>
                                                        <div class="span2"><input type="text" id="to_date_week" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                        <div class="span2"><button id="set_copy_time" class="btn btn-primary" type="button">{$translate.non_prefered_set}</button></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" id="group_id" value="">
                                        </div>
                                        <div class="span6">
                                            <div class="row-fluid mt" id="day_wrapper">
                                                <div class="row-fluid day-show"  id="day_show1">
                                                    <div class="panel-title collapsed" data-toggle="collapse" data-target="#day1" aria-expanded="false" aria-controls="day1">{$translate.{$week[0].day}}<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
                                                    <div class="collapse mb single-day" id="day1">
                                                        <div class="panel-body span12" data-day="1">
                                                            <div class="span12 row-fluid interval-div">
                                                                <div class="span1"><span class="icon-plus add-new-intervals"></span></div>
                                                                <div class="span2">{$translate.emp_non_prefr_time_from}</div>
                                                                <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                                <div class="span2">{$translate.emp_non_prefr_time_to}</div>
                                                                <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row-fluid day-show"  id="day_show2">
                                                    <div class="panel-title collapsed" data-toggle="collapse" data-target="#day2" aria-expanded="false" aria-controls="day2">{$translate.{$week[1].day}}<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
                                                    <div class="collapse mb single-day" id="day2">
                                                        <div class="panel-body span12" data-day="2">
                                                            <div class="span12 row-fluid interval-div">
                                                                <div class="span1"><span class="icon-plus add-new-intervals"></span></div>
                                                                <div class="span2">{$translate.emp_non_prefr_time_from}</div>
                                                                <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                                <div class="span2">{$translate.emp_non_prefr_time_to}</div>
                                                                <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row-fluid day-show"  id="day_show3">
                                                    <div class="panel-title collapsed" data-toggle="collapse" data-target="#day3" aria-expanded="false" aria-controls="day3">{$translate.{$week[2].day}}<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
                                                    <div class="collapse mb single-day" id="day3">
                                                        <div class="panel-body span12" data-day="3">
                                                            <div class="span12 row-fluid interval-div">
                                                                <div class="span1"><span class="icon-plus add-new-intervals"></span></div>
                                                                <div class="span2">{$translate.emp_non_prefr_time_from}</div>
                                                                <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                                <div class="span2">{$translate.emp_non_prefr_time_to}</div>
                                                                <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row-fluid day-show"  id="day_show4">
                                                    <div class="panel-title collapsed" data-toggle="collapse" data-target="#day4" aria-expanded="false" aria-controls="day4">{$translate.{$week[3].day}}<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
                                                    <div class="collapse mb single-day" id="day4">
                                                        <div class="panel-body span12" data-day="4">
                                                            <div class="span12 row-fluid interval-div">
                                                                <div class="span1"><span class="icon-plus add-new-intervals"></span></div>
                                                                <div class="span2">{$translate.emp_non_prefr_time_from}</div>
                                                                <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                                <div class="span2">{$translate.emp_non_prefr_time_to}</div>
                                                                <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row-fluid day-show"  id="day_show5">
                                                    <div class="panel-title collapsed" data-toggle="collapse" data-target="#day5" aria-expanded="false" aria-controls="day5">{$translate.{$week[4].day}}<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
                                                    <div class="collapse mb single-day" id="day5">
                                                        <div class="panel-body span12 " data-day="5">
                                                            <div class="span12 row-fluid interval-div" >
                                                                <div class="span1"><span class="icon-plus add-new-intervals"></span></div>
                                                                <div class="span2">{$translate.emp_non_prefr_time_from}</div>
                                                                <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                                <div class="span2">{$translate.emp_non_prefr_time_to}</div>
                                                                <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row-fluid day-show"  id="day_show6">
                                                    <div class="panel-title collapsed" data-toggle="collapse" data-target="#day6" aria-expanded="false" aria-controls="day6">{$translate.{$week[5].day}}<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
                                                    <div class="collapse mb single-day" id="day6" >
                                                        <div class="panel-body span12 " data-day="6">
                                                            <div class="span12 row-fluid interval-div">
                                                                <div class="span1"><span class="icon-plus add-new-intervals"></span></div>
                                                                <div class="span2">{$translate.emp_non_prefr_time_from}</div>
                                                                <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                                <div class="span2">{$translate.emp_non_prefr_time_to}</div>
                                                                <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row-fluid day-show"  id="day_show7">
                                                    <div class="panel-title collapsed" data-toggle="collapse" data-target="#day7" aria-expanded="false" aria-controls="day7">{$translate.{$week[6].day}}<span class="icon icon- toggle-icon mr toggler-class pull-right"></span></div>
                                                    <div class="collapse mb single-day" id="day7">
                                                        <div class="panel-body span12" data-day="7">
                                                            <div class="span12 row-fluid interval-div">
                                                                <div class="span1"><span class="icon-plus add-new-intervals"></span></div>
                                                                <div class="span2">{$translate.emp_non_prefr_time_from}</div>
                                                                <div class="span2"><input type="text"  class="span12 no-min-height small-input time-from empty-all" ></div>
                                                                <div class="span2">{$translate.emp_non_prefr_time_to}</div>
                                                                <div class="span2"><input type="text" class="span12 no-min-height small-input time-to empty-all" ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span12 widget-body-section input-group" id="saved_non_preferd_time">
                            <div id="inconve_message_wraper" class="span12 no-min-height no-ml"></div>
                            <div class="table-responsive span12 no-ml">
                                <table id="non_preferd_time_table" class="table table-white table-bordered table-hover table-responsive table-primary table-Anställda" style="margin: 0px; top: 0px;">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px;" class="table-col-center">#</th>
                                            <th style="width: 10em;">{$translate.date_range}</th>
                                            <th style="width: 25em;">{$translate.timing}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {assign i 0}
                                        {assign prev_day ''}
                                        {foreach from=$orderdAllNonPreferedTime item=date_range key=group_id }
                                            {assign i $i+1}
                                            <tr>
                                                <td style="width: 20px;" class="table-col-center center">{$i}</td>
                                                <td class="center">{$date_range[0]['date_from']} {$translate.to} {$date_range[0]['date_to']}</td>
                                                <td>
                                                    {foreach from=$date_range  item=value key=key}
                                                        {if $prev_day neq $value['day']}
                                                            {if $prev_day neq $value['day'] && $key != 0}</div>{/if}

                                                            <div class="day-report" style="width:auto;">
                                                                <h1>{$translate.{$week[$value['day']-1].day}}
                                                                    
                                                                </h1>
                                                                {$value['time_from']}-{$value['time_to']}
                                                                <a href="javascript:void(0);" onclick="handleSingleDelete({$value['id']})">
                                                                        <i class="icon-remove ml mr"></i>
                                                                </a>
                                                                {assign prev_day $value['day']}
                                                        {else}
                                                            {assign prev_day $value['day']}
                                                                <br/>{$value['time_from']}-{$value['time_to']}
                                                                <a href="javascript:void(0);" onclick="handleSingleDelete({$value['id']})">
                                                                        <i class="icon-remove ml mr"></i>
                                                                </a>
                                                        {/if}
                                                    {/foreach}
                                                    {assign prev_day ''}
                                                </td>
                                                <td class="table-col-center">
                                                    <button type="button" class="btn btn-default" title="{$translate.edit}" onclick='edit_non_prefered_time({$date_range|json_encode},{$group_id})'><span class="icon-wrench"></span></button>
                                                    <button type="button" class="btn btn-default no-ml" title="{$translate.delete}" onclick="delete_non_prefered_time('{$group_id}')" style="margin-top: 5px;"><span class="icon-trash"></span></button>
                                                </td>
                                            </tr>
                                        {foreachelse}
                                            <tr class="gradeX">
                                                <td class="text-center" colspan="6">
                                                    <div class="alert alert-info no-ml no-mr">
                                                        <strong><i class="icon-info-sign icon-large"></i> {$translate.message_caption_information}</strong>:  {$translate.no_non_preferred_data_found}
                                                    </div>
                                                </td>
                                            </tr>
                                        {/foreach}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- non_preferred_time ends -->

        <div class="row-fluid">
            <div class="span6" style="">
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin: 0px 0px 15px ! important;" class="widget">
                            <div style="" class="widget-header span12">
                                <div class="day-slot-wrpr-header-left">
                                    <h1>{$translate.time_preference}</h1>
                                </div>
                              
                            </div>
                            <!--WIDGET BODY BEGIN-->
                            <div class="span12 widget-body-section input-group widget-body-profile-time-preference-height-fix">
                                <form method="post" action=""  id="time_preference_form" name="time_preference_form">
                                    <input type="hidden" name="url" id="url" value="{$url_path}" />    
                                    <div class="span12 widget-body-section input-group" style="display:none;">
                                        <div class="row-fluid">
                                            <div style="color:red; display:none;" align="center" id="errormsg" >{$translate.todate_greaterthan_fromdate_error}</div>
                                            {if $errorMessage != ''}<div style="color:red; " align="center" id="posterrormsg" >{$errorMessage}</div>{/if}
                                            {if $deleteMessage != ''} {$deleteMessage} {/if}
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span5">
                                                <div style="margin: 0px;" class="span10">
                                                    <label style="float: left;" class="span10" for="exampleInputEmail1">Från datum :</label>
                                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-calendar"></span>
                                                        <input class="form-control span7" type="text" name="frmdate" id="frmdate" data-date-format="yyyy-mm-dd" maxlength="11" /> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span5">
                                                <div style="margin: 0px;" class="span10">
                                                    <label style="float: left;" class="span10" for="exampleInputEmail1">Till Datum :</label>
                                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-calendar"></span>
                                                        <input class="form-control span7" type="text" name="todate" id="todate" maxlength="11" data-date-format="yyyy-mm-dd" /> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span1" style="margin-top: 17px;">
                                                <input class="btn btn-default btn-option-panel" type="submit" value="{$translate.show}" id="submit" name="submit" />
                                                <input type="hidden" id="hdn_employee" name="hdn_employee" value="{$employees_username}" />
                                                <input type="hidden" id="hdn_tot_employee" name="hdn_tot_employee" value="{$emp_count}" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form method="post" action=""  id="myform" name="myform" >
                                    <input type="hidden" name="hdn_delete" id="hdn_delete" value="" />                
                                </form>
                                <div class="row-fluid">
                                    <div class="row-fluid">
                                        <div style="margin: 15px 0px 0px ! important;" class="span12">
                                            <div id="datashow"></div>
                                            {assign var=number value=0}
                                            {assign var=emp_counter value=$emp_count}
                                            {section name=employee loop=$preferred_time}
                                                <form name="editform{$number}" id="editform{$number}" action="" method="post" >
                                                    <input type="hidden" name="hdn_editform" id="hdn_editform" value="1" />
                                                    <input type="hidden" id="hdn_employee" name="hdn_employee" value="{$employees_username}" />
                                                    <input type="hidden" id="hdn_slot" name="hdn_slot" value="" />
                                                    <table class="table table-bordered table-condensed table-hover table-responsive table-primary " style="margin: 0px ! important; top: 0px; z-index: 0;">
                                                        <thead>
                                                            <tr>
                                                                <th align="right" style="border-bottom:none;display:none;">             
                                                                    <input type="button" name="edit{$number}" id="edit{$number}" value="{$translate.edit}" onclick="document.getElementById('showtable{$number}').style.display = 'none'; document.getElementById('edittable{$number}').style.display = 'block';  document.getElementById('submitslot{$number}').style.display = ''; document.getElementById('cancelslot{$number}').style.display = ''; document.getElementById('edit{$number}').style.display = 'none'; "/>
                                                                    <input type="button" name="delete" id="delete" value="{$translate.delete}" onclick="delrec({$number},{$preferred_time[employee].timeid});"  />
                                                                    &nbsp;&nbsp;<input type="button" name="submitslot{$number}" id="submitslot{$number}" value="{$translate.save}" style="display:none;" onclick="checkthis('{$number}','{$preferred_time[employee].timeid}'); return false;document.editform{$number}.hdn_slot.value = '{$preferred_time[employee].timeid}'; if(document.editform{$number}.editfrmdate.value > document.editform{$number}.edittodate.value){ document.getElementById('errormsg').style.display = 'block'; return false; } else { document.getElementById('errormsg').style.display = 'none'; }  document.editform{$number}.submit();" />
                                                                    &nbsp;&nbsp;<input type="button" name="cancelslot{$number}" id="cancelslot{$number}" value="{$translate.cancel}" onclick="document.getElementById('showtable{$number}').style.display = 'block'; document.getElementById('edittable{$number}').style.display = 'none'; document.getElementById('edit{$number}').style.display = ''; document.getElementById('submitslot{$number}').style.display = 'none'; document.getElementById('cancelslot{$number}').style.display = 'none';" style="display:none;" />    
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                    <table class="table table-bordered table-condensed table-hover table-responsive table-primary " style="margin: 0px ! important; top: 0px; z-index: 0;" id="showtable{$number}">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="8" class="table-col-center center">
                                                                    {$translate.from_date} : {$preferred_time[employee].fromdate} {$translate.to_date} : {$preferred_time[employee].todate}
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tr class="gradeX">
                                                            <th class="table-col-center center">{$translate.day}</th>
                                                            <th class="table-col-center center" colspan="6">{$translate.preferred_time}<br /> {$translate.message_for_preferred_time_format}</th>
                                                            <th class="table-col-center center">{$translate.book_overtime}</th>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center">{$translate.monday}</td>
                                                            <td class="table-col-center left" colspan="6">{$preferred_time[employee][0].preferredtime}</td>
                                                            <td class="table-col-center center">{$preferred_time[employee][0].overtime}</td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center">{$translate.tuesday}</td>
                                                            <td class="table-col-center left" colspan="6">{$preferred_time[employee][1].preferredtime}</td>
                                                            <td class="table-col-center center">{$preferred_time[employee][1].overtime}</td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center">{$translate.wednesday}</td>
                                                            <td class="table-col-center left" colspan="6">{$preferred_time[employee][2].preferredtime}</td>
                                                            <td class="table-col-center center">{$preferred_time[employee][2].overtime}</td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center">{$translate.thursday}</td>
                                                            <td class="table-col-center left" colspan="6">{$preferred_time[employee][3].preferredtime}</td>
                                                            <td class="table-col-center center">{$preferred_time[employee][3].overtime}</td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center">{$translate.friday}</td>
                                                            <td class="table-col-center left" colspan="6">{$preferred_time[employee][4].preferredtime}</td>
                                                            <td class="table-col-center center">{$preferred_time[employee][4].overtime}</td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center">{$translate.saturday}</td>
                                                            <td class="table-col-center left" colspan="6">{$preferred_time[employee][5].preferredtime}</td>
                                                            <td class="table-col-center center">{$preferred_time[employee][5].overtime}</td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center">{$translate.sunday}</td>
                                                            <td class="table-col-center left" colspan="6">{$preferred_time[employee][6].preferredtime}</td>
                                                            <td class="table-col-center center">{$preferred_time[employee][6].overtime}</td>
                                                        </tr>       
                                                    </table>
                                                    <table class="table table-bordered table-condensed table-hover table-responsive table-primary " style="margin: 0px ! important; top: 0px; z-index: 0; display:none;" id="edittable{$number}">
                                                        <input type="hidden" name="table[]" id="table{$number}" value="table{$number}" />
                                                        <thead>
                                                            <tr>
                                                                <th class="table-col-center left" colspan="8">
                                                                    <div class="span5">
                                                                        <label style="float: left;" class="span10" for="exampleInputEmail1">{$translate.from_date}</label>
                                                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-calendar"></span>
                                                                            <input class="form-control span7" type="text"  name="hdn_fromdate" id="editfrmdate{$number}" value="{$preferred_time[employee].fromdate}" maxlength="11" /> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="span5">
                                                                        <label style="float: left;" class="span10" for="exampleInputEmail1">{$translate.to_date}</label>
                                                                        <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-calendar"></span>
                                                                            <input class="form-control span7" type="text" name="hdn_todate" id="edittodate{$number}" value="{$preferred_time[employee].todate}" maxlength="11" /> 
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tr class="gradeX">
                                                            <th class="table-col-center center">{$translate.day}</th>
                                                            <th class="table-col-center center" colspan="6">{$translate.preferred_time}<br />{$translate.message_for_preferred_time_format}</th>
                                                            <th class="table-col-center center">{$translate.book_overtime}</th>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center">{$translate.monday}</td>
                                                            <td class="table-col-center center" colspan="6">
                                                                <input type="text" name="txtday0" id="txtday0" value="{$preferred_time[employee][0].preferredtime}" tabindex="1"  />
                                                                <input type="text" name="error0" value="{$translate.invalid_time_slot}" style="color:red !important; border:none; display:none; " readonly="readonly" />
                                                            </td>
                                                            <td class="table-col-center center">
                                                                {html_checkboxes values=1 selected=$preferred_time[employee][0].overtimeval output='' name="chkday0" id="chkday0"}                    
                                                            </td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center">{$translate.tuesday}</td>
                                                            <td class="table-col-center center" colspan="6" >
                                                                <input type="text" name="txtday1" id="txtday1" value="{$preferred_time[employee][1].preferredtime}" tabindex="2" />
                                                                <input type="text" name="error1" value="{$translate.invalid_time_slot}" style="color:red; border:none; display:none;" readonly="readonly" />
                                                            </td>
                                                            <td class="table-col-center center">
                                                                {html_checkboxes values=1 selected=$preferred_time[employee][1].overtimeval output='' name="chkday1" id="chkday1"} 
                                                            </td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center">{$translate.wednesday}</td>
                                                            <td class="table-col-center center" colspan="6">
                                                                <input type="text" name="txtday2" id="txtday2" value="{$preferred_time[employee][2].preferredtime}" tabindex="3" />
                                                                <input type="text" name="error2" value="{$translate.invalid_time_slot}" style="color:red; border:none; display:none;" readonly="readonly" />
                                                            </td>
                                                            <td class="table-col-center center">
                                                                {html_checkboxes values=1 selected=$preferred_time[employee][2].overtimeval output='' name="chkday2" id="chkday2"} 
                                                            </td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center">{$translate.thursday}</td>
                                                            <td class="table-col-center center" colspan="6">
                                                                <input type="text" name="txtday3" id="txtday3" value="{$preferred_time[employee][3].preferredtime}" tabindex="4" />
                                                                <input type="text" name="error3" value="{$translate.invalid_time_slot}" style="color:red; border:none; display:none;" readonly="readonly" />
                                                            </td>
                                                            <td class="table-col-center center">
                                                                {html_checkboxes values=1 selected=$preferred_time[employee][3].overtimeval output='' name="chkday3" id="chkday3"} 
                                                            </td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center">{$translate.friday}</td>
                                                            <td class="table-col-center center" colspan="6">
                                                                <input type="text" name="txtday4" id="txtday4" value="{$preferred_time[employee][4].preferredtime}" tabindex="5" />
                                                                <input type="text" name="error4" value="{$translate.invalid_time_slot}" style="color:red; border:none; display:none;" readonly="readonly" />
                                                            </td>
                                                            <td class="table-col-center center">
                                                                {html_checkboxes values=1 selected=$preferred_time[employee][4].overtimeval output='' name="chkday4" id="chkday4"}                     
                                                            </td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center">{$translate.saturday}</td>
                                                            <td class="table-col-center center" colspan="6">
                                                                <input type="text" name="txtday5" id="txtday5" value="{$preferred_time[employee][5].preferredtime}" tabindex="6" />
                                                                <input type="text" name="error5" value="{$translate.invalid_time_slot}" style="color:red; border:none; display:none;" readonly="readonly" />
                                                            </td>
                                                            <td class="table-col-center center">
                                                                {html_checkboxes values=1 selected=$preferred_time[employee][5].overtimeval output='' name="chkday5" id="chkday5"}                     
                                                            </td>
                                                        </tr>
                                                        <tr class="gradeX">
                                                            <td class="table-col-center center">{$translate.sunday}</td>
                                                            <td class="table-col-center center" colspan="6">
                                                                <input type="text" name="txtday6" id="txtday6" value="{$preferred_time[employee][6].preferredtime}" tabindex="7" />
                                                                <input type="text" name="error6" value="{$translate.invalid_time_slot}" style="color:red; border:none; display:none;" readonly="readonly" />
                                                            </td>
                                                            <td class="table-col-center center">
                                                                {html_checkboxes values=1 selected=$preferred_time[employee][6].overtimeval output='' name="chkday6" id="chkday6"} 
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    {assign var=emp_counter value=$emp_counter-1}
                                                    {assign var="number" value=$number+1}
                                                </form>
                                            {/section}
                                        </div>        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
        <!--////////////////////////////////////MAIN LEFT END\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
        <!--////////////////////////////////////MAIN RIGHT BEGIN\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\-->
        <div class="span4 main-right" style="margin: 0px 0px 0px 5px; padding: 5px; display: block; width: 32%;">
          
             <!-- <div class="row-fluid">
                <div class="span12 upload-document-visible" style="margin-left: 0px;">
                    <div style="margin: 0px ! important;" class="widget">
                        <form method="post" name="doc_form" action="{$url_path}employee/administration/" enctype="multipart/form-data">
                            <div style="" class="widget-header span12">
                                <div class="span5 day-slot-wrpr-header-left span6">
                                    <h1 style="">{$translate.upload_document}</h1>
                                </div>
                                <div class="pull-right day-slot-wrpr-header-left span7" style="padding: 5px;">
                                    <button class="btn btn-default btn-normal pull-right btn-upload-file" name="save_doc" type="submit" value="{$translate.save}"><span class="icon-save"></span> {$translate.save}</button>
                                    <button class="btn btn-default btn-normal  pull-right btn-cancel-upload btn-margin-rgt" type="button"><span class="icon-arrow-left"></span> {$translate.cancel}</button>
                                </div>
                            </div>
                            <div class="span12 widget-body-section input-group email-list-box">
                                <div class="row-fluid">
                                    <div class="span12" style="margin:0">
                                        <div style="background: none repeat scroll 0px center transparent; margin: 0px ! important; padding: 0px;" class="btn btn-default btn-file">
                                            <span style="margin-right: 8px;" class="fileupload-new">Select file</span>
                                            <input class="margin-none" type="file" name="file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
            <div class="row-fluid">
                <div class="span12 sigin-box" style="margin-left: 0px;">
                    <div style="margin: 0px ! important;" class="widget">
                        <div style="" class="widget-header span12">
                            <div class="span6 day-slot-wrpr-header-left span6">
                                <h1 style="">Enter your password</h1>
                            </div>
                            <div class="pull-right day-slot-wrpr-header-left span6" style="padding: 5px;">
                                <button class="btn btn-default btn-normal pull-right btn-upload-file" style="" type="button">Signin</button>
                                <button class="btn btn-default btn-normal pull-right btn-cancel-upload" style="" type="button">Cancel</button>
                            </div>
                        </div>
                        <!--WIDGET BODY BEGIN-->
                        <div class="span12 widget-body-section input-group email-list-box">
                            <div class="row-fluid">
                                <div style="margin: 0px 0px 10px ! important;" class="span12">
                                    <label style="float: left;" class="span12" for="exampleInputEmail1">Password</label>
                                    <div style="margin: 0px;" class="input-prepend date hasDatepicker span12" id="datepicker"> <span class="add-on icon-pencil"></span>
                                        <input placeholder="Förnamn*" class="form-control span10" id="exampleInputEmail1" type="password"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--WIDGET BODY END-->
                    </div>
                </div>
            </div>
           <!--  <div class="row-fluid">
                 <div class="span12 edit_skill_right" style="margin-left: 0px; display: none;">
                    <div style="margin: 0px ! important;" class="widget">
                        <form method="post" name="doc_form" action="" enctype="multipart/form-data">
                             <div style="" class="widget-header span12">
                                <div class="span5 day-slot-wrpr-header-left span6">
                                    <h1 style="">{$translate.upload_document}</h1>
                                </div>

                                <div class="pull-right day-slot-wrpr-header-left span7" style="padding: 5px;">
                                    <button class="btn btn-default btn-normal pull-right" name="save_edit_doc" type="submit" value="{$translate.save}" ><span class="icon-save"></span> {$translate.save}</button>
                                    <button class="btn btn-default btn-normal  pull-right btn-edit-back" type="button"><span class="icon-arrow-left"></span> {$translate.cancel}</button>
                                </div>
                                <div class="span12 widget-body-section input-group email-list-box">
                                    <div class="row-fluid">
                                        <div style="margin: 0px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="skills">{$translate.skill}</label>
                                            <div style="margin: 0px 0 10px 0" class="input-prepend date hasDatepicker span12"> <span class="add-on icon-pencil"></span>
                                                <input class="form-control span10 non_editable" type="text" name="skills" id="skills_edit" /> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div style="margin: 0px ! important;" class="span12">
                                            <label style="float: left;" class="span12" for="description">{$translate.description}</label>
                                            <textarea class="form-control span12 non_editable" name="description" id="description_edit"></textarea>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div style="margin: 0px ! important;" class="span12">
                                            <label style="float: left;" class="span12">{$translate.upload_document}</label>
                                            <div class="attachment1" style="margin-top: 25px;"></div>
                                            <div class="attachment2" style="padding-top: 10px;"></div>
                                            <div class="attachment3" style="padding-top: 10px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </form>
                    </div>
                </div>
            </div> -->
        </div>
</form>
</div>
{/block}