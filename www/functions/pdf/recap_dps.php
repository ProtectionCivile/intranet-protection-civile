<?php
require('../../lib/fpdf/fpdf.php');
$pdf=new FPDF();
$pdf->AddPage();
require('header_pdf.php');

$pdf->SetTextColor(0,64,128);
$pdf->SetFont('Poppins-SemiBold','',10);
$pdf->Text(12,62,"Ouverture d'un Dispositif Prévisionnel de Secours de Moyenne Envergure (DPS-ME)");


// Début des cadres
// Position du cadre COA : X = 168 --- Y = 41
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Poppins-SemiBold','',10); 
$pdf->SetXY(170,62);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(32,5.3,"92-15-COU-080",1,1,"C");
$pdf->SetFont('Arial','',7); 
$pdf->SetTextColor(0,0,0);
$pdf->Text(170, 61, "Certificat Original d'Affiliation");

//Organisateur
$pdf->SetLineWidth(0.3) ;
$pdf->SetFont('Poppins-Semibold','',8);
$pdf->SetTextColor(0,64,128);
$pdf->SetXY(12,65);
$pdf->Cell(50,5,"Organisateur",1,0,"","true");
$pdf->Rect(12, 70, 191, 20) ;

$pdf->SetFont('Arial','B',7);
$pdf->SetTextColor(0,0,0);
$pdf->Text(14, 73, "Nom :");
$pdf->Text(14, 76, "Représenté(e) par :");  
$pdf->Text(14, 79, "Qualité de :"); 
$pdf->Text(14, 82, "Adresse :"); 
$pdf->Text(14, 85, "Téléphone :"); 
$pdf->Text(63, 85, "Fax :"); 
$pdf->Text(14, 88, "E-mail :");
$pdf->SetTextColor(210,120,20);
$pdf->Text(40, 73, "Association Passé Présent (A.P.P.)");
$pdf->Text(40, 76, "Michèle TELLIER");  
$pdf->Text(40, 79, "Organisatrice de la Révolution Française"); 
$pdf->Text(40, 82, "13 Avenue du Chat blanc sur la grande branche en chêne clair - 92345 Cormeilles En Parisis Sur Marne de la Seine"); 
$pdf->Text(40, 85, "+1 783-780-1345"); 
$pdf->Text(70, 85, "01 02 03 04 05"); 
$pdf->Text(40, 88, "directeur-adj-informatique@protectioncivile92.org");

//Nature manifestation
$pdf->SetTextColor(0,64,128);
$pdf->SetFont('Poppins-Semibold','',8);
$pdf->SetXY(12,92);
$pdf->Cell(50,5,"Nature de la manifestation",1,0,"","true");
$pdf->Rect(12, 97, 191, 17) ;

$pdf->SetFont('Arial','B',7); 
$pdf->SetTextColor(0,0,0);
$pdf->Text(14, 100, "Nom / nature :");
$pdf->Text(14, 103, "Activité / descriptif :");
$pdf->Text(14, 106, "Lieux précis :");
$pdf->SetTextColor(210,120,20);
$pdf->Text(40, 100, "Combats Kata et karaté : championnats départementaux 2015");
$pdf->Text(40, 103, "Sport / Karaté");  
$pdf->Text(40, 106, "13 Avenue du Chat blanc sur la grande branche en chêne clair - 92345 Cormeilles En Parisis Sur Marne de la Seine"); 
$pdf->Text(14, 109, "La manifestation se déroule le 04-10-2015 de 08H00 à 19H00");
$pdf->Text(14, 112, "Aucun dossier n'a été déposé en préfecture.");

//RIS
$pdf->SetTextColor(0,64,128);
$pdf->SetFont('Poppins-Semibold','',8);
$pdf->SetXY(12,116);
$pdf->Cell(50,5,"Grille d'évaluation des risques",1,0,"","true");
$pdf->Rect(12, 121, 191, 32) ;

$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',7); 
$pdf->Text(14, 124, "Acteurs :");
$pdf->Text(75, 124, "Spectateurs :"); 
$pdf->Text(184, 124, "P1 :"); 
$pdf->Text(14, 127, "Activité du rassemblement :"); 
$pdf->Text(14, 130, "Accessibilité et environnement :"); 
$pdf->Text(14, 133, "Délai d'intervention des secours publics :"); 
$pdf->Text(184, 127, "P2 :");
$pdf->Text(184, 130, "E1 :");
$pdf->Text(184, 133, "E2 :");
$pdf->Text(14, 136, "Indice total de risque :");
$pdf->Text(14, 139, "Type de poste :");
$pdf->Text(184, 139, "RIS :"); 
$pdf->Text(14, 142, "Commentaire sur le RIS :"); 

$pdf->SetTextColor(210,120,20);
$pdf->Text(50, 124, "250000");
$pdf->Text(115, 124, "250000"); 
$pdf->Text(190, 124, "500000");
$pdf->Text(191, 127, "0,40");
$pdf->Text(191, 130, "0,40");
$pdf->Text(191, 133, "0,40");
$pdf->Text(50, 136, "0,80");
$pdf->Text(191, 139, "124");
$pdf->Text(75, 127, "Public debout (spectacle avec public dynamique, danse féria, spectacle de rue, etc.)"); 
$pdf->Text(75, 130, "Espace naturels : surfaces Supérieur ou égal à  5 ha.");
$pdf->Text(75, 133, "Entre 20 minutes et 30 minutes"); 
$pdf->Text(50, 139, "Point d'Alerte et de Premiers secours (PAPS)");
$pdf->MultiCell(160,24);
$pdf->Cell(39);
$pdf->MultiCell(150,3,"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum");

