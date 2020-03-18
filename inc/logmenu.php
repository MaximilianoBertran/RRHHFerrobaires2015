<form name="login" method="post" action="inc/login.php">
<div id='logmenu'>
<br /><br /><br /><img src="img/LOGOTA.png"><br /><br /><br />
<span><input name="username" type="text" id="username" size="15" maxlength="15" placeholder="Usuario"/></span><br />
<span><input name="password" type="password" id="password" size="15" maxlength="15" placeholder="Contraseña"/></span><br />
<span><input type="submit" name="log" id="log" value="Acceder" /></span>
</div>
</form>
<?php
	if(isset($_GET['stat']))
	{
?>
<br />
<div id='nolog'>USUARIO Y/O CONTRASEÑA INCORRECTO.</div>
<?php
	}
?>
