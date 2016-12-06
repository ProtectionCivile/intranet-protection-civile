<?php
include 'securite.php';
require_once('connexion.php');


if(isset($_POST['id'])){
$id = $_POST['id'];
$query = "SELECT * FROM demande_dps WHERE id = '$id'";
$dps_result = mysqli_query($link, $query);
$dps = mysqli_fetch_array($dps_result);
$cu = $dps['cu_complet'];
}elseif(isset($_SESSION['dps-creation'])){
$cu = $_SESSION['dps-creation'];
$query = "SELECT * FROM demande_dps WHERE cu_complet = '$cu'";
$dps_result = mysqli_query($link, $query);
$dps = mysqli_fetch_array($dps_result);
unset($_SESSION['dps-creation']);
}elseif(isset($_SESSION['dps-update'])){
$id = $_SESSION['dps-update'];
$query = "SELECT * FROM demande_dps WHERE id = '$id'";
$dps_result = mysqli_query($link, $query);
$dps = mysqli_fetch_array($dps_result);
$cu = $dps['cu_complet'];
unset($_SESSION['dps-update']);
}else{header("Location: list-dps.php"); exit;}

$pathy = $dps['annee_poste'];
$pathyear = "20".$pathy;
$pathcode_commune = $dps['commune_ris'];
$pathquery = "SELECT nomcode,numero FROM commune WHERE numero=$pathcode_commune";
$pathcommune_result = mysqli_query($link, $pathquery);
$pathcommune_array = mysqli_fetch_array($pathcommune_result);
$pathantenne = $pathcommune_array["nomcode"];
$pathnum_cu = $dps['num_cu'];

