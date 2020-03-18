<?php
$sql = "SELECT * FROM agente_irregularidades WHERE dni = '$du' ORDER BY fecha ASC";
$rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class='ficha'>
  <tr>
    <td colspan="6" align="center" bgcolor="#E6E6E6">INFRACCIONES Y CASTIGOS</td>
  </tr>
  <tr bgcolor="#F2F2F2">
    <td>FECHA</td>
    <td>IRREGULARIDAD</td>
    <td>ENCUADRE</td>
    <td>I/SANCION</td>
    <td>F/SANCION</td>
    <td>DIAS</td>
  </tr>
<?php
if(mysqli_num_rows($rs) > 0){
	while($irregularidad = mysqli_fetch_assoc($rs)){
	?>
	  <tr>
	    <td><?php echo cambioDate($irregularidad['fecha']); ?></td>
	    <td><?php echo $irregularidad['irregularidad']; ?></td>
	    <td><?php echo "Articulo N° ".$irregularidad['encuadre']; ?></td>
	    <td><?php
	    if($irregularidad['desde'] == "0000-00-00"){
	    	echo "Apercibido";
	  	} else {
	    	echo cambioDate($irregularidad['desde']); 
	  	}
	    ?></td>
	    <td><?php
	    if($irregularidad['hasta'] == "0000-00-00"){
	    	echo "Apercibido";
		} else {
		  echo cambioDate($irregularidad['hasta']); 
		}
	    ?></td>
	    <td><?php echo dias_transcurridos($irregularidad['desde'],$irregularidad['hasta']); ?> </td>
	  </tr>
	 <?php
	 }
 } else {
 ?>
  <tr>
    <td colspan="6" align="center">NO REGISTRA</td>
  </tr>
 <?php
 }
 ?>
</table>