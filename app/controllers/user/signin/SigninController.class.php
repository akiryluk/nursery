<?php

class SigninController
{
    public function httpGetMethod(Http $http, array $queryFields)
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
        // if(isset($formFields['nom']))
        // {
            $user = new UserModel($formFields['lastName'], $formFields['firstName'], 
            "", $formFields['adresse'], $formFields['ville'],
            $formFields['cp'], $formFields['tel'], $formFields['email'],
            $formFields['password'],"France", false);

            $user->createUser();
            $http->redirectTo('/user/login');

        // }
    }
    // public function addPost()  
    // {
    //     try {
    //         $cnx = new PDO('mysql:host=localhost;dbname=data_restaurant;charset=utf8', "root", "troiswa");
    //     } catch (PDOExeption $e) {
    //         echo $e->getMessage();
    //     }
  
    //     $stmt = $cnx->prepare('INSERT INTO post (prenom, nom, email, password, birthday, adresse) VALUES (?,?,?,?,?)');
    //     $stmt->execute([
    //         $this->title,
    //         $this->content,
    //         $this->picture, 
    //         $this->category_id,
    //         $this->created_at
    //     ]);

    //     $cnx = null;
    // }
}