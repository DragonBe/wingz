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
class Wingz_Service_Joindin_Model_Events implements Countable, SeekableIterator
{
    protected $_idx = 0;
    protected $_count = 0;
    protected $_events = array ();
    protected $_itemCount = 0;
    
    public function __construct($params = null, $itemCount = 0)
    {
        if (0 < (int) $itemCount) {
            $this->_itemCount = (int) $itemCount;
        }
        if (null !== $params) {
            $this->populate($params);
        }
    }
    public function addEvent(Wingz_Service_Joindin_Model_Event $event)
    {
        $this->_events[] = $event;
        $this->_count++;
        return $this;
    }
    public function getEvents()
    {
        return $this->_events;
    }
    public function populate($data)
    {
        if (is_array($data)) {
            $data = new ArrayObject($data, ArrayObject::ARRAY_AS_PROPS);
        }
        if (isset ($data->item)) {
            foreach ($data->item as $item) {
                $event = new Wingz_Service_Joindin_Model_Event($item);
                $this->addEvent($event);
                if (0 < $this->_itemCount && $this->_itemCount <= $this->count()) break;
            }
        }
    }
    public function toArray()
    {
        $array = array ();
        foreach ($this->getEvents() as $event) {
            $array[] = $event->toArray();
        }
        return $array;
    }
    public function rewind()
    {
        $this->_idx = 0;
    }
    public function key()
    {
        return $this->_idx;
    }
    public function current()
    {
        return $this->_events[$this->_idx];
    }
    public function next()
    {
        ++$this->_idx;
    }
    public function valid()
    {
        return isset ($this->_events[$this->_idx]);
    }
    public function seek($position)
    {
        $this->_idx = (int) $position;
        if (!$this->valid()) {
            throw new OutOfBoundsException('Invalid position provided');
        }
    }
    public function count()
    {
        return $this->_count;
    }
}