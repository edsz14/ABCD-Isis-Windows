<?php
/**
 * @program:   ABCD - ABCD-Central - http://reddes.bvsaude.org/projects/abcd
 * @copyright:  Copyright (C) 2009 BIREME/PAHO/WHO - VLIR/UOS
 * @file:      fmt.php
 * @desc:      Search form for z3950 record importing
 * @author:    Guilda Ascencio
 * @since:     20091203
 * @version:   1.0
 * Modified by Marino Borrero to allow RPC
 * == BEGIN LICENSE ==
 *
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU Lesser General Public License as
 *    published by the Free Software Foundation, either version 3 of the
 *    License, or (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU Lesser General Public License for more details.
 *
 *    You should have received a copy of the GNU Lesser General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * == END LICENSE ==
*/
session_start();
set_time_limit(0);
if (!isset($_SESSION["permiso"])){
	header("Location: ../common/error_page.php") ;
}
$lang=$_SESSION["lang"];
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING );
global  $arrHttp, $valortag,$variables,$maxmfn;
global $xEditor,$xUrlEditor,$Marc,$Leader,$fdt,$tab_prop,$Html_ingreso,$tl,$nr;
$tab_prop="";
$ArchivoTexto="";  //para colocar el nombre del archivo de texto para la continuaci�n
$FdtHtml="";
$kardex="";   //para indicar la presencia de una KK
$valortag = Array();
$arrHttp = Array();
$fdt = Array();
$tipom = "";
$fondocelda="#ffffff";
$llamada="";
$query="";
$ver=false;
$base="";
$marc=false;
$ixicampo=-1;
$maxmfn=0;
$etiqueta=Array();
$tl="";
$nr="";
$Mfn="";
$Html_ingreso="";
$Rtl="";
$Rnr="";

require_once("../common/get_post.php");
//foreach ($arrHttp as $var=>$value) echo "$var=$value<br>";
//echo "<xmp>".$arrHttp["ValorCapturado"]."</xmp>";
//die;
require_once("../config.php");
require_once ('leerregistroisis.php');
require_once ('dibujarhojaentrada.php');
require_once ('actualizarregistro.php');
require_once ('plantilladeingreso.php');

require_once ("../lang/dbadmin.php");
require_once ("../lang/admin.php");
//require_once ("../lang/msgusr.php");

include("../common/header.php");



function ReadWorksheetsRights(){global $db_path,$arrHttp,$msgstr,$lang_db;
//READ THE DATAENTRY WORKSHEET TO DETERMINE THE AVAILABILITY FOR THE OPERATOR
	if (file_exists($db_path.$arrHttp["base"]."/def/".$_SESSION["lang"]."/formatos.wks")){
		$fp = file($db_path.$arrHttp["base"]."/def/".$_SESSION["lang"]."/formatos.wks");
	}else{
		if (file_exists($db_path.$arrHttp["base"]."/def/".$lang_db."/formatos.wks"))
			$fp = file($db_path.$arrHttp["base"]."/def/".$lang_db."/formatos.wks");
	}
	$i=0;
	$wks_p=array();
	if (isset($fp)) {
		foreach($fp as $linea){
			if (trim($linea)!="") {
				$linea=trim($linea);
				$l=explode('|',$linea);
				$cod=trim($l[0]);
				$nom=trim($l[1]);
				$avail_wks=0;
				if (isset($_SESSION["permiso"]["CENTRAL_ALL"]) or isset($_SESSION["permiso"][$arrHttp["base"]."_fmt_ALL"]) or isset($_SESSION["permiso"][$arrHttp["base"]."_CENTRAL_ALL"]) or $avail_wks==1){
					$i=$i+1;
					$wks_p[$cod]="Y";
				}
			}
		}
	}
    return $wks_p;
}

function CambiarFormatoRegistro(){// apply conversion to the record captured from the databaseglobal $valortag,$arrHttp,$db_path,$Wxis,$xWxis,$wxisUrl;
	$ValorCapturado="";
	foreach ($valortag as $key => $lin){		if (trim($key)!=""){
			$lin=stripslashes($lin);
			$sal=explode("\n",$lin);
			foreach ($sal as $l){
	   			$ValorCapturado.="<$key 0>".$l."</$key>";
	   		}
		}
	}
	$file=$db_path."/cnv/".$arrHttp["cnvtabsel"];
	$fp=file($file);
	$Pft="";
	foreach ($fp as $value) {
		$value=trim($value);
		if ($value!=""){
			$ix=strpos($value,':');
			$Pft.="'$$^^$$".substr($value,0,$ix).":'".substr($value,$ix+1)."/";
		}
	}
	$ValorCapturado=urlencode($ValorCapturado);
	$IsisScript=$xWxis."z3950_cnv.xis";
	$Pft=urlencode($Pft);
	$query = "&base=".$arrHttp["base"] ."&cipar=$db_path"."par/".$arrHttp["base"].".par&ValorCapturado=".$ValorCapturado."&Pft=$Pft";
	include("../common/wxis_llamar.php");
	$res=implode("\n",$contenido);
	$res=explode("$$^^$$",$res);
	$ValorCapturado="";
	$tag="";
	$valortag=array();
	foreach ($res as $value){
		$ixpos=strpos($value,':');
		$tag=substr($value,0,$ixpos);
		$campo=substr($value,$ixpos+1);
		$c=explode("\n",$campo);
		foreach($c as $val){
			$val=trim($val);
			if ($val!=""){				if (isset($valortag[$tag]))
					$valortag[$tag].="\n".$val;
				else
					$valortag[$tag]=$val;
			}
		}
	}
//	foreach ($valortag as $tag=>$val) echo "$tag=$val<br>";
}

