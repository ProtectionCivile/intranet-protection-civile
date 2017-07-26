<?php
include 'securite.php';
require_once('connexion.php');
if ($_SESSION['privilege'] != "admin") { header("Location: accueil.php"); }else{ ?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Liste des organisateurs</title>
		<meta http-equiv="Content-Type" content="text/html";>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	</head>
	<body>
	<?php include 'header.php'; ?>
	<div class="container">
	<?php
	if(isset($_POST["id"])){
	$id = $_POST["id"];
	$query = "DELETE FROM organisateurs WHERE id='$id'";
	mysqli_query($db_link,$query);
	echo "<div class='alert alert-success' role='alert'>";
	echo "Organisateur supprimé avec succès";
	echo "</div>";
	};
	?>
	<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Liste des organisateurs</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
		<table class="table table-bordered table-condensed">
			<tr>
				<th>Commune</th>
				<th>Référence interne</th>
				<th>Nom de l'organisation</th>
				<th>Représentant</th>
				<th>Modifier</th>
				<th>Supprimer</th>
			</tr>
			<?php
			$query = "SELECT * FROM organisateurs ORDER BY id ASC";
			$listeorganisateurs_result = mysqli_query($db_link, $query);
			while($listeorganisateurs = mysqli_fetch_array($listeorganisateurs_result)){
			echo "<tr><td>";
			$num_commune = $listeorganisateurs["commune"];
			$commune_query = "SELECT numero_commune,nom_commune FROM rat_com WHERE numero_commune=$num_commune";
			$commune_result = mysqli_query($db_link, $commune_query);
			$commune = mysqli_fetch_array($commune_result);
			echo $commune["nom_commune"];
			
			
			echo "</td><td>";
			echo $listeorganisateurs["ref"];
			echo "</td><td>";
			echo $listeorganisateurs["nom"];
			echo "</td><td>";
			echo $listeorganisateurs["represente"];
			echo "</td><td>";
			?>
			<form role="form" action="edit-organisateur.php" method="post">
			<?php
			echo "<input type='hidden' name='id' value='".$listeorganisateurs["id"]."'>";
			echo "<button type='submit' class='btn btn-warning'>Modifier</button></form>";
			echo "</td><td>";
			?>
			<form role="form" action="" method="post">
			<?php
			echo "<input type='hidden' name='id' value='".$listeorganisateurs["id"]."'>";
			echo "<button type='submit' class='btn btn-danger'>Supprimer</button></form>";
			echo "</td>";
			echo "</tr>";
			}
			?>
		</table>
		</div>
		</div>
			<div class="panel-footer"><a class="btn btn-default" role="button" href="add-organisateur.php">Ajouter un organisateur</a></div>
		</div>
	</div>
	</div>
	</div>
	<?php } include 'footer.php'; ?>
	</body>
	</html>