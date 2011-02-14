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
class Wingz_Service_Joindin_Site extends Wingz_Service_Joindin_Abstract
{
    const JOINDIN_API_URI = 'http://joind.in/api/site';
    
    /**
     * Retrieves the status of joindin service provider
     * 
     * @param 	null|string $string A test string to see the service is operational
     * @return	SimpleXMLElement
     */
    public function status($string = null)
    {
        if (null === $this->getJoindin()) {
            throw new Wingz_Service_Joindin_Exception(
            	'Main joindin service should be loaded first');
        }
        $this->getJoindin()->getClient()->setUri(self::JOINDIN_API_URI);
        $xml = $this->getJoindin()->getRequestBody();
        $action = $xml->addChild('action');
        $action->addAttribute('type', 'status');
        $action->addAttribute('output', $this->getJoindin()->getOutput());
        if (null !== $string) {
            $action->addChild('test_string', $string);
        }
        $data = $this->getJoindin()->getRequestBody();
        return $this->getJoindin()->makeRequest();
    }
}