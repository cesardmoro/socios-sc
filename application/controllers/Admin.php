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

	}
	public function capacitaciones()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('material');
			$crud->set_table('sc_eventos');
			$crud->set_subject('Capacitaciones');
			$crud->required_fields('titulo', "fecha");
			$crud->columns('titulo','fecha','descripcion', 'oradores', 'lugar');
			$crud->set_field_upload('foto','assets/uploads/eventos');
			$crud->add_action('Participantes', '', 'admin/inscripciones', 'green');
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

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */