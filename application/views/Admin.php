<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct(true);

		$this->load->database();
		$this->load->helper('url'); 
		$this->load->model('Eventos_Model');
		$this->load->model('Account_Model');
		$this->load->library('grocery_CRUD');
		$this->load->library('email');
		$this->load->config('email');

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
			$crud->columns('titulo','fecha', 'oradores', 'lugar', 'valor', 'valor_no_socio');
			$crud->field_type('tipo_validacion', 'dropdown', array('0' => 'Standard', '1' => 'Festival'));
			$crud->field_type('oculto', 'dropdown', array('0' => 'NO', '1' => 'SI'));
			$crud->set_field_upload('foto','assets/uploads/eventos');
			$crud->add_action('Participantes', '', 'admin/inscripciones', 'green'); 
			$crud->add_action('Link Publico', '', 'capacitaciones/capacitacion_public', 'green');
			die('test');
			$crud->callback_add_field('extrafield_1_values',  array($this, '_callback_extrafield_1')); 
			$crud->callback_add_field('extrafield_2_values',  array($this, '_callback_extrafield_2'));
			
			$crud->field_type('oculto', 'dropdown', array('0' => 'NO', '1' => 'SI'));


			
			$crud->callback_add_field('email', array($this, '_callback_default_email'));


			$crud->unset_read();
			$crud->unset_jquery();

			$output = $crud->render(); 
 
			$this->load->view('main',(array)$output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	} 
	function _callback_extrafield_1(){ 
		return 'Ingrese Label|valores separados por ,<br>
		 ejemplo Provincia|Buenos Aires,Mendoza,Jujuy
		 <input type="text" name="extrafield_1_values">'
	}
	function _callback_extrafield_2(){
		return '<input type="text" name="extrafield_2_values">'
	}
	function _callback_default_email($value, $row){
		
		if(!$value) {
			$value = "<br> 
			LA FORMA DE PAGO ES:<br>
			Reserva de vacante $500 única manera de reservar el cupo, el resto EN EFECTIVO EL DÍA DEL CURSO.<br>
			<br>
			Les recordamos que solo se reserva la vacante 48 hs después de recibir el mail.<br>
			<br>
			Adjuntamos los Links de pago por reserva. (recargo del 6.5%)<br>
			<br>
			Pagá tu $500 - capacitación  con Mercado Pago: $ 532,50  https://mpago.la/23gn47B<br>
			<br>
			También pueden hacerlo por transferencia.<br>
			<br>
			Datos de la cuenta a depositar: Banco Credicoop Cooperativo Limitado, Sucursal Flores Norte (221)<br>
			<br>
			Titular: Asociación Civil Somos Cerveceros Cuenta corriente: 191-221-001925/0<br>
			CBU: 1910221255022100192500<br>
			CUIT: 30-71077118-5<br>
			<br>
			Por favor, luego de realizar el pago, responder con el comprobante de la operación<br>
			<br>";
		} 
		return '<textarea id="field-email" name="email" class="texteditor" >'.$value.'</textarea>';
	} 

	// Callback function
	public function _callback_get_entries_qry($value, $row) {
		return $this->db->select('count(1) as qty')->where('id_contest', $row->id)->get('sc_contest_entries')->row('qty');
	}
	public function _callback_get_entrant_qry($value, $row) {
		return $this->db->select('count(1) as qty')->where('id_contest', $row->id)->get('sc_contest_entrants')->row('qty');
	}
	public function concursos(){
		try{

			$crud = new grocery_CRUD(); 

			//$crud->columns('email', 'role', 'adherent_id');
			$crud->set_theme('material');
			$crud->order_by('id');
			$crud->set_table('sc_contest');
			$crud->set_subject('Concursos');
			//$crud->field_type('adherent_id', 'hidden');
			//$crud->display_as('adherent_id','Socio');
			//$crud->set_relation('adherent_id','llx_adherent','{firstname} {lastname} ({rowid})');
			$crud->columns('competition_name', 'cantidad_entradas', 'cantidad_concursantes');
			// Callback for the custom column _callback_get_counter
			$crud->callback_column('cantidad_entradas', array($this, '_callback_get_entries_qry'));
			$crud->callback_column('cantidad_concursantes', array($this, '_callback_get_entrant_qry'));


			/* Just before the view I have this */

			$this->state = $crud->getState();
			/*if(in_array($this->state, array('list','success')))
			{
				$this->db->select('', false);
				$q = $this->db->get('categories');
			}*/



		  	//$crud->field_type('enviada_confirmacion', 'dropdown', array('1' => 'Confirmación enviada', '0' => 'No enviada'));
			//$crud->field_type('role','dropdown', array('USUARIO' => 'USUARIO', 'ADMIN' => 'ADMIN'));  

			$crud->add_action('<i class="material-icons">autorenew</i>', '', 'admin/sync_contest_data', 'red syncconfirm');
			$crud->add_action('Concursantes', '', 'admin/concursos_concursantes', 'green');
			$crud->add_action('Entradas', '', 'admin/concursos_entradas', 'green');
			$crud->add_action('Reporte estilos', '', 'admin/reporte_estilos', 'blue');
  	
			$crud->unset_read(); 
			$crud->unset_jquery(); 

			$output = $crud->render(); 
 
			$this->load->view('main',(array)$output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function reporte_estilos($id_contest){
		$this->load->model('Contest_Model');
		$estilos = $this->Contest_Model->get_style_report($id_contest);
		$output['output'] = $this->load->view('concursos/reporte_estilos', array('estilos' => $estilos, 'id_contest' => $id_contest), true);
		$this->load->view('main',(array)$output);
	}

	public function reporte_estilos_csv($id_contest){
		$this->load->model('Contest_Model');
		$contest = $this->Contest_Model->get_contest($id_contest);
		$estilos = $this->Contest_Model->get_style_report($id_contest);

		$spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();

        // configuramos header
        $sheet->setCellValue('A1', 'Estilo'); 
        $sheet->setCellValue('B1', 'Nombre Subestilo');
		$sheet->setCellValue('C1', 'Cantidad');
		$row = 2;
		foreach($estilos as $v){
			$sheet->setCellValue('A'.$row, $v->style); 
			$sheet->setCellValue('B'.$row, $v->substyle_name);
			$sheet->setCellValue('C'.$row, $v->qty);
			$row++;
		}
        
        $writer = new Xlsx($spreadsheet); // instantiate Xlsx
 
        $filename = $contest->competition_name ; // set filename for excel file to be exported
 
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');	// download file 
	}
	
	public function upload_entries_file($id){ 
		$replace = $this->input->post("replace");
		$this->load->model('Contest_Model');
		$contest = $this->Contest_Model->get_contest($id);
		$filedir = FCPATH.'upload/'.$contest->id.'/';
		if(array_key_exists('entries', $_FILES) && $_FILES["entries"]["name"]) {
			$filename = $_FILES["entries"]["name"];
			$source = $_FILES["entries"]["tmp_name"];
			$type = $_FILES["entries"]["type"];
			
			$name = explode(".", $filename);
			$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
			foreach($accepted_types as $mime_type) {
				if($mime_type == $type) {
					$okay = true;
					break;
				} 
			}
			
			$continue = strtolower($name[1]) == 'zip' ? true : false;
			if(!$continue) {
				$message = "The file you are trying to upload is not a .zip file. Please try again.";
			}
			if(!file_exists($filedir))mkdir($filedir);
			
			$target_path = $filedir.$filename; // change this to the correct site path
			if(move_uploaded_file($source, $target_path)) {
				$zip = new ZipArchive();
				$x = $zip->open($target_path);
				if ($x === true) {
					$zip->extractTo($filedir); // change this to the correct site path
					$zip->close();
					unlink($target_path);
				}
			} 
			$entradas = 0;
			$files = scandir($filedir);
			foreach($files as $file){
				$fname = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file);
				$entry = $this->db->select('*')->where('entry', $file)->where('id_contest', $contest->id)->get('sc_contest_entries')->row();
				if($entry){
					if(!$entry->entry_file || $replace == "on"){
						$newFilename = $filedir. uniqid() .'.pdf';
						rename($filedir.$file, $newFilename);
						$this->db->where('id', $entry->id)->where('id_contest', $contest->id)->update('sc_contest_entries', ['entry_file'=>$newFilename, 'entry_confirm' => 1]); 
						$entradas++;
					}
				
				}
			}
			$this->session->set_flashdata('message', 'Cargadas '.$entradas.' Entradas correctamente' );
		}else{
			$this->session->set_flashdata('error', 'Seleccione un archivo' );
		}
    	redirect('admin/concursos_entradas/'.$contest->id); 
	}





	public function concursos_entradas($id){
		try{

		$this->load->model('Contest_Model');
		$contest = $this->Contest_Model->get_contest($id);
		$stats = $this->Contest_Model->get_contest_statics($id);
		$data = array('contest' => $contest, 'stats' => $stats);
		$crud = new grocery_CRUD(); 
		$crud->set_theme('material');
		$crud->order_by('id');
		$crud->where('id_contest',$id);
		$crud->set_table('sc_contest_entries');
		$crud->set_subject('Entradas');
		$crud->unset_read(); 
		$crud->unset_add();
		$crud->unset_export(); 
		$crud->unset_print();
		$crud->unset_add();
		$crud->unset_jquery(); 
		$crud->set_relation('id_contest','sc_contest','competition_name');
		$crud->columns(['entrant_name','entry_name', 'style', 'substyle_name', 'entry', 'entry_confirm', 'entry_file', 'entry_sent']);
		$crud->add_action('Confirmar', '', 'admin/confirmar_entrada', 'green btn-confirm-entry');
		$crud->field_type('entry_confirm', 'dropdown', array('0' => 'Sin confirmar', '1' => 'Confirmada'));

		$output = $crud->render(); 
		$output->output = $this->load->view('concursos/send', $data, true).$output->output;
		
		$this->load->view('main',(array)$output);
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function concursos_concursantes($id){
		try{

			$crud = new grocery_CRUD(); 
			$crud->set_theme('material');
			$crud->order_by('id');
			$crud->set_table('sc_contest_entrants');
			$crud->set_subject('Concursos');
			$crud->where('id_contest',$id);
			$crud->unset_read(); 
			$crud->unset_jquery(); 
		
			$output = $crud->render(); 
			$this->load->view('main',(array)$output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function sync_contest_data($id){
		$this->load->model('Contest_Model');
		$contest = $this->Contest_Model->get_contest($id);
		if(!$contest) die('no existe el concurso');
		
		$this->Contest_Model->sync_entrants($contest);
		$this->Contest_Model->sync_entries($contest);
		$this->Contest_Model->update_contest_adherent_id();
		
    	$this->session->set_flashdata('message', 'Concurso sincronizado correctamente' );
    	redirect('admin/concursos/'); 

	}
	public function festival(){
		try{
			$crud = new grocery_CRUD(); 
			$crud->columns('id',  'id_paquete',  'id_socio',  'fecha_inscripcion',  'dni',  'nombre',  'apellido',  'valor',  'nro_socio',  'estado_pago',  'nro_compobante',  'fecha_pago',  'telefono',  'email', 'enviada_confirmacion');   
			$crud->set_theme('material');
			$crud->order_by('fecha_inscripcion');
			$crud->set_table('sc_festival_inscripciones');
			$crud->set_subject('Inscripciones');
			$crud->field_type('id_socio', 'hidden');

			  $crud->field_type('enviada_confirmacion', 'dropdown', array('1' => 'Confirmación enviada', '0' => 'No enviada'));

			$crud->field_type('estado_pago','dropdown', 
			array('0' => 'No pagado', '1' => 'Pagado', '2' => 'Bonificado'));  
			$crud->add_action('Enviar confirmación', '', 'admin/confirmar_pago_festival', 'green');
  
			$crud->unset_read(); 
			$crud->unset_jquery(); 

			$output = $crud->render(); 
 
			$this->load->view('main',(array)$output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


	public function usuarios(){
		try{

			$crud = new grocery_CRUD(); 
			//$crud->columns('id',  'id_paquete',  'id_socio',  'fecha_inscripcion',  'dni',  'nombre',  'apellido',  'valor',  'nro_socio',  'estado_pago',  'nro_compobante',  'fecha_pago',  'telefono',  'email', 'enviada_confirmacion');
			//
			$crud->columns('email', 'role', 'adherent_id');
			$crud->set_theme('material');
			$crud->order_by('id');
			$crud->set_table('sc_accounts');
			$crud->set_subject('Usuarios');
			//$crud->field_type('adherent_id', 'hidden');
			$crud->display_as('adherent_id','Socio');
			$crud->set_relation('adherent_id','llx_adherent','{firstname} {lastname} ({rowid})');


		  	//$crud->field_type('enviada_confirmacion', 'dropdown', array('1' => 'Confirmación enviada', '0' => 'No enviada'));
			$crud->field_type('password', 'hidden');
			$crud->field_type('role','dropdown', array('USUARIO' => 'USUARIO', 'ADMIN' => 'ADMIN'));  

			$crud->add_action('recuperar contraseña', '', 'admin/recuperar_pass', 'green');
  	
			$crud->unset_read(); 
			$crud->unset_jquery(); 

			$output = $crud->render(); 
 
			$this->load->view('main',(array)$output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	} 
	public function recuperar_pass($id){

		$socio = $this->Account_Model->getSocioByUserId($id);
		$token = $this->Account_Model->getToken($socio, true);
        $data['link'] = base_url().'login/token/'.$token.'/1'; 
        $body = $this->load->view('login/email-recuperar', $data, true);			   

       // $this->email->initialize($this->config->item('email'));
        $this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
        $this->email->to($socio->email);  
        $this->email->set_mailtype("html");
        $this->email->subject('Somos Cerveceros | Recuperar contraseña');
		$this->email->message($body);  
		
        $r = $this->email->send();

    	$this->session->set_flashdata('message', 'Se envio un email al socio, en caso de que no lo reciba enviarle este link: '.$data['link'] );
    	redirect('admin/usuarios/'); 
	}
	public function confirmar_pago_festival($id){
		$this->load->model('Festival_Model'); 
		$inscripcion = $this->Festival_Model->get_inscripcion($id);

		if($inscripcion->estado_pago != null ){ 
			$this->Festival_Model->set_confirmacion($id);
			$body = $this->load->view('festival/email-confirmacion', array('inscripcion' => $inscripcion, 'packs' => array('Pack preventa full socios', 'Pack Full', 'Pack acompañante', 'Pack fiesta de cierre')), true); 
			$this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
			$this->email->to($inscripcion->email);     
			$this->email->set_mailtype("html");
			$this->email->subject('Somos Cerveceros | Confirmación de Pago Festival');
			$this->email->message($body);    
			$r = $this->email->send();  
			$this->session->set_flashdata('message', 'Se notifico por email la confirmación de pago');   	
			redirect('admin/festival/');  

		}else{
			$this->session->set_flashdata('error', 'No ha cargado aun el pago');   
			redirect('admin/festival/'); 

		}
	}
	public function inscripciones($id){
		$crud = new grocery_CRUD();
		$crud->set_theme('material');
		$crud->set_table('sc_eventos_inscripciones');
		$crud->set_subject('Inscripciones');
		
		$crud->unset_read();
		$crud->unset_jquery();

		$output = $crud->render(); 
		$data['participantes'] = $this->Eventos_Model->get_participantes($id);  
		$data['capacitacion'] = $this->Eventos_Model->get_capacitacion($id);

		$output->output = $this->load->view('inscripciones', $data, true);
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
	public function confirmar_entrada($id){
		$this->load->model('Contest_Model');
		$this->Contest_Model->confirm_entry($id);
		$entry = $this->Contest_Model->get_entry($id);
		echo json_encode($entry);
	}
	public function enviar_devolucion($id_contest){
		$this->load->model('Contest_Model');
		$contest = $this->Contest_Model->get_contest($id_contest);
		$entrants = $this->Contest_Model->get_entries_for_send($id_contest);
		foreach($entrants as $e){
			$data = ['entrant' => $e, 'contest'=>$contest];
			$body = $this->load->view('concursos/email-devolucion', $data, true);			   
			$this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
			$this->email->to($e->email);   
			$this->email->set_mailtype("html");
			$this->email->subject('Somos Cerveceros | Devolucion concurso');
			$this->email->message($body);  
			$this->Contest_Model->update_entries_sent($e->entries);
			$r = $this->email->send();  
		}
		$this->session->set_flashdata('message', 'Se enviaron '.count($entrants).' emails de devoluciones' );
    	redirect('admin/concursos_entradas/'.$contest->id); 
	}
	public function enviar_perdidas($id_contest){
		$this->load->model('Contest_Model');
		$this->load->model('Contest_Model');
		$contest = $this->Contest_Model->get_contest($id_contest);
		$entrants = $this->Contest_Model->get_entries_for_lost($id_contest);
		foreach($entrants as $e){
			$data = ['entrant' => $e, 'contest'=>$contest];  
			$body = $this->load->view('concursos/email-perdidos', $data, true);			   
			$this->email->from('socios@somoscerveceros.com.ar', 'Somos Cerveceros');
			$this->email->to($e->email);   
			$this->email->set_mailtype("html");
			$this->email->subject('Somos Cerveceros | Devolucion concurso');
			$this->email->message($body);  
			//$this->Contest_Model->update_entries_sent($e->entries);
			$r = $this->email->send();  
		}
		$this->session->set_flashdata('message', 'Se enviaron '.count($entrants).' emails de perdida de muestras' );
    	redirect('admin/concursos_entradas/'.$contest->id); 
	}


}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */