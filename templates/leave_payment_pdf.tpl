{block name='script'}
<script type="text/javascript">
    function loadCustomers(){
        var year = $("#year").val();
        var month = $("#month").val();
        alert(year);
        alert(month);
        document.location.href='{$url_path}leave_payment_pdf.php?year='+year+'&month='+month;
    }
    
    function loadEmployees(){
        var year = $("#year").val();
        var month = $("#month").val();
        var customer =$("#customer").val();
        document.location.href='{$url_path}leave_payment_pdf.php?year='+year+'&month='+month+'&cust='+customer;
    }
    
    function submitForm(){
        $('#form').submit();
    }
</script>
{/block}
{block name="content"}
<form id="form" name="form" method="post" action="{$url_post}leave_payment_pdf.php" >
<select id="year" name="year">
    <option value="">Select</option>
    <option value="2011" {if $year == 2011}selected="selected" {/if}>2011</option>
    <option value="2012" {if $year == 2012}selected="selected" {/if}>2012</option>
</select>
<select id="month" name="month" onchange="loadCustomers()">
    <option value="">Select</option>
    <option value="01" {if $month == 01}selected="selected" {/if}>jan</option>
    <option value="02" {if $month == 02}selected="selected" {/if}>feb</option>
    <option value="03" {if $month == 03}selected="selected" {/if}>mar</option>
    <option value="04" {if $month == 04}selected="selected" {/if}>apr</option>
    <option value="05" {if $month == 05}selected="selected" {/if}>may</option>
    <option value="06" {if $month == 06}selected="selected" {/if}>june</option>
    <option value="07" {if $month == 07}selected="selected" {/if}>july</option>
    <option value="08" {if $month == 08}selected="selected" {/if}>aug</option>
    <option value="09" {if $month == 09}selected="selected" {/if}>sept</option>
    <option value="10" {if $month == 10}selected="selected" {/if}>oct</option>
    <option value="11" {if $month == 11}selected="selected" {/if}>nov</option>
    <option value="12" {if $month == 12}selected="selected" {/if}>dec</option>
</select>
<select id="customer" name="customer" onchange="loadEmployees()">
    <option value="">select</option>
{foreach from=$customers item=customer}
    <option value="{$customer.customer_id}" {if $cust== $customer.customer_id}selected="selected" {/if} >{$customer.cust}</option>
{/foreach}
</select>
<select id="employee" name="employee" onchange="submitForm()">
     <option value="">select</option>
{foreach from=$employees item=employee}
    <option value="{$employee.employee_id}">{$employee.employee}</option>
{/foreach}
</select>
</form>
<table border="1">
    <tr><th>Namn på vikarie</th><TH>Datum</th><th>Klockslag</th><th>Löntyp</th><th>Ant tim</th><th>Timlön</th><th>Soc.</th></tr>
    {assign i 0}
    {foreach from=$relations item=relation}
        <tr><td>{$relation.relation}</td><td>{$relation.date}</td><td>{$relation.time_from} {$relation.time_to}</td><td>{$relation.inconv}</td><td>{$relation.tot_time}</td><td><input type="text" name="time_{$i}" /></td><td><input type="text" name="soc_{$i}" /></td></tr>
        {assign i $i+1}
    {/foreach}
</table>
{/block}