<?php
$dept = $dps['dept'];
$email = "";
$query = "SELECT setting_value FROM settings_mail WHERE setting_name LIKE '%92%'";
$email_result = mysqli_query($link, $query);
//$email_array = mysqli_fetch_array($email_result);
//$email = $email_array['setting_value'];
while ($row = mysqli_fetch_assoc($email_result)) {
        $email .= $row["setting_value"].", ";
    }

?>

<div class="modal fade" id="ModalRefus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title" id="myModalLabel">Précisez et confirmez</h4>
			</div>
		<div class="modal-body">
			<form role="form" action="traitement-demande-dps.php" method="post">
				<div class="form-group">
					<label for="motif_refus" class="control-label">Motif :</label>
					<input type="text" class="form-control" id="motif_refus" name="motif_refus">
				</div>
				<div class="form-group">
					<label for="commentaire_refus" class="control-label">Commentaire :</label>
					<textarea class="form-control" id="commentaire_refus" name="commentaire_refus"></textarea>
				</div>
				<input type='hidden' name='refus' value='<?php echo $dps['id'];?>'>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			<button type="submit" class="btn btn-danger">Refuser</button>
		</form>
		</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ModalAccept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h4 class="modal-title" id="myModalLabel">Acceptation et envoi de confirmation</h4>
			</div>
		<div class="modal-body">
			<form role="form" action="traitement-demande-dps.php" method="post">
				<div class="form-group">
					<label for="email_to" class="control-label">E-mail(s) :</label>
					<textarea type="text" class="form-control" id="email_to" name="email_to" rows="3"><?php echo $email;?></textarea>
					<span id="helpBlock" class="help-block">Pour ajouter un destinataire, espacez chaque adresse par une virgule.</span>
				</div>
				<div class="form-group">
					<label for="commentaire_accept" class="control-label">Commentaire :</label>
					<textarea class="form-control" id="commentaire_accept" name="commentaire_accept" rows="5"></textarea>
				</div>
				<input type='hidden' name='valider' value='<?php echo $dps['id'];?>'>
				<?php if($dept != "92"){echo"<p class='bg-primary text-center'>Attention, cet e-mail doit être validé par autre ADPC, il n'est pas envoyé au SIDPC. Ce sera le département accueillant qui devra faire la demande (si besoin est).</p>";}?>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			<button type="submit" class="btn btn-success">Envoyer <span class="glyphicon glyphicon-send"></span></button>
		</form>
		</div>
		</div>
	</div>
</div>