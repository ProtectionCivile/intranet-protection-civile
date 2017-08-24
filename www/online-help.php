<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Aide en ligne</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class='breadcrumb'>
	<li><a href='/'>Accueil</a></li>
	<li><a href='online-help.php'>Aide en ligne</a></li>
	<li class='active'>Sommaire</li>
</ol>

<div class='container'>

	<div class='page-header'>
		<h1>Aide en ligne</h1>
	</div>

	<p class='lead'>Sélectionner une rubrique parmi les items ci-dessous.</p>

	<br />

	<div class='row'>
		<div class='col-sm-4'>
			<h4 class='text-warning'>Opérationnel</h4>
			<ul>
				<li><a href='online-help-clients.php'>Base contacts (clients)</a></li>
				<li><a href='online-help-dps.php'>Dispositifs de secours</a></li> préciser workflow de validation
				<li><a href='online-help-mailer.php'>Envoi de mails pour les DPS</a></li>
				<li><a href=''>Demandes de renfort</a> <span class='label label-default'>Bientôt</span></li>
				<li><a href=''>Gestion de la trésorerie</a> <span class='label label-default'>Bientôt</span></li>
			</ul>
		</div>
		<div class='col-sm-4'>
			<h4 class='text-warning'>Administration</h4>
			<ul>
				<li><a href='online-help-settings-general.php'>Paramètres de l'application</a></li>
				<li><a href='online-help-settings-mail.php'>Paramètres des e-mails</a></li>
				<li><a href='online-help-users-roles-permissions.php'>Utilisateurs, rôles, permissions</a></li>
				<li><a href='online-help-sections.php'>Antennes et rattachement</a></li>
				<li><a href='online-help-mailinglists.php'>Listes de diffusion</a></li>
			</ul>
		</div>
		<div class='col-sm-4'>
			<h4 class='text-warning'>Divers</h4>
			<ul>
				<li><a href=''>Annuaire</a> <span class='label label-default'>Bientôt</span></li>
				<li><a href=''>Cartoucheur de photos</a> <span class='label label-default'>Bientôt</span></li>
				<li><a href=''>Générateur de signature mail</a> <span class='label label-default'>Bientôt</span></li>
			</ul>
		</div>
	</div>

	<br />	<br />

	<div class='row'>
		<div class='col-sm-6'>
			<h4 class='text-warning'>Conception et réalisation</h4>
			<p>Cet intranet a été entièrement conçu par le Pôle Technique Informatique de la <strong>Protection Civile des Hauts-de-Seine</strong>. Le contenu est sous licence GPL-2.0.</p>
			<p>
				L'ensemble des sources et le suivi des modifications (corrections et nouvelles fonctionnalités) sont disponibles en toute transparence sur la plate-forme GitHub à l'adresse suivante : <a href='https://github.com/ProtectionCivile/intranet-protection-civile' target='_blank'>https://github.com/ProtectionCivile/intranet-protection-civile</a>.
				C'est à cette adresse dans la partie <kbd>Issues</kbd> que vous trouverez les nouvelles fonctionnalités qui sont prévues pour le site, et la date à laquelle elles seront disponibles;
			</p>
		</div>

		<div class='col-sm-6'>
			<h4 class='text-warning'>Contribution</h4>
			<p>
				Pour contribuer au développement de cet intranet, ou proposer des corrections ou des évolutions, vous pouvez le faire :
				<ul>
					<li>En écrivant au Pôle (<a href='mailto:pole-informatique@protectioncivile92.org'>pole-informatique@protectioncivile92.org</a>)</li>
					<li>En soumettant directement vos demandes <a href='https://github.com/ProtectionCivile/intranet-protection-civile/issues'>sur la plate-forme GitHub</a></li>
				</ul>
			</p>
			<p>L'effectif de l'équipe du pôle informatique étant très mince, vous pouvez également proposer votre aide ou celle d'un de vos membres pour le développement.</p>
		</div>
	</div>
</div>

<?php include('components/footer.php'); ?>

</body>
</html>
