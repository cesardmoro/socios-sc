<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos_Model extends CI_Model {

	public function get_capacitaciones_activas($id_socio = false){
		
		$this->db->select('e.*, ei.id_socio as inscripcion');
		$this->db->select('(cupos-(select count(1) from sc_eventos_inscripciones where id_evento = e.id)-reservados) as vacantes');
		$this->db->from('sc_eventos e');
		$this->db->join('sc_eventos_inscripciones ei', "ei.id_evento = e.id and ei.id_socio = '".$id_socio."'",  'left');
		$this->db->where('e.fecha >=', date('Y-m-d')); 
		$this->db->where('e.oculto', 0);
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
			if($event->tipo_validacion == 1){ //Validación festival
				$fes = $this->db->select('id_paquete')->where('id_socio', $id_socio)->where('estado_pago >=', 1)->where_in('id_paquete', array(0,1,2))->order_by('id_paquete', 'desc')->get('sc_festival_inscripciones')->row();  
				if(!$fes){
					$this->session->set_flashdata('error', 'Para inscribirse a esta capacitacion tiene q haber comprado pack preventa, packfull o conferencias y tener el pago acreditado');        
					redirect('capacitaciones' ); 
				}else{

					$limite = strtotime('2019-08-12 20:00:00');
					if($fes->id_paquete != 0  &&  $limite > time()){
						$this->session->set_flashdata('error', 'Hasta '.date('d/m/Y H:i:s', $limite).' Solo puede inscribirse Pack Preventa socios');        
						redirect('capacitaciones'); 
					}
				}
				$this->validar_horario_duplicado_festival($id_evento, $id_socio, false);
			}
	

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
	private function validar_horario_duplicado_festival($id_cap, $id, $dni){
		
		$group = null;
		$group1 = array (62,61);
		$group3 = array (64,65); 
		$group5 = array (67,68);
		$group6 = array (70,71);
		if(in_array($id_cap, $group1)) $group = $group1;		
		else if(in_array($id_cap, $group3)) $group = $group3;		
		else if(in_array($id_cap, $group5)) $group = $group5; 		
		else if(in_array($id_cap, $group6)) $group = $group6; 
		else return false;


		if($id){  
			$res = $this->db->select('id')->where('id_socio', $id)->where_in('id_evento', $group)->get('sc_eventos_inscripciones')->row();
			if($res){ 
				
				$this->session->set_flashdata('error', 'Tiene una capacitacion que se superpone con el horario, no se puede inscribir');        
				redirect('capacitaciones' );
			}
		}else{ 
			$res =$this->db->select('id')->where('dni', $dni)->where_in('id_evento', $group)->get('sc_eventos_inscripciones')->row();
			if($res){ 
				
				$this->session->set_flashdata('error', 'Tiene una capacitacion que se superpone con el horario, no se puede inscribir');         
				redirect('capacitaciones' );
			}
		}
		return false;

	}
	public function inscribir_no_socio($id_evento, $data){
		 $inscripcion = $this->db->select('id')->from('sc_eventos_inscripciones')
		 ->where('nombre', $data['nombre'])
		->where('email', $data['email'])
		->where('telefono', $data['telefono'])
		->where('dni', $data['dni'])
		->where('id_evento', $id_evento)->get()->row();  
		 
		$event = $this->db->select('*')->where('id', $id_evento)->where('fecha >', date('Y-m-d'))->get('sc_eventos')->row();   

		if($event->tipo_validacion == 1){ //Validación festival 
			$fes = $this->db->select('id_paquete')->where('dni', $data['dni'])->where('estado_pago >=', 1)->where_in('id_paquete', array(0, 1, 2))->order_by('id_paquete', 'desc')->get('sc_festival_inscripciones')->row();  
			if(!$fes){
				$this->session->set_flashdata('error', 'Para inscribirse a esta capacitacion tiene q haber comprado preventa para el festival somos cerveceros y tener el pago acreditado');        
				redirect('capacitaciones' ); 
			}
			$limite = strtotime('2019-08-12 20:00:00');
			if($fes->id_paquete != 0  &&  $limite > time()){
				$this->session->set_flashdata('error', 'Hasta '.date('d/m/Y H:i:s', $limite).' Solo puede inscribirse Pack Preventa socios');        
				redirect('capacitaciones'); 
			}
				$group5 = array(41,42,43); 
				if($fes->id_paquete == 4){
					if(!in_array($id_evento, $group5)){  
						$this->session->set_flashdata('error', 'Para inscribirse a esta capacitacion tiene q haber comprado pack preventa o packfull para el festival somos cerveceros 2018 y tener el pago acreditado');
						redirect('capacitaciones' );         
					}

				}
				if($fes->id_paquete == 1){
					if(in_array($id_evento, $group5)){  
						$this->session->set_flashdata('error', 'Para inscribirse al tour tiene q comprar el pack Tour el tour solo esta incluido en la preventa');
						redirect('capacitaciones' );         
					}  

				}

				$this->validar_horario_duplicado_festival($id_evento, false , $data['dni']);
		}	
		if(!$inscripcion){
			$event = $this->db->select('*')->where('id', $id_evento)->where('fecha >', date('Y-m-d'))->get('sc_eventos')->row();   
			if($event){
				$reg = array('id_evento' => $id_evento, 'fecha_inscripcion' => date('Y-m-d H:i:s'), 'dni'=>$data['dni'], 'nombre' => $data['nombre'], 'email' => $data['email'], 'telefono' => $data['telefono']);    
				$this->db->insert('sc_eventos_inscripciones', $reg); 

				return true;
				
			}else{
				return false;
				 
			}
		}else{
			setcookie("capacitacion-".$id_evento, true); 
			$this->session->set_flashdata('message', 'Usted ya se encuentra inscripto a esta capacitación');  

			redirect('capacitaciones/capacitacion_public/'.$id_evento );
		}
	}

	public function validar_festival($dni, $id_evento){

			$fes = $this->db->select('id_paquete')->where('dni', $dni)->where('estado_pago >=', 1)->where_in('id_paquete', array(0, 1, 4))->order_by('id_paquete', 'desc')->get('sc_festival_inscripciones')->row();  
			if(!$fes){  	
				return false; 
			}
			$group5 = array(41,42,43); 
			if($fes->id_paquete == 4){
				if(!in_array($id_evento, $group5)){  
					$this->session->set_flashdata('error', 'Para inscribirse a esta capacitacion tiene q haber comprado pack preventa o packfull para el festival somos cerveceros 2018 y tener el pago acreditado');
					redirect('capacitaciones' );         
				}

			}
			if($fes->id_paquete == 1){
				if(in_array($id_evento, $group5)){  
					$this->session->set_flashdata('error', 'Para inscribirse al tour tiene q comprar el pack Tour el tour solo esta incluido en la preventa');
					redirect('capacitaciones' );         
				}

			}

			return true; 
			
	}

	public function desinscribirse_no_socio($id_evento, $data){

			$inscripcion = $this->db->select('id')
			->where('id_evento', $id_evento)		
			->where('nombre', $data['nombre'])
			->where('email', $data['email'])
			->where('telefono', $data['telefono']) 
			->where('dni', $data['dni'])->get('sc_eventos_inscripciones')->row(); 
	 		$this->Eventos_Model->notificar_participantes( $id_evento, $inscripcion->id); 
	 		 
			$this->db->where('id', $inscripcion->id)->delete('sc_eventos_inscripciones'); 
			


	}
	public function desinscribirse($id_evento, $id_socio){
		$event = $this->db->select('*')->where('id', $id_evento)->where('fecha >', date('Y-m-d'))->get('sc_eventos')->row();   
		if($event){
			$inscripcion = $this->db->select('id')
			->where('id_evento', $id_evento)
			->where('id_socio', $id_socio)
			->get('sc_eventos_inscripciones')->row();

	 		$this->Eventos_Model->notificar_participantes( $id_evento, $inscripcion->id); 

			$this->db->where('id', $inscripcion->id)->delete('sc_eventos_inscripciones');  
			return true;
		}else{
			return false;
		}
			
	}
	public function get_participantes($id_evento){

		$this->db->select('ei.id as id , IFNULL(ei.id_socio, "No socio") as id_socio, ei.fecha_inscripcion, s.lastname, IFNULL(s.firstname, ei.nombre) as firstname, IFNULL(s.email, ei.email) as email, ifnull(s.phone_mobile, ei.telefono) as phone_mobile, s.datefin, CASE WHEN datefin < now() then "vencida" else "al dia" END as estado_couta, IFNULL(s.rowid, ei.dni) as dni');
		$this->db->from('sc_eventos_inscripciones ei');
		$this->db->join('llx_adherent s', 's.rowid = ei.id_socio', 'left');
		$this->db->order_by('fecha_inscripcion');
		$this->db->where('ei.id_evento', $id_evento); 
		$socios = $this->db->get()->result(); 
		return $socios;
	}
	public function eliminar_inscripcion($id_evento, $id_inscripcion){ 
	 	$this->Eventos_Model->notificar_participantes( $id_evento, $id_inscripcion); 
		$this->db->where('id', $id_inscripcion)->where('id_evento', $id_evento)->delete('sc_eventos_inscripciones'); 
	}
	public function obtener_participantes_notificar($id_evento, $id_inscripcion){
		$cap = $this->get_capacitacion($id_evento);
		$participantes = $this->get_participantes($id_evento);
		$vacantes = $cap->vacantes;
		$notify = false; 
		if(empty($participantes)) return false;
		foreach($participantes as $key => $participante){
			

			if($participante->id == $id_inscripcion){
				if(($key+1) <= ($cap->cupos-$cap->reservados)){
					//el participante esta dentro de los indicados, hay que notificar al que sigue
					$notify = true;
					break;
				}else{
					//el participante que se retira estaba en lista de espera
				}
			}

		}
		if($notify){
			//el proximo participante a notificar es  el cupo +1
			// 3 -1 = 2 
			$key = ($cap->cupos-$cap->reservados);
			if(array_key_exists($key, $participantes)){
				return $participantes[$key];
			}else{
				//si no hay no lo tengo q notificar
				return false;
			}
		}
		return false; 		
	}
	public function notificar_participantes($id_evento, $id_inscripcion){
		$res = $this->obtener_participantes_notificar( $id_evento, $id_inscripcion);
		if($res){ 
			$this->load->config('email');
			$capacitacion = $this->get_capacitacion($id_evento);
			$link = "";  
			if(is_numeric($res->id_socio)){
				$link = "capacitaciones/desinscribirse/".$id_evento;
			}else{
				$link = 'capacitaciones/desinscribirse_public/'.$capacitacion->id.'/'.rtrim(base64_encode($res->firstname.'|'.$res->dni.'|'.$res->email.'|'. $res->phone_mobile), '=');
			} 
			$data = array('capacitacion' => $capacitacion ,  'socio' => $res, 'link' => $link); 
			$body = $this->load->view('capacitaciones/email-capacitacion-cupo-libre', $data, true);
	       	$this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
	        $this->email->to($res->email);  
	        $this->email->set_mailtype("html");
	        $this->email->subject('Somos Cerveceros | Cupo libre - Confirmacion de inscripción');
			$this->email->message($body);  
			$r = $this->email->send(); 		
		}
	}
}

/* End of file Eventos_Model.php */
/* Location: ./application/models/Eventos_Model.php */
