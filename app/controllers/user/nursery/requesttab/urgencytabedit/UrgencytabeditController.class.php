<?php

class UrgencyTabEditController extends SecuredController
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

                $urgence = new PersonModel();

                if(!empty($family->getEmergencyOneId())){
                     //Fetch Person info based on kid id
                    $urgence = PersonModel::readPersonById($family->getEmergencyOneId());
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
                    'person' => $urgence,
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
               
                PersonModel::updatePerson($formFields['id'], $formFields['firstName'],$formFields['lastName'],
                $formFields['street'],$formFields['city'],$formFields['zipCode'],
                $formFields['country'],$formFields['birthday'],$formFields['birthPlace'],
                $formFields['email'],$formFields['phone'],$formFields['nationality'],
                $formFields['jobTitle'],$formFields['companyName'],$formFields['securityNumber'] );
                $http->redirectTo('user/nursery/requestTab/urgencyTabEdit?requestId='.$formFields['requestId']."&statusAction=updated");
            }
        }

        //CREATION MODE is not supported here since we delegate Kid Creation at RequestEditController 
        //so redirect to request nursery listing if theres no Id for editing this kid Person. 
        //=========================================================
        //PERSIST FIRSTNAME, LASTNAME FIELD FOR EMERGENCY / PERSON
        //=========================================================
        $emergencyPerson = new PersonModel();
        $emergencyPerson->setFirstName($formFields['firstName']);
        $emergencyPerson->setLastName($formFields['lastName']);
        $emergencyPerson->setStreet($formFields['street']);
        $emergencyPerson->setCity($formFields['city']);
        $emergencyPerson->setZipCode($formFields['zipCode']);
        $emergencyPerson->setPhone($formFields['phone']);

        $newEmergencyPersonId = $emergencyPerson->createPerson();
// TO DO BIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIG PROBLEM urgence PERSONNE N'EST LIE a personne 
        $familyPerson = FamilyModel::readFamilyByNurseryRequestId($formFields['requestId']);
        
        $familyPerson->setEmergencyOneId($newEmergencyPersonId);
        $familyPerson->updateFamily();
    
        $http->redirectTo('user/nursery/requestTab/urgencyTabEdit?requestId='.$formFields['requestId']."&statusAction=created");
        
	}
}