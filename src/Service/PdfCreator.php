<?php
/**
 * Manages PDF generation.
 */
class Service_PdfCreator
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
        $this->_pdf->AddPage();

        if (Controller_Setting::PDF_DRAW_BORDER) {
            $this->_drawBorder();
        }

        $this->_drawImage($imageFileName);
        $this->_drawTicketId($ticketId);
        $this->_drawTicketTitle($ticketTitle);
        $this->_drawTicketType($ticketType);
        $this->_drawTicketEstimation($ticketEstimation);
    }

    /**
     * Saves the generated PDF to disk.
     */
    public function createAndSavePdf()
    {
        $this->_pdf->Output('F', $this->_pdfFileName);

        Controller_TicketTool::DEBUG_LOG('Successfully created pdf file <b>[<a href="' . $this->_pdfFileName . '" target="_blank">' . $this->_pdfFileName . '</a>]</b>');
        Controller_TicketTool::DEBUG_LOG('<hr>', false);
    }

    /**
     * Draws a border around the page.
     */
    private function _drawBorder()
    {
        $this->_pdf->Rect(
            Controller_Setting::PDF_RECT_BORDER_X,
            Controller_Setting::PDF_RECT_BORDER_Y,
            $this->_pdf->GetPageWidth()  - 2 * Controller_Setting::PDF_RECT_BORDER_X,
            $this->_pdf->GetPageHeight() - 2 * Controller_Setting::PDF_RECT_BORDER_Y
        );
    }

    /**
     * Draws the QR code image.
     *
     * @param string $imageFileName
     */
    private function _drawImage($imageFileName)
    {
        $this->_pdf->SetXY(0.0, 0.0);
        $imageSize = getimagesize($imageFileName);
        $this->_pdf->Image(
            $imageFileName,
            ($this->_pdf->GetPageWidth() - $imageSize[0]) / 2,
            Controller_Setting::PDF_OFFSET_IMAGE_Y,
            $imageSize[0],
            $imageSize[1]
        );
    }

    /**
     * Draws the ticket ID as the headline of the PDF.
     *
     * @param string $ticketId
     */
    private function _drawTicketId($ticketId)
    {
        $this->_pdf->SetXY(0.0, 0.0);
        $this->_pdf->SetFont(Controller_Setting::PDF_FONT_FACE, 'B', Controller_Setting::PDF_FONT_SIZE_ID);
        $titleWidth = $this->_pdf->GetStringWidth($ticketId);
        $this->_pdf->Text(
            ($this->_pdf->GetPageWidth() - $titleWidth) / 2,
            ($this->_pdf->GetPageHeight() / 2) + Controller_Setting::PDF_OFFSET_TICKET_ID_Y,
            $ticketId
        );
    }

    /**
     * Draws the ticket title as the content text of the PDF.
     *
     * @param string $ticketTitle
     */
    private function _drawTicketTitle($ticketTitle)
    {
        $this->_pdf->SetXY(0.0, ($this->_pdf->GetPageHeight() / 2) + Controller_Setting::PDF_OFFSET_TICKET_TITLE_Y);
        $this->_pdf->SetFont(Controller_Setting::PDF_FONT_FACE, '', Controller_Setting::PDF_FONT_SIZE_TITLE);
        $this->_pdf->MultiCell($this->_pdf->GetPageWidth(), Controller_Setting::PDF_TICKET_TITLE_BLOCK_HEIGHT, $ticketTitle, 0.0, 'C');
    }

    /**
     * Draws the ticket type into the PDF.
     *
     * @param string $ticketType
     */
    private function _drawTicketType($ticketType)
    {
        $this->_pdf->SetXY(0.0, 0.0);
        $this->_pdf->SetFont(Controller_Setting::PDF_FONT_FACE, '', Controller_Setting::PDF_FONT_SIZE_DETAILS);
        //$titleWidth = $this->_pdf->GetStringWidth($ticketId);
        $this->_pdf->Text(Controller_Setting::PDF_TEXT_BORDER_X, $this->_pdf->GetPageHeight() - Controller_Setting::PDF_TEXT_BORDER_Y, $ticketType);
    }

    /**
     * Draws the ticket estimation into the PDF.
     *
     * @param string $ticketEstimation
     */
    private function _drawTicketEstimation($ticketEstimation)
    {
        // draw estimation
        $this->_pdf->SetXY(0.0, 0.0);
        $this->_pdf->SetFont(Controller_Setting::PDF_FONT_FACE, '', Controller_Setting::PDF_FONT_SIZE_DETAILS);
        $estimationWidth = $this->_pdf->GetStringWidth($ticketEstimation);
        $this->_pdf->Text(
            $this->_pdf->GetPageWidth() - Controller_Setting::PDF_TEXT_BORDER_X - $estimationWidth,
            $this->_pdf->GetPageHeight() - Controller_Setting::PDF_TEXT_BORDER_Y,
            $ticketEstimation
        );
    }

}