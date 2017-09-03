<?php $feedback = compute_server_feedback($name_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="name" class="col-sm-4 control-label">
    Nom du paramètre
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom du paramètre" />
  </label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id="name" name="name" aria-describedby="name-error" placeholder="ex: mail-generique-adpc" minlength='3' maxlength='120' required='true' value="<?php echo htmlentities($name) ?>">
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='name-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<?php $feedback = compute_server_feedback($value_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="value" class="col-sm-4 control-label">
    Valeur du paramètre
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Valeur textuelle du paramètre" />
  </label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id="value" name="value" aria-describedby="value-error" minlength='3' maxlength='400' required='false' placeholder="Valeur du paramètre" value="<?php echo htmlentities($value);?>" />
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='value-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>
