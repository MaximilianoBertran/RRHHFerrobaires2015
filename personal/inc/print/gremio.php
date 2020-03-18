<?php
$sql = "SELECT * FROM agente_gremio WHERE dni = '$du'";
$rs = consultaSql($sql);
?>
<table border="1" align="center" cellpadding="0" cellspacing="0" class='ficha'>
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
	<tr>
		<td>
		<?php 
			switch ($gremio['gremio']) {
				case 0:
					echo "NO REGISTRA";
					break;
				case 1:
					echo "UNION FERROVIARIA";
					break;
				case 2:
					echo "LA FRATERNIDAD";
					break;
				case 3:
					echo "A.P.D.F.A.";
					break;
				case 4:
					echo "A.S.F.A.";
					break;
				case 5:
					echo "FUERA DE CONVENIO";
					break;
			}
		?>
		</td>
	    <td><?php echo $gremio['representacion']; ?></td>
	    <td><?php echo $gremio['inicio']; ?></td>
	    <td><?php echo $gremio['fin']; ?></td>
	    <td><?php echo $gremio['fuero']; ?></td>
	</tr>
</table>