<?php if ($rbac->check("ope-dps-view-all", $currentUserID)) { ?>
	<ul class="nav nav-pills">
		<?php $activeOrNot = isset($city) ? "" : "class='active'"; ?>
		<li role="presentation" <?php echo $activeOrNot;?> ><a href="dps-list-view.php">TOUS</a></li>
		<?php 
		$query = "SELECT name, shortname, `number` FROM sections WHERE attached_section=number" or die("Erreur lors de la consultation" . mysqli_error($link)); 
		$villes = mysqli_query($link, $query);
		while($ville = mysqli_fetch_array($villes)) { 
			$activeOrNot = "";
			if ($city == $ville['number']) {
				$activeOrNot = "class='active'";
			} ?>
			<li role="presentation" <?php echo $activeOrNot;?> ><a href='dps-list-view.php?city=<?php echo $ville['number']; ?>'><?php echo $ville['shortname']; ?></a></li>
		<?php } ?>
	</ul>
<?php } ?>