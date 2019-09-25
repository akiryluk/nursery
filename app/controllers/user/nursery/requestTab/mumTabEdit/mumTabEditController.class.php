<?php

class MumTabEditController extends SecuredController
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

                //Fetch Family information
                $family = FamilyModel::readFamilyByNurseryRequestId($queryFields['requestId']);

                $mum = new PersonModel();

                if(!empty($family->getMotherId())){
                     //Fetch Person info based on kid id
                    $mum = PersonModel::readPersonById($family->getMotherId());
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
                    'person' => $mum,
                ];
                
            }
        }

        //DISPLAY AN EMPTY CREATION FORM
        $nurseryRequest = new NurseryRequestModel();
        $person = new PersonModel();

        return
        [
            'errorMessage' => null,
            'nurseryRequest'  => $nurseryRequest,
            'person' => $person,
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
                $http->redirectTo('user/nursery/requestTab/mumTabEdit?requestId='.$formFields['requestId']."&statusAction=updated");
            }
        }

        //CREATION MODE is not supported here since we delegate Kid Creation at RequestEditController 
        //so redirect to request nursery listing if theres no Id for editing this kid Person. 

        $http->redirectTo('user/nursery/requestList');
        
	}
}