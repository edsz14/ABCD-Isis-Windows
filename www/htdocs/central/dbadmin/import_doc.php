
<?php
/**
 * @program:   ABCD - ABCD-Central 
 * @copyright:  Copyright (C) 2014 UO - VLIR/UOS
 * @file:      fmt.php
 * @desc:      Import full text docs to a record
 * @author:    Marino Borrero Sánchez, Cuba
 * @since:     20141207
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
if (!isset($_SESSION["permiso"])){
	header("Location: ../common/error_page.php") ;
}
if (!isset($_SESSION["lang"]))  $_SESSION["lang"]="en";
include("../common/get_post.php");
include("../config.php");
$lang=$_SESSION["lang"];
include("../lang/dbadmin.php");
include("../lang/acquisitions.php");
include("../config.php");
//include("../common/header.php");
$base=$arrHttp["base"];
//include("../common/institutional_info.php");
//echo "<div style='float:right;'><a href='menu_mantenimiento.php?base=$base&encabezado=s' class='defaultButton backButton'><img src='../images/icon/defaultButton_back.png'/><span><strong> back </strong></span></a></div>";
	
//echo "<div style='float:right;'> <a href=\"menu_mantenimiento.php?base=".$base."&encabezado=s\" class=\"defaultButton backButton\">";
//echo "<img 'src=\"../images/defaultButton_iconBorder.gif\" alt=\"\" title=\"\" /><span><strong> Back </strong></span></a></div>";

echo "<div class=\"sectionInfo\">
			<div class=\"breadcrumb\">Import DOC: " . $base."
			</div>
			<div class=\"actions\">";
echo "</div>
	<div class=\"spacer\">&#160;</div>
	</div>";

?>

<?php
if (isset($_SESSION["permiso"]["CENTRAL_EDHLPSYS"]))
 	echo "<a href=../documentacion/edit.php?archivo=".$_SESSION["lang"]."/menu_mantenimiento_import_doc.html target=_blank>".$msgstr["edhlp"]."</a>";
//echo "<font color=white>&nbsp; &nbsp; Script: import_doc.php</font>";

if (file_exists($db_path.$arrHttp["base"]."/dr_path.def")){
	$def = parse_ini_file($db_path.$arrHttp["base"]."/dr_path.def");
	if (isset($def["ROOT"])){
		$dr_path=trim($def["ROOT"]);
		$ix=strrpos($dr_path,"/");
        $dr_path_rel=substr($dr_path,0,$ix-1);
        $ix=strrpos($dr_path_rel,"/");
        $dr_path_rel="<i>[dr_path.def]</i>".substr($dr_path,$ix);
	}else{
		$dr_path=getenv("DOCUMENT_ROOT")."/bases/".$arrHttp["base"]."/";
		$dr_path_rel="<i>[DOCUMENT_ROOT]</i>/bases/".$arrHttp["base"]."/";
	}
}

include("../common/header.php");

?>
<body>

<div class="helper">
<a href=../documentacion/ayuda.php?help=<?php echo $_SESSION["lang"]?>/import_doc.html target=_blank><?php echo $msgstr["help"]?></a>&nbsp &nbsp;
<?php
if (isset($_SESSION["permiso"]["CENTRAL_EDHLPSYS"]))
	echo "<a href=../documentacion/edit.php?archivo=".$_SESSION["lang"]."/import_doc.html target=_blank>".$msgstr["edhlp"]."</a>";
echo "<font color=white>&nbsp; &nbsp; Script: import_doc_mnu.php" ?>
</font>
</div>
<div class="middle form">
	<div class="formContent">
<?php
$OS=strtoupper(PHP_OS);
include("../common/get_post.php");
include("../config.php");
$lang=$_SESSION["lang"];
include("../lang/dbadmin.php");
include("../lang/acquisitions.php");
include("../config.php");
include("../common/header.php");
//function to get the ID
function ProximoNumero($base){
global $db_path,$max_cn_length;
	$archivo=$db_path.$base."/data/control_number.cn";
	if (!file_exists($archivo)){
		$fp=fopen($archivo,"w");
		$res=fwrite($fp,"");
		fclose($fp);
	}
	$perms=fileperms($archivo);
	if (is_writable($archivo)){
	//se protege el archivo con el número secuencial
		chmod($archivo,0555);
	// se lee el último número asignado y se le agrega 1
		$fp=file($archivo);
		$cn=implode("",$fp);
		$cn=$cn+1;
	// se remueve el archivo .bak y se renombre el archivo .cn a .bak
		if (file_exists($db_path.$base."/data/control_number.bak"))
			unlink($db_path.$base."/data/control_number.bak");
		$res=rename($archivo,$db_path.$base."/data/control_number.bak");
		chmod($db_path.$base."/data/control_number.bak",0666);
		$fp=fopen($archivo,"w");
	    fwrite($fp,$cn);
	    fclose($fp);
	    chmod($archivo,0666);
	    if (isset($max_cn_length)) $cn=str_pad($cn, $max_cn_length, '0', STR_PAD_LEFT);
	    return $cn;
	}
}
$fn=$_POST["fn"];
$count=0;
if(isset($fn))
{

$fn=explode("&*",$fn);


for($i=0;$i<count($fn)-1;$i++)
{
 
$mx_path=$cisis_ver."mx";

//$base="marc";
$base=$_POST["base"];
$bd=$db_path.$base;
$nombre=$fn[$i];
$dirc=$_POST['cd'];
//$nombre=str_replace(" ","\\ ",$fn[$i]);
$nombrese=str_replace(" ","_",$nombre);
rename($dirc.$nombre,$dirc.$nombrese);
$nombre=$nombrese;
$myID=ProximoNumero($base);
$tika_path=str_replace($cisis_ver,"",$cisis_path);
$cmdconvert= "java -jar ".$tika_path."tika.jar -h ".$dirc."/".$nombre." > ".$db_path."wrk/".$nombre.".html";

exec($cmdconvert,$out,$b);
//echo 'cmdconvert=' . $cmdconvert . '<BR>';
if($b==1)
{
echo "<br><font color='red'>Error occurred converting to HTML $nombre </font>";


}
else
{
//$nombre=str_replace("\\ "," ",$nombre);
$bdp=$_POST['base'];


rename($db_path."wrk/".$nombre.".html",$db_path."wrk/".$nombrese.".html");
$nombre=$nombrese.".html";

//echo "<br><h2>Import process OK</h2>";
/* $fichero_texto = fopen ($db_path."wrk/" . $nombre, "r");
   $Nro = fread($fichero_texto, filesize($db_path."wrk/" . $nombre));
   $IsisScript="$Wxis"." IsisScript=".$db_path."wrk/hi.xis";*/


