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
	<li class="active">Utilisateurs, permissions et rôles</li>
</ol>

<div class="container">

	<div class="page-header">
		<h1>Aide en ligne <small>Utilisateurs, permissions et rôles</small></h1>
	</div>

	<p class='lead'>Un utilisateur possède des rôles, et les rôles ont certaines permissions.</p>

	<p>Les pages du site et les actions sont protégées par des permissions. Au travers de ses rôles un utilisateur donné pourra ou non accéder aux resources. Un utilisateur accède uniquement à ce qu'il a le droit de voir.</p>


	<h3 class='text-primary'>Droits d'accès</h3>
	<p>Il existe une permission pour les consulter, une autre pour les modifier.</p>

	<h3 class='text-primary'>Utilisateurs</h3>
	<p>Les rôles sont entièrement modifiables. L'utilisateur se connecte à l'aide de son matricule e-Protec. Leur photo de profil est extraite à partir de leur matricule e-Protec.</p>

	<h3 class='text-primary'>Rôles</h3>
	<p>Les rôles peuvent être modifiés dans les pages de gestion associées. Leur modification entraîne systématiquement une mise à jour de l'annuaire.</p>
	<p>Le rôle <samp>Administrateur</samp> ne peut pas être supprimé.</p>
	<p>Pour affecter un rôle à un utilisateur, il faut se rendre dans le paramétrage de l'utilisateur et cliquer sur <span class='glyphicon glyphicon-check'></span></p>

	<h3 class='text-primary'>Rôles</h3>
	<p>La modification des permissions a une conséquence directe sur ls droits d'accès des utilisateurs. Les permissions spéciales permettant de modifier les rôles et les permissions ne peuvent pas être supprimées.</p>
	<p>Pour affecter des permissions aux rôles, il faut se rendre dans le paramétrage des rôles avec le bouton <span class='glyphicon glyphicon-check'></span></p>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>
