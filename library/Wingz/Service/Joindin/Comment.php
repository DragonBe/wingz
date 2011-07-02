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
 * Wingz_Service_Joindin_Comment
 * 
 * Joindin service component for usage with the comments
 * 
 * @package Wingz_Service
 * @subpackage Wingz_Service_Joindin
 * @link http://joind.in/api
 */
class Wingz_Service_Joindin_Comment extends Wingz_Service_Joindin_Abstract 
{
    const JOINDIN_API_END = '/comment';
    /**
     * @var 	Wingz_Service_Joindin
     */
    protected $_joindin;
    /**
     * Sets the joindin instance
     * 
     * @see 	Wingz_Service_Joindin_Abstract::setJoindin()
     * @param	Wingz_Service_Joindin
     * @return	Wingz_Service_Joindin_Event
     */
    public function setJoindin(Wingz_Service_Joindin $joindin)
    {
        $this->_joindin = $joindin;
        return $this;
    }
    /**
     * Retrieves the joindin instance
     * 
     * @see 	Wingz_Service_Joindin_Abstract::getJoindin()
     * @return	Wingz_Service_Joindin
     */
    public function getJoindin()
    {
        return $this->_joindin;
    }
}