$fp=file($db_path."wrk/$nombre");
$IsisScript="$Wxis"." IsisScript=".$db_path."wrk/hi.xis";
$strNro="";
foreach ($fp as $Nro){
if ($Nro!="") 
{
$pos=strpos($Nro,'"/>')-strlen($Nro);
if (substr($Nro,0,23)=='<meta name="dc:creator"') $creator=trim(substr($Nro,33,$pos));
if (substr($Nro,0,22)=='<meta name="dc:format"') $format=trim(substr($Nro,32,$pos));
if (substr($Nro,0,23)=='<meta name="dc:subject"') $subject=trim(substr($Nro,33,$pos));
if (substr($Nro,0,21)=='<meta name="dc:title"') $title=trim(substr($Nro,31,$pos));
if (substr($Nro,0,28)=='<meta name="dcterms:created"') $created=trim(substr($Nro,38,$pos));
if (substr($Nro,0,25)=='<meta name="dc:publisher"') $publisher=trim(substr($Nro,35,$pos));
if (substr($Nro,0,27)=='<meta name="dc:description"') $description=trim(substr($Nro,37,$pos));
}
$strNro.= strip_tags($Nro);
}
//Change the < and the > in the text
$strNro=str_replace("&lt;",'<  ',$strNro);
$strNro=str_replace("&gt",'  >',$strNro);
@ $fp = fopen($db_path."wrk/txt99.txt", "w");
if (!$fp)
 {
   echo "Unable to write the file ".$db_path."wrk/txt99.txt";         
   exit;
 }

