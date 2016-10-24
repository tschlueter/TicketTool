<?php
/**
 * Manages PDF generation.
 */
class Service_PdfExporter
{

    const RECT_BORDER_X             = 0.0;
    const RECT_BORDER_Y             = 0.0;

    const TEXT_BORDER_X             = 10.0;
    const TEXT_BORDER_Y             = 10.0;

    const FONT_FACE                 = 'Arial';

    const FONT_SIZE_ID              = 27.5;
    const FONT_SIZE_TITLE           = 22.5;
    const FONT_SIZE_DETAILS         = 12.5;

    const TICKET_TITLE_BLOCK_HEIGHT = 30.0;
    const OFFSET_IMAGE_Y            = 20.0;

    const OFFSET_TICKET_ID_Y        = 15.0;
    const OFFSET_TICKET_TITLE_Y     = 30.0;

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
        $this->_pdf->AddPage();




        //draw border
        $this->_pdf->Rect(
            self::RECT_BORDER_X,
            self::RECT_BORDER_Y,
            $this->_pdf->GetPageWidth()  - 2 * self::RECT_BORDER_X,
            $this->_pdf->GetPageHeight() - 2 * self::RECT_BORDER_Y
        );


        // draw image
        $this->_pdf->SetXY(0.0, 0.0);
        $imageSize = getimagesize($imageFileName);
        $this->_pdf->Image(
            $imageFileName,
            ($this->_pdf->GetPageWidth() - $imageSize[0]) / 2,
            self::OFFSET_IMAGE_Y,
            $imageSize[0],
            $imageSize[1]
        );

        // draw ID
        $this->_pdf->SetXY(0.0, 0.0);
        $this->_pdf->SetFont(self::FONT_FACE, 'B', self::FONT_SIZE_ID);
        $titleWidth = $this->_pdf->GetStringWidth($ticketId);
        $this->_pdf->Text(
            ($this->_pdf->GetPageWidth() - $titleWidth) / 2,
            ($this->_pdf->GetPageHeight() / 2) + self::OFFSET_TICKET_ID_Y,
            $ticketId
        );

        // draw title
        $this->_pdf->SetXY(0.0, ($this->_pdf->GetPageHeight() / 2) + self::OFFSET_TICKET_TITLE_Y);
        $this->_pdf->SetFont(self::FONT_FACE, '', self::FONT_SIZE_TITLE);
        $this->_pdf->MultiCell($this->_pdf->GetPageWidth(), self::TICKET_TITLE_BLOCK_HEIGHT, $ticketTitle, 0.0, 'C');

        // draw type
        $this->_pdf->SetXY(0.0, 0.0);
        $this->_pdf->SetFont(self::FONT_FACE, '', self::FONT_SIZE_DETAILS);
        //$titleWidth = $this->_pdf->GetStringWidth($ticketId);
        $this->_pdf->Text(self::TEXT_BORDER_X, $this->_pdf->GetPageHeight() - self::TEXT_BORDER_Y, $ticketType);

        // draw estimation
        $this->_pdf->SetXY(0.0, 0.0);
        $this->_pdf->SetFont(self::FONT_FACE, '', self::FONT_SIZE_DETAILS);
        $estimationWidth = $this->_pdf->GetStringWidth($ticketEstimation);
        $this->_pdf->Text(
            $this->_pdf->GetPageWidth() - self::TEXT_BORDER_X - $estimationWidth,
            $this->_pdf->GetPageHeight() - self::TEXT_BORDER_Y,
            $ticketEstimation
        );
    }

    /**
     * Saves the generated PDF to disk.
     */
    public function exportPdf()
    {
        $this->_pdf->Output('F', $this->_pdfFileName);

        Controller_TicketTool::DEBUG_LOG('Successfully created pdf file <b>[<a href="' . $this->_pdfFileName . '" target="_blank">' . $this->_pdfFileName . '</a>]</b>');
        Controller_TicketTool::DEBUG_LOG('<hr>', false);
    }

}