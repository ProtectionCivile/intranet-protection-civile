<div class="panel panel-primary">
  <div class="panel-heading">
    <button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#orga-panel-filter" aria-expanded='true' aria-controls="orga-panel-filter">
      <span aria-hidden="true" >Montrer/Cacher</span>
    </button>
    <h3 class="panel-title">Organisateur</h3>
  </div>

  <div id='orga-panel-filter' aria-expanded='true' class="panel-body in">
    <?php $feedback = compute_server_feedback($client_name_error);?>
    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
      <label for="client_name" class="col-sm-4 control-label">
        Nom de l'organisation
        <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom de la société, association, collectivité, etc." />
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="client_name" name="client_name" aria-describedby="client-name-error" placeholder="Nom de l'organisation" minlength='8' required='true' value="<?php echo $client_name;?>" />
        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
        <span id='client-name-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
      </div>
    </div>

    <?php $feedback = compute_server_feedback($client_represent_error);?>
    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
      <label for="client_represent" class="col-sm-4 control-label">
        Représenté par
        <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Personne qui représente l'organisation."></span>
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="client_represent" name="client_represent" aria-describedby="client-represent-error" placeholder="Représentant" minlength='4' required='true' value="<?php echo $client_represent;?>" />
        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
        <span id='client-represent-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
      </div>
    </div>

    <?php $feedback = compute_server_feedback($client_title_error);?>
    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
      <label for="client_title" class="col-sm-4 control-label">
        Qualité
        <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Statut du représentant."></span>
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="client_title" name="client_title" aria-describedby="client-title-error" placeholder="Qualité" minlength='4' required='true' value="<?php echo $client_title;?>" >
        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
        <span id='client-title-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
      </div>
    </div>

    <?php $feedback = compute_server_feedback($client_address_error);?>
    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
      <label for="client_address" class="col-sm-4 control-label">
        Adresse postale
        <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Adresse, code postal, ville."></span>
      </label>
      <div class="col-sm-8">
        <input type="text" class="form-control" id="client_address" name="client_address" aria-describedby="client-address-error" placeholder="Adresse" minlength='20' required='true' value="<?php echo $client_address;?>" data-minlength="6" >
        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
        <span id='client-adress-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
      </div>
    </div>

    <?php $feedback = compute_server_feedback($client_phone_error);?>
    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
      <label for="client_phone" class="col-sm-4 control-label">
        Téléphone
        <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Format 0XXXXXXXXX"></span>
      </label>
      <div class="col-sm-8">
        <input type="tel" class="form-control" id="client_phone" name="client_phone" aria-describedby="client-phone-error" placeholder="telephone" minlength='10' maxlength='10' required='true' digits='true' value="<?php echo $client_phone;?>" data-minlength="10" >
        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
        <span id='client-phone-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
      </div>
    </div>

    <?php $feedback = compute_server_feedback($client_fax_error);?>
    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
      <label for="client_fax" class="col-sm-4 control-label">
        Fax
        <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Format 0XXXXXXXXX"></span>
      </label>
      <div class="col-sm-8">
        <input type="tel" class="form-control" id="client_fax" name="client_fax" aria-describedby="client-fax-error" placeholder="Fax" minlength='10' maxlength='10' digits='true' value="<?php echo $client_fax;?>"data-minlength="10">
        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
        <span id='client-fax-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
      </div>
    </div>

    <?php $feedback = compute_server_feedback($client_email_error);?>
    <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
      <label for="client_email" class="col-sm-4 control-label">
        E-mail
        <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Adresse e-mail du représentant ou de l'organisation."></span>
      </label>
      <div class="col-sm-8">
        <input type="email" class="form-control" id="client_email" name="client_email" aria-describedby="client-email-error" placeholder="E-mail" minlength='4' email='true' value="<?php echo $client_email;?>" data-minlength="10" />
        <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
        <span id='client-email-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
      </div>
    </div>


  </div>
</div>
