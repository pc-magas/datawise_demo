<?php

namespace PCMagas;
define("DROPBOX_OAUTH_LOGIN_URL","https://www.dropbox.com/oauth2/authorize");
define("API_OAUTH_TOKEN_URL","https://api.dropboxapi.com/oauth2/token");
define("API_LIST_FILES","https://api.dropboxapi.com/2/files/list_folder");

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
     * Common Logic for Handling Http Error
     * @param Integer $code
     * @throws Exception
     */
    private function httpErrorHandling($code)
    {
        switch($code){
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
            //Treat all 500 error code (seems kinda ugly)
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

        //Call method and let it blow up
        $this->httpErrorHandling($response->getStatusCode());

        $body=$response->getBody()->getContents();
        $body=json_decode($body,true);
        $_SESSION['token']=$body['access_token'];
        return $_SESSION['token'];
    }

    /**
     * List the root of my Dropbox Folder
     * @param String $accessToken The access token 
     * @return array containing the files and directoried of user's dropbox
     */
    public function getFileList($accessToken)
    {
        $response=$this->httpClient->request("POST",API_LIST_FILES,[
            RequestOptions::HEADERS=>[
                'Authorization' => 'Bearer ' . $accessToken,        
                'Accept'        => 'application/json'
            ],
            RequestOptions::JSON => [
                "path"=>"",
                "recursive" => false,
                "include_deleted" => false,
                "include_has_explicit_shared_members" => false,
                "include_mounted_folders" => true
            ]
        ]);

        $this->httpErrorHandling($response->getStatusCode());
        
        $body=$response->getBody()->getContents();
        $body=json_decode($body,true);

        //Ugly but called once thus I resorted to the use of an anonymous function
        return array_map(function($value){
            return $value['name'];
        },$body['entries']);
    }
}