<?php
	if (isset($_POST['id'])) {
		$id = str_replace("'","", $_POST['id']);
	}
	else if (isset($_GET['id'])) {
		$id = str_replace("'","", $_GET['id']);
	}

	if($id == ""){
		$genericError = "Aucun client défini";
	}
	else {
		$sql = "SELECT * FROM $tablename_clients WHERE id='$id'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
		$query = mysqli_query($db_link, $sql);
		$client = mysqli_fetch_assoc($query);
	 	$clientCount = mysqli_num_rows($query);
		if (!$clientCount){
			$genericError = "Le client en question n'existe pas";
		}
	}

	if(empty($genericError)) {
		$client_id = $client['id'];
		$client_name = $client['name'];
		$client_ref = $client['ref'];
		$client_represent = $client['represent'];
		$client_title = $client['title'];
		$client_address = $client['address'];
		$client_phone = $client['phone'];
		$client_fax = $client['fax'];
		$client_email = $client['email'];
		$attached_section = $client['attached_section'];
	}
?>
