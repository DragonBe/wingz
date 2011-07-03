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
 * Wingz_Service_Joindin2_Event
 * 
 * The joindin v2 API event endpoint class
 * 
 * @package Wingz_Service
 * @subpackage Wingz_Service_Joindin2
 * @link http://joind.in/api/v2docs
 */
class Wingz_Service_Joindin2_Event extends Wingz_Service_Joindin2_Abstract
{
    const LINKEDIN_END_POINT = '/events';
    /**
     * Retrieves a listing of all events, defaults to 21 events per request
     * 
     * @return array|string 
     * @throws Wingz_Service_Joindin2_Exception
     */
    public function getEventList()
    {
        $this->getJoindin()
             ->getClient()
             ->setUri(sprintf('%s/%s',
                 Wingz_Service_Joindin2::JOINDIN_API_BASE,
                 self::LINKEDIN_END_POINT))
             ->setMethod('GET');
        $response = $this->getJoindin()->getClient()->request();
        if (!$response->isSuccessful()) {
            throw new Wingz_Service_Joindin2_Exception(
                $response->getMessage());
        }
        $content = $response->getBody();
        if (Wingz_Service_Joindin2::JOINDIN_FORMAT_JSON 
            === $this->getJoindin()->getFormat()) {
            return json_decode($content, true);
        }
        return $content;
    }
    /**
     * Retrieves the details of an event based on a given ID
     * 
     * @param int $eventId
     * @return array|string
     * @throws Wingz_Service_Joindin2_Exception
     */
    public function getEvent($eventId)
    {
        $this->getJoindin()
             ->getClient()
             ->setUri(sprintf('%s/%s/%d',
                 Wingz_Service_Joindin2::JOINDIN_API_BASE,
                 self::LINKEDIN_END_POINT,
                 $eventId))
             ->setMethod('GET');
        $response = $this->getJoindin()->getClient()->request();
        if (!$response->isSuccessful()) {
            throw new Wingz_Service_Joindin2_Exception(
                $response->getMessage());
        }
        $content = $response->getBody();
        if (Wingz_Service_Joindin2::JOINDIN_FORMAT_JSON 
            === $this->getJoindin()->getFormat()) {
            $data = json_decode($content, true);
            return array_shift($data);
        }
        return $content;
    }
}