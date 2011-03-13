<?php
class Wingz_Model_EventLogo implements Wingz_Model_EventLogoInterface
{
    protected $_url;
    protected $_width;
    protected $_height;
    protected $_alt;
    public function __construct($url = null, $width = null, $height = null, $alt = null)
    {
        if (null !== $url) {
            if (is_array ($url)) {
                $this->populate($url);
            } else {
                $this->setUrl($url)
                     ->setWidth($width)
                     ->setHeight($height)
                     ->setAlt($alt);
            }
        }
    }
    public function setUrl($url)
    {
        $this->_url = (string) $url;
        return $this;
    }
    public function getUrl()
    {
        return $this->_url;
    }
    public function setWidth($width)
    {
        $this->_width = (int) $width;
        return $this;
    }
    public function getWidth()
    {
        return $this->_width;
    }
    public function setHeight($height)
    {
        $this->_height = (int) $height;
        return $this;
    }
    public function getHeight()
    {
        return $this->_height;
    }
    public function setAlt($alt)
    {
        $this->_alt = (string) $alt;
        return $this;
    }
    public function getAlt()
    {
        return $this->_alt;
    }
    public function populate(array $array)
    {
        if (isset ($array['url'])) $this->setUrl($array['url']);
        if (isset ($array['width'])) $this->setWidth($array['width']);
        if (isset ($array['height'])) $this->setHeight($array['height']);
        if (isset ($array['alt'])) $this->setAlt($array['alt']);
    }
    public function toArray()
    {
        return array (
            'url' => $this->getUrl(),
            'width' => $this->getWidth(),
            'height' => $this->getHeight(),
            'alt' => $this->getAlt(),
        );
    }
    public function __toString()
    {
        return sprintf('<img src="%s" width="%s" height="%s" alt="%s"/>',
            $this->getUrl(),
            $this->getWidth(),
            $this->getHeight(),
            $this->getAlt());
    }
}