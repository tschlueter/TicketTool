<?php
/**
 * Manages PDF generation.
 */
class Service_PdfExporter
{

    /**
     * @var FPDF
     */
    private $_pdf;

    /**
     * @var string
     */
    private $_pdfFileName;

    /**
     * Creates a new PDF export file.
     *
     * @param string $pdfFileName
     */
    public function __construct($pdfFileName)
    {
        $this->_pdf = new FPDF(
            Controller_Setting::PDF_PAGE_ORIENTATION,
            Controller_Setting::PDF_PAGE_UNIT,
            Controller_Setting::PDF_PAGE_DIMENSION
        );

        $this->_pdfFileName = Controller_Setting::PATH_OUT_PDF . $pdfFileName . '.pdf';
    }

    /**
     * Tests the functionality.
     *
     * @param string $ticketId
     * @param string $ticketTitle
     * @param string $ticketType
     * @param string $ticketEstimation
     * @param string $imageFileName
     */
    public function createPage(
        $ticketId,
        $ticketTitle,
        $ticketType,
        $ticketEstimation,
        $imageFileName
    )
    {
        // TODO refactor to constants!

        $rectBorderX            = 0.0;
        $rectBorderY            = 0.0;

        $textBorderX            = 10.0;
        $textBorderY            = 10.0;

        $fontSizeId             = 27.5;
        $fontSizeTitle          = 22.5;

        $ticketTitleLineHeight  = 30.0;
        $distanceImageY         = 20.0;

        $offsetTicketIdY        = 15.0;
        $offsetTicketTitleY     = 30.0;




        $pageWidth  = $this->_pdf->GetPageWidth();  // 297.64;
        $pageHeight = $this->_pdf->GetPageHeight(); // 420.94;

        $ticketIdY    = ( $pageHeight / 2 ) + $offsetTicketIdY;
        $ticketTitleY = ( $pageHeight / 2 ) + $offsetTicketTitleY;

        $this->_pdf->AddPage();

        $this->_pdf->Rect(
            $rectBorderX,
            $rectBorderY,
            $pageWidth  - 2 * $rectBorderX,
            $pageHeight - 2 * $rectBorderY
        );


        // draw image

        $this->_pdf->SetXY(0.0, 0.0);
        $imageSize = getimagesize($imageFileName);
        $this->_pdf->Image(
            $imageFileName,
            ($pageWidth - $imageSize[0]) / 2,
            $distanceImageY,
            $imageSize[0],
            $imageSize[1]
        );

        // draw ID

        $this->_pdf->SetFont('Arial', 'B', $fontSizeId);

        $this->_pdf->SetXY(0.0, 0.0);
        $titleWidth = $this->_pdf->GetStringWidth($ticketId);
        $this->_pdf->Text(($pageWidth - $titleWidth) / 2, $ticketIdY, $ticketId);

        // draw title

        $this->_pdf->SetFont('Arial', '', $fontSizeTitle);

        $this->_pdf->SetXY(0.0, $ticketTitleY);
        $this->_pdf->MultiCell($pageWidth, $ticketTitleLineHeight, $ticketTitle, 0.0, 'C');

        // draw type



        // draw estimation


    }

    public function exportPdf()
    {
        $this->_pdf->Output('F', $this->_pdfFileName);

        Controller_TicketTool::DEBUG_LOG('Successfully created pdf file <b>[' . $this->_pdfFileName . ']</b>');
        Controller_TicketTool::DEBUG_LOG('<hr>', false);
    }

}