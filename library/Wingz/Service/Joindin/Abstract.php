<?php
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