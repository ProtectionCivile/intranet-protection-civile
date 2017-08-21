<?php
function getRealMailAddresses($db_link, $tablename, $section, $department, $mail_strip ) {

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

    $query = "SELECT * FROM $tablename WHERE name LIKE '".str_replace('#', '', $lookup)."'";
    $query_result = mysqli_query($db_link, $query);
    $db_record = mysqli_fetch_assoc($query_result);
    return explode(',', str_replace(' ', '', $db_record['value']));
  }
  else if ( strpos($mail_strip, '#') !== FALSE) { // This must be interpreted
    $mail_strip = str_replace('ANTENNE', $section, $mail_strip);

    $query = "SELECT * FROM $tablename WHERE name LIKE '".str_replace('#', '', $mail_strip)."'";
  	$query_result = mysqli_query($db_link, $query);
  	$db_record = mysqli_fetch_assoc($query_result);
    return explode(',', str_replace(' ', '', $db_record['value']));
  }

}


function getMailRecipients($db_link, $tablename, $section, $department, $recipients_to_find_p) {
  // $oneLineRecipients = '';
  $db_recipients = array();

  // Récupère la liste des destinataires
  $sql = "SELECT * FROM `".$tablename."` WHERE `name` LIKE '".$recipients_to_find_p."'" or die("Impossible de récupérer le paramètre" . mysqli_error($db_link));
  $query_result = mysqli_query($db_link, $sql);
  $db_record = mysqli_fetch_assoc($query_result);
  $oneLineRecipients = $db_record['value'];

  // Aligne les sur une ligne en les mettant sous forme de tableau
	$oneLineCommaSeparatedRecipients = explode(',', str_replace(' ', '', $oneLineRecipients));

  // Résoud les adresses particulières
  foreach ($oneLineCommaSeparatedRecipients as $dbr) {
    $realMailAdressses = getRealMailAddresses($db_link, $tablename, $section, $department, $dbr);
    foreach ($realMailAdressses as $realMail) {
      array_push($db_recipients, $realMail);
    }
  }
  return $db_recipients;
}

?>
