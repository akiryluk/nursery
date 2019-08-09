<?php

class LogoutController
{
    
public function httpGetMethod(Http $http, array $queryFields)
    {
        $session = new Session();
        $session->destroy();
        $http->redirectTo('/user/login');
    }

}
