<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Festival extends MY_Controller {
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->model('Festival_Model');
		$this->load->config('email');
	}
	public function index(){
		$socio = $this->session->userdata('socio');
		if($socio && $socio->datefin >= date('Y-m-d')){   
			if(!$this->input->post()){
				$output = array();
				$data = array('nro_socio' => $socio->rowid);
				$output['output'] = $this->load->view('festival/index', $data, true);
				$this->load->view('main',(array)$output);
			}else{
				$data = $this->input->post();
				if($data['nombre'] && $data['dni'] && $data['email'] && $data['telefono']){
					$socio = $this->session->userdata('socio');
					$id = ($socio) ? $socio->rowid : null; 

					$res = $this->Festival_Model->inscribir($id, $data);  
					if($res){ 
						$data['id_paquete'] = 1; 
						$body = $this->load->view('festival/email-paquete-'.$data['id_paquete'], array('id' => $res), true);
				        $this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
				        $this->email->to($data['email']);    
				        $this->email->set_mailtype("html");
				        $this->email->subject('Somos Cerveceros | Pago inscripción Festival');
						$this->email->message($body);    
				        $r = $this->email->send(); 
				        
						$this->session->set_flashdata('message', 'Se ha enviado un email a su casilla con instrucciones sobre como realizar el pago');  
							redirect('festival'); 
					}else{
						$this->session->set_flashdata('error', 'Este numero de socio ya se encuentra inscripto');      
						redirect('festival');   

					}
				
				}else{
					$this->session->set_flashdata('error', 'Debe completar todos los campos');        

				}
			}
		}
		else{ 
			$this->session->set_flashdata('error', 'No se puede inscribir a la capacitación porque tiene la couta vencida');  
			redirect('dashboard') ;
		} 
	} 
	function contact_public(){
		$data = $this->input->post();
		$body = $this->load->view('festival/email-contacto', $data, true);  
        $this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
        $this->email->to('festival@somoscerveceros.com.ar');     
        $this->email->set_mailtype("html");
        $this->email->subject('Somos Cerveceros | Contacto Web Festival ');
		$this->email->message($body);     
        $r = $this->email->send();  
	}
}

/* End of file Eventos.php */
/* Location: ./application/controllers/Eventos.php */