<br />
<?php
	$sql = "SELECT * FROM agente_laboral WHERE dni = '$du'";
	$laboral = consultaSql($sql);
	$agentelab = mysqli_fetch_assoc($laboral);
?>
<table border="1" cellspacing="0" cellpadding="0" align="center" class="personal">
	<form method="post" action="personal/procesos/script.php?edit=lab">
	<tr>
		<td>
			Agente: <input name="agente" type="text" id="agente" size="30" value="<?php echo $agentelab['agente'];?>"/>
		</td>
		<td>
			DNI: <input name="du" type="text" id="du" size="12"  value="<?php echo $agentelab['dni'];?>"/>
		</td>
		<td>
			CUIL: <input name="cuil" type="text" id="cuil" size="15"  value="<?php echo $agentelab['cuil'];?>"/></td>

		<td rowspan="3" scope="col" align="center">
			<?php
				$pathFoto = 'img/personal/'.$du.'.jpg';
				if(file_exists($pathFoto))
				{
					echo '<img src="'.$pathFoto.'" width="90" height="72">'; 
				}else{
					echo '<img src="img/personal/0.png" width="90" height="72">';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			Legajo:  <?php echo $agentelab['legajo'];?>
		</td>
		<td>
			Carnet: <input name="ncarnet" type="text" id="ncarnet" size="7"  value="<?php echo $agentelab['ncarnet'];?>"/>
		</td>
		<td><?php $planta = $agentelab['planta'];?>
			Planta: <label for="planta"></label>
			<select name="planta" id="planta">
			    <option value="0" <?php if($agentelab['planta'] == 0) echo 'selected="selected"'?>>BAJA</option>
			    <option value="1" <?php if($agentelab['planta'] == 1) echo 'selected="selected"'?>>FUERA CCT</option>
			    <option value="2" <?php if($agentelab['planta'] == 2) echo 'selected="selected"'?>>EFECTIVO</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			F/ing <input name="fing" type="date" id="fing" size="12" <?php
			     if ($agentelab['fing'] == '0000-00-00') {
			     } else {
			     	echo ' value="'.$agentelab['fing'].'"';
				};?>/>
		</td>
		<td>
			F/efec <input name="efect" type="date" id="efect" size="12" <?php
			     if ($agentelab['efect'] == '0000-00-00') {
			     } else {
			     	echo ' value="'.$agentelab['efect'].'"';
				};?>/> 
			    <?php
			    	$decreto = traerDecreto($agentelab['efect']);
			    	echo $decreto;
			    ?>
		</td>
		<td>
			Traspaso a Nacion <input name="nacion" type="date" id="nacion" size="12" <?php
			     if ($agentelab['nacion'] == '0000-00-00') {
			     } else {
			     	echo ' value="'.$agentelab['nacion'].'"';
				};?>/> 
		</td>
	</tr>
	<tr>
		<td colspan="2">
			Sub Gerencia: <label for="select"></label>
			<select name="id_subg" id="id_subg">
			<?php
				$sql = "SELECT * FROM subgerencias ORDER BY id_subg ASC";
				$depto = consultaSql($sql);
				while($dpto = mysqli_fetch_assoc($depto)){
				    echo '<option value="'.$dpto['id_subg'].'"';
					if($dpto['id_subg'] == $agentelab['id_subg']){
				    	echo " selected";
					}
					echo '>'.$dpto['subgerencia'].'</option>';
				}
			?>
			</select>
		</td>
		<td colspan="2">
			<label for="select"> Coordinación:</label>
     			<select id="id_dpto" name="id_dpto">
					<?php
						$sql = "SELECT * FROM coordinacion WHERE id_subg = ".$agentelab['id_subg']." ORDER BY id ASC";
						$sec = consultaSql($sql);
						while($sector = mysqli_fetch_assoc($sec)){
						    echo '<option value="'.$sector['id'].'"';
							if($sector['id'] == $agentelab['id_dpto']){
						    	echo " selected";
							}
							echo '>'.$sector['departamento'].'</option>';
						}
					?>
     			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<label for="select"> Sector:</label>
     			<select id="id_sector" name="id_sector">
					<?php
						$sql = "SELECT * FROM sectores WHERE id_dpto = ".$agentelab['id_dpto']." ORDER BY id ASC";
						$sec = consultaSql($sql);
						while($sector = mysqli_fetch_assoc($sec)){
						    echo '<option value="'.$sector['id'].'"';
							if($sector['id'] == $agentelab['id_sector']){
						    	echo " selected";
							}
							echo '>'.$sector['sector'].'</option>';
						}
					?>
     			</select>		
		</td>
		<td colspan="2">
			Residencia: <label for="select"></label>
			<select name="resid" id="resid">
				<?php
				   	$sql = "SELECT * FROM residencias ORDER BY residencia ASC";
				   	$rsd = consultaSql($sql);
				   	while($resid = mysqli_fetch_assoc($rsd)){
				       	echo '<option value="'.$resid['id'].'"';
					if($resid['id'] == $agentelab['resid']){
						echo " selected";
					}
				   		echo '>'.$resid['residencia'].'</option>';
				   	}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Cat:
			<input name="cat" type="text" id="cat" size="7" value="<?php echo $agentelab['catact'];?>" />
		</td>
		<td>
			Esc:
			<input name="esc" type="text" id="esc" size="7" value="<?php echo $agentelab['escact'];?>" />
			<?php
			if($agentelab['planta'] > 1){
				echo convenio($agentelab['escact'],$agentelab['catact']);
			}
			?>
		</td>
		<td colspan="2">
			<?php 
				if ($agentelab['catact'] > 0) {
					$cat = $agentelab['catact'];
					$esc = $agentelab['escact'];
				 	$sql = "SELECT * FROM nomenclador WHERE esc = '$esc' AND cat = '$cat'";
					$tarea = mysqli_fetch_assoc(consultaSql($sql));
					echo $tarea['desc'];
			    } else {
			?>
			    <input name="desc" type="text" id="desc" size="45" value="<?php echo $agentelab['tarea'];?>" />
			<?php 
			     }
			?>
			
		</td>
	</tr>
	<tr>
		<td colspan="2">Fecha Baja:
			<input name="fbaja" type="date" id="fbaja" size="12"<?php 
				 if ($agentelab['fbaja'] == '') {
				 	echo ' value';
			     } else {
			     	echo ' value="'.$agentelab['fbaja'].'"';
			     }
			    ;?> />
		</td>
		<td colspan="2">Causa Baja:
			<label for="select"></label>
			<select name="cbaja" id="cbaja">
			<?php
				$sql = "SELECT * FROM causa_baja ORDER BY id ASC";
				$baja = consultaSql($sql);
				while($cbaja = mysqli_fetch_assoc($baja)){
				    echo '<option value="'.$cbaja['id'].'"';
					if($cbaja['id'] == $agentelab['cbaja']){
				    	echo " selected";
					}
				    echo '>'.$cbaja['causa_baja'].' '.$cbaja['art'].'</option>';
				}
			?>
			</select>
	    </td>
	</tr>
	<tr>
		<td colspan="4">Observaciones:
			<label for="observaciones"></label>
			<textarea name="observaciones" id="observaciones" cols="95" rows="2"><?php echo $agentelab['observaciones'];?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan="4" align="center">
			<input type="submit" name="log" id="log" value="Guardar Cambios" />
		</td>
	</tr>
	</form>
</table>

<br />

<?php
$sql = "SELECT * FROM agente_gremio WHERE dni = '$du'";
$rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class='personal'>
	<tr>
		<td colspan="5" align="center" bgcolor="#E6E6E6">ESTADO GREMIAL</td>
	</tr>
	<tr bgcolor="#F2F2F2">
		<td>GREMIO</td>
		<td>REPRESENTACION</td>
		<td>F/INICIO</td>
		<td>F/FIN</td>
		<td>FUERO</td>
	</tr>
<?php
$gremio = mysqli_fetch_assoc($rs);
?>
	<form id="gremio" name="gremio" method="post" action="personal/procesos/script.php?edit=gre">
		<tr>
			<td><input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
				<label for="planta"></label>
				<select name="gremio" id="gremio">
				    <option value="0" <?php if($gremio['gremio'] == 0) echo 'selected="selected"'?>>NO REGISTRA</option>
				    <option value="1" <?php if($gremio['gremio'] == 1) echo 'selected="selected"'?>>UNION FERROVIARIA</option>
				    <option value="2" <?php if($gremio['gremio'] == 2) echo 'selected="selected"'?>>LA FRATERNIDAD</option>
				    <option value="3" <?php if($gremio['gremio'] == 3) echo 'selected="selected"'?>>A.P.D.F.A.</option>
				    <option value="4" <?php if($gremio['gremio'] == 4) echo 'selected="selected"'?>>A.S.F.A.</option>
				    <option value="5" <?php if($gremio['gremio'] == 5) echo 'selected="selected"'?>>FUERA DE CONVENIO</option>
				</select>
			</td>
		    <td><input name="representacion" type="text" id="representacion" size="30" value="<?php echo $gremio['representacion']; ?>" /></td>
		    <td><input name="inicio" type="date" id="inicio" size="12" value="<?php echo $gremio['inicio']; ?>" /></td>
		    <td><input name="fin" type="date" id="fin" size="12" value="<?php echo $gremio['fin']; ?>" /></td>
		    <td><input name="fuero" type="date" id="fuero" size="12" value="<?php echo $gremio['fuero']; ?>" /></td>
		</tr>
		<tr>
    		<td colspan="6" align="center"><input type="submit" name="button" id="button" value="Actualizar" /></td>
    	</tr>
	</form>
</table>

<br />

<?php
$sql = "SELECT * FROM agente_historial WHERE dni = '$du' ORDER BY finicio ASC";
$rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class='personal'>
  <tr>
    <td colspan="7" align="center" bgcolor="#E6E6E6">HISTORIAL LABORAL</td>
  </tr>
  <tr bgcolor="#F2F2F2">
    <td>INICIO</td>
    <td>ESCALA</td>
    <td>CATEGORIA</td>
    <td>PUESTO</td>
    <td>TERMINO</td>
    <td>SEC-CTRL</td>
    <td></td>
  </tr>
<?php
while($historial = mysqli_fetch_assoc($rs)){
?>
  <tr>
    <td><?php echo cambioDate($historial['finicio']); ?></td>
    <td><?php echo $historial['esc']; ?></td>
    <td><?php echo $historial['cat']; ?></td>
    <td><?php 
		$cat = $historial['cat'];
		$esc = $historial['esc'];
		$sql = "SELECT * FROM nomenclador WHERE esc = '$esc' AND cat = '$cat'";
		$tarea = mysqli_fetch_assoc(consultaSql($sql));
		echo $tarea['desc'];
	?></td>
    <td><?php
    if($historial['ffin'] == "0000-00-00"){
    echo "Continua";
  } else {
    echo cambioDate($historial['ffin']); 
  }
    ?></td>
    <td><?php
    	if($historial['sectrl'] == ""){
    		echo "NO REGISTRA";
    	} else {
    		echo $historial['sectrl'];
    	}

    ?></td>
    <td><a href="personal/procesos/script.php?edit=hiseli&id=<?php echo $historial['id'];?>&du=<?php echo base64_encode($du)?>"><img src="img/iconos/cancel.png"></a></td>
  </tr>
 <?php
 }
 ?>
  <form id="cargahist" name="cargahist" method="post" action="personal/procesos/script.php?edit=his">
  <tr>
    <td><input type="hidden" name="du" id="du" value="<?php echo $du; ?>" /><input name="finicio" type="date" id="finicio" size="12" placeholder="DD/MM/AAAA" /></td>
      <td><input name="esc" type="text" id="esc" size="12" /></td>
        <td><input name="cat" type="text" id="cat" size="12" /></td>
        <td></td>
        <td><input name="ffin" type="date" id="ffin" size="12" value="0000-00-00" /></td>
        <td><input name="sectrl" type="text" id="sectrl" size="12" placeholder="Ej: 1-0123-2541" /></td>
        <td></td>
    </tr>
    <tr>
      <td colspan="7" align="center"><input type="submit" name="button" id="button" value="Agregar Cargo" /></td>
    </tr>
  </form>
</table>

<br />

<?php
$sql = "SELECT * FROM agente_comision WHERE dni = '$du' ORDER BY desde ASC ";
$rs = consultaSql($sql);
$aux = mysqli_num_rows($rs);
$ctrl = 0;
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class="personal">
  <tr>
    <td colspan="4" align="center"  bgcolor="#E6E6E6" >PASES EN COMISION</td>
  </tr>
  <tr bgcolor="#F2F2F2">
    <td align="center" ><strong>DESCRIPCION</strong></td>
    <td align="center" ><strong>DESDE</strong></td>
    <td align="center" ><strong>HASTA</strong></td>
    <td align="center" ><strong>ESTADO</strong></td>
  </tr>
  <?php
  if($aux > 0){
    while($dato = mysqli_fetch_assoc($rs)){
      if($dato['estado'] == 1){  
      $ctrl = 1;    
    ?>
    <form id="art" name="art" method="post" action="personal/procesos/script.php?edit=com&tarea=act">
    <input type="hidden" name="id" id="id" value="<?php echo $dato['id']; ?>" />
    <input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
    <tr>
      <td align="center" ><input name="descripcion" type="text" id="descripcion" value="<?php echo $dato['descripcion']; ?>" size="85" /></td>
      <td align="center" ><input name="desde" type="date" id="desde" <?php 
				 if ($dato['desde'] == '') {
				 	echo ' value';
			     } else {
			     	echo ' value="'.$dato['desde'].'"';
			     }
			    ;?> size="10" /></td>
      <td align="center" ><input name="hasta" type="date" id="hasta" <?php 
				 if ($dato['hasta'] == '') {
				 	echo ' value';
			     } else {
			     	echo ' value="'.$dato['hasta'].'"';
			     }
			    ;?> size="10" /></td>
      <td align="center" ><input name="estado" id="estado" type="checkbox" /></td>
    </tr>
    <tr>
      <td colspan="4" align="center"><input type="submit" name="button" id="button" value="Actualizar"></td>
    </tr>
    </form>
    <?php
        }else{
    ?>  
    <tr>
      <td align="center" ><?php echo $dato['descripcion']; ?></td>
      <td align="center" ><?php 
      if($dato['desde'] == '0000-00-00') {
        echo $dato['desde'];
      } else {
        echo cambioDate($dato['desde']); 
      }
      ?></td>
      <td align="center" ><?php 
      if($dato['hasta'] == '0000-00-00') {
        echo $dato['hasta'];
      } else {
        echo cambioDate($dato['hasta']); 
      }
      ?></td>
      <td align="center" >Cerrado</td>
    </tr>
      
    <?php
      }
    }
    }
    if($ctrl == 0 && $planta > 0){
    ?>
    <form id="comision" name="comision" method="post" action="personal/procesos/script.php?edit=com&tarea=ins">
    <input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
    <tr>
      <td align="center" ><input name="descripcion" type="text" id="descripcion" value="" size="45" /></td>
      <td align="center" ><input name="desde" type="date" id="desde" size="10" /></td>
      <td align="center" ><input name="hasta" type="date" id="hasta" size="10" /></td>
      <td align="center" ><input name="estado" id="estado" type="checkbox" value="" /></td>
    </tr>
    <tr>
      <td colspan="4" align="center"><input type="submit" name="button" id="button" value="Cargar"></td>
    </tr>
    </form>
 <?php
  }
  ?>
</table>

<br/>

<?php
$sql = "SELECT * FROM agente_irregularidades WHERE dni = '$du' ORDER BY fecha ASC";
$rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class='personal'>
  <tr>
    <td colspan="6" align="center" bgcolor="#E6E6E6">INFRACCIONES Y CASTIGOS</td>
  </tr>
  <tr bgcolor="#F2F2F2">
    <td>FECHA</td>
    <td>IRREGULARIDAD</td>
    <td>ENCUADRE</td>
    <td>I/SANCION</td>
    <td>F/SANCION</td>
    <td>DIAS</td>
  </tr>
<?php
	while($irregularidad = mysqli_fetch_assoc($rs)){
	?>
	  <tr>
	    <td><?php echo cambioDate($irregularidad['fecha']); ?></td>
	    <td><?php echo $irregularidad['irregularidad']; ?></td>
	    <td><?php echo "Articulo N° ".$irregularidad['encuadre']; ?></td>
	    <td><?php
	    if($irregularidad['desde'] == "0000-00-00"){
	    	echo "Apercibido";
	  	} else {
	    	echo cambioDate($irregularidad['desde']); 
	  	}
	    ?></td>
	    <td><?php
	    if($irregularidad['hasta'] == "0000-00-00"){
	    	echo "Apercibido";
		} else {
		  echo cambioDate($irregularidad['hasta']); 
		}
	    ?></td>
	    <td><?php echo dias_transcurridos($irregularidad['desde'],$irregularidad['hasta']); ?> </td>
	  </tr>
	 <?php
	 }
	 if($planta > 0){
 ?>

  <form id="cargairreg" name="cargairreg" method="post" action="personal/procesos/script.php?edit=irr">
  <tr>
    <td><input type="hidden" name="du" id="du" value="<?php echo $du; ?>" /><input name="fecha" type="date" id="fecha" size="12" /></td>
      <td><input name="irregularidad" type="text" id="irregularidad" size="30" /></td>
        <td>
        	<label for="select"></label>
			<select name="encuadre" id="encuadre">
				<?php
				   	$sql = "SELECT id FROM encuadre_irregularidades ORDER BY id ASC";
				   	$rsd = consultaSql($sql);
				   	while($encuadre = mysqli_fetch_assoc($rsd)){
				       	echo '<option value="'.$encuadre['id'].'"';
				   		echo '> Articulo N° '.$encuadre['id'].'</option>';
				   	}
				?>
			</select>
        </td>
        <td><input name="desde" type="date" id="desde" size="30" /></td>
        <td colspan="2"><input name="hasta" type="date" id="hasta" size="12" /></td>
    </tr>
    <tr>
      <td colspan="6" align="center"><input type="submit" name="button" id="button" value="Agregar Irregularidad" /></td>
    </tr>
  </form>
  <?php
	}
	?>
</table>

<br/>

<?php
$sql = "SELECT * FROM agente_certificado_conduccion WHERE dni = '$du' ORDER BY id ASC";
$rst = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class='personal'>
  <tr>
    <td colspan="4" align="center" bgcolor="#E6E6E6">CERTIFICADOS DE CONDUCCION</td>
  </tr>
  
<?php
while($conduccion = mysqli_fetch_assoc($rst)){
?>
	<form id="certcond" enctype="multipart/form-data" name="certcond" method="post" action="personal/procesos/script.php?edit=actcond">
	<tr><input type="hidden" name="id" id="id" value="<?php echo $conduccion['id']; ?>"/><input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
		<td rowspan="3" align="center">
			<?php
				$pathFoto = 'img/cnrt/'.$conduccion['id'].'.jpg';
				if(file_exists($pathFoto))
				{
				?>
					<a href="#" onclick="window.open('<?php echo $pathFoto ?>','CNRT','width =550,height=400');"><img src="<?php echo $pathFoto ?>" width="140" height="84"> </a>
				<?php
				}else{
					echo '<img src="img/cnrt/0.png" width="90" height="72">';
				}
			?>
			<br/><input name="imgcnrt" id="imgcnrt" type="file" />
		</td>
		<td colspan="2">CERTIFICADO 
	    	<label for="select"></label>
		    <select name="tipo" id="tipo">
	    		<?php
		        $sql = "SELECT * FROM certificados_conduccion";
		        $rs = consultaSql($sql);
		        while($ceco = mysqli_fetch_assoc($rs)){
		        echo '<option value="'.$ceco['id'].'"';
		        if($conduccion['tipo'] == $ceco['id']){
		        	echo " selected ";
		        }
		        echo '">'.$ceco['certificado'].'</option>';
		        }
	    ?></select></td>
		<td>CERTIF. N° <input name="numero" type="text" id="numero" size="6" value="<?php echo $conduccion['numero']; ?>" /></td>
		
	</tr>
	  <tr>
	  	<td>F/EMISION <input name="femision" type="date" id="femision" size="8" value="<?php echo $conduccion['femision']; ?>" /></td>
	    <td>F/VENC <input name="fvenc" type="date" id="fvenc" size="8" value ="<?php echo $conduccion['fvenc']; ?>"/></td>
	    
	    <td>
	    	<label for="select"></label>
			<select name="aprobado" id="aprobado">
			    <option value="0"<?php if($conduccion['aprobado'] == 0){ echo " selected"; }?>>SIN TEMA</option>
			    <option value="6"<?php if($conduccion['aprobado'] == 6){ echo " selected"; }?>>TEMA 0</option>
			    <option value="1"<?php if($conduccion['aprobado'] == 1){ echo " selected"; }?>>TEMA 1</option>
			    <option value="2"<?php if($conduccion['aprobado'] == 2){ echo " selected"; }?>>TEMA 2</option>
			    <option value="3"<?php if($conduccion['aprobado'] == 3){ echo " selected"; }?>>TEMA 3</option>
			    <option value="4"<?php if($conduccion['aprobado'] == 4){ echo " selected"; }?>>TEMA 4</option>
			    <option value="5"<?php if($conduccion['aprobado'] == 5){ echo " selected"; }?>>TEMA 5</option>
			    <option value="C"<?php if($conduccion['aprobado'] == C){ echo " selected"; }?>>COMPLETO</option>
			</select>
		</td>
	  </tr>
	  <tr>
	  	<td>ACTA N° <input name="acta" type="text" id="acta" size="4" value="<?php echo $conduccion['acta']; ?>" /></td>
		<td>F/EXAMEN <input name="fecha" type="date" id="fecha" size="8" VALUE="<?php echo $conduccion['fecha']; ?>" /></td>
	    <td>CONCESIONARIO <label for="select"></label>
		        <select name="concesionario" id="concesionario">
		        <option val
		        ue="ue"<?php if($conduccion['concesionario'] == "no"){ echo " selected"; }?>>NO REGISTRA</option>
		        <option value="ue"<?php if($conduccion['concesionario'] == "ue"){ echo " selected"; }?>>U.E.P.F.P.</option>
		        <option value="fa"<?php if($conduccion['concesionario'] == "fa"){ echo " selected"; }?>>FERRO. ARG.</option>
		        <option value="nfa"<?php if($conduccion['concesionario'] == "nfa"){ echo " selected"; }?>>N. FERRO. ARG.</option>
		        <option value="ue"<?php if($conduccion['concesionario'] == "fe"){ echo " selected"; }?>>FEPSA</option>
		        </select></td>
	  </tr>
	  <tr>
	  	<td colspan="4" align="center"><input type="submit" name="button" id="button" value="Actualizar" /></td>
	  </tr>
	  </form>
 <?php
 }
 ?>
  <form id="certcond" enctype="multipart/form-data" name="certcond" method="post" action="personal/procesos/script.php?edit=cond">
  	<tr>
  		<td rowspan="3" align="center"><input name="imgcnrt" id="imgcnrt" type="file" /></td>
  		<td colspan="2">CERTIFICADO 
	    	<input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
	    	<label for="select"></label>
	        <select name="tipo" id="tipo">
	        <?php
	        $sql = "SELECT * FROM certificados_conduccion";
	        $rs = consultaSql($sql);
	        while($ceco = mysqli_fetch_assoc($rs)){
	        echo '<option value="'.$ceco['id'].'">'.$ceco['certificado'].'</option>';
	        }
	        ?>
	    </td>
	    <td>CERTIF. N° <input name="numero" type="text" id="numero" size="6" /></td>
  	</tr>
	<tr>
		<td>F/EMISION <input name="femision" type="date" id="femision" size="8" /></td>
		<td>F/VENC <input name="fvenc" type="date" id="fvenc" size="8" /></td>
		<td>ACTA N° <input name="acta" type="text" id="acta" size="4" /></td>
	</tr>
    <tr>
		<td>APROBADO <label for="select"></label>
	        <select name="aprobado" id="aprobado">
	        <option value="0">SIN TEMA</option>
	        <option value="6">TEMA 0</option>
	        <option value="1">TEMA 1</option>
	        <option value="2">TEMA 2</option>
	        <option value="3">TEMA 3</option>
	        <option value="4">TEMA 4</option>
	        <option value="5">TEMA 5</option>
	        <option value="C">COMPLETO</option>
	        </select>
	    </td>
		<td>F/EXAMEN <input name="fecha" type="date" id="fecha" size="8" /></td>
		<td>CONCESIONARIO 
			<label for="select"></label>
	        <select name="concesionario" id="concesionario">
	        <option value="no">NO REGISTRA</option>
	        <option value="ue">U.E.P.F.P.</option>
	        <option value="fa">FERRO. ARG.</option>
	        <option value="nfa">N. FERRO. ARG.</option>
	        <option value="fe">FEPSA</option>
	        </select>
	    </td>
    </tr>
    <tr>
      <td colspan="4" align="center"><input type="submit" name="button" id="button" value="Agregar Certificado" /></td>
    </tr>
  </form>
</table>

<br/>

<?php
$sql = "SELECT * FROM agente_correo WHERE dni = '$du' ORDER BY id ASC";
$rs = consultaSql($sql);
?>

<table border="1" align="center" cellpadding="0" cellspacing="0" class='personal'>
  <tr>
    <td colspan="6" align="center" bgcolor="#E6E6E6">HISTORIAL CORREO</td>
  </tr>
  <tr bgcolor="#F2F2F2">
  	<td>TIPO</td>
    <td>NUMERO</td>
    <td>FACTURA</td>
    <td>DETALLE</td>
    <td>FECHA</td>
    <td>MOVIMIENTO</td>
  </tr>
  <?php
while($correo = mysqli_fetch_assoc($rs)){
?>
  <tr>
    <td><?php echo $correo['tipo']; ?></td>
    <td><?php echo $correo['numero']; ?></td>
    <td><?php echo $correo['factura']; ?></td>
    <td><?php echo $correo['detalle']; ?></td>
    <td><?php echo cambioDate($correo['fecha']); ?></td>
    <td><?php echo $correo['entsal']; ?></td>
  </tr>
 <?php
 }
 ?>
  <form id="histcorreo" name="histcorreo" method="post" action="personal/procesos/script.php?edit=corr">
  <tr>
  	<td><input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
  		<select name="tipo" id="tipo">
		    <option value="CD" selected="selected">CD</option>
		    <option value="TLC">TLC</option>
		</select>
	</td>
    <td><input name="numero" type="text" id="numero" size="10" maxlength="10" /></td>
    <td><input name="factura" type="text" id="factura" size="10" maxlength="10" /></td>
    <td><input name="detalle" type="text" id="detalle" size="25" maxlength="25" placeholder="MAYUSCULA - MAX 25 CARACTERES" /></td>
    <td><input name="fecha" type="date" id="fecha" size="6" /></td>
    <td>
    	<select name="entsal" id="entsal">
		    <option value="SAL" selected="selected">SALIDA</option>
		    <option value="ENT">ENTRADA</option>
		</select>
    </td>
  </tr>
  <tr>
  	<td colspan="6" align="center"><input type="submit" name="button" id="button" value="Cargar" /></td>
  </tr>
  </form>
</table>

<br/>

<?php
$sql = "SELECT * FROM movimiento_legajo WHERE dni = '$du' ORDER BY fecha ASC";
$rs = consultaSql($sql);
?>

<table border="1" align="center" cellpadding="0" cellspacing="0" class='personal'>
  <tr>
    <td colspan="3" align="center" bgcolor="#E6E6E6">MOVIMIENTOS LEGAJO</td>
  </tr>
  <tr bgcolor="#F2F2F2">
  	<td>DESTINO</td>
    <td>RETIRO</td>
    <td>FECHA</td>
  </tr>
  <?php
while($correo = mysqli_fetch_assoc($rs)){
?>
  <tr>
    <td><?php echo $correo['destino']; ?></td>
    <td><?php echo $correo['retiro']; ?></td>
    <td><?php echo $correo['fecha']; ?></td>
  </tr>
 <?php
 }
 ?>

</table>
<br/><br/><br/><br/>