<?php
/**
 * A tool for printing tickets.
 *
 * TODO ASAP Implement XML import.
 * TODO ASAP Modern templating engine for phtml file?
 * TODO ASAP Fancy UI for uploading XML.
 * TODO HIGH Handle long titles with excessed lengths.
 * TODO HIGH Improve setting/centering for all objects in the PDF.
 * TODO INIT Increase QR-Code image size.
 * TODO LOW  Settings switch for border drawing?
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
     * @var Service_PdfExport
     */
    private $_pdfExportService;

    /**
     * The unchanged default constructor.
     */
    public function __construct()
    {
    }

    /**
     * The application's entry point.
     */
    public function run()
    {
        Controller_TicketTool::DEBUG_LOG('BAHAG JIRA TicketTool v.' . Controller_Setting::VERSION);
        Controller_TicketTool::DEBUG_LOG('<hr>', false);



        // TODO implement fancy XML upload button
        $ticketId = (array_key_exists('ticket', $_GET) ? $_GET['ticket'] : null);



        $this->_parseUrlParameters();
        $this->_createOutputDirectories();

        $this->_pdfExportService = new Service_PdfExport(date('Y_m_d_H-i-s'));

        for ($i = 0; $i < 10; $i++) {
            $this->_streamAndExportTicket($ticketId);
        }

        $this->_pdfExportService->createAndSavePdf();

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
            'ticket        [<b>' . $ticket->getId()         . '</b>]<br>'
            . 'title       [<b>' . $ticket->getTitle()      . '</b>]<br>'
            . 'issue type  [<b>' . $ticket->getType()       . '</b>]<br>'
            . 'estimation  [<b>' . $ticket->getEstimation() . '</b>]'
        );
        Controller_TicketTool::DEBUG_LOG('<hr>', false);

        // create qr code as png image
        $imageFileName = Controller_Setting::PATH_OUT_TMP . 'tempQrImage.png';
        QRcode::png(
            $ticket->getId(),
            $imageFileName,
            QR_ECLEVEL_L,
            Controller_Setting::QR_IMAGE_SIZE,
            Controller_Setting::QR_IMAGE_MARGIN
        );
        Controller_TicketTool::DEBUG_LOG('Successfully created QR code:');
        Controller_TicketTool::DEBUG_LOG('<img src="' . $imageFileName . '" style="border: 0px solid #a0a0a0;">');
        Controller_TicketTool::DEBUG_LOG('<hr>', false);

        // export ticket information in LaTeX format
        if (Controller_Setting::DEBUG_TEST_LATEX) {
            Service_LatexCreator::test();
        }

        // export ticket information in pdf format
        $this->_pdfExportService->createPage(
            $ticket->getId(),
            $ticket->getTitle(),
            $ticket->getType(),
            $ticket->getEstimation(),
            $imageFileName
        );
    }

}