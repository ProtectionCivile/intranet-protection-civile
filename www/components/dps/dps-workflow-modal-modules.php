<?php
$dept = $dps['dept'];
$email = "";
$query = "SELECT setting_value FROM settings_mail WHERE setting_name LIKE '%92%'";
$email_result = mysqli_query($db_link, $query);
//$email_array = mysqli_fetch_array($email_result);
//$email = $email_array['setting_value'];
while ($row = mysqli_fetch_assoc($email_result)) {
        $email .= $row["setting_value"].", ";
    }

?>

<div class="modal fade" id="ModalRefus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<form role="form" action="dps-view.php" method="post">
		<input type='hidden' name='id' value='<?php echo $dps['id'];?>'>
		<input type='hidden' name='workflow_action' value='reject'>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Précisez et confirmez</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="status_justification" class="control-label">Commentaire :</label>
						<textarea class="form-control" id="status_justification" name="status_justification"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
					<button type="submit" class="btn btn-danger">Refuser</button>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="modal fade" id="ModalCancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<form role="form" action="dps-view.php" method="post">
		<input type='hidden' name='id' value='<?php echo $dps['id'];?>'>
		<input type='hidden' name='workflow_action' value='cancel'>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Précisez et confirmez</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="status_cancel_reason" class="control-label">Motif :</label>
						<textarea class="form-control" id="status_cancel_reason" name="status_cancel_reason"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
					<button type="submit" class="btn btn-danger">Annuler le poste de secours</button>
				</div>
			</div>
		</div>
	</form>
</div>


<div class="modal fade" id="ModalWait" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<form role="form" action="dps-view.php" method="post">
		<input type='hidden' name='id' value='<?php echo $dps['id'];?>'>
		<input type='hidden' name='workflow_action' value='wait'>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Précisez et confirmez</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="status_justification" class="control-label">Commentaire (en attente de qui / pourquoi) :</label>
						<textarea class="form-control" id="status_justification" name="status_justification"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
					<button type="submit" class="btn btn-danger">Mettre en attente</button>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="modal fade" id="ModalAccept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<form role="form" action="dps-view.php" method="post">
		<input type='hidden' name='id' value='<?php echo $dps['id'];?>'>
		<input type='hidden' name='workflow_action' value='accept'>
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Acceptation et envoi de confirmation</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="email_to" class="control-label">E-mail(s) :</label>
						<textarea type="text" class="form-control" id="email_to" name="email_to" rows="3"><?php echo $email;?></textarea>
						<span id="helpBlock" class="help-block">Pour ajouter un destinataire, espacez chaque adresse par une virgule.</span>
					</div>
					<div class="form-group">
						<label for="status_justification" class="control-label">Commentaire :</label>
						<textarea class="form-control" id="status_justification" name="status_justification" rows="5"></textarea>
					</div>
					<?php if($dept != "92"){echo"<p class='bg-primary text-center'>Attention, cet e-mail doit être validé par autre ADPC, il n'est pas envoyé au SIDPC. Ce sera le département accueillant qui devra faire la demande (si besoin est).</p>";}?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
					<button type="submit" class="btn btn-success">Envoyer <span class="glyphicon glyphicon-send"></span></button>
				</div>
			</div>
		</div>
	</form>
</div>
