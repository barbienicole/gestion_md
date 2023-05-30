<?php
class MaterialesController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Materiales', 'modelo');
	}
	
	public function listado()
	{
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table('materiales');
		$crud->set_subject('Material');
		$crud->set_language('spanish');

		$crud->unset_print();
		$crud->unset_export();
		$crud->unset_clone();
		$crud->unset_edit();
		$crud->unset_delete();
				
		$crud->required_fields('nombre');

		$output = $crud->render();
		$data = (array)$output;
		$data['titulo'] = 'Materiales';
		$this->load->view('materiales/listado', $data);
		/*
		$items = $this->modelo->getItems();
		$data = [
					'titulo' => 'Items',
					'items' => $items
				];
		$this->load->view('items/index', $data);
		*/
	}

	public function index()
	{
		$materiales = $this->modelo->getMateriales();
		$data = [
					'titulo' => 'Materiales',
					'materiales' => $materiales
				];
		$this->load->view('materiales/index', $data);
	}

	public function add(){
		$data = [
			'titulo' => 'Agregar Material'
		];
		$this->load->view('materiales/add', $data);
	}

	public function edit(){
		$id = trim($this->input->get('id', TRUE));
		$material = $this->modelo->getMaterial($id);
		$data = [
			'id' => $id,
			'titulo' => 'Editar Material # '.$id,
			'data'	=> $material
		];
		$this->load->view('materiales/edit', $data);
	}

	public function addMaterial(){
		$codigo = $this->input->post('input-codigo');
		$nombre = $this->input->post('input-nombre');
		$valor = $this->input->post('input-valor');
		$stockideal = $this->input->post('input-stockideal');
		$stock = $this->input->post('input-stock');
		$data = ['codigo' => $codigo,
				 'nombre' => $nombre,
				 'valor' => $valor,
				 'stockideal' => $stockideal,
				 'stock' => $stock
				];
		$this->modelo->addMaterial($data);
		$this->index();
	}

	public function editMaterial(){
		$id = trim($this->input->post('id', TRUE));
		$codigo = trim($this->input->post('codigo', TRUE));
		$nombre = trim($this->input->post('nombre', TRUE));
		$valor = trim($this->input->post('valor', TRUE));
		$stockideal = trim($this->input->post('stockideal', TRUE));
		$stock = trim($this->input->post('stock', TRUE));
		$data = ['codigo' => $codigo,
			 	 'nombre' => $nombre,
				 'valor' => $valor,
				 'stockideal' => $stockideal,
				 'stock' => $stock
				];
		$responseBD = $this->modelo->updateMaterial($id, $data);
		if($responseBD){
			//true hacer algo
			echo '1';
		}
		else{
			//false hacer algo
			echo '0';
		}
	}

	public function deleteMaterial(){
		$id = trim($this->input->post('id', TRUE));
		$responseBD = $this->modelo->deleteMaterial($id);
		if($responseBD){
			//true hacer algo
			echo '1';
		}
		else{
			//false hacer algo
			echo '0';
		}
	}

	public function updateStock(){
		$id = trim($this->input->post('id', TRUE));
		$nuevoStock = trim($this->input->post('nuevoStock', TRUE));
		$data = [
				 'stock' => $nuevoStock
				];
		$responseBD = $this->modelo->updateMaterial($id, $data);
		if($responseBD){
			//true hacer algo
			echo '1';
		}
		else{
			//false hacer algo
			echo '0';
		}
	}

	public function getDataMaterial(){
		$id = trim($this->input->post('id', TRUE));
		$material = $this->modelo->getMaterial($id);
		echo json_encode($material);
	}
}
