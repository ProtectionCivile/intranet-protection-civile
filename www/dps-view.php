<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Liste des DPS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8";>
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>
<?php include('components/header.php'); ?>
<?php require_once('functions/dps/dps-view-functions.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Opérationnel</a></li>
	<li><a href="#">Dispositifs de secours</a></li>
	<li class="active">Listing</li>
</ol>


<!-- Authentication -->
<?php 
	if(isset($_GET['commune'])){
		$rbac->enforce("ope-dps-view-own", $currentUserID); 
	}
	else {
		$rbac->enforce("ope-dps-view-all", $currentUserID); 
	}
?>



<!-- Page content container -->
<div class="container">

	<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Liste des Dispositifs Prévisionnels de Secours</h3>
	</div>
	<div class="panel-body">
	<div class="table-responsive" style="vertical-align: middle;">
	<table class="table table-bordered table-condensed">
		<thead>
			<th>Date</th>
			<th>Numéro CU</th>
			<th>DPT</th>
			<th>Type</th>
			<th>Description</th>
			<th>Validation</th>
			<th>Action</th>
		</thead>
		<tbody>
	
			<?php
			$dpsperpage = 50;

			if(isset($_GET['commune'])){
				$commune = $_GET['commune'];
				$query = "SELECT id, commune_ris FROM demande_dps WHERE commune_ris = $commune";
				$number_dps = mysqli_query($link, $query);
				$row_cnt = mysqli_num_rows($number_dps);
				$numberpages=ceil($row_cnt/$dpsperpage);
			
				if(isset($_GET['page'])){
					$pagecurrent=intval($_GET['page']);
					if($pagecurrent>$numberpages)
					{
						$pagecurrent=$numberpages;
					}
				}
				else{
					$pagecurrent=1;
				}
				$premiereEntree=($pagecurrent-1)*$dpsperpage;
				$query = "SELECT id, dps_debut_poste, cu_complet, dept, type_dps, description_manif, commune_ris, valid_demande_rt, valid_demande_dps, etat_demande_dps FROM demande_dps WHERE commune_ris = $commune ORDER BY id DESC LIMIT $premiereEntree, $dpsperpage";
				$listedps_result = mysqli_query($link, $query);
			
			}
			elseif(isset($_GET['filter'])){
				$filter = $_GET['filter'];
				if($filter == "en-attente"){
					$query = "SELECT id, etat_demande_dps, valid_demande_rt FROM demande_dps WHERE valid_demande_rt NOT LIKE '0000-00-00' AND valid_demande_dps LIKE '0000-00-00'";
				}
				$number_dps = mysqli_query($link, $query);
				$row_cnt = mysqli_num_rows($number_dps);
				$numberpages=ceil($row_cnt/$dpsperpage);
				
				if(isset($_GET['page'])){
					$pagecurrent=intval($_GET['page']);
					if($pagecurrent>$numberpages){
						$pagecurrent=$numberpages;
					}
				}
				else{
					$pagecurrent=1;
				}
				$premiereEntree=($pagecurrent-1)*$dpsperpage;
				$query = "SELECT id, dps_debut_poste, cu_complet, dept, type_dps, description_manif, commune_ris, valid_demande_rt, valid_demande_dps, etat_demande_dps FROM demande_dps WHERE valid_demande_rt NOT LIKE '0000-00-00' AND valid_demande_dps LIKE '0000-00-00' ORDER BY id DESC LIMIT $premiereEntree, $dpsperpage";
				$listedps_result = mysqli_query($link, $query);
			
			}
			else{
				$query = "SELECT id FROM demande_dps";
				$number_dps = mysqli_query($link, $query);
				$row_cnt = mysqli_num_rows($number_dps);
				$numberpages=ceil($row_cnt/$dpsperpage);
			
				if(isset($_GET['page'])){
					$pagecurrent=intval($_GET['page']);
					if($pagecurrent>$numberpages){
						$pagecurrent=$numberpages;
					}
				}
				else{
					$pagecurrent=1;
				}
				$premiereEntree=($pagecurrent-1)*$dpsperpage;
				$query = "SELECT id, dps_debut_poste, cu_complet, dept, type_dps, description_manif, commune_ris, valid_demande_rt, valid_demande_dps, etat_demande_dps FROM demande_dps ORDER BY id DESC LIMIT $premiereEntree, $dpsperpage";
				$listedps_result = mysqli_query($link, $query);
			}

			while($listedps = mysqli_fetch_array($listedps_result)){
				?>

				<?php include('functions/dps/choose-between-dps-type.php'); ?>


				<tr <?php echo $trClass;?> >
					<td>
						<?php echo $listedps["dps_debut_poste"]; ?>
					</td>
					<td>
						<?php echo $listedps["cu_complet"]; ?>
					</td>
					<td>
						<?php echo compute_dps_department($listedps["dept"]); ?>
					</td>
					<td>
						<?php echo compute_dps_type($listedps["type_dps"]); ?>
					</td>
					<td>
						<?php echo $listedps["description_manif"]; ?>
					</td>
					<td>
						<?php echo compute_dps_status($refus, $validation_ec, $validation, $listedps["valid_demande_dps"]); ?>
					</td>
					<td>
						<form role='form' action='<?php echo $urlform; ?>' method='post'>
							<input type='hidden' name='id' value='<?php echo $listedps["id"]; ?>'>
							<button type='submit' class='<?php echo $buttonclass; ?>'></button>
						</form>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	

	<nav>
		<ul class="pagination pagination-sm">
			<?php 
			for($i=1; $i<=$numberpages; $i++){
				if($i==$pagecurrent){ ?>
					<li class="active">
						<a href="<?php echo $i; ?>"><?php echo $i; ?><span class="sr-only">(current)</span></a>
					</li>
			
				<?php 
				}
				else{
					if(isset($_GET['commune'])){
						$pageget = "?commune=".$commune."&page=".$i;
					}
					elseif(isset($_GET['filter'])){
						$pageget = "?filter=".$filter."&page=".$i;
					}
					else{
						$pageget = "?page=".$i;
					}
					?>
					<li>
						<a href='dps-view.php <?php echo $pageget; ?>'><?php echo $i; ?></a>
					</li>
					<?php
				}
			}
			?>
		</ul>
	</nav>
		</div>
	</div>
	</div>
	</div>
	<?php include 'footer.php'; ?>
	</body>
	</html>