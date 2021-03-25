// JavaScript Document
function adddata(sort_by, sort_direction){
	document.getElementById("hdn_alpha").value = '';
	var emp = document.getElementById("employee-id").value;	
	var emp_name = document.getElementById("emp").value;	
	var frmdate = document.getElementById("frmdate").value;
	var todate = document.getElementById("todate").value;
        
        
    var search_type = "";
    var search_type_rd = $("#search_type_div input[type='radio'][name='search_type']:checked");
    if (search_type_rd.length > 0)
        search_type = search_type_rd.val();
    var search_customer_id = '-';
    var search_customer_name = '';
    if(search_type == 1){
        search_customer_id = $.trim($("#customer-id").val());
        search_customer_name = $.trim($("#txt_customer").val());
        if($.trim(search_customer_id) == '' && $.trim(search_customer_name) == ''){
            alert('Välj kund');
            return false;	
        }
    }
    /*else if(search_type == 2){
        search_user_id = $.trim($("#employee-id").val());
        search_user_name = $.trim($("#txt_employee").val());
    }*/

    var sort_by_val = sort_direction_val = null;
    if(typeof sort_by != 'undefined'){
    	sort_by_val = sort_by;
    	sort_direction_val = (typeof sort_direction != 'undefined' && sort_direction != '') ? sort_direction : 'ASC';
    }

	var host = document.getElementById("url").value;
	if(frmdate > todate && todate != '' && frmdate != ''){
		document.getElementById("errormsg").style.display = 'block';
		return false;	
	}
	else
		document.getElementById("errormsg").style.display = 'none';
	document.getElementById("loading").style.display = 'block';
	
	var url = host+"report/perofemployementgrid/emp/"+sort_by_val+'/'+sort_direction_val+'/';	
	var today = new Date();
    var mm = today.getMonth()+1; //January is 0!
    if (mm < 10)mm = '0' + mm;
    var yyyy = today.getFullYear();
    var start_date = yyyy+"-"+mm+"-01";
    var end_day = new Date(yyyy, mm, 0).getDate();
    var end_date = yyyy+"-"+mm+"-"+end_day;
	if($.trim(emp) != '' && $.trim(emp_name) != '') {
		emp = emp.replace(' ','_');
		url += emp+"/";
	}else
		url += "-/";
	if(frmdate != ''){
		url += frmdate+"/";
	}else{
		url += start_date+"/";
                frmdate = start_date
	}
	if(todate != ''){
		url += todate+"/";
	}else{
		url += end_date+"/";
                todate = end_date
	}
        url += search_customer_id+"/";
        if (new Date(frmdate) < new Date(todate)){
        
            $.ajax({
                url:url,
                type: "GET",
                success:function(data){
                        $("#showdata").html(data);
                },
                error: function (xhr, ajaxOptions, thrownError){
                    alert(thrownError);
                }
            }).always(function(data) { 
                $("#loading").css('display', 'none');
            });
        }
        else{
            alert("Felaktigt datum");
        }
        
	return false;

}

function showgrid(divid)
{
	
	var tot = document.getElementById('pages').value;
	if(divid >= tot)
	{
		return false;	
	}
	for(var t=0;t<tot;t++)
	{
		if(t == divid)	
		{
			document.getElementById('showmain'+divid+'').style.display = 'block';
		}
		else
		{
			document.getElementById('showmain'+t+'').style.display = 'none';	
		}
	}
	//document.getElementById('showmain'+divid+'').style.display = '';
	return false;
}


