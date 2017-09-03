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
