<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
			$output = array();
			$output['output'] = $this->load->view('dashboard', array(), true);
			$this->load->view('main',(array)$output);
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */