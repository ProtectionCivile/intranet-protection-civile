<?php

function verif_settings($link, $name)
{
	$verif_query = "SELECT * FROM settings WHERE setting_name='$name'"; 
	$verif = mysqli_query($link, $verif_query);

	if(!$verif){
		trigger_error("Erreur lors de la consultation" . mysqli_error($link));
	}

	if(mysqli_num_rows($verif) > 0){
		return true;
	}	
	return false;
}

function insert_settings($link, $name, $value)
{
	$query = mysqli_prepare($link, "INSERT INTO settings (setting_name, setting_value) VALUES (?, ?)");
	mysqli_stmt_bind_param($query, "ss", $name, $value);
	if(!mysqli_stmt_execute($query)){
		trigger_error("Impossible d'ajouter le parametre dans la base de donn&eacute;e" . mysqli_error($link));
	}

	return true;
}


function update_settings($link, $id, $name, $value)
{
	$query = mysqli_prepare($link, "UPDATE settings SET setting_name=?, setting_value=? WHERE id=?");
	mysqli_stmt_bind_param($query, "ssi", $name, $value, $id);
	if(!mysqli_stmt_execute($query)){
		trigger_error("Impossible de mettre a jour le parametre dans la base de donn&eacute;e" . mysqli_error($link));
	}

	return true;
}


function delete_settings($link, $id)
{
	$query = mysqli_prepare($link, "DELETE FROM settings WHERE id=?");
	mysqli_stmt_bind_param($query, "i", $id);
	if(!mysqli_stmt_execute($query)){
		trigger_error("Impossible de supprimer le parametre dans la base de donn&eacute;e" . mysqli_error($link));
	}

	return true;
}

function count_settings($link)
{
	$query = "SELECT setting_name FROM settings"; 
	$queryStmt = mysqli_query($link, $query);
	if(!$queryStmt){
		trigger_error("Erreur lors de la consultation" . mysqli_error($link));
	}
	return mysqli_num_rows($queryStmt);
}

function select_settings($link, $page=1, $perPage = 10)
{
	$limit = $page-1;
	$query = mysqli_prepare($link, "SELECT * FROM settings ORDER BY setting_name LIMIT ?,?");
	mysqli_stmt_bind_param($query, "ii", $limit, $perPage);		
	if(!mysqli_stmt_execute($query)){
		trigger_error("Erreur lors de la consultation" . mysqli_error($link));
	}
	return mysqli_fetch_all(mysqli_stmt_get_result($query), MYSQLI_ASSOC);
}

function load_setting($link, $id)
{
	$query = mysqli_prepare($link, "SELECT * FROM settings WHERE ID=?");
	mysqli_stmt_bind_param($query, "i", $id);
	if(!mysqli_stmt_execute($query)){
		trigger_error("Erreur lors de la consultation" . mysqli_error($link));
	}

	return mysqli_fetch_array(mysqli_stmt_get_result($query), MYSQLI_ASSOC);
}

