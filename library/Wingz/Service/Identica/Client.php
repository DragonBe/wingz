<?php
class Wingz_Service_Identica_Client
{
    const API_BASE_URI = 'https://identi.ca/api';
    
    /**
     * Username
     * 
     * @var string
     */
    protected $_username;
    /**
     * Password
     * 
     * @var string
     */
    protected $_password;
    /**
     * Options
     * 
     * @var array
     */
    protected $_options = array ();
    /**
     * Http client
     * 
     * @var Zend_Http_Client
     */
    protected $_httpClient;
    /**
     * Response format
     * 
     * @var string
     */
    protected $_format = 'xml';
    /**
     * Constructor of this client
     * 
     * @param array|Zend_Config $options
     * @param Zend_Http_Client $httpClient
     */
    public function __construct($options = null, $httpClient = null)
    {
        if (null !== $options) {
            $this->setOptions($options);
        }
        if (null !== $httpClient && $httpClient instanceof Zend_Http_Client) {
            $this->setHttpClient($httpClient);
        }
    }
    /**
     * Set username
     * 
     * @param string $username
     * @return Wingz_Service_Identica_Client
     */
    public function setUsername($username)
    {
        $this->_username = (string) $username;
        return $this;
    }
    /**
     * Retrieve the username
     * 
     * @return string
     */
    public function getUsername()
    {
        return $this->_username;
    }
    /**
     * Sets the password
     * 
     * @param string $password
     * @return Wingz_Service_Identica_Client
     */
    public function setPassword($password)
    {
        $this->_password = (string) $password;
        return $this;
    }
    /**
     * Retrieve the password
     * 
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }
    /**
     * Sets the options
     * 
     * @param array|Zend_Config $options
     * @return Wingz_Service_Identica_Client
     */
    public function setOptions($options)
    {
        if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        }
        if (isset ($options['username'])) $this->setUsername($options['username']);
        if (isset ($options['password'])) $this->setPassword($options['password']);
        if (isset ($options['format'])) $this->setFormat($optiosn['format']);
        return $this;
    }
    /**
     * Sets the http client
     * 
     * @param Zend_Http_Client $httpClient
     * @return Wingz_Service_Identica_Client
     */
    public function setHttpClient(Zend_Http_Client $httpClient)
    {
        $this->_httpClient = $httpClient;
        return $this;
    }
    /**
     * Retrieves the http client
     * 
     * @return Zend_Http_Client
     * @throws Wingz_Service_Identica_Exception
     */
    public function getHttpClient()
    {
        if (null === $this->_httpClient) {
            throw new Wingz_Service_Identica_Exception('No HTTP client instantiated');
        }
        return $this->_httpClient;
    }
    /**
     * Sets the response format
     * 
     * @param string $format
     * @throws Wingz_Service_Identica_Exception
     * @return Wingz_Service_Identica_Client
     */
    public function setFormat($format)
    {
        $formats = array ('xml', 'json');
        if (!in_array($format, $formats)) {
            throw new Wingz_Service_Identica_Exception(
            	'Format ' . $format . ' not supported by Identica');
        }
        $this->_format = (string) $format;
        return $this;
    }
    /**
     * Retrieves the response format
     * 
     * @return string
     */
    public function getFormat()
    {
        return $this->_format;
    }
    
    public function accountVerifyCredentials()
    {
        $uri = self::API_BASE_URI . '/account/verify_credentials.' . $this->getFormat();
        return $this->_sendRequest($uri);
    }
    
    public function statusesUserTimeline()
    {
        $uri = self::API_BASE_URI . '/statuses/user_timeline.' . $this->getFormat();
        return $this->_sendRequest($uri);
    }
    
    public function statusesUpdate($status, $params = array ())
    {
        $uri = self::API_BASE_URI . '/statuses/update.' . $this->getFormat();
        $this->getHttpClient()
             ->setUri($uri)
             ->setAuth($this->getUsername(), $this->getPassword());
        $this->getHttpClient()
             ->setMethod('POST')
             ->setParameterPost('status', $status);
        foreach ($params as $key => $value) {
            $this->getHttpClient()->setParameterPost($key, $value);
        }
        $response = $this->getHttpClient()->request();
        if (!$response->isSuccessful()) {
            throw new Wingz_Service_Identica_Exception($response->getMessage());
        }
        if ('xml' === $this->getFormat()) {
            return simplexml_load_string($response->getBody());
        }
        return $response->getBody();
    }
	/**
     * Get the current version of identi.ca
     * 
     * @return string
     */
    public function statusnetGetVersion()
    {
        $uri = self::API_BASE_URI . '/statusnet/version.' . $this->getFormat();
        return $this->_sendRequest($uri);
    }
    
    protected function _sendRequest($uri)
    {
        $this->getHttpClient()
             ->setUri($uri)
             ->setAuth($this->getUsername(), $this->getPassword());
        $response = $this->getHttpClient()->request();
        if (!$response->isSuccessful()) {
            throw new Wingz_Service_Identica_Exception($response->getMessage());
        }
        if ('xml' === $this->getFormat()) {
            return simplexml_load_string($response->getBody());
        }
        return $response->getBody();
    }
}