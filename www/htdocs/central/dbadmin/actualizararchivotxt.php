<?php
session_start();
if (!isset($_SESSION["permiso"])){
	header("Location: ../common/error_page.php") ;
}
include("../common/get_post.php");
include ("../config.php");
$lang=$_SESSION["lang"];

include("../lang/dbadmin.php");;



if (!isset($arrHttp["archivo"])) die;
$arrHttp["txt"]=stripslashes($arrHttp["txt"]);
$arrHttp["txt"]=str_replace("\"",'"',$arrHttp["txt"]);
$archivo=$arrHttp["archivo"];
$fp=fopen($db_path.$archivo,"w");
fputs($fp,$arrHttp["txt"]);
fclose($fp);
include("../common/header.php");
?>
<link rel=STYLESHEET type=text/css href=../css/styles.css>
<body>
<?php
if (isset($arrHttp["encabezado"])){
	include("../common/institutional_info.php");
?>
<div class="sectionInfo">

			<div class="breadcrumb">
				<?php echo "<h5>"." " .$msgstr["database"].": ".$arrHttp["base"]."</h5>"?>
			</div>

			<div class="actions">
<?php echo "<a href=\"menu_modificardb.php?base=".$arrHttp["base"]."&encabezado=s\" class=\"defaultButton backButton\">";
?>
					<img src="../images/defaultButton_iconBorder.gif" alt="" title="" />
					<span><strong><?php echo $msgstr["back"]?></strong></span>
				</a>
			</div>
			<div class="spacer">&#160;</div>
</div>
<?php }?>
<div class="middle form">
			<div class="formContent">
<br><br>
<dd><table border=0>
	<tr>
		<TD>
			<p><h4>
<?php $ar=explode('/',$arrHttp["archivo"]);
$ix=count($ar)-1;
$file=$ar[$ix];
echo $file." ".$msgstr["updated"]?></h4>
<?php if (!isset($arrHttp["encabezado"]))
		echo "
			<script>if (top.frames.length<1)
			        document.writeln(\"<a href=javascript:self.close()>Cerrar</a>\")
			</script>
         ";
?>
		</TD>
</table>
</div></div>
<?php include("../common/footer.php")?>

</body>
</html>
