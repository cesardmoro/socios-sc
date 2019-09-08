<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Festival_Model extends CI_Model {

	public function inscribir($id_socio, $data){ 
		$row = $this->db->select('*')->where('id_socio', $id_socio)->where('nro_socio', $id_socio)->get('sc_festival_inscripciones')->row();
		if(!$id_socio || !$row){
			$data['id_socio'] = $id_socio; 
			$data['nro_socio'] = $id_socio;

			switch ($data['id_paquete']) {
				case 0:
					if($data['id_socio'] == NULL){
						die(' no socio puede comprar preventa');
					}
					$data['valor'] = "3500";
					break;
				case 1 :

					$data['valor'] = "4200";
					if($data['id_socio'] == NULL){
						$data['valor'] = "4900";
					}
					break;
				case 2 :
					$data['valor'] = "2500";
					if($data['id_socio'] == NULL){
						$data['valor'] = "2900";
					}
					break;
				case 3 :
					$data['valor'] = "150";
					break;
					break;
				case 4 :
					$data['valor'] = "600";
					if($data['id_socio'] == NULL){
						$data['valor'] = "800";
					}
					break;
				default:
					// code...
					break;
			}
						 
			$data['fecha_inscripcion'] = date('Y-m-d H:i:s');
	 		$this->db->insert('sc_festival_inscripciones', $data); 
	 		return $this->db->insert_id();
 		}else return false; 
	}

	public function get_inscripcion($id){ 
		$row = $this->db->select('*')->where('id', $id)->get('sc_festival_inscripciones')->row();
		return $row;
	}

	public function set_confirmacion($id){ 
		$row = $this->db->where('id', $id)->update('sc_festival_inscripciones', array('enviada_confirmacion' => 1) ); 
		return $row;
	}
	public function get_impagos(){

		return $this->db->select('*')->where('estado_pago', null)->get('sc_festival_inscripciones')->result();
	}

}

/* End of file Festival_Model.php */
/* Location: ./application/models/Festival_Model.php */