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
		<div class="container">
		<?php
			$next_alignment = 'left';
			$roles = mysqli_query($db_link, $sqlQuery);
			while($role = mysqli_fetch_array($roles)) {
				$query = "SELECT U.first_name, U.last_name, U.login FROM $tablename_users AS U JOIN $tablename_userroles AS UR on U.ID=UR.UserID WHERE UR.RoleID=".$role['ID']." ORDER BY U.last_name" or die("Erreur lors de la consultation" . mysqli_error($db_link));
				$users = mysqli_query($db_link, $query);
				while($user = mysqli_fetch_array($users)) {

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
					<img src='<?php echo getUserPicturePath($setting_service, $user["login"]) ?>' alt='user picture' class='img-circle'/>
					<?php echo $suffix_1 ?>
					<?php echo $prefix_2 ?>
					<strong><?php echo htmlentities($role["Description"]) ?> </strong> <br />
					<?php echo ucfirst(htmlentities($user["first_name"]))." ".mb_strtoupper($user["last_name"]) ?> <br />
					<span class='glyphicon glyphicon-envelope'></span> <?php echo htmlentities($role["Phone"]) ?> <br />
					<span class='glyphicon glyphicon-earphone'></span> <?php echo htmlentities($role["Mail"]) ?> <br />
					<span class='glyphicon glyphicon-phone'></span> <?php echo htmlentities($role["Callsign"]) ?> <br />
					<?php echo $suffix_2 ?>
					<?php
				}
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

	<!-- Page's pagination module -->
	<?php //require_once('components/filter/parts/filter-paging-display.php'); ?>

</div>

<?php include('components/footer.php'); ?>
</body>
</html>
