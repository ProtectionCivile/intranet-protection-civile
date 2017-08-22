<?php
function getRealMailAddresses($db_link, $setting_service_p, $section, $department, $mail_strip ) {
  $mail_strip = trim($mail_strip);
  if ( strpos($mail_strip, '@') == TRUE) { // This is a real mail addr
    return explode(',', $mail_strip);
  }
  else if ( $mail_strip == "#prefadpc") { // This must be interpreted
    if ($department == '92') {
      $lookup = 'prefecture';
    }
    else {
      $lookup = 'adpc-'.$department;
    }
    return explode(',', $setting_service_p->getMailSetting(str_replace('#', '', $lookup)));
  }
  else if ( strpos($mail_strip, '#') !== FALSE) { // This must be interpreted
    $mail_strip = str_replace('ANTENNE', $section, $mail_strip);
    return explode(',', $setting_service_p->getMailSetting(str_replace('#', '', $mail_strip)));
  }
}


function getMailRecipients($db_link, $setting_service_p, $section, $department, $recipients_to_find_p) {
  // $oneLineRecipients = '';
  $db_recipients = array();

  // Récupère la liste des destinataires
  $oneLineRecipients = $setting_service_p->getMailSetting($recipients_to_find_p);
  echo "recipients_to_find_p=".$recipients_to_find_p." --> oneLineRecipients=".$oneLineRecipients."<br />";

  // Aligne les sur une ligne en les mettant sous forme de tableau
	$oneLineCommaSeparatedRecipients = explode(',', trim($oneLineRecipients));

  // Résoud les adresses particulières
  foreach ($oneLineCommaSeparatedRecipients as $dbr) {
    $realMailAdressses = getRealMailAddresses($db_link, $setting_service_p, $section, $department, $dbr);
    foreach ($realMailAdressses as $realMail) {
      array_push($db_recipients, trim($realMail));
    }
  }
  return $db_recipients;
}


function getMailAddress($contact) {
  if (strpos($contact, '>') == TRUE) {
    return substr( $contact, strpos($contact, '<')+1, strpos($contact, '>') - strpos($contact, '<') - 1 );
  }
  else {
    return $contact;
  }
}

function getName($contact) {
  if (strpos($contact, '>') == TRUE) {
    return substr( $contact, strpos($contact, '"')+1, strpos($contact, '"', strpos($contact, '"')+1) - strpos($contact, '"') - 1 );
  }
  else {
    return null;
  }
}

?>
