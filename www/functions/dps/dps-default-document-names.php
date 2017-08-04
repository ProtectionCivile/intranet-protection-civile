<?php

$query = "SELECT * FROM $tablename_settings_general WHERE name LIKE 'dps-doc-suffix-convention'";
$query_result = mysqli_query($db_link, $query);
$dps_doc_names = mysqli_fetch_assoc($query_result);
$dps_doc_suffix_convention = $dps_doc_names['value'];

$query = "SELECT * FROM $tablename_settings_general WHERE name LIKE 'dps-doc-suffix-risk'";
$query_result = mysqli_query($db_link, $query);
$dps_doc_names = mysqli_fetch_assoc($query_result);
$dps_doc_suffix_risk = $dps_doc_names['value'];

$query = "SELECT * FROM $tablename_settings_general WHERE name LIKE 'dps-doc-suffix-demande'";
$query_result = mysqli_query($db_link, $query);
$dps_doc_names = mysqli_fetch_assoc($query_result);
$dps_doc_suffix_demande = $dps_doc_names['value'];

$query = "SELECT * FROM $tablename_settings_general WHERE name LIKE 'dps-doc-suffix-declaration'";
$query_result = mysqli_query($db_link, $query);
$dps_doc_names = mysqli_fetch_assoc($query_result);
$dps_doc_suffix_declaration = $dps_doc_names['value'];

?>
