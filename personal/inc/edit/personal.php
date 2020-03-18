<?php
$sql = "SELECT * FROM agente_personal WHERE dni = '$du'";
$pers = consultaSql($sql);
$personal = mysqli_fetch_assoc($pers);
?>
<br/ >
<table border="1" cellpadding="0" cellspacing="0" class="personal" align="center">
  <form method="post" action="personal/procesos/script.php?edit=per">
    <tr>
      <td>
        Domicilio:
        <label for="domicilio"></label><input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
        <input type="text" name="domicilio" id="domicilio" value="<?php echo $personal['domicilio']; ?>"/>
      </td>
      <td>
        Localidad:
        <label for="localidad"></label>
        <input type="text" name="localidad" size="8" id="localidad" value="<?php echo $personal['localidad']; ?>"/> - 
        <label for="textfield3"></label>
        <input name="cp" type="text" id="cp" size="1" maxlength="4" placeholder="CP" value="<?php echo $personal['cp']; ?>"/>
      </td>
      <td>
        Provincia:
        <label for="pcia"></label>
        <input type="text" name="pcia" id="pcia" value="<?php echo $personal['pcia']; ?>"/>  
      </td>
    </tr>
    <tr>
      <td>
        F/Nac.:
        <label for="textfield4"></label>
        <input name="fnac" type="date" id="fnac" size="2" <?php
           if ($personal['fnac'] == '0000-00-00') {
           } else {
            echo ' value="'.$personal['fnac'].'"';
        };?> /> (<?php echo edad($personal['fnac']); ?>)-<label for="select"></label>
        <select name="sexo" id="sexo">
        <?php
        if($personal['sexo'] == "1"){
        ?>
        <option value="1" selected>M</option>
        <option value="0">F</option>
        <?php
        } else {
        ?>
        <option value="1">M</option>
        <option value="0" selected>F</option>
        <?php
        }
        ?>
        </select> 
      </td>
      <td>
        Estado Civil:
        <label for="select"></label>
        <select name="estcivil" id="estcivil">
        <?php
        $sql = "SELECT * FROM estcivil";
        $eciv = consultaSql($sql);
        while($civil = mysqli_fetch_assoc($eciv)){
        echo '<option value="'.$civil['id'].'"';
        if($civil['id'] == $personal['estcivil']){
        echo " selected";
        }
        echo '>'.$civil['estado'].'</option>';
        }
        ?>
        </select>
      </td>
      <td>
        Estudios: 
        <label for="estudios"></label>
        <select name="estudios" id="estudios">
        <?php
        $sql = "SELECT * FROM estudios";
        $estu = consultaSql($sql);
        while($estudio = mysqli_fetch_assoc($estu)){
        echo '<option value="'.$estudio['id'].'"';
        if($estudio['id'] == $personal['estudios']){
        echo " selected";
        }
        echo '>'.$estudio['nivel'].'</option>';
        }
        ?>
        </select>
        <label for="titulo"></label>
        <input name="titulo" type="text" id="titulo" size="20" value="<?php echo $personal['titulo']; ?>" placeholder='TIT. UNIV. SIN ACENTOS' />
      </td>
    </tr>
    <tr>
      <td>
        E-Mail:
        <label for="email"></label>
        <input name="email" type="text" id="email" size="26" value="<?php echo $personal['email']; ?>"/>
      </td>
      <td>
        Telefono:
        <label for="telefono"></label>
        <input type="text" name="telefono" size="15" id="telefono" value="<?php echo $personal['telefono']; ?>"/></td>
      </td>
      <td>
        A.Datos:
        <input name="act" type="date" id="act" size="6" <?php
           if ($personal['act'] == '0000-00-00') {
           } else {
            echo ' value="'.$personal['act'].'"';
        };?>
        />
        <input name="siape" type="checkbox"  
        <?php
        if($personal['siape'] == 1){
          echo 'checked="checked"';
        }
        ?> value="" />
        Prent: 
        <input name="prenatal" type="date" id="prenatal" size="6" <?php
           if ($personal['prenatal'] == '0000-00-00') {
           } else {
            echo ' value="'.$personal['prenatal'].'"';
        };?>
        />
      </td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input type="submit" name="button" id="button" value="Guardar cambios" /></td>
    </tr>
  </form>
</table>

<br />

