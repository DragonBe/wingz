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
    }

    public function indexAction()
    {
		$username = 'Anonymous';
		if ($tat = $_COOKIE['tat']) {
			$token = unserialize($tat);
			$username = $token->getParam('screen_name');
			setcookie('tat', $tat, 30758400, '/', $_SERVER['HTTP_HOST'], false);
		}
        echo 'hoi ' . $username;
    }

    public function facebookAction()
    {
		$facebook = new Wingz_Service_Facebook($this->_config->facebook);
		if (false !== ($token = $facebook->requestToken())) {
			$this->view->facebook = $token;
		} else {
			$this->view->errors = $facebook->getErrors();
		}
    }

    public function twitterAction()
    {
		// create an oauth consumer
        $consumer = new Zend_Oauth_Consumer($this->_config->twitter);

		// check if there's a valid token returned
		if (!empty ($_GET) && isset ($this->_session->twitter_request_token)) {
			$token = $consumer->getAccessToken($_GET,
				unserialize($this->_session->twitter_request_token));
			unset ($this->_session->twitter_request_token);
			$tat = serialize($token);
			$this->_session->twitter_access_token = $tat;
			setcookie('tat', $tat, 30758400, '/', $_SERVER['HTTP_HOST'], false);
			return $this->_helper->redirector('index');
		} else {
			// retrieve the token and store it in a session
			$token = $consumer->getRequestToken();
			$this->_session->twitter_request_token = serialize($token);

			// redirect to twitter to allow/reject your app
			$consumer->redirect();
		}
    }


}





