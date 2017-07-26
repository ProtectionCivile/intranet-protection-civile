<?php
	if(isset($_POST['formnbelementsperpage']) && !empty($_POST['formnbelementsperpage']) ){
		$nb_elements_per_page=intval($_POST['formnbelementsperpage']);
	}
	else {
		$nb_elements_per_page="25";
	}

	if(isset($_POST['formcurrentpage'])){
		$current_page=intval($_POST['formcurrentpage']);
	}
	else{
		$current_page=1;
	}
?>