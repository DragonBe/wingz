<?php
class Wingz_Service_JoindinTest extends PHPUnit_Framework_TestCase
{
    protected $_joindin;
    protected $_live = true;
    
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
        $this->assertXmlStringEqualsXmlFile(
            dirname(__FILE__) . '/_files/eventtalks.xml',
                $this->_joindin->event()->getTalks(8));
    }
}