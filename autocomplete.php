
<?php
@ require 'inc/functions.php';
@ require 'inc/const.php';
	class BuscarUsuarios{
		var $devolver = array();
		public function __construct($user){
			$devolver = array();
			$sql = "SELECT agente, dni FROM agente_laboral WHERE agente LIKE '%$user%'";
			$query = consultaSql($sql);
			while($row = mysqli_fetch_array($query, MYSQL_ASSOC)){
				$row['agente'] = $row['agente'].' '.$row['dni'];
				$this->devolver[] = array("value" => $row['agente']);
			}
		}
	}

	$us = new BuscarUsuarios($_GET['term']);
	echo json_encode($us->devolver);

?>