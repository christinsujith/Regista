<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rss extends CI_Controller {

    /*
     * Author       :   Prabhakar.A
     * Framework    :   Codeigniter 2.1.0(php) 
     * Database     :   mysql 5.5.16  
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
       
        public function news($iUserId)
	{
            $aItems =array();
            $this->load->model('Page_model');
            list($iNews,$aNews) = $this->Page_model->getPages($iUserId,2,1,25);
            if(count($aNews) > 0)
            {
                
                foreach($aNews as $aPage)
                {
                    $link = site_url(array('regista','newspage',$aPage['pageid']));
                    
                     $imgpath = base_url().'page/'.str_replace('.', '_thumb.', $aPage['imageurl']);

                    $aItems[] = array(  'title'         =>$aPage['headline'],
                                        'link'          =>$link,
                                        'description'   =>$aPage['text'],
                                        'imgpath'        =>$imgpath,
                                        'pubDate'       =>$aPage['created'],
                                        'guid'          =>$link
                                    );
                }
                $sItems = $this->getXmlItems($aItems);
                $sLink = base_url();
                $aXml = array(  'title'         =>  'regista',
                                'link'          =>  $sLink,
                                'description'   => 'Regista',
                                'pubDate'       =>  date("Y-m-d H:i:s", time()), 
                                'lastBulidDate' =>  date("Y-m-d H:i:s", time()),
                                'sItems'        =>  $sItems
                                );
                $sXml= $this->getXml($aXml);
                $this->output->set_content_type('application/xml');
                $this->output->set_output($sXml);
            }
        }
        public function page($iUserId)
	{
            $aItems =array();
            $this->load->model('Page_model');
            list($iPages,$aPages) = $this->Page_model->getPages($iUserId,1,1,25);
            if(count($aPages) > 0)
            {
                
                foreach($aPages as $aPage)
                {
                    $link = site_url(array('regista','page',$aPage['pageid']));
                    $imgpath = base_url().'page/'.str_replace('.', '_thumb.', $aPage['imageurl']);
                    
                    $aItems[] = array(  'title'         =>$aPage['headline'],
                                        'link'          =>$link,
                                        'description'   =>$aPage['text'],
                                        'imgpath'      =>$imgpath,
                                        'pubDate'       =>$aPage['created'],
                                        'guid'          =>$link
                                    );
                }
                $sItems = $this->getXmlItems($aItems);
                $sLink = base_url();
                $aXml = array(  'title'         =>  'regista',
                                'link'          =>  $sLink,
                                'description'   => 'Regista',
                                'pubDate'       =>  date("Y-m-d H:i:s", time()), 
                                'lastBulidDate' =>  date("Y-m-d H:i:s", time()),
                                'sItems'        =>  $sItems
                                );
                $sXml= $this->getXml($aXml);
                $this->output->set_content_type('application/xml');
                $this->output->set_output($sXml);
            }
        }
        public function members($iUserId)
	{
            $aItems =array();
            $this->load->model('Member_model');
            list($iMembers,$aMembers) = $this->Member_model->getMembers($iUserId,1,25);
            if(count($aMembers) > 0)
            {
                
                foreach($aMembers as $aMember)
                {
                    $link = site_url(array('regista','members',$aMember['memberid']));
                    $imgpath = base_url().'members/'.str_replace('.', '_thumb.', $aMember['imageurl']);
                    $sName = $aMember['firstname'].' '.$aMember['lastname'];
                    $aItems[] = array(  'title'         =>$sName,
                                        'link'          =>$link,
                                        'description'   =>$aMember['number'],
                                        'imgpath'       =>$imgpath,
                                        'pubDate'       =>$aMember['created'],
                                        'guid'          =>$link
                                    );
                }
                $sItems = $this->getXmlItems($aItems);
                $sLink = base_url();
                $aXml = array(  'title'         =>  'regista',
                                'link'          =>  $sLink,
                                'description'   => 'Regista',
                                'pubDate'       =>  date("Y-m-d H:i:s", time()), 
                                'lastBulidDate' =>  date("Y-m-d H:i:s", time()),
                                'sItems'        =>  $sItems
                                );
                $sXml= $this->getXml($aXml);
                $this->output->set_content_type('application/xml');
                $this->output->set_output($sXml);
            }
        }  
        public function getXml($aXml)
        {
            $sXml = '<?xml version="1.0" ?>  
                    <rss version="2.0">
                      <channel>
                        <title>'.$aXml['title'].'</title>
                        <link>'.$aXml['link'].'</link>
                        <description>'.$aXml['description'].'</description>
                        <language>en-us</language>
                        <pubDate>'.$aXml['pubDate'].'</pubDate>
                        <lastBuildDate>'.$aXml['lastBulidDate'].'</lastBuildDate>
                        <docs>http://blogs.law.harvard.edu/tech/rss</docs>
                        <generator>Weblog Editor 2.0</generator>
                        <managingEditor>info@regista.com</managingEditor>
                        <webMaster>info@regista.com</webMaster> '.
                        $aXml['sItems']
                      .'</channel>
                    </rss>';
              return $sXml;
        }
        public function getXmlItems($aItems)
        {
            $sItems = "";
            foreach ($aItems as $aItem)
            {
                $sItems .=' <item>
                          <title>'.$aItem['title'].'</title>
                          <link>'.$aItem['link'].'</link>
                             <description><![CDATA[<img src="'.$aItem['imgpath'].'"  /><br/><p></p>]]>
                             '.html_entity_decode(substr(strip_tags($aItem['description']),0,150) , ENT_QUOTES, 'UTF-8').'</description>
                          <pubDate>'.$aItem['pubDate'].'</pubDate>
                          <guid>'.$aItem['guid'].'</guid>
                        </item> ';
            }
            return $sItems;
        }
}

