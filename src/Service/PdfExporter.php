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

        $fontFace               = 'Arial';

        $fontSizeId             = 27.5;
        $fontSizeTitle          = 22.5;
        $fontSizeDetails        = 12.5;

        $ticketTitleLineHeight  = 30.0;
        $distanceImageY         = 20.0;

        $offsetTicketIdY        = 15.0;
        $offsetTicketTitleY     = 30.0;




        $ticketIdY    = ( $this->_pdf->GetPageHeight() / 2 ) + $offsetTicketIdY;
        $ticketTitleY = ( $this->_pdf->GetPageHeight() / 2 ) + $offsetTicketTitleY;

        $this->_pdf->AddPage();

        $this->_pdf->Rect(
            $rectBorderX,
            $rectBorderY,
            $this->_pdf->GetPageWidth() - 2 * $rectBorderX,
            $this->_pdf->GetPageHeight() - 2 * $rectBorderY
        );


        // draw image
        $this->_pdf->SetXY(0.0, 0.0);
        $imageSize = getimagesize($imageFileName);
        $this->_pdf->Image(
            $imageFileName,
            ($this->_pdf->GetPageWidth() - $imageSize[0]) / 2,
            $distanceImageY,
            $imageSize[0],
            $imageSize[1]
        );

        // draw ID
        $this->_pdf->SetXY(0.0, 0.0);
        $this->_pdf->SetFont($fontFace, 'B', $fontSizeId);
        $titleWidth = $this->_pdf->GetStringWidth($ticketId);
        $this->_pdf->Text(($this->_pdf->GetPageWidth() - $titleWidth) / 2, $ticketIdY, $ticketId);

        // draw title
        $this->_pdf->SetXY(0.0, $ticketTitleY);
        $this->_pdf->SetFont($fontFace, '', $fontSizeTitle);
        $this->_pdf->MultiCell($this->_pdf->GetPageWidth(), $ticketTitleLineHeight, $ticketTitle, 0.0, 'C');

        // draw type
        $this->_pdf->SetXY(0.0, 0.0);
        $this->_pdf->SetFont($fontFace, '', $fontSizeDetails);
        //$titleWidth = $this->_pdf->GetStringWidth($ticketId);
        $this->_pdf->Text($textBorderX, $this->_pdf->GetPageHeight() - $textBorderY, $ticketType);

        // draw estimation
        $this->_pdf->SetXY(0.0, 0.0);
        $this->_pdf->SetFont($fontFace, '', $fontSizeDetails);
        $estimationWidth = $this->_pdf->GetStringWidth($ticketEstimation);
        $this->_pdf->Text(
            $this->_pdf->GetPageWidth() - $textBorderX - $estimationWidth,
            $this->_pdf->GetPageHeight() - $textBorderY,
            $ticketEstimation
        );
    }

    public function exportPdf()
    {
        $this->_pdf->Output('F', $this->_pdfFileName);

        Controller_TicketTool::DEBUG_LOG('Successfully created pdf file <b>[<a href="' . $this->_pdfFileName . '" target="_blank">' . $this->_pdfFileName . '</a>]</b>');
        Controller_TicketTool::DEBUG_LOG('<hr>', false);
    }

}