<?php

require_once __DIR__ . '/../vendor/autoload.php';
define('VIEWS_DIR', __DIR__.'/../views');

// PCMagas namespace is being PSR-4 autoloaded
use PCMagas\Dropbox;
use PCMagas\DropboxFactory;
use GuzzleHttp\Client;

$guzzle=new Client();
$dropbox=DropboxFactory::fromIniFile(__DIR__."/../params.ini", $guzzle);

// Frontpage in order to render the login button into the url.
Flight::route('/', function(){
    Flight::render(VIEWS_DIR.'/frontpage.html.php',['login_url'=>'http://example.com']);
});

// Route that lists the files
Flight::route('/files', function(){
    echo 'hello world!';
});

Flight::start();