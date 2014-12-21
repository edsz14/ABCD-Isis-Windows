<?php
session_start();
$_SESSION=array();
include("../config.php");
include("../common/get_post.php");
//foreach ($arrHttp as $var=>$value) echo "$var = $value<br>";

if (isset($_SESSION["lang"])){
	$arrHttp["lang"]=$_SESSION["lang"];
}else{
	$arrHttp["lang"]=$lang;
	$_SESSION["lang"]=$lang;
}
include ("../lang/admin.php");
include ("../lang/lang.php");
	if (!isset($css_name))
		$css_name="";
	else
		$css_name.="/";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br">
	<head>
		<title>ABCD</title>
		<meta http-equiv="Expires" content="-1" />
		<meta http-equiv="pragma" content="no-cache" />
		<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<meta http-equiv="Content-Language" content="pt-br" />
		<meta name="robots" content="all" />
		<meta http-equiv="keywords" content="" />
		<meta http-equiv="description" content="" />
		<!-- Stylesheets -->
		<link rel="stylesheet" rev="stylesheet" href="../css/<?php echo $css_name?>template.css" type="text/css" media="screen"/>
		<!--[if IE]>
			<link rel="stylesheet" rev="stylesheet" href="../css/bugfixes_ie.css" type="text/css" media="screen"/>
		<![endif]-->
		<!--[if IE 6]>
			<link rel="stylesheet" rev="stylesheet" href="../css/bugfixes_ie6.css" type="text/css" media="screen"/>
		<![endif]-->
<script src=../dataentry/js/lr_trim.js></script>
<script languaje=javascript>

// Function to check letters and numbers
function alphanumeric(inputtxt) {
  var letters = /^[0-9a-z]+$/;
  if (letters.test(inputtxt)) {
    return true;
  } else {

    return false;
  }
}

function Enviar(){	login=Trim(document.administra.login.value)
	password=Trim(document.administra.password.value)
	new_password=Trim(document.administra.new_password.value)
	confirm_password=Trim(document.administra.confirm_password.value)

	if (login=="" || password=="" || new_password=="" || confirm_password==""){
		alert("<?php echo $msgstr["datosidentificacion"]?>")
		return
	}else{		if (new_password != confirm_password){			alert("<?php echo $msgstr["passconfirm"]?>")
			return		}
		txt=login+password+new_password+confirm_password
		if (alphanumeric(txt)){			document.administra.submit()		}else{			alert("<?php echo $msgstr["valchars"]?>")		}
	}}
</script>
</head>
<body>
	<div class="heading">
		<div class="institutionalInfo">
			<h1><img src=../images/logoabcd.jpg >
			<?php echo $institution_name?></h1>
		</div>
		<div class="userInfo"></div>
		<div class="spacer">&#160;</div>
	</div>
	<div class="sectionInfo">
		<div class="breadcrumb"></div>
		<div class="actions"></div>
		<div class="spacer">&#160;</div>
	</div>
<form name=administra action=../common/inicio.php method=post onsubmit="Javascript:Enviar();return false">
<input type=hidden name=Opcion value=chgpsw>
<input type=hidden name=lang value="<?php echo $arrHttp["lang"]?>">
<input type=hidden name=db_path value="<?php if (isset($arrHttp["db_path"])) echo $arrHttp["db_path"]?>">
	<div class="middle login">
		<div class="loginForm">
			<div class="boxTop">
				<div class="btLeft">&#160;</div>
				<div class="btRight">&#160;</div>
			</div>
		<div class="boxContent">
			<div class="formRow">
				<label for="user"><?php echo $msgstr["userid"]?></label>
				<input type="text" name="login" id="user" value="" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';" onblur="this.className = 'textEntry superTextEntry';" onkeyup="capLock(event);"/>
			</div>
			<div class="formRow">
				<label for="pwd"><?php echo $msgstr["actualpass"]?></label>
				<input type="password" name="password" id="pwd" value="" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';" onblur="this.className = 'textEntry superTextEntry';" />
			</div>
			<div class="formRow">
				<label for="pwd"><?php echo $msgstr["newpass"]?></label>
				<input type="password" name="new_password" id="pwd" value="" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';" onblur="this.className = 'textEntry superTextEntry';" />
			</div>
			<div class="formRow">
				<label for="pwd"><?php echo $msgstr["confirmpass"]?></label>
				<input type="password" name="confirm_password" id="pwd" value="" class="textEntry superTextEntry" onfocus="this.className = 'textEntry superTextEntry textEntryFocus';" onblur="this.className = 'textEntry superTextEntry';" />
			</div>
			<div class="submitRow">
				<xdiv class="frRightColumn">
					<a href="javascript:Enviar()" class="defaultButton goButton">
					<img src="../images/icon/defaultButton_next.png" alt="" title="" />
						<span><?php echo $msgstr["chgpass"]?></span>
					</a>
				</xdiv>
				<xdiv class="spacer">&#160;</xdiv>
			</div>
			<div class="spacer">&#160;</div>
		</div>
		<div class="boxBottom">
			<div class="bbLeft">&#160;</div>
			<div class="bbRight">&#160;</div>
	</div>
</div>
</div>
</form>

<?php include ("../common/footer.php");?>
	</body>
</html>



