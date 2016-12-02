<?php
require_once('functions/session/db-connect.php');
require_once('PhpRbac/src/PhpRbac/Rbac.php');
use PhpRbac\Rbac;
$rbac = new Rbac();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>


<?php require_once('functions/session/currentuser-parameters.php'); ?>

<?php require_once('menu.php'); ?>