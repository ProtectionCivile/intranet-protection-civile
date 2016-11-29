<?php
require_once ('PhpRbac/src/PhpRbac/Rbac.php');
?>
<html>
<head>
	<title>Installation des rôles et permissions</title>
	<meta http-equiv="Content-Type" content="text/html">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>

Démarrage : <?php echo date("H:i:s");

use PhpRbac\Rbac;
$rbac = new Rbac();

$rbac->Permissions->reset(true);

$settings_descriptions = array('Modifier les réglages','Voir les réglages');
$rbac->Permissions->addPath('/admin-settings-update/admin-settings-view', $settings_descriptions);

$roles_descriptions = array('Modifier les rôles','Voir les rôles');
$rbac->Permissions->addPath('/admin-roles-update/admin-roles-view', $roles_descriptions);

$permissions_descriptions = array('Modifier les permissions','Voir les permissions');
$rbac->Permissions->addPath('/admin-permissions-update/admin-permissions-view', $permissions_descriptions);

$users_descriptions = array('Assigner des rôles aux utilisateurs','Modifier les utilisateurs','Voir les utilisateurs');
$rbac->Permissions->addPath('/admin-asssign-roles-to-users/admin-users-update/admin-users-view', $users_descriptions);

$own_dps_descriptions = array('Valider une demande de DPS pour sa commune','Créer un DPS sur sa commune', 'Voir les DPS de sa commune');
$rbac->Permissions->addPath('/ope-dps-validate-local/ope-dps-create-own/ope-dps-view-own', $own_dps_descriptions);

$all_dps_descriptions = array('Envoyer une demande de DPS à la Préfecture','Créer un DPS sur toute commune', 'Voir les DPS de toutes les communes');
$rbac->Permissions->addPath('/ope-dps-validate-ddo-to-pref/ope-dps-create-all/ope-dps-view-all', $all_dps_descriptions);

$directory_descriptions = array('Modifier annuaire','Voir anuaire');
$rbac->Permissions->addPath('/directory-update/directory-view', $directory_descriptions);

$mailinglists_descriptions = array('Gestion des listes de diffusion');
$rbac->Permissions->addPath('/admin-mailinglist-manage', $mailinglists_descriptions);

$communes_descriptions = array('Modifier les communes','Voir les communes');
$rbac->Permissions->addPath('/admin-communes-update/admin-communes-view', $communes_descriptions);



//$rbac->Roles->reset(true);


?>
<br />
C'est fini : <?php echo date("H:i:s"); ?>
</body>
</html>
