<?php
include 'securite.php';
require_once('connexion.php');
if ($_SESSION['privilege'] != "admin") { header("Location: accueil.php"); }else{
if(isset($_POST['commune_dps'])){
	$commune_dps = $_POST['commune_dps'];}
	else{
	$commune_dps = $_SESSION['commune'];
	}
$dept = "92";
$year = date("y");
$query_code = "SELECT nomcode FROM commune WHERE numero=$commune_dps";
$code_result = mysqli_query($link, $query_code);
$code_array = mysqli_fetch_array($code_result);
$code_commune = $code_array['nomcode'];
mysqli_free_result($code_result);
$query_cu = "SELECT num_cu FROM demande_dps WHERE annee_poste=$year AND commune_ris=$commune_dps ORDER BY id DESC LIMIT 1";
$cu_result = mysqli_query($link, $query_cu);
$cu_array = mysqli_fetch_array($cu_result);
$num_cu = $cu_array['num_cu'];
$num_cu = $num_cu + 1;
if($num_cu < 10){
	$num_cu = "00".$num_cu;
}elseif($num_cu < 100){
	$num_cu = "0".$num_cu;
}
$cu = $dept."-".$year."-".$code_commune."-".$num_cu;
$org_id="";
if(isset($_POST['org_id'])){
	$org_id = $_POST['org_id'];
	$query_org_fill = "SELECT * FROM organisateurs WHERE id=$org_id";
	$org_fill = mysqli_query($link, $query_org_fill);
	$org_array = mysqli_fetch_array($org_fill);
}
$duplicate_dps="";
if(isset($_POST['duplicate_dps'])){
	$duplicate_dps_id = $_POST['duplicate_dps'];
	$query_duplicate_fill = "SELECT * FROM demande_dps WHERE id=$duplicate_dps_id";
	$duplicate_fill = mysqli_query($link, $query_duplicate_fill);
	$duplicate_array = mysqli_fetch_array($duplicate_fill);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Demande DPS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
	<link href="css/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include 'header.php'; ?>
<script type="text/javascript" src="js/moment.js"></script>
<script src="js/moment-with-locales.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/bootstrap-datetimepicker.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/fr.js" type="text/javascript" charset="utf-8"></script>
<script src="js/fileinput.js" type="text/javascript"></script>
<script src="js/validator.js" type="text/javascript"></script>
<div class="container">
<?php if(isset($_POST['duplicate_dps'])){?>
<div class='alert alert-warning'><span class="glyphicon glyphicon-alert" style="font-size:2em"></span> <strong>Attention : </strong>Tous les champs ne sont pas dupliqués.<br>Vous devez vérifier tous les champs avant d'envoyer en validation.</div>
<?php }?>
		<?php if ($_SESSION['privilege'] == "admin") {?>
			<h2>Formulaire : Demande de DPS</h2>
			<h3>Demande : <?php echo $cu; ?></h3>
			
			<?php
			if($_SESSION['commune'] == "0"){
			?>
			<div class="panel panel-warning">
					<div class="panel-heading">
						<h3 class="panel-title">Accès spécial DDO</h3>
					</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" action="" method="post">
					<div class="form-group form-group-sm">
						<label for="commune_dps" class="col-sm-4 control-label">Antenne :</label>
						<div class="col-sm-4">
							<select class="form-control" name="commune_dps" id="comune_dps">
								<?php
								$listecommune_query = "SELECT numero_commune, nom_commune FROM rat_com";
								$listecommune_result = mysqli_query($link, $listecommune_query);
								while($listecommune = mysqli_fetch_array($listecommune_result)){
								if($listecommune["numero_commune"] == $commune_dps){
								echo "<option value='".$listecommune["numero_commune"]."' selected>".$listecommune["nom_commune"]."</option>";
								}else{
								echo "<option value='".$listecommune["numero_commune"]."'>".$listecommune["nom_commune"]."</option>";
								}}
								?>
							</select>
						</div>
						<div class="btn-group col-sm-4" role="group">
							<button type="submit" class="btn btn-warning">Selectionner</button>
						</div>
					</div>
					</form>
				</div>
			</div>
			<?php }?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Aide à la demande de DPS</h3>
				</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" action="" method="post">
				<div class="form-group form-group-sm">
					<label for="org_id" class="col-sm-4 control-label">Organisateur pré-enregistré :</label>
					<div class="col-sm-4">
						<select class="form-control" name="org_id" id="org_id">
							<?php
							$query_org = "SELECT * FROM organisateurs WHERE commune=$commune_dps ORDER BY id ASC";
							$org_result = mysqli_query($link, $query_org);
							while($org = mysqli_fetch_array($org_result)){
							if($org_id == $org['id']){
							echo "<option value='".$org["id"]."' selected>".$org["ref"]."</option>";
							}else{
							echo "<option value='".$org["id"]."'>".$org["ref"]."</option>";
							}}
							echo "<input type='hidden' name='commune_dps' value='".$commune_dps."'>";
							?>
						</select>
					</div>
					<div class="btn-group col-sm-4" role="group">
						<button type="submit" class="btn btn-warning">Selectionner</button>
					</div>
				</div>
				</form>
				<form class="form-horizontal" role="form" action="" method="post">
					<div class="form-group form-group-sm">
						<label for="duplicate_dps" class="col-sm-4 control-label">Dupliquer le poste :</label>
						<div class="col-sm-4">
							<select class="form-control" name="duplicate_dps" id="duplicate_dps">
								<?php
								$listecu_query = "SELECT id, cu_complet FROM demande_dps WHERE commune_ris=$commune_dps ORDER BY id DESC LIMIT 50";
								$listecu_result = mysqli_query($link, $listecu_query);
								while($listecu = mysqli_fetch_array($listecu_result)){
								echo "<option value='".$listecu["id"]."'>".$listecu["cu_complet"]."</option>";
								}
								?>
							</select>
						</div>
						<div class="btn-group col-sm-4" role="group">
							<button type="submit" class="btn btn-warning">Selectionner</button>
						</div>
					</div>
					</form>
			</div>
			</div>
			
			<form class="form-horizontal" data-toggle="validator" role="form" action="traitement-demande-dps.php" method="post">
			<input type='hidden' name='cu' value='<?php echo $cu;?>'>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Organisateur</h3>
					</div>
				<div class="panel-body">
					<div class="form-group form-group-sm">
						<label for="nom_organisation" class="col-sm-4 control-label">Nom de l'organisation <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom de la société, association, collectivité, etc."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nom_organisation" name="nom_organisation" placeholder="Nom de l'organisation" value="<?php if(isset($org_array['nom'])){echo $org_array['nom'];}elseif(isset($duplicate_array['organisateur'])){echo $duplicate_array['organisateur'];}?>" required>
                            <div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="represente_par" class="col-sm-4 control-label">Représenté par <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Personne qui représente l'organisation."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="represente_par" name="represente_par" placeholder="Représentant" value="<?php if(isset($org_array['represente'])){echo $org_array['represente'];}elseif(isset($duplicate_array['representant_org'])){echo $duplicate_array['representant_org'];}?>" required>
                            <div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="qualite" class="col-sm-4 control-label">Qualité <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Statut du représentant."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="qualite" name="qualite" placeholder="Qualité" value="<?php if(isset($org_array['qualite'])){echo $org_array['qualite'];}elseif(isset($duplicate_array['qualite_org'])){echo $duplicate_array['qualite_org'];}?>" required>
                            <div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="adresse" class="col-sm-4 control-label">Adresse postale <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Adresse, code postale, ville."></span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" value="<?php if(isset($org_array['adresse'])){echo $org_array['adresse'];}elseif(isset($duplicate_array['adresse_org'])){echo $duplicate_array['adresse_org'];}?>" data-minlength="6" required>
                            <div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="telephone" class="col-sm-4 control-label">Téléphone <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Format 0XXXXXXXXX"></span></label>
						<div class="col-sm-8">
							<input type="tel" class="form-control" id="telephone" name="telephone" placeholder="telephone" value="<?php if(isset($org_array['telephone'])){echo $org_array['telephone'];}elseif(isset($duplicate_array['tel_org'])){echo $duplicate_array['tel_org'];}?>" data-minlength="10" required>
                            <div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="fax" class="col-sm-4 control-label">Fax <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Format 0XXXXXXXXX"></span></label>
						<div class="col-sm-8">
							<input type="tel" class="form-control" id="fax" name="fax" placeholder="Fax" value="<?php if(isset($org_array['fax'])){echo $org_array['fax'];}elseif(isset($duplicate_array['fax_org'])){echo $duplicate_array['fax_org'];}?>"data-minlength="10">
                            <div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="email" class="col-sm-4 control-label">E-mail <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Adresse e-mail du représentant ou de l'organisation."></span></label>
						<div class="col-sm-8">
							<input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php if(isset($org_array['email'])){echo $org_array['email'];}elseif(isset($duplicate_array['email_org'])){echo $duplicate_array['email_org'];}?>" required>
                            <div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group form-group-sm">
						<label for="deja_pref" class="col-sm-4 control-label">Dossier déjà déposé en préfecture ?</label>
						<div class="col-sm-8">
							<select class="form-control" name="deja_pref" id="deja_pref">
								<option value="false">Non</option>
								<option value="true">Oui</option>
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
							<label for="nom_nature" class="col-sm-4 control-label">Nom / Nature <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom/Nature de la manifestation"></span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="nom_nature" name="nom_nature" placeholder="Nom / Nature" value="<?php if(isset($duplicate_array['description_manif'])){echo $duplicate_array['description_manif'];} ?>" required>
                                <div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="activite_descriptif" class="col-sm-4 control-label">Activité / Descriptif <span class="glyphicon glyphicon-info-sign" data-trigger="hover" rel="popover" data-toggle="popover" data-content="Descriptif court."></span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="activite_descriptif" name="activite_descriptif" placeholder="Activité / Descriptif" value="<?php if(isset($duplicate_array['activite'])){echo $duplicate_array['activite'];} ?>" required>
                                <div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="lieu_precis" class="col-sm-4 control-label">Lieu précis <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Adresse la plus précise possible du lieu de l'événement."></span></label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="lieu_precis" name="lieu_precis" placeholder="Adresse précise du lien de l'évenement" value="<?php if(isset($duplicate_array['adresse_manif'])){echo $duplicate_array['adresse_manif'];} ?>" required>
                                <div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="form-group form-group-sm form-inline row datetimestart">
							<label for="date_debut" class="col-sm-4 control-label">Date et heure du début</label>
							<div class="col-sm-6">
								<div class='input-group date' id='date_debut' name="date_debut">
								<input type='text' class="form-control" id='date_debut' name="date_debut" value=""/ required>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
                                <div class="help-block with-errors"></div>
							</div>
							<div class="col-sm-2">
								<div class='input-group date' id='heure_debut' name="heure_debut">
								<input type='text' class="form-control" id='heure_debut' name="heure_debut" required/>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
                                <div class="help-block with-errors"></div>
							</div>
							<script type="text/javascript">
							$(function () {
								$('#date_debut').datetimepicker({
									locale: 'fr',
									format: 'YYYY-MM-DD',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom',
					
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
									stepping:'5'
					
								});
							});
							</script>
						</div>
						<div class="form-group form-group-sm form-inline row">
							<label for="date_fin" class="col-sm-4 control-label">Date et heure de fin</label>
							<div class="col-sm-6">
								<div class='input-group date' id='date_fin' name="date_fin">
								<input type='text' class="form-control" id='date_fin' name="date_fin" required/>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
                                <div class="help-block with-errors"></div>
							</div>
							<div class="col-sm-2">
								<div class='input-group date' id='heure_fin' name="heure_fin">
								<input type='text' class="form-control" id='heure_fin' name="heure_fin" required/>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
                                <div class="help-block with-errors"></div>
							</div>
							<script type="text/javascript">
							$(function () {
								$('#date_fin').datetimepicker({
									locale: 'fr',
									format: 'YYYY-MM-DD',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom'
					
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
									stepping:'5'
					
								});
							});
							</script>
						</div>
						<div class="form-group form-group-sm">
							<label for="departement" class="col-sm-4 control-label">Département où se situe la manifestation <span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Exemple : 92"></span></label>
							<div class="col-sm-8">
								<input type="number" class="form-control" id="departement" name="departement" placeholder="Département" value="<?php if(isset($duplicate_array['dept'])){echo $duplicate_array['dept'];} ?>" required>
                                <div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="prix" class="col-sm-4 control-label">Prix <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Tarif facturé au client."></span></label>
							<div class="col-sm-8">
								<div class="input-group">
									<input type="number" class="form-control" id="prix" name="prix" placeholder="Prix" value="<?php if(isset($duplicate_array['prix'])){echo $duplicate_array['prix'];} ?>" required>
									<div class="input-group-addon">euros
									</div>
								</div>
                                <div class="help-block with-errors"></div>
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
							<label for="spectateurs" class="col-sm-4 control-label">Nombre de spectateurs <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Chiffres uniquement."></span></label>
							<div class="col-sm-8">
								<input type="number" class="form-control risp" id="spectateurs" name="spectateurs" placeholder="Spectateurs" required>
                                <div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="participants" class="col-sm-4 control-label">Nombre de participants <span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Chiffres uniquement."></span></label>
							<div class="col-sm-8">
								<input type="number" class="form-control risp" id="participants" name="participants" placeholder="Participants" required>
                                <div class="help-block with-errors"></div>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="activite" class="col-sm-4 control-label">Activité du rassemblement </label>
							<div class="col-sm-8">
								<select class="form-control risi" id="activite" name="activite" required>
									<option value="1">Public assis (spectacle, réunion, restauration, etc.)</option>
									<option value="2">Public debout (Exposition, foire, salon, exposition, etc.)</option>
									<option value="3">Public debout actif (Spectacle avec public statique, fête foraine, etc.)</option>
									<option value="4">Public debout à risque (public dynamique, danse, féria, carnaval, etc.)</option>
								</select>
                                <div class="help-block with-errors"></div>
								<span class="help-block">Niveau de risque (P2)</span>
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="environnement" class="col-sm-4 control-label">Environnement et accessibilité</label>
							<div class="col-sm-8">
								<select class="form-control risi" id="environnement" name="environnement" required>
									<option value="1">Faible (Structure permanente, voies publiques, etc.)</option>
									<option value="2">Modéré (Gradins, tribunes, mois de 2 hectares, etc.)</option>
									<option value="3">Moyen (Entre 2 et 5 hectares, autres conditions, etc.)</option>
									<option value="4">Elevé (Brancardage > 600m, pas d'accès VPSP, etc.)</option>
								</select>
                                <div class="help-block with-errors"></div>
								<span class="help-block">Caractéristiques de l'environnement et accessibilité du site (E1)</span>
                                <div id="e1"></div>
                                
							</div>
						</div>
						<div class="form-group form-group-sm">
							<label for="delai" class="col-sm-4 control-label">Délai d'intervention des secours publics</label>
							<div class="col-sm-8">
								<select class="form-control risi" id="delai" name="delai" required>
									<option value="1">Faible (Moins de 10 minutes)</option>
									<option value="2">Modéré (Entre 10 et 20 minutes)</option>
									<option value="3">Moyen (Entre 20 et 30 minutes)</option>
									<option value="4">Elevé (Plus de 30 minutes)</option>
								</select>
                                <div class="help-block with-errors"></div>
								<span class="help-block">Délai d'intervention (E2)</span>
							</div>
						</div>
						<textarea class="form-control" rows="4" id="commentaire_ris" name="commentaire_ris" placeholder="Indiquer ici tout commentaire(s) concernant le RIS"></textarea>
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
								<input type='text' class="form-control" id='date_debut_poste' name="date_debut_poste" value="" required/>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
                                <div class="help-block with-errors"></div>
							</div>
							<div class="col-sm-2">
								<div class='input-group date' id='heure_debut_poste' name="heure_debut_poste">
								<input type='text' class="form-control" id='heure_debut_poste' name="heure_debut_poste" required/>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
                                <div class="help-block with-errors"></div>
							</div>
							<script type="text/javascript">
							$(function () {
								$('#date_debut_poste').datetimepicker({
									locale: 'fr',
									format: 'YYYY-MM-DD',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom',
					
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
									stepping:'5'
					
								});
							});
							</script>
						</div>
						<div class="form-group form-group-sm form-inline row">
							<label for="date_fin_poste" class="col-sm-4 control-label">Date et heure de fin de poste</label>
							<div class="col-sm-6">
								<div class='input-group date' id='date_fin_poste' name="date_fin_poste">
								<input type='text' class="form-control" id='date_fin_poste' name="date_fin_poste" required/>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
                                <div class="help-block with-errors"></div>
							</div>
							<div class="col-sm-2">
								<div class='input-group date' id='heure_fin_poste' name="heure_fin_poste">
								<input type='text' class="form-control" id='heure_fin_poste' name="heure_fin_poste" required/>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
                                <div class="help-block with-errors"></div>
							</div>
							<script type="text/javascript">
							$(function () {
								$('#date_fin_poste').datetimepicker({
									locale: 'fr',
									format: 'YYYY-MM-DD',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom'
					
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
									stepping:'5'
					
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
										<input type="number" class="form-control" id="nb_ce" name="nb_ce" placeholder="00" required>
                                        <div class="help-block with-errors"></div>
									</div>
									<label for="nb-pse2" class="col-sm-4 control-label">PSE2</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="nb_pse2" name="nb_pse2" placeholder="00" required>
                                        <div class="help-block with-errors"></div>
									</div>
									<label for="nb_pse1" class="col-sm-4 control-label">PSE1</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="nb_pse1" name="nb_pse1" placeholder="00" required>
                                        <div class="help-block with-errors"></div>
									</div>
									<label for="nb_psc1" class="col-sm-4 control-label">PSC1</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="nb_psc1" name="nb_psc1" placeholder="00" required>
                                        <div class="help-block with-errors"></div>
									</div>
								</div>
							</div>
							<div class="panel-body">
								<div class="form-group form-group-sm">
									<label for="vpsp_transport" class="col-sm-4 control-label">VPSP transport</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="vpsp_transport" name="vpsp_transport" placeholder="00" required>
                                        <div class="help-block with-errors"></div>
									</div>
									<label for="vpsp_soin" class="col-sm-4 control-label">VPSP soin</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="vpsp_soin" name="vpsp_soin" placeholder="00" required>
                                        <div class="help-block with-errors"></div>
									</div>
									<label for="vl" class="col-sm-4 control-label">Véhicule Léger</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="vl" name="vl" placeholder="00">
									</div>
									<label for="tente" class="col-sm-4 control-label">Tente</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="tente" name="tente" placeholder="00">
									</div>
								</div>
								<div class="form-group form-group-sm">
									<label for="local" class="col-sm-4 control-label">Local</label>
									<div class="col-sm-8">
										<select class="form-control" id="local" name="local">
											<option value="false">Non</option>
											<option value="true">Oui</option>
										</select>
									</div>
								</div>
								<div class="form-group form-group-sm">
									<label for="supplement" class="col-sm-4 control-label">Moyens humains / logistiques supplémentaires</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="supplement" name="supplement" placeholder="entrer ici tout moyen supplémentaire">
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
										<input type="number" class="form-control" id="medecin_asso" name="medecin_asso" placeholder="00">
									</div>
									<label for="medecin_autre" class="col-sm-4 control-label">Nombre médecin autre</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="medecin_autre" name="medecin_autre" placeholder="00">
									</div>
									<label for="medecin_appartenance" class="col-sm-4 control-label">Appartenance</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="medecin_appartenance" name="medecin_appartenance" placeholder="Appartenance">
									</div>
								</div>
								<div class="form-group form-group-sm">
									<label for="infirmier_asso" class="col-sm-4 control-label">Nombre d'infirmier associatif</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="infirmier_asso" name="infirmier_asso" placeholder="00">
									</div>
									<label for="infirmier_autre" class="col-sm-4 control-label">Nombre d'infirmier autre</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" id="infirmier_autre" name="infirmier_autre" placeholder="00">
									</div>
									<label for="infirmier_appartenance" class="col-sm-4 control-label">Appartenance</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="infirmier_appartenance" name="infirmier_appartenance" placeholder="Appartenance">
									</div>
								</div>
								<div class="form-group form-group-sm">
									<label for="samu" class="col-sm-4 control-label">SAMU</label>
									<div class="col-sm-2">
										<select class="form-control" id="samu" name="samu">
											<option value="0">Ni informé, ni présent</option>
											<option value="1" selected>Informé, non présent</option>
											<option value="2">Informé et présent</option>
										</select>
									</div>
									<label for="bspp_sdis" class="col-sm-4 control-label">SDIS / BSPP</label>
									<div class="col-sm-2">
										<select class="form-control" id="bspp_sdis" name="bspp_sdis">
											<option value="0">Ni informé, ni présent</option>
											<option value="1">Informé, non présent</option>
											<option value="2">Informé et présent</option>
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
						<textarea class="form-control" rows="5" id="justificatif" name="justificatif" placeholder="Indiquer tout justificatif sur les moyens, structures, etc. ou toute information utile pour la bonne gestion administrative du poste."></textarea>
					</div>
				</div>
<?php
				echo "<input type='hidden' name='year' value='".$year."'>";
				echo "<input type='hidden' name='code_commune' value='".$commune_dps."'>";
				echo "<input type='hidden' name='num_cu' value='".$num_cu."'>";
?>
				
				
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8 ">
						<button type="submit" class="btn btn-warning">Envoyer <span class="glyphicon glyphicon-send"></span></button>
					</div>
				</div>
			</form>
			
			
		<?php }if ($_SESSION['privilege'] == "user") { ?>
  		<strong>En tant qu'utilisateur simple vous ne pouvez pas effectuer d'actions</strong> <?php }?>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
    $(function () {
        $("[rel='tooltip']").tooltip();
    });
	$(function () {
		$('[data-toggle="popover"]').popover()
	})
</script>

<?php require_once('functions/dps/dps-compute-ris-js.php'); ?>
</body>
</html>
<?php }?>