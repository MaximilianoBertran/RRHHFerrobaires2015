<br />
<?php
  $sql = "SELECT agente_licencia.year, agente_licencia.dias, agente_laboral.fing, agente_laboral.planta, agente_laboral.efect  FROM agente_licencia, agente_laboral WHERE agente_licencia.dni = '$du' AND agente_laboral.dni = '$du' AND year > 2015 ORDER BY year ASc";
  $licpen = consultaSql($sql);
?>
<table border="1" cellspacing="0" cellpadding="0" align="center"  class="ficha">
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
    echo "<tr>";
    echo '<td>'.$agentelicpen['year'].'</td>';
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
      echo '<td>'.$pendientes.'</td>';
    }
    echo "</tr>";
    $aux++;
  }
  ?>


</table>