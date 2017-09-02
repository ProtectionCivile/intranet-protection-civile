<form class="form-horizontal" id="auto-validation-form" action='' role="form" method='post' accept-charset='utf-8'>
  <input type="hidden" id="wish" name="updatePassword" />
  <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />

  <?php require_once('user-edit-form-password-part.php'); ?>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <?php if (empty($genericSuccess)){ ?>
        <a class="btn btn-default" href="user-list.php" role="button">Annuler - Retour à la liste</a>
      <?php } ?>
      <button type="submit" class="btn btn-success" id='submitAddClientForm'>Mettre à jour</button>
      <?php if (isset($_POST['updateUser']) && !empty($genericSuccess)) { ?>
        <a class="btn btn-default" href="user-list.php" role="button">J'ai terminé ! Retour à la liste</a>
      <?php } ?>
     </div>
  </div>
</form>

<!-- CAUTION : DO NOT FORGET TO CALL VALIDATION FORM AT PAGE ENDING -->
