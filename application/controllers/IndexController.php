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
        $events = $joindin->event()->getListing(
            Wingz_Service_Joindin_Event::LISTING_UPCOMING, 3);
        $this->view->assign(array (
            'events' => simplexml_load_string($events),
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

    public function eventAction()
    {
        $id = $this->getRequest()->getParam('id', null);
        if (null === $id) {
            return $this->_helper->redirector('index');
        }
        $joindin = new Wingz_Service_Joindin();
        $event = $joindin->event()->getEventDetail($id);
        $xml = simplexml_load_string($event);
//        $this->getResponse()->setHeader('Content-type', 'text/xml');
//        $this->_helper->layout()->disableLayout();
//        $this->_helper->viewRenderer->setNoRender(true);
//        echo $xml->asXML();
        $this->view->event = $xml;
    }


}





