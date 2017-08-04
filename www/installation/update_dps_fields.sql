-- DUPLIQUE LA TABLE EXISTANTE
DROP TABLE `dps`;
CREATE TABLE `dps` AS (SELECT * FROM `demande_dps`);
ALTER TABLE `dps` ADD PRIMARY KEY(`id`);
ALTER TABLE `dps` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;


-- RENOMMAGE DES CHAMPS ET CHANGEMENT DE TYPE ET NOUVELLE VALEUR PAR DÉFAUT
ALTER TABLE `dps` CHANGE `commune_ris` `section` TINYINT(1) NULL DEFAULT '0' AFTER `id`;
ALTER TABLE `dps` CHANGE `cu_complet` `cu_full` VARCHAR(14) NULL DEFAULT NULL AFTER `section`;
ALTER TABLE `dps` CHANGE `annee_poste` `cu_year` VARCHAR(4) NULL DEFAULT NULL AFTER `cu_full`;
ALTER TABLE `dps` CHANGE `num_cu` `cu_yearly_index` INT(1) NULL DEFAULT NULL AFTER `cu_year`;

ALTER TABLE `dps` CHANGE `organisateur` `client_name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `cu_yearly_index`;
ALTER TABLE `dps` CHANGE `representant_org` `client_represent` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `client_name`;
ALTER TABLE `dps` CHANGE `qualite_org` `client_title` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `client_represent`;
ALTER TABLE `dps` CHANGE `adresse_org` `client_address` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `client_title`;
ALTER TABLE `dps` CHANGE `tel_org` `client_phone` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `client_address`;
ALTER TABLE `dps` CHANGE `fax_org` `client_fax` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `client_phone`;
ALTER TABLE `dps` CHANGE `email_org` `client_email` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `client_fax`;

ALTER TABLE `dps` CHANGE `description_manif` `event_name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `client_email`;
ALTER TABLE `dps` CHANGE `activite` `event_description` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `event_name`;
ALTER TABLE `dps` CHANGE `adresse_manif` `event_address` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `event_description`;
ALTER TABLE `dps` CHANGE `dept` `event_department` VARCHAR(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '92' AFTER `event_address`;
ALTER TABLE `dps` CHANGE `dps_debut` `event_begin_date` DATE NULL DEFAULT NULL AFTER `event_department`;
ALTER TABLE `dps` CHANGE `heure_debut` `event_begin_time` VARCHAR(4) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `event_begin_date`;
ALTER TABLE `dps` CHANGE `dps_fin` `event_end_date` DATE NULL DEFAULT NULL AFTER `event_begin_time`;
ALTER TABLE `dps` CHANGE `heure_fin` `event_end_time` VARCHAR(4) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `event_end_date`;
ALTER TABLE `dps` CHANGE `dossier_pref` `event_pref_secu` BOOLEAN NOT NULL DEFAULT '0' AFTER `event_end_time`;

ALTER TABLE `dps` CHANGE `p1_spec` `ris_p1_public` VARCHAR(7) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `event_pref_secu`;
ALTER TABLE `dps` CHANGE `p1_part` `ris_p1_actors` VARCHAR(7) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `ris_p1_public`;
ALTER TABLE `dps` CHANGE `p2` `ris_p2` TINYINT(1) NULL DEFAULT '4' AFTER `ris_p1_actors`;
ALTER TABLE `dps` CHANGE `e1` `ris_e1` TINYINT(1) NULL DEFAULT '4' AFTER `ris_p2`;
ALTER TABLE `dps` CHANGE `e2` `ris_e2` TINYINT(1) NULL DEFAULT '4' AFTER `ris_e1`;
ALTER TABLE `dps` CHANGE `comment_ris` `ris_comment` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `ris_e2`;

ALTER TABLE `dps` CHANGE `type_dps` `dps_type` TINYINT(1) NULL DEFAULT '3' AFTER `ris_comment`;

ALTER TABLE `dps` CHANGE `dps_debut_poste` `dps_begin_date` DATE NULL DEFAULT NULL AFTER `dps_type`;
ALTER TABLE `dps` CHANGE `heure_debut_poste` `dps_begin_time` VARCHAR(4) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `dps_begin_date`;
ALTER TABLE `dps` CHANGE `dps_fin_poste` `dps_end_date` DATE NULL DEFAULT NULL AFTER `dps_begin_time`;
ALTER TABLE `dps` CHANGE `heure_fin_poste` `dps_end_time` VARCHAR(4) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `dps_end_date`;

ALTER TABLE `dps` CHANGE `cei` `dps_nb_ce` TINYINT(1) NULL DEFAULT '0' AFTER `dps_end_time`;
ALTER TABLE `dps` CHANGE `PSE2` `dps_nb_pse2` TINYINT(1) NULL DEFAULT '0' AFTER `dps_nb_ce`;
ALTER TABLE `dps` CHANGE `PSE1` `dps_nb_pse1` TINYINT(1) NULL DEFAULT '0' AFTER `dps_nb_pse2`;
ALTER TABLE `dps` CHANGE `PSC1` `dps_nb_psc1` TINYINT(1) NULL DEFAULT '0' AFTER `dps_nb_pse1`;
ALTER TABLE `dps` ADD `dps_nb_lot_a` TINYINT(1) NULL DEFAULT '0' AFTER `dps_nb_psc1`;
ALTER TABLE `dps` ADD `dps_nb_lot_b` TINYINT(1) NULL DEFAULT '0' AFTER `dps_nb_lot_a`;
ALTER TABLE `dps` ADD `dps_nb_lot_c` TINYINT(1) NULL DEFAULT '0' AFTER `dps_nb_lot_b`;
ALTER TABLE `dps` ADD `dps_nb_dae` TINYINT(1) NULL DEFAULT '0' AFTER `dps_nb_lot_c`;
ALTER TABLE `dps` CHANGE `vpsp` `dps_nb_vpsp_transp` TINYINT(1) NULL DEFAULT '0' AFTER `dps_nb_dae`;
ALTER TABLE `dps` CHANGE `vpsp_soin` `dps_nb_vpsp_soin` TINYINT(1) NULL DEFAULT '0' AFTER `dps_nb_vpsp_transp`;
ALTER TABLE `dps` CHANGE `vl` `dps_nb_vtu` TINYINT(1) NULL DEFAULT '0' AFTER `dps_nb_vpsp_soin`;
ALTER TABLE `dps` CHANGE `tente` `dps_nb_tente` TINYINT(1) NULL DEFAULT '0' AFTER `dps_nb_vtu`;
ALTER TABLE `dps` CHANGE `med_asso` `dps_nb_med_asso` TINYINT(1) NULL DEFAULT '0' AFTER `dps_nb_tente`;
ALTER TABLE `dps` CHANGE `inf_asso` `dps_nb_inf_asso` TINYINT(1) NULL DEFAULT '0' AFTER `dps_nb_med_asso`;
ALTER TABLE `dps` CHANGE `moyen_supp` `dps_other_matos_asso` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `dps_nb_inf_asso`;

ALTER TABLE `dps` CHANGE `local` `clientmatos_infirmerie` BOOLEAN NOT NULL DEFAULT '0' AFTER `dps_other_matos_asso`;
ALTER TABLE `dps` ADD `clientmatos_tente` BOOLEAN NOT NULL DEFAULT '0' AFTER `clientmatos_infirmerie`;
ALTER TABLE `dps` ADD `clientmatos_other` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `clientmatos_tente`;

ALTER TABLE `dps` CHANGE `med_autre` `medicalext_nb_med` TINYINT(1) NULL DEFAULT NULL AFTER `clientmatos_other`;
ALTER TABLE `dps` CHANGE `medecin` `medicalext_med_company` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `medicalext_nb_med`;
ALTER TABLE `dps` CHANGE `inf_autre` `medicalext_nb_inf` TINYINT(1) NULL DEFAULT NULL AFTER `medicalext_med_company`;
ALTER TABLE `dps` CHANGE `infirmier` `medicalext_inf_company` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `medicalext_nb_inf`;
ALTER TABLE `dps` CHANGE `samu` `samu` TINYINT(1) NULL DEFAULT NULL AFTER `medicalext_inf_company`;
ALTER TABLE `dps` CHANGE `pompier` `bspp` TINYINT(1) NULL DEFAULT NULL AFTER `samu`;

ALTER TABLE `dps` CHANGE `prix` `price` VARCHAR(7) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `bspp`;
ALTER TABLE `dps` CHANGE `justif_poste` `dps_justification` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `price`;

-- ALTER TABLE `dps` CHANGE `etat_demande_dps` `status` TINYINT(1) NULL DEFAULT NULL AFTER `dps_justification`;
ALTER TABLE `dps` ADD `status` TINYINT(1) NULL DEFAULT NULL AFTER `dps_justification`;
ALTER TABLE `dps` CHANGE `administration` `status_justification` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `status`;
ALTER TABLE `dps` CHANGE `date_creation` `status_creation_date` DATE NULL DEFAULT NULL AFTER `status_justification`;
ALTER TABLE `dps` CHANGE `annul_poste` `status_cancel_date` DATE NULL DEFAULT NULL AFTER `status_creation_date`;
ALTER TABLE `dps` CHANGE `motif_annul` `status_cancel_reason` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `status_cancel_date`;
ALTER TABLE `dps` CHANGE `valid_demande_rt` `status_validation_dlo_date` DATE NULL DEFAULT NULL AFTER `status_cancel_reason`;
ALTER TABLE `dps` CHANGE `valid_demande_dps` `status_validation_ddo_date` DATE NULL DEFAULT NULL AFTER `status_validation_dlo_date`;


-- Changement des status de dps
-- 0 = Brouillon
-- 1 = Validé Antenne
-- 2 = Validé DDO / En attente Pref ou ADPC
-- 3 = Validé Préfecture
-- 4 = Annulé
-- 5 = Refusé (DDO ou Préf)
-- NULL = On ne sait pas
UPDATE `dps` SET `status` = 0 WHERE `status_cancel_date` IS NULL AND `etat_demande_dps`=0 AND `status_validation_dlo_date` IS NULL;
UPDATE `dps` SET `status` = 1 WHERE `status_cancel_date` IS NULL AND `etat_demande_dps`=0 AND `status_validation_dlo_date` IS NOT NULL AND `status_validation_ddo_date` IS NULL;
UPDATE `dps` SET `status` = 2 WHERE `status_cancel_date` IS NULL AND `etat_demande_dps`=3;
UPDATE `dps` SET `status` = 3 WHERE `status_cancel_date` IS NULL AND `etat_demande_dps`=1;
UPDATE `dps` SET `status` = 4 WHERE `status_cancel_date` IS NOT NULL;
UPDATE `dps` SET `status` = 5 WHERE `status_cancel_date` IS NULL AND (`etat_demande_dps`=2 OR `etat_demande_dps`=4);


-- SUPPRESSION DES CHAMPS INUTILISÉS
ALTER TABLE `dps` DROP `date_ris`;
ALTER TABLE `dps` DROP `envoi_ok_rt`;
ALTER TABLE `dps` DROP `envoi_accord_demande`;
ALTER TABLE `dps` DROP `soin_lsp`;
ALTER TABLE `dps` DROP `soin_evac`;
ALTER TABLE `dps` DROP `soin_ar`;
ALTER TABLE `dps` DROP `soin_dcd`;
ALTER TABLE `dps` DROP `etat_demande_dps`;
ALTER TABLE `dps` DROP `edition_ris`;


-- POSITIONNEMENT DE NOUVELLES VALEURS PAR DÉFAUT ET VALEURS NULLES
UPDATE `dps` SET `client_name` = NULL WHERE `client_name` = '';
UPDATE `dps` SET `client_represent` = NULL WHERE `client_represent` = '';
UPDATE `dps` SET `client_title` = NULL WHERE `client_title` = '';
UPDATE `dps` SET `client_address` = NULL WHERE `client_address` = '';
UPDATE `dps` SET `client_phone` = NULL WHERE `client_phone` = '';
UPDATE `dps` SET `client_fax` = NULL WHERE `client_fax` = '';
UPDATE `dps` SET `client_email` = NULL WHERE `client_email` = '';
UPDATE `dps` SET `event_name` = NULL WHERE `event_name` = '';
UPDATE `dps` SET `event_description` = NULL WHERE `event_description` = '';
UPDATE `dps` SET `event_address` = NULL WHERE `event_address` = '';
UPDATE `dps` SET `event_begin_date` = NULL WHERE `event_begin_date` = '0000-00-00';
UPDATE `dps` SET `event_begin_time` = NULL WHERE `event_begin_time` = '';
UPDATE `dps` SET `event_end_date` = NULL WHERE `event_end_date` = '0000-00-00';
UPDATE `dps` SET `event_end_time` = NULL WHERE `event_end_time` = '';
UPDATE `dps` SET `ris_comment` = NULL WHERE `ris_comment` = '';
UPDATE `dps` SET `dps_begin_date` = NULL WHERE `dps_begin_date` = '0000-00-00';
UPDATE `dps` SET `dps_end_date` = NULL WHERE `dps_end_date` = '0000-00-00';
UPDATE `dps` SET `dps_justification` = NULL WHERE `dps_justification` = '';
UPDATE `dps` SET `dps_other_matos_asso` = NULL WHERE `dps_other_matos_asso` = '';
UPDATE `dps` SET `medicalext_med_company` = NULL WHERE `medicalext_med_company` = '';
UPDATE `dps` SET `medicalext_inf_company` = NULL WHERE `medicalext_inf_company` = '';
UPDATE `dps` SET `dps_begin_time` = NULL WHERE `dps_begin_time` = '';
UPDATE `dps` SET `dps_end_date` = NULL WHERE `dps_end_date` = '0000-00-00';
UPDATE `dps` SET `dps_end_time` = NULL WHERE `dps_end_time` = '';
UPDATE `dps` SET `status_creation_date` = NULL WHERE `status_creation_date` = '0000-00-00';
UPDATE `dps` SET `status_validation_dlo_date` = NULL WHERE `status_validation_dlo_date` = '0000-00-00';
UPDATE `dps` SET `status_validation_ddo_date` = NULL WHERE `status_validation_ddo_date` = '0000-00-00';
UPDATE `dps` SET `status_cancel_date` = NULL WHERE `status_cancel_date` = '0000-00-00';
UPDATE `dps` SET `status_justification` = NULL WHERE `status_justification` = '';
UPDATE `dps` SET `status_cancel_reason` = NULL WHERE `status_cancel_reason` = '';


DROP TABLE `select_list_parameters`;
CREATE TABLE `select_list_parameters` (
	`id` INT(1) NOT NULL AUTO_INCREMENT ,
	`category` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'category' ,
	`option_value` TINYINT(2) NULL COMMENT 'valeur du select' ,
	`option_text` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'human readable text' ,
	PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci COMMENT = 'options du select';

	INSERT INTO `select_list_parameters`
	(`id`, `category`, `option_value`, `option_text`) VALUES
	(NULL, 'bspp', '0', 'Ni informé, ni présent'),
	(NULL, 'bspp', '1', 'Informé, non présent'),
	(NULL, 'bspp', '2', 'Informé et présent'),
	(NULL, 'samu', '0', 'Ni informé, ni présent'),
	(NULL, 'samu', '1', 'Informé, non présent'),
	(NULL, 'samu', '2', 'Informé et présent'),
	(NULL, 'dps_type_short', '0', 'PAPS'),
	(NULL, 'dps_type_short', '1', 'DPS-PE'),
	(NULL, 'dps_type_short', '2', 'DPS-ME'),
	(NULL, 'dps_type_short', '3', 'DPS-GE'),
	(NULL, 'dps_type_detailed', '0', 'Point d\'Alerte et de Premiers Secours'),
	(NULL, 'dps_type_detailed', '1', 'DPS de Petite Envergure'),
	(NULL, 'dps_type_detailed', '2', 'DPS de Moyenne Envergure'),
	(NULL, 'dps_type_detailed', '3', 'DPS de Grande Envergure'),
	(NULL, 'ris_p2', '1', 'Public assis (spectacle, réunion, restauration, etc.)'),
	(NULL, 'ris_p2', '2', 'Public debout (Exposition, foire, salon, exposition, etc.)'),
	(NULL, 'ris_p2', '3', 'Public debout actif (Spectacle avec public statique, fête foraine, etc.)'),
	(NULL, 'ris_p2', '4', 'Public debout à risque (public dynamique, danse, féria, carnaval, etc.)'),
	(NULL, 'ris_e1', '1', 'Faible (Structure permanente, voies publiques, etc.)'),
	(NULL, 'ris_e1', '2', 'Modéré (Gradins, tribunes, mois de 2 hectares, etc.)'),
	(NULL, 'ris_e1', '3', 'Moyen (Entre 2 et 5 hectares, autres conditions, etc.)'),
	(NULL, 'ris_e1', '4', 'Elevé (Brancardage > 600m, pas d\'accès VPSP, etc.)'),
	(NULL, 'ris_e2', '1', 'Faible (Moins de 10 minutes)'),
	(NULL, 'ris_e2', '2', 'Modéré (Entre 10 et 20 minutes)'),
	(NULL, 'ris_e2', '3', 'Moyen (Entre 20 et 30 minutes)'),
	(NULL, 'ris_e2', '4', 'Elevé (Plus de 30 minutes)'),
	(NULL, 'yesno', '0', 'Non'),
	(NULL, 'yesno', '1', 'Oui');


// section


// Client
