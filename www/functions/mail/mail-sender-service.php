<?php
// Appelé régulièrement par le CRON, dépile et envoie les mails en attente de la base de données.
// Dès qu'ils sont traités, il positionne la date d'envoi à la date du jour

require_once(__DIR__ .'/../../functions/session/db-connect.php');
require_once(__DIR__ .'/../../functions/mail/mail-functions.php');
require_once(__DIR__ .'/../../lib/PhpMailer/class.phpmailer.php');


$sql = "SELECT `id`, `from_addr`, `to_addr`, `cc_addr`, `subject`, `message`, `attachments` FROM $tablename_mail WHERE `date_sent` IS NULL ORDER BY id ASC";
foreach  ($db_link->query($sql) as $row) {
  // Récupération des informations du Mail
  $id = $row['id'];
  $from = $row['from_addr'];
  $to = explode(',', $row['to_addr']);
  $cc = explode(',', $row['cc_addr']);
  $subject = $row['subject'];
  $message = $row['message'];
  $attachmentFilePaths = explode(',', $row['attachments']);

  $email = new PHPMailer();
  $email->From      = getMailAddress($from);
  $email->FromName  = getName($from);
  $email->Subject   = $subject;
  $email->Body      = $message;
  $email->isHTML(true);
  if (!empty($to)) {
    foreach ($to as $to_mail) {
      $email->AddAddress(getMailAddress($to_mail), getName($to_mail));
    }
  }
  if (!empty($cc)) {
    foreach ($cc as $cc_mail) {
      $email->addCC(getMailAddress($cc_mail), getName($cc_mail));
    }
  }
  if (!empty($attachmentFilePaths)) {
    foreach ($attachmentFilePaths as $filepath) {
      $email->AddAttachment($filepath);
    }
  }

  $sent = $email->Send();

  // Positionnement de la date d'envoi à aujourd'hui
  if ($sent) {
    $today = date("Y-m-d H:i:s");
    echo "envoyé le ".$today;
    $sql = "UPDATE `".$tablename_mail."` SET `date_sent`='".$today."' WHERE `id`='".$id."' ";
    if ($db_link->query($sql) === TRUE) {
      echo "OK<br />";
    }
    else {
      echo "Failure (".$db_link->error.")<br />"; // Ou bien renvoyer une erreur 500 ?
    }
  }
  else {
    echo "Echec envoi du mail numéro ".$id." (".$email->ErrorInfo.")<br />";
  }
}


?>
