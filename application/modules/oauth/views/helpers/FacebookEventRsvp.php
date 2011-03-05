<?php
class Oauth_View_Helper_FacebookEventRsvp extends Zend_View_Helper_Abstract
{
    public $view;
    
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }
    public function facebookEventRsvp($status)
    {
        $statusLabel = array (
            'attending' => 'I\'m attending',
            'unsure' => 'Maybe',
        );
        $defaultLabel = 'Not attending';
        $label = isset ($statusLabel[$status]) ? $statusLabel[$status] : $defaultLabel;
        return sprintf('<span class="%s">%s</span>',
            $status, $label);
    }
}