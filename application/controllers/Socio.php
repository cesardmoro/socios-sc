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
		
		if($this->input->post("numero") && $this->input->post("dni")) redirect("cuota/".$this->input->post("dni") ."/".$this->input->post("numero")); 
	
		if((!empty($numero) && !empty($dni))){ 
			$socio = $this->Account_Model->getSocio($numero);
			if($socio){

				if($socio->dni == $dni){
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
			//redirect("cuota/".$dni."/".$numero); 
		}
			

		$view = $this->load->view('socio/cuota_al_dia', array('dni' => $dni, 'numero' => $numero), true);
		$this->load->view('base', array('view' => $view)); 
	}
	public function qr($dni = "", $numero=""){
		if(empty($dni) || empty($numero)){
			die('Complete dni y numero');
		}


		$this->load->library('ciqrcode');
		header("Content-Type: image/png");
		$params['data'] = 'http://somoscerveceros.com/socios/couta/'.$dni.''.$numero; 
		$this->ciqrcode->generate($params);
	}
	public function manual(){
		$view = $this->load->view('manual', array(), true);
		$this->load->view('base', array('view' => $view)); 
	
	}

}

/* End of file Socio.php */
/* Location: ./application/controllers/Socio.php */