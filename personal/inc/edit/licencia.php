<br />


<?php
  $sql = "SELECT agente_licencia.year, agente_licencia.dias, agente_laboral.fing, agente_laboral.planta, agente_laboral.efect  FROM agente_licencia, agente_laboral WHERE agente_licencia.dni = '$du' AND agente_laboral.dni = '$du' AND year > 2015 ORDER BY year ASc";
  $licpen = consultaSql($sql);
?>
<table border="1" cellspacing="0" cellpadding="0" align="center"  class="personal">
  <tr>
    <td colspan="3" bgcolor="#E6E6E6" align="center">LICENCIAS PENDIENTES</td>
  </tr>
  <tr>
    <td>AÑO</td>
    <td>DIAS</td>
    <td>PENDIENTES</td>
  </tr>
  <?php
  $hoy = date(Y)."-12-31";
  while($agentelicpen = mysqli_fetch_assoc($licpen)){
    echo '<tr><td>'.$agentelicpen['year'].'</td>';
    if($agentelicpen['dias'] == 0){
      if($agentelicpen['efect'] < '2012-01-01' && $agentelicpen['planta'] == 2){
        $antig = antig_licencia($agentelicpen['efect']);
      } else {
        $antig = antig_licencia($agentelicpen['fing']);
      }
      if($antig < 5){
        $dias = 14;
      } else if($antig >= 5 && $antig < 10){
        $dias = 21;
      } else if($antig >= 10 && $antig < 20){
        $dias = 28;
      } else if($antig >= 20){
        $dias = 35;
      }
      echo '<td>'.$dias.'</td>';
    } else {
      echo '<td>'.$agentelicpen['dias'].'</td>'; 
    }
    if($agentelicpen['dias'] == 0){
      echo '<td>'.$dias.'</td>';
    } else {
      $year = $agentelicpen['year'];
      $sql = "SELECT desde, hasta FROM agente_historial_licencia WHERE year = '$year' AND dni = '$du' AND tipo = 0";
      $res = consultaSql($sql);
      $tomados = 0;
      while ($lictom = mysqli_fetch_assoc($res)) {
        $tomados = $tomados + dias_transcurridos($lictom['desde'],$lictom['hasta']);
      }
      $pendientes = $agentelicpen['dias'] - $tomados;
      echo '<td>'.$pendientes.'</td></tr>';
    }
    $aux++;
  }
  ?>
</table>

<br />

<table border="1" align="center" cellpadding="0" cellspacing="0" class="personal">
  <tr>
    <td colspan="3" align="center" bgcolor="#E6E6E6" >DISPONIBILIDAD LICENCIAS ADICIONALES PERIODO <?php echo date('Y'); ?> </td>
  </tr>
  <tr bgcolor="#F2F2F2">
    <td align="center" colspan="2">LIC. POR ESTUDIO</td>
    <td align="center">LIC. FAMILIAR ENFERMO</td>
  </tr>
  <tr>
    <td align="center" width="200">
      <?php
      $year = date('Y');
      $sql = "SELECT * FROM agente_historial_licencia WHERE dni = '$du' AND tipo = 8 AND year = '$year'";
      $rs = consultaSql($sql);
      $dias = 0;
      while($historial = mysqli_fetch_assoc($rs)){
        $dias = $dias + dias_transcurridos($historial['desde'],$historial['hasta']);
      }
        $dias = 20 - $dias;
        if ($dias > 0){
          echo $dias;
        } else {
          echo 0;
        }
      ?>
    </td>
    <td width="200">
      <?php
      $sql = "SELECT * FROM agente_cert_lic_estudio WHERE dni = '$du' AND year = '$year'";
      $rs = consultaSql($sql);
      if(mysqli_num_rows($rs) > 0){
        echo 'Cert. Estudios '.$year.' prersentado.(<a href="personal/procesos/script.php?edit=esteli&year='.$year.'&du='.base64_encode($du).'"><img src="img/iconos/cancel.png">)';
      } else {
      ?>
      <a href="personal/procesos/script.php?edit=cerest&du=<?php echo base64_encode($du)?>"><input type="submit" name="cargar" id="cargar" value="Presentar Cert. Estudios" /></a>
      <?php
      }
      ?>
    </td>
    <td align="center"><?php
      $sql = "SELECT * FROM agente_historial_licencia WHERE dni = '$du' AND tipo = 18 AND year = '$year'";
      $rs = consultaSql($sql);
      $dias = 0;
      while($historial = mysqli_fetch_assoc($rs)){
        $dias = $dias + dias_transcurridos($historial['desde'],$historial['hasta']);
      }
        $dias = 30 - $dias;
        if ($dias > 0){
          echo $dias;
        } else {
          echo 0;
        }
      ?></td>
  </tr>
</table>
<br />

<?php
$sql = "SELECT * FROM agente_historial_licencia WHERE dni = '$du' ORDER BY desde ASC";
$rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="personal">
  <tr>
    <td colspan="5" align="center" bgcolor="#E6E6E6" >HISTORIAL LICENCIAS</td>
  </tr>
  <tr bgcolor="#F2F2F2">
    <td align="center">DESDE</td>
    <td align="center">HASTA</td>
    <td align="center">TIPO</td>
    <td align="center" colspan="2" width="150">AÑO</td>
  </tr>
<?php
while($historial = mysqli_fetch_assoc($rs)){
  if($_SESSION['id'] == 1 || $_SESSION['id'] == 22  || $_SESSION['id'] == 2){
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
      echo "LICENCIA POR DONACION DE SANGRE O PIEL";
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
    case 18:
      echo "LICENCIA POR FAMILIAR ENFERMO";
      break;
    case 19:
      echo "EXTRACCION DE PIEZA DENTAL";
      break;
  }
  ?></td>
    <td align="center" width="90"><?php echo $historial['year']; ?></td>
    <td width="10"><a href="personal/procesos/script.php?edit=liceli&id=<?php echo $historial['id'];?>&du=<?php echo base64_encode($du)?>"><img src="img/iconos/cancel.png"></a></td>
  </tr>
  <?php
  } else {
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
      echo "LICENCIA POR DONACION DE SANGRE O PIEL";
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
    case 18:
      echo "LICENCIA POR FAMILIAR ENFERMO";
      break;
    case 19:
      echo "EXTRACCION DE PIEZA DENTAL";
      break;
  }
  ?></td>
    <td align="center" colspan="2"><?php echo $historial['year']; ?></td>
  </tr>
 <?php
  }
 }
 ?>
 <?php if($planta > 0){?>
<form method="post" action="personal/procesos/script.php?edit=lic">
  <tr>
    <td width="66"> <input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
    <input name="desde" type="date" id="desde"  size="12" /></td>
    <td width="67"><input name="hasta" type="date" id="hasta" size="12" /></td>
    <td width="279"><label for="tipolic"></label>
      <select name="tipolic" id="tipolic"><?php
        $sql = "SELECT * FROM licencia_tipos ORDER BY id ASC";
    $lic = consultaSql($sql);
    while($tiposlic = mysqli_fetch_assoc($lic)){
      echo '<option value="'.$tiposlic['id'].'">'.$tiposlic['descripcion'].'</option>';
    }
    ?>
      </select></td>
    <td width="103" colspan="2"><input name="year" type="text" id="year" placeholder="aaaa" size="10" /></td>
 
  </tr>
  <tr>
    <td colspan="5" align="center"><input type="submit" name="cargar" id="cargar" value="Agregar Licencia" /></td>
  </tr>
</form>
<?php } ?>
</table>



