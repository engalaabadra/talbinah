<?php

namespace App\Services;
use Mpdf\Mpdf; 

class GeneratePdfService{
    public function renderPdf($view,$data,$fileName){
        $pdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;
        // Load the view into the PDF
        $view = view($view, $data)->render();
        $pdf->WriteHTML($view);

        // // Set image dimensions and position
        // $imageWidth = 100;
        // $imageHeight = 100;
        // $imageX = 50;
        // $imageY = 50;

        // // Path to the PNG image file
        // $imageFile = 'assets/images/logo/logo_talbinah.png';

        // Add the image to the PDF
        // $pdf->Image($imageFile, $imageX, $imageY, $imageWidth, $imageHeight, 'PNG');

        // Output the PDF
        return $pdf->Output($fileName, 'D');
    }
}
