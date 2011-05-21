<?php
class Wingz_Service_JoindinTest extends PHPUnit_Framework_TestCase
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
     * First test all is put into place before we start rolling
     */
    public function testJoindinServiceCanBeInstantiated()
    {
        $this->assertInstanceOf('Wingz_Service_Joindin', $this->_joindin);
        $this->assertInstanceOf('Wingz_Service_Joindin_Event', $this->_joindin->event());
        $this->assertInstanceOf('Wingz_Service_Joindin_Site', $this->_joindin->site());
        $this->assertInstanceOf('Wingz_Service_Joindin_Talk', $this->_joindin->talk());
        $this->assertInstanceOf('Wingz_Service_Joindin_User', $this->_joindin->user());
        $this->assertInstanceOf('Wingz_Service_Joindin_Comment', $this->_joindin->comment());
    }
}