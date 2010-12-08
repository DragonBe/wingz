<?php

Interface Application_Model_Mapper_Interface
{
	public function setDbTable($dbTable);
	public function getDbTable();
	public function find($model, $primaryKey);
	public function fetchRow($model, $where = null, $order = null);
	public function fetchAll($modelName, $where = null, $order = null, $count = null, $offset = null);
	public function save($model);
}
