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
 * Wingz_Model_EventInterface
 * 
 * A common interface for defining an event
 * 
 * @package		Wingz_Model
 */
interface Wingz_Model_EventInterface
{
    public function setTitle($title);
    public function getTitle();
    public function setAbstract($abstract);
    public function getAbstract();
    public function setDescription($description);
    public function getDescription();
    public function setLogo(Wingz_Model_EventLogo $logo);
    public function getLogo();
    public function setHashtag($hashtag);
    public function getHashtag();
}