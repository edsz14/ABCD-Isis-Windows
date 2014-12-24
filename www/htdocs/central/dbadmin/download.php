<?php    
    $f = $_GET["file"];	
	
	$OS=strtoupper(PHP_OS);    
    if (strpos($OS,"WIN")!= false)
      {
		$f=str_replace ("/", "\\", $f);  
      }	      
   header("Content-type: application/octet-stream");
   header("Content-Disposition: attachment; filename=\"$f\"\n");     
	$fp=fopen("$f", "r");
    fpassthru($fp);
?> 