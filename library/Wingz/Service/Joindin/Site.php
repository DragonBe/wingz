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
 * Wingz_Service_Joindin_Site
 * 
 * Joindin service component for usage with the site details
 * 
 * @package Wingz_Service
 * @subpackage Wingz_Service_Joindin
 * @link http://joind.in/api
 */
class Wingz_Service_Joindin_Site extends Wingz_Service_Joindin_Abstract
{
    const JOINDIN_API_END = '/site';
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
    /**
     * Call the joindin status RPC
     * 
     * @param 	null|string $test
     * @return	string
     */
    public function getStatus($test = null)
    {
        $status = $this->getJoindin()
                       ->getMessage()
                       ->addChild('action');
        $status->addAttribute('type', 'status');
        $status->addAttribute('output', $this->getJoindin()->getOutput());
        if (null !== $test) {
            $status->addChild('test_string', $test);
        }
        
        $response = $this->getJoindin()->connect(
            $this->getJoindin()->getMessage(), self::JOINDIN_API_END);
        if ($response->isError()) {
            throw new Wingz_Service_Joindin_Exception($response->getMessage());
        }
        return $response->getBody();
    }
}