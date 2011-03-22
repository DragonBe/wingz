<?php
class Wingz_View_Helper_EventListItem extends Zend_View_Helper_Abstract
{
    public $view;
    
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }
    
    public function eventListItem(Wingz_Model_Event $event)
    {
        $html = array ();
        $html[] = '<div class="eventBox">';
        if (null !== $event->getUrl()) {
            $html[] = sprintf('  <h2 class="eventTitle"><a href="%s" title="%s">%s</a></h2>',
                $this->view->escape($event->getUrl()),
                $this->view->escape($event->getTitle()),
                $this->view->escape($event->getTitle()));
        } else {
            $html[] = sprintf('  <h2 class="eventTitle">%s</h2>',
                $this->view->escape($event->getTitle()));
        }
        $html[] = '  <div class="eventAbstract">';
        $html[] = '    <div class="eventDescription">';
        $html[] = sprintf('      <p>%s</p>', 
            nl2br($this->view->escape($event->getAbstract())));
        if (null !== $event->getLogo()->getUrl()) {
            $html[] = '      <span class="eventImage">';
            $html[] = sprintf('        <img src="%s" width="%d" height="%d" alt="%s" class="eventIcon"/>',
                $event->getLogo()->getUrl(),
                $event->getLogo()->getWidth(),
                $event->getLogo()->getHeight(),
                $this->view->escape($event->getHashtag()));
            $html[] = '      </span>';
        }
        $html[] = '    </div>';
        $html[] = '  </div>';
        $html[] = '  <div class="clear">&nbsp;</div>';
        $html[] = sprintf('  <div class="eventHashtag">Tagged as <a href="%s" title="%s">%s</a></div>',
            'http://hashtags.org/' . $event->getHashtag(),
            $event->getHashtag(),
            $event->getHashtag());
        $html[] = '</div>';
        $html[] = '';
        return implode(PHP_EOL, $html);
    }
}

/*
<div class="eventBox">
<h2 class="eventTitle">ConFoo 2011</h2>
    <div class="eventAbstract">
        <div class="eventDescription">
                        <p>PHP Québec, Montréal-Python, Montreal.rb, W3Qc and OWASP Montréal are proud to announce the second edition of the ConFoo Conference. From March 9th to 11th 2011, international experts in Java, .Net, PHP, Python and Ruby will present solutions for developers and project managers the prestigious Hilton Bonaventure Hotel, located in downtown Montréal.</p>
                    </div>
        <span class="eventImage">

                        <img src="http://joind.in/inc/img/event_icons/logo_confoo_joindin1.gif"
            width="84" height="84" alt="Event icon" class="eventIcon"/>
                    </span>
    </div>
    <div class="clear">&nbsp;</div>
</div>
*/
