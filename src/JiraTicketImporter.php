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
    public static function test($ticket)
    {
        echo 'Test ticket importing<br>';



$curlOptions = array(
    CURLOPT_URL => "http://christopherstock.jenetic.de",
    CURLOPT_HEADER => 0,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_TIMEOUT => 4,
    //CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.16 (KHTML, like Gecko) \ Chrome/24.0.1304.0 Safari/537.16'
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