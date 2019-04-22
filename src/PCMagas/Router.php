<?php

namespace PcMagas;

use PcMagas\Dropbox;
use PcMagas\Helpers;

class Router {

  public function __construct(Dropbox $dropbox){
    $this->dropbox=$dropbox;
  }

  public function homepage(){
    $url = \Flight::generateHostRoute(AppHost,'/files');
    \Flight::render(VIEWS_DIR.'/frontpage.html.php',['login_url'=>$this->dropbox->getOAuthAutorizeUrl($url)]);
  }
}