<form class="form-horizontal" id="auto-validation-form" action='' role="form" method='post' accept-charset='utf-8'>
  <input type="hidden" id="wish" name="updatePermission" />
  <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />

  <?php $feedback = compute_server_feedback($permission_title_error);?>
  <div class="form-group form-group-sm required has-feedback <?php echo $feedback[0];?>">
    <label for="permission_title" class="col-sm-4 control-label">
      Titre
      <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Nom court"></span>
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="permission_title" name="permission_title" aria-describedby="permission-title-error" placeholder="ex: dps-view" minlength='3' maxlength='120' required='true' value="<?php echo htmlentities($permission_title);?>" >
      <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
      <span id='permission-title-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
    </div>
  </div>

  <?php $feedback = compute_server_feedback($permission_description_error);?>
  <div class="form-group form-group-sm required has-feedback <?php echo $feedback[0];?>">
    <label for="permission_description" class="col-sm-4 control-label">
      Description
      <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom d'affichage des permissions" />
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="permission_description" name="permission_description" aria-describedby="permission-description-error" placeholder="ex: Visualiser DPS" minlength='3' maxlength='120' required='true' value="<?php echo htmlentities($permission_description);?>" />
      <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
      <span id='permission-description-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <?php if (empty($genericSuccess)){ ?>
        <a class="btn btn-default" href="permission-list.php" role="button">Annuler - Retour à la liste</a>
      <?php } ?>
      <button type="submit" class="btn btn-success" id='submitAddPermissionForm'>Mettre à jour</button>
      <?php if (isset($_POST['updatePermission']) && !empty($genericSuccess)) { ?>
        <a class="btn btn-default" href="permission-list.php" role="button">J'ai terminé ! Retour à la liste</a>
      <?php } ?>
     </div>
  </div>
</form>

<!-- CAUTION : DO NOT FORGET TO CALL VALIDATION FORM AT PAGE ENDING -->
