$('.upload-all').click(function(){
	//submit all form
	$('form').submit();
});

$('.cancel-all').click(function(){
	//submit all form
	$('form .cancel').click();
});

$(document).on('submit','.upload1',function(e){
	e.preventDefault();
	$form = $(this);
	uploadImage($form);

});

$(document).on('submit','.upload2',function(e){
	e.preventDefault();
	$form = $(this);
	uploadImage($form);
});
$(document).on('submit','.upload3',function(e){
	e.preventDefault();
	$form = $(this);
	uploadImage($form);
});
$(document).on('submit','.upload4',function(e){
	e.preventDefault();
	$form = $(this);
	uploadImage($form);
});

function uploadImage($form){
	$form.find('.progress-bar').removeClass('progress-bar-success')
								.removeClass('progress-bar-danger');

	var formdata = new FormData($form[0]); //formelement
	var request = new XMLHttpRequest();

	//progress event...
	request.upload.addEventListener('progress',function(e){
		var percent = Math.round(e.loaded/e.total * 100);
		$form.find('.progress-bar').width(percent+'%').html(percent+'%');
	});

	//progress completed load event
	request.addEventListener('load',function(e){
		$form.find('.progress-bar').addClass('progress-bar-success').html('Veuillez patienter...');
		//$form.find('.progress').removeClass('progress-striped');
		
		
		
	});

	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
			$form.find('.progress').removeClass('progress-striped');
			$form.find('.progress-bar').html('Transfert Terminé !');
			window.setTimeout(function(){location.reload()},2000);
			
		}
	}
	request.open('POST', 'functions/dps-documents-upload.php', true);
	request.send(formdata);
	
	
	

	$form.on('click','.cancel',function(){
		request.abort();

		$form.find('.progress-bar')
			.addClass('progress-bar-danger')
			.removeClass('progress-bar-success')
			.html('upload aborted...');
	});

}