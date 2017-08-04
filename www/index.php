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

	<center><img class="img-responsive" src='img/logo-baseline-right.png'/></center>
	<h2 class="text-center">Protection Civile des Hauts-de-Seine</h2>

	<br />
	<p>Bonjour <strong><?php echo ucfirst($currentUserFirstName); ?></strong>, bienvenue dans votre espace sécurisé</p>
	<p>Vous pouvez sélectionner une action en vous aidant du menu ci-dessus. Seules les opérations accessibles à votre niveau d'accréditation sont visibles; Si vous constatez une erreur, merci de nous en informer par mail : <a href='mailto:directeur-adj-informatique@protectioncivile92.org'>directeur-adj-informatique@protectioncivile92.org</a></p>

	Vous avez les rôles suivants :
	<ul>
		<?php
			$roles = $rbac->Users->allRoles($currentUserID);
			foreach ($roles as &$role) {
				$query = "SELECT name FROM sections WHERE number='".$role['Affiliation']."'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
				$cities = mysqli_query($db_link, $query);
				$city = mysqli_fetch_array($cities);
				echo "<li>".utf8_encode($role['Description'])." (".$city['name'].")</li>";
			}
		?>
	</ul>
	<br />
	<p align="left"><a href="logout.php"><strong>Déconnexion</strong></a></p>
</div>

<?php include('components/footer.php'); ?>

</body>
</html>
