<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>

<!-- Redirect user if unauthorized (bad request) => shoot him -->
<?php
if (isset($_GET['notallowed'])){
	header("Location: login.php?notallowed");
	exit();
}

?>

<center><img class="img-responsive" src='img/logos/logo-baseline-right.png'/></center>
<h2 class="text-center text-primary">Protection Civile des Hauts-de-Seine</h2>


<div class="container">

	<div class="page-header">
		<h2>Bonjour <?php echo ucfirst(htmlentities($currentUserFirstName)); ?> ! <small>bienvenue dans votre espace intranet</small></h2>
	</div>

	<p class='lead'>Cet intranet est conçu pour les mobiles. Il est entièrement compatible avec tous les ordinateurs, les smartphones et les tablettes. Ne vous privez pas !</p>

	<div class=' alert alert-info' role='alert'>
		<p class='text-muted'>Seules les opérations accessibles à votre niveau d'accréditation sont visibles; Si vous constatez une erreur, merci de nous en informer par mail : <a href='mailto:directeur-adj-informatique@protectioncivile92.org'>directeur-adj-informatique@protectioncivile92.org</a> pour faire évoluer cet intranet.</p>
	</div>

	<div class="row">
	  <div class="col-sm-6">
			<h4 class='text-warning'>En fonction de vos rôles, vous pourrez (ou non) :</h4>
			<ul>
				<li>Pour tout le monde</li>
				<ul>
					<li class='text-muted'>Accéder à l'annuaire en ligne</li>
					<li class='text-muted'>Estampiller des photos à l'effigie de la PC-92 (cartouche)</li>
					<li class='text-muted'>Générer une signature pour vos mails</li>
					<li class='text-muted'>Soumettre des dossiers de recrutement</li>
				</ul>
				<li>Pour les COs</li>
				<ul>
					<li class='text-muted'>Créer ou visualiser les postes de secours sur votre antenne</li>
					<li class='text-muted'>Gérer vos clients favoris pour créer des DPS plus rapidement</li>
					<li class='text-muted'>Faire une recherche de secouristes facilement (renforts)</li>
				</ul>
				<li>Pour la DDO</li>
				<ul>
					<li class='text-muted'>Valider (ou non) les DPS des antennes et du département</li>
					<li class='text-muted'>Accéder rapidement à la liste "à traiter"</li>
					<li class='text-muted'>Transmettre des demandes de DPS à la Préfecture (ou aux autres ADPC)</li>
				</ul>
				<li>Pour les Trésoriers</li>
				<ul>
					<li class='text-muted'>Afficher l'état des recettes opérationnelles et des taxes FNPC et ADPC</li>
					<li class='text-muted'>Calculer l'impôt FNPC au niveau départemental</li>
				</ul>
				<li>Pour les Admins</li>
				<ul>
					<li class='text-muted'>Modifier l'affectation des permissions et des rôles des utiilsateurs</li>
					<li class='text-muted'>Gérer les antennes et leur rattachement administratif</li>
					<li class='text-muted'>Accéder aux paramètres de configuration</li>
					<li class='text-muted'>Gérer les utilisateurs et leur affecter des rôles</li>
					<li class='text-muted'>Changer les numéros de contact des antennes</li>
					<li class='text-muted'>Ajouter ou supprimer des utilisateurs à des listes de diffusion (CE, CEPS, ...)</li>
					<li class='text-muted'>Modifier l'annuaire</li>
				</ul>
			</ul>
		</div>
	  <div class="col-sm-6">
			<h4 class='text-warning'>Vous avez les rôles suivants :</h4>
			<ul>
				<?php
					$roles = $rbac->Users->allRoles($currentUserID);
					foreach ($roles as &$role) {
						$query = "SELECT name FROM sections WHERE number='".$role['Affiliation']."'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
						$cities = mysqli_query($db_link, $query);
						$city = mysqli_fetch_array($cities);
						echo "<li>".htmlentities($role['Description'])." (".htmlentities($city['name']).")</li>";
						$permissions = $rbac->Roles->Permissions($role['ID']);
						echo '<ul>';
						foreach ($permissions as &$permission) {
							$query = "SELECT Description FROM $tablename_permissions WHERE ID='".$permission."'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
							$real_permissions = mysqli_query($db_link, $query);
							$real_permission = mysqli_fetch_array($real_permissions);
							echo "<li class='text-muted'>".htmlentities($real_permission['Description'])."</li>";
						}
						echo '</ul>';
					}
				?>
			</ul>
		</div>
	</div>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>