function EjecutarBusqueda(){
global $arrHttp,$db_path,$xWxis,$Wxis,$valortag,$tl,$nr,$Mfn,$wxisUrl,$lang_db,$msgstr,$registro,$Expresion,$Total_Search;

	$Expresion=stripslashes($arrHttp["Expresion"]);
	$Expresion=str_replace('\"','"',$Expresion);
	$Expresion=urlencode(trim($Expresion));

	if (!isset($arrHttp["Formato"]))$arrHttp["Formato"]="";
	$Formato=$arrHttp["Formato"];
	if ($Formato!="ALL" and $Formato!=""){
		$Formato.=".pft";		$a=$db_path.$arrHttp["base"]."/pfts/".$_SESSION["lang"]."/".$Formato;
		if (!file_exists($a)){			$a=$db_path.$arrHttp["base"]."/pfts/".$lang_db."/".$Formato;		}
		$Formato=$a;	}

	$contenido="";
	$registro="";
	$IsisScript=$xWxis."buscar_ingreso.xis";
	$query = "&base=".$arrHttp["base"] ."&cipar=$db_path"."par/".$arrHttp["cipar"]."&Expresion=".$Expresion."&count=1&from=".$arrHttp["from"]."&Formato=$Formato&prologo=@prologoact.pft&epilogo=@epilogoact.pft";
	include("../common/wxis_llamar.php");
    $ficha_bib=$contenido;
	foreach ($ficha_bib as $linea){
		$linea=trim($linea);
		if ($linea!="") {
			if (substr($linea,0,6)=='$$REF:'){
	 			$ref=substr($linea,6);
	 			$f=explode(",",$ref);
	 			$bd_ref=$f[0];
	 			$pft_ref=$f[1];
	 			$a=$db_path.$bd_ref."/pfts/".$_SESSION["lang"]."/".$pft_ref;
				if (!file_exists($a)){
					$a=$db_path.$bd_ref."/pfts/".$lang_db."/".$pft_ref;

				}
				$pft_ref=$a;
	 			$expr_ref=$f[2];
	 			$IsisScript=$xWxis."buscar.xis";
 				$query = "&cipar=$db_path"."par/".$arrHttp["cipar"]. "&Expresion=".$expr_ref."&Opcion=buscar&base=".$bd_ref."&Formato=$pft_ref&prologo=NNN";
				include("../common/wxis_llamar.php");
				foreach($contenido as $linea_alt) $registro.= "$linea_alt\n";
	  		}else{
				if (substr($linea,0,6)=="[MFN:]"){					$arrHttp["Mfn"]=trim(substr($linea,6));
					echo "\n<script>top.Mfn_Search=".$arrHttp["Mfn"]."

					top.mfn=".$arrHttp["from"]."
					if (top.mfn==0) top.mfn=1
					top.browseby='search'\n</script>\n";				}else{
					if (substr($linea,0,8)=="[TOTAL:]"){
						if(trim(substr($linea,8))==0){							//echo "Total: 0";
							return "0";
							echo "\n<script>top.Max_Search=0
							</script>\n";
							break;						}else{
							$Total_Search=trim(substr($linea,8));
							echo "\n<script>top.Max_Search=".trim(substr($linea,8))."
						\n</script>\n";
						}
					}else{
						if ($arrHttp["Formato"]!="ALL"){
							$arrHttp["Opcion"]="ver";							$registro.= "$linea\n";
						}else{							$registro.=$linea."\n";
	                        $arrHttp["Opcion"]="ver";						}
					}				}
			}
		}
	}

	echo "<script>
	var item=top.menu.toolbar.getItem('select');
    item.selElement.options[2].selected =true \n";
    if (!isset($arrHttp["cambiolang"]))  // Si se dibuja el formulario luego de un cambio de lenguaje, no se actualiza la casilla ir_a porque da un error en javascript
    	echo "top.menu.document.forma1.ir_a.value=top.mfn.toString()+'/'+top.Max_Search.toString()\n";
    echo "</script>\n";
	if ($arrHttp["Formato"]!="ALL"){		return "no";
	}
	$contenido=explode("\n",$registro);
	$valortag=array();
	$ic=-1;
	foreach($contenido as $linea){
		if ($ic==-1){  //para saltar la primera l�nea que tiene el mfn en el formato all
			$ic=2;
		}else{
			$linea=trim($linea);
			if ($linea!=""){
   				$pos=strpos($linea, " ");
   				if (is_integer($pos)) {
   					$tag=trim(substr($linea,0,$pos));
////El formato ALL env�a un <br> al final de cada l�nea y hay que quitarselo
//
   					$linea=rtrim(substr($linea, $pos+2,strlen($linea)-($pos+2)-5));
					if ($tag==1002){
 						$maxmfn=$linea;
					}else{
   						if (!isset($valortag[$tag])){
   							$valortag[$tag]=$linea;
   						}else {
   	 						$valortag[$tag]=$valortag[$tag]."\n".$linea;
   						}
   					}
				}
			}
		}
	}
	return "si";

}



// ******
// A partir de las variable ValorCapturado crea una estructura con el tag de Isis y el valor del campo
// el tag y el valor deben venir separados por un espacio

