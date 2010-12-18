<?php
class Wingz_Service_Joindin_Model_Events implements Countable, SeekableIterator
{
    protected $_idx = 0;
    protected $_count = 0;
    protected $_events = array ();
    
    public function __construct($params = null)
    {
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