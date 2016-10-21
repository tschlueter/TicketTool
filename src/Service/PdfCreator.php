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

        // TODO refactor to constants!

        $pageWidth  = 420.94;
        $pageHeight = 297.64;

        $borderX = 10.0;
        $borderY = 10.0;

        $offsetTitleY = 40.0;

        // A6 dimensions are 297.64, 420.94
        $pdf = new FPDF('L', 'pt', 'A6');

        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 25.0);


        $pdf->Rect(
            $borderX,
            $borderY,
            $pageWidth  - 2 * $borderX,
            $pageHeight - 2 * $borderY
        );


        $pdf->SetXY(0.0, 0.0);

        //$pdf->Cell(500.0, 10.0, $ticketId, 'R');

        $titleWidth = $pdf->GetStringWidth($ticketId);

        $pdf->Text(($pageWidth - $titleWidth) / 2, $offsetTitleY, $ticketId);


        //$pdf->Line(0.0, 0.0, $pageWidth, $pageHeight);



        $pdf->Output('I' /* 'F' */, $pdfOutName);
    }

}