<?php
class Application_Model_RoleTest extends PHPUnit_Framework_TestCase
{
    protected $_role;
    
    protected function setUp()
    {
        parent::setUp();
        $this->_role = new Application_Model_Role();
    }
    protected function tearDown()
    {
        $this->_role = null;
        parent::tearDown();
    }
    public function testRoleIsEmpty()
    {
        $this->assertNull($this->_role->getId());
        $this->assertNull($this->_role->getName());
    }
    public function roleProvider()
    {
        return array (
            array (array ('id' => 1, 'name' => 'Tester')),
        );
    }
    /**
     * @dataProvider roleProvider
     */
    public function testRoleContainsCorrectData($data)
    {
        $this->_role->setId($data['id'])
                    ->setName($data['name']);
                    
        $this->assertSame($this->_role->toArray(), $data);
    }
    /**
     * @dataProvider roleProvider
     */
    public function testRoleCanBePopulatedAtConstruct($data)
    {
        $role = new Application_Model_Role($data);
        $this->assertSame($role->toArray(), $data);
    }
}