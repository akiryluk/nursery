<?php

class RequestEditController extends SecuredController
{

    //
    //Get a Nursery Request identified by 12
    //localhost/nursery/index.php/user/nurseryRequest?id=12
	protected function doHttpGetMethod(Http $http, array $queryFields)
	{

        //LECTURE/READ ONLY MODE (lecture)

        // Validation de la query string.
        //ID is discriminator (permet to select one and only one line on my listing; ex gender(boy, girl))
        if(array_key_exists('id', $queryFields) == true)
        {
            if(ctype_digit($queryFields['id']) == true)
            {
				// Récupération des informations sur nursery request.
                $nurseryRequest = NurseryRequestModel::readNurseryRequestById($queryFields['id']);

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
                //TO DO AK TRY CATCH EXCEPTION IN ORDER TO SET AN ERROR MSG
                return
                [
                    'errorMessage' => null,
                    'infoMessage' => $infoMessage,
                    'nurseryRequest'  => $nurseryRequest,
                    'kidPerson' => $kidPerson,
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
            'kidPerson' => $kidPerson,
        ];

    }
   


    protected function doHttpPostMethod(Http $http, array $formFields)
	{
        //WRITE ONLY MODE (ecriture)

        $today = date("Y-m-d H:i:s");
        if(array_key_exists('id', $formFields) == true)
        {
            if(ctype_digit($formFields['id']) == true)
            {

				// Récupération des informations sur nursery request.
                NurseryRequestModel::updateNurseryRequest($formFields['id'],$formFields['id'],$today, 
                $formFields['entryDate'],$formFields['kidId'],$formFields['cafNumber'],"en cours",null);
                $http->redirectTo('user/nursery/requestEdit?id='.$formFields['id']."&statusAction=updated");
            }
        }

        //CREATION MODE because ID is null/never been saved into db before

        //=========================================================
        //PERSIST FIRSTNAME, LASTNAME FIELD FOR KID/ PERSON
        //=========================================================
        $person = new PersonModel();
        $person->setFirstName($formFields['firstName']);
        $person->setLastName($formFields['lastName']);

        $newPersonId = $person->createPerson();

        $kid = new KidModel();
        $kid->setInfoKidId($newPersonId);

        $newKidId = $kid->createKid();

        //=========================================================
        //PERSIST FIELD FOR NURSERY REQUEST
        //=========================================================
        $requestModel = new NurseryRequestModel();
        
        $requestModel->setRequestDate($today);
        $requestModel->setEntryDate($formFields['entryDate']);
        $requestModel->setCafNumber($formFields['cafNumber']);
        $requestModel->setKidId($newKidId);
        $session = new Session();

        $requestModel->setUserId($session->getCurrentUserId());
        //On Creation Mode, each request is marked as IN Progress for Status field
        $requestModel->setStatusReq("en cours");

        //Persist into DB this new Nursery Request
        $newId = $requestModel->createNurseryRequest();

        $http->redirectTo('user/nursery/requestEdit?id='.$newId."&statusAction=created");
        
	}
}