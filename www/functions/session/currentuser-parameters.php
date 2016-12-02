<?php 
	$selectMyUserQuery = 'SELECT first_name, last_name, attached_section FROM users WHERE ID='.$_SESSION["ID"];
	$selectMyUserQueryExecution = mysqli_query($link, $selectMyUserQuery);
	$myUserAsQueryResult = mysqli_fetch_assoc($selectMyUserQueryExecution);
	$currentUserID=$_SESSION["ID"];
	$currentUserFirstName=$myUserAsQueryResult['first_name'];
	$currentUserLastName=$myUserAsQueryResult['last_name'];
	$currentUserSection=$myUserAsQueryResult['attached_section'];
?>