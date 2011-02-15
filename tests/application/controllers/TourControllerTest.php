<?php

require_once TEST_PATH . '/ControllerTestCase.php';

class TourControllerTest extends ControllerTestCase
{
    public function testTourPageDisplaysStepsToStart()
    {
        $this->dispatch('/tour');
        $this->assertNotController('error');
        $this->assertNotAction('error');
        $this->assertModule('default');
        $this->assertController('tour');
        $this->assertAction('index');
        $this->assertResponseCode(200);
        $this->assertQuery('h1');
        $this->assertQueryCount('h1#tourTitle', 1);
        $this->assertQueryContentContains('h1#tourTitle', 'Steps to automate deployment');
    }
}

