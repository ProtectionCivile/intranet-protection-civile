<?php

	$sqlQuery_query = mysqli_query($db_link, $sqlQuery);
	$nb_elements = mysqli_num_rows($sqlQuery_query);

	$nb_pages=ceil($nb_elements/$_SESSION['nb_elements_per_page']);

	if($_SESSION['current_page']>$nb_pages){
		$_SESSION['current_page']=$nb_pages;
	}

	require_once('functions/paging-filtering-functions.php');

	if ($nb_pages > 1) {
		$addLimit = true;
		$premiereEntree=($_SESSION['current_page']-1)*$_SESSION['nb_elements_per_page'];
		$limit = "LIMIT ".$premiereEntree.", ".$_SESSION['nb_elements_per_page'];

		if ($_SESSION['current_page'] > $nb_pages) {
			reset_currrent_page();
		}
	}
	else {
		reset_currrent_page();
	}

	if (isset($addLimit) && $addLimit) {
		$sqlQuery = $sqlQuery." ".$limit;
	}

	$sqlQuery_query = mysqli_query($db_link, $sqlQuery);


?>
