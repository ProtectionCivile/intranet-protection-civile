DROP TABLE `select_list_parameters`;
CREATE TABLE `select_list_parameters` (
	`id` INT(1) NOT NULL AUTO_INCREMENT ,
	`category` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'category' ,
	`option_value` TINYINT(2) NULL COMMENT 'valeur du select' ,
	`option_text` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'human readable text' ,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci COMMENT = 'options du select';


CREATE TABLE `settings_general` (
	`ID` INT(12) NOT NULL AUTO_INCREMENT ,
	`name` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
	`value` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
	PRIMARY KEY (`ID`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci COMMENT = 'Paramètres généraux';


CREATE TABLE `settings_mail` (
	`ID` INT(12) NOT NULL AUTO_INCREMENT ,
	`name` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
	`value` VARCHAR(400) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
	PRIMARY KEY (`ID`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci COMMENT = 'Paramètres mail';


CREATE TABLE `users` (
	`ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`login` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`pass` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`first_name` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci,
	`phone` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci,
	`mail` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	`attached_section` tinyint(4) NULL DEFAULT NULL,
	`eprotec` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE `clients` (
	`id` INT(12) unsigned NOT NULL AUTO_INCREMENT,
	`attached_section` TINYINT(4) NULL DEFAULT '0',
  `ref` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `name` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `represent` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fax` VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mail` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;


CREATE TABLE `mail` (
	`id` INT(12) unsigned NOT NULL AUTO_INCREMENT,
	`user` TINYINT(7) NOT NULL DEFAULT '0',
  `from_addr` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
	`to_addr` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cc_addr` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `subject` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `message` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
	`attachments` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `date_created` DATETIME NULL DEFAULT NULL,
	`date_sent` DATETIME NULL DEFAULT NULL,
	 PRIMARY KEY (`id`)
 ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;


CREATE TABLE `sections` (
 `ID` TINYINT(255) NOT NULL AUTO_INCREMENT,
 `number` TINYINT(2) NOT NULL,
 `attached_section` TINYINT(4) NOT NULL,
 `name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
 `shortname` TINYTEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
 `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
 `zip_code` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
 `city` TINYTEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
 `phone` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
 `website` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
 `mail` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


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


INSERT INTO `settings_general`
	(name, value) VALUES
	('application-header-name', 'Extranet PC-92'),
	('dps-doc-suffix-convention', 'CONV'),
	('dps-doc-suffix-risk', 'RISK'),
	('dps-doc-suffix-demande', 'DEM'),
	('dps-doc-suffix-declaration',	'DECL'),
	('eprotec-event-url', 'https://franceprotectioncivile.org/evenement_display.php?evenement=EVENTID'),
	('mail-signature-dlo',	'<strong>Le Directeur Local des Opérations</strong>'),
	('mail-signature-ddo',	'<strong>Le Directeur Départemental des Opérations</strong><br />operationnel@protectioncivile92.org<br />06.74.95.31.75');


INSERT INTO `settings_mail`
	(name, value) VALUES
	('ddo', '"Protection Civile - Direction des Opérations" <directeur-operations@protectioncivile92.org>'),
	('fnpc', 'changeme@protectioncivile92.org'),
	('prefecture', 'changeme@protectioncivile92.org'),
	('adpc-75', 'changeme@protectioncivile92.org, changeme@protectioncivile92.org'),
	('adpc-78',	'changeme@protectioncivile92.org'),
	('adpc-93',	'changeme@protectioncivile92.org'),
	('adpc-94',	'changeme@protectioncivile92.org'),
	('adpc-95',	'changeme@protectioncivile92.org'),
	('dlo-0',	'operationnel@protectioncivile92.org'),
	('dlo-1',	'"DLO Antony" <operationnel-antony@protectioncivile92.org>'),
	('dlo-2',	'"DLO Asnieres" <operationnel-asnieres@protectioncivile92.org>'),
	('dlo-5',	'"DLO Boulogne-Issy" <operationnel-boulogne-issy@protectioncivile92.org>'),
	('dlo-6',	'"DLO Bourg-la-Reine" <operationnel-bourg-la-reine@protectioncivile92.org>'),
	('dlo-10',	'"DLO Clamart" <operationnel-clamart@protectioncivile92.org>'),
	('dlo-11',	'"DLO Clichy" <operationnel-clichy@protectioncivile92.org>'),
	('dlo-12',	'"DLO Colombes" <operationnel-colombes@protectioncivile92.org>'),
	('dlo-13',	'"DLO Courbevoie" <operationnel-courbevoie@protectioncivile92.org>'),
	('dlo-15',	'"DLO Garches" <operationnel-garches@protectioncivile92.org>'),
	('dlo-17',	'"DLO Gennevilliers" <operationnel-gennevilliers@protectioncivile92.org>'),
	('dlo-20',	'"DLO Levallois" <operationnel-levallois@protectioncivile92.org>'),
	('dlo-24',	'"DLO Nanterre" <operationnel-nanterre@protectioncivile92.org>'),
	('dlo-28',	'"DLO Rueil" <operationnel-rueil@protectioncivile92.org>'),
	('dlo-32',	'"DLO Suresnes-Puteaux" <operationnel-suresnes-puteaux@protectioncivile92.org>'),
	('dlo-33',	'"DLO Vanves" <operationnel-vanves@protectioncivile92.org>'),
	('dlo-36',	'"DLO Villeneuve" <operationnel-villeneuve@protectioncivile92.org>'),
	('dlo-validate-recipients',	'demande-dps@protectioncivile92.org'),
	('dlo-validate-ccrecipients',	'#dlo-ANTENNE, #ddo'),
	('dlo-cancel-recipients',	'demande-dps@protectioncivile92.org'),
	('dlo-cancel-ccrecipients',	'#dlo-ANTENNE, #ddo'),
	('ddo-cancel-internal-recipients',	'#dlo-ANTENNE'),
	('ddo-cancel-internal-ccrecipients',	'#ddo'),
	('ddo-cancel-external-recipients',	'#prefadpc'),
	('ddo-cancel-external-ccrecipients',	'#ddo'),
	('ddo-wait-recipients',	'#dlo-ANTENNE'),
	('ddo-wait-ccrecipients',	'#ddo'),
	('ddo-reject-recipients',	'#dlo-ANTENNE'),
	('ddo-reject-ccrecipients',	'#ddo'),
	('ddo-validate-internal-recipients',	'#dlo-ANTENNE'),
	('ddo-validate-internal-ccrecipients',	'#ddo'),
	('ddo-validate-external-recipients',	'#prefadpc'),
	('ddo-validate-external-ccrecipients',	'#ddo');


INSERT INTO `users`
	(login, pass, last_name, first_name, phone, mail, attached_section, eprotec) VALUES
	('Admin', '', 'Administrator', 'Général', '', 'directeur-adj-informatique@protectioncivile92.org', '0', ''),


INSERT INTO `sections`
	(`number`, `attached_section`, `name`, `shortname`, `address`, `zip_code`, `city`, `phone`, `website`, `mail`) VALUES
	(0, 0, 'ADPC92', 'ADP', '32 boulevard des oiseaux', '92700', 'Colombes', '', 'http://www.protectioncivile92.org', 'contact'),
	(1, 0, 'Antony', 'ANT', '5 allée Françoise Dolto', '', 'Antony', '', '', 'antony@protectioncivile92.org'),
	(2, 2, 'Asnières sur Seine', 'ASN', 'Stade Félix Eboué, 19 avenue Laurent Cely', '', 'Asnières sur Seine', '0147903359', 'http://protectioncivile92.org/asnieres', 'asnieres@protectioncivile92.org'),
	(3, 0, 'Bagneux', 'BAG', '', '', '', '', '', ''),
	(4, 12, 'BoisCo', 'BOI', '', '', '', '', '', ''),
	(5, 5, 'Boulogne Billancourt', 'BOU', '', '92100', 'Boulogne Billancourt', '0652221205', '', 'boulogne-issy@protectioncivile92.org'),
	(6, 6, 'Bourg la Reine', 'BLR', '5 allée Françoise Dolto, 116 av Général Leclerc', '92340', 'Bourg la Reine', '0632989270', 'http://protectioncivile92.org/bourg-la-reine', 'bourg-la-reine@protectioncivile92.org'),
	(7, 0, 'Chatenay Malabry', 'CHM', '', '', '', '', '', ''),
	(8, 0, 'Chatillon', 'CHT', '', '', '', '', '', ''),
	(9, 0, 'Chaville', 'CHV', '', '', '', '', '', '');
	(10, 10, 'Clamart', 'CLA', '76 bis rue du parc', '92140', 'Clamart', '0140959222', 'http://protectioncivile92.org/clamart', 'clamart@protectioncivile92.org'),
	(11, 'Clichy sur Seine', 'CLI', '92 rue Martre, Bureau 101', '92110', 'Clichy Sur Seine', '0142704150', '', 'clichy@protectioncivile92.org'),
	(12, 12, 'Colombes', 'COL', '32 boulevard des oiseaux', '92700', 'Colombes', '0142427404', 'http://protectioncivile92.org/colombes', 'colombes@protectioncivile92.org'),
	(13, 13, 'Courbevoie, Neuilly, La Garenne Colombes', 'COU', '48 rue de Colombes', '92400', 'Courbevoie', '0762263688', 'http://protectioncivile92.org/courbevoie', 'courbevoie@protectioncivile92.org'),
	(14, 0, 'Fontenay aux Roses', 'FON', '', '', '', '', '', ''),
	(15, 15, 'Garches', 'GAR', '59 rue du Docteur Debat', '92380', 'Garches', '0676457979', 'http://protectioncivile92.org/garches', 'garches@protectioncivile92.org'),
	(16, 13, 'La Garenne Colombes', 'LGA', '', '', '', '', '', ''),
	(17, 17, 'Gennevilliers', 'GEN', '37 rue du 8 mai 1945', '92230', 'Gennevilliers', '0147902624', 'http://protectioncivile92.org/gennevilliers', 'gennevilliers@protectioncivile92.org'),
	(18, 5, 'Issy', 'ISS', '', '', '', '', '', ''),
	(19, 33, 'Malakoff', 'MAL', '', '', '', '', '', ''),
	(20, 20, 'Levallois-Perret', 'LEV', '122 rue Président Wilson', '92300', 'Levallois-Perret', '0173729583', 'http://protectioncivile92.org/levallois', 'levallois@protectioncivile92.org'),
	(21, 0, 'Marne la Coquette', 'MAR', '', '', '', '', '', ''),
	(22, 0, 'Meudon', 'MEU', '', '', '', '', '', ''),
	(23, 6, 'Montrouge', 'MON', 'Maison des Associations, 105 avenue Aristide Briant', '92120', 'Montrouge', '0632989170', '', 'montrouge@protectioncivile92.org'),
	(24, 24, 'Nanterre', 'NAN', '27 rue Sadi Carnot', '92800', 'Nanterre', '0146950922', 'http://protectioncivile92.org/nanterre', 'nanterre@protectioncivile92.org'),
	(25, 13, 'Neuilly sur Seine', 'NEU', '167 Avenue Charles de Gaulle', '92200', 'Neuilly Sur Seine', '', 'http://protectioncivile92.org/courbevoie', 'neuilly@protectioncivile92.org'),
	(26, 0, 'Plessis Robinson', 'PLE', '', '', '', '', '', ''),
	(27, 32, 'Puteaux', 'PUT', '', '', '', '', '', ''),
	(28, 28, 'Rueil Malmaison', 'RUE', '25 avenue du Président Pompidou', '92500', 'Rueil Malmaison', '0147082047', 'http://protectioncivile92.org/rueil', 'rueil@protectioncivile92.org'),
	(29, 0, 'Saint Cloud', 'SAI', '', '', '', '', '', ''),
	(30, 0, 'Sceaux', 'SCE', '', '', '', '', '', ''),
	(31, 0, 'Sevres', 'SEV', '', '', '', '', '', ''),
	(32, 32, 'Suresnes, Puteaux', 'SUR', '125 Boulevard de Lattre de Tassigny', '92150', 'Suresnes', '0142047837', 'http://protectioncivile92.org/suresnes', 'suresnes-puteaux@protectioncivile92.org'),
	(33, 33, 'Vanves, Malakoff', 'VAN', '20 avenue Verdun', '92170', 'Vanves', '0629713430', 'http://protectioncivile92.org/vanves', 'vanves@protectioncivile92.org'),
	(34, 0, 'Vaucresson', 'VAU', '', '', '', '', '', ''),
	(35, 15, 'Ville d\'Avray', 'VLA', '', '', '', '', '', ''),
	(36, 36, 'Villeneuve La Garenne', 'VLG', 'BP 28, 1 rue Gaston Appert', '92390', 'Villeneuve la Garenne', '0140851192', 'http://protectioncivile92.org/villeneuve', 'villeneuve@protectioncivile92.org'),
