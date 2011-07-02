<?php
class Wingz_Service_Joindin_UserTest extends PHPUnit_Framework_TestCase
{
    protected $_joindin;
    protected $_config;
    
    protected function setUp()
    {
        parent::setUp();
        $this->_joindin = new Wingz_Service_Joindin();
        $this->_joindin->getClient()->setAdapter(
            new Zend_Http_Client_Adapter_Test());
    }
    protected function tearDown()
    {
        $this->_joindin = null;
        $this->_config = null;
        parent::tearDown();
    }
    
    public function testJoindinUserDetailsRequiresUsername()
    {
        try {
            $this->_joindin->user()->getDetail();
        } catch (Wingz_Service_Joindin_Exception $e) {
            $this->assertEquals('Required username missing', $e->getMessage());
            return;
        }
        $this->fail('No exception was raised');
    }
    
    public function testJoindinUserDetailsRequiresPassword()
    {
        $this->_joindin->setUsername('test');
        try {
            $this->_joindin->user()->getDetail();
        } catch (Wingz_Service_Joindin_Exception $e) {
            $this->assertEquals('Required password missing', $e->getMessage());
            return;
        }
        $this->fail('No exception was raised');
    }
    
    public function testJoindinCanFetchUserDetails()
    {
        $response = <<<EOL
HTTP/1.1 200 OK
Content-type: text/xml

<?xml version="1.0"?>
<response>
  <item>
    <username>test</username>
    <full_name>Test User</full_name>
    <ID>1</ID>
    <last_login>946681200</last_login>
  </item>
</response>
EOL
        ;
        $this->_joindin->setUsername('test')
                       ->setPassword('whatever')
                       ->getClient()->getAdapter()->setResponse($response);
        $result = $this->_joindin->user()->getDetail();
        $this->assertXmlStringEqualsXmlFile(dirname(__FILE__) . '/_files/userdetail.xml', $result);
    }
    
    public function testJoindinReturnsErrorWhenFailureOccurs()
    {
        $response = <<<EOL
HTTP/1.1 503 Service Unavailable
EOL
        ;
        $this->_joindin->setUsername('test')
                       ->setPassword('whatever')
                       ->getClient()->getAdapter()->setResponse($response);
        try {
            $result = $this->_joindin->user()->getDetail();
        } catch (Wingz_Service_Joindin_Exception $e) {
            $this->assertEquals('Service Unavailable', $e->getMessage());
            return;
        }
        $this->fail('Exception not raised');
    }
}