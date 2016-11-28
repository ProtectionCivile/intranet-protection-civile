<?php
require_once('functions/session/db-connect.php');
require_once('PhpRbac/src/PhpRbac/Rbac.php');
use PhpRbac\Rbac;
$rbac = new Rbac();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>

<?php 
$selectMyUserQuery = 'SELECT first_name, last_name, attached_section FROM users WHERE ID='.$_SESSION["ID"];
$selectMyUserQueryExecution = mysqli_query($link, $selectMyUserQuery);
$myUserAsQueryResult = mysqli_fetch_assoc($selectMyUserQueryExecution);
$currentUserID=$_SESSION["ID"];
$currentUserFirstName=$myUserAsQueryResult['first_name'];
$currentUserLastName=$myUserAsQueryResult['last_name'];
$currentUserSection=$myUserAsQueryResult['attached_section'];

?>

<?php require_once('menu.php'); ?>