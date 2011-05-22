<?php
class Application_View_Helper_FeedList extends Zend_View_Helper_Abstract
{
    public $view;
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }
    public function feedList(Zend_Feed_Abstract $feed, $count = 10)
    {
        $entries = count($feed->entry);
        $max = $count < $entries ? $count : $entries; 
        $html = array ();
        $html[] = '<ul class="feed-list">';
        $counter = 0;
        while ($counter < $max) {
            $entry = $feed->entry->current();
            $html[] = '<li class="feed-list-item">';
            $html[] = '<span class="feed-list-author">';
            $html[] = sprintf('<a href="%s">@%s</a>', 
                $entry->author->uri, $entry->author->name);
            $html[] = '</span>';
            $html[] = '<span class="feed-list-title">';
            $html[] = $entry->title;
            $html[] = '</span>';
            $html[] = '</li>';
            $counter++;
            $feed->entry->next();
        }
        $html[] = '</ul>';
        return implode(PHP_EOL, $html);
    }
}