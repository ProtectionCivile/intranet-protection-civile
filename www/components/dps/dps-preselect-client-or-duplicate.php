<div class="panel panel-warning">
	<div class="panel-heading">
		<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#preselect-panel-filter" aria-expanded='true' aria-controls="select-city-panel-filter">
			<span aria-hidden="true" >Montrer/Cacher</span>
		</button>
		<h3 class="panel-title">Pré-remplissage de la création de DPS</h3>
	</div>
	<div class="panel-body in" aria-expanded='true' id="preselect-panel-filter">
		<form class="form-horizontal" role="form" action="" method="post">
			<input type='hidden' name='city' value='<?php echo $city; ?>'>
			<div class="form-group form-group-sm">
				<label for="org_id" class="col-sm-4 control-label">Organisateur pré-enregistré :</label>
				<div class="col-sm-4">
					<select class="form-control" name="org_id" id="org_id">
						<?php
						$sql = "SELECT * FROM $tablename_clients WHERE city=$city ORDER BY ref ASC";
						$query = mysqli_query($link, $sql);
						while($org = mysqli_fetch_array($query)){
							if($org_id == $org['id']){
								echo "<option value='".$org["id"]."' selected>".$org["ref"]."</option>";
							}
							else{
								echo "<option value='".$org["id"]."'>".$org["ref"]."</option>";
							}
						}
						?>
					</select>
				</div>
				<div class="btn-group col-sm-4" role="group">
					<button type="submit" class="btn btn-warning">Selectionner</button>
				</div>
			</div>
		</form>

		<form class="form-horizontal" role="form" action="" method="post">
			<div class="form-group form-group-sm">
				<label for="duplicate_dps" class="col-sm-4 control-label">Dupliquer le poste :</label>
				<div class="col-sm-4">
					<select class="form-control" name="duplicate_dps" id="duplicate_dps">
						<?php
						echo $city;
						$sql = "SELECT id, cu_complet, description_manif FROM $tablename_dps WHERE commune_ris=$city ORDER BY id DESC LIMIT 50";
						echo $sql;
						$query = mysqli_query($link, $sql);
						while($listecu = mysqli_fetch_array($query)){
							echo "<option value='".$listecu["id"]."'>".$listecu["cu_complet"]." - ".$listecu["description_manif"]."</option>";
						}
						?>
					</select>
				</div>
				<div class="btn-group col-sm-4" role="group">
					<button type="submit" class="btn btn-warning">Selectionner</button>
				</div>
			</div>
		</form>
	</div>
</div>

<?php 
	
	$org_id="";
	if(isset($_POST['org_id'])){
		$org_id = $_POST['org_id'];
		$sql = "SELECT * FROM $tablename_clients WHERE id=$org_id";
		$query = mysqli_query($link, $sql);
		$org_array = mysqli_fetch_array($query);
	}

	$duplicate_dps="";
	if(isset($_POST['duplicate_dps'])){
		$duplicate_dps_id = $_POST['duplicate_dps'];
		$sql = "SELECT * FROM $tablename_dps WHERE id=$duplicate_dps_id";
		$query = mysqli_query($link, $sql);
		$duplicate_array = mysqli_fetch_array($query);
	}
?>