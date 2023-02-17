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
        $items = $this->modelo->getItems();
        $data = [
			'titulo' => 'Nuevo Proyecto',
            'items' => $items
		];
		$this->load->view('cotizaciones/add', $data);
    }

    public function view(){

    }

    public function edit(){

    }
}
