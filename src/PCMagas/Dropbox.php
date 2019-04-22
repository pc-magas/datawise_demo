<?php

namespace PCMagas;
define("DROPBOX_OAUTH_LOGIN_URL","https://www.dropbox.com/oauth2/authorize");

use \GuzzleHttp\Client; 

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
    public function getOAuthAutorizeUrl($rediurectUrl)
    {
        //For ease of use and development time saving, we utilize a direct token fetch.
        return DROPBOX_OAUTH_LOGIN_URL."?client_id={$this->appId}&response_type=token&redirectUrl=";
    }

    /**
     * @param String $code
     * @return String
     * @throws Exception if any error occured when token cannot be fetched
     */
    public function getToken($code)
    {
        //If code get token from code
        //Else get token from $session
        //Not satisfiable thorw Esception
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