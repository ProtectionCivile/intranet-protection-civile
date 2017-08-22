<?php

class SelectListParameterService {
  private $db_link;
  private $tablename_select_list_parameters;

  public function __construct ($db_link_p, $tablename_select_list_parameters_p) {
    $this->db_link = $db_link_p;
    $this->tablename_select_list_parameters = $tablename_select_list_parameters_p;
  }

  public function getTranslation($category, $value) {
    if (empty($category) || $value == null) {
      return "NON-DÉFINI (paramètres manquants)";
    }
    $sql =  "SELECT DISTINCT option_text FROM `".$this->tablename_select_list_parameters."` WHERE `category` = '".$category."' AND `option_value` = '".$value."'";
    foreach  ($this->db_link->query($sql) as $row) {
      $value = $row['option_text'];
    }
    return (empty($value)) ? "PAS DE PARAMÈTRE POUR ".$category."/".$value : $value ;
  }

  public function getParametersForCategory($category) {
    if (empty($category)) {
      return "NON-DÉFINI (paramètres manquants)";
    }
    $sql =  "SELECT option_value, option_text FROM `".$this->tablename_select_list_parameters."` WHERE `category` = '".$category."'";
    return $this->db_link->query($sql);
  }

}

$select_list_parameter_service = new SelectListParameterService($db_link, $tablename_select_list_parameters);

?>
