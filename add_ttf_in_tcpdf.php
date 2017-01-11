<?php
require_once('tcpdf/config/tcpdf_config.php') ;
require_once('tcpdf/tcpdf.php') ;

$fontname=TCPDF_FONTS::addTTFfont('tcpdf/fonts/big5/kaiu.ttf', 'TrueTypeUnicode');*/
$pdf->SetFont('kaiu', '', 12, true);
define ('PDF_FONT_NAME_MAIN', 'kaiu');


?>