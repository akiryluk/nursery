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
        if(array_key_exists('id', $queryFields) == true)
        {
            if(ctype_digit($queryFields['id']) == true)
            {
				// Récupération des informations sur nursery request.
                $nurseryRequest = NurseryRequestModel::readNurseryRequestById($queryFields['id']);
                
                return
                [
                    'errorMessage' => null,
                    'nurseryRequest'  => $nurseryRequest,
                ];
                
            }
        }else{
            //DISPLAY AN EMPTY CREATION FORM
            $nurseryRequest = new NurseryRequestModel();
            return
            [
                'errorMessage' => null,
                'nurseryRequest'  => $nurseryRequest,
            ];

        }

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
                $formFields['entryDate'],null,$formFields['cafNumber'],"en cours",null);

                $nurseryRequest = NurseryRequestModel::readNurseryRequestById($formFields['id']);

                return
                [
                    'errorMessage' => null,
                    'nurseryRequest'  => $nurseryRequest,
                ];
            }
        }

        //CREATION MODE because ID is null/never been saved into db before
        $requestModel = new NurseryRequestModel();

        
        $requestModel->setRequestDate($today);
        $requestModel->setEntryDate($formFields['entryDate']);
        $requestModel->setCafNumber($formFields['cafNumber']);
        //On Creation Mode, each request is marked as IN Progress for Status field
        $requestModel->setStatusReq("en cours");
    
        //continue with other setter

        //Persist into DB this new Nursery Request
        $newId = $requestModel->createNurseryRequest();
        $http->redirectTo('user/nursery/requestEdit?id='.$newId);
        
	}
}