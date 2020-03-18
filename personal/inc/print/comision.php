<?php
  $sql = "SELECT * FROM agente_comision WHERE dni = '$du' ORDER BY desde ASC ";
  $rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="ficha">
  <tr>
    <td colspan="4" align="center"  bgcolor="#E6E6E6" >PASES EN COMISION</td>
  </tr>
  <tr bgcolor="#F2F2F2">
    <td align="center" ><strong>DESCRIPCION</strong></td>
    <td align="center" ><strong>DESDE</strong></td>
    <td align="center" ><strong>HASTA</strong></td>
    <td align="center" ><strong>ESTADO</strong></td>
    </tr>
  <?php
    if(mysqli_num_rows($rs) > 0){
      while($dato = mysqli_fetch_assoc($rs)){
  ?>
        <tr>
          <td>
            <?php echo $dato['descripcion']; ?>
          </td>
          <td align="center" >
            <?php 
              if($dato['desde'] == '0000-00-00') {
                echo "NO REGISTRA";
              } else {
                echo cambioDate($dato['desde']); 
              }
            ?>
          </td>
          <td align="center" >
            <?php 
              if($dato['hasta'] == '0000-00-00') {
                echo "NO REGISTRA";
              } else {
                echo cambioDate($dato['hasta']); 
            }?>
          </td>
          <td align="center" >
            <?php
              if($dato['estado'] == 1){  
                echo "VIGENTE"; 
              } else {
                echo "CERRADO";
              }
            ?>
          </td>
        </tr>
  <?php
      }
    } else {
      echo '<tr><td colspan="4" align="center">NO REGISTRA</td></tr>';
    }
  ?>
</table>
  