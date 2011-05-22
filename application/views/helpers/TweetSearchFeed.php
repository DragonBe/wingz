<?php
class Application_View_Helper_TweetSearchFeed extends Zend_View_Helper_Abstract
{
    const TWITTER_SEARCH_URI = 'http://search.twitter.com/search.atom?lang=en&q=';
    const JOINDIN_HASH_SEPARATOR = ',';
    const TWITTER_SEARCH_COUNT = 5;
    public $view;
    
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }
    public function tweetSearchFeed($hashtags)
    {
        if (false !== strpos($hashtags, self::JOINDIN_HASH_SEPARATOR)) {
            $hashtags = explode(self::JOINDIN_HASH_SEPARATOR, $hashtags);
        } else {
            $hashtags = array ($hashtags);
        }
        $uri = self::TWITTER_SEARCH_URI . urlencode(array_shift($hashtags));
        $feed = array ();
        try {
            $feed = new Zend_Feed_Atom($uri);
        } catch (Zend_Feed_Exception $e) {
            // do something
        } catch (Zend_Http_Client_Exception $e) {
            // do something else
        }
        if (!empty ($feed)) {
            return $this->view->feedList($feed, self::TWITTER_SEARCH_COUNT);
        }
        return $feed;
    }
}