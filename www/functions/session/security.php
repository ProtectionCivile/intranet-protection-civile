<?php
	session_start(); // On relaye la session
	if (isset($_SESSION['authenticated'])) { 
	}
	else {
		header("Location: login.php?notallowed");
		exit();
	}
?>