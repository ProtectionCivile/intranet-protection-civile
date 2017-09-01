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
	$user_has_chosen_a_section = ($_SESSION['filtered_section'] || $_SESSION['filtered_section'] == '0');
	$user_has_chosen_a_tag = !(empty($_SESSION['tags']));
	$query_cities = "SELECT name, address, zip_code, city, phone, mail, website FROM sections WHERE number=".$_SESSION['filtered_section'] or die("Erreur lors de la consultation" . mysqli_error($db_link));
	$cities = mysqli_query($db_link, $query_cities);
	$city = mysqli_fetch_assoc($cities);
	if ( !$user_has_chosen_a_section && !$user_has_chosen_a_tag ) {
		?>
		<br />
		<div class='alert alert-info' role='alert'>
			Trop de résultats pour tout afficher. Sélectionner une commune dans la liste
		</div>
		<?php
	}
	else {
		if ($user_has_chosen_a_section) {
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
			<?php
		}
		?>

		<div class="panel panel-info">
			<div class='panel-body'>
		<?php
			$next_alignment = 'left';
			$roles = mysqli_query($db_link, $sqlQuery);
			while($role = mysqli_fetch_array($roles)) {
				$query = "SELECT U.first_name, U.last_name, U.login, U.phone FROM $tablename_users AS U JOIN $tablename_userroles AS UR on U.ID=UR.UserID WHERE UR.RoleID=".$role['ID']." ORDER BY U.last_name" or die("Erreur lors de la consultation" . mysqli_error($db_link));
				$users = mysqli_query($db_link, $query);
				$user = null;
				$user_login = null;
				$user_first_name = null;
				$user_last_name = null;
				$user_phone = null;
				$user_picture_path = null;
				while($user = mysqli_fetch_array($users)) {
					$user_login = $user["login"];
					$user_first_name = $user["first_name"];
					$user_last_name = $user["last_name"];
					$user_phone = $user["phone"];
					$user_picture_path = getUserPicturePath($setting_service, $user_login);
				}
				$query = "SELECT name FROM $tablename_sections WHERE `number`=".$role['Affiliation'] or die("Erreur lors de la consultation" . mysqli_error($db_link));
				$cities = mysqli_query($db_link, $query);
				$attached_section = null;
				while($section = mysqli_fetch_array($cities)) {
					$section_name = $section["name"];
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

				echo $prefix_1;
				if (!empty($user_picture_path)) {
					?> <center><img src='<?php echo $user_picture_path ?>' alt='user picture' class='img-circle'/> </center><?php
				}
				else {
					?> <center><img src='img/unknown_user.jpeg' alt='user picture' class='img-circle'/> </center><?php
				}
				echo $suffix_1;
				echo $prefix_2;
				?>
				<h4 class='text-primary'><?php echo htmlentities($role["Description"]) ?> <small> <?php echo (!$user_has_chosen_a_section) ? '<br />'.htmlentities($section_name) : ''?> </small><br /></h4>
				<?php
				if (!empty($user_first_name)) {
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
