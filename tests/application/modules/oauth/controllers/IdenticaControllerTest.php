<?php

class Oauth_IdenticaControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testIndexAction()
    {
        $params = array('action' => 'index', 'controller' => 'Identica', 'module' => 'oauth');
        $url = $this->url($this->urlizeOptions($params));
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($params['module']);
        $this->assertController($params['controller']);
        $this->assertAction($params['action']);
        $this->assertQueryContentContains('a', 'Identi.ca');
    }

    public function testAuthAction()
    {
        $params = array('action' => 'auth', 'controller' => 'Identica', 'module' => 'oauth');
        $url = $this->url($this->urlizeOptions($params));
        $this->dispatch($url);
        
        $this->assertResponseCode(302);
        $this->assertRedirectTo('/oauth/identica/login');
    }

    public function testLoginAction()
    {
        $params = array('action' => 'login', 'controller' => 'Identica', 'module' => 'oauth');
        $url = $this->url($this->urlizeOptions($params));
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($params['module']);
        $this->assertController($params['controller']);
        $this->assertAction($params['action']);
        $this->assertQuery('dl.zend_form');
    }

    public function testMessageAction()
    {
        $params = array('action' => 'message', 'controller' => 'Identica', 'module' => 'oauth');
        $url = $this->url($this->urlizeOptions($params));
        $this->dispatch($url);
        
        // assertions
        $this->assertResponseCode(302);
        $this->assertRedirectTo('/oauth/identica');
    }


}









