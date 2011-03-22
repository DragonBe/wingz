<?php
class Wingz_View_Helper_EventListItemTest extends PHPUnit_Framework_TestCase
{
    protected $_eventListItem;
    
    protected function setUp()
    {
        parent::setUp();
        $this->_eventListItem = new Wingz_View_Helper_EventListItem();
        $this->_eventListItem->setView(new Zend_View());
    }
    
    protected function tearDown()
    {
        $this->_eventListItem = null;
        parent::tearDown();
    }
    
    public function testViewHelperGeneratesTemplate()
    {
        $event = new Wingz_Model_Event();
        $event->setTitle('Test event')
              ->setAbstract('This is a test abstract')
              ->setDescription('This is test event description')
              ->setUrl('http://example.com')
              ->setHashtag('#testevent');
        $expected = <<<EOS
<div class="eventBox">
  <h2 class="eventTitle"><a href="http://example.com" title="Test event">Test event</a></h2>
  <div class="eventAbstract">
    <div class="eventDescription">
      <p>This is a test abstract</p>
    </div>
  </div>
  <div class="clear">&nbsp;</div>
  <div class="eventHashtag">Tagged as <a href="http://hashtags.org/testevent" title="testevent">testevent</a></div>
</div>

EOS
;
        $this->assertSame($expected, $this->_eventListItem->eventListItem($event));
    }
}