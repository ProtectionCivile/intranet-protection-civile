<?php
require_once('connexion.php');
include 'securite.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Ajout d'un utilisateur</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
include ('components/header.php');
if ($_SESSION['privilege'] == "admin") {
	
$login = $_post['prenom'].'.'.$_post['nom'];

// ------ AJOUT D'UN UTILISATEUR --------
if (isset($_POST['nom'])){ // on vérifie la présence des variables de formulaire (si le formulaire a été envoyé)
	//if(($login == "") || ($_POST['pass'] == "")){ // si login ou mot de passe non spécifiés >> message d'erreur
	header("Location:admin.php?erreur=empty");
	exit;
}
else {
    if ($_POST['pass'] !== $_POST['pass2']) { // on vérifie si le mot de passe et le mot de passe confirmé ont la même valeur
        header("Location:admin.php?erreur=pass"); // redirection si le pass1 est différent du pass2
		exit;
    }
    else {
        // on passe la variable $POST(login) en variable pour la tester
		mysql_select_db($database_dbprotect, $dbprotect);
        $verif_query = sprintf("SELECT * FROM $tablename_dbprotect WHERE login='$login'"); // requête sur la base administrateurs
        $verif = mysql_query($verif_query, $dbprotect) or die(mysql_error());
        $row_verif = mysql_fetch_assoc($verif);
        $utilisateur = mysql_num_rows($verif);
			
		if ($utilisateur) {
            header("Location:admin.php?erreur=login"); // redirection si le login existe déjà
            exit;
        }
        else {
            // on passe les autres variables $POST en variables
			$pass = sha1($_POST['pass']); // ici, on crypte le mot de passe à l'aide de SHA1 (c'est tout simple non ? :)
			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$privilege = $_POST['privilege'];
			// on fait l'INSERT dans la base de données
				$add_user = sprintf("INSERT INTO $tablename_dbprotect (login, pass, nom, prenom, privilege) VALUES ('$login', '$pass', '$nom', '$prenom', '$privilege')");
				mysql_select_db($database_dbprotect, $dbprotect);
				$result = mysql_query($add_user, $dbprotect) or die ("Impossible d'ajouter l'utilisateur dans la base de donn&eacute;e");
				header("Location:admin.php?add=ok"); // redirection si création réussie
				exit;
				}
				
			}
		}
// requête sur tous les utilisateurs recensés dans la base (on fait un tri par nom)


// ------ SUPPRESSION D'UN UTILISATEUR --------
// on fait la requête sur tous les utilisateurs de la base
mysql_select_db($database_dbprotect, $dbprotect);
$query_users = "SELECT * FROM $tablename_dbprotect ORDER BY nom ASC"; // ORDER BY renvoi les données triées (ici par nom croissant)
$users = mysql_query($query_users, $dbprotect) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);

if (isset($_POST['suppr'])){ // on vérifie la présence des variables de formulaire (si le formulaire a été envoyé)
	$id = $_POST['suppr'];
    $query_user = mysql_query("SELECT * FROM $tablename_dbprotect WHERE id_user='$id'", $dbprotect);
    $row_verif = mysql_fetch_assoc($query_user);
    $privilege = $row_verif['privilege'];
    $query_admin = mysql_query("SELECT * FROM $tablename_dbprotect WHERE privilege = 'admin'", $dbprotect);
    $admin = mysql_num_rows($query_admin);
    
    if ($privilege == 'admin' && $admin == 1) {
        header("Location:admin.php?delete=erreur_admin");
        exit;
    }
    else {
        $delete_user = sprintf("DELETE FROM $tablename_dbprotect WHERE id_user='$id'");
        mysql_select_db($database_dbprotect, $dbprotect);
        $result = mysql_query($delete_user, $dbprotect) or die(mysql_error());
        header("Location:admin.php?delete=ok");
    }
}
?>
<div class="container">
		<h2>Création d'un membre</h2>
		
		<form class="form-horizontal" role="form" action="#" name="add" method="post">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Informations</h3>
				</div>
			<div class="panel-body">
				<div class="form-group form-group-sm">
					<label for="nom" class="col-sm-4 control-label">Nom</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="nom" placeholder="Nom du membre">
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label for="prenom" class="col-sm-4 control-label">Prénom</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="prenom" placeholder="Prénom du membre">
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label for="pass" class="col-sm-4 control-label">Mot de passe</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" id="pass" placeholder="">
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label for="pass2" class="col-sm-4 control-label">Confirmation du mot de passe</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" id="pass2" placeholder="">
					</div>
				</div>
				<div class="form-group form-group-sm">
					<label for="privilege" class="col-sm-4 control-label">Privilège accordé</label>
					<div class="col-sm-8">
						<select class="form-control" id="privilege">
							<option value="user">Utilisateur</option>
							<option value="admin">Administrateur</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-warning">Envoyer</button>
				    </div>
				</div>
			</div>
		</form>
