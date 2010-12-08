<?php

class OauthController extends Zend_Controller_Action
{
    public function init()
    {
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
        echo 'hoi';
    }

    public function facebookAction()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/api.ini');
        $facebook = new Wingz_Service_Facebook($config->facebook);
        if (false !== ($token = $facebook->requestToken())) {
            $this->view->facebook = $token;
        } else {
            $this->view->errors = $facebook->getErrors();
        }
    }


}



