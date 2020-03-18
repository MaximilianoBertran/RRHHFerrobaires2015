<?php
$sql = "SELECT * FROM agente_estado_medico WHERE dni = '$du'";
$rs = consultaSql($sql);
$estado = mysqli_fetch_assoc($rs);
?>
<table  border="1" cellpadding="0" align="center" cellspacing="0" class="ficha">
    <tr  bgcolor="#E6E6E6">
      <td>JUB. X INVALIDEZ</td>
      <td>APIP</td>
      <td>PSICO-FISICO</td>
      <td>CERTIF.</td>
    </tr>
    <tr>
      <td>  
        <?php
          if($estado['jpi'] == 0){
            echo 'NO REGISTRA';
          } else {
            echo 'EN TRAMITE';
          }
        ?>
      </td>
      <td> 
        <?php
          if($estado['checkapip'] == 0){
            echo 'NO';
          } else {
            echo 'SI';
          }
        ?> -  F/Inicio: <?php
          if($estado['apip'] == "0000-00-00")
            echo 'NO REGISTRA';
          else
            echo cambioDate($estado['apip']); 
        ?>
        <br /><?php echo $estado['apipinfo'];?>
      </td>
      <td>
        F/Vencimiento: <?php
          if($estado['pf'] == "0000-00-00")
            echo 'NO REGISTRA';
          else
            echo cambioDate($estado['pf']); 
        ?><br />
        F/Reclamo: <?php
          if($estado['reclamopf'] == "0000-00-00")
            echo 'NO REGISTRA';
          else
            echo cambioDate($estado['pf']); 
        ?>
      </td>
      <td align="left">
        <?php
          switch ($estado['cert']) {
            case 1:
              echo "LOCOMOTORA";
              break;
            case 2:
              echo "ZORRAMOTOR";
              break;
            default:
              echo "SIN CERTIFICADO";
              break;
          }
        ?>
      </td>
    </tr>
</table>