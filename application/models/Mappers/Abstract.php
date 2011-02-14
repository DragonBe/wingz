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
class Application_Model_Mapper_Abstract
{
	/**
	 * @var		Zend_Db_Table_Abstract
	 */
	protected $_dbTable;

	/**
	 * Sets the Data gateway for this mapper
	 *
	 * @param	string|Zend_Db_Table_Abstract The name or instance of the data gateway
	 * @return	Application_Model_Mapper_Abstract
	 * @throws	Zend_Exception
	 */
	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			if (!class_exists($dbTable)) {
				throw new Zend_Exception('Non-existing class provided');
			}
			$dbTable = new $dbTable;
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Zend_Exception('Invalid class provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}
	/**
	 * Retrieves the data gateway from this mapper
	 *
	 * @return	Zend_Db_Table_Abstract
	 */
	public function getDbTable()
	{
		return $this->_dbTable;
	}
	/**
	 * Finds the data for a given model provided by it's primary key
	 *
	 * @param	string|Application_Model_Abstract $model
	 * @return	Application_Model_Mapper_Abstract
	 */
	public function find($model, $primaryKey)
	{
		$model = $this->_validateModel($model);
		$model->populate($this->getDbTable()->find($primaryKey));
		return $this;
	}
	public function fetchRow($model, $where = null, $order = null)
	{
	}
	public function fetchAll($modelName, $where = null, $order = null, $count = null, $offset = null)
	{
	}
	public function save($model)
	{
	}
	/**
	 * Validates if a model is either a string or a genuine model
	 *
	 * @param	mixed $model
	 * @return	Application_Model_Abstract
	 * @throws	Zend_Exception
	 */
	protected function _validateModel($model)
	{
		if (is_string($model)) {
			if (!class_exists($model)) {
				throw new Zend_Exception('Non-existing class provided');
			}
			$model = new $model;
		}
		if (!$model instanceof Application_Model_Abstract) {
			throw new Zend_Exception('Invalid class provided');
		}
		return $model;
	}
}
