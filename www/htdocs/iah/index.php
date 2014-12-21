<?php
$base = ($_REQUEST['base'] != '' ?  $_REQUEST['base'] : 'MARC');
$lang = ($_REQUEST['lang'] != '' ?  $_REQUEST['lang'] : 'en');
$form = $_REQUEST['form'];
$db_path="/ABCD/www/bases/";
if (!file_exists($db_path."abcd.def")){
$db_path="/var/opt/ABCD/bases/";	
	if (!file_exists($db_path."abcd.def")){
	echo "Missing abcd.def in the database folder"; die;
	}
}
$def = parse_ini_file($db_path."abcd.def");
$cisis_ver=$def[$base];

if (isset($cisis_ver)) $cisis_ver=$cisis_ver.'/';
$hdr = "Location: /cgi-bin/". $cisis_ver . "wxis.exe/iah/scripts/?IsisScript=iah.xis&lang=" . $lang . "&base=" . $base;
header($hdr);
?>
