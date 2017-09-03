<?php require_once('functions/SettingService.php'); ?>
<?php require_once('functions/url-tester.php'); ?>

<?php

function getUserPicturePath($setting_service_p, $userID_p) {
	$eprotec_userpicture_base_url = $setting_service_p->getGeneralSetting('eprotec-user-picture-url');
	$eprotec_default_userpicture_base_url = $setting_service_p->getGeneralSetting('eprotec-default-user-picture-url');
	if (!empty($eprotec_userpicture_base_url) && !empty($eprotec_default_userpicture_base_url)) {
		$eprotec_userpicture_full_url = ($eprotec_userpicture_base_url && (strstr($eprotec_userpicture_base_url, 'MATRICULE')) ) ? str_replace('MATRICULE', $userID_p, $eprotec_userpicture_base_url) : '';

		if (url_exists($eprotec_userpicture_full_url)) { // Si l'image existe dans eProtec
			return $eprotec_userpicture_full_url;
		}
		else {
			return $eprotec_default_userpicture_base_url;
		}
	}
	return 'MISSING PARAMETER IN SETTINGS TABLE';
}
?>
