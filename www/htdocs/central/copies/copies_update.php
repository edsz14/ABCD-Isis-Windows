<?php
session_start();
if (!isset($_SESSION["permiso"])){
	header("Location: ../common/error_page.php") ;
}
include("../common/get_post.php");
include("../config.php");
$ValorCapturado="";
$arrHttp=array();
foreach ($_GET as $var => $value) {
	$value=trim($value);
	if ($value!="")	VariablesDeAmbiente($var,$value);
}
if (count($arrHttp)==0){

	foreach ($_POST as $var => $value) {
		$value=trim($value);
		if ($value!="")	VariablesDeAmbiente($var,$value);
	}
}
//foreach ($arrHttp as $var=>$value) echo "$var=$value<br>";
$arrHttp["Opcion"]="actualizar";
$cipar=$arrHttp["cipar"];
$base=$arrHttp["base"];
$xtl="";
$xnr="";
$arrHttp["wks"]="";
include("../dataentry/plantilladeingreso.php");
include("../dataentry/actualizarregistro.php");
$havetoloanobject=0;
$inumber="";$ctatus="";$pnumber="";$pstatus="";
foreach ($arrHttp as $var => $value) {
    if ($var=='tag30') $inumber=$value; 
	if ($var=='tag200') $ctatus=$value; 
	if ($var=='curIN') $pnumber=$value; 
	if ($var=='curST') $pstatus=$value;
	if (substr($var,0,3)=="tag" ){
		$tag=explode("_",$var);
		if (isset($variables[$tag[0]])){
			$variables[$tag[0]].="\n".$value;
			$valortag[substr($tag[0],3)].="\n".$value;
		}else{
			$variables[$tag[0]]=$value;
			$valortag[substr($tag[0],3)]=$value;
		}
   	}

}
ActualizarRegistro();
//Change loanobject entry if status change-------------
$liststatus=explode("^",$ctatus);
$ctatus=$liststatus[1];
$liststatus=explode("^",$pstatus);
$pstatus=$liststatus[1];
if ($ctatus!=$pstatus or $pnumber!=$inumber)
{
    //Search for the record data in the loaobjects database 
	$Expresion="IN_".$pnumber;
	$IsisScript= $xWxis."buscar_ingreso.xis";
	$Pft="v1'|',v10'|',(v959'|')/";
	$query = "&base=loanobjects&cipar=$db_path"."par/loanobjects.par&Expresion=$Expresion&Pft=$Pft";
	include("../common/wxis_llamar.php");
	$Mfn="";$Total="";$MyRecord="";
	foreach ($contenido as $linea){	
		if (trim($linea)!=""){
			if (substr($linea,0,6)=="[MFN:]") $Mfn=substr($linea,6);
			if (substr($linea,0,8)=="[TOTAL:]") $Total=substr($linea,8);
			if (substr($linea,0,6)!="[MFN:]" and substr($linea,0,8)!="[TOTAL:]") $MyRecord=$linea;
		}
	}
	//Search for the record MFN in the trans database 
	$Expresion="TR_P_".$pnumber;
	$IsisScript= $xWxis."buscar_ingreso.xis";
	$Pft="v1'|',v10'|',v98'|'/";
	$query = "&base=trans&cipar=$db_path"."par/trans.par&Expresion=$Expresion&Pft=$Pft";
	include("../common/wxis_llamar.php");
	$MfnT="";
	foreach ($contenido as $lineaT){	
		if (trim($lineaT)!="") if (substr($lineaT,0,6)=="[MFN:]") $MfnT=substr($lineaT,6);}

if ($Total==1)
 {
//If Inventory Number changes
if ($pnumber!=$inumber)
{
$MyRecord=str_replace($pnumber, $inumber, $MyRecord);
//Updating The Inventory Number in trans 
if ($MfnT!="")
{
$ValorCapturado1="0010".$inumber."\n";
$ValorCapturado1=urlencode($ValorCapturado1);
$IsisScript=$xWxis."actualizar_registro.xis";
$Formato="";
$query = "&base=trans&cipar=$db_path"."par/trans.par&login=".$_SESSION["login"]."&Mfn=".$MfnT."&ValorCapturado=".$ValorCapturado1;
include("../common/wxis_llamar.php");
}
//End of Updating The Inventory Number in trans
}//End of if ($pnumber!=$inumber)
//if Status changes
if ($ctatus!='a2' and $ctatus!=$pstatus)
{
$MyNewRecord="";
$listmyrecord=explode("|",$MyRecord);
for($i=0; $i<count($listmyrecord); $i++){
if ($listmyrecord[$i]!="")	{
$listalinea=explode("^",$listmyrecord[$i]);
if ($listalinea[1]!='i'.$inumber) $MyNewRecord.="|".$listmyrecord[$i];
}}
$MyRecord=$MyNewRecord;

//Updating The Record Type in trans
if ($MfnT!="")
{
$ValorCapturado1="0001X\n";
$ValorCapturado1=urlencode($ValorCapturado1);
$IsisScript=$xWxis."actualizar_registro.xis";
$Formato="";
$query = "&base=trans&cipar=$db_path"."par/trans.par&login=".$_SESSION["login"]."&Mfn=".$MfnT."&ValorCapturado=".$ValorCapturado1;
include("../common/wxis_llamar.php");
}
//End of Updating The Record Type in trans

}//End of if ($ctatus!='a2' and $ctatus!=$pstatus)
$OS=strtoupper(PHP_OS);
$converter_path=$cisis_path."mx";
$MyNewRecord="";
$pos = strpos ($MyRecord, "^");
if ($pos === false) $MyRecord=""; else $MyRecord = substr ($MyRecord, $pos,-2);
$listmyrecord=explode("|",$MyRecord);
for($i=0; $i<count($listmyrecord); $i++) 
if ($listmyrecord[$i]!="") $MyNewRecord.="<959>".$listmyrecord[$i]."<~959>";
$MyRecord=str_replace ("~", '/', $MyNewRecord);
$mx=$converter_path." ".$db_path."loanobjects/data/loanobjects \"proc=if mfn=".$Mfn." then  'd959', '".$MyRecord."',fi,\" copy=".$db_path."loanobjects/data/loanobjects now -all";
exec($mx,$outmx,$banderamx);
$mxinv=$converter_path." ".$db_path."loanobjects/data/loanobjects fst=@".$db_path."loanobjects/data/loanobjects.fst fullinv=".$db_path."loanobjects/data/loanobjects now -all";
exec($mxinv, $outputmxinv,$banderamxinv);
 }//End of if ($Total==1)

}//End of if ($ctatus!=$pstatus or $pnumber!=$inumber)
//------------------------------------------------------

header("Location: ".$arrHttp["retorno"]);
die;
//------------------------------------------------------
function VariablesDeAmbiente($var,$value){
global $arrHttp;
		if (substr($var,0,3)=="tag") {
			$ixpos=strpos($var,"_");
			if ($ixpos!=0) {
				$occ=explode("_",$var);
				$value="^".trim($occ[2]).$value;
				$var=$occ[0]."_".$occ[1];
				if (isset($arrHttp[$var])){
					$arrHttp[$var].=$value;
				}else{
					$arrHttp[$var]=$value;
				}
			}else{
				if (is_array($value)) {
			   		$value = implode("\n", $value);
					$var=$occ[0]."_".$occ[1];
					if (is_array($value)) {
						$value = implode("\n", $value);
					}
					if (isset($arrHttp[$var])){
						$arrHttp[$var].=$value;
					}else{
						$arrHttp[$var]=$value;
					}
				}
				if (isset($arrHttp[$var])){
					$arrHttp[$var].="\n".$value;
				}else{
					$arrHttp[$var]=$value;
				}
			}
		}else{
			if (trim($value)!="") $arrHttp[$var]=$value;
		}
}

?>