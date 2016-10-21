<?php
/**
 * Manages CURL calls.
 */
class Service_Curl
{

    /**
     * Performs a curl call and returns the response.
     *
     * @param string $url
     * @param string $user
     * @param string $pass
     *
     * @return string
     */
    public static function get($url, $user, $pass)
    {
        $curlOptions = array(
            CURLOPT_URL            => $url,
            CURLOPT_USERPWD        => $user . ':' . $pass,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => 0,
            CURLOPT_TIMEOUT        => 4,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        );

        $curlConnection = curl_init();
        curl_setopt_array($curlConnection, $curlOptions);
        $result = curl_exec($curlConnection);

        if ($result === false) {
            trigger_error(curl_error($curlConnection));
        }

        curl_close($curlConnection);

        return $result;
    }

}