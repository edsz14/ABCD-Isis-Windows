  <html>
      <head>
      	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">			
      	<title>Test ODDS</title>      
	  	<script type="text/javascript" src="js/odds.js"></script>	    
    </head>	
	<body> 
		<h1> Test! </h1>
		<a target="_blank" href='form_odds.php'>Form! sin popup</a>
		<hr/>
    <a target="_blank" href='form_odds.php?lang=es&id=12987&name=Juan&category=est&email=juan@gmail.com&phone=12898-98 (29)&level=al&tag010=valor_tag10&tag012=valor_tag12&tag086=valor_tag86&referer=iah'>Form! sin popup con parámetros</a>
    <hr/>
		<a href="JavaScript:newPopup('form_odds.php?resize=yes', 1273, 655);">Form! con popup</a><a>
		<hr/>
        <?php
            //phpinfo();
            //$name = utf8_encode("Juan Pérez");
            $name ="Juan Pérez";
            //echo "<a href=\"JavaScript:newPopup('form_odds.php?lang=es&id=12987&name=$name&category=est&email=juan@gmail.com&phone=12898-98 (29)&level=al&tag010=valor_tag10&tag012=valor_tag12', 1300, 655);\">Form! con popup y datos por GET</a><a>";
            echo "<a href=\"JavaScript:newPopup('form_odds.php?".urlencode("lang=es&id=12987&name=$name&category=est&email=juan@gmail.com&phone=12898-98 (29)&level=al&tag010=valor_tag10&tag012=valor_tag12&resize=yes', 1300, 655)").";\">Form! con popup y datos por GET</a>";
        ?>
		  <hr/>
      <form id="verdocumentoSA" name="verdocumentoSA" action="../iah/ver_documento.php" method="post" target="AEUDOC">
          <a class="common_link" href="javascript:onClick=VerDocumentoSA('users', '')">
          Formulario ODDS sin parámetros, con ventana para validación de usuario
          </a>          
          <input type="hidden" id="parametersODDS" name="parametersODDS" value="">
          <input type="hidden" id="sa" name="sa" value="sa">
          <input type="hidden" id="base" name="base" value="users">
      </form>

	</body>
</html>
