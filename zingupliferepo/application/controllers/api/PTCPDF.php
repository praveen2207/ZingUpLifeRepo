<?php

class PTCPDF extends TCPDF
{
 protected $processId =0;
 protected $header = 'logo';
 protected $footer ='';
 static $errorMsg ='';
 /**
 * This method is used to override the parent class method.
**/
 public function Header()
 {
     
    if($this->page != 1){
	//$image_file = base_url().'assets/assessment/logo.png';
    $image_file = base_url().'assets/assessment/img/pdf/logo.png';
    $this->Image($image_file, 136, 12, 54, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false); 
    //$this->Image($image_file, 20, 12, 60, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false); 
    
	//$this->writeHTMLCell($w='90', $h='10', $x='100', $y='15', 'header2', $border=0, $ln=0, $fill=0, $reseth=true, $align='R', $autopadding=true);
	//$this->SetLineStyle( array('width'=>0.40,'color'=> array(0,0,0)));
	//$this->Line(20,25, $this->getPageWidth()-20,25);
	//$this->Line(12,5, $this->getPageWidth()-12,5); 
	//$this->Line($this->getPageWidth()-12,5, $this->getPageWidth()-12, $this->getPageHeight()-5);
	//$this->Line(12, $this->getPageHeight()-5, $this->getPageWidth()-12, $this->getPageHeight()-5);
	//$this->Line(12 ,5,12, $this->getPageHeight()-5); 
    }
 }
 
 
 // Page footer
 public function Footer() {
     // Position at 15 mm from bottom
     $this->SetY(-15);
     // Set font
     $this->SetFont('helvetica', 'I', 8);
     // Page number
     $this->Cell(0, 10, 'CONFIDENTIAL & PROPRIETARY | ZULPHS INFOTECH PRIVATE LIMITED', 0, false, 'C', 0, '', 0, false, 'T', 'M');
     $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
 }
 
 
}