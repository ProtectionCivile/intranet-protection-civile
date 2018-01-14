<form class="form-horizontal" id="auto-validation-form" action='' role="form" method='post' accept-charset='utf-8'>
  <input type="hidden" id="wish" name="addPermissionPath" />

  <?php $feedback = compute_server_feedback($permission_title_path_error);?>
  <div class="form-group form-group-sm required has-feedback <?php echo $feedback[0];?>">
    <label for="permission_title_path" class="col-sm-4 control-label">
      Chemin
      <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Chemin pour créer des permissions enchaînées"></span>
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="permission_title_path" name="permission_title_path" aria-describedby="permission-title-path-error" placeholder="ex: edit-dps/view-dps" minlength='3' maxlength='120' required='true' value="<?php echo htmlentities($permission_title_path);?>" >
      <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
      <span id='permission-title-path-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
    </div>
  </div>

  <?php $feedback = compute_server_feedback($permission_description_path_error);?>
  <div class="form-group form-group-sm required has-feedback <?php echo $feedback[0];?>">
    <label for="permission_description_path" class="col-sm-4 control-label">
      Description
      <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Noms d'affichage des permissions" />
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="permission_description_path" name="permission_description_path" aria-describedby="permission-description-path-error" placeholder="Description 1/Description 2/ Description 3..." minlength='3' maxlength='255' required='true' value="<?php echo htmlentities($permission_description_path);?>" />
      <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
      <span id='permission-description-path-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button type="submit" class="btn btn-success">Créer</button>
     </div>
  </div>
</form>

<!-- CAUTION : DO NOT FORGET TO CALL VALIDATION FORM AT PAGE ENDING -->
