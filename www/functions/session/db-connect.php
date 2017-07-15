<?php
$hostname_dbprotect = "localhost";
$username_dbprotect = "root";
$password_dbprotect = "root";
$database_dbprotect = "ADPC";


$tablename_users = "users";
$tablename_dps = "demande_dps";
$tablename_sections = "sections";
$tablename_permissions = "rbac_permissions";
$tablename_roles = "rbac_roles";
$tablename_rolepermissions = "rbac_rolepermissions";
$tablename_userroles = "rbac_userroles";
$tablename_settings_general = "settings_general";
$tablename_settings_mail = "settings_mail";

$db_link = mysqli_connect($hostname_dbprotect,$username_dbprotect,$password_dbprotect,$database_dbprotect) or die("Error " . mysqli_error($db_link));
if (!mysqli_set_charset($db_link, 'utf8')) { echo "charset not utf8";}
?>
