<div class='container form-group'>
	<div class='col-md-10'>
		<?php if ($nb_pages > 1) { ?>
			<nav>
				<ul class="pagination pagination-sm">
					<li class='paging-filter-prev' >
						<a href="#" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
			    	<?php
					for($i=1; $i<=$nb_pages; $i++){
						$liClass = ($i==$current_page) ? "active" : "";
						$liSpan = ($i==$current_page) ? "<span class='sr-only'>(current)</span>" : "";
						?>
						<li class='paging-filter <?php echo $liClass; ?>' data-filter='<?php echo $i; ?>' >
							<a href="#"><?php echo $i.$liSpan; ?></a>
						</li>
					<?php } ?>
					<li class='paging-filter-next'>
						<a href="#" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				</ul>
			</nav>
		<?php } ?>
	</div>
	<div class='col-md-2'>
		<label for='nbelements-filter'>Éléments par page</label>
		<select class="form-control nbelements-filter">
			<option <?php if ($nb_elements_per_page == 10) echo "selected"; ?>>10</option>
			<option <?php if ($nb_elements_per_page == 25) echo "selected"; ?>>25</option>
			<option <?php if ($nb_elements_per_page == 50) echo "selected"; ?>>50</option>
			<option <?php if ($nb_elements_per_page == 100) echo "selected"; ?>>100</option>
			<option <?php if ($nb_elements_per_page == 500) echo "selected"; ?>>500</option>
		</select>
	</div>
</div>

<script type='text/javascript'>
	$(document).ready(function(){
		$(".paging-filter").click(function(){
			var nb = $(this).attr('data-filter');
			$('#formcurrentpage').val(nb);
			$('#formfilter').submit();
		});
	});
	$(document).ready(function(){
		$(".paging-filter-next").click(function(){
			var nb = parseInt($('#formcurrentpage').val());
			if (nb< <?php echo $nb_pages; ?>) {
				$('#formcurrentpage').val(nb+1);
				$('#formfilter').submit();
			}
		});
	});
	$(document).ready(function(){
		$(".paging-filter-prev").click(function(){
			var nb = parseInt($('#formcurrentpage').val());
			if (nb>1) {
				$('#formcurrentpage').val(nb-1);
				$('#formfilter').submit();
			}
		});
	});

	$(document).ready(function(){
		$(".nbelements-filter").click(function(){
			var value = $(this).val();
			$('#formnbelementsperpage').val(value);
			$('#formfilter').submit();
		});
	});
</script>
