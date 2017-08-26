<?php require('functions/dps/dps-find-documents.php'); //Reload forcé?>

<div class="panel panel-info">
  <div class="panel-heading">
    <button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#files-panel-filter" aria-expanded='true' aria-controls="files-panel-filter">
      <span aria-hidden="true" >Montrer/Cacher</span>
    </button>
    <h3 class="panel-title">Fichiers attachés</h3>
  </div>

	  <div id='files-panel-filter' aria-expanded='true' class="panel-body in">
			<div class='container'>

	    <div class="row" >
	      <?php
				$pdf = glob($pathfile.'*.{pdf}', GLOB_BRACE);
				foreach($pdf as $otherfiles){
					echo "<p><a href='$otherfiles' target='_blank'><span class='glyphicon glyphicon-file'></span> ".basename($otherfiles)."</a></p>";
				}

				$pdf = glob($pathfile.'autre/*.{pdf}', GLOB_BRACE);
	      foreach($pdf as $otherfiles){
	        echo "<p><a href='$otherfiles' target='_blank'><span class='glyphicon glyphicon-file'></span> ".basename($otherfiles)."</a></p>";
				}
	      ?>
	    </div>

	  </div>
	</div>
</div>
