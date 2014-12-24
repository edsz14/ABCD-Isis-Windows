<?php
session_start();
include("../common/get_post.php");
//foreach ($arrHttp as $var => $value) 	echo "$var = $value<br>";
$_SESSION["FDT"]=$arrHttp["ValorCapturado"];
if (isset($arrHttp["encabezado"]))
	$encabezado="&encabezado=S";
else
	$encabezado="";
header("Location:fst.php?Opcion=new&base=".$arrHttp["base"].$encabezado);
?>