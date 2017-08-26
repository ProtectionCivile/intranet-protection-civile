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
	<li class="active">Système d'envoi d'e-mails</li>
</ol>

<div class="container">

	<div class="page-header">
		<h1>Aide en ligne <small>Système d'envoi d'e-mails</small></h1>
	</div>

	<p class='lead'>Recevoir l'information chez soi au lieu d'aller la chercher.</p>


	<div class='alert alert-info' role='alert'>
		<p><span class='glyphicon glyphicon-hand-right'></span> Pour ne pas saturer les serveurs avec des envois de mail trop fréquents, un système de file d'attente a été mis en place. Ainsi, les mails ne sont envoyés que <strong>toutes les 15 minutes</strong>. Ce n'est donc pas utile de s'exciter sur le bouton tant que le mail ne vous est pas parvenu. Patience, il est en chemin...</p>
	</div>

	<br />
	<h3 class='text-primary'>Administration</h3>
	<p>Pour s'assurer que le système fonctionne correctement, un icône est disponible pour les admins en haut à droite et comptabilise le nombre de mails dans la file d'attente. Si ce nombre est anormalement grand, il est temps de prévenir la Direction Technique (<a href='mailto:pole-informatique@protectioncivile92.org'>pole-informatique@protectioncivile92.org</a>). Ce bouton ne s'affiche que s'il y a des mails en attente. Il a cette forme là : <span class="badge" title='Nombre de mails en attente d&alt;envoi'>14</span> </p>

	<br />
	<h3 class='text-primary'>Mails par défaut pour les DPS</h3>
	<p>Chaque changement d'état d'un DPS déclenche l'envoi d'un e-mail suivant le schéma suivant :</p>

	<div class='table-responsive'>
		<table class='table table-hover'>
			<thead>
				<tr>
					<th>Action</th>
					<th>Destinataires par défaut</th>
					<th>Explication</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Validation locale</td>
					<td>À: demande-dps<br />Cc: DLO, DDO</td>
					<td class='text-muted'>Informe qu'un poste de secours a été soumis à validation</td>
				</tr>
				<tr>
					<td>Annulation <strong>avant</strong> validation DDO</td>
					<td>À: demande-dps<br />Cc: DLO, DDO</td>
					<td class='text-muted'>Informe de l'annulation du poste au DDO</td>
				</tr>
				<tr>
					<td rowspan='2'>Annulation <strong>après</strong> validation DDO</td>
					<td>À: DLO<br />Cc: DDO</td>
					<td class='text-muted'>Pour informer en <strong>interne</strong> de l'annulation</td>
				</tr>
				<tr>
					<td>À: Préfecture ou ADPC concernée<br />Cc: DDO</td>
					<td class='text-muted'>Pour informer en <strong>externe</strong> de l'annulation</td>
				</tr>
				<tr>
					<td>Mise en attente</td>
					<td>À: DLO<br />Cc: DDO</td>
					<td class='text-muted'>Donne le motif de mise en attente</td>
				</tr>
				<tr>
					<td rowspan='2'>Acceptation DDO</td>
					<td>À: DLO<br />Cc: DDO</td>
					<td class='text-muted'>Pour donner l'autorisation de la tenue du poste (<strong>interne</strong>)</td>
				</tr>
				<tr>
					<td>À: Préfecture ou ADPC concernée<br />Cc: DDO</td>
					<td class='text-muted'>Pour déclarer en <strong>externe</strong> le DPS</td>
				</tr>
				<tr>
					<td>Refus DDO</td>
					<td>À: DLO<br />Cc: DDO</td>
					<td class='text-muted'>Informe que la DDO a refusé la tenue du poste (avec le motif)</td>
				</tr>

			</tbody>
		</table>
	</div>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>
