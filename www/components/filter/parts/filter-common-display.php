<form role='form' id='formfilter' action='<?php echo $base_url; ?>' method='post'>
	<input type='hidden' name='formfilteredsection' id='formfilteredsection' value='<?php echo $filtered_section; ?>'>
	<input type='hidden' name='formstatus' id='formstatus' value='<?php echo $status; ?>'>
	<input type='hidden' name='formdatebegin' id='formdatebegin' value='<?php echo $datebegin; ?>'>
	<input type='hidden' name='formdateend' id='formdateend' value='<?php echo $dateend; ?>'>
	<input type='hidden' name='formcurrentpage' id='formcurrentpage' value='<?php echo $current_page; ?>'>
	<input type='hidden' name='formnbelementsperpage' id='formnbelementsperpage' value='<?php echo $nb_elements_per_page; ?>'>
</form>
