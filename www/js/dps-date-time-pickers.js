$(function () {
	$('#event_begin_date_picker').datetimepicker({
		locale: 'fr',
		useCurrent: false,
		format: 'DD-MM-YYYY',
		showClear:true,
		showClose:true,
		toolbarPlacement: 'bottom'
	})
	$('#event_begin_time_picker').datetimepicker({
		locale: 'fr',
		format: 'HH:mm',
		showClear:true,
		showClose:true,
		toolbarPlacement: 'bottom',
		useCurrent:false,
		stepping:'15'
	});

	$('#event_end_date_picker').datetimepicker({
		locale: 'fr',
		useCurrent: false,
		format: 'DD-MM-YYYY',
		showClear:true,
		showClose:true,
		toolbarPlacement: 'bottom'
	});
	$('#event_end_time_picker').datetimepicker({
		locale: 'fr',
		format: 'HH:mm',
		showClear:true,
		showClose:true,
		toolbarPlacement: 'bottom',
		useCurrent:false,
		stepping:'15'
	});


	$('#dps_begin_date_picker').datetimepicker({
		locale: 'fr',
		useCurrent: false,
		format: 'DD-MM-YYYY',
		showClear:true,
		showClose:true,
		toolbarPlacement: 'bottom'
	});
	$('#dps_begin_time_picker').datetimepicker({
		locale: 'fr',
		format: 'HH:mm',
		showClear:true,
		showClose:true,
		toolbarPlacement: 'bottom',
		useCurrent:false,
		stepping:'15'
	});

	$('#dps_end_date_picker').datetimepicker({
		locale: 'fr',
		useCurrent: false,
		format: 'DD-MM-YYYY',
		showClear:true,
		showClose:true,
		toolbarPlacement: 'bottom'
	});
	$('#dps_end_time_picker').datetimepicker({
		locale: 'fr',
		format: 'HH:mm',
		showClear:true,
		showClose:true,
		toolbarPlacement: 'bottom',
		useCurrent:false,
		stepping:'15'
	});



	$('#event_begin_date_picker').on("dp.change", function(ev) {
		$('#event_end_date_picker').data("DateTimePicker").minDate(ev.date);
		$('#dps_begin_date_picker').data("DateTimePicker").minDate(ev.date);
		$('#dps_end_date_picker').data("DateTimePicker").minDate(ev.date);
		$('#dps_begin_date_picker').data("DateTimePicker").date(ev.date);
	})

	$('#event_end_date_picker').on("dp.change", function(ev) {
		$('#event_begin_date_picker').data("DateTimePicker").maxDate(ev.date);
		$('#dps_begin_date_picker').data("DateTimePicker").maxDate(ev.date);
		$('#dps_end_date_picker').data("DateTimePicker").maxDate(ev.date);
		$('#dps_end_date_picker').data("DateTimePicker").date(ev.date);
	})

	$('#event_begin_time_picker').on("dp.change", function(ev) {
		var evdate = ev.date;
		// Delta 15mn x 60s/mn x 1000ms/s
		var deltams = 15*60*1000;
		var dpsdate = evdate - deltams;
		$('#dps_begin_time_picker').data("DateTimePicker").maxDate(evdate);
		$('#dps_begin_time_picker').data("DateTimePicker").date(new Date(dpsdate));
	})

	$('#event_end_time_picker').on("dp.change", function(ev) {
		var evdate = ev.date;
		// Delta 15mn x 60s/mn x 1000ms/s
		var deltams = 15*60*1000;
		var dpsdate = evdate + deltams;
		$('#dps_end_time_picker').data("DateTimePicker").minDate(evdate);
		$('#dps_end_time_picker').data("DateTimePicker").date(new Date(dpsdate));
	})


});
