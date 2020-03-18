<br />
<?php if($planta > 0){?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="personal">
  <tr>
    <td colspan="3" align="center" bgcolor="#E6E6E6">CARGA DE EMBARGOS</td>
  </tr>
  <tr>
    <td width="300">DESCRIPCION</td>
    <td>TIPO</td>
    <td>DEUDA</td>
  </tr>
  <form method="post" action="personal/procesos/script.php?edit=emb">
    <tr>
      <td><input type="hidden" name="du" id="du" value="<?php echo $du; ?>" /><input name="descripcion" type="text" id="descripcion" size="40" /></td>
      <td>
        <label for="tipo"></label>
        <select name="tipo" id="tipo">
          <option value="0"> EJECUTIVO </option>
          <option value="1"> ALIMENTARIO </option>
          <option value="2"> ALIMENTARIO+ASIGNACIONES </option>
        </select>
      </td>
      <td><input name="monto" type="text" id="monto" size="10" /></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input type="submit" name="button" id="button" value="Cargar Embargo" /></td>
    </tr>
  </form>
</table>

<br />
<?php }?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="personal">
  <tr>
    <td colspan="3" align="center" bgcolor="#E6E6E6">CARGA DE PAGOS</td>
  </tr>
  <tr>
    <td>MONTO</td>
    <td>ID</td>
    <td>MES</td>
  </tr>
  <form method="post" action="personal/procesos/script.php?edit=embpag">
  <input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
    <tr>
      <td><input name="monto" type="text" id="monto" size="20" /></td>
      <td>
        <label for="select"></label>
        <select name="embpag" id="embpag">
        <?php
        $sql = "SELECT id FROM agente_embargo WHERE dni = '$du' AND estado = 1";
        $query = consultaSql($sql);
        while($idemb = mysqli_fetch_assoc($query)){
        echo '<option value="'.$idemb['id'].'">'.$idemb['id'].'</option>';
        }
        ?>
        </select>
      </td>
      <td><input name="mes" type="date" id="mes" size="10" /></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input type="submit" name="button" id="button" value="Cargar Pago" /></td>
    </tr>
  </form>
</table>

<br />

<?php
$sql = "SELECT * FROM agente_embargo WHERE dni = '$du' AND estado = 1 ORDER BY id ASC ";
$rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="personal">
<tr>
  <td colspan="5" align="center" bgcolor="#E6E6E6">EMBARGOS VIGENTES</td>
</tr>
<tr>
  <td>ID</td>
  <td>DESCRIPCION</td>
  <td>TIPO</td>
  <td>DEUDA</td>
  <td>RESTO</td>
</tr>
<?php
if(mysqli_num_rows($rs) > 0) {
  while($embvig = mysqli_fetch_assoc($rs)){
    $id = $embvig['id'];
?>
    <tr>
      <td>
        <a href="personal/informes/embargos.php?id=<?php echo $embvig['id'];?>" target="_blank">
          <?php echo $embvig['id'];?>
        </a>
      </td>
      <td><?php echo $embvig['descripcion'];?></td>
      <td>
        <?php
          if($embvig['tipo'] == 0){
            echo "EJECUTIVO";
          } else if($embvig['tipo'] == 1){
            echo "ALIMENTARIO";
          } else {
            echo "ALIMENTARIO+ASIGNACION";
          }
        ?>
      </td>
      <td align="center">
        <?php
            echo $embvig['monto'];
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
      </tr>
      <tr><form  method="post" action="personal/procesos/script.php?edit=finemb">
      <td colspan="3"><label for="observaciones"></label>
      <textarea name="observaciones" id="observaciones" cols="95" rows="2"></textarea>
      </td>
      <td colspan="2">
          <input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
          <input type="hidden" name="idembargo" id="idembargo" value="<?php echo $embvig['id'];?>" />
          <input type="submit" name="button" id="button" value="Finalizar <?php echo $embvig['id'];?>" />
      </td>  
      
    </form></tr>
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

<br />

<?php
$sql = "SELECT * FROM agente_embargo WHERE dni = '$du' AND estado = 2 ORDER BY id ASC ";
$rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="personal">
<tr>
  <td colspan="4" align="center" bgcolor="#E6E6E6" >EMBARGOS PENDIENTES</td>
</tr>
<tr>
  <td>ID</td>
  <td>DESCRIPCION</td>
  <td>TIPO</td>
  <td>DEUDA</td>

</tr>
<?php
if(mysqli_num_rows($rs) > 0) {
  while($embpend = mysqli_fetch_assoc($rs)){
    $id = $embpend['id'];
?>
    <tr>
      <td><a href="personal/informes/embargos.php?id=<?php echo $embpend['id'];?>" target="_blank">
        <?php echo $embpend['id'];?>
      </a></td>
      <td><?php echo $embpend['descripcion'];?></td>
      <td>
        <?php

          if($embpend['tipo'] == 0){
            echo "EJECUTIVO";
          } else if($embpend['tipo'] == 1){
            echo "ALIMENTARIO";
          } else {
            echo "ALIMENTARIO+ASIGNACION";
          }
        ?>
      </td>
      <td><?php echo $embpend['monto'];?></td>
    </tr>
<?php
  }
} else {
?>
<tr>
  <td colspan="4" align="center">NO REGISTRA.</td>
</tr>
<?php
}
?>
</table>

<br />
<?php
$sql = "SELECT * FROM agente_embargo WHERE dni = '$du' AND estado = 0 ORDER BY id ASC ";
$rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="personal">
<tr>
  <td colspan="5" align="center" bgcolor="#E6E6E6" >HISTORIAL EMBARGOS</td>
</tr>
<tr>
  <td>ID</td>
  <td>DESCRIPCION</td>
  <td>TIPO</td>
  <td>DEUDA</td>
  <td>PERIODO</td>
</tr>
<?php
if(mysqli_num_rows($rs) > 0) {
while($embpend = mysqli_fetch_assoc($rs)){
  $id = $embpend['id'];
?>
    <tr>
      <td><a href="personal/informes/embargos.php?id=<?php echo $embpend['id'];?>" target="_blank">
        <?php echo $id;?>
      </a></td>
      <td><?php echo $embpend['descripcion'];?></td>
      <td>
        <?php
          if($embpend['tipo'] == 0){
            $tipo = "EJECUTIVO";
          } else if($embpend['tipo'] == 1){
            $tipo = "ALIMENTARIO";
          } else {
            $tipo = "ALIMENTARIO+ASIGNACION";
          }
                  ?>
      </td>
      <td>
        <?php 
            echo $embpend['monto'];
        ;?>
      </td>
      <td>
        <?php
          $sql = "SELECT mes FROM agente_descuento_embargo WHERE id_embargo = '$id' ORDER BY mes ASC limit 1 ";
          $ini = consultaSql($sql);
          $ini = mysqli_fetch_assoc($ini);
          echo substr(cambioDate($ini['mes']), 3)." a ";
          $sql = "SELECT mes FROM agente_descuento_embargo WHERE id_embargo = '$id' ORDER BY mes DESC limit 1 ";
          $fin = consultaSql($sql);
          $fin = mysqli_fetch_assoc($fin);
          echo substr(cambioDate($fin['mes']), 3);
        ?>
      </td>
    </tr>
<?php
  }
} else {
?>
<tr>
  <td colspan="5" align="center">NO REGISTRA.</td>
</tr>
<?php
}
?>
</table>