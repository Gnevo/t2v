{block name='script'}

{literal}
    
<script type="text/javascript">
/*$(document).ready(function(){
  $("#item").keyup(function(){
       var values = $("#item").val();

        $("#vals").load('{$url_path}ajax_items_present.php?val=' + values);
  });
});*/
  
    $(function() {
		var availableTags = [
			{/literal}{assign i 0}{foreach from=$items_names item=itemss}
                     "{$itemss.name}",       
                    {/foreach}{literal}
                        "Add New"
                                
                            
		];
		$( "#item" ).autocomplete({
			source: availableTags,
                        maxWidth: 30
		});
	});
       function check_item()
           {
               alert("hello");
                   }
     function display_price()
     {
         var qty = $("#qty").val();
             
         var item = $("#item").val();
             
         if(qty != "" && item != "")
            {
                    $.ajax({
                            url:"{/literal}{$url_path}{literal}ajax_items_present.php",
                            data:"item="+item+"&qty="+qty,
                            type:"POST",
                            success:function(data){
                                    $("#td_price").html(data);
                            }
                            });
            }
     }
                     
      //{if in_array($needle, $array)}           
   /* $(function() {
		

		$( "#item" ).autocomplete({
			source: "ajax_items_present.php",
			minLength: 2
			 
		});
	});
/*function available_data()
        {
   // function show_hours()
    //{
            var values = $("#item").val(); 
    //	check_dates();
         // alert(values);
                     $.ajax({
                            url:"{$url_path}ajax_items_present.php",
                            data:"val="+values,
                            type:"POST",
                            success:function(data){
                                    $("#vals").html(data);
                            }
                            });
           
    //}
        }*/
	</script>
        
{/literal}
{/block}
{block name="content"}
<form action="{$url_path}material_order.php" method="post" >
<table>
    <tr><td>Employee</td><td><select name=employee>
                {foreach from=$employees item=employee}
                    <option value="{$employee.username}">{$employee.first_name} {$employee.last_name}</option>
                    {/foreach}
            </select></td>
            <td>Customer</td><td><select name="customer">
                {foreach from=$customers item=customer}
                    <option value="{$customer.username}">{$customer.first_name} {$customer.last_name}</option>
                    {/foreach}
                </select></td><td>Item</td><td><div class="ui-widget" style="width: 150px"><input type="text" name="item" id="item" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" /></div>
                </td><td>Qty</td><td><input type="text" name="qty" id="qty" onkeyup="display_price()" onfocus="check_item()" /></td><td>price</td><td><div  id="td_price"><input type="text" name="price" id="price" /></div></td><td><input type="submit" name="saves" value="Save" /></td></tr>
</table>
</form>
                    <table>
                        {assign i 1}
                        <tr><th>SL NO</th><th>Employee</th><th>Customer</th><th>Item</th><th>Order Date</th></tr>
                        {foreach from=$items item=itt}
                            <tr><td>{$i}</td><td>{$itt.employee}</td><td>{$itt.customer}</td><td>{$itt.name}</td><td>{$itt.date}</td><td></td></tr>
                            {assign i $i+1}
                        {/foreach}
                        <tr></tr>
                    </table>
{/block}
