<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capacitaciones extends MY_Controller {
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Eventos_Model');
	}
	public function inscribirse($id){
		if($this->session->userdata('socio')){
		$res = $this->Eventos_Model->inscribirse($id, $this->session->userdata('socio')->rowid);
		if($res) $this->session->set_flashdata('message', 'Se ha inscripto a la capacitacion correctamente');        
			redirect('Capacitaciones' );
		}
	} 
	public function desinscribirse($id){
		$res = $this->Eventos_Model->desinscribirse($id, $this->session->userdata('socio')->rowid);
		if($res) $this->session->set_flashdata('message', 'Se ha cancelado su inscripción');        
		redirect('Capacitaciones');
	}
	public function index()
	{
			$output = array();
			$data = array(
				'capacitaciones' => $this->Eventos_Model->get_capacitaciones_activas($this->session->userdata('socio')->rowid)
				);
			$output['output'] = $this->load->view('capacitaciones', $data, true);
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
				$output['output'] = $this->load->view('capacitacion', $data, true);
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
		$output['output'] = $this->load->view('participantes', $data, true);
		$this->load->view('main',(array)$output);
	}
}

/* End of file Eventos.php */
/* Location: ./application/controllers/Eventos.php */