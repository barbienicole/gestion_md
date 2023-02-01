<?php
class RolesController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Roles', 'modelo');
	}
	
	public function index()
	{
		$roles = $this->modelo->getRoles();
		$data = [
					'titulo' => 'Roles',
					'roles' => $roles
				];
		$this->load->view('roles/index', $data);
	}

	public function add(){
		$data = [
			'titulo' => 'Agregar Rol'
		];
		$this->load->view('roles/add', $data);
	}

	public function edit(){
		$id = trim($this->input->get('id', TRUE));
		$rol = $this->modelo->getRol($id);
		$data = [
			'id' => $id,
			'titulo' => 'Editar Rol # '.$id,
			'data'	=> $rol
		];
		$this->load->view('roles/edit', $data);
	}

	public function addRol(){
		$rol = $this->input->post('input-rol');
		$data = ['nombre' => $rol];
		$this->modelo->addRol($data);
		$this->index();
	}

	public function editRol(){
		$id = trim($this->input->post('id', TRUE));
		$nombre = trim($this->input->post('nombre', TRUE));
		$data = ['nombre' => $nombre];
		$responseBD = $this->modelo->updateRol($id, $data);
		if($responseBD){
			//true hacer algo
			echo '1';
		}
		else{
			//false hacer algo
			echo '0';
		}
	}

	public function deleteRol(){
		$id = trim($this->input->post('id', TRUE));
		$responseBD = $this->modelo->deleteRol($id);
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
