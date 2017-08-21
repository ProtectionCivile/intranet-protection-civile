<?php

class Mail {

  private $db_link;
  private $tablename;
  private $userId = '';

  private $sender = '';
  private $subject = '';
  private $message = '';
  private $recipients= array();
  private $ccrecipients = array();
  private $attachements = array();


  public function __construct($db_link_p, $tablename_p, $userId_p, $sender_p, $subject_p, $message_p) {
    $this->db_link = $db_link_p;
    $this->tablename = $tablename_p;
    $this->subject = $subject_p;
    $this->userId = $userId_p;
    $this->sender = $sender_p;
    $this->message = $message_p;
  }

  public function addAttachement($filepath_p) {
    array_push($this->$attachements, $filepath_p);
  }

  public function addRecipient($recipient_p) {
    array_push($this->recipients, $recipient_p);
  }

  public function addCcRecipient($ccrecipient_p) {
    array_push($this->ccrecipients, $ccrecipient_p);
  }

  public function displayInfos() {
    echo "<br />Envoi d'un mail avec les paramètres suivants : <br /><br />";
    echo "UserID : ".$this->userId."<br />";
    echo "Sender : ".$this->sender."<br />";
    echo "Sujet : ".$this->subject."<br />";
    foreach ($this->recipients as $item) {
      echo "Destinataire : ".$item."<br />";
    }
    foreach ($this->ccrecipients as $item) {
      echo "CC : ".$item."<br />";
    }
    echo "Message : ".$this->message."<br />";
    echo "PJ : ".print_r($this->attachements)."<br />";
  }


  public function store() {
    $recipientsList = (!empty($this->recipients)) ? implode(',', $this->recipients) : '';
    $ccrecipientsList = (!empty($this->ccrecipients)) ? implode(',', $this->ccrecipients) : '';
    $attachementsList = (!empty($this->attachements)) ? implode(',', $this->attachements) : '';
    $encodedMessage = mysqli_real_escape_string($this->db_link, $this->message);
    $today = date("Y-m-d H:i:s");

    $sql = "INSERT INTO $this->tablename (`user`, `sender`, `recipients`, `cc_recipients`, `subject`, `message`, `attachements`, `date_created`) VALUES
    ('$this->userId', '$this->sender', '$recipientsList', '$ccrecipientsList', '$this->subject', '$encodedMessage', '$attachementsList', '$today')"
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
