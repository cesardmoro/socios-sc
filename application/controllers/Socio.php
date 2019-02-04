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
		$params['data'] = 'http://somoscerveceros.com/socios/cuota/'.$dni.'/'.$numero; 
		$this->ciqrcode->generate($params);
	}
	public function qr_gen(){
	    $tempDir = FCPATH."qr/";  
	   	$this->load->library('ciqrcode');
	    
	   	$socios = $this->db->select('l.rowid as numero, le.a2 as dni')->from('llx_adherent l')->join('llx_adherent_extrafields le', 'le.fK_object = l.rowid')->get()->result(); 
	   	foreach($socios as $socio){
			$dni = $socio->dni;	
			$numero = $socio->numero;
			$params['data'] = 'http://somoscerveceros.com/socios/cuota/'.$dni.'/'.$numero; 
			$params['savename'] = $tempDir.$socio->numero.'.png'; 
	    	echo $this->ciqrcode->generate($params);
 		}


	
		header("Content-Type: image/png");

	}
	public function manual(){
		$view = $this->load->view('manual', array(), true);
		$this->load->view('base', array('view' => $view)); 
	
	} 
	public function perfil(){
		if(!$this->session->userdata('socio')) redirect('login');
		//si posteo el socio
		if($this->input->post()){
			$edit = [];
			$edit['zip'] = $this->input->post('cp');
			$edit['address'] = $this->input->post('direccion');
			$edit['town'] = $this->input->post('ciudad');
			$edit['state_id'] = $this->input->post('provincia'); 
			$idSocio = $this->session->userdata('socio')->rowid;
			$this->Account_Model->editPerfil($edit, $idSocio);

		}
		$socio = $this->Account_Model->getSocio($this->session->userdata('socio')->rowid);
		$this->session->set_userdata('socio', $socio);
		$view = $this->load->view('socio/perfil', array('socio' => $socio, 'estados' => $this->Account_Model->getStates()), true);
		$this->load->view('main', array('output' => $view));  




	}

}

/* End of file Socio.php */
/* Location: ./application/controllers/Socio.php */