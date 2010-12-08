<?php

abstract class Application_Model_Abstract implements Application_Model_Interface
{
	/**
	 * @var		Application_Model_Mapper_Abstract
	 */
	protected $_mapper;
	/**
	 * Sets a mapper class for this model
	 *
	 * @param	string|Application_Model_Mapper_Abstract
	 */
	public function setMapper($mapper)
	{
		if (is_string($mapper)) {
			if (!class_exists($mapper)) {
				throw new Zend_Exception('Non-existing mapper provided');
			}
			$mapper = new $mapper;
		}
		if (!$mapper instanceof Application_Model_Mapper_Abstract) {
			throw new Zend_Exception('Invalid mapper class provided');
		}
		$this->_mapper = $mapper;
		return $this;
	}
	public function getMapper()
	{
		if (null === $this->_mapper) {
			throw new Zend_Exception('Mapper class not yet set');
		}
		return $this->_mapper;
	}
	public function find($primaryKey)
	{
		return $this->getMapper()->find($this, $primaryKey);
	}
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        if (method_exists($this, $method)) {
            $this->$method($value);
        }
    }
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }
}

