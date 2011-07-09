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
 * Wingz_Service_Joindin2_Talk
 * 
 * The joindin v2 API talk endpoint class
 * 
 * @package Wingz_Service
 * @subpackage Wingz_Service_Joindin2
 * @link http://joind.in/api/v2docs
 */
class Wingz_Service_Joindin2_Talk extends Wingz_Service_Joindin2_Abstract
{
    const JOINDIN_END_POINT = '/talks';
    const JOINDIN_EVENT_TALKS = 'talks';
    /**
     * Retrieves a listing of talks given at an event, specified by its ID
     * in either HTML format or an array
     * 
     * @param int $eventId
     * @return array|string
     * @throws Wingz_Service_Joindin2_Exception
     */
    public function getTalkList($eventId)
    {
        $this->getJoindin()
             ->getClient()
             ->setUri(sprintf('%s/%s/%d/%s',
                 Wingz_Service_Joindin2::JOINDIN_API_BASE,
                 Wingz_Service_Joindin2_Event::JOINDIN_END_POINT,
                 $eventId,
                 self::JOINDIN_EVENT_TALKS))
             ->setMethod(Zend_Http_Client::GET);
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
    public function getTalkDetail($talkId)
    {
        $this->getJoindin()
             ->getClient()
             ->setUri(sprintf('%s/%s/%d',
                 Wingz_Service_Joindin2::JOINDIN_API_BASE,
                 self::JOINDIN_END_POINT,
                 $talkId))
             ->setMethod(Zend_Http_Client::GET);
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
