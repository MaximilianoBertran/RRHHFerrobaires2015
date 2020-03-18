<?php
$sql = "SELECT * FROM agente_medico WHERE dni = '$du' AND tipo = 1 ORDER BY desde ASC ";
$rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="ficha">
  <tr>
    <td colspan="4" align="center" bgcolor="#E6E6E6">HISTORIAL ART</td>
  </tr>
  <tr bgcolor="#F2F2F2">
    <td align="center" >DESDE</td>
    <td align="center" >HASTA</td>
    <td align="center" >DIAS</td>
    <td align="center" >ESTADO</td>
  </tr>
  <?php
  if(mysqli_num_rows($rs) > 0){
    while($dato = mysqli_fetch_assoc($rs)){   
  ?>
<tr>
    <td align="center" ><?php echo cambioDate($dato['desde']); ?></td>
    <td align="center" ><?php echo cambioDate($dato['hasta']); ?></td>
    <td align="center" ><?php echo dias_transcurridos($dato['desde'],$dato['hasta']); ?></td>
    <td align="center" >
      <?php 
        if($dato['alta'] == 1){
          echo "CERRADO";
        } else {
          echo "VIGENTE";
        }
      ?>
    </td>
  </tr>
    <tr>
    <td colspan="4" align="left">OBSERVACIONES: <?php echo $dato['observaciones']; ?></td>
  </tr>
  <?php 
    }
  } else {
    echo '<tr><td colspan="4" align="center">NO REGISTRA</td></tr>';
  }  
  ?>
</table>