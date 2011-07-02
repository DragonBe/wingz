<?php
/**
 * Wingz: Write PHP, deploy anywhere
 * 
 * Wingz is an example application that uses a fully working Zend Framework
 * application that can run on Linux w/ Apache, Microsoft Windows w/ IIS and
 * on Microsoft Windows Azure w/ IIS.
 * 
 * @license CreativeCommons-Attribution-ShareAlike
 * @link http://creativecommons.org/licenses/by-sa/3.0/
 * @category Wingz
 */

/**
 * Wingz_Service_Joindin_Abstract
 * 
 * Abstract class for every endpoint of Joindin API
 * 
 * @package Wingz_Service
 * @subpackage Wingz_Service_Joindin
 * @link http://joind.in/api
 * @abstract
 */
abstract class Wingz_Service_Joindin_Abstract
{
    /**
     * Sets the joindin instance
     * 
     * @param 	Wingz_Service_Joindin $joindin
     * @return	Wingz_Service_Joindin_Abstract
     */
    abstract public function setJoindin(Wingz_Service_Joindin $joindin);
    /**
     * Retrieves the joindin instance
     * 
     * @return	Wingz_Service_Joindin
     */
    abstract public function getJoindin();
}