<?php 
require_once('../functions/session/db-connect.php');
require_once('../PhpRbac/src/PhpRbac/Rbac.php');
use PhpRbac\Rbac;
$rbac = new Rbac();
session_start();
?>

<html>
<head>
	<title>Installation des rôles et permissions</title>
	<meta http-equiv="Content-Type" content="text/html">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>

<?php 


if(!isset($_GET["confirm"])){
	echo ("NOT AUTHORIZED TO PERFORM OPERATION");
	exit();
}

echo ("Démarrage : ".date("H:i:s"));

/////////////////////////////////////////////////
// RESET THE PHPRBAC SYSTEM
/////////////////////////////////////////////////
$rbac->reset(true);



/////////////////////////////////////////////////
// INITIALIZING PERMISSIONS SYSTEM
/////////////////////////////////////////////////
$rbac->Permissions->addPath('/admin-settings-update/admin-settings-view', array('Modifier les réglages','Voir les réglages'));
$rbac->Permissions->addPath('/admin-roles-update/admin-roles-view', array('Modifier les rôles','Voir les rôles'));
$rbac->Permissions->addPath('/admin-permissions-update/admin-permissions-view', array('Modifier les permissions','Voir les permissions'));
$rbac->Permissions->addPath('/admin-asssign-roles-to-users/admin-users-update/admin-users-view', array('Assigner des rôles aux utilisateurs','Modifier les utilisateurs','Voir les utilisateurs'));
$rbac->Permissions->addPath('/ope-dps-validate-local/ope-dps-create-own/ope-dps-view-own', array('Valider une demande de DPS pour sa commune','Créer un DPS sur sa commune', 'Voir les DPS de sa commune'));
$rbac->Permissions->addPath('/ope-dps-validate-ddo-to-pref/ope-dps-create-all/ope-dps-view-all', array('Envoyer une demande de DPS à la Préfecture','Créer un DPS sur toute commune', 'Voir les DPS de toutes les communes'));
$rbac->Permissions->addPath('/ope-clients-update-own/ope-clients-view-own', array('Voir ses clients','Modifier ses clients'));
$rbac->Permissions->addPath('/ope-clients-update-all/ope-clients-view-all', array('Voir tous les clients','Modifier tous les clients'));
$rbac->Permissions->addPath('/directory-update/directory-view', array('Modifier annuaire','Voir anuaire'));
$rbac->Permissions->addPath('/admin-mailinglist-manage', array('Gestion des listes de diffusion'));
$rbac->Permissions->addPath('/admin-communes-update/admin-communes-view', array('Modifier les communes','Voir les communes'));
// Trésorerie ?
// Devis ?
// Factures ?


/////////////////////////////////////////////////
// INITIALIZING ROLES SYSTEM
/////////////////////////////////////////////////
$rbac->Roles->add('Président', 'Président départemental');
$rbac->Roles->add('Vice-Président-1', '1er Vice-Président départemental');
$rbac->Roles->add('Vice-Président-2', '2nd Vice-Président départemental');
$rbac->Roles->add('Secrétaire', 'Secrétaire général');
$rbac->Roles->add('Secrétaire Adjoint', 'Secrétaire général adjoint');
$rbac->Roles->add('Trésorier', 'Trésorier départemental');
$rbac->Roles->add('Trésorier Adjoint', 'Trésorier départemental adjoint');
$rbac->Roles->add('DDO', 'Directeur Départemental des Opérations');
$rbac->Roles->add('DDO-A', 'Directrice Départementale des Opérations adjointe');
$rbac->Roles->add('DDO-B', 'Directrice Départementale des Opérations adjointe aux réseau de secours');
$rbac->Roles->add('DDO-C', 'Directeur Départemental des Opérations adjoint aux missions départementales et nationales');
$rbac->Roles->add('DDASS', 'Directrice Départementale des Actions Solidaires et Sociales');
$rbac->Roles->add('DDC', 'Directeur Départemental de la Communication');
$rbac->Roles->add('DDT', 'Directeur Départemental Technique');
$rbac->Roles->add('DDT-T', 'Directeur Départemental Technique adjoint aux moyens de trasnmission');
$rbac->Roles->add('DDT-L', 'Directeur Départemental Technique adjoint aux moyens logistiques');
$rbac->Roles->add('DDT-I', 'Directeur Départemental Technique adjoint aux moyens informatiques');
$rbac->Roles->add('DDF', 'Directeur Départemental des Formations');
$rbac->Roles->add('CM-FOR-ARS', 'Chargé de Mission responsable des formations ARS');
$rbac->Roles->add('CM-FOR-OPR', 'Chargé de Mission responsable des formations OPR');
$rbac->Roles->add('CM-FOR-CH', 'Chargé de Mission responsable des formations Conducteur');
$rbac->Roles->add('CM-FOR-CE', 'Chargé de Mission responsable des formations CE / CP / CEPS');
$rbac->Roles->add('V-COM', 'Communication');
$rbac->Roles->add('MED', 'Médecin Référent');
$rbac->Roles->add('CM-PARAMED', 'Chargé de Mission responsable de l\'équipe paramédicale');
$rbac->Roles->add('CM-CODEP', 'Chargé de Mission responsable des CODEP et Exercices');
$rbac->Roles->add('V-CODEP', 'Cadre Opérationnel Départemental de permanence');
$rbac->Roles->add('V-PERM-BUREAU', 'Permanence Bureau Départemental');


