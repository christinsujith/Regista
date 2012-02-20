<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
     /*
     * Author       :   Prabhakar.A
     * Framework    :   Codeigniter 2.1.0(php) 
     * Database     :   mysql 5.5.16   
     * Created      :   01-02-2012
     * Last Updated :   08-02-2012
    */
	public function __construct()
  	{
    	parent::__construct();
		
  	}
	public function addUser()
	{
			$aUser = array(		'typeid'	=> $this->input->post('typeid'),
                                                'name'		=> $this->input->post('name'),
                                                'username'	=> $this->input->post('username'),
                                                'pass' 		=> md5($this->input->post('pass')),
                                                'lastlogin'     => date("Y-m-d H:i:s", time()),
                                                'created' 	=> date("Y-m-d H:i:s", time())
                                        );
                        
                    if($this->getUserByName($this->input->post('username')))    
                    {				
                        return "User Name Already Exist";
                    }
                    else
                    {
                        $this->db->insert(T_USERS,$aUser);
                        return "User Added Successfuly";
                    }
	}
	
	public function updateUser()
	{
		$aUser = array(	'typeid'    => $this->input->post('typeid'),
                                'name'      => $this->input->post('name'),
                                'updated'   => date("Y-m-d H:i:s", time())
                        );
						
		$iId = $this->input->post('userid');
		
		$this->db->update(T_USERS, $aUser, array('userid' => $iId));
		
	}
	public function getUsers($iPage = 1, $iLimit = 10)
	{
		$aTableData = array();
                $sCloumn = "u.*,ut.name AS type_name";
		$sQuery = "SELECT ".$sCloumn." FROM ".T_USERS." AS u 
                            LEFT JOIN ".T_USER_TYPE." AS ut ON(u.typeid=ut.typeid)";
                
		$sQuery .= " ORDER BY u.created DESC";
		$rsCount = $this->db->query(str_replace($sCloumn, 'COUNT(*) AS total', $sQuery));
		$rwCount = $rsCount->row_array();
		
		if($rwCount['total'] > 0)
		{
			$iPage = $iPage - 1;
			if($iPage<0) $iPage = 0;
			$sQuery .= " LIMIT ".($iPage*$iLimit).",".$iLimit;		
			$rsUsers = $this->db->query($sQuery);
			foreach ($rsUsers->result_array() as $rwUsers)
			{
				$aTableData[] = $rwUsers;
			}
		}
		return array($rwCount['total'], $aTableData);
		
	}
        public function changePassword()
        {
            $query = "SELECT * FROM ".T_USERS." WHERE userid =".$this->session->userdata('userid')." 
                        AND pass='".  md5($this->input->post('pass'))."'";
            $rsUsers = $this->db->query($query);
		if($rsUsers->num_rows() > 0)
		{
			$aTableData = $rsUsers->row_array();
                        $sUpdate = "UPDATE ".T_USERS." SET pass ='".  md5($this->input->post('newpass'))."'
                                    WHERE userid=".$aTableData['userid'];
                        $this->db->query($sUpdate);
			return "Password Changed Successfuly";
		}
                else
                {
                    return "Old Password is Wrong";
                }
            
        }


        public function getUser($iUserId)
	{
		$query = "SELECT * FROM ".T_USERS." WHERE userid =".$iUserId;
		$rsUsers = $this->db->query($query);
		if($rsUsers->num_rows() > 0)
		{
			$aTableData = $rsUsers->row_array();
			return $aTableData;
		}
	}
        public function getUserByName($sUserName)
	{
		$query = "SELECT * FROM ".T_USERS." WHERE username ='".$sUserName."'";
		$rsUsers = $this->db->query($query);
		if($rsUsers->num_rows() > 0)
		{
			$aTableData = $rsUsers->row_array();
			return $aTableData;
		}
	}
	
	public function deleteUserAjax($iUserId)
	{
                $this->load->model('Page_model');
                $this->load->model('Member_model');
                $aUser = $this->getUser($iUserId);
                if(count($aUser) > 0 && $aUser['typeid']!= 3)
                {
		$aPages = $this->Page_model->getAllPages($iUserId);
			if($aPages)
			{
				foreach($aPages as $aPage)
				{
					@unlink($this->config->item('base_path').'/page/'.$aPage['imageurl']);  
					@unlink($this->config->item('base_path').'/page/'.str_replace('.', '_thumb.',$aPage['imageurl']));  
					$this->db->query("DELETE FROM ".T_PAGE." WHERE pageid = ".$aPage['pageid']);
				} 
			}
			
			$aMembers = $this->Member_model->getAllMembers($iUserId);
                if($aMembers)
                {
					foreach($aMembers as $aMember)
					{
						@unlink($this->config->item('base_path').'/members/'.$aMember['imageurl']);  
						@unlink($this->config->item('base_path').'/members/'.str_replace('.', '_thumb.',$aMember['imageurl']));  
						 $this->db->query("DELETE FROM ".T_MEMBER." WHERE memberid = ".$aMember['memberid']);
					}
                } 
				
		$this->db->query("DELETE FROM ".T_USERS." WHERE typeid != 3 AND userid = ".$iUserId);
                }   
	}
	
	public function getUserTypes()
	{
		$aTableData = array();
		$query = "SELECT * FROM ".T_USER_TYPE." ORDER BY typeid";	
		$rsTypes = $this->db->query($query);
		if($rsTypes->num_rows() > 0)
		{
			foreach($rsTypes->result_array() as $rwTypes)
			{
				$aTableData[] = $rwTypes;
			}
			
			return $aTableData;
		}
	
	}
}
?>