<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Socio extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Account_Model');
		$this->load->helper('url');

	}
	public function cuota($dni = "", $numero = "")
	{
		if($this->input->post("numero")){
			$socio = $this->Account_Model->getSocio($this->input->post("numero"));
			if($socio){

				if($socio->dni == $this->input->post('dni')){
					if($socio->datefin >= date('Y-m-d')){   

						$this->session->set_flashdata('message', 'El socio '.$socio->firstname.' '.$socio->lastname.' tiene la cuota al dia.');   	
					}else{
						$this->session->set_flashdata('error', 'La cuota del socio esta impaga.');   
					}
				}else{
					$this->session->set_flashdata('error', 'El numero de socio y el dni no son de la misma persona.');       
				}
			}else{
				$this->session->set_flashdata('error', 'El numero de socio no existe.');       
			}
			redirect("cuota/".$this->input->post('dni')."/".$this->input->post('numero'));
		} 

		$view = $this->load->view('socio/cuota_al_dia', array('dni' => $dni, 'numero' => $numero), true);
		$this->load->view('base', array('view' => $view)); 
	}
	public function manual(){
		$view = $this->load->view('manual', array(), true);
		$this->load->view('base', array('view' => $view)); 
	
	}

}

/* End of file Socio.php */
/* Location: ./application/controllers/Socio.php */