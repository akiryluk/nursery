<?php

/**
 * This abstract controller check if an user is well authenticated 
 * before to execute httpPostMethod or httpGetMethod. No need for 
 * Child classes (which implement abstract method doHttpGetMethod 
 * and doHttpPostMethod ) to check again if an user is authenticated or not.
 * Note, if none user is connected then SecuredController will redirect 
 * automatically to Login Page.
 */
abstract class SecuredController
{

	public function httpGetMethod(Http $http, array $queryFields)
    {
		$this->checkIsAuthenticatedOrRedirectToLogIn($http);
		return $this->doHttpGetMethod($http, $queryFields);
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
		$this->checkIsAuthenticatedOrRedirectToLogIn($http);
		return $this->doHttpPostMethod($http, $formFields);
	}
	
	public function checkIsAuthenticatedOrRedirectToLogIn(Http $http){
		$session = new Session();
		if($session->isAuthenticated() == false)
		{
            // We can't access at this resource as Anonymous user.
			$http->redirectTo('/user/login');
        }
	}

	/**
	 * Ensure User is authenticated and is granted for accesing at this resource.
	 * Delegate Http Get request processing at Child class. 
	 */
	abstract protected function doHttpGetMethod(Http $http, array $queryFields);
	/**
	 * Ensure User is authenticated and is granted for accesing at this resource.
	 * Delegate Http POST request processing at Child class. 
	 */
    abstract protected function doHttpPostMethod(Http $http, array $formFields);
}