<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
	
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
        public $aNotFound = array('result' => 'No results found');
	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function index($iPage = 1)
	{
		verifyLoggedIn();
		$iLimit = 10;
		
		$this->data['fLeftNavigation'] = 'newsNavigation';
		
		$this->data['sActiveNavigation'] = 'news';
		$this->data['sPageHeading'] = 'News List';
		$this->load->model('Page_model');
		
		if($this->input->post('btnSubmit'))
		{
			$this->Page_model->addPage();
		}
		if($this->input->post('btnUpdate'))
		{
			$this->Page_model->updatePage();
		}
		list($iNews, $aNews) = $this->Page_model->getUserPages(2,$iPage,$iLimit);
		$this->data['aNews'] = $aNews;
                
		$this->load->library('pagination');
		$config['base_url'] = site_url('api/viewnews');
		$config['first_url'] = site_url('api/viewnews');
		$config['total_rows'] = $iNews;
		$config['per_page'] = $iLimit;
		$this->pagination->initialize($config);
		$this->data['linkPagination'] = $this->pagination->create_links();
                
		$this->load->view('view_news',$this->data);
	}
	
	public function deleteRollAjax($iId)
	{
		$this->load->model('System_model');
		$this->System_model->deleteRole($iId);
	}
	
/*Start of login section*/	
	public function login()
	{
		if($this->session->userdata('userid')>0)
			redirect(base_url(), 'location');
		
		if($this->input->post('btnLogin'))
		{
			$this->load->model('System_model');
			$this->data['error'] = $this->System_model->checkLogin();
		}
		
		$this->load->view('login', $this->data);
	}
	
	public function logout()
	{
		$aUserData = array (
				'user_id'	=> 0,
			  	'username'	=> '',
		);

		$this->session->unset_userdata($aUserData);
		$this->session->sess_destroy();
		redirect(base_url(), 'location');
	}
	
	/*End of login section*/
	/*Start of news section*/
	public function news($iUserId = NULL,$iPage = 1)
	{
		$iLimit = 25;
		$aJson = array();
		$this->load->model('Page_model');
		list($iNews, $aNews) = $this->Page_model->getPages($iUserId,2,$iPage,$iLimit);
		$this->data['aNews'] = $aNews;
                if(count($aNews) > 0)
                {
                    foreach($aNews as $aNew)
                    {
                        $imgurl = base_url().'page/'.$aNew['imageurl'];
                        $sText = trim(strip_tags($aNew['text']));
                                $order   = array("\r\n", "\n", "\r","\t","\u");
                                $sText = substr(str_replace($order,' ',$sText),0,150);
                                $sHeadline = str_replace($order,' ',$aNew['headline']);
                        $aJson[] = array(   'newsid' => $aNew['pageid'],
                                            'news'   => $sHeadline,
                                            'imgurl' => $imgurl,
                                            'text'   =>$sText
                                        );
                    }
                    echo json_encode($aJson);
                } else 
                {
                    echo json_encode($this->aNotFound);
                }
                
         }
         public function newsitem($iNewsId)
        {
                $this->load->model('Page_model');
                $aNews = $this->Page_model->getPage($iNewsId);
                 if($aNews)
                 {
                        $sText = trim(strip_tags($aNews['text']));
                                $order   = array("\r\n", "\n", "\r","\t","\u");
                                $sText = str_replace($order,' ',$sText);
						
					   $sHeadline = $aNews['headline'];
					   
                    $imgurl = base_url().'page/'.$aNews['imageurl'];
                    $aJson = array( 'newsid' => $aNews['pageid'],
                                    'news'   => $sHeadline,
                                    'imgurl' => $imgurl,
                                    'text'   => $sText
                                );
                    echo json_encode($aJson);
                 } else 
                {
                    echo json_encode($this->aNotFound);
                }
        }
         public function viewnews($iPage = 1)
	{
		verifyLoggedIn();
		$iLimit = 10;
		
		$this->data['fLeftNavigation'] = 'newsNavigation';
		
		$this->data['sActiveNavigation'] = 'news';
                $this->data['sPageHeading'] = 'News List';
               
		
		$this->load->model('Page_model');
		
		if($this->input->post('btnSubmit'))
		{
			$this->Page_model->addPage();
		}
		if($this->input->post('btnUpdate'))
		{
			$this->Page_model->updatePage();
		}
                if($this->input->post('btnSubmitSec'))
                {
                     $this->session->set_userdata('nUser',trim($this->input->post('nUser')));
                    $this->session->set_userdata('nHeadline',trim($this->input->post('nHeadline')));
                    $this->session->set_userdata('nPost_from',trim($this->input->post('nPost_from')));
                    $this->session->set_userdata('nPost_to',trim($this->input->post('nPost_to')));
                }
                  if($this->input->post('btnResetSec'))
                {
                    $this->session->unset_userdata('nUser');
                    $this->session->unset_userdata('nHeadline');
                    $this->session->unset_userdata('nPost_from');
                    $this->session->unset_userdata('nPost_to');
                }
                
		list($iNews, $aNews) = $this->Page_model->getUserNews(2,$iPage,$iLimit);
		$this->data['aNews'] = $aNews;
		
                $this->load->library('pagination');
		$config['base_url'] = site_url(array('api','viewnews'));
		$config['first_url'] = site_url(array('api','viewnews'));
		$config['total_rows'] = $iNews;
		$config['per_page'] = $iLimit;
		$this->pagination->initialize($config);
		$this->data['linkPagination'] = $this->pagination->create_links();
                
		$this->load->view('view_news',$this->data);	
	}

	public function addnews()
	{
		verifyLoggedIn();
		
		$this->data['fLeftNavigation'] = 'newsNavigation';
		
		$this->data['sActiveNavigation'] = 'add_news';
                $this->data['sPageHeading'] = 'Add News';
                 $this->data['sPostPage'] = 'viewnews';
                $this->data['iTypeId'] = 2;
		$this->load->view('addPage',$this->data);	
		
	}
	
	public function editnews($iNewsId)
	{
		verifyLoggedIn();
		$this->data['fLeftNavigation'] = 'newsNavigation';
		$this->data['sActiveNavigation'] = 'add_news';
                 $this->data['sPostPage'] = 'viewnews';
                $this->data['iTypeId'] = 2;
                $this->data['sPageHeading'] = 'Edit News';
		$this->load->model('Page_model');
		$this->data['aPage'] = $this->Page_model->getUserPage($iNewsId);
		$this->load->view('addPage',$this->data);	
	}
	public function viewnewsitem($iNewsId)
	{
		
		$this->data['fLeftNavigation'] = 'newsNavigation';
		$this->data['sActiveNavigation'] = 'news_item';
                $this->data['sPageHeading'] = 'News Item';
		$this->load->model('Page_model');
		$this->data['aPage'] = $this->Page_model->getPage($iNewsId);
		$this->load->view('pageitem',$this->data);	
	}
	
	public function deleteNewsAjax($iNewsId)
	{
		$this->load->model('Page_model');
		$this->Page_model->deleteNewsAjax($iNewsId);
		
	}
	
	/*End of news section*/
    /*Start of page section*/
        
        public function pages($iUserId = NULL,$iPage = 1)
	{
		
		$iLimit = 25;
                $this->load->model('Page_model');
		list($iPages, $aPages) = $this->Page_model->getPages($iUserId,1,$iPage,$iLimit);
		$this->data['aPages'] = $aPages;
                
                if(count($aPages) > 0)
                {
                    foreach($aPages as $aPage)
                    {
                           $sText = trim(strip_tags($aPage['text']));
                        $order   = array("\r\n", "\n", "\r","\t","\u");
                        $sText = substr(str_replace($order,' ',$sText),0,150);
                          $sHeadline = str_replace($order,' ',$aPage['headline']);
                        $imgurl = base_url().'page/'.$aPage['imageurl'];
                        $aJson[] = array(   'pageid' => $aPage['pageid'],
                                            'name'   => $sHeadline,
                                            'imgurl' => $imgurl,
                                            'text'   => $sText
                                        );
                    }
                    echo json_encode($aJson);
                } else 
                {
                    echo json_encode($this->aNotFound);
                }
                	
	}
        public function pageitem($iPageId)
	{
                $this->load->model('Page_model');
		$aPage = $this->Page_model->getPage($iPageId);
		 if($aPage)
                 {
                  $sText = trim(strip_tags($aPage['text']));
                        $order   = array("\r\n", "\n", "\r","\t","\u");
                        $sText = str_replace($order,' ',$sText);

                  $sHeadline = str_replace($order,' ',$aPage['headline']);
					  
                    $imgurl = base_url().'page/'.$aPage['imageurl'];
                    $aJson = array( 'pageid' => $aPage['pageid'],
                                    'name'   => $sHeadline,
                                    'imgurl' => $imgurl,
                                    'text'   => $sText
                                );
                    echo json_encode($aJson);
                 } else 
                {
                    echo json_encode($this->aNotFound);
                }	
                
	}
	public function viewpages($iPage = 1)
	{
		verifyLoggedIn();
		$iLimit = 10;
		
		$this->data['fLeftNavigation'] = 'pageNavigation';
		
		$this->data['sActiveNavigation'] = 'pages';
		
                $this->data['sPageHeading'] = 'Pages List';
                
		$this->load->model('Page_model');
		
		if($this->input->post('btnSubmit'))
		{
			$this->Page_model->addPage();
		}
		if($this->input->post('btnUpdate'))
		{
			$this->Page_model->updatePage();
		}
                  if($this->input->post('btnSubmitSec'))
                    {
                        $this->session->set_userdata('pUser',trim($this->input->post('pUser')));
                        $this->session->set_userdata('pHeadline',trim($this->input->post('pHeadline')));
                        $this->session->set_userdata('pPost_from',trim($this->input->post('pPost_from')));
                        $this->session->set_userdata('pPost_to',trim($this->input->post('pPost_to')));
                    }
                      if($this->input->post('btnResetSec'))
                    {
                        $this->session->unset_userdata('pUser');
                        $this->session->unset_userdata('pHeadline');
                        $this->session->unset_userdata('pPost_from');
                        $this->session->unset_userdata('pPost_to');
                    }
                
		list($iPages, $aPages) = $this->Page_model->getUserPages(1,$iPage,$iLimit);
		$this->data['aPages'] = $aPages;
		
                $this->data['iPage'] = $iPage;
                $this->load->library('pagination');
		$config['base_url'] = site_url(array('api','viewpages'));
		$config['first_url'] = site_url(array('api','viewpages'));
		$config['total_rows'] = $iPages;
		$config['per_page'] = $iLimit;
		$this->pagination->initialize($config);
		$this->data['linkPagination'] = $this->pagination->create_links();
                
		$this->load->view('view_pages',$this->data);	
	}

	public function addpage()
	{
		verifyLoggedIn();
		
		$this->data['fLeftNavigation'] = 'pageNavigation';
		$this->data['sActiveNavigation'] = 'add_page';
                $this->data['sPageHeading'] = 'Add Page';
                 $this->data['sPostPage'] = 'viewpages';
                $this->data['iTypeId'] = 1;
		$this->load->view('addPage',$this->data);	
		
	}
	
	public function editpage($iPageId)
	{
		verifyLoggedIn();
		$this->data['fLeftNavigation'] = 'pageNavigation';
		$this->data['sActiveNavigation'] = 'add_page';
                $this->data['iTypeId'] = 1;
                $this->data['sPageHeading'] = 'Edit Page';
                $this->data['sPostPage'] = 'viewpages';
		$this->load->model('Page_model');
		$this->data['aPage'] = $this->Page_model->getUserPage($iPageId);
		$this->load->view('addPage',$this->data);	
	}
	public function viewpageitem($iPageId)
	{
		
		$this->data['fLeftNavigation'] = 'pageNavigation';
		$this->data['sActiveNavigation'] = 'page_item';
                $this->data['sPageHeading'] = 'Page Item';
		$this->load->model('Page_model');
		$this->data['aPage'] = $this->Page_model->getPage($iPageId);
		$this->load->view('pageitem',$this->data);	
	}
	
	public function deletePageAjax($iPageId)
	{
		$this->load->model('Page_model');
		$this->Page_model->deletePageAjax($iPageId);
		
	}
	
	/*End of page section*/
        
	/*Start of user section*/
	public function users($iUser = 1)
	{
		verifyLoggedIn();
                
                checkPermission(3);
                
		$iLimit = 10;
		$this->data['fLeftNavigation'] = 'userNavigation';
		
		$this->data['sActiveNavigation'] = 'users';
		$this->data['sPageHeading'] = 'View Users List';
		$this->load->model('User_model');
		
		if($this->input->post('btnSubmit'))
		{
			$this->data['message'] = $this->User_model->addUser();
		}
		if($this->input->post('btnUpdate'))
		{
			$this->data['message'] = $this->User_model->updateUser();
		}
		list($iUsers, $aUsers) = $this->User_model->getUsers($iUser,$iLimit);
		$this->data['aUsers'] = $aUsers;
		$this->load->library('pagination');
		$config['base_url'] = site_url('api/users');
		$config['first_url'] = site_url('api/users');
		$config['total_rows'] = $iUsers;
		$config['per_page'] = $iLimit;
		$this->pagination->initialize($config);
		$this->data['linkPagination'] = $this->pagination->create_links();
		$this->load->view('view_users',$this->data);	
	}

	public function adduser()
	{
		verifyLoggedIn();
                
		checkPermission(3);
                
		$this->data['fLeftNavigation'] = 'userNavigation';
		$this->data['sActiveNavigation'] = 'add_user';
                $this->data['sPageHeading'] = 'Add User';
		$this->load->model('User_model');
		$this->data['aUserTypes'] = $this->User_model->getUserTypes();
		$this->load->view('addUser',$this->data);	
		
	}
        public function changepassword()
	{
		verifyLoggedIn();
                
		$this->data['fLeftNavigation'] = '';
		$this->data['sActiveNavigation'] = 'add_user';
                $this->data['sPageHeading'] = 'Change Password';
		$this->load->model('User_model');
                if($this->input->post('btnSubmit'))
		{
			$this->data['message'] = $this->User_model->changePassword();
		}
		$this->load->view('changePassword',$this->data);	
		
	}
	
	public function edituser($iUserId)
	{
		verifyLoggedIn();
                
                checkPermission(3);
                
		$this->data['fLeftNavigation'] = 'userNavigation';
		$this->data['sActiveNavigation'] = 'edit_user';
                $this->data['sPageHeading'] = 'Edit User';
		$this->load->model('User_model');
		$this->data['aUserTypes'] = $this->User_model->getUserTypes();
		$this->data['aUser'] = $this->User_model->getUser($iUserId);
		$this->load->view('addUser',$this->data);	
	}
	public function useritem($iUserId)
	{
		verifyLoggedIn();
                
                checkPermission(3);
		$this->data['fLeftNavigation'] = 'userNavigation';
		$this->data['sActiveNavigation'] = 'user_item';
                $this->data['sPageHeading'] = 'View Useritem';
		$this->load->model('User_model');
		$this->data['aUser'] = $this->User_model->getUser($iUserId);
		$this->load->view('view_user',$this->data);	
	}
	
	public function deleteUserAjax($iUserId)
	{
                checkPermission(3);
		$this->load->model('User_model');
		$this->User_model->deleteUserAjax($iUserId);
		
	}
	
	/*End of user section*/
			
	/*Start of member section*/
        public function members($iUserId = NULL,$iPage = 1)
	{
		$iLimit = 25;
		$this->load->model('Member_model');
		list($iMembers, $aMembers) = $this->Member_model->getMembers($iUserId,$iPage,$iLimit);
		$this->data['aMembers'] = $aMembers;
		if(count($aMembers) > 0)
                {
                    foreach($aMembers as $aMember)
                    {
                        $imgurl = base_url().'members/'.$aMember['imageurl'];
                        $order   = array("\r\n", "\n", "\r","\t","\u");
                         $sFirstName = str_replace($order,' ',$aMember['firstname']);
                          $sLastName = str_replace($order,' ',$aMember['lastname']);
					 
						
                        $aJson[] = array(   'memberId' => $aMember['memberid'],
                                            'firstname'   => $sFirstName,
                                            'lastname'   => $sLastName,
                                            'imgurl' => $imgurl,
                                            'number'   => $aMember['number']
                                        );
                    }
                    echo json_encode($aJson);
                } else 
                {
                    echo json_encode($this->aNotFound);
                }
	}
        
        public function memberitem($iMemberId)
	{
		
		$this->load->model('Member_model');
		$aMember = $this->Member_model->getMember($iMemberId);
		 if($aMember)
                 {
                       $sText = trim(strip_tags($aMember['text']));
                            $order   = array("\r\n", "\n", "\r","\t","\u");
                            $sText = str_replace($order,' ',$sText);

					 $sFirstName = str_replace($order,' ',$aMember['firstname']);
					  $sLastName = str_replace($order,' ',$aMember['lastname']);
					   $sFirstClub = str_replace($order,' ',$aMember['firstclub']);
					    $sArrived = str_replace($order,' ',$aMember['arrived']);
					 
                    $imgurl = base_url().'members/'.$aMember['imageurl'];
                    $aJson = array( 'memberId'   => $aMember['memberid'],
                                    'firstname'  => $sFirstName,
                                    'lastname'   => $sLastName,
                                    'imgurl'     => $imgurl,
                                    'number'     => $aMember['number'],
                                     'yearborn'   => $aMember['born'],
                                     'games'     => $aMember['games'],
                                     'goals'     => $aMember['goals'],
                                     'firstclub' => $sFirstClub,
                                     'arrived'   => $sArrived,
                                     'text'      => $sText
                                );
                    echo json_encode($aJson);
                 } else 
                {
                    echo json_encode($this->aNotFound);
                }	
	}
        
	public function viewmembers($iPage = 1)
	{
		verifyLoggedIn();
		
		checkPermission(2);
		
		$iLimit = 10;
		
		$this->data['fLeftNavigation'] = 'memberNavigation';
		
		$this->data['sActiveNavigation'] = 'members';
		$this->data['sPageHeading'] = 'View Members List';
		$this->load->model('Member_model');
		
		if($this->input->post('btnSubmit'))
		{
			$this->Member_model->addMember();
		}
		if($this->input->post('btnUpdate'))
		{
			$this->Member_model->updateMember();
		}
		list($iMembers, $aMembers) = $this->Member_model->getUserMembers($iPage,$iLimit);
		$this->data['aMembers'] = $aMembers;
		$this->load->library('pagination');
		$config['base_url'] = site_url(array('api','viewmembers'));
		$config['first_url'] = site_url(array('api','viewmembers'));
		$config['total_rows'] = $iMembers;
		$config['per_page'] = $iLimit;
		$this->pagination->initialize($config);
		$this->data['linkPagination'] = $this->pagination->create_links();
		
		$this->load->view('view_members',$this->data);	
	}

	public function addmember()
	{
		verifyLoggedIn();
		
		checkPermission(2);
		
		$this->data['fLeftNavigation'] = 'memberNavigation';
		
		$this->data['sActiveNavigation'] = 'add_member';
		$this->data['sPageHeading'] = 'Add Member';
                 $this->data['sPostPage'] = 'viewmembers';
		$this->load->view('addMember',$this->data);	
		
	}
	
	public function editmember($iMemberId)
	{
		verifyLoggedIn();
		
		checkPermission(2);
		
		$this->data['fLeftNavigation'] = 'memberNavigation';
		$this->data['sActiveNavigation'] = 'edit_member';
                $this->data['sPageHeading'] = 'Edit Member';
                $this->data['sPostPage'] = 'viewmembers';
		$this->load->model('Member_model');
		$this->data['aMember'] = $this->Member_model->getUserMember($iMemberId);
		$this->load->view('addMember',$this->data);	
	}
	public function viewmemberitem($iMemberId)
	{
		verifyLoggedIn();
		
		checkPermission(2);
		
		$this->data['fLeftNavigation'] = 'memberNavigation';
		$this->data['sActiveNavigation'] = 'member_item';
                $this->data['sPageHeading'] = 'View Memberitem';
		$this->load->model('Member_model');
		$this->data['aMember'] = $this->Member_model->getMember($iMemberId);
		$this->load->view('view_member',$this->data);	
	}
	
	public function deleteMemberAjax($iMemberId)
	{
		checkPermission(2);
                
		$this->load->model('Member_model');
		$this->Member_model->deleteMemberAjax($iMemberId);
		
	}
	
	/*End of member section*/
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */