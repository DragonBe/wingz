<?php

class Oauth_Model_Facebook extends Zend_Oauth_Config
{
    protected $_client_id;
    protected $_redirect_uri;
    
    public function setClientId($clientId)
    {
        $this->_client_id = (string) $clientId;
        return $this;
    }
    public function setRedirectUri($redirectUri)
    {
        $this->_redirect_url = (string) $redirectUri;
        return $this;
    }
    
    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            switch ($key) {
                case 'client_id':
                    $this->setClientId($value);
                    break;
                case 'redirect_url':
                    $this->setRedirectUri($value);
                    break;
                default:
                    break;
            }
        }
        parent::setOptions($options);
    }
}

