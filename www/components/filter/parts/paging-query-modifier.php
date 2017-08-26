<?php

	$sqlQuery_query = mysqli_query($db_link, $sqlQuery);
	$nb_elements = mysqli_num_rows($sqlQuery_query);

	$nb_pages=ceil($nb_elements/$nb_elements_per_page);

	if($current_page>$nb_pages){
		$current_page=$nb_pages;
	}

	require_once('functions/paging-filtering-functions.php');

	if ($nb_pages > 1) {
		$addLimit = true;
		$premiereEntree=($current_page-1)*$nb_elements_per_page;
		$limit = "LIMIT ".$premiereEntree.", ".$nb_elements_per_page;

		if ($current_page > $nb_pages) {
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
