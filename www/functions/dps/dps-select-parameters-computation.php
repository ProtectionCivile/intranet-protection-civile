<?php require_once('components/header.php'); ?>

<?php
function get_select_parameters($parameters_query_result_p, $category) {
	if($parameters_query_result_p == null || $category == null  || $category == '' ) {
		return 'Non-défini (paramètres manquants)';
	}
	else {
		while( $parameter = mysqli_fetch_array($parameters_query_result_p)){
			if($category == $parameter['category']){
					$valid_parameters[] = $parameter;
			}
		}
		return $valid_parameters;
	}
}

function get_select_unique_parameter($parameters_query_result_p, $category, $value) {
	if($parameters_query_result_p == null || $category == null  || $category == ''  || $value == null  || $value == '' ) {
		return 'Non-défini (paramètres manquants)';
	}
	else {
		while( $parameter = mysqli_fetch_array($parameters_query_result_p)){
			if($category == $parameter['category'] && $value == $parameter['option_value']){
				return $parameter['option_text'];
			}
		}
		return 'Pas de valeur pour cette clé';
	}
}

?>
