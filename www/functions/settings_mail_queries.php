<?php

function verif_settings_mail($link, $name)
{
	$verif_query = "SELECT * FROM settings_mail WHERE name='$name'"; 
	$verif = mysqli_query($link, $verif_query);

	if(!$verif){
		trigger_error("Erreur lors de la consultation" . mysqli_error($link));
	}

	if(mysqli_num_rows($verif) > 0){
		return true;
	}	
	return false;
}

function insert_settings_mail($link, $name, $value)
{
	$query = mysqli_prepare($link, "INSERT INTO settings_mail (name, value) VALUES (?, ?)");
	mysqli_stmt_bind_param($query, "ss", $name, $value);
	if(!mysqli_stmt_execute($query)){
		trigger_error("Impossible d'ajouter le parametre dans la base de donn&eacute;e" . mysqli_error($link));
	}

	return true;
}


function update_settings_mail($link, $id, $name, $value)
{
	$query = mysqli_prepare($link, "UPDATE settings_mail SET name=?, value=? WHERE id=?");
	mysqli_stmt_bind_param($query, "ssi", $name, $value, $id);
	if(!mysqli_stmt_execute($query)){
		trigger_error("Impossible de mettre a jour le parametre dans la base de donn&eacute;e" . mysqli_error($link));
	}

	return true;
}


function delete_settings_mail($link, $id)
{
	$query = mysqli_prepare($link, "DELETE FROM settings_mail WHERE id=?");
	mysqli_stmt_bind_param($query, "i", $id);
	if(!mysqli_stmt_execute($query)){
		trigger_error("Impossible de supprimer le parametre dans la base de donn&eacute;e" . mysqli_error($link));
	}

	return true;
}

function count_settings_mail($link)
{
	$query = "SELECT name FROM settings_mail"; 
	$queryStmt = mysqli_query($link, $query);
	if(!$queryStmt){
		trigger_error("Erreur lors de la consultation" . mysqli_error($link));
	}
	return mysqli_num_rows($queryStmt);
}

function select_settings_mail($link, $page=1, $perPage = 10)
{
	$limit = $page-1;
	$query = mysqli_prepare($link, "SELECT * FROM settings_mail ORDER BY name LIMIT ?,?");
	mysqli_stmt_bind_param($query, "ii", $limit, $perPage);		
	if(!mysqli_stmt_execute($query)){
		trigger_error("Erreur lors de la consultation" . mysqli_error($link));
	}
	return mysqli_fetch_all(mysqli_stmt_get_result($query), MYSQLI_ASSOC);
}

function load_setting_mail($link, $id)
{
	$query = mysqli_prepare($link, "SELECT * FROM settings_mail WHERE ID=?");
	mysqli_stmt_bind_param($query, "i", $id);
	if(!mysqli_stmt_execute($query)){
		trigger_error("Erreur lors de la consultation" . mysqli_error($link));
	}

	return mysqli_fetch_array(mysqli_stmt_get_result($query), MYSQLI_ASSOC);
}

