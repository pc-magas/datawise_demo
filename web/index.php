<?php

require_once __DIR__ . '/../vendor/autoload.php';
define('VIEWS_DIR', __DIR__.'/../views');
define('AppHost',getEnv('APP_URL'));

// PCMagas namespace is being PSR-4 autoloaded
use PCMagas\Dropbox;
use PCMagas\DropboxFactory;
use PCMagas\Router;
use GuzzleHttp\Client;

$guzzle=new Client();
$dropbox=DropboxFactory::fromIniFile(__DIR__."/../params.ini", $guzzle);

$router= new Router($dropbox);

// Frontpage in order to render the login button into the url.
Flight::route('/', [$router,'homepage']);

// Route that lists the files
Flight::route('/files', function(){
    echo 'hello world!';
});

Flight::start();