<?php

class RequestListController extends SecuredController
{


//Get All Nursery Request for current User
//localhost/nursery/index.php/user/nursery/requestList
	protected function doHttpGetMethod(Http $http, array $queryFields)
	{

        //Ask for ALL Nursery Request for current user
        $session = new Session();
        $userId =  $session->getCurrentUserId();

        $nurseryRequests = NurseryRequestModel::readAllNurseryRequestByUserId($userId);

        return
        [
            'errorMessage' => null,
            'nurseryRequests'  => $nurseryRequests,
        ];

    }
   


    protected function doHttpPostMethod(Http $http, array $formFields)
	{
        //At this stage, there's no need for any POST Method for Nursery Request Listing.
        // To see if later, there's some user requirement for Search Engine based on formField criteria
	}
}