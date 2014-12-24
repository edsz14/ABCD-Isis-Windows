<?php session_start();
include("../common/get_post.php");
//foreach ($arrHttp as $var=>$value)    echo "$var=$value<br>";

$path=$arrHttp["environment"];
$ix=strpos($path,'^b');
$path=substr($path,$ix+2);
$ix=strpos($path,"^p");
$path=substr($path,0,$ix-1);

include("../config.php");
$db_path=$path."/";
$_SESSION["lang"]=$arrHttp["lang"];
$lang=$_SESSION["lang"];
include("../lang/prestamo.php");
?>
<html>
<title>Statment</title>
<script src=../dataentry/js/lr_trim.js></script>
<Script>
function EnviarForma(){	if (Trim(document.reserva.usuario.value)==""){		alert("Debe suministrar su número de carnet")
		return	}
	document.reserva.submit()}
function PoliticaReserva(){	msgwin=window.open("politica_reserva.html","politica","width=500,height=400, resizable, scrollbars")
	msgwin.focus()}
</script>
<body>
<font face=arial size=2>
<form name=reserva action=opac_statment_ex.php method=post onsubmit="javascript:return false">
<?php

echo "<p><strong>".$msgstr["statment"]."</strong>";
echo "<p>".$msgstr["usercode"];
echo "<p><input type=text name=usuario>\n";
echo "<input type=hidden name=path_data>\n";
echo "<input type=hidden name=vienede value=ecta_web>\n";
echo " &nbsp; <input type=submit value='".$msgstr["continue"]."' onclick=javascript:EnviarForma()>";
?>
</form>
</font>
</html>

