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
class Wingz_View_Helper_Facebook extends Zend_View_Helper_Abstract
{
    public function facebook()
    {
        $apiKey = '115813438483976';
        return $this->_createJavaScript($apiKey);
    }
    
    protected function _createJavaScript($apiKey)
    {
        return <<<EOS
<script>
      window.fbAsyncInit = function() {
        FB.init({appId: '{$apiKey}', status: true, cookie: true,
                 xfbml: true});
      };
      (function() {
        var e = document.createElement('script');
        e.type = 'text/javascript';
        e.src = document.location.protocol +
          '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
EOS
        ;
    }
}