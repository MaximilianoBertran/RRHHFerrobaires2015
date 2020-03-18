<?php
	$sql = "SELECT * FROM agente_laboral WHERE dni = '$du'";
	$laboral = consultaSql($sql);
	$agentelab = mysqli_fetch_assoc($laboral);
?>
<table border="1" cellspacing="0" cellpadding="0" align="center" class="ficha">
	<tr>
		<td>
			Agente: <?php echo strtoupper($agentelab['agente']);?>
		</td>
		<td>
			DNI: <?php echo $agentelab['dni'];?>
		</td>
		<td>
			CUIL: <?php echo $agentelab['cuil'];?>
		</td>
		<td rowspan="3" scope="col" align="center">
			<?php
				$pathFoto = '../../img/personal/'.$du.'.jpg';
				if(file_exists($pathFoto))
				{
					echo '<img src="'.$pathFoto.'" width="90" height="72">'; 
				}else{
					echo '<img src="../../img/personal/0.png" width="90" height="72">';
				}
			?>
		</td>
	</tr>
	<tr>
		<td>
			Legajo:  <?php echo $agentelab['legajo'];?>
		</td>
		<td>
			Carnet: <?php echo $agentelab['ncarnet'];?>
		</td>
		<td>
			PLANTA: <?php 
				switch ($agentelab['planta']) {
					case 1:
						echo "FUERA CCT";
						break;
					case 2:
						echo "EFECTIVO";
						break;
					case 3:
						echo "NACION";
						break;
					default:
						echo "BAJA";
						break;
				}
			?>
		</td>
	</tr>
	<tr>
		
		<td>
			F/ing: <?php
			     if ($agentelab['fing'] == '0000-00-00') {
			     	echo "NO REGISTRA";
			     } else {
			     	echo cambioDate($agentelab['fing']);
				};?>
		</td>
		<td>
			F/efec: <?php
				 if ($agentelab['efect'] == '0000-00-00') {
			     	echo "NO REGISTRA";
			     } else {
			     	echo cambioDate($agentelab['efect']);
			     }
			    ;?>
			    <?php
			    	$decreto = traerDecreto($agentelab['efect']);
			    	echo $decreto;
			    ?>
		</td>
		<td>
			Traspaso a Nacion: <?php
				 if ($agentelab['nacion'] == '0000-00-00') {
			     	echo "NO REGISTRA";
			     } else {
			     	echo cambioDate($agentelab['nacion']);
			     }
			    ;?>

		</td>
	</tr>
	<tr>
		<td colspan="2">
			Subgerencia: 
				<?php
					$id_subg = $agentelab['id_subg'];
				   	$sql = "SELECT * FROM subgerencias WHERE id_subg='$id_subg'";
				   	$rsd = consultaSql($sql);
				   	$resid = mysqli_fetch_assoc($rsd);
					echo $resid['subgerencia'];
				?>
			</select>
		</td>
		<td colspan="2">
			Coordinacion: 
				<?php
					$id_dpto = $agentelab['id_dpto'];
				   	$sql = "SELECT * FROM coordinacion WHERE id='$id_dpto'";
				   	$rsd = consultaSql($sql);
				   	$resid = mysqli_fetch_assoc($rsd);
					echo $resid['departamento'];
				?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			Sector: 
				<?php
					$id_sector = $agentelab['id_sector'];
				    $sql = "SELECT * FROM sectores WHERE id='$id_sector'";
				   	$rsd = consultaSql($sql);
				   	$resid = mysqli_fetch_assoc($rsd);
					echo $resid['sector'];
				?>
		</td>

		<td colspan="2">
			Residencia: 
				<?php
					$resid = $agentelab['resid'];
				   	$sql = "SELECT * FROM residencias WHERE id='$resid'";
				   	$rsd = consultaSql($sql);
				   	$resid = mysqli_fetch_assoc($rsd);
					echo $resid['residencia'];
				?>
		</td>
	</tr>
	<tr>
		<td>
			Cat:
			<?php echo $agentelab['catact'];?>
		</td>
		<td>
			Esc:
			<?php echo $agentelab['escact'];?>
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
					echo $agentelab['tarea'];
				}
			?>
		</td>
	</tr>
	<tr>
		<td colspan="2">Fecha Baja:
			<?php 
				if ($agentelab['fbaja'] == '0000-00-00') {
			    	echo "NO REGISTRA";
			    } else {
			    	echo cambioDate($agentelab['fbaja']);
			    }
			;?>
		</td>
		<td colspan="2">Causa Baja:
			<?php
				$sql = "SELECT * FROM causa_baja ORDER BY id ASC";
				$baja = consultaSql($sql);
				while($cbaja = mysqli_fetch_assoc($baja)){
					if($cbaja['id'] == $agentelab['cbaja']){
				    	echo $cbaja['causa_baja'];
					}
				}
			?>
	    </td>
	</tr>
	<tr>
		<td colspan="4">Observaciones:
			<?php echo $agentelab['observaciones'];?>
		</td>
	</tr>
</table>