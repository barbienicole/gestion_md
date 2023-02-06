<?php
class ServiciosController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Servicios', 'modelo');
	}
	
	public function index()
	{
		$servicios = $this->modelo->getServicios();
		$data = [
					'titulo' => 'Servicios',
					'servicios' => $servicios
				];
		$this->load->view('servicios/index', $data);
	}

	public function add(){
		$data = [
			'titulo' => 'Agregar Servicio'
		];
		$this->load->view('servicios/add', $data);
	}

	public function edit(){
		$id = trim($this->input->get('id', TRUE));
		$servicio = $this->modelo->getServicio($id);
		$data = [
			'id' => $id,
			'titulo' => 'Editar Servicio # '.$id,
			'data'	=> $servicio
		];
		$this->load->view('servicios/edit', $data);
	}

	public function addServicio(){
		$servicio = $this->input->post('input-servicio');
		$data = ['nombre' => $servicio];
		$this->modelo->addServicio($data);
		$this->index();
	}

	public function editServicio(){
		$id = trim($this->input->post('id', TRUE));
		$nombre = trim($this->input->post('nombre', TRUE));
		$data = ['nombre' => $nombre];
		$responseBD = $this->modelo->updateServicio($id, $data);
		if($responseBD){
			//true hacer algo
			echo '1';
		}
		else{
			//false hacer algo
			echo '0';
		}
	}

	public function deleteServicio(){
		$id = trim($this->input->post('id', TRUE));
		$responseBD = $this->modelo->deleteServicio($id);
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
