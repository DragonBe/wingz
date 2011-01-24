<?php

class OauthController extends Zend_Controller_Action
{
	protected $_config;
	protected $_session;

    public function init()
    {
        $this->_config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/api.ini');
		$this->_session = new Zend_Session_Namespace('oauth');
        $contextSwitch = $this->_helper->contextSwitch();
                if (!$contextSwitch->hasContext('html')) {
                    $contextSwitch->addContext('html', array (
                        'suffix' => '',
                    ));
                }
                $contextSwitch->setAutoDisableLayout(true)
                              ->setAutoJsonSerialization(true)
                              ->addActionContext('facebook', array ('html'))
                              ->initContext();
                              
        $this->view->googleTracker('UA-352655-7');
    }

    public function indexAction()
    {
		$username = 'Anonymous';
		$token = null;
		$username = Application_Service_Oauth::getUsername('twitter');
		$username = Application_Service_Oauth::getUsername('linkedin');
        echo 'hoi ' . $username;
        Zend_Debug::dump($token);
    }

    public function facebookAction()
    {
//		$facebook = new Wingz_Service_Facebook($this->_config->facebook);
//		if (false !== ($token = $facebook->requestToken())) {
//			$this->view->facebook = $token;
//		} else {
//			$this->view->errors = $facebook->getErrors();
//		}

        // create an oauth consumer
        $consumer = new Zend_Oauth_Consumer($this->_config->facebook);
        
        // check if there's a valid token returned
        $options = array (
            'client_id' => $this->_config->facebook->client_id,
            'client_secret' => $this->_config->facebook->consumerSecret,
            'redirect_uri' => $this->_config->facebook->redirect_uri,
        );
        $token = null;
        try {
            $token = $consumer->getRequestToken($options);
        } catch (Exception $e) {
            var_dump($e->getMessage());
            $client = Zend_Oauth_Consumer::getHttpClient();
            Zend_Debug::dump($client->getLastRequest(), 'Request');
            Zend_Debug::dump($client->getLastResponse(), 'Response');
        }
        Zend_Debug::dump($token);
    }

    public function twitterAction()
    {
		$oauth = new Application_Service_Oauth();
		$result = $oauth->authenticate('twitter', $this->getRequest(), $this->_session);
		Zend_Debug::dump($result);
		/*
        // create an oauth consumer
        $consumer = new Zend_Oauth_Consumer($this->_config->twitter);

		// let's see if the user is already known to the system
		if (isset($_COOKIE['tat'])) {
			return $this->_helper->redirector('index');
		}

		
		// check if there's a valid token returned
		if (!empty ($_GET) && isset ($this->_session->twitter_request_token)) {
			$token = $consumer->getAccessToken($_GET,
				unserialize($this->_session->twitter_request_token));
			unset ($this->_session->twitter_request_token);
			$tat = serialize($token);
			$this->_session->twitter_access_token = $tat;
			setcookie('tat', $tat, 30758400, '/');
			return $this->_helper->redirector('index');
		} else {
			// retrieve the token and store it in a session
			$token = $consumer->getRequestToken();
			$this->_session->twitter_request_token = serialize($token);

			// redirect to twitter to allow/reject your app
			$consumer->redirect();
		}
		*/
    }
    
    public function linkedinAction()
    {
		// create an oauth consumer
        $consumer = new Zend_Oauth_Consumer($this->_config->linkedin);

		// let's see if the user is already known to the system
		if (isset ($_COOKIE['lat'])) {
			return $this->_helper->redirector('index');
		}

		// check if there's a valid token returned
		if (!empty ($_GET) && isset ($this->_session->linkedin_request_token)) {
			$token = $consumer->getAccessToken($_GET,
				unserialize($this->_session->linkedin_request_token));
			unset ($this->_session->linkedin_request_token);
			$lat = serialize($token);
			$this->_session->linkedin_access_token = $lat;
			setcookie('lat', $lat, 30758400);
			return $this->_helper->redirector('index');
		} else {
			// retrieve the token and store it in a session
			$token = $consumer->getRequestToken();
			$this->_session->linkedin_request_token = serialize($token);

			// redirect to linkedin to allow/reject your app
			$consumer->redirect();
		}
    }


}





