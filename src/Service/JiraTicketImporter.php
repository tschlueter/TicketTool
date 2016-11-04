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
            Controller_Setting::JIRA_BASE_URL . '/rest/api/latest/issue/' . $ticketId,
            $user,
            $pass
        );

        $json = json_decode($response);
/*
        echo '<pre>';
        var_export($json);
        echo '</pre>';
*/
        if ($json == null) {
            die('ERROR on requesting JIRA API! Please check your credentials.');
        }

        $actualId           = $json->key;
        $title              = $json->fields->summary;
        $type               = $json->fields->issuetype->name;
        $originalEstimation = '';

        if (array_key_exists('originalEstimateSeconds', $json->fields->timetracking)) {
            $originalEstimation = (
                $json->fields->timetracking->originalEstimateSeconds / Controller_Setting::SECONDS_PER_HOUR
            ) . 'h';
        } else {
            $originalEstimation = 'unestimated';
        }

        if (Controller_Setting::DEBUG_SUPERSIZE_TITLE) {
            $title .= str_repeat('_SUPERSIZED', 20);
        }

        if (strlen($title) > Controller_Setting::MAX_TITLE_LENGTH) {
            $title = substr($title, 0, Controller_Setting::MAX_TITLE_LENGTH) . '...';
        }

        return new Model_JiraTicket(
            $actualId,
            $title,
            $type,
            $originalEstimation
        );
    }

}