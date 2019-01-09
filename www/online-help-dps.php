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
	<li class="active">Dispositifs Prévisionnels de Secours</li>
</ol>

<div class="container">

	<div class="page-header">
		<h1>Aide en ligne <small>Dispositifs Prévisionnels de Secours</small></h1>
	</div>

	<p class='lead'>Création de dispositifs de secours et déclaration auprès de nos partenaires.</p>

	<br />
	<h3 class='text-primary'>Droits d'accès</h3>
	<p>Plusieurs permissions sont disponibles pour les DPS, avec 3 niveaux. Pour chaque niveau (local, départemental ou la totalité) il est possible de consulter, modifier (donc créer) et valider la demande de DPS. D'autres accréditations existent ensuite pour valider (point de vue DDO) le DPS.</p>

	<br />
	<h3 class='text-primary'>Listing et recherche de DPS</h3>
	<p>Ils sont présentés au moyen d'une simple liste, et des modules de filtrage peuvent être appliqués avec les boutons de couleur. Dans la liste, chaque DPS apparaît avec un code couleur qui est le même que celui du bouton du module de filtrage :</p>
	<ul>
		<li>En blanc s'il est nouveau (brouillon) et pas encore validé par l'antenne</li>
		<li><span class='bg-info'>En bleu clair s'il a été validé par l'antenne, mais pas encore par la DDO</span></li>
		<li><span class='bg-warning'>En orange s'il a été mis en attente par la DDO</span></li>
		<li><span class='bg-success'>En vert s'il a été validé par la DDO après accord de la Préfecture et des autres départements</span></li>
		<li><span class='bg-danger'>En rouge s'il a été refusé par la DDO, ou s'il est dans un état inconnu</span></li>
	</ul>
	<p>La visualisation des DPS ne permet de voir que les DPS sur sa commune. Si l'on a les droits pour voir ceux du département, ils apparaîtront dans une seconde liste. Si toutefois vous cherchez un DPS, assurez-vous que les dates concordent et qu'il ne se situe pas sur une autre page.</p>
	<p>Des <strong>modules de filtrage</strong> sont accessibles et permettent de filtrer par date et par statut. Par défaut, la date de début est la date du jour, et la date de fin se situe 3 mois après. Les boutons de statut représentent les statuts des DPS. Le dernier bouton de statut <span class='glyphicon glyphicon-fire'></span> sert à les DPS "à problèmes". Enfin, le module de filtrage peut être masqué pour une meilleure lisibilité. Si l'utilisateur a le droit de consulter tous les DPS, un autre module de filtrage par antenne apparaît alors.</p>
	<p>En fin de ligne des boutons sont disponibles pour visualiser ou modifier un DPS. Ils apparaîssent selon que l'utilisateur a ou non les droits afférents.</p>


	<br />
	<h3 class='text-primary'>Création d'un poste (et modification)</h3>
	<p>Pour créer un DPS il faut utiliser les boutons de création. Les utilisateurs ayant le droit de créer un DPS sur n'importe quelle commune peuvent modifier leur choix sur la page de création. <span class='text-danger'>Attention il faut cependant ne pas oublier de cliquer sur le bouton 'Sélectionner' pour valider le choix de l'antenne</span>. Le nouveau numéro de certificat unique apparaît alors en haut.</p>

	<h4>Aide à la saisie : pré-remplissage</h4>
	<p>Deux types de pré-remplissage sont possibles. Le premier se fait à partir de la base contacts (partie Administration), et le second se fait à partir d'un autre DPS existant. Il est possible de les utiliser conjointement. Pour chacun d'entre eux, le module de pré-remplissage ne saisit que les champs qui sont vides, et ne remplace pas une donnée déjà saisie par l'utilisateur.</p>

	<h4>Choix par défaut de l'application</h4>
	<ul>
		<li>N'étant pas utile, la saisie du nombre de stagiaires PSC-1, de médecins et d'infirmiers Protection Civile a été désactivée. Leur nombre est automatiquement porté à 0.</li>
		<li>Le choix par défaut de la BSPP est positionné à "Ni informé ni présent" et celui du SAMU est à "Informé et non-présent" pour correspondre à la majeure partie des cas.</li>
		<li>Dès saisie et modification, les dates de début et de fin d'évènement sont automatiquement utilisés pour positionner les dates du dispositif de secours</li>
		<li>Les horaires du dispositif de secours sont positionnées respectivement 1/4 d'heure avant le début de l'événement et 1/4 d'heure après la fin de l'évenement</li>
	</ul>
	<h4>Saisie et validité des données</h4>
	<p>Toutes les données sont vérifiées, par le navigateur mais également sur le serveur. Par exemple, si une donnée requise est entrée, la création sera refusée. Si du texte est entré à la place d'un nombre, c'est pareil. Le système n'appréciera pas non plus un numéro de téléphone à 8 chiffres ou une adresse mail qui n'en est pas une.</p>
	<p>Le <strong>numéro d'évènement e-Protec</strong> est présent uniquement pour générer un lien direct entre le DPS 'intranet' et l'évènement eProtec. A terme, il n'est pas exlu de faire communiquer les 2 outils pour partager les données et éviter de saisir à deux endroîts.</p>

	<br />
	<h3 class='text-primary'>Ajout de pièces jointes à un DPS</h3>
	<p>Il est possible d'ajouter des pièces jointes à un DPS. Certains documents comme la Convention, la Grille des risques et la demande seront automatiquement renommés par le système. Ces documents sont distincts, il ne sera pas possible de les transmettre via un unique fichier qui contiendrait les 2 documents.</p>

	<br />
	<h3 class='text-primary'>Validation d'un DPS par l'antenne</h3>
	<p>Une fois le DPS rempli, 2 choix s'offrent au CO :</p>
	<ul>
		<li><strong>Annuler le poste</strong> : Il ne sera pas supprimé, mais ne sera plus modifiable. C'est ce qu'il faut faire lorsqu'un client ne souhaite plus faire appel à nos services (météo incertaine, a trouvé moins cher ailleurs...)</li>
		<li><strong>Valider le poste</strong> : Il donnera ainsi la main à la DDO, qui sera prévenue par mail. Pour cela, il est impératif que la Convention et la Grille d'analyse des risques soient tous les deux renseignés, et pas dans un même fichier.</li>
	</ul>
	<div class='alert alert-warning' role='alert'>
		<p><span class='glyphicon glyphicon-hand-right'></span> La convention et la grille de risques sont obligatoires pour valider le DPS, ils doivent bien évidemment être signés par le client pour être valides. Sans ces 2 documents, le CO ne pourra pas valider le poste.</p>
	</div>

	<br />
	<h3 class='text-primary'>Validation par la DDO</h3>
	<p>La DDO peut valider localement un poste à la place d'un CO. Mais une fois qu'elle a un poste validé par une antenne, 4 choix s'offrent à elle :</p>
	<ul>
		<li><strong>Mettre le poste en attente</strong> si la DDO valide le poste en interne mais a besoin d'autres autorisations (Préfecture, autres ADPC, ...)</li>
		<li><strong>Refuser le poste</strong> : Une justification sera demandée</li>
		<li><strong>Valider le poste</strong> : Donne l'accord de la tenue du poste et en informe nos partenaires (préfecture, ADPC...).</li>
		<li><strong>Annuler le poste</strong> : S'il a déjà été validé par la DDO, nos partenaires en seront avisés.</li>
	</ul>

	<br />
	<div class='alert alert-info' role='alert'>
		<p><span class='glyphicon glyphicon-hand-right'></span> Pour plus d'infos sur les différents mails envoyés par le système lors des étapes de validation d'un DPS, consultez la <a href='online-help-mailer.php'>rubrique d'aide associée</a>.</p>
	</div>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>
