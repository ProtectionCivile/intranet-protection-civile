<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des utilisateurs</title>
	<meta http-equiv="Content-Type" content="text/html">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all" title="no title" charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Administration</a></li>
	<li class="active">Gestion des sections</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-sections-view", $currentUserID); ?>


<!-- Delete a section : Controller -->
<?php include 'functions/controller/section-delete-controller.php'; ?>


<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Liste des communes</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th>Code</th>
							<th>Commune</th>
							<th>Rattachement</th>
							<th>Adresse</th>
							<th>CP</th>
							<th>Ville</th>
							<th>Téléphone</th>
							<th>Adresse e-mail</th>
							<th>Modifier</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT shortname,name,`number`,attached_section,address,zip_code,city,phone,mail FROM sections";
						$listecommune_result = mysqli_query($link, $query);
						while($listecommune = mysqli_fetch_array($listecommune_result)){
							$trclass = "";
							if ($listecommune["attached_section"] == "99"){
								$trclass = "danger";
							}
							elseif ($listecommune["number"] != $listecommune["attached_section"]){
								$trclass = "warning";
							}
							else{
								$trclass = "success";
							}
							?>
							<tr class='<?php echo $trclass; ?>'>
								<td>
									<?php echo $listecommune["shortname"];?>
								</td>
								<?php 
								$colspan = "";
								if ( !($listecommune["attached_section"] == "99") && ($listecommune["number"] == $listecommune["attached_section"])){
									$colspan = "2";
								}
								?>
								<td colspan='<?php echo $colspan;?>'>
									<?php echo $listecommune["name"];?> 
								</td>
								
								<?php 
								if ($listecommune["attached_section"] == "99"){
									echo "<td>";
									$attached_section = $listecommune["attached_section"];
									$rat_query = "SELECT numero_commune,nom_commune FROM rat_com WHERE numero_commune=$attached_section";
									$rat_result = mysqli_query($link, $rat_query);
									$rattach = mysqli_fetch_array($rat_result);
									echo $rattach["nom_commune"];
									echo "</td>";
								}
								elseif ($listecommune["number"] != $listecommune["attached_section"]){
									echo "<td>";
									$attached_section = $listecommune["attached_section"];
									$rat_query = "SELECT numero_commune,nom_commune FROM rat_com WHERE numero_commune=$attached_section";
									$rat_result = mysqli_query($link, $rat_query);
									$rattach = mysqli_fetch_array($rat_result);
									echo $rattach["nom_commune"];
									echo "</td>";
								}
								else{
								}
								?>
								<td>
									<?php echo $listecommune["address"]; ?>
								</td>
								<td>
									<?php echo $listecommune["zip_code"]; ?>
								</td>
								<td>
									<?php echo $listecommune["city"]; ?>
								</td>
								<td>
									<?php echo $listecommune["phone"]; ?>
								</td>
								<td>
									<?php 
									if (!empty($listecommune["mail"])) {
										echo $listecommune["mail"]."@protectioncivile92.org";
									}
									?>
								</td>
								<td>
									<form role="form" action="city-edit.php" method="post">
										<input type='hidden' name='modifier' value='<?php $listecommune["number"]; ?>'/>
										<button type='submit' class='btn btn-warning glyphicon glyphicon-pencil' title='Modifier'></button>
									</form>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php require_once('components/footer.php'); ?>
</body>
</html>