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

        $pageWidth  = 297.64;
        $pageHeight = 420.94;

        $borderX = 1.0;
        $borderY = 1.0;

        $offsetTicketIdY    = ( $pageHeight / 2 ) + 15.0;
        $offsetTicketTitleY = ( $pageHeight / 2 ) + 30.0;

        $fontSizeId    = 27.5;
        $fontSizeTitle = 22.5;

        $ticketTitleLineHeight = 30.0;
        $distanceImageY        = 20.0;

        // A6 dimensions are 297.64, 420.94
        $pdf = new FPDF($orientation, 'pt', $dimension);

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
        $pdf->Text(($pageWidth - $titleWidth) / 2, $offsetTicketIdY, $ticketId);

        // draw title

        $pdf->SetFont('Arial', '', $fontSizeTitle);

        $pdf->SetXY(0.0, $offsetTicketTitleY);
        $pdf->MultiCell($pageWidth, $ticketTitleLineHeight, $ticketTitle, 0.0, 'C');

        // save as file

        $pdf->Output('F', $pdfOutName);

        if (Controller_TicketTool::DEBUG_OUT) echo 'Successfully created pdf file <b>[' . $pdfOutName . ']</b><br><br><hr><br>';
    }

    private function createPdf()
    {


    }

}