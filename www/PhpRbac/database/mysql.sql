/*
 * Create Tables
 */

CREATE TABLE IF NOT EXISTS `rbac_permissions` (
  `ID` int(11) NOT NULL auto_increment,
  `Lft` int(11) NOT NULL,
  `Rght` int(11) NOT NULL,
  `Title` char(64) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `Title` (`Title`),
  KEY `Lft` (`Lft`),
  KEY `Rght` (`Rght`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `rbac_rolepermissions` (
  `RoleID` int(11) NOT NULL,
  `PermissionID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL,
  PRIMARY KEY  (`RoleID`,`PermissionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `rbac_roles` (
  `ID` int(11) NOT NULL auto_increment,
  `Lft` int(11) NOT NULL,
  `Rght` int(11) NOT NULL,
  `Title` varchar(128) NOT NULL,
  `Description` text NOT NULL,
  `Directory` boolean NOT NULL,
  `Assignable` boolean NOT NULL,
  `Phone` text NOT NULL,
  `Mail` text NOT NULL,
  `Callsign` text NOT NULL,
  `Affiliation` int NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `Title` (`Title`),
  KEY `Lft` (`Lft`),
  KEY `Rght` (`Rght`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `rbac_userroles` (
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL,
  PRIMARY KEY  (`UserID`,`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*
 * Insert Initial Table Data
 */

INSERT INTO `rbac_permissions` (`Title`, `Description`)
VALUES ('admin-roles-view', 'Voir les rôles'),
 ('admin-roles-update', 'Modifier les rôles'),
 ('admin-permissions-view', 'Voir les permissions'),
 ('admin-permissions-update', 'Modifier les permissions'),
 ('admin-asssign-permissions-to-roles', 'Assigner les permissions'),
 ('ope-dps-create-own', 'Créer un DPS sur sa commune'),
 ('ope-dps-view-own', 'Voir les DPS de sa commune'),
 ('ope-dps-create-all', 'Créer un DPS sur toute commune'),
 ('ope-dps-view-all', 'Voir les DPS de toutes les communes'),
 ('ope-dps-validate-local', 'Valider une demande de DPS pour sa commune'),
 ('ope-dps-validate-ddo-to-pref', 'Envoyer une demande de DPS à la Préfecture'),
 ('admin-users-view', 'Voir les membres'),
 ('admin-users-update', 'Modifier les membres'),
 ('admin-mailinglist-manage', 'Gestion des listes de diffusion'),
 ('admin-commune-view', 'Voir les communes'),
 ('admin-commune-update', 'Modifier les communes'),
 ('directory-view', 'Voir annuaire'),
 ('directory-update', 'Modifier annuaire');


INSERT INTO `rbac_rolepermissions` (`RoleID`, `PermissionID`, `AssignmentDate`)
VALUES (1, 1, UNIX_TIMESTAMP()),
  (1, 2, UNIX_TIMESTAMP());

INSERT INTO `rbac_roles` (`Title`, `Description`, `Directory`, `Assignable`, `Phone`, `Mail`, `Callsign`, `Affiliation`)
VALUES ('Administrateur', 'root', FALSE,FALSE,'','','',NULL),
 ('Président', 'Président Départemental', TRUE, TRUE, '06123456789', 'president@protectioncivile92.org', 'AUTORITE 92', 0),
 ('Secrétaire', 'Secrétaire Général', TRUE, TRUE, '0676457981', 'secretaire-general@protectioncivile92.org', 'SECRETAIRE 92', 0),
 ('Trésorier', 'Trésorier', TRUE, TRUE, '0676457981', 'tresorier@protectioncivile92.org', 'TRESORIER 92', 0),
 ('DDO', 'Directeur Départemental des Opérations', TRUE, TRUE, '06123456789', 'directeur-operations@protectioncivile92.org', 'OPE 92', 0),
 ('DLO Courbevoie', 'Directeur Local des Opérations', TRUE, TRUE, '0674728980', 'operationnel-courbevoie@protectioncivile92.org', 'OPE Courbevoie', 13);

INSERT INTO `rbac_userroles` (`UserID`, `RoleID`, `AssignmentDate`)
VALUES (1, 1, UNIX_TIMESTAMP());
