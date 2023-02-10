<?php
class ClientesController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Clientes', 'modelo');
	}
	
	public function index()
	{
		$clientes = $this->modelo->getClientes();
		$data = [
					'titulo' => 'Clientes',
					'clientes' => $clientes
				];
		$this->load->view('clientes/index', $data);
	}

	public function add(){
		$data = [
			'titulo' => 'Agregar Cliente'
		];
		$this->load->view('clientes/add', $data);
	}

	public function edit(){
		$id = trim($this->input->get('id', TRUE));
		$cliente = $this->modelo->getCliente($id);
		$data = [
			'id' => $id,
			'titulo' => 'Editar Cliente # '.$id,
			'data'	=> $cliente
		];
		$this->load->view('clientes/edit', $data);
	}

	public function addCliente(){
		$rut = $this->input->post('input-rut');
		$nombre = $this->input->post('input-nombre');
		$razon_social = $this->input->post('input-razon_social');
		$direccion = $this->input->post('input-direccion');
		$email = $this->input->post('input-email');
		$telefono = $this->input->post('input-telefono');
		$comuna = $this->input->post('input-comuna');
		$data = ['rut' => $rut,
				 'nombre' => $nombre,
				 'razon_social' => $razon_social,
				 'direccion' => $direccion,
				 'email' => $email,
				 'telefono' => $telefono,
				 'comuna' => $comuna,
				];
		$this->modelo->addCliente($data);
		$this->index();
	}

	public function editCliente(){
		$id = trim($this->input->post('id', TRUE));
		$rut = trim($this->input->post('rut', TRUE));
		$nombre = trim($this->input->post('nombre', TRUE));
		$razon_social = trim($this->input->post('razon_social', TRUE));
		$direccion = trim($this->input->post('direccion', TRUE));
		$email = trim($this->input->post('email', TRUE));
		$telefono = trim($this->input->post('telefono', TRUE));
		$comuna = trim($this->input->post('comuna', TRUE));
		$data = ['rut' => $rut,
				 'nombre' => $nombre,
				 'razon_social' => $razon_social,
				 'direccion' => $direccion,
				 'email' => $email,
				 'telefono' => $telefono,
				 'comuna' => $comuna
				];
		$responseBD = $this->modelo->updateCliente($id, $data);
		if($responseBD){
			//true hacer algo
			echo '1';
		}
		else{
			//false hacer algo
			echo '0';
		}
	}

	public function deleteCliente(){
		$id = trim($this->input->post('id', TRUE));
		$responseBD = $this->modelo->deleteCliente($id);
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