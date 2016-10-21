<?php
/**
 * A tool for printing tickets.
 */
class Controller_TicketTool
{

    const VERSION = '1.0';

    const JIRA_BASE_URL = 'https://bdc.bahag.com';

    /**
     * The application's entry point.
     */
    public static function main()
    {
        echo 'BAHAG JIRA TicketTool v.' . self::VERSION . '<br><br>';

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
        echo 'Picked ticket [' . $ticket->getId() . '] with title [' . $ticket->getTitle() . ']<br><br>';

        // create qr code as png image
        $ticketUrl = self::JIRA_BASE_URL . '/browse/' . $ticket->getId();
        $fileName  = 'filename.png';
        QRcode::png(
            $ticketUrl,
            $fileName
        );

        echo 'Successfully created QR code.<br><br>';
        echo '<img src="' . $fileName . '">';



    }

}