<?php
@ require '../../inc/functions.php';
@ require '../../inc/const.php';

 if(isset($_POST["id_dpto"]))
 {

 	$id_dpto = $_POST["id_dpto"];
 	$id_sector = $_POST["sector"];
    $strConsulta = "SELECT * FROM sectores WHERE id_dpto = '$id_dpto'";
    $result = consultaSql($strConsulta);
    while( $fila = mysqli_fetch_assoc($result) )
    {
    	$aux='';
    	if($fila['id'] == $id_sector){
		   	$aux=" selected";
		}
       $opciones.='<option value="'.$fila["id"].$aux.'">'.$fila["sector"].'</option>';
    }
     echo $opciones;
 }
?>