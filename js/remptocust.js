
function changeorder(order)
{
	document.getElementById("hdn_order").value = order;	
	document.getElementById("loading").style.display = 'block';
	var host = document.getElementById("url").value;
	var order = document.getElementById("hdn_order").value;	
	var url = host+"report/employeedata/qstr/"; 
	
	var check1 = document.getElementById('check1');
	var check2 = document.getElementById('check2');
	
	var aplpha = document.getElementById("hdn_alpha").value;
	
	if(aplpha != '' || aplpha != ' ')
	{
		url += aplpha+"/";		
	}
	else
	{
		url += "-/";	
	}	
	
	if(check1.checked == true && check2.checked == false)
	{
		url += document.getElementById('check1').value+"/";
	}			
	else if(check1.checked == false && check2.checked == true)
	{
		url += document.getElementById('check2').value+"/";
	}	
	else
	{
		url += "-/";
	}	
	url += order+"/";
        
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
        /*
	var xmlhttp;	
	
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
function fillemp(myval)
{
	document.getElementById("emp").value = myval;
	document.getElementById("suggest").innerHTML = '';
}

function adddata()
{	
	document.getElementById("hdn_alpha").value = '';
	document.getElementById("loading").style.display = 'block';
	
	var selyear = document.getElementById("cmb_year").value;

	var host = document.getElementById("url").value;
				
	//var url = host+"report/employeedata/qstr/"; 	
	var url = host+"report/emptocust/qstr/"; 	
	
	url += "-/";		
	
	if(selyear != '' || selyear != '' )
	{
		url += selyear+"/";	
	}
	else
	{
		url += "-/";		
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
        
        /*
	var xmlhttp;	
	
	
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
	document.getElementById('showmain'+divid+'').style.display = '';
	return false;
}


//for alphabets
function select_employee(alpha)
{	

	document.getElementById("hdn_alpha").value = alpha;
	document.getElementById("loading").style.display = 'block';
	
	var selyear = document.getElementById("cmb_year").value;

	var host = document.getElementById("url").value;
				
	//var url = host+"report/employeedata/qstr/"; 	
	var url = host+"report/emptocust/qstr/"; 
	
	if(alpha != '' || alpha != '' ){
		url += alpha+"/";	
	}
	else{
		url += "-/";		
	}		
	
	/*if(selyear != '' || selyear != '' )
	{
		url += selyear+"/";	
	}
	else
	{
		url += "-/";		
	}	*/	
	
	url += "-/";		
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
          /*      
	var xmlhttp;	
	//document.getElementById("loader").style.display = 'block';
	
	
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
			document.getElementById("showdata").innerHTML = xmlhttp.responseText;
			document.getElementById("loading").style.display = 'none';
		}
	}	
	xmlhttp.open("GET",url,true);
	xmlhttp.send();*/
	
	return false;

}

function pdfdownload()
{
	var selyear = document.getElementById("cmb_year").value;
	var alpha = document.getElementById("hdn_alpha").value;	
	var host = document.getElementById("url").value;
	//var url = host+"emptocust/pdfdownload/qstr/";
	var url = host+"employeetocustomer/pdfdownload/qstr/";
		
	if(alpha != '' || alpha != '' )
	{
		url += alpha+"/";	
	}
	else
	{
		url += "-/";		
	}	
	
	if(selyear != '' || selyear != '' )
	{
		url += selyear+"/";	
	}
	else
	{
		url += "-/";		
	}	
	
	/*alert(url);
	return false;	*/
	
	//myWindow=window.open(url,'Employee To Customer PDF','width=200,height=100');
	myWindow=window.open(url);
	myWindow.focus();
	return false;
}