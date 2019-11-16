<?php

class Session{


    public function __construct()
	{
		if(session_status() == PHP_SESSION_NONE)
		{
            // Démarrage du module PHP de gestion des sessions.
			session_start();
		}
	}

    public function create($id, $firstName, $lastName, $status)
    {
        // Construction de la session utilisateur.
        $_SESSION= 
        [
            'logged' => true,
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'admin' => $status
        ];
    }

    public function destroy()
    {
        // Destruction de l'ensemble de la session.
        $_SESSION = array();
        session_destroy();
    }

    public function isAuthenticated()
	{
		if(array_key_exists('logged', $_SESSION) == true && $_SESSION['logged'] == true)
		{
            return true;
             
        }
		return false;
    }

    public function getFullName()
    {
        if(array_key_exists ('firstName', $_SESSION) == true && array_key_exists ('lastName', $_SESSION) == true)
        {
            return ($_SESSION['firstName'])." ".($_SESSION['lastName']);
        }
        return "";
    }

    public function getFirstName()
    {
        if(array_key_exists ('firstName', $_SESSION) == true)
        {
            return ($_SESSION['firstName']);
        }
        return "";
    }

    public function isAdmin()
    {
        if(!empty($_SESSION['admin']) && $_SESSION['admin']== true)
        {
            return true;
        }
        return false;
    }
    /*
    * Get Current User Identifier. Return Null if anonymous user.
    *
    */

    public function getCurrentUserId()
    {
        if(array_key_exists ('id', $_SESSION) == true)
        {
            return ($_SESSION['id']);
        }
        return null;
    }
}