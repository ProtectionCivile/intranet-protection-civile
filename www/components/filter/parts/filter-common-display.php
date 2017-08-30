
<?php
// Each time I submit this form, store parameters in session
if (isset($_POST['hasSubmittedFilterParameters'])) {
	$_SESSION['nb_elements_per_page'] = $_POST['formnbelementsperpage'];
	$_SESSION['current_page'] = $_POST['formcurrentpage'];
	$_SESSION['datebegin'] = $_POST['formdatebegin'];
	echo "enregistrement de ".$_SESSION['datebegin'];
	$_SESSION['dateend'] = $_POST['formdateend'];
	// $_SESSION['nb_elements_per_page'] = $_POST['formnbelementsperpage'];
	// $_SESSION['nb_elements_per_page'] = $_POST['formnbelementsperpage'];
}
?>


<form role='form' id='formfilter' action='<?php echo $base_url; ?>' method='post'>
	<input type='hidden' name='hasSubmittedFilterParameters' id='hasSubmittedFilterParameters' value='1'>
	<input type='hidden' name='formfilteredsection' id='formfilteredsection' value='<?php echo $filtered_section; ?>'>
	<input type='hidden' name='formstatus' id='formstatus' value='<?php echo $status; ?>'>
	<input type='hidden' name='formdatebegin' id='formdatebegin' value='<?php echo $_SESSION['datebegin']; ?>'>
	<input type='hidden' name='formdateend' id='formdateend' value='<?php echo $_SESSION['dateend']; ?>'>
	<input type='hidden' name='formcurrentpage' id='formcurrentpage' value='<?php echo $_SESSION['current_page']; ?>'>
	<input type='hidden' name='formnbelementsperpage' id='formnbelementsperpage' value='<?php echo $_SESSION['nb_elements_per_page']; ?>'>
</form>
