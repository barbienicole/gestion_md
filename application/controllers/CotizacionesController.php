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
		$cotizacion_cebecera = $this->modelo->obtenerCotizacion($id);
		$cotizacion_detalle_pre = $this->modelo->obtenerDetalleCotizacionPre($id);
		$cotizacion_detalle_real = $this->modelo->obtenerDetalleCotizacionReal($id);
		$data['titulo'] = 'Ver Proyecto # '.$id;
		$data['cabecera'] = $cotizacion_cebecera; 
		$data['detalle_pre'] = $cotizacion_detalle_pre; 
		$data['detalle_real'] = $cotizacion_detalle_real; 
		$data['clientes'] = $this->modelo->obtenerClientes();
		$data['estados'] = $this->modelo->obtenerEstados();
		$this->load->view('cotizaciones/view', $data);
    }

    public function edit(){
		$iva = $this->modelo->getParametroConfiguracion('iva');
		$items = $this->modelo->getItems();
		$id = trim($this->input->get('id', TRUE));
		$cotizacion_cebecera = $this->modelo->obtenerCotizacion($id);
		$cotizacion_detalle_pre = $this->modelo->obtenerDetalleCotizacionPre($id);
		$cotizacion_detalle_real = $this->modelo->obtenerDetalleCotizacionReal($id);
		$data['titulo'] = 'Editar Proyecto # '.$id;
		$data['cabecera'] = $cotizacion_cebecera; 
		$data['detalle_pre'] = $cotizacion_detalle_pre; 
		$data['detalle_real'] = $cotizacion_detalle_real; 
		$data['clientes'] = $this->modelo->obtenerClientes();
		$data['estados'] = $this->modelo->obtenerEstados();
		$data['iva'] = $iva;
		$data['items'] = $items;
		$this->load->view('cotizaciones/edit', $data);
    }

	public function obtenerCotizaciones(){
		$desde = trim($this->input->post('desde', TRUE));
		$hasta = trim($this->input->post('hasta', TRUE));
		$cliente = trim($this->input->post('cliente', TRUE));
		$estado = trim($this->input->post('estado', TRUE));

		echo json_encode($this->modelo->obtenerCotizaciones($desde, $hasta, $cliente, $estado));
	}
	//add & edit
	//add
	public function addCotizacion(){
		$dataPre = $this->input->post('dataPre', TRUE);
		$dataReal = $this->input->post('dataReal', TRUE);

		$usuario = trim($this->input->post('usuario', TRUE));
		$codigo = trim($this->input->post('codigo', TRUE));
		$fecha = trim($this->input->post('fecha', TRUE));
		$titulo = trim($this->input->post('titulo', TRUE));
		$estado = 1;
		$cliente = trim($this->input->post('cliente', TRUE));
		$descripcion = trim($this->input->post('descripcion', TRUE));
		$iva_historico = trim($this->input->post('iva_historico', TRUE));
		$neto_pre = trim($this->input->post('neto_pre', TRUE));
		$iva_pre = trim($this->input->post('iva_pre', TRUE));
		$total_pre = trim($this->input->post('total_pre', TRUE));
		$neto_real = trim($this->input->post('neto_real', TRUE));
		$iva_real = trim($this->input->post('iva_real', TRUE));
		$total_real = trim($this->input->post('total_real', TRUE));

		$response = [];
		if(!empty($codigo) && !empty($fecha) && !empty($titulo) && !empty($cliente) && !empty($dataPre) && !empty($neto_pre)){
			//guardar cotizacion
			$dataCotizacion = 	[
				'codigo' => $codigo,
				'fecha_creacion' => date('Y-m-d H:i:s'),
				'fecha_actualizacion' => date('Y-m-d H:i:s'),
				'fecha' => $fecha,
				'titulo' => $titulo,
				'cotizaciones_estado_id' => $estado,
				'clientes_id' => $cliente,
				'descripcion' => $descripcion,
				'iva_historico' => $iva_historico,
				'neto' => $neto_pre,
				'total' => $total_pre,
				'iva'	=>	$iva_pre,
				'neto_real' => $neto_real,
				'iva_real' => $iva_real,
				'total_real' => $total_real,
				'usuarios_id' => $this->session->userdata("usuario_id")
			];

			$cotizacion_id = $this->modelo->modelo->add($dataCotizacion);
			//guardar detalles
			if($cotizacion_id != false){
				for($i=0; $i < count($dataPre); $i++){
					$arr_temp = 	[
								'cotizaciones_id' => $cotizacion_id,
								'items_id' => $dataPre[$i][0],
								'n_linea' => ($i+1),
								'cantidad' => $dataPre[$i][1],
								'valor'	=> $dataPre[$i][2]
					];
				
					$this->modelo->addDetallePre($arr_temp);
				}
				if(!empty($dataReal)){
					for($i=0; $i < count($dataReal); $i++){
						$arr_temp = 	[
									'cotizaciones_id' => $cotizacion_id,
									'items_id' => $dataReal[$i][0],
									'n_linea' => ($i+1),
									'cantidad' => $dataReal[$i][1],
									'valor'	=> $dataReal[$i][2]
						];
						$this->modelo->addDetalleReal($arr_temp);
					}
				}
			}
			$response = [
							'codigo' => 1,
							'response' => 'Se ha generado de manera correcta el Proyecto.'
						];
		}
		else{
			$response = [
							'codigo' => 0,
							'response' => 'Verifique que los campos obligatorios no esten vacíos.'
						];
		}
		echo json_encode($response);
	}
	//edit
	public function editCotizacion(){
		$cotizacion_id = trim($this->input->post('cotizacion_id', TRUE));

		$dataPre = $this->input->post('dataPre', TRUE);
		$dataReal = $this->input->post('dataReal', TRUE);

		$usuario = trim($this->input->post('usuario', TRUE));
		$codigo = trim($this->input->post('codigo', TRUE));
		$fecha = trim($this->input->post('fecha', TRUE));
		$titulo = trim($this->input->post('titulo', TRUE));
		$estado = trim($this->input->post('estado', TRUE));
		$cliente = trim($this->input->post('cliente', TRUE));
		$descripcion = trim($this->input->post('descripcion', TRUE));
		$iva_historico = trim($this->input->post('iva_historico', TRUE));
		$neto_pre = trim($this->input->post('neto_pre', TRUE));
		$iva_pre = trim($this->input->post('iva_pre', TRUE));
		$total_pre = trim($this->input->post('total_pre', TRUE));
		$neto_real = trim($this->input->post('neto_real', TRUE));
		$iva_real = trim($this->input->post('iva_real', TRUE));
		$total_real = trim($this->input->post('total_real', TRUE));

		$response = [];
		if(!empty($codigo) && !empty($fecha) && !empty($titulo) && !empty($cliente) && 
			!empty($dataPre) && !empty($neto_pre)){
			//guardar cotizacion
			$dataCotizacion = 	[
									'codigo' => $codigo,
									'fecha_creacion' => date('Y-m-d H:i:s'),
									'fecha_actualizacion' => date('Y-m-d H:i:s'),
									'fecha' => $fecha,
									'titulo' => $titulo,
									'cotizaciones_estado_id' => $estado,
									'clientes_id' => $cliente,
									'descripcion' => $descripcion,
									'iva_historico' => $iva_historico,
									'neto' => $neto_pre,
									'total' => $total_pre,
									'iva'	=>	$iva_pre,
									'neto_real' => $neto_real,
									'iva_real' => $iva_real,
									'total_real' => $total_real,
									'usuarios_id' => $this->session->userdata("usuario_id")
								];
			
			$this->modelo->modelo->edit($dataCotizacion, $cotizacion_id);
			//eliminar detalles
			$this->modelo->deleteDetalleCotizacionPre($cotizacion_id);
			$this->modelo->deleteDetalleCotizacionReal($cotizacion_id);
			//guardar detalles
			for($i=0; $i < count($dataPre); $i++){
				$arr_temp = 	[
									'cotizaciones_id' => $cotizacion_id,
									'items_id' => $dataPre[$i][0],
									'n_linea' => ($i+1),
									'cantidad' => $dataPre[$i][1],
									'valor'	=> $dataPre[$i][2]
				];
				$this->modelo->addDetallePre($arr_temp);
			}

			for($i=0; $i < count($dataReal); $i++){
				$arr_temp = 	[
									'cotizaciones_id' => $cotizacion_id,
									'items_id' => $dataReal[$i][0],
									'n_linea' => ($i+1),
									'cantidad' => $dataReal[$i][1],
									'valor'	=> $dataReal[$i][2]
				];
				$this->modelo->addDetalleReal($arr_temp);
			}
			$response = [
				'codigo' => 1,
				'response' => 'Se ha editado de manera correcta el Proyecto.'
			];
		}
		else{
			$response = [
				'codigo' => 0,
				'response' => 'Verifique que los campos obligatorios no esten vacíos.'
			];
		}
		echo json_encode($response);
	}

	public function historico()
	{
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table('cotizaciones');
		$crud->set_subject('Usuario');
		$crud->set_language('spanish');
		/*
		$crud->set_relation('roles_id','roles','nombre');
		$crud->display_as('roles_id','Rol');

		$crud->field_type('password', 'password');
		$crud->field_type('email', 'email');
		
		$crud->unset_columns(array('password'));
		*/
		//$crud->unset_print();
		//$crud->unset_export();
		$crud->unset_clone();
		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();

		$output = $crud->render();
		$data = (array)$output;
		$data['titulo'] = 'Cotizaciones Historico';
		$this->load->view('cotizaciones/historico', $data);
	}
}
