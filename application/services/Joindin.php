<?php
class Application_Service_Joindin
{
    public function getEvents()
    {
        $joindIn = new Wingz_Service_Joindin();
        $joindIn->setOutput(Wingz_Service_Joindin::JOINDIN_OUTPUT_XML);
        $response = $joindIn->event()->getList();
        return new Wingz_Service_Joindin_Model_Events(
            new SimpleXMLElement($response));
    }    
}
