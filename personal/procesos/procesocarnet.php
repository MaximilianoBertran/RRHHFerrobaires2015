<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>FerroBaires RH</title>
</head>
<?php
session_start(); 
@ require '../../inc/functions.php';
@ require '../../inc/const.php';
	$tipocarnet = $_POST['tipocarnet'];
	switch ($tipocarnet){
		case 'emp':
			@ require '../certificados/carnet.php';
			break;
		case 'fam':
			@ require '../certificados/carnetflia.php';
			break;
		case 'est':
			@ require '../certificados/carnetestudiante.php';
			break;
		case 'gre':
			@ require '../certificados/carnetgremio.php';
			break;
	}
?>
</html>