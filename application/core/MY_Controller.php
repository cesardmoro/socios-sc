<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	private $secured;

	public function __construct($secured = false)
	{		
		parent::__construct();
		$this->load->helper('url');
		
		$this->secured = $secured;
		$this->require_access_permissions();

		 
	}
	public function checkSecurity (){
		if($this->session->userdata('role')!="ADMIN"){
			die('No tiene acceso a esta pagina');
		} 
	}
	private function require_access_permissions(){
		$class = $this->router->fetch_class();
		$method = $this->router->fetch_method();
 
		if($class=="festival")
			$this->session->set_flashdata('error', 'Las inscripciones solo estan disponibles para socios hasta el 17/10');      


		if(!(strpos($method, 'public') !== false)){
			if(!$this->session->userdata('socio')){
				$this->session->set_userdata('referred_from', current_url());
				redirect('login');
			}
		}
		if($this->secured) {
			$this->checkSecurity();
		}

	}

}

/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */