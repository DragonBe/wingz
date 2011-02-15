<?php

require_once TEST_PATH . '/ControllerTestCase.php';

class ErrorControllerTest extends ControllerTestCase
{
    public function testErrorPageIsApproachableAndDisplaysMessage()
    {
        $this->dispatch('/error/error');
        $this->assertModule('default');
        $this->assertController('error');
        $this->assertAction('error');
        $this->assertResponseCode(200);
        $this->assertQueryContentContains('h1', 'An error occurred');
        $this->assertQueryContentContains('h2', 'You have reached the error page');
    }
    
    public function testBogusPageReturnsPageNotFound()
    {
        $this->dispatch('/foo');
        $this->assertModule('default');
        $this->assertController('error');
        $this->assertAction('error');
        $this->assertResponseCode(404);
    }
    
}

