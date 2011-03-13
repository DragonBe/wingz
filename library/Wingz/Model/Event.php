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
 * Wingz_Model_Event
 * 
 * A generic container describing an event, no matter where it comes from
 * providing a common interface.
 * 
 * @package		Wingz_Model
 */
class Wingz_Model_Event implements Wingz_Model_EventInterface
{
    /**
     * @var 	string The title of the event
     */
    protected $_title;
    /**
     * @var 	string The abstract (introduction) of the event
     */
    protected $_abstract;
    /**
     * @var 	string The full description of the event
     */
    protected $_description;
    /**
     * @var 	Wingz_Model_EventLogo The logo of the event
     */
    protected $_logo;
    /**
     * @var 	string The hashtag of the event
     */
    protected $_hashtag;
    /**
     * (non-PHPdoc)
     * @see 	Wingz_Model_EventInterface::setTitle()
     * @return	Wingz_Model_Event
     */
    public function setTitle($title)
    {
        $this->_title = (string) $title;
        return $this;
    }
    /**
     * (non-PHPdoc)
     * @see 	Wingz_Model_EventInterface::getTitle()
     * @return	string
     */
    public function getTitle()
    {
        return $this->_title;
    }
    /**
     * (non-PHPdoc)
     * @see 	Wingz_Model_EventInterface::setAbstract()
     * @param	string $abstract
     * @return	Wingz_Model_Event
     */
    public function setAbstract($abstract)
    {
        $this->_abstract = (string) $abstract;
        return $this;
    }
    /**
     * (non-PHPdoc)
     * @see 	Wingz_Model_EventInterface::getAbstract()
     * @return	string
     */
    public function getAbstract()
    {
        return $this->_abstract;
    }
    /**
     * (non-PHPdoc)
     * @see 	Wingz_Model_EventInterface::setDescription()
     * @param	string $description
     * @return	Wingz_Model_Event
     */
    public function setDescription($description)
    {
        $this->_description = (string) $description;
        return $this;
    }
    /**
     * (non-PHPdoc)
     * @see 	Wingz_Model_EventInterface::getDescription()
     * @return	string
     */
    public function getDescription()
    {
        return $this->_description;
    }
    /**
     * (non-PHPdoc)
     * @see 	Wingz_Model_EventInterface::setLogo()
     * @param	Wingz_Model_EventLogo $logo
     * @return	Wingz_Model_Event
     */
    public function setLogo(Wingz_Model_EventLogo $logo)
    {
        $this->_logo = $logo;
        return $this;
    }
    /**
     * (non-PHPdoc)
     * @see 	Wingz_Model_EventInterface::getLogo()
     * @return	Wingz_Model_EventLogo
     */
    public function getLogo()
    {
        return $this->_logo;
    }
    /**
     * (non-PHPdoc)
     * @see 	Wingz_Model_EventInterface::setHashtag()
     * @param	string $hashtag
     * @return	Wingz_Model_Event
     */
    public function setHashtag($hashtag)
    {
        $this->_hashtag = (string) $hashtag;
        return $this;
    }
    /**
     * (non-PHPdoc)
     * @see 	Wingz_Model_EventInterface::getHashtag()
     * @return	string
     */
    public function getHashtag()
    {
        return $this->_hashtag;
    }
}