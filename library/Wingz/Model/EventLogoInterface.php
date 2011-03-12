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
 * Wingz_Model_EventLogoInterface
 * 
 * A generic interface describing the logo for an event
 * 
 * @package		Wingz_Model
 */
interface Wingz_Model_EventLogoInterface
{
    /**
     * Sets the url of the logo
     * 
     * @param	string $url The URI of the image
     */
    public function setUrl($url);
    /**
     * Retrieves the url of the logo
     * 
     * @return	string
     */
    public function getUrl();
    /**
     * Sets the width of the logo image
     * 
     * @param int $width The width of the logo image
     */
    public function setWidth($width);
    /**
     * Retrieves the width of the logo image
     * 
     * @return	int
     */
    public function getWidth();
    /**
     * Sets the height of the logo image
     * 
     * @param 	int $height The height of the logo
     */
    public function setHeight($height);
    /**
     * Retrieves the height of the logo image
     * 
     * @return	int
     */
    public function getHeight();
    public function setAlt($altText);
    public function getAlt();
    public function toArray();
    public function __toString();
}