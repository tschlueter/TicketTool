<?php
/**
 * A tool for printing tickets.
 */
class Controller_TicketTool
{

    const VERSION = '1.0';

    const JIRA_BASE_URL = 'https://bdc.bahag.com';

    const QR_IMAGE_SIZE = 6;

    const QR_IMAGE_MARGIN = 0;

    /**
     * The application's entry point.
     */
    public static function main()
    {
        echo 'BAHAG JIRA TicketTool v.' . self::VERSION . '<br><br><hr><br>';

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

        // pick ticket

        $ticket = Service_JiraTicketImporter::get(
            $ticketId,
            $user,
            $pass
        );
        echo 'Picked ticket [<b>' . $ticket->getId() . '</b>]<br>with title [<b>' . $ticket->getTitle() . '</b>]<br><br><hr><br>';

        // create qr code as png image TODO refactor to QR Service class

        //$ticketUrl = self::JIRA_BASE_URL . '/browse/' . $ticket->getId();
        $fileName  = 'out/tempQrImage.png';

        QRcode::png(
            $ticket->getId(),
            $fileName,
            QR_ECLEVEL_L,
            self::QR_IMAGE_SIZE,
            self::QR_IMAGE_MARGIN
        );

        echo 'Successfully created QR code:<br><br>';
        echo '<img src="' . $fileName . '" style="border: 0px solid #a0a0a0;"><br><br><hr><br>';

        // read png from file and close it afterwards

        $pngFile = imagecreatefrompng($fileName);
        imagedestroy($pngFile);

        // export primal information in LaTeX format
        Service_LatexCreator::test();








    }

}