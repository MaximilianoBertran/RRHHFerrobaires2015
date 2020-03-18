<br />

<?php
$sql = "SELECT * FROM agente_estado_medico WHERE dni = '$du'";
$rs = consultaSql($sql);
$estado = mysqli_fetch_assoc($rs);
?>
<table  border="1" cellpadding="0" align="center" cellspacing="0" class="personal">
  <form method="post" action="personal/procesos/script.php?edit=med">
    <tr  bgcolor="#E6E6E6"><input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
      <td>JUB. X INVALIDEZ</td>
      <td>APIP</td>
      <td>PSICO-FISICO</td>
      <td>CERTIF.</td>
    </tr>
    <tr>
      <td align="center">
        <input name="jpi" type="checkbox"  
        <?php
          if($estado['jpi'] == 0){
            echo 'disabled';
          } else {
            echo 'checked="checked"';
          }
        ?>value="" /></label>
      </td>
      <td> <input name="checkapip" type="checkbox"  
        <?php
          if($estado['checkapip'] == 0){
            echo 'disabled';
          } else {
            echo 'checked="checked"';
          }
        ?>value="" /></label> F/Inicio<label for="apip"></label>
        <input type="date" name="apip" id="apip" size="10" <?php
           if ($estado['fing'] == '0000-00-00') {
           } else {
            echo ' value="'.$estado['apip'].'"';
        };?>/><br />Observaciones: <br />
        <textarea name="apipinfo" cols="35" rows="1" id="apipinfo"><?php echo $estado['apipinfo'];?></textarea>
      </td>
      <td>
        F/Vencimiento <label for="pf"></label>
        <input type="date" name="pf" id="pf" size="10" <?php
           if ($estado['pf'] == '0000-00-00') {
           } else {
            echo ' value="'.$estado['pf'].'"';
        };?>/><br />
        F/Reclamo:
        <label for="reclamopf"></label>
        <input type="date" name="reclamopf" id="reclamopf" size="10" <?php
           if ($estado['reclamopf'] == '0000-00-00') {
           } else {
            echo ' value="'.$estado['reclamopf'].'"';
        };?>/>
      </td>
      <td align="left">
        <input type="radio" name="cert" id="sin" value="0" <?php if($estado['cert'] == 0) echo "checked";?>>
        <label for="varon">SIN CERTIFICADO </label>
        <br/>
        <input type="radio" name="cert" id="loco" value="1" <?php if($estado['cert'] == 1) echo "checked";?>>
        <label for="varon">LOCOMOTORA </label>
        <br/>
        <input type="radio" name="cert" id="zorra" value="2" <?php if($estado['cert'] == 2) echo "checked";?>>
        <label for="mujer">ZORRAMOTOR </label>
      </td>
    </tr>
    <tr>
      <td colspan="4" align="center">
        <input type="submit" name="button" id="button" value="Guardar Cambios">
      </td>
    </tr>
  </form>
</table>

<br />

<?php
$sql = "SELECT * FROM agente_medico WHERE dni = '$du' AND tipo = 3 ORDER BY desde ASC ";
$rs = consultaSql($sql);
$aux = mysqli_num_rows($rs);
$ctrl = 0;
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="personal">
  <tr>
    <td colspan="5" align="center" bgcolor="#E6E6E6">HISTORIAL T.L.T.</td>
  </tr>
  <tr bgcolor="#F2F2F2">
    <td align="center" >DESDE</td>
    <td align="center" >HASTA</td>
    <td align="center" >DIAS</td>
    <td align="center" colspan="2" >ESTADO</td>
    
  </tr>
  <?php
  if($aux > 0){
    while($dato = mysqli_fetch_assoc($rs)){
      if($dato['alta'] == 1){  
          
  ?>
  <tr>
    <td align="center" ><?php echo cambioDate($dato['desde']); ?></td>
    <td align="center" ><?php echo cambioDate($dato['hasta']); ?></td>
    <td align="center" ><?php echo dias_transcurridos($dato['desde'],$dato['hasta']); ?></td>    
    <?php
    if($_SESSION['id'] == 1 || $_SESSION['id'] == 22  || $_SESSION['id'] == 2){
      echo '<td align="center" >CERRADO</td>';
      echo '<td width="10"><a href="personal/procesos/script.php?edit=enfeli&id='.$dato['id'].'&du='.base64_encode($du).'"><img src="img/iconos/cancel.png"></a></td>';
    }else{
      echo '<td align="center" colspan="2">CERRADO</td>';
    }
    ?>
  </tr>
  <tr>
    <td colspan="5" align="left">OBSERVACIONES: <?php echo $dato['observaciones']; ?></td>
  </tr>
  <?php
      }else{
        $ctrl = 1;
  ?>  
  <form id="art" name="art" method="post" action="personal/procesos/script.php?edit=tlt&tarea=act">
  <input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
  <tr>
    <td align="center" ><input name="desde" type="date" id="desde" <?php
        if ($dato['desde'] == '0000-00-00') {
        } else {
          echo ' value="'.$dato['desde'].'"';
        };?> /></td>
    <td align="center" ><input name="hasta" type="date" id="hasta" <?php
        if ($dato['hasta'] == '0000-00-00') {
        } else {
          echo ' value="'.$dato['hasta'].'"';
        };?> /></td>
    <td align="center" ><?php echo dias_transcurridos($dato['desde'],$dato['hasta']); ?></td>
    <td align="center"  colspan="2" ><input name="alta" id="alta" type="checkbox" /></td>
  </tr>
  <tr>
    <td colspan="5" align="left"><strong>OBSERVACIONES: </strong><br /> <textarea name="observaciones" id="observaciones" cols="85" rows="1"><?php echo $dato['observaciones']?></textarea></td>
  </tr>
  <tr>
    <td colspan="5" align="center"><input type="submit" name="button" id="button" value="Actualizar"></td>
  </tr>
  </form>
  <?php
    }
  }
  }
  if($ctrl == 0 && $planta > 0){
  ?>
  <form id="art" name="art" method="post" action="personal/procesos/script.php?edit=tlt&tarea=ins">
  
  <tr><input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
    <td align="center" ><input name="desde" type="date" id="desde" value="" size="10" /></td>
    <td align="center" ><input name="hasta" type="date" id="hasta" value="" size="10" /></td>
    <td align="center" ></td>
    <td align="center"  colspan="2" ><input name="alta" id="alta" type="checkbox" value="" /></td>
  </tr>
  <tr>
    <td colspan="5" align="left">OBSERVACIONES: <textarea name="observaciones" id="observaciones" cols="85" rows="1">
        </textarea></td>
  </tr>
  <tr>
    <td colspan="5" align="center"><input type="submit" name="button" id="button" value="Cargar"></td>
  </tr>
  </form>
 <?php
  }
  ?>
