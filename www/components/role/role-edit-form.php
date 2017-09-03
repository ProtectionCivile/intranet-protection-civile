<form class="form-horizontal" id="auto-validation-form" action='' role="form" method='post' accept-charset='utf-8'>
  <input type="hidden" id="wish" name="updateRole" />
  <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />

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

  <?php $feedback = compute_server_feedback($role_phone_error);?>
  <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
    <label for="role_phone" class="col-sm-4 control-label">
      Téléphone
      <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Format 0XXXXXXXXX"></span>
    </label>
    <div class="col-sm-8">
      <input type="tel" class="form-control" id="role_phone" name="role_phone" aria-describedby="role-phone-error" placeholder="Télephone de fonction" minlength='10' maxlength='10' digits='true' value="<?php echo htmlentities($role_phone);?>" data-minlength="10" >
      <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
      <span id='role-phone-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
    </div>
  </div>

  <?php $feedback = compute_server_feedback($role_email_error);?>
  <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
    <label for="role_email" class="col-sm-4 control-label">
      E-mail
      <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Adresse mail propre à la fonction"></span>
    </label>
    <div class="col-sm-8">
      <input type="email" class="form-control" id="role_email" name="role_email" aria-describedby="role-email-error" placeholder="E-mail de fonction" minlength='4' email='true' value="<?php echo htmlentities($role_email);?>" data-minlength="10" />
      <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
      <span id='role-email-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
    </div>
  </div>

  <?php $feedback = compute_server_feedback($role_callsign_error);?>
  <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
    <label for="role_callsign" class="col-sm-4 control-label">
      Indicatif radio
      <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Indicatif radio uniquement si applicable" />
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="role_callsign" name="role_callsign" aria-describedby="role-callsign-error" placeholder="OPE 92 Alpha" minlength='3' maxlength='120' value="<?php echo htmlentities($role_callsign);?>" />
      <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
      <span id='role-callsign-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
    </div>
  </div>

  <?php $feedback = compute_server_feedback($role_assignable_error);?>
  <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
    <label for="role_assignable" class="col-sm-4 control-label">
      Assignable à un utilisateur
      <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Est-ce que ce rôle peut être affecté à un utilisateur?"></span>
    </label>
    <div class="col-sm-8 checkbox">
      <input type="checkbox" id="role_assignable" name="role_assignable" aria-describedby="role-assignable-error" <?php if ($role_assignable) echo "checked"; ?> />
      <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
      <span id='role-assignable-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
    </div>
  </div>

  <?php $feedback = compute_server_feedback($role_directory_error);?>
  <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
    <label for="role_directory" class="col-sm-4 control-label">
      Apparaît dans annuaire
      <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Est-ce que ce rôle apparaît daans les annuaires ?"></span>
    </label>
    <div class="col-sm-8 checkbox">
      <input type="checkbox" id="role_directory" name="role_directory" aria-describedby="role-directory-error" <?php if ($role_directory) echo "checked"; ?> />
      <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
      <span id='role-directory-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
    </div>
  </div>

  <?php $feedback = compute_server_feedback($role_hierarchy_error);?>
  <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
    <label for="role_hierarchy" class="col-sm-4 control-label">
      Hiérrchie annuaire
      <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Un nombre entier. Plus il est élevé, plus le rôle apparaîtra bas dans l'annuaire."></span>
    </label>
    <div class="col-sm-8">
      <input type="number" class="form-control" id="role_hierarchy" name="role_hierarchy" aria-describedby="role-hierarchy-error" placeholder="10" minlength='1' maxlength='4' digits='true' value="<?php echo htmlentities($role_hierarchy);?>"data-minlength="1">
      <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
      <span id='role-hierarchy-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
    </div>
  </div>

  <?php $feedback = compute_server_feedback($role_tags_error);?>
  <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
    <label for="role_tags" class="col-sm-4 control-label">
      Tags annuaire
      <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Tags, séparés par des '|' qui servent à regrouper les rôles lors de la production de l'annuaire"></span>
    </label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="role_tags" name="role_tags" aria-describedby="role-tags-error" placeholder="Opérationnel|Bureau"  required='false' value="<?php echo htmlentities($role_tags);?>" >
      <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
      <span id='role-adress-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
    </div>
  </div>

  <div class="form-group form-group-sm">
    <label for="attached_section" class="col-sm-4 control-label">Antenne de rattachement</label>
    <div class="col-sm-8">
      <select class="form-control" id="attached_section" name="attached_section">
        <?php
          $reqliste = "SELECT number, name FROM $tablename_sections" or die("Erreur lors de la consultation" . mysqli_error($db_link));
          $sections = mysqli_query($db_link, $reqliste);
          while($section = mysqli_fetch_array($sections)) {
            echo "<option value='".$section["number"]."'".(($section["number"] == $attached_section) ? "selected='true'" : "").">".htmlentities($section["name"])."</option>";
          }
        ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <?php if (empty($genericSuccess)){ ?>
        <a class="btn btn-default" href="role-list.php" role="button">Annuler - Retour à la liste</a>
      <?php } ?>
      <button type="submit" class="btn btn-success" id='submitAddRoleForm'>Mettre à jour</button>
      <?php if (isset($_POST['updateRole']) && !empty($genericSuccess)) { ?>
        <a class="btn btn-default" href="role-list.php" role="button">J'ai terminé ! Retour à la liste</a>
      <?php } ?>
     </div>
  </div>
</form>

<!-- CAUTION : DO NOT FORGET TO CALL VALIDATION FORM AT PAGE ENDING -->
