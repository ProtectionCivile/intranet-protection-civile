<?php
include 'securite.php';
require_once('connexion.php');
if ($_SESSION['privilege'] != "admin") { header("Location: accueil.php"); }else{

// if(isset($_POST['cu'])){
// $cu = $_POST['cu'];
// include 'functions/var_traitement.php';
// $today = date("Y-m-d");
// $query_insert = "INSERT INTO demande_dps(num_cu, cu_complet, annee_poste, commune_ris, type_dps, dps_debut, dps_fin, dps_debut_poste, dps_fin_poste, heure_debut, heure_fin, heure_debut_poste, heure_fin_poste, dept, prix, description_manif, activite, adresse_manif, organisateur, representant_org, qualite_org, adresse_org, tel_org, fax_org, email_org, dossier_pref, p1_part, p1_spec, p2, e1, e2, date_creation, comment_ris, justif_poste, cei, PSE2, PSE1, PSC1, vpsp, vpsp_soin, vl, tente, local, moyen_supp, med_asso, med_autre, medecin, inf_asso, inf_autre, infirmier, samu, pompier) VALUES ('$num_cu', '$cu', '$year', '$code_commune', '$type_dps','$date_debut', '$date_fin', '$date_debut_poste', '$date_fin_poste', '$heure_debut', '$heure_fin', '$heure_debut_poste', '$heure_fin_poste', '$dept', '$prix' ,'$nom_nature', '$activite_descriptif', '$lieu_precis', '$nom_organisation', '$represente_par', '$qualite', '$adresse', '$telephone', '$fax', '$email', '$deja_pref', '$p1_part', '$p1_spec', '$p2', '$e1', '$e2', '$today', '$commentaire_ris', '$justificatif', '$nb_ce', '$nb_pse2' , '$nb_pse1', '$nb_psc1', '$vpsp_transport', '$vpsp_soin', '$vl', '$tente', '$local', '$supplement', '$medecin_asso', '$medecin_autre', '$medecin_appartenance', '$infirmier_asso', '$infirmier_autre', '$infirmier_appartenance', '$samu', '$bspp_sdis')" or die("Impossible d'ajouter l'utilisateur dans la base de donn&eacute;e" . mysqli_error($link));
// //var_dump($query_insert);
// mysqli_query($link, $query_insert);
// $_SESSION['dps-creation'] = $cu;
// header("Location: edit-dps.php");}

if(isset($_POST['update_id'])){
$id = $_POST['update_id'];
include 'functions/var_traitement.php';
$query_update = "UPDATE demande_dps SET type_dps='$type_dps', dps_debut='$date_debut', dps_fin='$date_fin', dps_debut_poste='$date_debut_poste', dps_fin_poste='$date_fin_poste', heure_debut='$heure_debut', heure_fin='$heure_fin', heure_debut_poste='$heure_debut_poste', heure_fin_poste='$heure_fin_poste', dept='$dept', prix='$prix', description_manif='$nom_nature', activite='$activite_descriptif', adresse_manif='$lieu_precis', organisateur='$nom_organisation', representant_org='$represente_par', qualite_org='$qualite', adresse_org='$adresse', tel_org='$telephone', fax_org='$fax', email_org='$email', dossier_pref='$deja_pref', p1_part='$p1_part', p1_spec='$p1_spec', p2='$p2', e1='$e1', e2='$e2', comment_ris='$commentaire_ris', justif_poste='$justificatif', cei='$nb_ce', PSE2='$nb_pse2', PSE1='$nb_pse1', PSC1='$nb_psc1', vpsp='$vpsp_transport', vpsp_soin='$vpsp_soin', vl='$vl', tente='$tente', local='$local', moyen_supp='$supplement', med_asso='$medecin_asso', med_autre='$medecin_autre', medecin='$medecin_appartenance', inf_asso='$infirmier_asso', inf_autre='$infirmier_autre', infirmier='$infirmier_appartenance', samu='$samu', pompier='$bspp_sdis' WHERE id='$id'";
//var_dump($query_update);
mysqli_query($link, $query_update);
$_SESSION['dps-update'] = $id;
header("Location: edit-dps.php");}

if(isset($_POST['demande_valid'])){
$id = $_POST['demande_valid'];
$today = date("Y-m-d");
$query_update = "UPDATE demande_dps SET valid_demande_rt='$today', etat_demande_dps='0' WHERE id='$id'";
mysqli_query($link, $query_update);
header("Location: list-dps.php");}

if(isset($_POST['valider'])){
$id = $_POST['valider'];
$today = date("Y-m-d");
$query_update = "UPDATE demande_dps SET valid_demande_dps='$today', etat_demande_dps='1' WHERE id='$id'";
mysqli_query($link, $query_update);
header("Location: list-dps.php");}

if(isset($_POST['refus'])){
$id = $_POST['refus'];
$motif_refus = $_POST['motif_refus'];
$administration = $_POST['commentaire_refus'];
$date_empty = "0000-00-00";
$query_update = "UPDATE demande_dps SET valid_demande_rt='$date_empty', motif_annul='$motif_refus', administration='$administration', etat_demande_dps='2' WHERE id='$id'";
mysqli_query($link, $query_update);
header("Location: list-dps.php");}
?>
<!DOCTYPE html>
<html>
<head>
<title>Traitement en cours</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php include 'header.php'; ?>
	  <div class="container">
<div class="progress">
  <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
  </div>
</div>
<p>Traitement en cours, veuillez patienter...</p>
<p>Si vous voyez pendant plus de 15 secondes cette barre de chargement, merci de contacter la DDTI.</p>
<?php }
include 'footer.php'; ?>
</body>
</html>
