<?php
//archivos de estilo
if (isset($def["CSS_NAME"])){
	$css_name=$def["CSS_NAME"];
}
//Logo
if (isset($def["LOGO"])) $logo=$def["LOGO"];
if (isset($def["reserve"])) $reserve_active=$def["reserve"];
//se lee el archivo dr_path.def para ver las configuraciones locales de la base de datos
if (isset($arrHttp["base"])){
	if (file_exists($db_path.$arrHttp["base"]."/dr_path.def")){
		$def_db = parse_ini_file($db_path.$arrHttp["base"]."/dr_path.def");
		if (isset($def_db["inventory_numeric"]))      	$inventory_numeric=$def_db["inventory_numeric"];
		if (isset($def_db["max_inventory_length"]))   	$max_inventory_length=$def_db["max_inventory_length"];
		if (isset($def_db["max_cn_length"]))     	$max_cn_length=$def_db["max_cn_length"];
		if (isset($def_db["mx_path"]))                	$mx_path=$def_db["mx_path"];
		if (isset($def_db["dirtree"]))                  $dirtree=1;
		unset($_SESSION["BARCODE"]);
		unset($_SESSION["BARCODE_SIMPLE"]);
		if (isset($def_db["barcode"]))                  $_SESSION["BARCODE"]="Y";
		if (isset($def_db["barcode_simple"]))			$_SESSION["BARCODE_SIMPLE"]="Y";
		if (isset($def_db["db_path"]))                  $db_path=$def_db["db_path"];
        if (isset($def_db["tesaurus"]))                 $tesaurus=$def_db["tesaurus"];
        if (isset($def_db["prefix_search_tesaurus"]))   $prefix_search_tesaurus=$def_db["prefix_search_tesaurus"];
		//SE REDEFINEN LOS SIGUIENTES PARÁMETROS DEL CONFIG.PHP
		if (isset($def_db["cisis_ver"]))
			 $cisis_ver=$def_db["cisis_ver"];
		if (isset($def_bd["wxis_get"]))
			//Path to the wxis.exe when using get;
			$Wxis=$def_bd["wxis_get"];
   		if (isset($def_bd["wxis_post"]))
   			//Url for the execution of WXis, when using POST
   			$wxisUrl=$def_bd["wxis_post"];
		if (isset($def_db["mx_path"]))
			$mx_path=$def_db["mx_path"];


	}
}
$show_acces="Y";
?>