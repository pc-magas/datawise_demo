<?php

require_once __DIR__ . '/../vendor/autoload.php';
define('VIEWS_DIR', __DIR__.'/../views');
define('PARAMS_FILE',__DIR__."/../params.ini");

// PCMagas namespace is being PSR-4 autoloaded
use PCMagas\Dropbox;
use PCMagas\Router;
use GuzzleHttp\Client;

if( !file_exists(PARAMS_FILE) ){
    die('Parameter File Does not exist');
}

$iniArray = parse_ini_file(PARAMS_FILE);
if($iniArray===FALSE){
    die('Misconfigured parameter file.');
}

$guzzle=new Client();
$dropbox=new DropBox($iniArray['dropbox_key'],$iniArray['dropbox_secret'], $guzzle);
$router= new Router($dropbox, $iniArray['app_url']);

// Frontpage in order to render the login button into the url.
Flight::route('/', [$router,'homepage']);

// Route that lists the files
Flight::route('/files', function(){
    echo 'hello world!';
});

Flight::start();