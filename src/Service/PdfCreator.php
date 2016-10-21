<?php
/**
 * Manages PDF generation.
 */
class Service_PdfCreator
{

    /**
     * Tests the functionality.
     */
    public static function test($ticketId, $ticketTitle)
    {
        $pdfOutName = 'out/pdfTest.pdf';

        $width  = 420.94;
        $height = 297.64;

        // A6 dimensions are 297.64, 420.94
        $pdf = new FPDF('L', 'pt', 'A6');

        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 20.0);



        $pdf->Cell(0.0, 0.0, $ticketId, 'center');

        $pdf->Line(0.0, 0.0, $width, $height);






        $pdf->Output('I' /* 'F' */, $pdfOutName);
    }

}