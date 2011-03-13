<?php
require_once 'Wingz/Model/EventLogo.php';
require_once 'PHPUnit/Framework/TestCase.php';
/**
 * Wingz_Model_EventLogo test case.
 */
class Wingz_Model_EventLogoTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Wingz_Model_EventLogo
     */
    private $_logo;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        // TODO Auto-generated Wingz_Model_EventLogoTest::setUp()
        $this->_logo = new Wingz_Model_EventLogo(/* parameters */);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated Wingz_Model_EventLogoTest::tearDown()
        $this->_logo = null;
        parent::tearDown();
    }
    /**
     * Constructs the test case.
     */
    public function __construct ()
    {
        // TODO Auto-generated constructor
    }
    /**
     * Tests Wingz_Model_EventLogo->setUrl()
     */
    public function testSetUrl ()
    {
        $url = 'http://www.example.com';
        $this->_logo->setUrl($url);
        $this->assertAttributeEquals($url, '_url', $this->_logo);
        return $this->_logo;
    }
    /**
     * Tests Wingz_Model_EventLogo->getUrl()
     * 
     * @depends testSetUrl
     */
    public function testGetUrl (Wingz_Model_EventLogo $logo)
    {
        $this->assertEquals('http://www.example.com', $logo->getUrl());
    }
    /**
     * Tests Wingz_Model_EventLogo->setWidth()
     */
    public function testSetWidth ()
    {
        $this->_logo->setWidth(80);
        $this->assertAttributeSame(80, '_width', $this->_logo);
        return $this->_logo;
    }
    /**
     * Tests Wingz_Model_EventLogo->getWidth()
     * 
     * @depends testSetWidth
     */
    public function testGetWidth (Wingz_Model_EventLogo $logo)
    {
        $this->assertSame(80, $logo->getWidth());
    }
    /**
     * Tests Wingz_Model_EventLogo->setHeight()
     */
    public function testSetHeight ()
    {
        $this->_logo->setHeight(80);
        $this->assertAttributeSame(80, '_height', $this->_logo);
        return $this->_logo;
    }
    /**
     * Tests Wingz_Model_EventLogo->getHeight()
     * 
     * @depends testSetHeight
     */
    public function testGetHeight (Wingz_Model_EventLogo $logo)
    {
        $this->assertSame(80, $logo->getHeight());
    }
    /**
     * Tests Wingz_Model_EventLogo->setHeight()
     */
    public function testSetAlt ()
    {
        $this->_logo->setAlt('alt text');
        $this->assertAttributeEquals('alt text', '_alt', $this->_logo);
        return $this->_logo;
    }
    /**
     * Tests Wingz_Model_EventLogo->getAlt()
     * 
     * @depends	testSetAlt
     */
    public function testGetAlt (Wingz_Model_EventLogo $logo)
    {
        $this->assertEquals('alt text', $logo->getAlt());
    }
    /**
     * Test Wingz_Mode_EventLogo->populate()
     */
    public function testPopulate()
    {
        $data = $this->getData();
        $this->_logo->populate($data);
        $this->assertSame($data['url'], $this->_logo->getUrl());
        $this->assertSame($data['width'], $this->_logo->getWidth());
        $this->assertSame($data['height'], $this->_logo->getHeight());
        $this->assertEquals($data['alt'], $this->_logo->getAlt());
        return $this->_logo;
    }
    /**
     * Tests Wingz_Model_EventLogo->toArray()
     * 
     * @depends testPopulate
     */
    public function testToArray (Wingz_Model_EventLogo $logo)
    {
        $this->assertSame($logo->toArray(), $this->getData());
    }
    /**
     * Test Wingz_Model_EventLogo->__construct()
     */
    public function testConstructWithArray()
    {
        $logo = new Wingz_Model_EventLogo($this->getData());
        $this->assertSame($this->getData(), $logo->toArray());
    }
    /**
     * Test Wingz_Model_EventLogo->__construct()
     */
    public function testConstructWithParams()
    {
        $data = $this->getData();
        $logo = new Wingz_Model_EventLogo($data['url'], $data['width'], $data['height'], $data['alt']);
        $this->assertSame($data, $logo->toArray());
    }
    /**
     * Test Wingz_Model_EventLogo->__toString()
     * 
     * @depends testPopulate
     */
    public function testToString(Wingz_Model_EventLogo $logo)
    {
        $this->assertEquals('<img src="http://www.example.com" width="80" height="80" alt="alt text"/>', (string) $logo);
    }
    public function getData()
    {
        return array (
            'url' => 'http://www.example.com',
            'width' => 80,
            'height' => 80,
            'alt' => 'alt text',
        );
    }
}

