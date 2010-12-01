<?php

class Application_Model_Role extends Application_Model_Abstract
{
    /**
     * @var 	int The ID of this Role
     */
    protected $_id;
    /**
     * @var 	string The name of this Role
     */
    protected $_name;
    /**
     * Constructor for this Role
     * 
     * @param 	null|array|Zend_Db_Table_Row $params
     */
    public function __construct($params = null)
    {
        if (null !== $params) {
            $this->populate($params);
        }
    }
    /**
     * Sets the ID for this Role
     * 
     * @param 	int $id
     * @return	Application_Model_Role
     */
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
    /**
     * Retrieves the ID from this Role
     * 
     * @return	int
     */
    public function getId()
    {
        return $this->_id;
    }
    /**
     * Sets the name for this Role
     * 
     * @param 	string $name
     * @return	Application_Model_Role
     */
    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }
    /**
     * Retrieves the name from this Role
     * 
     * @return	string
     */
    public function getName()
    {
        return $this->_name;
    }
    /**
     * (non-PHPdoc)
     * @see Application_Model_Interface::populate()
     */
    public function populate($row)
    {
        if (is_array($row)) {
            $row = new ArrayObject($row, ArrayObject::ARRAY_AS_PROPS);
        }
        if (isset ($row->id)) { $this->setId($row->id); }
        if (isset ($row->name)) { $this->setName($row->name); }
    }
    /**
     * (non-PHPdoc)
     * @see Application_Model_Interface::toArray()
     */
    public function toArray()
    {
        return array (
            'id'	=> $this->getId(),
            'name'  => $this->getName(),
        );
    }
}

