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
				<div class='conainer'>


	        <div class='row'>
	          <div class="col col-sm-3 text-right">Nom / Nature</div>
	          <div class="col col-sm-9">
	            <p class='bg-info' ><?php echo ($event_name) ? $event_name : '&nbsp;';?></p>
	          </div>
	        </div>

	        <div class='row'>
	          <div class="col col-sm-3 text-right">Activité / Descriptif</div>
	          <div class="col col-sm-9">
	            <p class='bg-info' ><?php echo ($event_description) ? $event_description : '&nbsp;';?></p>
	          </div>
	        </div>

	        <div class='row'>
	          <div class="col col-sm-3 text-right">Adresse exacte</div>
	          <div class="col col-sm-9">
	            <p class='bg-info' ><?php echo ($event_address) ? $event_address : '&nbsp;';?></p>
	          </div>
	        </div>

					<div class='row'>
						<div class="col col-sm-3 text-right">Horaires de l'évènement</div>
						<div class="col col-sm-9">
							<p class='bg-info' >
								Du
								<?php echo ($event_begin_date) ? formatDateFrToReadable($event_begin_date) : '&nbsp;';?>
								<?php echo ($event_begin_time) ? 'à '.formatTimeFrToReadable($event_begin_time) : '&nbsp;';?>
								au
								<?php echo ($event_end_date) ? formatDateFrToReadable($event_end_date) : '&nbsp;';?>
								<?php echo ($event_end_time) ? 'à '.formatTimeFrToReadable($event_end_time) : '&nbsp;';?>
							</p>
						</div>
					</div>

	        <div class='row'>
	          <div class="col col-sm-3 text-right">Département</div>
	          <div class="col col-sm-3 text-center">
							<p class='bg-info' ><?php echo ($event_department) ? compute_dps_department($event_department) : '&nbsp;';?></p>
	          </div>

            <div class="col col-sm-3 text-right">Dossier déjà déposé en préfecture ?</div>
            <div class="col col-sm-2 text-center">
							<p class='bg-info' >
								<?php
								include ('functions/dps/dps-query-select-parameters.php');
								echo get_select_unique_parameter($parameters_query_result, 'yesno', $event_pref_secu);
								?>
						</p>
            </div>
          </div>

				</div>

      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">
          Évaluation du risque

        </h3>
      </div>
      <div class="panel-body">
				<div class='conainer'>


	        <div class='row'>
	          <div class="col col-sm-3 text-right">Nombre de spectateurs</div>
	          <div class="col col-sm-2 text-center">
							<p class='bg-info' ><?php echo ($ris_p1_public) ? $ris_p1_public : '&nbsp;';?></p>
	          </div>

	          <div class="col col-sm-4 text-right">Nombre de participants</div>
	          <div class="col col-sm-2 text-center">
							<p class='bg-info' ><?php echo ($ris_p1_actors) ? $ris_p1_actors : '&nbsp;';?></p>
	          </div>
	        </div>


	        <div class='row'>
	          <div class="col col-sm-3 text-right">Activité du rassemblement</div>
	          <div class="col col-sm-9">
							<p class='bg-info' >
								<?php
								include ('functions/dps/dps-query-select-parameters.php');
								echo get_select_unique_parameter($parameters_query_result, 'ris_p2', $ris_p2);
								?>
							</p>
	          </div>
	        </div>


	        <div class='row'>
	          <div class="col col-sm-3 text-right">Environnement et accessibilité</div>
	          <div class="col col-sm-9">
							<p class='bg-info' >
								<?php
								include ('functions/dps/dps-query-select-parameters.php');
								echo get_select_unique_parameter($parameters_query_result, 'ris_e1', $ris_e1);
								?>
							</p>
	          </div>
	        </div>


					<div class='row'>
	          <div class="col col-sm-3 text-right">Délai des secours publics</div>
	          <div class="col col-sm-9">
							<p class='bg-info' >
								<?php
								include ('functions/dps/dps-query-select-parameters.php');
								echo get_select_unique_parameter($parameters_query_result, 'ris_e2', $ris_e2);
								?>
							</p>
	          </div>
	        </div>

					<div class='row'>
	          <div class="col col-sm-3 text-right">Commentaires concernant le RIS</div>
	          <div class="col col-sm-9">
							<p class='bg-info' ><?php echo ($ris_comment) ? $ris_comment : '&nbsp;';?></p>
	          </div>
	        </div>

				</div>

      </div>
    </div>

  </div>
</div>
