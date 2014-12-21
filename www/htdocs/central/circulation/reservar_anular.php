<?php
session_start();
include("../common/get_post.php");
include("../config.php");
//foreach ($arrHttp as $var=>$value) echo "$var=$value<br>";
//SE ELIMINA LA RESERVA A TRAVÉS DE SU MFN
$query = "&base=reserve&cipar=$db_path"."par/reserve.par&login=abcd&Mfn=" . $arrHttp["Mfn"]."&Opcion=eliminar";
$IsisScript=$xWxis."eliminarregistro.xis";
include("../common/wxis_llamar.php");
header("Location:opac_statment_ex.php?usuario=".$arrHttp["usuario"]."&vienede=ecta_web");

?>
