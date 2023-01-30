<?php
class UsuariosController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Usuarios', 'modelo');
	}
	
	public function index()
	{
		$usuarios = $this->modelo->getUsuarios();
		$data = [
					'titulo' => 'Usuarios',
					'usuarios' => $usuarios
				];
		$this->load->view('usuarios/index', $data);
	}

	public function add(){
		$data = [
			'titulo' => 'Agregar Usuario'
		];
		$this->load->view('usuarios/add', $data);
	}

	public function addUsuario(){
		$usuario = $this->input->post('input-usuario');
		$data = ['nombre' => $usuario];
		$this->modelo->addUsuario($data);
		$this->index();
	}
}
