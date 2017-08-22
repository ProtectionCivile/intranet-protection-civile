<?php

class Mail {

  private $db_link;
  private $tablename;
  private $userId = '';

  private $from = '';
  private $subject = '';
  private $message = '';
  private $to= array();
  private $cc = array();
  private $attachements = array();


  public function __construct($db_link_p, $tablename_p, $userId_p, $from_p, $subject_p, $message_p) {
    $this->db_link = $db_link_p;
    $this->tablename = $tablename_p;
    $this->subject = $subject_p;
    $this->userId = $userId_p;
    $this->from = $from_p;
    $this->message = $message_p;
  }

  public function addAttachement($filepath_p) {
    array_push($this->$attachements, $filepath_p);
  }

  public function addTo($to_p) {
    array_push($this->to, $to_p);
  }

  public function addCc($cc_p) {
    array_push($this->cc, $cc_p);
  }

  public function displayInfos() {
    echo "<br />Envoi d'un mail avec les paramètres suivants : <br /><br />";
    echo "UserID : ".$this->userId."<br />";
    echo "from : ".$this->from."<br />";
    echo "Sujet : ".$this->subject."<br />";
    foreach ($this->to as $item) {
      echo "Destinataire : ".$item."<br />";
    }
    foreach ($this->cc as $item) {
      echo "CC : ".$item."<br />";
    }
    echo "Message : ".$this->message."<br />";
    echo "PJ : ".print_r($this->attachements)."<br />";
  }


  public function store() {
    $toList = (!empty($this->to)) ? implode(',', $this->to) : '';
    $ccList = (!empty($this->cc)) ? implode(',', $this->cc) : '';
    $attachementsList = (!empty($this->attachements)) ? implode(',', $this->attachements) : '';
    $encodedMessage = mysqli_real_escape_string($this->db_link, $this->message);
    $today = date("Y-m-d H:i:s");

    $sql = "INSERT INTO $this->tablename (`user`, `from_addr`, `to_addr`, `cc_addr`, `subject`, `message`, `attachements`, `date_created`) VALUES
    ('$this->userId', '$this->from', '$toList', '$ccList', '$this->subject', '$encodedMessage', '$attachementsList', '$today')"
    or die("Impossible de stocker le mail dans la base de données" . mysqli_error($db_link));
    if ($this->db_link->query($sql) === TRUE) {
      // echo "c réussi";
    }
    else {
      // echo "c raté : ".$this->db_link->error;
    }
  }

}

?>
