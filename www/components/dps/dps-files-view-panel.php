<?php require_once('functions/dps/dps-find-documents.php'); ?>


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
				$files = glob($pathfile.'/*.{pdf}', GLOB_BRACE);
				foreach($files as $pdf_file){
					echo "<p><a href='$pdf_file' target='_blank'><span class='glyphicon glyphicon-file'></span> ".basename($pdf_file)."</a></p>";
				}

				$files = glob($pathfile.'/autre/*.{pdf}', GLOB_BRACE);
	      foreach($files as $pdf_file){
	        echo "<p><a href='$pdf_file' target='_blank'><span class='glyphicon glyphicon-file'></span> ".basename($pdf_file)."</a></p>";
				}
	      ?>
	    </div>

	  </div>
	</div>
</div>
