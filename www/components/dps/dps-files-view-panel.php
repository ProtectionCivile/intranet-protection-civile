<?php
$pathyear = "20".$cu_year;
$pathquery = "SELECT shortname, number FROM $tablename_sections WHERE number=$section";
$pathcommune_result = mysqli_query($db_link, $pathquery);
$pathcommune_array = mysqli_fetch_array($pathcommune_result);
$pathantenne = $pathcommune_array["shortname"];

$pathfile = "documents_dps/".$pathyear."/".$pathantenne."/".$cu_yearly_index."/";
?>


<div class="panel panel-info">
  <div class="panel-heading">
    <button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#files-panel-filter" aria-expanded='true' aria-controls="files-panel-filter">
      <span aria-hidden="true" >Montrer/Cacher</span>
    </button>
    <h3 class="panel-title">Fichiers attachés</h3>
  </div>

  <div id='files-panel-filter' aria-expanded='true' class="panel-body in">

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
