<?php
class Wingz_Service_Joindin2Test extends PHPUnit_Framework_TestCase
{
    protected $_joindin;
    
    protected function setUp()
    {
        $this->_joindin = new Wingz_Service_joindin2();
        parent::setUp();
    }
    protected function tearDown()
    {
        parent::tearDown();
        $this->_joindin = null;
    }
    public function testClientUsesVersion2OfApi()
    {
        $this->assertEquals('http://api.joind.in/v2',
            Wingz_Service_Joindin2::JOINDIN_API_BASE);
    }
    public function testClientUsesAZendHttpClient()
    {
        $this->assertInstanceOf('Zend_Http_Client', $this->_joindin->getClient());
    }
    public function testClientIsNonVerbosePerDefault()
    {
        $this->assertFalse($this->_joindin->isVerbose());
    }
    public function testClientCanBeSetToVerbose()
    {
        $this->_joindin->setVerbose('true');
        $this->assertTrue($this->_joindin->isVerbose());
    }
    public function testClientOffsetIsNullAsDefault()
    {
        $this->assertNull($this->_joindin->getStart());
    }
    public function testClientOffsetCanBeGivenAValue()
    {
        $this->_joindin->setStart(10);
        $this->assertSame(10, $this->_joindin->getStart());
    }
    public function testClientResultsPerPageIsNullAsDefault()
    {
        $this->assertNull($this->_joindin->getResultsPerPage());
    }
    public function testClientResultsPerPageCanBeGivenAValue()
    {
        $this->_joindin->setResultsPerPage(20);
        $this->assertSame(20, $this->_joindin->getResultsPerPage());
    }
    public function testClientDefaultResponseIsHtml()
    {
        $this->assertEquals('html', $this->_joindin->getFormat());
    }
    public function testClientDefaultCanBeSetToJson()
    {
        $this->_joindin->setFormat('json');
        $this->assertEquals('json', $this->_joindin->getFormat());
    }
}