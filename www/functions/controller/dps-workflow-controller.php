<?php require_once('functions/dps/dps-compute-status.php'); ?>
<?php require('functions/dps/dps-workflow-authorization.php'); // Relaod forcé?>
<?php


	if (isset($_POST['workflow_action']) && isset($_POST['id']) ) {
		$today = date("Y-m-d");

		// Validation par un DLO
		if ($_POST['workflow_action'] == 'validation_antenne' ) {
			if (!$canValidateLocal) {
				$genericError = "Opération non permise, vous n'avez pas les droits suffisants pour modifier l'état actuel du DPS";
			}
			elseif (!$hasAllAttachments) {
				$genericError = "Opération non permise, il manque la convention ou la grille de risques";
			}
			else {
				$sql = "UPDATE $tablename_dps SET
				status_validation_dlo_date='$today',
				status='1'
				WHERE id='$id'" or die("Impossible de modifier le DPS dans la base de données" . mysqli_error($db_link));
				if ($db_link->query($sql) === TRUE) {
					$genericSuccess = "Dispositif de Secours mis à jour.
					<a href='dps-list.php' class='btn btn-primary btn-sm' title='Retour à la liste'>Retour à la liste</a>";
					// Update new status for the workflow display module to have the relevant value
					$dps_status = "valid_antenne";
					$dps['status_validation_dlo_date'] = $_POST['status_validation_dlo_date'];

					// Send mail
					$action = 'validate-local';
				}
				else {
					$genericError = "Erreur pendant la mise à jour du DPS ".htmlentities($event_name)." (".htmlentities($cu_full).") " . $db_link->error;
				}
			}
		}

		// Annulation du DPS
		if ($_POST['workflow_action'] == 'cancel' ) {
			if (!$canRejectLocal) {
				$genericError = "Opération non permise, vous n'avez pas les droits suffisants pour modifier l'état actuel du DPS";
			}
			else {
				$sql = "UPDATE $tablename_dps SET
				status_cancel_date='$today',
				status_cancel_reason='".mysqli_escape_string($db_link, $_POST['status_cancel_reason'])."',
				status='4'
				WHERE id='$id'" or die("Impossible de modifier le DPS dans la base de données" . mysqli_error($db_link));
				if ($db_link->query($sql) === TRUE) {
					$genericSuccess = "Dispositif de Secours mis à jour.
					<a href='dps-list.php' class='btn btn-primary btn-sm' title='Retour à la liste'>Retour à la liste</a>";

					// Send mail
					if ($dps_status == 'accepted') { // Si il a déjà été validé, on communique l'annulation en extérieur
						$action = 'cancel-ddo';
					}
					else {
						$action = 'cancel-dlo';
					}

					// Update new status for the workflow display module to have the relevant value
					$dps_status = "canceled";
					$dps['status_cancel_reason'] = $_POST['status_cancel_reason'];
					$dps['status_cancel_date'] = $today;
				}
				else {
					$genericError = "Erreur pendant la mise à jour du DPS ".htmlentities($event_name)." (".htmlentities($cu_full).") " . $db_link->error;
				}
			}
		}

		// Rejet par DDO
		if ($_POST['workflow_action'] == 'reject' ) {
			if (!$canRejectDdo) {
				$genericError = "Opération non permise, vous n'avez pas les droits suffisants pour modifier l'état actuel du DPS";
			}
			else {
				$sql = "UPDATE $tablename_dps SET
				status_validation_ddo_date='$today',
				status_justification='".mysqli_escape_string($db_link, $_POST['status_justification'])."',
				status='5'
				WHERE id='$id'" or die("Impossible de modifier le DPS dans la base de données" . mysqli_error($db_link));
				if ($db_link->query($sql) === TRUE) {
					$genericSuccess = "Dispositif de Secours mis à jour.
					<a href='dps-list.php' class='btn btn-primary btn-sm' title='Retour à la liste'>Retour à la liste</a>";
					// Update new status for the workflow display module to have the relevant value
					$dps_status = "refused";
					$dps['status_justification'] = $_POST['status_justification'];
					$dps['status_validation_ddo_date'] = $today;

					// Send mail
					$action = 'reject-ddo';
				}
				else {
					$genericError = "Erreur pendant la mise à jour du DPS ".htmlentities($event_name)." (".htmlentities($cu_full).") " . $db_link->error;
				}
			}
		}

		// Mise en attente par DDO
		if ($_POST['workflow_action'] == 'wait' ) {
			if (!$canWaitDdo) {
				$genericError = "Opération non permise, vous n'avez pas les droits suffisants pour modifier l'état actuel du DPS";
			}
			else {
				$sql = "UPDATE $tablename_dps SET
				status_validation_ddo_date='$today',
				status_justification='".mysqli_escape_string($db_link, $_POST['status_justification'])."',
				status='2'
				WHERE id='$id'" or die("Impossible de modifier le DPS dans la base de données" . mysqli_error($db_link));
				if ($db_link->query($sql) === TRUE) {
					$genericSuccess = "Dispositif de Secours mis à jour.
					<a href='dps-list.php' class='btn btn-primary btn-sm' title='Retour à la liste'>Retour à la liste</a>";
					// Update new status for the workflow display module to have the relevant value
					$dps_status = "valid_ddo_attente";
					$dps['status_justification'] = $_POST['status_justification'];
					$dps['status_validation_ddo_date'] = $today;

					// Send mail
					$action = 'wait';
				}
				else {
					$genericError = "Erreur pendant la mise à jour du DPS ".htmlentities($event_name)." (".htmlentities($cu_full).") " . $db_link->error;
				}
			}
		}

		// Acceptation DDO & Pref
		if ($_POST['workflow_action'] == 'accept' ) {
			if (!$canValidateDdo) {
				$genericError = "Opération non permise, vous n'avez pas les droits suffisants pour modifier l'état actuel du DPS";
			}
			// On donne quand même le droit au DDO de valider un poste même s'il n'a pas tous les documents. C'est sa responsabilité.
			// elseif (!$hasAllAttachments) {
			// 	$genericError = "Opération non permise, il manque la convention ou la grille de risques";
			// }
			else {
				$sql = "UPDATE $tablename_dps SET
				status_validation_ddo_date='$today',
				status_justification='".mysqli_escape_string($db_link, $_POST['status_justification'])."',
				status='3'
				WHERE id='$id'" or die("Impossible de modifier le DPS dans la base de données" . mysqli_error($db_link));
				if ($db_link->query($sql) === TRUE) {
					$genericSuccess = "Dispositif de Secours mis à jour.
					<a href='dps-list.php' class='btn btn-primary btn-sm' title='Retour à la liste'>Retour à la liste</a>";
					// Update new status for the workflow display module to have the relevant value
					$dps_status = "accepted";
					$dps['status_justification'] = $_POST['status_justification'];
					$dps['status_validation_ddo_date'] = $today;
					// TODO Generate PDF

					// TODO Donner une variable $declarationFilePath avec le chemin du fichier généré pour la Préf.

					// Send mail
					$action = 'accept-ddo';
				}
				else {
					$genericError = "Erreur pendant la mise à jour du DPS ".htmlentities($event_name)." (".htmlentities($cu_full).") " . $db_link->error;
				}
			}
		}


}

?>
