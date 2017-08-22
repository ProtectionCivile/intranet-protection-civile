to<?php
// Appelé régulièrement par le CRON, dépile et envoie les mails en attente de la base de données.
// Dès qu'ils sont traités, il positionne la date d'envoi à la date du jour

require_once('functions/session/db-connect.php');


$sql = "SELECT `id`, `from_addr`, `to_addr`, `cc_addr`, `subject`, `message`, `attachements` FROM $tablename_mail WHERE `date_sent` IS NULL ORDER BY id ASC";
foreach  ($db_link->query($sql) as $row) {
  // Récupération des informations du Mail
  $id = $row['id'];
  $from = $row['from_addr'];
  $to = $row['to_addr'];
  $cc = $row['cc_addr'];
  $subject = $row['subject'];
  $message = $row['message'];
  $attachementFilePaths = explode(',', $row['attachements']);

  // TODO Ici il faut envoyer le mail
  // Si on peut, récupérer le résultat de l'envoi dans une variable $sent.

  $sent = TRUE; // A faire varier selon si oui ou non le mail a été envoyé.

  // Positionnement de la date d'envoi à aujourd'hui
  if ($sent) {
    $today = date("Y-m-d H:i:s");
    $sql = "UPDATE `".$tablename_mail."` SET `date_sent`='".$today."' WHERE `id`='".$id."' ";
    if ($db_link->query($sql) === TRUE) {
      echo "OK<br />";
    }
    else {
      echo "Failure (".$db_link->error.")<br />"; // Ou bien renvoyer une erreur 500 ?
    }
  }
}


?>
