<?php
$sql = "SELECT * FROM agente_embargo WHERE dni = '$du' ORDER BY id ASC ";
$rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="ficha">
<tr>
  <td colspan="6" align="center" bgcolor="#E6E6E6">EMBARGOS VIGENTES</td>
</tr>
<tr>
  <td>ID</td>
  <td>DESCRIPCION</td>
  <td>TIPO</td>
  <td>DEUDA</td>
  <td>RESTO</td>
  <td>ESTADO</td>
</tr>
<?php
if(mysqli_num_rows($rs) > 0) {
  while($embvig = mysqli_fetch_assoc($rs)){
    $id = $embvig['id'];
?>
    <tr>
      <td>
          <?php echo $embvig['id'];?>
      </td>
      <td><?php echo $embvig['descripcion'];?></td>
      <td>
        <?php
          if($embvig['tipo'] == 0){
            echo "EJECUTIVO";
          } else if($embvig['tipo'] == 1){
            echo "ALIMENTARIO";
          }
        ?>
      </td>
      <td>
        <?php
          if($embvig['tipo'] == 0){
            echo $embvig['monto'];
          } else if($embvig['tipo'] == 1){
            echo "------";
          }
        ?>
      </td>
      <td>
        <?php
          if($embvig['tipo'] == 0){
            $sql = "SELECT monto FROM agente_descuento_embargo WHERE id_embargo = '$id'";
            $resu = consultaSql($sql);
            $suma = 0;
            while($abonado = mysqli_fetch_assoc($resu)){
              $suma = $suma + $abonado['monto'];
            }
            $suma = $embvig['monto'] - $suma;
            echo $suma;
          } else if($embvig['tipo'] == 1){
            echo "------";
          }
        ?>
      </td>
      <td>
        FINALIZADO
      </td>
    </tr>
<?php
  }
} else {
?>
<tr>
  <td colspan="6" align="center"> NO REGISTRA.</td>
</tr>
<?php
}
?>
</table>