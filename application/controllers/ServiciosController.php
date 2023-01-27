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
}
