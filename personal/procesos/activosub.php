<?php
@ require '../../inc/functions.php';
@ require '../../inc/const.php';
if(date('Y-m-d') < VENCIMIENTO){
 if(isset($_POST["id_subg"]))
 {

 	$id_subg = $_POST["id_subg"];
 	$id_dpto = $_POST["id_dpto"];
    $strConsulta = "SELECT * FROM coordinacion WHERE id_subg = '$id_subg'";
    $result = consultaSql($strConsulta);
    while( $fila = mysqli_fetch_assoc($result) )
    {
    	$aux='';
    	if($fila['id'] == $id_dpto){
		   	$aux=" selected";
		}
       $opciones.='<option value="'.$fila["id"].$aux.'">'.$fila["departamento"].'</option>';
    }
     echo $opciones;
 }
}
?>