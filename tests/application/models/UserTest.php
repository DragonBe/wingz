<?php
class Application_Model_UserTest extends PHPUnit_Framework_TestCase
{
    protected $_user;
    
    protected function setUp()
    {
        parent::setUp();
        $this->_user = new Application_Model_User();
    }
    public function tearDown()
    {
        $this->_user = null;
        parent::tearDown();
    }
    public function testModelIsEmpty()
    {
        $this->assertNull($this->_user->getId());
        $this->assertNull($this->_user->getUsername());
        $this->assertNull($this->_user->getPassword());
        $this->assertNull($this->_user->getEmail());
    }
    public function userDataProvider()
    {
        return array (
            array (array (
                'id'        => 1,
                'username'  => 'testuser',
                'password'  => 'verysecret',
                'email'		=> 'test@example.com',
                'role'      => array (
                    'id'   => 1,
                    'name' => 'testuser',
                ),
            ))
        );
    }
    /**
     * @dataProvider userDataProvider
     */
    public function testUserContainsCorrectData($data)
    {
        $this->_user->setId($data['id'])
                    ->setUsername($data['username'])
                    ->setPassword($data['password'])
                    ->setEmail($data['email'])
                    ->setRole($data['role']);
        $this->assertSame($this->_user->toArray(), $data);
    }
    /**
     * @dataProvider userDataProvider
     */
    public function testUserCanBePopulatedAtConstruct($data)
    {
        $user = new Application_Model_User($data);
        $this->assertSame($user->toArray(), $data);
    }
}