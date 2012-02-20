<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_model extends CI_Model
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
	
	public function checkLogin()
	{
		$sQuery = "SELECT u.userid,u.typeid,u.name,u.username,ut.name as type_name FROM ".T_USERS." AS u
                            LEFT JOIN ".T_USER_TYPE." AS ut ON(u.typeid=ut.typeid)
                            WHERE username='".$this->input->post('username')."' AND pass='".md5($this->input->post('password'))."'";
		$query = $this->db->query($sQuery);
        
        if ($query->num_rows() == 0) {
            return "Invalid login credentials";
        }
		
		$aValues = $query->row_array();
		
		$this->session->set_userdata($aValues);
		
		if($this->session->userdata('TargetUrl') != '')
		{
			$sTargetUrl = $this->session->userdata('TargetUrl');
			$this->session->set_userdata('TargetUrl','');
			redirect($sTargetUrl, 'location');
		}
		else
			redirect(base_url(), 'location');
	}
}

?>