//Configuration du DPS
$pdf->SetTextColor(0,64,128);
$pdf->SetFont('Poppins-Semibold','',8);
$pdf->SetXY(12,155);
$pdf->Cell(50,5,"Configuration du DPS",1,0,"","true");
$pdf->Rect(12, 160, 191, 33) ;

$pdf->SetFont('Arial','',7);
$pdf->SetTextColor(0,0,0);
$pdf->Text(14, 163, "Le Dispositif Prévisionnel de Secours sera activé du 04-10-2015 à 07H30 au 05-10-2015 à 18H00.");
$pdf->SetFont('Arial','B',7);
$pdf->Text(14, 166, "Moyens fournis par l'AASC :");
$pdf->Text(60, 166, "CE / CP :");
$pdf->Text(100, 166, "PSE2 :");
$pdf->Text(140, 166, "PSE1 :");
$pdf->Text(180, 166, "PSC1 :");
$pdf->Text(60, 169, "LOT A :");
$pdf->Text(100, 169, "LOT B :");
$pdf->Text(140, 169, "LOT C :");
$pdf->Text(180, 169, "D.A.E. :");
$pdf->Text(60, 172, "VPSP Trans. :");
$pdf->Text(100, 172, "VPSP fixe :");
$pdf->Text(140, 172, "VL / VTU :");
$pdf->Text(180, 172, "Tentes :");
$pdf->Text(60, 175, "Médecins :");
$pdf->Text(100, 175, "infirmiers :");
$pdf->Text(140, 175, "Moyens sup. :");

$pdf->SetTextColor(210,120,20);
$pdf->Text(85, 166, "12");
$pdf->Text(120, 166, "230");
$pdf->Text(165, 166, "390");
$pdf->Text(195, 166, "98");
$pdf->Text(85, 169, "16");
$pdf->Text(120, 169, "90");
$pdf->Text(165, 169, "3");
$pdf->Text(195, 169, "230");
$pdf->Text(85, 172, "12");
$pdf->Text(120, 172, "7");
$pdf->Text(165, 172, "68");
$pdf->Text(195, 172, "460");
$pdf->Text(85, 175, "21");
$pdf->Text(120, 175, "65");
$pdf->Text(165, 175, "SMG + groupe + tout ça");


$pdf->SetTextColor(0,0,0);
$pdf->Text(14, 178, "Moyens fournis par l'orga. :");
$pdf->Text(60, 178, "Local infirmerie:");
$pdf->Text(140, 178, "Tentes :");
$pdf->Text(60, 181, "autres moyens :");

$pdf->SetTextColor(220,120,20);
$pdf->Text(85, 178, "Oui");
$pdf->Text(165, 178, "12");
$pdf->Text(85, 181, "Un gymnase");

$pdf->SetTextColor(0,0,0);
$pdf->Text(14, 184, "Moyens medicaux :");
$pdf->Text(60, 184, "Médecins ext. :");
$pdf->Text(140, 184, "Appartenance :");
$pdf->Text(60, 187, "Infirmiers ext. :");
$pdf->Text(140, 187, "Appartenance :");
$pdf->Text(14, 190, "S.A.M.U. :");
$pdf->Text(100, 190, "B.S.P.P. :");

$pdf->SetTextColor(220,120,20);
$pdf->Text(85, 184, "1");
$pdf->Text(165, 184, "Jean-Jacques Goldman");
$pdf->Text(85, 187, "13");
$pdf->Text(165, 187, "Infirm land");
$pdf->Text(60, 190, "Informé, non présent");
$pdf->Text(140, 190, "Ni informé, Ni présent");


$pdf->SetFont('Poppins-Semibold','',8);
$pdf->SetTextColor(0,64,128);
$pdf->SetXY(12,195);
$pdf->Cell(50,5,"Justification du DPS",1,0,"","true");
$pdf->Rect(12, 200, 191, 15) ;
$pdf->SetTextColor(0,0,0);


$pdf->SetFont('Poppins-Semibold','',8);
$pdf->SetTextColor(0,64,128);
$pdf->SetXY(12,217);
$pdf->Cell(50,5,"Cadre réservé à  l'administration",1,0,"","true");
$pdf->Rect(12, 222, 191, 20) ;

$pdf->SetFont('Arial','',7);
$pdf->SetTextColor(0,0,0);
$pdf->Text(12, 247, "Le Directeur Local des Opérations");
$pdf->Text(12, 250, "Antenne de Courbevoie, Neuilly, La garenne colombes");
$pdf->Text(12, 253, "Nicolas Lethellier");
$pdf->Text(12, 256, "Le 13-10-2015");


$pdf->Text(120, 247, "Le Directeur Départemental des Opérations");
$pdf->Text(120, 250, "Protection Civile des Hauts-de-Seine");
$pdf->Text(120, 253, "Par intérim : Pascal Mallet");
$pdf->Text(120, 256, "Le 18-10-2015");
$pdf->Image("../../img/signatures/rod92.png",170,259,30,15);
$pdf->Image("../../img/signatures/tampon.png",110,259,50,15);

$pdf->Output();
?>