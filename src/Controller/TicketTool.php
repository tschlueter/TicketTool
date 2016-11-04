<?php
/**
 * A tool for printing tickets.
 *
 * TODO ASAP Outsource TicketTool controller class and all it's functionality into a service.
 * TODO ASAP Disable temporary generated image files after PDF creation.
 * TODO ASAP Group all dirs to settings class.
 * TODO ASAP Enable CLI support.
 *
 * TODO ASAP Improve workflow (Enable URL of XMl in frontend etc.)?.
 * TODO ASAP Add '...' after the n-th line if it exceeds the maximum length.
 * TODO ASAP Enable single or multiple ticket print support.
 * TODO ASAP Create webservice that invoked the tool?
 * TODO ASAP Create user-story.
 * TODO LOW  Add PHP-Doc.
 * TODO HIGH Package app to one .phar. Enable .phar on webserver?
 * TODO ASAP Implement AJAX requests for life console logging.
 * TODO ASAP Add TypeScript for JS generation.
 * TODO ASAP Add SASS for css generation.
 * TODO ASAP Implement templating engine ('Smarty') for phtml files?
 * TODO ASAP Fancy UI for uploading XML (jQuery).
 * TODO LOW  Use COMPOSER for loading libs and class autoloading (Symfony component!)
 * TODO LOW  Remove project to private Git Repo!
 * TODO WEAK No need to stream Tickets because all information are stored in the input XML!
 * TODO WEAK Add favicon.
 */
class Controller_TicketTool
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
     * The application's entry point.
     */
    public function run()
    {
        Controller_TicketTool::DEBUG_LOG('BAHAG JIRA TicketTool v.' . Controller_Setting::VERSION);
        Controller_TicketTool::DEBUG_LOG('<hr>', false);

        //$this->_testSmarty();

        $this->_parseUrlParameters();
        $this->_createOutputDirectories();

        $ticketIds = Service_JiraXmlTicketParser::parseTicketIds(
            Controller_Setting::PATH_IN_XML . DIRECTORY_SEPARATOR . 'SearchRequest.xml'
        );

        $this->_streamAndExportTickets($ticketIds);

        Controller_TicketTool::DEBUG_LOG('Done.');
    }

    /**
     * Logs the specified message to the frontend output.
     *
     * @param string  $msg
     * @param boolean $appendLineBreak
     */
    public static function DEBUG_LOG($msg, $appendLineBreak = true)
    {
        if (Controller_Setting::DEBUG_ENABLE_LOGS)
        {
            echo $msg . ($appendLineBreak ? '<br>' : '');
        }
    }

    /**
     * Parses url parameters 'user' and 'pass'.
     * Quits the program if one of them are missing.
     */
    private function _parseUrlParameters()
    {
        $this->_user = (array_key_exists('user', $_GET) ? $_GET['user'] : null);
        $this->_pass = (array_key_exists('pass', $_GET) ? $_GET['pass'] : null);

        if (
                $this->_user == null
            ||  $this->_pass == null
        ) {
            die('Please specify GET-Parameters [user][pass] with the JIRA credentials for the tool to operate.');
        }
    }

    /**
     * Creates all output directories 'tmp' and 'pdf' recursively.
     */
    private function _createOutputDirectories()
    {
        // create output directories
        @mkdir(Controller_Setting::PATH_OUT_PDF, 0777, true);
        @mkdir(Controller_Setting::PATH_OUT_TMP, 0777, true);
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
    }

    /**
     * Streams all required information for the given ticket-ID, creates the QR-code and assembles the PDF.
     *
     * @param string $ticketId
     */
    private function _streamAndExportTicket($ticketId)
    {
        // pick ticket
        $ticket = Service_JiraTicketImporter::get(
            $ticketId,
            $this->_user,
            $this->_pass
        );
        Controller_TicketTool::DEBUG_LOG(
            'Picked JIRA ticket id [<b>' . $ticket->getId()         . '</b>]'
            . ' title              [<b>' . $ticket->getTitle()      . '</b>]'
            . ' issue type         [<b>' . $ticket->getType()       . '</b>]'
            . ' estimation         [<b>' . $ticket->getEstimation() . '</b>]'
        );

        // create qr code as png image
        $imageFileName = Controller_Setting::PATH_OUT_TMP . 'qr_code_' . $ticketId . '.png';
        QRcode::png(
            $ticket->getId(),
            $imageFileName,
            QR_ECLEVEL_L,
            Controller_Setting::QR_IMAGE_SIZE,
            Controller_Setting::QR_IMAGE_MARGIN
        );
        Controller_TicketTool::DEBUG_LOG('Successfully created QR code.');

        // export ticket information in LaTeX format
        if (Controller_Setting::DEBUG_TEST_LATEX) {
            Service_LatexCreator::test();
        }

        // export ticket information in pdf format
        $this->_pdfExportService->createPage(
            utf8_decode($ticket->getId()),
            utf8_decode($ticket->getTitle()),
            utf8_decode($ticket->getType()),
            utf8_decode($ticket->getEstimation()),
            $imageFileName
        );

        Controller_TicketTool::DEBUG_LOG('Successfully created PDF page.');
        Controller_TicketTool::DEBUG_LOG('<hr>', false);
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