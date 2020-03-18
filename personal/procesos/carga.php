<?php
@ require '../../inc/functions.php';
@ require '../../inc/const.php';
$link = @ mysqli_connect(SERVER, USER, PASSWORD, BASE);
$du = verificarSqlInyect($_POST['du']);
$sql = 'SELECT legajo FROM agente_laboral WHERE efect = "0000-00-00" ORDER BY legajo DESC LIMIT 1';
$rs = consultaSql($sql);
$legajo = mysqli_fetch_assoc($rs);
$leg = $legajo['legajo'] + 1;
$sql = "INSERT INTO `agente_laboral` (`dni`, `legajo`) VALUES ('$du', '$leg')";
$claboral=mysqli_query($link, $sql);
$sql = "INSERT INTO `agente_personal` (`dni`) VALUES ('$du')";
$cpersonal=mysqli_query($link, $sql);
$sql = "INSERT INTO `agente_estado_medico` (`dni`) VALUES ('$du')";
$emedico=mysqli_query($link, $sql);
$sql = "INSERT INTO `agente_previsional` (`dni`) VALUES ('$du')";
$emedico=mysqli_query($link, $sql);
mysqli_close($link);
if($claboral && $cpersonal && $emedico){
	header("Location: ../personal/index.php?sector=carg&check=28");
} else {
	header("Location: ../personal/index.php?sector=carg&check=0");
}

?>