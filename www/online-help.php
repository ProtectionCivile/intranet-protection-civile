<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Aide en ligne</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Accueil</a></li>
	<li class="active">Aide en ligne</li>
</ol>

<div class="container">

	<div class="page-header">
		<h1>Aide en ligne</h1>
	</div>

	<br />

	<div class="row">
		<div class="col-sm-4">
			<h4 class='text-warning'>Opérationnel</h4>
			<ul>
				<li><a href=''>Workflow de validation de DPS</a></li>
				<li><a href=''>Envoi de mails pour les DPS</a></li>
				<li><a href=''>Base contacts (clients)</a></li>
				<li><a href=''>Envoi de mails pour les DPS</a></li>
			</ul>
		</div>
		<div class="col-sm-4">
			<h4 class='text-warning'>Administration</h4>
			<ul>
				<li><a href='online-help-settings-general.php'>Paramètres de l'application</a></li>
				<li><a href='online-help-settings-mail.php'>Paramètres des e-mails</a></li>
				<li><a href='online-help-users-roles-permissions.php'>Utilisateurs, rôles, permissions</a>certaines persmissions indispensables (et roles?) ne peuvent pas etre supprimées</li>
				<li><a href=''>Antennes et rattachement</a></li>
				<li><a href=''>Listes de diffusion</a></li>
			</ul>
		</div>
		<div class="col-sm-4">
			<h4 class='text-warning'>XXX</h4>
			<ul>
				<li><a href=''>XXX</a></li>
			</ul>
		</div>

	</div>
</div>

<?php include('components/footer.php'); ?>

</body>
</html>
