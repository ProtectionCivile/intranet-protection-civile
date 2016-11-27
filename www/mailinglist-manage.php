<?php
	include 'securite.php';
	require_once('connexion.php');
	include 'functions/str.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ajout d'un compte mail à des listes de diffusion</title>
	<meta http-equiv="Content-Type" content="text/html">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>

<body>

<?php include 'header.php'; ?>
<script src="js/jquery.validate.min.js" type="text/javascript"></script>

<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li class="active">Gestion des listes de diffusion</li>
</ol>



	<!-- Update mailing list : Controller -->
	<?php include 'functions/controller/mailinglist-update-controller.php'; ?>


	<!-- Page content container -->
	<div class="container">

		<!-- Update mailing list : Operation status indicator -->
		<?php include 'functions/operation-status-indicator.php'; ?>

		<h2>Gestion des abonnements aux listes de diffusion</h2>


		<!-- Add subscriber to mailing list : display form -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Abonner un compte mail</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" id="updatemailinglistForm" action='' role="form" method='post' accept-charset='utf-8'>
					<input type="hidden" name="addUser">
					<label for="mailAccount" class="col-sm-4 control-label">Nom du compte mail</label>
					<div class="input-group col-sm-4">
						<input type="text" class="form-control" id="mailAccount" name="mailAccount" placeholder="ex: martin.smith">
						<div class="input-group-addon">@protectioncivile92.org</div>
					</div>

					<div class="checkbox">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents">
							Adhérents 92
						</label>
					</div>
					<br />
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents-asnieres">
							Asnières
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents-boulogne-issy">
							Boulogne Issy
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents-bourg-la-reine">
							Bourg-la-Reine
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents-clamart">
							Clamart
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents-clichy">
							Clichy
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents-colombes">
							Colombes
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents-courbevoie">
							Courbevoie
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents-garches">
							Garches
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents-gennevilliers">
							Gennevilliers
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents-nanterre">
							Nanterre
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents-rueil">
							Rueil
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents-suresnes-puteaux">
							Suresnes-Puteaux
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents-vanves">
							Vanves
						</label>
					</div>
					<div class="checkbox-inline">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="adherents-villeneuve">
							Villeneuve
						</label>
					</div>
					<br />
					<div class="checkbox">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="ceps">
							CEPS
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="lists[]" id="lists[]" value="ars">
							ARS
						</label>
					</div>
					
					<br />
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<button type="submit" class="btn btn-warning" id='submitAddUserForm'>Abonner</button>
					   </div>
					</div>
				</form>
			</div>
		</div>


		<!-- Remove subscriber from mailing lists : display form -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Désabonner un compte mail de toutes les listes</h3>
			</div>
			<p>Attention l'utilisateur sera retiré de <strong>toutes</strong> les listes de diffusion. A utiliser avec précaution</p>
			<div class="panel-body">
				<form class="form-horizontal" id="updatemailinglistForm" action='' role="form" method='post' accept-charset='utf-8'>
					<input type="hidden" name="delUser">
					<label for="mailAccount" class="col-sm-4 control-label">Nom du compte mail</label>
					<div class="input-group col-sm-4">
						<input type="text" class="form-control" id="mailAccount" name="mailAccount" placeholder="ex: martin.smith">
						<div class="input-group-addon">@protectioncivile92.org</div>
					</div>
					<br />
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<button type="submit" class="btn btn-danger" id='submitAddUserForm'>Retirer de toutes les listes !</button>
					   </div>
					</div>
				</form>
			</div>
		</div>

	</div>


<?php include 'footer.php'; ?>

</body>
</html>