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
	<li class="active">Listes de diffusion</li>
</ol>

<div class="container">

	<div class="page-header">
		<h1>Aide en ligne <small>Listes de diffusion</small></h1>
	</div>

	<p class='lead'>Ajouter ou retirer des utilisateurs à des listes de diffusion mail prédéfinies.</p>

	<h3 class='text-primary'>Droits d'accès</h3>
	<p>Il existe une permission pour les consulter et une autre pour les modifier.</p>

	<h3 class='text-primary'>Utilisation</h3>
	<p>Deux pages sont proposées pour mettre à jour une liste. A ce jour, l'intranet ne permet pas d'afficher la liste des abonnés à une liste donnée.</p>

	<p>La <strong>page d'abonnement</strong> permet d'ajouter un utilisateur à partir de son adresse mail à une ou plusieurs listes. L'action est immédiate.</p>

	<p>La <strong>page de désabonnement</strong> permet de retirer un utilisateur de <span class='text-danger'>toutes les listes de diffusion</span>. Attention cette action est irréversible.</p>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>
