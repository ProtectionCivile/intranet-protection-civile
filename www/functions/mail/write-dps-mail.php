<?php
require_once('functions/mail/Mail.php');
require_once('functions/mail/mail-functions.php');


// Find section owning the DPS
$sql =  'SELECT DISTINCT name FROM '.$tablename_sections.' WHERE number = '.$section;
 foreach  ($db_link->query($sql) as $row) {
   $sectionName = $row['name'];
 }

if ($action == 'validate-local') {
  $from = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#dlo-".$section));
  $db_to = getMailRecipients($db_link, $setting_service, $section, $event_department, 'dlo-validate-recipients');
  $db_cc = getMailRecipients($db_link, $setting_service, $section, $event_department, 'dlo-validate-ccrecipients');

  $subject = "Création de ".$select_list_parameter_service->getTranslation('dps_type_short', $dps_type).": ".$event_name;
  $message = "Bonjour,<br />
  <br />
  L'antenne de <strong>".$sectionName."</strong> vient de vous soumettre un DPS pour validation. Voici les informations :<br />
  <ul>
  <li><strong>Type de poste : </strong>".$select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type)."</li>
  <li><strong>Nom : </strong>".$event_name."</li>
  <li><strong>Description : </strong>".$event_description."</li>
  <li><strong>Adresse : </strong>".$event_address."</li>
  <li><strong>Horaires de poste : </strong> Du ".formatDateFrToReadable($dps_begin_date)." à ".formatTimeFrToReadable($dps_begin_time)." au ".formatDateFrToReadable($dps_end_date)." à ".formatTimeFrToReadable($dps_end_time)."</li>
  <li><strong>Certificat Original d'Affiliation : </strong>".$cu_full."</li>
  </ul>
  <br />
  Ce poste attend votre validation sur l'intranet.<br />
  <br />
  Bien cordialement,<br />
  <br />".$setting_service->getGeneralSetting('mail-signature-dlo')."<br />
  Antenne de ".$sectionName;

  $mail = new Mail($db_link, $tablename_mail, $currentUserID, $from, $subject, $message);

  foreach ($db_to as $mailaddr) {
    $mail->addTo($mailaddr);
  }
  foreach ($db_cc as $mailaddr) {
    $mail->addCc($mailaddr);
  }

  $mail->store();
}


if ($action == 'cancel-local') {
  $from = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#dlo-".$section));
  $db_to = getMailRecipients($db_link, $setting_service, $section, $event_department, 'dlo-cancel-recipients');
  $db_cc = getMailRecipients($db_link, $setting_service, $section, $event_department, 'dlo-cancel-ccrecipients');

  $subject = "Annulation de ".$select_list_parameter_service->getTranslation('dps_type_short', $dps_type).": ".$event_name;
  $message = "Bonjour,<br />
  <br />
  L'antenne de <strong>".$sectionName."</strong> vient d'annuler prématurément un DPS pour la raison suivante : ".$dps['status_cancel_reason']."
  <br />
  <br />
  Voici les informations :<br />
  <ul>
  <li><strong>Type de poste : </strong>".$select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type)."</li>
  <li><strong>Nom : </strong>".$event_name."</li>
  <li><strong>Horaires de poste : </strong> Du ".formatDateFrToReadable($dps_begin_date)." à ".formatTimeFrToReadable($dps_begin_time)." au ".formatDateFrToReadable($dps_end_date)." à ".formatTimeFrToReadable($dps_end_time)."</li>
  <li><strong>Certificat Original d'Affiliation : </strong>".$cu_full."</li>
  </ul>
  <br/>
  Bien cordialement,<br />
  <br />".$setting_service->getGeneralSetting('mail-signature-dlo')."<br />
  Antenne de ".$sectionName;

  $mail = new Mail($db_link, $tablename_mail, $currentUserID, $from, $subject, $message);

  foreach ($db_to as $mailaddr) {
    $mail->addTo($mailaddr);
  }
  foreach ($db_cc as $mailaddr) {
    $mail->addCc($mailaddr);
  }

  $mail->store();
}


if ($action == 'cancel-ddo') {
  // 1er mail : INTERNAL
  $from = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#ddo"));
  $db_to = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-cancel-internal-recipients');
  $db_cc = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-cancel-internal-ccrecipients');

  $subject = "Annulation du ".$select_list_parameter_service->getTranslation('dps_type_short', $dps_type).": ".$event_name;
  $message = "Bonjour,<br />
  <br />
  La Direction Départementale des Opérations annule votre ".$select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type)." <strong>".$event_name."</strong> pour la raison suivante : ".$dps['status_cancel_reason']."<br />
  <br />
  <br />
  Bien cordialement,<br />
  <br />".$setting_service->getGeneralSetting('mail-signature-ddo');

  $mail = new Mail($db_link, $tablename_mail, $currentUserID, $from, $subject, $message);

  foreach ($db_to as $mailaddr) {
    $mail->addTo($mailaddr);
  }
  foreach ($db_cc as $mailaddr) {
    $mail->addCc($mailaddr);
  }

  $mail->store();

  // 2nd mail : EXTERNE
  $from = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#ddo"));
  $db_to = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-cancel-external-recipients');
  $db_cc = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-cancel-external-ccrecipients');

  $subject = "Déclaration de ".$select_list_parameter_service->getTranslation('dps_type_short', $dps_type).": ".$cu_full;
  $message = "Bonjour,<br />
  <br />
  La Protection Civile des Hauts-de-Seine vous informe de l'annulation du <strong>".$select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type)."</strong> numéro ".$cu_full." pour la raison suivante : ".$dps['status_cancel_reason'].".<br />
  <br />
  Rappels :
  <ul>
  <li><strong>Nom : </strong>".$event_name."</li>
  <li><strong>Description : </strong>".$event_description."</li>
  <li><strong>Adresse : </strong>".$event_address."</li>
  <li><strong>Horaires de poste : </strong> Du ".formatDateFrToReadable($dps_begin_date)." à ".formatTimeFrToReadable($dps_begin_time)." au ".formatDateFrToReadable($dps_end_date)." à ".formatTimeFrToReadable($dps_end_time)."</li>
  <li><strong>Certificat Original d'Affiliation : </strong>".$cu_full."</li>
  <br />
  </ul>
  <br />
  <br />
  Bien cordialement,<br />
  <br />".$setting_service->getGeneralSetting('mail-signature-ddo');

  $mail = new Mail($db_link, $tablename_mail, $currentUserID, $from, $subject, $message);

  foreach ($db_to as $mailaddr) {
    $mail->addTo($mailaddr);
  }
  foreach ($db_cc as $mailaddr) {
    $mail->addCc($mailaddr);
  }

  $mail->store();
}


