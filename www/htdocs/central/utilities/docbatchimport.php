<?php
session_start();
if (!isset($_SESSION["permiso"])){
	header("Location: ../common/error_page.php") ;
}
set_time_limit(0);
if (!isset($_SESSION["lang"]))  $_SESSION["lang"]="en";
include("../common/get_post.php");
include("../config.php");
$lang=$_SESSION["lang"];
include("../lang/dbadmin.php");
include("../common/header.php");
$converter_path=$cisis_path."mx";
$base_ant=$arrHttp["base"];
$tikapath=$cisis_path;
if ($cisis_ver!="")  $tikapath=str_replace($cisis_ver,'',$cisis_path);
$OS=strtoupper(PHP_OS);
if (strpos($OS,"WIN")=== false) 
{
$tikacommands='java -jar '.$tikapath.'tika-server.jar --host=127.0.0.1 --port=9998 > '.$db_path."wrk/TikaTemp.txt".' &';
//echo "TIKA command : " . $tikacommands . "<BR>";
//die;
exec($tikacommands,$outcms,$banderacms);
}
echo "<script src=../dataentry/js/lr_trim.js></script>";
echo "<body onunload=win.close()>\n";
if (isset($arrHttp["encabezado"])) {
	include("../common/institutional_info.php");
	$encabezado="&encabezado=s";	
}
echo "<div class=\"sectionInfo\">
			<div class=\"breadcrumb\">".$msgstr["docbatchimport_mx"].": " . $base_ant."
			</div>
			<div class=\"actions\">";
if (isset($arrHttp["encabezado"])){
echo "<a href=\"../dbadmin/menu_mantenimiento.php?base=".$base_ant."&encabezado=s\" class=\"defaultButton backButton\">";
echo "<img src=\"../images/defaultButton_iconBorder.gif\" alt=\"\" title=\"\" />
	<span><strong>". $msgstr["back"]."</strong></span></a>";
}
echo "</div>
	<div class=\"spacer\">&#160;</div>
	</div>";
?>
	<script language="javascript">
    function OpenWindows() {      
NewWindow("../dataentry/img/preloader.gif","progress",100,100,"NO","center")
win.focus()
    }	
function NewWindow(mypage,myname,w,h,scroll,pos){
if(pos=="random"){LeftPosition=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;TopPosition=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
if(pos=="center"){LeftPosition=(screen.width)?(screen.width-w)/2:100;TopPosition=(screen.height)?(screen.height-h)/2:100;}
else if((pos!="center" && pos!="random") || pos==null){LeftPosition=0;TopPosition=20}
settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
win=window.open(mypage,myname,settings);}


var seconds = 7;
function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    document.getElementById('countdown').innerHTML = "Please wait " + remainingSeconds+" seconds while tika server starts.";
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = '<input type=submit name=submit value="<?php echo $msgstr["update"];?>">';
    } else {
        seconds--;
    }
}
 
var countdownTimer = setInterval('secondPassed()', 1000);

 </script>
<div class="helper">
	<a href=../documentacion/ayuda.php?help=<?php echo $_SESSION["lang"]?>/menu_mantenimiento_docbatchimport.html target=_blank><?php echo $msgstr["help"]?></a>&nbsp &nbsp;
<?php
if (isset($_SESSION["permiso"]["CENTRAL_EDHLPSYS"]))
 	echo "<a href=../documentacion/edit.php?archivo=".$_SESSION["lang"]."/menu_mantenimiento_docbatchimport.html target=_blank>".$msgstr["edhlp"]."</a>";
echo "<font color=white>&nbsp; &nbsp; Script: docbatchimport.php</font>";
?>
</div>		
<div class="middle form">
	<div class="formContent">
<form action="" method="post" name="form1" target="_self" id="form1" onsubmit="OpenWindows();">
<?php
echo "<p>".$msgstr["docbatchimport_tx"]."</p>";  
echo '<b><label style="color:red">'.$msgstr["warning"].'</label></b></br>'; 
echo $msgstr["docbatchimport_tw"];
echo " <input type=\"hidden\" value=\"$base_ant\" name=\"base\"/>";  
echo '</br></br></br>';
  ?>
