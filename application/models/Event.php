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
class Application_Model_Event extends Application_Model_Abstract
{
    /**
     * @var 	int The ID of this Event
     */
    protected $_id;
    /**
     * @var 	string The name of this Event
     */
    protected $_name;
    /**
     * @var 	DateTime The start date and time of this Event
     */
    protected $_start;
    /**
     * @var		DateTime The end date and time of this Event
     */
    protected $_end;
    /**
     * @var 	Application_Model_Venue The venue of this Event
     */
    protected $_venue;
    
    /**
     * Constructor for this Event
     * 
     * @param 	null|array|Zend_Db_Table_Row $params
     */
    public function __construct($params = null)
    {
        $this->_start = new DateTime();
        $this->_end = new DateTime();
        if (null !== $params) {
            $this->populate($params);
        }
    }
    /**
     * Sets the sequence ID for this Event
     * 
     * @param 	int $id
     * @return	Application_Model_Event
     */
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
    /**
     * Retrieve the sequence ID from this Event
     * 
     * @return	int
     */
    public function getId()
    {
        return $this->_id;
    }
    /**
     * Sets the name for this Event
     * 
     * @param 	string $name
     * @return	Application_Model_Event
     */
    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }
    /**
     * Retrieves the name from this Event
     * 
     * @return	string
     */
    public function getName()
    {
        return $this->_name;
    }
    /**
     * Sets the start date and time for this Event
     * 
     * @param 	string $date
     * @return	Application_Model_Event
     */
    public function setStart($date)
    {
        $this->_start = new DateTime($date);
        return $this;
    }
    /**
     * Retrieves the start date and time from this Event
     * 
     * @return	DateTime
     */
    public function getStart()
    {
        return $this->_start;
    }
    /**
     * Sets the end date and time for this Event
     * 
     * @param 	string $date
     * @return	Application_Model_Event
     */
    public function setEnd($date)
    {
        $this->_end = new DateTime($date);
        return $this;
    }
    /**
     * Retrieves the end date and time from this Event
     * 
     * @return	DateTime
     */
    public function getEnd()
    {
        return $this->_end;
    }
    /**
     * (non-PHPdoc)
     * @see Application_Model_Interface::populate()
     */
    public function populate($row)
    {
        if (is_array($row)) {
            $row = new ArrayObject($row, ArrayObject::ARRAY_AS_PROPS);
        }
        if (isset ($row->id)) { $this->setId($row->id); }
        if (isset ($row->name)) { $this->setName($row->name); }
        if (isset ($row->start)) { $this->setStart($row->start); }
        if (isset ($row->end)) { $this->setEnd($row->end); }
    }
    /**
     * (non-PHPdoc)
     * @see Application_Model_Interface::toArray()
     */
    public function toArray()
    {
        return array (
            'id' => $this->getId(),
            'name' => $this->getName(),
            'start' => $this->getStart()->format('Y-m-d H:i:s'),
            'end' => $this->getEnd()->format('Y-m-d H:i:s'),
        );
    }
}