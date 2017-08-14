
<?php
	$tmp_file = $_FILES['mainfile']['tmp_name'];
	$filename = $_FILES['mainfile']['name'];
	$num_cu = $_POST['yearly_index'];
	if($num_cu < 10){
		$num_cu = "00".$num_cu;
	}
	elseif($num_cu < 100){
		$num_cu = "0".$num_cu;
	}
	$cu = $_POST['unique_certificate_full'];
	$type = $_POST['type'];
	$antenne = $_POST['section'];
	$year = $_POST['year'];

	$path_parts = pathinfo($filename);
	if($path_parts['extension'] != "pdf"){
		exit;
	}


	if($type == 'convention'){
		$filename = $cu."-CONV.pdf";
	}
	elseif($type == 'risk'){
		$filename = $cu."-RISK.pdf";
	}
	elseif($type == 'demande'){
		$filename = $cu."-DEM.pdf";
	}

	if($type == "other") {
		$pathuntilyear = dirname(__DIR__).'../../documents_dps/'.$year;
		$pathuntilcity = $pathuntilyear.'/'.$antenne;
		$pathtocu = $pathuntilcity.'/'.$num_cu;
		$pathtocreate = $pathtocu.'/autre';
		$filepath = $pathtocreate.'/'.$filename;
		$path = dirname(__DIR__)."/documents_dps/".$year."/".$antenne."/".$num_cu."/autre/";
		$pathtocreate = "../documents_dps/$year/$antenne/$num_cu/autre/";
		$security = fopen("../../documents_dps/$year/index.html","w");
		fclose($security);
		$security = fopen("../../documents_dps/$year/$antenne/index.html","w");
		fclose($security);
		$security = fopen("../../documents_dps/$year/$antenne/$num_cu/index.html","w");
		fclose($security);
		$security = fopen("../../documents_dps/$year/$antenne/$num_cu/autre/index.html","w");
		fclose($security);
		if ( ! is_dir($pathuntilyear)) {
		    mkdir($pathuntilyear, 0755, true);
		}
		if ( ! is_dir($pathuntilcity)) {
		    mkdir($pathuntilcity, 0755, true);
		}
		if ( ! is_dir($pathtocu)) {
		    mkdir($pathtocu, 0755, true);
		}
		if ( ! is_dir($pathtocreate)) {
		    mkdir($pathtocreate, 0755, true);
		}
		if (file_exists($filepath)) {
        unlink($filepath);
    }
	}
	else {
		$pathuntilyear = dirname(__DIR__).'../../documents_dps/'.$year;
		$pathuntilcity = $pathuntilyear.'/'.$antenne;
		$pathtocreate = $pathuntilcity.'/'.$num_cu;
		$filepath = $pathtocreate.'/'.$filename;
		$security = fopen("../../documents_dps/$year/index.html","w");
		fclose($security);
		$security = fopen("../../documents_dps/$year/$antenne/index.html","w");
		fclose($security);
		$security = fopen("../../documents_dps/$year/$antenne/$num_cu/index.html","w");
		fclose($security);
		if ( ! is_dir($pathuntilyear)) {
		    mkdir($pathuntilyear, 0755, true);
		}
		if ( ! is_dir($pathuntilcity)) {
		    mkdir($pathuntilcity, 0755, true);
		}
		if ( ! is_dir($pathtocreate)) {
		    mkdir($pathtocreate, 0755, true);
		}
		if (file_exists($filepath)) {
        unlink($filepath);
    }
	}
	move_uploaded_file($tmp_file, $filepath);
	$data['status'] = 'done';
  echo json_encode($data);


?>
