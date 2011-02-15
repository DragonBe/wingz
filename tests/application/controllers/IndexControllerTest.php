<?php

require_once TEST_PATH . '/ControllerTestCase.php';

class IndexControllerTest extends ControllerTestCase
{
    public function testIndexPageIsReachable()
    {
        $this->dispatch('/');
        $this->assertNotController('error');
        $this->assertNotAction('error');
        $this->assertModule('default');
        $this->assertController('index');
        $this->assertAction('index');
        $this->assertResponseCode(200);
        $this->assertQueryContentContains('h1', 'Overview of upcoming events');
    }
}

