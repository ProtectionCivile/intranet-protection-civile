<?php
$parameters_query = "SELECT category, option_value, option_text FROM $tablename_select_list_parameters" or die("Erreur lors de la consultation" . mysqli_error($db_link));
$parameters_query_result = mysqli_query($db_link, $parameters_query);
?>