</div>




    <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "login")) { // Affiche l'erreur  ?><span class="Style5">Veuillez entrer un login inutilisé SVP!</span><?php } ?>
    <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "pass")) { // Affiche l'erreur  ?><span class="Style5">Veuillez entrer deux fois votre mot de passe SVP!</span><?php } ?>
    <?php if(isset($_GET['add']) && ($_GET['add'] == "ok")) { // Affiche l'erreur ?><span class="Style2">L'utilisateur a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s !</span><?php } ?>
    <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "empty")) { // Affiche l'erreur  ?><span class="Style5">Un petit oubli non ? Veuillez renseigner au moins un login et un mot de passe SVP!</span><?php } ?>
 
  <p align="center" class="Style6"><strong>
  <?php if(isset($_GET['delete']) && ($_GET['delete'] == "ok")) { // Affiche l'erreur  ?>
  <span class="Style2">L'utilisateur a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s !</span><?php } ?>
  <?php if(isset($_GET['delete']) && ($_GET['delete'] == "erreur_admin")) { // Affiche l'erreur  ?>
  <span class="Style2">L'utilisateur n'a pas pu &ecirc;tre supprim&eacute; ; c'est le seul administrateur !</span><?php } ?></strong> </p>
    <form action="" method="post" name="suppr" class="Style6">
      <p align="center"><strong><u>Supprimer un utilisateur</u></strong></p>
      <div align="center">
        <table border="0" cellpadding="5" cellspacing="0">
          <tr>
            <td>
                <select name="suppr" size="5" class="textform" id="select2">
                  <?php
do {  
?>
                  <option value="<?php echo $row_users['id_user']?>">
                  <?php if($row_users['privilege']== "admin") echo ">> ";echo $row_users['nom']; echo " "; echo $row_users['prenom']; echo " ("; echo $row_users['login']; echo ")"; if($row_users['privilege']== "admin") echo " <<"?>
                  </option>
                  <?php
} while ($row_users = mysql_fetch_assoc($users));
  $rows = mysql_num_rows($users);
  if($rows > 0) {
      mysql_data_seek($users, 0);
	  $row_users = mysql_fetch_assoc($users);
  }
?>
                </select></td>
            <td><input type="submit" name="Supprimer" value="Supprimer cet utilisateur"></td>
          </tr>
              </table>
        <p>&nbsp;</p>
        <p><a href="accueil.php"><strong>&lt; Retour accueil</strong></a></p>
      </div>
    </form>
    <p align="center"><span class="Style6">Script par <a href="http://www.borrat.net">DB</a></span><br />
	Mise &agrave; jour php5 + cryptage sha1 par aventurier19</p>
<?php } ?>
<?php include ('components/footer.php');
if ($_SESSION['privilege'] == "user") { ?>
	Page interdite. <?php }?>
</body>
</html>