<?php
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