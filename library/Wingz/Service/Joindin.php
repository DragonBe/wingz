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

/**
 * Wingz_Service_Joindin
 * 
 * The base class for interacting with the joindin api.
 * 
 * @package		Wingz_Service
 * @subpackage	Wingz_Service_Joindin
 * @link		http://joind.in/api
 */
class Wingz_Service_Joindin
{
    const JOINDIN_WEB_BASE = 'http://joind.in';
    const JOINDIN_API_BASE = 'http://joind.in/api';
    const JOINDIN_DEF_TYPE = 'xml';
    const JOINDIN_OUT_XML  = 'xml';
    const JOINDIN_OUT_JSON = 'json';
    
    /**
     * @var 	Zend_Http_Client A client to connect with Joind.in
     */
    protected $_client;
    /**
     * @var 	string The username to connect to Joind.in
     */
    protected $_username;
    /**
     * @var 	string The password to connect to Joind.in
     */
    protected $_password;
    /**
     * @var 	string The output type of request
     */
    protected $_output;
    /**
     * @var 	SimpleXMLElement
     */
    protected $_message;
    /**
     * @var 	Wingz_Service_Joindin_Site
     */
    protected $_site;
    /**
     * @var 	Wingz_Service_Joindin_Event
     */
    protected $_event;
    /**
     * @var 	Wingz_Service_Joindin_Talk
     */
    protected $_talk;
    /**
     * @var 	Wingz_Service_Joindin_User
     */
    protected $_user;
    /**
     * @var 	Wingz_Service_Joindin_Comment
     */
    protected $_comment;
    /**
     * Constructor for this joindin class
     * 
     * @param 	null|string $username 
     * @param 	null|string $password
     * @param 	string $output
     */
    public function __construct($username = null, $password = null, $output = self::JOINDIN_DEF_TYPE)
    {
        if (null !== $username) {
            $this->setUsername($username);
        }
        if (null !== $password) {
            $this->setPassword($password);
        }
        $this->setOutput($output);
        $this->setMessage(new SimpleXMLElement('<request></request>'));
        $this->_site = new Wingz_Service_Joindin_Site();
        $this->_event = new Wingz_Service_Joindin_Event();
        $this->_talk = new Wingz_Service_Joindin_Talk();
        $this->_user = new Wingz_Service_Joindin_User();
        $this->_comment = new Wingz_Service_Joindin_Comment();
    }
    /**
     * Sets the HTTP client
     * 
     * @param 	Zend_Http_Client $client
     * @return	Wingz_Service_Joindin
     */
    public function setClient(Zend_Http_Client $client)
    {
        $this->_client = $client;
        return $this;
    }
    /**
     * Retrieves the HTTP client
     * 
     * @return	Zend_Http_Client
     */
    public function getClient()
    {
        if (null === $this->_client) {
            $this->_client = new Zend_Http_Client();
        }
        return $this->_client;
    }
    /**
     * Sets the username for this joindin
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
     * Retrieves the username from this joindin class
     * 
     * @return	string
     */
    public function getUsername()
    {
        if (null === $this->_username) {
            throw new Wingz_Service_Joindin_Exception('Username is not set');
        }
        return $this->_username;
    }
    /**
     * Sets the password for this joindin account
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
     * Retrieves the password from this joindin account
     * 
     * @return	string
     */
    public function getPassword()
    {
        return $this->_password;
    }
    /**
     * Sets the output format of the joindin webservice, either xml or json
     * 
     * @param 	string $output
     * @return	Wingz_Service_Joindin
     */
    public function setOutput($output)
    {
        $types = array (self::JOINDIN_OUT_JSON, self::JOINDIN_OUT_XML);
        if (!in_array($output, $types)) {
            $output = self::JOINDIN_DEF_TYPE;
        }
        $this->_output = (string) $output;
        return $this;
    }
    /**
     * Retrieves the output format for the joindin webservice
     * 
     * @return	string
     */
    public function getOutput()
    {
        return $this->_output;
    }
    /**
     * Sets the request message to be send to the joindin webservice
     * 
     * @param 	SimpleXmlElement $message
     * @return	Wingz_Service_Joindin
     */
    public function setMessage(SimpleXmlElement $message)
    {
        $this->_message = $message;
    }
    /**
     * Retrieves the request message for the joindin webservice
     * 
     * @return	SimpleXMLElement
     * @throws	Wingz_Service_Joindin_Exception
     */
    public function getMessage()
    {
        if (null === $this->_message) {
            throw new Wingz_Service_Joindin_Exception('Request message is not set');
        }
        return $this->_message;
    }
    /**
     * Prepares the user part of joindin webservice
     * 
     * @return	Wingz_Service_Joindin_User
     */
    public function user()
    {
        $this->_user->setJoindin($this);
        return $this->_user;
    }
    /**
     * Prepares the site part of joindin webservice
     * 
     * @return	Wingz_Service_Joindin_Site
     */
    public function site()
    {
        $this->_site->setJoindin($this);
        return $this->_site;
    }
    /**
     * Prepares the event part of joindin webservice
     * 
     * @return	Wingz_Service_Joindin_Event
     */
    public function event()
    {
        $this->_event->setJoindin($this);
        return $this->_event;
    }
    /**
     * Prepares the talk part of joindin webservice
     * 
     * @return	Wingz_Service_Joindin_Talk
     */
    public function talk()
    {
        $this->_talk->setJoindin($this);
        return $this->_talk;
    }
    /**
     * Prepares the comment part of joindin webservice
     * 
     * @return	Wingz_Service_Joindin_Comment
     */
    public function comment()
    {
        $this->_comment->setJoindin($this);
        return $this->_comment;
    }
    /**
     * Connects to the joindin webservice and executes provided message to the
     * joindin endpoint
     * 
     * @param 	SimpleXMLElement $message
     * @param 	string $apiEnd
     * @throws	Wingz_Service_Joindin_Exception
     * @return	Zend_Http_Response
     */
    public function connect(SimpleXMLElement $message, $apiEnd = null)
    {
        if (null === $apiEnd) {
            throw new Wingz_Service_Joindin_Exception('API end point not set');
        }
        $this->getClient()
             ->setUri(self::JOINDIN_API_BASE . $apiEnd)
             ->setMethod(Zend_Http_Client::POST);
        if (self::JOINDIN_OUT_XML === $this->getOutput()) {
             $this->getClient()
                  ->setHeaders('Content-Type', 'text/xml')
                  ->setRawData($message->asXML());
        }
        try {
            $request = $this->getClient()->request();
        } catch (Zend_Http_Client_Exception $e) {
            throw new Wingz_Service_Joindin_Exception($e->getMessage());
        }
        return $this->getClient()->getLastResponse();
    }
}