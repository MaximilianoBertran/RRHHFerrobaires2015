<?php
  $sql = "SELECT * FROM agente_conyuge WHERE dnititular = '$du'";
  $cony = consultaSql($sql);
  $conyu = mysqli_fetch_assoc($cony);
  if(mysqli_num_rows($cony) > 0){
?>
<table border="1" cellspacing="0" cellpadding="0" class="ficha" align="center">
    <tr>
      <td colspan="4"  align="center" bgcolor="#E6E6E6">CONYUGE</td>
    </tr>
  <tr>
    <td colspan="2">
      Ape. y Nombre: <?php echo $conyu['apeynom'];?>
    </td>
    <td>
      DNI: <?php echo $conyu['dni']; ?>
    </td>
    <td>
      F/Nac.: <?php
      if ($conyu['fnac'] == '0000-00-00') {
        echo "NO REGISTRA";
      } else {
        echo cambioDate($conyu['fnac']);
      };?> - <?php echo edad($conyu['fnac']); ?>
    </td>
  </tr>
  <tr>
    <td>
      F/Enlace: <?php
      if ($conyu['fenl'] == '0000-00-00') {
        echo "NO REGISTRA";
      } else {
        echo cambioDate($conyu['fenl']);
      };?>
    </td>
    <td>
      Estado: <?php
        switch ($conyu['act']) {
          case 'ama':
              echo "SIN EMPLEO";
            break;
          case 'tra':
              echo "EMPLEADO/A";
            break;
          case 'uep':
              echo "U.E.P.F.P.";
            break;
        }
      ?>
    </td>
    <td>
      Prenatal: <?php
      if ($conyu['prenatal'] == '0000-00-00') {
        echo "NO REGISTRA";
      } else {
        echo cambioDate($conyu['prenatal']);
      };?>
    </td>
    <td>
      IOMA: <?php
      if($conyu['ioma'] == 0){
        echo 'NO';
      } else {
        echo 'SI';
      }
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="4">
      Observaciones: <?php echo $conyu['observaciones'];?>
    </td>
  </tr>
</table>
<?php
  }
?>