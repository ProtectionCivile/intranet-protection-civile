<div class='container'>
	<div class="form-group form-group-sm">
		<div class='col-md-1 col-sm-2 row'>
			<label for='date_debut' >Période</label>
		</div>
		<div class=" col-md-3 col-sm-3">
			<div class='input-group date' id='begin_date_picker' name="begin_date_picker">
				<input type='text' class='form-control form-inline' id='inputdatebegin'  onKeyPress='if (event.keyCode == 13) {save_dates();}' name='inputdatebegin' placeholder="01-01-2015" value='<?php echo $_SESSION['datebegin'];?>' />
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
      <div class="help-block with-errors"></div>
		</div>
		<div class="col-md-3 col-sm-3">
			<div class='input-group date' id='end_date_picker' name="end_date_picker">
				<input type='text' class='form-control form-inline' id='inputdateend' onKeyPress='if (event.keyCode == 13) {save_dates();}' name='inputdateend' placeholder="12-11-2016" value='<?php echo $_SESSION['dateend'];?>' />
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
      <div class="help-block with-errors"></div>
		</div>
		<div class="col-md-3 col-sm-3">
			<button class='btn btn-primary btn-sm date-filter'>Appliquer la période</button>
		</div>
	</div>
</div>


<script src="js/moment-with-locales.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/bootstrap-datetimepicker.min.js" type="text/javascript" charset="utf-8"></script>

<script type='text/javascript'>

	function save_dates() {
		var begin = $('#inputdatebegin').val();
		var end = $('#inputdateend').val();
		$('#formdatebegin').val(begin);
		$('#formdateend').val(end);
		$('#formfilter').submit();
	}

	$(document).ready(function(){

		$(".date-filter").click(function(){
			save_dates();
		});

	});

	$(function () {
		$('#begin_date_picker').datetimepicker({
			locale: 'fr',
			format: 'DD-MM-YYYY',
			showClear:true,
			showClose:true,
			toolbarPlacement: 'bottom',

		});

	});

	$(function () {
		$('#end_date_picker').datetimepicker({
			locale: 'fr',
			format: 'DD-MM-YYYY',
			showClear:true,
			showClose:true,
			toolbarPlacement: 'bottom',
		});
	});

</script>
