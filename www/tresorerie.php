<?php
include 'securite.php';
require_once ('PhpRbac/src/PhpRbac/Rbac.php');
use PhpRbac\Rbac;
$rbac = new Rbac();

require_once('connexion.php');
if ($_SESSION['privilege'] != "admin") { header("Location: accueil.php"); }else{ ?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Trésorerie des DPS</title>
		<meta http-equiv="Content-Type" content="text/html">
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	</head>
	<body>
	<?php include 'header.php'; ?>


	<!-- ##########   CODE A SUPPRIMER ############ -->
	<?php 
		$exampleUserID = 7;
		$hasViewDpsPermission=$rbac->check("view-dps", $exampleUserID);
		$hasEditDpsPermission=$rbac->check("edit-dps", $exampleUserID);
		
		if ($hasViewDpsPermission) {
			echo "<center>Brice en a une petite (mais il a le droit de voir les DPS)</center><br />";
		}
		else {
			echo "<center>Pas le droit de voir les DPS</center><br />";
		}
		if ($hasEditDpsPermission) {
			echo "<center>Brice peut éditer les DPS</center><br /><br />";
		}
		else {
			echo "<center>Pas le droit d'éditer un DPS</center><br /><br />";
		}
	?>
	<!-- ##########   CODE A SUPPRIMER ############ -->


	<div class="container">
		<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Liste des Dispositifs Prévisionnels de Secours</h3>
		</div>
		<div class="panel-body">
		<div class="btn-group">
		<div class="dropdown">
			<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				Selection d'une commune
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
			<?php

			if(isset($_GET['commune']) && isset($_GET['filter'])){
			$pagefiltered = "?commune=".$listecommune["numero_commune"]."&filter=".$filter;
			}elseif(isset($_GET['commune']) && !isset($_GET['filter'])){
			$pagefiltered = "?commune=".$listecommune["numero_commune"];
			}elseif(isset($_GET['filter']) && !isset($_GET['commune'])){
			$pagefiltered = "?filter=".$filter;}
			
			$reqliste = "SELECT numero_commune,nom_commune FROM rat_com" or die("Erreur lors de la consultation" . mysqli_error($db_link)); 
			$liste = mysqli_query($db_link, $reqliste);
			while($listecommune = mysqli_fetch_array($liste)) {
			echo "<li><a href='?commune=".$listecommune["numero_commune"]."'>".$listecommune["nom_commune"]."</a></li>";}?>
			</ul>
		</div>
		<div class="dropdown">
			<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				Selection d'un statut
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<?php if(!empty($_GET['commune'])){?>
				<li><a href="<?php echo "?commune=".$_GET['commune'];?>&filter=en-attente">Postes en attente</a></li>
				<li><a href="<?php echo "?commune=".$_GET['commune'];?>&filter=accepted">Postes acceptés</a></li>
				<?php }else{ ?>
				<li><a href="?filter=en-attente">Postes en attente</a></li>
				<li><a href="?filter=accepted">Postes acceptés</a></li>
				<?php } ?>
			</ul>
		</div>
		</div>
		<div class="table-responsive" style="vertical-align: middle;">
		<table class="table table-bordered table-condensed">
			<tr>
				<th>Date</th>
				<th>Antenne</th>
				<th>Description</th>
				<th>Total</th>
				<th>5% ADPC</th>
				<th>9% FNPC</th>
			</tr>
		<?php
		$dpsperpage = 50;
		
		if(!empty($_GET['commune'])){
		$commune = $_GET['commune'];
		}
		if(isset($_GET['filter'])){
		$filter = $_GET['filter'];
		}
		if(!empty($_GET['commune']) && !empty($_GET['filter'])){
		if($filter == "en-attente"){
		$nbquery = "SELECT id, etat_demande_dps, valid_demande_rt FROM demande_dps WHERE commune_ris = $commune AND valid_demande_rt NOT LIKE '0000-00-00' AND valid_demande_dps LIKE '0000-00-00'";}
		if($filter == "accepted"){
		$nbquery = "SELECT id, etat_demande_dps, valid_demande_rt FROM demande_dps WHERE commune_ris = $commune AND valid_demande_dps NOT LIKE '0000-00-00'";}}
		if(empty($_GET['commune']) && isset($_GET['filter'])){
		if($filter == "en-attente"){
		$nbquery = "SELECT id, etat_demande_dps, valid_demande_rt FROM demande_dps WHERE valid_demande_rt NOT LIKE '0000-00-00' AND valid_demande_dps LIKE '0000-00-00'";}
		if($filter == "accepted"){
		$nbquery = "SELECT id, etat_demande_dps, valid_demande_rt FROM demande_dps WHERE valid_demande_dps NOT LIKE '0000-00-00'";}}
		if(isset($_GET['commune']) && empty($_GET['filter'])){
		$nbquery = "SELECT id, etat_demande_dps, valid_demande_rt FROM demande_dps WHERE commune_ris = $commune";}
		if(empty($_GET['commune']) && empty($_GET['filter'])){
		$nbquery = "SELECT id, etat_demande_dps, valid_demande_rt FROM demande_dps";}
		$number_dps = mysqli_query($db_link, $nbquery);
		$row_cnt = mysqli_num_rows($number_dps);
		$numberpages=ceil($row_cnt/$dpsperpage);
		
		if(isset($_GET['page'])){
		$pagecurrent=intval($_GET['page']);
		if($pagecurrent>$numberpages){
		$pagecurrent=$numberpages;}}
		else{
		$pagecurrent=1;}
		$premiereEntree=($pagecurrent-1)*$dpsperpage;
		
		if(!empty($_GET['commune']) && !empty($_GET['filter'])){
		if($filter == "en-attente"){
		$query = "SELECT * FROM demande_dps WHERE valid_demande_rt NOT LIKE '0000-00-00' AND valid_demande_dps LIKE '0000-00-00' AND commune_ris = $commune ORDER BY id DESC LIMIT $premiereEntree, $dpsperpage";}
		if($filter == "accepted"){
		$query = "SELECT * FROM demande_dps WHERE valid_demande_dps NOT LIKE '0000-00-00' AND commune_ris = $commune ORDER BY id DESC LIMIT $premiereEntree, $dpsperpage";}}
		if(!isset($_GET['commune']) && isset($_GET['filter'])){
		if($filter == "en-attente"){
		$query = "SELECT * FROM demande_dps WHERE valid_demande_rt NOT LIKE '0000-00-00' AND valid_demande_dps LIKE '0000-00-00' ORDER BY id DESC LIMIT $premiereEntree, $dpsperpage";}
		if($filter == "accepted"){
		$query = "SELECT * FROM demande_dps WHERE valid_demande_dps NOT LIKE '0000-00-00' ORDER BY id DESC LIMIT $premiereEntree, $dpsperpage";}}
		if(!empty($_GET['commune']) && !isset($_GET['filter'])){
		$query = "SELECT * FROM demande_dps WHERE commune_ris = $commune ORDER BY id DESC LIMIT $premiereEntree, $dpsperpage";}
		if(!isset($_GET['commune']) && !isset($_GET['filter'])){
		$query = "SELECT * FROM demande_dps ORDER BY id DESC LIMIT $premiereEntree, $dpsperpage";}
		
		$listedps_result = mysqli_query($db_link, $query);
		
		while($listedps = mysqli_fetch_array($listedps_result)){
			if($listedps["valid_demande_rt"] == 0 && $listedps["etat_demande_dps"] == "0"){
				$validation=false;
				$validation_ec=false;
				$refus=false;
				$urlform = "edit-dps.php";
				$buttonclass = "btn btn-warning";
				$buttonmessage = "Modifier";
				echo "<tr>";
			}elseif($listedps["valid_demande_rt"] == 0 && $listedps["etat_demande_dps"] == "2"){
				$refus=true;
				$validation=true;
				$validation_ec=false;
				$urlform = "edit-dps.php";
				$buttonclass = "btn btn-danger";
				$buttonmessage = "Modifier";
				echo "<tr class='danger'>";
			}elseif($listedps["etat_demande_dps"] == "1"){
				$validation=true;
				$validation_ec=false;
				$refus=false;
				$urlform = "show-dps.php";
				$buttonclass = "btn btn-success";
				$buttonmessage = "Acceder";
				echo "<tr class='success'>";
			}else{
				$validation=false;
				$validation_ec=true;
				$refus=false;
				$urlform = "show-dps.php";
				$buttonclass = "btn btn-success";
				$buttonmessage = "Acceder";
				echo "<tr class='info'>";
			}
		echo "<td>";
		$date = date_create($listedps["dps_debut_poste"]);
		echo date_format($date, 'd/m/Y');
		echo "</td><td>";
		$pathcode_commune = $listedps["commune_ris"];
		$pathquery = "SELECT nom,numero FROM commune WHERE numero=$pathcode_commune";
		$pathcommune_result = mysqli_query($db_link, $pathquery);
		$pathcommune_array = mysqli_fetch_array($pathcommune_result);
		$pathantenne = $pathcommune_array["nom"];
		echo $pathantenne;
		echo "</td><td>";
		echo $listedps["description_manif"];
		echo "</td><td>";
		$prix = $listedps["prix"];
		echo $prix." €";
		echo "</td><td>";
		if($prix == "0"){
		echo "ADPC €";
		}else{
		$prixadpc = ($prix * (5/100));
		echo $prixadpc." €";
		}
		echo "</td><td>";
		if($prix == "0"){
		echo "FNPC €";
		}else{
		$prixadpc = ($prix * (9/100));
		echo $prixadpc." €";
		}
		echo "</td></tr>";
		}
		?>
		</table>
		<nav>
		<ul class="pagination pagination-sm">
		<?php 
	for($i=1; $i<=$numberpages; $i++){
	?>
			<?php if($i==$pagecurrent){ ?>
			<li class="active"><a href="<?php echo $i; ?>"><?php echo $i; ?> <span class="sr-only">(current)</span></a></li>
		<?php
		}else{
		if(isset($_GET['commune']) && isset($_GET['filter'])){
		$pageget = "?commune=".$commune."&filter=".$filter."&page=".$i;
		}elseif(isset($_GET['commune']) && !isset($_GET['filter'])){
		$pageget = "?commune=".$commune."&page=".$i;
		}elseif(isset($_GET['filter']) && !isset($_GET['commune'])){
		$pageget = "?filter=".$filter."&page=".$i;}else{
		$pageget = "?page=".$i;}
		echo "<li><a href='tresorerie.php".$pageget."'>".$i."</a></li>";
		}}
		?>
		</ul>
	</nav>
		</div>
	</div>
	</div>
	</div>
	<?php } include 'footer.php'; ?>
	</body>
	</html>