//for alphabets
function select_employee(alpha)
{	

	document.getElementById("emp").value = '';
	document.getElementById("employee-id").value = '';
	document.getElementById("loading").style.display = 'block';
	var emp = alpha;
	document.getElementById("hdn_alpha").value = alpha;	
	
	document.getElementById("frmdate").value = '';
	document.getElementById("todate").value = '';
	document.getElementById("errormsg").style.display = 'none';
	
	
	var frmdate = "0000-00-00";
	var todate = "0000-00-00";
	
	var host = document.getElementById("url").value;
		
	//var url = host+"report/getgrid/employee/emp/"; 
	var url = host+"report/perofemployementgrid/emp/";	
	
	if(emp != '')
	{
		emp = emp.replace(' ','_');
		
		url += emp+"/";
	}
	else
	{
		url += "-/";
	}
	if(frmdate != '')
	{
		url += frmdate+"/";
	}
	else
	{
		url += "0000-00-00/";
	}
	if(todate != '')
	{
		url += todate+"/";
	}
	else
	{
		url += "0000-00-00/";
	}
        
	$.ajax({
            url:url,
            type: "GET",
            success:function(data){
                    $("#showdata").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError){
                alert(thrownError);
            }
        }).always(function(data) { 
            $("#loading").css('display', 'none');
        });
        
	return false;

}

function pdfdownload()
{
	var emp = document.getElementById("employee-id").value;		
	var frmdate = document.getElementById("frmdate").value;
	var todate = document.getElementById("todate").value;
	var host = document.getElementById("url").value;
	var alphaemp = document.getElementById("hdn_alpha").value;		
		
        var search_type = "";
        var search_type_rd = $("#search_type_div input[type='radio'][name='search_type']:checked");
        if (search_type_rd.length > 0)
            search_type = search_type_rd.val();
        var search_customer_id = '-';
        var search_customer_name = '';
        if(search_type == 1){
            search_customer_id = $.trim($("#customer-id").val());
            search_customer_name = $.trim($("#txt_customer").val());
            if($.trim(search_customer_id) == '' && $.trim(search_customer_name) == ''){
                alert('Välj kund');
                return false;	
            }
        }
        
	//var url = host+"perofemployment/pdfdownload/emp/"; 
	var url = host+"report/percentageofemployee/emp/"; 
        
        var today = new Date();
        var mm = today.getMonth()+1; //January is 0!
        if (mm < 10)mm = '0' + mm;
        var yyyy = today.getFullYear();
        start_date = yyyy+"-"+mm+"-01";
        end_day = new Date(yyyy, mm, 0).getDate();
        end_date = yyyy+"-"+mm+"-"+end_day;
	
	if($.trim(emp) != '' && $.trim(emp_name) != '') {
		emp = emp.replace(' ','_');		
		url += emp+"/";
	}else{
		
		if(alphaemp != '')
		{
			url += alphaemp+"/";
		}
		else
		{
			url += "-/";		
		}
	}
	if(frmdate != ''){
		url += frmdate+"/";
	}else{
		url += start_date+"/";
                frmdate = start_date;
	}
	if(todate != '')
		url += todate+"/";
	else{
		url += end_date+"/";
                todate = end_date;
	}
        url += search_customer_id+"/";
		
	//myWindow=window.open(url,'Employee Leave PDF','width=200,height=100');
        if (new Date(frmdate) < new Date(todate)){
	myWindow = window.open(url);
	myWindow.focus();
        }else{
            alert("Felaktigt datum");
        }
	return false;
}


$(document).ready(function (){

	$(document).off('click', ".table_list  th.sort_by_percentage")
        .on('click', ".table_list  th.sort_by_percentage", function() {
        		var sort_order = $(this).data('order');
        		var sort_order_val = (sort_order == 'ASC' ? 'DESC' : 'ASC');
                adddata('SORT_BY_PERCENTAGE', sort_order_val);
    });

	$(document).off('click', ".table_list  th.sort_by_contract_percentage")
        .on('click', ".table_list  th.sort_by_contract_percentage", function() {
        		var sort_order = $(this).data('order');
        		var sort_order_val = (sort_order == 'ASC' ? 'DESC' : 'ASC');
                adddata('SORT_BY_CONTRACT_PERCENTAGE', sort_order_val);
    });
});