<?php
class Application_View_Helper_HashtagFilter extends Zend_View_Helper_Abstract
{
    protected $_view;
    public function setView(Zend_View_Interface $view)
    {
        $this->_view = $view;
    }
    public function hashtagFilter($hashtag)
    {
        if (false !== strpos($hashtag, ',')) {
            $hashtag = explode(',', $hashtag);
        } else {
            $hashtag = array ($hashtag);
        }
        $tags = array ();
        foreach ($hashtag as $tag) {
            $tag = trim($tag);
            if (false === strpos($tag, '#')) {
                $tags[] = '#' . $tag;
            } else {
                $tags[] = $tag;
            }
        }
        return implode(', ', $tags);
    }
}