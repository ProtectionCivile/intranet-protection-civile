<?php
$query = "SELECT valid_demande_rt, valid_demande_dps, annee_poste FROM demande_dps WHERE valid_demande_rt NOT LIKE '0000-00-00' AND valid_demande_dps LIKE '0000-00-00'";
$number_dps = mysqli_query($link, $query);
$row_cnt = mysqli_num_rows($number_dps);

$query = "SELECT * FROM settings WHERE setting_name='name'";
$query_result = mysqli_query($link, $query);
$settings_array = mysqli_fetch_array($query_result);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>

<div class="navbar navbar-default navbar-static-top " role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="accueil.php"><?php echo $settings_array['setting_value'];?></a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="accueil.php">Accueil</a></li>
				<li><a href="#">Lien</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Operationnel <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class="dropdown-header">Direction départementale</li>
						<li><a href="list-dps.php?filter=en-attente">A traîter <span class="badge"><?php echo $row_cnt;?></span></a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Gestion des DPS</li>
						<li><a href="list-dps.php?commune=<?php echo $_SESSION["commune"]; ?>">Liste des DPS de l'Antenne</a></li>
						<li><a href="list-dps.php">Liste de tous les DPS</a></li>
						<li class="divider"></li>
						<li><a href="demande-dps.php">Demande de DPS</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Réglages oppérationnels</li>
						<li><a href="list-organisateur.php">Liste des organisateurs</a></li>
						<li><a href="add-organisateur.php">Ajouter un organisateur</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Bureau <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class="dropdown-header">Trésorerie</li>
						<li><a href="tresorerie.php?filter=accepted">Trésorerie</a></li>
						<li><a href="devis.php">Devis</a></li>
						<li><a href="factures.php">Factures</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Informatique <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class="dropdown-header">Informatique</li>
						<li><a href="mailinglist-manage.php">Listes de diffusion</a></li>
					</ul>
				</li>

<?php if ($_SESSION['privilege'] == "admin") {?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Administration <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class="dropdown-header">Réglages communs</li>
						<li><a href="user-view.php">Gestion des utilisateurs</a></li>
						<li><a href="liste-commune.php">Liste des communes</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Paramètres</li>
						<li><a href="liste-settings.php">Liste des paramètres</a></li>
						<li><a href="liste-settings_mail.php">Liste des paramètres mail</a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Sécurité</li>
						<li><a href="role-view.php">Gestion des rôles</a></li>
						<li><a href="permission-view.php">Gestion des permissions</a></li>
						<li><a href="view-all-users-with-roles.php">Audit des rôles d'utilisateurs</a></li>
					</ul>
				</li>
<?php }?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['prenom'];?> <?php echo $_SESSION['nom'];?> <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class="disabled"><a href="modifier-mdp.php">Modifier son mot de passe</a></li>
						<li><a href="index.php?erreur=logout">Déconnexion</a></li>
					</ul>
				</li>	
			</ul>	
		</div>	<!--/.nav-collapse -->
	</div>
</div>
