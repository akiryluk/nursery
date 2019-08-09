<?php

class LoginController
{
    public function httpGetMethod(Http $http)
    {
        $session = new Session();
        if($session->isAuthenticated()){
            if($session->isAdmin() == true)
            {
                $http->redirectTo('/admin');
            }else{
                $http->redirectTo('/user');
            }
        }
    }
    
    public function httpPostMethod(Http $http, array $formFields)
    {

        if(isset($formFields['email']))
        {
            $user = UserModel::getUserByEmail($formFields['email']);
            if($user)
            { 
                //compare if client password === db password
                if(password_verify($formFields['password'], $user->getPassword()))
                {
                    //Demarrer une nouvelle session car l'utilisateur est connu
                    $session = new Session();
                    
                    // ouvrir la session et stocker dedans :
                    // logged = true
                    // l'id de l'utilisateur
                    // stocker le nom et prénom
                    // stocker le "ROLE" (status)

                    $session->create($user->getId(), $user->getFirstName(), $user->getLastName(), $user->getAdmin());

                    $user->editLastLogin();

                    if($user->getAdmin() == true)
                    {
                        $http->redirectTo('/admin');
                    }else{
                        $http->redirectTo('/user');
                    }

                }
            }else{
                $http->redirectTo('/user/login');
            }
        }
  
         
    }
   
}

