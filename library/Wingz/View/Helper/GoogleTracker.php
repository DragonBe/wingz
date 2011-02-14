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
class Wingz_View_Helper_GoogleTracker extends Zend_View_Helper_Abstract
{
    public $view;
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }
    public function googleTracker($trackerCode)
    {
        $this->view->headScript()->appendScript(<<<EOS
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '{$trackerCode}']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
EOS
        );
    }
}