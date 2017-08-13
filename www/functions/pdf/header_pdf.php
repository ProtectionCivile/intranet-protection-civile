<?php
$pdf->Image("../../img/logos/logo-baseline-right.png",6,10,95,23);
$pdf->SetDrawColor(0,64,128);
$pdf->SetLineWidth(0.3);
$pdf->Line(30,31,30,35);
$pdf->Addfont('Poppins-SemiBold','','Poppins-SemiBold.php');
$pdf->SetFont('Poppins-SemiBold','',11);
$pdf->SetTextColor(0,64,128);
$pdf->Text(32,34,"HAUTS-DE-SEINE");
$pdf->Image("../../img/saynette/saynette-echarpe.jpg",135,6,70,50);
require('sender_pdf.php');

$pdf->SetFillColor(243,133,49);
$pdf->SetDrawColor(243,133,49);
$pdf->Rect(5,279,200,0.2,'FD');
$pdf->SetTextColor(13,53,148);
$pdf->SetFont('Arial','',6);
$pdf->Text(40,283,"Association Departementale de Protection Civile des Hauts-de-Seine - ADPC 92 - 32 boulevard des oiseaux, 92700 Colombes, France");
$pdf->Text(43,285,"Tel : 01.47.72.80.33 - Fax : 01.47.72.61.90 - Email : contact@protectioncivile92.org - Site Internet : www.protectioncivile92.org");
$pdf->Text(33,287,"Association regie par la loi de 1901 - Agreee de securite civile - Reconnue d'utilite publique - Membre de la Federation Nationale de Protection Civile");
$pdf->Text(49,289,"Numero SIRET : 325 625 739 00041 - Numero : APE 8559B - Declaration en prefecture Numero : W922002223");
?>