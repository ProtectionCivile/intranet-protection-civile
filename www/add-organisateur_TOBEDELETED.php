<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ajout d'un organisateur</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>
<?php include('components/header.php'); ?>

<div class="container">
			<h2>Ajout d'un organisateur</h2>
			
			<form class="form-horizontal" role="form" action="edit-organisateur.php" method="post">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Organisateur</h3>
					</div>
				<div class="panel-body">
					<div class="form-group form-group-sm">
						<label for="commune" class="col-sm-4 control-label">Commune  <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Commune concernée par cet organisateur"></span></label>
						<div class="col-sm-8">
							<select class="form-control" id="commune" name="commune">
								<?php							
								$reqliste = "SELECT numero_commune,nom_commune FROM rat_com" or die("Erreur lors de la consultation" . mysqli_error($db_link)); 
								$liste = mysqli_query($db_link, $reqliste);
								while($listecommune = mysqli_fetch_array($liste)) {
								echo "<option value='".$listecommune["numero_commune"]."'>".$listecommune["nom_commune"]."</option>";
								}							
								?>
							</select>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="ref_interne" class="col-sm-4 control-label">Référence interne <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Référence interne. Exemple : Mairie Pantin - Mr Dupont"></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="ref_interne" name="ref_interne" placeholder="Référence interne">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="nom_organisation" class="col-sm-4 control-label">Nom de l'organisation <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Nom de la société, association, collectivité, etc."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nom_organisation" name="nom_organisation" placeholder="Nom de l'organisation">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="represente_par" class="col-sm-4 control-label">Représenté par <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Personne qui représente l'organisation."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="represente_par" name="represente_par" placeholder="Représentant">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="qualite" class="col-sm-4 control-label">Qualité <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Statut du représentant."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="qualite" name="qualite" placeholder="Qualité">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="adresse" class="col-sm-4 control-label">Adresse postale <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Adresse, code postale, ville."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="telephone" class="col-sm-4 control-label">Téléphone <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Format 0XXXXXXXXX"></span></label>
						<div class="col-sm-8">
							<input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Téléphone">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="fax" class="col-sm-4 control-label">Fax <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Format 0XXXXXXXXX"></span></label>
						<div class="col-sm-8">
							<input type="tel" class="form-control" id="fax" name="fax" placeholder="Fax">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="email" class="col-sm-4 control-label">E-mail <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Adresse e-mail du représentant ou de l'organisation."></span></label>
						<div class="col-sm-8">
							<input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
						</div>
					</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-warning">Envoyer</button>
				    </div>
				</div>
				<input type="hidden" name="insert" value="insert">
			</form>
			
	</div>
	<?php include 'footer.php'; ?>
	</body>
<script type="text/javascript">
    $(function () {
        $("[rel='tooltip']").tooltip();
    });
</script>
</html>