function CargarMatriz($var){
global $valortag,$variables;
	$var=urldecode($var);
	$filas=explode("\n",$var);
	foreach ($filas as $lin){		$lin=trim($lin);
		if (trim($lin)!=""){			$lin= stripslashes($lin);
			$pos=strpos($lin, " ");
			if (is_integer($pos)) {
				$indice=substr($lin,0,$pos);
				$valor=trim(substr($lin,$pos+1));
				if (trim($valor)!=""){
					if (substr($indice,0,1)=="0") $indice=substr($indice,1);
					if (substr($indice,0,1)=="0") $indice=substr($indice,1);
					if (!isset($valorcap[$indice])) $valorcap[$indice]="";
					if ($valorcap[$indice]!=""){
						$valorcap[$indice]=$valorcap[$indice]."\n".substr($lin,$pos+1);
					}else{
						$valorcap[$indice]=substr($lin,$pos+1);
					}
               }
			}
       }
	}
	//COPY THE CAPTURED RECORD TO THE EMPTY FIELDS

	foreach ($valorcap as $tag=>$value){		if (!isset($valortag["$tag"])) $valortag[$tag]=$value;
		$variables["tag$tag"]=$value;	}
}

function ColocarMfn(){
global $arrHttp;
    $arrHttp["Mfn"]=str_replace("<","",$arrHttp["Mfn"]); //Ojo: Averiguar porque se trae el <
	if (!isset($arrHttp["ventana"])){
		echo "<script>
		if (top.window.frames.length>0){
		\n";


		echo "if (top.browseby==\"search\"){
				top.mfn=".$arrHttp["Mfn"]."\n
				top.Mfn_Search=".$arrHttp["Mfn"]."\n";
			if (!isset($arrHttp["cambiolang"])) echo "top.menu.document.forma1.ir_a.value=top.Search_pos.toString()+'/'+top.Max_Search.toString()\n";
		echo "	}else{ ";
				if ($arrHttp["Mfn"]!="New"){

					if (isset($arrHttp["Mfn"])) echo "top.mfn=".$arrHttp["Mfn"]."\n";
					if (isset($arrHttp["Maxmfn"])) echo "top.maxmfn=".$arrHttp["Maxmfn"]."\n";
            	}
					if (!isset($arrHttp["cambiolang"])) echo "top.menu.document.forma1.ir_a.value=top.mfn.toString()+'/'+top.maxmfn.toString()\n";
        	echo "}
        	}\n";
			echo "</script>\n

		";
	}}

function VariablesDeAmbiente($var,$value){
global $arrHttp,$variables;

		if (substr($var,0,3)=="tag") {
			$ixpos=strpos($var,"_");
			if ($ixpos!=0) {
				$occ=explode("_",$var);
				if (trim($value)!=""){
					if (isset($occ[2])) $value="^".trim($occ[2]).$value;
					$var=$occ[0]."_".$occ[1];
					if (is_array($value)) {
						$value = implode("\n", $value);
					}
				}
				if (isset($arrHttp[$var])){
					$arrHttp[$var].=$value;
				}else{
					if (trim($value)!="") $arrHttp[$var]=$value;
				}
			}else{
				if (is_array($value)) {
			   		$value = implode("\n", $value);
				}
				if (isset($arrHttp[$var])){
					$arrHttp[$var].="\n".$value;
				}else{
					if (trim($value)!="") $arrHttp[$var]=$value;
				}
			}
		}else{
			if (trim($value)!="") {				$arrHttp[$var]=$value;			}
		}
}

function GetRecordType(){global $arrHttp,$valortag,$tm,$nr,$tl,$tym;
	if (isset($arrHttp["wks"]))
		return;
	if (isset($tm)){   //para ver si hay tipo de material  y no viene fijado anteriormente
		foreach ($tm as $linea){
			$tym=explode('|',trim($linea));
			if (count($tym)>1){  // la hoja de ingreso no se toma del men� de hojas de entrada
				if (!isset($valortag[$tl])){
					$arrHttp["wks"]=$tym[0];
					$arrHttp["wk_tipom_1"]=$tym[1];
					$arrHttp["wk_tipom_2"]=$tym[2];
					break;
				}else{
					if (!isset($valortag[$nr])) $valortag[$nr]="";
					if ($valortag[$tl]==$tym[1] and $tym[2]==""  or $valortag[$tl]==$tym[1] and $valortag[$nr]==$tym[2]) {
						$arrHttp["wks"]=$tym[0];
						$arrHttp["wk_tipom_1"]=$tym[1];
						$arrHttp["wk_tipom_2"]=$tym[2];
					}
				}
			}
		}
  	}
}


// ==================================================================================================
// INICIO DEL PROGRAMA
// ==================================================================================================

//

