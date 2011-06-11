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
 * Class that allows to interact with the Facebook API in a Zend Framwork
 * preferred way.
 * 
 * @package		Wingz_Service
 * @version		$Id:$
 * @link		http://developers.facebook.com/docs/authentication/
 */
class Wingz_Service_Facebook
{
    const FB_OAUTH_URI = 'https://www.facebook.com/dialog/oauth';
    const FB_CONN_URI = 'https://graph.facebook.com/oauth/access_token';
    const FB_API_URI = 'https://graph.facebook.com/me';
    /**
     * @var 	string The app ID for the Facebook app
     */
    protected $_client_id;
    /**
     * @var 	string The app secret key for the Facebook app
     */
    protected $_client_secret;
    /**
     * @var 	string The redirection url for the Facebook app
     */
    protected $_redirect_uri;
    /**
     * @var 	string The scope of the Facebook app
     */
    protected $_scope;
    /**
     * @var 	string The state for the Facebook app
     */
    protected $_state;
    /**
     * @var 	string The response type for the Facebook app
     */
    protected $_response_type;
    /**
     * @var 	string The display for the Facebook app
     */
    protected $_display;
    /**
     * Constructor for this Facebook service layer
     * 
     * @param null|array $options A list of optional settings for the FB API
     */
    public function __construct ($options = null)
    {
        if (null !== $options) {
            $this->setOptions($options);
        }
    }
    /**
     * Sets the app ID
     * 
     * @param 	string $client_id
     * @return	Wingz_Service_Facebook
     */
    public function setClientId ($client_id)
    {
        $this->_client_id = (string) $client_id;
        return $this;
    }
    /**
     * Retrieves the app ID
     * 
     * @return	string
     */
    public function getClientId ()
    {
        return $this->_client_id;
    }
    /**
     * Sets the secret key for this Facebook App
     * 
     * @param 	string $client_secret
     * @return	Wingz_Service_Facebook
     */
    public function setClientSecret ($client_secret)
    {
        $this->_client_secret = (string) $client_secret;
        return $this;
    }
    /**
     * Retrieves the secret key of this Facebook app
     * 
     * @return	string
     */
    public function getClientSecret ()
    {
        return $this->_client_secret;
    }
    /**
     * Sets the redirection URI for Facebook to return to when authentication
     * is completed
     * 
     * @param 	string $redirect_uri
     * @return	Wingz_Service_Facebook
     */
    public function setRedirectUri ($redirect_uri)
    {
        $this->_redirect_uri = (string) $redirect_uri;
        return $this;
    }
    /**
     * Retrieves the redirection URI
     * 
     * @return	string
     */
    public function getRedirectUri ()
    {
        return $this->_redirect_uri;
    }
    /**
     * Sets the scope setting for this app
     * 
     * @param 	string $scope
     * @return	Wingz_Service_Facebook
     * @link	http://developers.facebook.com/docs/authentication/permissions
     */
    public function setScope ($scope)
    {
        $this->_scope = (string) $scope;
        return $this;
    }
    /**
     * Retrievest the scope of this Facebook app
     * 
     * @return	string
     */
    public function getScope ()
    {
        return $this->_scope;
    }
    /**
     * Sets the state for this Facebook app
     * 
     * @param 	string $state
     * @return	Wingz_Service_Facebook
     * @link	http://developers.facebook.com/docs/reference/dialogs/oauth/
     */
    public function setState ($state)
    {
        $this->_state = (string) $state;
        return $this;
    }
    /**
     * Retrieves the state from this Facebook app
     * 
     * @return	string
     */
    public function getState ()
    {
        return $this->_state;
    }
    /**
     * Set the response type for this Facebook app
     * 
     * @param 	string $response_type
     * @return	Wingz_Service_Facebook
     * @link	http://developers.facebook.com/docs/reference/dialogs/oauth/
     */
    public function setResponseType ($response_type)
    {
        $this->_response_type = (string) $response_type;
        return $this;
    }
    /**
     * Retrieves the response type from this Facebook app
     * 
     * @return	string
     */
    public function getResponseType ()
    {
        return $this->_response_type;
    }
    /**
     * Sets the display portion of this Facebook app.
     * 
     * @param 	string $display
     * @return	Wingz_Service_Facebook
     * @link	http://developers.facebook.com/docs/reference/dialogs/oauth/
     */
    public function setDisplay ($display)
    {
        $this->_display = (string) $display;
        return $this;
    }
    /**
     * Retrieves the display from this Facebook app
     * 
     * @return	string
     */
    public function getDisplay ()
    {
        return $this->_display;
    }
    /**
     * Sets an array of options for this Facebook app
     * 
     * @param 	array|Zend_Config $options
     * @return	Wingz_Service_Facebook
     * @link	http://developers.facebook.com/docs/reference/dialogs/oauth/
     */
    public function setOptions ($options)
    {
        if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        }
        $this->_checkValue('client_id', $options, 'setClientId');
        $this->_checkValue('client_secret', $options, 'setClientSecret');
        $this->_checkValue('redirect_uri', $options, 'setRedirectUri');
        $this->_checkValue('scope', $options, 'setScope');
        $this->_checkValue('state', $options, 'setState');
        $this->_checkValue('response_type', $options, 'setResponseType');
        $this->_checkValue('display', $options, 'setDisplay');
    }
    /**
     * Validates the needle exists before trying to set the property
     * 
     * @param 	string $needle
     * @param 	array $haystack
     * @param 	string $method
     */
    protected function _checkValue ($needle, $haystack, $method)
    {
        if (isset($haystack[$needle])) {
            if (method_exists($this, $method)) {
                $this->$method($haystack[$needle]);
            }
        }
    }
    /**
     * Retrieves all settings as an array
     * 
     * @retun	array
     */
    public function toArray ()
    {
        return array('client_id' => $this->getClientId(), 
        'client_secret' => $this->getClientSecret(), 
        'redirect_uri' => $this->getRedirectUri(), 
        'scope' => $this->getScope(), 'state' => $this->getState(), 
        'response_type' => $this->getResponseType(), 
        'display' => $this->getDisplay());
    }
    /**
     * Creates an HTTP client for Facebook authentication
     * 
     * @return	Zend_Http_Client
     * @link	http://developers.facebook.com/docs/authentication/
     */
    public function generateAuthUrl ()
    {
        $client = new Zend_Http_Client();
        $client->setConfig(array('strict' => false))
            ->setUri(self::FB_OAUTH_URI)
            ->setParameterGet('client_id', $this->getClientId())
            ->setParameterGet('redirect_uri', $this->getRedirectUri());
        if (null !== $this->getScope())
            $client->setParameterGet('scope', $this->getScope());
        if (null !== $this->getState())
            $client->setParameterGet('state', $this->getState());
        if (null !== $this->getResponseType())
            $client->setParameterGet('response_type', $this->getResponseType());
        if (null !== $this->getDisplay())
            $client->setParameterGet('display', $this->getDisplay());
        return $client;
    }
    /**
     * Creates an HTTP client for Facebook connect
     * 
     * @param 	string $code
     * @return	Zend_Http_Client
     * @link	http://developers.facebook.com/docs/authentication/
     */
    public function generateConnectUrl ($code)
    {
        $client = new Zend_Http_Client();
        $client->setConfig(array('strict' => false))
            ->setUri(self::FB_CONN_URI)
            ->setParameterGet('client_id', $this->getClientId())
            ->setParameterGet('redirect_uri', $this->getRedirectUri())
            ->setParameterGet('client_secret', $this->getClientSecret())
            ->setParameterGet('code', $code);
        return $client;
    }
    /**
     * Authenticates to Facebook
     * 
     * @return	Zend_Http_Response
     * @link	http://developers.facebook.com/docs/authentication/
     */
    public function authenticate ()
    {
        $client = $this->generateAuthUrl();
        $response = $client->request();
        if ($response->isSuccessful()) {
            return $response->getBody();
        }
    }
    /**
     * Links user profile to Facebook app
     * 
     * @param 	string $code
     * @return	array
     * @link	http://developers.facebook.com/docs/authentication/
     */
    public function connect ($code)
    {
        $client = $this->generateConnectUrl($code);
        $response = null;
        try {
            $response = $client->request();
        } catch (Zend_Exception $e) {
            return false;
        }
        $result = array();
        $query = $response->getBody();
        $params = explode('&', $query);
        foreach ($params as $keyValue) {
            list ($key, $value) = explode('=', $keyValue);
            $result[$key] = $value;
        }
        return $result;
    }
    /**
     * Fetches user details from Facebook
     * 
     * @param 	string $access_token
     * @return	stdClass
     */
    public function getUser ($access_token)
    {
        $client = new Zend_Http_Client();
        $client->setUri(self::FB_API_URI)->setParameterGet('access_token', 
        $access_token);
        $response = $client->request();
        $user = json_decode($response->getBody());
        return $user;
    }
    public function getUserEvents ($access_token)
    {
        $client = new Zend_Http_Client();
        $client->setConfig(array('strict' => false))
            ->setUri('https://graph.facebook.com/me/events')
            ->setParameterGet('access_token', $access_token)
            ->setParameterGet('since', 'yesterday');
        $response = $client->request();
        $events = json_decode($response->getBody());
        return $events->data;
    }
    public function getEventDetails ($access_token, $eventId)
    {
        $client = new Zend_Http_Client();
        $client->setConfig(array('strict' => false))
            ->setUri('https://graph.facebook.com/' . $eventId)
            ->setParameterGet('access_token', $access_token);
        $response = $client->request();
        $details = json_decode($response->getBody());
        return $details;
    }
}

