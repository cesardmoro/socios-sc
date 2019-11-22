<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contest_Model extends CI_Model {

	public function get_contests(){
		return $this->db->select('*')->get('sc_contest')->result();
	}
	
	public function get_contest($id){
		return $this->db->select('*')->where('id', $id)->get('sc_contest')->row();
	}

	public function get_entries_user($id, $id_user){
		 return $this->db->select('cei.*')->from('sc_contest_entries cei')->join('sc_contest_entrants ce','ce.name = cei.entrant_name')->where('ce.adherent_id', $id_user)->where('cei.id_contest', $id)->where('ce.id_contest', $id)->get()->result();
	}

	public function get_contest_statics($id){
		$stats = [];
		$stats['entries'] = $this->db->select('count(1) as entries')->where('id_contest', $id)->get('sc_contest_entries')->row()->entries;
		$stats['entrants'] = $this->db->select('count(1) as entrants')->where('id_contest', $id)->get('sc_contest_entrants')->row()->entrants;
		$stats['adherent_entrants'] = $this->db->select('count(1) as entrants')->where('id_contest', $id)->where('adherent_id is not null')->get('sc_contest_entrants')->row()->entrants;
		$stats['no_adherent_entrants'] = $stats['entrants']-$stats['adherent_entrants'];
		$stats['load_entries'] = $this->db->select('count(1) as entries')->where('entry_file is not null')->where('id_contest', $id)->get('sc_contest_entries')->row()->entries;
		$stats['sent_entries'] = $this->db->select('count(1) as entries')->where('entry_sent is not null')->where('id_contest', $id)->get('sc_contest_entries')->row()->entries;
		$stats['confirmed_entries'] = $this->db->select('count(1) as entries')->where('entry_confirm', 1)->where('id_contest', $id)->get('sc_contest_entries')->row()->entries;

		return $stats;
	}
	public function sync_entrants($contest){
		
		$url = 'https://reggiebeer.com/ReggieAjax.php';
		$data = [];
		$data['xGroup'] = "Judge" ;
		$data['xSubGroup'] = "Contact"; 
		$data['xAction'] = "Report" ;
		$data['xCompID'] = $contest->competition_username;
		$data['xPassword'] = $contest->competition_password; 
		$data['xDBIndex'] = "Entrants";
		$data['Report'] = "14";
		$data['Table'] = "Entrant"; 
		$data['Params'] = "?";

		// use key 'http' even if you send the request to https://...
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$this->db->where('id_contest', $contest->id)->delete('sc_contest_entrants'); 
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$this->load->library('Dom_parser');
		$dom = new simple_html_dom();
		$dom->load($result); 
		$entrats = [];
		foreach( $dom->find('tr') as $node)
		{	 
			$tds = $node->find('td');
			if(count($tds)){
				$reg = [];
				$reg['id_contest'] = $contest->id;
				$reg['name'] = $tds[0]->innertext;
				$reg['email'] = $tds[1]->find('a')[0]->innertext;
				$reg['phone'] = $tds[2]->innertext;
				$reg['adress'] = $tds[4]->innertext;	
				$entrants[] = $reg;
			}
		}
		$this->db->insert_batch('sc_contest_entrants', $entrants); 
	}
	public function sync_entries($contest){

		$url = 'https://reggiebeer.com/ReggieAjax.php';
		$data = [];
		$data['xGroup'] = "Judge" ;
		$data['xSubGroup'] = "Contact"; 
		$data['xAction'] = "Report" ;
		$data['xCompID'] = $contest->competition_username;
		$data['xPassword'] = $contest->competition_password; 
		$data['xDBIndex'] = "0";
		$data['Report'] = "14";
		$data['Table'] = "Entry"; 
		$data['Params'] = "?";
 

		// use key 'http' even if you send the request to https://...
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);

		$this->db->where('id_contest', $contest->id)->delete('sc_contest_entries'); 
		$this->load->library('Dom_parser');
		$dom = new simple_html_dom();
		$dom->load($result); 
		$entries = [];
		foreach( $dom->find('tr') as $node)
		{	
			$tds = $node->find('td');
			if(count($tds)){
				$reg = [];
				$reg['id_contest'] = $contest->id;
				$reg['entrant_name'] = $tds[0]->innertext;
				$reg['entry_name'] = $tds[1]->innertext;
				$reg['style'] = $tds[2]->innertext;
				$reg['substyle_name'] = $tds[3]->innertext;
				$reg['entry'] = $tds[4]->innertext; 
				$entries[] = $reg;
			}
		}
		$this->db->insert_batch('sc_contest_entries', $entries); 
	}
	public function update_contest_adherent_id(){
		$this->db->query("UPDATE sc_contest_entrants sce, llx_adherent la
		set sce.adherent_id = la.rowid
		where la.email = sce.email");
	} 
	
	public function get_entry($id){
		return $this->db->where('id', $id)->get('sc_contest_entries')->row();
	}
	public function get_entries_for_lost($id_contest){
		$entrants = $this->db->select('scentrants.*')->join('sc_contest_entries scentries','scentrants.name = scentries.entrant_name')->where('scentries.id_contest', $id_contest)->where('scentrants.id_contest', $id_contest)->where('scentries.entry_confirm', 0)->get('sc_contest_entrants scentrants')->result(); 

		foreach($entrants as $e){
			$e->entries = $this->db->select('*')->where('id_contest', $id_contest)->where('entrant_name', $e->name)->where('entry_confirm', 0)->get('sc_contest_entries')->result();
		}
		return $entrants;
	}

	public function get_entries_for_send($id_contest){

		$entrants = $this->db->select('scentrants.*')->join('sc_contest_entries scentries','scentrants.name = scentries.entrant_name')->where('scentries.id_contest', $id_contest)->where('scentrants.id_contest', $id_contest)->where('scentries.entry_file is not null')->get('sc_contest_entrants scentrants')->result(); 

		foreach($entrants as $e){
			$e->entries = $this->db->select('*')->where('id_contest', $id_contest)->where('entrant_name', $e->name)->where('entry_file is not null')->get('sc_contest_entries')->result();
		}
		return $entrants;
		
		
	}
	public function confirm_entry($id){
		$this->db->where('id', $id)->update('sc_contest_entries', ['entry_confirm' => 1]);
	}
	public function update_entries_sent($entries){
		foreach($entries as $e){
			$entry = ['entry_sent' => date('Y-m-d H:i:s')]; 
			$this->db->where('id', $e->id)->update('sc_contest_entries',$entry);		
		}
	}
}

/* End of file Account_Model.php */
/* Location: ./application/models/Account_Model.php */
