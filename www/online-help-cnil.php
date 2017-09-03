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
	<li class="active">Informatique et libertés</li>
</ol>

<div class="container">

	<div class="page-header">
		<h1>Aide en ligne <small>Informatique et libertés</small></h1>
	</div>

	<p class='lead'>Parce que nul n'est censé ignorer la loi</p>


	<br />
	<h3 class='text-primary'>Données conservées</h3>
	<p>Chaque utilisateur ayant une fonction au sein de l'Association Départementale de la Protection Civile des Hauts-de-Seine dispose d'un compte personnel sur ce site. Les informations sont collectées depuis le site national e-Protec (http://franceprotectioncivile.org) pour lequel l'utilisateur a déjà accepté la charte d'utilisation. Sur ce site sont collectés le nom, le prénom, le matricule e-Protec, l'adresse mail et le numéro de téléphone;</p>

	<br />
	<h3 class='text-primary'>Utilisation</h3>
	<p>Ces données restent la propriété stricte de la Protection Civile des Hauts-de-Seine, et ne snot en aucun cas communiquées à des tiers.</p>
	<p>Elles sont utilisées par le système pour communiquer (envoi de mails aux DLOs par exemple) mais aussi pour afficher les informations concernant l'annuaire.</p>

	<br />
	<h3 class='text-primary'>Durée de conservation et droits de l'utilisateur</h3>
	<p>Les données sont conservées tant que l'utilisateur est membre de l'association, et détruites lors de sa radiation.</p>
	<p>Lors d'une connextion à l'intranet, rien n'est stocké sur l'ordinateur du visiteur. Seul son identifiant de session est utilisé.</p>
	<p>Conformément à la loi n° 78-17 du 6 janvier 1978 modifiée article 2 relative à l’informatique, aux fichiers et aux libertés, chaque utilisateur dispose d'un droit d'accès, de rectification et de suppression des données le concernant. Ce droit peut être fait sur simple demande adressée par mail à <a href='mailto:secretariat@protectioncivile92.org'>secretariat@protectioncivile92.org</a> en précisant votre nom, prénom et la motivation de votre demande.</p>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>
