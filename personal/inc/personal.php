<?php
if(date('Y-m-d') < VENCIMIENTO){
if(isset($_GET['du']) || isset($_POST['buscar'])){
	if(isset($_GET['du'])) {
		$du = verificarSqlInyect(base64_decode($_GET['du']));
	}
	if(isset($_POST['buscar'])) {
		$du = substr(verificarSqlInyect($_POST['buscar']), -8);
	}
	@ require 'personal/inc/container.php';
} else {
?>
<br />
<br />
<form name="search" method="post" action="">
<div id='search'>
Ingrese DNI o Nombre <span class='buscar'><input  name="buscar" type="text" id="buscar" size="40" maxlength="70"></span> <input name="Consulta" type="submit" id="Consulta" value="Consulta">
</div>
</form>
<br /><br /><br /><br /><br /><div class="volver"><a href="index.php"><p><-- Salir</p></a></div>
<?php
}
}
?>
