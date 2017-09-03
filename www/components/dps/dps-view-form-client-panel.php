<div class="panel panel-primary">
  <div class="panel-heading">
    <button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#orga-panel-filter" aria-expanded='true' aria-controls="orga-panel-filter">
      <span aria-hidden="true" >Montrer/Cacher</span>
    </button>
    <h3 class="panel-title">Organisateur</h3>
  </div>

  <div id='orga-panel-filter' aria-expanded='true' class="panel-body in">
		<div class='conainer'>

	    <div class="row">
	      <div class="col col-sm-3 text-right">Nom de l'organisation</div>
	      <div class="col col-sm-3">
	        <p class='bg-info'><?php echo ($client_name) ? htmlentities($client_name) : '&nbsp;';?> </p>
	      </div>
	    </div>

	    <div class="row">
	      <div class="col col-sm-3 text-right">Représenté par</div>
	      <div class="col col-sm-3">
	        <p class='bg-info' ><?php echo ($client_represent) ? htmlentities($client_represent) : '&nbsp;';?></p>
	      </div>

	      <div class="col col-sm-1 text-right">Qualité</div>
	      <div class="col col-sm-3">
	        <p class='bg-info' ><?php echo ($client_title) ? htmlentities($client_title) : '&nbsp;';?> </p>
	      </div>
	    </div>

	    <div class="row">
	      <div class="col col-sm-3 text-right">Adresse postale</div>
	      <div class="col col-sm-7">
	        <p class='bg-info' ><?php echo ($client_address) ? htmlentities($client_address) : '&nbsp;';?>  </p>
	      </div>
	    </div>

			<div class='row'>
				<div class="col col-sm-3 text-right">Téléphone</div>
				<div class="col-sm-2">
				  <p class='bg-info' ><?php echo ($client_phone) ? htmlentities($client_phone) : '&nbsp;';?> </p>
				</div>
	      <div class="col col-sm-2 text-right">Fax</div>
	      <div class="col-sm-2">
	        <p class='bg-info'><?php echo ($client_fax) ? htmlentities($client_fax) : '&nbsp;';?></p>
	      </div>
	    </div>

			<div class='row'>
				<div class="col col-sm-3 text-right">E-mail</div>
				<div class="col-sm-6">
				   <p class='bg-info'><?php echo ($client_email) ? htmlentities($client_email) : '&nbsp;';?></p>
				</div>
	    </div>

		</div>


  </div>
</div>
