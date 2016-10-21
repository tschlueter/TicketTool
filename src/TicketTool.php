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

        self::$ticket = $_GET['ticket'];
        self::$user   = $_GET['user'];
        self::$pass   = $_GET['pass'];

        JiraTicketImporter::test(
            self::$ticket,
            self::$user,
            self::$pass
        );




    }

}