// nota: aqu� no se usa el include get_post.php por que el m�todo de leer las variables es diferente
//codigo para comprobar si est� protegido el registro
//obteniendo el tag del RPC
function RPC($pathMX,$ver,$pathDB,$base,$fromto,$tag,$passHttp)
{
//check RPC
session_start();//esto es temporal
$mxrpc=$pathMX.$ver."/"."mx.exe ".$pathDB."/".$base."/data/".$base." from=".$fromto." to=".$fromto." pft=v$tag";
//$mx920=$mx_path."mx.exe ".$db_path."/".$arrHttp['base']."/data/".$arrHttp['base']." from=".$arrHttp['Mfn']." to=".$arrHttp['Mfn']." pft=v$rpctag"; 
exec($mxrpc,$out,$b);
$pass=$out[0];
$libre=true;
if($pass!="")
{

session_start();
//busco si ya ha insertado el pass correctamente
 if(session_is_registered($base.$fromto))
 {
 $libre=true;
 }
 else
 {
echo "<div class=\"middle form\">
	<div class=\"formContent\">
	<form name='form1' action='' method='post'>
Enter password to unlock record <input type='password' name='pass'><br>
<input type='submit' name='btn' value='OK'>
</form>
</div>
</div>
";
if($passHttp!=$pass)
{
$libre=false;
}
else
{
session_register($base.$fromto);
echo "<script>document.location.href=document.location.href;</script>";
}
}
}

//end check RPC	
return $libre;
}
//
$ValorCapturado="";
$arrHttp=Array();
foreach ($_GET as $var => $value) {
	if (trim($value)!="") VariablesDeAmbiente($var,$value);
}
if (count($arrHttp)==0){
	foreach ($_POST as $var => $value) {
		if (trim($value)!="") VariablesDeAmbiente($var,$value);
	}
}

if (!isset($arrHttp["Expresion"]))     $arrHttp["Expresion"]="";

//READ THE RIGHTS OF THE USERS FOR THE DATAENTRY WORKSHEETS
$wks_avail=ReadWorksheetsRights();

if (isset($arrHttp["wks"])){	$arrHttp["wks_a"]=$arrHttp["wks"];
	$wk=explode('|',$arrHttp["wks"])  ;
	$arrHttp["wks"]=$wk[0];            // Nombre de la hoja de entrada
	if (isset($wk[1]))
		$arrHttp["wk_tipom_1"]=$wk[1]; // Tipo de registro 1
	else
		$arrHttp["wk_tipom_1"]="";
	if (isset($wk[2]))
		$arrHttp["wk_tipom_2"]=$wk[2]; // Tipo de registro 2
	else
		$arrHttp["wk_tipom_2"]="";
	if (isset($wk[4]))
		$arrHttp["wk_tag_tipom_1"]=$wk[4]; // Tag correspondiente al Tipo de registro 1
	else
		$arrHttp["wk_tag_tipom_1"]="";
	if (isset($wk[5]))
		$arrHttp["wk_tag_tipom_2"]=$wk[5]; // Tag correspondiente al Tipo de registro 2
	else
		$arrHttp["wk_tag_tipom_2"]="";


}else{}
echo "\n<script>top.toolbarEnabled=\"\"\n</script>";

// Settings for returning to the script browse.php  (added 14-04-2009)
$retorno="";  // Para regresar a browse.php
$return="";   // para regresar al procedimiento que invoc� a browse.php
if (isset($arrHttp["retorno"])){
	$retorno =str_replace('~','&',$arrHttp["retorno"]);  // se reconstruye el url del retorno
 	$retorno.="?encabezado=s&base=".$arrHttp["base"]."&unlock=s&Mfn=".$arrHttp["Mfn"];
}
if (isset($arrHttp["return"])){
          $retorno.="&return=".$arrHttp["return"];

}
if (isset($arrHttp["from"])){
		$retorno.="&from=".$arrHttp["from"];
}
if (isset($arrHttp["Status"])){    // value=1 indicates record deleted
		$retorno.="&Status=".$arrHttp["Status"];
}
// end settings

if ($arrHttp["Opcion"]=="ver" or $arrHttp["Opcion"]=="cancelar" or $arrHttp["Opcion"]=="buscar" or ($arrHttp["Opcion"]=="actualizar") or $arrHttp["Opcion"]=="save" ) {

		if (isset($arrHttp["sort"]))
			$sort="&sort=".$arrHttp["sort"];
		else
			$sort="";
}

$arrHttp["login"]=$_SESSION["login"];
$arrHttp["password"]=$_SESSION["password"];


$arrHttp["Notificacion"]="N";
//Si hay leader, se lee para ver en qu� campos est�n el tipo de literatura y el nivel bibliogr�fico
$fpLeader=file($db_path.$arrHttp["base"]."/def/".$lang_db."/typeofrecord.tab");
foreach ($fpLeader as $value){	$line_1=trim($value);
	break;}
$tmLeader=explode(" ",$line_1);
foreach ($arrHttp as $var => $value) {	if (substr($var,0,3)=="tag" ){
		$tag=explode("_",$var);
		if (substr($tag[0],3)>3000 and substr($tag[0],3)<4000 or (count($tmLeader)>0 and (substr($tag[0],3)==$tmLeader[0] or substr($tag[0],3)==$tmLeader[1]))){  //IF LEADER, REFORMAT THE FIELD FOR ELIMINATING |
			$v=explode('|',$value);
			$value=$v[0];
		}
		if (isset($variables[$tag[0]])){
			$variables[$tag[0]].="\n".$value;
			$valortag[substr($tag[0],3)].="\n".$value;
		}else{
			$variables[$tag[0]]=$value;
			$valortag[substr($tag[0],3)]=$value;
		}
   	}

}
//foreach ($variables as $key => $value) echo "$key=$value<br>";die;

// Si la opcion es copiar_captura, se cambia la base de datos para poder leer los archivos de definici�n

if ($arrHttp["Opcion"]=="captura_bd") {
    $basecap=$arrHttp["base"];
	$ciparcap=$arrHttp["cipar"];
	$arrHttp["base"]=$arrHttp["basecap"];
	$arrHttp["cipar"]=$arrHttp["ciparcap"];

}



