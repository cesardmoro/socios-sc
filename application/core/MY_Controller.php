<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	private $secured;

	public function __construct($secured = false)
	{		
		parent::__construct();
		$this->load->helper('url');
		if(!$this->session->userdata('socio')){
			$this->session->set_userdata('referred_from', current_url());
			redirect('login');
		}
		$this->secured = $secured;

		if($this->secured) {
			$this->checkSecurity();
		}
	}
	public function checkSecurity (){
		if($this->session->userdata('role')!="ADMIN"){
			die('No tiene acceso a esta pagina');
		} 
	}
	

}

/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */