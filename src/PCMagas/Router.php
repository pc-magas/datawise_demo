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
    
    return str_replace('//','/',"$this->appHost/$route");
  }

  public function homepage(){
    $url = $this->generateUrl('/files');
    \Flight::render(VIEWS_DIR.'/frontpage.html.php',['login_url'=>$this->dropbox->getOAuthAutorizeUrl($url)]);
  }
}