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
 * Wingz_Service_Joindin_User
 * 
 * Joindin service component for usage with the user
 * 
 * @package Wingz_Service
 * @subpackage Wingz_Service_Joindin
 * @link http://joind.in/api
 */
class Wingz_Service_Joindin_User extends Wingz_Service_Joindin_Abstract 
{
    const JOINDIN_API_END = '/user';
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
     * @throws	Wingz_Service_Joindin_Exception
     */
    public function getJoindin()
    {
        if (null === $this->_joindin 
            || !$this->_joindin instanceof Wingz_Service_Joindin) {
            throw new Wingz_Service_Joindin_Exception('Joindin instance not set yet');
        }
        return $this->_joindin;
    }
    /**
     * Gets the detail for a specific user
     * 
     * @return string
     * @throws Wingz_Service_Joindin_Exception
     */
    public function getDetail()
    {
        if (null === $this->getJoindin()->getUsername()) {
            throw new Wingz_Service_Joindin_Exception(
            'Required username missing');
        }
        if (null === $this->getJoindin()->getPassword()) {
            throw new Wingz_Service_Joindin_Exception(
            'Required password missing');
        }
        $detail = $this->getJoindin()
                       ->getMessage()
                       ->addChild('action');
        $detail->addAttribute('type', 'getdetail');
        $detail->addAttribute('output', $this->getJoindin()->getOutput());
        $detail->addChild('uid', $this->getJoindin()->getUsername());
        $response = $this->getJoindin()->connect(
            $this->getJoindin()->getMessage(), self::JOINDIN_API_END);
        if ($response->isError()) {
            throw new Wingz_Service_Joindin_Exception($response->getMessage());
        }
        return $response->getBody();
    }
}