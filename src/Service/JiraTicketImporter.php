<?php
/**
 * Handles the import of ticket information from JIRA.
 */
class Service_JiraTicketImporter
{

    /**
     * Requests one ticket and returns the rendered model.
     *
     * @param string $ticket
     * @param string $user
     * @param string $pass
     */
    public static function get($ticket, $user, $pass)
    {
        $response = Service_Curl::get(
            Controller_TicketTool::JIRA_BASE_URL . '/rest/api/latest/issue/' . $ticket,
            $user,
            $pass
        );

        $json = json_decode($response);

        var_export($json);
    }

}