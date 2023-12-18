<?php
function DateChangeFormat($date){
    
   $date = date_create($date);
   return date_format($date,"d-m-Y");
    
}
?>
