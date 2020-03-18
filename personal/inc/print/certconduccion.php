<?php
$sql = "SELECT * FROM agente_certificado_conduccion WHERE dni = '$du' ORDER BY id ASC";
$rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class='ficha'>
  <tr>
    <td colspan="4" align="center" bgcolor="#E6E6E6">CERTIFICADOS DE CONDUCCION</td>
  </tr>
<?php
if(mysqli_num_rows($rs) > 0){
  while($conduccion = mysqli_fetch_assoc($rs)){
?>
<tr>
    <td rowspan="3" align="center">
      <?php
        $pathFoto = '../../img/cnrt/'.$conduccion['id'].'.jpg';
        if(file_exists($pathFoto))
        {
        ?>
          <img src="<?php echo $pathFoto ?>" width="140" height="84">
        <?php
        }else{
          echo '<img src="../../img/cnrt/0.png" width="90" height="72">';
        }
      ?>
    </td>
    <td colspan="2">CERTIFICADO 
          <?php
            $sql = "SELECT * FROM certificados_conduccion";
            $rs = consultaSql($sql);
            while($ceco = mysqli_fetch_assoc($rs)){
            if($conduccion['tipo'] == $ceco['id']){
              echo $ceco['certificado'];
            }
            }
      ?></td>
    <td>CERTIF. N° <?php echo $conduccion['numero']; ?></td>
    
  </tr>
    <tr>
      <td>F/EMISION <?php echo cambioDate($conduccion['femision']); ?></td>
      <td>F/VENC <?php echo cambioDate($conduccion['fvenc']); ?></td>
      
      <td> APROBADO
        <?php 
        switch ($conduccion['aprobado']) {
          case 0:
            echo "SIN REGISTRO";
            break;
          case 6:
            echo "TEMA 0";
            break;
          case 1:
            echo "TEMA 1";
            break;
          case 2:
            echo "TEMA 2";
            break;
          case 3:
            echo "TEMA 3";
            break;
          case 4:
            echo "TEMA 4";
            break;
          case 5:
            echo "TEMA 5";
            break;
          case 'C':
            echo "COMPETO";
            break;
        }
?>
    </td>
    </tr>
    <tr>
      <td>ACTA N° <?php echo $conduccion['acta']; ?></td>
    <td>F/EXAMEN <?php echo cambioDate($conduccion['fecha']); ?></td>
      <td>CONCESIONARIO 
        <?php
        switch ($conduccion['concesionario']) {
          case 'no':
            echo "NO REGISTRA";
            break;
          case 'ue':
            echo "U.E.P.F.P.";
            break;
          case 'fa':
            echo "FERRO. ARG.";
            break;
          case 'nfa':
            echo "N. FERRO. ARG.";
            break;
          case 'fe':
            echo "F.E.P.S.A.";
            break;

        }?></td>
    </tr>
<?php
  }
} else {
?>
  <tr>
    <td colspan="6">NO REGISTRA.</td>
  </tr>
<?php
}
?>
</table>


