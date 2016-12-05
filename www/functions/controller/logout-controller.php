<?php
	// Disconnect
	if (isset($_GET['logout'])){
		$_SESSION['authenticated'] = false;
	}
?>