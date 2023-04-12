<?php
class ConfiguracionesController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Configuraciones', 'modelo');
	}
	
	public function index()
	{
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table('configuraciones');
		$crud->set_subject('Configuración');
		$crud->set_language('spanish');

		$crud->unset_print();
		$crud->unset_export();
		$crud->unset_clone();
		
		$crud->required_fields('nombre');

		$output = $crud->render();
		$data = (array)$output;
		$data['titulo'] = 'Configuraciones';
		$this->load->view('configuraciones/index', $data);
		
	}

	public function add(){
		$data = [
			'titulo' => 'Agregar Configuración'
		];
		$this->load->view('configuraciones/add', $data);
	}

	public function edit(){
		$id = trim($this->input->get('id', TRUE));
		$configuracion = $this->modelo->getConfiguracion($id);
		$data = [
			'id' => $id,
			'titulo' => 'Editar Configuración # '.$id,
			'data'	=> $configuracion
		];
		$this->load->view('configuraciones/edit', $data);
	}

	public function addConfiguracion(){
		$configuracion = $this->input->post('input-configuracion');
		$data = ['nombre' => $configuracion];
		$this->modelo->addConfiguracion($data);
		$this->index();
	}

	public function editConfiguracion(){
		$id = trim($this->input->post('id', TRUE));
		$nombre = trim($this->input->post('nombre', TRUE));
		$data = ['nombre' => $nombre];
		$responseBD = $this->modelo->updateConfiguracion($id, $data);
		if($responseBD){
			//true hacer algo
			echo '1';
		}
		else{
			//false hacer algo
			echo '0';
		}
	}

	public function deleteConfiguracion(){
		$id = trim($this->input->post('id', TRUE));
		$responseBD = $this->modelo->deleteConfiguracion($id);
		if($responseBD){
			//true hacer algo
			echo '1';
		}
		else{
			//false hacer algo
			echo '0';
		}
	}

	public function getDataConfiguracion(){
		$id = trim($this->input->post('id', TRUE));
		$configuracion = $this->modelo->getConfiguracion($id);
		echo json_encode($configuracion);
	}
}