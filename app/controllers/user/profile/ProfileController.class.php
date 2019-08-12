<?php

class ProfileController extends SecuredController
{


	protected function doHttpGetMethod(Http $http, array $queryFields)
	{
        
        $session = new Session();
        $userId =  $session->getCurrentUserId();

        $currentUser = UserModel::getUserById($userId);

        return
        [
            'errorMessage' => null,
            'currentUser'  => $currentUser,
        ];

    }
   


    protected function doHttpPostMethod(Http $http, array $formFields)
	{
        $session = new Session();

        // Récupération du compte client de l'utilisateur connecté.
        $userId = $session->getCurrentUserId();

		// Création de la réservation.
        $userModel = UserModel::saveUser
		(
			$userId,
			$formFields['lastName'],
            $formFields['firstName'],
			$formFields['address'],
		    $formFields['city'],
            $formFields['zipCode'],
            $formFields['phone'],
            $formFields['email'],
		);

        // Redirection vers la page d'accueil.
		$http->redirectTo('/user/profile');
	}
}