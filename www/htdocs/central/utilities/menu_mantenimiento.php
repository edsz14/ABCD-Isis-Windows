<?php
session_start();
$Permiso=$_SESSION["permiso"];
if (!isset($_SESSION["lang"]))  $_SESSION["lang"]="en";
include("../common/get_post.php");
$db=$arrHttp["base"];


include ("../config.php");
$lang=$_SESSION["lang"];
include("../lang/admin.php");
include("../lang/soporte.php");
include("../lang/dbadmin.php");

if (!isset($_SESSION["permiso"]["CENTRAL_ALL"]) and
    !isset($_SESSION["permiso"]["CENTRAL_DBUTILS"]) and
    !isset($_SESSION["permiso"][$db."_CENTRAL_ALL"]) and
    !isset($_SESSION["permiso"][$db."_CENTRAL_DBUTILS"])
    ){
	echo "<script>
	      alert('".$msgstr["invalidright"]."')
          history.back();
          </script>";
    die;
}

if (!isset($arrHttp["base"])) $arrHttp["base"]="";

if (strpos($arrHttp["base"],"|")===false){

}   else{
		$ix=strpos($arrHttp["base"],'^b');
		$arrHttp["base"]=substr($arrHttp["base"],2,$ix-2);
}
//foreach ($arrHttp as $var=>$value) echo "$var = $value<br>";
include("../common/header.php");
?>

<script src=../dataentry/js/lr_trim.js></script>


