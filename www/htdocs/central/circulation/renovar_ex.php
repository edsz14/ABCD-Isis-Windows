<?php
/**
 * @program:   ABCD - ABCD-Central - http://reddes.bvsaude.org/projects/abcd
 * @copyright:  Copyright (C) 2009 BIREME/PAHO/WHO - VLIR/UOS
 * @file:      renovar_ex.php
 * @desc:      Renews a loan
 * @author:    Guilda Ascencio
 * @since:     20091203
 * @version:   1.0
 *
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
if (!isset($_SESSION["login"])) $_SESSION["login"] ="web";
include("../common/get_post.php");
include("../config.php");
if (!isset($arrHttp["vienede"]) or $arrHttp["vienede"]!="ecta_web" ){
	if (!isset($_SESSION["permiso"])){
		header("Location: ../common/error_page.php") ;
	}
}
if (isset($arrHttp["DB_PATH"])) $db_path=$arrHttp["DB_PATH"];
//foreach ($arrHttp as $var=>$value) echo "$var=$value<br>";
if (isset($arrHttp["lang"])) $_SESSION["lang"]=$arrHttp["lang"];
//die;

$lang=$_SESSION["lang"];

include("../lang/admin.php");
include("../lang/prestamo.php");

include("fecha_de_devolucion.php");
// se lee la configuración de la base de datos de usuarios
include("borrowers_configure_read.php");
# Se lee el prefijo y el formato para extraer el código de usuario
include("leer_pft.php");
$us_tab=LeerPft("loans_uskey.tab","users");
$t=explode("\n",$us_tab);
$uskey=$t[0];

require_once("../circulation/grabar_log.php");

function compareDate ($FechaP){
global $locales;
	$dia=substr($FechaP,6,2);
	$mes=substr($FechaP,4,2);
	$year=substr($FechaP,0,4);
	$exp_date=$year."-".$mes."-".$dia;
	$todays_date = date("Y-m-d");
	$today = strtotime($todays_date);
	$expiration_date = strtotime($exp_date);
	$diff=$today-$expiration_date;
	return $diff;

}//end Compare Date

function Reservado($Ctrl,$bd){global $xWxis,$Wxis,$wxisUrl,$db_path;
	$Expresion="(ST_0 or ST_3) and CN_".$bd."_$Ctrl";
	$IsisScript=$xWxis."cipres_usuario.xis";
	$Pft="v1,'|',v10,'|',v15,'|',v20,'|',v40/";
	$Formato=$db_path."reserve/pfts/".$_SESSION["lang"]."/tbreserve.pft";
	$query="&base=reserve&cipar=$db_path"."par/reserve.par&Expresion=$Expresion&Pft=$Pft";
	include("../common/wxis_llamar.php");
	$cuenta=0;
	foreach ($contenido as $value) {		echo ($value);		if (trim($value)!=""){			$v=explode('|',$value);			if ($v[0]=="3"){				if ($v[4]!="" and $v[4]<date("Ymd")){					continue;				}			}
			$cuenta=$cuenta+1;
		}	}	if ($cuenta>0)
		return "Y";
	else
		return "N";}

//Se ubica el ejemplar prestado en la base de datos de transacciones
$items=explode('$$',$arrHttp["searchExpr"]);
$resultado="";
foreach ($items as $num_inv){	$num_inv=trim($num_inv);
	if ($num_inv!=""){
		$inventario="TR_P_".$num_inv;
		if (!isset($arrHttp["base"])) $arrHttp["base"]="trans";
		$Formato="v10'|$'v20'|$'v30'|$'v35'|$'v40'|$'v45'|$'v70'|$'v80'|$'v100,'|$'f(nocc(v200),1,0)'|$'v400,'|$'v95,'|$'v98/";
		$query = "&base=".$arrHttp["base"] ."&cipar=$db_path"."par/".$arrHttp["base"].".par&count=1&Expresion=".$inventario."&Pft=$Formato";
		$contenido="";
		$IsisScript=$xWxis."buscar_ingreso.xis";
		include("../common/wxis_llamar.php");
		$Total=0;
		foreach ($contenido as $linea){
			$linea=trim($linea);
			if ($linea!="") {
				$l=explode('|$',$linea);
				if (substr($linea,0,6)=="[MFN:]"){					$Mfn=trim(substr($linea,6));				}else{					if (substr($linea,0,8)=="[TOTAL:]"){						$Total=trim(substr($linea,8));					}else{						$prestamo=$linea;					}
				}
			}
		}

		$errores="";
	//echo "Mfn=$Mfn<p>" ;
		if ($Total<=0){			$error="&error=".$msgstr["notloaned"];
			$resultado.=";".$num_inv." ".$msgstr["notloaned"];		}else{
	// se extrae la información del ejemplar a devolver
			$p=explode('|$',$prestamo);
			$cod_usuario=$p[1];
			$inventario=$p[0];
			$fecha_p=$p[2];
			$hora_p=$p[3];
			$fecha_d=$p[4];
			$hora_d=$p[5];
			$tipo_usuario=$p[6];
			$tipo_objeto=$p[7];
			$referencia=$p[8];
			$no_renova=$p[9];         // Número de renovaciones procesadas
			$ppres=$p[10];            //Loan policy
			$num_ctrl=$p[11];         // Número de control
			$bd_obj=$p[12];           // Nombre de la base de datos
			$arrHttp["usuario"]=$cod_usuario;
            include_once("sanctions_read.php");
	// se lee la política de préstamos
			include_once("loanobjects_read.php");
	// se lee el calendario
			include_once("calendario_read.php");
	// se lee la configuración local
			include_once("locales_read.php");

			//Se obtiene el código, tipo y vigencia del usuario
			$formato=$pft_uskey.'\'$$\''.$pft_ustype.'\'$$\''.$pft_usvig;
			$formato=urlencode($formato);
			$query = "&Expresion=".trim($uskey).$arrHttp["usuario"]."&base=users&cipar=$db_path"."par/users.par&Pft=$formato";
			$contenido="";
			$IsisScript=$xWxis."cipres_usuario.xis";
			include("../common/wxis_llamar.php");
			//foreach ($contenido as $value) echo "$value<br>";die;

	//se determina la política a aplicar
			if ($ppres==""){
				if (isset($politica[$tipo_objeto][$tipo_usuario])){
	    			$ppres=$politica[$tipo_objeto][$tipo_usuario];
				}
				if (trim($ppres)==""){
					if (isset($politica[0][$tipo_usuario])) {
						$ppres=$politica[0][$tipo_usuario];
					}
				}
				if (trim($ppres)==""){
					if (isset($politica[$tipo_usuario][0])){
	    				$ppres=$politica[$tipo_usuario][0];
	  				}
				}
				if (trim($ppres)==""){
					if (isset($politica["0"]["0"])){
						$ppres=$politica["0"]["0"];
					}
				}
			}
			$p=explode('|',$ppres);
			$lapso=$p[3];
			$unidad=$p[5];
			$renewed="S";

			//se verifica si el objeto admite más renovaciones
			if ($p[6]!=""){
				if ($no_renova>$p[6]){					$error="&error=".$msgstr["nomorenew"];
					$resultado.=";".$num_inv."  ".$msgstr["nomorenew"];
					$renewed="N";
					Regresar($error);
					continue;				}
            }
//se verifica la fecha límite del usuario
			if (trim($p[15])!=""){
				if (compareDate ($p[15])<0){					$error="&error=".$msgstr["limituserdate"].". ".$p[15]."  ".$msgstr["nomorenew"];
					$resultado.=";".$num_inv."  ".$msgstr["limituserdate"].". ".$p[15]."  ".", ".$msgstr["nomorenew"];
					$renewed="N";
					//echo $resultado;die;
					Regresar($error);
					continue;
				}
			}
// se verifica la fecha límite del objeto
			if (trim($p[16])!=""){
				if (compareDate ($p[16])<0){
					$error="&error=".$msgstr["limitobjectdate"];
					$resultado.=";".$num_inv."  ".$msgstr["limitobjectdate"].", ".$msgstr["nomorenew"];
					$renewed="N";
					//echo $resultado;die;
					Regresar($error);
					continue;
				}
			}
// se verifica si el titulo no está reservado
			if(Reservado($num_ctrl,$bd_obj)=="Y"){				$error="&error=".$msgstr["reservednorenew"];
				$resultado.=";".$num_inv."  ".$msgstr["reservednorenew"];
				$renewed="N";
				//echo $resultado;die;
				Regresar($error);
				continue;			}

// Se calcula si hay atraso en la fecha de devolución
			$atraso=compareDate($fecha_d);
			if ($atraso<0){
				if ($p[13]!="Y"){  // se verifica si la política permite renovar cuando está atrasado					$error="&error=".$msgstr["loanoverdued"];
					$resultado.=";".$num_inv."  ".$msgstr["loanoverdued"]."  ";
					$renewed="N";
					Regresar($error);
					continue;
				}
			}
            $nsusp=0;
            $nmulta=0;
            $arrHttp["usuario"]=$cod_usuario;
            include_once("sanctions_read.php");
            if ($nsusp>0 or $nmulta>0){            	$error="&error=".$msgstr["pending_sanctions"];
            	$resultado.=";".$num_inv." ".$msgstr["pending_sanctions"];
            	$rnewed="N";
            	Regresar($error);
            	continue;
            }
// se verifica si tiene reservas
			if ($renewed=="S"){
	// Se pasa la fecha de préstamo y devolución anteriores al campo 200
				$f_ant="^a".$fecha_p."^b".$hora_p."^c".$fecha_d."^d".$hora_p."^e".$_SESSION["login"];
	//se calcula la nueva fecha de devolución

				$fecha_pres=date("Ymd h:i:s A");
				$ixpos=strpos($fecha_pres," ");
				$hora_d=trim(substr($fecha_pres,$ixpos));
				$fecha_pres=trim(substr($fecha_pres,0,$ixpos));
				$fecha_dev=FechaDevolucion($lapso,$unidad,"");
				$ixp=strpos($fecha_dev," ");
				if ($ixp>0){
					$fecha_d=trim(substr($fecha_dev,0,$ixp));
				}

				$ValorCapturado="d30d35d40d45";
				$ValorCapturado.="<30 0>".$fecha_pres."</30>";
				$ValorCapturado.="<35 0>".$hora_d."</35>";
				$ValorCapturado.="<40 0>".$fecha_d."</40>";
				$ValorCapturado.="<45 0>".$hora_d."</45>";
				$ValorCapturado.="<200 0>".$f_ant."</200>";
				$ValorCapturado=urlencode($ValorCapturado);
				$IsisScript=$xWxis."actualizar_registro.xis";
				$Formato="";
				$query = "&base=trans&cipar=$db_path"."par/trans.par&login=".$_SESSION["login"]."&Mfn=".$Mfn."&ValorCapturado=".$ValorCapturado;
				$resultado.=";".$num_inv." ".$msgstr["renewed"];
				if (file_exists($db_path."logtrans/data/logtrans.mst")){

					$datos_trans["BD"]=$bd_obj;
					$datos_trans["NUM_CONTROL"]=$num_ctrl;
					$datos_trans["NUM_INVENTARIO"]=trim($inventario);
					$datos_trans["TIPO_OBJETO"]=$tipo_objeto;
					$datos_trans["CODIGO_USUARIO"]=$cod_usuario;
					$datos_trans["TIPO_USUARIO"]=$tipo_usuario;
					$datos_trans["FECHA_DEVOLUCION"]=$fecha_d;
					$ValorCapturado=GrabarLog("C",$datos_trans,$Wxis,$xWxis,$wxisUrl,$db_path,"RETORNAR");
                    if ($ValorCapturado!="") $query.="&logtrans=".$ValorCapturado;
				}
				include ("../common/wxis_llamar.php");
			}
		}
	}
}
$cu="";
$recibo="";


if (isset($arrHttp["usuario"]))
	$cu="&usuario=".$arrHttp["usuario"];
else
	$cu="&usuario=$cod_usuario";
if (isset($arrHttp["reserve"])){	$reserve="&reserve=\"S\"";
}else{	$reserve="";}
if (isset($arrHttp["vienede"]) and $arrHttp["vienede"]=="ecta_web"){    header("Location: opac_statment_ex.php?usuario=$cod_usuario$error&vienede=ecta_web&DB_PATH=$db_path&lang=$lang");
    die;
}header("Location: usuario_prestamos_presentar.php?renovado=S&encabezado=s&resultado=".urlencode($resultado)."$cu&rec_dev=$Mfn_rec"."&inventario=".$arrHttp["searchExpr"].$reserve);
die;

function Regresar($error){global $arrHttp,$cod_usuario,$db_path,$lang;
    if (isset($arrHttp["vienede"]) and $arrHttp["vienede"]=="ecta_web"){    	header("Location: opac_statment_ex.php?usuario=$cod_usuario$error&vienede=ecta_web&DB_PATH=$db_path&lang=$lang");
    	die;    }
}






?>