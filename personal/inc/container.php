<div id='pestania'>
	<ul>
		<li id='laboral'>LABORAL</li>
		<li id='personal'>PERSONAL</li>
		<li id='medico'>MEDICO</li>
		<li id='licencia'>LICENCIA</li>
		<li id='judicial'>JUDICIAL</li>
		<li id='previsional'>PREVISIONAL</li>
		<li id='imprimir'>IMPRIMIR</li>
	</ul>
</div>
<?php
	$sql = "SELECT agente, dni, planta FROM agente_laboral WHERE dni = '$du'";
	$query = consultaSql($sql);
	$cabecera = mysqli_fetch_assoc($query);
?>
<div align="center" <?php if($cabecera['planta'] == 0) echo 'class="rojo"';?> > <?php echo strtoupper($cabecera['agente']); ?> (<?php echo $cabecera['dni']; ?>)</div>
<div id='contentlaboral'> <?php @ require 'personal/inc/edit/laboral.php';?> </div>
<div id='contentpersonal'> <?php @ require 'personal/inc/edit/personal.php';?> </div>
<div id='contentmedico'> <?php @ require 'personal/inc/edit/medico.php';?> </div>
<div id='contentjudicial'> <?php @ require 'personal/inc/edit/judicial.php';?> </div>
<div id='contentlicencia'> <?php @ require 'personal/inc/edit/licencia.php';?> </div>
<div id='contentprevisional'> <?php @ require 'personal/inc/edit/previsional.php';?> </div>
<div id='contentimprimir'> <?php @ require 'personal/inc/edit/imprimir.php';?> </div>