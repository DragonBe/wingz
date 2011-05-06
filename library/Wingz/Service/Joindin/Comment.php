<?php
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