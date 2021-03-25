// JavaScript Document
function changeweek(week,year,emp)
{
	var host = document.getElementById("url").value;	
	document.getElementById("loading").style.display = 'block';		
	var url = host+"horizontal/customerdata/emp/";
	
	if(emp != '')
	{
		emp = emp.replace(' ','_');
		url += emp+'/';
	}
	else
	{
		url += '-/';
	}
	var month = 0;
	
	var date = year+'-'+month+'-'+week;
	url += date+'/';
	
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
		{	
			document.getElementById("showdata").innerHTML = '';
			document.getElementById("showdata").innerHTML=xmlhttp.responseText;
			document.getElementById("loading").style.display = 'none';
		}
	}	
	xmlhttp.open("GET",url,true);
	xmlhttp.send();*/
	return false;
}

function showdates(obj)
{
	document.getElementById('hdn_table').value = obj;
	for(var t=0;t<7;t++)	
	{
		if(obj == t)
		{
			document.getElementById('mytables'+t).style.display = 'block';	
		}
		else
		{
			document.getElementById('mytables'+t).style.display = 'none';		
		}
	}
	for(var f=0;f<7;f++)	
	{
		if(obj == f)
		{
			document.getElementById('th'+f).style.background = '#A4DEEA';	
		}
		else
		{
			document.getElementById('th'+f).style.background = '#DAF2F7';		
		}
	}
}

//Get weeeks from month and year
function getweek(month)
{
	var month = document.getElementById('month').value;	
	var year = document.getElementById('cmb_year').value;
	
	if(year == 0)
	{
		//document.getElementById('month').disabled = true;
		document.getElementById('cmb_year').style.borderColor = 'red';
		return false;
	}
	else
	{
		//document.getElementById('month').disabled = false;
		document.getElementById('cmb_year').style.borderColor = '';			
		if(month == 00)
		{
			document.getElementById('month').style.borderColor = 'red';
			return false;
		}
		else
		{				
			document.getElementById('month').style.borderColor = '';			
			/*if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}*/
			var host = document.getElementById("url").value;	
			var url = host+"getweek/emp/"; 
			url += year+'/';
			url += month+'/';
			
                        $.ajax({
                            url:url,
                            type: "GET",
                            success:function(data){
                                    $("#weekdiv").html(data);
                            },
                            error: function (xhr, ajaxOptions, thrownError){
                                alert(thrownError);
                            }
                        });

			/*xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{		//document.getElementById("loader").style.display = 'none';		
				document.getElementById("weekdiv").innerHTML=xmlhttp.responseText;
				}
			}	
			xmlhttp.open("GET",url,true);
			xmlhttp.send();	*/	
		}			
	}
}


function adddata()
{	
	document.getElementById('hdn_table').value = '';
	var emp = document.getElementById("employee-id").value;	
	var emptxt = document.getElementById("emp").value;	
	var month = document.getElementById('month').value;	
	var year = document.getElementById('cmb_year').value;	
	var week = document.getElementById('week').value;
	
	
	if(emptxt.length < 4)
	{
		document.getElementById('emp').style.borderColor = 'red';
		return false;
	}
	else
	{
		document.getElementById('emp').style.borderColor = '';
	}
			
	if(emptxt != '')
	{	
		document.getElementById('emp').style.borderColor = '#D9D9D9';	
		//document.getElementById('cmb_year').disabled = false;
		//document.getElementById('month').disabled = false; 
		if(year == 0)
		{
			//document.getElementById('month').disabled = true;
			document.getElementById('cmb_year').style.borderColor = 'red';
			return false;
		}
		else
		{
			//document.getElementById('month').disabled = false;
			document.getElementById('cmb_year').style.borderColor = '';			
			if(month == 00)
			{
				
				document.getElementById('month').style.borderColor = 'red';
				return false;
			}
			else
			{	
				
				if(week == '')
				{
					document.getElementById('week').style.borderColor = 'red';
					return false;
				}
				else
				{
					document.getElementById('week').style.borderColor = '';
				}						
				document.getElementById('month').style.borderColor = '';
				
			}			
		}
	}
	else
	{
		document.getElementById('emp').style.borderColor = 'red';
		//document.getElementById('cmb_year').disabled = true;
		//document.getElementById('month').disabled = true;
		return false;
	}
	
	
	var host = document.getElementById("url").value;	
	document.getElementById("loading").style.display = 'block';		
	var url = host+"horizontal/customerdata/emp/";
	
	
	if(emp != '')
	{
		emp = emp.replace(' ','_');
		url += emp+'/';
	}
	else
	{
		url += '-/';
	}
	
	var date = year+'-'+month+'-'+week;
	url += date+'/';
	
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
		{	
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
	var month = document.getElementById('month').value;	
	var year = document.getElementById('cmb_year').value;	
	var week = document.getElementById('week').value;
	var table = document.getElementById('hdn_table').value;
	var hdn_weeek = document.getElementById('hdn_week').value;
	
	
	
	
	if(emptxt != '')
	{	
		document.getElementById('emp').style.borderColor = '#D9D9D9';	
		//document.getElementById('cmb_year').disabled = false;
		//document.getElementById('month').disabled = false; 
		if(year == 0)
		{
			//document.getElementById('month').disabled = true;
			document.getElementById('cmb_year').style.borderColor = 'red';
			return false;
		}
		else
		{
			//document.getElementById('month').disabled = false;
			document.getElementById('cmb_year').style.borderColor = '';			
			if(month == 00)
			{
				
				document.getElementById('month').style.borderColor = 'red';
				return false;
			}
			else
			{	
				if(week == '')
				{
					document.getElementById('week').style.borderColor = 'red';
					return false;
				}
				else
				{
					document.getElementById('week').style.borderColor = '';
				}				
				document.getElementById('month').style.borderColor = '';
				
			}			
		}
	}
	else
	{
		document.getElementById('emp').style.borderColor = 'red';
		//document.getElementById('cmb_year').disabled = true;
		//document.getElementById('month').disabled = true;
		return false;
	}
	
	if(hdn_weeek != '')
	{
		week = hdn_weeek;
	}
			
	
	var host = document.getElementById("url").value;	
	var url = host+"report/horizontalcust/pdfdownload/emp/";	
	//var url = host+"fpdf/vacationplanningdata/pdfdownload/emp/";
	
	if(emp != '')
	{
		emp = emp.replace(' ','_');
		url += emp+'/';
	}
	else
	{
		url += '-/';
	}
	
	var date = year+'-'+month+'-'+week;
	url += date+'/';
	
	if(table != '')
	{		
		url += table+'/';
	}
	else
	{
		url += '-/';
	}
	
	myWindow=window.open(url);
	myWindow.focus();
	return false;	
}