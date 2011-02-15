<?php

require_once TEST_PATH . '/ControllerTestCase.php';

class FaqControllerTest extends ControllerTestCase
{
    public function testFaqPageDisplaysQuestions()
    {
        $this->dispatch('/faq');
        $this->assertNotController('error');
        $this->assertNotAction('error');
        $this->assertModule('default');
        $this->assertController('faq');
        $this->assertAction('index');
        $this->assertResponseCode(200);
        $this->assertQuery('h1');
        $this->assertQueryCount('h1#faqTitle', 1);
        $this->assertQueryContentContains('h1#faqTitle', 'Frequently asked questions');
    }
}

