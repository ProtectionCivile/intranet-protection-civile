<div class="panel panel-success">
	<div class="panel-heading">
		<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#preselect-panel-filter" aria-expanded='true' aria-controls="select-city-panel-filter">
			<span aria-hidden="true">Montrer/Cacher</span>
		</button>
		<h3 class="panel-title">Pré-remplissage de la création de DPS</h3>
	</div>
	<div class="panel-body in" aria-expanded='true' id="preselect-panel-filter">
		<form class="form-horizontal" role="form" action="" method="post">
			<input type='hidden' name='city' value='<?php echo $ordered_section; ?>'>
			<div class="form-group form-group-sm">
				<label for="org_id" class="col-sm-4 control-label">Organisateur pré-enregistré :</label>
				<div class="col-sm-4">
					<select class="form-control" name="org_id" id="org_id">
						<?php
						$sql = "SELECT * FROM $tablename_clients WHERE attached_section=$ordered_section ORDER BY ref ASC";
						var_dump($sql);
						$query = mysqli_query($db_link, $sql);
						while($org = mysqli_fetch_array($query)){
							if($org_id == $org['id']){
								echo "<option value='".$org["id"]."' selected>".htmlentities($org["ref"])."</option>";
							}
							else{
								echo "<option value='".$org["id"]."'>".htmlentities($org["ref"])."</option>";
							}
						}
						?>
					</select>
				</div>
				<div class="btn-group col-sm-4" role="group">
					<button type="submit" class="btn btn-warning">Pré-remplir l'orga</button>
				</div>
			</div>
		</form>

		<form class="form-horizontal" role="form" action="" method="post">
			<div class="form-group form-group-sm">
				<label for="duplicate_dps" class="col-sm-4 control-label">Dupliquer le poste :</label>
				<div class="col-sm-4">
					<select class="form-control" name="duplicate_dps" id="duplicate_dps">
						<?php
						$sql = "SELECT id, cu_full, event_name FROM $tablename_dps WHERE section=$ordered_section ORDER BY id DESC LIMIT 100";
						$query = mysqli_query($db_link, $sql);
						while($listecu = mysqli_fetch_array($query)){
							echo "<option value='".$listecu["id"]."'>".htmlentities($listecu["cu_full"])." - ".htmlentities($listecu["event_name"])."</option>";
						}
						?>
					</select>
				</div>
				<div class="btn-group col-sm-4" role="group">
					<button type="submit" class="btn btn-warning">Pré-remplir avec ce DPS</button>
				</div>
			</div>
		</form>
	</div>
</div>
