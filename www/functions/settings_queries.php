<?php

function load_setting($db_link, $id)
{
	echo "JE CHARGE UN PARAM";
	$query = mysqli_prepare($db_link, "SELECT * FROM ".$tablename_settings_general." WHERE ID=?");
	mysqli_stmt_bind_param($query, "i", $id);
	if(!mysqli_stmt_execute($query)){
		trigger_error("Erreur lors de la consultation" . mysqli_error($db_link));
	}

	return mysqli_fetch_array(mysqli_stmt_get_result($query), MYSQLI_ASSOC);
}

