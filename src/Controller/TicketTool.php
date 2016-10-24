<?php
/**
 * A tool for printing tickets.
 *
 * TODO ASAP Print ticket type and ticket estimation.
 * TODO ASAP Refactor
 * TODO ASAP Implement XML import.
 * TODO ASAP Extract constants to settings.
 * TODO ASAP Refactor to out/pdf
 * TODO ASAP Refactor to out/tmp
 * TODO HIGH Revise all refactoring TODOs.
 * TODO HIGH Handle long titles with excessed lengths.
 * TODO HIGH Größerer QR-Code.
 * TODO LOW  Border 0px ?
 */
class Controller_TicketTool
{

    const VERSION = '0.1a';

    const DEBUG_OUT = true;

    const TEST_LATEX = true;

    const JIRA_BASE_URL = 'https://bdc.bahag.com';

    const QR_IMAGE_SIZE = 6;

    const QR_IMAGE_MARGIN = 0;

    /**
     * The application's entry point.
     */
    public static function main()
    {
        if (self::DEBUG_OUT) echo 'BAHAG JIRA TicketTool v.' . self::VERSION . '<br><br><hr><br>';

        // browse parameters TODO extract to Parameters model class

        $ticketId = (array_key_exists('ticket', $_GET) ? $_GET['ticket'] : null);
        $user     = (array_key_exists('user',   $_GET) ? $_GET['user']   : null);
        $pass     = (array_key_exists('pass',   $_GET) ? $_GET['pass']   : null);

        if (
                $ticketId == null
            ||  $user     == null
            ||  $pass     == null
        ) {
            die('Please specify GET-Parameters [ticket][user][pass] for the tool to operate.');
        }

        // create output directories
        @mkdir('out/pdf', 0777, true);
        @mkdir('out/tmp', 0777, true);

        // pick ticket

        $ticket = Service_JiraTicketImporter::get(
            $ticketId,
            $user,
            $pass
        );
        if (self::DEBUG_OUT) echo 'Picked ticket [<b>' . $ticket->getId() . '</b>]<br>with title [<b>' . $ticket->getTitle() . '</b>]<br><br><hr><br>';

        // create qr code as png image TODO refactor to QR Service class

        //$ticketUrl = self::JIRA_BASE_URL . '/browse/' . $ticket->getId();
        $imageFileName  = 'out/tmp/tempQrImage.png';

        QRcode::png(
            $ticket->getId(),
            $imageFileName,
            QR_ECLEVEL_L,
            self::QR_IMAGE_SIZE,
            self::QR_IMAGE_MARGIN
        );

        if (self::DEBUG_OUT) echo 'Successfully created QR code:<br><br>';
        if (self::DEBUG_OUT) echo '<img src="' . $imageFileName . '" style="border: 0px solid #a0a0a0;"><br><br><hr><br>';

        // export primal information in LaTeX format
        if (self::TEST_LATEX) {
            Service_LatexCreator::test();
        }

        // export primal information in pdf format
        $pdfCreator = new Service_PdfCreator();
        $pdfCreator->export(
            $ticket->getId(),
            $ticket->getTitle(),
            $imageFileName
        );

        if (Controller_TicketTool::DEBUG_OUT) echo 'Done.<br><br>';
    }

}