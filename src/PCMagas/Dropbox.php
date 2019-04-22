<?php

namespace PCMagas;
define("DROPBOX_OAUTH_LOGIN_URL","https://www.dropbox.com/oauth2/authorize");
define("API_OAUTH_TOKEN_URL","https://api.dropboxapi.com/oauth2/token");

use \GuzzleHttp\Client; 
use \GuzzleHttp\RequestOptions;

class Dropbox
{
    /**
     * @param String $appid The Dropbox Application Id.
     * @param String $secret The dropbox Secret
     * @param Client $httpClient The interface used to consume the Dropbox Rest API
     */
    public function __construct($appId,$secret,Client $httpClient)
    {
        $this->appId=$appId;
        $this->secret=$secret;
        $this->httpClient=$httpClient;
    }

    /**
     * Generate the url used for User Authorization to the App.
     * @param String $rediurectUrl The usrl used in order to redirect the app.
     * @return String with the correct OAuth url
     */
    public function getOAuthAutorizeUrl($redirectUrl)
    {
        session_start();
        $_SESSION['redirect_url']=$redirectUrl; //Saving into session for later Use

        //For ease of use and development time saving, we utilize a direct token fetch.
        return DROPBOX_OAUTH_LOGIN_URL."?client_id={$this->appId}&response_type=code&redirect_uri={$redirectUrl}";
    }

    /**
     * @param String $code
     * @return String
     * @throws InvalidArgumentException In case that the code is not correctly Provided.
     * @throws Exception if any error occured when token cannot be fetched
     */
    public function getToken($code)
    {
        //If code get token from code
        //Else get token from $session
        //Not satisfiable thows Esception
        session_start();
        if(!empty($_SESSION['token'])){
            return $_SESSION['token'];
        }

        if(empty($code)){
            throw new \InvalidArgumentException('Please provide a code fetched from Dropbox Athorization.');
        }

        if(empty($_SESSION['redirect_url'])){
            throw new \Exception('Cannot find the url that Dropbox Redirected From');
        }

        $response = $this->httpClient->request("POST",API_OAUTH_TOKEN_URL,[
            RequestOptions::FORM_PARAMS =>[
                'code'=>$code,
                'grant_type'=>'authorization_code',
                'redirect_uri'=>$_SESSION['redirect_url']
            ],
            RequestOptions::AUTH=>[$this->appId,$this->secret]
        ]);

        switch($response->getStatusCode()){
            case 400:
                throw new Exception('Invalid HttpRequest to DropBoxApi');
            case 401:
                throw new Exception('Invalid Dropbox Token');
            case 403:
                throw new Exception('Access Denied');
            case 429:
                throw new Exception('Try again later (after a 10th cup of coffee)');
            case 409:
                throw new Exception('Api user provided error');
            //Treat all 500 error code (seemd kinda ugly)
            case 500:
            case 501:
            case 502:
            case 503:
            case 504:
            case 505:
            case 506:
            case 507:
            case 508:
            case 510:
            case 511:
                throw new Exception('Internal Dropbox Error');
        }

        $body=$response->getBody()->getContents();

        echo "<br>".$body;
    }

    /**
     * @return array containing the files and directoried of user's dropbox
     */
    public function getFileList()
    {
        //Dummy Logic
        return ["aaa"=>"aaa"];
    }
}