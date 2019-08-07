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
        return [ '_form' => new SigninForm() ];
    }

    /**
     * Validation des champs obligatoires avec un message d'erreur 
     * cote back (au cas ou JS sera desactive côté client).
     */
    public function validateFields (array $formFields)
    {
        $mandatoryFields=['lastName', 'firstName', 'email','password'];
       
        for($i = 0 ; $i< count($mandatoryFields); $i++)
        {
            $isEmpty = empty($formFields[$mandatoryFields[$i]]);
            if($isEmpty){
                return false;
            }
        }

        return true;
    }
    public function httpPostMethod(Http $http, array $formFields)
    {

         if($this->validateFields($formFields))
         {
            $user = new UserModel($formFields['lastName'], $formFields['firstName'], 
            "", $formFields['address'], $formFields['city'],
            $formFields['zipCode'], $formFields['phone'], $formFields['email'],
            $formFields['password'],"France", false);

            $user->createUser();
            $http->redirectTo('/user/login');
        }else{
            // Réaffichage du formulaire avec un message d'erreur.
            $form = new SigninForm();
            $form->bind($formFields);
            $form->setErrorMessage("Erreur de validation. Au moins un des champs obligatoires n*est pas saisie.");

			return [ '_form' => $form ];
        }
    }

}