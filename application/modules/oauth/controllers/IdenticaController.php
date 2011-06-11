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
        if (isset ($this->_session->identity)) {
            $identica = new Wingz_Service_Identica_Client(
                $this->_session->identity, new Zend_Http_Client());
            $response = $identica->accountVerifyCredentials();
            $status = $identica->statusesUserTimeline();
            $version = $identica->statusnetGetVersion();
            
            $form = $this->_getMessageForm();
            
            if (isset ($this->_session->messageForm)) {
                $form = unserialize($this->_session->messageForm);
                unset ($this->_session->messageForm);
            }
            
            $this->view->assign(array (
                'screenName' => $response->screen_name,
                'userName' => $response->name,
                'status' => $status,
                'version' => $version,
                'form' => $form,
            ));
        }
    }

    public function authAction()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->_helper->redirector('login', 'identica', 'oauth');
        }
        $form = $this->_getForm();
        if (!$form->isValid($this->getRequest()->getPost())) {
            $this->_session->form = serialize($form);
            return $this->_helper->redirector('login', 'identica', 'oauth');
        }
        
        $values = $form->getValues();
        $identica = new Wingz_Service_Identica_Client(
            $values, new Zend_Http_Client());
        $response = null;
        try {
            $response = $identica->accountVerifyCredentials();
        } catch (Wingz_Service_Identica_Exception $e) {
            $this->_session->form = serialize($form);
            return $this->_helper->redirector('login', 'identica', 'oauth');
        }
        $this->_session->identity = $values;
        /*
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/api.ini', APPLICATION_ENV);
        $identicaConfig = $config->identica->toArray();
        
        $consumer = new Zend_Oauth_Consumer($identicaConfig);
        
        if (!empty ($_GET) && isset ($this->_session->identica_request_token)) {
            $accessToken = $consumer->getAccessToken(
                $_GET, unserialize($this->_session->identica_request_token));
            $this->_session->identica_access_token = serialize($accessToken);
        } else {
            $requestToken = $consumer->getRequestToken();
            $this->_session->identica_request_token = serialize($requestToken);
            $consumer->redirect();
        }*/
        return $this->_helper->redirector('index', 'identica', 'oauth');
    }

    public function loginAction()
    {
        $form = $this->_getForm();
        
        if (isset ($this->_session->form)) {
            $form = unserialize($this->_session->form);
            unset ($this->_session->form);
        }
        $this->view->form = $form;
    }

    public function messageAction()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->_helper->redirector('index', 'identica', 'oauth');
        }
        $form = $this->_getMessageForm();
        if (!$form->isValid($this->getRequest()->getPost())) {
            $this->_session->messageForm = serialize($form);
            return $this->_helper->redirector('index', 'identica', 'oauth');
        }
        $values = $form->getValues();
        $identica = new Wingz_Service_Identica_Client(
            $this->_session->identity, new Zend_Http_Client());
        $response = $identica->statusesUpdate($values['message'], 
            array ('lat' => $values['latitude'], 'long' => $values['longitude']));
        unset ($this->_session->messageForm);
        return $this->_helper->redirector('index', 'identica', 'oauth');
    }

    protected function _getForm()
    {
        $form = new Oauth_Form_Identica(array (
        	'action' => $this->view->url(array (
                'module' => 'oauth',
                'controller' => 'identica',
                'action' => 'auth',
            )),
            'method' => 'post',
        ));
        return $form;
    }

    protected function _getMessageForm()
    {
        $form = new Oauth_Form_IdenticaMessage(array (
        	'action' => $this->view->url(array (
                'module' => 'oauth',
                'controller' => 'identica',
                'action' => 'message',
            )),
            'method' => 'post',
        ));
        return $form;
    }


}







