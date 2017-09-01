<?php
	$sqlQuery = "SELECT * FROM $tablename_roles ";


	if (!empty($_SESSION['filtered_section']) || $_SESSION['filtered_section'] == "0") {
		$addWhereClause = true;
		$whereCity = "Affiliation='".$_SESSION['filtered_section']."'";
	}

	if (!empty($_SESSION['tags'])) {
		$addWhereClause = true;
		$whereTags = '';
		$count=0;
		$tags_exploded = explode('|', $_SESSION['tags']);
		foreach ($tags_exploded as $tag) {
			if (!empty($tag)) {
				$count++;
				if ($count > 1) {
					$whereTags = $whereTags."OR ";
				}
				$whereTags = $whereTags."Tags LIKE'%".$tag."%' ";
			}
		}
	}


	$sqlQuery = $sqlQuery." WHERE ";
	$sqlQuery = $sqlQuery." Directory = '1' ";
	if ($addWhereClause) {
		if (!empty($whereCity)) {
			$sqlQuery = $sqlQuery." AND ".$whereCity;
		}
		if (!empty($whereTags)) {
			$sqlQuery = $sqlQuery." AND (".$whereTags.")";
		}
	}


	$sqlQuery = $sqlQuery." ORDER by Hierarchy ASC ";
?>
