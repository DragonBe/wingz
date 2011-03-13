<?php

class Oauth_Form_IdenticaMessage extends Zend_Form
{

    public function init()
    {
        $this->addElement('textarea', 'message', array (
            'label' => 'Message',
            'cols' => 40,
            'rows' => 6,
        ));
        $this->addElement('submit', 'send', array (
            'Label' => 'Send',
            'Ignore' => true,
        ));
        $this->addElement('hidden', 'latitude');
        $this->addElement('hidden', 'longitude');
        $this->addElement('hash', 'token');
    }


}

