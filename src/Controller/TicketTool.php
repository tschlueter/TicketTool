<?php
/**
 * A tool for printing tickets.
 *
 * TODO ASAP Enable CLI support.
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
     * @var Service_TicketTool
     */
    private $_ticketToolService;

    /**
     * The application's entry point.
     */
    public function run()
    {
        Controller_TicketTool::DEBUG_LOG('BAHAG JIRA TicketTool v.' . Controller_Setting::VERSION);
        Controller_TicketTool::DEBUG_LOG('<hr>', false);

        $params = $this->_parseUrlParameters();

        $this->_ticketToolService = new Service_TicketTool(
            $params['user'],
            $params['pass']
        );
        $this->_ticketToolService->run();
    }

    /**
     * Parses url parameters 'user' and 'pass'.
     * Quits the program if one of them are missing.
     *
     * @return array
     */
    private function _parseUrlParameters()
    {
        $user = (array_key_exists('user', $_GET) ? $_GET['user'] : null);
        $pass = (array_key_exists('pass', $_GET) ? $_GET['pass'] : null);

        if (
                $user == null
            ||  $pass == null
        ) {
            die('Please specify GET-Parameters [user][pass] with your JIRA credentials for the tool to operate.');
        }

        return array(
            'user' => $user,
            'pass' => $pass,
        );
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