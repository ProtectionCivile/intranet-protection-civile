<?php 
	if (isset($_POST['login'])){ 
		$login = mysqli_real_escape_string($link, $_POST['login']);
		$passwordFromPost = $_POST['pass'];
		
		$sql = "SELECT * FROM $tablename_users WHERE login='$login'" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$query = mysqli_query($link, $sql);
		$user = mysqli_fetch_assoc($query);
		$userCount = mysqli_num_rows($query);

		if ($userCount && password_verify($passwordFromPost, $user['pass'])) {
		    $_SESSION['authenticated'] = true;
			$_SESSION['ID'] = $user['ID'];	
			header("Location: index.php"); 
			exit;
		}
		else {
			header("Location: login.php?badlogin"); // redirection si utilisateur non reconnu
			exit;
		}
	}
?>