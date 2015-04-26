<?php

global $Permiso, $arrHttp,$valortag,$nombre,$userid,$db,$vectorAbrev;
$arrHttp=Array();
session_start();
require_once ("config.php");
require_once('nusoap/nusoap.php');
$converter_path=$cisis_path."mx";

$page="";
if (isset($_REQUEST['GET']))
	$page = $_REQUEST['GET'];
else
	if (isset($_REQUEST['POST'])) $page = $_REQUEST['POST'];

if (!(eregi("^[a-z_./]*$", $page) && !eregi("\\.\\.", $page))) {
	// Abort the script
	die("Invalid request");

}
$valortag = Array();


function LeerRegistro() {

// la variable $llave permite retornar alguna marca que esté en el formato de salida
// identificada entre $$LLAVE= .....$$

$llave_pft="";
$myllave ="";
global $llamada,$valortag,$maxmfn,$arrHttp,$OS,$Bases,$xWxis,$Wxis,$Mfn,$db_path,$wxisUrl,$empwebservicequerylocation,$empwebserviceusersdb,$db,$EmpWeb,$MD5,$converter_path,$vectorAbrev;
if ($EmpWeb=="Y")
{
//USING the Emweb Module to login to MySite module
      $proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
      $proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
      $proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
      $proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';
      $useCURL = isset($_POST['usecurl']) ? $_POST['usecurl'] : '0';
      $client = new nusoap_client($empwebservicequerylocation, false,
      						$proxyhost, $proxyport, $proxyusername, $proxypassword);

      $err = $client->getError();
      if ($err) {
      	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
      	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';
      	exit();
      }


      $params = array('queryParam'=>array("query"=> array('login'=>$arrHttp["login"])), 'database' =>$empwebserviceusersdb);
      $result = $client->call('searchUsers', $params, 'http://kalio.net/empweb/engine/query/v1' , '');

      //print_r($result);
      //die;

      //Esto se ha complejizado con el asunto de la incorporación de mas de una base de datos

      if (is_array($result['queryResult']['databaseResult']['result']['userCollection']))
      {
        $vectoruno = $result['queryResult']['databaseResult']['result']['userCollection'];

        if (is_array($vectoruno['user']))
        {
          //Hay una sola base y ahí está el usuario
          $myuser = $vectoruno['user'];
          $db = $empwebserviceusersdb;
        }
        else if (is_array($vectoruno[0]))
        {
          // hay un vector de dbnames, hay que encontrar en cual de ellos está el user, si está en mas de uno
          // joderse, se toma el primero
          foreach ($vectoruno as $elementos)
          {
            if (is_array($elementos['user']))
            {
              $myuser = $elementos['user'];
              $db = $elementos['!dbname'];
            }
          }

        }

        // Con el myuser recuperado me fijo si es que el passwd coincide

        if (($myuser['password']==$arrHttp["password"]) &&  (strlen($arrHttp["password"])>3))
        {
              $vectorAbrev=$myuser;
              //print_r($vectorAbrev);
              //die;
              $myllave = $vectorAbrev['id']."|";
              $myllave .= "1|";
              $myllave .= $vectorAbrev['name']."|";
              $valortag[40] = "\n";
        }


      }
}//if ($EmpWeb=="Y")
else
{
//USING the Central Module to login to MySite module
//Get the user and pass
$checkuser=$arrHttp["login"];
if ($MD5==0) $checkpass=$arrHttp["password"];
else
$checkpass=md5($arrHttp["password"]);
//Search the users database
$mx=$converter_path." ".$db_path."users/data/users \"pft=if v600='".$checkuser."' then if v610='".$checkpass."' then v20,'|',v30,'|',v10,'|',v10^a,'|',v10^b,'|',v18 fi,fi\" now";
$outmx=array();
exec($mx,$outmx,$banderamx);
$textoutmx="";
for ($i = 0; $i < count($outmx); $i++) {
$textoutmx.=substr($outmx[$i], 0);
}
if ($textoutmx!="")
{
$splittxt=explode("|",$textoutmx);
$myuser = $checkuser;
$db = "users";
$myllave = $splittxt[0]."|";
$myllave .= "1|";
$myllave .= $splittxt[1]."|";
$valortag[40] = $splittxt[2]."\n";
$vectorAbrev['id']=$splittxt[0];
$vectorAbrev['name']=$splittxt[1];
$vectorAbrev['userClass']=$splittxt[4]."(".$splittxt[3].")";
$vectorAbrev['expirationDate']=$splittxt[5];
$currentdatem=date("Ymd");
if ($currentdatem>$splittxt[5]) $myllave="";


}
}
	  return $myllave;

}

