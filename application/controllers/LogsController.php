<?php
class LogsController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Logs', 'modelo');
	}
	
	public function index()
	{
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table('logs');
		$crud->set_subject('Log');
		$crud->set_language('spanish');

		$crud->unset_print();
		$crud->unset_export();
		$crud->unset_clone();
		$crud->unset_edit();
		$crud->unset_delete();
		$crud->unset_add();
		
		$crud->required_fields('nombre');

		$output = $crud->render();
		$data = (array)$output;
		$data['titulo'] = 'Logs';
		$this->load->view('logs/index', $data);
		
	}

	public function add(){
		$data = [
			'titulo' => 'Agregar Log'
		];
		$this->load->view('logs/add', $data);
	}


	public function edit(){
		$id = trim($this->input->get('id', TRUE));
		$log = $this->modelo->getLog($id);
		$data = [
			'id' => $id,
			'titulo' => 'Editar Log # '.$id,
			'data'	=> $log
		];
		$this->load->view('logs/edit', $data);
	}

	public function addLog(){
		$log = $this->input->post('input-log');
		$data = ['nombre' => $log];
		$this->modelo->addLog($data);
		$this->index();
	}

    /*
	public function editLog(){
		$id = trim($this->input->post('id', TRUE));
		$nombre = trim($this->input->post('nombre', TRUE));
		$data = ['nombre' => $nombre];
		$responseBD = $this->modelo->updateItem($id, $data);
		if($responseBD){
			//true hacer algo
			echo '1';
		}
		else{
			//false hacer algo
			echo '0';
		}
	}
    */

	public function deleteLog(){
		$id = trim($this->input->post('id', TRUE));
		$responseBD = $this->modelo->deleteLog($id);
		if($responseBD){
			//true hacer algo
			echo '1';
		}
		else{
			//false hacer algo
			echo '0';
		}
	}

	public function getDataLog(){
		$id = trim($this->input->post('id', TRUE));
		$log = $this->modelo->getLog($id);
		echo json_encode($log);
	}
}