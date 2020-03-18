<!DOCTYPE HTML>
<?php
@ require '../../inc/functions.php';
@ require '../../inc/const.php';
session_start();
?>
<html lang="es">
	<head>
		<meta charset="utf-8">
	
		<link rel='stylesheet' type='text/css' href="../../style/base.css" />
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
		<title> Sistema RH 3.0 </title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	</head>
	<body>
		<?php
		extract($_POST);
		@ require 'print/laboral.php';
		if(isset($checkgre)){
			echo "<br />";
			@ require 'print/gremio.php';
		}
		if(isset($checkhlab)){
			echo "<br />";
			@ require 'print/histlaboral.php';
		}
		if(isset($checkcom)){
			echo "<br />";
			@ require 'print/comision.php';
		}
		if(isset($checkirr)){
			echo "<br />";
			@ require 'print/irregularidades.php';
		}
		if(isset($checkcond)){
			echo "<br />";
			@ require 'print/certconduccion.php';
		}
		if(isset($checkcorr)){
			echo "<br />";
			@ require 'print/correo.php';
		}
		if(isset($checkper)){
			echo "<br />";
			@ require 'print/personal.php';
		}
		if(isset($checkcony)){
			echo "<br />";
			@ require 'print/conyuge.php';
		}
		if(isset($checkhijo)){
			echo "<br />";
			@ require 'print/hijos.php';
		}
		if(isset($checkmed)){
			echo "<br />";
			@ require 'print/estadomedico.php';
		}
		if(isset($checktlt)){
			echo "<br />";
			@ require 'print/histtlt.php';
		}
		if(isset($checkenf)){
			echo "<br />";
			@ require 'print/enfermedades.php';
		}
		if(isset($checkart)){
			echo "<br />";
			@ require 'print/art.php';
		}
		if(isset($checklic)){
			echo "<br />";
			@ require 'print/licpendientes.php';
		}
		if(isset($checkhlic)){
			echo "<br />";
			@ require 'print/histlicencias.php';
		}
		if(isset($checkemb)){
			echo "<br />";
			@ require 'print/embargo.php';
		}
		
		?>
	</body> 
</html>