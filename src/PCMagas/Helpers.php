<?php

namespace PcMagas;

class Helpers
{
    public static function generateUrl($isSecure,$baseUrl,$route) 
    {
        $http='http';
        if($isSecure){
            $http+='s';
        }
        if(empty($baseUrl)){
            throw new InvalidArgumentException('Please Provide a Base Url');
        }

        if(empty($route)){
            throw new InvalidArgumentException('Provide a valid route');
        }
    
        return str_replace('//','/',"{$http}://$baseUrl/$route");
    }
}