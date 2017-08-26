# intranet-protection-civile
Intranet officiel de la Protection Civile des Hauts-de-Seine

Cet intranet est à destination et usage des associations départementales de Protection Civile, ainsi qu'aux groupements d'associations de Protection Civile.

Cet intranet permet :
- Gérer une liste d'utilisateurs avec les droits d'accès
- Générer des signatures mail avec la charte graphique officielle
- Estampiller des photos à l'effigie de la Protection Civile (cartouche)
- Mettre à jour les antennes (préalablement définie en base de données)
- Créer des Dispositif Prévisionnel de secours
- Workflow de validation d'un DPS avec envoi de mails (autres ADPC / Préfecture)
- Voir toutes les demandes de Dispositif Prévisionnel de secours
- Effectuer une recherche de bénévoles secouristes
- Accéder aux recettes des DPS
- Mettre à jour des listes de diffusion mail
- Gérer une base contacts de clients favoris pour créer des DPS plus rapidement


#### Prérequis

Runtime applicatif : PHP 5.3 ou ultérieur
Serveur web : Apache 2.2 / 2.4
Base de données : Mysql 5.x ou mariadb
Modules apache :
- mod_rewrite

#### Installation

1. git clone https://github.com/ProtectionCivile/intranet-protection-civile.git
3. Récupérer la BDD
4. Installer PHPRbac (si ce n'est pas fait) en exécutant le script PhpRbac/database/MySql.sql dans PhpMyAdmin
5. Installer les permissions et roles par défaut en :
5a. se connectant à l'appli avec un compte d'admin
5b. exécutant le script installation/install_rbac.php?confirm
6. Installer les tables SQL supplémentaires avec le script 'installation/update_sql_fields.sql'
2. Aller sur http://localhost/index.php
