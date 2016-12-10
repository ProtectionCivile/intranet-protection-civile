<?php
	function compute_server_feedback($errorMessage){
		if($errorMessage != "") {
			$fbMsg=$errorMessage;
			$fbStatus="has-error";
			$fbGlyph="glyphicon-remove";
		}
		else {
			$fbMsg="";
			$fbStatus="";
			$fbGlyph="";
		}
		return array($fbStatus, $fbGlyph, $fbMsg);
	}
?>