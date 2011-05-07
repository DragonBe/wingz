<?php
class Wingz_Service_JoindinTest extends PHPUnit_Framework_TestCase
{
    protected $_joindin;
    protected $_live = false;
    
    protected function setUp()
    {
        parent::setUp();
        $this->_joindin = new Wingz_Service_Joindin();
        if (false === $this->_live) {
            $httpAdapter = new Zend_Http_Client_Adapter_Test();
            $this->_joindin->getClient()->setAdapter($httpAdapter);
        }
    }
    protected function tearDown()
    {
        $this->_joindin = null;
        parent::tearDown();
    }
    
    /**
     * First test all is put into place before we start rolling
     */
    public function testJoindinServiceCanBeInstantiated()
    {
        $this->assertInstanceOf('Wingz_Service_Joindin', $this->_joindin);
        $this->assertInstanceOf('Wingz_Service_Joindin_Event', $this->_joindin->event());
        $this->assertInstanceOf('Wingz_Service_Joindin_Site', $this->_joindin->site());
        $this->assertInstanceOf('Wingz_Service_Joindin_Talk', $this->_joindin->talk());
        $this->assertInstanceOf('Wingz_Service_Joindin_User', $this->_joindin->user());
        $this->assertInstanceOf('Wingz_Service_Joindin_Comment', $this->_joindin->comment());
    }
    
    /**
     * Test the status of the joindin webservice
     */
    public function testJoindinServiceStatus()
    {
        $response = <<<EOL
HTTP/1.1 200 OK
Content-type: text/xml

<?xml version="1.0"?>
<response>
  <dt>Sun, 01 May 2011 01:00:00 +0000</dt>
  <test_string>this is a test</test_string>
</response>
EOL;
        if (false === $this->_live) {
            $this->_joindin->getClient()->getAdapter()->setResponse($response);
        } else {
            $this->markTestSkipped('Cannot predict time');
        }
        $this->assertXmlStringEqualsXmlFile(
            dirname(__FILE__) . '/_files/status.xml', 
            $this->_joindin->site()->getStatus('this is a test')); 
    }
    
    public function testJoindinListEvents()
    {
        $response = <<<EOL
HTTP/1.1 200 OK
Content-type: text/xml

<?xml version="1.0"?>
<response>
    <item>
        <event_name>PHP Appalachia 2008</event_name>
        <event_start>1223683200</event_start>
        <event_end>1224028799</event_end>
        <event_lat></event_lat>
        <event_long></event_long>
        <ID>12</ID>
        <event_loc>Pigeon Forge, TN</event_loc>
        <event_desc>Three days full of PHP, community and relaxation.</event_desc>
        <active>1</active>
        <event_stub>phpapp08</event_stub>
        <event_icon>phpappalachia.gif</event_icon>
        <pending></pending>
        <event_hashtag></event_hashtag>
        <event_href></event_href>
        <event_cfp_start></event_cfp_start>
        <event_cfp_end></event_cfp_end>
        <event_voting></event_voting>
        <private></private>
        <event_tz_cont></event_tz_cont>
        <event_tz_place></event_tz_place>
        <event_contact_name></event_contact_name>
        <event_contact_email></event_contact_email>
        <event_cfp_url></event_cfp_url>
        <num_attend>3</num_attend>
        <num_comments>0</num_comments>
        <user_attending>0</user_attending>
        <allow_comments>0</allow_comments>
    </item>
    <item>
        <event_name>Zend/PHP Conference &amp; Expo 2008</event_name>
        <event_start>1221436800</event_start>
        <event_end>1221782399</event_end>
        <event_lat></event_lat>
        <event_long></event_long>
        <ID>8</ID>
        <event_loc>San Jose, CA</event_loc>
        <event_desc>Zend's yearly PHP conference and Expo held in San Jose, California</event_desc>
        <active>1</active>
        <event_stub></event_stub>
        <event_icon>zendconexpo2008.gif</event_icon>
        <pending></pending>
        <event_hashtag>#zendcon08, #zendcon</event_hashtag>
        <event_href>http://www.zendcon.com/ZendCon08/public/content/home</event_href>
        <event_cfp_start></event_cfp_start>
        <event_cfp_end></event_cfp_end>
        <event_voting></event_voting>
        <private></private>
        <event_tz_cont></event_tz_cont>
        <event_tz_place></event_tz_place>
        <event_contact_name></event_contact_name>
        <event_contact_email></event_contact_email>
        <event_cfp_url></event_cfp_url>
        <num_attend>13</num_attend>
        <num_comments>0</num_comments>
        <user_attending>0</user_attending>
        <allow_comments>0</allow_comments>
    </item>
</response>
EOL;
        if (false === $this->_live) {
            $this->_joindin->getClient()->getAdapter()->setResponse($response);
        }
        $this->assertXmlStringEqualsXmlFile(
            dirname(__FILE__) . '/_files/eventlisthot.xml', 
            $this->_joindin->event()->getListing(
                Wingz_Service_Joindin_Event::LISTING_HOT));
        return $response;
    }
    /**
     * @depends testJoindinListEvents
     */
    public function testJoininListEventsWithCount($response)
    {
        $count = 2;
        if (false === $this->_live) {
            $this->_joindin->getClient()->getAdapter()->setResponse($response);
        }
        $data = $this->_joindin->event()->getListing(
            Wingz_Service_Joindin_Event::LISTING_UPCOMING, $count);
        $events = simplexml_load_string($data);
        $this->assertSame($count, count($events->item));
    }
    
