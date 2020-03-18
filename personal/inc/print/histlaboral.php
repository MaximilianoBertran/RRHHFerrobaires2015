<?php
$sql = "SELECT * FROM agente_historial WHERE dni = '$du' ORDER BY finicio ASC";
$rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class='ficha'>
  <tr>
    <td colspan="6" align="center" bgcolor="#E6E6E6">HISTORIAL LABORAL</td>
  </tr>
  <tr bgcolor="#F2F2F2">
    <td>INICIO</td>
    <td>ESCALA</td>
    <td>CATEGORIA</td>
    <td>PUESTO</td>
    <td>TERMINO</td>
    <td>SEC-CTRL</td>
  </tr>
<?php
if(mysqli_num_rows($rs) > 0){
  while($historial = mysqli_fetch_assoc($rs)){
?>
  <tr>
    <td><?php echo cambioDate($historial['finicio']); ?></td>
    <td><?php echo $historial['esc']; ?></td>
    <td><?php echo $historial['cat']; ?></td>
    <td><?php 
    $cat = $historial['cat'];
    $esc = $historial['esc'];
    $sql = "SELECT * FROM nomenclador WHERE esc = '$esc' AND cat = '$cat'";
    $tarea = mysqli_fetch_assoc(consultaSql($sql));
    echo $tarea['desc'];
  ?></td>
    <td><?php
    if($historial['ffin'] == "0000-00-00"){
    echo "CONTINUA";
  } else {
    echo cambioDate($historial['ffin']); 
  }
    ?></td>
    <td><?php echo $historial['sectrl']; ?></td>
  </tr>
 <?php
  }
 } else {
 ?>
  <tr>
    <td colspan="6">NO REGISTRA.</td>
  </tr>
 <?php
 }
 ?>
</table>