<?php
	$cu_year = date("y");
	$dept = "92";

	$query_code = "SELECT shortname FROM $tablename_sections WHERE number=$city";
	$code_result = mysqli_query($db_link, $query_code);
	$code_array = mysqli_fetch_array($code_result);
	$code_commune = $code_array['shortname'];
	mysqli_free_result($code_result);

	$query_cu = "SELECT cu_yearly_index FROM $tablename_dps WHERE cu_year=$cu_year AND section=$city ORDER BY id DESC LIMIT 1";
	$cu_result = mysqli_query($db_link, $query_cu);
	$cu_array = mysqli_fetch_array($cu_result);
	$cu_yearly_index = $cu_array['cu_yearly_index'];
	$cu_yearly_index = $cu_yearly_index + 1;
	if($cu_yearly_index < 10){
		$cu_yearly_index = "00".$cu_yearly_index;
	}
	elseif($cu_yearly_index < 100){
		$cu_yearly_index = "0".$cu_yearly_index;
	}

	$cu_full = $dept."-".$cu_year."-".$code_commune."-".$cu_yearly_index;

?>
