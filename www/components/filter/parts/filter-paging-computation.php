<?php
	if(isset($_SESSION['nb_elements_per_page']) && !empty($_SESSION['nb_elements_per_page']) ){
		$_SESSION['nb_elements_per_page']=intval($_SESSION['nb_elements_per_page']);
	}
	else {
		$_SESSION['nb_elements_per_page']="25";
	}

	if(isset($_SESSION['current_page'])){
		$_SESSION['current_page']=intval($_SESSION['current_page']);
	}
	else{
		$_SESSION['current_page']=1;
	}
?>
