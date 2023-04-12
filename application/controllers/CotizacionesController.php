<?php
class CotizacionesController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Cotizaciones', 'modelo');
	}

    public function index(){
		$data['titulo'] = 'Proyectos';
		$data['clientes'] = $this->modelo->obtenerClientes();
		$data['estados'] = $this->modelo->obtenerEstados();
		$this->load->view('cotizaciones/index', $data);
    }

    public function add(){
		$iva = $this->modelo->getParametroConfiguracion('iva');
        $items = $this->modelo->getItems();
        $data = [
			'titulo' => 'Nuevo Proyecto',
			'iva' => $iva,
            'items' => $items
		];
		$data['clientes'] = $this->modelo->obtenerClientes();
		$data['estados'] = $this->modelo->obtenerEstados();
		$this->load->view('cotizaciones/add', $data);
    }

    public function view(){
		$id = trim($this->input->get('id', TRUE));
		$data['titulo'] = 'Ver Proyecto # '.$id;
		$this->load->view('cotizaciones/view', $data);
    }

    public function edit(){

    }

	public function obtenerCotizaciones(){
		$desde = trim($this->input->post('desde', TRUE));
		$hasta = trim($this->input->post('hasta', TRUE));
		$cliente = trim($this->input->post('cliente', TRUE));
		$estado = trim($this->input->post('estado', TRUE));

		echo json_encode($this->modelo->obtenerCotizaciones($desde, $hasta, $cliente, $estado));
	}
}
