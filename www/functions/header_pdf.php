<?php
$pdf->SetFillColor(237,242,247);
$pdf->SetDrawColor(237,242,247);
$pdf->Rect(0,0,210,42,'FD');
$pdf->Image("../img/logo.png",14,5,30,30);
$pdf->SetTextColor(13,53,148);
$pdf->SetFont('Arial','B',14);
$pdf->Text(94.8,11.9,"ROTECTION");
$pdf->Text(131.8,11.9,"IVILE DES");
$pdf->Text(163.8,11.9,"AUTS DE");
$pdf->Text(193.1,11.9,"EINE");
$pdf->SetFont('Arial','B',26);
$pdf->SetTextColor(255,127,0);
$pdf->Text(88.5,11.9,"P");
$pdf->Text(125,11.9,"C");
$pdf->Text(157,11.9,"H");
$pdf->Text(187,11.9,"S");
$pdf->SetTextColor(13,53,148);
$pdf->SetFont('Arial','',8);
$pdf->Text(145.3,27,"32 boulevard des oiseaux - 92700 COLOMBES");
$pdf->Text(151.3,31,"Tel : 01 47 72 80 33 - Fax : 01 74 18 09 13");
$pdf->Text(99.6,35,"E-mail : operationnel@protectioncivile92.org - Site Web : www.protectioncivile92.org");
require('sender-pdf.php');

$pdf->SetFillColor(243,133,49);
$pdf->SetDrawColor(243,133,49);
$pdf->Rect(5,284,200,0.3,'FD');
$pdf->SetTextColor(13,53,148);
$pdf->SetFont('Arial','B',7);
$pdf->Text(5,288,"MEMBRE DE LA FEDERATION NATIONALE DE PROTECTION CIVILE");
$pdf->SetFont('Arial','',7);
$pdf->Text(87,288,"-  RECONNUE D'UTILITE PUBLIQUE - DECRET DU 14 NOVEMBRE 1969 ET ARRETE DU 15 OCTOBRE");
$pdf->Text(5,291,"1996   -    AGREEE DE SECURITE CIVILE PAR LE MINISTERE DE L'INTERIEUR LE 30 AOUT 2006   -   CONVENTION AVEC LE MINISTERE DE LA SANTE   -   10 JANVIER 1992");
?>