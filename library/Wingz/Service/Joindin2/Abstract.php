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
 * Wingz_Service_Joindin2_Abstract
 * 
 * The abstract class for all joindin v2 endpoints
 * 
 * @package Wingz_Service
 * @subpackage Wingz_Service_Joindin2
 * @link http://joind.in/api/v2docs
 */
abstract class Wingz_Service_Joindin2_Abstract 
    implements Wingz_Service_Joindin2_Interface
{
    /**
     * @var Wingz_Service_Joindin2 The joindin v2 base class
     */
    protected $_joindin;
    /**
     * Sets the joindin v2 base class
     * 
     * @param Wingz_Service_Joindin2 $joindin
     * @return Wingz_Service_Joindin2_Abstract
     */
    public function setJoindin(Wingz_Service_Joindin2 $joindin)
    {
        $this->_joindin = $joindin;
        return $this;
    }
    /**
     * Retrieves the joindin v2 base class
     * 
     * @return Wingz_Service_Joindin2
     */
    public function getJoindin()
    {
        return $this->_joindin;
    }
}