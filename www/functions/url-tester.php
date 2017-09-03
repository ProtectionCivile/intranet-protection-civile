<?php require_once('functions/SettingService.php'); ?>

<?php

function url_exists($url_p) {
	$file_headers = @get_headers($url_p);
	if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
		return false;
	}
	return true;
}
?>
