<?php

namespace SeinOxygen\Contabilium\Api;

use SeinOxygen\Contabilium\Exception\ApiException;

class ApiClient
{
    /**
     * The Contabilium API key.
     * @var string
     */
    protected $client_id;

    /**
     * The Contabilium username.
     * @var string
     */
    protected $client_secret;

    /**
     * The Contabilium access_token.
     * @var string
     */
    protected $access_token;

    /**
     * THe Contabilium API end-point.
     * @var string
     */
    protected $ApiUri = "https://rest.contabilium.com/";

    /*
     * @param string $apikey    ApiKey that gives you access to our SMTP and HTTP API's.
     */
    public function __construct($client_id = null, $client_secret = null, $country = null)
    {

        $config = app('config')->get('services.contabilium', []);

        $this->client_id = $client_id ? $client_id : $config['client_id'];
        $this->client_secret = $client_secret ? $client_secret : $config['client_secret'];
        $this->country = $country ? $country : $config['country'];

        switch ($country)
        {
            case 'uy':
                $this->ApiUri = 'https://rest.contabilium.com.uy';
                break;
            case 'cl':
                $this->ApiUri = 'https://rest.contabilium.cl';
                break;
        }

        $this->access_token = $this->getAccessToken();
    }

    public function getAccessToken()
    {
        $token = cache('contabilium_token');
        if($token){
            return $token;
        }

        $curl = curl_init();

        $url = $this->ApiUri . "token";

        $data = array(
            'grant_type' => 'client_credentials',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret
        );

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            throw new ApiException($url, 'POST', 'Request Error: ' . curl_error($curl));
        }

        curl_close($curl);
        $jsonResult = json_decode($response);

        if(isset($jsonResult->access_token)){
            cache(['contabilium_token' => $jsonResult->access_token], $jsonResult->expires_in);

            return $jsonResult->access_token;
        }

        return $jsonResult->access_token;
    }

    public function request($target, $data = array(), $method = "GET")
    {
        $ch = curl_init();

        $url = $this->ApiUri . $target . (($method === "GET") ? '?' . http_build_query($data) : '');

        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json' , 'Authorization: Bearer '.$this->access_token)
        ));

        if (in_array($method, ["POST", "PUT"])) {
            curl_setopt($ch, CURLOPT_POST, true);
            
            if(!empty($data)){
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            }
            
        }

        $response = $this->executeWithRetry($ch, true);
        if ($response === false) {
            throw new ApiException($url, $method, 'Request Error: ' . curl_error($ch));
        }

        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

        if(stripos($contentType, 'application/json') === false){
            return $response;
        }

        curl_close($ch);
        $jsonResult = json_decode($response);

        $parseError = $this->getParseError();
        if ($parseError !== false) {
            throw new ApiException($url, $method, 'Request Error: ' . $parseError, $response);
        }

        if (isset($jsonResult->Message)) {
            throw new ApiException($url, $method, $jsonResult->Message);
        }

        return $jsonResult;
    }

    public function executeWithRetry($ch, $sleep = false)
    {
        $counter = 0;
        $maxRetries = 3;
        $lastErr = NULL;
        $sleepInSeconds = 5;

        while ($counter < $maxRetries) {
            try {
                $response = curl_exec($ch);

                return $response;
            } catch (\Exception $e) {
                $counter++;
                $lastErr = $e->getMessage();

                if ($sleep) {
                    sleep($sleepInSeconds);
                }
            }
        }

        throw new \Exception('Error after ' . $maxRetries . ' retries: ' . $lastErr);
    }

    private function getParseError()
    {
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return false;
            case JSON_ERROR_DEPTH:
                return 'Maximum stack depth exceeded';
            case JSON_ERROR_STATE_MISMATCH:
                return 'Underflow or the modes mismatch';
            case JSON_ERROR_CTRL_CHAR:
                return 'Unexpected control character found';
            case JSON_ERROR_SYNTAX:
                return 'Syntax error, malformed JSON';
            case JSON_ERROR_UTF8:
                return 'Malformed UTF-8 characters, possibly incorrectly encoded';
            default:
                return 'Unknown error';
        }
    }

}