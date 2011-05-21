<?php
class Application_View_Helper_Qrcode extends Zend_View_Helper_Abstract
{
    public $view;
    
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }
    public function qrcode($string, $type = 'url')
    {
        return sprintf('<img src="%s" width="232" height="232" alt="QRCode"/>',
            $this->view->url(array (
                'module' => 'default',
                'controller' => 'index',
                'action' => 'qrcode',
                'data' => urlencode($string),
            ), null, true));
    }
}