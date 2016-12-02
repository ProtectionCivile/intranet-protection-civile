<?php
$hostname_dbprotect = "localhost";
$username_dbprotect = "root";
$password_dbprotect = "root";
$database_dbprotect = "ADPC"; 
$tablename_dbprotect= "users";    // nom de la table utilisée
$tablename_commune = "commune";		//liste des communes
$tablename_ratcommune = "rat_com";		//liste des rattachements aux communes
$tablename_ratmembre = "rat_membre";		//membres vis à vis des communes
$tablename_ratdepartement = "rat_dpt";		//membres vis à vis du département
$tablename_permission = "rbac_permissions";		//gestion des permissions
$tablename_roles = "rbac_roles";		//gestion des roles
$link = mysqli_connect($hostname_dbprotect,$username_dbprotect,$password_dbprotect,$database_dbprotect) or die("Error " . mysqli_error($link));
if (!mysqli_set_charset($link, 'utf8')) { echo "charset not utf8";}
?>