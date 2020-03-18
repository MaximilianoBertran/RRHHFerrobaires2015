<?php
$sql = "SELECT * FROM agente_historial_licencia WHERE dni = '$du' ORDER BY desde ASC";
$rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="ficha">
  <tr>
    <td colspan="4" align="center" bgcolor="#E6E6E6" >HISTORIAL LICENCIAS</td>
  </tr>
  <tr bgcolor="#F2F2F2">
    <td align="center">DESDE</td>
    <td align="center">HASTA</td>
    <td align="center">TIPO</td>
    <td align="center">AÑO</td>
  </tr>
<?php
while($historial = mysqli_fetch_assoc($rs)){
?>
  <tr>
    <td align="center"><?php echo cambioDate($historial['desde']); ?></td>
    <td align="center"><?php 
    if($historial['hasta'] == '0000-00-00'){
      echo "Indeterminado";
    } else {
      echo cambioDate($historial['hasta']); 
    }
    ?></td>
    <td><?php 
  switch ($historial['tipo']){
    case 0:
      echo "LICENCIA ANUAL";
      break;
    case 1:
      echo "LICENCIA POR TRASLADO";
      break;
    case 2:
      echo "LICENCIA POR MATRIMONIO";
      break;
    case 3:
      echo "LICENCIA POR DUELO";
      break;
    case 4:
      echo "LICENCIA POR PATERNIDAD";
      break;
    case 5:
      echo "LICENCIA POR DONACION DE SANGRE";
      break;
    case 6:
      echo "REALIZACION SERVICIO MILITAR";
      break;
    case 7:
      echo "REGRESO SERVICIO MILITAR";
      break;
    case 8:
      echo "LICENCIA POR ESTUDIO";
      break;
    case 9:
      echo "LICENCIA POR MATERNIDAD";
      break;
    case 10:
      echo "LICENCIA GREMIAL";
      break;
    case 11:
      echo "LICENCIA SIN SUELDO";
      break;
    case 12:
      echo "SUSPENDIDO";
      break;
    case 13:
      echo "LICENCIA ESPECIAL LEY 24716";
      break;
    case 14:
      echo "DIA DEL FERROVIARIO";
      break;
    case 15:
      echo "LICENCIA POR MUDANZA";
      break;
    case 16:
      echo "EXCEDENCIA LICENCIA POR MATERNIDAD S/SUELDO";
      break;
    case 17:
      echo "FERIADOS NACIONALES TRABAJADOS";
      break;
  }
  ?></td>
    <td align="center"><?php echo $historial['year']; ?></td>
  </tr>
 <?php
 }
 ?>
</table>