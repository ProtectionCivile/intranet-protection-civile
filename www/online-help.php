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
	<li><a href="online-help.php">Aide en ligne</a></li>
	<li class="active">Sommaire</li>
</ol>

<div class="container">

	<div class="page-header">
		<h1>Aide en ligne</h1>
	</div>

	<p class='lead'>Sélectionner une rubrique parmi les items ci-dessous.</p>

	<br />

	<div class="row">
		<div class="col-sm-4">
			<h3 class='text-warning'>Opérationnel</h3>
			<ul>
				<li><a href='online-help-clients.php'>Base contacts (clients)</a></li>
				<li><a href=''>Dispositifs de secours</a></li> préciser workflow de validation
				<li><a href=''>Envoi de mails pour les DPS</a></li>
				<li><a href=''>Demandes de renfort</a> <span class="label label-default">Bientôt</span></li>
				<li><a href=''>Gestion de la trésorerie</a></li>
			</ul>
		</div>
		<div class="col-sm-4">
			<h3 class='text-warning'>Administration</h3>
			<ul>
				<li><a href='online-help-settings-general.php'>Paramètres de l'application</a></li>
				<li><a href='online-help-settings-mail.php'>Paramètres des e-mails</a></li>
				<li><a href='online-help-users-roles-permissions.php'>Utilisateurs, rôles, permissions</a></li>
				<li><a href='online-help-sections.php'>Antennes et rattachement</a></li>
				<li><a href=''>Listes de diffusion</a></li>
			</ul>
		</div>
		<div class="col-sm-4">
			<h3 class='text-warning'>Divers</h3>
			<ul>
				<li><a href=''>Annuaire</a> <span class="label label-default">Bientôt</span></li>
				<li><a href=''>Cartoucheur de photos</a> <span class="label label-default">Bientôt</span></li>
				<li><a href=''>Générateur de signature mail</a> <span class="label label-default">Bientôt</span></li>
				<li><a href=''>Contact</a></li> ce site a été réalisé par la PC des Hds bla bla bla soumis github bla bla bla licence truc
			</ul>
		</div>

	</div>
</div>

<?php include('components/footer.php'); ?>

</body>
</html>
