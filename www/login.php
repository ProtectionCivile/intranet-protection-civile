<?php session_start();
require_once('functions/session/db-connect.php');
require_once('functions/controller/login-controller.php');
require_once('functions/controller/logout-controller.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
	<link rel="stylesheet" href="css/signin.css" type="text/css" media="all" title="no title" charset="utf-8">
</head>
<body>



	<title>Extranet - ADPC92</title>
	<div class="container">

		<form action="" method="post" name="connect" class="form-signin" role="form">
	  		<p align="center" class="Style7">
	      	<?php if(isset($_GET['badlogin'])) {
			  	echo '<span class="label label-danger">login ou mot de passe incorrect</span>';
			}
			if(isset($_GET['logout'])) {
				echo '<span class="label label-success">Déconnexion réussie</span>';
				session_unset();
			}
			if(isset($_GET['notallowed'])) {
				echo '<span class="label label-danger">Vous devez vous connecter pour afficher ce site</span>';
		    } ?>

	  		<h2 class="form-signin-heading"><center>Extranet PC-92</center></h2>

	    	<input name="login" type="text" class="form-control" placeholder="Identifiant" required="" autofocus="">
			<input type="password" name="pass" class="form-control" placeholder="Mot de passe" required="" id="pass">
			<button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
		</form>
	</div>

</body>
</html>
