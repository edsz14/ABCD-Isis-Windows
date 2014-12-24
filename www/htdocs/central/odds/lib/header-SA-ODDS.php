<body bgcolor="#E0EBEB" text="black" link="blue" vlink="blue">
<center>
	<table border="0" cellpadding="0" cellspacing="0" >
	<tr><td valign="top">				
			<!-- <img src="/iah/es/image/banner-ODDS.jpg" border="0"> -->
			<strong>SOLICITUD DE DOCUMENTACION ONLINE</strong>
		</td>
	</tr>
	</table>
</center>
<?php 
if ($use_sa) {
	echo '<font face=verdana size=2 color="maroon"><br>Solicitud de env&iacute;o de documentos </b><p>';
} else if ($use_odds) {
	echo '<font face=verdana size=2 color="maroon"><br>Solicitud de documento </b><p>';
} else {
	echo '<font face=verdana size=2 color="maroon"><br>Solicitud para ver documento</b><p>';
}
?>