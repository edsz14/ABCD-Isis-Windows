<?php
set_time_limit(0);
session_start();
if (!isset($_SESSION["permiso"])){
	header("Location: ../common/error_page.php") ;
}
if (!isset($_SESSION["lang"]))  $_SESSION["lang"]="en";
include("../common/get_post.php");
include("../config.php");
$lang=$_SESSION["lang"];
include("../lang/dbadmin.php");
include("../config.php");
include("../common/header.php");
echo "<script src=../dataentry/js/lr_trim.js></script>";
//echo 'cisispath='. $cisis_path . '<BR>';
//die;

?>

<script>
function OpenWindow(){
	msgwin=window.open("","test","width=800,height=200");
	msgwin.focus()
}
</script>
<?php
echo "<body>\n";
include("../common/institutional_info.php");

$base=$arrHttp["base"];
$bd=$db_path.$base;

if (file_exists($bd."/data/stw.tab"))
	$stw=" stw=@".$bd."/data/stw.tab";
else
	if (file_exists($db_path."stw.tab"))
		$stw=" stw=@".$db_path."stw.tab";
	else
		$stw="";

if (!file_exists($cisis_path)){
	echo $cisis_path.": ".$msgstr["misfile"];
	die;
}
$cipar="";
if (file_exists($db_path."cipar.par")){
	$cipar=$db_path."cipar.par";
}

$parameters= "Command line:<br>";
$parameters.= "database: ".$bd."/data/".$base."<br>";
$parameters.= "fst: @".$bd."/data/".$base.".fst<br>";
$parameters.= "mx: $cisis_path"."mx <br>";
if ($stw!="") $parameters.= "stw: $stw<br>";
if (($cisis_ver=='ffi/') or ($cisis_ver=='bigisis/')) $strINV=$cisis_path."mx  ".$bd."/data/".$base. "$cipar fst=@".$bd."/data/".$base.".fst $stw fullinv/m/ansi=".$bd."/data/".$base." -all now tell=100";
else $strINV=$cisis_path."mx  ".$bd."/data/".$base. "$cipar fst=@".$bd."/data/".$base.".fst $stw fullinv/ansi=".$bd."/data/".$base." -all now tell=100";
exec($strINV, $output,$t);
$straux="";
for($i=0;$i<count($output);$i++)
{
$straux.=$output[$i]."<br>";
}
echo "
	<div class=\"sectionInfo\">
			<div class=\"breadcrumb\">".
				$msgstr["maintenance"]. ": " . $arrHttp["base"]."
			</div>
			<div class=\"actions\">

	";
if (isset($arrHttp["encabezado"])){
	echo "<a href=\"../dbadmin/menu_mantenimiento.php?base=".$arrHttp["base"]."&encabezado=S\" class=\"defaultButton backButton\">";
echo "<img src=\"../images/defaultButton_iconBorder.gif\" alt=\"\" title=\"\" />
	<span><strong>". $msgstr["back"]."</strong></span></a>";
}
echo "</div>
	<div class=\"spacer\">&#160;</div>
	</div>";
?>
<div class="helper">
	<a href=../documentacion/ayuda.php?help=<?php echo $_SESSION["lang"]?>/menu_mantenimiento.html target=_blank><?php echo $msgstr["help"]?></a>&nbsp &nbsp;
<?php
if (isset($_SESSION["permiso"]["CENTRAL_EDHLPSYS"]))
 	echo "<a href=../documentacion/edit.php?archivo=".$_SESSION["lang"]."/menu_mantenimiento.html target=_blank>".$msgstr["edhlp"]."</a>";
echo "<font color=white>&nbsp; &nbsp; Script: utilities/vmx_fullinv.php";
?>
</font>
</div>
<div class="middle form">
	<div class="formContent">
<form name=maintenance>
<table cellspacing=5 align=center>
	<tr>
		<td>

		<input type=hidden name=base value=<?php echo $arrHttp["base"]?>>
             <br>

          <?
          echo "<font face=courier size=2>".$parameters."<hr>";
		  echo "Query: $strINV"."</font><br>";
		  ?>
           <br>
			<?php

			if($straux!="")
echo ("<h3>process Output: ".$straux."<br>process Finished OK</h3><br>");
else
echo ("<h2>Out: <br>process NOT EXECUTED</h2><br>");
if($base=="")
{
echo"NO database selected";
}
?></li>


			</ul>

		</td>
</table></form>
<form name=admin method=post action=administrar_ex.php onSubmit="Javascript:return false">
<input type=hidden name=base>
<input type=hidden name=cipar>
<input type=hidden name=Opcion>
<?php if (isset($arrHttp["encabezado"])) echo "<input type=hidden name=encabezado value=s>"?>
</form>
</div>
</div>
<?
include("../common/footer.php");
echo "</body></html>";
?>

