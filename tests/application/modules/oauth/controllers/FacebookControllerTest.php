<?php

class FacebookControllerTest extends ControllerTestCase
{
    public function testButtonDisplayedWithoutFacebookConnect()
    {
        $this->dispatch('/oauth/facebook');
        $this->assertQuery('a.fb_button');
        $this->assertQuery('span.fb_button_text');
        $this->assertQueryContentContains('span.fb_button_text', 'Login with Facebook');
    }
}

