<?php

class Oauth_TwitterController extends Zend_Controller_Action
{

    protected $_session = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->layout()->disableLayout();
        $this->_session = new Zend_Session_Namespace('twitter');
    }

    public function indexAction()
    {
        $accessToken = $userName = $screenName = null;
        if (isset ($this->_session->twitter_access_token)) {
            $accessToken = unserialize($this->_session->twitter_access_token);
            
            $twitter = new Zend_Service_Twitter(array ('accessToken' => $accessToken));
            $account = $twitter->accountVerifyCredentials();
            
            if (!isset ($this->_session->twitter_user_name)) {
                $userName = (string) $account->name;
                $this->_session->twitter_user_name = $userName;
            } else {
                $userName = $this->_session->twitter_user_name;
            }
            
            if (!isset ($this->_session->twitter_screen_name)) {
                $screenName = (string) $account->screen_name;
                $this->_session->twitter_screen_name = $screenName;
            } else {
                $screenName = $this->_session->twitter_screen_name;
            }
        }
        
        $this->view->accessToken = $accessToken;
        $this->view->screenName = $screenName;
        $this->view->userName = $userName;
    }

    public function authAction()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/api.ini', APPLICATION_ENV);
        $twitterConfig = $config->twitter->toArray();
        
        $consumer = new Zend_Oauth_Consumer($twitterConfig);
        
        if (!empty ($_GET) && isset ($this->_session->twitter_request_token)) {
            $accessToken = $consumer->getAccessToken(
                $_GET, unserialize($this->_session->twitter_request_token));
            $this->_session->twitter_access_token = serialize($accessToken);
        } else {
            $requestToken = $consumer->getRequestToken();
            $this->_session->twitter_request_token = serialize($requestToken);
            $consumer->redirect();
        }
        return $this->_helper->redirector('index', 'twitter', 'oauth');
    }


}



