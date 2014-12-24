<?php
session_start();
if (!isset($_SESSION["permiso"])){
	header("Location: ../common/error_page.php") ;
}
if (!isset($_SESSION["lang"]))  $_SESSION["lang"]="en";
include("../common/get_post.php");
//foreach ($arrHttp as $var=>$value)  echo "$var=$value<br>";
include("../config.php");
$lang=$_SESSION["lang"];


include("../lang/admin.php");
include("../lang/dbadmin.php");
include("../lang/statistics.php");
include("../common/header.php");
?>
<script languaje=javascript>
function Guardar(){	document.update.submit();}
function AbrirVentana(Html){
	msgwin=window.open("../documentacion/ayuda.php?help=<?php echo $lang?>/"+Html,"Ayuda","")
	msgwin.focus()
}
function Edit(Html){
	msgwin=window.open("../documentacion/edit.php?archivo=<?php echo $lang?>/"+Html,"Ayuda","")
	msgwin.focus()
}
</script>
<?php
include("../common/institutional_info.php");
echo " <body>
	<div class=\"sectionInfo\">
			<div class=\"breadcrumb\">"."<h5>".
				$msgstr["tradyudas"]."</h5>
			</div>
			<div class=\"actions\">

	";
echo "<a href=\"javascript:Guardar()\" class=\"defaultButton saveButton\">
		<img src=\"../images/defaultButton_iconBorder.gif\" alt=\"\" title=\"\" />
		<span><strong>".$msgstr["save"]."</strong></span></a>";
echo "<a href=\"menu_modificardb.php?encabezado=s&base=".$arrHttp["base"]."\" class=\"defaultButton backButton\">";
echo "
					<img src=\"../images/defaultButton_iconBorder.gif\" alt=\"\" title=\"\" />
					<span><strong>". $msgstr["back"]."</strong></span>
				</a>";
echo "			</div>
			<div class=\"spacer\">&#160;</div>
	</div>";

 ?>
<div class="helper">
<a href=../documentacion/ayuda.php?help=<?php echo $_SESSION["lang"]?>/trad_ayudas.html target=_blank><?php echo $msgstr["help"]?></a>&nbsp &nbsp;
<?php
if (isset($_SESSION["permiso"]["CENTRAL_EDHLPSYS"]))
	echo "<a href=../documentacion/edit.php?archivo=".$_SESSION["lang"]."/trad_ayudas.html target=_blank>".$msgstr["edhlp"]."</a>";
echo "<font color=white>&nbsp; &nbsp; Script: dbadmin/database_tooltips.php";
?>
</font>
	</div>
 <div class="middle form">
			<div class="formContent">


<body>
<form name=update action=database_tooltips_ex.php method=post>
<input type=hidden name=base value=<?php echo $arrHttp["base"]?>>
<?php
$archivo=$db_path.$arrHttp["base"]."/def/".$_SESSION["lang"]."/help.tab";
if (file_exists($archivo)){	$fp=file($archivo);
	foreach ($fp as $value){		$value=trim($value);
		if ($value!=""){			$v=explode('=',$value,2);
			$tooltip[$v[0]]=$v[1];		}
	}}
$archivo=$db_path.$arrHttp["base"]."/def/".$_SESSION["lang"]."/".$arrHttp["base"].".fdt";
if (file_exists($archivo)){
	$fp=file($archivo);
	foreach ($fp as $value){
		$value=trim($value);
		if ($value!=""){
			$v=explode('|',$value);
			if ($v[0]!="S"){				switch ($v[0]){					case "H":
					case "L":
						if (isset($v[18])){							if (trim($v[17])!="")
								$fdt[$v[17]]=$v[2];						}
						break;
					default:
						$fdt[$v[1]]=$v[2];
						break;				}			}
		}

	}
}
echo "<table>";
foreach ($fdt as $key=>$value){	echo "<tr><td valign=top>$key</td><td><strong>$value</strong><br><Textarea rows=3 cols=200 name=tag$key>";
	if (isset($tooltip[$key])) {		echo $tooltip[$key];	}
	echo "</textarea>";
	if (isset($tooltip[$key])) {
		echo "<br><font color=darkblue>".$tooltip[$key]."</font>";
	}
	echo "</td>";}
echo "</table></center></div></div>";
echo "</form>";
include("../common/footer.php");
?>
</body>
</html>