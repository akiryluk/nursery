<?php

class RequestListController extends SecuredController
{
    //Get a Nursery Request identified by 12
    //localhost/nursery/index.php/user/nurseryRequest?id=12
	protected function doHttpGetMethod(Http $http, array $queryFields)
	{

        // Validation de la query string.
        if(array_key_exists('id', $queryFields) == true)
        {
            if(ctype_digit($queryFields['id']) == true)
            {
				// Récupération des informations sur l'aliment.
                $nurseryRequest = NurseryRequestModel::readNurseryRequestById($queryFields['id']);

                return
                [
                    'errorMessage' => null,
                    'nurseryRequest'  => $nurseryRequest,
                ];
            }
        }

        // In case of id query parameter is empty or not a number then redirect to home page.
        $http->redirectTo('/');

    }
   


    protected function doHttpPostMethod(Http $http, array $formFields)
	{
        //TODO AK: NEED TO IMPLEMENT

        // $session = new Session();

        // // Récupération du compte client de l'utilisateur connecté.
        // $userId = $session->getCurrentUserId();

		// // Création de la réservation.
        // $userModel = UserModel::saveUser
		// (
		// 	$userId,
		// 	$formFields['lastName'],
        //     $formFields['firstName'],
		// 	$formFields['address'],
		//     $formFields['city'],
        //     $formFields['zipCode'],
        //     $formFields['phone'],
        //     $formFields['email'],
		// );

        // // Redirection vers la page d'accueil.
		// $http->redirectTo('/user/profile');
	}
}