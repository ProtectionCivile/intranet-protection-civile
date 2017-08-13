<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
</ol>

<!-- Redirect user if unauthorized (bad request) => shoot him -->
<?php
if (isset($_GET['notallowed'])){
	header("Location: login.php?notallowed");
	exit();
}

?>

<div class="container">

	<center><img class="img-responsive" src='img/logos/logo-baseline-right.png'/></center>
	<h3 class="text-center">Protection Civile des Hauts-de-Seine</h3>

	<br />
	<p>Bonjour <strong><?php echo ucfirst($currentUserFirstName); ?></strong>, bienvenue dans votre espace sécurisé</p>
	<p>Vous pouvez sélectionner une action en vous aidant du menu ci-dessus. Seules les opérations accessibles à votre niveau d'accréditation sont visibles; Si vous constatez une erreur, merci de nous en informer par mail : <a href='mailto:directeur-adj-informatique@protectioncivile92.org'>directeur-adj-informatique@protectioncivile92.org</a></p>

	<h3>En fonction de vos rôles, vous pourrez (ou non) :</h3>
	<ul>
		<li><strong>Pour tout le monde</strong></li>
		<ul>
			<li>Accéder à l'annuaire en ligne</li>
			<li>Estampiller des photos à l'effigie de la PC-92 (cartouche)</li>
		</ul>
		<li><strong>Pour les DLOs</strong></li>
		<ul>
			<li>Créer ou visualiser les postes de secours sur votre section</li>
			<li>Gérer vos clients favoris pour créer des DPS plus rapidement</li>
			<li>Faire une recherche de secouristes facilement</li>
		</ul>
		<li><strong>Pour la DDO</strong></li>
		<ul>
			<li>Valider (ou non) les DPS des antennes et du département</li>
			<li>Accéder rapidement à la liste "à traiter"</li>
			<li>Envoyer des demandes de DPS à la Préfecture (ou aux autres ADPC) directement</li>
		</ul>
		<li><strong>Pour les Trésoriers</strong></li>
		<ul>
			<li>Afficher l'état des recettes opérationnelles et des taxes FNPC et ADPC</li>
		</ul>
		<li><strong>Pour les Adminis</strong></li>
		<ul>
			<li>Modifier l'affectation des permissions et des rôles des utiilsateurs</li>
			<li>Gérer manuellement les antennes et leur rattachement administratif</li>
			<li>Accéder à des paramètres de configuration</li>
			<li>Gérer les utilisateurs et leur affecter des rôles</li>
			<li>Changer les numéros de contact des antennes</li>
			<li>Ajouter ou supprimer des utilisateurs à des listes de diffusion</li>
			<li>Modifier l'annuaire</li>
		</ul>
	</ul>

	<br />

	<h3>Vous avez les rôles suivants :</h3>
	<ul>
		<?php
			$roles = $rbac->Users->allRoles($currentUserID);
			foreach ($roles as &$role) {
				$query = "SELECT name FROM sections WHERE number='".$role['Affiliation']."'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
				$cities = mysqli_query($db_link, $query);
				$city = mysqli_fetch_array($cities);
				echo "<li>".$role['Description']." (".$city['name'].")</li>";
				$permissions = $rbac->Roles->Permissions($role['ID']);
				echo '<ul>';
				foreach ($permissions as &$permission) {
					$query = "SELECT Description FROM $tablename_permissions WHERE ID='".$permission."'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
					$real_permissions = mysqli_query($db_link, $query);
					$real_permission = mysqli_fetch_array($real_permissions);
					echo "<li>".$real_permission['Description']."</li>";
				}
				echo '</ul>';
			}
		?>
	</ul>

	<br />

	<p align="left"><a href="logout.php"><strong>Déconnexion</strong></a></p>
</div>

<?php include('components/footer.php'); ?>

</body>
</html>
