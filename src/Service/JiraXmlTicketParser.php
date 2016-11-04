<?php
/**
 * Handles the import of ticket-ID from a local XML file.
 */
class Service_JiraXmlTicketParser
{

    /**
     * Imports all ticket-IDs specified in the given XML file.
     *
     * @param string $xmlFile
     *
     * @return string[]
     */
    public static function parseTicketIds($xmlFile)
    {
        $ticketIds    = array();

        $fileContents = file_get_contents($xmlFile);
        $xml          = simplexml_load_string($fileContents);
        $json         = json_encode($xml);
        $array        = json_decode($json, true);
        $itemArray    = $array['channel']['item'];

        foreach ($itemArray as $item) {
            $ticketIds[] = $item['key'];
        }

        Controller_TicketTool::DEBUG_LOG('Parsed [' . count($ticketIds) . '] ticket-IDs from XML.');
        Controller_TicketTool::DEBUG_LOG();

        return $ticketIds;
    }

}