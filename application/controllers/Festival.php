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
	public function index($id = null){ 
		$socio = $this->session->userdata('socio'); 
		//if(!$socio) redirect('dashboard') ;

		if( ($socio && $socio->datefin >= date('Y-m-d'))){
			if(!$this->input->post()){
				$output = array();
				if($socio) $data = array('nro_socio' => $socio->rowid);
				else $data = array();

				$output['output'] = $this->load->view('festival/index', $data, true);
				if($socio)$this->load->view('main',(array)$output);
				else $this->load->view('main_public',(array)$output);
				
			}else{
				$data = $this->input->post();
				if($data['nombre'] && $data['dni'] && $data['email'] && $data['telefono']){
					$socio = $this->session->userdata('socio');
					$id = ($socio) ? $socio->rowid : null; 
					$soc = ($id == null) ? "no-" : "";
					
					$res = $this->Festival_Model->inscribir($id, $data);  
					//if($res){ 
						 
						$body = $this->load->view('festival/email-paquete-'.$soc.$data['id_paquete'], array('id' => $res), true);
				        $this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
				        $this->email->to($data['email']);    
				        $this->email->set_mailtype("html"); 
				        $this->email->subject('Somos Cerveceros | Pago inscripción Festival');
						$this->email->message($body);    
				        $r = $this->email->send(); 
				        
						$this->session->set_flashdata('message', 'Se ha enviado un email a su casilla con instrucciones sobre como realizar el pago');  
							redirect('festival'); 
					//}else{
						//$this->session->set_flashdata('error', 'Este numero de socio ya se encuentra inscripto');      
						//redirect('festival');   

					//}
				
				}else{
					$this->session->set_flashdata('error', 'Debe completar todos los campos');        

				}
			}
		}
		else{ 
			$this->session->set_flashdata('error', 'No se puede inscribir a al festival porque tiene la cuota vencida');  
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
	public function end(){
	/*res = $this->Festival_Model->get_impagos();
		foreach($res as $re){
			echo "mandar mail a ".$re->email;
			$body = "Estimado, Socio.<br><br>

					Nos contactamos para ponerte al tanto de que el lunes 08/10 es el ultimo día en el cual la reserva del XI Festival Somos cerveceros Rosario 2018 sera valida.<br>

					SI aun no realizaste el pago, tenes hasta esa fecha o tu reserva sera descargada. <br>

					Si ya realizaste el pago podes desestimar este mensaje.<br><br>

					Saludos. ";

				        $this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
				        $this->email->to('cesar.d.moro@gmail.com');    
				        $this->email->set_mailtype("html"); 
				        $this->email->subject('Somos Cerveceros | Reserva Festival - Importante.');
						$this->email->message($body);    
			 $r = $this->email->send(); 
			 die();
		}*/
	} 
}

/* End of file Eventos.php */
/* Location: ./application/controllers/Eventos.php */
