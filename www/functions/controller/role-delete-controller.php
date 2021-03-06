<?php


	$undeletableRoles=array("Admin", "DDT-I", "Secrétaire");

	if (isset($_POST['delRole'])){
		$id = str_replace("'","", $_POST['delRole']);
		if($id == ""){
			$genericError = "Impossible de supprimer un rôle inconnu";
		}
		else{
			$check_query = "SELECT ID, Title FROM $tablename_roles WHERE ID='$id'" or die("Erreur lors de la consultation" . mysqli_error($db_link));
			$verif = mysqli_query($db_link, $check_query);
			$row_verif = mysqli_fetch_assoc($verif);
			$role = mysqli_num_rows($verif);
			if (!$role){
				$genericError = "Le rôle en question n'existe pas";
			}
			else {
				$role_title = $rbac->Roles->getTitle($id);
				if (in_array($role_title, $undeletableRoles)) {
					$genericError = "Il est interdit de supprimer le rôle '".htmlentities($role_title)."'";
				}
				else {
					$perm_id = $rbac->Roles->remove($id, true);
					if (!$perm_id){
						$genericError = "Echec de la suppression (ID=".$id.")";
					}
					else {
						$genericSuccess = "Rôle correctement supprimé (".htmlentities($role_title).")";
					}
				}
			}
		}
	}
?>
