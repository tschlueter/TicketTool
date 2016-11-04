<?php
/**
 * A tool for printing tickets.
 *
 * TODO ASAP Fancy UI for uploading XML (jQuery).
 * TODO ASAP Improve workflow (Enable URL of XMl in frontend etc.)?.
 * TODO ASAP Enable single or multiple ticket print support.
 * TODO ASAP Create user-story.
 * TODO LOW  Add PHP-Doc.
 * TODO ASAP Implement AJAX requests for life console logging.
 * TODO ASAP Add TypeScript for JS generation.
 * TODO ASAP Add SASS for css generation.
 * TODO ASAP Implement templating engine ('Smarty') for phtml files?
 * TODO LOW Create webservice that invoked the tool?
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
        if (php_sapi_name() == 'cli') {
            $this->_runCliVersion();
        } else {
            $this->_runWebVersion();
        }
    }

    /**
     * Runs the CLI version of the Ticket Tool.
     */
    private function _runCliVersion()
    {
        Controller_TicketTool::DEBUG_LOG('BAHAG JIRA TicketTool, CLI-edition, v.' . Controller_Setting::VERSION);

        $params = $this->_parseCliArguments();
        $this->_createAndRunTicketToolService($params, true);

        Controller_TicketTool::DEBUG_LOG('Done.');
    }

    /**
     * Runs the WEB version of the Ticket Tool.
     */
    private function _runWebVersion()
    {
        Controller_TicketTool::DEBUG_LOG('<pre>');
        Controller_TicketTool::DEBUG_LOG('BAHAG JIRA TicketTool, WEB-edition, v.' . Controller_Setting::VERSION);
        Controller_TicketTool::DEBUG_LOG();

        $params = $this->_parseUrlParameters();
        $this->_createAndRunTicketToolService($params, false);

        Controller_TicketTool::DEBUG_LOG('Done.');
        Controller_TicketTool::DEBUG_LOG('</pre>');
    }

    /**
     * @param array   $params
     * @param boolean $cliRequest
     */
    private function _createAndRunTicketToolService($params, $cliRequest)
    {
        $this->_ticketToolService = new Service_TicketTool(
            $params['user'],
            $params['pass'],
            $cliRequest
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
        return $this->_parseParametersFromArray($_GET);
    }

    /**
     * Parses cli arguments 'user' and 'pass'.
     * Quits the program if one of them are missing.
     *
     * @return array
     */
    private function _parseCliArguments()
    {
        $args = getopt('', array('user:', 'pass:'));

        return $this->_parseParametersFromArray($args);
    }

    private function _parseParametersFromArray($array)
    {
        $user = (array_key_exists('user', $array) ? $array['user'] : null);
        $pass = (array_key_exists('pass', $array) ? $array['pass'] : null);

        if (
                $user == null
            ||  $pass == null
        ) {
            die('Please specify parameters [user][pass] with your JIRA credentials for the tool to operate.');
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
     */
    public static function DEBUG_LOG($msg = '')
    {
        if (Controller_Setting::DEBUG_ENABLE_LOGS)
        {
            echo $msg . "\n";
        }
    }

}