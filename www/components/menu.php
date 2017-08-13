<?php
$query = "SELECT status_validation_dlo_date, status_validation_ddo_date, cu_year FROM $tablename_dps WHERE status=1";
$number_dps = mysqli_query($db_link, $query);
$row_cnt = mysqli_num_rows($number_dps);

$query = "SELECT * FROM $tablename_settings_general WHERE name='application-header-name'";
$query_result = mysqli_query($db_link, $query);
$settings_array = mysqli_fetch_array($query_result);

?>

<div class="navbar navbar-default navbar-static-top " role="navigation">


	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">
				<!-- <img alt="Brand" class="img-responsive" src='img/logos/logo.png'> -->
			</a>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"><?php echo $settings_array['value'];?></a>
		</div>

		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class='glyphicon glyphicon-home'></span> Accueil</a></li>
				<li><a href="http://franceprotectioncivile.org" target="_blank">e-Protec</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-check'></span> Operationnel <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class="dropdown-header">Direction départementale</li>
						<li><a href="dps-list.php?atraiter"><span class='glyphicon glyphicon-fire'></span> A traiter <span class="badge"><?php echo $row_cnt;?></span></a></li>
						<li class="divider"></li>
						<li class="dropdown-header">Gestion des DPS</li>
						<?php if ($rbac->check("ope-dps-view-own", $currentUserID)) {?>
							<li><a href="dps-list.php?city"><span class='glyphicon glyphicon-search'></span> Liste des DPS de mon Antenne</a></li>
						<?php } ?>
						<?php if ($rbac->check("ope-dps-view-dept", $currentUserID) || $rbac->check("ope-dps-view-all", $currentUserID)) {?>
							<li><a href="dps-list.php?dept"><span class='glyphicon glyphicon-search'></span> Liste des DPS départementaux</a></li>
						<?php } ?>
						<?php if ($rbac->check("ope-dps-view-all", $currentUserID)) {?>
							<li><a href="dps-list.php"><span class='glyphicon glyphicon-search'></span> Liste de tous les DPS</a></li>
						<?php } ?>
						<li class="divider"></li>
						<?php if ($rbac->check("ope-dps-create-own", $currentUserID) || $rbac->check("ope-dps-create-all", $currentUserID)) {?>
							<li><a href="dps-create.php?city"><span class='glyphicon glyphicon-tasks'></span> Créer un DPS local</a></li>
						<?php } ?>
						<?php if ($rbac->check("ope-dps-create-dept", $currentUserID) || $rbac->check("ope-dps-create-all", $currentUserID)) {?>
							<li><a href="dps-create.php?dept"><span class='glyphicon glyphicon-tasks'></span> Créer un DPS départemental</a></li>
						<?php } ?>
						<li class="divider"></li>
						<li class="dropdown-header">Réglages opérationnels</li>
						<li><a href="list-organisateur.php"><span class='glyphicon glyphicon-user'></span> Liste des organisateurs</a></li>
						<li><a href="add-organisateur.php"><span class='glyphicon glyphicon-user'></span><span class='glyphicon glyphicon-plus'></span> Ajouter un organisateur</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-folder-open'></span> Finances<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class="dropdown-header">Trésorerie</li>
						<li><a href="tresorerie.php?filter=accepted"><span class='glyphicon glyphicon-piggy-bank'></span> Trésorerie</a></li>
						<li><a href="devis.php"><span class='glyphicon glyphicon-usd'></span> Devis</a></li>
						<li><a href="factures.php"><span class='glyphicon glyphicon-list-alt'></span> Factures</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-apple'></span> Informatique <span class="caret"></span></a>

					<ul class="dropdown-menu" role="menu">
						<?php if ($rbac->check("admin-mailinglist-manage", $currentUserID)) {?>
							<li class="dropdown-header">Listes de diffusion</li>
							<li><a href="mailinglist-add.php"><span class='glyphicon glyphicon-align-justify'></span><span class='glyphicon glyphicon-plus'></span> Abonnement</a></li>
							<li><a href="mailinglist-delete.php"><span class='glyphicon glyphicon-align-justify'></span><span class='glyphicon glyphicon-minus'></span> Désabonnement</a></li>
						<?php } ?>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-cog'></span> Paramètres<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<?php
						if ($rbac->check("admin-users-view", $currentUserID) || $rbac->check("admin-sections-view", $currentUserID)) {
							?> <li class="dropdown-header">Réglages communs</li> <?php
							if ($rbac->check("admin-users-view", $currentUserID)) {?> <li><a href="user-list.php"><span class='glyphicon glyphicon-user'></span> Gestion des utilisateurs</a></li> <?php }
							if ($rbac->check("admin-sections-view", $currentUserID)) {?> <li><a href="section-list.php"><span class='glyphicon glyphicon-tent'></span> Liste des communes</a></li> <?php }
						}

						if ($rbac->check("admin-settings-view", $currentUserID)) {
							?> <li class="divider" /> <?php
							?> <li class="dropdown-header">Paramètres</li> <?php
							?> <li><a href="setting-list.php"><span class='glyphicon glyphicon-wrench'></span> Liste des paramètres</a></li> <?php
							?> <li><a href="mailsetting-list.php"><span class='glyphicon glyphicon-envelope'></span> Liste des paramètres mail</a></li> <?php
						}

						if ($rbac->check("admin-roles-view", $currentUserID) || $rbac->check("admin-permissions-view", $currentUserID)) {
							?> <li class="divider" /> <?php
							?> <li class="dropdown-header">Sécurité</li> <?php
							if ($rbac->check("admin-roles-view", $currentUserID)) {?> <li><a href="role-list.php"><span class='glyphicon glyphicon-knight'></span> Gestion des rôles</a></li> <?php }
							if ($rbac->check("admin-permissions-view", $currentUserID)) {?> <li><a href="permission-list.php"><span class='glyphicon glyphicon-ok'></span> Gestion des permissions</a></li> <?php }
							if ($rbac->check("admin-roles-view", $currentUserID)) {?> <li><a href="view-all-users-with-roles.php"><span class='glyphicon glyphicon-search'></span> Utilisateurs par rôle</a></li> <?php }
							if ($rbac->check("admin-permissions-view", $currentUserID)) {?> <li><a href="view-all-permissions-with-roles.php"><span class='glyphicon glyphicon-search'></span> Habilitations par rôle</a></li> <?php }
						} ?>
					</ul>
				</li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo ucwords($currentUserFirstName);?> <?php echo strtoupper($currentUserLastName);?> <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class="disabled"><a href="modifier-mdp.php">Modifier son mot de passe</a></li>
						<li><a href="logout.php">Déconnexion</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
