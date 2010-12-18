<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $cs = $this->_helper->contextSwitch();
        $cs->setActionContext('index', array ('xml', 'json'))
           ->setAutoDisableLayout(true)
           ->initContext();
    }

    public function indexAction()
    {
        $joindin = new Application_Service_Joindin();
        $events = $joindin->getEvents();
        $this->view->assign(array (
            'events' => $events,
        ));
    }


}

