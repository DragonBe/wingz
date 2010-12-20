<?php
class Application_Service_Joindin
{
    /**
     * Get a listing of events
     * 
     * @return	Wingz_Service_Joindin_Model_Events
     */
    public function getEvents($itemCount = 0)
    {
        $joindIn = new Wingz_Service_Joindin();
        $joindIn->setOutput(Wingz_Service_Joindin::JOINDIN_OUTPUT_XML);
        $response = $joindIn->event()->getList();
        return new Wingz_Service_Joindin_Model_Events(
            new SimpleXMLElement($response), $itemCount);
    }    
}
