<?php
 include('../../data/conexion.php');
 $id = $_GET['id']; 


//require '../vendor/autoload.php' ;
//use  Spipu\Html2Pdf\Html2Pdf ;
require_once('../../clases/pdf/html2pdf.class.php');
ob_start();
include('informe.php');

$html = ob_get_clean();
//require_once('../clases/pdf/html2pdf.class.php');
/*$html2pdf  =  new  Html2Pdf('P','A4','es','true','UTF-8'); 
$html2pdf->pdf->SetDisplayMode('fullpage'); //Ver otros parÃ¡metros para SetDisplaMode
$html2pdf->pdf->SetTitle('Cotización #'.sprintf('%04d',$idcotizacion)); //Ver otros parÃ¡metros para SetDisplaMode
$html2pdf -> writeHTML ($html); 
$html2pdf -> output ();*/
$archivo = "Pedido".sprintf('%04d',$id).".pdf";
   try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(15, 10, 15, 15)); //Configura la hoja
        $html2pdf->pdf->SetDisplayMode('fullpage'); //Ver otros parÃ¡metros para SetDisplaMode
        $html2pdf->setTestTdInOnePage(true);
        $html2pdf->setTestIsImage(false);//pone una imagen en la etiqueta img cuando no se encuentra
       // $html2pdf->addFont ('ZapfDingbats', '', '../clases/pdf/font/zapfdingbats.php');
        $html2pdf->writeHTML($html); //Se escribe el contenido 
        $html2pdf->Output($archivo); //Nombre default del PDF
        $html2pdf->Output("copias/".$archivo,'F');
        
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }