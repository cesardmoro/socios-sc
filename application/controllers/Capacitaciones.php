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
				$this->session->set_flashdata('error', 'No se puede inscribir a la capacitación porque tiene la cuota vencida');      
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

	public function capacitacion_public($id)
	{
			$cap =  $this->Eventos_Model->get_capacitacion($id);
			if(!$this->input->post()){
				
				if($cap){ 
					$output = array();
					$dat = array('cap' => (array_key_exists('capacitacion-'.$id, $_COOKIE)) ? 1 : 0);

					$form = $this->load->view('capacitaciones/form-public', $dat, true);
					if($cap->inscripcion_no_socios_apartir_de){
						if(strtotime($cap->inscripcion_no_socios_apartir_de) > time()){
							$form = "Las inscripciones estan reservadas para socios hasta el ".date('d/m/Y', strtotime($cap->inscripcion_no_socios_apartir_de));  
						}
					}
					$data = array(
						'capacitacion' => $cap,
						'socio' => false,
						'form' => $form
						);
					$output['output'] = $this->load->view('capacitaciones/capacitacion', $data, true);
					$this->load->view('main_public',(array)$output);
				}else{
					$this->session->set_flashdata('error', 'Esta capacitacion no existe');        
					redirect('login'); 
				}
			}else{

				$data = $this->input->post();
				if($data['nombre'] && $data['dni'] && $data['email'] && $data['telefono']){
					if($cap->tipo_validacion == 1){ 
						$fes = $this->Eventos_Model->validar_festival($data['dni'], $id); 
						if(!$fes){
							$this->session->set_flashdata('error', 'Para inscribirse a esta capacitacion tiene q haber comprado preventa para el festival somos cerveceros y tener el pago acreditado');        
							redirect('capacitaciones' ); 
						}
					}
					$data['capacitacion'] = $cap; 
					$data['link'] = 'capacitaciones/inscribirse_public/'.$cap->id.'/'.rtrim(base64_encode($data['nombre'].'|'.$data['dni'].'|'.$data['email'].'|'. $data['telefono']), '='); 
					$body = $this->load->view('capacitaciones/email-capacitacion-confirmar-inscripcion', $data, true);	
			        $this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
			        $this->email->to($data['email']);    
			        $this->email->set_mailtype("html");
			        $this->email->subject('Somos Cerveceros | Confirmar inscripción a capacitación');
					$this->email->message($body);    
			        $r = $this->email->send(); 
					$this->session->set_flashdata('message', 'Se ha enviado un email a su casilla para validar su inscripción');  
						redirect('capacitaciones/capacitacion_public/'.$cap->id);
				
				}else{
					$this->session->set_flashdata('message', 'Debe completar todos los campos para registrarse');        

				}
			}


	}
	public function capacitaciones_public()
	{
		
			$output = array();
			$data = array(
				'capacitaciones' => $this->Eventos_Model->get_capacitaciones_activas($this->session->userdata('socio')->rowid)
				);
			$output['output'] = $this->load->view('capacitaciones/capacitaciones_public', $data, true);
			$this->load->view('main_public',(array)$output);

	}
	public function inscribirse_public($id, $data){
		$base_64 = $data . str_repeat('=', strlen($data) % 4);
		$data = base64_decode($base_64);
		$data = explode('|', $data); 
		$data['nombre'] = $data[0];
		$data['dni'] = $data[1];
		$data['email'] = $data[2];
		$data['telefono'] = $data[3];

	

			$cap =  $this->Eventos_Model->get_capacitacion($id);
			$res = $this->Eventos_Model->inscribir_no_socio($id, $data);
			if($res){

				$data['capacitacion'] = $cap; 
				$data['link'] = 'capacitaciones/desinscribirse_public/'.$cap->id.'/'.rtrim(base64_encode($data['nombre'].'|'.$data['dni'].'|'.$data['email'].'|'. $data['telefono']), '='); 
				$body = "";
				if($cap->vacantes>0){
					$body = $this->load->view('capacitaciones/email-capacitacion-inscripcion-confirmada', $data, true);	
		        	$this->email->subject('Somos Cerveceros | Inscripción a capacitación confirmada');
		        	$this->session->set_flashdata('message', 'Se ha confirmado su inscripción a la capacitación, se ha enviado un mail con un link para cancelar en caso de que no pueda asistir'); 
				}else{
					$body = $this->load->view('capacitaciones/email-capacitacion-inscripcion-confirmada-lista', $data, true);
					$this->email->subject('Somos Cerveceros | Inscripción a lista de espera');
					$this->session->set_flashdata('message', 'Para el momento de confirmar su inscripción no habia cupo, lo inscribimos en lista de espera y se le enviara un email si se libera una vacante');  
				} 
				
		        $this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
		        $this->email->to($data['email']);    
		        $this->email->set_mailtype("html");
				$this->email->message($body);   
		        $r = $this->email->send(); 
		        
				
				setcookie("capacitacion-".$id, true); 

				redirect('capacitaciones/capacitacion_public/'.$id );       
			}else{
				$this->session->set_flashdata('message', 'Esta capacitación ya sucedio y no puede inscribirse ni desinscribirse');        
				redirect('capacitaciones/capacitacion_public/'.$id );       
			}  
	
	}

	public function desinscribirse_public($id, $data){
		$cap =  $this->Eventos_Model->get_capacitacion($id);
		$base_64 = $data . str_repeat('=', strlen($data) % 4);
		$data = base64_decode($base_64);
		$data = explode('|', $data); 
		$data['nombre'] = $data[0];
		$data['dni'] = $data[1];
		$data['email'] = $data[2];
		$data['telefono'] = $data[3];
		$data['capacitacion'] = $cap; 
 
		$res = $this->Eventos_Model->desinscribirse_no_socio($id, $data);
		$body = $this->load->view('capacitaciones/email-capacitacion-cancelar-inscripcion-public', $data, true);		 
	        $this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
        $this->email->to($data['email']);  
        $this->email->set_mailtype("html");
        $this->email->subject('Somos Cerveceros | Cancelada su inscripción');
		$this->email->message($body); 
		if(array_key_exists('capacitacion-'.$id, $_COOKIE)){
			unset($_COOKIE['capacitacion'.$id]);  
		}
		unset($_COOKIE['capacitacion'.$id]);  
        $r = $this->email->send();  
		$this->session->set_flashdata('message', 'Se ha cancelado su inscripción');  
		redirect('capacitaciones/capacitacion_public/'.$id );       



	}
	public function capacitacion($id)
	{
			$cap =  $this->Eventos_Model->get_capacitacion($id, $this->session->userdata('socio')->rowid);
			if($cap){ 
				$output = array();
				$data = array(
					'capacitacion' => $cap,
					'socio' => $this->session->userdata('socio'),
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