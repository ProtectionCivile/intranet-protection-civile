<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Paramètres mail</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Accueil</a></li>
	<li><a href="/mailsetting-list.php">Réglages des e-mails</a></li>
	<li class="active">Listing</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-settings-view", $currentUserID); ?>


<!-- Delete a setting : Controller -->
<?php include 'functions/controller/mailsetting-delete-controller.php'; ?>


<!-- Page content container -->
<div class="container">

	<div class="page-header">
		<h2>Réglages des e-mails</h2>
	</div>

	<!-- Update setting : Operation status indicator -->
	<?php include 'components/operation-status-indicator.php'; ?>

	<?php $base_url="mailsetting-list.php"; ?>

	<!-- Beginning of the filter's parent module -->
	<?php include_once('components/filter/filter-settings-module.php'); ?>

	<?php require_once('components/filter/filter-mailsettings-query-builder.php'); ?>

	<?php require_once('components/filter/parts/paging-query-modifier.php'); ?>

	<?php
		$settings = mysqli_query($db_link, $sqlQuery);
	?>
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Liste des paramètres
				<?php if ($rbac->check("admin-settings-update", $currentUserID)) { ?>
					<div class="text-right"><a class="btn btn-warning" role="button" href="mailsetting-create.php">Ajouter un paramètre</a></div>
				<?php }?>
			</h3>
		</div>
		<div class="panel-body">
			<?php if($nb_elements == 0) { ?>
				<div>Aucun paramètre enregistré </div>
			<?php }
			else { ?>
				<div class="table-responsive" style="vertical-align: middle;">
					<table class="table table-bordered table-condensed">
						<tr>
							<th>Nom</th>
							<th>Valeur</th>
							<th colspan='2'>Opérations</th>
						</tr>
						<?php foreach ($settings as $setting):?>
						<tr>
							<td><samp><?php echo htmlentities($setting['name']) ?></samp></td>
							<td><?php echo htmlentities($setting['value']) ?></td>
							<td>
								<?php if ($rbac->check("admin-settings-update", $currentUserID)) { ?>
									<form action="mailsetting-edit.php" method="post" accept-charset="utf-8">
										<input name="ID" value="<?php echo $setting['ID'] ?>" type="hidden">
										<button type="submit" class="btn btn-warning glyphicon glyphicon-pencil" title="Modifier"></button>
									</form>
								<?php }?>
							</td>
							<td>
								<?php if ($rbac->check("admin-settings-update", $currentUserID)) { ?>
									<form action="" method="post" accept-charset="utf-8">
										<input name="ID" value="<?php echo $setting['ID'] ?>" type="hidden">
										<button type="submit" class="btn btn-danger glyphicon glyphicon-trash" title="Supprimer" onclick='return(confirm("Etes-vous sûr de vouloir supprimer ce paramètre?"));'></button>
									</form>
								<?php }?>
							</td>
						</tr>
						<?php endforeach;  ?>
					</table>
				</div>
			<?php } ?>
		</div>
		<?php if ($rbac->check("admin-settings-update", $currentUserID)) { ?>
			<div class="panel-footer"><a class="btn btn-warning" role="button" href="mailsetting-create.php">Ajouter un paramètre</a></div>
		<?php }?>
	</div>
	<!-- Page's pagination module -->
	<?php require_once('components/filter/parts/filter-paging-display.php'); ?>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>
