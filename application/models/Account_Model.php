<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_Model extends CI_Model {

	function getSocio($id){
		$this->db->select("a.*, e.a1 as nick, e.a2 as dni, e.a3 as fecha_nac, e.a4 as work ");
		$this->db->from('llx_adherent a');
		$this->db->join('llx_adherent_extrafields e', 'on e.fk_object = a.rowid');
 
		$this->db->where('a.rowid', $id);
		return $this->db->get()->row();
	}
	function getToken($socio){
		$str = hash ( "sha256", rand().uniqid().$socio->rowid); 
		$data = array('adherent_id' => $socio->rowid, 'token' => $str, 'created' => time());
		$this->db->where('adherent_id', $socio->rowid)->delete('sc_adherent_tokens'); 
		$this->db->insert('sc_adherent_tokens', $data);
		return $str;
	} 
	function getSocioWithToken($token){
		$adherent = $this->db->select('adherent_id')->where('token', $token)->get('sc_adherent_tokens')->row();
		if(!$adherent) return false; 
		$socio = $this->getSocio($adherent->adherent_id);
		return $socio;
	}
	function createAccount($socio, $password){
		$user = $this->getUserWithAdherent($socio->rowid);
		if($user) return "Ya existe"; 
		$data = ['email' => $socio->email,
				'password' => hash ( "sha256", $password), 
				'adherent_id' => $socio->rowid]; 

		$this->db->insert('sc_accounts', $data);  
		$this->db->where('adherent_id', $socio->rowid)->delete('sc_adherent_tokens'); 
	}
	function getUserWithAdherent($adherent_id){
		$user = $this->db->select('id')->from('sc_accounts')->where('adherent_id', $adherent_id)->get()->row();
		return $user;
	}
	function login($email, $password){
		$encPassword = hash ( "sha256", $password); 
		$this->db->select('adherent_id, role')->where('email', $email)->where('password', $encPassword);
		$usr = $this->db->get('sc_accounts')->row();
		if($usr){ 
			$data = array(
				'socio' => $this->getSocio($usr->adherent_id),
				'role' => $usr->role
			);  
			$this->session->set_userdata( $data );
			return true;
		}else{  
			return false;
		}

	}

}

/* End of file Account_Model.php */
/* Location: ./application/models/Account_Model.php */