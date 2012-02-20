<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model
{
    /*
     * Author       :   Prabhakar.A
     * Framework    :   Codeigniter 2.1.0 
     * Database     :   mysql 5.5.16   
     * Created      :   01-02-2012
     * Last Updated :   08-02-2012
    */

	public function __construct()
  	{
    	parent::__construct();
  	}
	
	public function addMember()
	{
			$aMember = array(	'userid'	=> $this->session->userdata('userid'),
                                                'firstname'	=> $this->input->post('firstname'),
                                                'lastname'	=> $this->input->post('lastname'),
                                                'number' 	=> $this->input->post('number'),
                                                'born' 		=> $this->input->post('born'),
                                                'games' 	=> $this->input->post('games'),
                                                'goals' 	=> $this->input->post('goals'),
                                                'arrived'	=> $this->input->post('arrived'),
                                                'firstclub' 	=> $this->input->post('firstclub'),
                                                'text' 		=> $this->input->post('text'),
                                                'created'	=> date("Y-m-d H:i:s", time())
                                        );
						
		$this->db->insert(T_MEMBER,$aMember);
                
              if($_FILES['imageurl']['name']!='')
                {
                        $iId = $this->db->insert_id();
                        $sFilename = $iId.'_'.time();
                        $config['upload_path'] = $this->config->item('base_path').'/members/';
                        $config['allowed_types'] = 'JPEG|jpg|jpeg|gif|png';
                        $config['max_size']	= '1000000';
                        $config['file_name'] = $sFilename;
                        $this->load->library('upload', $config);
                        $this->upload->do_upload('imageurl');
                        $aUFile = $this->upload->data();
                        //chmod($aUFile['full_path'], 0755);
                        $t_config['image_library'] = 'gd2';
                        $t_config['source_image'] = $this->config->item('base_path').'/members/'.$aUFile['file_name'];
                        $t_config['create_thumb'] = TRUE;
                        $t_config['maintain_ratio'] = TRUE;
                        $t_config['file_name'] = $sFilename.'_thumb';
                        $t_config['width'] = 120;
                        $t_config['height'] = 120;

                        $this->load->library('image_lib', $t_config);

                        $this->image_lib->resize();
                        $this->db->update(T_MEMBER, array('imageurl'=>$aUFile['file_name']), array('memberid'=>$iId));
                }
	}
	
	public function updateMember()
	{
		$aMember = array(	'userid'	=> $this->session->userdata('userid'),
                                        'firstname'	=> $this->input->post('firstname'),
                                        'lastname'	=> $this->input->post('lastname'),
                                        'number' 	=> $this->input->post('number'),
                                        'born' 		=> $this->input->post('born'),
                                        'games' 	=> $this->input->post('games'),
                                        'goals' 	=> $this->input->post('goals'),
                                        'arrived' 	=> $this->input->post('arrived'),
                                        'firstclub' 	=> $this->input->post('firstclub'),
                                        'text' 		=> $this->input->post('text'),
                                        'updated' 	=> date("Y-m-d H:i:s", time())
                                );
						
		$iId = $this->input->post('memberid');
		
		$this->db->update(T_MEMBER, $aMember, array('memberid' => $iId));
                 if($_FILES['imageurl']['name']!='')
                    {
			$sMember = $this->getMember($iId);
                        
                        if($sMember)
                        {
                            @unlink($this->config->item('base_path').'/members/'.$sMember['imageurl']);  
                            @unlink($this->config->item('base_path').'/members/'.str_replace('.', '_thumb.',$sMember['imageurl']));  
                            
                        } 
                        $sFilename = $iId.'_'.time();
			$config['upload_path'] = $this->config->item('base_path').'/members/';
			$config['allowed_types'] = 'JPEG|jpg|jpeg|gif|png';
			$config['max_size']	= '1000000';
			$config['file_name'] = $sFilename;
			$this->load->library('upload', $config);
			$this->upload->do_upload('imageurl');
			$aUFile = $this->upload->data();
			//chmod($aUFile['full_path'], 0755);
                        $t_config['image_library'] = 'gd2';
			$t_config['source_image'] = $this->config->item('base_path').'/members/'.$aUFile['file_name'];
			$t_config['create_thumb'] = TRUE;
			$t_config['maintain_ratio'] = TRUE;
                        $t_config['file_name'] = $sFilename.'_thumb';
			$t_config['width'] = 120;
			$t_config['height'] = 120;
			
			$this->load->library('image_lib', $t_config);
			
			$this->image_lib->resize();
			$this->db->update(T_MEMBER, array('imageurl'=>$aUFile['file_name']), array('memberid'=>$iId));
		}
		
	}
	public function getMembers($iUserId = NULL,$iPage = 1, $iLimit = 10)
	{
		$aTableData = array();
                $sCloumn = "m.*,u.username";
		$sQuery = "SELECT ".$sCloumn." FROM ".T_MEMBER." AS m
                            LEFT JOIN ".T_USERS." AS u ON(m.userid=u.userid)
                            WHERE m.userid IS NOT NULL ";
                if($iUserId != "")
                {
                    $sQuery .= " AND m.userid =".$iUserId;
                }
		$sQuery .= " ORDER BY m.created DESC";
		$rsCount = $this->db->query(str_replace($sCloumn, 'COUNT(*) AS total', $sQuery));
		$rwCount = $rsCount->row_array();
		
		if($rwCount['total'] > 0)
		{
			$iPage = $iPage - 1;
			if($iPage<0) $iPage = 0;
			$sQuery .= " LIMIT ".($iPage*$iLimit).",".$iLimit;		
			$rsMembers = $this->db->query($sQuery);
			foreach ($rsMembers->result_array() as $rwMembers)
			{
				$aTableData[] = $rwMembers;
			}
		}
		return array($rwCount['total'], $aTableData);
		
	}
	public function getAllMembers($iUserId = NULL)
	{
		$aTableData = array();
		$sQuery = "SELECT * FROM ".T_MEMBER." WHERE userid IS NOT NULL ";
		$sQuery .= " AND userid =".$iUserId;
		$sQuery .= " ORDER BY created DESC";
			
			$rsMembers = $this->db->query($sQuery);
			foreach ($rsMembers->result_array() as $rwMembers)
			{
				$aTableData[] = $rwMembers;
			}
			
		return  $aTableData;
		
	}
        
        public function getUserMembers($iPage = 1, $iLimit = 10)
	{
		$aTableData = array();
                $sCloumn = "m.*,u.username";
		$sQuery = "SELECT ".$sCloumn." FROM ".T_MEMBER." AS m 
                            LEFT JOIN ".T_USERS." AS u ON(m.userid=u.userid)
                            WHERE m.userid IS NOT NULL ";
                if($this->session->userdata('typeid')  != 3)
                $sQuery .= " AND m.userid =".$this->session->userdata('userid');
		$sQuery .= " ORDER BY m.created DESC";
		$rsCount = $this->db->query(str_replace($sCloumn, 'COUNT(*) AS total', $sQuery));
		$rwCount = $rsCount->row_array();
		
		if($rwCount['total'] > 0)
		{
			$iPage = $iPage - 1;
			if($iPage<0) $iPage = 0;
			$sQuery .= " LIMIT ".($iPage*$iLimit).",".$iLimit;		
			$rsMembers = $this->db->query($sQuery);
			foreach ($rsMembers->result_array() as $rwMembers)
			{
				$aTableData[] = $rwMembers;
			}
		}
		return array($rwCount['total'], $aTableData);
		
	}
	public function getMember($iMemberId)
	{
		$query = "SELECT * FROM ".T_MEMBER." WHERE memberid =".$iMemberId;
		$rsMembers = $this->db->query($query);
		if($rsMembers->num_rows() > 0)
		{
			$aTableData = $rsMembers->row_array();
			return $aTableData;
		}
	}
        public function getUserMember($iMemberId)
	{
		$query = "SELECT * FROM ".T_MEMBER." WHERE memberid =".$iMemberId;
                 if($this->session->userdata('typeid')  != 3)
                $query .=" AND userid = ".$this->session->userdata('userid');
		$rsMembers = $this->db->query($query);
		if($rsMembers->num_rows() > 0)
		{
			$aTableData = $rsMembers->row_array();
			return $aTableData;
		}
	}
	
	public function deleteMemberAjax($iMemberId)
	{
             $aMember = $this->getMember($iMemberId);
                if($aMember)
                {
                    @unlink($this->config->item('base_path').'/members/'.$aMember['imageurl']);  
                    @unlink($this->config->item('base_path').'/members/'.str_replace('.', '_thumb.',$aMember['imageurl']));  
                     $this->db->query("DELETE FROM ".T_MEMBER." WHERE memberid = ".$iMemberId);
                } 
		
	}
}