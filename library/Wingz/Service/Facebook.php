<?php
class Wingz_Service_Facebook extends Zend_Http_Client
{
    const OAUTH_BASE_URI = 'https://graph.facebook.com/oauth';
    
    const DIALOG_PAGE = 'page';
    
    const DIALOG_POPUP = 'popup';
    
    const DIALOG_WAP = 'wap';
    
    const DIALOG_TOUCH = 'touch';
    
    protected $_clientId;
    
    protected $_key;
    
    protected $_secret;
    
    protected $_redirectUri;
    
    protected $_display;
    
    protected $_accessToken;
    
    protected $_errors = array ();
    
    /**
     * @var 	Zend_Oauth_Consumer
     */
    protected $_oAuthConsumer;
    
    public function __construct($options = null, Zend_Oauth_Consumer $consumer = null)
    {
        if (null === $options) $options = array ();
        if ($options instanceof Zend_Config) $options = $options->toArray();
        if (isset ($options['client_id'])) $this->setClientId($options['client_id']);
        if (isset ($options['consumerKey'])) $this->setKey($options['consumerKey']);
        if (isset ($options['consumerSecret'])) $this->setSecret($options['consumerSecret']);
        if (isset ($options['redirect_uri'])) $this->setRedirectUri($options['redirect_uri']);
        if (isset ($options['access_token'])) $this->setAccessToken($options['access_token']);
        if (isset ($options['display'])) $this->setDisplay($options['display']);
    }
    
    public function setClientId($clientId)
    {
        $this->_clientId = (string) $clientId;
        return $this;
    }
    public function getClientId()
    {
        return $this->_clientId;
    }
    public function setKey($key)
    {
        $this->_key = (string) $key;
        return $this;
    }
    public function getKey()
    {
        return $this->_key;
    }
    public function setSecret($secret)
    {
        $this->_secret = (string) $secret;
        return $this;
    }
    public function getSecret()
    {
        return $this->_secret;
    }
    public function setRedirectUri($redirectUri)
    {
        $this->_redirectUri = (string) $redirectUri;
        return $this;
    }
    public function getRedirectUri()
    {
        return $this->_redirectUri;
    }
    public function setDisplay($display)
    {
        $this->_display = (string) $display;
        return $this;
    }
    public function getDisplay()
    {
        if (null === $this->_display) {
            $this->setDisplay(self::DIALOG_PAGE);
        }
        return $this->_display;
    }
    public function setAccessToken($accessToken)
    {
        $this->_accessToken = (string) $accessToken;
        return $this;
    }
    public function getAccessToken()
    {
        return $this->_accessToken;
    }
    public function addError($errorMessage)
    {
        $this->_errors[] = $errorMessage;
        return $this;
    }
    public function getErrors()
    {
        return $this->_errors;
    }
    public function requestToken()
    {
        if (null === $this->getClientId()) {
            throw new Wingz_Service_Facebook_Exception(
                'Required option client_id is missing');
        }
        if (null === $this->getRedirectUri()) {
            throw new Wingz_Service_Facebook_Exception(
                'Required option redirect_uri is missing');
        }
        $this->setUri(self::OAUTH_BASE_URI . '/authorize');
        $this->setParameterGet(array (
        	'client_id'    => $this->getClientId(),
            'redirect_uri' => $this->getRedirectUri(),
            'display'      => $this->getDisplay(),
            'language'     => 'en_US',
        ));
        $this->setHeaders(array ('Accept-Language' => 'en_US'));
        $response = $this->request();
        if ($response->isSuccessful()) {
            return $response->getBody();
        }
        // we got a bad response from Facebook
        $failure = json_decode($response->getBody());
        $this->addError($failure->error->message);
        return false;
    }
}