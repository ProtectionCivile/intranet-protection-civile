<div class="panel panel-primary">
  <div class="panel-heading">
    <button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#dps-panel-filter" aria-controls="dps-panel-filter">
      <span aria-hidden="true" >Montrer/Cacher</span>
    </button>
    <h3 class="panel-title">Dispositif Prévisionnel de Secours mis en place</h3>
  </div>

  <div id='dps-panel-filter' aria-expanded='true' class="panel-body in">

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Horaires de mise en place du dispositif</h3>
      </div>
      <div class="panel-body">

        <div class="form-group form-group-sm form-inline row datetimestart">
          <label for="dps_begin_date_div" class="col-sm-4 control-label">Date et heure de début de poste</label>
          <div class="col-sm-3">
            <div class='input-group date' id='dps_begin_date_div' name="dps_begin_date_div">
              <input type='text' class="form-control" id='dps_begin_date' name="dps_begin_date" aria-describedby="dps-begin-date-error" required='true' value="<?php echo $dps_begin_date; ?>" / >
              <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </div>
            <span id='dps-begin-date-error' class="help-block" aria-hidden="true"></span>
          </div>
          <div class="col-sm-3">
            <div class='input-group date' id='dps_begin_time_div' name="dps_begin_time_div">
              <input type='text' class="form-control" id='dps_begin_time' name="dps_begin_time" required='true' aria-describedby="dps-begin-time-error" value="<?php echo $dps_begin_time; ?>" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
              </span>
            </div>
            <span id='dps-begin-time-error' class="help-block" aria-hidden="true"></span>
          </div>
          <script type="text/javascript">
            $(function () {
              $('#dps_begin_date_div').datetimepicker({
                locale: 'fr',
                format: 'DD-MM-YYYY',
                showClear:true,
                showClose:true,
                toolbarPlacement: 'bottom',
              });
            });
            $(function () {
              $('#dps_begin_time_div').datetimepicker({
                locale: 'fr',
                format: 'HH:mm',
                showClear:true,
                showClose:true,
                toolbarPlacement: 'bottom',
                useCurrent:false,
                stepping:'15'
              });
            });
          </script>
        </div>

        <div class="form-group form-group-sm form-inline row">
          <label for="dps_end_date_div" class="col-sm-4 control-label">Date et heure de fin de poste</label>
          <div class="col-sm-3">
            <div class='input-group date' id='dps_end_date_div' name="dps_end_date_div">
              <input type='text' class="form-control" id='dps_end_date' name="dps_end_date" required='true' aria-describedby="dps-end-date-error" value="<?php echo $dps_end_date; ?>" />
              <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </div>
            <span id='dps-end-date-error' class="help-block" aria-hidden="true"></span>
          </div>
          <div class="col-sm-3">
            <div class='input-group date' id='dps_end_time_div' name="dps_end_time_div" >
              <input type='text' class="form-control" id='dps_end_time' name="dps_end_time" required='true' aria-describedby="dps-end-time-error" value="<?php echo $dps_end_time; ?>"/>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
              </span>
            </div>
            <span id='dps-end-time-error' class="help-block" aria-hidden="true"></span>
          </div>
          <script type="text/javascript">
            $(function () {
              $('#dps_end_date_div').datetimepicker({
                locale: 'fr',
                format: 'DD-MM-YYYY',
                showClear:true,
                showClose:true,
                toolbarPlacement: 'bottom'

              });
            });
            $(function () {
              $('#dps_end_time_div').datetimepicker({
                locale: 'fr',
                format: 'HH:mm',
                showClear:true,
                showClose:true,
                toolbarPlacement: 'bottom',
                useCurrent:false,
                stepping:'15'

              });
            });
          </script>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Moyens fournis par la Protection Civile <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Permet la comparaison avec la grille des risques."></span></h3>
      </div>
      <div class="panel-body">

        <div class="form-group form-group-sm">
          <?php $feedback = compute_server_feedback($dps_nb_ce_error);?>
          <label for="dps_nb_ce" class="col-sm-4 control-label">Chef d'équipe / de poste</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="dps_nb_ce" name="dps_nb_ce" aria-describedby="nb-ce-error" required='true' digits='true' placeholder="00" value="<?php echo $dps_nb_ce; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='nb-ce-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>
          <?php $feedback = compute_server_feedback($dps_nb_pse2_error);?>
          <label for="dps_nb_pse2" class="col-sm-3 control-label">Équipier secouriste PSE-2</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="dps_nb_pse2" name="dps_nb_pse2" aria-describedby="dps-nb-pse2-error" required='true' digits='true' placeholder="00" value="<?php echo $dps_nb_pse2; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='dps-nb-pse2-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>
          <?php $feedback = compute_server_feedback($dps_nb_pse1_error);?>
          <label for="dps_nb_pse1" class="col-sm-4 control-label">Secouriste PSE-1</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="dps_nb_pse1" name="dps_nb_pse1" aria-describedby="dps-nb-pse1-error" required='true' digits='true' placeholder="00" value="<?php echo $dps_nb_pse1; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='dps-nb-pse1-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>
          <?php $feedback = compute_server_feedback($dps_nb_psc1_error);?>
          <label for="dps_nb_psc1" class="col-sm-3 control-label">Stagiaire PSC-1</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="dps_nb_psc1" name="dps_nb_psc1" aria-describedby="dps-nb-psc1-error" required='false' disabled='true' digits='true' placeholder="00" value="<?php echo $dps_nb_psc1; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='dps-nb-psc1-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>
        </div>
      </div>

      <div class="panel-body">

        <div class="form-group form-group-sm">
          <?php $feedback = compute_server_feedback($dps_nb_lot_a_error);?>
          <label for="dps_nb_lot_a" class="col-sm-4 control-label">Lot A</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="dps_nb_lot_a" name="dps_nb_lot_a" aria-describedby="nb-lot-a-error" required='true' digits='true' placeholder="00" value="<?php echo $dps_nb_lot_a; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='nb-lot_a-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>
          <?php $feedback = compute_server_feedback($dps_nb_lot_b_error);?>
          <label for="dps_nb_lot_b" class="col-sm-3 control-label">Lot B</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="dps_nb_lot_b" name="dps_nb_lot_b" aria-describedby="dps-nb-lot-b-error" required='true' digits='true' placeholder="00" value="<?php echo $dps_nb_lot_b; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='dps-nb-lot-b-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>
          <?php $feedback = compute_server_feedback($dps_nb_lot_c_error);?>
          <label for="dps_nb_lot_c" class="col-sm-4 control-label">Lot C</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="dps_nb_lot_c" name="dps_nb_lot_c" aria-describedby="dps-nb-lot-c-error" required='true' digits='true' placeholder="00" value="<?php echo $dps_nb_lot_c; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='dps-nb-lot-c-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>
          <?php $feedback = compute_server_feedback($dps_nb_dae_error);?>
          <label for="dps_nb_dae" class="col-sm-3 control-label">DAE</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="dps_nb_dae" name="dps_nb_dae" aria-describedby="dps-nb-dae-error" required='true' digits='true' placeholder="00" value="<?php echo $dps_nb_dae; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='dps-nb-dae-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>
        </div>
      </div>

      <div class="panel-body">

        <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
          <?php $feedback = compute_server_feedback($dps_nb_vpsp_transp_error);?>
          <label for="dps_nb_vpsp_transp" class="col-sm-4 control-label">VPSP Transport (évacuation)</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="dps_nb_vpsp_transp" name="dps_nb_vpsp_transp" aria-describedby="dps-nb-vpsp-transp-error" min='0' required='true' digits='true' placeholder="00" value="<?php echo $dps_nb_vpsp_transp; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='dps-nb-vpsp-transp-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>

          <?php $feedback = compute_server_feedback($dps_nb_vpsp_soin_error);?>
          <label for="dps_nb_vpsp_soin" class="col-sm-3 control-label">VPSP fixe (poste de soins)</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="dps_nb_vpsp_soin" name="dps_nb_vpsp_soin" aria-describedby="dps-nb-vpsp-soin-error" min='0' required='true' digits='true' placeholder="00" value="<?php echo $dps_nb_vpsp_soin; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='dps-nb-vpsp-soin-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>

          <?php $feedback = compute_server_feedback($dps_nb_vtu_error);?>
          <label for="dps_nb_vtu" class="col-sm-4 control-label">VL / VTU / Goliath...</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="dps_nb_vtu" name="dps_nb_vtu" aria-describedby="dps-nb-vtu-error" min='0' required='true' digits='true' placeholder="00" value="<?php echo $dps_nb_vtu; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='dps-nb-vtu-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>

          <?php $feedback = compute_server_feedback($dps_nb_tente_error);?>
          <label for="dps_nb_tente" class="col-sm-3 control-label">Tente (Protec)</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="dps_nb_tente" name="dps_nb_tente" aria-describedby="dps-nb-tente-error" min='0' required='true' digits='true' placeholder="00" value="<?php echo $dps_nb_tente; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='dps-nb-tente-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body">

        <div class="form-group form-group-sm">

          <?php $feedback = compute_server_feedback($dps_nb_med_asso_error);?>
          <label for="dps_nb_med_asso" class="col-sm-4 control-label">Nombre de médecins Protec</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="dps_nb_med_asso" name="dps_nb_med_asso" aria-describedby="dps-nb-med-asso-error" min='0' digits='true' placeholder="00" value="<?php echo $dps_nb_med_asso; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='dps-nb-med-asso-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>

          <?php $feedback = compute_server_feedback($dps_nb_inf_asso_error);?>
          <label for="dps_nb_inf_asso" class="col-sm-3 control-label">Nombre d'infirmiers Protec</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="dps_nb_inf_asso" name="dps_nb_inf_asso" aria-describedby="dps-nb-inf-asso-error" min='0' digits='true' placeholder="00" value="<?php echo $dps_nb_inf_asso; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='dps-nb-inf-asso-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>
        </div>
      </div>

      <div class="panel-body">

        <div class="form-group form-group-sm">

          <?php $feedback = compute_server_feedback($dps_other_matos_asso_error);?>
          <label for="dps_other_matos_asso" class="col-sm-4 control-label">Moyens humains / logistiques supplémentaires</label>
          <div class="col-sm-7">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="text" class="form-control" id="dps_other_matos_asso" name="dps_other_matos_asso" aria-describedby="dps-other-matos-asso_error" placeholder="entrer ici tout moyen supplémentaire" value="<?php echo $dps_other_matos_asso; ?>" />
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='dps-other-matos-asso-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Moyens fournis par l'organisateur <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Permet la comparaison avec la grille des risques."></span></h3>
      </div>
      <div class="panel-body">

        <div class="form-group form-group-sm">

          <?php $feedback = compute_server_feedback($clientmatos_infirmerie_error);?>
          <div class="has-feedback <?php echo $feedback[0];?>">
            <label for="clientmatos_infirmerie" class="col-sm-4 control-label">Local infirmerie</label>
            <div class="col-sm-2">
              <select class="form-control" id="clientmatos_infirmerie" name="clientmatos_infirmerie" aria-describedby="clientmatos-infirmerie-error">
                <option value="0" <?php if ($clientmatos_infirmerie == '0') {echo 'selected';}?>>Non</option>
                <option value="1" <?php if ($clientmatos_infirmerie == '1') {echo 'selected';}?>>Oui</option>
              </select>
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='clientmatos-infirmerie-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>

          <?php $feedback = compute_server_feedback($clientmatos_tente_error);?>
          <div class="has-feedback <?php echo $feedback[0];?>">
            <label for="clientmatos_tente" class="col-sm-3 control-label">Tente</label>
            <div class="col-sm-2">
              <select class="form-control" id="clientmatos_tente" name="clientmatos_tente" aria-describedby="clientmatos-tente-error">
                <option value="0" <?php if ($clientmatos_tente == '0') {echo 'selected';}?>>Non</option>
                <option value="1" <?php if ($clientmatos_tente == '1') {echo 'selected';}?>>Oui</option>
              </select>
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='clientmatos-tente-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>

        </div>

        <div class="form-group form-group-sm">

          <?php $feedback = compute_server_feedback($clientmatos_other_error);?>
          <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
            <label for="clientmatos_other" class="col-sm-4 control-label">Autre</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="clientmatos_other" name="clientmatos_other" aria-describedby="clientmatos-other-error" placeholder="entrer ici tout moyen supplémentaire fourni par l'organisateur" value="<?php echo $clientmatos_other; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='clientmatos-other-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Moyens médicaux / structures</h3>
      </div>
      <div class="panel-body">
        <div class="form-group form-group-sm">

          <?php $feedback = compute_server_feedback($medicalext_nb_med_error);?>
          <label for="medicalext_nb_med" class="col-sm-4 control-label">Nombre de médecins extérieurs (préciser)</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="medicalext_nb_med" name="medicalext_nb_med" aria-describedby="medicalext-nb-med-error" min='0' digits='true' placeholder="00" value="<?php echo $medicalext_nb_med; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='medicalext-nb-med-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>

          <?php $feedback = compute_server_feedback($medicalext_med_company_error);?>
          <label for="medicalext_med_company" class="col-sm-2 control-label">Appartenance</label>
          <div class="col-sm-3">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="text" class="form-control" id="medicalext_med_company" name="medicalext_med_company" aria-describedby="medicalext-med-company-error" placeholder="Appartenance" value="<?php echo $medicalext_med_company; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='medicalext-med-company-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>

          <?php $feedback = compute_server_feedback($medicalext_nb_inf_error);?>
          <label for="medicalext_nb_inf" class="col-sm-4 control-label">Nombre d'infirmiers extérieurs (préciser)</label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="number" class="form-control" id="medicalext_nb_inf" name="medicalext_nb_inf" aria-describedby="medicalext-nb-inf-error" min='0' digits='true' placeholder="00" value="<?php echo $medicalext_nb_inf; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='medicalext-nb-inf-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>

          <?php $feedback = compute_server_feedback($medicalext_inf_company_error);?>
          <label for="medicalext_inf_company" class="col-sm-2 control-label">Appartenance</label>
          <div class="col-sm-3">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <input type="text" class="form-control" id="medicalext_inf_company" name="medicalext_inf_company" aria-describedby="medicalext-inf-company-error" placeholder="Appartenance" value="<?php echo $medicalext_inf_company; ?>" >
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='medicalext-inf-company-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group form-group-sm">

        <?php $feedback = compute_server_feedback($samu_error);?>
        <label for="samu" class="col-sm-4 control-label">SAMU</label>
        <div class="col-sm-2">
          <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
            <select class="form-control" id="samu" name="samu" aria-describedby="samu-error">
              <option value="0" <?php if ($samu == '0') {echo 'selected';}?>>Ni informé, ni présent</option>
              <option value="1" <?php if ($samu != '1' && $samu != '2') {echo 'selected';}?>>Informé, non présent</option>
              <option value="2" <?php if ($samu == '2') {echo 'selected';}?>>Informé et présent</option>
            </select>
            <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
            <span id='samu-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
          </div>
        </div>

        <?php $feedback = compute_server_feedback($bspp_error);?>
        <label for="bspp" class="col-sm-2 control-label">SDIS / BSPP <?php echo $bspp;?></label>
        <div class="col-sm-2">
          <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
            <select class="form-control" id="bspp" name="bspp" aria-describedby="bspp-error">
              <option value="0" <?php if ($bspp == '0') {echo 'selected';}?>>Ni informé, ni présent</option>
              <option value="1" <?php if ($bspp == '1') {echo 'selected';}?>>Informé, non présent</option>
              <option value="2" <?php if ($bspp == '2') {echo 'selected';}?>>Informé et présent</option>
            </select>
            <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
            <span id='bspp-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
          </div>
        </div>
      </div>

    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Justificatif du dispositif mis en place</h3>
      </div>
      <div class="panel-body">

        <div class="form-group form-group-sm">

          <?php $feedback = compute_server_feedback($dps_type_error);?>
          <label for="dps_type" class="col-sm-4 control-label">
            Dispositif mis en place
            <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Type de DPS."></span>
          </label>
          <div class="col-sm-2">
            <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <select class="form-control" id="dps_type" name="dps_type" aria-describedby="dps-type-error">
                <option value="0" <?php if ($dps_type == '0') {echo 'selected';}?>>Point d'Alerte</option>
                <option value="1" <?php if ($dps_type == '1') {echo 'selected';}?>>DPS-PE</option>
                <option value="2" <?php if ($dps_type == '2') {echo 'selected';}?>>DPS-ME</option>
                <option value="3" <?php if ($dps_type == '3') {echo 'selected';}?>>DPS-GE</option>
              </select>
              <span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
              <span id='dps-type-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>

          <?php $feedback = compute_server_feedback($dps_price_error);?>
            <label for="price" class="col-sm-2 control-label">
              Prix
              <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Tarif facturé au client."></span>
            </label>
            <div class="col-sm-2">
              <div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
              <div class="input-group">
                <input type="number" class="form-control" id="price" name="price" aria-describedby="price-error" minlength='1' required='true' number='true' placeholder="Prix" value="<?php echo $price; ?>" data-minlength="1" >
                <div class="input-group-addon glyphicon glyphicon-euro"></div>
              </div>
              <span id='price-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
            </div>
          </div>

        </div>

        <textarea class="form-control" rows="5" id="dps_justification" name="dps_justification" placeholder="Indiquer tout justificatif sur les moyens, structures, etc. ou toute information utile pour la bonne gestion administrative du poste." ><?php echo $dps_justification; ?></textarea>
      </div>
    </div>

  </div>
</div>
