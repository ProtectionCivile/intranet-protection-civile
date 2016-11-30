<?php require_once('functions/session/security.php'); ?>
<html>
<head>
 	<title>Annuaire : Numéros de téléphone des communes</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php require_once('components/header.php'); ?>

<!-- Redirect user if unauthorized (bad request) => shoot him -->
<?php
if (isset($_GET['notallowed'])){
	header("Location: login.php?notallowed");
	exit();
}
?>

<div class="container">

	<p class="bg-success">Bonjour <strong><?php echo $currentUserFirstName; ?></strong>, bienvenue dans votre espace sécurisé</p>
	
	<center><img class="img-responsive" src='img/logo.png'/></center>
	<h2 class="text-center">Protection Civile des Hauts-de-Seine</h2>
	<center>
		<?php
		$queryC="SELECT numero, nom FROM commune WHERE rat_commune=numero";
		$cities = mysqli_query($link, $queryC);
		?>

		<table class="table table-bordered table-responsive table-condensed">
			<thead>
				<th class='active'>Commune</th>
				<th class='active'>Rôle</th>
				<th class='active'>Téléphone</th>
			</thead>
			<tbody>
				<?php while($city = mysqli_fetch_array($cities)) { 
					$reset=0;
					$queryR="SELECT Description, Phone FROM rbac_roles WHERE Affiliation='".$city['numero']."'" ;
					$roles = mysqli_query($link, $queryR);
					$count=mysqli_num_rows($roles);
					while($role = mysqli_fetch_array($roles)) { 
						echo "<tr>";
						if ($reset==0) {
							echo "<td rowspan='".$count."'><strong>".$city['nom']."</strong></td>";
							$reset=1;
						}
						if ($role["Phone"]) 
						{
							echo "<td class='warning'>".$role["Description"]."</td>";
							echo "<td class='warning'>".$role["Phone"]."</td>";
						} 
						else {
							echo "<td>".$role["Description"]."</td>";
							echo "<td>".$role["Phone"]."</td>";
						}
						echo "</tr>";
					}
					
				}?>
			</tbody>
		</table> 
	</center>
	
</div>

<?php include('components/footer.php'); ?>
  
</body>
</html>