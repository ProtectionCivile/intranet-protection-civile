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
	<li><a href="/">Accueil</a></li>
	<li><a href="online-help.php">Aide en ligne</a></li>
	<li class="active">Paramètres généraux</li>
</ol>

<div class="container">

	<div class="page-header">
		<h1>Aide en ligne <small>Paramètres généraux de l'application</small></h1>
	</div>

	<p class='lead'>Ils servent à assurer la flexibilité de l'intranet, sans avoir à toucher au coeur du système pour changer un réglage.</p>

	<br />
	<h3 class='text-primary'>Droits d'accès</h3>
	<p>Il existe une permission pour les consulter, une autre pour les modifier.</p>

	<br />
	<h3 class='text-primary'>Utilisation</h3>
	<p>Les paramètres et les valeurs sont directement éditables par le site.</p>
	<p>
		<span class='text-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span> Sans ces paramètres, l'application ne peut pas fonctionner correctement. À manipuler avec précaution, parce qu'une modification non-réfléchie peut entraîner des coupures de service.</span> Les valeurs des paramètres peuvent néanmoins être modifiées.
	</p>

	<br />
	<h3 class='text-primary'>Paramètres indispensables</h3>

	<div class='table-responsive'>
		<table class='table table-striped table-hover'>
			<thead>
				<tr>
					<th>Nom</th>
					<th>Valeur par défaut</th>
					<th>Explication</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><samp>application-header-name</samp></td>
					<td><samp>Extranet PC92</samp></td>
					<td class='text-muted'>Le nom qui apparaît en haut à gauche de la barre de navigation</td>
				</tr>
				<tr>
					<td><samp>dps-doc-suffix-convention</samp></td>
					<td><samp>CONV</samp></td>
					<td class='text-muted'>Suffixe des noms fichier de convention de DPS, pour l'upload et la recherche. Par exemple: 92-17-COU-021-CONV.pdf</td>
				</tr>
				<tr>
					<td><samp>dps-doc-suffix-risk</samp></td>
					<td><samp>RISK</samp></td>
					<td class='text-muted'>Suffixe des noms fichier de grille de risques de DPS</td>
				</tr>
				<tr>
					<td><samp>dps-doc-suffix-demande</samp></td>
					<td><samp>DEM</samp></td>
					<td class='text-muted'>Suffixe des noms fichier de demande de DPS rempli par l'organisateur</td>
				</tr>
				<tr>
					<td><samp>dps-doc-suffix-declaration</samp></td>
					<td><samp>DECL</samp></td>
					<td class='text-muted'>Suffixe des noms fichier de déclaration en préfecture pour les DPS</td>
				</tr>
				<tr>
					<td><samp>eprotec-event-url</samp></td>
					<td><samp>https://franceprotectioncivile.org/evenement_display.php?evenement=EVENTID</samp></td>
					<td class='text-muted'>Lien vers un évènement eProtec, utilisé pour les déclarations de DPS. &lt;EVENTID&gt; sera remplacé par le numéro d'évènement</td>
				</tr>
				<tr>
					<td><samp>eprotec-user-picture-url</samp></td>
					<td><samp>https://franceprotectioncivile.org/images/user-specific/trombi/MATRICULE.jpg</samp></td>
					<td class='text-muted'>Lien vers une photo d'un utilisateur eProtec, utilisé pour l'annuaire. &lt;MATRICULE&gt; sera remplacé par l'identifiant eProtec de l'utilisateur</td>
				</tr>
				<tr>
					<td><samp>eprotec-user-picture-url</samp></td>
					<td><samp>https://franceprotectioncivile.org/images/boy.png</samp></td>
					<td class='text-muted'>Lien vers une image par défaut lorsqu'un utilisateur n'en a pas, utilisé pour l'annuaire.</td>
				</tr>
				<tr>
					<td><samp>mail-signature-ddo</samp></td>
					<td><samp>&lt;strong&gt;Le Directeur Départemental des Opérations&lt;/strong&gt;&lt;br /&gt;operationnel@protectioncivile92.org&lt;br /&gt;06.74.95.31.75</samp></td>
					<td class='text-muted'>Signature par défaut du DDO pour les mails envoyés</td>
				</tr>
				<tr>
					<td><samp>mail-signature-dlo</samp></td>
					<td><samp>&lt;strong&gt;Le Directeur Local des Opérations&lt;/strong&gt;</samp></td>
					<td class='text-muted'>Signature par défaut du DLO pour les mails envoyés</td>
				</tr>
			</tbody>
		</table>
	</div>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>
