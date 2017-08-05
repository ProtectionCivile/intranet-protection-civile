<?php

	$tmp_file = $_FILES['image']['tmp_name'];
	$filename = $_FILES['image']['name'];
	$year = date("Y");

	move_uploaded_file($tmp_file, 'documents_dps/'.$year.'/'.$filename);

?>