<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Concursos extends MY_Controller {
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Contest_Model');
	}


	public function index()
	{
			$output = array();
			$data = array(
				'concursos' => $this->Contest_Model->get_contests()
				);
			$output['output'] = $this->load->view('concursos/concursos', $data, true);
			$this->load->view('main',(array)$output);
	}

	public function devoluciones($id)
	{
			$output = array();
			$data = array(
				'entries' => $this->Contest_Model->get_entries_user($id, $this->session->userdata('socio')->rowid)
				);
			$output['output'] = $this->load->view('concursos/devoluciones', $data, true);
			$this->load->view('main',(array)$output);
	}

}

/* End of file Eventos.php */
/* Location: ./application/controllers/Eventos.php */
