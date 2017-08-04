<?php
$pathyear = "20".$cu_year;
$pathquery = "SELECT shortname, number FROM $tablename_sections WHERE number=$city";
$pathcommune_result = mysqli_query($db_link, $pathquery);
$pathcommune_array = mysqli_fetch_array($pathcommune_result);
$pathantenne = $pathcommune_array["shortname"];

$pathfile = "documents_dps/".$pathyear."/".$pathantenne."/".$cu_yearly_index."/";
$pathfileconvention = $pathfile.$cu_full."-CONV.pdf";
$pathfilerisk = $pathfile."/".$cu_full."-RISK.pdf";
$pathfiledemande = $pathfile."/".$cu_full."-DEM.pdf";
if(file_exists($pathfileconvention)){$fileconvention = true;}else{$fileconvention = false;}
if(file_exists($pathfilerisk)){$filerisk = true;}else{$filerisk = false;}
if(file_exists($pathfiledemande)){$filedemande = true;}else{$filedemande = false;}
?>

<script src="js/fileinput.min.js" type="text/javascript"></script>
<script src="js/fileinput_locale_fr.js" type="text/javascript"></script>
<script src="js/bootstrap.file-input.js" type="text/javascript"></script>

<div class="panel panel-info">
  <div class="panel-heading">
    <button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#files-panel-filter" aria-expanded='true' aria-controls="files-panel-filter">
      <span aria-hidden="true" >Montrer/Cacher</span>
    </button>
    <h3 class="panel-title">Fichiers attachés</h3>
  </div>

  <div id='files-panel-filter' aria-expanded='true' class="panel-body in">

    <div>
      <div class="row" id="rowconvention" <?php if($fileconvention == true){echo "hidden";} ?> >
        <form action='#' class='upload1'>
          <input type='hidden' name='type' value='convention' />
          <input type='hidden' name='unique_certificate_full' value='<?php echo $cu_full; ?>' />
          <input type='hidden' name='year' value='20<?php echo $cu_year; ?>' />
          <input type='hidden' name='section' value='<?php echo $pathantenne; ?>' />
          <input type='hidden' name='yearly_index' value='<?php echo $cu_yearly_index; ?>' />
          <div class="form-group form-group-sm">
            <div class="col-sm-5">
              <input id="file_convention" name='mainfile' type='file' data-filename-placement="inside" data-show-upload='true' data-show-caption='true' data-allowed-file-extensions='["pdf"]' accept='application/pdf' title='Ajouter la convention <span class="glyphicon glyphicon-folder-open"></span>' />
            </div>
            <div class="col-sm-4">
              <button class="btn btn-sm btn-info upload" id="submit_convention" type="submit">Envoyer <span class="glyphicon glyphicon-upload"></span></button>
              <button type="button" class="btn btn-sm btn-danger cancel">Annuler <span class="glyphicon glyphicon-trash"></span></button>
            </div>
            <div class="col-sm-3">
              <div class="progress progress-striped active">
                <div class="progress-bar" style="width:0%"></div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <?php if($fileconvention == true) { ?>
        <div class="row" id="changeconvention">
          <div class="form-group form-groupe-sm">
            <div class="col-sm-5">
            <a href="<?php echo $pathfileconvention; ?>" class="btn btn-success" target="_blank">Télécharger la convention <span class="glyphicon glyphicon-download-alt"></span></a>
            </div>
            <div class="col-sm-7">
            <button id="changeconv" type="button" class="btn btn-danger">Envoyer une nouvelle convention <span class="glyphicon glyphicon-trash"></span></button>
            </div>
          </div>
        </div>
				<br />
        <?php
      }
      ?>
    </div>

    <div>
      <div class="row" id="rowrisque" <?php if($filerisk == true){echo "hidden";} ?> >
        <form action='#' class='upload2'>
          <input type='hidden' name='type' value='risk' />
          <input type='hidden' name='unique_certificate_full' value='<?php echo $cu_full; ?>' />
          <input type='hidden' name='year' value='20<?php echo $cu_year; ?>' />
          <input type='hidden' name='section' value='<?php echo $pathantenne; ?>' />
          <input type='hidden' name='yearly_index' value='<?php echo $cu_yearly_index; ?>' />
          <div class="form-group form-group-sm">
            <div class="col-sm-5">
              <input id="file_risk" name='mainfile' type='file' data-filename-placement="inside" data-show-upload='true' data-show-caption='true' data-allowed-file-extensions='["pdf"]' accept='application/pdf' title='Ajouter la grille de risques <span class="glyphicon glyphicon-folder-open"></span>' />
            </div>
            <div class="col-sm-4">
              <button class="btn btn-sm btn-info upload" id="submit_risk" type="submit">Envoyer <span class="glyphicon glyphicon-upload"></span></button>
              <button type="button" class="btn btn-sm btn-danger cancel">Annuler <span class="glyphicon glyphicon-trash"></span></button>
            </div>
            <div class="col-sm-3">
              <div class="progress progress-striped active">
                <div class="progress-bar" style="width:0%"></div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <?php if($filerisk == true) { ?>
        <div class="row" id="changerisque">
          <div class="form-group form-groupe-sm">
            <div class="col-sm-5">
            <a href="<?php echo $pathfilerisk ;?>" class="btn btn-success" target="_blank">Télécharger la grille d'analyse des risques <span class="glyphicon glyphicon-download-alt"></span></a>
            </div>
            <div class="col-sm-7">
            <button id="changerisk" type="button" class="btn btn-danger">Envoyer une nouvelle grille <span class="glyphicon glyphicon-trash"></span></button>
            </div>
          </div>
        </div>
				<br />
        <?php
      }
      ?>
    </div>

    <div>
      <div class="row" id="rowdemande" <?php if($filedemande == true){echo "hidden";} ?> >
        <form action='#' class='upload3'>
          <input type='hidden' name='type' value='demande' />
          <input type='hidden' name='unique_certificate_full' value='<?php echo $cu_full; ?>' />
          <input type='hidden' name='year' value='20<?php echo $cu_year; ?>' />
          <input type='hidden' name='section' value='<?php echo $pathantenne; ?>' />
          <input type='hidden' name='yearly_index' value='<?php echo $cu_yearly_index; ?>' />
          <div class="form-group form-group-sm">
            <div class="col-sm-5">
              <input id="file_demande" name='mainfile' type='file' data-filename-placement="inside" data-show-upload='true' data-show-caption='true' data-allowed-file-extensions='["pdf"]' accept='application/pdf' title='Ajouter la demande de poste <span class="glyphicon glyphicon-folder-open"></span>' />
            </div>
            <div class="col-sm-4">
              <button class="btn btn-sm btn-info upload" id="submit_demande" type="submit">Envoyer <span class="glyphicon glyphicon-upload"></span></button>
              <button type="button" class="btn btn-sm btn-danger cancel">Annuler <span class="glyphicon glyphicon-trash"></span></button>
            </div>
            <div class="col-sm-3">
              <div class="progress progress-striped active">
                <div class="progress-bar" style="width:0%"></div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <?php if($filedemande == true) { ?>
        <div class="row" id="changedemande">
          <div class="form-group form-groupe-sm">
            <div class="col-sm-5">
            <a href="<?php echo $pathfiledemande?>" class="btn btn-success" target="_blank">Télécharger la demande de l'organisateur <span class="glyphicon glyphicon-download-alt"></span></a>
            </div>
            <div class="col-sm-7">
            <button id="changedem" type="button" class="btn btn-danger">Envoyer une nouvelle demande <span class="glyphicon glyphicon-trash"></span></button>
            </div>
          </div>
        </div>
				<br />
        <?php
      }
      ?>
    </div>

    <div>
      <div class="row" >
        <form action='#' class='upload4'>
          <input type='hidden' name='type' value='other' />
          <input type='hidden' name='unique_certificate_full' value='<?php echo $cu_full; ?>' />
          <input type='hidden' name='year' value='20<?php echo $cu_year; ?>' />
          <input type='hidden' name='section' value='<?php echo $pathantenne; ?>' />
          <input type='hidden' name='yearly_index' value='<?php echo $cu_yearly_index; ?>' />
          <div class="form-group form-group-sm">
            <div class="col-sm-5">
              <input id="file_other" name='mainfile' type='file' data-filename-placement="inside" data-show-upload='true' data-show-caption='true' data-allowed-file-extensions='["pdf"]' accept='application/pdf' title='Ajouter un autre document <span class="glyphicon glyphicon-folder-open"></span>' />
            </div>
            <div class="col-sm-4">
              <button class="btn btn-sm btn-info upload" id="submit_other" type="submit">Envoyer <span class="glyphicon glyphicon-upload"></span></button>
              <button type="button" class="btn btn-sm btn-danger cancel">Annuler <span class="glyphicon glyphicon-trash"></span></button>
            </div>
            <div class="col-sm-3">
              <div class="progress progress-striped active">
                <div class="progress-bar" style="width:0%"></div>
              </div>
            </div>
          </div>
        </form>
      </div>


      <div class="row" >
        <?php
        $pdf = glob($pathfile.'autre/*.{pdf}', GLOB_BRACE);
        foreach($pdf as $otherfiles){
        echo "<p><a href='$otherfiles' target='_blank'><span class='glyphicon glyphicon-file'></span> ".basename($otherfiles)."</a></p>";}
        ?>
      </div>
    </div>

  </div>




  <script>
    $('input[type=file]').bootstrapFileInput();
    $('.file-inputs').bootstrapFileInput();
  </script>

  <script type="text/javascript">
  	jQuery.fx.off = true
  	$("#changeconv").click(function() {
  	$("#rowconvention").removeAttr('hidden')
  	$("#changeconvention").toggle("hidden")});
  	$("#changerisk").click(function() {
  	$("#rowrisque").removeAttr('hidden')
  	$("#changerisque").toggle("hidden")});
  	$("#changedem").click(function() {
  	$("#rowdemande").removeAttr('hidden')
  	$("#changedemande").toggle("hidden")});
  </script>

  <script src='js/dps-doc-upload.js' type='text/javascript'></script>
</div>
