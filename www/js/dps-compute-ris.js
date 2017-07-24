var i;
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
		//console.log("i = "+ i );
	}
}

$( ".risi" ).change( displayVals );

displayVals();

var valuep11;
var valuep12;
var p1;
p1 =0;
var p;
$( "#ris_p1_public" )
.keyup(function() {
	valuep11 = $( this ).val();
	//console.log( valuep11 );
})
.keyup();
$( "#ris_p1_actors" )
.keyup(function() {
	valuep12 = $( this ).val();
	//console.log( valuep12 );
})
.keyup();

$( ".risp")
.keyup(function() {
	p1 = parseInt(valuep11, 10) + parseInt(valuep12, 10);
	$( "#p1" ).text( "P1 = "+p1 );
	if(p1 <= 100000){
		p = p1;
	}
	else{
		p = 100000 +(parseInt(p1) - 100000)/2;
		p = Math.ceil(p);
	}
	//console.log( "P = "+p );
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
	ris = 0;
	ristotal = 0;
	if(p != 0){
		ristotal = i*(p/1000);
	}
	if(ristotal != 0 && (ristotal*1000) <= 1125){
		ris = 2;
	}
	else if((ristotal*1000) > 1,125 && ristotal <= 4){
		ris = 4;
	}
	else if(ristotal > 4){
		ris = Math.ceil(ristotal);
		if(ris&1){
			ris = ris +1;
		}
	}
		//console.log( "RIS = "+ristotal );
	var typedeposte;
	$( "#nbsec" ).text(ris );

	if(ris == 0){
			$('#resultatris').addClass('hidden');
	}else if(ris != 0 && ris <=2){
		typedeposte = "PAPS";
		$('#resultatris').addClass('alert-info');
		$('#resultatris').removeClass('alert-warning');
		$('#grosris').addClass('hidden');
		$('#resultatris').removeClass('hidden');
	}else if(ris >=4 && ris <=12){
		typedeposte = "DPS-PE";
		$('#resultatris').addClass('alert-info');
		$('#resultatris').removeClass('alert-warning');
		$('#grosris').addClass('hidden');
		$('#resultatris').removeClass('hidden');
	}else if(ris > 12 && ris <=36){
		typedeposte = "DPS-ME";
		$('#resultatris').addClass('alert-warning');
		$('#grosris').removeClass('hidden');
		$('#resultatris').removeClass('hidden');
	}else if(ris >36){
		typedeposte = "DPS-GE";
		$('#resultatris').addClass('alert-warning');
		$('#grosris').removeClass('hidden');
		$('#resultatris').removeClass('hidden');
	}
	$( "#typeposte" ).text(typedeposte);
}
