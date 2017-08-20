<?php require_once('functions/dps/dps-default-document-names.php'); ?>
<?php require_once('functions/dps/dps-compute-city.php'); ?>
<?php require_once('functions/dps/dps-compute-variables.php'); ?>

<?php
$pathyear = "20".$cu_year;
$pathquery = "SELECT shortname, number FROM $tablename_sections WHERE number=".$dps['section'];
$pathcommune_result = mysqli_query($db_link, $pathquery);
$pathcommune_array = mysqli_fetch_array($pathcommune_result);
$pathantenne = $pathcommune_array["shortname"];
$cu_yearly_index = intval($cu_yearly_index, 10);

if($cu_yearly_index < 10){
  $cu_yearly_index = "00".$cu_yearly_index;
}
elseif($cu_yearly_index < 100){
  $cu_yearly_index = "0".$cu_yearly_index;
}

$pathfile = "documents_dps/".$pathyear."/".$pathantenne."/".$cu_yearly_index;

$pathfileconvention = $pathfile."/".$cu_full."-".$dps_doc_suffix_convention.".pdf";
$pathfilerisk = $pathfile."/".$cu_full."-".$dps_doc_suffix_risk.".pdf";
$pathfiledemande = $pathfile."/".$cu_full."-".$dps_doc_suffix_demande.".pdf";

$fileconvention = file_exists($pathfileconvention);
$filerisk = file_exists($pathfilerisk);
$filedemande = file_exists($pathfiledemande);

?>
