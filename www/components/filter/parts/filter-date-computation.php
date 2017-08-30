<?php
	if(isset($_SESSION['datebegin']) && !empty($_SESSION['datebegin']) ){
		$datebeginNF=new DateTime($_SESSION['datebegin']);
	}
	else {
		$datebeginNF = new DateTime("now -4 year");
		$_SESSION['datebegin'] = $datebeginNF->format('d-m-Y');
	}

	if(isset($_SESSION['dateend']) && !empty($_SESSION['dateend']) ){
		$dateendNF=new DateTime($_SESSION['dateend']);
	}
	else {
		$dateendNF = new DateTime("now +3 month");
		$_SESSION['dateend'] = $dateendNF->format('d-m-Y');
	}

	if( $dateendNF < $datebeginNF ){
		$previous = $_SESSION['dateend'];
    	$dateendNF = (new DateTime($_SESSION['datebegin']." +3 month"));
    	$_SESSION['dateend'] = $dateendNF->format('d-m-Y');
    	?>
    	<div class='alert alert-danger' role='alert'>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
 			<span class="sr-only">Error:</span>
 			Merci de saisir une date de fin qui ne se trouve pas avant la date de début ! Vous avez saisi comme date de fin <?php echo $previous; ?> ce qui est avant la date de début saisie <?php echo $_SESSION['datebegin']; ?>. La date de fin donc a été repositionnée à <?php echo $_SESSION['dateend']; ?>
		</div>
    	<?php
    }
?>
