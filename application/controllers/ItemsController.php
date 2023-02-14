<?php
class ItemsController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Items', 'modelo');
	}
	
	public function index()
	{
		$items = $this->modelo->getItems();
		$data = [
					'titulo' => 'Items',
					'items' => $items
				];
		$this->load->view('items/index', $data);
	}

	public function add(){
		$data = [
			'titulo' => 'Agregar Item'
		];
		$this->load->view('items/add', $data);
	}

	public function edit(){
		$id = trim($this->input->get('id', TRUE));
		$item = $this->modelo->getItem($id);
		$data = [
			'id' => $id,
			'titulo' => 'Editar Item # '.$id,
			'data'	=> $item
		];
		$this->load->view('items/edit', $data);
	}

	public function addItem(){
		$item = $this->input->post('input-item');
		$data = ['nombre' => $item];
		$this->modelo->addItem($data);
		$this->index();
	}

	public function editItem(){
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

	public function deleteItem(){
		$id = trim($this->input->post('id', TRUE));
		$responseBD = $this->modelo->deleteItem($id);
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
