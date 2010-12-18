<?php
class Wingz_Service_Joindin_Model_Event
{
    protected $_event_name;
    protected $_event_start;
    protected $_event_end;
    protected $_event_lat;
    protected $_event_long;
    protected $_ID;
    protected $_event_loc;
    protected $_event_desc;
    protected $_active;
    protected $_event_stub;
    protected $_event_icon;
    protected $_pending;
    protected $_event_hashtag;
    protected $_event_href;
    protected $_event_cfp_start;
    protected $_event_cfp_end;
    protected $_event_voting;
    protected $_private;
    protected $_event_tz_cont;
    protected $_event_tz_place;
    protected $_event_contact_name;
    protected $_event_contact_email;
    protected $_num_attend;
    protected $_num_comments;
    protected $_user_attending;
    protected $_allow_comments;
    
    public function __construct($params = null)
    {
        if (null !== $params) {
            $this->populate($params);
        }
    }
    public function populate($row)
    {
        if (is_array($row)) {
            $row = new ArrayObject($row, ArrayObject::ARRAY_AS_PROPS);
        }
        foreach ($row as $key => $value) {
            $this->$key = (string) $value;
        }
    }
    public function toArray()
    {
        $array = array ();
        foreach ($this as $property => $value) {
            $key = substr($property, 1);
            $array[$key] = $value;
        }
        return $array;
    }
    public function __set($name, $value)
    {
        $property = '_' . $name;
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
    public function __get($name)
    {
        $property = '_' . $name;
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        return null;
    }
}