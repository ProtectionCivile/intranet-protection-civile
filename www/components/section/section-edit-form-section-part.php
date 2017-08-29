<?php $feedback = compute_server_feedback($section_name_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="section_name" class="col-sm-4 control-label">
    Nom de l'antenne
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom de l'antenne au complet" />
  </label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id='section_name' name='section_name' minlength='3' maxlength='50' required='true' aria-describedby="section-name-error" value='<?php echo $section_name; ?>'>
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='section-name-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<?php $feedback = compute_server_feedback($section_shortname_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="section_shortname" class="col-sm-4 control-label">
    Nom court
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Un nom court qui vous permettra de sélectionner ce section lors de la création d'un DPS." />
  </label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id="section_shortname" name="section_shortname" aria-describedby="section-shortname-error" placeholder="Un nom court qui vous permettra de sélectionner cette antenne dans les filtres" minlength='3' maxlength='3' required='true' value="<?php echo $section_shortname;?>" />
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='section-shortname-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<?php $feedback = compute_server_feedback($section_number_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="section_number" class="col-sm-4 control-label">
    Numéro interne
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Numéro INSEE."></span>
  </label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id="section_number" name="section_number" aria-describedby="section-number-error" placeholder="12" minlength='1' maxlength='2' digits='true' required='true' value="<?php echo $section_number;?>" />
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='section-number-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<?php $feedback = compute_server_feedback($section_address_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="section_address" class="col-sm-4 control-label">
    Adresse postale
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Adresse, code postal, ville."></span>
  </label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id="section_address" name="section_address" aria-describedby="section-address-error" placeholder="13 rue de la Poupée qui Tousse, 92230 Gennevilliers" minlength='5' value="<?php echo $section_address;?>" data-minlength="5" >
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='section-adress-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<?php $feedback = compute_server_feedback($section_zipcode_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="section_zipcode" class="col-sm-4 control-label">
    Code postal
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Format 92400"></span>
  </label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id="section_zipcode" name="section_zipcode" aria-describedby="section-zipcode-error" minlength='5' maxlength='5' digits='true' placeholder="92400" minlength='10' value="<?php echo $section_zipcode;?>" data-minlength="5">
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='section-zipcode-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<?php $feedback = compute_server_feedback($section_city_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="section_city" class="col-sm-4 control-label">
    Ville
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Ville"></span>
  </label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id="section_city" name="section_city" aria-describedby="section-city-error" placeholder="Clamart-Plage" minlength='3' maxlength='40' value="<?php echo $section_city;?>" >
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='section-city-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<?php $feedback = compute_server_feedback($section_phone_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="section_phone" class="col-sm-4 control-label">
    Téléphone de contact
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Format 0XXXXXXXXX"></span>
  </label>
  <div class="col-sm-8">
    <input type="tel" class="form-control" id="section_phone" name="section_phone" aria-describedby="section-phone-error" placeholder="telephone" minlength='10' maxlength='10' digits='true' value="<?php echo $section_phone;?>" data-minlength="10" >
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='section-phone-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<?php $feedback = compute_server_feedback($section_email_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="section_email" class="col-sm-4 control-label">
    Adresse mail de contact
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Adresse e-mail"></span>
  </label>
  <div class="col-sm-8">
    <input type="email" class="form-control" id="section_email" name="section_email" aria-describedby="section-email-error" placeholder="E-mail" minlength='4' email='true' value="<?php echo $section_email;?>" data-minlength="10" />
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='section-email-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<?php $feedback = compute_server_feedback($section_website_error);?>
<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
  <label for="section_website" class="col-sm-4 control-label">
    Site internet
    <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Ne pas oublier le http devant"></span>
  </label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id="section_website" name="section_website" aria-describedby="section-website-error" placeholder="http://antenne.protectioncivile92.org" minlength='1' maxlength='80' url='true' value="<?php echo $section_website;?>" data-minlength="1" >
    <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
    <span id='section-website-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
  </div>
</div>

<div class="form-group form-group-sm">
  <label for="attached_section" class="col-sm-4 control-label">Antenne de rattachement</label>
  <div class="col-sm-8">
    <select class="form-control" id="attached_section" name="attached_section">
      <?php
        $reqliste = "SELECT number, name FROM $tablename_sections" or die("Erreur lors de la consultation" . mysqli_error($db_link));
        $sections = mysqli_query($db_link, $reqliste);
        while($sectionX = mysqli_fetch_array($sections)) {
          if ($sectionX['number'] == $attached_section){
            echo "<option value='".$sectionX['number']."' selected>".$sectionX['name']."</option>";
          }
          else {
            echo "<option value='".$sectionX['number']."'>".$sectionX['name']."</option>";
          }
        }
      ?>
    </select>
  </div>
</div>
