<?php
class SucursalesController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Sucursales', 'modelo');
	}
	
	public function index()
	{
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table('sucursales');
		$crud->set_subject('Sucursal');
		$crud->set_language('spanish');

		$crud->unset_print();
		$crud->unset_export();
		$crud->unset_clone();
		
		$crud->required_fields('nombre');

		$output = $crud->render();
		$data = (array)$output;
		$data['titulo'] = 'Sucursales';
		$this->load->view('sucursales/index', $data);

	}

	public function add(){
		$data = [
			'titulo' => 'Agregar Sucursal'
		];
		$this->load->view('sucursales/add', $data);
	}

	public function edit(){
		$id = trim($this->input->get('id', TRUE));
		$sucursal = $this->modelo->getSucursal($id);
		$data = [
			'id' => $id,
			'titulo' => 'Editar Sucursal # '.$id,
			'data'	=> $sucursal
		];
		$this->load->view('sucursales/edit', $data);
	}

	public function addSucursal(){
		$sucursal= $this->input->post('input-sucursal');
		$data = ['nombre' => $sucursal];
		$this->modelo->addSucursal($data);
		$this->index();
	}

	public function editSucursal(){
		$id = trim($this->input->post('id', TRUE));
		$nombre = trim($this->input->post('nombre', TRUE));
		$data = ['nombre' => $nombre];
		$responseBD = $this->modelo->updateSucursal($id, $data);
		if($responseBD){
			//true hacer algo
			echo '1';
		}
		else{
			//false hacer algo
			echo '0';
		}
	}

	public function deleteSucursal(){
		$id = trim($this->input->post('id', TRUE));
		$responseBD = $this->modelo->deleteSucursal($id);
		if($responseBD){
			//true hacer algo
			echo '1';
		}
		else{
			//false hacer algo
			echo '0';
		}
	}


}
