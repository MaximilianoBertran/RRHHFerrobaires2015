<?php
$sql = "SELECT * FROM agente_personal WHERE dni = '$du'";
$pers = consultaSql($sql);
$personal = mysqli_fetch_assoc($pers);
?>
<table border="1" cellpadding="0" cellspacing="0" class="ficha" align="center">
    <tr>
      <td colspan="3" align="center" bgcolor="#E6E6E6">DATOS PERSONALES</td>
    </tr>
    <tr>
      <td>
        Domicilio: <?php echo $personal['domicilio']; ?>
      </td>
      <td>
        Localidad: <?php echo $personal['localidad']; ?> - CP: <?php echo $personal['cp']; ?>
      </td>
      <td>
        Provincia: <?php echo $personal['pcia']; ?>
      </td>
    </tr>
    <tr>
      <td>
        Fecha Nacimiento: <?php
        if ($personal['fnac'] == '0000-00-00') {
            echo "NO REGISTRA";
        } else {
            echo cambioDate($personal['fnac']);
        };?>
        (<?php echo edad($personal['fnac']); ?>) - <?php
        if($personal['sexo'] == "1"){
            echo "M";
        } else {
            echo "F";
        }
        ?>
      </td>
      <td>
        Estado Civil: <?php
        $sql = "SELECT * FROM estcivil";
        $eciv = consultaSql($sql);
        while($civil = mysqli_fetch_assoc($eciv)){
          if($civil['id'] == $personal['estcivil']){
            echo $civil['estado'];
          }
        }
        ?>
      </td>
      <td>
        Estudios: <?php
        $sql = "SELECT * FROM estudios";
        $estu = consultaSql($sql);
        while($estudio = mysqli_fetch_assoc($estu)){
          if($estudio['id'] == $personal['estudios']){
            echo $estudio['nivel'];
          }
        }?>
      </td>
    </tr>
    <tr>
        <td>
            E-Mail: <?php echo $personal['email']; ?>
        </td>
        <td>
            Telefono: <?php echo $personal['telefono']; ?>
        </td>
      </td>
      <td>
        Act.Datos: <?php
        if ($personal['act'] == '0000-00-00') {
            echo "NO REGISTRA";
        } else {
            echo cambioDate($personal['act']);
        };?>
        SIAPE: <?php
        if ($personal['siape'] == 0) {
            echo "NO";
        } else {
            echo "SI";
        };?>
         <?php
        if ($personal['prenatal'] == '0000-00-00') {

        } else {
            echo "PRENATAL:".cambioDate($personal['prenatal']);
        };?>
      </td>
    </tr>
</table>