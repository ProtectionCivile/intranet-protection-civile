<?php require_once('functions/dps/dps-compute-status.php'); ?>

<?php require_once('functions/dps/dps-workflow-authorization.php'); ?>

<?php
	$query = "SELECT * FROM $tablename_settings_general WHERE name LIKE 'eprotec-event-url'";
	$query_result = mysqli_query($db_link, $query);
	$eprotec_url = mysqli_fetch_assoc($query_result);
	$eprotec_event_base_url = $eprotec_url['value'];
	if (!empty($eprotec_number) && !empty($eprotec_event_base_url)) {
		$eprotec_event_full_url = ($eprotec_event_base_url && (strstr($eprotec_event_base_url, 'EVENTID')) ) ? str_replace('EVENTID', $eprotec_number, $eprotec_event_base_url) : '';
		$eprotec_link = "&nbsp;<a href='".$eprotec_event_full_url."' target='_blank'>-> Voir l'évènement sur e-Protec</a>";
	}
?>

<?php
if($dps_status == "draft"){ ?>
	<div class='alert alert-warning'>
			<span class="glyphicon glyphicon-time" style="font-size:2em"></span>
			<strong>DPS non validé par l'antenne</strong>. Ne pas oublier la convention et la grille des risques pour le valider. <?php if (!empty($eprotec_number)) { echo $eprotec_link; }	?><br />
			<small>Création : <?php echo date("d-m-Y", strtotime($dps['status_creation_date']));?></small>
	</div> <?php
}
elseif($dps_status == "valid_antenne"){ ?>
	<div class='alert alert-info'>
		<span class="glyphicon glyphicon-ok" style="font-size:2em"></span>
		<strong>DPS envoyé pour validation à la DDO</strong> le <?php echo date("d-m-Y", strtotime($dps['status_validation_dlo_date']));?> <?php if (!empty($eprotec_number)) { echo $eprotec_link; }	?> <?php if (!empty($eprotec_number)) { echo $eprotec_link; }	?><br />
		<small>Création : <?php echo date("d-m-Y", strtotime($dps['status_creation_date']));?></small>
	</div> <?php
}
elseif($dps_status == "canceled"){ ?>
	<div class='alert alert-danger'>
		<span class="glyphicon glyphicon-ban-circle" style="font-size:2em"></span>
		<strong>DPS annulé le </strong><?php echo date("d-m-Y", strtotime($dps['status_cancel_date']));?> (Motif: <?php echo $dps['status_cancel_reason'];?>) <?php if (!empty($eprotec_number)) { echo $eprotec_link; }	?><br />
		<small>Création : <?php echo date("d-m-Y", strtotime($dps['status_creation_date']));?></small>
	</div> <?php
}
elseif($dps_status == "valid_ddo_attente"){ ?>
	<div class='alert alert-warning'>
		<span class="glyphicon glyphicon-time" style="font-size:2em"></span>
		<strong>Validation antenne le Validation DDO effectuée, attente validation Préfecture ou département concerné</strong> (Motif: <?php echo $dps['status_justification'];?>) <?php if (!empty($eprotec_number)) { echo $eprotec_link; }	?><br />
		<small>Création : <?php echo date("d-m-Y", strtotime($dps['status_creation_date']));?></small><br />
		<small>Validation antenne : <?php echo date("d-m-Y", strtotime($dps['status_validation_dlo_date']));?></small>
	</div>
<?php
}
elseif($dps_status == "refused"){ ?>
	<div class='alert alert-danger'>
		<span class="glyphicon glyphicon-remove" style="font-size:2em"></span>
		<strong>DPS refusé</strong> le <?php echo date("d-m-Y", strtotime($dps['status_validation_ddo_date']));?> (Motif: <?php echo $dps['status_justification'];?>) <?php if (!empty($eprotec_number)) { echo $eprotec_link; }	?><br />
		<small>Création : <?php echo date("d-m-Y", strtotime($dps['status_creation_date']));?></small><br />
		<small>Validation antenne : <?php echo date("d-m-Y", strtotime($dps['status_validation_dlo_date']));?></small>
	</div> <?php
}
elseif($dps_status == "accepted"){ ?>
	<div class='alert alert-success'>
		<span class="glyphicon glyphicon-ok" style="font-size:2em"></span>
		<strong>DPS validé et accepté</strong> le <?php echo date("d-m-Y", strtotime($dps['status_validation_ddo_date']));?> (Justification: <?php echo $dps['status_justification'];?>) <?php if (!empty($eprotec_number)) { echo $eprotec_link; }	?><br />
		<small>Création : <?php echo date("d-m-Y", strtotime($dps['status_creation_date']));?></small><br />
		<small>Demande initiale : <?php echo date("d-m-Y", strtotime($dps['status_validation_dlo_date']));?></small>
	</div> <?php
}
?>
