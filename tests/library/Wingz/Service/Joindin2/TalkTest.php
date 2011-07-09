<?php
class Wingz_Service_Joindin2_TalkTest extends PHPUnit_Framework_TestCase
{
    protected $_talk;
    
    protected function setUp()
    {
        $joindin = new Wingz_Service_Joindin2();
        $joindin->setFormat(Wingz_Service_Joindin2::JOINDIN_FORMAT_JSON);
        $joindin->getClient()->setAdapter(
            new Zend_Http_Client_Adapter_Test());
        $this->_talk = new Wingz_Service_Joindin2_Talk();
        $this->_talk->setJoindin($joindin);
        parent::setUp();
    }
    protected function tearDown()
    {
        parent::tearDown();
        $this->_talk = null;
    }
    /**
     * @expectedException Wingz_Service_Joindin2_Exception
     * @expectedExceptionMessage Service Unavailable
     */
    public function testServiceThrowsExceptionWhenNotAvailable()
    {
        $response = 'HTTP/1.1 503 Service Unavailable';
        $this->_talk->getJoindin()
                    ->getClient()
                    ->getAdapter()
                    ->setResponse($response);
        $response = $this->_talk->getTalkList(110);
    }
    public function testServiceReturnsListOfTalks()
    {
        $json = file_get_contents(
            dirname(__FILE__) . '/_files/talkList.json');
        $response = 'HTTP/1.1 200 Ok' . PHP_EOL 
                  . 'Content-type: application/json' . PHP_EOL 
                  . PHP_EOL;
        $response .= $json;
        $this->_talk->getJoindin()
                    ->getClient()
                    ->getAdapter()
                    ->setResponse($response);
        $result = $this->_talk->getTalklist(110);
        $this->assertSame(17, count($result));
    }
    public function testServiceReturnsListOfTalksInHtml()
    {
        $json = file_get_contents(
            dirname(__FILE__) . '/_files/talkList.html');
        $response = 'HTTP/1.1 200 Ok' . PHP_EOL 
                  . 'Content-type: text/html; Charset=UTF-8' . PHP_EOL 
                  . PHP_EOL;
        $response .= $json;
        $this->_talk->getJoindin()
                    ->getClient()
                    ->getAdapter()
                    ->setResponse($response);
        $this->_talk->getJoindin()->setFormat(
            Wingz_Service_Joindin2::JOINDIN_FORMAT_HTML);
        $result = $this->_talk->getTalkDetail(1240);
        
        $matcher = array (
            'tag' => 'li',
            'parent' => array ('tag' => 'ul'),
            'descendant' => array (
                'tag' => 'strong',
                'content' => 'talk_id'),
        );
        $this->assertTag($matcher, $result);
    }
    /**
     * @expectedException Wingz_Service_Joindin2_Exception
     * @expectedExceptionMessage Service Unavailable
     */
    public function testServiceThrowsExceptionForOneTalkWhenUnavailable()
    {
        $response = 'HTTP/1.1 503 Service Unavailable';
        $this->_talk->getJoindin()
                    ->getClient()
                    ->getAdapter()
                    ->setResponse($response);
        $response = $this->_talk->getTalkDetail(1240);
    }
    public function testServiceReturnsOneTalkWithId()
    {
        $json = file_get_contents(
            dirname(__FILE__) . '/_files/talkDetail.json');
        $response = 'HTTP/1.1 200 Ok' . PHP_EOL 
                  . 'Content-type: application/json' . PHP_EOL 
                  . PHP_EOL;
        $response .= $json;
        $this->_talk->getJoindin()
                    ->getClient()
                    ->getAdapter()
                    ->setResponse($response);
        $result = $this->_talk->getTalkDetail(1240);
        
        $this->assertEquals(1240, $result['talk_id']);
        $this->assertEquals(110, $result['event_id']);
        $this->assertEquals('The PHP Universe', $result['talk_title']);
        $this->assertEquals('This keynote introduces', 
            substr($result['talk_description'], 0, 23));
        $this->assertEquals('2010-01-30T00:00:00+00:00', $result['start_date']);
        $this->assertEquals('Derick Rethans', $result['speaker_name']);
        $this->assertEquals('http://api.joind.in/v2/talks/1240', $result['uri']);
        $this->assertEquals('http://api.joind.in/v2/talks/1240?verbose=yes', $result['verbose_uri']);
        $this->assertEquals('http://api.joind.in/v2/talks/1240/comments', $result['comments_link']);
        $this->assertEquals('http://api.joind.in/v2/events/110', $result['event_link']);
    }
    public function testServiceReturnsOneTalkWithIdInHtml()
    {
        $json = file_get_contents(
            dirname(__FILE__) . '/_files/talkDetail.html');
        $response = 'HTTP/1.1 200 Ok' . PHP_EOL 
                  . 'Content-type: text/html; Charset=UTF-8' . PHP_EOL 
                  . PHP_EOL;
        $response .= $json;
        $this->_talk->getJoindin()
                    ->getClient()
                    ->getAdapter()
                    ->setResponse($response);
        $this->_talk->getJoindin()->setFormat(
            Wingz_Service_Joindin2::JOINDIN_FORMAT_HTML);
        $result = $this->_talk->getTalkDetail(1240);
        
        $matcher = array (
            'tag' => 'li',
            'parent' => array ('tag' => 'ul'),
            'descendant' => array (
                'tag' => 'strong',
                'content' => 'talk_id'),
        );
        $this->assertTag($matcher, $result);
        $this->markTestIncomplete('Service HTML contains a nested value');
    }
}