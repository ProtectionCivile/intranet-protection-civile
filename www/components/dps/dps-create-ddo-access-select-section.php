<?php
	if ($rbac->check("ope-dps-update-all", $currentUserID)) {
		?>
		<div class="panel panel-danger">
			<div class="panel-heading">
				<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#select-city-panel-filter" aria-expanded='true' aria-controls="select-city-panel-filter">
					<span aria-hidden="true" >Montrer/Cacher</span>
				</button>
				<h3 class="panel-title">Accès spécial DDO</h3>
			</div>
			<div class="panel-body in" aria-expanded='true' id="select-city-panel-filter" >
				<form class="form-horizontal" role="form" action="" method="post">
				<div class="form-group form-group-sm">
					<label for="city" class="col-sm-4 control-label">Antenne :</label>
					<div class="col-sm-4">
						<select class="form-control" name="city" id="comune_dps">
							<?php
							$sql = "SELECT number, name FROM $tablename_sections WHERE number=attached_section";
							$query = mysqli_query($db_link, $sql);
							while($listecommune = mysqli_fetch_array($query)){
								if($listecommune["number"] == $ordered_section){
									echo "<option value='".$listecommune["number"]."' selected>".htmlentities($listecommune["name"])."</option>";
								}
								else{
									echo "<option value='".$listecommune["number"]."'>".htmlentities($listecommune["name"])."</option>";
								}
							}
							?>
						</select>
					</div>
					<div class="btn-group col-sm-4" role="group">
						<button type="submit" class="btn btn-warning">Sélectionner</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	<?php }
?>
