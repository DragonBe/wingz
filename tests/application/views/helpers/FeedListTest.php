<?php
class Application_View_Helper_FeedListTest extends PHPUnit_Framework_TestCase
{
    protected $_helper;
    protected function setUp()
    {
        parent::setUp();
        $this->_helper = new Application_View_Helper_FeedList();
    }
    protected function tearDown()
    {
        $this->_helper = null;
        parent::tearDown();
    }
    public function testHelperConvertsAtomFeedInHtmlListing()
    {
        $feed = Zend_Feed::importFile(
            APPLICATION_PATH . '/../tests/_files/hashtagsearch.xml');
        $html = $this->_helper->feedList($feed, 5);
        $dom = new Zend_Dom_Query($html);
        $query = $dom->query('li.feed-list-item');
        $this->assertSame(5, count($query));
    }
}