<?php
  $sql = "SELECT * FROM agente_conyuge WHERE dnititular = '$du'";
  $cony = consultaSql($sql);
  $conyu = mysqli_fetch_assoc($cony);
  $dnic = $conyu['dni'];
?>
<table border="1" cellspacing="0" cellpadding="0" class="personal" align="center">
  <form method="post" action="personal/procesos/script.php?edit=cony">
    <tr>
      <td colspan="4"  align="center" bgcolor="#E6E6E6">CONYUGE</td>
    </tr>
  <tr>
    <td colspan="2">
      Ape. y Nombre:
      <input name="apeynom" type="text" id="apeynom" value="<?php echo $conyu['apeynom']; ?>" size="40"/>
    </td>
    <td>
      DNI:
      <input name="dnic" type="text" id="dnic" value="<?php echo $conyu['dni']; ?>" size="12" placeholder="DNI (sin .)"/>
      <input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
    </td>
    <td>
      F/Nac.:
      <input name="fnac" type="date" id="fnac" size="6" <?php
           if ($conyu['fnac'] == '0000-00-00') {
           } else {
            echo ' value="'.$conyu['fnac'].'"';
        };?>/> - <?php echo edad($conyu['fnac']); ?>
    </td>
  </tr>
  <tr>
    <td>
      F/Enlace:
      <input name="fenl" type="date" id="fenl" <?php
           if ($conyu['fenl'] == '0000-00-00') {
           } else {
            echo ' value="'.$conyu['fenl'].'"';
        };?> />
    </td>
    <td>
      IOMA:
      <input name="ioma" type="checkbox"  
      <?php
      if($conyu['ioma'] == 0){
        echo 'disabled';
      } else {
        echo 'checked="checked"';
      }
      ?>value="" />
    </td>
    <td colspan="2">
      Estado:
      <select name="act" id="act">
        <option value="ama" <?php if($conyu['act'] == "ama") echo ' selected="selected"'; ?>>Sin Empleo</option>
        <option value="tra" <?php if($conyu['act'] == "tra") echo ' selected="selected"'; ?>>Empleado/a</option>
        <option value="uep" <?php if($conyu['act'] == "uep") echo ' selected="selected"'; ?>>U.E.P.F.P.</option>
      </select>
      <?php
        if($conyu['act'] == "uep") {
          $dni = $conyu['dni'];
          echo '(<a href="index.php?sector=personal&du='.base64_encode($dni).'" target="blank">+</a>)';
        }
      ?>
      
    </td>
  </tr>
  <tr>
    <td colspan="4">
      Observaciones:
      <label for="textarea"></label>
      <textarea name="observaciones" id="observaciones" cols="85" rows="1"><?php echo $conyu['observaciones']?>
      </textarea>
    </td>
  </tr>
    <tr>
      <td colspan="4" align="center"><input type="submit" name="button" id="button" value="Guardar Cambios"></form>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="personal/procesos/script.php?edit=cony&tarea=eli&du=<?php echo base64_encode($du)?>"><input type="submit" name="button" id="button" value="Eliminar Conyuge" /></a></td>
    </tr>
  
</table>



<?php
  if($conyu['act'] == "uep"){
  $sql = "SELECT * FROM agente_hijos WHERE dnititular = '$dnic'";
  $rs = consultaSql($sql);
  if (mysqli_num_rows($rs) > 0) {
    while ($hijos = mysqli_fetch_assoc($rs)){
?>
<br />
<table border="1" cellspacing="0" cellpadding="0" class="personal" align="center">
  <tr>
    <td colspan="4" align="center" bgcolor=#E6E6E6>MENOR A CARGO DE CONYUGE</td>
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
      C.L Inicio
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
<br />
<?php
    }
  }
}
?>

<br />

