<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos_Model extends CI_Model {

	public function get_capacitaciones_activas($id_socio){
		$this->db->select('e.*, ei.id_socio as inscripcion');
		$this->db->select('(cupos-(select count(1) from sc_eventos_inscripciones where id_evento = e.id)-reservados) as vacantes');

		$this->db->from('sc_eventos e');
		$this->db->join('sc_eventos_inscripciones ei', "ei.id_evento = e.id and ei.id_socio = '".$id_socio."'",  'left');
		$this->db->where('e.fecha >', date('Y-m-d')); 
		$this->db->order_by('fecha');
 		$res = $this->db->get()->result();
		return $res;
	}	
	public function get_capacitacion($id, $id_socio = -1){
		$this->db->select('e.*, ei.id_socio as inscripcion');
		$this->db->select('(cupos-(select count(1) from sc_eventos_inscripciones where id_evento = e.id)-reservados) as vacantes');
 
		$this->db->from('sc_eventos e');
		$this->db->join('sc_eventos_inscripciones ei', "ei.id_evento = e.id and ei.id_socio = '".$id_socio."'",  'left');
		if($id_socio  != -1){
			//$this->db->where('e.fecha >', date('Y-m-d')); 
		}
		$this->db->where('e.id', $id); 
		$this->db->order_by('fecha');

		return $this->db->get()->row();
	}	
	public function get_cupo($id){
		$this->db->select('(count(ei.id)-cupo) as cupo')->from('sc_eventos e');
		$this->db->join('sc_eventos_inscripciones ei', 'e.id = ei.id_evento', 'left');
		$this->db->where('e.id', $id);
		return $this->db->row();
	}

	public function inscribirse($id_evento, $id_socio){

		$event = $this->db->select('*')->where('id', $id_evento)->where('fecha >', date('Y-m-d'))->get('sc_eventos')->row();   
		if($event){
			$this->db->select('*')->where('id_evento', $id_evento);
			$row = $this->db->where('id_socio', $id_socio)->get('sc_eventos_inscripciones')->row();

			if(!$row){ 
				$reg = array('id_socio' => $id_socio, 'id_evento' => $id_evento, 'fecha_inscripcion' => date('Y-m-d H:i:s'));  
				$this->db->insert('sc_eventos_inscripciones', $reg);
				return true;
			}else{
				return false;
			}
		}else{
				$this->session->set_flashdata('message', 'Esta capacitacion ya sucedio y no puede inscribirse ni desinscribirse');        
				redirect('capacitaciones' );
		}
	}
	public function desinscribirse($id_evento, $id_socio){
		$event = $this->db->select('*')->where('id', $id_evento)->where('fecha >', date('Y-m-d'))->get('sc_eventos')->row();   
		if($event){
			$this->db->where('id_evento', $id_evento)->where('id_socio', $id_socio)->delete('sc_eventos_inscripciones'); 
			return true;
		}else{
				$this->session->set_flashdata('message', 'Esta capacitacion ya sucedio y no puede inscribirse ni desinscribirse');        
				redirect('capacitaciones' );
		}
			
	}
	public function get_participantes($id_evento){

		$this->db->select('ei.id_socio, ei.fecha_inscripcion, s.lastname, s.firstname, s.email, s.phone_mobile, s.datefin, CASE WHEN datefin < now() then "vencida" else "al dia" END as estado_couta');
		$this->db->from('sc_eventos_inscripciones ei');
		$this->db->join('llx_adherent s', 's.rowid = ei.id_socio');
		$this->db->order_by('fecha_inscripcion');
		$this->db->where('ei.id_evento', $id_evento); 
		return $this->db->get()->result(); 
	}

}

/* End of file Eventos_Model.php */
/* Location: ./application/models/Eventos_Model.php */