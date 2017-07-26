<?php 
require_once('functions/session/db-connect.php');
require_once('functions/session/security.php');
require_once('PhpRbac/src/PhpRbac/Rbac.php');
use PhpRbac\Rbac;
$rbac = new Rbac();
?>

<html>
<head>
	<title>Installation des rôles et permissions</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
// SQL TABLES
/////////////////////////////////////////////////
mysqli_query($db_link, "CREATE TABLE `$tablename_settings_general` ( 
	`ID` INT(12) NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(128) NULL , 
	`value` VARCHAR(400) NULL , 
	PRIMARY KEY (`ID`)
	) ENGINE = InnoDB; 
");

mysqli_query($db_link, "CREATE TABLE `$tablename_settings_mail` ( 
	`ID` INT(12) NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(128) NULL , 
	`value` VARCHAR(400) NULL , 
	PRIMARY KEY (`ID`)
	) ENGINE = InnoDB; 
");

mysqli_query($db_link, "CREATE TABLE `$tablename_users` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `pass` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `first_name` tinytext CHARACTER SET utf8,
  `phone` tinytext CHARACTER SET utf8,
  `mail` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `attached_section` tinyint(4) DEFAULT NULL,
  `eprotec` varchar(10) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
");

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
// TABLES SAMPLE DATA
/////////////////////////////////////////////////
mysqli_query($db_link, "INSERT INTO `$tablename_settings_general` (name, value) VALUES (
	'application-header-name', 
	'Extranet PC92'
	)
"); 



/////////////////////////////////////////////////
// RESET THE PHPRBAC SYSTEM
/////////////////////////////////////////////////
$rbac->reset(true);



/////////////////////////////////////////////////
// INITIALIZING PERMISSIONS SYSTEM
/////////////////////////////////////////////////
$rbac->Permissions->addPath(utf8_decode('/admin-settings-update/admin-settings-view'), array(utf8_decode('Modifier les réglages'), utf8_decode('Voir les réglages')));
$rbac->Permissions->addPath(utf8_decode('/admin-permissions-update/admin-permissions-view'), array(utf8_decode('Modifier les permissions'), utf8_decode('Voir les permissions')));
$rbac->Permissions->addPath(utf8_decode('/admin-roles-asssign-permissions/admin-roles-update/admin-roles-view'), array(utf8_decode('Assigner des permissions aux rôles'), utf8_decode('Modifier les rôles'), utf8_decode('Voir les rôles')));
$rbac->Permissions->addPath(utf8_decode('/admin-users-asssign-roles/admin-users-update/admin-users-view'), array(utf8_decode('Assigner des rôles aux utilisateurs'), utf8_decode('Modifier les utilisateurs'), utf8_decode('Voir les utilisateurs')));
$rbac->Permissions->addPath(utf8_decode('/ope-dps-validate-local/ope-dps-create-own/ope-dps-view-own'), array(utf8_decode('Valider une demande de DPS pour sa commune'), utf8_decode('Créer un DPS sur sa commune'), utf8_decode('Voir les DPS de sa commune')));
$rbac->Permissions->addPath(utf8_decode('/ope-dps-validate-dept/ope-dps-create-dept/ope-dps-view-dept'), array(utf8_decode('Valider une demande de DPS pour le département'), utf8_decode('Créer un DPS sur le département'), utf8_decode('Voir les DPS départementaux')));
$rbac->Permissions->addPath(utf8_decode('/ope-dps-validate-ddo-to-pref/ope-dps-create-all/ope-dps-view-all'), array(utf8_decode('Envoyer une demande de DPS à la Préfecture'), utf8_decode('Créer un DPS sur toute commune'), utf8_decode('Voir les DPS de toutes les communes')));
$rbac->Permissions->addPath(utf8_decode('/ope-clients-update-own/ope-clients-view-own'), array(utf8_decode('Voir ses clients'), utf8_decode('Modifier ses clients')));
$rbac->Permissions->addPath(utf8_decode('/ope-clients-update-all/ope-clients-view-all'), array(utf8_decode('Voir tous les clients'), utf8_decode('Modifier tous les clients')));
$rbac->Permissions->addPath(utf8_decode('/treso-dps-view-all/treso-dps-view-own'), array(utf8_decode('Voir toute la trésorerie'), utf8_decode('Voir sa trésorerie')));
$rbac->Permissions->addPath(utf8_decode('/directory-update/directory-view'), array(utf8_decode('Modifier annuaire'), utf8_decode('Voir annuaire')));
$rbac->Permissions->addPath(utf8_decode('/admin-mailinglist-manage'), array(utf8_decode('Gestion des listes de diffusion')));
$rbac->Permissions->addPath(utf8_decode('/admin-sections-update/admin-sections-view'), array(utf8_decode('Modifier les sections'), utf8_decode('Voir les sections')));
// Trésorerie ?
// Factures ?


/////////////////////////////////////////////////
// INITIALIZING ROLES SYSTEM
/////////////////////////////////////////////////
$rbac->Roles->add(utf8_decode('Admin'), utf8_decode('Administrateur'));

$rbac->Roles->add(utf8_decode('Président'), utf8_decode('Président départemental'));
$rbac->Roles->add(utf8_decode('Vice-Président-1'), utf8_decode('1er Vice-Président départemental'));
$rbac->Roles->add(utf8_decode('Vice-Président-2'), utf8_decode('2nd Vice-Président départemental'));
$rbac->Roles->add(utf8_decode('Secrétaire'), utf8_decode('Secrétaire général'));
$rbac->Roles->add(utf8_decode('Secrétaire Adjoint'), utf8_decode('Secrétaire général adjoint'));
$rbac->Roles->add(utf8_decode('Trésorier'), utf8_decode('Trésorier départemental'));
$rbac->Roles->add(utf8_decode('Trésorier Adjoint'), utf8_decode('Trésorier départemental adjoint'));
$rbac->Roles->add(utf8_decode('DDO'), utf8_decode('Directeur Départemental des Opérations'));
$rbac->Roles->add(utf8_decode('DDO-A'), utf8_decode('Directrice Départementale des Opérations adjointe'));
$rbac->Roles->add(utf8_decode('DDO-B'), utf8_decode('Directrice Départementale des Opérations adjointe aux réseau de secours'));
$rbac->Roles->add(utf8_decode('DDO-C'), utf8_decode('Directeur Départemental des Opérations adjoint aux missions départementales et nationales'));
$rbac->Roles->add(utf8_decode('DDASS'), utf8_decode('Directrice Départementale des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DDC'), utf8_decode('Directeur Départemental de la Communication'));
$rbac->Roles->add(utf8_decode('DDT'), utf8_decode('Directeur Départemental Technique'));
$rbac->Roles->add(utf8_decode('DDT-T'), utf8_decode('Directeur Départemental Technique adjoint aux moyens de trasnmission'));
$rbac->Roles->add(utf8_decode('DDT-L'), utf8_decode('Directeur Départemental Technique adjoint aux moyens logistiques'));
$rbac->Roles->add(utf8_decode('DDT-I'), utf8_decode('Directeur Départemental Technique adjoint aux moyens informatiques'));
$rbac->Roles->add(utf8_decode('DDF'), utf8_decode('Directeur Départemental des Formations'));
$rbac->Roles->add(utf8_decode('MED'), utf8_decode('Médecin Référent'));
$rbac->Roles->add(utf8_decode('SECRETARIAT'), utf8_decode('Secrétariat Administratif'));

$rbac->Roles->add(utf8_decode('CM-FOR-ARS'), utf8_decode('Chargé de Mission responsable des formations ARS'));
$rbac->Roles->add(utf8_decode('CM-FOR-OPR'), utf8_decode('Chargé de Mission responsable des formations OPR'));
$rbac->Roles->add(utf8_decode('CM-FOR-CH'), utf8_decode('Chargé de Mission responsable des formations Conducteur'));
$rbac->Roles->add(utf8_decode('CM-FOR-CE'), utf8_decode('Chargé de Mission responsable des formations CE / CP / CEPS'));
$rbac->Roles->add(utf8_decode('CM-PARAMED'), utf8_decode('Chargé de Mission responsable de l\'équipe paramédicale'));
$rbac->Roles->add(utf8_decode('CM-CODEP'), utf8_decode('Chargé de Mission responsable des CODEP et Exercices'));

$rbac->Roles->add(utf8_decode('V-COM'), utf8_decode('Communication'));
$rbac->Roles->add(utf8_decode('V-OPE'), utf8_decode('Opérationnel'));
$rbac->Roles->add(utf8_decode('V-FOR'), utf8_decode('Formation'));
$rbac->Roles->add(utf8_decode('V-TECH'), utf8_decode('Technique'));
$rbac->Roles->add(utf8_decode('V-BUREAU'), utf8_decode('Bureau Départemental'));
$rbac->Roles->add(utf8_decode('V-CD'), utf8_decode('Conseil Départemental'));
$rbac->Roles->add(utf8_decode('V-RECRUTEMENT'), utf8_decode('Recrutement'));
$rbac->Roles->add(utf8_decode('V-DEMANDE-DPS'), utf8_decode('Demande de poste de secours'));

$rbac->Roles->add(utf8_decode('P-CODEP'), utf8_decode('Cadre Opérationnel Départemental de Permanence'));
$rbac->Roles->add(utf8_decode('P-MICRO'), utf8_decode('Permanence Transmissions'));
$rbac->Roles->add(utf8_decode('P-TRANSF'), utf8_decode('Permanence de transfert opérationnel'));

$rbac->Roles->add(utf8_decode('C-LOG'), utf8_decode('Pôle Logistique'));
$rbac->Roles->add(utf8_decode('C-TRANS'), utf8_decode('Pôle Transmissions'));
$rbac->Roles->add(utf8_decode('C-INFO'), utf8_decode('Pôle Informatique'));

$rbac->Roles->add(utf8_decode('D-PRES'), utf8_decode('Liste de diffusion Président'));
$rbac->Roles->add(utf8_decode('D-SEC'), utf8_decode('Liste de diffusion Secrétaire'));
$rbac->Roles->add(utf8_decode('D-TRESO'), utf8_decode('Liste de diffusion Trésorier'));
$rbac->Roles->add(utf8_decode('D-DLO'), utf8_decode('Liste de diffusion Opérationnel'));
$rbac->Roles->add(utf8_decode('D-DLF'), utf8_decode('Liste de diffusion Formation'));
$rbac->Roles->add(utf8_decode('D-DLAS'), utf8_decode('Liste de diffusion Actions Sociales'));
$rbac->Roles->add(utf8_decode('D-DLT'), utf8_decode('Liste de diffusion Technique Logistique'));
$rbac->Roles->add(utf8_decode('D-DLT-T'), utf8_decode('Liste de diffusion Technique Transmissions'));
$rbac->Roles->add(utf8_decode('D-DLC'), utf8_decode('Liste de diffusion Communication'));

$rbac->Roles->add(utf8_decode('Président Asnières'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Asnières'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Asnières'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Asnières'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Asnières'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Asnières'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Asnières'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Asnières'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Asnières'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Asnières'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Asnières'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Asnières'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Asnières'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Asnières'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Asnières'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Boulogne'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Boulogne'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Boulogne'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Boulogne'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Boulogne'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Boulogne'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Boulogne'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Boulogne'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Boulogne'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Boulogne'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Boulogne'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Boulogne'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Boulogne'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Boulogne'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Boulogne'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Bourg-la-Reine'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Bourg-la-Reine'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Bourg-la-Reine'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Bourg-la-Reine'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Bourg-la-Reine'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Bourg-la-Reine'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Bourg-la-Reine'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Bourg-la-Reine'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Bourg-la-Reine'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Bourg-la-Reine'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Bourg-la-Reine'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Bourg-la-Reine'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Bourg-la-Reine'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Bourg-la-Reine'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Bourg-la-Reine'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Clamart'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Clamart'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Clamart'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Clamart'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Clamart'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Clamart'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Clamart'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Clamart'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Clamart'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Clamart'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Clamart'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Clamart'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Clamart'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Clamart'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Clamart'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Clichy'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Clichy'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Clichy'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Clichy'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Clichy'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Clichy'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Clichy'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Clichy'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Clichy'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Clichy'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Clichy'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Clichy'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Clichy'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Clichy'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Clichy'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Colombes'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Colombes'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Colombes'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Colombes'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Colombes'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Colombes'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Colombes'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Colombes'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Colombes'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Colombes'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Colombes'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Colombes'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Colombes'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Colombes'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Colombes'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Courbevoie'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Courbevoie'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Courbevoie'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Courbevoie'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Courbevoie'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Courbevoie'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Courbevoie'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Courbevoie'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Courbevoie'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Courbevoie'), utf8_decode('Directeur Local des Formations adjoint à la formation externe Grand Public'));
$rbac->Roles->add(utf8_decode('DLF-C Courbevoie'), utf8_decode('Directeur Local des Formations adjoint à la formation externe Grands Comptes'));
$rbac->Roles->add(utf8_decode('DLAS Courbevoie'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Courbevoie'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Courbevoie'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Courbevoie'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Courbevoie'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Garches'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Garches'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Garches'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Garches'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Garches'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Garches'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Garches'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Garches'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Garches'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Garches'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Garches'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Garches'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Garches'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Garches'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Garches'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Gennevilliers'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Gennevilliers'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Gennevilliers'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Gennevilliers'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Gennevilliers'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Gennevilliers'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Gennevilliers'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Gennevilliers'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Gennevilliers'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Gennevilliers'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Gennevilliers'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Gennevilliers'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Gennevilliers'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Gennevilliers'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Gennevilliers'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Levallois'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Levallois'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Levallois'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Levallois'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Levallois'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Levallois'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Levallois'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Levallois'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Levallois'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Levallois'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Levallois'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Levallois'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Levallois'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Levallois'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Levallois'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Montrouge'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Montrouge'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Montrouge'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Montrouge'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Montrouge'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Montrouge'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Montrouge'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Montrouge'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Montrouge'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Montrouge'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Montrouge'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Montrouge'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Montrouge'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Montrouge'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Montrouge'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Nanterre'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Nanterre'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Nanterre'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Nanterre'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Nanterre'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Nanterre'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Nanterre'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Nanterre'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Nanterre'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Nanterre'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Nanterre'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Nanterre'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Nanterre'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Nanterre'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Nanterre'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Rueil'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Rueil'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Rueil'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Rueil'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Rueil'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Rueil'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Rueil'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Rueil'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Rueil'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Rueil'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Rueil'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Rueil'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Rueil'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Rueil'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Rueil'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Suresnes'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Suresnes'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Suresnes'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Suresnes'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Suresnes'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Suresnes'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Suresnes'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Suresnes'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Suresnes'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Suresnes'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Suresnes'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Suresnes'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Suresnes'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Suresnes'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Suresnes'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Vanves'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Vanves'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Vanves'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Vanves'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Vanves'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Vanves'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Vanves'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Vanves'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Vanves'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Vanves'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Vanves'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Vanves'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Vanves'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Vanves'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Vanves'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));

$rbac->Roles->add(utf8_decode('Président Villeneuve'), utf8_decode('Président délégué'));
$rbac->Roles->add(utf8_decode('Secrétaire Villeneuve'), utf8_decode('Secrétaire'));
$rbac->Roles->add(utf8_decode('Trésorier Villeneuve'), utf8_decode('Trésorier'));
$rbac->Roles->add(utf8_decode('DLO Villeneuve'), utf8_decode('Directeur Local des Opérations'));
$rbac->Roles->add(utf8_decode('DLO-A Villeneuve'), utf8_decode('Directeur Local des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(utf8_decode('DLO-B Villeneuve'), utf8_decode('Directeur Local des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(utf8_decode('DLO-C Villeneuve'), utf8_decode('Directeur Local des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(utf8_decode('DLF Villeneuve'), utf8_decode('Directeur Local des Formations'));
$rbac->Roles->add(utf8_decode('DLF-A Villeneuve'), utf8_decode('Directeur Local des Formations adjoint à la formation interne'));
$rbac->Roles->add(utf8_decode('DLF-B Villeneuve'), utf8_decode('Directeur Local des Formations adjoint à la formation externe'));
$rbac->Roles->add(utf8_decode('DLAS Villeneuve'), utf8_decode('Directeur Local des Actions Solidaires et Sociales'));
$rbac->Roles->add(utf8_decode('DLC Villeneuve'), utf8_decode('Directeur Local de la Communication'));
$rbac->Roles->add(utf8_decode('DLT Villeneuve'), utf8_decode('Directeur Local Technique'));
$rbac->Roles->add(utf8_decode('DLT-L Matér Villeneuve'), utf8_decode('Directeur Local Technique adjoint à la logistique'));
$rbac->Roles->add(utf8_decode('DLT-L Véhic Villeneuve'), utf8_decode('Directeur Local Technique adjoint aux véhicules'));




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


///////////////////////////////////////////////
// ROLES DEPARTEMENTAUX
///////////////////////////////////////////////

mysqli_query($db_link, "UPDATE `rbac_roles` SET 
	`Phone`='06.74.95.31.72', 
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
	`Phone`='06.76.45.79.81', 
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
	`Phone`='06.77.46.47.13',
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
	`Phone`='06.74.95.31.75', 
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
	`Phone`='06.74.95.31.65', 
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
	`Phone`='06.74.95.31.73', 
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
	`Phone`='06.32.98.91.06', 
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
	`Phone`='06.89.17.80.43', 
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
	`Phone`='06.74.95.31.59', 
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
	`Phone`='06.74.95.31.62', 
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
	`Phone`='06.74.95.31.57', 
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
	`Phone`='06.76.45.79.78', 
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
	`Phone`='06.76.45.79.78', 
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
	`Phone`='06.76.45.79.78', 
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
	`Phone`='06.76.45.79.78', 
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
	`Phone`='06.76.45.79.78', 
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
	`Phone`='06.74.95.31.70', 
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
	`Phone`='06.74.95.31.66', 
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
	`Phone`='06.50.84.22.89', 
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
	`Phone`='06.64.65.17.46', 
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
	`Phone`='01.47.90.33.59', 
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
	`Phone`='07.83.88.47.79', 
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
	`Phone`='06.52.36.88.55', 
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
	`Phone`='06.52.22.12.05', 
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
	`Phone`='06.32.98.91.70', 
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
	`Phone`='06.07.10.27.26', 
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
	`Phone`='06.95.04.99.78', 
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
	`Phone`='06.79.56.00.98', 
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
	`Phone`='', 
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
	`Phone`='06.74.72.89.80', 
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
	`Phone`='06.52.54.06.53', 
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
	`Phone`='06.16.46.10.22', 
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
	`Phone`='07.62.26.18.63', 
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
	`Phone`='06.76.45.79.79', 
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
	`Phone`='07.50.93.92.11', 
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
	`Phone`='07.50.85.73.00', 
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
	`Phone`='06.60.26.44.51', 
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
	`Phone`='06.73.49.32.44', 
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
	`Phone`='06.64.97.92.00', 
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
	`Phone`='06.65.64.00.20', 
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
	`Phone`='06.67.52.32.57', 
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
	`Phone`='06.99.40.01.28', 
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
	`Phone`='06.99.42.02.28', 
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
	`Phone`='07.68.97.86.37', 
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
	`Phone`='07.68.66.48.29', 
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
	`Phone`='07.68.54.19.42', 
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
$rbac->Roles->assign(utf8_decode('Admin'), utf8_decode('admin-settings-update'));
$rbac->Roles->assign(utf8_decode('Admin'), utf8_decode('admin-roles-asssign-permissions'));
$rbac->Roles->assign(utf8_decode('Admin'), utf8_decode('admin-users-asssign-roles'));
$rbac->Roles->assign(utf8_decode('Admin'), utf8_decode('admin-permissions-update'));
$rbac->Roles->assign(utf8_decode('Admin'), utf8_decode('ope-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Admin'), utf8_decode('treso-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Admin'), utf8_decode('ope-clients-update-all'));
$rbac->Roles->assign(utf8_decode('Admin'), utf8_decode('admin-sections-update'));
$rbac->Roles->assign(utf8_decode('Admin'), utf8_decode('directory-update'));
$rbac->Roles->assign(utf8_decode('Admin'), utf8_decode('admin-mailinglist-manage'));
$rbac->Roles->assign(utf8_decode('Président'), utf8_decode('admin-settings-view'));
$rbac->Roles->assign(utf8_decode('Président'), utf8_decode('admin-roles-view'));
$rbac->Roles->assign(utf8_decode('Président'), utf8_decode('admin-permissions-view'));
$rbac->Roles->assign(utf8_decode('Président'), utf8_decode('admin-users-asssign-roles'));
$rbac->Roles->assign(utf8_decode('Président'), utf8_decode('ope-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Président'), utf8_decode('treso-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Président'), utf8_decode('ope-clients-view-all'));
$rbac->Roles->assign(utf8_decode('Président'), utf8_decode('admin-sections-update'));
$rbac->Roles->assign(utf8_decode('Président'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Vice-Président-1'), utf8_decode('admin-settings-view'));
$rbac->Roles->assign(utf8_decode('Vice-Président-1'), utf8_decode('admin-permissions-view'));
$rbac->Roles->assign(utf8_decode('Vice-Président-1'), utf8_decode('admin-users-asssign-roles'));
$rbac->Roles->assign(utf8_decode('Vice-Président-1'), utf8_decode('ope-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Vice-Président-1'), utf8_decode('treso-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Vice-Président-1'), utf8_decode('ope-clients-view-all'));
$rbac->Roles->assign(utf8_decode('Vice-Président-1'), utf8_decode('admin-sections-update'));
$rbac->Roles->assign(utf8_decode('Vice-Président-1'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Vice-Président-2'), utf8_decode('admin-settings-view'));
$rbac->Roles->assign(utf8_decode('Vice-Président-2'), utf8_decode('admin-permissions-view'));
$rbac->Roles->assign(utf8_decode('Vice-Président-2'), utf8_decode('admin-users-asssign-roles'));
$rbac->Roles->assign(utf8_decode('Vice-Président-2'), utf8_decode('ope-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Vice-Président-2'), utf8_decode('treso-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Vice-Président-2'), utf8_decode('ope-clients-view-all'));
$rbac->Roles->assign(utf8_decode('Vice-Président-2'), utf8_decode('admin-sections-update'));
$rbac->Roles->assign(utf8_decode('Vice-Président-2'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire'), utf8_decode('admin-settings-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire'), utf8_decode('admin-permissions-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire'), utf8_decode('admin-users-asssign-roles'));
$rbac->Roles->assign(utf8_decode('Secrétaire'), utf8_decode('ope-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Secrétaire'), utf8_decode('treso-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Secrétaire'), utf8_decode('ope-clients-update-all'));
$rbac->Roles->assign(utf8_decode('Secrétaire'), utf8_decode('admin-sections-update'));
$rbac->Roles->assign(utf8_decode('Secrétaire'), utf8_decode('directory-update'));
$rbac->Roles->assign(utf8_decode('Secrétaire'), utf8_decode('admin-mailinglist-manage'));
$rbac->Roles->assign(utf8_decode('Secrétaire Adjoint'), utf8_decode('admin-settings-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Adjoint'), utf8_decode('admin-roles-update'));
$rbac->Roles->assign(utf8_decode('Secrétaire Adjoint'), utf8_decode('admin-permissions-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Adjoint'), utf8_decode('admin-users-asssign-roles'));
$rbac->Roles->assign(utf8_decode('Secrétaire Adjoint'), utf8_decode('ope-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Secrétaire Adjoint'), utf8_decode('treso-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Secrétaire Adjoint'), utf8_decode('ope-clients-update-all'));
$rbac->Roles->assign(utf8_decode('Secrétaire Adjoint'), utf8_decode('admin-sections-update'));
$rbac->Roles->assign(utf8_decode('Secrétaire Adjoint'), utf8_decode('directory-update'));
$rbac->Roles->assign(utf8_decode('Trésorier'), utf8_decode('ope-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Trésorier'), utf8_decode('treso-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Trésorier'), utf8_decode('ope-clients-view-all'));
$rbac->Roles->assign(utf8_decode('Trésorier'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Adjoint'), utf8_decode('ope-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Trésorier Adjoint'), utf8_decode('treso-dps-view-all'));
$rbac->Roles->assign(utf8_decode('Trésorier Adjoint'), utf8_decode('ope-clients-view-all'));
$rbac->Roles->assign(utf8_decode('Trésorier Adjoint'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Adjoint'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DDO'), utf8_decode('admin-settings-view'));
$rbac->Roles->assign(utf8_decode('DDO'), utf8_decode('admin-roles-view'));
$rbac->Roles->assign(utf8_decode('DDO'), utf8_decode('admin-permissions-view'));
$rbac->Roles->assign(utf8_decode('DDO'), utf8_decode('ope-dps-validate-ddo-to-pref'));
$rbac->Roles->assign(utf8_decode('DDO'), utf8_decode('treso-dps-view-all'));
$rbac->Roles->assign(utf8_decode('DDO'), utf8_decode('ope-clients-update-all'));
$rbac->Roles->assign(utf8_decode('DDO'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DDO'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DDO-A'), utf8_decode('admin-roles-view'));
$rbac->Roles->assign(utf8_decode('DDO-A'), utf8_decode('admin-permissions-view'));
$rbac->Roles->assign(utf8_decode('DDO-A'), utf8_decode('ope-dps-validate-ddo-to-pref'));
$rbac->Roles->assign(utf8_decode('DDO-A'), utf8_decode('treso-dps-view-all'));
$rbac->Roles->assign(utf8_decode('DDO-A'), utf8_decode('ope-clients-update-all'));
$rbac->Roles->assign(utf8_decode('DDO-A'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DDO-A'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DDO-B'), utf8_decode('ope-dps-view-all'));
$rbac->Roles->assign(utf8_decode('DDO-B'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DDO-B'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DDO-C'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DDO-C'), utf8_decode('ope-dps-view-all'));
$rbac->Roles->assign(utf8_decode('DDO-C'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DDO-C'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DDO-C'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DDO-C'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DDASS'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DDASS'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DDC'), utf8_decode('ope-dps-view-all'));
$rbac->Roles->assign(utf8_decode('DDC'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DDC'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DDT'), utf8_decode('admin-settings-view'));
$rbac->Roles->assign(utf8_decode('DDT'), utf8_decode('admin-roles-view'));
$rbac->Roles->assign(utf8_decode('DDT'), utf8_decode('admin-permissions-view'));
$rbac->Roles->assign(utf8_decode('DDT'), utf8_decode('admin-users-view'));
$rbac->Roles->assign(utf8_decode('DDT'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DDT'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DDT-T'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DDT-T'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DDT-L'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DDT-L'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DDT-I'), utf8_decode('admin-settings-update'));
$rbac->Roles->assign(utf8_decode('DDT-I'), utf8_decode('admin-roles-asssign-permissions'));
$rbac->Roles->assign(utf8_decode('DDT-I'), utf8_decode('admin-users-asssign-roles'));
$rbac->Roles->assign(utf8_decode('DDT-I'), utf8_decode('ope-dps-view-all'));
$rbac->Roles->assign(utf8_decode('DDT-I'), utf8_decode('treso-dps-view-all'));
$rbac->Roles->assign(utf8_decode('DDT-I'), utf8_decode('ope-clients-update-all'));
$rbac->Roles->assign(utf8_decode('DDT-I'), utf8_decode('admin-sections-update'));
$rbac->Roles->assign(utf8_decode('DDT-I'), utf8_decode('directory-update'));
$rbac->Roles->assign(utf8_decode('DDT-I'), utf8_decode('admin-mailinglist-manage'));
$rbac->Roles->assign(utf8_decode('DDF'), utf8_decode('admin-roles-view'));
$rbac->Roles->assign(utf8_decode('DDF'), utf8_decode('admin-permissions-view'));
$rbac->Roles->assign(utf8_decode('DDF'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DDF'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('CM-FOR-ARS'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('CM-FOR-ARS'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('CM-FOR-OPR'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('CM-FOR-OPR'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('CM-FOR-CH'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('CM-FOR-CH'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('CM-FOR-CE'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('CM-FOR-CE'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('MED'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('MED'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('CM-PARAMED'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('CM-PARAMED'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('CM-CODEP'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('CM-CODEP'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Asnières'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Asnières'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Asnières'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Asnières'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Asnières'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Asnières'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Asnières'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Asnières'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Asnières'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Asnières'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Asnières'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Asnières'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Asnières'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Asnières'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Asnières'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Asnières'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Asnières'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Asnières'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Asnières'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Asnières'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Asnières'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Asnières'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Asnières'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Asnières'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Asnières'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Asnières'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Asnières'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Asnières'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Asnières'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Asnières'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Asnières'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Asnières'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Asnières'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Asnières'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Asnières'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Asnières'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Asnières'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Boulogne'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Boulogne'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Boulogne'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Boulogne'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Boulogne'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Boulogne'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Boulogne'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Boulogne'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Boulogne'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Boulogne'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Boulogne'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Boulogne'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Boulogne'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Boulogne'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Boulogne'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Boulogne'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Boulogne'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Boulogne'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Boulogne'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Boulogne'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Boulogne'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Boulogne'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Boulogne'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Boulogne'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Boulogne'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Boulogne'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Boulogne'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Boulogne'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Boulogne'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Boulogne'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Boulogne'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Boulogne'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Boulogne'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Boulogne'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Boulogne'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Boulogne'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Boulogne'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Bourg-la-Reine'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Bourg-la-Reine'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Bourg-la-Reine'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Bourg-la-Reine'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Bourg-la-Reine'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Bourg-la-Reine'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Bourg-la-Reine'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Bourg-la-Reine'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Bourg-la-Reine'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Bourg-la-Reine'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Bourg-la-Reine'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Bourg-la-Reine'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Bourg-la-Reine'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Bourg-la-Reine'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Bourg-la-Reine'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Bourg-la-Reine'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Bourg-la-Reine'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Bourg-la-Reine'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Bourg-la-Reine'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Bourg-la-Reine'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Bourg-la-Reine'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Bourg-la-Reine'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Bourg-la-Reine'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Bourg-la-Reine'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Bourg-la-Reine'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Bourg-la-Reine'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Bourg-la-Reine'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Bourg-la-Reine'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Bourg-la-Reine'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Bourg-la-Reine'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Bourg-la-Reine'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Bourg-la-Reine'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Bourg-la-Reine'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Bourg-la-Reine'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Bourg-la-Reine'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Bourg-la-Reine'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Bourg-la-Reine'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Clamart'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Clamart'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Clamart'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Clamart'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Clamart'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Clamart'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Clamart'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Clamart'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Clamart'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Clamart'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Clamart'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Clamart'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Clamart'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Clamart'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Clamart'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Clamart'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Clamart'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Clamart'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Clamart'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Clamart'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Clamart'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Clamart'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Clamart'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Clamart'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Clamart'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Clamart'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Clamart'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Clamart'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Clamart'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Clamart'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Clamart'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Clamart'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Clamart'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Clamart'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Clamart'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Clamart'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Clamart'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Clichy'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Clichy'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Clichy'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Clichy'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Clichy'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Clichy'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Clichy'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Clichy'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Clichy'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Clichy'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Clichy'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Clichy'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Clichy'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Clichy'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Clichy'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Clichy'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Clichy'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Clichy'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Clichy'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Clichy'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Clichy'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Clichy'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Clichy'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Clichy'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Clichy'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Clichy'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Clichy'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Clichy'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Clichy'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Clichy'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Clichy'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Clichy'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Clichy'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Clichy'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Clichy'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Clichy'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Clichy'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Colombes'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Colombes'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Colombes'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Colombes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Colombes'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Colombes'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Colombes'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Colombes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Colombes'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Colombes'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Colombes'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Colombes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Colombes'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Colombes'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Colombes'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Colombes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Colombes'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Colombes'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Colombes'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Colombes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Colombes'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Colombes'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Colombes'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Colombes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Colombes'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Colombes'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Colombes'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Colombes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Colombes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Colombes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Colombes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Colombes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Colombes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Colombes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Colombes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Colombes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Colombes'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Courbevoie'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Courbevoie'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Courbevoie'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Courbevoie'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Courbevoie'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Courbevoie'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Courbevoie'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Courbevoie'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Courbevoie'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Courbevoie'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Courbevoie'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Courbevoie'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Courbevoie'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Courbevoie'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Courbevoie'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Courbevoie'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Courbevoie'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Courbevoie'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Courbevoie'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Courbevoie'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Courbevoie'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-C Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-C Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Courbevoie'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Courbevoie'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Courbevoie'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Garches'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Garches'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Garches'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Garches'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Garches'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Garches'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Garches'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Garches'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Garches'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Garches'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Garches'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Garches'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Garches'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Garches'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Garches'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Garches'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Garches'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Garches'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Garches'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Garches'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Garches'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Garches'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Garches'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Garches'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Garches'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Garches'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Garches'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Garches'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Garches'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Garches'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Garches'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Garches'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Garches'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Garches'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Garches'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Garches'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Garches'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Gennevilliers'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Gennevilliers'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Gennevilliers'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Gennevilliers'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Gennevilliers'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Gennevilliers'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Gennevilliers'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Gennevilliers'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Gennevilliers'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Gennevilliers'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Gennevilliers'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Gennevilliers'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Gennevilliers'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Gennevilliers'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Gennevilliers'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Gennevilliers'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Gennevilliers'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Gennevilliers'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Gennevilliers'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Gennevilliers'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Gennevilliers'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Gennevilliers'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Gennevilliers'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Gennevilliers'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Gennevilliers'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Gennevilliers'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Gennevilliers'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Gennevilliers'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Gennevilliers'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Gennevilliers'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Gennevilliers'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Gennevilliers'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Gennevilliers'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Gennevilliers'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Gennevilliers'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Gennevilliers'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Gennevilliers'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Levallois'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Levallois'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Levallois'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Levallois'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Levallois'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Levallois'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Levallois'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Levallois'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Levallois'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Levallois'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Levallois'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Levallois'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Levallois'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Levallois'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Levallois'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Levallois'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Levallois'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Levallois'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Levallois'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Levallois'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Levallois'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Levallois'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Levallois'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Levallois'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Levallois'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Levallois'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Levallois'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Levallois'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Levallois'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Levallois'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Levallois'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Levallois'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Levallois'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Levallois'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Levallois'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Levallois'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Levallois'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Montrouge'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Montrouge'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Montrouge'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Montrouge'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Montrouge'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Montrouge'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Montrouge'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Montrouge'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Montrouge'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Montrouge'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Montrouge'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Montrouge'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Montrouge'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Montrouge'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Montrouge'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Montrouge'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Montrouge'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Montrouge'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Montrouge'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Montrouge'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Montrouge'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Montrouge'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Montrouge'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Montrouge'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Montrouge'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Montrouge'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Montrouge'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Montrouge'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Montrouge'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Montrouge'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Montrouge'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Montrouge'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Montrouge'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Montrouge'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Montrouge'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Montrouge'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Montrouge'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Nanterre'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Nanterre'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Nanterre'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Nanterre'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Nanterre'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Nanterre'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Nanterre'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Nanterre'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Nanterre'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Nanterre'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Nanterre'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Nanterre'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Nanterre'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Nanterre'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Nanterre'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Nanterre'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Nanterre'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Nanterre'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Nanterre'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Nanterre'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Nanterre'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Nanterre'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Nanterre'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Nanterre'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Nanterre'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Nanterre'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Nanterre'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Nanterre'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Nanterre'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Nanterre'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Nanterre'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Nanterre'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Nanterre'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Nanterre'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Nanterre'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Nanterre'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Nanterre'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Rueil'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Rueil'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Rueil'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Rueil'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Rueil'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Rueil'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Rueil'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Rueil'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Rueil'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Rueil'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Rueil'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Rueil'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Rueil'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Rueil'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Rueil'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Rueil'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Rueil'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Rueil'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Rueil'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Rueil'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Rueil'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Rueil'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Rueil'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Rueil'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Rueil'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Rueil'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Rueil'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Rueil'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Rueil'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Rueil'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Rueil'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Rueil'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Rueil'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Rueil'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Rueil'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Rueil'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Rueil'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Suresnes'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Suresnes'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Suresnes'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Suresnes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Suresnes'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Suresnes'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Suresnes'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Suresnes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Suresnes'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Suresnes'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Suresnes'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Suresnes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Suresnes'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Suresnes'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Suresnes'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Suresnes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Suresnes'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Suresnes'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Suresnes'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Suresnes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Suresnes'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Suresnes'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Suresnes'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Suresnes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Suresnes'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Suresnes'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Suresnes'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Suresnes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Suresnes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Suresnes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Suresnes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Suresnes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Suresnes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Suresnes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Suresnes'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Suresnes'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Suresnes'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Vanves'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Vanves'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Vanves'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Vanves'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Vanves'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Vanves'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Vanves'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Vanves'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Vanves'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Vanves'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Vanves'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Vanves'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Vanves'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Vanves'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Vanves'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Vanves'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Vanves'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Vanves'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Vanves'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Vanves'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Vanves'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Vanves'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Vanves'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Vanves'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Vanves'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Vanves'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Vanves'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Vanves'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Vanves'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Vanves'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Vanves'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Vanves'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Vanves'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Vanves'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Vanves'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Vanves'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Vanves'), utf8_decode('directory-view'));

$rbac->Roles->assign(utf8_decode('Président Villeneuve'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('Président Villeneuve'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Président Villeneuve'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Président Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Président Villeneuve'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Villeneuve'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Villeneuve'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Villeneuve'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Secrétaire Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Secrétaire Villeneuve'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Villeneuve'), utf8_decode('ope-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Villeneuve'), utf8_decode('ope-clients-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Villeneuve'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('Trésorier Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('Trésorier Villeneuve'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO Villeneuve'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO Villeneuve'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO Villeneuve'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO Villeneuve'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Villeneuve'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-A Villeneuve'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Villeneuve'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-A Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-A Villeneuve'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Villeneuve'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-B Villeneuve'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Villeneuve'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-B Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-B Villeneuve'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Villeneuve'), utf8_decode('ope-dps-validate-local'));
$rbac->Roles->assign(utf8_decode('DLO-C Villeneuve'), utf8_decode('ope-clients-update-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Villeneuve'), utf8_decode('treso-dps-view-own'));
$rbac->Roles->assign(utf8_decode('DLO-C Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLO-C Villeneuve'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF Villeneuve'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-A Villeneuve'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLF-B Villeneuve'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLAS Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLAS Villeneuve'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLC Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLC Villeneuve'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT Villeneuve'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Matér Villeneuve'), utf8_decode('directory-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Villeneuve'), utf8_decode('admin-sections-view'));
$rbac->Roles->assign(utf8_decode('DLT-L Véhic Villeneuve'), utf8_decode('directory-view'));




/////////////////////////////////////////////////
// GOD MODE FOR THE USER INSTALLING THIS SCRIPT
/////////////////////////////////////////////////
$rbac->Users->assign('Admin', $_SESSION["ID"]);





/////////////////////////////////////////////////
// END OF INSTALLATION SCRIPT
/////////////////////////////////////////////////
?>
<br />
C'est fini : <?php echo date("H:i:s"); ?>
</body>
</html>
