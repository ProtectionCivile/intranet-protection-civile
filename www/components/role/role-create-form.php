<form class="form-horizontal" id="auto-validation-form" action='' role="form" method='post' accept-charset='utf-8'>
  <input type="hidden" id="wish" name="addRole" />

  <?php $feedback = compute_server_feedback($role_title_error);?>
  <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
    <label for="role_title" class="col-sm-4 control-label">
      Titre
      <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Nom court"></span>
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="role_title" name="role_title" aria-describedby="role-title-error" placeholder="DLO Asnières" minlength='3' maxlength='120' required='true' value="<?php echo htmlentities($role_title);?>" >
      <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
      <span id='role-title-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
    </div>
  </div>

  <?php $feedback = compute_server_feedback($role_description_error);?>
  <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
    <label for="role_description" class="col-sm-4 control-label">
      Desription
      <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom long" />
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="role_description" name="role_description" aria-describedby="role-description-error" placeholder="Directeur Local des Opérations d'Asnières" minlength='3' maxlength='120' required='true' value="<?php echo htmlentities($role_description);?>" />
      <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
      <span id='role-description-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <?php if (empty($genericSuccess)){ ?>
        <a class="btn btn-default" href="role-list.php" role="button">Annuler - Retour à la liste</a>
      <?php } ?>
      <button type="submit" class="btn btn-success" id='submitAddRoleForm'>Créer</button>
      <?php if (isset($_POST['addRole']) && !empty($genericSuccess)) { ?>
        <a class="btn btn-success" href="role-edit.php?id=<?php echo $id; ?>" role="button">Ajouter des infos au rôle</a>
        <a class="btn btn-default" href="role-list.php" role="button">J'ai terminé ! Retour à la liste</a>
      <?php } ?>
     </div>
  </div>
</form>

<!-- CAUTION : DO NOT FORGET TO CALL VALIDATION FORM AT PAGE ENDING -->
