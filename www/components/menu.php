<?php 
$query = "SELECT valid_demande_rt, valid_demande_dps, annee_poste FROM demande_dps WHERE valid_demande_rt NOT LIKE '0000-00-00' AND valid_demande_dps LIKE '0000-00-00'";
$number_dps = mysqli_query($link, $query);
$row_cnt = mysqli_num_rows($number_dps);

$query = "SELECT * FROM settings WHERE setting_name='name'";
$query_result = mysqli_query($link, $query);
$settings_array = mysqli_fetch_array($query_result);

?>



<div class="navbar navbar-default navbar-static-top " role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="home.php"><?php echo $settings_array['setting_value'];?></a>
		</div>

		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Accueil</a></li>
				<li><a href="#">Lien</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Operationnel <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class="dropdown-header">Direction départementale</li>
						<li><a href="list-dps.php?filter=en-attente">A traiter <span class="badge"><?php echo $row_cnt;?></span></a></li>
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
						<?php if ($rbac->check("admin-mailinglist-manage", $currentUserID)) {?> <li><a href="mailinglist-manage.php">Listes de diffusion</a></li> <?php } ?>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle glyphicon glyphicon-cog" data-toggle="dropdown"><span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<?php 
						if ($rbac->check("admin-users-view", $currentUserID) || $rbac->check("admin-communes-view", $currentUserID)) { 
							?> <li class="dropdown-header">Réglages communs</li> <?php
							if ($rbac->check("admin-users-view", $currentUserID)) {?> <li><a href="user-view.php">Gestion des utilisateurs</a></li> <?php }
							if ($rbac->check("admin-communes-view", $currentUserID)) {?> <li><a href="liste-commune.php">Liste des communes</a></li> <?php }
						}

						if ($rbac->check("admin-settings-view", $currentUserID)) {
							?> <li class="divider" /> <?php
							?> <li class="dropdown-header">Paramètres</li> <?php
							?> <li><a href="settings-view.php">Liste des paramètres</a></li> <?php
							?> <li><a href="mailsettings-view.php">Liste des paramètres mail</a></li> <?php
						} 

						if ($rbac->check("admin-roles-view", $currentUserID) || $rbac->check("admin-permissions-view", $currentUserID)) {
							?> <li class="divider" /> <?php
							?> <li class="dropdown-header">Sécurité</li> <?php
							if ($rbac->check("admin-roles-view", $currentUserID)) {?> <li><a href="role-view.php">Gestion des rôles</a></li> <?php }
							if ($rbac->check("admin-permissions-view", $currentUserID)) {?> <li><a href="permission-view.php">Gestion des permissions</a></li> <?php }
							if ($rbac->check("admin-roles-view", $currentUserID)) {?> <li><a href="view-all-users-with-roles.php">Audit des rôles d'utilisateurs</a></li> <?php } 
						} ?>
					</ul>
				</li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $currentUserFirstName;?> <?php echo $currentUserLastName;?> <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class="disabled"><a href="modifier-mdp.php">Modifier son mot de passe</a></li>
						<li><a href="logout.php">Déconnexion</a></li>
					</ul>
				</li> 
			</ul> 
		</div>
	</div>
</div>