/////////////////////////////////////////////////
// ADD EXTRA COLUMNS TO ROLES TABLE
/////////////////////////////////////////////////
$query = "ALTER TABLE `rbac_roles` 
	ADD `Phone` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `Description`,
	ADD `Mail` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `Phone`,
	ADD `Affiliation` INT(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `Mail`,
	ADD `Callsign` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `Affiliation`,
	ADD `Directory` boolean CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `Callsign`,
	ADD `Assignable` boolean CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `Assignable`,
	ADD `Hierarchy` INT(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `Assignable`,
	ADD `Tags` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL AFTER `Directory`
" or die("Erreur lors de la mise a jour" . mysqli_error($link)); 
$exec = mysqli_query($link, $query);



/////////////////////////////////////////////////
// ADD ALL MISSING INFORMATION ABOUT ROLES
/////////////////////////////////////////////////
mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='06 74 95 31 72', 
	`Mail`='president@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Autorité 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='vice-president-1@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Autorité 92 Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Bureau|Président'
	WHERE `Title`='Vice-Président-1' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='vice-president-2@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Autorité 92 Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Bureau|Président'
	WHERE `Title`='Vice-Président-2' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='06 76 45 79 81', 
	`Mail`='secretaire-general@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Autorité 92 Delta',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='secretaire-general-adj@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Adjoint' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='06 77 46 47 13', 
	`Mail`='tresorier@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='tresorier-adj@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Adjoint' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='06 74 95 31 75', 
	`Mail`='directeur-operations@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Opé 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DDO' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='06 74 95 31 65', 
	`Mail`='directeur-adj-operations@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Opé 92 Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DDO-A' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='06 74 95 31 73', 
	`Mail`='directeur-adj-reseau-secours@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Opé 92 Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DDO-B' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='directeur-adj-dispositif@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Opé 92 Charlie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DDO-C' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='06 32 98 XX XX', 
	`Mail`='directeur-actions-sociales@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Acso 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DDASS' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='06 89 17 80 43', 
	`Mail`='directeur-communication@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='COM 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DDC' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='06 32 98 XX XX', 
	`Mail`='directeur-technique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Tech 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DDT' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='directeur-adj-transmissions@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Tech 92 Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DDT-T' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='06 74 95 31 57', 
	`Mail`='directeur-adj-logistique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Tech 92 Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DDT-L' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='directeur-adj-informatique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Tech 92 Charlie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Technique'
	WHERE `Title`='DDT-I' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='directeur-formations@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='For 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DDF' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='formation-ars@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='CM-FOR-ARS' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='CM-FOR-OPR' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='formation-ceps@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='CM-FOR-CE' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='formation-conducteur@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='CM-FOR-CH' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='communication@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='2',
	`Tags`='Communication'
	WHERE `Title`='V-COM' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='medica92@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Medica 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Médical'
	WHERE `Title`='MED' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='paramedical@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Paramed 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Médical'
	WHERE `Title`='CM-PARAMED' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='directeur-adj-cadre-permanence@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='5',
	`Tags`='Opérationnel'
	WHERE `Title`='CM-CODEP' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='permanence-operationnel@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='VISU 92',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='5',
	`Tags`='Opérationnel'
	WHERE `Title`='V-CODEP' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='permanence-bureau@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='5',
	`Tags`='Bureau'
	WHERE `Title`='V-PERM-BUREAU' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 


















mysqli_query($link, "UPDATE `rbac_roles` SET 
	`Phone`='', 
	`Mail`='XXXXXXXXXXXXXXXXXXXXXXXXXXXX@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='XXXXXXXXXXXXXXXXXXXXXXXXXXXX',
	`Directory`='1',
	`Assignable`='1'
	`Tags`='XXXXXXXXXXXXXXXXXXXXXXXXXXXX'
	WHERE `Title`='XXXXXXXXXXXXXXXXXXXXXXXXXXXX' 
" or die("Erreur lors de la mise a jour" . mysqli_error($link))); 

/////////////////////////////////////////////////
// DEFAULT PERMISSIONS FOR ROLES
/////////////////////////////////////////////////
$rbac->Roles->assign('Président', 'admin-settings-view');
$rbac->Roles->assign('Président', 'admin-roles-view');
$rbac->Roles->assign('Président', 'admin-permissions-view');
$rbac->Roles->assign('Président', 'admin-asssign-roles-to-users');
$rbac->Roles->assign('Président', 'ope-dps-view-all');
$rbac->Roles->assign('Président', 'ope-clients-view-all');
$rbac->Roles->assign('Président', 'admin-communes-update');
$rbac->Roles->assign('Président', 'directory-view');
$rbac->Roles->assign('Vice-Président-1', 'admin-settings-view');
$rbac->Roles->assign('Vice-Président-1', 'admin-roles-view');
$rbac->Roles->assign('Vice-Président-1', 'admin-permissions-view');
$rbac->Roles->assign('Vice-Président-1', 'admin-asssign-roles-to-users');
$rbac->Roles->assign('Vice-Président-1', 'ope-dps-view-all');
$rbac->Roles->assign('Vice-Président-1', 'ope-clients-view-all');
$rbac->Roles->assign('Vice-Président-1', 'admin-communes-update');
$rbac->Roles->assign('Vice-Président-1', 'directory-view');
$rbac->Roles->assign('Vice-Président-2', 'admin-settings-view');
$rbac->Roles->assign('Vice-Président-2', 'admin-roles-view');
$rbac->Roles->assign('Vice-Président-2', 'admin-permissions-view');
$rbac->Roles->assign('Vice-Président-2', 'admin-asssign-roles-to-users');
$rbac->Roles->assign('Vice-Président-2', 'ope-dps-view-all');
$rbac->Roles->assign('Vice-Président-2', 'ope-clients-view-all');
$rbac->Roles->assign('Vice-Président-2', 'admin-communes-update');
$rbac->Roles->assign('Vice-Président-2', 'directory-view');
$rbac->Roles->assign('Secrétaire', 'admin-settings-view');
$rbac->Roles->assign('Secrétaire', 'admin-roles-update');
$rbac->Roles->assign('Secrétaire', 'admin-permissions-view');
$rbac->Roles->assign('Secrétaire', 'admin-asssign-roles-to-users');
$rbac->Roles->assign('Secrétaire', 'ope-dps-view-all');
$rbac->Roles->assign('Secrétaire', 'ope-clients-update-all');
$rbac->Roles->assign('Secrétaire', 'admin-communes-update');
$rbac->Roles->assign('Secrétaire', 'directory-update');
$rbac->Roles->assign('Secrétaire', 'admin-mailinglist-manage');
$rbac->Roles->assign('Secrétaire Adjoint', 'admin-settings-view');
$rbac->Roles->assign('Secrétaire Adjoint', 'admin-roles-update');
$rbac->Roles->assign('Secrétaire Adjoint', 'admin-permissions-view');
$rbac->Roles->assign('Secrétaire Adjoint', 'admin-asssign-roles-to-users');
$rbac->Roles->assign('Secrétaire Adjoint', 'ope-dps-view-all');
$rbac->Roles->assign('Secrétaire Adjoint', 'ope-clients-update-all');
$rbac->Roles->assign('Secrétaire Adjoint', 'admin-communes-update');
$rbac->Roles->assign('Secrétaire Adjoint', 'directory-update');
$rbac->Roles->assign('Trésorier', 'ope-dps-view-all');
$rbac->Roles->assign('Trésorier', 'ope-clients-view-all');
$rbac->Roles->assign('Trésorier', 'admin-communes-view');
$rbac->Roles->assign('Trésorier', 'directory-view');
$rbac->Roles->assign('Trésorier Adjoint', 'ope-dps-view-all');
$rbac->Roles->assign('Trésorier Adjoint', 'ope-clients-view-all');
$rbac->Roles->assign('Trésorier Adjoint', 'admin-communes-view');
$rbac->Roles->assign('Trésorier Adjoint', 'directory-view');
$rbac->Roles->assign('DDO', 'admin-settings-view');
$rbac->Roles->assign('DDO', 'admin-roles-view');
$rbac->Roles->assign('DDO', 'admin-permissions-view');
$rbac->Roles->assign('DDO', 'ope-dps-validate-ddo-to-pref');
$rbac->Roles->assign('DDO', 'ope-clients-update-all');
$rbac->Roles->assign('DDO', 'admin-communes-view');
$rbac->Roles->assign('DDO', 'directory-view');
$rbac->Roles->assign('DDO-A', 'admin-roles-view');
$rbac->Roles->assign('DDO-A', 'admin-permissions-view');
$rbac->Roles->assign('DDO-A', 'ope-dps-validate-ddo-to-pref');
$rbac->Roles->assign('DDO-A', 'ope-clients-update-all');
$rbac->Roles->assign('DDO-A', 'admin-communes-view');
$rbac->Roles->assign('DDO-A', 'directory-view');
$rbac->Roles->assign('DDO-B', 'ope-dps-view-all');
$rbac->Roles->assign('DDO-B', 'admin-communes-view');
$rbac->Roles->assign('DDO-B', 'directory-view');
$rbac->Roles->assign('DDO-C', 'ope-dps-validate-local');
$rbac->Roles->assign('DDO-C', 'ope-dps-view-all');
$rbac->Roles->assign('DDO-C', 'ope-clients-update-own');
$rbac->Roles->assign('DDO-C', 'admin-communes-view');
$rbac->Roles->assign('DDO-C', 'directory-view');
$rbac->Roles->assign('DDASS', 'admin-communes-view');
$rbac->Roles->assign('DDASS', 'directory-view');
$rbac->Roles->assign('DDC', 'ope-dps-view-all');
$rbac->Roles->assign('DDC', 'admin-communes-view');
$rbac->Roles->assign('DDC', 'directory-view');
$rbac->Roles->assign('DDT', 'admin-settings-view');
$rbac->Roles->assign('DDT', 'admin-roles-view');
$rbac->Roles->assign('DDT', 'admin-permissions-view');
$rbac->Roles->assign('DDT', 'admin-users-view');
$rbac->Roles->assign('DDT', 'admin-communes-view');
$rbac->Roles->assign('DDT', 'directory-view');
$rbac->Roles->assign('DDT-T', 'admin-communes-view');
$rbac->Roles->assign('DDT-T', 'directory-view');
$rbac->Roles->assign('DDT-L', 'admin-communes-view');
$rbac->Roles->assign('DDT-L', 'directory-view');
$rbac->Roles->assign('DDT-I', 'admin-settings-update');
$rbac->Roles->assign('DDT-I', 'admin-roles-update');
$rbac->Roles->assign('DDT-I', 'admin-permissions-update');
$rbac->Roles->assign('DDT-I', 'admin-asssign-roles-to-users');
$rbac->Roles->assign('DDT-I', 'ope-dps-view-all');
$rbac->Roles->assign('DDT-I', 'ope-clients-update-all');
$rbac->Roles->assign('DDT-I', 'admin-communes-update');
$rbac->Roles->assign('DDT-I', 'directory-update');
$rbac->Roles->assign('DDT-I', 'admin-mailinglist-manage');
$rbac->Roles->assign('DDF', 'admin-roles-view');
$rbac->Roles->assign('DDF', 'admin-permissions-view');
$rbac->Roles->assign('DDF', 'admin-communes-view');
$rbac->Roles->assign('DDF', 'directory-view');
$rbac->Roles->assign('CM-FOR-ARS', 'admin-communes-view');
$rbac->Roles->assign('CM-FOR-ARS', 'directory-view');
$rbac->Roles->assign('CM-FOR-OPR', 'admin-communes-view');
$rbac->Roles->assign('CM-FOR-OPR', 'directory-view');
$rbac->Roles->assign('CM-FOR-CH', 'admin-communes-view');
$rbac->Roles->assign('CM-FOR-CH', 'directory-view');
$rbac->Roles->assign('CM-FOR-CE', 'admin-communes-view');
$rbac->Roles->assign('CM-FOR-CE', 'directory-view');
$rbac->Roles->assign('MED', 'admin-communes-view');
$rbac->Roles->assign('MED', 'directory-view');
$rbac->Roles->assign('CM-PARAMED', 'admin-communes-view');
$rbac->Roles->assign('CM-PARAMED', 'directory-view');
$rbac->Roles->assign('CM-CODEP', 'admin-communes-view');
$rbac->Roles->assign('CM-CODEP', 'directory-view');


$rbac->Users->assign('DDT-I', $_SESSION["ID"]);
/////////////////////////////////////////////////
// END OF INSTALLATION SCRIPT
/////////////////////////////////////////////////

?>
<br />
C'est fini : <?php echo date("H:i:s"); ?>
</body>
</html>
