var i=0;
var p=0;
var valuep11=0;
var valuep12=0;
var p2 = "0,25";
var e1 = "0,25";
var e2 = "0,25";

function displayVals() {
	p2 = $("#ris_p2").val();
	e1 = $( "#ris_e1" ).val();
	e2 = $( "#ris_e2" ).val();
	if (e1 == "1"){e1 = "25";}else if(e1 == "2"){e1 = "30";}else if(e1 == "3"){e1 = "35";}else{e1 = "40";}
	if (e2 == "1"){e2 = "25";}else if(e2 == "2"){e2 = "30";}else if(e2 == "3"){e2 = "35";}else{e2 = "40";}
	if (p2 == "1"){p2 = "25";}else if(p2 == "2"){p2 = "30";}else if(p2 == "3"){p2 = "35";}else{p2 = "40";}
	if(e1 && e2 && p2 != "0"){
		i = parseInt(p2,10) + parseInt(e1,10) + parseInt(e2,10);
		i = i/100;
		// console.log("i = "+ i );
	}
}

$( ".risi" ).change( displayVals );

displayVals();


var p1=0;
$( "#ris_p1_public" )
.keyup(function() {
	valuep11 = $( this ).val();
	// console.log( "p11=" + valuep11 );
})
.keyup();
$( "#ris_p1_actors" )
.keyup(function() {
	valuep12 = $( this ).val();
	// console.log( "p12="+valuep12 );
})
.keyup();

$( ".risp")
.keyup(function() {
	p=0;
	if (valuep11 && valuep12) {
		p1 = parseInt(valuep11, 10) + parseInt(valuep12, 10);
		$( "#p1" ).text( "P1 = "+p1 );
		if(p1 <= 100000){
			p = parseInt(p1, 10);
		}
		else{
			p = parseInt(100000 +(parseInt(p1, 10) - 100000)/2, 10);
			p = parseInt(Math.ceil(p)), 10;
		}
	}
	else {
		p1=0;
		p=0;
	}
	// console.log( "P = "+p );
})
.keyup();

$( ".risp" )
.keyup(function() {
	calculris();
})
.keyup();
$( ".risi" ).change(function() {
	calculris();
});
$( ".risp" ).change(function() {
	calculris();
});

function calculris(){
	var ristotal;
	var ris;
	var typedeposte;
	ris = 0;
	ristotal = 0;
	if(p != 0){
		ristotal = i*(p/1000);
	}
	if(ristotal == 0 ){
		ris = 0;
		$('#resultatris').addClass('hidden');
	}
	else if(ristotal > 0 && ristotal <= 0.25){
		ris = 0;
		typedeposte = "cf. autorité compétente";
		$('#resultatris').addClass('alert-info');
		$('#resultatris').removeClass('alert-warning');
		$('#grosris').addClass('hidden');
		$('#resultatris').removeClass('hidden');
		$('#dps_type').val('0');
	}
	else if(ristotal > 0.25 && ristotal <= 1.125){
		ris = 2;
		typedeposte = "PAPS";
		$('#resultatris').addClass('alert-info');
		$('#resultatris').removeClass('alert-warning');
		$('#grosris').addClass('hidden');
		$('#resultatris').removeClass('hidden');
		$('#dps_type').val('0');
	}
	else if(ristotal > 1,125 && ristotal <= 4){
		ris = 4;
		typedeposte = "DPS-PE";
		$('#resultatris').addClass('alert-info');
		$('#resultatris').removeClass('alert-warning');
		$('#grosris').addClass('hidden');
		$('#resultatris').removeClass('hidden');
		$('#dps_type').val('1');
	}
	else if(ristotal > 4 && ristotal <= 12){
		ris = Math.ceil(ristotal);
		if(ris&1){
			ris = ris +1;
		}
		typedeposte = "DPS-PE";
		$('#resultatris').addClass('alert-info');
		$('#resultatris').removeClass('alert-warning');
		$('#grosris').addClass('hidden');
		$('#resultatris').removeClass('hidden');
		$('#dps_type').val('1');
	}
	else if(ristotal > 12 && ristotal <= 36){
		ris = Math.ceil(ristotal);
		if(ris&1){
			ris = ris +1;
		}
		typedeposte = "DPS-ME";
		$('#resultatris').addClass('alert-warning');
		$('#grosris').removeClass('hidden');
		$('#resultatris').removeClass('hidden');
		$('#dps_type').val('2');
	}
	else {
		ris = Math.ceil(ristotal);
		if(ris&1){
			ris = ris +1;
		}
		typedeposte = "DPS-GE";
		$('#resultatris').addClass('alert-warning');
		$('#grosris').removeClass('hidden');
		$('#resultatris').removeClass('hidden');
		$('#dps_type').val('3');
	}
		//console.log( "RIS = "+ristotal );

	$( "#nbsec" ).text(ris);
	$( "#typeposte" ).text(typedeposte);
}
