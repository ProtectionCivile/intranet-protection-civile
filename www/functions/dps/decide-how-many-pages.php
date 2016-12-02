<?php
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
?>