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
	<li class="active">Paramètres des e-mails</li>
</ol>

<div class="container">

	<div class="page-header">
		<h1>Aide en ligne <small>Paramètres des e-mails</small></h1>
	</div>

	<p class='lead'>Ils servent à maintenir à jour les adresses mail utilisées par le système pour envoyer des mail.</p>

	<br />
	<h3 class='text-primary'>Droits d'accès</h3>
	<p>Il existe une permission pour les consulter, une autre pour les modifier.</p>

	<br />
	<h3 class='text-primary'>Utilisation</h3>
	<p>Les <span class='bg-info'>items en bleu</span> dans le tableau sont utilisés pour définir le ou les destinataires à utiliser lorsque l'on parle d'un item donné. Par exemple, lorsque le système doit envoyer un mail à l'opérationnel d'Asnières et que l'antenne souhaite que ses CO Adjoints reçoivent également les notificaitons pour les DPS, on peut renseigner ici la liste des destinataires. Ainsi, pour ces items, il est possible de saisir :</p>
	<ul>
		<li>une adresse mail au format <samp>machin.chose@trucmuche.com</samp></li>
		<li>une adresse mail au format <samp>"Nom Prénom" &lt;machin.chose@trucmuche.com&gt;</samp></li>
		<li>une liste d'adresses mail séparées par des virgules</li>
	</ul>

	<p>
		Les <span class='bg-warning'>items en jaune</span> dans le tableau sont utilisés pour définir des destinataires paramétrés, qui peuvent faire référence à des <span class='bg-info'>paramètres bleus</span>. Ainsi, pour ces items, il est possible de saisir :
		<ul>
			<li>une adresse mail au format <samp>machin.chose@trucmuche.com</samp></li>
			<li>
				un <span class='bg-info'>paramètre bleu </span>. Pour cela, le faire précéder du caractère <samp>#</samp>. Cet item peut être <strong>paramétré</strong> avec une variable. Ainsi :
				<ul>
					<li>La variable <samp>ANTENNE</samp> sera remplacée par le numéro de la section courante. Par exemple, <samp>#co-ANTENNE</samp> fera rérérence à <samp>#co-13</samp> lors de la consultation d'un DPS sur l'antenne de Courbevoie (n°13)</li>
				</ul>
			</li>
			<li>
				La variable <samp>#prefadpc</samp> est spécifique, puisqu'elle choisira comme destinataire :
				<ul>
					<li>L'item <samp>prefecture</samp> lorsqu'il s'agit d'un DPS sur notre département 92</li>
					<li>Un item <samp>adpc-XX</samp> où <samp>XX</samp> est le numéro du département du DPS, si extérieur au 92, comme par exemple <samp>adpc-78</samp></li>
				</ul>
			</li>
		</ul>
		Lorsqu'il y a plusieurs valeurs, il faut les séparer par une virgule.
	</p>

	<p class='text-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span> De mauvais paramètres peuvent empêcher le bon fonctionnement de l'application.</p>

	<br />
	<h3 class='text-primary'>Paramètres indispensables</h3>

	<div class='table-responsive'>
		<table class='table table-hover'>
			<thead>
				<tr>
					<th>Nom</th>
					<th>Valeur par défaut</th>
					<th>Explication</th>
				</tr>
			</thead>
			<tbody>
				<tr class='info'>
					<td><samp>fnpc</samp></td>
					<td><em>masqué</em></td>
					<td class='text-muted'>Adresse(s) mail de la FNPC pour validation d'un DPS hors-92</td>
				</tr>
				<tr class='info'>
					<td><samp>prefecture</samp></td>
					<td><em>masqué</em></td>
					<td class='text-muted'>Adresse(s) mail des DPS de la Préfcture 92 pour la validation des DPS sur le 92</td>
				</tr>
				<tr class='warning'>
					<td><samp>co-validate-recipients</samp></td>
					<td><samp>demande-dps@protectioncivile92.org</samp></td>
					<td class='text-muted'>Destinataire(s) pour la validation d'un DPS par un CO</td>
				</tr>
				<tr class='warning'>
					<td><samp>co-validate-ccrecipients</samp></td>
					<td><samp>#co-ANTENNE, #ddo</samp></td>
					<td class='text-muted'>Destinataire(s) en copie pour la validation d'un DPS par un CO</td>
				</tr>
				<tr class='warning'>
					<td><samp>co-cancel-recipients</samp></td>
					<td><samp>demande-dps@protectioncivile92.org</samp></td>
					<td class='text-muted'>Destinataire(s) pour l'annulation d'un DPS par un CO</td>
				</tr>
				<tr class='warning'>
					<td><samp>co-cancel-ccrecipients</samp></td>
					<td><samp>#co-ANTENNE, #ddo</samp></td>
					<td class='text-muted'>Destinataire(s) en copie pour l'annulation d'un DPS par un CO</td>
				</tr>
				<tr class='warning'>
					<td><samp>ddo-cancel-internal-recipients</samp></td>
					<td><samp>#co-ANTENNE</samp></td>
					<td class='text-muted'>Destinataire(s) pour le mail interne d'annulation d'un DPS qui avait déjà été validé par le DDO</td>
				</tr>
				<tr class='warning'>
					<td><samp>ddo-cancel-internal-ccrecipients</samp></td>
					<td><samp>#ddo</samp></td>
					<td class='text-muted'>Destinataire(s) en copie pour le mail interne d'annulation d'un DPS qui avait déjà été validé par le DDO</td>
				</tr>
				<tr class='warning'>
					<td><samp>ddo-cancel-external-recipients</samp></td>
					<td><samp>#prefadpc</samp></td>
					<td class='text-muted'>Destinataire(s) pour le mail externe d'annulation d'un DPS qui avait déjà été validé par le DDO</td>
				</tr>
				<tr class='warning'>
					<td><samp>ddo-cancel-external-ccrecipients</samp></td>
					<td><samp>#ddo</samp></td>
					<td class='text-muted'>Destinataire(s) en copie pour le mail externe d'annulation d'un DPS qui avait déjà été validé par le DDO</td>
				</tr>
				<tr class='warning'>
					<td><samp>ddo-wait-recipients</samp></td>
					<td><samp>#co-ANTENNE</samp></td>
					<td class='text-muted'>Destinataire(s) pour la mise en attente d'un DPS</td>
				</tr>
				<tr class='warning'>
					<td><samp>ddo-wait-ccrecipients</samp></td>
					<td><samp>#ddo</samp></td>
					<td class='text-muted'>Destinataire(s) en copie pour la mise en attente d'un DPS par un CO</td>
				</tr>
				<tr class='warning'>
					<td><samp>ddo-reject-recipients</samp></td>
					<td><samp>#co-ANTENNE</samp></td>
					<td class='text-muted'>Destinataire(s) pour le refus d'un DPS</td>
				</tr>
				<tr class='warning'>
					<td><samp>ddo-reject-ccrecipients</samp></td>
					<td><samp>#ddo</samp></td>
					<td class='text-muted'>Destinataire(s) en copie pour le refus d'un DPS</td>
				</tr>
				<tr class='warning'>
					<td><samp>ddo-validate-internal-recipients</samp></td>
					<td><samp>#co-ANTENNE</samp></td>
					<td class='text-muted'>Destinataire(s) pour le mail interne d'acceptation d'un DPS</td>
				</tr>
				<tr class='warning'>
					<td><samp>ddo-validate-internal-ccrecipients</samp></td>
					<td><samp>#ddo</samp></td>
					<td class='text-muted'>Destinataire(s) en copie pour le mail interne d'acceptation d'un DPS</td>
				</tr>
				<tr class='warning'>
					<td><samp>ddo-validate-external-recipients</samp></td>
					<td><samp>#prefadpc</samp></td>
					<td class='text-muted'>Destinataire(s) pour le mail externe d'acceptation d'un DPS</td>
				</tr>
				<tr class='warning'>
					<td><samp>ddo-validate-external-ccrecipients</samp></td>
					<td><samp>#ddo</samp></td>
					<td class='text-muted'>Destinataire(s) en copie pour le mail externe d'acceptation d'un DPS</td>
				</tr>
				<tr class='info'>
					<td><samp>ddo</samp></td>
					<td><samp>"Protection Civile - Direction des Opérations" &lt;directeur-operations@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Adresse mail du DDO</td>
				</tr>
				<tr class='info'>
					<td><samp>co-0</samp></td>
					<td><samp>operationnel@protectioncivile92.org</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS départementaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-1</samp></td>
					<td><samp>"CO Antony" &lt;operationnel-antony@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-2</samp></td>
					<td><samp>"CO Asnieres" &lt;operationnel-asnieres@protectioncivile92.org&gt;, "Président Asnieres" &lt;president-asnieres@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-5</samp></td>
					<td><samp>"CO Boulogne-Issy" &lt;operationnel-boulogne-issy@protectioncivile92.org"&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-6</samp></td>
					<td><samp>"CO Bourg-la-Reine" &lt;operationnel-bourg-la-reine@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-10</samp></td>
					<td><samp>"CO Clamart" &lt;operationnel-clamart@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-11</samp></td>
					<td><samp>"CO Clichy" &lt;operationnel-clichy@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-12</samp></td>
					<td><samp>"CO Colombes" &lt;operationnel-colombes@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-13</samp></td>
					<td><samp>"CO Courbevoie" &lt;operationnel-courbevoie@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-15</samp></td>
					<td><samp>"CO Garches" &lt;operationnel-garches@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-17</samp></td>
					<td><samp>"CO Gennevilliers" &lt;operationnel-gennevilliers@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-20</samp></td>
					<td><samp>"CO Levallois" &lt;operationnel-levallois@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-24</samp></td>
					<td><samp>"CO Nanterre" &lt;operationnel-nanterre@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-28</samp></td>
					<td><samp>"CO Rueil" &lt;operationnel-rueil@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-32</samp></td>
					<td><samp>"CO Suresnes-Puteaux" &lt;operationnel-suresnes-puteaux@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-33</samp></td>
					<td><samp>"CO Vanves" &lt;operationnel-vanves@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>co-36</samp></td>
					<td>"CO Villeneuve" &lt;operationnel-villeneuve@protectioncivile92.org&gt;</samp></td>
					<td class='text-muted'>Destinataire(s) pour les DPS locaux</td>
				</tr>
				<tr class='info'>
					<td><samp>adpc-75</samp></td>
					<td><em>masqué</em></td>
					<td class='text-muted'>Destinataire(s) pour validation d'un DPS sur leur territoire</td>
				</tr>
				<tr class='info'>
					<td><samp>adpc-78</samp></td>
					<td><em>masqué</em></td>
					<td class='text-muted'>Destinataire(s) pour validation d'un DPS sur leur territoire</td>
				</tr>
				<tr class='info'>
					<td><samp>adpc-93</samp></td>
					<td><em>masqué</em></td>
					<td class='text-muted'>Destinataire(s) pour validation d'un DPS sur leur territoire</td>
				</tr>
				<tr class='info'>
					<td><samp>adpc-94</samp></td>
					<td><em>masqué</em></td>
					<td class='text-muted'>Destinataire(s) pour validation d'un DPS sur leur territoire</td>
				</tr>
				<tr class='info'>
					<td><samp>adpc-95</samp></td>
					<td><em>masqué</em></td>
					<td class='text-muted'>Destinataire(s) pour validation d'un DPS sur leur territoire</td>
				</tr>
			</tbody>
		</table>
	</div>

</div>

<?php include('components/footer.php'); ?>

</body>
</html>
