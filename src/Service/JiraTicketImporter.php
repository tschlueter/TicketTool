<?php
/**
 * Handles the import of ticket information from JIRA.
 */
class Service_JiraTicketImporter
{

    /**
     * Requests one ticket and returns the rendered model.
     *
     * @param string $ticketId
     * @param string $user
     * @param string $pass
     *
     * @return Model_JiraTicket
     */
    public static function get($ticketId, $user, $pass)
    {
        $response = Service_Curl::get(
            Controller_TicketTool::JIRA_BASE_URL . '/rest/api/latest/issue/' . $ticketId,
            $user,
            $pass
        );

        $json = json_decode($response);

        return new Model_JiraTicket(
            $ticketId,
            $json->fields->summary
        );
    }

}