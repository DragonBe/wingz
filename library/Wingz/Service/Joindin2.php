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
 * Wingz_Service_Joindin2
 * 
 * The base class for interacting with the joindin api v2.
 * 
 * @package Wingz_Service
 * @subpackage Wingz_Service_Joindin2
 * @link http://joind.in/api/v2docs
 */
class Wingz_Service_Joindin2
{
    const JOINDIN_API_BASE = 'http://api.joind.in/v2';
    const JOINDIN_FORMAT_JSON = 'json';
    const JOINDIN_FORMAT_HTML = 'html';
    
    /**
     * @var Zend_Http_Client The HTTP client to access the API
     */
    protected $_client;
    /**
     * @var bool Flag indicating more or less information should be returned
     */
    protected $_verbose = false;
    /**
     * @var int Offset position of paginated requests
     */
    protected $_start;
    /**
     * @var int Number of results to be returned in one request
     */
    protected $_resultsPerPage;
    /**
     * @var string The format in which the response should be
     */
    protected $_format = self::JOINDIN_FORMAT_HTML;
    /**
     * @var Wingz_Service_Joindin2_Event The event endpoint client
     */
    protected $_event;
    /**
     * Constructor for this joindin v2 base class
     * 
     * @param null|Zend_Http_Client $client
     * @param null|boolean $verbose
     * @param null|int $start
     * @param null|int $resultsPerPage
     * @param string $format
     */
    public function __construct($client = null, $verbose = false, $start = null,
        $resultsPerPage = null, $format = self::JOINDIN_FORMAT_HTML)
    {
        if (null === $client) {
            $this->setClient(new Zend_Http_Client());
        }
        $this->setVerbose($verbose)
             ->setFormat($format);
        if (null !== $start) {
             $this->setStart($start);
        }
        if (null !== $resultsPerPage) {
             $this->setResultsPerPage($resultsPerPage);
        }
    }
    /**
     * Sets the HTTP client for accessing the joindin v2 API
     * 
     * @param Zend_Http_Client $client
     * @return Wingz_Service_Joindin2
     */
    public function setClient(Zend_Http_Client $client)
    {
        $this->_client = $client;
        return $this;
    }
    /**
     * Retrieves the joindin2 HTTP client
     * 
     * @return Zend_Http_Client
     */
    public function getClient()
    {
        return $this->_client;
    }
    /**
     * Activate or de-activate verbosity on return values of joindin v2 API
     * 
     * @param bool $flag
     * @return Wingz_Service_Joindin2
     */
    public function setVerbose($flag = true)
    {
        $this->_verbose = (bool) $flag;
        return $this;
    }
    /**
     * Check if verbosity is activated for return values of joindin v2 API
     * 
     * @return bool
     */
    public function isVerbose()
    {
        return $this->_verbose;
    }
    /**
     * Sets the offset of results retrieved from the joindin v2 API
     * 
     * @param int $offset
     * @return Wingz_Service_Joindin2
     */
    public function setStart($offset)
    {
        if (0 > $offset) {
            throw new Wingz_Service_Exception('Only positive numbers allowed');
        }
        $this->_start = (int) $offset;
        return $this;
    }
    /**
     * Retrieve the current offset for results from the joindin v2 API
     * 
     * @return int
     */
    public function getStart()
    {
        return $this->_start;
    }
    /**
     * Sets the number of results per page
     * 
     * @param int $resultsPerPage
     * @return Wingz_Service_Joindin2
     */
    public function setResultsPerPage($resultsPerPage)
    {
        if (0 > $resultsPerPage) {
            throw new Wingz_Service_Exception('Only positive numbers allowed');
        }
        $this->_resultsPerPage = (int) $resultsPerPage;
        return $this;
    }
    /**
     * Retrieve the number of results per page
     * 
     * @return int
     */
    public function getResultsPerPage()
    {
        return $this->_resultsPerPage;
    }
    /**
     * Sets the format of the resultset from the joindin v2 API ('html', 
     * 'json')
     * 
     * @param string $format
     * @return Wingz_Service_Joindin2
     */
    public function setFormat($format)
    {
        $formats = array (self::JOINDIN_FORMAT_HTML, self::JOINDIN_FORMAT_JSON);
        if (!in_array($format, $formats)) {
            throw new Wingz_Service_Exception('Invalid format provided');
        }
        $this->_format = $format;
        return $this;
    }
    /**
     * Retrieve the format setting for the results from the joindin v2 API
     * 
     * @return string
     */
    public function getFormat()
    {
        return $this->_format;
    }
    /**
     * Provides access to the endpoint event
     * 
     * @return Wingz_Service_Joindin2_Event
     */
    public function event()
    {
        if (null === $this->_event) {
            $this->_event = new Wingz_Service_Joindin2_Event();
        }
        return $this->_event;
    }
}