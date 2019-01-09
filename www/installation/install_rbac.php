<?php require_once('../PhpRbac/src/PhpRbac/Rbac.php'); ?>
<?php require_once('../functions/session/db-connect.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Installation des rôles et permissions</title>
	<?php require_once('../components/common-html-head-parameters.php'); ?>
</head>
<body>

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

function convert_utf8_if_prod($string) {
	if(isset($_GET["prod"])){
		return (utf8_decode($string));
	}
	else {
		return ($string);
	}
}


/////////////////////////////////////////////////
// RESET THE PHPRBAC SYSTEM
/////////////////////////////////////////////////
$rbac->reset(true);


/////////////////////////////////////////////////
// SQL TABLES
/////////////////////////////////////////////////

mysqli_query($db_link, "ALTER TABLE `$tablename_roles`
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
// INITIALIZING PERMISSIONS SYSTEM
/////////////////////////////////////////////////
$rbac->Permissions->addPath('/admin-settings-update/admin-settings-view', array(convert_utf8_if_prod('Modifier les réglages'), convert_utf8_if_prod('Voir les réglages')));
$rbac->Permissions->addPath('/admin-permissions-update/admin-permissions-view', array(convert_utf8_if_prod('Modifier les permissions'), convert_utf8_if_prod('Voir les permissions')));
$rbac->Permissions->addPath('/admin-roles-asssign-permissions/admin-roles-update/admin-roles-view', array(convert_utf8_if_prod('Assigner des permissions aux rôles'), convert_utf8_if_prod('Modifier les rôles'), convert_utf8_if_prod('Voir les rôles')));
$rbac->Permissions->addPath('/admin-users-asssign-roles/admin-users-update/admin-users-view', array(convert_utf8_if_prod('Assigner des rôles aux utilisateurs'), convert_utf8_if_prod('Modifier les utilisateurs'), convert_utf8_if_prod('Voir les utilisateurs')));
$rbac->Permissions->addPath('/ope-dps-validate-local/ope-dps-update-own/ope-dps-view-own', array(convert_utf8_if_prod('Valider une demande de DPS pour sa commune'), convert_utf8_if_prod('Créer/Modifier un DPS sur sa commune'), convert_utf8_if_prod('Voir les DPS de sa commune')));
$rbac->Permissions->addPath('/ope-dps-validate-dept/ope-dps-update-dept/ope-dps-view-dept', array(convert_utf8_if_prod('Valider une demande de DPS pour le département'), convert_utf8_if_prod('Créer/Modifier un DPS sur le département'), convert_utf8_if_prod('Voir les DPS départementaux')));
$rbac->Permissions->addPath('/ope-dps-validate-ddo-to-pref/ope-dps-update-all/ope-dps-view-all', array(convert_utf8_if_prod('Envoyer une demande de DPS à la Préfecture'), convert_utf8_if_prod('Créer/Modifier un DPS sur toute commune'), convert_utf8_if_prod('Voir les DPS de toutes les communes')));
$rbac->Permissions->addPath('/ope-clients-update-own/ope-clients-view-own', array(convert_utf8_if_prod('Modifier les clients de son antenne'), convert_utf8_if_prod('Voir les clients de son antenne')));
$rbac->Permissions->addPath('/ope-clients-update-all/ope-clients-view-all', array(convert_utf8_if_prod('Modifier tous les clients'), convert_utf8_if_prod('Voir tous les clients')));
$rbac->Permissions->addPath('/treso-dps-view-all/treso-dps-view-own', array(convert_utf8_if_prod('Voir toute la trésorerie'), convert_utf8_if_prod('Voir la trésorerie de son antenne')));
$rbac->Permissions->addPath('/directory-update/directory-view', array(convert_utf8_if_prod('Modifier annuaire'), convert_utf8_if_prod('Voir annuaire')));
$rbac->Permissions->addPath('/admin-mailinglist-manage', array(convert_utf8_if_prod('Gestion des listes de diffusion')));
$rbac->Permissions->addPath('/admin-sections-update/admin-sections-view', array(convert_utf8_if_prod('Modifier les sections'), convert_utf8_if_prod('Voir les sections')));
// Trésorerie ?
// Factures ?


/////////////////////////////////////////////////
// INITIALIZING ROLES SYSTEM
/////////////////////////////////////////////////
$rbac->Roles->add(convert_utf8_if_prod('Admin'), convert_utf8_if_prod('Administrateur'));
$rbac->Roles->add(convert_utf8_if_prod('Public'), convert_utf8_if_prod('Public'));

$rbac->Roles->add(convert_utf8_if_prod('Président'), convert_utf8_if_prod('Président départemental'));
$rbac->Roles->add(convert_utf8_if_prod('Vice-Président-1'), convert_utf8_if_prod('1er Vice-Président départemental'));
$rbac->Roles->add(convert_utf8_if_prod('Vice-Président-2'), convert_utf8_if_prod('2nd Vice-Président départemental'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire'), convert_utf8_if_prod('Secrétaire général'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Adjoint'), convert_utf8_if_prod('Secrétaire général adjoint'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier'), convert_utf8_if_prod('Trésorier départemental'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Adjoint'), convert_utf8_if_prod('Trésorier départemental adjoint'));
$rbac->Roles->add(convert_utf8_if_prod('DDO'), convert_utf8_if_prod('Directeur Départemental des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('DDO-A'), convert_utf8_if_prod('Directrice des Opérations adjointe'));
$rbac->Roles->add(convert_utf8_if_prod('DDO-B'), convert_utf8_if_prod('Directrice des Opérations adjointe aux réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('DDO-C'), convert_utf8_if_prod('Directeur des Opérations adjoint aux missions départementales et nationales'));
$rbac->Roles->add(convert_utf8_if_prod('DASS'), convert_utf8_if_prod('Directrice des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('DC'), convert_utf8_if_prod('Directeur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('DT'), convert_utf8_if_prod('Directeur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('DT-T'), convert_utf8_if_prod('Directeur Technique adjoint aux moyens de trasnmission'));
$rbac->Roles->add(convert_utf8_if_prod('DT-L'), convert_utf8_if_prod('Directeur Technique adjoint aux moyens logistiques'));
$rbac->Roles->add(convert_utf8_if_prod('DT-I'), convert_utf8_if_prod('Directeur Technique adjoint aux moyens informatiques'));
$rbac->Roles->add(convert_utf8_if_prod('DF'), convert_utf8_if_prod('Directeur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('MED'), convert_utf8_if_prod('Médecin Référent'));
$rbac->Roles->add(convert_utf8_if_prod('SECRETARIAT'), convert_utf8_if_prod('Secrétariat Administratif'));

$rbac->Roles->add(convert_utf8_if_prod('CM-FOR-ARS'), convert_utf8_if_prod('Chargé de Mission responsable des formations ARS'));
$rbac->Roles->add(convert_utf8_if_prod('CM-FOR-OPR'), convert_utf8_if_prod('Chargé de Mission responsable des formations OPR'));
$rbac->Roles->add(convert_utf8_if_prod('CM-FOR-CH'), convert_utf8_if_prod('Chargé de Mission responsable des formations Conducteur'));
$rbac->Roles->add(convert_utf8_if_prod('CM-FOR-CE'), convert_utf8_if_prod('Chargé de Mission responsable des formations CE / CP / CEPS'));
$rbac->Roles->add(convert_utf8_if_prod('CM-PARAMED'), convert_utf8_if_prod('Chargé de Mission responsable de l\'équipe paramédicale'));
$rbac->Roles->add(convert_utf8_if_prod('CM-CODEP'), convert_utf8_if_prod('Chargé de Mission responsable des CODEP et Exercices'));

$rbac->Roles->add(convert_utf8_if_prod('V-COM'), convert_utf8_if_prod('Communication'));
$rbac->Roles->add(convert_utf8_if_prod('V-OPE'), convert_utf8_if_prod('Opérationnel'));
$rbac->Roles->add(convert_utf8_if_prod('V-FOR'), convert_utf8_if_prod('Formation'));
$rbac->Roles->add(convert_utf8_if_prod('V-TECH'), convert_utf8_if_prod('Technique'));
$rbac->Roles->add(convert_utf8_if_prod('V-BUREAU'), convert_utf8_if_prod('Bureau Départemental'));
$rbac->Roles->add(convert_utf8_if_prod('V-CD'), convert_utf8_if_prod('Conseil Départemental'));
$rbac->Roles->add(convert_utf8_if_prod('V-RECRUTEMENT'), convert_utf8_if_prod('Recrutement'));
$rbac->Roles->add(convert_utf8_if_prod('V-DEMANDE-DPS'), convert_utf8_if_prod('Demande de poste de secours'));

$rbac->Roles->add(convert_utf8_if_prod('P-CODEP'), convert_utf8_if_prod('Cadre Opérationnel Départemental de Permanence'));
$rbac->Roles->add(convert_utf8_if_prod('P-MICRO'), convert_utf8_if_prod('Permanence Transmissions'));
$rbac->Roles->add(convert_utf8_if_prod('P-TRANSF'), convert_utf8_if_prod('Permanence de transfert opérationnel'));

$rbac->Roles->add(convert_utf8_if_prod('C-LOG'), convert_utf8_if_prod('Pôle Logistique'));
$rbac->Roles->add(convert_utf8_if_prod('C-TRANS'), convert_utf8_if_prod('Pôle Transmissions'));
$rbac->Roles->add(convert_utf8_if_prod('C-INFO'), convert_utf8_if_prod('Pôle Informatique'));

$rbac->Roles->add(convert_utf8_if_prod('D-RANT'), convert_utf8_if_prod('Liste de diffusion Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('D-SEC'), convert_utf8_if_prod('Liste de diffusion Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('D-TRESO'), convert_utf8_if_prod('Liste de diffusion Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('D-CO'), convert_utf8_if_prod('Liste de diffusion Opérationnel'));
$rbac->Roles->add(convert_utf8_if_prod('D-CF'), convert_utf8_if_prod('Liste de diffusion Formation'));
$rbac->Roles->add(convert_utf8_if_prod('D-CA'), convert_utf8_if_prod('Liste de diffusion Actions Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('D-CT'), convert_utf8_if_prod('Liste de diffusion Technique Logistique'));
$rbac->Roles->add(convert_utf8_if_prod('D-CT-T'), convert_utf8_if_prod('Liste de diffusion Technique Transmissions'));
$rbac->Roles->add(convert_utf8_if_prod('D-CC'), convert_utf8_if_prod('Liste de diffusion Communication'));

$rbac->Roles->add(convert_utf8_if_prod('Président Asnières'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Asnières'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Asnières'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Asnières'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Asnières'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Asnières'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Asnières'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Asnières'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Asnières'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Asnières'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Asnières'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Asnières'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Asnières'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Asnières'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Asnières'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Boulogne'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Boulogne'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Boulogne'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Boulogne'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Boulogne'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Boulogne'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Boulogne'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Boulogne'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Boulogne'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Boulogne'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Boulogne'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Boulogne'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Boulogne'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Boulogne'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Boulogne'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Bourg-la-Reine'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Bourg-la-Reine'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Bourg-la-Reine'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Bourg-la-Reine'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Bourg-la-Reine'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Bourg-la-Reine'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Bourg-la-Reine'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Bourg-la-Reine'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Bourg-la-Reine'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Bourg-la-Reine'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Bourg-la-Reine'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Bourg-la-Reine'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Bourg-la-Reine'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Bourg-la-Reine'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Bourg-la-Reine'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Clamart'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Clamart'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Clamart'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Clamart'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Clamart'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Clamart'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Clamart'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Clamart'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Clamart'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Clamart'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Clamart'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Clamart'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Clamart'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Clamart'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Clamart'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Clichy'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Clichy'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Clichy'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Clichy'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Clichy'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Clichy'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Clichy'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Clichy'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Clichy'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Clichy'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Clichy'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Clichy'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Clichy'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Clichy'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Clichy'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Colombes'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Colombes'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Colombes'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Colombes'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Colombes'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Colombes'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Colombes'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Colombes'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Colombes'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Colombes'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Colombes'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Colombes'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Colombes'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Colombes'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Colombes'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Courbevoie'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Courbevoie'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Courbevoie'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Courbevoie'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Courbevoie'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Courbevoie'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Courbevoie'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Courbevoie'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Courbevoie'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Courbevoie'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe Grand Public'));
$rbac->Roles->add(convert_utf8_if_prod('CF-C Courbevoie'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe Grands Comptes'));
$rbac->Roles->add(convert_utf8_if_prod('CA Courbevoie'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Courbevoie'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Courbevoie'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Courbevoie'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Courbevoie'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Garches'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Garches'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Garches'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Garches'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Garches'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Garches'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Garches'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Garches'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Garches'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Garches'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Garches'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Garches'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Garches'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Garches'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Garches'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Gennevilliers'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Gennevilliers'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Gennevilliers'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Gennevilliers'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Gennevilliers'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Gennevilliers'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Gennevilliers'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Gennevilliers'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Gennevilliers'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Gennevilliers'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Gennevilliers'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Gennevilliers'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Gennevilliers'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Gennevilliers'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Gennevilliers'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Levallois'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Levallois'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Levallois'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Levallois'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Levallois'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Levallois'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Levallois'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Levallois'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Levallois'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Levallois'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Levallois'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Levallois'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Levallois'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Levallois'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Levallois'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Montrouge'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Montrouge'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Montrouge'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Montrouge'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Montrouge'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Montrouge'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Montrouge'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Montrouge'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Montrouge'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Montrouge'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Montrouge'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Montrouge'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Montrouge'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Montrouge'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Montrouge'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Nanterre'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Nanterre'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Nanterre'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Nanterre'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Nanterre'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Nanterre'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Nanterre'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Nanterre'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Nanterre'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Nanterre'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Nanterre'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Nanterre'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Nanterre'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Nanterre'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Nanterre'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Rueil'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Rueil'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Rueil'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Rueil'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Rueil'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Rueil'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Rueil'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Rueil'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Rueil'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Rueil'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Rueil'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Rueil'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Rueil'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Rueil'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Rueil'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Suresnes'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Suresnes'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Suresnes'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Suresnes'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Suresnes'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Suresnes'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Suresnes'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Suresnes'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Suresnes'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Suresnes'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Suresnes'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Suresnes'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Suresnes'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Suresnes'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Suresnes'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Vanves'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Vanves'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Vanves'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Vanves'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Vanves'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Vanves'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Vanves'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Vanves'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Vanves'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Vanves'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Vanves'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Vanves'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Vanves'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Vanves'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Vanves'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));

$rbac->Roles->add(convert_utf8_if_prod('Président Villeneuve'), convert_utf8_if_prod('Responsable d\'Antenne'));
$rbac->Roles->add(convert_utf8_if_prod('Secrétaire Villeneuve'), convert_utf8_if_prod('Secrétaire'));
$rbac->Roles->add(convert_utf8_if_prod('Trésorier Villeneuve'), convert_utf8_if_prod('Trésorier'));
$rbac->Roles->add(convert_utf8_if_prod('CO Villeneuve'), convert_utf8_if_prod('Coordinateur des Opérations'));
$rbac->Roles->add(convert_utf8_if_prod('CO-A Villeneuve'), convert_utf8_if_prod('Coordinateur des Opérations adjoint aux missions extérieures'));
$rbac->Roles->add(convert_utf8_if_prod('CO-B Villeneuve'), convert_utf8_if_prod('Coordinateur des Opérations adjoint au réseau de secours'));
$rbac->Roles->add(convert_utf8_if_prod('CO-C Villeneuve'), convert_utf8_if_prod('Coordinateur des Opérations adjoint en charge de l\'administratif'));
$rbac->Roles->add(convert_utf8_if_prod('CF Villeneuve'), convert_utf8_if_prod('Coordinateur des Formations'));
$rbac->Roles->add(convert_utf8_if_prod('CF-A Villeneuve'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation interne'));
$rbac->Roles->add(convert_utf8_if_prod('CF-B Villeneuve'), convert_utf8_if_prod('Coordinateur des Formations adjoint à la formation externe'));
$rbac->Roles->add(convert_utf8_if_prod('CA Villeneuve'), convert_utf8_if_prod('Coordinateur des Actions Solidaires et Sociales'));
$rbac->Roles->add(convert_utf8_if_prod('CC Villeneuve'), convert_utf8_if_prod('Coordinateur de la Communication'));
$rbac->Roles->add(convert_utf8_if_prod('CT Villeneuve'), convert_utf8_if_prod('Coordinateur Technique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Matér Villeneuve'), convert_utf8_if_prod('Coordinateur Technique adjoint à la logistique'));
$rbac->Roles->add(convert_utf8_if_prod('CT-L Véhic Villeneuve'), convert_utf8_if_prod('Coordinateur Technique adjoint aux véhicules'));




/////////////////////////////////////////////////
// ADD ALL MISSING INFORMATION ABOUT ROLES
/////////////////////////////////////////////////
mysqli_query($db_link, "UPDATE `$tablename_roles` SET
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

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
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

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0674953172',
	`Mail`='president@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Autorité 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='vice-president-1@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Autorité 92 Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='1',
	`Tags`='Bureau|Président'
	WHERE `Title`='Vice-Président-1'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
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

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0676457981',
	`Mail`='secretaire-general@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Autorité 92 Delta',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-general-adj@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='11',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Adjoint'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0677464713',
	`Mail`='tresorier@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-adj@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='21',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Adjoint'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0674953175',
	`Mail`='directeur-operations@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Opé 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='DDO'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0674953165',
	`Mail`='directeur-adj-operations@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Opé 92 Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='DDO-A'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0674953173',
	`Mail`='directeur-adj-reseau-secours@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Opé 92 Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='DDO-B'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='directeur-adj-dispositif@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Opé 92 Charlie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='DDO-C'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0632989106',
	`Mail`='directeur-actions-sociales@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Acso 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='DASS'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0689178043',
	`Mail`='directeur-communication@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='COM 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='DC'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0674953159',
	`Mail`='directeur-technique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Tech 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='DT'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0674953157',
	`Mail`='directeur-adj-logistique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Tech 92 Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='DT-L'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='directeur-adj-informatique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Tech 92 Charlie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='DT-I'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0674953162',
	`Mail`='directeur-adj-transmissions@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Tech 92 Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='53',
	`Tags`='Technique'
	WHERE `Title`='DT-T'
	");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0676457978',
	`Mail`='directeur-formations@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='For 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='DF'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='medica92@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Medica 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='81',
	`Tags`='Divers'
	WHERE `Title`='MED'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretariat@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='80',
	`Tags`='Divers'
	WHERE `Title`='SECRETARIAT'
");

///////////////////////////////////////////////
// CHARGÉS DE MISSION
///////////////////////////////////////////////

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0676457978',
	`Mail`='formation-ars@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CM-FOR-ARS'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0676457978',
	`Mail`='',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='43',
	`Tags`='Formation'
	WHERE `Title`='CM-FOR-OPR'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0676457978',
	`Mail`='formation-ceps@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='44',
	`Tags`='Formation'
	WHERE `Title`='CM-FOR-CE'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0676457978',
	`Mail`='formation-conducteur@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='45',
	`Tags`='Formation'
	WHERE `Title`='CM-FOR-CH'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='paramedical@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='Paramed 92',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='82',
	`Tags`='Divers'
	WHERE `Title`='CM-PARAMED'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='directeur-adj-cadre-permanence@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='35',
	`Tags`='Opérationnel'
	WHERE `Title`='CM-CODEP'
");

///////////////////////////////////////////////
// PÔLES / COMMISSIONS
///////////////////////////////////////////////

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='pole-logistique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='55',
	`Tags`='Pôle|Technique'
	WHERE `Title`='C-LOG'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='pole-transmissions@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='56',
	`Tags`='Pôle|Technique'
	WHERE `Title`='C-TRANS'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='pole-informatique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='57',
	`Tags`='Pôle|Technique'
	WHERE `Title`='C-INFO'
");

///////////////////////////////////////////////
// DIVERS
///////////////////////////////////////////////

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='bureau@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='21',
	`Tags`='Bureau'
	WHERE `Title`='V-BUREAU'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='conseil-departemental@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='22',
	`Tags`='Divers|Bureau'
	WHERE `Title`='V-CD'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='recrutement@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='83',
	`Tags`='Divers'
	WHERE `Title`='V-RECRUTEMENT'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='demande-dps@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='84',
	`Tags`='Divers|Opérationnel'
	WHERE `Title`='V-DEMANDE-DPS'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='61',
	`Tags`='Communication'
	WHERE `Title`='V-COM'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='34',
	`Tags`='Opérationnel'
	WHERE `Title`='V-OPE'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='V-FOR'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='technique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='55',
	`Tags`='Technique'
	WHERE `Title`='V-TECH'
");

///////////////////////////////////////////////
// PERMANENCES
///////////////////////////////////////////////

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='07 51 60 75 18',
	`Mail`='permanence-bureau@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='38',
	`Tags`='Permanence|Opérationnel|Bureau'
	WHERE `Title`='P-TRANSF'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0674953170',
	`Mail`='permanence-operationnel@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='VISU 92',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='36',
	`Tags`='Permanence|Opérationnel'
	WHERE `Title`='P-CODEP'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0674953166',
	`Mail`='permanence-transmissions@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='MICRO 92',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='37',
	`Tags`='Permanence|Opérationnel'
	WHERE `Title`='P-MICRO'
");

///////////////////////////////////////////////
// LISTES DE DIFFUSION
///////////////////////////////////////////////

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='antennes-president@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='3',
	`Tags`='Diffusion|Président'
	WHERE `Title`='D-RANT'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='antennes-secretaire@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='12',
	`Tags`='Diffusion|Secrétaire'
	WHERE `Title`='D-SEC'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='antennes-tresorier@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='22',
	`Tags`='Diffusion|Trésorier'
	WHERE `Title`='D-TRESO'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='antennes-operationnel@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='39',
	`Tags`='Diffusion|Opérationnel'
	WHERE `Title`='D-CO'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='antennes-formation@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='46',
	`Tags`='Diffusion|Formation'
	WHERE `Title`='D-CF'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='antennes-actions-sociales@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='71',
	`Tags`='Diffusion|Acso'
	WHERE `Title`='D-CA'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='antennes-logistique@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='58',
	`Tags`='Diffusion|Technique'
	WHERE `Title`='D-CT'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='antennes-transmissions@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='59',
	`Tags`='Diffusion|Technique'
	WHERE `Title`='D-CT-T'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='antennes-communication@protectioncivile92.org',
	`Affiliation`='0',
	`Callsign`='',
	`Directory`='1',
	`Assignable`='0',
	`Hierarchy`='62',
	`Tags`='Diffusion|Communication'
	WHERE `Title`='D-CC'
");

///////////////////////////////////////////////
// ROLES DES ANTENNES
///////////////////////////////////////////////

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0650842289',
	`Mail`='president-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Autorité Asnières',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Asnières'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Autorité Asnières Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Asnières'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Autorité Asnières Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Asnières'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0664651746',
	`Mail`='operationnel-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Opé Asnières',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Asnières'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Opé Asnières Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Asnières'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Opé Asnières Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Asnières'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Opé Asnières Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Asnières'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0147903359',
	`Mail`='formation-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='For Asnières',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Asnières'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='For Asnières Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Asnières'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='For Asnières Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Asnières'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Acso Asnières',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Asnières'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Com Asnières',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Asnières'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Tech Asnières',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Asnières'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Tech Asnières Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Asnières'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-asnieres@protectioncivile92.org',
	`Affiliation`='2',
	`Callsign`='Tech Asnières Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Asnières'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0783884779',
	`Mail`='president-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Autorité Boulogne',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Boulogne'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Autorité Boulogne Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Boulogne'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Autorité Boulogne Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Boulogne'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0652368855',
	`Mail`='operationnel-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Opé Boulogne',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Boulogne'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Opé Boulogne Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Boulogne'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Opé Boulogne Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Boulogne'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Opé Boulogne Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Boulogne'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0652221205',
	`Mail`='formation-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='For Boulogne',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Boulogne'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='For Boulogne Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Boulogne'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='For Boulogne Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Boulogne'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Acso Boulogne',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Boulogne'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Com Boulogne',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Boulogne'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Tech Boulogne',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Boulogne'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Tech Boulogne Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Boulogne'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-boulogne-issy@protectioncivile92.org',
	`Affiliation`='5',
	`Callsign`='Tech Boulogne Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Boulogne'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0632989170',
	`Mail`='president-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Autorité Bourg-la-Reine',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Autorité Bourg-la-Reine Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Autorité Bourg-la-Reine Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0607102726',
	`Mail`='operationnel-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Opé Bourg-la-Reine',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Opé Bourg-la-Reine Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Opé Bourg-la-Reine Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Opé Bourg-la-Reine Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0695049978',
	`Mail`='formation-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='For Bourg-la-Reine',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='For Bourg-la-Reine Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0679560098',
	`Mail`='formation-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='For Bourg-la-Reine Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Acso Bourg-la-Reine',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Com Bourg-la-Reine',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Tech Bourg-la-Reine',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Tech Bourg-la-Reine Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Bourg-la-Reine'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-bourg-la-reine@protectioncivile92.org',
	`Affiliation`='6',
	`Callsign`='Tech Bourg-la-Reine Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Bourg-la-Reine'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='president-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Autorité Clamart',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Clamart'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Autorité Clamart Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Clamart'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Autorité Clamart Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Clamart'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Opé Clamart',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Clamart'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Opé Clamart Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Clamart'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Opé Clamart Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Clamart'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Opé Clamart Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Clamart'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='For Clamart',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Clamart'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='For Clamart Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Clamart'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='For Clamart Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Clamart'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Acso Clamart',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Clamart'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Com Clamart',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Clamart'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Tech Clamart',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Clamart'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Tech Clamart Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Clamart'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-clamart@protectioncivile92.org',
	`Affiliation`='10',
	`Callsign`='Tech Clamart Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Clamart'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='president-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Autorité Clichy',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Clichy'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Autorité Clichy Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Clichy'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Autorité Clichy Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Clichy'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Opé Clichy',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Clichy'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Opé Clichy Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Clichy'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Opé Clichy Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Clichy'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Opé Clichy Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Clichy'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='For Clichy',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Clichy'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='For Clichy Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Clichy'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='For Clichy Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Clichy'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Acso Clichy',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Clichy'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Com Clichy',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Clichy'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Tech Clichy',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Clichy'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Tech Clichy Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Clichy'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-clichy@protectioncivile92.org',
	`Affiliation`='11',
	`Callsign`='Tech Clichy Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Clichy'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='president-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Autorité Colombes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Colombes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Autorité Colombes Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Colombes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Autorité Colombes Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Colombes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Opé Colombes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Colombes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Opé Colombes Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Colombes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Opé Colombes Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Colombes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Opé Colombes Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Colombes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='For Colombes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Colombes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='For Colombes Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Colombes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='For Colombes Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Colombes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Acso Colombes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Colombes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Com Colombes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Colombes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Tech Colombes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Colombes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Tech Colombes Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Colombes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-colombes@protectioncivile92.org',
	`Affiliation`='12',
	`Callsign`='Tech Colombes Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Colombes'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0762263688',
	`Mail`='president-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Autorité Courbevoie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Autorité Courbevoie Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Autorité Courbevoie Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0674728980',
	`Mail`='operationnel-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Opé Courbevoie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0652540653',
	`Mail`='operationnel-adj-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Opé Courbevoie Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Opé Courbevoie Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Opé Courbevoie Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='For Courbevoie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='For Courbevoie Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0616461022',
	`Mail`='formation-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='For Courbevoie Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='For Courbevoie Charlie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='4',
	`Tags`='Formation'
	WHERE `Title`='CF-C Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0762261863',
	`Mail`='actions-sociales-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Acso Courbevoie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Com Courbevoie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Tech Courbevoie',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Tech Courbevoie Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Courbevoie'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-courbevoie@protectioncivile92.org',
	`Affiliation`='13',
	`Callsign`='Tech Courbevoie Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Courbevoie'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0676457979',
	`Mail`='president-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Autorité Garches',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Garches'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Autorité Garches Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Garches'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Autorité Garches Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Garches'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0750939211',
	`Mail`='operationnel-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Opé Garches',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Garches'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Opé Garches Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Garches'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Opé Garches Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Garches'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Opé Garches Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Garches'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0750857300',
	`Mail`='formation-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='For Garches',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Garches'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='For Garches Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Garches'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='For Garches Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Garches'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Acso Garches',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Garches'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Com Garches',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Garches'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Tech Garches',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Garches'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Tech Garches Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Garches'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-garches@protectioncivile92.org',
	`Affiliation`='15',
	`Callsign`='Tech Garches Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Garches'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='president-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Autorité Gennevilliers',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Gennevilliers'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Autorité Gennevilliers Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Gennevilliers'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Autorité Gennevilliers Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Gennevilliers'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0660264451',
	`Mail`='operationnel-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Opé Gennevilliers',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Gennevilliers'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Opé Gennevilliers Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Gennevilliers'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Opé Gennevilliers Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Gennevilliers'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Opé Gennevilliers Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Gennevilliers'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0673493244',
	`Mail`='formation-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='For Gennevilliers',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Gennevilliers'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='For Gennevilliers Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Gennevilliers'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='For Gennevilliers Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Gennevilliers'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Acso Gennevilliers',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Gennevilliers'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Com Gennevilliers',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Gennevilliers'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Tech Gennevilliers',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Gennevilliers'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Tech Gennevilliers Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Gennevilliers'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-gennevilliers@protectioncivile92.org',
	`Affiliation`='17',
	`Callsign`='Tech Gennevilliers Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Gennevilliers'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='president-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Autorité Levallois',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Levallois'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Autorité Levallois Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Levallois'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Autorité Levallois Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Levallois'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0664979200',
	`Mail`='operationnel-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Opé Levallois',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Levallois'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0665640020',
	`Mail`='operationnel-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Opé Levallois Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Levallois'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Opé Levallois Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Levallois'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Opé Levallois Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Levallois'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0667523257',
	`Mail`='formation-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='For Levallois',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Levallois'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='For Levallois Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Levallois'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='For Levallois Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Levallois'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Acso Levallois',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Levallois'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Com Levallois',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Levallois'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Tech Levallois',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Levallois'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Tech Levallois Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Levallois'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-levallois@protectioncivile92.org',
	`Affiliation`='20',
	`Callsign`='Tech Levallois Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Levallois'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='president-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Autorité Montrouge',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Montrouge'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Autorité Montrouge Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Montrouge'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Autorité Montrouge Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Montrouge'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Opé Montrouge',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Montrouge'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Opé Montrouge Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Montrouge'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Opé Montrouge Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Montrouge'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Opé Montrouge Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Montrouge'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='For Montrouge',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Montrouge'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='For Montrouge Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Montrouge'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='For Montrouge Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Montrouge'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Acso Montrouge',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Montrouge'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Com Montrouge',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Montrouge'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Tech Montrouge',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Montrouge'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Tech Montrouge Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Montrouge'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-montrouge@protectioncivile92.org',
	`Affiliation`='23',
	`Callsign`='Tech Montrouge Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Montrouge'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='president-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Autorité Nanterre',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Nanterre'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Autorité Nanterre Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Nanterre'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Autorité Nanterre Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Nanterre'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Opé Nanterre',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Nanterre'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Opé Nanterre Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Nanterre'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Opé Nanterre Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Nanterre'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Opé Nanterre Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Nanterre'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='For Nanterre',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Nanterre'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='For Nanterre Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Nanterre'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='For Nanterre Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Nanterre'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Acso Nanterre',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Nanterre'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Com Nanterre',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Nanterre'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Tech Nanterre',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Nanterre'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Tech Nanterre Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Nanterre'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-nanterre@protectioncivile92.org',
	`Affiliation`='24',
	`Callsign`='Tech Nanterre Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Nanterre'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0699400128',
	`Mail`='president-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Autorité Rueil',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Rueil'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Autorité Rueil Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Rueil'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Autorité Rueil Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Rueil'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0699420228',
	`Mail`='operationnel-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Opé Rueil',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Rueil'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Opé Rueil Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Rueil'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Opé Rueil Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Rueil'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Opé Rueil Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Rueil'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='For Rueil',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Rueil'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='For Rueil Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Rueil'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='For Rueil Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Rueil'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Acso Rueil',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Rueil'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Com Rueil',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Rueil'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Tech Rueil',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Rueil'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Tech Rueil Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Rueil'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-rueil@protectioncivile92.org',
	`Affiliation`='28',
	`Callsign`='Tech Rueil Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Rueil'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='president-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Autorité Suresnes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Suresnes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Autorité Suresnes Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Suresnes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Autorité Suresnes Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Suresnes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Opé Suresnes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Suresnes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Opé Suresnes Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Suresnes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Opé Suresnes Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Suresnes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Opé Suresnes Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Suresnes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='For Suresnes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Suresnes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='For Suresnes Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Suresnes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='For Suresnes Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Suresnes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Acso Suresnes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Suresnes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Com Suresnes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Suresnes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Tech Suresnes',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Suresnes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Tech Suresnes Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Suresnes'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-suresnes-puteaux@protectioncivile92.org',
	`Affiliation`='32',
	`Callsign`='Tech Suresnes Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Suresnes'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='president-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Autorité Vanves',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Vanves'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Autorité Vanves Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Vanves'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Autorité Vanves Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Vanves'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Opé Vanves',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Vanves'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Opé Vanves Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Vanves'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Opé Vanves Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Vanves'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Opé Vanves Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Vanves'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='For Vanves',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Vanves'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='For Vanves Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Vanves'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='For Vanves Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Vanves'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Acso Vanves',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Vanves'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Com Vanves',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Vanves'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Tech Vanves',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Vanves'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Tech Vanves Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Vanves'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-vanves@protectioncivile92.org',
	`Affiliation`='33',
	`Callsign`='Tech Vanves Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Vanves'
");


mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0768978637',
	`Mail`='president-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Autorité Villeneuve',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='0',
	`Tags`='Bureau|Président'
	WHERE `Title`='Président Villeneuve'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='secretaire-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Autorité Villeneuve Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='10',
	`Tags`='Bureau|Secrétaire'
	WHERE `Title`='Secrétaire Villeneuve'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='tresorier-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Autorité Villeneuve Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='20',
	`Tags`='Bureau|Trésorier'
	WHERE `Title`='Trésorier Villeneuve'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0768664829',
	`Mail`='operationnel-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Opé Villeneuve',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='30',
	`Tags`='Opérationnel'
	WHERE `Title`='CO Villeneuve'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-adj-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Opé Villeneuve Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='31',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-A Villeneuve'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Opé Villeneuve Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='32',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-B Villeneuve'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='operationnel-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Opé Villeneuve Charlie',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='33',
	`Tags`='Opérationnel'
	WHERE `Title`='CO-C Villeneuve'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='0768541942',
	`Mail`='formation-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='For Villeneuve',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='40',
	`Tags`='Formation'
	WHERE `Title`='CF Villeneuve'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='For Villeneuve Alpha',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='41',
	`Tags`='Formation'
	WHERE `Title`='CF-A Villeneuve'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='formation-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='For Villeneuve Bravo',
	`Directory`='0',
	`Assignable`='1',
	`Hierarchy`='42',
	`Tags`='Formation'
	WHERE `Title`='CF-B Villeneuve'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='actions-sociales-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Acso Villeneuve',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='70',
	`Tags`='Acso'
	WHERE `Title`='CA Villeneuve'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='communication-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Com Villeneuve',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='60',
	`Tags`='Communication'
	WHERE `Title`='CC Villeneuve'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Tech Villeneuve',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='50',
	`Tags`='Technique'
	WHERE `Title`='CT Villeneuve'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Tech Villeneuve Alpha',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='51',
	`Tags`='Technique'
	WHERE `Title`='CT-L Matér Villeneuve'
");

mysqli_query($db_link, "UPDATE `$tablename_roles` SET
	`Phone`='',
	`Mail`='logistique-villeneuve@protectioncivile92.org',
	`Affiliation`='36',
	`Callsign`='Tech Villeneuve Bravo',
	`Directory`='1',
	`Assignable`='1',
	`Hierarchy`='52',
	`Tags`='Technique'
	WHERE `Title`='CT-L Véhic Villeneuve'
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
$rbac->Roles->assign('DASS', 'admin-sections-view');
$rbac->Roles->assign('DASS', 'directory-view');
$rbac->Roles->assign('DC', 'ope-dps-view-all');
$rbac->Roles->assign('DC', 'admin-sections-view');
$rbac->Roles->assign('DC', 'directory-view');
$rbac->Roles->assign('DT', 'admin-settings-view');
$rbac->Roles->assign('DT', 'admin-roles-view');
$rbac->Roles->assign('DT', 'admin-permissions-view');
$rbac->Roles->assign('DT', 'admin-users-view');
$rbac->Roles->assign('DT', 'admin-sections-view');
$rbac->Roles->assign('DT', 'directory-view');
$rbac->Roles->assign('DT-T', 'admin-sections-view');
$rbac->Roles->assign('DT-T', 'directory-view');
$rbac->Roles->assign('DT-L', 'admin-sections-view');
$rbac->Roles->assign('DT-L', 'directory-view');
$rbac->Roles->assign('DT-I', 'admin-settings-update');
$rbac->Roles->assign('DT-I', 'admin-roles-asssign-permissions');
$rbac->Roles->assign('DT-I', 'admin-users-asssign-roles');
$rbac->Roles->assign('DT-I', 'ope-dps-view-all');
$rbac->Roles->assign('DT-I', 'treso-dps-view-all');
$rbac->Roles->assign('DT-I', 'ope-clients-update-all');
$rbac->Roles->assign('DT-I', 'admin-sections-update');
$rbac->Roles->assign('DT-I', 'directory-update');
$rbac->Roles->assign('DT-I', 'admin-mailinglist-manage');
$rbac->Roles->assign('DF', 'admin-roles-view');
$rbac->Roles->assign('DF', 'admin-permissions-view');
$rbac->Roles->assign('DF', 'admin-sections-view');
$rbac->Roles->assign('DF', 'directory-view');
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
$rbac->Roles->assign('CO Asnières', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Asnières', 'ope-clients-update-own');
$rbac->Roles->assign('CO Asnières', 'treso-dps-view-own');
$rbac->Roles->assign('CO Asnières', 'admin-sections-view');
$rbac->Roles->assign('CO Asnières', 'directory-view');
$rbac->Roles->assign('CO-A Asnières', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Asnières', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Asnières', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Asnières', 'admin-sections-view');
$rbac->Roles->assign('CO-A Asnières', 'directory-view');
$rbac->Roles->assign('CO-B Asnières', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Asnières', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Asnières', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Asnières', 'admin-sections-view');
$rbac->Roles->assign('CO-B Asnières', 'directory-view');
$rbac->Roles->assign('CO-C Asnières', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Asnières', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Asnières', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Asnières', 'admin-sections-view');
$rbac->Roles->assign('CO-C Asnières', 'directory-view');
$rbac->Roles->assign('CF Asnières', 'admin-sections-view');
$rbac->Roles->assign('CF Asnières', 'directory-view');
$rbac->Roles->assign('CF-A Asnières', 'admin-sections-view');
$rbac->Roles->assign('CF-A Asnières', 'directory-view');
$rbac->Roles->assign('CF-B Asnières', 'admin-sections-view');
$rbac->Roles->assign('CF-B Asnières', 'directory-view');
$rbac->Roles->assign('CA Asnières', 'admin-sections-view');
$rbac->Roles->assign('CA Asnières', 'directory-view');
$rbac->Roles->assign('CC Asnières', 'admin-sections-view');
$rbac->Roles->assign('CC Asnières', 'directory-view');
$rbac->Roles->assign('CT Asnières', 'admin-sections-view');
$rbac->Roles->assign('CT Asnières', 'directory-view');
$rbac->Roles->assign('CT-L Matér Asnières', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Asnières', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Asnières', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Asnières', 'directory-view');

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
$rbac->Roles->assign('CO Boulogne', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Boulogne', 'ope-clients-update-own');
$rbac->Roles->assign('CO Boulogne', 'treso-dps-view-own');
$rbac->Roles->assign('CO Boulogne', 'admin-sections-view');
$rbac->Roles->assign('CO Boulogne', 'directory-view');
$rbac->Roles->assign('CO-A Boulogne', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Boulogne', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Boulogne', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Boulogne', 'admin-sections-view');
$rbac->Roles->assign('CO-A Boulogne', 'directory-view');
$rbac->Roles->assign('CO-B Boulogne', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Boulogne', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Boulogne', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Boulogne', 'admin-sections-view');
$rbac->Roles->assign('CO-B Boulogne', 'directory-view');
$rbac->Roles->assign('CO-C Boulogne', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Boulogne', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Boulogne', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Boulogne', 'admin-sections-view');
$rbac->Roles->assign('CO-C Boulogne', 'directory-view');
$rbac->Roles->assign('CF Boulogne', 'admin-sections-view');
$rbac->Roles->assign('CF Boulogne', 'directory-view');
$rbac->Roles->assign('CF-A Boulogne', 'admin-sections-view');
$rbac->Roles->assign('CF-A Boulogne', 'directory-view');
$rbac->Roles->assign('CF-B Boulogne', 'admin-sections-view');
$rbac->Roles->assign('CF-B Boulogne', 'directory-view');
$rbac->Roles->assign('CA Boulogne', 'admin-sections-view');
$rbac->Roles->assign('CA Boulogne', 'directory-view');
$rbac->Roles->assign('CC Boulogne', 'admin-sections-view');
$rbac->Roles->assign('CC Boulogne', 'directory-view');
$rbac->Roles->assign('CT Boulogne', 'admin-sections-view');
$rbac->Roles->assign('CT Boulogne', 'directory-view');
$rbac->Roles->assign('CT-L Matér Boulogne', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Boulogne', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Boulogne', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Boulogne', 'directory-view');

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
$rbac->Roles->assign('CO Bourg-la-Reine', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Bourg-la-Reine', 'ope-clients-update-own');
$rbac->Roles->assign('CO Bourg-la-Reine', 'treso-dps-view-own');
$rbac->Roles->assign('CO Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('CO Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('CO-A Bourg-la-Reine', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Bourg-la-Reine', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Bourg-la-Reine', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('CO-A Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('CO-B Bourg-la-Reine', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Bourg-la-Reine', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Bourg-la-Reine', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('CO-B Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('CO-C Bourg-la-Reine', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Bourg-la-Reine', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Bourg-la-Reine', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('CO-C Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('CF Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('CF Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('CF-A Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('CF-A Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('CF-B Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('CF-B Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('CA Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('CA Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('CC Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('CC Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('CT Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('CT Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('CT-L Matér Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Bourg-la-Reine', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Bourg-la-Reine', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Bourg-la-Reine', 'directory-view');

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
$rbac->Roles->assign('CO Clamart', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Clamart', 'ope-clients-update-own');
$rbac->Roles->assign('CO Clamart', 'treso-dps-view-own');
$rbac->Roles->assign('CO Clamart', 'admin-sections-view');
$rbac->Roles->assign('CO Clamart', 'directory-view');
$rbac->Roles->assign('CO-A Clamart', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Clamart', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Clamart', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Clamart', 'admin-sections-view');
$rbac->Roles->assign('CO-A Clamart', 'directory-view');
$rbac->Roles->assign('CO-B Clamart', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Clamart', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Clamart', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Clamart', 'admin-sections-view');
$rbac->Roles->assign('CO-B Clamart', 'directory-view');
$rbac->Roles->assign('CO-C Clamart', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Clamart', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Clamart', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Clamart', 'admin-sections-view');
$rbac->Roles->assign('CO-C Clamart', 'directory-view');
$rbac->Roles->assign('CF Clamart', 'admin-sections-view');
$rbac->Roles->assign('CF Clamart', 'directory-view');
$rbac->Roles->assign('CF-A Clamart', 'admin-sections-view');
$rbac->Roles->assign('CF-A Clamart', 'directory-view');
$rbac->Roles->assign('CF-B Clamart', 'admin-sections-view');
$rbac->Roles->assign('CF-B Clamart', 'directory-view');
$rbac->Roles->assign('CA Clamart', 'admin-sections-view');
$rbac->Roles->assign('CA Clamart', 'directory-view');
$rbac->Roles->assign('CC Clamart', 'admin-sections-view');
$rbac->Roles->assign('CC Clamart', 'directory-view');
$rbac->Roles->assign('CT Clamart', 'admin-sections-view');
$rbac->Roles->assign('CT Clamart', 'directory-view');
$rbac->Roles->assign('CT-L Matér Clamart', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Clamart', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Clamart', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Clamart', 'directory-view');

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
$rbac->Roles->assign('CO Clichy', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Clichy', 'ope-clients-update-own');
$rbac->Roles->assign('CO Clichy', 'treso-dps-view-own');
$rbac->Roles->assign('CO Clichy', 'admin-sections-view');
$rbac->Roles->assign('CO Clichy', 'directory-view');
$rbac->Roles->assign('CO-A Clichy', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Clichy', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Clichy', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Clichy', 'admin-sections-view');
$rbac->Roles->assign('CO-A Clichy', 'directory-view');
$rbac->Roles->assign('CO-B Clichy', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Clichy', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Clichy', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Clichy', 'admin-sections-view');
$rbac->Roles->assign('CO-B Clichy', 'directory-view');
$rbac->Roles->assign('CO-C Clichy', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Clichy', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Clichy', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Clichy', 'admin-sections-view');
$rbac->Roles->assign('CO-C Clichy', 'directory-view');
$rbac->Roles->assign('CF Clichy', 'admin-sections-view');
$rbac->Roles->assign('CF Clichy', 'directory-view');
$rbac->Roles->assign('CF-A Clichy', 'admin-sections-view');
$rbac->Roles->assign('CF-A Clichy', 'directory-view');
$rbac->Roles->assign('CF-B Clichy', 'admin-sections-view');
$rbac->Roles->assign('CF-B Clichy', 'directory-view');
$rbac->Roles->assign('CA Clichy', 'admin-sections-view');
$rbac->Roles->assign('CA Clichy', 'directory-view');
$rbac->Roles->assign('CC Clichy', 'admin-sections-view');
$rbac->Roles->assign('CC Clichy', 'directory-view');
$rbac->Roles->assign('CT Clichy', 'admin-sections-view');
$rbac->Roles->assign('CT Clichy', 'directory-view');
$rbac->Roles->assign('CT-L Matér Clichy', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Clichy', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Clichy', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Clichy', 'directory-view');

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
$rbac->Roles->assign('CO Colombes', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Colombes', 'ope-clients-update-own');
$rbac->Roles->assign('CO Colombes', 'treso-dps-view-own');
$rbac->Roles->assign('CO Colombes', 'admin-sections-view');
$rbac->Roles->assign('CO Colombes', 'directory-view');
$rbac->Roles->assign('CO-A Colombes', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Colombes', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Colombes', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Colombes', 'admin-sections-view');
$rbac->Roles->assign('CO-A Colombes', 'directory-view');
$rbac->Roles->assign('CO-B Colombes', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Colombes', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Colombes', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Colombes', 'admin-sections-view');
$rbac->Roles->assign('CO-B Colombes', 'directory-view');
$rbac->Roles->assign('CO-C Colombes', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Colombes', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Colombes', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Colombes', 'admin-sections-view');
$rbac->Roles->assign('CO-C Colombes', 'directory-view');
$rbac->Roles->assign('CF Colombes', 'admin-sections-view');
$rbac->Roles->assign('CF Colombes', 'directory-view');
$rbac->Roles->assign('CF-A Colombes', 'admin-sections-view');
$rbac->Roles->assign('CF-A Colombes', 'directory-view');
$rbac->Roles->assign('CF-B Colombes', 'admin-sections-view');
$rbac->Roles->assign('CF-B Colombes', 'directory-view');
$rbac->Roles->assign('CA Colombes', 'admin-sections-view');
$rbac->Roles->assign('CA Colombes', 'directory-view');
$rbac->Roles->assign('CC Colombes', 'admin-sections-view');
$rbac->Roles->assign('CC Colombes', 'directory-view');
$rbac->Roles->assign('CT Colombes', 'admin-sections-view');
$rbac->Roles->assign('CT Colombes', 'directory-view');
$rbac->Roles->assign('CT-L Matér Colombes', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Colombes', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Colombes', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Colombes', 'directory-view');

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
$rbac->Roles->assign('CO Courbevoie', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Courbevoie', 'ope-clients-update-own');
$rbac->Roles->assign('CO Courbevoie', 'treso-dps-view-own');
$rbac->Roles->assign('CO Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('CO Courbevoie', 'directory-view');
$rbac->Roles->assign('CO-A Courbevoie', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Courbevoie', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Courbevoie', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('CO-A Courbevoie', 'directory-view');
$rbac->Roles->assign('CO-B Courbevoie', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Courbevoie', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Courbevoie', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('CO-B Courbevoie', 'directory-view');
$rbac->Roles->assign('CO-C Courbevoie', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Courbevoie', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Courbevoie', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('CO-C Courbevoie', 'directory-view');
$rbac->Roles->assign('CF Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('CF Courbevoie', 'directory-view');
$rbac->Roles->assign('CF-A Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('CF-A Courbevoie', 'directory-view');
$rbac->Roles->assign('CF-B Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('CF-B Courbevoie', 'directory-view');
$rbac->Roles->assign('CF-C Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('CF-C Courbevoie', 'directory-view');
$rbac->Roles->assign('CA Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('CA Courbevoie', 'directory-view');
$rbac->Roles->assign('CC Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('CC Courbevoie', 'directory-view');
$rbac->Roles->assign('CT Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('CT Courbevoie', 'directory-view');
$rbac->Roles->assign('CT-L Matér Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Courbevoie', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Courbevoie', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Courbevoie', 'directory-view');

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
$rbac->Roles->assign('CO Garches', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Garches', 'ope-clients-update-own');
$rbac->Roles->assign('CO Garches', 'treso-dps-view-own');
$rbac->Roles->assign('CO Garches', 'admin-sections-view');
$rbac->Roles->assign('CO Garches', 'directory-view');
$rbac->Roles->assign('CO-A Garches', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Garches', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Garches', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Garches', 'admin-sections-view');
$rbac->Roles->assign('CO-A Garches', 'directory-view');
$rbac->Roles->assign('CO-B Garches', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Garches', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Garches', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Garches', 'admin-sections-view');
$rbac->Roles->assign('CO-B Garches', 'directory-view');
$rbac->Roles->assign('CO-C Garches', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Garches', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Garches', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Garches', 'admin-sections-view');
$rbac->Roles->assign('CO-C Garches', 'directory-view');
$rbac->Roles->assign('CF Garches', 'admin-sections-view');
$rbac->Roles->assign('CF Garches', 'directory-view');
$rbac->Roles->assign('CF-A Garches', 'admin-sections-view');
$rbac->Roles->assign('CF-A Garches', 'directory-view');
$rbac->Roles->assign('CF-B Garches', 'admin-sections-view');
$rbac->Roles->assign('CF-B Garches', 'directory-view');
$rbac->Roles->assign('CA Garches', 'admin-sections-view');
$rbac->Roles->assign('CA Garches', 'directory-view');
$rbac->Roles->assign('CC Garches', 'admin-sections-view');
$rbac->Roles->assign('CC Garches', 'directory-view');
$rbac->Roles->assign('CT Garches', 'admin-sections-view');
$rbac->Roles->assign('CT Garches', 'directory-view');
$rbac->Roles->assign('CT-L Matér Garches', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Garches', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Garches', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Garches', 'directory-view');

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
$rbac->Roles->assign('CO Gennevilliers', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Gennevilliers', 'ope-clients-update-own');
$rbac->Roles->assign('CO Gennevilliers', 'treso-dps-view-own');
$rbac->Roles->assign('CO Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('CO Gennevilliers', 'directory-view');
$rbac->Roles->assign('CO-A Gennevilliers', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Gennevilliers', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Gennevilliers', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('CO-A Gennevilliers', 'directory-view');
$rbac->Roles->assign('CO-B Gennevilliers', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Gennevilliers', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Gennevilliers', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('CO-B Gennevilliers', 'directory-view');
$rbac->Roles->assign('CO-C Gennevilliers', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Gennevilliers', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Gennevilliers', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('CO-C Gennevilliers', 'directory-view');
$rbac->Roles->assign('CF Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('CF Gennevilliers', 'directory-view');
$rbac->Roles->assign('CF-A Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('CF-A Gennevilliers', 'directory-view');
$rbac->Roles->assign('CF-B Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('CF-B Gennevilliers', 'directory-view');
$rbac->Roles->assign('CA Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('CA Gennevilliers', 'directory-view');
$rbac->Roles->assign('CC Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('CC Gennevilliers', 'directory-view');
$rbac->Roles->assign('CT Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('CT Gennevilliers', 'directory-view');
$rbac->Roles->assign('CT-L Matér Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Gennevilliers', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Gennevilliers', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Gennevilliers', 'directory-view');

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
$rbac->Roles->assign('CO Levallois', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Levallois', 'ope-clients-update-own');
$rbac->Roles->assign('CO Levallois', 'treso-dps-view-own');
$rbac->Roles->assign('CO Levallois', 'admin-sections-view');
$rbac->Roles->assign('CO Levallois', 'directory-view');
$rbac->Roles->assign('CO-A Levallois', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Levallois', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Levallois', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Levallois', 'admin-sections-view');
$rbac->Roles->assign('CO-A Levallois', 'directory-view');
$rbac->Roles->assign('CO-B Levallois', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Levallois', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Levallois', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Levallois', 'admin-sections-view');
$rbac->Roles->assign('CO-B Levallois', 'directory-view');
$rbac->Roles->assign('CO-C Levallois', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Levallois', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Levallois', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Levallois', 'admin-sections-view');
$rbac->Roles->assign('CO-C Levallois', 'directory-view');
$rbac->Roles->assign('CF Levallois', 'admin-sections-view');
$rbac->Roles->assign('CF Levallois', 'directory-view');
$rbac->Roles->assign('CF-A Levallois', 'admin-sections-view');
$rbac->Roles->assign('CF-A Levallois', 'directory-view');
$rbac->Roles->assign('CF-B Levallois', 'admin-sections-view');
$rbac->Roles->assign('CF-B Levallois', 'directory-view');
$rbac->Roles->assign('CA Levallois', 'admin-sections-view');
$rbac->Roles->assign('CA Levallois', 'directory-view');
$rbac->Roles->assign('CC Levallois', 'admin-sections-view');
$rbac->Roles->assign('CC Levallois', 'directory-view');
$rbac->Roles->assign('CT Levallois', 'admin-sections-view');
$rbac->Roles->assign('CT Levallois', 'directory-view');
$rbac->Roles->assign('CT-L Matér Levallois', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Levallois', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Levallois', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Levallois', 'directory-view');

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
$rbac->Roles->assign('CO Montrouge', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Montrouge', 'ope-clients-update-own');
$rbac->Roles->assign('CO Montrouge', 'treso-dps-view-own');
$rbac->Roles->assign('CO Montrouge', 'admin-sections-view');
$rbac->Roles->assign('CO Montrouge', 'directory-view');
$rbac->Roles->assign('CO-A Montrouge', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Montrouge', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Montrouge', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Montrouge', 'admin-sections-view');
$rbac->Roles->assign('CO-A Montrouge', 'directory-view');
$rbac->Roles->assign('CO-B Montrouge', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Montrouge', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Montrouge', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Montrouge', 'admin-sections-view');
$rbac->Roles->assign('CO-B Montrouge', 'directory-view');
$rbac->Roles->assign('CO-C Montrouge', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Montrouge', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Montrouge', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Montrouge', 'admin-sections-view');
$rbac->Roles->assign('CO-C Montrouge', 'directory-view');
$rbac->Roles->assign('CF Montrouge', 'admin-sections-view');
$rbac->Roles->assign('CF Montrouge', 'directory-view');
$rbac->Roles->assign('CF-A Montrouge', 'admin-sections-view');
$rbac->Roles->assign('CF-A Montrouge', 'directory-view');
$rbac->Roles->assign('CF-B Montrouge', 'admin-sections-view');
$rbac->Roles->assign('CF-B Montrouge', 'directory-view');
$rbac->Roles->assign('CA Montrouge', 'admin-sections-view');
$rbac->Roles->assign('CA Montrouge', 'directory-view');
$rbac->Roles->assign('CC Montrouge', 'admin-sections-view');
$rbac->Roles->assign('CC Montrouge', 'directory-view');
$rbac->Roles->assign('CT Montrouge', 'admin-sections-view');
$rbac->Roles->assign('CT Montrouge', 'directory-view');
$rbac->Roles->assign('CT-L Matér Montrouge', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Montrouge', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Montrouge', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Montrouge', 'directory-view');

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
$rbac->Roles->assign('CO Nanterre', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Nanterre', 'ope-clients-update-own');
$rbac->Roles->assign('CO Nanterre', 'treso-dps-view-own');
$rbac->Roles->assign('CO Nanterre', 'admin-sections-view');
$rbac->Roles->assign('CO Nanterre', 'directory-view');
$rbac->Roles->assign('CO-A Nanterre', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Nanterre', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Nanterre', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Nanterre', 'admin-sections-view');
$rbac->Roles->assign('CO-A Nanterre', 'directory-view');
$rbac->Roles->assign('CO-B Nanterre', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Nanterre', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Nanterre', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Nanterre', 'admin-sections-view');
$rbac->Roles->assign('CO-B Nanterre', 'directory-view');
$rbac->Roles->assign('CO-C Nanterre', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Nanterre', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Nanterre', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Nanterre', 'admin-sections-view');
$rbac->Roles->assign('CO-C Nanterre', 'directory-view');
$rbac->Roles->assign('CF Nanterre', 'admin-sections-view');
$rbac->Roles->assign('CF Nanterre', 'directory-view');
$rbac->Roles->assign('CF-A Nanterre', 'admin-sections-view');
$rbac->Roles->assign('CF-A Nanterre', 'directory-view');
$rbac->Roles->assign('CF-B Nanterre', 'admin-sections-view');
$rbac->Roles->assign('CF-B Nanterre', 'directory-view');
$rbac->Roles->assign('CA Nanterre', 'admin-sections-view');
$rbac->Roles->assign('CA Nanterre', 'directory-view');
$rbac->Roles->assign('CC Nanterre', 'admin-sections-view');
$rbac->Roles->assign('CC Nanterre', 'directory-view');
$rbac->Roles->assign('CT Nanterre', 'admin-sections-view');
$rbac->Roles->assign('CT Nanterre', 'directory-view');
$rbac->Roles->assign('CT-L Matér Nanterre', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Nanterre', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Nanterre', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Nanterre', 'directory-view');

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
$rbac->Roles->assign('CO Rueil', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Rueil', 'ope-clients-update-own');
$rbac->Roles->assign('CO Rueil', 'treso-dps-view-own');
$rbac->Roles->assign('CO Rueil', 'admin-sections-view');
$rbac->Roles->assign('CO Rueil', 'directory-view');
$rbac->Roles->assign('CO-A Rueil', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Rueil', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Rueil', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Rueil', 'admin-sections-view');
$rbac->Roles->assign('CO-A Rueil', 'directory-view');
$rbac->Roles->assign('CO-B Rueil', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Rueil', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Rueil', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Rueil', 'admin-sections-view');
$rbac->Roles->assign('CO-B Rueil', 'directory-view');
$rbac->Roles->assign('CO-C Rueil', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Rueil', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Rueil', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Rueil', 'admin-sections-view');
$rbac->Roles->assign('CO-C Rueil', 'directory-view');
$rbac->Roles->assign('CF Rueil', 'admin-sections-view');
$rbac->Roles->assign('CF Rueil', 'directory-view');
$rbac->Roles->assign('CF-A Rueil', 'admin-sections-view');
$rbac->Roles->assign('CF-A Rueil', 'directory-view');
$rbac->Roles->assign('CF-B Rueil', 'admin-sections-view');
$rbac->Roles->assign('CF-B Rueil', 'directory-view');
$rbac->Roles->assign('CA Rueil', 'admin-sections-view');
$rbac->Roles->assign('CA Rueil', 'directory-view');
$rbac->Roles->assign('CC Rueil', 'admin-sections-view');
$rbac->Roles->assign('CC Rueil', 'directory-view');
$rbac->Roles->assign('CT Rueil', 'admin-sections-view');
$rbac->Roles->assign('CT Rueil', 'directory-view');
$rbac->Roles->assign('CT-L Matér Rueil', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Rueil', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Rueil', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Rueil', 'directory-view');

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
$rbac->Roles->assign('CO Suresnes', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Suresnes', 'ope-clients-update-own');
$rbac->Roles->assign('CO Suresnes', 'treso-dps-view-own');
$rbac->Roles->assign('CO Suresnes', 'admin-sections-view');
$rbac->Roles->assign('CO Suresnes', 'directory-view');
$rbac->Roles->assign('CO-A Suresnes', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Suresnes', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Suresnes', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Suresnes', 'admin-sections-view');
$rbac->Roles->assign('CO-A Suresnes', 'directory-view');
$rbac->Roles->assign('CO-B Suresnes', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Suresnes', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Suresnes', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Suresnes', 'admin-sections-view');
$rbac->Roles->assign('CO-B Suresnes', 'directory-view');
$rbac->Roles->assign('CO-C Suresnes', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Suresnes', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Suresnes', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Suresnes', 'admin-sections-view');
$rbac->Roles->assign('CO-C Suresnes', 'directory-view');
$rbac->Roles->assign('CF Suresnes', 'admin-sections-view');
$rbac->Roles->assign('CF Suresnes', 'directory-view');
$rbac->Roles->assign('CF-A Suresnes', 'admin-sections-view');
$rbac->Roles->assign('CF-A Suresnes', 'directory-view');
$rbac->Roles->assign('CF-B Suresnes', 'admin-sections-view');
$rbac->Roles->assign('CF-B Suresnes', 'directory-view');
$rbac->Roles->assign('CA Suresnes', 'admin-sections-view');
$rbac->Roles->assign('CA Suresnes', 'directory-view');
$rbac->Roles->assign('CC Suresnes', 'admin-sections-view');
$rbac->Roles->assign('CC Suresnes', 'directory-view');
$rbac->Roles->assign('CT Suresnes', 'admin-sections-view');
$rbac->Roles->assign('CT Suresnes', 'directory-view');
$rbac->Roles->assign('CT-L Matér Suresnes', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Suresnes', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Suresnes', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Suresnes', 'directory-view');

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
$rbac->Roles->assign('CO Vanves', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Vanves', 'ope-clients-update-own');
$rbac->Roles->assign('CO Vanves', 'treso-dps-view-own');
$rbac->Roles->assign('CO Vanves', 'admin-sections-view');
$rbac->Roles->assign('CO Vanves', 'directory-view');
$rbac->Roles->assign('CO-A Vanves', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Vanves', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Vanves', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Vanves', 'admin-sections-view');
$rbac->Roles->assign('CO-A Vanves', 'directory-view');
$rbac->Roles->assign('CO-B Vanves', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Vanves', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Vanves', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Vanves', 'admin-sections-view');
$rbac->Roles->assign('CO-B Vanves', 'directory-view');
$rbac->Roles->assign('CO-C Vanves', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Vanves', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Vanves', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Vanves', 'admin-sections-view');
$rbac->Roles->assign('CO-C Vanves', 'directory-view');
$rbac->Roles->assign('CF Vanves', 'admin-sections-view');
$rbac->Roles->assign('CF Vanves', 'directory-view');
$rbac->Roles->assign('CF-A Vanves', 'admin-sections-view');
$rbac->Roles->assign('CF-A Vanves', 'directory-view');
$rbac->Roles->assign('CF-B Vanves', 'admin-sections-view');
$rbac->Roles->assign('CF-B Vanves', 'directory-view');
$rbac->Roles->assign('CA Vanves', 'admin-sections-view');
$rbac->Roles->assign('CA Vanves', 'directory-view');
$rbac->Roles->assign('CC Vanves', 'admin-sections-view');
$rbac->Roles->assign('CC Vanves', 'directory-view');
$rbac->Roles->assign('CT Vanves', 'admin-sections-view');
$rbac->Roles->assign('CT Vanves', 'directory-view');
$rbac->Roles->assign('CT-L Matér Vanves', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Vanves', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Vanves', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Vanves', 'directory-view');

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
$rbac->Roles->assign('CO Villeneuve', 'ope-dps-validate-local');
$rbac->Roles->assign('CO Villeneuve', 'ope-clients-update-own');
$rbac->Roles->assign('CO Villeneuve', 'treso-dps-view-own');
$rbac->Roles->assign('CO Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('CO Villeneuve', 'directory-view');
$rbac->Roles->assign('CO-A Villeneuve', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-A Villeneuve', 'ope-clients-update-own');
$rbac->Roles->assign('CO-A Villeneuve', 'treso-dps-view-own');
$rbac->Roles->assign('CO-A Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('CO-A Villeneuve', 'directory-view');
$rbac->Roles->assign('CO-B Villeneuve', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-B Villeneuve', 'ope-clients-update-own');
$rbac->Roles->assign('CO-B Villeneuve', 'treso-dps-view-own');
$rbac->Roles->assign('CO-B Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('CO-B Villeneuve', 'directory-view');
$rbac->Roles->assign('CO-C Villeneuve', 'ope-dps-validate-local');
$rbac->Roles->assign('CO-C Villeneuve', 'ope-clients-update-own');
$rbac->Roles->assign('CO-C Villeneuve', 'treso-dps-view-own');
$rbac->Roles->assign('CO-C Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('CO-C Villeneuve', 'directory-view');
$rbac->Roles->assign('CF Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('CF Villeneuve', 'directory-view');
$rbac->Roles->assign('CF-A Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('CF-A Villeneuve', 'directory-view');
$rbac->Roles->assign('CF-B Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('CF-B Villeneuve', 'directory-view');
$rbac->Roles->assign('CA Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('CA Villeneuve', 'directory-view');
$rbac->Roles->assign('CC Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('CC Villeneuve', 'directory-view');
$rbac->Roles->assign('CT Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('CT Villeneuve', 'directory-view');
$rbac->Roles->assign('CT-L Matér Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('CT-L Matér Villeneuve', 'directory-view');
$rbac->Roles->assign('CT-L Véhic Villeneuve', 'admin-sections-view');
$rbac->Roles->assign('CT-L Véhic Villeneuve', 'directory-view');




/////////////////////////////////////////////////
// GOD MODE FOR THE USER INSTALLING THIS SCRIPT
/////////////////////////////////////////////////

// Plaese note that the user whose ID = '1' is always assigned the 'root' role.
// Then assign 'Admin' role to user '1' (the admin)
$rbac->Users->assign('Admin', 1); // Hope '1' is the 'admin' user
// Then assign 'Public' role to user '2' (public user)
$rbac->Users->assign('Public', 2); // Hope '2' is the 'public' user





/////////////////////////////////////////////////
// END OF INSTALLATION SCRIPT
/////////////////////////////////////////////////
?>
<br />
C'est fini : <?php echo date("H:i:s"); ?>
</body>
</html>
