<?php

namespace PCMagas\DropboxFactory;

use \GuzzleHttp\Client; 

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
        //Dummy
        return new Dropbox("aaa",'aaa',$client);
    }
}