<?php

class Oauth_FacebookController extends Zend_Controller_Action
{
    protected $_session;
    
    public function init()
    {
        $this->_session = new Zend_Session_Namespace('facebook');
    }

    public function indexAction()
    {
        if ($this->getRequest()->getParam('access_token', false)) {
            $this->_session->facebook_access_token = $this->getRequest()->getParam('access_token');
        }
        if (isset ($this->_session->facebook_access_token)) {
            $fb = new Wingz_Service_Facebook();
            $user = $fb->getUser($this->_session->facebook_access_token);
            $events = $fb->getUserEvents($this->_session->facebook_access_token);
            $description = array ();
            foreach ($events as $event) {
                $details = $fb->getEventDetails($this->_session->facebook_access_token, $event->id);
                $description[$event->id] = isset ($details->description) ? $details->description : 'N/A';
            }
            $this->view->name = $user->name;
            $this->view->events = $events;
            $this->view->description = $description;
        }
    }

    public function authAction()
    {
        $this->_helper->layout()->disableLayout();
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/api.ini', APPLICATION_ENV);
        
        $fb = new Wingz_Service_Facebook($config->facebook);
        
        if (!empty ($_GET)) {
            if (isset ($_GET['error']) && isset ($_GET['error_description'])) {
                $this->view->message = $_GET['error_description'];
            }
            if (isset ($_GET['code'])) {
                $code = $_GET['code'];
                $this->_session->facebook_user_token = $code;
                $result = $fb->connect($code);
                if (false !== $result) {
                    $this->_session->facebook_access_token = $result['access_token'];
                    $user = $fb->getUser($result['access_token']);
                    return $this->_helper->redirector('index', 'facebook', 'oauth', array ('access_token' => $result['access_token']));
                }
            }
        } else {
            $this->view->fbConnect = $fb->authenticate();
        }
    }


}



