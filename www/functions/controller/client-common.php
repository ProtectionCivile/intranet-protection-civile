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
		$check_query = "SELECT * FROM $tablename_clients WHERE id='$id'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
		$verif = mysqli_query($db_link, $check_query);
		$client = mysqli_fetch_assoc($verif);
	 	$clientCount = mysqli_num_rows($verif);
		if (!$clientCount){
			$genericError = "Le client en question n'existe pas";
		}
	}

	if(empty($genericError)) {
		$client_id = str_replace("'","", $client['id']);
		$client_name = str_replace("'","", $client['name']);
		$client_ref = str_replace("'","", $client['ref']);
		$client_represent = str_replace("'","", $client['represent']);
		$client_title = str_replace("'","", $client['title']);
		$client_address = str_replace("'","", $client['address']);
		$client_phone = str_replace("'","", $client['phone']);
		$client_fax = str_replace("'","", $client['fax']);
		$client_email = str_replace("'","", $client['email']);
		$attached_section = str_replace("'","", $client['attached_section']);
	}
?>
