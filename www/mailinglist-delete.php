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


<?php include('components/footer.php'); ?>

</body>
</html>