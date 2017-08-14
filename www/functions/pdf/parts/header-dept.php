<?php

$header_w_offset_logo = 6;
$header_h_offset_logo = 10;
$header_w_offset_line = $header_w_offset_logo + 24;
$header_h_offset_line = $header_h_offset_logo + 21;

$pdf->Image("../../img/logos/logo-baseline-right.png", $header_w_offset_logo, $header_h_offset_logo,95,23);

$pdf->SetDrawColor(0,64,128);
$pdf->SetLineWidth(0.3);
$pdf->Line($header_w_offset_line, $header_h_offset_line, $header_w_offset_line, $header_h_offset_line+4);

$pdf->Addfont('Poppins-SemiBold','','Poppins-SemiBold.php');
$pdf->SetFont('Poppins-SemiBold','',11);
$pdf->SetTextColor(0,64,128);
$pdf->Text($header_w_offset_logo+26, $header_h_offset_logo+24, utf8_decode("HAUTS-DE-SEINE"));


?>
