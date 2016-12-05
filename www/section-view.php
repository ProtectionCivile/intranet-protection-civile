<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des sections</title>
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
<?php require_once('functions/controller/section-delete-controller.php'); ?>


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
							<th>N°</th>
							<th>Commune</th>
							<th>Rattachement</th>
							<th>Adresse</th>
							<th>CP</th>
							<th>Ville</th>
							<th>Téléphone</th>
							<th>Adresse e-mail</th>
							<th colspan='2'>Opérations</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT shortname,name,`number`,attached_section,address,zip_code,city,phone,mail FROM sections ORDER BY number";
						$section_result = mysqli_query($link, $query);
						while($section = mysqli_fetch_array($section_result)){
							$isAttachedToItself = ($section["number"] == $section["attached_section"]);
							$trclass = "";
							if ($section["attached_section"] == "0"){
								$trclass = "danger";
							}
							elseif ($isAttachedToItself){
								$trclass = "success";
							}
							else{
								$trclass = "warning";
							}
							?>
							<tr class='<?php echo $trclass; ?>'>
								<td>
									<?php echo $section["shortname"];?>
								</td>
								<td>
									<?php echo $section["number"];?>
								</td>
								<?php 
								$colspan = "";
								if ( $isAttachedToItself ) {
									$colspan = "2";
								}
								?>
								<td colspan='<?php echo $colspan;?>'>
									<?php echo $section["name"];?> 
								</td>
								
								<?php 
								if (!$isAttachedToItself){
									$attached_section = $section["attached_section"];
									$sql = "SELECT shortname FROM sections WHERE number='$attached_section' ORDER BY number";
									$query = mysqli_query($link, $sql);
									$rattach = mysqli_fetch_array($query);

									echo "<td>";
									echo $rattach['shortname'];
									echo "</td>";
								}
								?>
								<td>
									<?php echo $section["address"]; ?>
								</td>
								<td>
									<?php echo $section["zip_code"]; ?>
								</td>
								<td>
									<?php echo $section["city"]; ?>
								</td>
								<td>
									<?php echo $section["phone"]; ?>
								</td>
								<td>
									<?php 
									if (!empty($section["mail"])) {
										echo $section["mail"]."@protectioncivile92.org";
									}
									?>
								</td>
								<td>
									<?php if ($rbac->check("admin-sections-update", $currentUserID)) {?>
										<form role="form" action="section-edit.php" method="post">
											<input type='hidden' name='ID' value='<?php echo $section["number"]; ?>'/>
											<button type='submit' class='btn btn-warning glyphicon glyphicon-pencil' title='Modifier'></button>
										</form>
									<?php } ?>
								</td>
								<td>	
									<?php if ($rbac->check("admin-sections-update", $currentUserID)) { ?>							
										<form action='' method='post' accept-charset='utf-8'>
											<input type='hidden' name='ID' value='<?php echo $section["number"]; ?>'/>
											<button type='submit' class='btn btn-danger glyphicon glyphicon-trash' title="Supprimer" onclick='return(confirm("Etes-vous sûr de vouloir supprimer la section?"));'></button>
										</form>
									<?php }?>
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