// JavaScript Document

function adddata(){	
	document.getElementById("hdn_alpha").value = '';
	var emp = document.getElementById("employee-id").value;	
	var frmdate = document.getElementById("frmdate").value;
	var todate = document.getElementById("todate").value;
	
	var host = document.getElementById("url").value;
	if(frmdate > todate && todate != '' && frmdate != '')
	{
		document.getElementById("errormsg").style.display = 'block';
		return false;	
	}
	else
	{
		document.getElementById("errormsg").style.display = 'none';
	}
	document.getElementById("loading").style.display = 'block';
		
	//var url = host+"report/getgrid/employee/emp/";
	var url = host+"report/getgrid/customer/emp/";
	
	if(emp != '') {
		emp = emp.replace(' ','_');
		url += emp+"/";
	}
	else{
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
        
        
        var selected_leave_types = $('#leave_types input.leave_type:checkbox:checked').map(function () {
                return this.value;
        }).get().join(':');
        url += selected_leave_types+'/';
	
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
	
	/*var xmlhttp;	
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{		//document.getElementById("loader").style.display = 'none';	
			document.getElementById("showdata").innerHTML = '';
			document.getElementById("showdata").innerHTML=xmlhttp.responseText;
			document.getElementById("loading").style.display = 'none';
		}
	}	
	xmlhttp.open("GET",url,true);
	xmlhttp.send();*/
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
	
	//var frmdate = document.getElementById("frmdate").value;
	//var todate = document.getElementById("todate").value;
	document.getElementById("frmdate").value = '';
	document.getElementById("todate").value = '';
	document.getElementById("errormsg").style.display = 'none';
	
	
	var frmdate = "0000-00-00";
	var todate = "0000-00-00";
	
	var host = document.getElementById("url").value;
		
	//var url = host+"report/getgrid/employee/emp/"; 
	var url = host+"report/getgrid/customer/emp/";
	
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
        
	/*var xmlhttp;	
	
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{		//document.getElementById("loader").style.display = 'none';	
			document.getElementById("showdata").innerHTML = '';
			document.getElementById("showdata").innerHTML=xmlhttp.responseText;
			document.getElementById("loading").style.display = 'none';
		}
	}	
	xmlhttp.open("GET",url,true);
	xmlhttp.send();*/
	return false;

}

function pdfdownload()
{	
	var emp = document.getElementById("employee-id").value;		
	var frmdate = document.getElementById("frmdate").value;
	var todate = document.getElementById("todate").value;
	var host = document.getElementById("url").value;
	var alphaemp = document.getElementById("hdn_alpha").value;	
	
	//var url = host+"custleave/pdfdownload/emp/";
	var url = host+"report/absence/customer/emp/";
	 
	
	if(emp != '')
	{
		emp = emp.replace(' ','_');		
		url += emp+"/";
	}
	else
	{
		
		if(alphaemp != '')
		{
			url += alphaemp+"/";
		}
		else
		{
			url += "-/";		
		}
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
        
        
        var selected_leave_types = $('#leave_types input.leave_type:checkbox:checked').map(function () {
                return this.value;
        }).get().join(':');
        url += selected_leave_types+'/';
		
	//myWindow=window.open(url,'Employee Leave PDF','width=200,height=100');
	myWindow=window.open(url);
	myWindow.focus();
	return false;
}