if ($action == 'wait') {
  $from = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#ddo"));
  $db_to = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-wait-recipients');
  $db_cc = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-wait-ccrecipients');

  $subject = $select_list_parameter_service->getTranslation('dps_type_short', $dps_type)." mis en attente: ".$event_name;
  $message = "Bonjour,<br /><br />Votre ".$select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type)." <strong>".$event_name."</strong> initialement prévu du ".formatDateFrToReadable($dps_begin_date)." à ".formatTimeFrToReadable($dps_begin_time)." au ".formatDateFrToReadable($dps_end_date)." à ".formatTimeFrToReadable($dps_end_time)." vient d'être <strong>mis en attente</strong> pour la raison suivante : ".$dps['status_justification']."
  <br />
  <br />
  Vous ne pouvez néanmoins plus modifier le DPS. Au besoin, contactez le DDO pour régulariser la situation:<br />
  <br />
  Bien cordialement,<br />
  <br />".$setting_service->getGeneralSetting('mail-signature-ddo');

  $mail = new Mail($db_link, $tablename_mail, $currentUserID, $from, $subject, $message);

  foreach ($db_to as $mailaddr) {
    $mail->addTo($mailaddr);
  }
  foreach ($db_cc as $mailaddr) {
    $mail->addCc($mailaddr);
  }

  $mail->store();
}


if ($action == 'accept-ddo') {
  // 1er mail : INTERNAL
  $from = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#ddo"));
  $db_to = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-validate-internal-recipients');
  $db_cc = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-validate-internal-ccrecipients');

  $subject = "Accord du ".$select_list_parameter_service->getTranslation('dps_type_short', $dps_type).": ".$event_name;
  $message = "Bonjour,<br />
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
  <br />".$setting_service->getGeneralSetting('mail-signature-ddo');

  $mail = new Mail($db_link, $tablename_mail, $currentUserID, $from, $subject, $message);

  foreach ($db_to as $mailaddr) {
    $mail->addTo($mailaddr);
  }
  foreach ($db_cc as $mailaddr) {
    $mail->addCc($mailaddr);
  }
  if (!empty($declarationFilePath)) {
    $mail->addAttachment($declarationFilePath);
  }

  $mail->store();

  // 2nd mail : EXTERNE
  $from = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#ddo"));
  $db_to = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-validate-external-recipients');
  $db_cc = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-validate-external-ccrecipients');

  $subject = "Déclaration de ".$select_list_parameter_service->getTranslation('dps_type_short', $dps_type).": ".$cu_full;
  $message = "Bonjour,<br />
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
  <br />".$setting_service->getGeneralSetting('mail-signature-ddo');

  $mail = new Mail($db_link, $tablename_mail, $currentUserID, $from, $subject, $message);

  foreach ($db_to as $mailaddr) {
    $mail->addTo($mailaddr);
  }
  foreach ($db_cc as $mailaddr) {
    $mail->addCc($mailaddr);
  }
  if (!empty($declarationFilePath)) {
    $mail->addAttachment($declarationFilePath);
  }

  // Si extérieur au département, mail à la fNPC
  if (!($event_department == '92')) {
    $fnpcMail = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#fnpc"));
    $mail->addTo($fnpcMail);
  }

  $mail->store();
}


if ($action == 'reject-ddo') {
  $from = implode(",", getRealMailAddresses($db_link, $setting_service, $section, $event_department, "#ddo"));
  $db_to = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-reject-recipients');
  $db_cc = getMailRecipients($db_link, $setting_service, $section, $event_department, 'ddo-reject-ccrecipients');

  $subject = $select_list_parameter_service->getTranslation('dps_type_short', $dps_type)." refusé: ".$event_name;
  $message = "Bonjour,<br /><br />Votre ".$select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type)." <strong>".$event_name."</strong> initialement prévu du ".formatDateFrToReadable($dps_begin_date)." à ".formatTimeFrToReadable($dps_begin_time)." au ".formatDateFrToReadable($dps_end_date)." à ".formatTimeFrToReadable($dps_end_time)." vient d'être <strong>refusé</strong> pour la raison suivante : ".$dps['status_justification']."
  <br />
  <br />
  Vous ne pouvez plus modifier le DPS. Au besoin, contactez le DDO pour régulariser la situation:<br />
  Bien cordialement,<br />
  <br />".$setting_service->getGeneralSetting('mail-signature-ddo');

  $mail = new Mail($db_link, $tablename_mail, $currentUserID, $from, $subject, $message);

  foreach ($db_to as $mailaddr) {
    $mail->addTo($mailaddr);
  }
  foreach ($db_cc as $mailaddr) {
    $mail->addCc($mailaddr);
  }

  $mail->store();
}

?>
