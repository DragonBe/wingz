<?php
class Wingz_Service_Joindin_SiteTest extends PHPUnit_Framework_TestCase
{
    protected $_joindin;
    protected $_live = false;
    
    protected function setUp()
    {
        parent::setUp();
        $this->_joindin = new Wingz_Service_Joindin();
        if (false === $this->_live) {
            $httpAdapter = new Zend_Http_Client_Adapter_Test();
            $this->_joindin->getClient()->setAdapter($httpAdapter);
        }
    }
    protected function tearDown()
    {
        $this->_joindin = null;
        parent::tearDown();
    }
    
    /**
     * Test the status of the joindin webservice
     */
    public function testJoindinServiceStatus()
    {
        $response = <<<EOL
HTTP/1.1 200 OK
Content-type: text/xml

<?xml version="1.0"?>
<response>
  <dt>Sun, 01 May 2011 01:00:00 +0000</dt>
  <test_string>this is a test</test_string>
</response>
EOL;
        if (false === $this->_live) {
            $this->_joindin->getClient()->getAdapter()->setResponse($response);
        } else {
            $this->markTestSkipped('Cannot predict time');
        }
        $this->assertXmlStringEqualsXmlFile(
            dirname(__FILE__) . '/_files/status.xml', 
            $this->_joindin->site()->getStatus('this is a test')); 
    }
    
    public function testJoindinResponseReturnsError()
    {
        $resonse = <<<EOL
HTTP/1.1 400 Bad Request
Content-type: text/xml

<?xml version="1.0"?>
<response>
    <message>Server made a booboo</message>
</response>
EOL;
        if (false === $this->_live) {
            $this->_joindin->getClient()->getAdapter()->setResponse($response);
        }
        try {
            $status = $this->_joindin->site()->getStatus();
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }
        Zend_Debug::dump($status);
    }
}