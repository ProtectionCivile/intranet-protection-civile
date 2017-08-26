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
	<li class="active">Antennes</li>
</ol>

<div class="container">

	<div class="page-header">
		<h1>Aide en ligne <small>Antennes de Protection Civile</small></h1>
	</div>

	<p class='lead'>Une section est une commune, donc une potentielle antenne de Protection Civile.</p>

	<p>Les sections sont toutes modifiables. Une section peut être rattachée à une autre, et leur statut actif / inactif est déterminé par leur "rattachement". L'ADPC-92 est considéré comme une section.</p>
	<ul>
		<li>Une section sans rattachement est considérée comme une antenne de PC et apparaît <span class='bg-success'>en vert</span> dans le tableau</li>
		<li>Une section rattachée à une autre sera inactive et apparaît <span class='bg-danger'>en rouge</span> dans le tableau</li>
		<li>Une section rattachée à l'ADPC est considérée comme inactive et apparaît <span class='bg-warning'>en jaune</span> dans le tableau</li>
	</ul>

	<p>Seules les sections adtives sont présenes dans l'annuaire et dans les différents filtres.</p>

<?php include('components/footer.php'); ?>

</body>
</html>
