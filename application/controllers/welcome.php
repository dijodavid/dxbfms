<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library("form_validation");
		$this->template->set('nav', 'Home');
	}
	
	public function index()
	{
		
		$this->template->set('page_title', 'Welcome');
		$this->template->load('tpl-default','welcome');
	}
}

/* End of file welcome.php */
