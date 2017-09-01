<?php require_once('../functions/session/security.php'); ?>
<?php require_once('../PhpRbac/src/PhpRbac/Rbac.php'); ?>
<?php require_once('../functions/session/db-connect.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Installation des rôles et permissions</title>
	<?php require_once('../components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>

<?php
use PhpRbac\Rbac;
$rbac = new Rbac();
?>



<?php


if(!isset($_GET["confirm"])){
	echo ("NOT AUTHORIZED TO PERFORM OPERATION");
	exit();
}

echo ("Démarrage : ".date("H:i:s"));


/////////////////////////////////////////////////
// SQL TABLES
/////////////////////////////////////////////////

mysqli_query($db_link, "ALTER TABLE `ADPC`.`$tablename_roles`
	ADD `Phone` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `Description`,
	ADD `Mail` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `Phone`,
	ADD `Affiliation` INT(10) NULL AFTER `Mail`,
	ADD `Callsign` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `Affiliation`,
	ADD `Directory` INT(2) NULL AFTER `Callsign`,
	ADD `Assignable` INT(2) NULL AFTER `Directory`,
	ADD `Hierarchy` INT(10) NULL AFTER `Assignable`,
	ADD `Tags` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `Hierarchy`
");


/////////////////////////////////////////////////
// RESET THE PHPRBAC SYSTEM
/////////////////////////////////////////////////
$rbac->reset(true);



/////////////////////////////////////////////////
// INITIALIZING PERMISSIONS SYSTEM
/////////////////////////////////////////////////
$rbac->Permissions->addPath('/admin-settings-update/admin-settings-view', array('Modifier les réglages', 'Voir les réglages'));
$rbac->Permissions->addPath('/admin-permissions-update/admin-permissions-view', array('Modifier les permissions', 'Voir les permissions'));
$rbac->Permissions->addPath('/admin-roles-asssign-permissions/admin-roles-update/admin-roles-view', array('Assigner des permissions aux rôles', 'Modifier les rôles', 'Voir les rôles'));
$rbac->Permissions->addPath('/admin-users-asssign-roles/admin-users-update/admin-users-view', array('Assigner des rôles aux utilisateurs', 'Modifier les utilisateurs', 'Voir les utilisateurs'));
$rbac->Permissions->addPath('/ope-dps-validate-local/ope-dps-update-own/ope-dps-view-own', array('Valider une demande de DPS pour sa commune', 'Créer/Modifier un DPS sur sa commune', 'Voir les DPS de sa commune'));
$rbac->Permissions->addPath('/ope-dps-validate-dept/ope-dps-update-dept/ope-dps-view-dept', array('Valider une demande de DPS pour le département', 'Créer/Modifier un DPS sur le département', 'Voir les DPS départementaux'));
$rbac->Permissions->addPath('/ope-dps-validate-ddo-to-pref/ope-dps-update-all/ope-dps-view-all', array('Envoyer une demande de DPS à la Préfecture', 'Créer/Modifier un DPS sur toute commune', 'Voir les DPS de toutes les communes'));
$rbac->Permissions->addPath('/ope-clients-update-own/ope-clients-view-own', array('Modifier les clients de son antenne', 'Voir les clients de son antenne'));
$rbac->Permissions->addPath('/ope-clients-update-all/ope-clients-view-all', array('Modifier tous les clients', 'Voir tous les clients'));
$rbac->Permissions->addPath('/treso-dps-view-all/treso-dps-view-own', array('Voir toute la trésorerie', 'Voir la trésorerie de son antenne'));
$rbac->Permissions->addPath('/directory-update/directory-view', array('Modifier annuaire', 'Voir annuaire'));
$rbac->Permissions->addPath('/admin-mailinglist-manage', array('Gestion des listes de diffusion'));
$rbac->Permissions->addPath('/admin-sections-update/admin-sections-view', array('Modifier les sections', 'Voir les sections'));
// Trésorerie ?
// Factures ?


/////////////////////////////////////////////////
// INITIALIZING ROLES SYSTEM
/////////////////////////////////////////////////
$rbac->Roles->add('Admin', 'Administrateur');
$rbac->Roles->add('Public', 'Public');

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
$rbac->Roles->add('MED', 'Médecin Référent');
$rbac->Roles->add('SECRETARIAT', 'Secrétariat Administratif');

$rbac->Roles->add('CM-FOR-ARS', 'Chargé de Mission responsable des formations ARS');
$rbac->Roles->add('CM-FOR-OPR', 'Chargé de Mission responsable des formations OPR');
$rbac->Roles->add('CM-FOR-CH', 'Chargé de Mission responsable des formations Conducteur');
$rbac->Roles->add('CM-FOR-CE', 'Chargé de Mission responsable des formations CE / CP / CEPS');
$rbac->Roles->add('CM-PARAMED', 'Chargé de Mission responsable de l\'équipe paramédicale');
$rbac->Roles->add('CM-CODEP', 'Chargé de Mission responsable des CODEP et Exercices');

$rbac->Roles->add('V-COM', 'Communication');
$rbac->Roles->add('V-OPE', 'Opérationnel');
$rbac->Roles->add('V-FOR', 'Formation');
$rbac->Roles->add('V-TECH', 'Technique');
$rbac->Roles->add('V-BUREAU', 'Bureau Départemental');
$rbac->Roles->add('V-CD', 'Conseil Départemental');
$rbac->Roles->add('V-RECRUTEMENT', 'Recrutement');
$rbac->Roles->add('V-DEMANDE-DPS', 'Demande de poste de secours');

$rbac->Roles->add('P-CODEP', 'Cadre Opérationnel Départemental de Permanence');
$rbac->Roles->add('P-MICRO', 'Permanence Transmissions');
$rbac->Roles->add('P-TRANSF', 'Permanence de transfert opérationnel');

$rbac->Roles->add('C-LOG', 'Pôle Logistique');
$rbac->Roles->add('C-TRANS', 'Pôle Transmissions');
$rbac->Roles->add('C-INFO', 'Pôle Informatique');

$rbac->Roles->add('D-PRES', 'Liste de diffusion Président');
$rbac->Roles->add('D-SEC', 'Liste de diffusion Secrétaire');
$rbac->Roles->add('D-TRESO', 'Liste de diffusion Trésorier');
$rbac->Roles->add('D-DLO', 'Liste de diffusion Opérationnel');
$rbac->Roles->add('D-DLF', 'Liste de diffusion Formation');
$rbac->Roles->add('D-DLAS', 'Liste de diffusion Actions Sociales');
$rbac->Roles->add('D-DLT', 'Liste de diffusion Technique Logistique');
$rbac->Roles->add('D-DLT-T', 'Liste de diffusion Technique Transmissions');
$rbac->Roles->add('D-DLC', 'Liste de diffusion Communication');

$rbac->Roles->add('Président Asnières', 'Président délégué');
$rbac->Roles->add('Secrétaire Asnières', 'Secrétaire');
$rbac->Roles->add('Trésorier Asnières', 'Trésorier');
$rbac->Roles->add('DLO Asnières', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Asnières', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Asnières', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Asnières', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Asnières', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Asnières', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Asnières', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Asnières', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Asnières', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Asnières', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Asnières', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Asnières', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Boulogne', 'Président délégué');
$rbac->Roles->add('Secrétaire Boulogne', 'Secrétaire');
$rbac->Roles->add('Trésorier Boulogne', 'Trésorier');
$rbac->Roles->add('DLO Boulogne', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Boulogne', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Boulogne', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Boulogne', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Boulogne', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Boulogne', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Boulogne', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Boulogne', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Boulogne', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Boulogne', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Boulogne', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Boulogne', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Bourg-la-Reine', 'Président délégué');
$rbac->Roles->add('Secrétaire Bourg-la-Reine', 'Secrétaire');
$rbac->Roles->add('Trésorier Bourg-la-Reine', 'Trésorier');
$rbac->Roles->add('DLO Bourg-la-Reine', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Bourg-la-Reine', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Bourg-la-Reine', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Bourg-la-Reine', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Bourg-la-Reine', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Bourg-la-Reine', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Bourg-la-Reine', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Bourg-la-Reine', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Bourg-la-Reine', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Bourg-la-Reine', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Bourg-la-Reine', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Bourg-la-Reine', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Clamart', 'Président délégué');
$rbac->Roles->add('Secrétaire Clamart', 'Secrétaire');
$rbac->Roles->add('Trésorier Clamart', 'Trésorier');
$rbac->Roles->add('DLO Clamart', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Clamart', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Clamart', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Clamart', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Clamart', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Clamart', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Clamart', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Clamart', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Clamart', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Clamart', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Clamart', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Clamart', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Clichy', 'Président délégué');
$rbac->Roles->add('Secrétaire Clichy', 'Secrétaire');
$rbac->Roles->add('Trésorier Clichy', 'Trésorier');
$rbac->Roles->add('DLO Clichy', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Clichy', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Clichy', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Clichy', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Clichy', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Clichy', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Clichy', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Clichy', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Clichy', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Clichy', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Clichy', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Clichy', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Colombes', 'Président délégué');
$rbac->Roles->add('Secrétaire Colombes', 'Secrétaire');
$rbac->Roles->add('Trésorier Colombes', 'Trésorier');
$rbac->Roles->add('DLO Colombes', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Colombes', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Colombes', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Colombes', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Colombes', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Colombes', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Colombes', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Colombes', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Colombes', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Colombes', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Colombes', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Colombes', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Courbevoie', 'Président délégué');
$rbac->Roles->add('Secrétaire Courbevoie', 'Secrétaire');
$rbac->Roles->add('Trésorier Courbevoie', 'Trésorier');
$rbac->Roles->add('DLO Courbevoie', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Courbevoie', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Courbevoie', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Courbevoie', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Courbevoie', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Courbevoie', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Courbevoie', 'Directeur Local des Formations adjoint à la formation externe Grand Public');
$rbac->Roles->add('DLF-C Courbevoie', 'Directeur Local des Formations adjoint à la formation externe Grands Comptes');
$rbac->Roles->add('DLAS Courbevoie', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Courbevoie', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Courbevoie', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Courbevoie', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Courbevoie', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Garches', 'Président délégué');
$rbac->Roles->add('Secrétaire Garches', 'Secrétaire');
$rbac->Roles->add('Trésorier Garches', 'Trésorier');
$rbac->Roles->add('DLO Garches', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Garches', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Garches', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Garches', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Garches', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Garches', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Garches', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Garches', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Garches', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Garches', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Garches', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Garches', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Gennevilliers', 'Président délégué');
$rbac->Roles->add('Secrétaire Gennevilliers', 'Secrétaire');
$rbac->Roles->add('Trésorier Gennevilliers', 'Trésorier');
$rbac->Roles->add('DLO Gennevilliers', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Gennevilliers', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Gennevilliers', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Gennevilliers', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Gennevilliers', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Gennevilliers', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Gennevilliers', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Gennevilliers', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Gennevilliers', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Gennevilliers', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Gennevilliers', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Gennevilliers', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Levallois', 'Président délégué');
$rbac->Roles->add('Secrétaire Levallois', 'Secrétaire');
$rbac->Roles->add('Trésorier Levallois', 'Trésorier');
$rbac->Roles->add('DLO Levallois', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Levallois', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Levallois', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Levallois', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Levallois', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Levallois', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Levallois', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Levallois', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Levallois', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Levallois', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Levallois', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Levallois', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Montrouge', 'Président délégué');
$rbac->Roles->add('Secrétaire Montrouge', 'Secrétaire');
$rbac->Roles->add('Trésorier Montrouge', 'Trésorier');
$rbac->Roles->add('DLO Montrouge', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Montrouge', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Montrouge', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Montrouge', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Montrouge', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Montrouge', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Montrouge', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Montrouge', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Montrouge', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Montrouge', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Montrouge', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Montrouge', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Nanterre', 'Président délégué');
$rbac->Roles->add('Secrétaire Nanterre', 'Secrétaire');
$rbac->Roles->add('Trésorier Nanterre', 'Trésorier');
$rbac->Roles->add('DLO Nanterre', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Nanterre', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Nanterre', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Nanterre', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Nanterre', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Nanterre', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Nanterre', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Nanterre', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Nanterre', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Nanterre', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Nanterre', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Nanterre', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Rueil', 'Président délégué');
$rbac->Roles->add('Secrétaire Rueil', 'Secrétaire');
$rbac->Roles->add('Trésorier Rueil', 'Trésorier');
$rbac->Roles->add('DLO Rueil', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Rueil', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Rueil', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Rueil', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Rueil', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Rueil', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Rueil', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Rueil', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Rueil', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Rueil', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Rueil', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Rueil', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Suresnes', 'Président délégué');
$rbac->Roles->add('Secrétaire Suresnes', 'Secrétaire');
$rbac->Roles->add('Trésorier Suresnes', 'Trésorier');
$rbac->Roles->add('DLO Suresnes', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Suresnes', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Suresnes', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Suresnes', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Suresnes', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Suresnes', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Suresnes', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Suresnes', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Suresnes', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Suresnes', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Suresnes', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Suresnes', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Vanves', 'Président délégué');
$rbac->Roles->add('Secrétaire Vanves', 'Secrétaire');
$rbac->Roles->add('Trésorier Vanves', 'Trésorier');
$rbac->Roles->add('DLO Vanves', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Vanves', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Vanves', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Vanves', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Vanves', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Vanves', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Vanves', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Vanves', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Vanves', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Vanves', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Vanves', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Vanves', 'Directeur Local Technique adjoint aux véhicules');

$rbac->Roles->add('Président Villeneuve', 'Président délégué');
$rbac->Roles->add('Secrétaire Villeneuve', 'Secrétaire');
$rbac->Roles->add('Trésorier Villeneuve', 'Trésorier');
$rbac->Roles->add('DLO Villeneuve', 'Directeur Local des Opérations');
$rbac->Roles->add('DLO-A Villeneuve', 'Directeur Local des Opérations adjoint aux missions extérieures');
$rbac->Roles->add('DLO-B Villeneuve', 'Directeur Local des Opérations adjoint au réseau de secours');
$rbac->Roles->add('DLO-C Villeneuve', 'Directeur Local des Opérations adjoint en charge de l\'administratif');
$rbac->Roles->add('DLF Villeneuve', 'Directeur Local des Formations');
$rbac->Roles->add('DLF-A Villeneuve', 'Directeur Local des Formations adjoint à la formation interne');
$rbac->Roles->add('DLF-B Villeneuve', 'Directeur Local des Formations adjoint à la formation externe');
$rbac->Roles->add('DLAS Villeneuve', 'Directeur Local des Actions Solidaires et Sociales');
$rbac->Roles->add('DLC Villeneuve', 'Directeur Local de la Communication');
$rbac->Roles->add('DLT Villeneuve', 'Directeur Local Technique');
$rbac->Roles->add('DLT-L Matér Villeneuve', 'Directeur Local Technique adjoint à la logistique');
$rbac->Roles->add('DLT-L Véhic Villeneuve', 'Directeur Local Technique adjoint aux véhicules');




/////////////////////////////////////////////////
// ADD ALL MISSING INFORMATION ABOUT ROLES
/////////////////////////////////////////////////
mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`=''
	WHERE `Title`='Admin'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`=''
	WHERE `Title`='Public'
");


///////////////////////////////////////////////
// ROLES DEPARTEMENTAUX
///////////////////////////////////////////////

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0674953172',
	`Mail`='president@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Autorité 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='vice-president-1@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Autorité 92 Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Bureau|Président'
	WHERE `Title`='Vice-Président-1'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='vice-president-2@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Autorité 92 Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Bureau|Président'
	WHERE `Title`='Vice-Président-2'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0676457981',
	`Mail`='secretaire-general@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Autorité 92 Delta',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-general-adj@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Adjoint'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0677464713',
	`Mail`='tresorier@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-adj@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Adjoint'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0674953175',
	`Mail`='directeur-operations@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Opé 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DDO'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0674953165',
	`Mail`='directeur-adj-operations@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Opé 92 Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DDO-A'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0674953173',
	`Mail`='directeur-adj-reseau-secours@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Opé 92 Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DDO-B'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='directeur-adj-dispositif@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Opé 92 Charlie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DDO-C'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0632989106',
	`Mail`='directeur-actions-sociales@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Acso 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DDASS'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0689178043',
	`Mail`='directeur-communication@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='COM 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DDC'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0674953159',
	`Mail`='directeur-technique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Tech 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DDT'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0674953162',
	`Mail`='directeur-adj-transmissions@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Tech 92 Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DDT-T'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0674953157',
	`Mail`='directeur-adj-logistique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Tech 92 Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DDT-L'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='directeur-adj-informatique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Tech 92 Charlie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Technique'
	WHERE `Title`='DDT-I'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0676457978',
	`Mail`='directeur-formations@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='For 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DDF'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='medica92@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Medica 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Médical'
	WHERE `Title`='MED'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretariat@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Divers|Opérationnel'
	WHERE `Title`='SECRETARIAT'
");

///////////////////////////////////////////////
// CHARGÉS DE MISSION
///////////////////////////////////////////////

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0676457978',
	`Mail`='formation-ars@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='CM-FOR-ARS'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0676457978',
	`Mail`='',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='CM-FOR-OPR'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0676457978',
	`Mail`='formation-ceps@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='CM-FOR-CE'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0676457978',
	`Mail`='formation-conducteur@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='CM-FOR-CH'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='paramedical@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Paramed 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Médical'
	WHERE `Title`='CM-PARAMED'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='directeur-adj-cadre-permanence@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='5',
	`Tags`='Opérationnel'
	WHERE `Title`='CM-CODEP'
");

///////////////////////////////////////////////
// PÔLES / COMMISSIONS
///////////////////////////////////////////////

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='pole-logistique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='21',
	`Tags`='Commission|Technique'
	WHERE `Title`='C-LOG'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='pole-transmissions@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='22',
	`Tags`='Commission|Technique'
	WHERE `Title`='C-TRANS'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='pole-informatique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='23',
	`Tags`='Commission|Technique'
	WHERE `Title`='C-INFO'
");

///////////////////////////////////////////////
// DIVERS
///////////////////////////////////////////////

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='bureau@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='11',
	`Tags`='Divers|Bureau'
	WHERE `Title`='V-BUREAU'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='conseil-departemental@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='12',
	`Tags`='Divers|Bureau'
	WHERE `Title`='V-CD'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='recrutement@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='12',
	`Tags`='Divers'
	WHERE `Title`='V-RECRUTEMENT'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='demande-dps@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='15',
	`Tags`='Divers|Opérationnel'
	WHERE `Title`='V-DEMANDE-DPS'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='2',
	`Tags`='Communication'
	WHERE `Title`='V-COM'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='V-OPE'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='4',
	`Tags`='Formation'
	WHERE `Title`='V-FOR'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='technique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='5',
	`Tags`='Technique'
	WHERE `Title`='V-TECH'
");

///////////////////////////////////////////////
// PERMANENCES
///////////////////////////////////////////////

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='07 51 60 75 18',
	`Mail`='permanence-bureau@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='5',
	`Tags`='Permanence|Opérationnel'
	WHERE `Title`='P-TRANSF'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0674953170',
	`Mail`='permanence-operationnel@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='VISU 92',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='6',
	`Tags`='Permanence|Opérationnel'
	WHERE `Title`='P-CODEP'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0674953166',
	`Mail`='permanence-transmissions@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='MICRO 92',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='7',
	`Tags`='Permanence|Opérationnel'
	WHERE `Title`='P-MICRO'
");

///////////////////////////////////////////////
// LISTES DE DIFFUSION
///////////////////////////////////////////////

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='antennes-president@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='30',
	`Tags`='Diffusion|Président'
	WHERE `Title`='D-PRES'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='antennes-secretaire@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='30',
	`Tags`='Diffusion|Secrétaire'
	WHERE `Title`='D-SEC'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='antennes-tresorier@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='30',
	`Tags`='Diffusion|Trésorier'
	WHERE `Title`='D-TRESO'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='antennes-operationnel@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='30',
	`Tags`='Diffusion|Opérationnel'
	WHERE `Title`='D-DLO'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='antennes-formation@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='30',
	`Tags`='Diffusion|Formation'
	WHERE `Title`='D-DLF'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='antennes-actions-sociales@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='30',
	`Tags`='Diffusion|Acso'
	WHERE `Title`='D-DLAS'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='antennes-logistique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='30',
	`Tags`='Diffusion|Technique'
	WHERE `Title`='D-DLT'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='antennes-transmissions@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='30',
	`Tags`='Diffusion|Technique'
	WHERE `Title`='D-DLT-T'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='antennes-communication@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='30',
	`Tags`='Diffusion|Communication'
	WHERE `Title`='D-DLC'
");

///////////////////////////////////////////////
// ROLES DES ANTENNES
///////////////////////////////////////////////

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0650842289',
	`Mail`='president-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Autorité Asnières',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Asnières'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Autorité Asnières Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Asnières'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Autorité Asnières Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Asnières'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0664651746',
	`Mail`='operationnel-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Opé Asnières',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Asnières'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Opé Asnières Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Asnières'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Opé Asnières Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Asnières'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Opé Asnières Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Asnières'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0147903359',
	`Mail`='formation-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='For Asnières',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Asnières'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='For Asnières Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Asnières'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='For Asnières Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Asnières'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Acso Asnières',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Asnières'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Com Asnières',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Asnières'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Tech Asnières',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Asnières'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Tech Asnières Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Asnières'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Tech Asnières Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Asnières'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0783884779',
	`Mail`='president-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Autorité Boulogne',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Boulogne'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Autorité Boulogne Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Boulogne'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Autorité Boulogne Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Boulogne'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0652368855',
	`Mail`='operationnel-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Opé Boulogne',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Boulogne'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Opé Boulogne Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Boulogne'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Opé Boulogne Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Boulogne'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Opé Boulogne Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Boulogne'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0652221205',
	`Mail`='formation-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='For Boulogne',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Boulogne'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='For Boulogne Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Boulogne'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='For Boulogne Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Boulogne'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Acso Boulogne',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Boulogne'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Com Boulogne',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Boulogne'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Tech Boulogne',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Boulogne'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Tech Boulogne Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Boulogne'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Tech Boulogne Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Boulogne'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0632989170',
	`Mail`='president-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Autorité Bourg-la-Reine',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Autorité Bourg-la-Reine Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Autorité Bourg-la-Reine Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0607102726',
	`Mail`='operationnel-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Opé Bourg-la-Reine',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Opé Bourg-la-Reine Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Opé Bourg-la-Reine Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Opé Bourg-la-Reine Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0695049978',
	`Mail`='formation-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='For Bourg-la-Reine',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='For Bourg-la-Reine Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0679560098',
	`Mail`='formation-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='For Bourg-la-Reine Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Acso Bourg-la-Reine',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Com Bourg-la-Reine',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Tech Bourg-la-Reine',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Tech Bourg-la-Reine Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Tech Bourg-la-Reine Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Bourg-la-Reine'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='president-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Autorité Clamart',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Clamart'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Autorité Clamart Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Clamart'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Autorité Clamart Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Clamart'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Opé Clamart',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Clamart'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Opé Clamart Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Clamart'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Opé Clamart Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Clamart'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Opé Clamart Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Clamart'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='For Clamart',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Clamart'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='For Clamart Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Clamart'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='For Clamart Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Clamart'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Acso Clamart',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Clamart'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Com Clamart',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Clamart'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Tech Clamart',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Clamart'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Tech Clamart Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Clamart'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Tech Clamart Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Clamart'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='president-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Autorité Clichy',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Clichy'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Autorité Clichy Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Clichy'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Autorité Clichy Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Clichy'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Opé Clichy',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Clichy'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Opé Clichy Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Clichy'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Opé Clichy Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Clichy'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Opé Clichy Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Clichy'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='For Clichy',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Clichy'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='For Clichy Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Clichy'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='For Clichy Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Clichy'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Acso Clichy',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Clichy'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Com Clichy',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Clichy'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Tech Clichy',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Clichy'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Tech Clichy Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Clichy'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Tech Clichy Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Clichy'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='president-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Autorité Colombes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Colombes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Autorité Colombes Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Colombes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Autorité Colombes Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Colombes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Opé Colombes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Colombes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Opé Colombes Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Colombes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Opé Colombes Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Colombes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Opé Colombes Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Colombes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='For Colombes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Colombes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='For Colombes Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Colombes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='For Colombes Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Colombes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Acso Colombes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Colombes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Com Colombes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Colombes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Tech Colombes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Colombes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Tech Colombes Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Colombes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Tech Colombes Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Colombes'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0762263688',
	`Mail`='president-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Autorité Courbevoie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Autorité Courbevoie Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Autorité Courbevoie Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0674728980',
	`Mail`='operationnel-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Opé Courbevoie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0652540653',
	`Mail`='operationnel-adj-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Opé Courbevoie Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Opé Courbevoie Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Opé Courbevoie Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='For Courbevoie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='For Courbevoie Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0616461022',
	`Mail`='formation-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='For Courbevoie Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='For Courbevoie Charlie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Formation'
	WHERE `Title`='DLF-C Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0762261863',
	`Mail`='actions-sociales-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Acso Courbevoie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Com Courbevoie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Tech Courbevoie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Tech Courbevoie Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Courbevoie'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Tech Courbevoie Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Courbevoie'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0676457979',
	`Mail`='president-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Autorité Garches',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Garches'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Autorité Garches Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Garches'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Autorité Garches Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Garches'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0750939211',
	`Mail`='operationnel-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Opé Garches',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Garches'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Opé Garches Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Garches'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Opé Garches Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Garches'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Opé Garches Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Garches'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0750857300',
	`Mail`='formation-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='For Garches',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Garches'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='For Garches Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Garches'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='For Garches Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Garches'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Acso Garches',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Garches'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Com Garches',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Garches'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Tech Garches',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Garches'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Tech Garches Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Garches'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Tech Garches Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Garches'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='president-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Autorité Gennevilliers',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Gennevilliers'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Autorité Gennevilliers Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Gennevilliers'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Autorité Gennevilliers Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Gennevilliers'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0660264451',
	`Mail`='operationnel-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Opé Gennevilliers',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Gennevilliers'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Opé Gennevilliers Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Gennevilliers'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Opé Gennevilliers Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Gennevilliers'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Opé Gennevilliers Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Gennevilliers'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0673493244',
	`Mail`='formation-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='For Gennevilliers',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Gennevilliers'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='For Gennevilliers Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Gennevilliers'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='For Gennevilliers Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Gennevilliers'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Acso Gennevilliers',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Gennevilliers'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Com Gennevilliers',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Gennevilliers'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Tech Gennevilliers',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Gennevilliers'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Tech Gennevilliers Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Gennevilliers'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Tech Gennevilliers Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Gennevilliers'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='president-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Autorité Levallois',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Levallois'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Autorité Levallois Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Levallois'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Autorité Levallois Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Levallois'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0664979200',
	`Mail`='operationnel-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Opé Levallois',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Levallois'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0665640020',
	`Mail`='operationnel-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Opé Levallois Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Levallois'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Opé Levallois Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Levallois'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Opé Levallois Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Levallois'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0667523257',
	`Mail`='formation-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='For Levallois',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Levallois'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='For Levallois Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Levallois'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='For Levallois Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Levallois'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Acso Levallois',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Levallois'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Com Levallois',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Levallois'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Tech Levallois',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Levallois'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Tech Levallois Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Levallois'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Tech Levallois Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Levallois'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='president-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Autorité Montrouge',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Montrouge'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Autorité Montrouge Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Montrouge'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Autorité Montrouge Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Montrouge'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Opé Montrouge',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Montrouge'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Opé Montrouge Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Montrouge'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Opé Montrouge Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Montrouge'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Opé Montrouge Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Montrouge'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='For Montrouge',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Montrouge'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='For Montrouge Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Montrouge'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='For Montrouge Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Montrouge'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Acso Montrouge',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Montrouge'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Com Montrouge',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Montrouge'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Tech Montrouge',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Montrouge'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Tech Montrouge Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Montrouge'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Tech Montrouge Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Montrouge'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='president-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Autorité Nanterre',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Nanterre'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Autorité Nanterre Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Nanterre'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Autorité Nanterre Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Nanterre'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Opé Nanterre',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Nanterre'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Opé Nanterre Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Nanterre'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Opé Nanterre Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Nanterre'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Opé Nanterre Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Nanterre'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='For Nanterre',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Nanterre'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='For Nanterre Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Nanterre'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='For Nanterre Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Nanterre'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Acso Nanterre',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Nanterre'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Com Nanterre',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Nanterre'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Tech Nanterre',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Nanterre'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Tech Nanterre Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Nanterre'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Tech Nanterre Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Nanterre'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0699400128',
	`Mail`='president-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Autorité Rueil',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Rueil'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Autorité Rueil Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Rueil'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Autorité Rueil Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Rueil'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0699420228',
	`Mail`='operationnel-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Opé Rueil',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Rueil'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Opé Rueil Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Rueil'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Opé Rueil Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Rueil'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Opé Rueil Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Rueil'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='For Rueil',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Rueil'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='For Rueil Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Rueil'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='For Rueil Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Rueil'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Acso Rueil',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Rueil'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Com Rueil',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Rueil'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Tech Rueil',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Rueil'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Tech Rueil Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Rueil'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Tech Rueil Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Rueil'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='president-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Autorité Suresnes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Suresnes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Autorité Suresnes Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Suresnes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Autorité Suresnes Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Suresnes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Opé Suresnes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Suresnes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Opé Suresnes Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Suresnes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Opé Suresnes Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Suresnes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Opé Suresnes Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Suresnes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='For Suresnes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Suresnes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='For Suresnes Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Suresnes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='For Suresnes Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Suresnes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Acso Suresnes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Suresnes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Com Suresnes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Suresnes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Tech Suresnes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Suresnes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Tech Suresnes Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Suresnes'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Tech Suresnes Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Suresnes'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='president-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Autorité Vanves',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Vanves'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Autorité Vanves Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Vanves'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Autorité Vanves Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Vanves'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Opé Vanves',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Vanves'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Opé Vanves Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Vanves'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Opé Vanves Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Vanves'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Opé Vanves Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Vanves'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='For Vanves',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Vanves'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='For Vanves Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Vanves'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='For Vanves Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Vanves'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Acso Vanves',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Vanves'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Com Vanves',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Vanves'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Tech Vanves',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Vanves'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Tech Vanves Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Vanves'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Tech Vanves Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Vanves'
");


mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0768978637',
	`Mail`='president-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Autorité Villeneuve',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Villeneuve'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='secretaire-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Autorité Villeneuve Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Villeneuve'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='tresorier-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Autorité Villeneuve Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Villeneuve'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0768664829',
	`Mail`='operationnel-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Opé Villeneuve',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO Villeneuve'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Opé Villeneuve Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-A Villeneuve'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Opé Villeneuve Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-B Villeneuve'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='operationnel-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Opé Villeneuve Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Opérationnel'
	WHERE `Title`='DLO-C Villeneuve'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='0768541942',
	`Mail`='formation-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='For Villeneuve',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Formation'
	WHERE `Title`='DLF Villeneuve'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='For Villeneuve Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Formation'
	WHERE `Title`='DLF-A Villeneuve'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='formation-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='For Villeneuve Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Formation'
	WHERE `Title`='DLF-B Villeneuve'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Acso Villeneuve',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Acso'
	WHERE `Title`='DLAS Villeneuve'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='communication-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Com Villeneuve',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Communication'
	WHERE `Title`='DLC Villeneuve'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Tech Villeneuve',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Technique'
	WHERE `Title`='DLT Villeneuve'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Tech Villeneuve Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='2',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Matér Villeneuve'
");

mysqli_query($db_link, "UPDATE `rbac_roles` SET
	`Phone`='',
	`Mail`='logistique-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Tech Villeneuve Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='3',
	`Tags`='Technique'
	WHERE `Title`='DLT-L Véhic Villeneuve'
");





/////////////////////////////////////////////////
// DEFAULT PERMISSIONS FOR ROLES
/////////////////////////////////////////////////
$rbac->Roles->assign('Admin', 'admin-settings-update');
$rbac->Roles->assign('Admin', 'admin-roles-asssign-permissions');
$rbac->Roles->assign('Admin', 'admin-users-asssign-roles');
$rbac->Roles->assign('Admin', 'admin-permissions-update');
$rbac->Roles->assign('Admin', 'ope-dps-view-all');
$rbac->Roles->assign('Admin', 'treso-dps-view-all');
$rbac->Roles->assign('Admin', 'ope-clients-update-all');
$rbac->Roles->assign('Admin', 'admin-sections-update');
$rbac->Roles->assign('Admin', 'directory-update');
$rbac->Roles->assign('Admin', 'admin-mailinglist-manage');
$rbac->Roles->assign('Public', 'directory-view');
$rbac->Roles->assign('Président', 'admin-settings-view');
$rbac->Roles->assign('Président', 'admin-roles-view');
$rbac->Roles->assign('Président', 'admin-permissions-view');
$rbac->Roles->assign('Président', 'admin-users-asssign-roles');
$rbac->Roles->assign('Président', 'ope-dps-view-all');
$rbac->Roles->assign('Président', 'treso-dps-view-all');
$rbac->Roles->assign('Président', 'ope-clients-view-all');
$rbac->Roles->assign('Président', 'admin-sections-update');
$rbac->Roles->assign('Président', 'directory-view');
$rbac->Roles->assign('Vice-Président-1', 'admin-settings-view');
$rbac->Roles->assign('Vice-Président-1', 'admin-permissions-view');
$rbac->Roles->assign('Vice-Président-1', 'admin-users-asssign-roles');
$rbac->Roles->assign('Vice-Président-1', 'ope-dps-view-all');
$rbac->Roles->assign('Vice-Président-1', 'treso-dps-view-all');
$rbac->Roles->assign('Vice-Président-1', 'ope-clients-view-all');
$rbac->Roles->assign('Vice-Président-1', 'admin-sections-update');
$rbac->Roles->assign('Vice-Président-1', 'directory-view');
$rbac->Roles->assign('Vice-Président-2', 'admin-settings-view');
$rbac->Roles->assign('Vice-Président-2', 'admin-permissions-view');
$rbac->Roles->assign('Vice-Président-2', 'admin-users-asssign-roles');
$rbac->Roles->assign('Vice-Président-2', 'ope-dps-view-all');
$rbac->Roles->assign('Vice-Président-2', 'treso-dps-view-all');
$rbac->Roles->assign('Vice-Président-2', 'ope-clients-view-all');
$rbac->Roles->assign('Vice-Président-2', 'admin-sections-update');
$rbac->Roles->assign('Vice-Président-2', 'directory-view');
$rbac->Roles->assign('Secrétaire', 'admin-settings-view');
$rbac->Roles->assign('Secrétaire', 'admin-permissions-view');
$rbac->Roles->assign('Secrétaire', 'admin-users-asssign-roles');
$rbac->Roles->assign('Secrétaire', 'ope-dps-view-all');
$rbac->Roles->assign('Secrétaire', 'treso-dps-view-all');
$rbac->Roles->assign('Secrétaire', 'ope-clients-update-all');
$rbac->Roles->assign('Secrétaire', 'admin-sections-update');
$rbac->Roles->assign('Secrétaire', 'directory-update');
$rbac->Roles->assign('Secrétaire', 'admin-mailinglist-manage');
$rbac->Roles->assign('Secrétaire Adjoint', 'admin-settings-view');
$rbac->Roles->assign('Secrétaire Adjoint', 'admin-roles-update');
$rbac->Roles->assign('Secrétaire Adjoint', 'admin-permissions-view');
$rbac->Roles->assign('Secrétaire Adjoint', 'admin-users-asssign-roles');
$rbac->Roles->assign('Secrétaire Adjoint', 'ope-dps-view-all');
$rbac->Roles->assign('Secrétaire Adjoint', 'treso-dps-view-all');
$rbac->Roles->assign('Secrétaire Adjoint', 'ope-clients-update-all');
$rbac->Roles->assign('Secrétaire Adjoint', 'admin-sections-update');
$rbac->Roles->assign('Secrétaire Adjoint', 'directory-update');
$rbac->Roles->assign('Trésorier', 'ope-dps-view-all');
$rbac->Roles->assign('Trésorier', 'treso-dps-view-all');
$rbac->Roles->assign('Trésorier', 'ope-clients-view-all');
$rbac->Roles->assign('Trésorier', 'admin-sections-view');
$rbac->Roles->assign('Trésorier', 'directory-view');
$rbac->Roles->assign('Trésorier Adjoint', 'ope-dps-view-all');
$rbac->Roles->assign('Trésorier Adjoint', 'treso-dps-view-all');
$rbac->Roles->assign('Trésorier Adjoint', 'ope-clients-view-all');
$rbac->Roles->assign('Trésorier Adjoint', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Adjoint', 'directory-view');
$rbac->Roles->assign('DDO', 'admin-settings-view');
$rbac->Roles->assign('DDO', 'admin-roles-view');
$rbac->Roles->assign('DDO', 'admin-permissions-view');
$rbac->Roles->assign('DDO', 'ope-dps-validate-ddo-to-pref');
$rbac->Roles->assign('DDO', 'treso-dps-view-all');
$rbac->Roles->assign('DDO', 'ope-clients-update-all');
$rbac->Roles->assign('DDO', 'admin-sections-view');
$rbac->Roles->assign('DDO', 'directory-view');
$rbac->Roles->assign('DDO-A', 'admin-roles-view');
$rbac->Roles->assign('DDO-A', 'admin-permissions-view');
$rbac->Roles->assign('DDO-A', 'ope-dps-validate-ddo-to-pref');
$rbac->Roles->assign('DDO-A', 'treso-dps-view-all');
$rbac->Roles->assign('DDO-A', 'ope-clients-update-all');
$rbac->Roles->assign('DDO-A', 'admin-sections-view');
$rbac->Roles->assign('DDO-A', 'directory-view');
$rbac->Roles->assign('DDO-B', 'ope-dps-view-dept');
$rbac->Roles->assign('DDO-B', 'admin-sections-view');
$rbac->Roles->assign('DDO-B', 'directory-view');
$rbac->Roles->assign('DDO-C', 'ope-dps-validate-dept');
$rbac->Roles->assign('DDO-C', 'ope-dps-view-all');
$rbac->Roles->assign('DDO-C', 'treso-dps-view-own');
$rbac->Roles->assign('DDO-C', 'ope-clients-update-own');
$rbac->Roles->assign('DDO-C', 'admin-sections-view');
$rbac->Roles->assign('DDO-C', 'directory-view');
$rbac->Roles->assign('DDASS', 'admin-sections-view');
$rbac->Roles->assign('DDASS', 'directory-view');
$rbac->Roles->assign('DDC', 'ope-dps-view-all');
$rbac->Roles->assign('DDC', 'admin-sections-view');
$rbac->Roles->assign('DDC', 'directory-view');
$rbac->Roles->assign('DDT', 'admin-settings-view');
$rbac->Roles->assign('DDT', 'admin-roles-view');
$rbac->Roles->assign('DDT', 'admin-permissions-view');
$rbac->Roles->assign('DDT', 'admin-users-view');
$rbac->Roles->assign('DDT', 'admin-sections-view');
$rbac->Roles->assign('DDT', 'directory-view');
$rbac->Roles->assign('DDT-T', 'admin-sections-view');
$rbac->Roles->assign('DDT-T', 'directory-view');
$rbac->Roles->assign('DDT-L', 'admin-sections-view');
$rbac->Roles->assign('DDT-L', 'directory-view');
$rbac->Roles->assign('DDT-I', 'admin-settings-update');
$rbac->Roles->assign('DDT-I', 'admin-roles-asssign-permissions');
$rbac->Roles->assign('DDT-I', 'admin-users-asssign-roles');
$rbac->Roles->assign('DDT-I', 'ope-dps-view-all');
$rbac->Roles->assign('DDT-I', 'treso-dps-view-all');
$rbac->Roles->assign('DDT-I', 'ope-clients-update-all');
$rbac->Roles->assign('DDT-I', 'admin-sections-update');
$rbac->Roles->assign('DDT-I', 'directory-update');
$rbac->Roles->assign('DDT-I', 'admin-mailinglist-manage');
$rbac->Roles->assign('DDF', 'admin-roles-view');
$rbac->Roles->assign('DDF', 'admin-permissions-view');
$rbac->Roles->assign('DDF', 'admin-sections-view');
$rbac->Roles->assign('DDF', 'directory-view');
$rbac->Roles->assign('CM-FOR-ARS', 'admin-sections-view');
$rbac->Roles->assign('CM-FOR-ARS', 'directory-view');
$rbac->Roles->assign('CM-FOR-OPR', 'admin-sections-view');
$rbac->Roles->assign('CM-FOR-OPR', 'directory-view');
$rbac->Roles->assign('CM-FOR-CH', 'admin-sections-view');
$rbac->Roles->assign('CM-FOR-CH', 'directory-view');
$rbac->Roles->assign('CM-FOR-CE', 'admin-sections-view');
$rbac->Roles->assign('CM-FOR-CE', 'directory-view');
$rbac->Roles->assign('MED', 'admin-sections-view');
$rbac->Roles->assign('MED', 'directory-view');
$rbac->Roles->assign('CM-PARAMED', 'admin-sections-view');
$rbac->Roles->assign('CM-PARAMED', 'directory-view');
$rbac->Roles->assign('CM-CODEP', 'admin-sections-view');
$rbac->Roles->assign('CM-CODEP', 'directory-view');

$rbac->Roles->assign('Président Asnières', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Asnières', 'ope-clients-update-own');
$rbac->Roles->assign('Président Asnières', 'treso-dps-view-own');
$rbac->Roles->assign('Président Asnières', 'admin-sections-view');
$rbac->Roles->assign('Président Asnières', 'directory-view');
$rbac->Roles->assign('Secrétaire Asnières', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Asnières', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Asnières', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Asnières', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Asnières', 'directory-view');
$rbac->Roles->assign('Trésorier Asnières', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Asnières', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Asnières', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Asnières', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Asnières', 'directory-view');
$rbac->Roles->assign('DLO Asnières', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Asnières', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Asnières', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Asnières', 'admin-sections-view');
$rbac->Roles->assign('DLO Asnières', 'directory-view');
$rbac->Roles->assign('DLO-A Asnières', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Asnières', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Asnières', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Asnières', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Asnières', 'directory-view');
$rbac->Roles->assign('DLO-B Asnières', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Asnières', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Asnières', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Asnières', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Asnières', 'directory-view');
$rbac->Roles->assign('DLO-C Asnières', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Asnières', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Asnières', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Asnières', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Asnières', 'directory-view');
$rbac->Roles->assign('DLF Asnières', 'admin-sections-view');
$rbac->Roles->assign('DLF Asnières', 'directory-view');
$rbac->Roles->assign('DLF-A Asnières', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Asnières', 'directory-view');
$rbac->Roles->assign('DLF-B Asnières', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Asnières', 'directory-view');
$rbac->Roles->assign('DLAS Asnières', 'admin-sections-view');
$rbac->Roles->assign('DLAS Asnières', 'directory-view');
$rbac->Roles->assign('DLC Asnières', 'admin-sections-view');
$rbac->Roles->assign('DLC Asnières', 'directory-view');
$rbac->Roles->assign('DLT Asnières', 'admin-sections-view');
$rbac->Roles->assign('DLT Asnières', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Asnières', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Asnières', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Asnières', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Asnières', 'directory-view');

$rbac->Roles->assign('Président Boulogne', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Boulogne', 'ope-clients-update-own');
$rbac->Roles->assign('Président Boulogne', 'treso-dps-view-own');
$rbac->Roles->assign('Président Boulogne', 'admin-sections-view');
$rbac->Roles->assign('Président Boulogne', 'directory-view');
$rbac->Roles->assign('Secrétaire Boulogne', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Boulogne', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Boulogne', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Boulogne', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Boulogne', 'directory-view');
$rbac->Roles->assign('Trésorier Boulogne', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Boulogne', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Boulogne', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Boulogne', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Boulogne', 'directory-view');
$rbac->Roles->assign('DLO Boulogne', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Boulogne', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Boulogne', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Boulogne', 'admin-sections-view');
$rbac->Roles->assign('DLO Boulogne', 'directory-view');
$rbac->Roles->assign('DLO-A Boulogne', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Boulogne', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Boulogne', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Boulogne', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Boulogne', 'directory-view');
$rbac->Roles->assign('DLO-B Boulogne', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Boulogne', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Boulogne', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Boulogne', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Boulogne', 'directory-view');
$rbac->Roles->assign('DLO-C Boulogne', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Boulogne', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Boulogne', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Boulogne', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Boulogne', 'directory-view');
$rbac->Roles->assign('DLF Boulogne', 'admin-sections-view');
$rbac->Roles->assign('DLF Boulogne', 'directory-view');
$rbac->Roles->assign('DLF-A Boulogne', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Boulogne', 'directory-view');
$rbac->Roles->assign('DLF-B Boulogne', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Boulogne', 'directory-view');
$rbac->Roles->assign('DLAS Boulogne', 'admin-sections-view');
$rbac->Roles->assign('DLAS Boulogne', 'directory-view');
$rbac->Roles->assign('DLC Boulogne', 'admin-sections-view');
$rbac->Roles->assign('DLC Boulogne', 'directory-view');
$rbac->Roles->assign('DLT Boulogne', 'admin-sections-view');
$rbac->Roles->assign('DLT Boulogne', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Boulogne', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Boulogne', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Boulogne', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Boulogne', 'directory-view');

$rbac->Roles->assign('Président Bourg-la-Reine', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Bourg-la-Reine', 'ope-clients-update-own');
$rbac->Roles->assign('Président Bourg-la-Reine', 'treso-dps-view-own');
$rbac->Roles->assign('Président Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('Président Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('Secrétaire Bourg-la-Reine', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Bourg-la-Reine', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Bourg-la-Reine', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('Trésorier Bourg-la-Reine', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Bourg-la-Reine', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Bourg-la-Reine', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('DLO Bourg-la-Reine', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Bourg-la-Reine', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Bourg-la-Reine', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('DLO Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('DLO-A Bourg-la-Reine', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Bourg-la-Reine', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Bourg-la-Reine', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('DLO-B Bourg-la-Reine', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Bourg-la-Reine', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Bourg-la-Reine', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('DLO-C Bourg-la-Reine', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Bourg-la-Reine', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Bourg-la-Reine', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('DLF Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('DLF Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('DLF-A Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('DLF-B Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('DLAS Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('DLAS Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('DLC Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('DLC Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('DLT Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('DLT Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Bourg-la-Reine', 'directory-view');

$rbac->Roles->assign('Président Clamart', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Clamart', 'ope-clients-update-own');
$rbac->Roles->assign('Président Clamart', 'treso-dps-view-own');
$rbac->Roles->assign('Président Clamart', 'admin-sections-view');
$rbac->Roles->assign('Président Clamart', 'directory-view');
$rbac->Roles->assign('Secrétaire Clamart', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Clamart', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Clamart', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Clamart', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Clamart', 'directory-view');
$rbac->Roles->assign('Trésorier Clamart', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Clamart', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Clamart', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Clamart', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Clamart', 'directory-view');
$rbac->Roles->assign('DLO Clamart', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Clamart', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Clamart', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Clamart', 'admin-sections-view');
$rbac->Roles->assign('DLO Clamart', 'directory-view');
$rbac->Roles->assign('DLO-A Clamart', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Clamart', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Clamart', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Clamart', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Clamart', 'directory-view');
$rbac->Roles->assign('DLO-B Clamart', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Clamart', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Clamart', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Clamart', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Clamart', 'directory-view');
$rbac->Roles->assign('DLO-C Clamart', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Clamart', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Clamart', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Clamart', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Clamart', 'directory-view');
$rbac->Roles->assign('DLF Clamart', 'admin-sections-view');
$rbac->Roles->assign('DLF Clamart', 'directory-view');
$rbac->Roles->assign('DLF-A Clamart', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Clamart', 'directory-view');
$rbac->Roles->assign('DLF-B Clamart', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Clamart', 'directory-view');
$rbac->Roles->assign('DLAS Clamart', 'admin-sections-view');
$rbac->Roles->assign('DLAS Clamart', 'directory-view');
$rbac->Roles->assign('DLC Clamart', 'admin-sections-view');
$rbac->Roles->assign('DLC Clamart', 'directory-view');
$rbac->Roles->assign('DLT Clamart', 'admin-sections-view');
$rbac->Roles->assign('DLT Clamart', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Clamart', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Clamart', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Clamart', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Clamart', 'directory-view');

$rbac->Roles->assign('Président Clichy', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Clichy', 'ope-clients-update-own');
$rbac->Roles->assign('Président Clichy', 'treso-dps-view-own');
$rbac->Roles->assign('Président Clichy', 'admin-sections-view');
$rbac->Roles->assign('Président Clichy', 'directory-view');
$rbac->Roles->assign('Secrétaire Clichy', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Clichy', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Clichy', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Clichy', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Clichy', 'directory-view');
$rbac->Roles->assign('Trésorier Clichy', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Clichy', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Clichy', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Clichy', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Clichy', 'directory-view');
$rbac->Roles->assign('DLO Clichy', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Clichy', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Clichy', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Clichy', 'admin-sections-view');
$rbac->Roles->assign('DLO Clichy', 'directory-view');
$rbac->Roles->assign('DLO-A Clichy', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Clichy', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Clichy', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Clichy', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Clichy', 'directory-view');
$rbac->Roles->assign('DLO-B Clichy', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Clichy', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Clichy', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Clichy', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Clichy', 'directory-view');
$rbac->Roles->assign('DLO-C Clichy', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Clichy', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Clichy', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Clichy', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Clichy', 'directory-view');
$rbac->Roles->assign('DLF Clichy', 'admin-sections-view');
$rbac->Roles->assign('DLF Clichy', 'directory-view');
$rbac->Roles->assign('DLF-A Clichy', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Clichy', 'directory-view');
$rbac->Roles->assign('DLF-B Clichy', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Clichy', 'directory-view');
$rbac->Roles->assign('DLAS Clichy', 'admin-sections-view');
$rbac->Roles->assign('DLAS Clichy', 'directory-view');
$rbac->Roles->assign('DLC Clichy', 'admin-sections-view');
$rbac->Roles->assign('DLC Clichy', 'directory-view');
$rbac->Roles->assign('DLT Clichy', 'admin-sections-view');
$rbac->Roles->assign('DLT Clichy', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Clichy', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Clichy', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Clichy', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Clichy', 'directory-view');

$rbac->Roles->assign('Président Colombes', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Colombes', 'ope-clients-update-own');
$rbac->Roles->assign('Président Colombes', 'treso-dps-view-own');
$rbac->Roles->assign('Président Colombes', 'admin-sections-view');
$rbac->Roles->assign('Président Colombes', 'directory-view');
$rbac->Roles->assign('Secrétaire Colombes', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Colombes', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Colombes', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Colombes', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Colombes', 'directory-view');
$rbac->Roles->assign('Trésorier Colombes', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Colombes', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Colombes', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Colombes', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Colombes', 'directory-view');
$rbac->Roles->assign('DLO Colombes', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Colombes', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Colombes', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Colombes', 'admin-sections-view');
$rbac->Roles->assign('DLO Colombes', 'directory-view');
$rbac->Roles->assign('DLO-A Colombes', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Colombes', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Colombes', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Colombes', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Colombes', 'directory-view');
$rbac->Roles->assign('DLO-B Colombes', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Colombes', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Colombes', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Colombes', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Colombes', 'directory-view');
$rbac->Roles->assign('DLO-C Colombes', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Colombes', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Colombes', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Colombes', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Colombes', 'directory-view');
$rbac->Roles->assign('DLF Colombes', 'admin-sections-view');
$rbac->Roles->assign('DLF Colombes', 'directory-view');
$rbac->Roles->assign('DLF-A Colombes', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Colombes', 'directory-view');
$rbac->Roles->assign('DLF-B Colombes', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Colombes', 'directory-view');
$rbac->Roles->assign('DLAS Colombes', 'admin-sections-view');
$rbac->Roles->assign('DLAS Colombes', 'directory-view');
$rbac->Roles->assign('DLC Colombes', 'admin-sections-view');
$rbac->Roles->assign('DLC Colombes', 'directory-view');
$rbac->Roles->assign('DLT Colombes', 'admin-sections-view');
$rbac->Roles->assign('DLT Colombes', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Colombes', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Colombes', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Colombes', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Colombes', 'directory-view');

$rbac->Roles->assign('Président Courbevoie', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Courbevoie', 'ope-clients-update-own');
$rbac->Roles->assign('Président Courbevoie', 'treso-dps-view-own');
$rbac->Roles->assign('Président Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('Président Courbevoie', 'directory-view');
$rbac->Roles->assign('Secrétaire Courbevoie', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Courbevoie', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Courbevoie', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Courbevoie', 'directory-view');
$rbac->Roles->assign('Trésorier Courbevoie', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Courbevoie', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Courbevoie', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Courbevoie', 'directory-view');
$rbac->Roles->assign('DLO Courbevoie', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Courbevoie', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Courbevoie', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('DLO Courbevoie', 'directory-view');
$rbac->Roles->assign('DLO-A Courbevoie', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Courbevoie', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Courbevoie', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Courbevoie', 'directory-view');
$rbac->Roles->assign('DLO-B Courbevoie', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Courbevoie', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Courbevoie', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Courbevoie', 'directory-view');
$rbac->Roles->assign('DLO-C Courbevoie', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Courbevoie', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Courbevoie', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Courbevoie', 'directory-view');
$rbac->Roles->assign('DLF Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('DLF Courbevoie', 'directory-view');
$rbac->Roles->assign('DLF-A Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Courbevoie', 'directory-view');
$rbac->Roles->assign('DLF-B Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Courbevoie', 'directory-view');
$rbac->Roles->assign('DLF-C Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('DLF-C Courbevoie', 'directory-view');
$rbac->Roles->assign('DLAS Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('DLAS Courbevoie', 'directory-view');
$rbac->Roles->assign('DLC Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('DLC Courbevoie', 'directory-view');
$rbac->Roles->assign('DLT Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('DLT Courbevoie', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Courbevoie', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Courbevoie', 'directory-view');

$rbac->Roles->assign('Président Garches', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Garches', 'ope-clients-update-own');
$rbac->Roles->assign('Président Garches', 'treso-dps-view-own');
$rbac->Roles->assign('Président Garches', 'admin-sections-view');
$rbac->Roles->assign('Président Garches', 'directory-view');
$rbac->Roles->assign('Secrétaire Garches', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Garches', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Garches', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Garches', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Garches', 'directory-view');
$rbac->Roles->assign('Trésorier Garches', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Garches', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Garches', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Garches', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Garches', 'directory-view');
$rbac->Roles->assign('DLO Garches', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Garches', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Garches', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Garches', 'admin-sections-view');
$rbac->Roles->assign('DLO Garches', 'directory-view');
$rbac->Roles->assign('DLO-A Garches', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Garches', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Garches', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Garches', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Garches', 'directory-view');
$rbac->Roles->assign('DLO-B Garches', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Garches', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Garches', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Garches', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Garches', 'directory-view');
$rbac->Roles->assign('DLO-C Garches', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Garches', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Garches', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Garches', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Garches', 'directory-view');
$rbac->Roles->assign('DLF Garches', 'admin-sections-view');
$rbac->Roles->assign('DLF Garches', 'directory-view');
$rbac->Roles->assign('DLF-A Garches', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Garches', 'directory-view');
$rbac->Roles->assign('DLF-B Garches', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Garches', 'directory-view');
$rbac->Roles->assign('DLAS Garches', 'admin-sections-view');
$rbac->Roles->assign('DLAS Garches', 'directory-view');
$rbac->Roles->assign('DLC Garches', 'admin-sections-view');
$rbac->Roles->assign('DLC Garches', 'directory-view');
$rbac->Roles->assign('DLT Garches', 'admin-sections-view');
$rbac->Roles->assign('DLT Garches', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Garches', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Garches', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Garches', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Garches', 'directory-view');

$rbac->Roles->assign('Président Gennevilliers', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Gennevilliers', 'ope-clients-update-own');
$rbac->Roles->assign('Président Gennevilliers', 'treso-dps-view-own');
$rbac->Roles->assign('Président Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('Président Gennevilliers', 'directory-view');
$rbac->Roles->assign('Secrétaire Gennevilliers', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Gennevilliers', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Gennevilliers', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Gennevilliers', 'directory-view');
$rbac->Roles->assign('Trésorier Gennevilliers', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Gennevilliers', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Gennevilliers', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Gennevilliers', 'directory-view');
$rbac->Roles->assign('DLO Gennevilliers', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Gennevilliers', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Gennevilliers', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('DLO Gennevilliers', 'directory-view');
$rbac->Roles->assign('DLO-A Gennevilliers', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Gennevilliers', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Gennevilliers', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Gennevilliers', 'directory-view');
$rbac->Roles->assign('DLO-B Gennevilliers', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Gennevilliers', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Gennevilliers', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Gennevilliers', 'directory-view');
$rbac->Roles->assign('DLO-C Gennevilliers', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Gennevilliers', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Gennevilliers', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Gennevilliers', 'directory-view');
$rbac->Roles->assign('DLF Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('DLF Gennevilliers', 'directory-view');
$rbac->Roles->assign('DLF-A Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Gennevilliers', 'directory-view');
$rbac->Roles->assign('DLF-B Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Gennevilliers', 'directory-view');
$rbac->Roles->assign('DLAS Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('DLAS Gennevilliers', 'directory-view');
$rbac->Roles->assign('DLC Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('DLC Gennevilliers', 'directory-view');
$rbac->Roles->assign('DLT Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('DLT Gennevilliers', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Gennevilliers', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Gennevilliers', 'directory-view');

$rbac->Roles->assign('Président Levallois', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Levallois', 'ope-clients-update-own');
$rbac->Roles->assign('Président Levallois', 'treso-dps-view-own');
$rbac->Roles->assign('Président Levallois', 'admin-sections-view');
$rbac->Roles->assign('Président Levallois', 'directory-view');
$rbac->Roles->assign('Secrétaire Levallois', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Levallois', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Levallois', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Levallois', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Levallois', 'directory-view');
$rbac->Roles->assign('Trésorier Levallois', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Levallois', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Levallois', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Levallois', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Levallois', 'directory-view');
$rbac->Roles->assign('DLO Levallois', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Levallois', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Levallois', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Levallois', 'admin-sections-view');
$rbac->Roles->assign('DLO Levallois', 'directory-view');
$rbac->Roles->assign('DLO-A Levallois', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Levallois', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Levallois', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Levallois', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Levallois', 'directory-view');
$rbac->Roles->assign('DLO-B Levallois', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Levallois', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Levallois', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Levallois', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Levallois', 'directory-view');
$rbac->Roles->assign('DLO-C Levallois', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Levallois', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Levallois', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Levallois', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Levallois', 'directory-view');
$rbac->Roles->assign('DLF Levallois', 'admin-sections-view');
$rbac->Roles->assign('DLF Levallois', 'directory-view');
$rbac->Roles->assign('DLF-A Levallois', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Levallois', 'directory-view');
$rbac->Roles->assign('DLF-B Levallois', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Levallois', 'directory-view');
$rbac->Roles->assign('DLAS Levallois', 'admin-sections-view');
$rbac->Roles->assign('DLAS Levallois', 'directory-view');
$rbac->Roles->assign('DLC Levallois', 'admin-sections-view');
$rbac->Roles->assign('DLC Levallois', 'directory-view');
$rbac->Roles->assign('DLT Levallois', 'admin-sections-view');
$rbac->Roles->assign('DLT Levallois', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Levallois', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Levallois', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Levallois', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Levallois', 'directory-view');

$rbac->Roles->assign('Président Montrouge', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Montrouge', 'ope-clients-update-own');
$rbac->Roles->assign('Président Montrouge', 'treso-dps-view-own');
$rbac->Roles->assign('Président Montrouge', 'admin-sections-view');
$rbac->Roles->assign('Président Montrouge', 'directory-view');
$rbac->Roles->assign('Secrétaire Montrouge', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Montrouge', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Montrouge', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Montrouge', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Montrouge', 'directory-view');
$rbac->Roles->assign('Trésorier Montrouge', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Montrouge', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Montrouge', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Montrouge', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Montrouge', 'directory-view');
$rbac->Roles->assign('DLO Montrouge', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Montrouge', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Montrouge', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Montrouge', 'admin-sections-view');
$rbac->Roles->assign('DLO Montrouge', 'directory-view');
$rbac->Roles->assign('DLO-A Montrouge', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Montrouge', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Montrouge', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Montrouge', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Montrouge', 'directory-view');
$rbac->Roles->assign('DLO-B Montrouge', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Montrouge', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Montrouge', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Montrouge', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Montrouge', 'directory-view');
$rbac->Roles->assign('DLO-C Montrouge', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Montrouge', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Montrouge', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Montrouge', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Montrouge', 'directory-view');
$rbac->Roles->assign('DLF Montrouge', 'admin-sections-view');
$rbac->Roles->assign('DLF Montrouge', 'directory-view');
$rbac->Roles->assign('DLF-A Montrouge', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Montrouge', 'directory-view');
$rbac->Roles->assign('DLF-B Montrouge', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Montrouge', 'directory-view');
$rbac->Roles->assign('DLAS Montrouge', 'admin-sections-view');
$rbac->Roles->assign('DLAS Montrouge', 'directory-view');
$rbac->Roles->assign('DLC Montrouge', 'admin-sections-view');
$rbac->Roles->assign('DLC Montrouge', 'directory-view');
$rbac->Roles->assign('DLT Montrouge', 'admin-sections-view');
$rbac->Roles->assign('DLT Montrouge', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Montrouge', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Montrouge', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Montrouge', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Montrouge', 'directory-view');

$rbac->Roles->assign('Président Nanterre', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Nanterre', 'ope-clients-update-own');
$rbac->Roles->assign('Président Nanterre', 'treso-dps-view-own');
$rbac->Roles->assign('Président Nanterre', 'admin-sections-view');
$rbac->Roles->assign('Président Nanterre', 'directory-view');
$rbac->Roles->assign('Secrétaire Nanterre', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Nanterre', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Nanterre', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Nanterre', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Nanterre', 'directory-view');
$rbac->Roles->assign('Trésorier Nanterre', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Nanterre', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Nanterre', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Nanterre', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Nanterre', 'directory-view');
$rbac->Roles->assign('DLO Nanterre', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Nanterre', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Nanterre', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Nanterre', 'admin-sections-view');
$rbac->Roles->assign('DLO Nanterre', 'directory-view');
$rbac->Roles->assign('DLO-A Nanterre', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Nanterre', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Nanterre', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Nanterre', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Nanterre', 'directory-view');
$rbac->Roles->assign('DLO-B Nanterre', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Nanterre', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Nanterre', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Nanterre', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Nanterre', 'directory-view');
$rbac->Roles->assign('DLO-C Nanterre', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Nanterre', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Nanterre', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Nanterre', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Nanterre', 'directory-view');
$rbac->Roles->assign('DLF Nanterre', 'admin-sections-view');
$rbac->Roles->assign('DLF Nanterre', 'directory-view');
$rbac->Roles->assign('DLF-A Nanterre', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Nanterre', 'directory-view');
$rbac->Roles->assign('DLF-B Nanterre', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Nanterre', 'directory-view');
$rbac->Roles->assign('DLAS Nanterre', 'admin-sections-view');
$rbac->Roles->assign('DLAS Nanterre', 'directory-view');
$rbac->Roles->assign('DLC Nanterre', 'admin-sections-view');
$rbac->Roles->assign('DLC Nanterre', 'directory-view');
$rbac->Roles->assign('DLT Nanterre', 'admin-sections-view');
$rbac->Roles->assign('DLT Nanterre', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Nanterre', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Nanterre', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Nanterre', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Nanterre', 'directory-view');

$rbac->Roles->assign('Président Rueil', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Rueil', 'ope-clients-update-own');
$rbac->Roles->assign('Président Rueil', 'treso-dps-view-own');
$rbac->Roles->assign('Président Rueil', 'admin-sections-view');
$rbac->Roles->assign('Président Rueil', 'directory-view');
$rbac->Roles->assign('Secrétaire Rueil', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Rueil', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Rueil', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Rueil', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Rueil', 'directory-view');
$rbac->Roles->assign('Trésorier Rueil', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Rueil', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Rueil', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Rueil', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Rueil', 'directory-view');
$rbac->Roles->assign('DLO Rueil', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Rueil', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Rueil', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Rueil', 'admin-sections-view');
$rbac->Roles->assign('DLO Rueil', 'directory-view');
$rbac->Roles->assign('DLO-A Rueil', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Rueil', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Rueil', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Rueil', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Rueil', 'directory-view');
$rbac->Roles->assign('DLO-B Rueil', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Rueil', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Rueil', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Rueil', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Rueil', 'directory-view');
$rbac->Roles->assign('DLO-C Rueil', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Rueil', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Rueil', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Rueil', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Rueil', 'directory-view');
$rbac->Roles->assign('DLF Rueil', 'admin-sections-view');
$rbac->Roles->assign('DLF Rueil', 'directory-view');
$rbac->Roles->assign('DLF-A Rueil', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Rueil', 'directory-view');
$rbac->Roles->assign('DLF-B Rueil', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Rueil', 'directory-view');
$rbac->Roles->assign('DLAS Rueil', 'admin-sections-view');
$rbac->Roles->assign('DLAS Rueil', 'directory-view');
$rbac->Roles->assign('DLC Rueil', 'admin-sections-view');
$rbac->Roles->assign('DLC Rueil', 'directory-view');
$rbac->Roles->assign('DLT Rueil', 'admin-sections-view');
$rbac->Roles->assign('DLT Rueil', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Rueil', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Rueil', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Rueil', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Rueil', 'directory-view');

$rbac->Roles->assign('Président Suresnes', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Suresnes', 'ope-clients-update-own');
$rbac->Roles->assign('Président Suresnes', 'treso-dps-view-own');
$rbac->Roles->assign('Président Suresnes', 'admin-sections-view');
$rbac->Roles->assign('Président Suresnes', 'directory-view');
$rbac->Roles->assign('Secrétaire Suresnes', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Suresnes', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Suresnes', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Suresnes', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Suresnes', 'directory-view');
$rbac->Roles->assign('Trésorier Suresnes', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Suresnes', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Suresnes', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Suresnes', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Suresnes', 'directory-view');
$rbac->Roles->assign('DLO Suresnes', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Suresnes', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Suresnes', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Suresnes', 'admin-sections-view');
$rbac->Roles->assign('DLO Suresnes', 'directory-view');
$rbac->Roles->assign('DLO-A Suresnes', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Suresnes', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Suresnes', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Suresnes', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Suresnes', 'directory-view');
$rbac->Roles->assign('DLO-B Suresnes', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Suresnes', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Suresnes', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Suresnes', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Suresnes', 'directory-view');
$rbac->Roles->assign('DLO-C Suresnes', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Suresnes', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Suresnes', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Suresnes', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Suresnes', 'directory-view');
$rbac->Roles->assign('DLF Suresnes', 'admin-sections-view');
$rbac->Roles->assign('DLF Suresnes', 'directory-view');
$rbac->Roles->assign('DLF-A Suresnes', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Suresnes', 'directory-view');
$rbac->Roles->assign('DLF-B Suresnes', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Suresnes', 'directory-view');
$rbac->Roles->assign('DLAS Suresnes', 'admin-sections-view');
$rbac->Roles->assign('DLAS Suresnes', 'directory-view');
$rbac->Roles->assign('DLC Suresnes', 'admin-sections-view');
$rbac->Roles->assign('DLC Suresnes', 'directory-view');
$rbac->Roles->assign('DLT Suresnes', 'admin-sections-view');
$rbac->Roles->assign('DLT Suresnes', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Suresnes', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Suresnes', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Suresnes', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Suresnes', 'directory-view');

$rbac->Roles->assign('Président Vanves', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Vanves', 'ope-clients-update-own');
$rbac->Roles->assign('Président Vanves', 'treso-dps-view-own');
$rbac->Roles->assign('Président Vanves', 'admin-sections-view');
$rbac->Roles->assign('Président Vanves', 'directory-view');
$rbac->Roles->assign('Secrétaire Vanves', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Vanves', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Vanves', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Vanves', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Vanves', 'directory-view');
$rbac->Roles->assign('Trésorier Vanves', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Vanves', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Vanves', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Vanves', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Vanves', 'directory-view');
$rbac->Roles->assign('DLO Vanves', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Vanves', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Vanves', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Vanves', 'admin-sections-view');
$rbac->Roles->assign('DLO Vanves', 'directory-view');
$rbac->Roles->assign('DLO-A Vanves', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Vanves', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Vanves', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Vanves', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Vanves', 'directory-view');
$rbac->Roles->assign('DLO-B Vanves', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Vanves', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Vanves', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Vanves', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Vanves', 'directory-view');
$rbac->Roles->assign('DLO-C Vanves', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Vanves', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Vanves', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Vanves', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Vanves', 'directory-view');
$rbac->Roles->assign('DLF Vanves', 'admin-sections-view');
$rbac->Roles->assign('DLF Vanves', 'directory-view');
$rbac->Roles->assign('DLF-A Vanves', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Vanves', 'directory-view');
$rbac->Roles->assign('DLF-B Vanves', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Vanves', 'directory-view');
$rbac->Roles->assign('DLAS Vanves', 'admin-sections-view');
$rbac->Roles->assign('DLAS Vanves', 'directory-view');
$rbac->Roles->assign('DLC Vanves', 'admin-sections-view');
$rbac->Roles->assign('DLC Vanves', 'directory-view');
$rbac->Roles->assign('DLT Vanves', 'admin-sections-view');
$rbac->Roles->assign('DLT Vanves', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Vanves', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Vanves', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Vanves', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Vanves', 'directory-view');

$rbac->Roles->assign('Président Villeneuve', 'ope-dps-validate-local');
$rbac->Roles->assign('Président Villeneuve', 'ope-clients-update-own');
$rbac->Roles->assign('Président Villeneuve', 'treso-dps-view-own');
$rbac->Roles->assign('Président Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('Président Villeneuve', 'directory-view');
$rbac->Roles->assign('Secrétaire Villeneuve', 'ope-dps-view-own');
$rbac->Roles->assign('Secrétaire Villeneuve', 'ope-clients-update-own');
$rbac->Roles->assign('Secrétaire Villeneuve', 'treso-dps-view-own');
$rbac->Roles->assign('Secrétaire Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('Secrétaire Villeneuve', 'directory-view');
$rbac->Roles->assign('Trésorier Villeneuve', 'ope-dps-view-own');
$rbac->Roles->assign('Trésorier Villeneuve', 'ope-clients-view-own');
$rbac->Roles->assign('Trésorier Villeneuve', 'treso-dps-view-own');
$rbac->Roles->assign('Trésorier Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('Trésorier Villeneuve', 'directory-view');
$rbac->Roles->assign('DLO Villeneuve', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO Villeneuve', 'ope-clients-update-own');
$rbac->Roles->assign('DLO Villeneuve', 'treso-dps-view-own');
$rbac->Roles->assign('DLO Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('DLO Villeneuve', 'directory-view');
$rbac->Roles->assign('DLO-A Villeneuve', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-A Villeneuve', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-A Villeneuve', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-A Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('DLO-A Villeneuve', 'directory-view');
$rbac->Roles->assign('DLO-B Villeneuve', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-B Villeneuve', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-B Villeneuve', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-B Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('DLO-B Villeneuve', 'directory-view');
$rbac->Roles->assign('DLO-C Villeneuve', 'ope-dps-validate-local');
$rbac->Roles->assign('DLO-C Villeneuve', 'ope-clients-update-own');
$rbac->Roles->assign('DLO-C Villeneuve', 'treso-dps-view-own');
$rbac->Roles->assign('DLO-C Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('DLO-C Villeneuve', 'directory-view');
$rbac->Roles->assign('DLF Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('DLF Villeneuve', 'directory-view');
$rbac->Roles->assign('DLF-A Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('DLF-A Villeneuve', 'directory-view');
$rbac->Roles->assign('DLF-B Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('DLF-B Villeneuve', 'directory-view');
$rbac->Roles->assign('DLAS Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('DLAS Villeneuve', 'directory-view');
$rbac->Roles->assign('DLC Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('DLC Villeneuve', 'directory-view');
$rbac->Roles->assign('DLT Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('DLT Villeneuve', 'directory-view');
$rbac->Roles->assign('DLT-L Matér Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Matér Villeneuve', 'directory-view');
$rbac->Roles->assign('DLT-L Véhic Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('DLT-L Véhic Villeneuve', 'directory-view');




/////////////////////////////////////////////////
// GOD MODE FOR THE USER INSTALLING THIS SCRIPT
/////////////////////////////////////////////////
$rbac->Users->assign('Admin', $_SESSION["ID"]);
$rbac->Users->assign('Public', 2); // Hopu it is the 'public' user





/////////////////////////////////////////////////
// END OF INSTALLATION SCRIPT
/////////////////////////////////////////////////
?>
<br />
C'est fini : <?php echo date("H:i:s"); ?>
</body>
</html>
