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



$sql = "SELECT * FROM auxiliar_carga_excel ORDER BY id ASC";
$query = consultaSql($sql);

while($aux = mysqli_fetch_assoc($query)){
    $id = $aux['id'];
    $celda[$id] = $aux['celda'];

}
$i=1;
while($objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue() != "") 
{   
    $a = 3;
    $b = 4;
    $c = 5;


    $du = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue(); 
    $du=trim($du); 

    while($objPHPExcel->getActiveSheet()->getCell($celda[$a].$i)->getValue() != ""){
        $ips = $objPHPExcel->getActiveSheet()->getCell($celda[$c].$i)->getValue(); 

        $bruto = $objPHPExcel->getActiveSheet()->getCell($celda[$b].$i)->getValue(); 

        $periodo = $objPHPExcel->getActiveSheet()->getCell($celda[$a].$i)->getValue(); 
        $periodo = trim($periodo); 
        $date = ($periodo - 25569) * 86400;
    	$periodo=  gmdate("Y-m-d", $date);
        $sql = "SELECT id FROM form_80 WHERE periodo = '$periodo' AND dni = '$du'";
        $ctrl = consultaSql($sql);
        if(mysqli_num_rows($ctrl) > 0){

        } else {
     	$sql = "INSERT INTO form_80 (dni, ips, bruto, periodo) VALUES ('$du', '$ips', '$bruto', '$periodo')"; 
        $rst = consultaSql($sql); 
        } 
        $a = $a + 3;
        $b = $b + 3;
        $c = $c + 3;
    }
	$i++; 
} 
if($rst){
    header("Location: ../../personal/index.php?sector=carg&check=30");
} else {
    header("Location: ../../personal/index.php?sector=carg&check=0");
}
?>