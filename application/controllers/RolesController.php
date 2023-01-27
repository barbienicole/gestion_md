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

	public function addRol(){
		$rol = $this->input->post('input-rol');
		$data = ['nombre' => $rol];
		$this->modelo->addRol($data);
		$this->index();
	}
}
