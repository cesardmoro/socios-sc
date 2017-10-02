<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct(true);

		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Eventos_Model');
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

			$crud->set_theme('material');
			$crud->order_by('fecha_inscripcion');
			$crud->set_table('sc_festival_inscripciones');
			$crud->set_subject('Inscripciones');
			$crud->field_type('id_socio', 'hidden');

			$crud->field_type('estado_pago','dropdown',
			array('0' => 'No pagado', '1' => 'Pagado'));  
			$crud->unset_read();
			$crud->unset_jquery(); 

			$output = $crud->render(); 
 
			$this->load->view('main',(array)$output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function inscripciones($id){
		$crud = new grocery_CRUD();
		$crud->set_theme('material');
		$crud->set_table('sc_eventos');
		$crud->set_subject('Inscripciones');
		$crud->unset_read();
		$crud->unset_jquery();

		$output = $crud->render(); 
		$data['participantes'] = $this->Eventos_Model->get_participantes($id);  
		$data['capacitacion'] = $this->Eventos_Model->get_capacitacion($id);

		$output->output = $this->load->view('inscripciones', $data, true) ;
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