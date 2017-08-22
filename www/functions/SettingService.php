<?php

class SettingService {
  private $db_link;
  private $tablename_settings_mail;
  private $tablename_settings_general;

  public function __construct ($db_link_p, $tablename_settings_general_p, $tablename_settings_mail_p) {
    $this->db_link = $db_link_p;
    $this->tablename_settings_mail = $tablename_settings_mail_p;
    $this->tablename_settings_general = $tablename_settings_general_p;
  }

  private function getSetting($tablename, $setting) {
    if (empty($setting)) {
      return "PAS DE PARAMÈTRE FOURNI";
    }
    $sql =  "SELECT DISTINCT value FROM `".$tablename."` WHERE `name` = '".$setting."'";
    foreach  ($this->db_link->query($sql) as $row) {
      $value = $row['value'];
    }
    return (empty($value)) ? "PAS DE PARAMÈTRE POUR ".$setting : $value ;
  }


  public function getMailSetting($setting) {
    return $this->getSetting($this->tablename_settings_mail, $setting);
  }

  public function getGeneralSetting($setting) {
    return $this->getSetting($this->tablename_settings_general, $setting);
  }
}

$setting_service = new SettingService($db_link, $tablename_settings_general, $tablename_settings_mail);

?>
