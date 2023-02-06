<?php
class MaterialesController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Materiales', 'modelo');
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
		$nombre = $this->input->post('input-nombre');
		$modelo = $this->input->post('input-modelo');
		$valor = $this->input->post('input-valor');
		$stock = $this->input->post('input-stock');
		$data = ['nombre' => $nombre,
				 'modelo' => $modelo,
				 'valor' => $valor,
				 'stock' => $stock
				];
		$this->modelo->addMaterial($data);
		$this->index();
	}

	public function editMaterial(){
		$id = trim($this->input->post('id', TRUE));
		$nombre = trim($this->input->post('nombre', TRUE));
		$data = ['nombre' => $nombre];
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
}
