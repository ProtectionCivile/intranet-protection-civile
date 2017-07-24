<form class="form-horizontal" id='auto-validation-form' name='auto-validation-form' data-toggle="validator" role="form" action="" method="post">
  <input type='hidden' name='create'/>
  <input type='hidden' name='cu_full' value='<?php echo $cu_full;?>' />
  <input type='hidden' name='section' value='<?php echo $city;?>'/>

  <!-- Form to create or edit a DPS : client part -->
  <?php require_once('components/dps/dps-edit-form-client-panel.php'); ?>

  <!-- Form to create or edit a DPS : event part -->
  <?php require_once('components/dps/dps-edit-form-event-panel.php'); ?>

  <!-- Form to create or edit a DPS : dps part -->
  <?php require_once('components/dps/dps-edit-form-dps-panel.php'); ?>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8 ">
      <button type="submit" class="btn btn-warning">Envoyer <span class="glyphicon glyphicon-send"></span></button>
    </div>
  </div>
</form>

<!-- CAUTION : DO NOT FORGET TO CALL VALIDATION FORM AT PAGE ENDING -->
