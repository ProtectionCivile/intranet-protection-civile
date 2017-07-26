<?php 
	
	$org_id="";
	if(isset($_POST['org_id'])){
		$org_id = $_POST['org_id'];
		$sql = "SELECT * FROM $tablename_clients WHERE id=$org_id";
		$query = mysqli_query($db_link, $sql);
		$client_array = mysqli_fetch_array($query);
	}

	$duplicate_dps="";
	if(isset($_POST['duplicate_dps'])){
		$duplicate_dps_id = $_POST['duplicate_dps'];
		$sql = "SELECT * FROM $tablename_dps WHERE id=$duplicate_dps_id";
		$query = mysqli_query($db_link, $sql);
		$duplicated_dps_array = mysqli_fetch_array($query);
	}
?>