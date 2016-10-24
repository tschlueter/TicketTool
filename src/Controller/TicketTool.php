<?php
/**
 * A tool for printing tickets.
 *
 * TODO ASAP Print ticket type and ticket estimation.
 * TODO ASAP Refactor
 * TODO ASAP Implement XML import.
 * TODO HIGH Revise all refactoring TODOs.
 * TODO HIGH Handle long titles with excessed lengths.
 * TODO HIGH Increase QR-Code image size.
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
        if (Controller_Setting::DEBUG_ENABLE_LOGS) echo 'BAHAG JIRA TicketTool v.' . Controller_Setting::VERSION . '<br><br><hr><br>';

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
        if (Controller_Setting::DEBUG_ENABLE_LOGS) echo 'Picked ticket [<b>' . $ticket->getId() . '</b>]<br>with title [<b>' . $ticket->getTitle() . '</b>]<br><br><hr><br>';

        // create qr code as png image TODO refactor to QR Service class

        //$ticketUrl = self::JIRA_BASE_URL . '/browse/' . $ticket->getId();
        $imageFileName  = 'out/tmp/tempQrImage.png';

        QRcode::png(
            $ticket->getId(),
            $imageFileName,
            QR_ECLEVEL_L,
            Controller_Setting::QR_IMAGE_SIZE,
            Controller_Setting::QR_IMAGE_MARGIN
        );

        if (Controller_Setting::DEBUG_ENABLE_LOGS) echo 'Successfully created QR code:<br><br>';
        if (Controller_Setting::DEBUG_ENABLE_LOGS) echo '<img src="' . $imageFileName . '" style="border: 0px solid #a0a0a0;"><br><br><hr><br>';

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

        if (Controller_Setting::DEBUG_ENABLE_LOGS) echo 'Done.<br><br>';
    }

}