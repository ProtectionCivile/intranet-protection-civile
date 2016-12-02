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
				if(isset($_GET['city'])){
					$pageget = "?city=".$city."&page=".$i;
				}
				elseif(isset($_GET['filter'])){
					$pageget = "?filter=".$filter."&page=".$i;
				}
				else{
					$pageget = "?page=".$i;
				}
				?>
				<li>
					<a href='dps-view.php<?php echo $pageget; ?>'><?php echo $i; ?></a>
				</li>
				<?php
			}
		}
		?>
	</ul>
</nav>	