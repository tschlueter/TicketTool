<?php
/**
 * A tool for printing tickets.
 */
class Controller_TicketTool
{

    /**
     * @var string
     */
    const JIRA_BASE_URL = "https://bdc.bahag.com";

    /**
     * The application's entry point.
     */
    public static function main()
    {
        echo 'Welcome to the TicketTool!<br><br>';

        $ticket = (array_key_exists('ticket', $_GET) ? $_GET['ticket'] : null);
        $user   = (array_key_exists('user',   $_GET) ? $_GET['user']   : null);
        $pass   = (array_key_exists('pass',   $_GET) ? $_GET['pass']   : null);

        if (
                $ticket == null
            ||  $user   == null
            ||  $pass   == null
        ) {
            die('Please specify GET-Parameters [ticket][user][pass] for the tool to operate.');
        }

        $ticket = Service_JiraTicketImporter::get(
            $ticket,
            $user,
            $pass
        );



    }

}