<?php
class Wingz_Service_Joindin_Event extends Wingz_Service_Joindin_Abstract
{
    const JOINDIN_API_URI = 'http://joind.in/api/event';
    
    /**
     * Retrieves the status of joindin service provider
     * 
     * @param 	string $eventType Events of type 'hot', 'upcoming' or 'past'
     * @return	SimpleXMLElement
     */
    public function getList($eventType = 'upcoming')
    {
        $allowedEventTypes = array ('hot', 'upcoming', 'past');
        if (null === $this->getJoindin()) {
            throw new Wingz_Service_Joindin_Exception(
            	'Main joindin service should be loaded first');
        }
        if (!in_array($eventType, $allowedEventTypes)) {
            throw new Wingz_Service_Joindin_Exception('Unknown event type provided');
        }
        $this->getJoindin()->getClient()->setUri(self::JOINDIN_API_URI);
        $xml = $this->getJoindin()->getRequestBody();
        $action = $xml->addChild('action');
        $action->addAttribute('type', 'getlist');
        $action->addAttribute('output', $this->getJoindin()->getOutput());
        if (null !== $eventType) {
            $action->addChild('event_type', $eventType);
        }
        $data = $this->getJoindin()->getRequestBody();
        return $this->getJoindin()->makeRequest();
    }
}