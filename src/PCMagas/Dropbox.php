<?php

namespace PCMagas;

use \GuzzleHttp\Client; 

class Dropbox
{
    /**
     * @param String $appid The Dropbox Application Id.
     * @param String $secret The dropbox Secret
     * @param Client $httpClient The interface used to consume the Dropbox Rest API
     */
    public function __construct($appid,$secret,Client $httpClient)
    {
        echo "Constructing";
        $this->appid=$appid;
        $this->secret=$secret;
        $this->httpClient=$httpClient;
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