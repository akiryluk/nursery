<?php

class HealthTabEditController extends SecuredController
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

                $health = new HealthModel();

                if(!empty($nurseryRequest->getKidId())){
                     //Fetch Person info based on kid id
                     $health = HealthModel::readHealthByKidId($nurseryRequest->getKidId());
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
                    'health' => $health,
                ];
                
            }
        }

        //DISPLAY AN EMPTY CREATION FORM
        $nurseryRequest = new NurseryRequestModel();
        $health = new HealthModel();

        return
        [
            'errorMessage' => null,
            'nurseryRequest'  => $nurseryRequest,
            'health' => $health,
        ];

    }
   


    protected function doHttpPostMethod(Http $http, array $formFields)
	{
        //WRITE ONLY MODE (ecriture)
        if(array_key_exists('id', $formFields) == true)
        {
            if(ctype_digit($formFields['id']) == true)
            {
               

                /*$defaultCreatedAt = empty($formFields['createdAt'])?'hoho':$formFields['createdAt'];*/

                HealthModel::updateHealth($formFields['id'], $formFields['kidId'],$formFields['doctorPersId'],
                $formFields['isBornOnTime'],$formFields['isBirthHealthIssue'], $formFields['isAllergy'],
                $formFields['allergyDetail'],$formFields['isDiet'], $formFields['dietDetail'],
                $formFields['isLoseConsciousnes'],$formFields['loseDetail'],$formFields['isConvulsions'],
                $formFields['isBleedingNose'],$formFields['isSpecialMedecine'],
                $formFields['medecineDetail'],$formFields['isFeverMedecine'],$formFields['weight'],
                $formFields['isHospitalEmergency'],$formFields['hospitalName'],$formFields['createdAt'],);


                $http->redirectTo('user/nursery/requestTab/healthTabEdit?requestId='.$formFields['requestId']."&statusAction=updated");
            }
        }

        //CREATION MODE 
        //=========================================================
        //PERSIST HEALTH FIELD FOR KID
        //=========================================================
        $nurseryRequest = NurseryRequestModel::readNurseryRequestById($formFields['requestId']);
        $health = new HealthModel();

        $health->setKidId($nurseryRequest->getKidId());

        if(array_key_exists('isBornOnTime', $formFields) == true){
            $health->setIsBornOnTime($formFields['isBornOnTime']);
        }
        
        $health->setIsBirthHealthIssues($formFields['isBirthHealthIssue']);
        $health->setIsAllergy($formFields['isAllergy']);
        $health->setAllergyDetail($formFields['allergyDetail']);
        $health->setIsDiet($formFields['isDiet']);
        $health->setDietDetail($formFields['dietDetail']);
        $health->setIsLoseConsciousness($formFields['isLoseConsciousnes']);
        $health->setLoseDetail($formFields['loseDetail']);
        $health->setIsConvulsions($formFields['isConvulsions']);
        $health->setIsBleedingNose($formFields['isBleedingNose']);
        $health->setIsSpecialMedecine($formFields['isSpecialMedecine']);
        $health->setMedecineDetail($formFields['medecineDetail']);
        $health->setIsFeverMedecine($formFields['isFeverMedecine']);
        $health->setWeight($formFields['weight']);
        $health->setIsHospitalEmergency($formFields['isHospitalEmergency']);
        $health->setHospitalName($formFields['hospitalName']);
        $health->setCreatedAt($formFields['createdAt']);

        $healthId = $health->createHealth();

    
        $http->redirectTo('user/nursery/requestTab/healthTabEdit?requestId='.$formFields['requestId']."&statusAction=created");
        
	}
}