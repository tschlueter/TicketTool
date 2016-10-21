<?php
/**
 * Manages PDF generation.
 */
class Service_PdfCreator
{

    /**
     * Tests the functionality.
     */
    public static function test()
    {
        $pdf = new FPDF();

        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hallo Welt!');
        $pdf->Output('F', 'out/pdfTest.pdf');
    }

}