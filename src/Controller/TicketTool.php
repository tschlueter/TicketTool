<?php
/**
 * The main controller for the TicketTools.
 * Also contains the ticket list.
 *
 * Pairing Tickets:
 *
 * TODO ASAP Add SASS for css generation.
 * TODO ASAP Create unit tests.
 * TODO ASAP Refactor Service_JiraTicketImporter to non-static functionality.
 *
 * Single tickets:
 *
 * TODO ASAP Fancy UI for uploading XML (jQuery).
 * TODO ASAP Enable XML upload field in frontend!
 * TODO ASAP Implement AJAX requests for life console logging.
 * TODO ASAP Add TypeScript for JS generation.
 * TODO ASAP Tool is inoperative if only one single ticket is exported! Fix this!
 * TODO ASAP Implement TS for javascript tasks.
 * TODO ASAP Reset repository.
 * TODO ASAP Use COMPOSER for loading libs and class autoloading (Symfony component!)
 * TODO ASAP Improve workflow (Enable URL of XMl in frontend etc.)?.
 * TODO ASAP Enable single or multiple ticket print support.
 * TODO ASAP Create user-stories how to use it!.
 * TODO ASAP Enable text input fields for several ticket numbers!
 * TODO ASAP Add PHP-Doc and script for its generation.
 * TODO ASAP Make frontend 3D and responsive?
 * TODO ASAP Create webservice that invokes the tool?
 * TODO ASAP Move project to private Git Repo?
 * TODO ASAP Create Wiki page.
 * TODO ASAP No need to stream Tickets because all information are stored in the input XML!
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

        $params    = $this->_parseCredentialsFromSettingsFile();
        $ticketIds = Service_JiraXmlTicketParser::parseTicketIds(Controller_Setting::PATH_IN_XML);

        $this->_createAndRunTicketToolService($params, true, $ticketIds);

        Controller_TicketTool::DEBUG_LOG('Done.');
    }

    /**
     * Runs the WEB version of the Ticket Tool.
     */
    private function _runWebVersion()
    {
        $action = (
            array_key_exists('action', $_POST)
            ? $_POST['action']
            : Controller_Setting::ACTION_ID_SHOW_UPLOAD_FORM
        );

        $webFrontendView = new View_WebFrontend();

        switch ($action) {
            case Controller_Setting::ACTION_ID_SHOW_UPLOAD_FORM:
                $webFrontendView->showUploadForm();
                break;

            case Controller_Setting::ACTION_ID_CREATE_PDF_FROM_TICKET_IDS:

                $webFrontendView->showGenerationPage(
                    'Dynamic Smarty output'
                );

                self::DEBUG_LOG('<pre>');
                $params    = $this->_parseCredentialsFromSettingsFile();
                $ticketIds = Service_JiraXmlTicketParser::parseTicketIds(Controller_Setting::PATH_IN_XML);
                $this->_createAndRunTicketToolService($params, false, $ticketIds);
                self::DEBUG_LOG('</pre>');

                break;

            case Controller_Setting::ACTION_ID_CREATE_PDF_FROM_XML:

                $webFrontendView->showGenerationPage(
                    'Dynamic Smarty output'
                );

                self::DEBUG_LOG('<pre>');
                $params    = $this->_parseCredentialsFromSettingsFile();
                $ticketIds = Service_JiraXmlTicketParser::parseTicketIds(Controller_Setting::PATH_IN_XML);
                $this->_createAndRunTicketToolService($params, false, $ticketIds);
                self::DEBUG_LOG('</pre>');

                break;
        }
    }

    /**
     * @param array    $params
     * @param boolean  $cliRequest
     * @param string[] $ticketIds
     */
    private function _createAndRunTicketToolService($params, $cliRequest, $ticketIds)
    {
        $this->_ticketToolService = new Service_TicketTool(
            $params['user'],
            $params['pass'],
            $params['jiraBaseUrl'],
            $cliRequest
        );
        $this->_ticketToolService->run($ticketIds);
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
        $jira  = $settings->jira;

        $user         = $credentials->user;
        $pass         = $credentials->pass;
        $jiraBaseUrl  = $jira->baseUrl;

        if ($user == null || $pass == null || $jiraBaseUrl == null) {
            die('Invalid config.');
        }

        return array(
            'user' => $user,
            'pass' => $pass,
            'jiraBaseUrl' => $jiraBaseUrl,
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
        if (Controller_Setting::$DEBUG_ENABLE_LOGS)
        {
            echo $msg . "\n";
        }
    }

}