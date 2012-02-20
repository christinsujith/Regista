<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	
     /*
     * Author       :   Prabhakar.A
     * Framework    :   Codeigniter 2.1.0(php) 
     * Database     :   mysql 5.1  
     * Created      :   01-02-2012
     * Last Updated :   08-02-2012
    */
	public $data = array(	'page_title'        => '',
                                'errors'            => array(),
                                'error'             => '',
                                'fLeftNavigation'   => '',
                                'sActiveNavigation' => ''
                            );
	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function index($iPage = 1)
	{
            
            $this->output->set_content_type('application/xml');
            $this->output->set_output('<?xml version="1.0" ?>  
                                <rss version="2.0">
                                  <channel>
                                    <title>Liftoff News</title>
                                    <link>http://liftoff.msfc.nasa.gov/</link>
                                    <description>Liftoff to Space Exploration.</description>
                                    <language>en-us</language>
                                    <pubDate>Tue, 10 Jun 2003 04:00:00 GMT</pubDate>
                                    <lastBuildDate>Tue, 10 Jun 2003 09:41:01 GMT</lastBuildDate>
                                    <docs>http://blogs.law.harvard.edu/tech/rss</docs>
                                    <generator>Weblog Editor 2.0</generator>
                                    <managingEditor>editor@example.com</managingEditor>
                                    <webMaster>webmaster@example.com</webMaster>

                                    <item>
                                      <title>Star City</title>
                                      <link>http://liftoff.msfc.nasa.gov/news/2003/news-starcity.asp</link>
                                      <description>How do Americans get ready to work with Russians aboard the
                                        International Space Station? They take a crash course in culture, language
                                        and protocol at Russia Star City.</description>
                                      <pubDate>Tue, 03 Jun 2003 09:39:21 GMT</pubDate>
                                      <guid>http://liftoff.msfc.nasa.gov/2003/06/03.html#item573</guid>
                                    </item>

                                    <item>
                                      <title>Space Exploration</title>
                                      <link>http://liftoff.msfc.nasa.gov/</link>
                                      <description>Sky watchers in Europe, Asia, and parts of Alaska and Canada
                                        will experience a partial eclipse of the Sun on Saturday, May 31st.</description>
                                      <pubDate>Fri, 30 May 2003 11:06:42 GMT</pubDate>
                                      <guid>http://liftoff.msfc.nasa.gov/2003/05/30.html#item572</guid>
                                    </item>

                                    <item>
                                      <title>The Engine That Does More</title>
                                      <link>http://liftoff.msfc.nasa.gov/news/2003/news-VASIMR.asp</link>
                                      <description>Before man travels to Mars, NASA hopes to design new engines
                                        that will let us fly through the Solar System more quickly.  The proposed
                                        VASIMR engine would do that.</description>
                                      <pubDate>Tue, 27 May 2003 08:37:32 GMT</pubDate>
                                      <guid>http://liftoff.msfc.nasa.gov/2003/05/27.html#item571</guid>
                                    </item>

                                    <item>
                                      <title>Astronauts Dirty Laundry</title>
                                      <link>http://liftoff.msfc.nasa.gov/news/2003/news-laundry.asp</link>
                                      <description>Compared to earlier spacecraft, the International Space
                                        Station has many luxuries, but laundry facilities are not one of them.
                                        Instead, astronauts have other options.</description>
                                      <pubDate>Tue, 20 May 2003 08:56:02 GMT</pubDate>
                                      <guid>http://liftoff.msfc.nasa.gov/2003/05/20.html#item570</guid>
                                    </item>
                                  </channel>
                                </rss>');
        }
}