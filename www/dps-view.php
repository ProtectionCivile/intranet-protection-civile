<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>DPS <?php echo $_POST['name']; ?></title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php require_once('components/header.php'); ?>
<?php require_once('functions/dps/dps-view-functions.php'); ?>
<?php require_once('functions/modals.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Opérationnel</a></li>
	<li><a href="dps-list-view.php">Dispositifs de secours</a></li>
	<li class="active">Visualisation</li>
</ol>


<?php 
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT * FROM $tablename_dps WHERE id = $id";
		$query = mysqli_query($link, $sql);
		$dps = mysqli_fetch_array($query);
	}
?>

<!-- Authentication -->
<?php require_once('functions/dps/dps-view-authentication.php'); ?>


<!-- Page content container -->
<div class="container">
	<h2><center><?php echo $dps['cu_complet'];?></center></h2>


	<!-- Accès spécial DDO -->
	<?php if ($rbac->check("ope-dps-validate-ddo-to-pref", $currentUserID)) {?> 
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title">Accès spécial DDO</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					
					<form class="form-horizontal" role="form" action="edit-dps.php" method="post">
						<input type='hidden' name='id' value='<?php echo $dps['id'];?>' />
						<div class="col-sm-3 col-md-3">
							<button type="submit" class="btn btn-info">Modifier le DPS</button>
						</div>
					</form>
					<div class="col-sm-3 col-md-3">
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalRefus" <?php if($dps['valid_demande_rt'] ==0){echo "disabled";}?>>Refuser le DPS</button>
					</div>
					<div class="col-sm-3 col-md-3">
						<button type="submit" class="btn btn-success" data-toggle="modal" data-target="#ModalAccept">Valider le DPS</button>
					</div>
					<div class="col-sm-3 col-md-3">
						<button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#ModalWait">Mettre en attente</button>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>

	<br />
	
	<!-- Module to compute DPS status -->
	<?php require_once('functions/dps/compute-dps-status.php'); ?>

	<?php if($dps_status == "accepted"){ ?>
		<div class='alert alert-success'>
			<span class="glyphicon glyphicon-ok" style="font-size:2em"></span>
			<strong>DPS validé par l'antenne le </strong><?php echo date("d-m-Y", strtotime($dps['valid_demande_dps']));?>
		</div> <?php 
	}
	elseif($dps_status == "canceled"){ ?>
		<div class='alert alert-warning'>
			<span class="glyphicon glyphicon-ban-circle" style="font-size:2em"></span>
			<strong>DPS annulé le </strong><?php echo date("d-m-Y", strtotime($dps['annul_poste']));?> (Motif: <?php echo $dps['motif_annul'];?>)
		</div> <?php 
	}
	elseif($dps_status == "refused"){ ?>
		<div class='alert alert-danger'>
			<span class="glyphicon glyphicon-remove" style="font-size:2em"></span>
			<strong>DPS refusé le </strong><?php echo date("d-m-Y", strtotime($dps['annul_poste']));?> (Motif: <?php echo $dps['motif_annul'];?>)
		</div> <?php 
	}
	elseif($dps_status == "valid_antenne"){ ?>
		<div class='alert alert-info'>
			<span class="glyphicon glyphicon-ok" style="font-size:2em"></span>
			<strong>DPS envoyé pour validation à la DDO</strong> le <?php echo date("d-m-Y", strtotime($dps['valid_demande_rt']));?>
		</div> <?php 
	}
	elseif($dps_status == "valid_ddo_attente"){ ?>
		<div class='alert alert-warning'>
			<span class="glyphicon glyphicon-time" style="font-size:2em"></span>
			<strong>Validation DDO effectuée, attente validation Préfecture ou département concerné</strong> (validation antenne du <?php echo date("d-m-Y", strtotime($dps['valid_demande_dps']));?>)
		</div> 
	<?php } ?>


	<br />

			
	<div class="panel panel-primary">
		<div class="panel-heading">
			<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#orga-panel-filter" aria-expanded='true' aria-controls="orga-panel-filter">
				<span aria-hidden="true" >Montrer/Cacher</span>
			</button>
			<h3 class="panel-title">Organisateur</h3>
		</div>
		<div id='orga-panel-filter' aria-expanded='true' class="panel-body in">
			<ul class="list-group">
				<li class="list-group-item">
					<div class="row">
						<div class="col-sm-3">
							<p>Nom de l'organisation</p>
						</div>
						<div class="col-sm-9">
							<p class="bg-info"><?php echo $dps['organisateur'];?></p>
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-sm-3">
							<p>Représenté par</p>
						</div>
						<div class="col-sm-9">
							<p class="bg-info"><?php echo $dps['representant_org'];?></p>
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-sm-3">
							<p>Qualité</p>
						</div>
						<div class="col-sm-9">
							<p class="bg-info"><?php echo $dps['qualite_org'];?></p>
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-sm-3">
							<p>Adresse Postale</p>
						</div>
						<div class="col-sm-9">
							<p class="bg-info"><?php echo $dps['adresse_org'];?></p>
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-sm-3">
							<p>Téléphone</p>
						</div>
						<div class="col-sm-3">
							<p class="bg-info"><?php echo $dps['tel_org'];?></p>
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-sm-3">
							<p>Fax</p>
						</div>
						<div class="col-sm-9">
							<p class="bg-info"><?php echo $dps['fax_org'];?></p>
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-sm-3">
							<p>Adresse e-mail</p>
						</div>
						<div class="col-sm-9">
							<p class="bg-info"><?php echo $dps['email_org'];?></p>
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-sm-3">
							<p>Dossier déjà déposé en préfecture</p>
						</div>
						<div class="col-sm-1">
							<p class="bg-info"><?php if($dps['dossier_pref'] == true){echo "Oui";}else{ echo "Non";}?></p>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
	
	<br />

	<div class="panel panel-primary">
		<div class="panel-heading">
			<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#manif-panel-filter" aria-expanded='true' aria-controls="manif-panel-filter">
				<span aria-hidden="true" >Montrer/Cacher</span>
			</button>
			<h3 class="panel-title">Évènement</h3>
		</div>
		<div id='manif-panel-filter' class="panel-body in">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Nature de la manifestation</h3>
				</div>
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Nom / Nature de la manifestation</p>
							</div>
							<div class="col-sm-9">
								<p class="bg-info"><?php echo $dps['description_manif'];?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Activité / Descriptif</p>
							</div>
							<div class="col-sm-9">
								<p class="bg-info"><?php echo $dps['activite'];?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Lieu précis :</p>
							</div>
							<div class="col-sm-9">
								<p class="bg-info"><?php echo $dps['adresse_manif'];?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Date de début et fin</p>
							</div>
							<div class="col-sm-2">
								<p class="bg-info"><?php echo (new DateTime($dps['dps_debut']))->format('d-m-Y');?></p>
							</div>
							<div class="col-sm-2">
								<p class="bg-info"><?php echo (new DateTime($dps['dps_fin']))->format('d-m-Y');?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Heure de début et fin</p>
							</div>
							<div class="col-sm-2">
								<p class="bg-info"><?php echo (new DateTime($dps['heure_debut']))->format('H:i');?></p>
							</div>
							<div class="col-sm-2">
								<p class="bg-info"><?php echo (new DateTime($dps['heure_fin']))->format('H:i');?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Departement</p>
							</div>
							<div class="col-sm-2">
								<p class="bg-info"><?php echo $dps['dept'];?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Prix</p>
							</div>
							<div class="col-sm-2">
								<p class="bg-info"><?php echo $dps['prix'];?> Euros</p>
							</div>
						</div>
					</li>
				</ul>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Évaluation du risque</h3>
				</div>
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Nombre de spectateurs</p>
							</div>
							<div class="col-sm-2">
								<p class="bg-info"><?php echo $dps['p1_spec'];?></p>
							</div>
							<div class="col-sm-3 col-sm-offset-1">
								<p>Nombre de participants</p>
							</div>
							<div class="col-sm-2">
								<p class="bg-info"><?php echo $dps['p1_part'];?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Activité du rassemblement</p>
							</div>
							<div class="col-sm-9">
								<p class="bg-info"><?php $p2 = $dps['p2']; if($p2 == "1"){echo "Public assis (spectacle, réunion, restauration, etc.)";}elseif($p2 == "2"){ echo "Public debout (Exposition, foire, salon, exposition, etc.)";}elseif($p2 == "3"){echo "Public debout actif (Spectacle avec public statique, fête foraine, etc.)";}else{echo "Public debout à risque (public dynamique, danse, féria, carnaval, etc.)";}?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Environnement et accessibilité</p>
							</div>
							<div class="col-sm-9">
								<p class="bg-info"><?php $p2 = $dps['e1']; if($p2 == "1"){echo "Faible (Structure permanente, voies publiques, etc.)";}elseif($p2 == "2"){ echo "Public debout (Gradins, tribunes, mois de 2 hectares, etc.)";}elseif($p2 == "3"){echo "Public debout actif (Entre 2 et 5 hectares, autres conditions, etc.)";}else{echo "Public debout à risque (Brancardage > 600m, pas d'accès VPSP, etc.)";}?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Délai d'intervention des secours publics</p>
							</div>
							<div class="col-sm-9">
								<p class="bg-info"><?php $p2 = $dps['e2']; if($p2 == "1"){echo "Faible (Moins de 10 minutes)";}elseif($p2 == "2"){ echo "Modéré (Entre 10 et 20 minutes)";}elseif($p2 == "3"){echo "Moyen (Entre 20 et 30 minutes)";}else{echo "Elevé (Plus de 30 minutes)";}?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Commentaires concernant le RIS</p>
							</div>
							<div class="col-sm-9">
								<p class="bg-info"><?php echo $dps['comment_ris'];?></p>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	<br />

	<div class="panel panel-primary">
		<div class="panel-heading">
			<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#dps-panel-filter" aria-controls="dps-panel-filter">
				<span aria-hidden="true" >Montrer/Cacher</span>
			</button>
			<h3 class="panel-title">Dispositif Prévisionnel de Secours mis en place</h3>
		</div>
		<div id='dps-panel-filter' aria-expanded='true' class="panel-body in">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Horaires de mise en place du dispositif</h3>
				</div>
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Date de début et fin</p>
							</div>
							<div class="col-sm-2">
								<p class="bg-info"><?php echo (new DateTime($dps['dps_debut_poste']))->format('d-m-Y');?></p>
							</div>
							<div class="col-sm-2">
								<p class="bg-info"><?php echo (new DateTime($dps['dps_fin_poste']))->format('d-m-Y');?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Heure de début et fin</p>
							</div>
							<div class="col-sm-2">
								<p class="bg-info"><?php echo (new DateTime($dps['heure_debut_poste']))->format('H:i');?></p>
							</div>
							<div class="col-sm-2">
								<p class="bg-info"><?php echo (new DateTime($dps['heure_fin_poste']))->format('H:i');?></p>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Nombre de secouristes / Moyens logistiques</h4>
				</div>
				<ul class="list-group">
						<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Chef du poste de secours</p>
							</div>
							<div class="col-sm-1">
								<p class="bg-info"><?php echo $dps['cei'];?></p>
							</div>
							<div class="col-sm-3 col-sm-offset-2">
								<p>PSE-2</p>
							</div>
							<div class="col-sm-1 ">
								<p class="bg-info"><?php echo $dps['PSE2'];?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<p>PSE-1</p>
							</div>
							<div class="col-sm-1">
								<p class="bg-info"><?php echo $dps['PSE1'];?></p>
							</div>
							<div class="col-sm-3 col-sm-offset-2">
								<p>Stagiaire PSC-1</p>
							</div>
							<div class="col-sm-1">
								<p class="bg-info"><?php echo $dps['PSC1'];?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>VPSP Transport (évacuation)</p>
							</div>
							<div class="col-sm-1">
								<p class="bg-info"><?php echo $dps['vpsp'];?></p>
							</div>
							<div class="col-sm-3 col-sm-offset-2">
								<p>VPSP fixe (poste de soins)</p>
							</div>
							<div class="col-sm-1">
								<p class="bg-info"><?php echo $dps['vpsp_soin'];?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<p>VL / VTU / ...</p>
							</div>
							<div class="col-sm-1">
								<p class="bg-info"><?php echo $dps['vl'];?></p>
							</div>
							<div class="col-sm-3 col-sm-offset-2">
								<p>Tente(s)</p>
							</div>
							<div class="col-sm-1">
								<p class="bg-info"><?php echo $dps['tente'];?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Local</p>
							</div>
							<div class="col-sm-1">
								<p class="bg-info"><?php if($dps['local'] =="0"){echo "Oui";}else{ echo "non";}?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Moyen(s) supplémentaire(s)</p>
							</div>
							<div class="col-sm-9">
								<p class="bg-info"><?php echo $dps['moyen_supp'];?></p>
							</div>
						</div>
					</li>
				</ul>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Moyens médicaux / structures</h3>
				</div>
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Médecins associatifs</p>
							</div>
							<div class="col-sm-1">
								<p class="bg-info"><?php echo $dps['med_asso'];?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<p>Médecins extérieurs</p>
							</div>
							<div class="col-sm-1">
								<p class="bg-info"><?php echo $dps['med_autre'];?></p>
							</div>
						
							<div class="col-sm-3 col-sm-offset-2">
								<p>Appartenance</p>
							</div>
							<div class="col-sm-3">
								<p class="bg-info"><?php echo $dps['medecin'];?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>Infirmiers associatifs</p>
							</div>
							<div class="col-sm-1">
								<p class="bg-info"><?php echo $dps['inf_asso'];?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<p>Infirmiers extérieurs</p>
							</div>
							<div class="col-sm-1">
								<p class="bg-info"><?php echo $dps['inf_autre'];?></p>
							</div>
							<div class="col-sm-3 col-sm-offset-2">
								<p>Appartenance</p>
							</div>
							<div class="col-sm-3">
								<p class="bg-info"><?php echo $dps['infirmier'];?></p>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-sm-3">
								<p>SAMU</p>
							</div>
							<div class="col-sm-3">
								<p class="bg-info"><?php if($dps['samu'] == "0"){echo "Ni informé, ni présent";}elseif($dps['samu'] == "1"){echo "Informé, non présent";}else{echo "Informé et présent";}?></p>
							</div>
							<div class="col-sm-3">
								<p>SDIS / BSPP</p>
							</div>
							<div class="col-sm-3">
								<p class="bg-info"><?php if($dps['pompier'] == "0"){echo "Ni informé, ni présent";}elseif($dps['pompier'] == "1"){echo "Informé, non présent";}else{echo "Informé et présent";}?></p>
							</div>
						</div>
					</li>
				</ul>
			</div>
		
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Justificatif du dispositif mis en place</h3>
				</div>
				<div class="panel-body">
					<p class="bg-info"><?php echo $dps['justif_poste'];?></p>
				</div>
			</div>
		</div>
	</div>
		
<!-- Modal -->


</div>
<?php require ('components/footer.php'); ?>
</body>
</html>