<?php

// Open the Central module in a new window for avoiding the use of the browse buttons
$open_new_window="N";
$context_menu="Y";

//USED FOR ALL THE DATE FUNCTIONS. DD=DAYS, MM=MONTH, AA=YEAR. USE / AS SEPARATOR
$config_date_format="DD/MM/YY";

//Folder with the administration modulo
$app_path="central";

//This variable erases the left zeroes in the inventory number
$inventory_numeric ="N";
//Add Zeroes to the left for reaching the max length of the inventory number
$max_inventory_length=1;
//Add Zeroes to the left for reaching the max length of the control number
$max_cn_length=1;

//Colocar Y en esta variable si se quiere llevar un log de todas las transacciones realizadas sobre la base de datos.
//Para que funcione en la carpeta de la base de datos debe existir una subcarpeta llamada log
$log="Y";


//$db_path="C:/ABCD/www/bases/";
$db_path="/var/opt/ABCD/bases/";
//path where the lang file and help page are to be located
$msg_path="/var/opt/ABCD/bases/";

if (isset($_SESSION["DATABASE_DIR"])) {
	$db_path=$_SESSION["DATABASE_DIR"];
}
//print "DB_PATH=".$db_path . '<p> ';
//die;
if (!file_exists($db_path."abcd.def")){
	echo "Missing  abcd.def in the database folder"; die;
}
$def = parse_ini_file($db_path."abcd.def");

//Name of the institution
$institution_name=$def["LEGEND2"];

//version del cisis
$cisis_ver="";
if (isset($arrHttp["base"])){
	if (isset($def[$arrHttp["base"]]))
 		$cisis_ver=$def[$arrHttp["base"]]."/";
}
//***
//Include config_extended.php that reads configuration parameters that applies to the selected database
if (file_exists(realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR."config_extended.php"))
        include (realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR."config_extended.php");
//***

//Path to the folder where the uploaded images are to be stored (the database name will be added to this path)
$img_path="/var/opt/ABCD/bases/";

//Path to the wwwisis executable (include the name of the program)
$Wxis="/opt/ABCD/www/cgi-bin/$cisis_ver"."wxis";

//Path to the wxis scripts
$xWxis="/opt/ABCD/www/htdocs/$app_path/dataentry/wxis/";

//Url for the execution of WXis, when using GGI in place of exec
//$wxisUrl="http://eds.netcat.be/cgi-bin/$cisis_ver"."wxis";
$wxisUrl="";   //SI NO SE VA A UTILIZAR EL METODO POST PARA VER LOS REGISTROS

//ruta hacia el mx
if ($cisis_ver!="")
	$mx_path="/opt/ABCD/www/cgi-bin/$cisis_ver/mx";
else
	$mx_path="/opt/ABCD/www/cgi-bin/mx";
	
//CISIS PATH
if ($cisis_ver!="")
	$cisis_path="/opt/ABCD/www/cgi-bin/$cisis_ver/";
else
	$cisis_path="/opt/ABCD/www/cgi-bin/";

//default language
$lang="en";

//Default langue for the databases definition
$lang_db="en";

//extension allowed for uploading files (used in dataentry/)
$ext_allowed=array("jpg","gif","png","pdf","doc","docx","xls","xlsx","odt");

//allow change password
$change_password="Y";

//Ruta hacia el archivo con la configuración del FCKeditor
$FCKConfigurationsPath="/".$app_path."/dataentry/fckconfig.js";

//Ruta hacia el FCKEditor
$FCKEditorPath="/site/bvs-mod/FCKeditor/";

//USE THIS LOGIN AND PASSWORD IN CASE OF CORRUPTION OF THE OPERATORS DATABASE OR IF YOU DELETED, BY ERROR, THE SYSTEM ADMINISTRATOR
$adm_login="";
$adm_password="";

//USE THIS PARAMETER TO SHOW THE ICON THAT ALLOWS THE BASES FOLDER EXPLORATION.
// this parameter can be read from the abcd.def
//DIRTREE=0 dont show
//DIRTREE=1 show
$dirtree=0;
if (isset($def["DIRTREE"]))
 	$dirtree=$def["DIRTREE"];

//USE THIS PARAMETER TO ENABLE/DISABLE THE MD5 PASSWORD ENCRIPTYON (0=OFF 1=ON)
$MD5=0;

$empwebservicequerylocation = "http://localhost:8086/ewengine/services/EmpwebQueryService";$empwebservicetranslocation = "http://localhost:8086/ewengine/services/EmpwebTransactionService";
$empwebserviceobjectsdb = "objetos";$empwebserviceusersdb = "*";

//***
//Include config_extended.php that reads configuration parameters that applies to the selected database
if (file_exists(realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR."config_extended.php"))
	include (realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR."config_extended.php");
//***
?>
