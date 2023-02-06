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

	public function edit(){
		$id = trim($this->input->get('id', TRUE));
		$usuario = $this->modelo->getUsuario($id);
		$data = [
			'id' => $id,
			'titulo' => 'Editar Usuario # '.$id,
			'data'	=> $usuario 
		];
		$this->load->view('usuarios/edit', $data);
	}

	public function addUsuario(){
		$usuario = $this->input->post('input-usuario');
		$data = ['nombre' => $usuario];
		$this->modelo->addUsuario($data);
		$this->index();
	}

	public function editUsuario(){
		$id = trim($this->input->post('id', TRUE));
		$nombre = trim($this->input->post('nombre', TRUE));
		$data = ['nombre' => $nombre];
		$responseBD = $this->modelo->updateUsuario($id, $data);
		if($responseBD){
			//true hacer algo
			echo '1';
		}
		else{
			//false hacer algo
			echo '0';
		}
	}

	public function deleteUsuario(){
		$id = trim($this->input->post('id', TRUE));
		$responseBD = $this->modelo->deleteUsuario($id);
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