<div id="formarea" style="display:block"> 
<table width="750px" border="0">
  <tr>
     <td width="10">&nbsp;</td>
    <td colspan="10" style="font-size:14px">Match your fields with the Dublin Core metadata format.</td>
	  <tr>
    <td width="10">&nbsp;</td>
    <td width="59" align="left" style="font-size:14px"><label>DC:Title</label></td>
    <td width="60" align="left" style="font-size:14px"><input type="text" name="title" size="2" value="v1"/></td>
    <td width="71" align="left" style="font-size:14px"><label>DC:Creator</label></td>
    <td width="71" align="left" style="font-size:14px"><input type="text" name="creator" size="2" value="v2"/></td>
    <td width="71" align="left" style="font-size:14px"><label>DC:Subject</label></td>
    <td width="72" align="left" style="font-size:14px"><input type="text" name="subject" size="2" value="v3"/></td>
    <td width="79" align="left" style="font-size:14px"><label>DC:Description</label></td>
    <td width="80" align="left" style="font-size:14px"><input type="text" name="description" size="2" value="v4"/></td>
    <td width="70" align="left" style="font-size:14px"><label>DC:Publisher</label></td>
    <td width="71" align="left" style="font-size:14px"><input type="text" name="publisher" size="2" value="v5"/></td>
	  </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    </tr>
	  <tr>
	  <td width="10">&nbsp;</td>
	 <td width="59" align="left" style="font-size:14px"><label>DC:Date</label></td>
     <td width="60" align="left" style="font-size:14px"><input type="text" name="date" size="2" value="v7"/></td>
     <td width="71" align="left" style="font-size:14px"><label>DC:Type</label></td>
     <td width="71" align="left" style="font-size:14px"><input type="text" name="type" size="2" value="v8"/></td>
     <td width="71" align="left" style="font-size:14px"><label>DC:Format</label></td>
     <td width="72" align="left" style="font-size:14px"><input type="text" name="format" size="2" value="v9"/></td>
     <td width="79" align="left" style="font-size:14px"><label>DC:Source</label></td>
     <td width="80" align="left" style="font-size:14px"><input type="text" name="source" size="2" value="v11"/></td>
     <td width="70" align="left" style="font-size:14px"><label>DC:URL</label></td>
     <td width="71" align="left" style="font-size:14px"><input type="text" name="url" size="2" value="v98"/></td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
		<td align="left" style="font-size:14px"><label>Sections</label></td>
	    <td align="left" style="font-size:14px"><input type="text" name="sections" size="2" value="v97"/></td>
	    <td align="left" style="font-size:14px"><label>DocText</label></td>
	    <td align="left" style="font-size:14px"><input type="text" name="doctext" size="2" value="v99"/></td>	    
	    <td align="left" style="font-size:14px"><label>Identifier</label></td>
	    <td align="left" style="font-size:14px"><input type="text" name="id" size="2" value="v111"/></td>
	    <td align="left" style="font-size:14px"><label>Date Added</label></td>
	    <td align="left" style="font-size:14px"><input type="text" name="dated" size="2" value="v112"/></td>
	    <td align="left" style="font-size:14px"><label>Doc Source</label></td>
	    <td align="left" style="font-size:14px"><input type="text" name="docsource" size="2" value="v96"/></td>
	    </tr>	
		<tr>
	    <td>&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    <td align="left" style="font-size:14px">&nbsp;</td>
	    </tr>
    </tr>
</table> 

<table width="750px" border="0">
  <tr>
     <td width="10">&nbsp;</td>
    <td><?php 
	if (strpos($OS,"WIN")=== false) 
{
//Linux
echo '<span id="countdown" class="timer" style="font-size:14px"></span>';
}
else echo "<input type=submit name=submit value=".$msgstr["update"].">"; 
  if (isset($arrHttp["encabezado"])) echo "<input type=hidden name=encabezado value=s>";
 ?></td>
    </tr>
