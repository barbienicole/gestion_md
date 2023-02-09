<?php
class CotizacionesController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Cotizaciones', 'modelo');
	}

    public function index(){

    }

    public function add(){
        $data = [
			'titulo' => 'Nuevo Proyecto'
		];
		$this->load->view('cotizaciones/add', $data);
    }

    public function view(){

    }

    public function edit(){

    }
}
