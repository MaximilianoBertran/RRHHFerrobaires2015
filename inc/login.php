<?php
@ require 'functions.php';
@ require 'const.php';
echo 'ok';
if(date('Y-m-d') < VENCIMIENTO){
	echo 'ok';
	ob_start();
	session_start();
	$username = verificarSqlInyect($_POST['username']);
	$password = md5(verificarSqlInyect($_POST['password']));
	$sql = "SELECT id, dni, personal, sueldos, sanidad, archivo FROM account WHERE username = '$username' AND password = '$password'";
	$rs = consultaSql($sql);
	if(mysqli_num_rows($rs) > 0){
		echo 'ok';
		$aux = mysqli_fetch_assoc($rs);
		$_SESSION['dni'] = $aux['dni'];
		$_SESSION['id'] = $aux['id'];
		$_SESSION['username'] = $username;
		$_SESSION['personal'] = $aux['personal'];
		$_SESSION['archivo'] = $aux['archivo'];
		$_SESSION['sueldos'] = $aux['sueldos'];
		$_SESSION['sanidad'] = $aux['sanidad'];
		header("Location: ../index.php");
	} else {
		header("Location: ../index.php?stat=0");
	}
}
?>