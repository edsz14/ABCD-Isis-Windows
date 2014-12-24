<?php
session_start();
if (!isset($_SESSION["permiso"])){
	header("Location: ../common/error_page.php") ;
}
include("../common/get_post.php");

if (isset($arrHttp["Expresion"]) and $arrHttp["Expresion"]!="")
	$arrHttp["Opcion"]="buscar";
//foreach ($arrHttp as $var=>$value) echo "$var=$value<br>";//die;
include("../config.php");


include("../lang/soporte.php");
include("../lang/admin.php");
set_time_limit(0);


include("leer_fdt.php");

//error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
global  $arrHttp,$xWxis;

// ==================================================================================================
// INICIO DEL PROGRAMA
// ==================================================================================================

//



//foreach ($arrHttp as $val=>$value) echo "$val=$value<br>";
include ("../common/header_display.php");
?>
<script>
function Presentar(Mfn){	url="leer_all.php?base=<?php echo $arrHttp["base"]?>&cipar=<?php echo $arrHttp["base"]?>.par&Mfn="+Mfn+"&count=1"
	msgwin=window.open(url,"SEE","width=400,height=400,resizable,scrollbars")
	msgwin.focus()}
</script>
<body>
<div class="sectionInfo">
	<div class="breadcrumb">
<?php echo $msgstr["m_busquedalibre"].": ".$arrHttp["base"]?>
	</div>
	<div class="actions">
<?php echo "<a href=\"freesearch.php?base=".$arrHttp["base"]."\"  class=\"defaultButton backButton\">";?>

		<img src="../images/defaultButton_iconBorder.gif" alt="" title="" />
		<span><strong><?php echo $msgstr["regresar"]?></strong></span></a>
	</div>
	<div class="spacer">&#160;</div>
</div>
<?php
$base =$arrHttp["base"];
$cipar =$arrHttp["cipar"];
if (!isset($arrHttp["count"]))
	$arrHttp["count"]=200;

//foreach ($arrHttp as $key => $value) echo "$key = $value <br>";
// se lee el archivo mm.fdt
if (!isset($_SESSION["login"])){
  	echo $msgstr["menu_noau"];
  	die;
}
if (!isset($arrHttp["nuevo"])) {
    $arrHttp["nuevo"]="";
}
$Fdt=LeerFdt($base);
$Pft="";
if ($arrHttp["fields"]=="ALL;"){
	foreach ($Fdt as $tag=>$linea){		if (trim($linea)!=""){
			$t=explode('|',$linea);
			if ($t[0]!="S" and $t[0]!="H" and $t[0]!="L" and $t[0]!="LDR"){
	  			if (trim($t[1])!="")
	  				$Pft.="(if p(v".$t[1].") then '".$t[1]." 'v".$t[1]."'____$$$' fi),";
	  		}
		}
	}
}else{	$t=explode(';',$arrHttp["fields"]);
	foreach ($t as $value){		if (trim($value)!="" and trim($value)!="ALL"){			$Pft.="(if p(v".$value.") then '".$value."= 'v".$value."'____$$$' fi),";		}	}}
$IxMfn=0;
if (!isset($arrHttp["from"])){
	$desde=1;
}else{
	$desde=$arrHttp["from"];
}
if (isset($arrHttp["count"])){
	$hasta=$desde+$arrHttp["count"]-1;
	$count=$arrHttp["count"];
}else{
	if (isset($arrHttp["hasta"])){
		$count=$arrHttp["hasta"];
	}else{
		$count=10;
	}
}
if (isset($arrHttp["to"]))
	$total=$arrHttp["to"];
if (isset($arrHttp["total"]))
	$total=$arrHttp["total"];
//echo $arrHttp["anterior"];
include("../common/header.php");
echo "
	<div class=\"helper\">
	<a href=../documentacion/ayuda.php?help=". $_SESSION["lang"]."/freesearch.html target=_blank>".$msgstr["help"]."</a>&nbsp &nbsp";
	if (isset($_SESSION["permiso"]["CENTRAL_EDHLPSYS"]))
		echo "<a href=../documentacion/edit.php?archivo=".$_SESSION["lang"]."/freesearch.html target=_blank>".$msgstr["edhlp"]."</a>";
	echo "<font color=white>&nbsp; &nbsp; Script: dataentry/freesearch_ex.php</font>";
	echo "

	</div>
	 <div class=\"middle form\">
			<div class=\"formContent\">

	<form name=tabla method=post action=freesearch_ex.php>
	<br><br><center>
