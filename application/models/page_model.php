<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model
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
	
	public function addPage()
	{
		$aPageTypeVar = array(1=>'page',2=>'newspage');
                
            $aPage = array(     	'typeid'		=> $this->input->post('typeid'),
                                                'userid'		=> $this->session->userdata('userid'),
                                                'externalid'	=> $this->input->post('externalid'),
                                                'headline' 		=> $this->input->post('headline'),
                                                'text'		=> $this->input->post('text'),
                                                'post_from' 	=> $this->input->post('post_from'),
                                                'post_to' 		=> $this->input->post('post_to'),
                                                'created' 		=> date("Y-m-d H:i:s", time())
                                );
						
		$this->db->insert(T_PAGE,$aPage);
                
                $iId = $this->db->insert_id();
                
                $sUrl = site_url(array('regista',$aPageTypeVar[$this->input->post('typeid')],$iId));
                
                $this->db->update(T_PAGE,array('url'=>$sUrl),array('pageid'=>$iId));
                
		if($_FILES['imageurl']['name']!='')
		{
			$sFilename = $iId.'_'.time();
			$config['upload_path'] = $this->config->item('base_path').'/page/';
			$config['allowed_types'] = 'JPEG|jpg|jpeg|gif|png';
			$config['max_size']	= '1000000';
                        $config['width'] = 600;
			$config['height'] = 400;
			$config['file_name'] = $sFilename;
			$this->load->library('upload', $config);
			$this->upload->do_upload('imageurl');
			$aUFile = $this->upload->data();
			//chmod($aUFile['full_path'], 0755);
						$t_config['image_library'] = 'gd2';
			$t_config['source_image'] = $this->config->item('base_path').'/page/'.$aUFile['file_name'];
			$t_config['create_thumb'] = TRUE;
			$t_config['maintain_ratio'] = TRUE;
						$t_config['file_name'] = $sFilename.'_thumb';
			$t_config['width'] = 120;
			$t_config['height'] = 120;
			
			$this->load->library('image_lib', $t_config);
			
			$this->image_lib->resize();
			$this->db->update(T_PAGE, array('imageurl'=>$aUFile['file_name']), array('pageid'=>$iId));
		}
	}
	
	public function updatePage()
	{
               $aPageTypeVar = array(1=>'page',2=>'newspage');
                
                $iId = $this->input->post('pageid');
            
                $sUrl = site_url(array('regista',$aPageTypeVar[$this->input->post('typeid')],$iId));
                
                 
		$aPage = array(     'typeid'		=> $this->input->post('typeid'),
                                    'externalid'	=> $this->session->userdata('userid'),
                                    'url'			=> $sUrl,
                                    'headline' 		=> $this->input->post('headline'),
                                    'text'			=> $this->input->post('text'),
                                    'post_from' 	=> $this->input->post('post_from'),
                                    'post_to' 		=> $this->input->post('post_to'),
                                    'updated' 		=> date("Y-m-d H:i:s", time())
                    );
						
	       
		$this->db->update(T_PAGE, $aPage, array('pageid' => $iId));
                
                if($_FILES['imageurl']['name']!='')
			{
			$sPage = $this->getPage($iId);
                        
                        if($sPage)
                        {
                            @unlink($this->config->item('base_path').'/page/'.$sPage['imageurl']);  
                            @unlink($this->config->item('base_path').'/page/'.str_replace('.', '_thumb.',$sPage['imageurl']));  
                        } 
                        $sFilename = $iId.'_'.time();
			$config['upload_path'] = $this->config->item('base_path').'/page/';
			$config['allowed_types'] = 'JPEG|jpg|jpeg|gif|png';
			$config['max_size']	= '1000000';
                        $config['width'] = 600;
			$config['height'] = 400;
			$config['file_name'] = $sFilename;
			$this->load->library('upload', $config);
			$this->upload->do_upload('imageurl');
			$aUFile = $this->upload->data();
			//chmod($aUFile['full_path'], 0755);
                        $t_config['image_library'] = 'gd2';
			$t_config['source_image'] = $this->config->item('base_path').'/page/'.$aUFile['file_name'];
			$t_config['create_thumb'] = TRUE;
			$t_config['maintain_ratio'] = TRUE;
                        $t_config['file_name'] = $sFilename.'_thumb';
			$t_config['width'] = 120;
			$t_config['height'] = 120;
			
			$this->load->library('image_lib', $t_config);
			
			$this->image_lib->resize();
			$this->db->update(T_PAGE, array('imageurl'=>$aUFile['file_name']), array('pageid'=>$iId));
		}
		
	}
	public function getPages($iUserId = NULL,$iType = NULL,$iPage = 1, $iLimit = 10)
	{
		$aTableData = array();
		$sClumon = "p.*,u.username,pt.name";
		$sQuery = "SELECT ".$sClumon." FROM ".T_PAGE." AS p 
					LEFT JOIN ".T_USERS." AS u ON(p.userid = u.userid)
					LEFT JOIN ".T_PAGE_TYPE." AS pt ON(p.typeid = pt.typeid)
					WHERE p.typeid IS NOT NULL AND
                                        ((p.post_from <= CURDATE() AND p.post_to >= CURDATE()) 
                                        OR (p.post_from = '0000-00-00 00:00:00' AND p.post_to = '0000-00-00 00:00:00') 
                                        OR (p.post_from <= CURDATE() AND p.post_to = '0000-00-00 00:00:00'))";
		if($iUserId != NULL)
		{
			$sQuery .=" AND p.userid = ".$iUserId;	
		}
		if($iType != NULL)
		{
			$sQuery .=" AND p.typeid = ".$iType;	
		}
		$sQuery .= " ORDER BY p.created DESC";
		$rsCount = $this->db->query(str_replace($sClumon, 'COUNT(*) AS total', $sQuery));
		$rwCount = $rsCount->row_array();
		
		if($rwCount['total'] > 0)
		{
			$iPage = $iPage - 1;
			if($iPage<0) $iPage = 0;
			$sQuery .= " LIMIT ".($iPage*$iLimit).",".$iLimit;		
			$rsPages = $this->db->query($sQuery);
			foreach ($rsPages->result_array() as $rwPages)
			{
				$aTableData[] = $rwPages;
			}
                        return array($rwCount['total'], $aTableData);
		}
		
		
	}
	
	public function getAllPages($iUserId = NULL)
	{
		$aTableData = array();
		$sClumon = "p.*,u.username,pt.name";
		$sQuery = "SELECT ".$sClumon." FROM ".T_PAGE." AS p 
					LEFT JOIN ".T_USERS." AS u ON(p.userid = u.userid)
					LEFT JOIN ".T_PAGE_TYPE." AS pt ON(p.typeid = pt.typeid)
					WHERE p.typeid IS NOT NULL";
                if($iUserId != NULL)
                {
                        $sQuery .=" AND p.userid = ".$iUserId;	
                }
		
			$sQuery .= " ORDER BY p.created DESC";
		
			$rsPages = $this->db->query($sQuery);
			foreach ($rsPages->result_array() as $rwPages)
			{
				$aTableData[] = $rwPages;
			}
		return  $aTableData;
		
	}
	
        public function getUserPages($iType = NULL,$iPage = 1, $iLimit = 10)
	{
		$aTableData = array();
		$sClumon = "p.*,u.username,pt.name";
		$sQuery = "SELECT ".$sClumon." FROM ".T_PAGE." AS p 
					LEFT JOIN ".T_USERS." AS u ON(p.userid = u.userid)
					LEFT JOIN ".T_PAGE_TYPE." AS pt ON(p.typeid = pt.typeid)
					WHERE p.typeid IS NOT NULL";
                 if($this->session->userdata('typeid')  != 3)
			$sQuery .=" AND p.userid = ".$this->session->userdata('userid');	
		if($iType != NULL)
		{
			$sQuery .=" AND p.typeid = ".$iType;	
		}
                 if($this->session->userdata('pUser'))
                {
                    $sQuery .=" AND u.username like('%".$this->session->userdata('pUser')."%')";
                }
                if($this->session->userdata('pHeadline'))
                {
                    $sQuery .=" AND p.headline like('%".$this->session->userdata('pHeadline')."%')";
                }
                 if($this->session->userdata('pPost_from') && $this->session->userdata('pPost_to'))
                {
                    $sQuery .=" AND (p.post_from BETWEEN'".$this->session->userdata('pPost_from')."' AND '".$this->session->userdata('pPost_to')."') ";
                }
		$sQuery .= " ORDER BY p.created DESC";
		$rsCount = $this->db->query(str_replace($sClumon, 'COUNT(*) AS total', $sQuery));
		$rwCount = $rsCount->row_array();
		
		if($rwCount['total'] > 0)
		{
			$iPage = $iPage - 1;
			if($iPage<0) $iPage = 0;
			$sQuery .= " LIMIT ".($iPage*$iLimit).",".$iLimit;		
			$rsPages = $this->db->query($sQuery);
                        
                        return array($rwCount['total'], $rsPages->result_array());
		}
		
		
	}
          public function getUserNews($iType = NULL,$iPage = 1, $iLimit = 10)
	{
		$aTableData = array();
		$sClumon = "p.*,u.username,pt.name";
		$sQuery = "SELECT ".$sClumon." FROM ".T_PAGE." AS p 
					LEFT JOIN ".T_USERS." AS u ON(p.userid = u.userid)
					LEFT JOIN ".T_PAGE_TYPE." AS pt ON(p.typeid = pt.typeid)
					WHERE p.typeid IS NOT NULL";
                 if($this->session->userdata('typeid')  != 3)
			$sQuery .=" AND p.userid = ".$this->session->userdata('userid');	
		if($iType != NULL)
		{
			$sQuery .=" AND p.typeid = ".$iType;	
		}
                if($this->session->userdata('nUser'))
                {
                    $sQuery .=" AND u.username like('%".$this->session->userdata('nUser')."%')";
                }
                if($this->session->userdata('nHeadline'))
                {
                    $sQuery .=" AND p.headline like('%".$this->session->userdata('nHeadline')."%')";
                }
                 if($this->session->userdata('nPost_from') && $this->session->userdata('nPost_to'))
                {
                    $sQuery .=" AND (p.post_from BETWEEN'".$this->session->userdata('nPost_from')."' AND '".$this->session->userdata('nPost_to')."') ";
                }
		$sQuery .= " ORDER BY p.created DESC";
		$rsCount = $this->db->query(str_replace($sClumon, 'COUNT(*) AS total', $sQuery));
		$rwCount = $rsCount->row_array();
		
		if($rwCount['total'] > 0)
		{
			$iPage = $iPage - 1;
			if($iPage<0) $iPage = 0;
			$sQuery .= " LIMIT ".($iPage*$iLimit).",".$iLimit;		
			$rsPages = $this->db->query($sQuery);
                        
                        return array($rwCount['total'], $rsPages->result_array());
			
		}
		
		
	}
	
	public function getPage($iPageId)
	{
		$query = "SELECT * FROM ".T_PAGE." WHERE pageid =".$iPageId;
		$rsPages = $this->db->query($query);
		if($rsPages->num_rows() > 0)
		{
			$aTableData = $rsPages->row_array();
			return $aTableData;
		}
	}
        public function getUserPage($iPageId)
	{
		$query = "SELECT * FROM ".T_PAGE." WHERE pageid =".$iPageId;
                 if($this->session->userdata('typeid')  != 3)
                $query .= " AND userid = ".$this->session->userdata('userid');
		$rsPages = $this->db->query($query);
		if($rsPages->num_rows() > 0)
		{
			$aTableData = $rsPages->row_array();
			return $aTableData;
		}
	}
	
	public function deletePageAjax($iPageId)
	{
                $aPage = $this->getPage($iPageId);
                if($aPage)
                {
                    @unlink($this->config->item('base_path').'/page/'.$aPage['imageurl']);  
                    @unlink($this->config->item('base_path').'/page/'.str_replace('.', '_thumb.',$aPage['imageurl']));  
                    $this->db->query("DELETE FROM ".T_PAGE." WHERE pageid = ".$iPageId);
                } 
	}
	
	public function getPageTypes()
	{
		$aTableData = array();
		$query = "SELECT * FROM ".T_PAGE_TYPE." ORDER BY typeid";	
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