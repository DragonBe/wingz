<?php

require_once 'PHPUnit/Framework/TestCase.php';
require_once TEST_PATH . '/ControllerTestCase.php';
class TwitterControllerTest extends ControllerTestCase
{
    public function testTwitterDisplaysLinkWhenNotAuthenticated()
    {
        $this->dispatch('/oauth/twitter');
        $this->assertQueryContentContains('a', 'Twitter');
    }
}

