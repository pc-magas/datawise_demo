<?php
namespace PcMagas;


use \PcMagas\Dropbox;
use \PcMagas\Helpers;

class Router {

  public function __construct(Dropbox $dropbox, $appHost){
    $this->dropbox=$dropbox;
    $this->appHost=$appHost;
  }

  private function generateUrl($route) 
  {
    if(empty($route)){
      throw new \InvalidArgumentException('Provide a valid route');
    }
    
    $appHost=preg_replace('/\/$/','',$this->appHost);
    $route=preg_replace('/^\//','',$route);
    return "$appHost/$route";
  }

  public function homepage(){
    $url = $this->generateUrl('/files');
    \Flight::render('frontpage.html.php',['login_url'=>$this->dropbox->getOAuthAutorizeUrl($url)]);
  }

  public function fileList()
  {
    $code=\Flight::request()->query["code"];

    try {
      $token=$this->dropbox->getToken($code);
    } catch(Exception $e) {
      echo $e->getMessage();
    }

    $files=$this->dropbox->getFileList($token);

    \Flight::render('list.html.php',['array'=>$files]);
  }
}