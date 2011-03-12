<?php

class Oauth_IdenticaController extends Zend_Controller_Action
{

    public function init()
    {
//        $this->_helper->layout()->disableLayout();
        $this->_session = new Zend_Session_Namespace('identica');
    }

    public function indexAction()
    {
        $accessToken = $userName = $screenName = null;
        if (isset ($this->_session->identica_access_token)) {
            $accessToken = unserialize($this->_session->identica_access_token);
            
            $identica = new Wingz_Service_Identica(array ('accessToken' => $accessToken));
            $account = $identica->accountVerifyCredentials();
            
            if (!isset ($this->_session->identica_user_name)) {
                $userName = (string) $account->name;
                $this->_session->identica_user_name = $userName;
            } else {
                $userName = $this->_session->identica_user_name;
            }
            
            if (!isset ($this->_session->identica_screen_name)) {
                $screenName = (string) $account->screen_name;
                $this->_session->identica_screen_name = $screenName;
            } else {
                $screenName = $this->_session->identica_screen_name;
            }
        }
        
        $this->view->accessToken = $accessToken;
        $this->view->screenName = $screenName;
        $this->view->userName = $userName;
    }

    public function authAction()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/api.ini', APPLICATION_ENV);
        $identicaConfig = $config->identica->toArray();
        
        $consumer = new Zend_Oauth_Consumer($identicaConfig);
        
        if (!empty ($_GET) && isset ($this->_session->identica_request_token)) {
            $accessToken = $consumer->getAccessToken(
                $_GET, unserialize($this->_session->identica_request_token));
            $this->_session->identica_access_token = serialize($accessToken);
        } else {
            $requestToken = $consumer->getRequestToken();
//            Zend_Debug::dump($requestToken);die;
            $this->_session->identica_request_token = serialize($requestToken);
            $consumer->redirect();
        }
        return $this->_helper->redirector('index', 'identica', 'oauth');
    }


}



