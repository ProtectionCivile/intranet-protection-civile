<?php
	if(isset($_POST['formdatebegin']) && !empty($_POST['formdatebegin']) ){
		$datebegin=$_POST['formdatebegin'];
		$datebeginNF=new DateTime($datebegin);
	}
	else {
		$datebeginNF = new DateTime("now -4 year");
		$datebegin = $datebeginNF->format('d-m-Y');
	}

	if(isset($_POST['formdateend']) && !empty($_POST['formdateend']) ){
		$dateend = $_POST['formdateend'];
		$dateendNF=new DateTime($dateend);
	}
	else {
		$dateendNF = new DateTime("now +3 month");
		$dateend = $dateendNF->format('d-m-Y');
	}

	if( $dateendNF < $datebeginNF ){
		$previous = $dateend;
    	$dateendNF = (new DateTime($datebegin." +3 month"));
    	$dateend = $dateendNF->format('d-m-Y');
    	?>
    	<div class='alert alert-danger' role='alert'>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
 			<span class="sr-only">Error:</span>
 			Merci de saisir une date de fin qui ne se trouve pas avant la date de début ! Vous avez saisi comme date de fin <?php echo $previous; ?> ce qui est avant la date de début saisie <?php echo $datebegin; ?>. La date de fin donc a été repositionnée à <?php echo $dateend; ?>
		</div>
    	<?php
    }
?>
