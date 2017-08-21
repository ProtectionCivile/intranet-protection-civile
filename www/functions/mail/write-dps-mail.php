<?php
require('functions/mail/Mail.php');
require_once('functions/mail/mail-functions.php');


// Paramètre d'entrée : l'action désrée (validation locale? refus DDO?)
$action = 'validate-local'; // TODO retirer cet exemple

// Find section owning the DPS
$sql =  'SELECT DISTINCT name FROM '.$tablename_sections.' WHERE number = '.$section;
 foreach  ($db_link->query($sql) as $row) {
   $sectionName = $row['name'];
 }


if ($action == 'validate-local') {
  $sender = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#dlo-".$section));
  $db_recipients = getMailRecipients($db_link, $setting_service, $section, $event_department, 'dlo-validate-recipients');
  $db_ccrecipients = getMailRecipients($db_link, $setting_service, $section, $event_department, 'dlo-validate-ccrecipients');

  $mail_subject = "Création de DPS: ".$event_name;
  $mail_message = "Bonjour,<br /><br />L'antenne de <strong>".$sectionName."</strong> vient de vous soumettre un DPS pour validation. Voici les informations :<br />
  <ul>
  <li><strong>Type de poste : </strong>".$select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type)."</li>
  <li><strong>Nom : </strong>".$event_name."</li>
  <li><strong>Description : </strong>".$event_description."</li>
  <li><strong>Adresse : </strong>".$event_address."</li>
  <li><strong>Horaires de poste : </strong> Du ".formatDateFrToReadable($dps_begin_date)." à ".formatTimeFrToReadable($dps_begin_time)." au ".formatDateFrToReadable($dps_end_date)." à ".formatTimeFrToReadable($dps_end_time)."</li>
  <li><strong>Certificat Original d'Affiliation : </strong>".$cu_full."</li>
  </ul>
  <br />
  Ce poste attend votre validation sur l'intranet.";

  $mail = new Mail($db_link, $tablename_mail, $currentUserID, $sender, $mail_subject, $mail_message);

  foreach ($db_recipients as $recipient) {
    $mail->addRecipient($recipient);
  }
  foreach ($db_ccrecipients as $ccrecipient) {
    $mail->addCcRecipient($ccrecipient);
  }

  // Stocker le mail en base de données
  $mail->store();
}


if ($action == 'cancel-local') {
  $sender = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#dlo-".$section));
  $db_recipients = getMailRecipients($db_link, $setting_service, $section, $event_department, 'dlo-cancel-recipients');
  $db_ccrecipients = getMailRecipients($db_link, $setting_service, $section, $event_department, 'dlo-cancel-ccrecipients');

  $mail_subject = "Annulation de DPS: ".$event_name;
  $mail_message = "Bonjour,<br /><br />L'antenne de <strong>".$sectionName."</strong> vient d'annuler prématurément un DPS pour la raison suivante : ".$dps['status_cancel_reason']."
  <br />
  <br />
  Voici les informations :<br />
  <ul>
  <li><strong>Type de poste : </strong>".$select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type)."</li>
  <li><strong>Nom : </strong>".$event_name."</li>
  <li><strong>Horaires de poste : </strong> Du ".formatDateFrToReadable($dps_begin_date)." à ".formatTimeFrToReadable($dps_begin_time)." au ".formatDateFrToReadable($dps_end_date)." à ".formatTimeFrToReadable($dps_end_time)."</li>
  <li><strong>Certificat Original d'Affiliation : </strong>".$cu_full."</li>
  </ul>
  <br />
  Ce poste attend votre validation sur l'intranet.";

  $mail = new Mail($db_link, $tablename_mail, $currentUserID, $sender, $mail_subject, $mail_message);

  foreach ($db_recipients as $recipient) {
    $mail->addRecipient($recipient);
  }
  foreach ($db_ccrecipients as $ccrecipient) {
    $mail->addCcRecipient($ccrecipient);
  }

  // Stocker le mail en base de données
  $mail->store();
}


if ($action == 'cancel-ddo') {

}


if ($action == 'wait') {
  $sender = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#ddo"));
  $db_recipients = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-wait-recipients');
  $db_ccrecipients = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-wait-ccrecipients');

  $mail_subject = "DPS mis en attente: ".$event_name;
  $mail_message = "Bonjour,<br /><br />Votre ".$select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type)." <strong>".$event_name."</strong> initialement prévu du ".formatDateFrToReadable($dps_begin_date)." à ".formatTimeFrToReadable($dps_begin_time)." au ".formatDateFrToReadable($dps_end_date)." à ".formatTimeFrToReadable($dps_end_time)." vient d'être <strong>mis en attente</strong> pour la raison suivante : ".$dps['status_justification']."
  <br />
  <br />
  Vous ne pouvez néanmoins plus modifier le DPS. Au besoin, contactez le DDO pour régulariser la situation:<br />";

  $mail = new Mail($db_link, $tablename_mail, $currentUserID, $sender, $mail_subject, $mail_message);

  foreach ($db_recipients as $recipient) {
    $mail->addRecipient($recipient);
  }
  foreach ($db_ccrecipients as $ccrecipient) {
    $mail->addCcRecipient($ccrecipient);
  }

  // Stocker le mail en base de données
  $mail->store();
}


