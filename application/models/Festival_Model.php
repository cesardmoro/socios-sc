<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Festival_Model extends CI_Model {

	public function inscribir($id_socio, $data){ 
		$row = $this->db->select('*')->where('id_socio', $id_socio)->where('nro_socio', $id_socio)->get('sc_festival_inscripciones')->row();
		if(!$row){
			$data['id_socio'] = $id_socio;
			$data['nro_socio'] = $id_socio;
			$data['valor'] = "3060";
			$data['fecha_inscripcion'] = date('Y-m-d H:i:s');
	 		$this->db->insert('sc_festival_inscripciones', $data); 
	 		return $this->db->insert_id();
 		}else return false;

	}
	public function get_inscripcion($id){ 
		$row = $this->db->select('*')->where('id', $id)->get('sc_festival_inscripciones')->row();
		return $row;
	}

}

/* End of file Festival_Model.php */
/* Location: ./application/models/Festival_Model.php */