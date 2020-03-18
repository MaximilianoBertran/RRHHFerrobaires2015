<?php 
if($_SESSION['personal'] == 1){
	echo '<div class="botsec"><a href="?sector=personal"><p>Personal</p></a></div><br />';
} else {
	echo '<div class="botsecd"><p>Personal</p></div><br />';
}
if($_SESSION['archivo'] == 1){
	echo '<div class="botsec"><a href="index.php?sector=archivo"><p>Archivo</p></a></div><br />';
} else {
	echo '<div class="botsecd"><p>Archivo</p></div><br />';
}
if($_SESSION['sanidad'] == 1){
	echo '<div class="botsec"><a href="?sector=sanidad"><p>Sanidad</p></a></div><br />';
} else {
	echo '<div class="botsecd"><p>Sanidad</p></div><br />';
}
if($_SESSION['sumarios'] == 1){
	echo '<div class="botsec"><a href="?sector=sumarios"><p>Sumarios</p></a></div><br />';
} else {
	echo '<div class="botsecd"><p>Sumarios</p></div><br />';
}
?>
<div class="botsec"><a href="index.php?sector=perfil"><p>Perfil</p></a></div><br />
<div class="botsec"><a href="procesos/logout.php"><p>Salir</p></a></div><br />