$pathfile = "documents_dps/".$pathyear."/".$pathantenne."/".$pathnum_cu."/";
$pathfileconvention = $pathfile.$cu."-CONV.pdf";
$pathfilerisk = $pathfile."/".$cu."-RISK.pdf";
$pathfiledemande = $pathfile."/".$cu."-DEM.pdf";
if(file_exists($pathfileconvention)){$fileconvention = true;}else{$fileconvention = false;}
if(file_exists($pathfilerisk)){$filerisk = true;}else{$filerisk = false;}
if(file_exists($pathfiledemande)){$filedemande = true;}else{$filedemande = false;}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Modification DPS - <?php echo $cu;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	<link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include 'header.php'; ?>
<script type="text/javascript" src="js/moment.js"></script>
<script src="js/moment-with-locales.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/bootstrap-datetimepicker.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/fr.js" type="text/javascript" charset="utf-8"></script>
<script src="js/fileinput.min.js" type="text/javascript"></script>
<script src="js/fileinput_locale_fr.js" type="text/javascript"></script>
<script src="js/bootstrap.file-input.js" type="text/javascript"></script>
<script src="js/validator.js" type="text/javascript"></script>
<div class="container">
		<?php if ($_SESSION['privilege'] == "admin") {?>
			<h2>Edition de la demande de DPS <span class="bg-info"><?php echo $cu; ?></span></h2>
			<?php
			if($_SESSION['commune'] == "0"){
			?>
			<div class="panel panel-warning">
					<div class="panel-heading">
						<h3 class="panel-title">Accès spécial DDO</h3>
					</div>
				<div class="panel-body">
					<div class="form-group form-group-sm">
					<form class="form-horizontal" role="form" action="traitement-demande-dps.php" method="post">
						<input type='hidden' name='demande_valid' value='<?php echo $dps['id'];?>'>
						<div class="form-group">
							<div class="col-sm-4">
								<button type="submit" class="btn btn-success" <?php if($dps['valid_demande_rt'] !=0){echo "disabled";}?>>Envoyer en validation</button>
							</div>
					</form>
					<form class="form-horizontal" role="form" action="traitement-demande-dps.php" method="post">
						<input type='hidden' name='valider' value='<?php echo $dps['id'];?>'>
							<div class="col-sm-4">
								<button type="submit" class="btn btn-success" <?php if($dps['valid_demande_rt'] ==0){echo "disabled";}?>>Valider la demande de DPS</button>
						    </div>
					</form>
					<div class="col-sm-4">
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalRefus" <?php if($dps['valid_demande_rt'] ==0){echo "disabled";}?>>Refuser la demande de DPS</button>
					</div>
						</div>
					</div>
				</div>
			</div>
			<?php }
			if($dps['etat_demande_dps'] == "2"){
			?>
			<div class="panel panel-danger">
				<div class="panel-heading">
					<h3 class="panel-title">Demande <strong>refusée</strong> par la Direction Départementale des Opérations</h3>
				</div>
				<div class="panel-body">
					<h4>Motif de refus :</h4>
					<blockquote>
						<p><?php echo $dps['motif_annul'];?></p>
					</blockquote>
					<h4>Détails :</h4>
					<blockquote>
						<p><?php echo $dps['administration'];?></p>
					</blockquote>
				</div>
			</div>
			<?php } ?>
			<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Gestion des fichiers <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Seuls les fichiers au format PDF sont acceptés"></span></h3>
					</div>
				<ul class="list-group">
					<li class="list-group-item">
				<div class="row" id="rowconvention" <?php if($fileconvention == true){echo "hidden";} ?>>
					<form action="#" class="upload1">
						<div class="form-group form-groupe-sm">
						<div class="col-sm-4">
							<input type="file" name="image" id="input_convention" accept="application/pdf" title="Ajouter la convention <span class='glyphicon glyphicon-folder-open'></span>" data-filename-placement="inside">
						</div>
						<div class="col-sm-4">
							<button class="btn btn-sm btn-info upload" id="submit_convention" type="submit">Envoyer <span class="glyphicon glyphicon-upload"></span></button>
							<button type="button" class="btn btn-sm btn-danger cancel">Annuler <span class="glyphicon glyphicon-trash"></span></button>
						</div>
						<div class="col-sm-4">
						<div class="progress progress-striped active">
							<div class="progress-bar" style="width:0%"></div>
							<?php
											echo "<input type='hidden' name='year' value='".$pathyear."'>";
											echo "<input type='hidden' name='antenne' value='".$pathantenne."'>";
											echo "<input type='hidden' name='num_cu' value='".$pathnum_cu."'>";
											echo "<input type='hidden' name='type' value='convention'>";
											echo "<input type='hidden' name='cu' value='".$cu."'>";
							?>
						</div>
						</div>
						</div>
					</form>
				</div>
				<?php if($fileconvention == true){?>
				<div class="row" id="changeconvention">
				<div class="form-group form-groupe-sm">
					<div class="col-sm-4">
					<a href="<?php echo $pathfileconvention?>" class="btn btn-primary" target="_blank">Télécharger la convention <span class="glyphicon glyphicon-download-alt"></span></a>
					</div>
					<div class="col-sm-4">
					<button id="changeconv" type="button" class="btn btn-danger">Envoyer une nouvelle convention <span class="glyphicon glyphicon-trash"></span></button>
					</div>
				</div>
				</div>
				<?php } ?>
				</li>
				<li class="list-group-item">
				<div class="row" id="rowrisque" <?php if($filerisk == true){echo "hidden";} ?>>
					<form action="#" class="upload2">
						<div class="form-group form-groupe-sm">
						<div class="col-sm-4">
							<input type="file" name="image" id="input_risk" accept="application/pdf" title="Ajouter la Grille des risques <span class='glyphicon glyphicon-folder-open'></span>" data-filename-placement="inside">
						</div>
						<div class="col-sm-4">
							<button class="btn btn-sm btn-info upload" id="submit_risk" type="submit">Envoyer <span class="glyphicon glyphicon-upload"></span></button>
							<button type="button" class="btn btn-sm btn-danger cancel">Annuler <span class="glyphicon glyphicon-trash"></span></button>
						</div>
						<div class="col-sm-4">
						<div class="progress progress-striped active">
							<div class="progress-bar" style="width:0%"></div>
							<?php
											echo "<input type='hidden' name='year' value='".$pathyear."'>";
											echo "<input type='hidden' name='antenne' value='".$pathantenne."'>";
											echo "<input type='hidden' name='num_cu' value='".$pathnum_cu."'>";
											echo "<input type='hidden' name='type' value='risk'>";
											echo "<input type='hidden' name='cu' value='".$cu."'>";
							?>
						</div>
						</div>
						</div>
					</form>
				</div>
				<?php if($filerisk == true){?>
				<div class="row" id="changerisque">
				<div class="form-group form-groupe-sm">
					<div class="col-sm-4">
					<a href="<?php echo $pathfilerisk?>" class="btn btn-primary" target="_blank">Télécharger la grille des risques <span class="glyphicon glyphicon-download-alt"></span></a>
					</div>
					<div class="col-sm-4">
					<button id="changerisk" type="button" class="btn btn-danger">Envoyer une nouvelle grille des risques <span class="glyphicon glyphicon-trash"></span></button>
					</div>
				</div>
				</div>
				<?php } ?>
				</li>
				<li class="list-group-item">
				<div class="row" id="rowdemande" <?php if($filedemande == true){echo "hidden";} ?>>
					<form action="#" class="upload3">
						<div class="form-group form-groupe-sm">
						<div class="col-sm-4">
							<input type="file" name="image" id="input_demande" accept="application/pdf" title="Ajouter la demande <span class='glyphicon glyphicon-folder-open'></span>" data-filename-placement="inside">
						</div>
						<div class="col-sm-4">
							<button class="btn btn-sm btn-info upload" id="submit_demande" type="submit">Envoyer <span class="glyphicon glyphicon-upload"></span></button>
							<button type="button" class="btn btn-sm btn-danger cancel">Annuler <span class="glyphicon glyphicon-trash"></span></button>
						</div>
						<div class="col-sm-4">
						<div class="progress progress-striped active">
							<div class="progress-bar" style="width:0%"></div>
							<?php
											echo "<input type='hidden' name='year' value='".$pathyear."'>";
											echo "<input type='hidden' name='antenne' value='".$pathantenne."'>";
											echo "<input type='hidden' name='num_cu' value='".$pathnum_cu."'>";
											echo "<input type='hidden' name='type' value='demande'>";
											echo "<input type='hidden' name='cu' value='".$cu."'>";
							?>
						</div>
						</div>
						</div>
					</form>
				</div>
				<?php if($filedemande == true){?>
				<div class="row" id="changedemande">
				<div class="form-group form-groupe-sm">
					<div class="col-sm-4">
					<a href="<?php echo $pathfiledemande?>" class="btn btn-primary" target="_blank">Télécharger la demande de DPS <span class="glyphicon glyphicon-download-alt"></span></a>
					</div>
					<div class="col-sm-4">
					<button id="changedem" type="button" class="btn btn-danger">Envoyer une nouvelle demande de DPS <span class="glyphicon glyphicon-trash"></span></button>
					</div>
				</div>
				</div>
				<?php } ?>
				</li>
				<li class="list-group-item">
				<div class="row">
					<form action="#" class="upload4">
						<div class="form-group form-groupe-sm">
						<div class="col-sm-4">
							<input type="file" name="image" id="input_demande" accept="application/pdf" title="Ajouter un autre document <span class='glyphicon glyphicon-folder-open'></span>" data-filename-placement="inside">
						</div>
						<div class="col-sm-4">
							<button class="btn btn-sm btn-info upload" id="submit_autre" type="submit">Envoyer <span class="glyphicon glyphicon-upload"></span></button>
							<button type="button" class="btn btn-sm btn-danger cancel">Annuler <span class="glyphicon glyphicon-trash"></span></button>
						</div>
						<div class="col-sm-4">
						<div class="progress progress-striped active">
							<div class="progress-bar" style="width:0%"></div>
							<?php
											echo "<input type='hidden' name='year' value='".$pathyear."'>";
											echo "<input type='hidden' name='antenne' value='".$pathantenne."'>";
											echo "<input type='hidden' name='num_cu' value='".$pathnum_cu."'>";
											echo "<input type='hidden' name='type' value='autre'>";
											echo "<input type='hidden' name='cu' value='".$cu."'>";
							?>
						</div>
						</div>
						</div>
					</form>
				</div>
				<div id="row">
				<?php
				$pdf = glob($pathfile.'autre/*.{pdf}', GLOB_BRACE);
				foreach($pdf as $otherfiles){
				echo "<p><a href='$otherfiles' target='_blank'><span class='glyphicon glyphicon-file'></span> ".basename($otherfiles)."</a></p>";}
				?>
				</div>
				</li>
				</ul>
							<script>
								$('input[type=file]').bootstrapFileInput();
								$('.file-inputs').bootstrapFileInput();
							</script>
			</div>
			
			<form class="form-horizontal" data-toggle="validator" role="form" action="traitement-demande-dps.php" method="post">
			<input type='hidden' name='update_id' value='<?php echo $dps['id'];?>'>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Organisateur</h3>
					</div>
				<div class="panel-body">
					<div class="form-group form-group-sm">
						<label for="nom_organisation" class="col-sm-4 control-label">Nom de l'organisation <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom de la société, association, collectivité, etc."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nom_organisation" name="nom_organisation" placeholder="Nom de l'organisation" value="<?php echo $dps['organisateur']; ?>" required>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="represente_par" class="col-sm-4 control-label">Représenté par <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Personne qui représente l'organisation."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="represente_par" name="represente_par" placeholder="Représentant" value="<?php echo $dps['representant_org']; ?>"required>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="qualite" class="col-sm-4 control-label">Qualité <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Statut du représentant."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="qualite" name="qualite" placeholder="Qualité" value="<?php echo $dps['qualite_org'];?>"required>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="adresse" class="col-sm-4 control-label">Adresse postale <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Adresse, code postale, ville."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" value="<?php echo $dps['adresse_org'];?>"required>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="telephone" class="col-sm-4 control-label">Téléphone <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Format 0XXXXXXXXX"></span></label>
						<div class="col-sm-8">
							<input type="tel" class="form-control" id="telephone" name="telephone" placeholder="telephone" value="<?php echo $dps['tel_org'];?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="fax" class="col-sm-4 control-label">Fax <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Format 0XXXXXXXXX"></span></label>
						<div class="col-sm-8">
							<input type="tel" class="form-control" id="fax" name="fax" placeholder="Fax" value="<?php echo $dps['fax_org'];?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="email" class="col-sm-4 control-label">E-mail <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Adresse e-mail du représentant ou de l'organisation."></span></label>
						<div class="col-sm-8">
							<input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo $dps['email_org'];?>">
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="deja_pref" class="col-sm-4 control-label">Dossier déjà déposé en préfecture ?</label>
						<div class="col-sm-8">
							<select class="form-control" name="deja_pref" id="deja_pref">
								<option value="false">Non</option>
								<option value="true" <?php if($dps['dossier_pref'] == true){ echo "selected";}?>>Oui</option>
							</select>
						</div>
					</div>
				</div>
			</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Nature de la manifestation</h3>
					</div>
					<div class="panel-body">
						<div class="form-group form-group-sm">
							<label for="nom_nature" class="col-sm-4 control-label">Nom / Nature <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Nom/Nature de la manifestation"></span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="nom_nature" name="nom_nature" placeholder="Nom / Nature" value="<?php echo $dps['description_manif'];?>"required>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="activite_descriptif" class="col-sm-4 control-label">Activité / Descriptif <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Descriptif court."></span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="activite_descriptif" name="activite_descriptif" placeholder="Activité / Descriptif" value="<?php echo $dps['activite'];?>"required>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="lieu_precis" class="col-sm-4 control-label">Lieu précis <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Adresse la plus précise possible du lieu de l'événement."></span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="lieu_precis" name="lieu_precis" placeholder="Adresse précise du lien de l'évenement" value="<?php echo $dps['adresse_manif'];?>"required>
							</div>
						</div>
						<div class="form-group form-group-sm form-inline row">
							<label for="date_debut" class="col-sm-4 control-label">Date et heure du début</label>
							<div class="col-sm-6">
								<div class='input-group date' id='date_debut' name="date_debut">
								<input type='text' class="form-control" id='date_debut' name="date_debut"required>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class='input-group date' id='heure_debut' name="heure_debut">
								<input type='text' class="form-control" id='heure_debut' name="heure_debut"required>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
							</div>
							<script type="text/javascript">
							$(function () {
								$('#date_debut').datetimepicker({
									locale: 'fr',
									format: 'YYYY-MM-DD',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom',
									defaultDate:'<?php $dps_debut = $dps['dps_debut'];
									if($dps_debut == 0000-00-00){$dps_debut = "2015-01-01";}
									echo $dps_debut;?>'
								});
							});
							$(function () {
								$('#heure_debut').datetimepicker({
									locale: 'fr',
									format: 'HHmm',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom',
									useCurrent:false,
									stepping:'5',
									defaultDate:'<?php $heure_debut = $dps['heure_debut'];
									if(empty($heure_debut)){$iso_heure_debut = "00:00";}else{
									$h_debut = substr($heure_debut,0,-2);
									$m_debut = substr($heure_debut,-2);
									$iso_heure_debut = $h_debut.':'.$m_debut.':00';}
									echo $dps_debut.' '.$iso_heure_debut;
									?>'
								});
							});
							</script>
						</div>
						<div class="form-group form-group-sm form-inline row">
							<label for="date_debut" class="col-sm-4 control-label">Date et heure de fin de poste</label>
							<div class="col-sm-6">
								<div class='input-group date' id='date_fin' name="date_fin">
								<input type='text' class="form-control" id='date_fin' name="date_fin" required>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class='input-group date' id='heure_fin' name="heure_fin">
								<input type='text' class="form-control" id='heure_fin' name="heure_fin" required>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
							</div>
							<script type="text/javascript">
							$(function () {
								$('#date_fin').datetimepicker({
									locale: 'fr',
									format: 'YYYY-MM-DD',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom',
									defaultDate:'<?php $dps_fin = $dps['dps_fin'];
									if($dps_fin == "0000-00-00"){$dps_fin = "2015-01-01";}
									echo $dps_fin;?>'
					
								});
							});
							$(function () {
								$('#heure_fin').datetimepicker({
									locale: 'fr',
									format: 'HHmm',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom',
									useCurrent:false,
									stepping:'5',
									defaultDate:'<?php $heure_fin = $dps['heure_fin'];
									if(empty($heure_fin)){$iso_heure_fin = "00:00";}else{
									$h_fin = substr($heure_fin,0,-2);
									$m_fin = substr($heure_fin,-2);
									$iso_heure_fin = $h_fin.':'.$m_fin.':00';}
									echo $dps_fin.' '.$iso_heure_fin;
									?>'
					
								});
							});
							</script>
						</div>
						<div class="form-group form-group-sm">
							<label for="departement" class="col-sm-4 control-label">Département où se situe la manifestation <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Exemple : 92"></span></label>
							<div class="col-sm-8">
								<input type="number" class="form-control" id="departement" name="departement" placeholder="Département" value="<?php echo $dps['dept'];?>"required>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="prix" class="col-sm-4 control-label">Prix <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Tarif facturé au client."></span></label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="number" class="form-control" id="prix" name="prix" placeholder="Prix" value="<?php echo $dps['prix'];?>"required>
									<div class="input-group-addon">euros
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Dimensionnement du poste <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Permet le calcul de la grille des risques."></span></h3>
					</div>
					<div class="panel-body">
						<div class="form-group form-group-sm">
							<label for="spectateurs" class="col-sm-4 control-label">Nombre de spectateurs <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Chiffres uniquement."></span></label>
							<div class="col-sm-8">
								<input type="number" class="form-control risp" id="spectateurs" name="spectateurs" placeholder="Spectateurs" value="<?php if($dps['p1_spec'] == null){echo '0';}else{echo $dps['p1_spec'];};?>"required>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="participants" class="col-sm-4 control-label">Nombre de participants <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Chiffres uniquement."></span></label>
							<div class="col-sm-8">
								<input type="number" class="form-control risp" id="participants" name="participants" placeholder="Participants" value="<?php if($dps['p1_part'] == null){echo '0';}else{echo $dps['p1_part'];};?>"required>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="activite" class="col-sm-4 control-label">Activité du rassemblement </label>
							<div class="col-sm-8">
								<select class="form-control risi" id="activite" name="activite">
									<option value="1" <?php if($dps['p2'] == "1"){ echo "selected";}?>>Public assis (spectacle, réunion, restauration, etc.)</option>
									<option value="2" <?php if($dps['p2'] == "2"){ echo "selected";}?>>Public debout (Exposition, foire, salon, exposition, etc.)</option>
									<option value="3" <?php if($dps['p2'] == "3"){ echo "selected";}?>>Public debout actif (Spectacle avec public statique, fête foraine, etc.)</option>
									<option value="4" <?php if($dps['p2'] == "4"){ echo "selected";}?>>Public debout à risque (public dynamique, danse, féria, carnaval, etc.)</option>
								</select>
								<span class="help-block">Niveau de risque (P2)</span>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="environnement" class="col-sm-4 control-label">Environnement et accessibilité</label>
							<div class="col-sm-8">
								<select class="form-control risi" id="environnement" name="environnement">
									<option value="1" <?php if($dps['e1'] == "1"){ echo "selected";}?>>Faible (Structure permanente, voies publiques, etc.)</option>
									<option value="2" <?php if($dps['e1'] == "2"){ echo "selected";}?>>Modéré (Gradins, tribunes, mois de 2 hectares, etc.)</option>
									<option value="3" <?php if($dps['e1'] == "3"){ echo "selected";}?>>Moyen (Entre 2 et 5 hectares, autres conditions, etc.)</option>
									<option value="4" <?php if($dps['e1'] == "4"){ echo "selected";}?>>Elevé (Brancardage > 600m, pas d'accès VPSP, etc.)</option>
								</select>
								<span class="help-block">Caractéristiques de l'environnement et accessibilité du site (E1)</span>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="delai" class="col-sm-4 control-label">Délai d'intervention des secours publics</label>
							<div class="col-sm-8">
								<select class="form-control risi" id="delai" name="delai">
									<option value="1" <?php if($dps['e2'] == "1"){ echo "selected";}?>>Faible (Moins de 10 minutes)</option>
									<option value="2" <?php if($dps['e2'] == "2"){ echo "selected";}?>>Modéré (Entre 10 et 20 minutes)</option>
									<option value="3" <?php if($dps['e2'] == "3"){ echo "selected";}?>>Moyen (Entre 20 et 30 minutes)</option>
									<option value="4" <?php if($dps['e2'] == "4"){ echo "selected";}?>>Elevé (Plus de 30 minutes)</option>
								</select>
								<span class="help-block">Délai d'intervention (E2)</span>
							</div>
						</div>
						<textarea class="form-control" rows="4" id="commentaire_ris" name="commentaire_ris" placeholder="Indiquer ici tout commentaire(s) concernant le RIS"><?php echo $dps['comment_ris'];?></textarea>
						<span class="help-block">Commentaires concernant le RIS</span>
                        <div class="alert " id="resultatris" role="alert">
                            <h4>Grille d'évaluation des risques</h4>
                            <p>Classification du type de poste : <strong><span id="typeposte"></span></strong><br>
                            Nombre de secouristes : <strong><span id="nbsec"></span></strong></p>
                            <p id="grosris"><strong><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Attention !</strong> Ce type de poste impose un contact avec la DDO.</p>                           
                       </div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Configuration du dispositif prévisionnel de secours mis en place</h3>
					</div>
					<div class="panel-body">
						<div class="form-group form-group-sm form-inline row">
							<label for="date_debut_poste" class="col-sm-4 control-label">Date et heure du début de poste</label>
							<div class="col-sm-6">
								<div class='input-group date' id='date_debut_poste' name="date_debut_poste">
								<input type='text' class="form-control" id='date_debut_poste' name="date_debut_poste"required>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class='input-group date' id='heure_debut_poste' name="heure_debut_poste">
								<input type='text' class="form-control" id='heure_debut_poste' name="heure_debut_poste"required>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
							</div>
							<script type="text/javascript">
							$(function () {
								$('#date_debut_poste').datetimepicker({
									locale: 'fr',
									format: 'YYYY-MM-DD',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom',
									defaultDate:'<?php $dps_debut_poste = $dps['dps_debut_poste'];
									if($dps_debut_poste == 0000-00-00){$dps_debut_poste = "2015-01-01";}
									echo $dps_debut_poste;?>'
								});
							});
							$(function () {
								$('#heure_debut_poste').datetimepicker({
									locale: 'fr',
									format: 'HHmm',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom',
									useCurrent:false,
									stepping:'5',
									defaultDate:'<?php $heure_debut_poste = $dps['heure_debut_poste'];
									if(empty($heure_debut_poste)){$iso_heure_debut_poste = "00:00";}else{
									$h_debut_poste = substr($heure_debut_poste,0,-2);
									$m_debut_poste = substr($heure_debut_poste,-2);
									$iso_heure_debut_poste = $h_debut_poste.':'.$m_debut_poste.':00';}
									echo $dps_debut_poste.' '.$iso_heure_debut_poste;
									?>'
								});
							});
							</script>
						</div>
						<div class="form-group form-group-sm form-inline row">
							<label for="date_debut_poste" class="col-sm-4 control-label">Date et heure de fin de poste</label>
							<div class="col-sm-6">
								<div class='input-group date' id='date_fin_poste' name="date_fin_poste">
								<input type='text' class="form-control" id='date_fin_poste' name="date_fin_poste"required>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
							<div class="col-sm-2">
								<div class='input-group date' id='heure_fin_poste' name="heure_fin_poste">
								<input type='text' class="form-control" id='heure_fin_poste' name="heure_fin_poste"required>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
							</div>
							<script type="text/javascript">
							$(function () {
								$('#date_fin_poste').datetimepicker({
									locale: 'fr',
									format: 'YYYY-MM-DD',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom',
									defaultDate:'<?php $dps_fin_poste = $dps['dps_fin_poste'];
									if($dps_fin_poste == "0000-00-00"){$dps_fin_poste = "2015-01-01";}
									echo $dps_fin_poste;?>'
					
								});
							});
							$(function () {
								$('#heure_fin_poste').datetimepicker({
									locale: 'fr',
									format: 'HHmm',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom',
									useCurrent:false,
									stepping:'5',
									defaultDate:'<?php $heure_fin_poste = $dps['heure_fin_poste'];
									if(empty($heure_fin_poste)){$iso_heure_fin_poste = "00:00";}else{
									$h_fin_poste = substr($heure_fin_poste,0,-2);
									$m_fin_poste = substr($heure_fin_poste,-2);
									$iso_heure_fin_poste = $h_fin_poste.':'.$m_fin_poste.':00';}
									echo $dps_fin_poste.' '.$iso_heure_fin_poste;
									?>'
					
								});
							});
							</script>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">Nombre de secouristes / moyens logistiques <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Permet la comparaison avec la grille des risques."></span></div>
							<div class="panel-body">
								<div class="form-group form-group-sm">
									<label for="nb_ce" class="col-sm-4 control-label">Chef(s) d'équipe</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="nb_ce" name="nb_ce" placeholder="00" value="<?php echo $dps['cei'];?>">
									</div>
									<label for="nb-pse2" class="col-sm-4 control-label">PSE2</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="nb_pse2" name="nb_pse2" placeholder="00" value="<?php echo $dps['PSE2'];?>">
									</div>
									<label for="nb_pse1" class="col-sm-4 control-label">PSE1</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="nb_pse1" name="nb_pse1" placeholder="00" value="<?php echo $dps['PSE1'];?>">
									</div>
									<label for="nb_psc1" class="col-sm-4 control-label">PSC1</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="nb_psc1" name="nb_psc1" placeholder="00" value="<?php echo $dps['PSC1'];?>">
									</div>
								</div>
							</div>
							<div class="panel-body">
								<div class="form-group form-group-sm">
									<label for="vpsp_transport" class="col-sm-4 control-label">VPSP transport</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="vpsp_transport" name="vpsp_transport" placeholder="00" value="<?php echo $dps['vpsp'];?>">
									</div>
									<label for="vpsp_soin" class="col-sm-4 control-label">VPSP soin</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="vpsp_soin" name="vpsp_soin" placeholder="00" value="<?php echo $dps['vpsp_soin'];?>">
									</div>
									<label for="vl" class="col-sm-4 control-label">Véhicule Léger</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="vl" name="vl" placeholder="00" value="<?php echo $dps['vl'];?>">
									</div>
									<label for="tente" class="col-sm-4 control-label">Tente</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="tente" name="tente" placeholder="00" value="<?php echo $dps['tente'];?>">
									</div>
								</div>
								<div class="form-group form-group-sm">
									<label for="local" class="col-sm-4 control-label">Local</label>
									<div class="col-sm-8">
										<select class="form-control" id="local" name="local">
											<option value="false" <?php if($dps['local'] == true){ echo "selected";}?>>Non</option>
											<option value="true" <?php if($dps['local'] == false){ echo "selected";}?>>Oui</option>
										</select>
									</div>
								</div>
								<div class="form-group form-group-sm">
									<label for="supplement" class="col-sm-4 control-label">Moyens humains / logistiques supplémentaires</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="supplement" name="supplement" placeholder="entrer ici tout moyen supplémentaire" value="<?php echo $dps['moyen_supp'];?>">
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">Moyens médicaux / structures</div>
							<div class="panel-body">
								<div class="form-group form-group-sm">
									<label for="medecin_asso" class="col-sm-4 control-label">Nombre médecin associatif</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="medecin_asso" name="medecin_asso" placeholder="00" value="<?php echo $dps['med_asso'];?>">
									</div>
									<label for="medecin_autre" class="col-sm-4 control-label">Nombre médecin autre</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="medecin_autre" name="medecin_autre" placeholder="00" value="<?php echo $dps['med_autre'];?>">
									</div>
									<label for="medecin_appartenance" class="col-sm-4 control-label">Appartenance</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="medecin_appartenance" name="medecin_appartenance" placeholder="Appartenance" value="<?php echo $dps['medecin'];?>">
									</div>
								</div>
								<div class="form-group form-group-sm">
									<label for="infirmier_asso" class="col-sm-4 control-label">Nombre d'infirmier associatif</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="infirmier_asso" name="infirmier_asso" placeholder="00" value="<?php echo $dps['inf_asso'];?>">
									</div>
									<label for="infirmier_autre" class="col-sm-4 control-label">Nombre d'infirmier autre</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="infirmier_autre" name="infirmier_autre" placeholder="00" value="<?php echo $dps['inf_autre'];?>">
									</div>
									<label for="infirmier_appartenance" class="col-sm-4 control-label">Appartenance</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="infirmier_appartenance" name="infirmier_appartenance" placeholder="Appartenance" value="<?php echo $dps['infirmier'];?>">
									</div>
								</div>
								<div class="form-group form-group-sm">
									<label for="samu" class="col-sm-4 control-label">SAMU</label>
									<div class="col-sm-2">
										<select class="form-control" id="samu" name="samu">
											<option value="0" <?php if($dps['samu'] == "0"){ echo "selected";}?>>Ni informé, ni présent</option>
											<option value="1" <?php if($dps['samu'] == "1"){ echo "selected";}?>>Informé, non présent</option>
											<option value="2" <?php if($dps['samu'] == "2"){ echo "selected";}?>>Informé et présent</option>
										</select>
									</div>
									<label for="bspp_sdis" class="col-sm-4 control-label">SDIS / BSPP</label>
									<div class="col-sm-2">
										<select class="form-control" id="bspp_sdis" name="bspp_sdis">
											<option value="0" <?php if($dps['pompier'] == "0"){ echo "selected";}?>>Ni informé, ni présent</option>
											<option value="1" <?php if($dps['pompier'] == "1"){ echo "selected";}?>>Informé, non présent</option>
											<option value="2" <?php if($dps['pompier'] == "2"){ echo "selected";}?>>Informé et présent</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Justificatif du dispositif mis en place</h3>
					</div>
					<div class="panel-body">
						<textarea class="form-control" rows="5" id="justificatif" name="justificatif" placeholder="Indiquer tout justificatif sur les moyens, structures, etc. ou toute information utile pour la bonne gestion administrative du poste." ><?php echo $dps['justif_poste'];?></textarea>
					</div>
				</div>
<?php
				echo "<input type='hidden' name='year' value='".$dps['annee_poste']."'>";
				echo "<input type='hidden' name='code_commune' value='".$dps['commune_ris']."'>";
				echo "<input type='hidden' name='num_cu' value='".$dps['num_cu']."'>";
?>
				
				<!-- ATTENTION - LA VALIDATION NE FONCTIONNE PAS SUR ENVOYER : REVOIR FONCTIONNEMENT FORMULAIRE GLOBAL-->
				<div class="form-group">
					<div class="col-sm-4">
						<button type="submit" class="btn btn-warning">Mettre à jour</button>
				    </div>
			</form>
			<form class="form-horizontal" role="form" action="traitement-demande-dps.php" method="post">
				<input type='hidden' name='demande_valid' value='<?php echo $dps['id'];?>'>
					<div class="col-sm-8">
						<button type="submit" class="btn btn-success" <?php if($dps['valid_demande_rt'] !=0){echo "disabled";}?>>Envoyer en validation</button>
				    </div>
				</div>
			</form>

			
			
			
<!-- Modal refus -->
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
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-danger">Refuser</button>
		</form>
		</div>
		</div>
	</div>
</div>
			
		<?php }if ($_SESSION['privilege'] == "user") { ?>
  		<strong>En tant qu'utilisateur simple vous ne pouvez pas effectuer d'actions</strong> <?php }?>
</div>
<script type="text/javascript">
    $(function () {
        $("[rel='tooltip']").tooltip();
    });
	$(function () {
		$('[data-toggle="popover"]').popover()
	})
</script>
<script>
		$('.upload-all').click(function(){
			//submit all form
			$('form').submit();
		});

		$('.cancel-all').click(function(){
			//submit all form
			$('form .cancel').click();
		});

		$(document).on('submit','.upload1',function(e){
			e.preventDefault();
			$form = $(this);
			uploadImage($form);

		});
		
		$(document).on('submit','.upload2',function(e){
			e.preventDefault();
			$form = $(this);
			uploadImage($form);
		});
		$(document).on('submit','.upload3',function(e){
			e.preventDefault();
			$form = $(this);
			uploadImage($form);
		});
		$(document).on('submit','.upload4',function(e){
			e.preventDefault();
			$form = $(this);
			uploadImage($form);
		});

		function uploadImage($form){
			$form.find('.progress-bar').removeClass('progress-bar-success')
										.removeClass('progress-bar-danger');

			var formdata = new FormData($form[0]); //formelement
			var request = new XMLHttpRequest();

			//progress event...
			request.upload.addEventListener('progress',function(e){
				var percent = Math.round(e.loaded/e.total * 100);
				$form.find('.progress-bar').width(percent+'%').html(percent+'%');
			});

			//progress completed load event
			request.addEventListener('load',function(e){
				$form.find('.progress-bar').addClass('progress-bar-success').html('Veuillez patienter...');
				//$form.find('.progress').removeClass('progress-striped');
				
				
				
			});

			request.onreadystatechange = function(){
				if(request.readyState == 4 && request.status == 200){
					$form.find('.progress').removeClass('progress-striped');
					$form.find('.progress-bar').html('Transfert Terminé !');
					window.setTimeout(function(){location.reload()},2000);
					
				}
			}
			request.open('POST', 'functions/dps-documents-upload.php', true);
			request.send(formdata);
			
			
			

			$form.on('click','.cancel',function(){
				request.abort();

				$form.find('.progress-bar')
					.addClass('progress-bar-danger')
					.removeClass('progress-bar-success')
					.html('upload aborted...');
			});

		}
</script>

<script type="text/javascript">
	jQuery.fx.off = true
	$("#changeconv").click(function() {
	$("#rowconvention").removeAttr('hidden')
	$("#changeconvention").toggle("hidden")});
	$("#changerisk").click(function() {
	$("#rowrisque").removeAttr('hidden')
	$("#changerisque").toggle("hidden")});
	$("#changedem").click(function() {
	$("#rowdemande").removeAttr('hidden')
	$("#changedemande").toggle("hidden")});
</script>

<script src='js/dps-compute-ris.js' type='text/javascript'></script>

<?php require_once('components/footer.php'); ?>
</body>
</html>

