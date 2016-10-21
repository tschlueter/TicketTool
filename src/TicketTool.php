<?php

/**
 * A tool for printing tickets.
 */
class TicketTool
{

    /**
     * @var string
     */
    const JIRA_BASE_URL = "https://bdc.bahag.com";

    /**
     * @var string
     */
    public static $user = null;

    /**
     * @var string
     */
    public static $pass = null;

    /**
     * @var string
     */
    public static $ticket = null;

    /**
     * The application's entry point.
     */
    public static function main()
    {
        echo 'Welcome!<br><br>';

        self::$user   = $_GET['user'];
        self::$pass   = $_GET['pass'];
        self::$ticket = $_GET['ticket'];

        JiraTicketImporter::test(self::$ticket);









    }

}