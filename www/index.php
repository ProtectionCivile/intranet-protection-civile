<?php require_once('functions/session/security.php'); ?>
<html>
<head>
 	<title>Accueil</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php require_once('components/header.php'); ?>

<!-- Redirect user if unauthorized (bad request) => shoot him -->
<?php
if (isset($_GET['notallowed'])){
	header("Location: login.php?notallowed");
	exit();
}
?>

<div class="container">
	<p>Bonjour <?php echo $currentUserFirstName; ?> ,
	Bienvenue dans votre espace sécurisé.</p>

	<?php if ($rbac->check("admin-users-update", $currentUserID)) { ?>
		<strong>En tant que gérant des utilisateurs vous pouvez effectuer les actions suivantes : </strong><br />
		<a href="user-view.php">Gérer les utilisateurs</a><br />
	<?php } ?>
	<br />

	<?php if ($rbac->check("admin-mailinglist-manage", $currentUserID)) { ?>
		<strong>En tant que gestionnaire des listes de diffusion, vous pouvez effectuer les actions suivantes</strong> <br />
		<a href="mailinglist-manage.php">Gérer les listes de diffusion</a><br />
	<?php } ?>

	<p align="left"><a href="logout.php"><strong>Déconnexion</strong></a></p>
</div>

<?php include('components/footer.php'); ?>
  
</body>
</html>