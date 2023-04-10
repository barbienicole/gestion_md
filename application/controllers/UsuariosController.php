<?php
class UsuariosController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		ini_set('date.timezone', 'America/Santiago');
		$this->load->model('Usuarios', 'modelo');
	}
	
	public function index()
	{
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table('usuarios');
		$crud->set_subject('Usuario');
		$crud->set_language('spanish');
		
		$crud->set_relation('roles_id','roles','nombre');
		$crud->display_as('roles_id','Rol');

		$crud->field_type('password', 'password');
		$crud->field_type('email', 'email');
		
		$crud->unset_columns(array('password'));
		$crud->unset_print();
		$crud->unset_export();
		$crud->unset_clone();
		if($this->session->userdata('usuario_escribir') == 0)
			$crud->unset_add();
		if($this->session->userdata('usuario_editar') == 0)
			$crud->unset_edit();
		if($this->session->userdata('usuario_eliminar') == 0)
			$crud->unset_delete();

		$crud->callback_before_insert(array($this,'encrypt_password_and_insert_callback'));
		$crud->callback_before_update(array($this,'encrypt_password_and_update_callback'));

		$crud->required_fields('usuario','password', 'nombre', 'roles_id');

		$output = $crud->render();
		$data = (array)$output;
		$data['titulo'] = 'Usuarios';
		$this->load->view('usuarios/index', $data);
	}

	function encrypt_password_and_insert_callback($post_array) {
		$post_array['password'] = md5($post_array['password']);
		return $post_array;
	} 

	function encrypt_password_and_update_callback($post_array) {
		$email = $post_array['email'];
		$this->db->select('password');
		$this->db->from('usuarios');
		$this->db->where('email', $email);
		$this->db->limit(1);
		$res = $this->db->get()->result_array();

		$input_password = $post_array['password'];
		if($input_password != $res[0]['password'])
			$post_array['password'] = md5($post_array['password']);
		return $post_array;
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

	public function login(){
		$usuario = trim($this->input->post('usuario', TRUE));
		$password = trim($this->input->post('password', TRUE));

		$usuarioValidado = $this->modelo->login($usuario, md5($password));
		if(!empty($usuarioValidado)){
			//si existe es porque usuario y password hizo match con nuestros registros
			//por ende tenemos que crear session
			$session_array = array(
				'usuario_id' => $usuarioValidado[0]['id'],
				'usuario_usuario' => $usuarioValidado[0]['usuario'],
				'usuario_password_raw' => $password,
				'usuario_password' => $usuarioValidado[0]['password'],
				'usuario_nombre' => $usuarioValidado[0]['nombre'],
				'usuario_email' => $usuarioValidado[0]['email'],
				'usuario_escribir' => $usuarioValidado[0]['escribir'],
				'usuario_editar' => $usuarioValidado[0]['editar'],
				'usuario_eliminar' => $usuarioValidado[0]['eliminar'],
				'roles_id' => $usuarioValidado[0]['roles_id'],
				'roles_nombre' => $usuarioValidado[0]['roles_nombre']
			);
			$this->session->set_userdata($session_array);
			$dataLog = 	[
				'accion' => 'Login Correcto',
				'entidad' => 'usuarios',
				'identificador' => $this->session->userdata('usuario_id'),
				'data' => json_encode($session_array),
				'usuarios_id' => $this->session->userdata('usuario_id'),
				'fecha' => date('Y-m-d H:i:s')
			];
			$this->modelo->addLog($dataLog);
			header('Location: '.base_url().'index.php/Welcome/Panel');
			//$this->load->view('index');
		}
		else{
			//si no existe, hay que enviar mensaje hacia el usuario
			$data = ['mensaje' => '<font color="red">Usuario y/o Contraseña incorrecta.</font>'];
			$dataLog = 	[
							'accion' => 'Login Incorrecto',
							'entidad' => 'usuarios',
							'identificador' => '3',
							'data' => json_encode(['usuario' => $usuario, 'password' => $password]),
							'usuarios_id' => '3', //$this->session->userdata('usuario_id'),
							'fecha' => date('Y-m-d H:i:s')
						];
			$this->modelo->addLog($dataLog);
			$this->load->view('login',$data);
		}
	}

	public function logout()
	{
		$this->session->userdata = array();
		$this->session->sess_destroy();
		header('Location: ' . base_url());
	}
}
