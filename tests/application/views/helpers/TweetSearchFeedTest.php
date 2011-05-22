<?php
class Application_View_Helper_TweetSearchFeedTest extends PHPUnit_Framework_TestCase
{
    protected $_helper;
    
    protected function setUp()
    {
        $this->_helper = new Application_View_Helper_TweetSearchFeed();
        parent::setUp();
    }
    protected function tearDown()
    {
        parent::tearDown();
        $this->_helper = null;
    }
    public function testSearchReturnsTweets()
    {
        $this->markTestIncomplete('Not sure yet how to test view helpers');
        $feed = $this->_helper->tweetSearchFeed('#test');
        if (empty ($feed)) {
            $this->markTestSkipped('Skipping because of connectivity issues');
        }
        $dom = new Zend_Dom_Query($feed);
        $query = $dom->query('li.feed-list-item');
        $this->assertSame(10, count($query));
    }
}