//Esta variable es para almacenar las tablas que hay que generar con JavaScript
$Tabla_sel=array();

$base =$arrHttp["base"];
$cipar =$arrHttp["cipar"];
if (isset($arrHttp["Mfn"]))$Mfn=$arrHttp["Mfn"];
$login=$arrHttp["login"];
$password=$arrHttp["password"];
if (!isset($arrHttp["ver"])) $arrHttp["ver"]="";
if ($arrHttp["ver"]=="S") {

	$ver=true;
} else {
	$ver=false;
}
$capturar="NO";
$actualizar="N";

if (isset ($arrHttp["Opcion"]))  {
	if ($arrHttp["Opcion"]=="actualizar" || $arrHttp["Opcion"]=="actualizarregistrousuario" || $arrHttp["Opcion"]=="save") $actualizar="SI";
	if ($arrHttp["Opcion"]=="crear") {

		$actualizar="SI";

	}
// si se seleccion� la opci�n nuevo en el men� superior, se transforma a crear para poder crear el nuevo registro
	if ($arrHttp["Opcion"]=="nuevo" or $arrHttp["Opcion"]=="nuevoregistro" ||$arrHttp["Opcion"]=="nuevoregistrousuario") {
		$Mfn="New";
		$arrHttp["Opcion"]="crear";

	}
}

//--------------------------------------------------------------------------


// se lee el archivo con los tipos de registro
unset ($tm);
$tor="";
if (file_exists($db_path.$base."/def/".$_SESSION["lang"]."/typeofrecord.tab")){	$tor=$db_path.$base."/def/".$_SESSION["lang"]."/typeofrecord.tab";
}else{	if (file_exists($db_path.$base."/def/".$lang_db."/typeofrecord.tab"))
		$tor=$db_path.$base."/def/".$lang_db."/typeofrecord.tab";}
//se carga la tabla de tipos de registro
// $tl and $nr are the tags where the type of record is stored
if ($tor!=""){
	$fp = file($tor);
	$ix=0;
	$tm[]="";
	foreach ($fp as $linea){		$linea=trim($linea);
		if ($linea!=""){
			if ($ix==0){
				$ij=strpos($linea," ");
				if ($ij===false) {					$tl=$linea;				}else{					$tl=trim(substr($linea,0,$ij));
					$nr=trim(substr($linea,$ij));				}

				$ix=1;
			}else{				$tm[]=trim($linea);
			}
		}

	}
}else{
	$tl="";
	$nr="";

}
$i=-1;
$ValorCapturado="";
if (!isset($arrHttp["encabezado"])and $arrHttp["Opcion"]!="captura_bd"){
	if (!isset($arrHttp["cambiolang"]) and !isset($arrHttp["ventana"]))
	echo "<script>
		if (top.window.frames.length>0) top.PrenderEdicion()\n";

	echo "</script>\n";
}