";
	echo "<center><div style=\"width:700px;border-style:solid;border-width:1px; text-align: left;\">";
	if (isset($arrHttp["from"])){		echo $msgstr["cg_from"].": ".$arrHttp["from"]." &nbsp; &nbsp; ".$msgstr["cg_to"].": ";
		if (isset($arrHttp["to"]))
			echo $arrHttp["to"];
		else
			echo $total;
		echo "<br>";	}
	if (isset($arrHttp["Expresion"])){
		echo $msgstr["cg_search"].": ".$arrHttp["Expresion"]."<br>";	}
	echo "<strong>".$msgstr["cg_locate"].": ".$arrHttp["search"]."</strong>";
	echo "</div>";
?>
<center>
<table bgcolor=#cccccc cellspacing=1 border=0 cellpadding=5>
<tr><td bgcolor=white align=center> </td><td bgcolor=white align=center>Mfn</td><td bgcolor=white align=center>
    </td>
<?php
$arr_mfn=array();
if (!isset($arrHttp["Expresion"])){
	//se construye el rango de Mfn's a procesar
	for ($ix=$desde;$ix<=$hasta;$ix++){		$arr_mfn[$ix]=$ix;	}
	$Opcion="rango";
}else{

	$query="&base=".$arrHttp["base"]."&cipar=$db_path"."par/".$arrHttp["cipar"];
	$query.="&Formato=mfn/&Expresion=".urlencode(stripslashes($arrHttp["Expresion"]))."&Opcion=".$arrHttp["Opcion"];
	$query.="&from=$desde&count=$count";
	$IsisScript=$xWxis."act_tabla.xis";
	include("../common/wxis_llamar.php");
	$ix=0;
	foreach ($contenido as $value){
		if (trim($value)!="") {
			$ix++;
			$val=explode('|',$value);
			$pos=explode('$$',$val[0]);
			if (!isset($total)){				$total=$pos[2];
				echo $msgstr["registros"]."=$total";

			}			$arr_mfn[$ix]=$val[1];
		}	}
	$Opcion="busqueda";
}
$tope=count($arr_mfn);
$cuenta=$desde-1;
foreach ($arr_mfn as $Mfn){
 	$IxMfn=$IxMfn+1;
 	$cuenta=$cuenta+1;
  	$query="&base=".$arrHttp["base"]."&cipar=$db_path"."par/".$arrHttp["cipar"]."&Mfn=$Mfn&count=1";
	$query.="&Formato=".urlencode($Pft)."&Opcion=rango";
	$contenido="";
	$IsisScript=$xWxis."act_tabla.xis";
	include("../common/wxis_llamar.php");
	$nfilas=0;

	$Actualizar="";
	foreach ($contenido as $linea){
		if (trim($linea)=="") continue;
		$xcampos=explode('|',$linea);
   		$linea=$xcampos[0];
   		$tope=$xcampos[1];
   		$valor=$xcampos[2];
   		if (stristr($valor,$arrHttp["search"])!==false){
   			$val=explode('____$$$',$valor);
   			echo "<tr>";
   			echo "<td bgcolor=white valign=top>".$cuenta."/$total</td>";
   			echo "<td bgcolor=white valign=top>".$xcampos[1]."</td><td bgcolor=white valign=top>";
   			foreach ($val as $cont) {   				$ixc=stripos($cont,$arrHttp["search"]);

   				if ($ixc!==false){   					$ixter=strlen($arrHttp["search"]);
   					$cont=substr($cont,0,$ixc)."<font color=red>".substr($cont,$ixc,$ixter)."</font>".substr($cont,$ixter+$ixc);   				}   				echo $cont."<br>";   			}
   			echo "</td>";

         }
		//if ($arrHttp["Opcion"]=='buscar') $tope=$hasta;
	}
}

echo "</table>";

switch ($Opcion){
  	case "rango":
  		$arrHttp["from"]=$Mfn+1;
  		break;
	case "buqueda":
		echo "<br><div style=\"width=700;border-style:solid;border-width:1px \"><font size=1 face=arial>Expresion: ".stripslashes($arrHttp["Expresion"])."<br>Recuperados en la búsqueda : $hasta registros</div>";
		break;
}
foreach ($arrHttp as $var=>$value){	if ($var!="from" and $var!="to")		echo "<input type=hidden name=$var value=\"$value\">\n";}
$hasta=$desde+$count;
if ($hasta>=$total){	$hasta=1;}
echo "<p><font face=arial size=1>
Próximo registro:<input type=text size=5 name=from value='".$hasta."'>,
procesar <input type=text size=5 name=count value=".$count."> registros más
<br><input type=submit value=\"".$msgstr["continuar"]."\"><br>";
echo "<input type=hidden name=total value=$total>\n";
?>
</td>
</form>
</table>

<p>
</div>
</div>
<?php include("../common/footer.php")?>
</body>
</html>
