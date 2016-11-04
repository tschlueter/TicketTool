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
     * @var Service_PdfCreator
     */
    private $_pdfExportService;

    /**
     * @param string $user
     * @param string $pass
     */
    public function __construct($user, $pass)
    {
        $this->_user = $user;
        $this->_pass = $pass;
    }

    /**
     * @return void
     */
    public function run()
    {
        $this->_createOutputDirectories();

        //$this->_testSmarty();

        $ticketIds = Service_JiraXmlTicketParser::parseTicketIds(
            Controller_Setting::PATH_IN_XML
        );

        $this->_streamAndExportTickets($ticketIds);
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
     */
    private function _streamAndExportTickets($ticketIds)
    {
        $this->_pdfExportService = new Service_PdfCreator(date('Y_m_d_H-i-s'));

        foreach ($ticketIds as $ticketId) {
            $this->_streamAndExportTicket($ticketId);
        }

        $this->_pdfExportService->createAndSavePdf();

        Controller_TicketTool::DEBUG_LOG(
            'Successfully created pdf file [<a href="' . $this->_pdfExportService->getFileName() . '" target="_blank">'
            . $this->_pdfExportService->getFileName()
            . '</a>]'
        );

        Controller_TicketTool::DEBUG_LOG();
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
            $this->_pass
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

    /**
     * Tests the smarty template engine.
     */
    private function _testSmarty()
    {
        // create object
        $smarty = new Smarty;

        $smarty->setTemplateDir('res/smarty/template'  );
        $smarty->setCompileDir( 'res/smarty/template_c');

        // assign some content. This would typically come from
        // a database or other source, but we'll use static
        // values for the purpose of this example.
        $smarty->assign('name', 'george smith');
        $smarty->assign('address', '45th & Harris');

        // display it
        $smarty->display('default/index.tpl');
    }

}