</table>



<br />



<?php
$sql = "SELECT * FROM agente_medico WHERE dni = '$du' AND tipo = 0 ORDER BY desde ASC ";
$rs = consultaSql($sql);
$aux = mysqli_num_rows($rs);
$ctrl = 0;
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="personal">
  <tr>
    <td colspan="6" align="center" bgcolor="#E6E6E6">HISTORIAL ENFERMEDAD</td>
  </tr>
  <tr bgcolor="#F2F2F2">
    <td align="center" >DESDE</td>
    <td align="center" >HASTA</td>
    <td align="center" >DIAS</td>
    <td align="center" >A.A. 050 N</td>
    <td align="center" colspan="2">ESTADO</td>
  </tr>
  <?php
  if($aux > 0){
    while($dato = mysqli_fetch_assoc($rs)){
      if($dato['alta'] == 0){  
      $ctrl = 1;    
  ?>
  <form method="post" action="personal/procesos/script.php?edit=enf&tarea=act">
  <input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
  <tr>
    <td align="center" ><input name="desde" type="date" id="desde" <?php
           if ($dato['desde'] == '0000-00-00') {
           } else {
            echo ' value="'.$dato['desde'].'"';
        };?> />
    </td>
    <td align="center" ><input name="hasta" type="date" id="hasta" <?php
           if ($dato['hasta'] == '0000-00-00') {
           } else {
            echo ' value="'.$dato['hasta'].'"';
        };?> />
    </td>
    <td align="center" ><?php echo dias_transcurridos($dato['desde'],$dato['hasta']); ?></td>
    <td align="center" ><input name="aa050" type="text" id="aa050" value="<?php echo $dato['aa050']; ?>" size="10" /></td>
    <td align="center" ><input name="alta" id="alta" type="checkbox" /></td>
  </tr>
  <tr>
    <td colspan="6" align="left">OBSERVACIONES: <textarea name="observaciones" id="observaciones" cols="85" rows="1"><?php echo $dato['observaciones']?></textarea></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><input type="submit" name="button" id="button" value="Actualizar"></td>
  </tr>
  </form>
  <?php
      }else{
  ?>  
<tr>
    <td align="center" ><?php echo cambioDate($dato['desde']); ?></td>
    <td align="center" ><?php echo cambioDate($dato['hasta']); ?></td>
    <td align="center" ><?php echo dias_transcurridos($dato['desde'],$dato['hasta']); ?></td>
    <td align="center" ><?php echo $dato['aa050']; ?></td>
    <?php
    if($_SESSION['id'] == 1 || $_SESSION['id'] == 22  || $_SESSION['id'] == 2){
      echo '<td align="center" >CERRADO</td>';
      echo '<td width="10"><a href="personal/procesos/script.php?edit=enfeli&id='.$dato['id'].'&du='.base64_encode($du).'"><img src="img/iconos/cancel.png"></a></td>';
    }else{
      echo '<td align="center" colspan="2">CERRADO</td>';
    }
    ?>
  </tr>
    <tr>
    <td colspan="6" align="left">OBSERVACIONES: <?php echo $dato['observaciones']; ?></td>
  </tr>
  <?php
    }
  }
  }
  if($ctrl == 0 && $planta > 0){
  ?>
  <form method="post" action="personal/procesos/script.php?edit=enf&tarea=ins">
  <input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
  <tr>
    <td align="center" ><input name="desde" type="date" id="desde" value="" size="10" /></td>
    <td align="center" ><input name="hasta" type="date" id="hasta" value="" size="10" /></td>
    <td align="center" ><?php echo dias_transcurridos($dato['desde'],$dato['hasta']); ?></td>
    <td align="center" ><input name="aa050" type="text" id="aa050" value="" size="10" /></td>
    <td align="center" colspan="2"><input name="alta" id="alta" type="checkbox" value="" /></td>
  </tr>
  <tr>
    <td colspan="6" align="left">OBSERVACIONES: <textarea name="observaciones" id="observaciones" cols="85" rows="1">
        </textarea></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><input type="submit" name="button" id="button" value="Cargar"></td>
  </tr>
  </form>
 <?php
  }
  ?>
