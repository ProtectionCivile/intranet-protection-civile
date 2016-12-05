<?php session_start(); 
require_once('functions/session/db-connect.php');


if (isset($_POST['login'])){ 
	$login = mysqli_real_escape_string($link, $_POST['login']);
	$pass = sha1($_POST['pass']);
	
	$verif_query = "SELECT * FROM $tablename_dbprotect WHERE login='$login' AND pass='$pass'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
	$verif = mysqli_query($link, $verif_query);
	$row_verif = mysqli_fetch_assoc($verif);
	$user = mysqli_num_rows($verif);

	
	if ($user) {
	    $_SESSION['authenticated'] = true;
		$_SESSION['ID'] = $row_verif['ID'];	
		header("Location: index.php"); 
		exit;
	}
	else {
		header("Location: login.php?badlogin"); // redirection si utilisateur non reconnu
		exit;
	}
}


// Disconnect
if (isset($_GET['logout'])){
	$_SESSION['authenticated'] = false;
}
?>

<html>
<head>
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