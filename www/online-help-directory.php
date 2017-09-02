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
	<li class="active">Annuaire</li>
</ol>

<div class="container">

	<div class="page-header">
		<h1>Aide en ligne <small>Annuaire en ligne</small></h1>
	</div>

	<p class='lead'>Permet de trouver facilement les informations de contact.</p>


	<br />
	<h3 class='text-primary'>Droits d'accès</h3>
	<p>Il est accessible à tous les rôles, et un utilisateur dédié a été créé avec uniquement cet accès. Pour avoir accès à l'annuaire, n'importe qui peut se connecter avec l'identifiant <samp>public</samp>.</p>


	<br />
	<h3 class='text-primary'>Filtrage</h3>
	<p>Un filtrage existe par antenne et par tag. Plusieurs tags peuvent être sélectionnés simultanément A noter qu'un rôle peut avoir plusieurs tags.</p>

	<br />
	<h3 class='text-primary'>Ordre d'apparition et téléphone</h3>
	<p>L'agencement est effectué en premier lieu selon l'antenne, puis selon le numéro de hiérarchie du rôle.</p>
	<p>Si la fonction possède un numéro de téléphone, il est affiché. Si ce n'est pas le cas, le système affiche le numéro personnel de l'utilisateur s'il existe.</p>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>
