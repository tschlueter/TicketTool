<?php
/**
 * The service that handles all TicketTool generation task.
 */
class Service_TicketTool
{

    /**
     * @var string The user name coming from the url.
     */
    private $_user;

    /**
     * @var string The password coming from the url.
     */
    private $_pass;

    /**
     * @var string The base url of the JIRA ticket system.
     */
    private $_jiraBaseUrl;

    /**
     * @var Service_PdfCreator
     */
    private $_pdfExportService;

    /**
     * @param string  $user
     * @param string  $pass
     * @param string  $jiraBaseUrl
     * @param boolean $cli
     */
    public function __construct($user, $pass, $jiraBaseUrl, $cli)
    {
        $this->_user        = $user;
        $this->_pass        = $pass;
        $this->_jiraBaseUrl = $jiraBaseUrl;
        $this->_cli         = $cli;
    }

    /**
     * @param string[] $ticketIds
     *
     * @return string
     */
    public function run($ticketIds)
    {
        $this->_createOutputDirectories();
        $pdfFilename = $this->_streamAndExportTickets($ticketIds);

        return $pdfFilename;
    }

    /**
     * Creates all output directories 'tmp' and 'pdf' recursively.
     */
    private function _createOutputDirectories()
    {
        @mkdir(Controller_Setting::PATH_OUT_PDF,       0777, true);
        @mkdir(Controller_Setting::PATH_OUT_TMP_LATEX, 0777, true);
        @mkdir(Controller_Setting::PATH_OUT_TMP_IMAGE, 0777, true);
    }

    /**
     * Performs batch processing for the given ticket-IDs.
     *
     * @param string[] $ticketIds
     *
     * @return string
     */
    private function _streamAndExportTickets($ticketIds)
    {
        $this->_pdfExportService = new Service_PdfCreator(date('Y_m_d_H-i-s'));

        foreach ($ticketIds as $ticketId) {
            $this->_streamAndExportTicket($ticketId);
        }

        $this->_pdfExportService->createAndSavePdf();

        if ($this->_cli) {
            Controller_TicketTool::DEBUG_LOG(
                'Successfully created pdf file [' . $this->_pdfExportService->getFileName() . ']'
            );
            Controller_TicketTool::DEBUG_LOG();
        }

        return '<a href="'
            . $this->_pdfExportService->getFileName()
            . '" target="_blank">'
            . basename($this->_pdfExportService->getFileName())
            . '</a>';
    }

    /**
     * Streams all required information for the given ticket-ID, creates the QR-code and assembles the PDF.
     *
     * @param string $ticketId
     */
    private function _streamAndExportTicket($ticketId)
    {
        $ticket = Service_JiraTicketImporter::get(
            $ticketId,
            $this->_user,
            $this->_pass,
            $this->_jiraBaseUrl
        );
        Controller_TicketTool::DEBUG_LOG(
            'Picked JIRA ticket id [' . $ticket->getId()         . ']'
            . ' title ['              . $ticket->getTitle()      . ']'
            . ' issue type ['         . $ticket->getType()       . ']'
            . ' estimation ['         . $ticket->getEstimation() . ']'
        );

        $imageFileName = Controller_Setting::PATH_OUT_TMP_IMAGE . 'qr_code_' . $ticketId . '.png';
        QRcode::png(
            $ticket->getId(),
            $imageFileName,
            QR_ECLEVEL_L,
            Controller_Setting::QR_IMAGE_SIZE,
            Controller_Setting::QR_IMAGE_MARGIN
        );
        Controller_TicketTool::DEBUG_LOG('Successfully created QR code.');

        if (Controller_Setting::DEBUG_TEST_LATEX) {
            Service_LatexCreator::test();
        }

        $this->_pdfExportService->createPage(
            utf8_decode($ticket->getId()),
            utf8_decode($ticket->getTitle()),
            utf8_decode($ticket->getType()),
            utf8_decode($ticket->getEstimation()),
            $imageFileName
        );

        Controller_TicketTool::DEBUG_LOG('Successfully created PDF page.');
        Controller_TicketTool::DEBUG_LOG();
    }

}