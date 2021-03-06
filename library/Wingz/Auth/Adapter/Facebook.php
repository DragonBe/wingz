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
class Wingz_Auth_Adapter_Facebook implements Zend_Auth_Adapter_Interface
{
    private $_appId;
    private $_secret;
    private $_permissions;
    private $_token;
    private $_url           = 'https://graph.facebook.com/oauth/access_token';

    /**
    * List of query parameters that get automatically dropped when rebuilding
    * the current URL.
    */
    protected static $DROP_QUERY_PARAMS = array(
        'session',
        'signed_request',
    );

    /**
     * @param mixed $config - Zend_Config or array
     */
    public function __construct($config)
    {
        if($config instanceof Zend_Config) {
            $config = $config->toArray();
        }
        
        if (isset($config['appId'])) {
            $this->_appId = $config['appId'];
            unset($config['appId']);
        } else {
            throw new Zend_Auth_Exception('Required param "appId" is missing param in config');
        }

        if (isset($config['secret'])) {
            $this->_secret = $config['secret'];
            unset($config['secret']);
        } else {
            throw new Zend_Auth_Exception('Required param "secret" is missing param in config');
        }

        if (isset($config['permissions'])) {
            $this->_permissions = $config['permissions'];
            unset($config['permissions']);
        } else {
            $this->_permissions = '';
        }
    }

    /**
     * Set token You have received from Facebook
     * @param string $token
     * @return Zend_Auth_Adapter_Facebook
     */
    public function setToken($token)
    {
        $this->_token = $token;
        return $this;
    }

    /**
     * Exchange token to access_token
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
        if (empty($this->_token)) {
            $code = Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID;
            return new Zend_Auth_Result($code, false, 'Set Token for authorization');
        }

        $args = array(
            'client_id'     => $this->_appId,
            'client_secret' => $this->_secret,
            'type'          => 'client_cred',
            'redirect_uri'  => $this->getCurrentUrl(),
            'code'          => $this->_token,
        );

        $response = $this->_apiCall($this->_url, $args);
        if (isset($response['error'])) {
            $code = Zend_Auth_Result::FAILURE;
            $msgs[] = $response['error']['message'];
            $result = new Zend_Auth_Result($code, false, $msgs);
        } else {
            $code = Zend_Auth_Result::SUCCESS;
            $identity = $response['access_token'];
            $result = new Zend_Auth_Result($code, $identity);
        }

        return $result;
    }

    /**
     * Make post to url
     * @param string $url
     * @param array $params
     * @return array
     */
    protected function _apiCall($url, $params)
    {
        $r = new Zend_Http_Client($url);
        $r->setParameterPost($params);
        $response = $r->request(Zend_Http_Client::POST);
        
        $res = json_decode($response->getBody(), true);
        if(is_array($res)) {
            return $res;
        } else {
            $access_token = str_replace('access_token=', '', $response->getBody());
            return array('access_token' => $access_token);
        }
    }

    /**
     * Redirect to login page
     */
    public function redirect()
    {
        $params = array(
            'scope'         => $this->_permissions,
            'client_id'     => $this->_appId,
            'redirect_uri'  => $this->getCurrentUrl(),
        );
        $url = 'https://graph.facebook.com/oauth/authorize?';
        $url .= http_build_query($params, null, '&');
        header('Location: '.$url);
        exit();
    }

    /**
    * Returns the Current URL, stripping it of known FB parameters that should
    * not persist.
    *
    * @return String the current URL
    */
    protected function getCurrentUrl()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'
          ? 'https://'
          : 'http://';
        $currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $parts = parse_url($currentUrl);

        // drop known fb params
        $query = '';
        if (!empty($parts['query'])) {
          $params = array();
          parse_str($parts['query'], $params);
          foreach(self::$DROP_QUERY_PARAMS as $key) {
            unset($params[$key]);
          }
          if (!empty($params)) {
            $query = '?' . http_build_query($params, null, '&');
          }
        }

        // use port if non default
        $port =
          isset($parts['port']) &&
          (($protocol === 'http://' && $parts['port'] !== 80) ||
           ($protocol === 'https://' && $parts['port'] !== 443))
          ? ':' . $parts['port'] : '';

        // rebuild
        return $protocol . $parts['host'] . $port . $parts['path'] . $query;
    }

}