function VerificarUsuario(){
Global $arrHttp,$valortag,$Path,$xWxis,$session_id,$Permiso,$msgstr,$db_path,$nombre,$userid,$lang;
 	$llave=LeerRegistro();	
 	if ($llave!=""){
  		$res=split("\|",$llave);
  		$userid=$res[0];
  		$_SESSION["mfn_admin"]=$res[1];
  		$mfn=$res[1];
  		$nombre=$res[2];
		$arrHttp["Mfn"]=$mfn;
  		$Permiso="|";
  		$P=explode("\n",$valortag[40]);
  		foreach ($P as $value){
  			$value=substr($value,2);
  			$ix=strpos($value,'^');
    		$Permiso.=substr($value,0,$ix)."|";
    	}		
 	}else{
 		echo "<script>
 		self.location.href=\"../indexmysite.php?login=N&lang=".$lang."\";
 		</script>";
  		die;
 	}
}

/////
/////   INICIO DEL PROGRAMA
/////


$query="";
include("common/get_post.php");

//foreach ($arrHttp as $var => $value) echo "$var = $value<br>";die;


if (isset($arrHttp["lang"])){
	$_SESSION["lang"]=$arrHttp["lang"];
	$lang=$arrHttp["lang"];
}else{
	if (!isset($_SESSION["lang"]))
    $_SESSION["lang"]=$lang;
}

require_once ("lang/mysite.php");
require_once("lang/lang.php");



if (isset($arrHttp["action"]))
{
    if ($arrHttp["action"]!='clear')
    {
      $_SESSION["action"]=$arrHttp["action"];
      $_SESSION["recordId"]=$arrHttp["recordId"];
    }
    else
    {
      $_SESSION["action"]="";
      $_SESSION["recordId"]="";
    }
	if ($arrHttp["action"]=='gotosite')
    {
	$arrHttp["login"]=$_SESSION["login"];
    $arrHttp["password"]=$_SESSION["password"];
	}
}





//if (!$_SESSION["userid"] || !$_SESSION["permiso"]=="mysite".$_SESSION["userid"]) {

      	if (isset($arrHttp["reinicio"])){
      		$arrHttp["login"]=$_SESSION["login"];
      		$arrHttp["password"]=$_SESSION["password"];
      		$arrHttp["startas"]=$_SESSION["permiso"];
      		$arrHttp["lang"]=$_SESSION["lang"];
            $arrHttp["db"]=$_SESSION["db"];

      	}	
			
      	VerificarUsuario();

      	$_SESSION["lang"]=$arrHttp["lang"];
		if ($arrHttp["id"]!="") 
		{
		$_SESSION["action"]='reserve';
		$_SESSION["recordId"]=$arrHttp["id"];
		$_SESSION["cdb"]=$arrHttp["cdb"];
		}
        $_SESSION["userid"]=$userid;
      	$_SESSION["login"]=$arrHttp["login"];
      	$_SESSION["password"]=$arrHttp["password"];
      	$_SESSION["permiso"]="mysite".$userid;
      	$_SESSION["nombre"]=$nombre;
        $_SESSION["db"]=$db;

//}


//print_r ($msgstr);
include("homepagemysite.php");

?>