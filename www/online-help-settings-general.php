<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Aide en ligne</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="online-help.php">Aide en ligne</a></li>
	<li class="active">Paramètres généraux</li>
</ol>

<div class="container">

	<div class="page-header">
		<h1>Aide en ligne <small>Paramètres généraux</small></h1>
	</div>

	<p class='lead'>Ils servent à assurer la flexibilité de l'intranet, sans avoir à toucher au coeur du système pour changer un réglage.</p>
	<div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span> Attention, la modification de ces paramètres peut entraîner une coupure de service</div>

	<h3 class='text-primary'>Droits d'accès</h3>
	<p>Il existe une permission pour les consulter, une autre pour les modifier.</p>

	<h3 class='text-primary'>Paramètres par défaut, indispensables à l'application</h3>
	<p>Il existe une permission pour les consulter, une autre pour les modifier.</p>

	<div class='table-responsive'>
		<table class='table table-condensed'>
			<thead>
				<tr>
					<th>Nom</th>
					<th>Valeur par défaut</th>
					<th>Explication</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>application-header-name</td>
					<td>Extranet PC92</td>
					<td>Le nom qui apparaît en haut à gauche de la barre de navigation</td>
				</tr>
				<tr>
					<td>dps-doc-suffix-convention</td>
					<td>CONV</td>
					<td>Suffixe des noms fichier de convention de DPS, pour l'upload et la recherche. Par exemple: 92-COU-17-CONV.pdf</td>
				</tr>
				<tr>
					<td>dps-doc-suffix-risk</td>
					<td>RISK</td>
					<td>Suffixe des noms fichier de grille de risques de DPS</td>
				</tr>
				<tr>
					<td>dps-doc-suffix-demande</td>
					<td>DEM</td>
					<td>Suffixe des noms fichier de demande de DPS rempli par l'organisateur</td>
				</tr>
				<tr>
					<td>dps-doc-suffix-declaration</td>
					<td>DECL</td>
					<td>Suffixe des noms fichier de déclaration en préfecture pour les DPS</td>
				</tr>
				<tr>
					<td>eprotec-event-url</td>
					<td>https://franceprotectioncivile.org/evenement_display.php?evenement=EVENTID</td>
					<td>Lien par défaut pour un évènement eProtec, utilisé pour les déclarations de DPS. &lt;EVENTID&gt; sera remplacé par le numéro d'évènement</td>
				</tr>
				<tr>
					<td>mail-signature-ddo</td>
					<td>&lt;strong&gt;Le Directeur Départemental des Opérations&lt;/strong&gt;&lt;br /&gt;operationnel@protectioncivile92.org&lt;br /&gt;06.74.95.31.75</td>
					<td>Signature par défaut du DDO pour les mails envoyés</td>
				</tr>
				<tr>
					<td>mail-signature-dlo</td>
					<td>&lt;strong&gt;Le Directeur Local des Opérations&lt;/strong&gt;</td>
					<td>Signature par défaut du DLO pour les mails envoyés</td>
				</tr>
			</tbody>
		</table>
	</div>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>
