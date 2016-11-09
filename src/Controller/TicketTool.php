<?php
/**
 * A tool for printing tickets.
 *
 * TODO ASAP Tool is inoperative if only one single ticket is exported! Fix this!
 * TODO ASAP als anregung: kannst du die überschrift noch einen hauch größer machen und die andere schrift noch fett?
 * TODO ASAP Reset repository.
 * TODO ASAP Use COMPOSER for loading libs and class autoloading (Symfony component!)
 * TODO ASAP Fancy UI for uploading XML (jQuery).
 * TODO ASAP Implement templating engine ('Smarty') for phtml files?
 * TODO ASAP Improve workflow (Enable URL of XMl in frontend etc.)?.
 * TODO ASAP Enable single or multiple ticket print support.
 * TODO ASAP Create user-stories how to use it!.
 * TODO ASAP Enable text input fields for several ticket numbers!
 * TODO ASAP Enable XML upload field in frontend!
 * TODO HIGH Implement AJAX requests for life console logging.
 * TODO INIT Add TypeScript for JS generation.
 * TODO INIT Add SASS for css generation.
 * TODO INIT Make frontend 3D and responsive?
 * TODO LOW  Create webservice that invokes the tool?
 * TODO LOW  Move project to private Git Repo?
 * TODO LOW  Add PHP-Doc and script for its generation.
 * TODO LOW  Create Wiki page.
 * TODO WEAK No need to stream Tickets because all information are stored in the input XML!
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
        Controller_TicketTool::DEBUG_LOG();
        $this->_outputAsciiLogo();
        Controller_TicketTool::DEBUG_LOG(Controller_Setting::TITLE . ', CLI-edition, v.' . Controller_Setting::VERSION);

        $params = $this->_parseCredentialsFromSettingsFile();
        $this->_createAndRunTicketToolService($params, true);

        Controller_TicketTool::DEBUG_LOG('Done.');
    }

    /**
     * Runs the WEB version of the Ticket Tool.
     */
    private function _runWebVersion()
    {
        $title = Controller_Setting::TITLE . ', WEB-edition, v.' . Controller_Setting::VERSION;

        Controller_TicketTool::DEBUG_LOG('<html>');
        Controller_TicketTool::DEBUG_LOG('<head>');
        Controller_TicketTool::DEBUG_LOG('<title>' .  $title . '</title>');
        Controller_TicketTool::DEBUG_LOG('<meta charset="utf-8" />');
        Controller_TicketTool::DEBUG_LOG('<link rel="icon"          href="favicon.ico" type="image/x-icon" />');
        Controller_TicketTool::DEBUG_LOG('<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />');
        Controller_TicketTool::DEBUG_LOG('</head>');
        Controller_TicketTool::DEBUG_LOG('<body>');
        Controller_TicketTool::DEBUG_LOG('<pre>');
        $this->_outputAsciiLogo();
        Controller_TicketTool::DEBUG_LOG($title);
        Controller_TicketTool::DEBUG_LOG();

        $params = $this->_parseCredentialsFromSettingsFile();
        $this->_createAndRunTicketToolService($params, false);

        Controller_TicketTool::DEBUG_LOG('Done.');
        Controller_TicketTool::DEBUG_LOG('</pre>');
        Controller_TicketTool::DEBUG_LOG('</body>');
        Controller_TicketTool::DEBUG_LOG('</html>');
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
     * Parses the JIRA credentials from the external json settings file.
     *
     * @return array
     */
    private function _parseCredentialsFromSettingsFile()
    {
        $settingsFile = Controller_Setting::PATH_IN_SETTINGS;

        if (!file_exists($settingsFile)) {
            die('Please specify the json settings file containing your JIRA credentials in the input directory.');
        }

        $settingsJson = file_get_contents($settingsFile);
        $settings     = json_decode($settingsJson);

        $credentials  = $settings->credentials;

        $user         = $credentials->user;
        $pass         = $credentials->pass;

        if ($user == null || $pass == null) {
            die('Please specify "user" and "pass" properties in the json "credentials" object.');
        }

        return array(
            'user' => $user,
            'pass' => $pass,
        );
    }

    /**
     * Streams external resource containing the logo in ASCII art and outputs it to the console.
     *
     * @return void
     */
    private static function _outputAsciiLogo()
    {
        $asciiLogo = file_get_contents(Controller_Setting::PATH_RES_TXT . DIRECTORY_SEPARATOR . 'logo.txt');

        Controller_TicketTool::DEBUG_LOG($asciiLogo);
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