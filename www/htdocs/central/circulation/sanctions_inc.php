<?php
/**
 * @program:   ABCD - ABCD-Central - http://reddes.bvsaude.org/projects/abcd
 * @copyright:  Copyright (C) 2009 BIREME/PAHO/WHO - VLIR/UOS
 * @file:      sanctions_inc.php
 * @desc:      Calculate suspenctions and fines
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
require_once("fecha_de_devolucion.php");

function Sanciones($fecha_d,$atraso,$cod_usuario,$inventario,$politica,$ncontrol,$bd,$tipo_usuario,$tipo_objeto){
global $Wxis,$xWxis,$wxisUrl,$db_path,$locales,$arrHttp,$msgstr;
	$p=explode('|',$politica);
	$multa=trim($p[7]);
	$multa_reserva=trim($p[8]);
	$dias=trim($p[9]);
	$dias_reserva=trim($p[10]);
	$sancion="";
	$ValorCapturado="";
	if ($multa!=0 and $multa!="") $sancion="M";
	if ($dias!=0 and $dias!="") $sancion="S";
	if ($sancion=="") return;
	switch ($sancion){
		case "M":
			$tipor="M";                                     		//v1
			$cod_trans="I";
			$status="0";	                                  		//v10
			//cod_usuario                                     		//v20
  			$concepto=$msgstr["fine"]." (".$inventario.")";    		//v40
     		$fecha=date("Ymd");              						//v30
       		$monto=$atraso*$p[7]*$locales["fine"];                		//v50
       		$ValorCapturado="<1 0>". $tipor."</1><10 0>".$status."</10><20 0>".$cod_usuario."</20><30 0>".$fecha."</30><40 0>".$concepto."</40><50 0>".$monto."</50>";
			break;
		case "S":                                                   //v1
			$tipor="S";
			$cod_trans="M";
			$status="0";	                 						//v10
			//cod_usuario                    						//v20
  			$concepto="Suspensión por atraso (".$inventario.")";    //v40
     		$fecha=date("Ymd");
     		if (trim($p[9])!=""){
     			$lapso=$atraso*$p[9];
     			if ($lapso>365){     				$lapso=365;
     			}
     			$fecha_v=FechaDevolucion($lapso,"D","");
     			$fecha_v=substr($fecha_v,0,8);
     			$ValorCapturado="<1 0>".$tipor."</1><10 0>".$status."</10><20 0>".$cod_usuario."</20><30 0>".$fecha."</30><40 0>".$concepto."</40><60 0>".$fecha_v."</60>";
			}
			break;
		default:
			return;
			break;
	}
//	print "<xmp>$ValorCapturado</xmp>";
	if ($ValorCapturado!=""){
		$ValorCapturado=urlencode($ValorCapturado);
		$IsisScript=$xWxis."actualizar_registro.xis";
   		$query = "&base=suspml&cipar=$db_path"."par/suspml.par&login=".$_SESSION["login"]."&Mfn=New&Opcion=crear&ValorCapturado=".$ValorCapturado;

//        foreach ($contenido as $value) echo "$value<br>";
	}
	if (file_exists($db_path."logtrans/data/logtrans.mst")){
		require_once("../circulation/grabar_log.php");
		$datos_trans["CODIGO_USUARIO"]=$cod_usuario;
		$datos_trans["BD"]=$bd;
		$datos_trans["NUM_CONTROL"]=$ncontrol;
		$datos_trans["NUM_INVENTARIO"]=trim($inventario);
		$datos_trans["TIPO_OBJETO"]=$tipo_objeto;
		$datos_trans["TIPO_USUARIO"]=$tipo_usuario;
		if (isset($fecha_v))
			$datos_trans["FECHA_DEVOLUCION"]=$fecha_v;
		if (isset($unidades_multa))
			$datos_trans["UNIDADES_MULTA"]=$unidades_multa;
		if (isset($monto))
			$datos_trans["MONTO_MULTA"]=$monto;
		if (isset($unidades_suspension))
			$datos_trans["UNIDADES_SUSPENSION"]=$unidades_suspension;
		$ValorCapturado=GrabarLog($cod_trans,$datos_trans,$Wxis,$xWxis,$wxisUrl,$db_path,"RETORNAR");
		$query.="&logtrans=".$ValorCapturado;

	}
	include("../common/wxis_llamar.php");
}
?>