    public function testJoindinGetEventDetail()
    {
        $response = <<<EOL
HTTP/1.1 200 OK
Content-type: text/xml

<?xml version="1.0"?>
<response>
    <item>
        <event_name>Zend/PHP Conference &amp; Expo 2008</event_name>
        <event_start>1221436800</event_start>
        <event_end>1221782399</event_end>
        <event_lat></event_lat>
        <event_long></event_long>
        <ID>8</ID>
        <event_loc>San Jose, CA</event_loc>
        <event_desc>Zend's yearly PHP conference and Expo held in San Jose, California</event_desc>
        <active>1</active>
        <event_stub></event_stub>
        <event_icon>zendconexpo2008.gif</event_icon>
        <pending></pending>
        <event_hashtag>#zendcon08, #zendcon</event_hashtag>
        <event_href>http://www.zendcon.com/ZendCon08/public/content/home</event_href>
        <event_cfp_start></event_cfp_start>
        <event_cfp_end></event_cfp_end>
        <event_voting></event_voting>
        <private></private>
        <event_tz_cont></event_tz_cont>
        <event_tz_place></event_tz_place>
        <event_contact_name></event_contact_name>
        <event_contact_email></event_contact_email>
        <event_cfp_url></event_cfp_url>
        <allow_comments>0</allow_comments>
        <num_attend>13</num_attend>
        <num_comments>0</num_comments>
        <now/>
        <timezoneString>/</timezoneString>
        <tracks/>
    </item>
</response>
EOL;
        if (false === $this->_live) {
            $this->_joindin->getClient()->getAdapter()->setResponse($response);
        }
        $this->assertXmlStringEqualsXmlFile(
            dirname(__FILE__) . '/_files/eventdetail.xml',
                $this->_joindin->event()->getEventDetail(8));
    }
    public function testJoindinGetEventTalks()
    {
        $response = <<<EOL
HTTP/1.1 200 OK
Content-type: text/xml

<?xml version="1.0"?>
<response>
    <item>
        <talk_title>Client-side Javascript Unit Testing</talk_title>
        <speaker>Tom Van Herreweghe</speaker>
        <slides_link>http://www.slideshare.net/Miljar/javascript-unit-testting-phpbenelux-20110504</slides_link>
        <date_given>1304530200</date_given>
        <event_id>672</event_id>
        <ID>3380</ID>
        <talk_desc>As a PHP developer, you've probably had to deal with Javascript at some point in your career. Some of
            the Javascript code you've written may even have been pretty complex. What happens if you need to make some
            changes? Will it break existing functionality? The only way to really know if everything is still working,
            is by unit testing your Javascript. This talk will introduce you to QUnit for creating Javascript unit tests
            and JsTestDriver for automating these tests.</talk_desc>
        <event_tz_cont>Europe</event_tz_cont>
        <event_tz_place>Brussels</event_tz_place>
        <event_start>1304460000</event_start>
        <event_end>1304546399</event_end>
        <lang>us</lang>
        <rank>5</rank>
        <comment_count>6</comment_count>
        <tcid>Talk</tcid>
        <tracks></tracks>
    </item>
    <item>
        <talk_title>Unit Testing with Zend Framework</talk_title>
        <speaker>Michelangelo van Dam</speaker>
        <slides_link>http://slidesha.re/jyVEtv</slides_link>
        <date_given>1304533800</date_given>
        <event_id>672</event_id>
        <ID>3381</ID>
        <talk_desc>In 2010, I told everyone how to start unit testing Zend Framework applications. In 2011, let&#x2019;s
            take this a step further by testing services, work flows and performance. Looking to raise the bar on
            quality? Let this talk be the push you need to improve your Zend Framework projects.</talk_desc>
        <event_tz_cont>Europe</event_tz_cont>
        <event_tz_place>Brussels</event_tz_place>
        <event_start>1304460000</event_start>
        <event_end>1304546399</event_end>
        <lang>us</lang>
        <rank>5</rank>
        <comment_count>6</comment_count>
        <tcid>Talk</tcid>
        <tracks></tracks>
    </item>
</response>
EOL;
        if (false === $this->_live) {
            $this->_joindin->getClient()->getAdapter()->setResponse($response);
        }
        $this->assertXmlStringEqualsXmlFile(
            dirname(__FILE__) . '/_files/eventtalks.xml',
                $this->_joindin->event()->getTalks(672));
    }
}