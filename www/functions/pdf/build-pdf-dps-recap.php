<?php
require_once('lib/fpdf/fpdf.php');

function buildPdfForDps($select_list_parameter_service_p, $pathfile, $dps_p) {

  $pdf=new FPDF();
  $pdf->AddPage();
  $pdf->AliasNbPages();

  require_once('templates/template-ddo-saynete.php');

  $pdf->SetTextColor(0,64,128);
  $pdf->SetFont('Poppins-SemiBold','',10);

  $dps_type_detailed = $select_list_parameter_service_p->getTranslation('dps_type_detailed', $dps_p['dps_type']);
  $dps_type_short = $select_list_parameter_service_p->getTranslation('dps_type_short', $dps_p['dps_type']);

  $pdf->Text(12,62,utf8_decode("Ouverture d'un ".$dps_type_detailed." (".$dps_type_short.")"));


  // Début des cadres
  // Position du cadre COA : X = 168 --- Y = 41
  $pdf->SetFillColor(256,256,256);
  $pdf->SetFont('Poppins-SemiBold','',10);
  $pdf->SetXY(171,62);
  $pdf->SetDrawColor(0,0,0);
  $pdf->SetTextColor(255,0,0);
  $pdf->Cell(32,5.3,utf8_decode($dps_p['cu_full']),1,1,"C");
  $pdf->SetFont('Arial','',7);
  $pdf->SetTextColor(0,0,0);
  $pdf->Text(171, 61, utf8_decode("Certificat Original d'Affiliation"));

  //Organisateur
  $pdf->SetLineWidth(0.3) ;
  $pdf->SetFont('Poppins-Semibold','',8);
  $pdf->SetTextColor(0,64,128);
  $pdf->SetXY(12,65);
  $pdf->Cell(50,5,utf8_decode("Organisateur"),1,0,"","true");
  $pdf->Rect(12, 70, 191, 20) ;

  $pdf->SetFont('Arial','B',7);
  $pdf->SetTextColor(0,0,0);
  $pdf->Text(14, 73, utf8_decode("Nom :"));
  $pdf->Text(14, 76, utf8_decode("Représenté(e) par :"));
  $pdf->Text(14, 79, utf8_decode("Qualité de :"));
  $pdf->Text(14, 82, utf8_decode("Adresse :"));
  $pdf->Text(14, 85, utf8_decode("Téléphone :"));
  $pdf->Text(63, 85, utf8_decode("Fax :"));
  $pdf->Text(14, 88, utf8_decode("E-mail :"));
  $pdf->SetTextColor(210,120,20);
  $pdf->Text(40, 73, utf8_decode($dps_p['client_name']));
  $pdf->Text(40, 76, utf8_decode($dps_p['client_represent']));
  $pdf->Text(40, 79, utf8_decode($dps_p['client_title']));
  $pdf->Text(40, 82, utf8_decode($dps_p['client_address']));
  $pdf->Text(40, 85, utf8_decode($dps_p['client_phone']));
  $pdf->Text(70, 85, utf8_decode($dps_p['client_fax']));
  $pdf->Text(40, 88, utf8_decode($dps_p['client_email']));

  //Nature manifestation
  $pdf->SetTextColor(0,64,128);
  $pdf->SetFont('Poppins-Semibold','',8);
  $pdf->SetXY(12,92);
  $pdf->Cell(50,5,utf8_decode("Nature de la manifestation"),1,0,"","true");
  $pdf->Rect(12, 97, 191, 17) ;

  $pdf->SetFont('Arial','B',7);
  $pdf->SetTextColor(0,0,0);
  $pdf->Text(14, 100, utf8_decode("Nom / nature :"));
  $pdf->Text(14, 103, utf8_decode("Activité / descriptif :"));
  $pdf->Text(14, 106, utf8_decode("Lieux précis :"));
  $pdf->SetTextColor(210,120,20);
  $pdf->Text(40, 100, utf8_decode($dps_p['event_name']));
  $pdf->Text(40, 103, utf8_decode($dps_p['event_description']));
  $pdf->Text(40, 106, utf8_decode($dps_p['event_address']));
	if($dps_p['event_begin_date'] == $dps_p['event_end_date']){
		$pdf->Text(14, 109, utf8_decode("La manifestation se déroule le ".formatDateFrToReadable($dps_p['event_begin_date'])." de ".formatTimeFrToReadable($dps_p['event_begin_time'])." à ".formatTimeFrToReadable($dps_p['event_end_time'])));
	}else{
			$pdf->Text(14, 109, utf8_decode("La manifestation se déroule du ".formatDateFrToReadable($dps_p['event_begin_date'])." à ".formatTimeFrToReadable($dps_p['event_begin_time'])." au ".formatDateFrToReadable($dps_p['event_end_date'])." à ".formatTimeFrToReadable($dps_p['event_end_time'])));
		}
	if($dps_p['event_pref_secu'] == "0"){
		$pdf->Text(14, 112, utf8_decode("Aucun dossier n'a été déposé en préfecture."));
	}else{
		$pdf->Text(14, 112, utf8_decode("Un dossier a été déposé en préfecture."));
	}

  //RIS
  $pdf->SetTextColor(0,64,128);
  $pdf->SetFont('Poppins-Semibold','',8);
  $pdf->SetXY(12,116);
  $pdf->Cell(50,5,utf8_decode("Grille d'évaluation des risques"),1,0,"","true");
  $pdf->Rect(12, 121, 191, 32) ;

  $pdf->SetTextColor(0,0,0);
  $pdf->SetFont('Arial','B',7);
  $pdf->Text(14, 124, utf8_decode("Acteurs :"));
  $pdf->Text(75, 124, utf8_decode("Spectateurs :"));
  $pdf->Text(184, 124, utf8_decode("P1 :"));
  $pdf->Text(14, 127, utf8_decode("Activité du rassemblement :"));
  $pdf->Text(14, 130, utf8_decode("Accessibilité et environnement :"));
  $pdf->Text(14, 133, utf8_decode("Délai d'intervention des secours publics :"));
  $pdf->Text(184, 127, utf8_decode("P2 :"));
  $pdf->Text(184, 130, utf8_decode("E1 :"));
  $pdf->Text(184, 133, utf8_decode("E2 :"));
  $pdf->Text(14, 136, utf8_decode("Indice total de risque :"));
  $pdf->Text(14, 139, utf8_decode("Type de poste :"));
  $pdf->Text(184, 139, utf8_decode("RIS :"));
  $pdf->Text(14, 142, utf8_decode("Commentaire sur le RIS :"));

	if($dps_p['ris_p2'] == "1"){
		$p2_value = "25";
		$p2_text = "Public assis (spectacle, réunion, restauration, etc.)";
	}elseif($dps_p['ris_p2'] == "2"){
		$p2_value = "30";
		$p2_text = "Public debout (Exposition, foire, salon, exposition, etc.)";
	}elseif($dps_p['ris_p2'] == "3"){
		$p2_value = "35";
		$p2_text = "Public debout actif (Spectacle avec public statique, fête foraine, etc.) ";
	}elseif($dps_p['ris_p2'] == "4"){
		$p2_value = "40";
		$p2_text = "Public debout à risque (public dynamique, danse, féria, carnaval, etc.)";
	}
	
	if($dps_p['ris_e1'] == "1"){
		$e1_value = "25";
		$e1_text = "Faible (Structure permanente, voies publiques, etc.)";
	}elseif($dps_p['ris_e1'] == "2"){
		$e1_value = "30";
		$e1_text = "Modéré (Gradins, tribunes, mois de 2 hectares, etc.)";
	}elseif($dps_p['ris_e1'] == "3"){
		$e1_value = "35";
		$e1_text = "Moyen (Entre 2 et 5 hectares, autres conditions, etc.)";
	}elseif($dps_p['ris_e1'] == "4"){
		$e1_value = "40";
		$e1_text = "Elevé (Brancardage > 600m, pas d'accès VPSP, etc.)";
	}
	
	if($dps_p['ris_e2'] == "1"){
		$e2_value = "25";
		$e2_text = "Faible (Moins de 10 minutes)";
	}elseif($dps_p['ris_e2'] == "2"){
		$e2_value = "30";
		$e2_text = "Modéré (Entre 10 et 20 minutes)";
	}elseif($dps_p['ris_e2'] == "3"){
		$e2_value = "35";
		$e2_text = "Moyen (Entre 20 et 30 minutes)";
	}elseif($dps_p['ris_e2'] == "4"){
		$e2_value = "40";
		$e2_text = "Elevé (Plus de 30 minutes)";
	}
	
  $pdf->SetTextColor(210,120,20);
  $pdf->Text(50, 124, utf8_decode($dps_p['ris_p1_actors']));
  $pdf->Text(115, 124, utf8_decode($dps_p['ris_p1_public']));
  $pdf->Text(191, 124, utf8_decode($dps_p['ris_p1_actors'] + $dps_p['ris_p1_public']));
  $pdf->Text(191, 127, utf8_decode($p2_value/100));
  $pdf->Text(191, 130, utf8_decode($e1_value/100));
  $pdf->Text(191, 133, utf8_decode($e2_value/100));
	
	$i = ($p2_value+$e1_value+$e2_value)/100;
	
  $pdf->Text(50, 136, utf8_decode($i));
	
	$p1 = $dps_p['ris_p1_actors'] + $dps_p['ris_p1_public'];
	if($p1>100000){
		$p = 100000 + (($p1 - 100000)/2);
	}else{$p = $p1;
		 }
	
	$ris = $i*($p / 1000);
	
  $pdf->Text(191, 139, utf8_decode($ris));
	
	
	
  $pdf->Text(75, 127, utf8_decode($p2_text));
  $pdf->Text(75, 130, utf8_decode($e1_text));
  $pdf->Text(75, 133, utf8_decode($e2_text));
  $pdf->Text(50, 139, utf8_decode($dps_type_detailed));
  $pdf->MultiCell(160,24,'');
  $pdf->Cell(39);
  $pdf->MultiCell(150,3,utf8_decode($dps_p['ris_comment']));

  //Configuration du DPS
  $pdf->SetTextColor(0,64,128);
  $pdf->SetFont('Poppins-Semibold','',8);
  $pdf->SetXY(12,155);
  $pdf->Cell(50,5,utf8_decode("Configuration du DPS"),1,0,"","true");
  $pdf->Rect(12, 160, 191, 33) ;

  $pdf->SetFont('Arial','',7);
  $pdf->SetTextColor(0,0,0);
	
	if($dps_p['dps_begin_date'] == $dps_p['dps_end_date']){
		$pdf->Text(14, 163, utf8_decode("Le Dispositif Prévisionnel de Secours sera activé le ".formatDateFrToReadable($dps_p['dps_begin_date'])." de ".formatTimeFrToReadable($dps_p['dps_begin_time'])." à ".formatTimeFrToReadable($dps_p['dps_end_time'])));
	}else{
			$pdf->Text(14, 163, utf8_decode("Le Dispositif Prévisionnel de Secours sera activé du ".formatDateFrToReadable($dps_p['dps_begin_date'])." à ".formatTimeFrToReadable($dps_p['dps_begin_time'])." au ".formatDateFrToReadable($dps_p['dps_end_date'])." à ".formatTimeFrToReadable($dps_p['dps_end_time'])));
		}
	
	
	
  $pdf->SetFont('Arial','B',7);
  $pdf->Text(14, 166, utf8_decode("Moyens fournis par l'AASC :"));
  $pdf->Text(60, 166, utf8_decode("CE / CP :"));
  $pdf->Text(100, 166, utf8_decode("PSE2 :"));
  $pdf->Text(140, 166, utf8_decode("PSE1 :"));
  $pdf->Text(180, 166, utf8_decode("PSC1 :"));
  $pdf->Text(60, 169, utf8_decode("LOT A :"));
  $pdf->Text(100, 169, utf8_decode("LOT B :"));
  $pdf->Text(140, 169, utf8_decode("LOT C :"));
  $pdf->Text(180, 169, utf8_decode("D.A.E. :"));
  $pdf->Text(60, 172, utf8_decode("VPSP Trans. :"));
  $pdf->Text(100, 172, utf8_decode("VPSP fixe :"));
  $pdf->Text(140, 172, utf8_decode("VL / VTU :"));
  $pdf->Text(180, 172, utf8_decode("Tentes :"));
  $pdf->Text(60, 175, utf8_decode("Médecins :"));
  $pdf->Text(100, 175, utf8_decode("infirmiers :"));
  $pdf->Text(140, 175, utf8_decode("Moyens sup. :"));

  $pdf->SetTextColor(210,120,20);
  $pdf->Text(85, 166, utf8_decode($dps_p['dps_nb_ce']));
  $pdf->Text(120, 166, utf8_decode($dps_p['dps_nb_pse2']));
  $pdf->Text(165, 166, utf8_decode($dps_p['dps_nb_pse1']));
  $pdf->Text(195, 166, utf8_decode($dps_p['dps_nb_psc1']));
  $pdf->Text(85, 169, utf8_decode($dps_p['dps_nb_lot_a']));
  $pdf->Text(120, 169, utf8_decode($dps_p['dps_nb_lot_b']));
  $pdf->Text(165, 169, utf8_decode($dps_p['dps_nb_lot_c']));
  $pdf->Text(195, 169, utf8_decode($dps_p['dps_nb_dae']));
  $pdf->Text(85, 172, utf8_decode($dps_p['dps_nb_vpsp_transp']));
  $pdf->Text(120, 172, utf8_decode($dps_p['dps_nb_vpsp_soin']));
  $pdf->Text(165, 172, utf8_decode($dps_p['dps_nb_vtu']));
  $pdf->Text(195, 172, utf8_decode($dps_p['dps_nb_tente']));
  $pdf->Text(85, 175, utf8_decode($dps_p['dps_nb_med_asso']));
  $pdf->Text(120, 175, utf8_decode($dps_p['dps_nb_inf_asso']));
  $pdf->Text(165, 175, utf8_decode($dps_p['dps_other_matos_asso']));


  $pdf->SetTextColor(0,0,0);
  $pdf->Text(14, 178, utf8_decode("Moyens fournis par l'orga. :"));
  $pdf->Text(60, 178, utf8_decode("Local infirmerie:"));
  $pdf->Text(140, 178, utf8_decode("Tentes :"));
  $pdf->Text(60, 181, utf8_decode("autres moyens :"));

  $pdf->SetTextColor(220,120,20);
  $pdf->Text(85, 178, utf8_decode($dps_p['clientmatos_infirmerie']));
  $pdf->Text(165, 178, utf8_decode($dps_p['clientmatos_tente']));
  $pdf->Text(85, 181, utf8_decode($dps_p['clientmatos_other']));

  $pdf->SetTextColor(0,0,0);
  $pdf->Text(14, 184, utf8_decode("Moyens medicaux :"));
  $pdf->Text(60, 184, utf8_decode("Médecins ext. :"));
  $pdf->Text(140, 184, utf8_decode("Appartenance :"));
  $pdf->Text(60, 187, utf8_decode("Infirmiers ext. :"));
  $pdf->Text(140, 187, utf8_decode("Appartenance :"));
  $pdf->Text(14, 190, utf8_decode("S.A.M.U. :"));
  $pdf->Text(100, 190, utf8_decode("B.S.P.P. :"));

  $pdf->SetTextColor(220,120,20);
  $pdf->Text(85, 184, utf8_decode($dps_p['medicalext_nb_med']));
  $pdf->Text(165, 184, utf8_decode($dps_p['medicalext_med_company']));
  $pdf->Text(85, 187, utf8_decode($dps_p['medicalext_nb_inf']));
  $pdf->Text(165, 187, utf8_decode($dps_p['medicalext_inf_company']));
	
	
  $pdf->Text(60, 190, utf8_decode($samu = $select_list_parameter_service_p->getTranslation('samu', $dps_p['samu'])));
  $pdf->Text(140, 190, utf8_decode($bspp = $select_list_parameter_service_p->getTranslation('bspp', $dps_p['bspp'])));


  $pdf->SetFont('Poppins-Semibold','',8);
  $pdf->SetTextColor(0,64,128);
  $pdf->SetXY(12,195);
  $pdf->Cell(50,5,utf8_decode("Justification du DPS"),1,0,"","true");
  $pdf->Rect(12, 200, 191, 15) ;
  $pdf->SetTextColor(0,0,0);

	$pdf->MultiCell(160,5,'');
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(3,3,'');
	$pdf->MultiCell(180,3,utf8_decode($dps_p['dps_justification']));

  $pdf->SetFont('Poppins-Semibold','',8);
  $pdf->SetTextColor(0,64,128);
  $pdf->SetXY(12,217);
  $pdf->Cell(50,5,utf8_decode("Cadre réservé à l'administration"),1,0,"","true");
  $pdf->Rect(12, 222, 191, 20) ;
	
	$pdf->MultiCell(160,5,'');
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(3,3,'');
	$pdf->MultiCell(180,3,utf8_decode($dps_p['status_justification']));

  $pdf->SetFont('Arial','',7);
  $pdf->SetTextColor(0,0,0);
  $pdf->Text(12, 247, utf8_decode("Le Directeur Local des Opérations"));
  $pdf->Text(12, 250, utf8_decode("Antenne de Courbevoie, Neuilly, La garenne colombes"));
  $pdf->Text(12, 253, utf8_decode("Nicolas Lethellier"));
  $pdf->Text(12, 256, utf8_decode("Le 13-10-2015"));


  $pdf->Text(120, 247, utf8_decode("Le Directeur Départemental des Opérations"));
  $pdf->Text(120, 250, utf8_decode("Protection Civile des Hauts-de-Seine"));
  $pdf->Text(120, 253, utf8_decode("Par intérim : Pascal Mallet"));
  $pdf->Text(120, 256, utf8_decode("Le 18-10-2015"));
  $pdf->Image("img/signatures/rod92.png",170,259,30,15);
  $pdf->Image("img/signatures/tampon.png",110,259,50,15);

  $pdf->Output( $pathfile, "F");
}

?>
