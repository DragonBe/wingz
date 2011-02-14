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
class Wingz_Service_Joindin
{
    const JOINDIN_API_URI = 'http://joind.in/api';
    const JOINDIN_OUTPUT_JSON = 'json';
    const JOINDIN_OUTPUT_XML = 'xml';
    
    /**
     * @var 	string The username used on joindin
     */
    protected $_username;
    /**
     * @var 	string The password used on joindin
     */
    protected $_password;
    /**
     * @var 	string The desired output
     */
    protected $_output = 'json';
    /**
     * @var 	SimpleXMLElement
     */
    protected $_requestBody;
    /**
     * @var 	Zend_Http_Client
     */
    protected $_client;
    
    public function __construct($username = null, $password = null)
    {
        $this->setRequestBody(new SimpleXMLElement('<request></request>'));
        $this->setClient(new Zend_Http_Client(self::JOINDIN_API_URI));
        if (null !== $username) {
            $this->setUsername($username);
        }
        if (null !== $password) {
            $this->setPassword($password);
        }
    }
    /**
     * Sets the joindin username for this class
     * 
     * @param 	string $username
     * @return	Wingz_Service_Joindin
     */
    public function setUsername($username)
    {
        $this->_username = (string) $username;
        return $this;
    }
    /**
     * Retrieves the joindin username from this class
     * 
     * @return	string
     */
    public function getUsername()
    {
        return $this->_username;
    }
    /**
     * Sets the joindin password for this class
     * 
     * @param 	string $password
     * @return	Wingz_Service_Joindin
     */
    public function setPassword($password)
    {
        $this->_password = (string) $password;
        return $this;
    }
    /**
     * Retrieves the joindin password from this class
     * 
     * @return	string
     */
    public function getPassword()
    {
        return $this->_password;
    }
    /**
     * Sets the output for retrieving data from joindin
     * 
     * @param 	string $output Supported formats are 'xml' or 'json'
     * @throws 	Wingz_Service_Joindin_Exception
     * @return	Wingz_Service_Joindin
     */
    public function setOutput($output)
    {
        $supportedOutputs = array ('xml', 'json');
        if (!in_array($output, $supportedOutputs)) {
            throw new Wingz_Service_Joindin_Exception('Unsupported output format provided');
        }
        $this->_output = (string) $output;
        return $this;
    }
    /**
     * Retrieves the desired output format for joindin data retrieval
     * 
     * @return	string
     */
    public function getOutput()
    {
        return $this->_output;
    }
    /**
     * Sets the request body
     * 
     * @param SimpleXMLElement $xml
     * @return	Wingz_Service_Joindin
     */
    public function setRequestBody(SimpleXMLElement $xml)
    {
        $this->_requestBody = $xml;
        return $this;
    }
    /**
     * Retrievest the requestbody
     * 
     * @return	SimpleXMLElement
     */
    public function getRequestBody()
    {
        return $this->_requestBody;
    }
    /**
     * Sets the client adapter for calling the service
     * 
     * @param 	Zend_Http_Client $client
     * @return	Wingz_Service_Joindin
     */
    public function setClient(Zend_Http_Client $client)
    {
        $client->setMethod(Zend_Http_Client::PUT);
        if ('xml' === $this->getOutput()) {
            $client->setHeaders('Content-Type', 'text/xml');
        }
        $this->_client = $client;
        return $this;
    }
    /**
     * Retrieves the client adapter for calling joindin service
     * 
     * @return	Zend_Http_Client
     */
    public function getClient()
    {
        return $this->_client;
    }
    /**
     * Makes the request to joindin and returns the resultset
     *
     * @throws	Wingz_Service_Joindin_Exception
     * @return	string Either an xml or json response from joindin
     */
    public function makeRequest()
    {
        $data = $this->getRequestBody();
        if ($data instanceof SimpleXMLElement) {
            $data = $data->asXML();
        }
        $this->getClient()->setRawData($data);
        $response = $this->getClient()->request();
        if (!$response->isSuccessful()) {
            throw new Wingz_Service_Joindin_Exception('Failure requesting service');
        }
        return $response->getBody();
    }
    /**
     * Get a listing of events
     * 
     * @return	Wingz_Service_Joindin_Model_Events
     * @fix	    Issue reported by Maarten on phpbnl11
     */
    public function getEvents($itemCount = 0)
    {
        $joindIn = new Wingz_Service_Joindin();
        $joindIn->setOutput(Wingz_Service_Joindin::JOINDIN_OUTPUT_XML);
        $response = $joindIn->event()->getList();
        return new Wingz_Service_Joindin_Model_Events(
            new SimpleXMLElement($response), $itemCount);
    } 
    
    public function __call($method, $args)
    {
        $service = null;
        switch ($method) {
            case 'site':
                $service = new Wingz_Service_Joindin_Site($this);
                break;
            case 'event':
                $service = new Wingz_Service_Joindin_Event($this);
                break;
            default:
                break;
        }
        return $service;
    }
}