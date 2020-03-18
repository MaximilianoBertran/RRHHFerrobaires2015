<?php
session_start(); 
@ require '../../inc/functions.php';
@ require '../../inc/const.php';
if(date('Y-m-d') < VENCIMIENTO){
if(isset($_GET['edit']) && isset($_SESSION['dni'])){
	extract($_POST);
	$usuedit = $_SESSION['id'];
	$fedit = date('Y-m-d');
	$link = @ mysqli_connect(SERVER, USER, PASSWORD, BASE);
	$check = 0;
	switch ($_GET['edit']){
		case "lab":
			$dni = base64_encode($du);
			if($planta == 0){
				$sql = "UPDATE agente_historial SET ffin='$fbaja' WHERE dni='$du' AND ffin = '0000-00-00' OR dni='$du' AND ffin IS NULL";
				$ctrl = mysqli_query($link, $sql);
			}
			$sql = "UPDATE agente_laboral SET planta='$planta', agente='$agente', cuil='$cuil', efect='$efect', fing='$fing', nacion='$nacion', id_sector='$id_sector', id_dpto='$id_dpto',id_subg='$id_subg',  resid='$resid', escact='$esc', catact='$cat', tarea='$desc', fbaja='$fbaja', cbaja='$cbaja', ncarnet='$ncarnet', observaciones='$observaciones', fedit='$fedit', usuedit='$usuedit' WHERE dni='$du'";
			$ctrl = mysqli_query($link, $sql);
			if($ctrl){
				$check = "6";
			} else {
				$check = "0";
			}
			break;
		case "prev":
			$dni = base64_encode($du);
			$sql = "UPDATE agente_previsional SET agente_previsional.estado = '$estado',agente_previsional.caja = '$caja',agente_previsional.apips = '$apips',agente_previsional.apanses = '$apanses',agente_previsional.tipo = '$tipo',agente_previsional.art = '$art',agente_previsional.cierre = '$cierre',agente_previsional.exp = '$exp',agente_previsional.inicio = '$inicio',agente_previsional.detalle = '$detalle',agente_previsional.expips = '$expips',agente_previsional.inicioips = '$inicioips',agente_previsional.detalleips = '$detalleips',agente_previsional.solcert = '$solcert',agente_previsional.c80 = '$c80',agente_previsional.notif = '$notif',agente_previsional.preaviso = '$preaviso',agente_previsional.servicios = '$servicios',agente_previsional.computo = '$computo',agente_previsional.haberes = '$haberes',agente_previsional.usuedit = '$usuedit',agente_previsional.fedit = '$fedit' WHERE agente_previsional.dni='$du'";
			$ctrl = mysqli_query($link, $sql);
			if($ctrl){
				$check = "39&js=pv";
			} else {
				$check = "0&js=pv";
			}
			break;
		case "per":
			$dni = base64_encode($du);
			if(isset($siape))
				$siape = 1;
			$titulo = strtoupper($titulo);
			$sql = "UPDATE agente_personal SET sexo='$sexo', domicilio='$domicilio', localidad='$localidad', cp='$cp', pcia='$pcia', fnac='$fnac', estcivil='$estcivil', estudios='$estudios', titulo='$titulo', prenatal='$prenatal', email='$email', telefono='$telefono', act = '$act', siape='$siape', fedit='$fedit', usuedit='$usuedit' WHERE dni='$du'";
			$ctrl = mysqli_query($link, $sql);
			if($ctrl){
				$check = "10&js=pe";
			} else {
				$check = "0&js=pe";
			}
			break;
		case "his":
			$dni = base64_encode($du);
			if($finicio != ''){
				$cierre = date("Y-m-d", strtotime("$finicio  -1 day"));
			}
			$sql = "UPDATE agente_historial SET ffin = '$cierre' WHERE dni = '$du' AND ffin = '0000-00-00' AND finicio < '$finicio'";
			mysqli_query($link, $sql);
			$sql = "INSERT INTO agente_historial (dni, finicio, esc, cat, ffin, sectrl) VALUES ('$du', '$finicio', '$esc', '$cat', '$ffin', '$sectrl')";
			$query = mysqli_query($link, $sql);
			if($query){
				$check = "7";
			} else {
				$check = "0";
			}
			break;
		case "art":
			$dni = base64_encode($du);
			if(isset($alta))
				$alta = 1;
			else
				$alta = 0;
			if($_GET['tarea'] == 'act'){
				$sql = "UPDATE agente_medico SET desde='$desde', hasta = '$hasta', aa050='$aa050', alta='$alta', observaciones='$observaciones', fedit='$fedit', usuedit='$usuedit' WHERE dni='$du' AND alta='0000-00-00' AND tipo=1";
				$query = mysqli_query($link, $sql);
				if($query){
					$check = "21&js=md";
				} else {
					$check = "0&js=md";
				}
			} else if($_GET['tarea'] == 'ins'){
				$sql = "INSERT INTO agente_medico (dni, desde, hasta, aa050, alta, observaciones, tipo, fedit, usuedit) VALUES ('$du','$desde', '$hasta', '$aa050', '$alta', '$observaciones', 1, '$fedit', '$usuedit' )";
				$query = mysqli_query($link, $sql);
				if($query){
					$check = "22&js=md";
				} else {
					$check = "0&js=md";
				}
			}
			break;
		case "enf":
			$dni = base64_encode($du);
			if(isset($alta))
				$alta = 1;
			else
				$alta = 0;
			if($_GET['tarea'] == 'act'){
				$sql = "UPDATE agente_medico SET desde='$desde', hasta = '$hasta', aa050='$aa050', alta='$alta', observaciones='$observaciones', fedit='$fedit', usuedit='$usuedit' WHERE dni='$du' AND alta='0000-00-00' AND tipo=0";
				$query = mysqli_query($link, $sql);
				if($query){
					$check = "19&js=md";
				} else {
					$check = "0&js=md";
				}
			} else if($_GET['tarea'] == 'ins'){
				$sql = "INSERT INTO agente_medico (dni, desde, hasta, aa050, alta, observaciones, tipo, fedit, usuedit) VALUES ('$du','$desde', '$hasta', '$aa050', '$alta', '$observaciones', 0, '$fedit', '$usuedit' )";
				$query = mysqli_query($link, $sql);
				if($query){
					$check = "20&js=md";
				} else {
					$check = "0&js=md";
				}
			}
			break;
		case "med":
			$dni = base64_encode($du);
			if(isset($jpi))
				$jpi = 1;
			else
				$jpi = 0;
			if(isset($checkapip))
				$checkapip = 1;
			else
				$checkapip = 0;

			$sql = "UPDATE agente_estado_medico SET jpi = '$jpi', checkapip = '$checkapip' , apip = '$apip', apipinfo = '$apipinfo', pf = '$pf', reclamopf = '$reclamopf', cert = '$cert', fedit='$fedit', usuedit='$usuedit' WHERE dni='$du'";
			$query = mysqli_query($link, $sql);
			if($query){
				$check = "16&js=md";
			} else {
				$check = "0&js=md";
			}
			break;
		case "tlt":
			$dni = base64_encode($du);
			if(isset($alta))
				$alta = 1;
			else
				$alta = 0;
			if($_GET['tarea'] == 'act'){
				$sql = "UPDATE agente_medico SET desde='$desde', hasta = '$hasta', aa050='', alta='$alta', observaciones='$observaciones', fedit='$fedit', usuedit='$usuedit' WHERE dni='$du' AND alta='0000-00-00' AND tipo=3";
				$query = mysqli_query($link, $sql);
				if($query){
					$check = "17&js=md";
				} else {
					$check = "0&js=md";
				}
			} else if($_GET['tarea'] == 'ins'){
				$sql = "INSERT INTO agente_medico (dni, desde, hasta, aa050, alta, observaciones, tipo, fedit, usuedit) VALUES ('$du','$desde', '$hasta', '', '$alta', '$observaciones', 3, '$fedit', '$usuedit' )";
				$query = mysqli_query($link, $sql);
				if($query){
					$check = "18&js=md";
				} else {
					$check = "0&js=md";
				}
			}
			break;
		case "cony":
			$dni = base64_encode($du);
			$sql = "SELECT dnititular FROM agente_conyuge WHERE dnititular = '$du'";
			$consu = mysqli_query($link, $sql);
			$aux = mysqli_num_rows($consu);
			if(isset($ioma))
				$ioma = 1;
			else
				$ioma = 0;
			if($_GET['tarea'] == 'eli'){
				$due = base64_decode($_GET['du']);
				$dni = $_GET['du'];
				$sql = "DELETE FROM agente_conyuge WHERE dnititular = '$due'";
				$ctrl = mysqli_query($link, $sql);
				if($ctrl){
					$check = "13&js=pe";
				} else {
					$check = "0&js=pe";
				}
			} else {
				if($aux >= 1){
					$sql = "UPDATE agente_conyuge SET apeynom='$apeynom', dni = '$dnic', fnac='$fnac', act='$act', fenl='$fenl', ioma='$ioma', observaciones='$observaciones', fedit='$fedit', usuedit='$usuedit' WHERE dnititular = '$du'";
					$query = mysqli_query($link, $sql);
					if($query){
						$check = "11&js=pe";
					} else {
						$check = "0&js=lb";
					}
				} else {
					$sql = "INSERT INTO agente_conyuge (apeynom, dni, fnac, act, fenl, ioma, observaciones, dnititular, fedit, usuedit) VALUES ('$apeynom', '$dnic', '$fnac', '$act', '$fenl', '$ioma', '$observaciones', '$du', '$fedit', '$usuedit')";
					$query = mysqli_query($link, $sql);
					if($query){
						$check = "12&js=pe";
					} else {
						$check = "0&js=pe";
					}
				}
			}
			break;
		case "cerest":
			$due = base64_decode($_GET['du']);
			$dni = $_GET['du'];
			$year = date('Y');
			$sql ="INSERT INTO agente_cert_lic_estudio (dni, year) VALUES ('$due', '$year')";
			$query = mysqli_query($link, $sql);
			if($query){
				$check = "42&js=lc";
			} else {
				$check = "0&js=lc";
			}
			break;
		case "hijo":
			$dni = base64_encode($du);
			if(isset($ioma)){
				$ioma = 1;
			}else{
				$ioma = 0;
			}
			if(isset($especial)){
				$especial = 1;
			}else{
				$especial = 0;
			}
			if(isset($disc)){
				$disc = 1;
			}else{
				$disc = 0;
			}
			if(isset($asigna)){
				$asigna = 1;
			}else{
				$asigna = 0;
			}
			if($grado == ""){
				$grado = 0;
			}
			
			if($_GET['tarea'] == 'act'){
				$sql = "UPDATE agente_hijos SET apeynom='$apeynom', dni='$dnih', fnac='$fnac', vinculo='$vinculo', nivel='$nivel', grado='$grado',  especial='$especial', disc='$disc', discvenc='$discvenc', ioma='$ioma', clinicio='$clinicio', clfinal='$clfinal', observaciones='$observaciones', fedit='$fedit', usuedit='$usuedit', asigna='$asigna' WHERE dni='$dnih'";
				$query = mysqli_query($link, $sql);
				if($query){
					$check = "14&js=pe";
				} else {
					$check = "0&js=pe";
				}
			} else if($_GET['tarea'] == 'ins'){
				$sql ="INSERT INTO agente_hijos (apeynom, dni, fnac, vinculo, disc, discvenc, nivel, grado, especial, asigna, ioma, clinicio, clfinal, observaciones, dnititular, fedit, usuedit) VALUES ('$apeynom','$dnih', '$fnac', '$vinculo', '$disc', '$discvenc', '$nivel', '$grado', '$especial', '$asigna', '$ioma', '$clinicio', '$clfinal', '$observaciones', '$du', '$fedit', '$usuedit')";
				$query = mysqli_query($link, $sql);
				if($query){
					$check = "15&js=pe";
				} else {
					$check = "0&js=pe";
				}
			}
			break;
		case "migh":
			$dni = $_GET['dni'];
			$dnih = $_GET['dnih'];
			$sql = "UPDATE agente_hijos SET  dnititular = '$dni' WHERE dni='$dnih'";
			$query = mysqli_query($link, $sql);
			if($query){
				$check = "38&js=pe";
				$dni = base64_encode($_GET['du']);
			} else {
				$check = "0&js=pe";
				$dni = base64_encode($_GET['du']);
			}
			break;
		case "lic":
			$dni = base64_encode($du);
			$dias = dias_transcurridos($desde, $hasta);

			if($tipolic == 0 && $year < 2016){
				$sql = "SELECT * FROM agente_licencia WHERE dni = '$du' AND year = '$year'";
				$sr = mysqli_fetch_assoc(mysqli_query($link, $sql));
				$dias = $sr['dias'] - $dias;
				if($dias < 1){
					$sql = "DELETE FROM agente_licencia WHERE dni='$du' AND year='$year'";
					mysqli_query($link, $sql);
				} else {
					$sql = "UPDATE agente_licencia SET dias='$dias' WHERE dni='$du' AND year='$year'";
					mysqli_query($link, $sql);
				}
			} else if($tipolic == 0 && $year > 2015){
				$sql = "SELECT * FROM agente_licencia WHERE dni = '$du' AND year = '$year'";
				$sr = mysqli_fetch_assoc(mysqli_query($link, $sql));
				if($sr['dias'] == 0){
					$sql = "SELECT planta, fing, efect FROM agente_laboral WHERE dni = '$du'";
					$agente = mysqli_fetch_assoc(mysqli_query($link, $sql));
				    if($agente['efect'] < '2012-01-01' && $agente['planta'] == 2){
				        $antig = antig_licencia($agente['efect']);
				    } else {
				        $antig = antig_licencia($agente['fing']);
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
				    $sql = "UPDATE agente_licencia SET dias='$dias' WHERE dni='$du' AND year='$year'";
					mysqli_query($link, $sql);
				}
			}
			$sql ="INSERT INTO agente_historial_licencia (dni, desde, hasta, tipo, year, fedit, usuedit) VALUES ('$du', '$desde', '$hasta', '$tipolic', '$year', '$fedit', '$usuedit')";
			$query = mysqli_query($link, $sql);
			if($query){
				$check = "23&js=lc";
			} else {
				$check = "0&js=lc";
			}
			break;
		case "liceli":
			if(isset($_GET['id'])){
				$dni = $_GET['du'];
				$id = $_GET['id'];
				$sql = "DELETE FROM agente_historial_licencia WHERE id='$id'";
				$query = mysqli_query($link, $sql);
			}
			if($query){
				$check = "26&js=lc";
			} else {
				$check = "0&js=lc";
			}
			break;
		case "liceli":
			if(isset($_GET['id'])){
				$dni = $_GET['du'];
				$id = $_GET['id'];
				$sql = "DELETE FROM agente_historial_licencia WHERE id='$id'";
				$query = mysqli_query($link, $sql);
			}
			if($query){
				$check = "44&js=lc";
			} else {
				$check = "0&js=lc";
			}
			break;
		case "enfeli":
			if(isset($_GET['id'])){
				$dni = $_GET['du'];
				$id = $_GET['id'];
				$sql = "DELETE FROM agente_medico WHERE id='$id'";
				$query = mysqli_query($link, $sql);
			}
			if($query){
				$check = "43&js=md";
			} else {
				$check = "0&js=md";
			}
			break;
		case "esteli":
			if(isset($_GET['du']) && isset($_GET['year'])){
				$dni = $_GET['du'];
				$du = base64_decode($dni);
				$year = $_GET['year'];
				$sql = "DELETE FROM agente_cert_lic_estudio WHERE dni='$du' AND year='$year'";
				$query = mysqli_query($link, $sql);
			}
			if($query){
				$check = "44&js=lc";
			} else {
				$check = "0&js=lc";
			}
			break;
		case "hiseli":
			if(isset($_GET['id'])){
				$dni = $_GET['du'];
				$id = $_GET['id'];
				$sql = "DELETE FROM agente_historial WHERE id='$id'";
				$query = mysqli_query($link, $sql);
			}
			if($query){
				$check = "40";
			} else {
				$check = "0";
			}
			break;
		case "emb":
			$dni = base64_encode($du);
			if($tipo == 0){
				$sql = "SELECT id FROM agente_embargo WHERE dni = '$du' AND estado = 1 AND tipo = 0 ";
				$sr = mysqli_num_rows(mysqli_query($link, $sql));
				if($sr > 0){
					$estado = 2;
				} else {
					$estado = 1;
				}
			} else {
				$estado = 1;
			}
			$sql ="INSERT INTO agente_embargo (dni, descripcion, tipo, monto, estado, fedit, usuedit) VALUES ('$du', '$descripcion', '$tipo', '$monto', '$estado', '$fedit', '$usuedit')";
			$query = mysqli_query($link, $sql);
			if($query){
				$check = "24&js=jd";
			} else {
				$check = "0&js=jd";
			}
			break;
		case "embpag":
			$dni = base64_encode($du);
			if($embpag > 0){
				$sql ="INSERT INTO agente_descuento_embargo (id_embargo, mes, monto, comision) VALUES ('$embpag', '$mes', '$monto', 0)";
				$query = mysqli_query($link, $sql);
				if($query){
					$check = "27&js=jd";
				} else {
					$check = "0&js=jd";
				}
			}
			break;
		case "irr":
			$dni = base64_encode($du);
			$sql ="INSERT INTO agente_irregularidades (dni, fecha, irregularidad, encuadre, desde, hasta) VALUES ('$du', '$fecha', '$irregularidad', '$encuadre', '$desde', '$hasta')";
			$query = mysqli_query($link, $sql);
			if($query){
				$check = "31";
			} else {
				$check = "0";
			}
			break;
		case "cond":
			$sql ="SELECT id FROM agente_certificado_conduccion ORDER BY id DESC limit 1";
			$query = mysqli_query($link, $sql);
			$consulta = mysqli_fetch_assoc($query);
			$id = $consulta['id']+1;
			if($_FILES['imgcnrt']['name']){
				$target_path = "../../img/cnrt/".$id.".jpg";
				move_uploaded_file($_FILES['imgcnrt']['tmp_name'], $target_path);
			}
			$dni = base64_encode($du);
			$sql ="INSERT INTO agente_certificado_conduccion (id, dni, tipo, numero, aprobado, femision, fvenc, acta, fecha, concesionario, fedit, usuedit) VALUES ('$id', '$du', '$tipo', '$numero', '$aprobado', '$femision', '$fvenc', '$acta', '$fecha', '$concesionario', '$fedit', '$usuedit')";
			$query = mysqli_query($link, $sql);
			if($query){
				$check = "32";
			} else {
				$check = "0";
			}
			break;
		case "actcond":
			$dni = base64_encode($du);
			if($_FILES['imgcnrt']['name']){
				$target_path = "../../img/cnrt/".$id.".jpg";
				if(file_exists($target_path)){
					unlink("../../img/cnrt/".$id.".jpg");
				}
				move_uploaded_file($_FILES['imgcnrt']['tmp_name'], $target_path);
			}
			$sql ="UPDATE agente_certificado_conduccion SET tipo = '$tipo', numero = '$numero', aprobado = '$aprobado', femision = '$femision', fvenc = '$fvenc', acta = '$acta', fecha = '$fecha', concesionario = '$concesionario', fedit = '$fedit', usuedit = '$usuedit' WHERE id = '$id'";
			$query = mysqli_query($link, $sql);
			if($query){
				$check = "32";
			} else {
				$check = "0";
			}
			break;
		case "finemb":
			$dni = base64_encode($du);
			$sql = "UPDATE agente_embargo SET estado = 0, observaciones = '$observaciones' WHERE id='$idembargo'";
			$query = mysqli_query($link, $sql);
			$sql = "SELECT id FROM agente_embargo WHERE dni = '$du' AND estado = 2";
			$rs = mysqli_query($link, $sql);
			if(mysqli_num_rows($rs) > 0){
				$aux = mysqli_fetch_assoc($rs);
				$id = $aux['id'];
				$sql = "UPDATE agente_embargo SET estado = 1 WHERE id='$id'";
				$query = mysqli_query($link, $sql);
			}
			if($query){
				$check = "25&js=jd";
			} else {
				$check = "0&js=jd";
			}
			break;
		case "gre":
			$dni = base64_encode($du);
			$query = mysqli_query($link, $sql);
			$sql = "UPDATE agente_gremio SET gremio = '$gremio', representacion = '$representacion', inicio = '$inicio', fin = '$fin', fuero = '$fuero', fedit='$fedit', usuedit='$usuedit' WHERE dni = '$du'";
			$query = mysqli_query($link, $sql);
			if($query){
				$check = "35";
			} else {
				$check = "0";
			}
			break;
		case "com":
			$dni = base64_encode($du);
			if($desde != ''){
				$desde = reCambioDate($desde);
			}
			if($hasta != ''){
				$hasta = reCambioDate($hasta);
			}
			if(isset($estado)){
				$estado = 0;
			}else{
				$estado = 1;
			}
			if($_GET['tarea'] == 'act'){
				$sql = "UPDATE agente_comision SET descripcion = '$descripcion', desde = '$desde', hasta = '$hasta', estado = '$estado', fedit='$fedit', usuedit='$usuedit' WHERE id='$id'";
				$query = mysqli_query($link, $sql);
				if($query){
					$check = "8&js=lb";
				} else {
					$check = "0&js=lb";
				}
			} else if($_GET['tarea'] == 'ins'){
				$sql ="INSERT INTO agente_comision (dni, descripcion, desde, hasta, estado, fedit, usuedit) VALUES ( '$du', '$descripcion', '$desde', '$hasta', '$estado', '$fedit', '$usuedit')";
				$query = mysqli_query($link, $sql);
				if($query){
					$check = "9&js=lb";
				} else {
					$check = "0&js=lb";
				}
			}
			break;
		case "leg":
			$dni = base64_encode($du);
			$salida = ereg_replace("[ ]", "", $salida);
			$entrada = ereg_replace("[ ]", "", $entrada);
			if($salida != '0000-00-00'){
				$salida = reCambioDate($salida);
			}
			if($entrada != '0000-00-00'){
				$entrada = reCambioDate($entrada);
			}
			if($_GET['tarea'] == 'act'){
				$sql = "UPDATE registro_legajo SET entrada='$entrada', fedit='$fedit', usuedit='$usuedit' WHERE id='$id'";
				$query = mysqli_query($link, $sql);
			} else if($_GET['tarea'] == 'ins'){
				$sql ="INSERT INTO registro_legajo (entrada, agente, salida, fedit, usuedit) VALUES ( '$entrada', '$agente', '$salida', '$fedit', '$usuedit')";
				$query = mysqli_query($link, $sql);
			}
			break;
		case "corr":
			$dni = base64_encode($du);
			$fecha = ereg_replace("[ ]", "", $fecha);
			if($fecha != '0000-00-00'){
				$fecha = reCambioDate($fecha);
			}
			$sql ="INSERT INTO agente_correo (tipo, numero, factura, detalle, fecha, entsal, dni, fedit, usuedit) VALUES ( '$tipo', '$numero', '$factura', '$detalle', '$fecha', '$entsal', '$du', '$fedit', '$usuedit')";
			$query = mysqli_query($link, $sql);
			if($query){
				$check = "33";
			} else {
				$check = "0";
			}
			break;
		default:
			header("Location: ../../index.php?sector=personal&du=".$dni."&check=".$check);
			break;
	}
	mysqli_close($link);
	header("Location: ../../index.php?sector=personal&du=".$dni."&check=".$check);
}
}
?>