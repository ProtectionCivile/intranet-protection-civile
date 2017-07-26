<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ajout d'un compte mail à des listes de diffusion</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php require_once('components/header.php'); ?>

<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li class="active">Gestion des listes de diffusion</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-mailinglist-manage", $currentUserID); ?>

<!-- Update mailing list : Controller -->
<?php include 'functions/controller/mailinglist-update-controller.php'; ?>


<!-- Page content container -->
<div class="container">

	<!-- Update mailing list : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>


	<!-- Add subscriber to mailing list : display form -->
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Abonner un compte mail à une liste de diffusion</h3>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" id="updatemailinglistForm" action='' role="form" method='post' accept-charset='utf-8'>
				<input type="hidden" name="addUser">
				<label for="mailAccount" class="col-sm-4 control-label">Nom du compte mail</label>
				<div class="input-group col-sm-4">
					<input type="text" class="form-control" id="mailAccount" name="mailAccount" placeholder="ex: martin.smith">
					<div class="input-group-addon">@protectioncivile92.org</div>
				</div>

				<br />
				<br />

				<table class='table table-bordered table-hover table-condensed'>
					<thead>
						<th><center>Type</center></th>
						<th><center>Ajouter aux liste de diffusion (plusieurs choix possibles)</center></th>
					</thead>
					<tbody>
						<tr>
							<td class="active">
								Liste des adhérents
							</td>
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents">
										Adhérents 92
									</label>
								</div>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents-asnieres">
										Asnières
									</label>
								</div>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents-boulogne-issy">
										Boulogne-Issy
									</label>
								</div>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents-bourg-la-reine">
										Bourg-la-Reine
									</label>
								</div>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents-clamart">
										Clamart
									</label>
								</div>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents-clichy">
										Clichy
									</label>
								</div>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents-colombes">
										Colombes
									</label>
								</div>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents-courbevoie">
										Courbevoie
									</label>
								</div>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents-garches">
										Garches
									</label>
								</div>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents-gennevilliers">
										Gennevilliers
									</label>
								</div>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents-nanterre">
										Nanterre
									</label>
								</div>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents-rueil">
										Rueil
									</label>
								</div>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents-suresnes-puteaux">
										Suresnes-Puteaux
									</label>
								</div>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents-vanves">
										Vanves
									</label>
								</div>
								<div class="checkbox checkbox-inline">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="adherents-villeneuve">
										Villeneuve
									</label>
								</div>
							</td>
						</tr>
						<tr>
							<td class="active">
								Opérationnel
							</td>
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="ce">
										Chefs d'équipe (ce@protectioncivile92.org)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="cp">
										Chefs de poste (cp@protectioncivile92.org)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="ceps">
										Chefs d'équipe de Prompt Secours (ceps@protectioncivile92.org)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="ars">
										Aide-Régulateur Secouriste (ars@protectioncivile92.org)
									</label>
								</div>
							</td>
						</tr>
						<tr>
							<td class="active">
								Cadres de Permanence
							</td>
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="permanence-logistique">
										Logistique (permanence-logistique@protectioncivile92.org)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="permanence-operationnel">
										Opérationnel / CODEP (permanence-operationnel@protectioncivile92.org)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="permanence-transmissions">
										Transmissions (permanence-transmissions@protectioncivile92.org)
									</label>
								</div>
							</td>
						</tr>
						<tr>
							<td class="active">
								Pôles / Commissions
							</td>
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="pole-informatique">
										Informatique (pole-informatique@protectioncivile92.org)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="pole-logistique">
										Logistique (pole-logistique@protectioncivile92.org)
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="lists[]" id="lists[]" value="pole-transmissions">
										Transmissions (pole-transmissions@protectioncivile92.org)
									</label>
								</div>
							</td>
						</tr>
					</tbody>
				</table>

				<br />
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-warning" id='submitAddUserForm'>Abonner</button>
				   </div>
				</div>
			</form>
		</div>
	</div>

</div>


<?php include('components/footer.php'); ?>

</body>
</html>
