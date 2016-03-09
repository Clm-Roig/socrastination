<?php

session_start();
session_unset ();

// On détruit notre session
session_destroy ();
header('Location: index.php');
exit;


?>