<?php

/* como manejar LOCKS!?
		if (isset($arrHttp["lock"]) and $arrHttp["lock"]=="S"){
			$query.="&lock=S";

		}
		*/
		include("../config.php");
		$IsisScript=$xWxis."actualizar.xis";
        $ValorCapturado=urlencode("<630>ernesto</630>");
		$query = "&base=odds&cipar=/kunden/homepages/9/d502990860/htdocs/ABCD/bases/demo_nocopies/par/odds.par&Mfn=New&Opcion=crear&ValorCapturado=$ValorCapturado";
		putenv('REQUEST_METHOD=GET');
		putenv('QUERY_STRING='."?xx=".$query);
		$contenido="";
		exec("\"".$Wxis."\" IsisScript=$IsisScript",$contenido);

//solo test
		var_dump($contenido);
		die();




?>

