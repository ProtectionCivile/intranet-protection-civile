<?php require_once('functions/dps/dps-compute-status.php'); ?>

<?php
if($dps_status == "draft"){ ?>
	<div class='alert alert-warning'>
		<form class="form-horizontal" role="form" action="dps-view.php" method="post">
			<span class="glyphicon glyphicon-time" style="font-size:2em"></span>
			<strong>DPS non validé par l'antenne</strong>
			<?php
			if (
					(	$dps_status == 'draft') && (
					( $dps['section'] == $currentUserSection && $rbac->check("ope-dps-validate-local", $currentUserID) ) ||
					( $dps['section'] == '0' && $rbac->check("ope-dps-validate-dept", $currentUserID) ) ||
					( $rbac->check("ope-dps-validate-ddo-to-pref", $currentUserID) )
					)
				) {
							// echo '1='.$dps_status.'<br />';
							// echo '2='.$dps['section'].'<br />';
							// echo '3='.$currentUserSection.'<br />';
							// echo '4='.$rbac->check("ope-dps-validate-local", $currentUserID).'<br />';
					?>
						<input type='hidden' name='workflow_action' value='validation_antenne'>
						<input type='hidden' name='id' value='<?php echo $dps['id'];?>'>
						<button type="submit" class="btn btn-success">Envoyer en validation <span class="glyphicon glyphicon-thumbs-up"></button>
					<?php
				}
			?>
			<br />
			<small>Création : <?php echo date("d-m-Y", strtotime($dps['status_creation_date']));?></small>
		</form>
	</div> <?php
}
elseif($dps_status == "valid_antenne"){ ?>
	<div class='alert alert-info'>
		<span class="glyphicon glyphicon-ok" style="font-size:2em"></span>
		<strong>DPS envoyé pour validation à la DDO</strong> le <?php echo date("d-m-Y", strtotime($dps['status_validation_dlo_date']));?><br />
		<small>Création : <?php echo date("d-m-Y", strtotime($dps['status_creation_date']));?></small>
	</div> <?php
}
elseif($dps_status == "canceled"){ ?>
	<div class='alert alert-danger'>
		<span class="glyphicon glyphicon-ban-circle" style="font-size:2em"></span>
		<strong>DPS annulé le </strong><?php echo date("d-m-Y", strtotime($dps['status_cancel_date']));?> (Motif: <?php echo $dps['status_cancel_reason'];?>)<br />
		<small>Création : <?php echo date("d-m-Y", strtotime($dps['status_creation_date']));?></small>
		<small>Validation antenne : <?php echo date("d-m-Y", strtotime($dps['status_validation_dlo_date']));?></small>
	</div> <?php
}
elseif($dps_status == "valid_ddo_attente"){ ?>
	<div class='alert alert-warning'>
		<span class="glyphicon glyphicon-time" style="font-size:2em"></span>
		<strong>Validation antenne le Validation DDO effectuée, attente validation Préfecture ou département concerné</strong><br />
		<small>Création : <?php echo date("d-m-Y", strtotime($dps['status_creation_date']));?></small>
		<small>Validation antenne : <?php echo date("d-m-Y", strtotime($dps['status_validation_dlo_date']));?></small>
	</div>
<?php
}
elseif($dps_status == "refused"){ ?>
	<div class='alert alert-danger'>
		<span class="glyphicon glyphicon-remove" style="font-size:2em"></span>
		<strong>DPS refusé</strong> le <?php echo date("d-m-Y", strtotime($dps['status_validation_ddo_date']));?> (Motif: <?php echo $dps['status_justification'];?>)<br />
		<small>Création : <?php echo date("d-m-Y", strtotime($dps['status_creation_date']));?></small>
		<small>Validation antenne : <?php echo date("d-m-Y", strtotime($dps['status_validation_dlo_date']));?></small>
	</div> <?php
}
elseif($dps_status == "accepted"){ ?>
	<div class='alert alert-success'>
		<span class="glyphicon glyphicon-ok" style="font-size:2em"></span>
		<strong>DPS validé</strong> le <?php echo date("d-m-Y", strtotime($dps['status_validation_ddo_date']));?>(Justification: <?php echo $dps['status_justification'];?>)<br />
		<small>Création : <?php echo date("d-m-Y", strtotime($dps['status_creation_date']));?></small>
		<small>Demande initiale : <?php echo date("d-m-Y", strtotime($dps['status_validation_dlo_date']));?></small>
	</div> <?php
}
?>
