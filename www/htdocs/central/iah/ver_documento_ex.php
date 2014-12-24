<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <title>Solicitud de documento</title>
  <script>
  	  function PresentarDocumento(){
  	  	msgwin=window.open("","PDFDOC","width=800,height=800,scrollbars,resizable")
  	  	msgwin.document.title="Pdf"
  	  	document.solicitud.submit()

  	  	msgwin.focus()
  	  	self.close()
  	  }
  </script>
</head>
<?php include('header.php');?>

<?php


	/* lee los datos del usuario (si es que existe) */
	function LeerUsuario($usuario, $db_path){	
		global $xWxis,$wxisUrl,$Wxis;	
		$contenido="";
		$db_path ="/kunden/homepages/9/d502990860/htdocs/".$db_path;
		$IsisScript=$xWxis."buscar.xis";	

		// v35 = code, v30 = nombre, v160 = email, v18 =  fecha iso validez, v140 = telefono, v10 = tipo de  usuario categoria
		//$formato="v35,'|',v30,'|',v160,'|',v18,'|',v140,'|',v10";		
		$formato="v20";
		$formato=urlencode($formato);
		
		$prefix="CO_";
		$par_path =  "/kunden/homepages/9/d502990860/htdocs/ABCD/bases/demo_nocopies/par/";
		$query = "&Expresion=".$prefix.trim($usuario)."&base=users&cipar=".$par_path."users.par&Pft=$formato";	
		var_dump($query);
		
		$IsisScript=$xWxis."cipres_usuario.xis";	
		include("../common/wxis_llamar.php");	
		return ($contenido);
	}


/* --------------------- MAIN  ----- */
include ("configure.php");
$error="";

//$resultado=LeerUsuario($arrHttp["usuario"],$config["USER_SEARCH"],$config["USER_DISPLAY"],$config["DB_PATH"]);
$resultado = LeerUsuario($arrHttp["usuario"], $config["DB_PATH"]);

var_dump($resultado);
echo "<hr>";

// el usuario no está en la BD
if (count($resultado)==0 or trim($resultado[0])==""){
	$error="S";
	echo "<font color=darkred><P>".$arrHttp["usuario"].": "."No está registrado como socio de la Biblioteca";
	echo "<p><a href=javascript:history.back()>Regresar</a>";
	die;
}

/* processing results */
$parse = explode('|', $resultado[0]);
$count = 1;

// procesamiento de parametros de usuario para invocar a ODDS 
// v20 = code, v30 = nombre, v160 = email, v18 =  fecha iso validez, v140 = telefono, v10 = tipo de usuario

$parametersFormODDS = "";
foreach ($parse as $value) {
	$value = trim($value);	

	if ($value != '') {
		if ($count == 1) {
			$parametersODDS .= "&id=".$value;
		} else if ($count == 2) {
			$parametersODDS .= "&name=".$value;
		} else if ($count == 3) {
			$parametersODDS .= "&email=".$value;
		} else if ($count == 4) {
			$fecha_validez = $value;
			// no se para como parámetro al ODDS, se valida antes, o sea, se valida a continuacion
			//$parametersODDS .= "&email_apoderado=".$value;
		} else if ($count == 5) {
			$parametersODDS .= "&phone=".$value;
		} else if ($count == 6) {
			$parametersODDS .= "&category=".$value;	
		}
	}
	$count++;
}

// datos a solicitar
//echo ":: parametersFormODDS<hr>";
//var_dump($parametersODDS);


// test 
/*
$fecha_actual = date("Ymd");
if ($fecha_actual> $fecha_validez) {
	echo "Usuario <strong>no autorizado</strong> a recibir este servicio, consulte en Biblioteca.";
	echo '<br><br>';
	echo '<a href="javascript:onClick=self.close()"><img src="/iah/es/image/salir.gif" border="0"></a>';
	die;
}
*/

echo '<script type="text/javascript" src="../odds/js/odds.js"></script>';
echo "<a id='redirect_link' href=\"JavaScript:newPopup('../odds/form_odds.php?lang=es&".$parametersODDS."',1250, 645)\">Solicitud de copia</a>";

echo '<script type="text/javascript">';
echo "document.getElementById('redirect_link').click();";
//echo "self.close();";
echo '</script>';

?>
</body>
</html>

