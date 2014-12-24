<?php
include ("../config.php");
include ("../common/get_post.php");

/*
var_dump($arrHttp);
echo "<hr>";
*/
$dbn=$arrHttp["base"];
//echo "<br>>> DBN : " .$dbn;


$file_name=$arrHttp["base"].".tab";
/*
var_dump(!$file_name);
echo "<br>>> DBN : " .$file_name;
*/
if (!$file_name){
	echo "Falta archivo de configuración $file_name";
	die;
}
$fp=file($file_name);
foreach ($fp as $value){
	$value=trim($value);
	if (trim($value)!=""){
		if (substr($value,0,1)==";") continue;
		$ix=strpos($value,":");
		if ($ix===false){
			echo "error en el archivo de configuración $file_name";
			die;
		}
		$key=substr($value,0,$ix);
		$value=trim(substr($value,$ix+1));
		//echo "$key=$value<br>";

		$config[$key]=$value;
	}
}
?>
