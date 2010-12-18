<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initView()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini',
            APPLICATION_ENV);
        // Initialize view
        $view = $this->getPluginResource('view')->getView();
        $view->doctype('XHTML1_STRICT');
        $view->headTitle(sprintf('%s v%s', $config->app->name, $config->app->version));
        $view->headTitle()->setSeparator(': ');
        $view->headLink()->appendStylesheet($view->baseUrl('/css/style.css'));
        $view->headMeta()->setHttpEquiv('text/html; Charset=UTF-8', 'Content-Type');
        // Add it to the ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
            'ViewRenderer'
        );
        $viewRenderer->setView($view);
        // Return it, so that it can be stored by the bootstrap
        return $view;
    }
    
    protected function _initNavigation()
    {
        $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml');
        $navigation = new Zend_Navigation();
        $navigation->setPages($config->nav->toArray());
        $view = $this->getPluginResource('view')->getView();
        $view->navigation($navigation);
        return $view;
    }
}

