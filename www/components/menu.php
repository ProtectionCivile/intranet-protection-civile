<?php
$query = "SELECT id FROM $tablename_dps WHERE status=1 OR status=2";
$number_dps = mysqli_query($db_link, $query);
$dps_needs_attention = mysqli_num_rows($number_dps);

$sql = "SELECT `id`, `from_addr`, `to_addr`, `cc_addr`, `subject`, `message`, `attachments` FROM $tablename_mail WHERE `date_sent` IS NULL";
$mails = mysqli_query($db_link, $sql);
$number_mails = (mysqli_num_rows($mails) > 0) ? mysqli_num_rows($mails) : null ;

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
			<a class="navbar-brand" href="index.php"><?php echo $setting_service->getGeneralSetting('application-header-name');?></a>
		</div>

		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-home'></span> Operationnel <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<?php if ($rbac->check("ope-dps-validate-ddo-to-pref", $currentUserID)) {?>
							<li class="dropdown-header">Direction départementale</li>
							<li><a href="dps-list.php?atraiter"><span class='glyphicon glyphicon-fire'></span> En attente de validation <span class="badge"><?php echo $dps_needs_attention;?></span></a></li>
						<?php } ?>
						<?php if ($rbac->check("ope-dps-view-own", $currentUserID) || $rbac->check("ope-dps-view-all", $currentUserID) || $rbac->check("ope-dps-view-dept", $currentUserID)) { ?>
							<li class="divider"></li>
							<li class="dropdown-header">Postes existants</li>
							<?php if ($rbac->check("ope-dps-view-own", $currentUserID)) {?>
								<li><a href="dps-list.php?own"><span class='glyphicon glyphicon-search'></span> Liste des DPS de mon Antenne</a></li>
							<?php } ?>
							<?php if ($rbac->check("ope-dps-view-dept", $currentUserID) || $rbac->check("ope-dps-view-all", $currentUserID)) {?>
								<li><a href="dps-list.php?dept"><span class='glyphicon glyphicon-search'></span> Liste des DPS départementaux</a></li>
							<?php } ?>
							<?php if ($rbac->check("ope-dps-view-all", $currentUserID)) {?>
								<li><a href="dps-list.php"><span class='glyphicon glyphicon-search'></span> Liste de tous les DPS</a></li>
							<?php } ?>
						<?php } ?>
						<?php if ( $rbac->check("ope-dps-update-own", $currentUserID) || $rbac->check("ope-dps-update-dept", $currentUserID) || $rbac->check("ope-dps-update-all", $currentUserID) ) { ?>
							<li class="divider"></li>
							<li class="dropdown-header">Création</li>
							<?php if ($rbac->check("ope-dps-update-own", $currentUserID) || $rbac->check("ope-dps-update-all", $currentUserID)) {?>
								<li><a href="dps-create.php?city"><span class='glyphicon glyphicon-plus'></span> Créer un DPS local</a></li>
							<?php } ?>
							<?php if ($rbac->check("ope-dps-update-dept", $currentUserID) || $rbac->check("ope-dps-update-all", $currentUserID)) {?>
								<li><a href="dps-create.php?dept"><span class='glyphicon glyphicon-plus'></span> Créer un DPS départemental</a></li>
							<?php } ?>
						<?php } ?>
						<?php if ($rbac->check("treso-dps-view-own", $currentUserID) || $rbac->check("treso-dps-view-all", $currentUserID)) {
							?> <li class="divider"></li> <?php
							?> <li class="dropdown-header">Trésorerie</li> <?php
							if ($rbac->check("treso-dps-view-own", $currentUserID)) {?> <li><a href="tresorerie.php?filter=accepted"><span class='glyphicon glyphicon-piggy-bank'></span> Taxes ADPC et FNPC</a></li> <?php }
							if ($rbac->check("treso-dps-view-all", $currentUserID)) {?> <li><a href="#"><span class='glyphicon glyphicon-usd'></span> Taxe opérationnelle départementale</a></li> <?php }
						} ?>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-apple'></span> Informatique <span class="caret"></span></a>

					<ul class="dropdown-menu" role="menu">
						<?php if ($rbac->check("admin-mailinglist-manage", $currentUserID)) {?>
							<li class="dropdown-header">Listes de diffusion</li>
							<li><a href="mailinglist-add.php"></span><span class='glyphicon glyphicon-plus'></span> Abonnement</a></li>
							<li><a href="mailinglist-delete.php"></span><span class='glyphicon glyphicon-minus'></span> Désabonnement</a></li>
						<?php } ?>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-cog'></span> Paramètres<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class="dropdown-header">Réglages opérationnels</li>
						<?php if ($rbac->check("ope-clients-view-own", $currentUserID) || $rbac->check("ope-clients-view-all", $currentUserID)) {?>
							<li><a href="client-list.php"><span class='glyphicon glyphicon-search'></span> Clients</a></li>
						<?php } ?>
						<li class="divider"></li>
						<?php
						if ($rbac->check("admin-users-view", $currentUserID) || $rbac->check("admin-sections-view", $currentUserID)) {
							?> <li class="dropdown-header">Administration</li> <?php
							if ($rbac->check("admin-users-view", $currentUserID)) {?> <li><a href="user-list.php"><span class='glyphicon glyphicon-user'></span> Utilisateurs</a></li> <?php }
							if ($rbac->check("admin-sections-view", $currentUserID)) {?> <li><a href="section-list.php"><span class='glyphicon glyphicon-tent'></span> Antennes</a></li> <?php }
						}

						if ($rbac->check("admin-settings-view", $currentUserID)) {
							?> <li class="divider"></li> <?php
							?> <li class="dropdown-header">Paramètres du site</li> <?php
							?> <li><a href="setting-list.php"><span class='glyphicon glyphicon-wrench'></span> Paramètres</a></li> <?php
							?> <li><a href="mailsetting-list.php"><span class='glyphicon glyphicon-envelope'></span> Paramètres mail</a></li> <?php
						}

						if ($rbac->check("admin-roles-view", $currentUserID) || $rbac->check("admin-permissions-view", $currentUserID)) {
							?> <li class="divider" ></li> <?php
							?> <li class="dropdown-header">Sécurité</li> <?php
							if ($rbac->check("admin-roles-view", $currentUserID)) {?> <li><a href="role-list.php"><span class='glyphicon glyphicon-knight'></span> Rôles (fonctions)</a></li> <?php }
							if ($rbac->check("admin-permissions-view", $currentUserID)) {?> <li><a href="permission-list.php"><span class='glyphicon glyphicon-ok'></span> Permissions</a></li> <?php }
							if ($rbac->check("admin-roles-view", $currentUserID)) {?> <li><a href="view-all-users-with-roles.php"><span class='glyphicon glyphicon-search'></span> Utilisateurs par rôle</a></li> <?php }
							if ($rbac->check("admin-permissions-view", $currentUserID)) {?> <li><a href="view-all-permissions-with-roles.php"><span class='glyphicon glyphicon-search'></span> Habilitations par rôle</a></li> <?php }
						} ?>
					</ul>
				</li>
				<?php if ($rbac->check("directory-view", $currentUserID)) { ?>
					<li><a href="#"><span class='glyphicon glyphicon-phone-alt'></span> Annuaire</a></li>
				<?php } ?>
				<li><a href="online-help.php"><span class='glyphicon glyphicon-question-sign'></span> Aide</a></li>

			</ul>

			<ul class="nav navbar-nav navbar-right">

				<?php if ($rbac->check("admin-settings-view", $currentUserID)) { ?>
					<p class="navbar-text"><span class="badge" title='Nombre de mails en attente d&alt;envoi'><?php echo $number_mails;?></span></p>
				<?php } ?>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo ucfirst(htmlentities($currentUserFirstName));?> <?php echo mb_strtoupper($currentUserLastName);?> <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li class="disabled"><a href="modifier-mdp.php">Modifier son mot de passe</a></li>
						<li><a href="logout.php"><span class='glyphicon glyphicon-off'></span> Déconnexion</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
