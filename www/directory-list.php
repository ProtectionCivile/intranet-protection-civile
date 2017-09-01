<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Annuaire en ligne</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Accueil</a></li>
	<li class="active">Annuaire en ligne</li>
</ol>

<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php require_once('functions/directory/directory-compute-city.php'); ?>


<!-- Authentication -->
<?php require_once('functions/directory/directory-view-authentication.php'); ?>


<!-- Page content container -->
<div class="container">

	<div class="page-header">
		<h2>Annuaire en ligne</h2>
	</div>

	<?php $base_url="directory-list.php"; ?>

	<!-- Beginning of the filter's parent module -->
	<?php include_once('components/filter/filter-directory-module.php'); ?>

	<?php require_once('components/filter/filter-directory-query-builder.php'); ?>

	<?php //require_once('components/filter/parts/paging-query-modifier.php'); ?>

	<?php require_once('functions/user/user-picture-retriever.php'); ?>

	<!-- List available roles -->

	<?php
	$query_cities = "SELECT name, address, zip_code, city, phone, mail, website FROM sections WHERE number=".$_SESSION['filtered_section'] or die("Erreur lors de la consultation" . mysqli_error($db_link));
	$cities = mysqli_query($db_link, $query_cities);
	$city = mysqli_fetch_assoc($cities);
	if ( !$_SESSION['filtered_section'] && $_SESSION['filtered_section'] != '0' ) {
		?>
		<br />
		<div class='alert alert-info' role='alert'>
			Trop de résultats pour tout afficher. Sélectionner une commune dans la liste
		</div>
		<?php
	}
	else {
		?>
		<div class="panel panel-success">
			<div class='panel-heading'>
				<h1 class="panel-title">Antenne : <?php echo $city['name'] ?></h1>
			</div>
			<div class='panel-body'>
				<span class='glyphicon glyphicon-pushpin'></span><span class='text-muted'> <?php echo htmlentities($city['address']).", ".htmlentities($city['zip_code'])." ".mb_strtoupper($city['city']); ?></span> <br />
				<span class='glyphicon glyphicon-earphone'></span><span class='text-muted'> <?php echo formatPhoneToReadable(htmlentities($city['phone'])) ?></span> <br />
				<span class='glyphicon glyphicon-envelope'></span><span class='text-muted'> <?php echo htmlentities($city['mail']) ?></span> <br />
				<span class='glyphicon glyphicon-globe'></span><span class='text-muted'> <?php echo htmlentities($city['website']) ?></span> <br />
		</div>
	</div>

		<div class="panel panel-info">
			<div class='panel-body'>
		<?php
			$next_alignment = 'left';
			$roles = mysqli_query($db_link, $sqlQuery);
			while($role = mysqli_fetch_array($roles)) {
				$query = "SELECT U.first_name, U.last_name, U.login, U.phone FROM $tablename_users AS U JOIN $tablename_userroles AS UR on U.ID=UR.UserID WHERE UR.RoleID=".$role['ID']." ORDER BY U.last_name" or die("Erreur lors de la consultation" . mysqli_error($db_link));
				$users = mysqli_query($db_link, $query);
				$user = null;
				while($user = mysqli_fetch_array($users)) {
					$user_login = $user["login"];
					$user_first_name = $user["first_name"];
					$user_last_name = $user["last_name"];
					$user_phone = $user["phone"];
				}
				if ($next_alignment == 'left') {
					$prefix_1 = "<div class='row'><div class='col-sm-2'>";
					$suffix_1 = "</div>";
					$prefix_2 = "<div class='col-sm-4'>";
					$suffix_2 = "</div>";
					$next_alignment = 'right';
				}
				else {
					$prefix_1 = "<div class='col-sm-2'>";
					$suffix_1 = "</div>";
					$prefix_2 = "<div class='col-sm-4'>";
					$suffix_2 = "</div></div>";
					$next_alignment = 'left';
				}
				?>
				<?php echo $prefix_1 ?>
				<img src='<?php echo getUserPicturePath($setting_service, $user_login) ?>' alt='user picture' class='img-circle'/>
				<?php echo $suffix_1 ?>
				<?php echo $prefix_2 ?>
				<h4 class='text-primary'><?php echo htmlentities($role["Description"]) ?> </h4>
				<?php
				if (!empty($user)) {
					?> <strong><?php echo ucfirst(htmlentities($user_first_name))." ".mb_strtoupper($user_last_name) ?> </strong> <br /> <?php
				}
				if (!empty($role["Mail"])) {
					?> <span class='glyphicon glyphicon-envelope'></span> <?php echo htmlentities($role["Mail"]) ?> <br /> <?php
				}
				if (!empty($role["Phone"])) {
					?> <span class='glyphicon glyphicon-earphone'></span> <?php echo formatPhoneToReadable(htmlentities($role["Phone"])) ?> <em>(tél de fonction)</em><br /> <?php
				}
				elseif (!empty($user["phone"])) {
					?> <span class='glyphicon glyphicon-earphone'></span> <?php echo formatPhoneToReadable(htmlentities($user_phone)) ?> <em>(tél personnel)</em><br /> <?php
				}
				if (!empty($role["Phone"])) {
					?> <span class='glyphicon glyphicon-phone'></span> <?php echo htmlentities($role["Callsign"]) ?> <br /> <?php
				}
				echo $suffix_2;
			}
			if ($next_alignment == 'right') { // Si on n'a pas fermé la balise droite avec la ligne
				?>
					<div class='col-sm-2'>
					</div>
					<div class='col-sm-4'>
					</div>
				</div>
				<?php
			}
		}
		?>
	</div>

	</div>

	<!-- Page's pagination module -->
	<?php //require_once('components/filter/parts/filter-paging-display.php'); ?>

</div>

<?php include('components/footer.php'); ?>
</body>
</html>
