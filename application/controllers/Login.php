<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Account_Model');
		$this->load->helper('url');
		if($this->session->userdata('socio')){
			redirect('dashboard');
		}
		$this->load->library('email');
		//$this->load->config('email');
	}

	public function index()
	{		        	
		if($this->input->post("email") && $this->input->post("password")){
			$res = $this->Account_Model->login($this->input->post("email"), $this->input->post('password'));
			if($res){ 
				$referred_from = $this->session->userdata('referred_from');
				if($referred_from) redirect($referred_from, 'refresh');
				else redirect('dashboard');  
			}
			else{ 
				$this->session->set_flashdata('error', 'El Usuario no existe o la contraseña es incorrecta');        	
			}
		}  
		$view = $this->load->view('login/login', null, true);
		$this->load->view('base', array('view' => $view));
	}
	public function nuevo()
	{	
		if($this->input->post("numero")){
			$socio = $this->Account_Model->getSocio($this->input->post("numero"));
			if($socio){        
				$user = $this->Account_Model->getUserWithAdherent($socio->rowid); 
				if(!$user){
					$token = $this->Account_Model->getToken($socio);

			        $data['link'] = base_url().'login/token/'.$token; 
			        $body = $this->load->view('login/email-nuevo', $data, true);			   

			        
			        $this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
			        $this->email->to($socio->email);  
			        $this->email->set_mailtype("html");
			        $this->email->subject('Somos Cerveceros | Registro socios');
					$this->email->message( $body);  
					
			        $r = $this->email->send();
					$r = 1 ;
			        if($r){
			        	$this->session->set_flashdata('message', 'Un email se ha enviado a tu casilla de correo para verificarla. Si no lo recibes asegurate de revisar spam y si aun no lo encuentras envia un email a  consultas@somoscerveceros.com con asunto "Registro de socios - No recibi email"');
			        	redirect('login'); 
			        }else{
			 			$this->session->set_flashdata('error', 'Ocurrio un error al enviar el email, intenta mas tarde'); 
					}
				}else{
					$this->session->set_flashdata('error', 'Ese numero de socio ya esta registrado, si es el tuyo envia un email a consultas@somoscerveceros.com con asunto "Registro de socios - Numero ya registrado"'); 
				}
			}else{
				$this->session->set_flashdata('error', 'Ese numero de socio no existe');
			}
		}
		$view = $this->load->view('login/nuevo', null, true);
		$this->load->view('base', array('view' => $view));
	}
	public function recuperar(){
		if($this->input->post("numero")){
			$socio = $this->Account_Model->getSocio($this->input->post("numero"));
			if($socio){        
				$user = $this->Account_Model->getUserWithAdherent($socio->rowid); 
			
				if($user){
					if($socio->email == $this->input->post('email')){
						$token = $this->Account_Model->getToken($socio, true);

				        $data['link'] = base_url().'login/token/'.$token.'/1'; 
				        $body = $this->load->view('login/email-recuperar', $data, true);			   
						$this->load->library('email');
						$this->load->config('email');
				        $this->email->initialize($this->config->item('email'));
				        $this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
				        $this->email->to($socio->email);  
				        $this->email->set_mailtype("html");
				        $this->email->subject('Somos Cerveceros | Recuperar contraseña');
						$this->email->message( $body);  
						
				        $r = $this->email->send();
						$r = 1 ;
				        if($r){
				        	$this->session->set_flashdata('message', 'Un email se ha enviado a tu casilla de correo para recuperar tu contraseña. Si no lo recibes asegurate de revisar spam y si aun no lo encuentras envia un email a  consultas@somoscerveceros.com con asunto "Registro de socios - Perdi mi contraseña"');
				        	redirect('login'); 
				        }else{
				 			$this->session->set_flashdata('error', 'Ocurrio un error al enviar el email, intenta mas tarde'); 
						}
					}else{  
						$this->session->set_flashdata('error', 'Ese email no coincide con el numero de socio ingresado');	
					}
				}else{
					$this->session->set_flashdata('error', 'Ese numero de socio no esta registrado, ingresá a "Generalo aca"'); 
				}
			}else{
				$this->session->set_flashdata('error', 'Ese numero de socio no existe');
			}
		}
		$view = $this->load->view('login/recuperar', null, true);
		$this->load->view('base', array('view' => $view));
	}

	public function token($token, $recover = false){
		$socio = $this->Account_Model->getSocioWithToken($token);
		if($socio){
			$error = false;
			if($this->input->post("password") && $this->input->post("password")==$this->input->post("repassword")){
				if($recover){
					$this->Account_Model->updatePassword($socio, $this->input->post('password')); 
					$this->session->set_flashdata('message', 'Password cambiada correctamente');
				}else{
					$res = $this->Account_Model->createAccount($socio, $this->input->post('password')); 
					if($res == "Ya existe") $this->session->set_flashdata('error', 'Error usuario ya existe');
					else $this->session->set_flashdata('message', 'Usuario creado correctamente'); 
				}
				redirect('login');
			}else if($this->input->post("password")){
				$this->session->set_flashdata('error', 'Passwords no coinciden'); 
			}

				$view = $this->load->view('login/register', array('error' => $error , 'socio'=>$socio), true);
				$this->load->view('base', array('view' => $view));
			
		}else{
			$view = $this->load->view('login/token-invalid', null, true);
			$this->load->view('base', array('view' => $view));
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