<?php
  $sql = "SELECT * FROM agente_hijos WHERE dnititular = '$du'";
  $rs = consultaSql($sql);
  while ($hijos = mysqli_fetch_assoc($rs)){
?>

<table border="1" cellspacing="0" cellpadding="0" class="personal" align="center">
  <form method="post" action="personal/procesos/script.php?edit=hijo&tarea=act">
    <tr>
      <td colspan="4" align="center" bgcolor="#E6E6E6">PERSONA A CARGO</td>
    </tr>
    <tr>
      <td colspan="2">Ape.y Nombre:
        <input name="apeynom" type="text" id="apeynom" value="<?php echo $hijos['apeynom']; ?>" placeholder="Apellido y nombre" size="35" />
        <input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
      </td>
      <td>
        DNI:    
        <input name="dnih" type="text" id="dnih" value="<?php echo $hijos['dni']; ?>" placeholder="DNI (sin .)" size="12" />
      </td>
      <td>
        F/Nac.: 
        <input name="fnac" type="date" id="fnac" size="6" <?php
           if ($hijos['fnac'] == '0000-00-00') {
           } else {
            echo ' value="'.$hijos['fnac'].'"';
        };?>/> - <?php echo edad($hijos['fnac']); ?>
      </td>
    </tr>
    <tr>
      <td>
        Vinculo:
        <select name="vinculo" id="vinculo">
          <option value="hij" <?php if($hijos['vinculo'] == "hij") echo ' selected="selected"'; ?>>Hijo</option>
          <option value="adp" <?php if($hijos['vinculo'] == "adp") echo ' selected="selected"'; ?>>Adopcion</option>
          <option value="acg" <?php if($hijos['vinculo'] == "acg") echo ' selected="selected"'; ?>>A cargo</option>
        </select>
      </td>
      <td>
        Asignacion:
        <input name="asigna" type="checkbox" id="asigna" value="1"  
        <?php
        if($hijos['asigna'] == 0){
          echo 'disabled';
        } else {
          echo 'checked="checked"';
        }
        ?>value="" />
      </td>
      <td>
        Nivel:
        <select name="nivel" id="nivel">
          <option value="inf"<?php if($hijos['nivel'] == "inf") echo ' selected="selected"'; ?>>Ninguno</option>
          <option value="pre"<?php if($hijos['nivel'] == "pre") echo ' selected="selected"'; ?>>Prescolar</option>
          <option value="pri"<?php if($hijos['nivel'] == "pri") echo ' selected="selected"'; ?>>Primario</option>
          <option value="sec"<?php if($hijos['nivel'] == "sec") echo ' selected="selected"'; ?>>Secundario</option>
          <option value="ter"<?php if($hijos['nivel'] == "ter") echo ' selected="selected"'; ?>>Terciario</option>
        </select>
         -
        <label for="grado"></label>
        <input name="grado" type="text" id="grado" value="<?php echo $hijos['grado']; ?>" size="2" />
      </td>
      <td>
        Inst. Especial:
        <input name="especial" type="checkbox" id="especial" value="1"  
        <?php
        if($hijos['especial'] == 0){
        echo 'disabled';
        } else {
        echo 'checked="checked"';
        }
        ?>value="" />
      </td>
    </tr>
    <tr>
      <td>
        Discapacidad:
        <input name="disc" type="checkbox" id="disc" value="1"  
        <?php
        if($hijos['disc'] == 0){
          echo 'disabled';
        } else {
          echo 'checked="checked"';
        }
        ?>value="" /> - <input name="discvenc" type="date" id="discvenc" size="6" <?php
           if ($hijos['discvenc'] == '0000-00-00') {
           } else {
            echo ' value="'.$hijos['discvenc'].'"';
        };?>/>
      </td>
      <td>
        IOMA:
        <input name="ioma" type="checkbox" value="1"  
        <?php
        if($hijos['ioma'] == 0){
          echo 'disabled';
        } else {
          echo 'checked="checked"';
        }
        ?>value="" /> 
      </td>
      <td>
        C.L Inicio
        <label for="clinicio"></label>
        <select name="clinicio" id="clinicio">
          <option value="0"<?php 
          $nulo = date('Y')-1; 
          if($hijos['clinicio'] < $nulo) echo ' selected="selected"'; 
          ?>>Sin Datos</option>
          <?php 
          $aux = 0;
          while ($aux <= 2){
            $print = $nulo + $aux;
            echo '<option value="'.$print.'"';
            if($hijos['clinicio'] == $print){
              echo ' selected="selected"';
            }
            echo '>'.$print.'</option>';
            $aux++;
          }

          ?>
        </select>
      </td>
      <td>
        C.L. Final
        <select name="clfinal" id="clfinal">
          <option value="0"<?php 
          if($hijos['clfinal'] < $nulo) echo ' selected="selected"'; 
          ?>>Sin Datos</option>
          <?php 
          $aux = 0;
          while ($aux <= 2){
            $print = $nulo + $aux;
            echo '<option value="'.$print.'"';
            if($hijos['clfinal'] == $print){
              echo ' selected="selected"';
            }
            echo '>'.$print.'</option>';
            $aux++;
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="4">Observaciones:
        <textarea name="observaciones" id="observaciones" cols="85" rows="1"><?php echo $hijos['observaciones']?>
        </textarea>
      </td>
    </tr>
    <?php if($conyu['act'] == "uep") {
      $dni = $conyu['dni'];
      $dnih = $hijos['dni'];
    ?>
    <tr>
      <td colspan="3" align="center"><input type="submit" name="button" id="button" value="Guardar Cambios" /></td></form>
      <td  align="center"><a href="personal/procesos/script.php?edit=migh&dni=<?php echo $dni;?>&dnih=<?php echo $dnih;?>&du=<?php echo $du;?>">Migrar</a></td>
      
    </tr>
    <?php
    } else {?>
      
    <tr>
      <td colspan="4" align="center"><input type="submit" name="button" id="button" value="Guardar Cambios" /></form></td>
    </tr>
    <?php }?>
  
</table>
<br />
<?php
  }
?>
<table border="1" cellspacing="0" cellpadding="0" class="personal" align="center">
  <form method="post" action="personal/procesos/script.php?edit=hijo&tarea=ins">
    <tr>
      <td colspan="4" align="center" bgcolor="#E6E6E6">PERSONA A CARGO</td>
    </tr>
    <tr>
      <td colspan="2">
        Ape.y Nombre:
        <input name="apeynom" type="text" id="apeynom" placeholder="Apellido y nombre" size="35" />
        <input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
      </td>
      <td>
        DNI:    
        <input name="dnih" type="text" id="dnih" placeholder="DNI (sin .)" size="12" /></td>
      <td>
        F/Nac.: 
        <input name="fnac" type="date" id="fnac" />
      </td>
    </tr>
    <tr>
      <td>
        Vinculo:
        <select name="vinculo" id="vinculo">
          <option value="hij" echo selected="selected"'>Hijo</option>
          <option value="adp" >Adopcion</option>
          <option value="acg" >A cargo</option>
        </select>
      </td>
      <td>
        Asignacion:
        <input name="asigna" type="checkbox" id="asigna" value="1"  />
      </td>
      <td>Nivel:
        <select name="nivel" id="nivel">
          <option value="inf" selected="selected">Ninguno</option>
          <option value="pre">Prescolar</option>
          <option value="pri">Primario</option>
          <option value="sec">Secundario</option>
          <option value="ter">Terciario</option>
        </select>
         -
        <label for="grado"></label>
        <input name="grado" type="text" id="grado" value="<?php echo $hijos['grado']; ?>" size="2" />
      </td>
      <td>
        Inst. Especial:
        <input name="especial" type="checkbox" id="especial" value="1" />
      </td>
    </tr>
    <tr>
      <td>
        Discapacidad:
        <input name="disc" type="checkbox" id="disc" value="1"  /> - <input name="discvenc" type="date" id="discvenc" size="6"/>
      </td>
      <td>
        IOMA:
        <input name="ioma" type="checkbox" value="1"  />
      </td>
      <td>
        C.L Inicio
        <label for="clinicio"></label>
        <select name="clinicio" id="clinicio">
          <option value="0"<?php 
          $nulo = date('Y')-1; 
          echo ' selected="selected"'; 
          ?>>Sin Datos</option>
          <?php 
          $aux = 0;
          while ($aux <= 2){
            $print = $nulo + $aux;
            echo '<option value="'.$print.'"';
            echo '>'.$print.'</option>';
            $aux++;
          }?>
        </select>
      </td>
      <td>
        C.L. Final
        <select name="clfinal" id="clfinal">
          <option value="0"<?php 
          echo ' selected="selected"'; 
          ?>>Sin Datos</option>
          <?php 
          $aux = 0;
          while ($aux <= 2){
            $print = $nulo + $aux;
            echo '<option value="'.$print.'"';
            echo '>'.$print.'</option>';
            $aux++;
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="4">Observaciones:
        <textarea name="observaciones" id="observaciones" cols="85" rows="1"></textarea>
      </td>
      </tr>
      <tr>
      <td colspan="4" align="center">
        <input type="submit" name="button" id="button" value="Agregar" />
      </td>
    </tr>
  </form>
</table>

<br/ ><br/ ><br/ ><br/ >