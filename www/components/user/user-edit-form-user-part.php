<?php $feedback = compute_server_feedback($user_lastName_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="user_lastName" class="col-sm-4 control-label">
    Nom
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom de famille" />
  </label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id="user_lastName" name="user_lastName" aria-describedby="user-lastName-error" placeholder="ex: Dupond" minlength='3' required='true' value="<?php echo htmlentities($user_lastName);?>" />
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='user-lastName-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<?php $feedback = compute_server_feedback($user_firstName_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="user_firstName" class="col-sm-4 control-label">
    Prénom
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Prénom" />
  </label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id="user_firstName" name="user_firstName" aria-describedby="user-firstName-error" placeholder="ex: Jean" minlength='3' required='true' value="<?php echo htmlentities($user_firstName);?>" />
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='user-firstName-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<?php $feedback = compute_server_feedback($user_login_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="user_login" class="col-sm-4 control-label">
    Matricule e-Protec
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Matricule e-Protec qui servira d'identifiant pour se connecter"></span>
  </label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id="user_login" name="user_login" aria-describedby="user-login-error" placeholder="ex: 49594" minlength='4' maxlength='8' required='true' digits='true' value="<?php echo htmlentities($user_login);?>" />
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='user-login-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<?php $feedback = compute_server_feedback($user_password_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="user_password1" class="col-sm-4 control-label">
    Mot de passe
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Mot de passe"></span>
  </label>
  <div class="col-sm-8">
    <input type="password" class="form-control" id="user_password1" name="user_password1" aria-describedby="user-password1-error" minlength='6' maxlength='20' >
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='user-password1-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="user_password2" class="col-sm-4 control-label">
    Mot de passe (confirmation)
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Mot de passe (confirmer)"></span>
  </label>
  <div class="col-sm-8">
    <input type="password" class="form-control" id="user_password2" name="user_password2" aria-describedby="user-password2-error" minlength='6' maxlength='20' equalTo='#user_password1'>
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='user-password2-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<?php $feedback = compute_server_feedback($user_phone_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="user_phone" class="col-sm-4 control-label">
    Téléphone
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Format 0XXXXXXXXX"></span>
  </label>
  <div class="col-sm-8">
    <input type="tel" class="form-control" id="user_phone" name="user_phone" aria-describedby="user-phone-error" placeholder="telephone" minlength='10' maxlength='10' required='true' digits='true' value="<?php echo htmlentities($user_phone);?>" data-minlength="10" >
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='user-phone-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<?php $feedback = compute_server_feedback($user_email_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="user_email" class="col-sm-4 control-label">
    E-mail
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Adresse e-mail"></span>
  </label>
  <div class="col-sm-8">
    <input type="email" class="form-control" id="user_email" name="user_email" aria-describedby="user-email-error" placeholder="E-mail" minlength='4' email='true' value="<?php echo htmlentities($user_email);?>" data-minlength="10" />
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='user-email-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>


<div class="form-group form-group-sm">
  <label for="attached_section" class="col-sm-4 control-label">Antenne</label>
  <div class="col-sm-8">
    <select class="form-control" id="attached_section" name="attached_section">
      <?php
        $reqliste = "SELECT number, name FROM $tablename_sections" or die("Erreur lors de la consultation" . mysqli_error($db_link));
        $sections = mysqli_query($db_link, $reqliste);
        while($section = mysqli_fetch_array($sections)) {
          echo "<option value='".$section["number"]."'".(($section["number"] == $user_section) ? "selected='true'" : "").">".htmlentities($section["name"])."</option>";
        }
      ?>
    </select>
  </div>
</div>
