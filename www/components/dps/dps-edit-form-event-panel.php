<div class="panel panel-primary">
  <div class="panel-heading">
    <button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#manif-panel-filter" aria-expanded='true' aria-controls="manif-panel-filter">
      <span aria-hidden="true" >Montrer/Cacher</span>
    </button>
    <h3 class="panel-title">Évènement</h3>
  </div>

  <div id='manif-panel-filter' class="panel-body in">

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Nature de la manifestation</h3>
      </div>
      <div class="panel-body">

        <?php $feedback = compute_server_feedback($event_name_error);?>
        <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
          <label for="event_name" class="col-sm-4 control-label">
            Nom / Nature
            <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom/Nature de la manifestation"></span>
          </label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="event_name" name="event_name" aria-describedby="event-name-error" minlength='5' required='true' placeholder="Nom / Nature" value="<?php echo $event_name; ?>" data-minlength="10" >
            <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
            <span id='event-name-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
          </div>
        </div>

        <?php $feedback = compute_server_feedback($event_description_error);?>
        <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
          <label for="event_description" class="col-sm-4 control-label">
            Activité / Descriptif
            <span class="glyphicon glyphicon-info-sign" data-trigger="hover" rel="popover" data-toggle="popover" data-content="Descriptif court."></span>
          </label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="event_description" name="event_description" aria-describedby="event-description-error" minlength='5' required='true' placeholder="Activité / Descriptif" value="<?php echo $event_description; ?>" data-minlength="10" >
            <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
            <span id='event-description-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
          </div>
        </div>

        <?php $feedback = compute_server_feedback($event_address_error);?>
        <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
          <label for="event_address" class="col-sm-4 control-label">
            Lieu précis avec adresse exacte
            <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Adresse la plus précise possible du lieu de l'événement."></span>
          </label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="event_address" name="event_address" aria-describedby="event-address-error" minlength='10' required='true' placeholder="Adresse précise du lien de l'évenement" value="<?php echo $event_address; ?>" data-minlength="10" >
            <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
            <span id='event-address-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
          </div>
        </div>

        <?php $feedback = compute_server_feedback($event_department_error);?>
        <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
          <label for="event_department" class="col-sm-4 control-label">
            Département où se situe la manifestation
            <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Exemple : 92"></span>
          </label>
          <div class="col-sm-2">
            <input type="number" class="form-control" id="event_department" name="event_department" aria-describedby="event-department-error" minlength='2' maxlength='3' required='true' digits='true' placeholder="92" value="<?php echo $event_department; ?>" data-minlength="10" >
            <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
            <span id='event-department-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
          </div>
        </div>

        <div class="form-group form-group-sm form-inline row datetimestart">
          <label for="event_begin_date_picker" class="col-sm-4 control-label">Date et heure du début de l'évènement</label>
          <div class="col-sm-3">
            <div class='input-group date' id='event_begin_date_picker' name="event_begin_date_picker">
              <input type='text' class="form-control" id='event_begin_date' name="event_begin_date" aria-describedby="event-begin-date-error" required='true' value="<?php echo $event_begin_date; ?>" / >
              <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </div>
            <span id='event-begin-date-error' class="help-block" aria-hidden="true"></span>
          </div>
          <div class="col-sm-3">
            <div class='input-group date' id='event_begin_time_picker' name="event_begin_time_picker">
              <input type='text' class="form-control" id='event_begin_time' name="event_begin_time" required='true' aria-describedby="event-begin-time-error" value="<?php echo $event_begin_time; ?>" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
              </span>
            </div>
            <span id='event-begin-time-error' class="help-block" aria-hidden="true"></span>
          </div>
        </div>

        <div class="form-group form-group-sm form-inline row">
          <label for="event_end_date_picker" class="col-sm-4 control-label">Date et heure de fin de l'évènement</label>
          <div class="col-sm-3">
            <div class='input-group date' id='event_end_date_picker' name="event_end_date_picker">
              <input type='text' class="form-control" id='event_end_date' name="event_end_date" required='true' aria-describedby="event-end-date-error" value="<?php echo $event_end_date; ?>" />
              <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </div>
            <span id='event-end-date-error' class="help-block" aria-hidden="true"></span>
          </div>
          <div class="col-sm-3">
            <div class='input-group date' id='event_end_time_picker' name="event_end_time_picker" >
              <input type='text' class="form-control" id='event_end_time' name="event_end_time" required='true' aria-describedby="event-end-time-error" value="<?php echo $event_end_time; ?>"/>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
              </span>
            </div>
            <span id='event-end-time-error' class="help-block" aria-hidden="true"></span>
          </div>
        </div>


        <div class="form-group form-group-sm">
          <?php $feedback = compute_server_feedback($event_pref_secu_error);?>
          <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
            <label for="event_pref_secu" class="col-sm-4 control-label">
              Dossier déjà déposé en préfecture ?
            </label>
            <div class="col-sm-2">
              <select class="form-control" name="event_pref_secu" id="event_pref_secu" aria-describedby="event-pref-secu-error" >
                <option value="0">Non</option>
                <option value="1" <?php if ($event_pref_secu) {echo 'selected';}?> >Oui</option>
              </select>
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='event-pref-secu-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">
          Évaluation du risque
          <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Permet le calcul de la grille des risques."></span>
        </h3>
      </div>
      <div class="panel-body">

        <?php $feedback = compute_server_feedback($ris_p1_public_error);?>
        <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
          <label for="ris_p1_public" class="col-sm-4 control-label">
            Nombre de spectateurs
            <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Chiffres uniquement"></span>
          </label>
          <div class="col-sm-8">
            <input type="digits" class="form-control risp" id="ris_p1_public" name="ris_p1_public" aria-describedby="ris-p1-public-error" required='true' digits='true' placeholder="Spectateurs" value="<?php echo $ris_p1_public; ?>" >
            <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
            <span id='ris-p1-public-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
          </div>
        </div>

        <?php $feedback = compute_server_feedback($ris_p1_actors_error);?>
        <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
          <label for="ris_p1_actors" class="col-sm-4 control-label">
            Nombre de participants
            <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Chiffres uniquement."></span>
          </label>
          <div class="col-sm-8">
            <input type="number" class="form-control risp" id="ris_p1_actors" name="ris_p1_actors" aria-describedby="ris-p1-actors-error" required='true' digits='true' placeholder="Participants" value="<?php echo $ris_p1_actors; ?>" >
            <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
            <span id='ris-p1-actors-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
          </div>
        </div>

        <?php $feedback = compute_server_feedback($ris_p2_error);?>
        <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
          <label for="ris_p2" class="col-sm-4 control-label">Activité du rassemblement </label>
          <div class="col-sm-8">
            <select class="form-control risi" id="ris_p2" name="ris_p2" aria-describedby="ris-p2-error" >
							<?php
							include ('functions/dps/dps-query-select-parameters.php');
							$parameters = get_select_parameters($parameters_query_result, 'ris_p2');
							 foreach ($parameters as $key => $value) {
								?>
								<option value="<?php echo $value['option_value']; ?>" <?php if ($ris_p2 == $value['option_value']) {echo 'selected';} ?> ><?php echo $value['option_text']; ?> </option>
								<?php
							}
							?>
            </select>
            <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
            <span id='ris-p2-error' class="help-block" aria-hidden="true">Niveau de risque (P2)</span>
          </div>
        </div>

        <?php $feedback = compute_server_feedback($ris_e1_error);?>
        <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
          <label for="ris_e1" class="col-sm-4 control-label">Environnement et accessibilité</label>
          <div class="col-sm-8">
            <select class="form-control risi" id="ris_e1" name="ris_e1" aria-describedby="ris-e1-error" >
              <option value="1" <?php if ($ris_e1 == '1') {echo 'selected';}?>>Faible (Structure permanente, voies publiques, etc.)</option>
              <option value="2" <?php if ($ris_e1 == '2') {echo 'selected';}?>>Modéré (Gradins, tribunes, mois de 2 hectares, etc.)</option>
              <option value="3" <?php if ($ris_e1 == '3') {echo 'selected';}?>>Moyen (Entre 2 et 5 hectares, autres conditions, etc.)</option>
              <option value="4" <?php if ($ris_e1 == '4') {echo 'selected';}?>>Elevé (Brancardage > 600m, pas d'accès VPSP, etc.)</option>
            </select>
            <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
            <span id='ris-e1-error' class="help-block" aria-hidden="true">Caractéristiques de l'environnement et accessibilité du site (E1)</span>
            <div id="e1"></div>
          </div>
        </div>

        <?php $feedback = compute_server_feedback($ris_e2_error);?>
        <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
          <label for="ris_e2" class="col-sm-4 control-label">Délai d'intervention des secours publics</label>
          <div class="col-sm-8">
            <select class="form-control risi" id="ris_e2" name="ris_e2" aria-describedby="ris-e2-error" >
              <option value="1" <?php if ($ris_e2 == '1') {echo 'selected';}?>>Faible (Moins de 10 minutes)</option>
              <option value="2" <?php if ($ris_e2 == '2') {echo 'selected';}?>>Modéré (Entre 10 et 20 minutes)</option>
              <option value="3" <?php if ($ris_e2 == '3') {echo 'selected';}?>>Moyen (Entre 20 et 30 minutes)</option>
              <option value="4" <?php if ($ris_e2 == '4') {echo 'selected';}?>>Elevé (Plus de 30 minutes)</option>
            </select>
            <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
            <span id='ris-e2-error' class="help-block" aria-hidden="true">Délai d'intervention (E2)</span>
          </div>
        </div>


        <div class="alert " id="resultatris" role="alert">
          <h4>Grille d'évaluation des risques</h4>
          <p>Classification du type de poste : <strong><span id="typeposte"></span></strong><br>
          Nombre de secouristes : <strong><span id="nbsec"></span></strong></p>
          <p id="grosris">
            <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
            <strong> Attention !</strong> Ce type de poste impose un contact avec la DDO.
          </p>
        </div>

        <?php $feedback = compute_server_feedback($ris_comment_error);?>
        <label for="ris_comment">Commentaires concernant le RIS</label>
        <textarea class="form-control" rows="4" id="ris_comment" name="ris_comment" placeholder="Indiquer ici tout commentaire(s) concernant le RIS" ><?php echo $ris_comment; ?></textarea>
        <span class="help-block"></span>

      </div>
    </div>

  </div>
</div>
