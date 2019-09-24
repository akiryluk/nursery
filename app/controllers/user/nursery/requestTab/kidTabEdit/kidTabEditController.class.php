<?php

class KidTabEditController extends SecuredController
{

    //
    //Get a Nursery Request identified by 12
    //localhost/nursery/index.php/user/nurseryRequest?id=12
	protected function doHttpGetMethod(Http $http, array $queryFields)
	{

        //LECTURE/READ ONLY MODE (lecture)

        // Validation de la query string.
        //ID is discriminator (permet to select one and only one line on my listing; ex gender(boy, girl))
        if(array_key_exists('requestId', $queryFields) == true)
        {
            if(ctype_digit($queryFields['requestId']) == true)
            {
				// Récupération des informations sur nursery request.
                $nurseryRequest = NurseryRequestModel::readNurseryRequestById($queryFields['requestId']);

                //Fetch Kid information
                $kidPerson = new PersonModel();

                if(!empty($nurseryRequest->getKidId())){
                    $kid = KidModel::readKidById($nurseryRequest->getKidId());
                     //Fetch Person info based on kid id
                    $kidPerson = PersonModel::readPersonById($kid->getInfoKidId());
                }
                
                $infoMessage = null;
                if(array_key_exists('statusAction', $queryFields) == true){
                    if($queryFields['statusAction'] == 'created'){
                        $infoMessage="Votre demande a bien été créée";
                    }else{
                        $infoMessage="Votre demande a bien été modifiée";
                    }

                }

                return
                [
                    'errorMessage' => null,
                    'infoMessage' => $infoMessage,
                    'nurseryRequest'  => $nurseryRequest,
                    'person' => $kidPerson,
                ];
                
            }
        }

        //DISPLAY AN EMPTY CREATION FORM
        $nurseryRequest = new NurseryRequestModel();
        $kidPerson = new PersonModel();

        return
        [
            'errorMessage' => null,
            'nurseryRequest'  => $nurseryRequest,
            'person' => $kidPerson,
        ];

    }
   


    protected function doHttpPostMethod(Http $http, array $formFields)
	{
        //WRITE ONLY MODE (ecriture)
        if(array_key_exists('id', $formFields) == true)
        {
            if(ctype_digit($formFields['id']) == true)
            {
                // Récupération des informations sur nursery request.
                //TODO AK l'ordre du update kidModel + créér view form
                PersonModel::updatePerson($formFields['id']);
                $http->redirectTo('user/nursery/requestEdit?id='.$formFields['id']."&statusAction=updated");
            }
        }

        //CREATION MODE is not supported here since we delegate Kid Creation at RequestEditController 
        //so redirect to request nursery listing if theres no Id for editing this kid Person. 

        $http->redirectTo('user/nursery/requestList');
        
	}
}