<?php

$autoloader=require_once __DIR__ . '/../vendor/autoload.php';

// PCMagas namespace is being PSR-4 autoloaded
use PCMagas\Dropbox;
use PCMagas\DropboxFactory;
use GuzzleHttp\Client;

$guzzle=new Client();
$dropbox=DropboxFactory::fromIniFile(__DIR__."/../params.ini", $guzzle);

//Dummy
print_r($dropbox->getFileList());