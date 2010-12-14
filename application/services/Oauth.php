<?php
class Application_Service_Oauth
{
    const COOKIE_TWITTER = 'tat';
    const COOKIE_FACEBOOK = 'fat';
    const COOKIE_LINKEDIN = 'lat';
    
    public static function getUsername($service)
    {
        switch ($service) {
            case 'twitter':
                $cookie = self::COOKIE_TWITTER;
                $param = 'screen_name';
                break;
            case 'linkedin':
                $cookie = self::COOKIE_LINKEDIN;
                $param = 'screen_name';
                break;
            default:
                $cookie = false;
                $param = null;
                break;
        }
        $username = 'Anonymous user';
        if (!$cookie) {
            return $username;
        }
        if ($cookie && isset ($_COOKIE[$cookie])) {
            $data = $_COOKIE[$cookie];
			$token = unserialize($data);
			$username = $token->getParam($param);
			setcookie($cookie, $tat, 30758400, '/');
		}
		return $username;
    }
    
    public function authenticate($service, $request, $session)
    {
        // create an oauth consumer
        if (!isset ($this->_config->$service)) {
            throw new Wingz_Exception('No configuration found for this service');
        }
        $consumer = new Zend_Oauth_Consumer($this->_config->$service);

        //get the correct cookie
        switch ($service) {
            case 'twitter':
                $cookie = self::COOKIE_TWITTER;
                break;
            default:
                $cookie = false;
                break;
        }
        
		// let's see if the user is already known to the system
		if (isset($_COOKIE[$cookie])) {
			return true;
		}
		
		$sessionRequestToken = $service . '_request_token';
		$sessionAccessToken = $service . '_access_token';
		
		// check if there's a valid token returned
		if (!empty ($request->getParams())) {
		    if (isset ($session->$sessionRequestToken)) {
    			$token = $consumer->getAccessToken($_GET,
    				unserialize($session->$sessionRequestToken));
    			unset ($session->$sessionRequestToken);
    			$data = serialize($token);
    			$session->$sessionAccessToken = $data;
    			setcookie($cookie, $data, 30758400, '/');
		    }
			return true;
		} else {
			// retrieve the token and store it in a session
			$token = $consumer->getRequestToken();
			$this->_session->twitter_request_token = serialize($token);

			// redirect to twitter to allow/reject your app
			$consumer->redirect();
		}
    }
}