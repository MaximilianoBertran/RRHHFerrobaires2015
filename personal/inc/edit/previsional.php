<br />
<?php
	$sql = "SELECT * FROM agente_previsional WHERE dni = '$du'";
	$laboral = consultaSql($sql);
	$previsional = mysqli_fetch_assoc($laboral);
?>
<table border="1" cellspacing="0" cellpadding="0" align="center" class="personal">
	<form method="post" action="personal/procesos/script.php?edit=prev">
	<tr>
		<td> <input type="hidden" name="du" id="du" value="<?php echo $du; ?>" />
			Estado <label for="estado"></label>
			<select name="estado" id="estado">
			    <option value="0" <?php if($previsional['estado'] == 0) echo 'selected="selected"'?>>0</option>
			    <option value="1" <?php if($previsional['estado'] == 1) echo 'selected="selected"'?>>1</option>
			    <option value="2" <?php if($previsional['estado'] == 2) echo 'selected="selected"'?>>2</option>
			    <option value="3" <?php if($previsional['estado'] == 3) echo 'selected="selected"'?>>3</option>
			    <option value="4" <?php if($previsional['estado'] == 4) echo 'selected="selected"'?>>4</option>
			    <option value="5" <?php if($previsional['estado'] == 5) echo 'selected="selected"'?>>5</option>
			</select>
		</td>
		<td>
			Edad: <?php
			$sql = "SELECT fnac FROM agente_personal WHERE dni = '$du'";
			$edad = mysqli_fetch_assoc(consultaSql($sql));
			 echo edad($edad['fnac']); 
			 ?> AÑOS
		</td>
		<td colspan="2">
			Caja Jubilatoria 
			<select name="caja" id="caja">
			    <option value="0" <?php if($previsional['caja'] == 0) echo 'selected="selected"'?>>NO REGISTRA</option>
			    <option value="1" <?php if($previsional['caja'] == 1) echo 'selected="selected"'?>>IPS</option>
			    <option value="2" <?php if($previsional['caja'] == 2) echo 'selected="selected"'?>>ANSES</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			Aportes Registrados
		</td>
		<td colspan="2" align="center">
			Aportes no Registrados
		</td>
	</tr>
	<?php
		$sql = "SELECT fing FROM agente_laboral WHERE dni = '$du'";
		$aportes = mysqli_fetch_assoc(consultaSql($sql)); 
		if($aportes['fing'] > '1993-12-31'){
			$ips = edad($aportes['fing']);
			$anses = 0;
		} else {
			$ips = edad('1994-01-01');
			$anses = edad($aportes['fing']) - $ips;
		}
	?>
	<tr>
		<td>
			IPS <?php echo $ips; ?> AÑOS
		</td>
		<td>
			ANSES <?php echo $anses; ?> AÑOS
		</td>
		<td>
			IPS <input name="apips" type="text" id="apips" size="7" value="<?php echo $previsional['apips'];?>" />
		</td>
		<td>
			ANSES <input name="apanses" type="text" id="apanses" size="7" value="<?php echo $previsional['apanses'];?>" />
		</td>
	</tr>
	<tr>
		<td colspan="2">
			Tipo 
			<label for="tipo"></label>
			<select name="tipo" id="tipo">
			    <option value='nr' <?php if($previsional['tipo'] == 'nr') echo 'selected="selected"'?>>NO REGISTRA</option>
			    <option value='sf' <?php if($previsional['tipo'] == 'sf') echo 'selected="selected"'?>>SIN DEFINIR</option>
			    <option value='ea' <?php if($previsional['tipo'] == 'ea') echo 'selected="selected"'?>>EDAD AVANZADA</option>
			    <option value='or' <?php if($previsional['tipo'] == 'or') echo 'selected="selected"'?>>ORDINARIA</option>
			    <option value='es' <?php if($previsional['tipo'] == 'es') echo 'selected="selected"'?>>ESPECIAL</option>
			    <option value='rp' <?php if($previsional['tipo'] == 'rp') echo 'selected="selected"'?>>REG.PRESTACION</option>
			</select>
		</td>
		<td colspan="2">
			Modalidad 
			<label for="art"></label>
			<select name="art" id="art">
			    <option value="0" <?php if($previsional['modalidad'] == 0) echo 'selected="selected"'?>>NO REGISTRA</option>
			    <option value="24" <?php if($previsional['modalidad'] == 24) echo 'selected="selected"'?>>Art. 24 Dec. Ley 9650/80</option>
			    <option value="35" <?php if($previsional['modalidad'] == 35) echo 'selected="selected"'?>>Art. 35 Dec. Ley 9650/80</option>
			    <option value="252" <?php if($previsional['modalidad'] == 252) echo 'selected="selected"'?>>Art. 252 Ley 20744</option>
			    <option value="302" <?php if($previsional['modalidad'] == 302) echo 'selected="selected"'?>>Decreto 302</option>

			</select>
		</td>
	</tr>
	<tr>
		
		<td colspan="2">
			Expte. Interno
			<input name="exp" type="text" id="exp" size="15" value="<?php echo $previsional['exp'];?>" />
		</td>
		<td>
			Inicio Expte. Int.
			<input name="inicio" type="date" id="inicio" size="2" <?php
           	if ($previsional['inicio'] == '0000-00-00') {
           	} else {
            echo ' value="'.$previsional['inicio'].'"';
        };?> />
		</td>
		<td>
			C.Computo
			<input name="cierre" type="date" id="cierre" size="2" <?php
           	if ($previsional['cierre'] == '0000-00-00') {
           	} else {
            echo ' value="'.$previsional['cierre'].'"';
        };?> />
		</td>
	</tr>
	<tr>
		<td colspan="4">
			Detalle Interno
			<label for="detalle"></label>
			<textarea name="detalle" id="detalle" cols="95" rows="2"><?php echo $previsional['detalle'];?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			MODALIDAD NOTIFICACION 
			<label for="notif"></label>
			<select name="notif" id="notif">
			    <option value="0" <?php if($previsional['notif'] == 0) echo 'selected="selected"'?>>NO REGISTRA</option>
			    <option value="1" <?php if($previsional['notif'] == 1) echo 'selected="selected"'?>>MEMO</option>
			    <option value="2" <?php if($previsional['notif'] == 2) echo 'selected="selected"'?>>CD</option>
			</select>

		</td>
		<td>
			F/PREAVISO
			<input name="preaviso" type="date" id="preaviso" size="2" <?php
           	if ($previsional['preaviso'] == '0000-00-00') {
           	} else {
            echo ' value="'.$previsional['preaviso'].'"';
        };?> />
		</td>
		<td>
			
		</td>
	</tr>
	<tr>
		<td colspan="2">
			Expte. Jub.
			<input name="expips" type="text" id="expips" size="15" value="<?php echo $previsional['expips'];?>" />
		</td>
		<td>
			F/Inicio 
			<input name="inicioips" type="date" id="inicioips" size="2" <?php
           	if ($previsional['inicioips'] == '0000-00-00') {
           	} else {
            echo ' value="'.$previsional['inicioips'].'"';
        };?> />
		</td>
		<td>
			Solicitud Cert. 
			<input name="solcert" type="date" id="solcert" size="2" <?php
           	if ($previsional['solcert'] == '0000-00-00') {
           	} else {
            echo ' value="'.$previsional['solcert'].'"';
        };?> />
		</td>
	</tr>
	<tr>
		<td colspan="4">
			Detalle Jub.
			<label for="detalleips"></label>
			<textarea name="detalleips" id="detalleips" cols="95" rows="2"><?php echo $previsional['detalleips'];?></textarea>
		</td>
	</tr>	
	<tr>
		<td colspan="4" align="center">
			CERTIFICADOS
		</td>
	</tr>
	<tr>
		<td>
			Cert. 80
			<label for="c80"></label>
			<select name="c80" id="c80">
			    <option value="0" <?php if($previsional['c80'] == 0) echo 'selected="selected"'?>>NO SOLICITADO</option>
			    <option value="1" <?php if($previsional['c80'] == 1) echo 'selected="selected"'?>>EN PROCESO</option>
			    <option value="2" <?php if($previsional['c80'] == 2) echo 'selected="selected"'?>>EN BANCO</option>
			    <option value="3" <?php if($previsional['c80'] == 3) echo 'selected="selected"'?>>LISTO</option>
			    <option value="4" <?php if($previsional['c80'] == 4) echo 'selected="selected"'?>>ENTREGADO</option>
			</select>
		</td>
		<td>
			C.Servicios
			<label for="servicios"></label>
			<select name="servicios" id="servicios">
			    <option value="0" <?php if($previsional['servicios'] == 0) echo 'selected="selected"'?>>NO SOLICITADO</option>
			    <option value="1" <?php if($previsional['servicios'] == 1) echo 'selected="selected"'?>>EN PROCESO</option>
			    <option value="2" <?php if($previsional['servicios'] == 2) echo 'selected="selected"'?>>EN BANCO</option>
			    <option value="3" <?php if($previsional['servicios'] == 3) echo 'selected="selected"'?>>LISTO</option>
			    <option value="4" <?php if($previsional['servicios'] == 4) echo 'selected="selected"'?>>ENTREGADO</option>
			</select>
		</td>
		<td>
			Cert.Computo
			<label for="computo"></label>
			<select name="computo" id="computo">
			    <option value="0" <?php if($previsional['computo'] == 0) echo 'selected="selected"'?>>NO SOLICITADO</option>
			    <option value="1" <?php if($previsional['computo'] == 1) echo 'selected="selected"'?>>EN PROCESO</option>
			    <option value="2" <?php if($previsional['computo'] == 2) echo 'selected="selected"'?>>EN BANCO</option>
			    <option value="3" <?php if($previsional['computo'] == 3) echo 'selected="selected"'?>>LISTO</option>
			    <option value="4" <?php if($previsional['computo'] == 4) echo 'selected="selected"'?>>ENTREGADO</option>
			</select>
		</td>
		<td>
			P.Haberes
			<label for="haberes"></label>
			<select name="haberes" id="haberes">
			    <option value="0" <?php if($previsional['haberes'] == 0) echo 'selected="selected"'?>>NO SOLICITADO</option>
			    <option value="1" <?php if($previsional['haberes'] == 1) echo 'selected="selected"'?>>EN PROCESO</option>
			    <option value="2" <?php if($previsional['haberes'] == 2) echo 'selected="selected"'?>>EN BANCO</option>
			    <option value="3" <?php if($previsional['haberes'] == 3) echo 'selected="selected"'?>>LISTO</option>
			    <option value="4" <?php if($previsional['haberes'] == 4) echo 'selected="selected"'?>>ENTREGADO</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="4" align="center">
			<input type="submit" name="log" id="log" value="Guardar Cambios" />
		</td>
	</tr>
</form>
</table>