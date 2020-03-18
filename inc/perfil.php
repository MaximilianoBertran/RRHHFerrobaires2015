<br />
<div> 
<?php 
if (isset($_GET['check'])) {
	if($_GET['check'] == 1){
		echo "CONTRASEÑA ACTUALIZADA.";
	} else if($_GET['check'] == 2){
		echo "LA NUEVA CONTRASEÑA Y LA CONFIRMACION DEBEN SER IGUALES.";
	} else {
		echo "ERROR DE COMUNICACION, INTENTELO NUEVAMENTE MAS TARDE.";
	}
}
?>
</div>

<div>
	<form name="login" method="post" action="procesos/script.php">
		<p>Cambiar Contraseña</p><input type="hidden" name="edit" id="edit" value="pass" />
		<input name="password" type="password" id="password" size="15" maxlength="15" placeholder="Contraseña actual"/><br />
		<input name="password1" type="password" id="password1" size="15" maxlength="15" placeholder="Nueva contraseña"/><br />
		<input name="password2" type="password" id="password2" size="15" maxlength="15" placeholder="Confirmar contraseña"/><br />
		<input type="submit" name="log" id="log" value="Cambiar" />
	</form>
</div>
<br />
<br /><a href="index.php"><div class="volver"><p><-- Volver</p></div></a>