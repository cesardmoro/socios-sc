<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capacitaciones extends MY_Controller {
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Eventos_Model');
		$this->load->library('email');
		$this->load->config('email');
	}
	public function inscribirse($id){
		if($this->session->userdata('socio')){
			$socio = $this->session->userdata('socio');
			if($socio->datefin >= date('Y-m-d')){   
				$res = $this->Eventos_Model->inscribirse($id, $this->session->userdata('socio')->rowid);
				if($res){
					$capacitacion = $this->Eventos_Model->get_capacitacion($id);
			        $this->email->initialize($this->config->item('email'));
	   		        $this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
			        $this->email->to($socio->email);  
			        $this->email->set_mailtype("html");
					
					if($capacitacion->vacantes<=-1){
						$data = array('capacitacion' => $capacitacion ,  'socio' => $socio);  
						$body = $this->load->view('capacitaciones/email-capacitacion-lista-de-espera', $data, true);		
			        	$this->email->subject('Somos Cerveceros | Inscripción lista de espera a '.$capacitacion->titulo);	
					}else{
						$data = array('capacitacion' => $capacitacion ,  'socio' => $socio); 
						$body = $this->load->view('capacitaciones/email-capacitacion-inscripcion', $data, true);		
			        	$this->email->subject('Somos Cerveceros | Inscripción a '.$capacitacion->titulo);
					} 
					$this->email->message( $body);    
			        $r = $this->email->send(); 
					$this->session->set_flashdata('message', 'Se ha inscripto a la capacitacion correctamente');        
					redirect('Capacitaciones' ); 
				}
			}
			else{ 
				$this->session->set_flashdata('error', 'No se puede inscribir a la capacitación porque tiene la couta vencida');      
			}
			redirect('Capacitaciones' );
			
		}
	} 
	public function desinscribirse($id){
		$res = $this->Eventos_Model->desinscribirse($id, $this->session->userdata('socio')->rowid);
		if($res){
			$socio = $this->session->userdata('socio');
			$capacitacion = $this->Eventos_Model->get_capacitacion($id);
			$data = array('capacitacion' => $capacitacion ,  'socio' => $socio); 
			$body = $this->load->view('capacitaciones/email-capacitacion-cancelar-inscripcion', $data, true);		
	        $this->email->initialize($this->config->item('email'));
		        $this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
	        $this->email->to($socio->email);  
	        $this->email->set_mailtype("html");
	        $this->email->subject('Somos Cerveceros | Cancelada su inscripción');
			$this->email->message($body);    
	        $r = $this->email->send();  
			$this->session->set_flashdata('message', 'Se ha cancelado su inscripción');  
	 	}      
		redirect('Capacitaciones');
	}
	public function index()
	{
			$output = array();
			$data = array(
				'capacitaciones' => $this->Eventos_Model->get_capacitaciones_activas($this->session->userdata('socio')->rowid)
				);
			$output['output'] = $this->load->view('capacitaciones/capacitaciones', $data, true);
			$this->load->view('main',(array)$output);
	}
	public function capacitacion($id)
	{
			$cap =  $this->Eventos_Model->get_capacitacion($id, $this->session->userdata('socio')->rowid);
			if($cap){ 
				$output = array();
				$data = array(
					'capacitacion' => $cap,
					);
				$output['output'] = $this->load->view('capacitaciones/capacitacion', $data, true);
				$this->load->view('main',(array)$output);
			}else{
				$this->session->set_flashdata('error', 'Esta capacitacion no existe');        
				redirect('capacitaciones' );
			}
	}
	public function participantes($id){
		$this->checkSecurity();
		$output = array();
		$data = array(
			'participantes' => $this->Eventos_Model->get_participantes($id)
			);
		$output['output'] = $this->load->view('capacitaciones/participantes', $data, true);
		$this->load->view('main',(array)$output);
	}
}

/* End of file Eventos.php */
/* Location: ./application/controllers/Eventos.php */