if ($action == 'accept-ddo') {
  // 1er mail : intl_error_name
  $sender = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#ddo"));
  $db_recipients = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-validate-internal-recipients');
  $db_ccrecipients = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-validate-internal-ccrecipients');

  $mail_subject = "Accord du ".$select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type).": ".$event_name;
  $mail_message = "Bonjour,<br />
  <br />
  La Protection Civile des Hauts-de-Seine vous donne l'accord pour effectuer votre ".$select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type)." <strong>".$event_name."</strong>.<br />
  <br />
  <ul>
  <li><strong>Nom : </strong>".$event_name."</li>
  <li><strong>Description : </strong>".$event_description."</li>
  <li><strong>Adresse : </strong>".$event_address."</li>
  <li><strong>Horaires de poste : </strong> Du ".formatDateFrToReadable($dps_begin_date)." à ".formatTimeFrToReadable($dps_begin_time)." au ".formatDateFrToReadable($dps_end_date)." à ".formatTimeFrToReadable($dps_end_time)."</li>
  <li><strong>Certificat Original d'Affiliation : </strong>".$cu_full."</li>
  <br />
  </ul>
  Ce dispositif a fait l'objet d'un accord favorable avec la mention suivante: ".$dps['status_justification']."<br />
  <br />
  <br />
  Bien cordialement,<br />
  <br />
  Le Directeur Départemental des Opérations  <br />
  operationnel@protectioncivile92.org  <br />
  07.74.95.31.75";

  $mail = new Mail($db_link, $tablename_mail, $currentUserID, $sender, $mail_subject, $mail_message);

  foreach ($db_recipients as $recipient) {
    $mail->addRecipient($recipient);
  }
  foreach ($db_ccrecipients as $ccrecipient) {
    $mail->addCcRecipient($ccrecipient);
  }
  // TODO Manque les attachements

  // Stocker le mail en base de données
  $mail->store();

  // 2nd mail : EXTERNE
  $sender = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#ddo"));
  $db_recipients = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-validate-internal-recipients');
  $db_ccrecipients = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-validate-internal-ccrecipients');

  $mail_subject = "Déclaration de ".$select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type).": ".$cu_full;
  $mail_message = "Bonjour,<br />
  <br />
  La Protection Civile des Hauts-de-Seine vous informe de la mise en place d'un <strong>".$select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type)."</strong>.<br />
  <br />
  <ul>
  <li><strong>Nom : </strong>".$event_name."</li>
  <li><strong>Description : </strong>".$event_description."</li>
  <li><strong>Adresse : </strong>".$event_address."</li>
  <li><strong>Horaires de poste : </strong> Du ".formatDateFrToReadable($dps_begin_date)." à ".formatTimeFrToReadable($dps_begin_time)." au ".formatDateFrToReadable($dps_end_date)." à ".formatTimeFrToReadable($dps_end_time)."</li>
  <li><strong>Certificat Original d'Affiliation : </strong>".$cu_full."</li>
  <br />
  </ul>
  Ce dispositif a fait l'objet d'un accord favorable avec la mention suivante: ".$dps['status_justification']."<br />
  <br />
  <br />
  Bien cordialement,<br />
  <br />
  Le Directeur Départemental des Opérations  <br />
  operationnel@protectioncivile92.org  <br />
  07.74.95.31.75";

  $mail = new Mail($db_link, $tablename_mail, $currentUserID, $sender, $mail_subject, $mail_message);

  foreach ($db_recipients as $recipient) {
    $mail->addRecipient($recipient);
  }
  foreach ($db_ccrecipients as $ccrecipient) {
    $mail->addCcRecipient($ccrecipient);
  }
  // TODO Manque les attachements

  // Stocker le mail en base de données
  $mail->store();
}


if ($action == 'reject-ddo') {
  $sender = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#ddo"));
  $db_recipients = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-reject-recipients');
  $db_ccrecipients = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-reject-ccrecipients');

  $mail_subject = "DPS refusé: ".$event_name;
  $mail_message = "Bonjour,<br /><br />Votre ".$select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type)." <strong>".$event_name."</strong> initialement prévu du ".formatDateFrToReadable($dps_begin_date)." à ".formatTimeFrToReadable($dps_begin_time)." au ".formatDateFrToReadable($dps_end_date)." à ".formatTimeFrToReadable($dps_end_time)." vient d'être <strong>refusé</strong> pour la raison suivante : ".$dps['status_justification']."
  <br />
  <br />
  Vous ne pouvez plus modifier le DPS. Au besoin, contactez le DDO pour régulariser la situation:<br />";

  $mail = new Mail($db_link, $tablename_mail, $currentUserID, $sender, $mail_subject, $mail_message);

  foreach ($db_recipients as $recipient) {
    $mail->addRecipient($recipient);
  }
  foreach ($db_ccrecipients as $ccrecipient) {
    $mail->addCcRecipient($ccrecipient);
  }

  // Stocker le mail en base de données
  $mail->store();
}

?>
