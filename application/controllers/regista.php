<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Regista extends CI_Controller {
	
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
	/*Start of news section*/
	public function newspage($iNewsId)
	{
            $this->load->model('Page_model');
            $this->data['aPage'] = $this->Page_model->getPage($iNewsId);
            $this->load->view('pageitem',$this->data);	
	}
	
	
	/*End of news section*/
        /*Start of page section*/
 	public function page($iPageId)
	{
            $this->load->model('Page_model');
            $this->data['aPage'] = $this->Page_model->getPage($iPageId);
            $this->load->view('pageitem',$this->data);	
	}
	
	
	/*End of page section*/
        public function members($iMemberId)
	{
		
            $this->load->model('Member_model');
            $this->data['aMember'] = $this->Member_model->getMember($iMemberId);
            $this->load->view('view_member',$this->data);	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */