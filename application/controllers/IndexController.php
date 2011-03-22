<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $cs = $this->_helper->contextSwitch();
        $cs->setActionContext('index', array ('xml', 'json'))
           ->setAutoDisableLayout(true)
           ->initContext();
           
        $this->view->googleTracker('UA-352655-7');
    }

    public function indexAction()
    {
        $joindin = new Wingz_Service_Joindin();
        $events = $joindin->getEvents(3);
        $this->view->assign(array (
            'events' => $events,
        ));
    }

    public function langAction()
    {
        $this->_helper->layout()->disableLayout();
        $lang = $this->getRequest()->getParam('lang', 'en');
        $locales = array ('en' => 'en_US', 'nl' => 'nl_NL');
        if (!key_exists($lang, $locales)) {
            $lang = 'en';
        }
        
        $bootstrap = $this->getInvokeArg('bootstrap');
        $bootstrap->bootstrap('translate');
        $translate = $bootstrap->getResource('translate');
        $translate->setLocale($lang);
        
        Zend_Registry::set('Zend_Translate', $translate);
        Zend_Registry::set('Zend_Locale', $lang);
        $this->view->locale = $locales[$lang];
        Zend_Debug::dump($translate, 'translate');
        Zend_Debug::dump($locales[$lang], 'locale');
    }


}



