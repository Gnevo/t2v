// JavaScript Document

function adddata(){	
	var emp = document.getElementById("employee-id").value;	
	var emptxt = document.getElementById("emp").value;	
	var frmdate = document.getElementById("frmdate").value;
	var todate = document.getElementById("todate").value;
	var error = 0;
	
	if(emptxt.length < 4)
	{
		document.getElementById('emp').style.borderColor = 'red';
		return false;
	}
	else
	{
		document.getElementById('emp').style.borderColor = '';
	}
	
	if(emptxt == '')
	{
		document.getElementById('emp').style.borderColor = 'red';
		error = 1;
	}
	else
	{
		document.getElementById('emp').style.borderColor = '';
	}
	
	if(frmdate == '')
	{
		document.getElementById('frmdate').style.borderColor = 'red';
		error = 1;
	}
	else
	{
		document.getElementById('frmdate').style.borderColor = '';
	}
	
	if(todate == '')
	{
		document.getElementById('todate').style.borderColor = 'red';
		error = 1;
	}
	else
	{
		document.getElementById('todate').style.borderColor = '';
	}	
	
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
	if(error == 1)
	{
		return false;	
	}
	
	document.getElementById("loading").style.display = 'block';
		
	var url = host+"hourly/customerdata/emp/";	
	 
		
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
	var emptxt = document.getElementById("emp").value;		
	var frmdate = document.getElementById("frmdate").value;
	var todate = document.getElementById("todate").value;
	var error = 0;
	
	if(emptxt.length < 4)
	{
		document.getElementById('emp').style.borderColor = 'red';
		return false;
	}
	else
	{
		document.getElementById('emp').style.borderColor = '';
	}
	
	if(emptxt == '')
	{
		document.getElementById('emp').style.borderColor = 'red';
		error = 1;
	}
	else
	{
		document.getElementById('emp').style.borderColor = '';
	}
	
	if(frmdate == '')
	{
		document.getElementById('frmdate').style.borderColor = 'red';
		error = 1;
	}
	else
	{
		document.getElementById('frmdate').style.borderColor = '';
	}
	
	if(todate == '')
	{
		document.getElementById('todate').style.borderColor = 'red';
		error = 1;
	}
	else
	{
		document.getElementById('todate').style.borderColor = '';
	}	
	
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
	if(error == 1)
	{
		return false;	
	}
	

	var host = document.getElementById("url").value;
	var url = host+"hourly/customer/pdfdownload/";
	
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
		
	//myWindow=window.open(url,'Employee Leave PDF','width=200,height=100');
	myWindow=window.open(url);
	return false;
}