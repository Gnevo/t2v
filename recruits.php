<?php
  $m='212121212';
  $m1=  str_split($m,1);
//  echo $m.'<br>';
//  print_r($m1);exit();
  $number=$_REQUEST['personal_number'];
  // $applicant_id=$_REQUEST['app_id'];
  $m2=  str_split($number,1);
  $number_of_digit= strlen($number);
  $result = '';
  if($number_of_digit==10){
      if(is_numeric($number)){
          for($x=0;$x<count($m1);$x++){
               $result.= $m1[$x]*$m2[$x];
          }
          $r=array_sum(str_split($result, 1));
//          echo "$r";
//          if($r!=0){
//              $a=$r%10;
//              $b=$b+$a;
//              $r=$r/10;
//              
////          }
//          return $b;
//          return $result;
//          $result1=array_sum($result);
          $c=substr($r,-1);
          $d=substr($number,-1);
          if($d==$c && $d==0)
          {
              echo "true";
            
          }
          else{
              $c=10-$c;
              if($c==$d){
                  echo "true";
                  
              }
          
         else{
                  echo "false";
             }
      }
      
         }else{
             echo "false";
         }
   }
   else
   {
       echo "false";
   }
?>