</table>



<br />



<?php
$sql = "SELECT * FROM agente_medico WHERE dni = '$du' AND tipo = 1 ORDER BY desde ASC ";
$rs = consultaSql($sql);
$aux = mysqli_num_rows($rs);
$ctrl = 0;
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="personal">
  <tr>
    <td colspan="6" align="center" bgcolor="#E6E6E6">HISTORIAL A.R.T.</td>
  </tr>
  <tr bgcolor="#F2F2F2">
    <td align="center" >DESDE</td>
    <td align="center" >HASTA</td>
    <td align="center" >DIAS</td>
    <td align="center" >A.A. 050 N</td>
    <td align="center" colspan="2">ESTADO</td>
  </tr>
  <?php
  if($aux > 0){
    while($dato = mysqli_fetch_assoc($rs)){
      if($dato['alta'] == 0){  
      $ctrl = 1;    
  ?>
  <form method="post" action="personal/procesos/script.php?edit=art&tarea=act">
  <input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
  <tr>
    <td align="center" ><input name="desde" type="date" id="desde" <?php
           if ($dato['desde'] == '0000-00-00') {
           } else {
            echo ' value="'.$dato['desde'].'"';
        };?> />
    </td>
    <td align="center" ><input name="hasta" type="date" id="hasta" <?php
           if ($dato['hasta'] == '0000-00-00') {
           } else {
            echo ' value="'.$dato['hasta'].'"';
        };?> />
    </td>
    <td align="center" ><?php echo dias_transcurridos($dato['desde'],$dato['hasta']); ?></td>
    <td align="center" ><input name="aa050" type="text" id="aa050" value="<?php echo $dato['aa050']; ?>" size="10" /></td>
    <td align="center" colspan="2"><input name="alta" id="alta" type="checkbox" /></td>
  </tr>
  <tr>
    <td colspan="6" align="left">OBSERVACIONES: <textarea name="observaciones" id="observaciones" cols="85" rows="1"><?php echo $dato['observaciones']?></textarea></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><input type="submit" name="button" id="button" value="Actualizar"></td>
  </tr>
  </form>
  <?php
      }else{
  ?>  
<tr>
    <td align="center" ><?php echo cambioDate($dato['desde']); ?></td>
    <td align="center" ><?php echo cambioDate($dato['hasta']); ?></td>
    <td align="center" ><?php echo dias_transcurridos($dato['desde'],$dato['hasta']); ?></td>
    <td align="center" ><?php echo $dato['aa050']; ?></td>
  <?php
    if($_SESSION['id'] == 1 || $_SESSION['id'] == 22  || $_SESSION['id'] == 2){
      echo '<td align="center" >CERRADO</td>';
      echo '<td width="10"><a href="personal/procesos/script.php?edit=enfeli&id='.$dato['id'].'&du='.base64_encode($du).'"><img src="img/iconos/cancel.png"></a></td>';
    }else{
      echo '<td align="center" colspan="2">CERRADO</td>';
    }
    ?>
  </td>
  </tr>
    <tr>
    <td colspan="6" align="left">OBSERVACIONES: <?php echo $dato['observaciones']; ?></td>
  </tr>
  <?php
    }
  }
  }
  if($ctrl == 0 && $planta > 0){
  ?>
  <form id="art" name="art" method="post" action="personal/procesos/script.php?edit=art&tarea=ins">
  <input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
  <tr>
    <td align="center" ><input name="desde" type="date" id="desde" size="10" /></td>
    <td align="center" ><input name="hasta" type="date" id="hasta" size="10" /></td>
    <td align="center" ><?php echo dias_transcurridos($dato['desde'],$dato['hasta']); ?></td>
    <td align="center" ><input name="aa050" type="text" id="aa050" value="" size="10" /></td>
    <td align="center" colspan="2"><input name="alta" id="alta" type="checkbox" value="" /></td>
  </tr>
  <tr>
    <td colspan="6" align="left">OBSERVACIONES: <textarea name="observaciones" id="observaciones" cols="85" rows="1">
        </textarea></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><input type="submit" name="button" id="button" value="Cargar"></td>
  </tr>
  </form>
 <?php
  }
  ?>
</table>
<br />
<br />
<br />
