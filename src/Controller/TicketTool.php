<?php
/**
 * A tool for printing tickets.
 *
 * TODO ASAP Revise all refactoring TODOs.
 * TODO ASAP Print ticket type and ticket estimation.
 * TODO ASAP Implement XML import.
 * TODO HIGH Handle long titles with excessed lengths.
 * TODO HIGH Increase QR-Code image size.
 * TODO INIT Refactor
 * TODO INIT Implement cut marks?
 * TODO LOW  Settings switch for border drawing?
 */
class Controller_TicketTool
{

    /**
     * The application's entry point.
     */
    public static function main()
    {
        Controller_TicketTool::DEBUG_LOG('BAHAG JIRA TicketTool v.' . Controller_Setting::VERSION);
        Controller_TicketTool::DEBUG_LOG('<hr>', false);

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
        Controller_TicketTool::DEBUG_LOG(
            'ticket        [<b>' . $ticket->getId()         . '</b>]<br>'
            . 'title       [<b>' . $ticket->getTitle()      . '</b>]<br>'
            . 'issue type  [<b>' . $ticket->getType()       . '</b>]<br>'
            . 'estimation  [<b>' . $ticket->getEstimation() . '</b>]'
        );
        Controller_TicketTool::DEBUG_LOG('<hr>', false);

        // create qr code as png image TODO refactor to QR Service class

        // TODO extract all output paths to constants!

        $imageFileName  = 'out/tmp/tempQrImage.png';

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

        // export primal information in LaTeX format
        if (Controller_Setting::DEBUG_TEST_LATEX) {
            Service_LatexCreator::test();
        }

        // export primal information in pdf format
        $pdfCreator = new Service_PdfCreator();
        $pdfCreator->export(
            $ticket->getId(),
            $ticket->getTitle(),
            $imageFileName
        );

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

}