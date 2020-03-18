<?php
@ require '../../inc/functions.php';
@ require '../../inc/const.php';
@ require_once '../../lib/PHPExcel/IOFactory.php';

if($_FILES['fichero_usuario']['error'] != 4) //el 4 implica que NO sube nada.
{
	$archivo_tipo   = $_FILES['fichero_usuario']['type'];   	// capturo el nombre
	$archivo_tmp 	= $_FILES['fichero_usuario']['tmp_name'];  	// capturo la ruta temporal
}

$objPHPExcel = PHPExcel_IOFactory::load($_FILES['fichero_usuario']['tmp_name']); 

$objPHPExcel->setActiveSheetIndex(0); 

$i=2;

while($objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue() != "") 
{   

    $du = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue(); 
    $du=trim($du); 

    $ips = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue(); 
    $ips=trim($ips); 
    $pos = strpos($ips, '+');

    if ($pos !== false){
    	$ips = str_replace("=","",$ips);
    	$long = strlen($ips);
    	$aux = - $long + $pos;
    	$num1 = substr($ips, 0, $aux);
    	$aux = -($aux - 1);
		$num2 = substr($ips, $aux);
		$ips = $num1 + $num2;
    }

    $bruto = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue(); 
    $bruto=trim($bruto); 
    $pos = strpos($bruto, '+');

    if ($pos !== false){
    	$bruto = str_replace("=","",$bruto);
    	$long = strlen($bruto);
    	$aux = - $long + $pos;
    	$num1 = substr($bruto, 0, $aux);
    	$aux = -($aux - 1);
		$num2 = substr($bruto, $aux);
		$bruto = $num1 + $num2;
    }

    $periodo = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue(); 
    $periodo = trim($periodo); 
    $date = ($periodo - 25569) * 86400;
	$periodo=  gmdate("Y-m-d", $date);

 	$sql = "INSERT INTO form_80 (dni, ips, bruto, periodo) VALUES ('$du', '$ips', '$bruto', '$periodo')"; 
    $rst = consultaSql($sql);  
	$i++; 
} 
if($rst){
    header("Location: ../../personal/index.php?sector=carg&check=29");
} else {
    header("Location: ../../personal/index.php?sector=carg&check=0");
}
?>