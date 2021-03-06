<?php
/**
 * The main controller for the TicketTools.
 * Also contains the ticket list.
 *
 * TODO HIGH Enable/FIX single or multiple ticket print support from XML.
 * TODO INIT Use COMPOSER for loading libs and class autoloading (Symfony component!)
 * TODO INIT Create user-stories how to use it!.
 * TODO LOW  Refactor Service_JiraTicketImporter to non-static functionality.
 * TODO LOW  Create unit tests.
 * TODO LOW  Add PHP-Doc and script for its generation.
 * TODO LOW  Create webservice that invokes the tool?
 * TODO LOW  Move project to private Git Repo?
 * TODO LOW  Create Wiki page.
 * TODO LOW  Implement AJAX requests for life console logging?
 * TODO LOW  Reset repository.
 * TODO WEAK Add TypeScript for JS generation.
 * TODO WEAK Add SASS for css generation?
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
        $asciiLogo = self::getAsciiLogo();

        Controller_TicketTool::DEBUG_LOG();
        Controller_TicketTool::DEBUG_LOG($asciiLogo);
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

                Controller_Setting::$DEBUG_ENABLE_LOGS = false;

                $output = '';

                $params = $this->_parseCredentialsFromSettingsFile();

                if (empty($_POST['ticketIds'])) {
                    $output = '<span style="color: #ff0000;">'
                        . 'Please enter one or more ticket-IDs'
                        . "\n"
                        . 'separated by commas.'
                        . '</span>';
                } else {
                    $ticketIds   = preg_split('/,/', $_POST['ticketIds']);
                    $pdfFilename = $this->_createAndRunTicketToolService($params, false, $ticketIds);
                    $output      = 'Your PDF has been generated<br><br>' . $pdfFilename;
                }

                $webFrontendView->showGenerationPage($output);

                break;

            case Controller_Setting::ACTION_ID_CREATE_PDF_FROM_XML:

                Controller_Setting::$DEBUG_ENABLE_LOGS = false;

                $output    = '';

                $params = $this->_parseCredentialsFromSettingsFile();

                if (empty($_FILES['xmlFile']['tmp_name'])) {
                    $output = '<span style="color: #ff0000;">'
                        . 'Please specify a Jira XML export file.'
                        . '</span>';
                } else {
                    rename($_FILES['xmlFile']['tmp_name'], Controller_Setting::PATH_IN_XML);
                    $ticketIds = Service_JiraXmlTicketParser::parseTicketIds(Controller_Setting::PATH_IN_XML);

                    $pdfFilename = $this->_createAndRunTicketToolService($params, false, $ticketIds);
                    $output      = 'Your PDF has been generated<br><br>' . $pdfFilename;
                }

                $webFrontendView->showGenerationPage($output);

                break;
        }
    }

    /**
     * @param array    $params
     * @param boolean  $cliRequest
     * @param string[] $ticketIds
     *
     * @return string The PDF filename as a clickable link.
     */
    public function _createAndRunTicketToolService($params, $cliRequest, $ticketIds)
    {
        $this->_ticketToolService = new Service_TicketTool(
            $params['user'],
            $params['pass'],
            $params['jiraBaseUrl'],
            $cliRequest
        );
        return $this->_ticketToolService->run($ticketIds);
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
            die('Please specify the json settings file in the input directory.');
        }

        $settingsJson = file_get_contents($settingsFile);
        $settings     = json_decode($settingsJson);

        $credentials  = $settings->credentials;
        $jira  = $settings->jira;

        $user         = $credentials->user;
        $pass         = $credentials->pass;
        $jiraBaseUrl  = $jira->baseUrl;

        if ($user == null || $pass == null || $jiraBaseUrl == null) {
            die('Invalid config file structure!');
        }

        return array(
            'user'        => $user,
            'pass'        => $pass,
            'jiraBaseUrl' => $jiraBaseUrl,
        );
    }

    /**
     * Streams external resource containing the logo in ASCII art and outputs it to the console.
     *
     * @return string
     */
    public static function getAsciiLogo()
    {
        $asciiLogo = file_get_contents(Controller_Setting::PATH_RES_TXT . DIRECTORY_SEPARATOR . 'logo.txt');

        return $asciiLogo;
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