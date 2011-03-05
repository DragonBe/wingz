<?php
class Application_View_Helper_FacebookLogin extends Zend_View_Helper_Abstract
{
    public $view;
    
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }
    /**
     * Provides a facebook login button
     * 
     * @param 	array|string $url The url this button should point to
     * @param 	string $label The label for the login button
     * @return	string The HTML code for generating such a button
     */
    public function facebookLogin($url, $label = 'Login with Facebook')
    {
        if (is_array($url)) {
            $url = $this->view->url($url, null, true);
        }
        $this->view->headLink()->appendStylesheet(
            $this->view->baseUrl('/css/facebook.css'));
        $html = array ();
        $html[] = sprintf('<a class="fb_button" href="%s" title="%s">',
                    $url, $this->view->escape($label));
        $html[] = sprintf('<span class="fb_button_text">%s</span>', 
                    $this->view->escape($label));
        $html[] = '</a>';
        return implode('', $html);
    }
}