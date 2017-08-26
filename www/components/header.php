<?php
require_once('functions/session/db-connect.php');
require_once('PhpRbac/src/PhpRbac/Rbac.php');
use PhpRbac\Rbac;
$rbac = new Rbac();

setlocale(LC_ALL, 'fr_FR');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/moment.js" type="text/javascript" ></script>
<script src="js/moment-with-locales.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script src="js/fr.js" type="text/javascript" charset="utf-8"></script>
<script src="js/fileinput.js" type="text/javascript"></script>
<!-- <script src="js/validator.js" type="text/javascript"></script> -->


<?php require_once('functions/compute-server-feedback.php'); ?>
<?php require_once('functions/str.php'); ?>
<?php require_once('functions/SettingService.php'); ?>
<?php require_once('functions/SelectListParameterService.php'); ?>


<?php require_once('functions/session/currentuser-parameters.php'); ?>

<?php require_once('menu.php'); ?>
