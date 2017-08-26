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
				<div class='conainer'>

					<div class='row'>
						<div class="col col-sm-3 text-right">Dispositif opérationnel</div>
						<div class="col col-sm-9">
							<p class='bg-info' >
								Du
								<?php echo ($dps_begin_date) ? formatDateFrToReadable($dps_begin_date) : '&nbsp;';?>
								<?php echo ($dps_begin_time) ? 'à '.formatTimeFrToReadable($dps_begin_time) : '&nbsp;';?>
								au
								<?php echo ($dps_end_date) ? formatDateFrToReadable($dps_end_date) : '&nbsp;';?>
								<?php echo ($dps_end_time) ? 'à '.formatTimeFrToReadable($dps_end_time) : '&nbsp;';?>
							</p>
						</div>
					</div>

	      </div>
			</div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Moyens fournis par la Protection Civile</h3>
      </div>
      <div class="panel-body">
				<div class='conainer'>


					<div class='row'>
						<div class="col col-sm-2 text-right">CE / CP</div>
						<div class="col col-sm-1 text-center">
							<p class='bg-info' ><?php echo ($dps_nb_ce) ? $dps_nb_ce : '&nbsp;';?></p>
						</div>

						<div class="col col-sm-2 text-right">PSE-2</div>
						<div class="col col-sm-1 text-center">
							<p class='bg-info' ><?php echo ($dps_nb_pse2) ? $dps_nb_pse2 : '&nbsp;';?></p>
						</div>

						<div class="col col-sm-2 text-right">PSE-1</div>
						<div class="col col-sm-1 text-center">
							<p class='bg-info' ><?php echo ($dps_nb_pse1) ? $dps_nb_pse1 : '&nbsp;';?></p>
						</div>

						<div class="col col-sm-2 text-right">PSC-1</div>
						<div class="col col-sm-1 text-center">
							<p class='bg-info' ><?php echo ($dps_nb_psc1) ? $dps_nb_psc1 : '&nbsp;';?></p>
						</div>
					</div>

					<div class='row'>
						<div class="col col-sm-2 text-right">Lot A</div>
						<div class="col col-sm-1 text-center">
							<p class='bg-info' ><?php echo ($dps_nb_lot_a) ? $dps_nb_lot_a : '&nbsp;';?></p>
						</div>

						<div class="col col-sm-2 text-right">Lot B</div>
						<div class="col col-sm-1 text-center">
							<p class='bg-info' ><?php echo ($dps_nb_lot_b) ? $dps_nb_lot_b : '&nbsp;';?></p>
						</div>

						<div class="col col-sm-2 text-right">Lot C</div>
						<div class="col col-sm-1 text-center">
							<p class='bg-info' ><?php echo ($dps_nb_lot_c) ? $dps_nb_lot_c : '&nbsp;';?></p>
						</div>

						<div class="col col-sm-2 text-right">D.A.E.</div>
						<div class="col col-sm-1 text-center">
							<p class='bg-info' ><?php echo ($dps_nb_dae) ? $dps_nb_dae : '&nbsp;';?></p>
						</div>
					</div>

					<div class='row'>
						<div class="col col-sm-2 text-right">VPSP Transport</div>
						<div class="col col-sm-1 text-center">
							<p class='bg-info' ><?php echo ($dps_nb_vpsp_transp) ? $dps_nb_vpsp_transp : '&nbsp;';?></p>
						</div>

						<div class="col col-sm-2 text-right">VPSP fixe</div>
						<div class="col col-sm-1 text-center">
							<p class='bg-info' ><?php echo ($dps_nb_vpsp_soin) ? $dps_nb_vpsp_soin : '&nbsp;';?></p>
						</div>

						<div class="col col-sm-2 text-right">VL / VTU</div>
						<div class="col col-sm-1 text-center">
							<p class='bg-info' ><?php echo ($dps_nb_vtu) ? $dps_nb_vtu : '&nbsp;';?></p>
						</div>

						<div class="col col-sm-2 text-right">Tente</div>
						<div class="col col-sm-1 text-center">
							<p class='bg-info' ><?php echo ($dps_nb_tente) ? $dps_nb_tente : '&nbsp;';?></p>
						</div>
					</div>

					<div class='row'>
						<div class="col col-sm-2 text-right">Médecins Protec</div>
						<div class="col col-sm-1 text-center">
							<p class='bg-info' ><?php echo ($dps_nb_med_asso) ? $dps_nb_med_asso : '&nbsp;';?></p>
						</div>

						<div class="col col-sm-2 text-right">Infirmiers Protec</div>
						<div class="col col-sm-1 text-center">
							<p class='bg-info' ><?php echo ($dps_nb_inf_asso) ? $dps_nb_inf_asso : '&nbsp;';?></p>
						</div>

						<div class="col col-sm-2 text-right">Moyens supp.</div>
						<div class="col col-sm-4">
							<p class='bg-info' ><?php echo ($dps_other_matos_asso) ? $dps_other_matos_asso : '&nbsp;';?></p>
						</div>
					</div>

				</div>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Moyens fournis par l'organisateur</h3>
      </div>
      <div class="panel-body">
				<div class='conainer'>

					<div class='row'>
						<div class="col col-sm-3 text-right">Local infirmerie</div>
						<div class="col col-sm-2 text-center">
							<p class='bg-info' >
								<?php
								echo $select_list_parameter_service->getTranslation('yesno', $clientmatos_infirmerie);
								?>
							</p>
						</div>

						<div class="col col-sm-2 text-right">Tente(s)</div>
						<div class="col col-sm-2 text-center">
							<p class='bg-info' >
								<?php
								echo $select_list_parameter_service->getTranslation('yesno', $clientmatos_tente);
								?>
							</p>
						</div>
					</div>

					<div class='row'>
						<div class="col col-sm-3 text-right">Autres moyens</div>
						<div class="col col-sm-9">
							<p class='bg-info' ><?php echo ($clientmatos_other) ? $clientmatos_other : '&nbsp;';?></p>
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
				<div class='conainer'>

					<div class='row'>
						<div class="col col-sm-3 text-right">Médecins extérieurs</div>
						<div class="col col-sm-2 text-center">
							<p class='bg-info' ><?php echo ($medicalext_nb_med) ? $medicalext_nb_med : '&nbsp;';?></p>
						</div>

						<div class="col col-sm-2 text-right">Appartenance</div>
						<div class="col col-sm-4">
							<p class='bg-info' ><?php echo ($medicalext_med_company) ? $medicalext_med_company : '&nbsp;';?></p>
						</div>
					</div>

					<div class='row'>
						<div class="col col-sm-3 text-right">Infirmiers extérieurs</div>
						<div class="col col-sm-2 text-center">
							<p class='bg-info' ><?php echo ($medicalext_nb_inf) ? $medicalext_nb_inf : '&nbsp;';?></p>
						</div>

						<div class="col col-sm-2 text-right">Appartenance</div>
						<div class="col col-sm-4">
							<p class='bg-info' ><?php echo ($medicalext_inf_company) ? $medicalext_inf_company : '&nbsp;';?></p>
						</div>
					</div>

					<div class='row'>
						<div class="col col-sm-3 text-right">SAMU</div>
						<div class="col col-sm-3">
							<p class='bg-info' >
								<?php
								echo $select_list_parameter_service->getTranslation('samu', $samu);
								?>
							</p>
						</div>

						<div class="col col-sm-1 text-right">BSPP</div>
						<div class="col col-sm-3">
							<p class='bg-info' >
								<?php
								echo $select_list_parameter_service->getTranslation('bspp', $bspp);
								?>
							</p>
						</div>
					</div>

	      </div>
			</div>

    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Justificatif du dispositif mis en place</h3>
      </div>
      <div class="panel-body">
				<div class='conainer'>

					<div class='row'>
	          <div class="col col-sm-3 text-right">Dispositif mis en place</div>
	          <div class="col col-sm-3">
							<p class='bg-info' >
								<?php
								echo $select_list_parameter_service->getTranslation('dps_type_detailed', $dps_type);
								?>
							</p>
	          </div>

						<div class="col col-sm-1 text-right">Prix</div>
						<div class="col col-sm-2 text-center">
							<p class='bg-info' ><?php echo ($price) ? $price.' €' : '&nbsp;';?></p>
						</div>
	        </div>

					<div class='row'>
						<div class="col col-sm-3 text-right">Justificatif du dispositif</div>
						<div class="col col-sm-9">
							<p class='bg-info' ><?php echo ($dps_justification) ? $dps_justification : '&nbsp;';?></p>
						</div>
					</div>

				</div>

      </div>
    </div>

  </div>
</div>