$OpcionDeEntrada=$arrHttp["Opcion"];
if (!isset($arrHttp["Formato"])) $arrHttp["Formato"]="";
if ($arrHttp["Opcion"]=="ver" and $arrHttp["Formato"]=="") $arrHttp["Opcion"]="leer";
$recdel="";
$reintentar="";
//echo $arrHttp["Opcion"];
switch ($arrHttp["Opcion"]) {
	case "reintentar":           // IF A VALIDATION ERROR OCCURS THE RECORD IS REDISPLAYED
    case "save":
    	if ($arrHttp["Opcion"]=="reintentar"){    		$reintentar="S";    		if ($arrHttp["Mfn"]=="New"){
				$arrHttp["Opcion"]="crear";
			}else{
				$arrHttp["Opcion"]="editar";
			}    	}
		CargarMatriz($arrHttp["ValorCapturado"]);
		//echo "<xmp>";
//var_dump($variables);
//echo "</xmp>";

		if (isset($tm) and !isset($arrHttp["wks"])){   //para ver si hay tipo de material  y no viene fijado anteriormente
			foreach ($tm as $linea){
				$tym=explode('|',trim($linea));
				if (!isset($valortag[$tl])){					$arrHttp["wks_a"]=$linea;
					$arrHttp["wks"]=$tym[0];
					$arrHttp["wk_tipom_1"]=$tym[1];
					$arrHttp["wk_tipom_2"]=$tym[2];
					break;
				}
				if ($valortag[$tl]==$tym[1] and $tym[2]==""  or $valortag[$tl]==$tym[1] and $valortag[$nr]==$tym[2]) {
					$arrHttp["wks_a"]=$linea;
					$arrHttp["wks"]=$tym[0];
					$arrHttp["wk_tipom_1"]=$tym[1];
					$arrHttp["wk_tipom_2"]=$tym[2];
				}
			}
		}
		PlantillaDeIngreso();
		if ($arrHttp["Opcion"]=="reintentar"){
			echo "<script>
			if (top.window.frames.length>0){
				top.xeditar='S'
				top.PrenderEdicion()
			}
			</script>\n";
		}
		break;
	case "buscar":
		include("scripts_dataentry.php");
        $resultado=EjecutarBusqueda();
        $_SESSION["Expresion"]=$arrHttp["Expresion"];
    	$ix=count($_SESSION["history"]);
    	$found="N";
    	$arrHttp["Expresion"]=str_replace('"','',$arrHttp["Expresion"]);
    	foreach ($_SESSION["history"] as $history){
    		$h=explode('$$|$$',$history);
    		if ($h[0]=$arrHttp["base"]){
    			if ($arrHttp["Expresion"]==$h[1]){
    				$found="Y";
    				break;
    			}
    		}
    	}
    	if ($found=="N")
    		$_SESSION["history"][$ix]=$arrHttp["base"].'$$|$$'.$arrHttp["Expresion"].'$$|$$'.$Total_Search;
        $_SESSION["refinar"]=$arrHttp["Expresion"];
        if (!isset($_SESSION["expresion"][$arrHttp["base"]][$arrHttp["expresion"]]))
        	$_SESSION["expresion"][$arrHttp["base"]][$arrHttp["expresion"]]=$resultado;
        if ($resultado=="0"){        	$arrHttp["Opcion"]=="ninguna";
        	echo "	<div class=\"middle form\">
						<div class=\"formContent\">
						<table width=100%><td width=10></td><td>\n";
			//if ($wxisUrl!="") echo $wxisUrl."<br>";

			echo "<font face=arial style=font-size:10px>".$msgstr["expresion"].":<input type=text name=nueva_b style=width:800px; value=\"".stripslashes($arrHttp["Expresion"])."\"><a href=javascript:NuevaBusqueda()>Buscar</a></font>";
			echo "<h4>Records:".$resultado."</h4></div></div>\n";
			$arrHttp["Mfn"] =1;
	        ColocarMfn();
	        echo "</td></table>";
	        echo "</div></div>";
	        include("../common/footer.php");
	        die;
	        break;        }else{
        	include("toolbar_record.php");
	        if ($resultado!="no"){        //resultado=no indica que ya se formateo el registro
	        	$ver="s";
	        	if ($arrHttp["Formato"]!=""){
	        		echo "<table width=100%><td width=10></td><td><font size+1>$registro.</td></table>";	        	}else{	        		$res=LeerRegistro($base,$cipar,$arrHttp["Mfn"],$maxmfn,"leer",$arrHttp["login"],$password,"");
            		$ver=true;
            		if (isset($arrHttp["wks"])){
					}else{
	        			GetRecordType();
        			}
        			PlantillaDeIngreso();	        	}

	        	if (isset($tm)){   //para ver si hay tipo de material  y no viene fijado anteriormente
					foreach ($tm as $linea){
						$linea=trim($linea);
						$tym=explode('|',trim($linea));

						if (!isset($valortag[$tl])){
							$arrHttp["wks_a"]=$linea;
							$arrHttp["wks"]=$tym[0];
							$arrHttp["wk_tipom_1"]=$tym[1];
							$arrHttp["wk_tipom_2"]=$tym[2];
							break;
						}
						if ($valortag[$tl]==$tym[1] and $tym[2]==""  or $valortag[$tl]==$tym[1] and $valortag[$nr]==$tym[2]) {
							$arrHttp["wks_a"]=$linea;
							$arrHttp["wks"]=$tym[0];
							$arrHttp["wk_tipom_1"]=$tym[1];
							$arrHttp["wk_tipom_2"]=$tym[2];
						}
					}

					PlantillaDeIngreso();

					if (!isset($arrHttp["encabezado"])) ColocarMfn();
				}

	        }else{	        	$ver="s";
	        	echo "<table width=100%><td width=20></td><td>";
	        	if ($arrHttp["Formato"]!=""){
	        		echo $registro;
	        	}else{
	        		$res=LeerRegistro($base,$cipar,$arrHttp["Mfn"],$maxmfn,"leer",$arrHttp["login"],$password,"");
            		$ver=true;
            		if (isset($arrHttp["wks"])){
					}else{
	        			GetRecordType();
        			}
        			PlantillaDeIngreso();
	        	}	        }
		}

			echo "</form></td></table></div></div>\n";
			include("../common/footer.php");
			die;
       	break;
	case "ver":    //Presenta el registro con el formato seleccionado
	if($arrHttp["Formato"]=="ALL")
	{
	$rpctag=$_SESSION['rpctag'];
	$passHttp=$_POST['pass'];
	$ver=RPC($mx_path,$cisis_ver,$db_path,$arrHttp['base'],$arrHttp['Mfn'],$rpctag,$passHttp);
	}
	if($ver)
	{
        include("scripts_dataentry.php");
		$salida= LeerRegistroFormateado($arrHttp["Formato"]);
		if ($record_deleted=="N") include("toolbar_record.php");
		$arrHttp["Opcion"]=="ninguna";
        	echo "	<div class=\"middle form\">
						<div class=\"formContent\">\n";
						echo "<dd><table><td width=20> </td><td>";
		echo $salida;
		echo "</td></table></dd>" ;
//SE AVERIGUA SE SE VA A LEER LA INFORMACI�N DE OTRA BASE DE DATOS
		if (isset($record_deleted) and $record_deleted=="Y"){			echo "<a href=javascript:Undelete(".$arrHttp["Mfn"].")>undelete</a>";		}
		if (!isset($arrHttp["capturar"])){
			ColocarMfn();
		}
		echo "</form></div></div></div>\n";
		include("../common/footer.php");
		die;
		break;
		}
	case "presentarformulario":
		PresentarFormulario("nuevo");
		return;
		break;
	case "presentar_captura":
        $ver="";
        if (isset($arrHttp["cnvtabsel"])){        	$res=LeerRegistro($arrHttp["basecap"],$arrHttp["ciparcap"],$arrHttp["Mfn"],$maxmfn,"editar",$login,$password,"");
        	CambiarFormatoRegistro();        }else{
			$res=LeerRegistro($arrHttp["basecap"],$arrHttp["ciparcap"],$arrHttp["Mfn"],$maxmfn,"editar",$login,$password,"");
       	}
       	$arrHttp["Mfn"]="New";
   	 	$arrHttp["Opcion"]="crear";
        break;
	case "captura_bd":
        $ver="S";
		$res=LeerRegistro($arrHttp["basecap"],$arrHttp["ciparcap"],$arrHttp["Mfn"],$maxmfn,"editar",$login,$password,"");
  	 	$arrHttp["Opcion"]="crear";
  	 	$arrHttp["capturar"]="S";
        break;
	case "capturar":
		echo "\n<script>
		top.xeditar=\"S\"
		if (top.window.frames.length>0) top.PrenderEdicion()
		</script>\n";
		if (isset($arrHttp["Mfn"]) and $arrHttp["Mfn"]!="New")
			$res=LeerRegistro($base,$cipar,$arrHttp["Mfn"],$maxmfn,"editar",$arrHttp["login"],$password,"");
//		echo "<xmp>".$arrHttp["ValorCapturado"]."</xmp>";
		CargarMatriz($arrHttp["ValorCapturado"]);
		$arrHttp["Opcion"]="crear";
		break;
	case "cancelar":

        if ($arrHttp["Mfn"]=="New") {        	include ("scripts_dataentry.php");
        	include("toolbar_record.php");
       		echo "<body><div class=\"middle form\">
			<div class=\"formContent\">";
			echo "<h3>".$msgstr["recnotupdated"]."</h3>" ;
        	echo "</form></div></div></div>\n";
			include("../common/footer.php");        	die;
        	break;        }
		$arrHttp["unlock"] ="S";
		$res=LeerRegistro($base,$cipar,$arrHttp["Mfn"],$maxmfn,"leer",$arrHttp["login"],$password,"");
		if (isset($arrHttp["Formato"]) and $arrHttp["Formato"]!=""){
        	include("scripts_dataentry.php");
        	include("toolbar_record.php");
        	echo "<body><div class=\"middle form\">
			<div class=\"formContent\">";
			echo LeerRegistroFormateado($arrHttp["Formato"]);
        	echo "</form></div></div></div>\n";
			include("../common/footer.php");
			die;
		}else{
			$res=LeerRegistro($base,$cipar,$arrHttp["Mfn"],$maxmfn,"leer",$arrHttp["login"],$password,"");
			unset($arrHttp["unlock"]);
			$res=LeerRegistro($base,$cipar,$arrHttp["Mfn"],$maxmfn,"leer",$arrHttp["login"],$password,"");
            $ver=true;
            if (isset($arrHttp["wks"])){
			}else{
	        	GetRecordType();
        	}
        	PlantillaDeIngreso();
			break;		}
	case "editar":
	session_start();//esto es temporal
$rpctag=$_SESSION['rpctag'];
//echo 'rpctag=' . $rpctag . '<p>';
//die;
$mxrpc=$cisis_path.$cisis_ver."/"."mx ".$db_path."/".$arrHttp['base']."/data/".$arrHttp['base']." from=".$arrHttp['Mfn']." to=".$arrHttp['Mfn']." pft=v$rpctag"; 
//$mx920=$mx_path."mx.exe ".$db_path."/".$arrHttp['base']."/data/".$arrHttp['base']." from=".$arrHttp['Mfn']." to=".$arrHttp['Mfn']." pft=v$rpctag"; 
exec($mxrpc,$out,$b);
$pass=$out[0];
$libre=true;
if($pass!="")
{
session_start();
//busco si ya ha insertado el pass correctamente
 if(session_is_registered($arrHttp['base'].$arrHttp['Mfn']))
 {
 $libre=true;
 }
 else
 {
echo "<div class=\"middle form\">
	<div class=\"formContent\">
	<form name='form1' action='' method='post'>
Enter password to unlock record <input type='password' name='pass'>����<a href='javascript:top.Menu(\"cancelar\");'><img border='1' alt='Cancel' src='img/toolbarCancelEdit.png'></a>
<br>
<input type='submit' name='btn' value='OK'>
</form>
</div>
</div>
";
$passHttp=$_POST['pass'];
if($passHttp!=$pass)
{
$libre=false;
}
else
{
session_register($arrHttp['base'].$arrHttp['Mfn']);
echo "<script>document.location.href=document.location.href;</script>";
}
die;
}

}

//end check RPC		
if($libre)
{
	    $arrHttp["lock"] ="S";
		}
	case "leer":
		$res=LeerRegistro($base,$cipar,$arrHttp["Mfn"],$maxmfn,$arrHttp["Opcion"],$arrHttp["login"],$password,"");
		if ($res=="LOCKREJECTED") {			echo "<script>
			alert('".$arrHttp["Mfn"].": ".$msgstr["reclocked"]."')
			if (top.window.frames.length>0){
				top.xeditar=''
				top.ApagarEdicion()
				top.Menu(\"leer\")
			}
			</script>";
			die;
			break;		}
		if (isset($arrHttp["wks"])){
		}else{
	        GetRecordType();
        }
        PlantillaDeIngreso();
		if (!isset($arrHttp["encabezado"]))ColocarMfn();

		break;
	case "nuevoregistro":
		break;
	case "actualizar":
		break;
	case "eliminar":
	case "actualizarregistrousuario":
	//check RPC
$rpctag=$_SESSION['rpctag'];
	$passHttp=$_POST['pass'];
	$actreguser=RPC($cisis_path,$cisis_ver,$db_path,$arrHttp['base'],$arrHttp['Mfn'],$rpctag,$passHttp);
	//end check RPC
	if($actreguser)
	{
		include ("scripts_dataentry.php");
        echo "<body><div class=\"middle form\">
			<div class=\"formContent\">";
		$res=ActualizarRegistro(1);
		if (trim($res)=="DELETED"){			echo "<h4>".$arrHttp["Mfn"]." ". $msgstr["recdel"]."</h4>";
			$record_deleted="Y";
			if (!isset($arrHttp["ventana"])) echo "<a href=javascript:Undelete(".$arrHttp["Mfn"].")>".$msgstr["undelete"]."</a>";		}else{			echo "<h4>".$arrHttp["Mfn"]." ". $msgstr["notdeleted"]."</h4>";
			$record_deleted="N";		}
		if (isset($arrHttp["ventana"])){			echo "<a href='javascript:window.opener.location.reload(true); self.close()'>";
			echo $msgstr["cerrar"]."</a>";		}
        echo "\n<script>if (top.window.frames.length>0) top.ApagarEdicion()</script>
        </div></div></body></html>\n";
		return;
		break;
		}
	case "usuariomodifica":
		PresentarFormulario("actualizacion");
		return;
		break;
	default:
}
if ($actualizar=="SI"){
	GetRecordType();// READ END CODE
	$validar="N";
	if ($arrHttp["Opcion"]!="save"){
		$ext=".end";
		include("fmt_begin_end.php");

		if (isset($rec_validation)){
			$validar="Y";
		}else{
			$validar="N";
		}
		if (isset($arrHttp["Validar"]))  $validar="N";

	}
    unset($rec_validation);
	unset($default_values);
	$xtl="";
	$xnr="";    if (isset($valortag[$Rtl])) $xtl=trim($valortag[$Rtl]);
	if (isset($valortag[$Rnr])) $xnr=trim($valortag[$Rnr]);
	$nuevo="";
	if ($arrHttp["Mfn"]=="New") $nuevo="s";

	$regSal=ActualizarRegistro();
	if ($nuevo=="s") $arrHttp["Maxmfn"]=$arrHttp["Mfn"];
	$arrHttp["Opcion"]="ver";
	$ver="S";
	reset($valortag);
	if (!isset($arrHttp["Formato"])or $arrHttp["Formato"]==""){
		$regSal=LeerRegistro($base,$cipar,$arrHttp["Mfn"],$maxmfn,$arrHttp["Opcion"],$login,$password,$arrHttp["Formato"]);
    	$arrHttp["Notificacion"]="N";
		require_once('ingresoadministrador.php');
	}else{		$regSal=LeerRegistroFormateado($arrHttp["Formato"]);	}
	include ("scripts_dataentry.php");
	if (!isset($record_deleted)) $record_deleted="N";
	if ($record_deleted=="N")
		include("toolbar_record.php");
	echo $regSal;
	echo "</div></div></div>";
	include("../common/footer.php");

}else{
//se lee la fdt de la base de datos
	if ($arrHttp["Opcion"]=="crear" or $arrHttp["Opcion"]=="capturar") {		if (isset($_SESSION["valdef"])){			$fp=explode('$$$',$_SESSION["valdef"]);
			foreach ($fp as $linea){
				$linea=rtrim($linea);
				$tag=trim(substr($linea,0,4))*1;
				if (trim(substr($linea,4))!=""){
					if (!isset($valortag[$tag]))
						$valortag[$tag]=substr($linea,4);
					else
						$valortag[$tag].="\n".substr($linea,4);
				}
			}
		}
		if (isset($arrHttp["wk_tag_tipom_1"]) and $arrHttp["wk_tag_tipom_1"]!=""){
			$valortag[$arrHttp["wk_tag_tipom_1"]]= $arrHttp["wk_tipom_1"];		}
		if (isset($arrHttp["wk_tag_tipom_2"]) and $arrHttp["wk_tag_tipom_2"]!=""){
			$valortag[$arrHttp["wk_tag_tipom_2"]]= $arrHttp["wk_tipom_2"];
		}
		PlantillaDeIngreso();
	}
// READ BEGIN CODE
	$ext=".beg";
	include("fmt_begin_end.php");
// se  colocan los valores por defecto
    foreach ($fdt as $campo) {
    	if (trim($campo)!=""){
    		$tt=explode('|',$campo);
    		if (isset($tt[15]) and $arrHttp["Opcion"]=="crear" and isset($valortag[$tt[1]]))
    	 		if (trim($valortag[$tt[1]])=="") $valortag[$tt[1]]= $tt[15];
    	}
    }
	$llamada=$query;
	$arrHttp["Notificacion"]="N";
	require_once('ingresoadministrador.php');

	die;

}
if (!isset($arrHttp["encabezado"]) and $arrHttp["Opcion"]!="captura_bd" and !isset($arrHttp["ventana"]))
	if ($arrHttp["Opcion"]!="eliminar" ) ColocarMfn();

if (isset($arrHttp["ventana"])){	echo "<script>
	 window.opener.location.reload(true)
	 self.close()
	</script>
	";}

?>
