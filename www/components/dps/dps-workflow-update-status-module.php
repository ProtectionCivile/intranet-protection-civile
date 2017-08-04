<?php require_once('functions/modals.php'); ?>

<?php if ($rbac->check("ope-dps-validate-ddo-to-pref", $currentUserID)) {?>

	<div class="panel panel-danger">
		<div class="panel-heading">
			<h3 class="panel-title">Accès spécial DDO</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">

				<form class="form-horizontal" role="form" action="dps-edit.php" method="post">
					<input type='hidden' name='id' value='<?php echo $dps['id'];?>' />
					<div class="col-sm-3 col-md-3">
						<button type="submit" class="btn btn-info">Modifier le DPS</button>
					</div>
				</form>
				<div class="col-sm-3 col-md-3">
					<button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#ModalWait"
					<?php
					if($dps_status == 'draft' || $dps_status == 'refused' || $dps_status == 'accepted' || $dps_status == 'valid_ddo_attente' ){
						echo "disabled";
					}
					?>
					>Mettre en attente</button>
				</div>
				<div class="col-sm-3 col-md-3">
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalRefus"
					<?php
					if($dps_status == 'draft' || $dps_status == 'refused' || $dps_status == 'accepted' ){
						echo "disabled";
					}
					?>
					>Refuser le DPS</button>
				</div>
				<div class="col-sm-3 col-md-3">
					<button type="submit" class="btn btn-success" data-toggle="modal" data-target="#ModalAccept"
					<?php
					if($dps_status == 'draft' || $dps_status == 'accepted' ){
						echo "disabled";
					}
					?>
					>Valider le DPS</button>
				</div>
			</div>
		</div>
	</div>

<?php } ?>
