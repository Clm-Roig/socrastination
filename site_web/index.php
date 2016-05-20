<?php
	session_start();
	if (!isset($_SESSION['pseudo'])) {
		$header=file_get_contents("elements_communs/header2.php");
	}
	else {
		$header=file_get_contents("elements_communs/header3.php");
	}

	$vue=file_get_contents("vues/v_index.html");
	$vue=str_replace("{header}",$header,$vue);
	echo $vue;
?>
		
