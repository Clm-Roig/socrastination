<?php 
	session_start();
	require ("config.php");
	$vue = file_get_contents("vues/v_interfacearbitre.html");
	echo $vue;
?>