fwrite($fp,$strNro);
fclose($fp);
$newdirc=str_replace('/opt/ABCD/www/htdocs/bases/'.$bdp.'/',"",$dirc);
if (($newdirc=='collection/') or ($newdirc=='collection/ABCDImportRepo/')) $newdirc="collection/";
else $newdirc=str_replace('collection/',"",$newdirc);
$newdirc=substr($newdirc,0,-1);
$newurl="";
if ($newdirc!='collection') $newurl=$newdirc."/";
$nombre=str_replace(".html","",$nombre);
$info = pathinfo($dirc.$nombre);
$ext = $info['extension'];
$currdate=date("Ymd H:i:s");
//$nombre=str_replace("\\ "," ",$nombre);
$mxcmd= $cisis_path."mx null \"proc='Gload/99=".$db_path."wrk/txt99.txt"."'\"  \"proc='<111>".$myID."</111><1>".$title."</1><2>".$creator."</2><3>".$subject."</3><4>".$description."</4><5>".$publisher."</5><7>".$created."</7><"."8".">".$ext."</8><9>".$format."</9><97>".$newdirc."</97><98>".$newurl.$nombre."</98><112>".$currdate."</112>'\"  append=".$db_path.$bdp."/data/".$bdp." count=1 now -all";
exec($mxcmd,$out,$b);

if($b ==0)
{
echo "<br>Import process OK for $nombre<br>";
$count++;
}
else

{
echo "<br><font color='red'>Error creating ISIS record $nombre</font><br>";

}
}
}
echo "<br><font color='green'>$count records created</font><br>";
$mxindex=$cisis_path."mx ".$db_path.$bdp."/data/".$bdp." fst=@".$db_path.$bdp."/data/".$bdp.".fst ifupd=$db_path$bdp/data/$bdp now -all";
//echo $mxindex."<p>";
exec($mxindex,$salida,$b);

//remove the temporary files used
@unlink($db_path."wrk/".$nombre.".html"); 
@unlink($db_path."wrk/txt99.txt");
@unlink($db_path."wrk/".$nombrese.".html");


//if($count > 0)
//{
//$strINV=$cisis_path."mx  ".$db_path.$bdp."/data/".$bdp." fst=@$db_path$bdp/data/$bdp.fst fullinv=".$db_path.$bdp."/data/".$bdp." -all now tell=100";
//exec($strINV, $output,$t);
//if($t==0)
//echo "<br> Index created OK<br>";
//else 
//{
//echo "<br><font color='red'>Error creating the index</font><br>";
//echo $strINV;
//}
//}
//echo "<br><a href='../common/inicio.php?reinicio=s&base=$bdp'>&#160;&#160;&#160;<img width='50' height='55'  src='../images/database.png'><br>Reload database</a>";
/*$IsisScript=$Wxis." IsisScript=idx.xis";
$str="<IsisScript name=\"update\">
<section name=\"update\">
        <trace>xOn</trace>
        <parm name=\"cipar\">
                <pft>
                        'GIZMO_XML.*=',v1,'gizmo/gizmoXML.*'/
                </pft>
        </parm>
        <do task=\"update\">
                <parm name=\"db\"><pft>'$db_path$bdp/data/$bdp'</pft></parm>
                <parm name=\"fst\"><pft>cat('$db_path$bdp/data/$bdp.fst')</pft></parm>
                <parm name=\"mfn\"><pft>'1'</pft></parm>
                <parm name=\"lockid\"><pft>'20110610'</pft></parm>
                <parm name=\"expire\"><pft>v2004</pft></parm>
                <field action=\"define\" tag=\"1101\">Isis_Lock</field>
                <field action=\"define\" tag=\"1102\">Isis_Status</field>
                <update>
                        <write>Unlock</write>
                </update>
        </do>
</section>
</IsisScript>";

@ $fp = fopen("idx.xis", "w");

@  flock($fp, 2);

  if (!$fp)
  {
    echo "<p><strong> Error ocurred in ISIS Script."
         ."Please try again.</strong></p></body></html>";
    exit;
  }

  fwrite($fp, $str);
  flock($fp, 3);
  fclose($fp);*/
//$IsisScript=$xWxis."updaterec.xis";
//include("/opt/ABCD/www/htdocs/central/common/wxis_llamar.php");
if($b==0)
echo "<br> Index created OK<br>";
}

  
else 
{
//include ("phpfileuploader/ajax-multiplefiles.php");
include("upload_myfile.php");

}

?>

</div></div>

<?php
//include("../common/footer.php");

?>
</body>
</Html>
