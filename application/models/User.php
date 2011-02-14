<?php
/**
 * Wingz: Write PHP, deploy anywhere
 * 
 * Wingz is an example application that uses a fully working Zend Framework
 * application that can run on Linux w/ Apache, Microsoft Windows w/ IIS and
 * on Microsoft Windows Azure w/ IIS.
 * 
 * @license		CreativeCommons-Attribution-ShareAlike
 * @link        http://creativecommons.org/licenses/by-sa/3.0/
 * @category	Wingz
 */
class Application_Model_User extends Application_Model_Abstract
{
    /**
     * @var 	int The ID of this User
     */
    protected $_id;
	/**
	 * @var		string The first name of this User
	 */
	protected $_firstName;
	/**
	 * @var		string The last name of this User
	 */
	protected $_lastName;
    /**
     * @var 	string The username of this User
     */
    protected $_username;
    /**
     * @var 	string The password of this User
     */
    protected $_password;
    /**
     * @var 	string The email address of this User
     */
    protected $_email;
    /**
     * @var 	Application_Model_Role The role of this User
     */
    protected $_role;
    
    /**
     * Constructor for this User
     * 
     * Instantiates a User object and populates it with optionally provided
     * data
     * 
     * @param 	null|array|Zend_Db_Table_Row $params
     */
    public function __construct($params = null)
    {
        $this->_role = new Application_Model_Role();
        if (null !== $params) {
            $this->populate($params);
        }
    }
    /**
     * Sets the ID for this User
     * 
     * @param 	int $id
     * @return	Application_Model_User
     */
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
    /**
     * Retrieves the ID from this User
     * 
     * @return	int
     */
    public function getId()
    {
        return $this->_id;
    }
	/**
	 * Sets the first name for this User
	 *
	 * @params	string $firstName
	 * @return	Application_Model_User
	 */
	public function setFirstName($firstName)
	{
		$this->_firstName = (string) $firstName;
		return $this;
	}
	/**
	 * Retrieves the first name from this User
	 *
	 * @return	string
	 */
	public function getFirstName()
	{
		return $this->_firstName;
	}
	/**
	 * Sets the last name for this User
	 *
	 * @param	string $lastName
	 * @return	Application_Model_User
	 */
	public function setLastName($lastName)
	{
		$this->_lastName = (string) $lastName;
		return $this;
	}
	/**
	 * Retrieves the last name from this User
	 *
	 * @return	string
	 */
	public function getLastName()
	{
		return $this->_lastName;
	}
    /**
     * Sets the username for this User
     * 
     * @param 	string $username
     * @return	Application_Model_User
     */
    public function setUsername($username)
    {
        $this->_username = (string) $username;
        return $this;
    }
    /**
     * Retrieve the username from this User
     * 
     * @return	string
     */
    public function getUsername()
    {
        return $this->_username;
    }
    /**
     * Sets the password for this User
     * 
     * @param 	string $password
     * @return	Application_Model_User
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }
    /**
     * Retrieves the password from this User
     * 
     * @return	string
     */
    public function getPassword()
    {
        return $this->_password;
    }
    /**
     * Sets the email address for this User
     * 
     * @param 	string $email
     * @return	Application_Model_User
     */
    public function setEmail($email)
    {
        $this->_email = (string) $email;
        return $this;
    }
    /**
     * Retrieves the email address from this User
     * 
     * @return	string
     */
    public function getEmail()
    {
        return $this->_email;
    }
	public function getMapper()
	{
		if (null === $this->_mapper) {
			$this->setMapper('Application_Model_Mapper_User');
		}
		return $this;
	}
    /**
     * Sets the role for this User
     * 
     * @param 	array|Application_Model_Role $role
     * @return	Application_Model_User
     */
    public function setRole($role)
    {
        if (is_array($role)) {
            $this->_role = new Application_Model_Role($role);
        } elseif ($role instanceof Application_Model_Role) {
            $this->_role = $role;
        } else {
            throw new Zend_Exception('No valid role provided');
        }
        return $this;
    }
    /**
     * Retrieves the role from this User
     * 
     * @return	Application_Model_Role
     */
    public function getRole()
    {
        return $this->_role;
    }
    /**
     * Populates this model with data
     * 
     * @param 	array|Zend_Db_Table_Row $row
     * @return	Application_Model_User
     */
    public function populate($row)
    {
        if (is_array($row)) {
            $row = new ArrayObject($row, ArrayObject::ARRAY_AS_PROPS);
        }
        if (isset ($row->id)) { $this->setId($row->id); }
		if (isset ($row->firstname)) { $this->setFirstName($row->firstname); }
		if (isset ($row->lastname)) { $this->setLastName($row->lastname); }
        if (isset ($row->username)) { $this->setUsername($row->username); }
        if (isset ($row->password)) { $this->setPassword($row->password); }
        if (isset ($row->email)) { $this->setEmail($row->email); }
        if (isset ($row->role)) { $this->setRole($row->role); }
        return $this;
    }
    /**
     * Retrieves this usr model as an array
     * 
     * @return	array
     */
    public function toArray()
    {
        return array (
            'id' => $this->getId(),
			'firstname' => $this->getFirstName(),
			'lastname' => $this->getLastName(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'email' => $this->getEmail(),
            'role' => $this->getRole()->toArray(),
        );
    }
}

