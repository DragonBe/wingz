<?php
/**
 * Wingz: Write PHP, deploy anywhere
 * 
 * Wingz is an example application that uses a fully working Zend Framework
 * application that can run on Linux w/ Apache, Microsoft Windows w/ IIS and
 * on Microsoft Windows Azure w/ IIS.
 * 
 * @license		CreativeCommons-Attribution-ShareAlike
 * @link        http://creativecommons.org/licenses/by-sa/3.0/
 * @category	Wingz
 */
class Wingz_View_Helper_FacebookLike extends Zend_View_Helper_Abstract
{
    /**
     * @var 	Zend_View_Interface
     */
    public $view;
    
    public function facebookLike($href = null, $self = true)
    {
        if (null === $href) {
            $href = $_SERVER['REQUEST_URI'];
        }
        if (true === $self) {
            $href = sprintf('%s://%s%s',
                isset ($_SERVER['HTTPS']) ? 'https' : 'http',
                $_SERVER['HTTP_HOST'],
                $href
            );
        }
        return sprintf('<iframe src="http://www.facebook.com/widgets/like.php?href=%s"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe>',
        urlencode($href));
    }
    
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }
}