<?php

class Oauth_Form_Identica extends Zend_Form
{

    public function init()
    {
        $this->addElement('text', 'username', array (
            'Label' => 'Username',
            'Required' => true,
            'filters' => array (),
            'validators' => array (),
        ));
        $this->addElement('password', 'password', array (
            'Label' => 'Password',
            'Required' => true,
            'Filters' => array (),
            'Validators' => array (),
        ));
        $this->addElement('hash', 'token');
        $this->addElement('submit', 'login', array (
            'Label' => 'Login',
            'Ignore' => true,
        ));
    }


}

