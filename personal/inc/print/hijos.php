<?php
  $sql = "SELECT * FROM agente_hijos WHERE dnititular = '$du'";
  $rs = consultaSql($sql);
  if (mysqli_num_rows($rs) > 0) {
    while ($hijos = mysqli_fetch_assoc($rs)){
?>
<table border="1" cellspacing="0" cellpadding="0" class="ficha" align="center">
  <tr>
    <td colspan="4" align="center" bgcolor="#E6E6E6">PERSONA A CARGO</td>
  </tr>
  <tr>
    <td colspan="2">Ape.y Nombre: <?php echo $hijos['apeynom']; ?>
    </td>
    <td>
    DNI: <?php echo $hijos['dni']; ?>
    </td>
    <td>
      F/Nac.: <?php
      if ($hijos['fnac'] == '0000-00-00') {
        echo "NO REGISTRA";
      } else {
        echo cambioDate($hijos['fnac']);
      };?> - <?php echo edad($hijos['fnac']); ?>
    </td>
  </tr>
  <tr>
    <td>
      Vinculo: <?php
        switch ($hijos['vinculo']) {
          case 'adp':
            echo "ADOPCION";
            break;
          case 'acg':
            echo "A CARGO";
            break;
          default:
            echo "HIJO";
            break;
        }
      ?>
    </td>
    <td>
      Asignacion: <?php
        if($hijos['asigna'] == 0){
          echo 'NO';
        } else {
          echo 'SI';
        }
      ?>
    </td>
    <td>
      Nivel: <?php
        switch ($hijos['nivel']) {
          case 'pre':
            echo "PRESCOLAR";
            break;
          case 'pri':
            echo "PRIMARIO";
            break;
          case 'sec':
            echo "SECUNDARIO";
            break;
          case 'ter':
            echo "TERCIARIO";
            break;
          default:
            echo "NINGUNO";
            break;
        }
      ?> - <?php echo $hijos['grado']; ?>
    </td>
    <td>
      Inst. Especial: <?php
        if($hijos['especial'] == 0){
          echo 'NO';
        } else {
          echo 'SI';
        }
      ?>
    </td>
  </tr>
  <tr>
    <td>
      Discapacidad: <?php
        if($hijos['disc'] == 0){
          echo 'NO';
        } else {
          echo 'SI';
        }
      ?> - <?php
      if ($hijos['discvenc'] == '0000-00-00') {
        echo "NO REGISTRA";
      } else {
        echo cambioDate($hijos['discvenc']);
      };?>
    </td>
    <td>
      IOMA: <?php
        if($hijos['ioma'] == 0){
          echo 'NO';
        } else {
          echo 'SI';
      }
      ?>
    </td>
    <td>
      C.L Inicio
      <?php 
        $nulo = date('Y')-1; 
        if($hijos['clinicio'] < $nulo){
          echo 'SIN DATOS'; 
        } else {
          $aux = 0;
          while ($aux <= 2){
            $print = $nulo + $aux;
            if($hijos['clinicio'] == $print){
              echo $hijos['clinicio'];
            }
            $aux++;
          }
        }
      ?>
    </td>
    <td>
      C.L Fin
      <?php 
        $nulo = date('Y')-1; 
        if($hijos['clfinal'] < $nulo){
          echo 'SIN DATOS'; 
        } else {
          $aux = 0;
          while ($aux <= 2){
            $print = $nulo + $aux;
            if($hijos['clfinal'] == $print){
              echo $hijos['clfinal'];
            }
            $aux++;
          }
        }
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4">
      Observaciones: <?php echo $hijos['observaciones']?>
    </td>
  </tr>
</table>
<?php
    }
  }
?>