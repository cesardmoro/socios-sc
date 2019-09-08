<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct(true);

		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Eventos_Model');
		$this->load->model('Account_Model');
		$this->load->library('grocery_CRUD');
		$this->load->config("email");

	}
	public function capacitaciones()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('material');
			$crud->order_by('fecha');
			$crud->set_table('sc_eventos');
			$crud->set_subject('Capacitaciones');
			$crud->required_fields('titulo', "fecha");
			$crud->columns('titulo','fecha','descripcion', 'oradores', 'lugar');
			$crud->field_type('tipo_validacion', 'dropdown', array('0' => 'Standard', '1' => 'Festival'));
			$crud->field_type('oculto', 'dropdown', array('0' => 'NO', '1' => 'SI'));
			$crud->set_field_upload('foto','assets/uploads/eventos');
			$crud->add_action('Participantes', '', 'admin/inscripciones', 'green'); 
			$crud->add_action('Link Publico', '', 'capacitaciones/capacitacion_public', 'green');
			$crud->unset_read();
			$crud->unset_jquery();

			$output = $crud->render(); 
 
			$this->load->view('main',(array)$output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	} 
	public function festival(){
		try{
			$crud = new grocery_CRUD(); 
			$crud->columns('id',  'id_paquete',  'id_socio',  'fecha_inscripcion',  'dni',  'nombre',  'apellido',  'valor',  'nro_socio',  'estado_pago',  'nro_compobante',  'fecha_pago',  'telefono',  'email', 'enviada_confirmacion');   
			$crud->set_theme('material');
			$crud->order_by('fecha_inscripcion');
			$crud->set_table('sc_festival_inscripciones');
			$crud->set_subject('Inscripciones');
			$crud->field_type('id_socio', 'hidden');

			  $crud->field_type('enviada_confirmacion', 'dropdown', array('1' => 'Confirmación enviada', '0' => 'No enviada'));

			$crud->field_type('estado_pago','dropdown', 
			array('0' => 'No pagado', '1' => 'Pagado', '2' => 'Bonificado'));  
			$crud->add_action('Enviar confirmación', '', 'admin/confirmar_pago_festival', 'green');
  
			$crud->unset_read(); 
			$crud->unset_jquery(); 

			$output = $crud->render(); 
 
			$this->load->view('main',(array)$output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


	public function usuarios(){
		try{

			$crud = new grocery_CRUD(); 
			//$crud->columns('id',  'id_paquete',  'id_socio',  'fecha_inscripcion',  'dni',  'nombre',  'apellido',  'valor',  'nro_socio',  'estado_pago',  'nro_compobante',  'fecha_pago',  'telefono',  'email', 'enviada_confirmacion');
			//
			$crud->columns('email', 'role', 'adherent_id');
			$crud->set_theme('material');
			$crud->order_by('id');
			$crud->set_table('sc_accounts');
			$crud->set_subject('Usuarios');
			//$crud->field_type('adherent_id', 'hidden');
			$crud->display_as('adherent_id','Socio');
			$crud->set_relation('adherent_id','llx_adherent','{firstname} {lastname} ({rowid})');


		  	//$crud->field_type('enviada_confirmacion', 'dropdown', array('1' => 'Confirmación enviada', '0' => 'No enviada'));
			$crud->field_type('password', 'hidden');
			$crud->field_type('role','dropdown', array('USUARIO' => 'USUARIO', 'ADMIN' => 'ADMIN'));  

			$crud->add_action('recuperar contraseña', '', 'admin/recuperar_pass', 'green');
  	
			$crud->unset_read(); 
			$crud->unset_jquery(); 

			$output = $crud->render(); 
 
			$this->load->view('main',(array)$output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function recuperar_pass($id){

		$socio = $this->Account_Model->getSocioByUserId($id);
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
		$this->email->message($body);  
		
        $r = $this->email->send();

    	$this->session->set_flashdata('message', 'Se envio un email al socio, en caso de que no lo reciba enviarle este link: '.$data['link'] );
    	redirect('admin/usuarios/'); 
	}
	public function confirmar_pago_festival($id){
		$this->load->model('Festival_Model'); 
		$inscripcion = $this->Festival_Model->get_inscripcion($id);

		if($inscripcion->estado_pago != null ){ 
			$this->Festival_Model->set_confirmacion($id);
			$body = $this->load->view('festival/email-confirmacion', array('inscripcion' => $inscripcion, 'packs' => array('Pack preventa full socios', 'Pack Full', 'Pack acompañante', 'Pack fiesta de cierre')), true); 
			$this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
			$this->email->to($inscripcion->email);     
			$this->email->set_mailtype("html");
			$this->email->subject('Somos Cerveceros | Confirmación de Pago Festival');
			$this->email->message($body);    
			$r = $this->email->send();  
			$this->session->set_flashdata('message', 'Se notifico por email la confirmación de pago');   	
			redirect('admin/festival/');  

		}else{
			$this->session->set_flashdata('error', 'No ha cargado aun el pago');   
			redirect('admin/festival/'); 

		}
	}
	public function inscripciones($id){
		$crud = new grocery_CRUD();
		$crud->set_theme('material');
		$crud->set_table('sc_eventos_inscripciones');
		$crud->set_subject('Inscripciones');
		
		$crud->unset_read();
		$crud->unset_jquery();

		$output = $crud->render(); 
		$data['participantes'] = $this->Eventos_Model->get_participantes($id);  
		$data['capacitacion'] = $this->Eventos_Model->get_capacitacion($id);

		$output->output = $this->load->view('inscripciones', $data, true);
		$this->load->view('main',(array)$output); 
	} 
	public function eliminar_inscripcion($id_evento, $id_inscripcion){
		$this->Eventos_Model->eliminar_inscripcion($id_evento, $id_inscripcion);
		$this->session->set_flashdata('message', 'Se ha eliminado la inscripción, se notificaran los usuarios que estaban en lista de espera y entran a cupo');  

		redirect('admin/inscripciones/'.$id_evento); 
	}
	public function test( $id_evento, $id_inscripcion){
		 $this->Eventos_Model->notificar_participantes( $id_evento, $id_inscripcion);

	}


}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */