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

	<p class="bg-success">Bonjour <strong><?php echo $currentUserFirstName; ?></strong>, bienvenue dans votre espace sécurisé</p>
	
	<center><img class="img-responsive" src='img/logo.png'/></center>
	<h2 class="text-center">Protection Civile des Hauts-de-Seine</h2>

	<p>Vous pouvez sélectionner une action en vous aidant du menu ci-dessus. Seules les opérations accessibles à votre niveau d'accréditation sont visibles; Si vous constatez une erreur, merci de nous en informer par mail : <a href='mailto:directeur-adj-informatique@protectioncivile92.org'>directeur-adj-informatique@protectioncivile92.org</a></p>
	
	Vous avez les rôles suivants : 
	<?php
		$roles = $rbac->Users->allRoles($currentUserID);
		foreach ($roles as &$role) {
			$query = "SELECT name FROM sections WHERE number='".$role['Affiliation']."'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
			$cities = mysqli_query($link, $query);
			$city = mysqli_fetch_array($cities);
			echo "<li>".utf8_encode($role['Description'])." (".$city['name'].")</li>";
		}
	?>
	<br />
	<?php if ($rbac->check("admin-users-update", $currentUserID)) { ?>
		<strong>En tant que gérant des utilisateurs vous pouvez effectuer les actions suivantes : </strong><br />
		<a href="user-view.php">Gérer les utilisateurs</a><br />
	<?php } ?>
	<br />

	<?php if ($rbac->check("admin-mailinglist-manage", $currentUserID)) { ?>
		<strong>En tant que gestionnaire des listes de diffusion, vous pouvez effectuer les actions suivantes</strong> <br />
		<a href="mailinglist-add.php">Gérer les listes de diffusion</a><br />
	<?php } ?>
	<br />
	<p align="left"><a href="logout.php"><strong>Déconnexion</strong></a></p>
</div>

<?php include('components/footer.php'); ?>
  
</body>
</html>