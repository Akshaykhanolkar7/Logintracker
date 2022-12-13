<?php  
 //excel.php  
 header('Content-Type: application/vnd.ms-excel');  
 header('Content-disposition: attachment; filename='.rand().'.xlsx');  
 echo $_GET["data"];  
 ?>  