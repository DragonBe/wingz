<?php

require_once 'PHPUnit/Framework/TestCase.php';

class TwitterControllerTest extends ControllerTestCase
{
    public function testTwitterDisplaysLinkWhenNotAuthenticated()
    {
        $this->dispatch('/oauth/twitter');
        $this->assertQueryContentContains('a', 'Twitter');
    }
}

