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
	<li class="active">Base contacts (clients)</li>
</ol>

<div class="container">

	<div class="page-header">
		<h1>Aide en ligne <small>Base contacts (clients)</small></h1>
	</div>

	<p class='lead'>Permet de recenser les clients réguliers pour créer un DPS plus rapidement.</p>

	<br />
	<h3 class='text-primary'>Droits d'accès</h3>
	<p>Il existe une permission pour consulter ceux de son antenne, une autre pour ceux du Département et les 2 permissions adéquates pour les modifier. Une permission transverse permet de voir toute la base et de tout modifier.</p>

	<br />
	<h3 class='text-primary'>Utilisation</h3>
	<p>L'idée est de saisir les coordonnées des clients réguliers pour pouvoir les réutiliser lors de la création d'un DPS. Même s'il est possible de créer un DPS en dupliquant un autre, la saisie du client seul reste une fonctionnalité intéresante. Lors de l'utilisation pour la création d'un DPS, seuls les champs vides seront remplis avec les infos du client.</p>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>
