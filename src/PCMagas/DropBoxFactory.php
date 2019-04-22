<?php

namespace PCMagas;

use \GuzzleHttp\Client; 
use PCMagas\Exceptions\FileNotFoundException;

class DropboxFactory
{
    /**
     * @param String $path File containing the configuration
     * @param Client $client The Required Http Client
     * @return Dropbox
     * @throws Exception
     */
    public static function fromIniFile($path,Client $client)
    {
        if( !file_exists($path) ){
         throw new FileNotFoundException($path);
        }

        $iniArray = parse_ini_file($path);
        if($iniArray === FALSE){
            throw new Exception("Could not parse the Ini file", 244);
        } 
        
        return new Dropbox($iniArray['key'],$iniArray['secret'],$client);
    }
}