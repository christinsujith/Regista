<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Mail extends CI_Email
{
	public function __construct()
	{
	 	parent::__construct();
		
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://smtp.googlemail.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = "prabhakar.tm@gmail.com";//also valid for Google Apps Accounts
		$config['smtp_pass'] = "PRABHAKAR0101";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		
		$this->from("prabhakar.tm@gmail.com");
		
		$this->initialize($config);
	}
	
	public function sendmail($sSubject, $sContent, $sTo, $sFrom = "prabhakar.tm@gmail.com")
	{
		$this->from($sFrom);
		$this->to($sTo);
		$this->subject($sSubject);
		$this->message($sContent);
		$this->send();
		//echo $this->print_debugger();
	}
	
}

?>