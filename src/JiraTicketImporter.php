<?php
/**
 * Handles the import of ticket information from JIRA.
 */
class JiraTicketImporter
{

    /**
     * Tests the functionality.
     *
     * @param string $ticket The ID of the ticket to stream.
     */
    public static function test($ticket, $user, $pass)
    {
        echo 'Test ticket importing<br>';

        $curlOptions = array(
            CURLOPT_URL            => 'https://bdc.bahag.com/rest/api/latest/issue/' . $ticket,
            CURLOPT_USERPWD        => $user . ':' . $pass,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => 0,
            CURLOPT_TIMEOUT        => 4,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        );

        $curlConnection = curl_init();
        curl_setopt_array($curlConnection, $curlOptions);
        if (!($result = curl_exec($curlConnection)))
        {
            trigger_error(curl_error($curlConnection));
        }
        curl_close($curlConnection);

        echo $result;
    }

}