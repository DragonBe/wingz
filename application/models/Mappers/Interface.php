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
interface Application_Model_Mapper_Interface
{
	public function setDbTable($dbTable);
	public function getDbTable();
	public function find($model, $primaryKey);
	public function fetchRow($model, $where = null, $order = null);
	public function fetchAll($modelName, $where = null, $order = null, $count = null, $offset = null);
	public function save($model);
}
