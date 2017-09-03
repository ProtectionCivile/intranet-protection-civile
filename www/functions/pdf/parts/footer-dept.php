<?php
$footer_h_offset_line = 279;
$footer_h_offset_text = 283;
$footer_h_linespacing = 2;
$footer_font_size = 6;

$pdf->SetFillColor(240,135,0);
$pdf->SetDrawColor(240,135,0);
$pdf->Rect(5,$footer_h_offset_line,200,0.2,'FD');
$pdf->SetTextColor(0,64,128);
$pdf->SetFont('Arial','',$footer_font_size);


$pdf->Text(40,$footer_h_offset_text,utf8_decode("Association Departementale de Protection Civile des Hauts-de-Seine - ADPC 92 - 32 boulevard des oiseaux, 92700 Colombes, France"));
$pdf->Text(43,$footer_h_offset_text+=$footer_h_linespacing,utf8_decode("Tel : 01.47.72.80.33 - Fax : 01.47.72.61.90 - Email : contact@protectioncivile92.org - Site Internet : www.protectioncivile92.org"));
$pdf->Text(33,$footer_h_offset_text+=$footer_h_linespacing,utf8_decode("Association regie par la loi de 1901 - Agreee de securite civile - Reconnue d'utilite publique - Membre de la Federation Nationale de Protection Civile"));
$pdf->Text(49,$footer_h_offset_text+=$footer_h_linespacing,utf8_decode("Numero SIRET : 325 625 739 00041 - Numero : APE 8559B - Declaration en prefecture Numero : W922002223"));
?>
