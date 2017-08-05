<?php require_once('functions/modals.php'); ?>
<!-- Attention ici on veut recalculer donc pas de require_once -->
<?php require('functions/dps/dps-workflow-authorization.php'); ?>

<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title">Modification du statut</h3>
	</div>
	<div class="panel-body">
		<div class="form-group">

			<div class="col col-md-2 col-xs-4 text-center">
				<form class="form-horizontal" role="form" action="dps-view.php" method="post">
					<?php
					if ($canValidateLocal && $hasAllAttachements) {
						?>
						<input type='hidden' name='workflow_action' value='validation_antenne'>
						<input type='hidden' name='id' value='<?php echo $dps['id'];?>'>
						<?php
					}
					?>
						<button type="submit" class="btn btn-success"
						<?php
						if(! $canValidateLocal || ! $hasAllAttachements){
							echo " disabled";
						}
						?>
						>Validation Antenne</button>
				</form>
			</div>

			<div class="col col-md-2 col-xs-4 text-center">
				<button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#ModalCancel"
				<?php
				if(! $canRejectLocal){
					echo " disabled";
				}
				?>
				>Annuler le poste</button>
			</div>

			<div class="col col-md-2 col-xs-4 text-center">
				<form class="form-horizontal" role="form" action="dps-edit.php?id=<?php echo $dps['id'];?>" method="post">
					<button type="submit" class="btn btn-info" <?php
					if(! $canValidateDdo){
						echo " disabled";
					}
					?>>Modification</button>
				</form>
			</div>

			<div class="col col-md-2 col-xs-4 text-center">
				<button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#ModalWait"
				<?php
				if(! $canWaitDdo ){
					echo "disabled";
				}
				?>
				>Mettre en attente</button>
			</div>

			<div class="col col-md-2 col-xs-4 text-center">
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalRefus"
				<?php
				if( ! $canRejectDdo ){
					echo "disabled";
				}
				?>
				>Refuser le DPS</button>
			</div>

			<div class="col col-md-2 col-xs-4 text-center">
				<button type="submit" class="btn btn-success" data-toggle="modal" data-target="#ModalAccept"
				<?php
				if( ! $canValidateDdo ){
					echo "disabled";
				}
				?>
				>Autoriser le DPS</button>
			</div>
		</div>
	</div>
</div>
