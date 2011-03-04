<?php

class Oauth_FacebookController extends Zend_Controller_Action
{
    protected $_session;
    
    public function init()
    {
        $this->_helper->layout()->disableLayout();
        $this->_session = new Zend_Session_Namespace('facebook');
    }

    public function indexAction()
    {
        // action body
    }

    public function authAction()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/api.ini', APPLICATION_ENV);
        $facebookConfig = $config->facebook->toArray();
        
        $consumer = new Oauth_Model_Facebook($config->facebook);
        
        Zend_Debug::dump($consumer);die;
        
        if (!empty ($_GET) && isset ($this->_session->facebook_request_token)) {
            $accessToken = $consumer->getAccessToken(
                $_GET, unserialize($this->_session->facebook_request_token));
            $this->_session->facebook_access_token = serialize($accessToken);
        } else {
            $requestToken = $consumer->getRequestToken();
            
            Zend_Debug::dump($requestToken); die;
            
            $this->_session->facebook_request_token = serialize($requestToken);
            $consumer->redirect();
        }
        return $this->_helper->redirector('index', 'facebook', 'oauth');
    }


}



