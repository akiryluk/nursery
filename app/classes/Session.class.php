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
    

    public function isAdmin()
    {
        if($_SESSION['admin']== true)
        {
            return true;
        }
        return false;
    }
}