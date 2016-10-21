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

        $offsetTicketIdY      = 50.0;
        $offsetTicketTitleIdY = 65.0;

        $fontSizeId    = 30.0;
        $fontSizeTitle = 25.0;

        $ticketTitleLineHeight = 30.0;



        // A6 dimensions are 297.64, 420.94
        $pdf = new FPDF('L', 'pt', 'A6');

        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', $fontSizeId);


        $pdf->Rect(
            $borderX,
            $borderY,
            $pageWidth  - 2 * $borderX,
            $pageHeight - 2 * $borderY
        );

        $pdf->SetXY(0.0, 0.0);
        $titleWidth = $pdf->GetStringWidth($ticketId);
        $pdf->Text(($pageWidth - $titleWidth) / 2, $offsetTicketIdY, $ticketId);

        $pdf->SetXY($borderX, $offsetTicketTitleIdY);
        $pdf->SetFont('Arial', '', $fontSizeTitle);
        $pdf->MultiCell($pageWidth  - 2 * $borderX, $ticketTitleLineHeight, $ticketTitle, 0.0, 'C');


        //$pdf->Line(0.0, 0.0, $pageWidth, $pageHeight);



        $pdf->Output('I' /* 'F' */, $pdfOutName);
    }

}