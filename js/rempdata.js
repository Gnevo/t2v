
function changeorder(order){
    document.getElementById("hdn_order").value = order;
    document.getElementById("loading").style.display = 'block';
    var host = document.getElementById("url").value;
    var order = document.getElementById("hdn_order").value;
    var url = host + "report/employeedata/qstr/";

    var check1 = document.getElementById('check1');
    var check2 = document.getElementById('check2');

    var aplpha = document.getElementById("hdn_alpha").value;

    if (aplpha != '' || aplpha != ' '){
        url += aplpha + "/";
    }
    else{
        url += "-/";
    }

    if (check1.checked == true && check2.checked == false) {
        url += document.getElementById('check1').value + "/";
    }
    else if (check1.checked == false && check2.checked == true) {
        url += document.getElementById('check2').value + "/";
    }
    else {
        url += "-/";
    }
    url += order + "/";

    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#showdata").html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    }).always(function (data) {
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
function fillemp(myval){
    document.getElementById("emp").value = myval;
    document.getElementById("suggest").innerHTML = '';
}

function adddata(){
    document.getElementById("hdn_order").value = 'ascname';
    document.getElementById("hdn_alpha").value = '';
    document.getElementById("loading").style.display = 'block';

    var host = document.getElementById("url").value;
    var order = document.getElementById("hdn_order").value;

    var check1 = document.getElementById('check1');
    var check2 = document.getElementById('check2');

    var url = host + "report/employeedata/qstr/";

    url += "-/";

    if (check1.checked == true && check2.checked == false){
        url += document.getElementById('check1').value + "/";
    }
    else if (check1.checked == false && check2.checked == true){
        url += document.getElementById('check2').value + "/";
    }
    else{
        url += "-/";
    }
    url += order + "/";

    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#showdata").html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    }).always(function (data) {
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

function showgrid(divid){

    var tot = document.getElementById('pages').value;
    if (divid >= tot) {
        return false;
    }
    for (var t = 0; t < tot; t++){
        if (t == divid){
            document.getElementById('showmain' + divid + '').style.display = 'block';
        }
        else{
            document.getElementById('showmain' + t + '').style.display = 'none';
        }
    }
    document.getElementById('showmain' + divid + '').style.display = '';
    return false;
}


//for alphabets
function select_employee(alpha){
    var order = document.getElementById("hdn_order").value = 'ascname';
    document.getElementById("loading").style.display = 'block';
    document.getElementById("hdn_alpha").value = alpha;

    var host = document.getElementById("url").value;
    var url = host + "report/employeedata/qstr/";

    var check1 = document.getElementById('check1');
    var check2 = document.getElementById('check2');

    url += alpha + "/";

    if (check1.checked == true && check2.checked == false)
    {
        url += document.getElementById('check1').value + "/";
    }
    else if (check1.checked == false && check2.checked == true)
    {
        url += document.getElementById('check2').value + "/";
    }
    else
    {
        url += "-/";
    }
    url += order + "/";

    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#showdata").html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        }
    }).always(function (data) {
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

function pdfdownload(){

    /*alert('calling pdf downlaod');	
     return false;
     */
    //document.getElementById("loading").style.display = 'block';

    var order = document.getElementById("hdn_order").value;
    var hdnalpha = document.getElementById("hdn_alpha").value;

    var host = document.getElementById("url").value;
    //var url = host+"activeinactive/pdfdownload/qstr/"; 
    var url = host + "employeedata/pdfdownload/qstr/";

    var check1 = document.getElementById('check1');
    var check2 = document.getElementById('check2');

    var aplpha = document.getElementById("hdn_alpha").value;

    if (aplpha != '' || aplpha != ' '){
        url += aplpha + "/";
    }
    else{
        url += "-/";
    }

    if (check1.checked == true && check2.checked == false){
        url += document.getElementById('check1').value + "/";
    }
    else if (check1.checked == false && check2.checked == true){
        url += document.getElementById('check2').value + "/";
    }
    else{
        url += "-/";
    }
    url += order + "/";

    //myWindow=window.open(url,'Employee Status PDF','width=200,height=100');
    myWindow = window.open(url);
    myWindow.focus();
    return false;
}
function exceldownload(){

    /*alert('calling pdf downlaod');	
     return false;
     */
    //document.getElementById("loading").style.display = 'block';

    var order = document.getElementById("hdn_order").value;
    var hdnalpha = document.getElementById("hdn_alpha").value;

    var host = document.getElementById("url").value;
    //var url = host+"activeinactive/pdfdownload/qstr/"; 
    var url = host + "employeedata/exceldownload/qstr/";

    var check1 = document.getElementById('check1');
    var check2 = document.getElementById('check2');

    var aplpha = document.getElementById("hdn_alpha").value;

    if (aplpha != '' || aplpha != ' '){
        url += aplpha + "/";
    }
    else{
        url += "-/";
    }

    if (check1.checked == true && check2.checked == false){
        url += document.getElementById('check1').value + "/";
    }
    else if (check1.checked == false && check2.checked == true){
        url += document.getElementById('check2').value + "/";
    }
    else{
        url += "-/";
    }
    url += order + "/";

    //myWindow=window.open(url,'Employee Status PDF','width=200,height=100');
    myWindow = window.open(url);
    myWindow.focus();
    return false;
}
function csvdownload(){

    /*alert('calling pdf downlaod');	
     return false;
     */
    //document.getElementById("loading").style.display = 'block';

    var order = document.getElementById("hdn_order").value;
    var hdnalpha = document.getElementById("hdn_alpha").value;

    var host = document.getElementById("url").value;
    //var url = host+"activeinactive/pdfdownload/qstr/"; 
    var url = host + "employeedata/csvdownload/qstr/";

    var check1 = document.getElementById('check1');
    var check2 = document.getElementById('check2');

    var aplpha = document.getElementById("hdn_alpha").value;

    if (aplpha != '' || aplpha != ' '){
        url += aplpha + "/";
    }
    else{
        url += "-/";
    }

    if (check1.checked == true && check2.checked == false){
        url += document.getElementById('check1').value + "/";
    }
    else if (check1.checked == false && check2.checked == true){
        url += document.getElementById('check2').value + "/";
    }
    else{
        url += "-/";
    }
    url += order + "/";

    //myWindow=window.open(url,'Employee Status PDF','width=200,height=100');
    myWindow = window.open(url);
    myWindow.focus();
    return false;
}