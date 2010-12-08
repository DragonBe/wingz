<?php

class Application_Model_Mapper_User extends Application_Model_Mapper_Abstract
{
	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('Application_Model_DbTable_User');
		}
		return $this;
	}
}
