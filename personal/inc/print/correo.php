<?php
$sql = "SELECT * FROM agente_correo WHERE dni = '$du' ORDER BY id ASC";
$rs = consultaSql($sql);
?>

<table border="1" align="center" cellpadding="0" cellspacing="0" class='ficha'>
  <tr>
    <td colspan="6" align="center" bgcolor="#E6E6E6">HISTORIAL CORREO</td>
  </tr>
  <tr bgcolor="#F2F2F2">
  	<td>TIPO</td>
    <td>NUMERO</td>
    <td>FACTURA</td>
    <td>DETALLE</td>
    <td>FECHA</td>
    <td>MOVIMIENTO</td>
  </tr>
  <?php
while($correo = mysqli_fetch_assoc($rs)){
?>
  <tr>
    <td><?php echo $correo['tipo']; ?></td>
    <td><?php echo $correo['numero']; ?></td>
    <td><?php echo $correo['factura']; ?></td>
    <td><?php echo $correo['detalle']; ?></td>
    <td><?php echo cambioDate($correo['fecha']); ?></td>
    <td><?php echo $correo['entsal']; ?></td>
  </tr>
 <?php
 }
 ?>
</table>