</table> 
</div>
</form>
</div>
<?php
if ($_POST["submit"])
{
$procstartedat=date("Y-m-d H:i:s");
$procstartedatN=date("Ymd H:i:s");
?>
<script languaje=javascript>
document.getElementById("formarea").style.display='none';
</script>
<?php 
$doctotal=0;
$total=mt_rand(1, 1000);

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

function showFiles($path) { 
// asignamos a $directorio el objeto dir creado con la ruta 
$directorio = dir($path); 
// recorremos todos los archivos y carpetas
while ($archivo = $directorio -> read()) 
{ 
if($archivo!="." && $archivo!="..") 
{ 
if(is_dir($path.$archivo)) 
{ 
// Mostramos el nombre de la carpeta y los archivo contenidos 
// en la misma 
echo get_infoFile($path,$archivo);
// llamamos nuevamente a la función con la nueva carpeta 
showFiles($path.$archivo."/");
}
else
{
// Mostramos el archivo 
echo get_infoFile($path,$archivo);
} 
} 
} 
$directorio -> close(); 
}


function get_infoFile($path,$archivo)
{ 
global $total,$tikapath,$converter_path,$db_path,$base_ant,$cisis_ver,$Wxis,$doctotal,$img_path,$OS,$procstartedatN;
if(!is_dir($path.$archivo)){ 
//Get the file info
$originalFileName=$archivo;
$info = pathinfo($path.$archivo);
$ext = $info['extension'];
// clean up file name to make it easy to process
$newdocname= preg_replace("/[^a-z0-9._]/", "",str_replace(" ", "_", str_replace("%20", "_", strtolower($archivo)))); 
$newdocname=str_replace(".".$ext,"",$newdocname);
//build the text to display
$cadena='&nbsp;&nbsp;&nbsp;&nbsp;<label style="color:blue">Processing</label> <label style="font-style:italic">'.$archivo.'</label> of <label style="font-weight:bold">'.number_format(filesize($path.$archivo)/1024,2,",",".").'Kb</label>. Renaming to <label style="font-weight:bold;color:red">'.$newdocname.'~'.$total.".".$ext."</label> .Creating records...";
//echo "Progress : " . $cadena . "<BR>";
//die;
//rename the file before proccessing
$temppath=substr($path,strpos($path,'ABCDImportRepo'));
$fixpath=substr($temppath,(strpos($temppath,'/')+1));
createPath($img_path.$base_ant."/collection/".$fixpath);
rename($path.$archivo, $img_path.$base_ant."/collection/".$fixpath.$newdocname.'~'.$total.".".$ext);
//Get the fields tags
$vid=RemoveV($_POST["id"]);
$vtitle=RemoveV($_POST["title"]);
$vcreator=RemoveV($_POST["creator"]);
$vsubject=RemoveV($_POST["subject"]);
$vdescription=RemoveV($_POST["description"]);
$vpublisher=RemoveV($_POST["publisher"]);
$vdate=RemoveV($_POST["date"]);
$vtype=RemoveV($_POST["type"]);
$vformat=RemoveV($_POST["format"]);
$vsource=RemoveV($_POST["source"]);
$vsections=RemoveV($_POST["sections"]);
$vurl=RemoveV($_POST["url"]);
$vdoctext=RemoveV($_POST["doctext"]);
$vdated=RemoveV($_POST["dated"]);
$vdocsource=RemoveV($_POST["docsource"]);
//Extract the HTML
if (strpos($OS,"WIN")=== false)
{
//Linux
if (($vdoctext!="") and ($cisis_ver=='bigisis/')) $tikacommand='curl -T '.$img_path.$base_ant."/collection/".$fixpath.$newdocname.'~'.$total.".".$ext.' http://127.0.0.1:9998/tika --header "Accept: text/html" >'.$db_path."wrk/".$newdocname.'~'.$total.'.html';
else 
$tikacommand='curl -T '.$img_path.$base_ant."/collection/".$fixpath.$newdocname.'~'.$total.".".$ext.' http://127.0.0.1:9998/meta >'.$db_path."wrk/".$newdocname.'~'.$total.'.html';
//echo "TIKA command : " . $tikacommand . "<BR>";
exec($tikacommand,$outcm,$banderacm);
}
else
{
//Windows
if (($vdoctext!="") and ($cisis_ver=='ffi/')) $tikacommand='java -jar '.$tikapath.'tika.jar -h '.$img_path.$base_ant."/collection/".$fixpath.$newdocname.'~'.$total.".".$ext.' >'.$db_path."wrk/".$newdocname.'~'.$total.'.html';
else $tikacommand='java -jar '.$tikapath.'tika.jar -m '.$img_path.$base_ant."/collection/".$fixpath.$newdocname.'~'.$total.".".$ext.' >'.$db_path."wrk/".$newdocname.'~'.$total.'.html';
//echo "TIKA command : " . $tikacommand . "<BR>";
exec($tikacommand,$outcm,$banderacm);
}
$creator=$format=$subject=$title=$created=$publisher=$description=$str="";
$fp=file($db_path."wrk/".$newdocname.'~'.$total.'.html');
foreach ($fp as $value){
if ($value!="") 
{

if (strpos($OS,"WIN")=== false) 
{
//In Linux
if (($vdoctext!="") and ($cisis_ver=='bigisis/'))
{
//Get the FullText in Linux
$pos=strpos($value,'"/>')-strlen($value);
if (substr($value,0,23)=='<meta name="dc:creator"') $creator=trim(substr($value,33,$pos));
if (substr($value,0,22)=='<meta name="dc:format"') $format=trim(substr($value,32,$pos));
if (substr($value,0,23)=='<meta name="dc:subject"') $subject=trim(substr($value,33,$pos));
if (substr($value,0,21)=='<meta name="dc:title"') $title=trim(substr($value,31,$pos));
if (substr($value,0,28)=='<meta name="dcterms:created"') $created=trim(substr($value,38,$pos));
if (substr($value,0,25)=='<meta name="dc:publisher"') $publisher=trim(substr($value,35,$pos));
if (substr($value,0,27)=='<meta name="dc:description"') $description=trim(substr($value,37,$pos));
if (substr($value,0,6)!='<meta ') $str.= $value;
}//End of if (($vdoctext!="") and ($cisis_ver=='bigisis/')))
else
{
//Only the Metadata in Linux
if (substr($value,0,14)=='"dc:creator","') $creator=trim(substr($value,14,-2));
if (substr($value,0,13)=='"dc:format","') $format=trim(substr($value,13,-2));
if (substr($value,0,14)=='"dc:subject","') $subject=trim(substr($value,14,-2));
if (substr($value,0,12)=='"dc:title","') $title=trim(substr($value,12,-2));
if (substr($value,0,19)=='"dcterms:created","') $created=trim(substr($value,19,-2));
if (substr($value,0,16)=='"dc:publisher","') $publisher=trim(substr($value,16,-2));
if (substr($value,0,18)=='"dc:description","') $description=trim(substr($value,18,-2));
}//end of else for if (($vdoctext!="") and ($cisis_ver=='bigisis/')))

}
else
{
//Windows
if (($vdoctext!="") and ($cisis_ver=='ffi/'))
{
//Get the FullText in Windows
$pos=strpos($value,'"/>')-strlen($value);
if (substr($value,0,23)=='<meta name="dc:creator"') $creator=trim(substr($value,33,$pos));
if (substr($value,0,22)=='<meta name="dc:format"') $format=trim(substr($value,32,$pos));
if (substr($value,0,23)=='<meta name="dc:subject"') $subject=trim(substr($value,33,$pos));
if (substr($value,0,21)=='<meta name="dc:title"') $title=trim(substr($value,31,$pos));
if (substr($value,0,28)=='<meta name="dcterms:created"') $created=trim(substr($value,38,$pos));
if (substr($value,0,25)=='<meta name="dc:publisher"') $publisher=trim(substr($value,35,$pos));
if (substr($value,0,27)=='<meta name="dc:description"') $description=trim(substr($value,37,$pos));
if (substr($value,0,6)!='<meta ') $str.= $value;
}//End of if (($vdoctext!="") and ($cisis_ver=='ffi/')))
else
{
//Only the Metadata in Windows
if (substr($value,0,11)=='dc:creator:') $creator=trim(substr($value,12));
if (substr($value,0,10)=='dc:format:') $format=trim(substr($value,11));
if (substr($value,0,11)=='dc:subject:') $subject=trim(substr($value,12));
if (substr($value,0,9)=='dc:title:') $title=trim(substr($value,10));
if (substr($value,0,16)=='dcterms:created:') $created=trim(substr($value,17));
if (substr($value,0,13)=='dc:publisher:') $publisher=trim(substr($value,14));
if (substr($value,0,15)=='dc:description:') $description=trim(substr($value,16));
}
}
}
}
//Get the ID
$currentID=ProximoNumero($base_ant);
//Create the fields proc
$fieldspart="\"proc='";
$vspath="collection";
$docsourcepath=$img_path.$base_ant."/collection/ABCDSourceRepo/".$newdocname.'~'.$total.".html";
if (($fixpath!="") and ($fixpath!="ABCDImportRepo/")) $vspath=substr($fixpath,0,-1);
if (($currentID!="") and ($vid!="")) $fieldspart.="<".$vid.">".$currentID."</".$vid.">";
if (($title!="") and ($vtitle!="")) $fieldspart.="<".$vtitle.">".$title."</".$vtitle.">";
if (($creator!="") and ($vcreator!="")) $fieldspart.="<".$vcreator.">".$creator."</".$vcreator.">";
if (($subject!="") and ($vsubject!="")) $fieldspart.="<".$vsubject.">".$subject."</".$vsubject.">";
if (($description!="") and ($vdescription!="")) $fieldspart.="<".$vdescription.">".$description."</".$vdescription.">";
if (($publisher!="") and ($vpublisher!="")) $fieldspart.="<".$vpublisher.">".$publisher."</".$vpublisher.">";
if (($created!="") and ($vdate!="")) $fieldspart.="<".$vdate.">".$created."</".$vdate.">";
if (($ext!="") and ($vtype!="")) $fieldspart.="<".$vtype.">".$ext."</".$vtype.">";
if (($format!="") and ($vformat!="")) $fieldspart.="<".$vformat.">".$format."</".$vformat.">";
if (($archivo!="") and ($vsource!="")) $fieldspart.="<".$vsource.">".$archivo."</".$vsource.">";
if ($vsections!="") $fieldspart.="<".$vsections.">".$vspath."</".$vsections.">"; 
if (($fixpath.$newdocname.'~'.$total.".".$ext!="") and ($vurl!="")) $fieldspart.="<".$vurl.">".$fixpath.$newdocname.'~'.$total.".".$ext."</".$vurl.">"; 
$fieldspart.="<112>".$procstartedatN."</112>";
if (($vdocsource!="") and ($vurl!="")) $fieldspart.="<".$vdocsource.">".$docsourcepath."</".$vdocsource.">"; 
$fieldspart.="'\"";
//Save the file and import the content into a record if allow
if (($cisis_ver=="bigisis/") or ($cisis_ver=="ffi/"))
{
if (($vdoctext!="") and ($str!=""))
{
//Save the text into a file
@ $fp = fopen($docsourcepath, "w");
fwrite($fp,$str);
fclose($fp); 
}
}
//Create the record
$mx = $converter_path." null ".$fieldspart." append=".$db_path.$base_ant."/data/".$base_ant." count=1 now -all";
exec($mx,$outmx,$banderamx);
@unlink($db_path."wrk/TikaTemp.txt");
@unlink($db_path."wrk/".$newdocname.'~'.$total.'.html');
$total++;
$doctotal++;
$cadena.=' <label style="font-weight:bold">Done</label></br>';
//echo "New record ".$doctotal . " created...<br>";
}
return $cadena; 
}
function RemoveV($field)
{
$field=trim($field);
if (($field[0]=='v') or ($field[0]=='V')) return str_replace( 'v','',strtolower($field));
return $field;
}
function time_diff($s) { 
    $m = 0; $hr = 0; $d = 0; $td = "now";
    if ($s > 59) { 
        $m = (int)($s/60); 
        $s = $s-($m*60); // sec left over 
        $td = "$m minute";
		if ($m > 1) $td .= "s";
		$td.=" $s second";
		if ($s > 1) $td .= "s";				
    } 
    if ($m > 59) { 
        $hr = (int)($m / 60); 
        $m = $m - ($hr*60); // min left over 
        $td = "$hr hour"; 
        if ($hr > 1) $td .= "s";
        if ($m > 0) $td .= ", $m minute";
		if ($m > 1) $td .= "s";
		$td.=" $s second";
		if ($s > 1) $td .= "s";
    } 
    if ($hr > 23) { 
        $d = (int) ($hr / 24); 
        $hr = $hr-($d*24); // hr left over 
        $td = "$d day"; 
        if ($d > 1) $td .= "s";
        if ($hr > 0) $td .= ", $hr hour";
        if ($hr > 1) $td .= "s";
		if ($m > 0) $td .= ", $m minute";
		if ($m > 1) $td .= "s";
		$td.=" $s second";
		if ($s > 1) $td .= "s";
        
    } 
    return $td; 
} 
//Llamamos a la funcion de procesar la coleccion
showFiles($img_path.$base_ant."/collection/ABCDImportRepo/");
//$mxinv=$converter_path." ".$db_path.$base_ant."/data/".$base_ant." fst=@".$db_path.$base_ant."/data/".$base_ant.".fst fullinv/m=".$db_path.$base_ant."/data/".$base_ant." now -all";
$mxinv=$converter_path." ".$db_path.$base_ant."/data/".$base_ant." fst=@".$db_path.$base_ant."/data/fulltext.fst fullinv/m=".$db_path.$base_ant."/data/".$base_ant." now -all tell=1";
exec($mxinv, $outputmxinv,$banderamxinv);
$procendedat=date("Y-m-d H:i:s");
$t1=strtotime ($procstartedat);
$t2=strtotime ($procendedat);
$differ = $t2 - $t1;
if ($differ>60)
{
$endtime=time_diff($differ);
}
else 
{
$endtime=$differ;
$endtime.=" seconds";
}
echo '</br></br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<label style="font-weight:bold;color:blue">Final Remarks</label></br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The process started at '.$procstartedat.'.</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The process ended at '.$procendedat.'.</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The process took '.$endtime.'.</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-weight:bold;color:red">'.$doctotal.'</label><label style="font-weight:bold;color:blue"> documents were processed.</label>';
eliminarDir($img_path.$base_ant."/collection/ABCDImportRepo");
}//if ($_POST["submit"])
function createPath($path) {
    if (is_dir($path)) return true;
    $prev_path = substr($path, 0, strrpos($path, '/', -2) + 1 );
    $return = createPath($prev_path);
    return ($return && is_writable($prev_path)) ? mkdir($path) : false;
}

function eliminarDir($carpeta)
{
foreach(glob($carpeta . "/*") as $archivos_carpeta)
{ 
if (is_dir($archivos_carpeta))
{
eliminarDir($archivos_carpeta);
}
else
{
unlink($archivos_carpeta);
}
}
$temppath=substr($carpeta,strpos($carpeta,'ABCDImportRepo'));
if ($temppath!="ABCDImportRepo") rmdir($carpeta);
}
?>
</br>
</div>
<?
include("../common/footer.php");
?>
