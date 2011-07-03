<?php
class Wingz_Service_Joindin2_EventTest extends PHPUnit_Framework_TestCase
{
    protected $_event;
    
    protected function setUp()
    {
        $joindin = new Wingz_Service_Joindin2();
        $joindin->setFormat(Wingz_Service_Joindin2::JOINDIN_FORMAT_JSON)
                ->setResultsPerPage(5);
        $joindin->getClient()
                ->setAdapter(new Zend_Http_Client_Adapter_Test());
        $this->_event = new Wingz_Service_Joindin2_Event();
        $this->_event->setJoindin($joindin);
        parent::setUp(); 
    }
    protected function tearDown()
    {
        parent::tearDown();
        $this->_event = null;
    }
    /**
     * @expectedException Wingz_Service_Joindin2_Exception
     * @expectedExceptionMessage Service Unavailable
     */ 
    public function testRetrievalFailsThrowsException()
    {
        $response = 'HTTP/1.1 503 Service Unavailable';
        $this->_event->getJoindin()
                     ->getClient()
                     ->getAdapter()
                     ->setResponse($response);
        $result = $this->_event->getEventList();
    }
    public function testRetrieveListingOfEvents()
    {
        $json = file_get_contents(
            dirname(__FILE__) . '/_files/eventList.json');
        $response = 'HTTP/1.1 200 Ok' . PHP_EOL 
                  . 'Content-type: application/json' . PHP_EOL 
                  . PHP_EOL;
        $response .= $json;
        $this->_event->getJoindin()
                     ->getClient()
                     ->getAdapter()
                     ->setResponse($response);
        $result = $this->_event->getEventList();
        $this->assertSame(3, count($result));
    }
    public function testRetrievalOfOneEvent()
    {
        $json = file_get_contents(
            dirname(__FILE__) . '/_files/eventItem.json');
        $response = 'HTTP/1.1 200 Ok' . PHP_EOL 
                  . 'Content-type: application/json' . PHP_EOL 
                  . PHP_EOL;
        $response .= $json;
        $this->_event->getJoindin()
                     ->getClient()
                     ->getAdapter()
                     ->setResponse($response);
        $result = $this->_event->getEvent(110);
        
        $this->assertEquals(1, $result['event_id']);
        $this->assertEquals('Test event number 1', $result['name']);
        $this->assertEquals('2011-06-30T19:30:00+02:00', 
            $result['start_date']);
        $this->assertEquals('2011-06-30T23:59:59+02:00', 
            $result['end_date']);
        $this->assertEquals('Test event number 1 description',
            $result['description']);
        $this->assertEquals('', $result['icon']);
        $this->assertEquals('http://api.joind.in/v2/events/1', $result['uri']);
        $this->assertEquals('http://api.joind.in/v2/events/1?verbose=yes', 
            $result['verbose_uri']);
        $this->assertEquals('http://api.joind.in/v2/events/1/comments', 
            $result['comments_link']);
        $this->assertEquals('http://api.joind.in/v2/events/1/talks',
            $result['talks_link']);
    }
}