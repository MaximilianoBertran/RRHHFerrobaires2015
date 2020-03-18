<?php
if(isset($_GET['check'])){
	switch ($_GET['check']) {
		case 0:
			echo "<br /><div class='rojo'>ACCION FALLIDA, VUELVA A INTENTARLO. SI EL ERROR PERSISTE REPORTELO.</div>";
			break;
		case 1:
			echo "<br /><div class='check'>LEGAJO GENERADO CORRECTAMENTE, INGRESE EN CONSULTA CON EL DNI Y REALICE LA CARGA DE DATOS.</div>";
			break;
		case 2:
			echo "<br /><div class='check'>LEGAJO NO GENERADO, INGRESE EN CONSULTA CON EL DNI O VUELVA A INTENTARLO.</div>";
			break;
		case 3:
			echo "<br /><div class='check'>ARCHIVO CARGADO CORRECTAMENTE.</div>";
			break;
		case 4:
			echo "<br /><div class='check'>HUBO PROBLEMAS AL INTENTAR CARGAR EL ARCHIVO.</div>";
			break;
		case 5:
			echo "<br /><div class='check'>MOVIMIENTO DE LEGAJO CARGADO CORRECTAMENTE.</div>";
			break;
		case 6:
			echo "<br /><div class='check'>PLANTILLA LABORAL ACTUALIZADA.</div>";
			break;
		case 7:
			echo "<br /><div class='check'>NUEVO CARGO AÑADIDO CORRECTAMENTE.</div>";
			break;
		case 8:
			echo "<br /><div class='check'>PASE EN COMISION ACTUALIZADO CORRECTAMENTE.</div>";
			break;
		case 9:
			echo "<br /><div class='check'>PASE EN COMISION AÑADIDO CORRECTAMENTE.</div>";
			break;
		case 10:
			echo "<br /><div class='check'>PLANTILLA PERSONAL ACTUALIZADA.</div>";
			break;
		case 11:
			echo "<br /><div class='check'>INFORMACION DE CONYUGE ACTUALIZADA.</div>";
			break;
		case 12:
			echo "<br /><div class='check'>AÑADIDA INFORMACION DE CONYUGE CORRECTAMENTE.</div>";
			break;
		case 13:
			echo "<br /><div class='check'>CONYUGE ELIMINADO.</div>";
			break;
		case 14:
			echo "<br /><div class='check'>INFORMACION DE MENOR A CARGO ACTUALIZADA.</div>";
			break;
		case 15:
			echo "<br /><div class='check'>MENOR A CARGO AÑADIDO CORRECTAMENTE.</div>";
			break;
		case 16:
			echo "<br /><div class='check'>PLANTILLA MEDICA ACTUALIZADA.</div>";
			break;
		case 17:
			echo "<br /><div class='check'>INFORME DE T.L.T. ACTUALIZADO.</div>";
			break;
		case 18:
			echo "<br /><div class='check'>INFORME DE T.L.T. AÑADIDO.</div>";
			break;
		case 19:
			echo "<br /><div class='check'>INFORME DE ENFERMEDAD ACTUALIZADO.</div>";
			break;
		case 20:
			echo "<br /><div class='check'>INFORME DE ENFERMEDAD AÑADIDO.</div>";
			break;
		case 21:
			echo "<br /><div class='check'>INFORME DE ART ACTUALIZADO.</div>";
			break;
		case 22:
			echo "<br /><div class='check'>INFORME DE ART AÑADIDO.</div>";
			break;
		case 23:
			echo "<br /><div class='check'>REGISTRO DE LICENCIA AÑADIDO.</div>";
			break;
		case 24:
			echo "<br /><div class='check'>REGISTRO DE EMBARGO AÑADIDO.</div>";
			break;
		case 25:
			echo "<br /><div class='check'>EMBARGO FINALIZADO.</div>";
			break;
		case 26:
			echo "<br /><div class='check'>LICENCIA ELIMINADA CORRECTAMENTE.</div>";
			break;
		case 27:
			echo "<br /><div class='check'>PAGO CARGADO CORRECTAMENTE.</div>";
			break;
		case 28:
			echo "<br /><div class='check'>NUEVO AGENTE GENERADO.</div>";
			break;
		case 29:
			echo "<br /><div class='check'>EXCEL ART 80 CARGADO.</div>";
			break;
		case 30:
			echo "<br /><div class='check'>EXCEL CARGADO.</div>";
			break;
		case 31:
			echo "<br /><div class='check'>IRREGULARIDAD CARGADA CORRECTAMENTE.</div>";
			break;
		case 32:
			echo "<br /><div class='check'>CERTIFICADO DE CONDUCCION CARGADO CORRECTAMENTE.</div>";
			break;
		case 33:
			echo "<br /><div class='check'>MOVIMIENTO POSTAL CARGADO CORRECTAMENTE.</div>";
			break;
		case 34:
			echo "<br /><div class='check'>CERTIFICADO DE CONDUCCION ACTUALIZADO CORRECTAMENTE.</div>";
			break;
		case 35:
			echo "<br /><div class='check'>REGISTRO GREMIAL ACTUALIZADA.</div>";
			break;
		case 36:
			echo "<br /><div class='check'>REGISTRO 80 CARGADO CORRECTAMENTE.</div>";
			break;
		case 37:
			echo "<br /><div class='check'>REGISTRO DE ENTRADAS CARGADO CORRECTAMENTE.</div>";
			break;
		case 38:
			echo "<br /><div class='check'>HIJO TRANSFERIDO CORRECTAMENTE.</div>";
			break;
		case 39:
			echo "<br /><div class='check'>SITUACION PREVISIONAL ACTUALIZADA CORRECTAMENTE.</div>";
			break;
		case 40:
			echo "<br /><div class='check'>HISTORIAL ELIMINADO CORRECTAMENTE.</div>";
			break;
		case 41:
			echo "<br /><div class='check'>DNI INGRESADO NO CORRESPONDE A UN AGENTE REGISTRADO.</div>";
			break;
		case 42:
			echo "<br /><div class='check'>CERTIFICADO DE ESTUDIO PERIODO ".date('Y')." CARGADO CORRECTAMENTE.</div>";
			break;
		case 43:
			echo "<br /><div class='check'>HISTORIAL MEDICO ELIMINADO CORRECTAMENTE.</div>";
			break;
		case 44:
			echo "<br /><div class='check'>CERTIFICACION LICENCIA POR ESTUDIO ELIMINADO CORRECTAMENTE.</div>";
			break;
	}
}
?>