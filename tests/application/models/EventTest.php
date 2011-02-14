<?php
class Application_Model_EventTest extends PHPUnit_Framework_TestCase
{
    protected $_event;
    
    protected function setUp()
    {
        parent::setUp();
        $this->_event = new Application_Model_Event();
    }
    protected function tearDown()
    {
        $this->_event = null;
        parent::tearDown();
    }
    public function testEventIsEmpty()
    {
        $this->assertNull($this->_event->getId());
        $this->assertNull($this->_event->getName());
        $this->assertInstanceOf('DateTime', $this->_event->getStart());
        $this->assertInstanceOf('DateTime', $this->_event->getEnd());
    }
    public function eventProvider()
    {
        return array (
            array (array (
                'id' => 1,
                'name' => 'Testing Event',
                'start' => '2010-01-01 10:00:00',
                'end' => '2010-01-01 18:00:00',
            )),
        );
    }
    /**
     * @dataProvider eventProvider
     */
    public function testEventCanContainData($data)
    {
        $this->_event->populate($data);
        $this->assertSame($this->_event->toArray(), $data);
    }
}