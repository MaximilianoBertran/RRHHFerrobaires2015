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
		$sql = "SELECT * FROM temporal";
		$temporal = consultaSql($sql);
		while($agenteporal = mysqli_fetch_assoc($temporal)){
			$du = $agenteporal['dni'];
			@ require 'print/laboral.php';
			@ require 'print/gremio.php';
			@ require 'print/histlaboral.php';
			@ require 'print/comision.php';
			@ require 'print/irregularidades.php';
			@ require 'print/certconduccion.php';
			@ require 'print/correo.php';
			@ require 'print/personal.php';
			@ require 'print/conyuge.php';
			@ require 'print/hijos.php';
			@ require 'print/estadomedico.php';
			@ require 'print/histtlt.php';
			@ require 'print/enfermedades.php';
			@ require 'print/art.php';
			@ require 'print/licpendientes.php';
			@ require 'print/histlicencias.php';
			@ require 'print/embargo.php';
			echo '<div class="page">
      		<h1> </h1>
    		</div>';
		}
		?>
	</body> 
</html>