<script language="javascript" type="text/javascript">
<!--
/****************************************************
     Author: Eric King
     Url: http://redrival.com/eak/index.shtml
     This script is free to use as long as this info is left in
     Featured on Dynamic Drive script library (http://www.dynamicdrive.com)
****************************************************/
var win=null;
function NewWindow(mypage,myname,w,h,scroll,pos){
if(pos=="random"){LeftPosition=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;TopPosition=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
if(pos=="center"){LeftPosition=(screen.width)?(screen.width-w)/2:100;TopPosition=(screen.height)?(screen.height-h)/2:100;}
else if((pos!="center" && pos!="random") || pos==null){LeftPosition=0;TopPosition=20}
settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
win=window.open(mypage,myname,settings);}
win.focus()
// -->

function EnviarForma(Opcion,Mensaje){

	base="<?php echo $arrHttp["base"]?>"
	if (Opcion=="eliminarbd" || Opcion=="inicializar"){
		if (base==""){
			alert("<?php echo $msgstr["seldb"]?>")
			return
		}

	}
//	if (Opcion!="explorar") Mensaje+=" "+base
//	if (confirm(Mensaje)==true){
		switch (Opcion){
			case "eliminarbd":
				document.admin.base.value=base
				document.admin.cipar.value=base+".par"
				document.admin.action="eliminarbd.php"
				document.admin.target=""
				break;
			case "inicializar":
				document.admin.base.value=base
				document.admin.target=""
				break;
            		case "cn":  //assign control number
            	document.admin.base.value=base
				document.admin.cipar.value=base+".par"
				document.admin.action="assign_control_number.php"
				document.admin.target=""
				break
			case "resetcn":    //RESET LAST CONTROL NUMBER IN THE BIBLIOGRAPHIC DATABASE
				document.admin.base.value=base
				document.admin.cipar.value=base+".par"
				document.admin.action="reset_control_number.php"
				document.admin.target=""
				break;
			case "linkcopies":    //LINK BIBLIOGRAPHIC DATABASE WITH COPIES DATABASE
				document.admin.base.value=base
				document.admin.cipar.value=base+".par"
				document.admin.action="copies_linkdb.php"
				document.admin.target=""
				break;
			case "addcopiesdatabase":    //Marcos Script				
				document.admin.base.value=base
				document.admin.cipar.value=base+".par"
				document.admin.action="addcopiesdatabase.php"
				document.admin.target=""				
				break;
			case "copiesocurrenciesreport":    //Marcos Script				
				document.admin.base.value=base
				document.admin.cipar.value=base+".par"
				document.admin.action="copiesdupreport.php"
				document.admin.target=""				
				break;
			case "addloanobjectcopies":    //Marcos Script				
				document.admin.base.value=base
				document.admin.cipar.value=base+".par"
				document.admin.action="addloanobjectcopies.php"
				document.admin.target=""				
				break;				
			case "addloanobj":    //Marino Vretag				
				document.admin.base.value=base
				document.admin.cipar.value=base+".par"
				document.admin.action="addloanobject.php"
				document.admin.target=""				
				break;				
			case "fullinv":     //INVERTED FILE GENERATION WITH MX
				NewWindow("../dataentry/img/preloader.gif","progress",100,100,"NO","center")
				document.admin.base.value=base
				document.admin.cipar.value=base+".par"
				document.admin.action="../utilities/vmx_fullinv.php"
				document.admin.target=""
				break;
				
			case "ISOexport":    //Marino ISO export
				
				document.admin.base.value=base
				document.admin.cipar.value=base+".par"
				document.admin.action="vmxISO_export.php"
				document.admin.target=""

			case "ISOimport":    //Marino ISO import
				
				document.admin.base.value=base
				document.admin.cipar.value=base+".par"
				document.admin.action="vmxISO_import.php"
				document.admin.target=""
				
				break;
			case "unlock":    //Marino Vretag
				
				document.admin.base.value=base
				document.admin.cipar.value=base+".par"
				document.admin.action="unlock_db_retag_check.php"
				document.admin.target=""
				break;
			case "addloanobj":    //Marino addloanobj
				
				document.admin.base.value=base
				document.admin.cipar.value=base+".par"
				document.admin.action="addloanobject.php"
				document.admin.target=""
				
				break;
			case "barcode":    //Marino barcode check
				
				document.admin.base.value=base
				document.admin.cipar.value=base+".par"
				document.admin.action="barcode_check.php"
				document.admin.target=""
				
								break;
			case "dirtree": //EXPLORE DATABASE DIRECTORY
				switch (Mensaje){
					case "par":
					case "www":
					case "wrk":
						document.admin.base.value=Mensaje
						break;
					default:
						document.admin.base.value=base
						break;
				}

				document.admin.action="dirtree.php";
				document.admin.target=""
				break;
			default:
				alert("")
				return;

		}
		document.admin.Opcion.value=Opcion
		document.admin.cipar.value=base+".par"
		document.admin.submit()
//	}

}

</script>
<body onunload=win.close()>
<?php
if (isset($arrHttp["encabezado"])) {
	include("../common/institutional_info.php");
	$encabezado="&encabezado=s";
}
echo "
	<div class=\"sectionInfo\">
			<div class=\"breadcrumb\">".
				$msgstr["maintenance"]. ": " . $arrHttp["base"]."
			</div>
			<div class=\"actions\">

	";
if (isset($arrHttp["encabezado"])){
	echo "<a href=\"../common/inicio.php?reinicio=s&base=".$arrHttp["base"]."\" class=\"defaultButton backButton\">";
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
echo "<font color=white>&nbsp; &nbsp; Script: dbadmin/menu_mantenimiento.php";
?>
</font>
</div>
<div class="middle form">
	<div class="formContent">
<form name=maintenance>
<table cellspacing=5 width=400 align=center>
	<tr>
		<td>

		<input type=hidden name=base value=<?php echo $arrHttp["base"]?>>
             <br>
			<ul>

			<li><a href='javascript:EnviarForma("fullinv","<?php echo $msgstr["mnt_gli"]?>")'><?php echo $msgstr["mnt_gli"] ."(MX)"?></a></li>
			<li><a href='javascript:EnviarForma("inicializar","<?php echo $msgstr["mnt_ibd"]?>")'><?php echo $msgstr["mnt_ibd"]?></a></li>
			<li><a href='javascript:EnviarForma("eliminarbd","<?php echo $msgstr["mnt_ebd"]?>")'><?php echo $msgstr["mnt_ebd"]?></a></li>
			<li><a href='javascript:EnviarForma("lock","<?php echo $msgstr["mnt_lock"]?>")'><?php echo $msgstr["mnt_lock"]?></a></li>
			<li><a href='javascript:EnviarForma("unlock","<?php echo $msgstr["mnt_unlock"]?>")'><?php echo $msgstr["mnt_unlock"]?></a></li>
			<li><a href='javascript:EnviarForma("cn","<?php echo $msgstr["assigncn"]?>")'><?php echo $msgstr["assigncn"]?></a></li>						
			<?php
			if (($arrHttp["base"]!="copies") and ($arrHttp["base"]!="providers") and ($arrHttp["base"]!="suggestions") and ($arrHttp["base"]!="purchaseorder") and ($arrHttp["base"]!="users") and ($arrHttp["base"]!="loanobjects") and ($arrHttp["base"]!="trans") and ($arrHttp["base"]!="suspml") ) {
            ?>
			<li><a href='javascript:EnviarForma("linkcopies","<?php echo $msgstr["linkcopies"]?>")'><?php echo $msgstr["linkcopies"]?></a></li>
			<li><a href='Javascript:EnviarForma("addloanobj","<?php echo $msgstr["addLOfromDB_mx"]?>")'><?php echo $msgstr["addLOfromDB_mx"]?></a></li>   
			<li><a href='Javascript:EnviarForma("addloanobjectcopies","<?php echo $msgstr["addLOwithoCP_mx"]?>")'><?php echo $msgstr["addLOwithoCP_mx"]?></a></li>          
			<li><a href='Javascript:EnviarForma("addcopiesdatabase","<?php echo $msgstr["addCPfromDB_mx"]?>")'><?php echo $msgstr["addCPfromDB_mx"]?></a></li> 			
			<li><a href='Javascript:EnviarForma("ISOexport","<?php echo "ExportISO"?>")'><?php echo "Export ISO with MX"?></a></li>
			<li><a href='Javascript:EnviarForma("ISOimport","<?php echo "ImportISO"?>")'><?php echo "Import ISO with MX"?></a></li>
             <li><a href='Javascript:EnviarForma("addloanobj","<?php echo "Add to loanobjects"?>")'><?php echo "Add to loanobjects"?></a></li>
             <li><a href='Javascript:EnviarForma("barcode","<?php echo "Barcode search"?>")'><?php echo "Barcode search"?></a></li>
			<?php
			}
			if ($arrHttp["base"]=="copies") {
			?>
			<li><a href='Javascript:EnviarForma("copiesocurrenciesreport","<?php echo $msgstr["CPdupreport_mx"]?>")'><?php echo $msgstr["CPdupreport_mx"]?></a></li>
			<?php }?>
			
			
			
			
	<?php
	if (isset($_SESSION["permiso"]["CENTRAL_ALL"]) and
		(isset($_SESSION["permiso"]["CENTRAL_EXDBDIR"]) or
        isset($_SESSION["permiso"][$arrHttp["base"]."_CENTRAL_EXDBDIR"]))
    ){

    ?>
			<li><a href='Javascript:EnviarForma("dirtree","<?php echo $msgstr["expbases"]?>")'><?php echo $msgstr["expbases"]?></a></li>
	        <li>Explorar las carpetas del sistema</li>
	        <ul>
			<li><a href='Javascript:EnviarForma("dirtree","par")'><?php echo "par"?></a></li>
			<li><a href='Javascript:EnviarForma("dirtree","www")'><?php echo "www"?></a></li>
			<li><a href='Javascript:EnviarForma("dirtree","wrk")'><?php echo "wrk"?></a></li>
	        </ul>
	<?php }?>
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
<?php include("../common/footer.php");?>
</body>
</html>
