<?php
require_once('functions/session/security.php'); 
require_once('functions/settings_queries.php');
require_once('components/header.php');


// Authentication
$rbac->enforce("admin-settings-view", $currentUserID);

if (isset($_POST['suppr'])){
		if(delete_settings($link, $_POST['suppr'])){
			$succes = "Paramètre supprimé avec succès";	
		}
}
if ($rbac->check("admin-settings-view", $currentUserID)) {
	header("Location: index.php");
	$page = 1;
	if(isset($_GET['page'])){
		$page = intval($_GET['page']);
	}
	$settingsCount = count_settings($link);
	$settings = select_settings($link, $page);
	$pages = ceil($settingsCount/50);
}



?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Liste des Paramètres</title>
		<meta http-equiv="Content-Type" content="text/html">
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	</head>
	<body>
	<?php include('header.php') ?>
	<div class="container">
<?php
	if (!empty($erreur)){
		echo "<div class='alert alert-danger'><strong>Erreur</strong> : ".$erreur."</div>";
	}elseif (!empty($succes)){
		echo "<div class='alert alert-success'><strong>Réussi</strong> : ".$succes."</div>";
	}
?>
		<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Liste des Paramètres</h3>
		</div>
		<div class="panel-body">
		<?php if($settingsCount ===0): ?>
			<div> aucun paramètre enregistré </div>
		<?php else: ?>
		<div class="table-responsive" style="vertical-align: middle;">
		<table class="table table-bordered table-condensed">
			<tr>
				<th>Nom</th>
				<th>Valeur</th>
				<th colspan='2'>Opérations</th>
			</tr>
			<?php foreach ($settings as $setting):?>
			<tr class='info'>
				<td><?php echo $setting['setting_name'] ?></td>
				<td><?php echo $setting['setting_value'] ?></td>
				<td>
					<?php if ($rbac->check("admin-settings-update", $currentUserID)) { ?>
						<a href="settings-edit.php?id=<?php echo $setting['ID'] ?>" class='btn btn-warning glyphicon glyphicon-pencil' title="Modifier"></a>
					<?php }?>
				<td>
					<?php if ($rbac->check("admin-settings-update", $currentUserID)) { ?>
						<form action="" method="post" accept-charset="utf-8">
							<input name="suppr" value="<?php echo $setting['ID'] ?>" type="hidden">
							<button type="submit" class="btn btn-danger glyphicon glyphicon-trash" title="Supprimer"></button>
						</form>
					<?php }?>
				</td>
			</tr>	
			<?php endforeach;  ?>	
		</table>
		<div>
		<?php for ($i=1; $i < $pages+1; $i++) { ?> 
			<a href="<?php echo sprintf('%s?page=%s', $_SERVER['PHP_SELF'], $i) ?>" ><?php echo $i; ?></a>
		<?php } ?>
		</div>
		</div>
	<?php endif; ?>
	</div>
		<?php if ($rbac->check("admin-settings-update", $currentUserID)) { ?>
			<div class="panel-footer"><a class="btn btn-default" role="button" href="settings-create.php">Ajouter un paramètre</a></div>
		<?php }?>
	</div>
	</div>
	

	</body>
	</html>
