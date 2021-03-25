{if $error==1}
    
    {$translate.overlapped_contract_period}
   
{else if $error==2}
    {$translate.to_date_greaterthan_from_date}
  
 {else if $error==3}
     {$translate.the_hours_greater_than_days}

{/if}