<?php
/**
 * Manages PDF generation.
 */
class Service_PdfCreator
{

    public function __construct()
    {
    }

    /**
     * Tests the functionality.
     *
     * @param string $ticketId
     * @param string $ticketTitle
     * @param string $imageFileName
     */
    public function export($ticketId, $ticketTitle, $imageFileName)
    {
        // TODO refactor to constants!

        $pdfOutName = 'out/pdf/' . $ticketId . '.pdf';

        $dimension   = 'A6';
        $orientation = 'P';

        $borderX = 0.0;
        $borderY = 0.0;

        $fontSizeId    = 27.5;
        $fontSizeTitle = 22.5;

        $ticketTitleLineHeight = 30.0;
        $distanceImageY        = 20.0;

        $offsetTicketIdY    = 15.0;
        $offsetTicketTitleY = 30.0;



        // A6 dimensions are 297.64, 420.94
        $pdf = new FPDF($orientation, 'pt', $dimension);

        $pageWidth  = $pdf->GetPageWidth();  // 297.64;
        $pageHeight = $pdf->GetPageHeight(); // 420.94;

        $ticketIdY    = ( $pageHeight / 2 ) + $offsetTicketIdY;
        $ticketTitleY = ( $pageHeight / 2 ) + $offsetTicketTitleY;

        $pdf->AddPage();

        $pdf->Rect(
            $borderX,
            $borderY,
            $pageWidth  - 2 * $borderX,
            $pageHeight - 2 * $borderY
        );


        // draw image

        $pdf->SetXY(0.0, 0.0);
        $imageSize = getimagesize($imageFileName);
        $pdf->Image(
            $imageFileName,
            ($pageWidth - $imageSize[0]) / 2,
            $distanceImageY,
            $imageSize[0],
            $imageSize[1]
        );

        // draw ID

        $pdf->SetFont('Arial', 'B', $fontSizeId);

        $pdf->SetXY(0.0, 0.0);
        $titleWidth = $pdf->GetStringWidth($ticketId);
        $pdf->Text(($pageWidth - $titleWidth) / 2, $ticketIdY, $ticketId);

        // draw title

        $pdf->SetFont('Arial', '', $fontSizeTitle);

        $pdf->SetXY(0.0, $ticketTitleY);
        $pdf->MultiCell($pageWidth, $ticketTitleLineHeight, $ticketTitle, 0.0, 'C');

        // save as file

        $pdf->Output('F', $pdfOutName);

        Controller_TicketTool::DEBUG_LOG('Successfully created pdf file <b>[' . $pdfOutName . ']</b>');
        Controller_TicketTool::DEBUG_LOG('<hr>', false);
    }

    private function createPdf()
    {


    }

}