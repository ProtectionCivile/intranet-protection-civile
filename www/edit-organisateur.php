<?php require_once('functions/session/security.php'); ?>
<?php include('components/header.php'); ?>
<?php


if(isset($_POST["insert"])){
$commune = $_POST["commune"];
$ref_interne = $_POST["ref_interne"];
$nom_organisation = $_POST["nom_organisation"];
$represente_par = $_POST["represente_par"];
$qualite = $_POST["qualite"];
$adresse = $_POST["adresse"];
$telephone = $_POST["telephone"];
$fax = $_POST["fax"];
$email = $_POST["email"];
$query = "INSERT INTO organisateurs (commune,ref,nom,represente,qualite,adresse,telephone,fax,email)
VALUES (\"$commune\",\"$ref_interne\",\"$nom_organisation\",\"$represente_par\",\"$qualite\",\"$adresse\",\"$telephone\",\"$fax\",\"$email\")";
mysqli_query($link,$query);
$query = "SELECT * FROM organisateurs WHERE ref=\"$ref_interne\"";
$result = mysqli_query($link,$query);
$organisateur = mysqli_fetch_array($result);
$success_insert = "Organisateur ajouté avec succès";
}elseif(isset($_POST["update"])){
	
$id = $_POST["id"];
$commune = $_POST["commune"];
$ref_interne = $_POST["ref_interne"];
$nom_organisation = $_POST["nom_organisation"];
$represente_par = $_POST["represente_par"];
$qualite = $_POST["qualite"];
$adresse = $_POST["adresse"];
$telephone = $_POST["telephone"];
$fax = $_POST["fax"];
$email = $_POST["email"];
$query = "UPDATE organisateurs SET commune=\"$commune\",ref=\"$ref_interne\",nom=\"$nom_organisation\",represente=\"$represente_par\",qualite=\"$qualite\",adresse=\"$adresse\",telephone=\"$telephone\",fax=\"$fax\",email=\"$email\" WHERE id=\"$id\"";
mysqli_query($link,$query);
$query = "SELECT * FROM organisateurs WHERE id=\"$id\"";
$result = mysqli_query($link,$query);
$organisateur = mysqli_fetch_array($result);
$success_update = "Organisateur mis à jour avec succès";
}else{
	
$id = $_POST["id"];
$query = "SELECT * FROM organisateurs WHERE id=\"$id\"";
$result = mysqli_query($link,$query);
$organisateur = mysqli_fetch_array($result);
}

$id = $organisateur["id"];
$commune = $organisateur["commune"];
$ref_interne = $organisateur["ref"];
$nom_organisation = $organisateur["nom"];
$represente_par = $organisateur["represente"];
$qualite = $organisateur["qualite"];
$adresse = $organisateur["adresse"];
$telephone = $organisateur["telephone"];
$fax = $organisateur["fax"];
$email = $organisateur["email"];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Modification d'un organisateur</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container">
<?php if (!empty($success_insert)){
					echo "<div class='alert alert-success' role='alert'>";
					echo $success_insert;
					echo "</div>";
				}
				if (!empty($success_update)){
					echo "<div class='alert alert-success' role='alert'>";
					echo $success_update;
					echo "</div>";
				}
?>
			<h2>Modification d'un organisateur</h2>
			
			<form class="form-horizontal" role="form" action="edit-organisateur.php" method="post">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Organisateur : N°<?php echo $id;?></h3>
					</div>
				<div class="panel-body">
					<div class="form-group form-group-sm">
						<label for="commune" class="col-sm-4 control-label">Commune  <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Commune concernée par cet organisateur"></span></label>
						<div class="col-sm-8">
							<select class="form-control" id="commune" name="commune">
								<?php
								$listecommune_query = "SELECT numero_commune, nom_commune FROM rat_com";
								$listecommune_result = mysqli_query($link, $listecommune_query);
								while($listecommune = mysqli_fetch_array($listecommune_result)){
								if($listecommune["numero_commune"] == $commune){
								echo "<option value='".$listecommune["numero_commune"]."' selected>".$listecommune["nom_commune"]."</option>";
								}else{
								echo "<option value='".$listecommune["numero_commune"]."'>".$listecommune["nom_commune"]."</option>";
								}}
								?>
							</select>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="ref_interne" class="col-sm-4 control-label">Référence interne <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Référence interne. Exemple : Mairie Pantin - Mr Dupont"></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="ref_interne" name="ref_interne" placeholder="Référence interne" value="<?php echo $ref_interne;?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="nom_organisation" class="col-sm-4 control-label">Nom de l'organisation <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Nom de la société, association, collectivitÃ©, etc."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nom_organisation" name="nom_organisation" placeholder="Nom de l'organisation" value="<?php echo $nom_organisation;?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="represente_par" class="col-sm-4 control-label">Représenté par <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Personne qui représente l'organisation."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="represente_par" name="represente_par" placeholder="Représentant" value="<?php echo $represente_par;?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="qualite" class="col-sm-4 control-label">Qualité <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Statut du représentant."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="qualite" name="qualite" placeholder="Qualité" value="<?php echo $qualite;?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="adresse" class="col-sm-4 control-label">Adresse postale <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Adresse, code postale, ville."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" value="<?php echo $adresse;?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="telephone" class="col-sm-4 control-label">Téléphone <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Format 0XXXXXXXXX"></span></label>
						<div class="col-sm-8">
							<input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Téléphone" value="<?php echo $telephone;?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="fax" class="col-sm-4 control-label">Fax <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Format 0XXXXXXXXX"></span></label>
						<div class="col-sm-8">
							<input type="tel" class="form-control" id="fax" name="fax" placeholder="Fax" value="<?php echo $fax;?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="email" class="col-sm-4 control-label">E-mail <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Adresse e-mail du représentant ou de l'organisation."></span></label>
						<div class="col-sm-8">
							<input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo $email;?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-warning">Envoyer</button>
				    </div>
				</div>
				<input type="hidden" name="update" value="update">
				<input type="hidden" name="id" value="<?php echo $id;?>">
				</div>
			</form>
	<?php include 'footer.php'; ?>
</div>
	</body>
<script type="text/javascript">
    $(function () {
        $("[rel='tooltip']").tooltip();
    });
</script>
</html>